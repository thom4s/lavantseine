<?php

	// Remontée des événements puis des articles liés à l'événement en cours.
	global $post; // for current $post backup
	global $taxo; // twonomy to link ('arborescence' for pages ; 'tag_relationnel' for events and posts)

	$backup = $post;  // backup the current object
	$taxonomy = $taxo; 
	$param_type = $taxo;
	$post_types = array('event', 'post');
	$tax_args = array('orderby' => 'none', );

	$tags = wp_get_post_terms( $post->ID , $taxonomy, $tax_args);

	$articles = array();
	$events = array();

	if ( !empty($tags) ) {
		foreach ($tags as $tag) {
			//first query
			$events_get_posts = get_posts(array(
				"$param_type" => $tag->slug,
				'post_type' => 'event',
				'posts_per_page'=>-1,
				'exclude'		=> $backup->ID,
				'meta_key' => 'eventDetail_first_date',
				'orderby' => 'meta_value_num',
				'order' => 'DESC',
			));
			$events = $events_get_posts + $events;

			//second query
			$articles_get_posts = get_posts(array(
				"$param_type" => $tag->slug,
				'post_type' => 'post',
				'posts_per_page'=>-1,
				'exclude'		=> $backup->ID,
				'orderby' => 'date',
				'order' => 'DESC',
			));
			$articles = $articles_get_posts + $articles;
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

			if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
			elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
			else { $paged = 1; }

			$args = array(
					'post__in' 			=> $uniqueposts,
					'post_type' 		=> $post_types,
					'post_status' 		=> 'publish',
					'orderby'			=> 'post__in',
					'posts_per_page'	=> 24,
					'paged'				=> $paged
			 		);  

			$wp_query = new WP_Query( $args );

			if ( $wp_query->have_posts() ):
			    while ( $wp_query->have_posts() ) :
			        $wp_query->the_post();
			    	get_template_part( 'boxes', get_post_format() );
			    endwhile;
			endif;
		}

	}




