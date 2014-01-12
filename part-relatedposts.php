<?php

	setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
	$today = time();

	// Remontée des événements puis des articles liés à l'événement en cours.
	// Basé sur un related post à partir de la taxonomie 'tag' (tag relationnel)
	global $post;
	global $taxo;

	$backup = $post;  // backup the current object
	$taxonomy = $taxo;
	$param_type = $taxo;
	$post_types = array('event', 'post');
	$tax_args = array('orderby' => 'none');

	$tags = wp_get_post_terms( $post->ID , $taxonomy, $tax_args);
	
	if ( !empty($tags) ) {
		foreach ($tags as $tag) {
			//first query
			$events = get_posts(array(
				"$param_type" => $tag->slug,
				'post_type' => 'event',
				'posts_per_page'=>-1,
				'meta_key' => 'eventDetail_first_date',
				'orderby' => 'meta_value_num',
				'order' => 'DESC',
			));
			//second query
			$articles = get_posts(array(
				"$param_type" => $tag->slug,
				'post_type' => 'post',
				'posts_per_page'=>-1,
				'orderby' => 'date',
				'order' => 'DESC',
			));
		}

		if ($events) {
			$eventsids = array();
			foreach( $events as $item ) {
				$eventdate = htmlspecialchars( get_post_meta( $item->ID, 'eventDetail_first_date', true ) );
				$eventsids[$eventdate] = $item->ID; 

			}
		}
		if ($articles) {
			$articlesids = array();
			foreach( $articles as $item ) {
				$articledate = get_the_time( 'U', $item->ID );
				$articlesids[$articledate] = $item->ID; 
			}
		}

		if ($eventsids && $articlesids) {
			$postids = $eventsids + $articlesids;
		} elseif ( $eventsids && !$articlesids ) {
			$postids = $eventsids;
		} elseif ( !$eventsids && $articlesids  ) {
			$postids = $articlesids;
		} else {
			$postids = array();
		}
		
		krsort($postids);
		$uniqueposts = array_unique($postids); 

		if( $uniqueposts ) {
			$posts = get_posts(array(
					'post__in' => $uniqueposts, 
					'post_type' => array('event', 'post'),
					'post_status' => 'publish',
					'orderby'		=> 'post__in',
					'posts_per_page'   => 24,
			 		));
			foreach( $posts as $post ) :
				get_template_part( 'boxes', get_post_format() );
			endforeach;
		} else {
			return;
		}

	}
	wp_reset_query();




