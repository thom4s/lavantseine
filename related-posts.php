<?php
	
	// Remontée des événements puis des articles liés à l'événement en cours.
	// Basé sur un related post à partir de la taxonomie 'tag' (tag relationnel)
	global $post;
	global $taxo;

	$backup = $post;  // backup the current object
	$taxonomy = $taxo;
	$param_type = $taxo;
	$post_types = array('post' );
	$tax_args=array('orderby' => 'none');
	$tags = wp_get_post_terms( $post->ID , $taxonomy, $tax_args);
		if ($tags) {
			foreach ($post_types as $post) {
			  foreach ($tags as $tag) {
			    $args=array(
			    	"$param_type" => $tag->slug,
			    	'post__not_in' => array($backup->ID),
			    	'post_type' => $post,
			    	'showposts'=>-1,
			    	'caller_get_posts'=>1
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