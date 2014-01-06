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
	$post_types = array('event');
	$tax_args = array('orderby' => 'none');

	if ( $taxo == '' ) {
		$fromToday = array(
				       	array(
				           'key' => 'eventDetail_first_date',
				           'value' => $today,
				           'compare' => '>=',
				        )
				    );
	}


	$tags = wp_get_post_terms( $post->ID , $taxonomy, $tax_args);
		if ($tags) {
			foreach ($post_types as $post) {
			  foreach ($tags as $tag) {
			    $args=array(
			    	"$param_type" => $tag->slug,
			    	'post__not_in' => array($backup->ID),
			    	'post_type' => $post,
			    	'showposts'=>-1,
			    	'caller_get_posts'=>1,
			      	'meta_key' => 'eventDetail_first_date',
				   	'orderby' => 'meta_value_num',
				   	'order' => 'ASC',
				   	'meta_query' => $fromToday
			    );
			    $my_query = null;
			    $my_query = new WP_Query($args);
			    if( $my_query->have_posts() ) {
			      while ($my_query->have_posts()) : $my_query->the_post();
			      	get_template_part( 'boxes', get_post_format() );
			      endwhile;
			    }
			  }
			}
		}
		wp_reset_query();

