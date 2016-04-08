<?php
/**
 * The main template file.
 *
 * @package lavantseine
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main backgrounded-box" role="main">

			<?php
				setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
				$today = time();
				$todayPlusOneMonth = strtotime("+1 month", $today);

				// Query last fourth events (event post type)
				$args = array(
				   	'post_type' => 'event',
						'posts_per_page' => '4',   
				   	'meta_key' => 'eventDetail_first_date',
				   	'orderby' => 'meta_value_num',
				   	'order' => 'ASC',
				   	'meta_query' => array(
				       	array(
				           'key' => 'eventDetail_last_date',
				           'value' => $today,
				           'compare' => '>=',
				        )
				    )
				);

				$query = new WP_Query( $args );
			?>

			<div class="featured-media">
				<?php if ( $query->have_posts() ) : ?>
				  <ul class="slider bxslider-no-controls">
		
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<a href="<?php the_permalink(); ?>"><li><?php the_post_thumbnail('top-thumbnail'); ?></li></a>
					<?php endwhile; ?>

				  </ul><!-- .bxslider -->
				<?php endif; ?>

				<h1>Prochainement</h1>
			</div><!-- .featured-media -->

			<div id="home-next-events" class="next-events">

				<?php if ( $query->have_posts() ) : ?>
					<?php $i = 1;  ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>

						<?php get_template_part( 'boxes', get_post_format() ); ?>
					
					<?php $i++; ?>
					<?php endwhile; ?>
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>


				<?php 
					wp_reset_postdata();
				?>
				<div class="clearfix"></div>
			</div>

		</main><!-- #main -->
		<div class="clearfix"></div>

		<div id="attached-content" class="">
			<a href="/magazine"><h1>Le <b>Magazine</b> de l'Avant Seine</h1></a>
			
			<?php 

					// Lister événements à venir sous 30 jours
					$args = array(
						'post_type' 		=> 'event',
						'posts_per_page' 	=> -1,
					   	'meta_key' => 'eventDetail_last_date',
					   	'orderby' => 'meta_value_num',
					   	'order' => 'ASC',
					   	'meta_query' => array(
					   		'RELATION'	=> 'AND',
					     	array(
					        'key' => 'eventDetail_last_date',
					        'value' => $today,
					        'compare' => '>=',
					      ),
					      array(
					        'key' => 'eventDetail_last_date',
					        'value' => $todayPlusOneMonth,
					        'compare' => '<=',
					      ),
					    )
					);
					$eventsNext30Days = get_posts( $args );

					// Lister les tags relationnels de ces événements à venir
					$eventRelTags = array();
					foreach ($eventsNext30Days as $event) {
						$tags = wp_get_post_terms( $event->ID, 'relational_tag' );
						array_push($eventRelTags, $tags[0]->slug);
					}
			?>


			<div id="homeGrid" class="last-posts" data-columns>

				<?php

					$articles = array();

					// Lister articles avec tags relationnels des événements à venir
					$args = array(
						'post_type' 		=> 'post',
						'posts_per_page'	=> 9,
						'tax_query' => array(
							array(
								'taxonomy' => 'relational_tag',
								'field' => 'slug',
								'terms' => $eventRelTags
							)
						),
						'orderby'			=> 'post_date',
						'order' 			=> 'DESC'	
					);

					$nextEventPost = get_posts( $args );
					$articles = array_merge($nextEventPost, $articles);
					wp_reset_postdata();


					// Lister articles sans liens avec événements, donc sans tags relationnels
					$relTags = get_terms( 'relational_tag', 'orderby=count&hide_empty=0' );
					$tagsArray = array();

					foreach ($relTags as $tag) {
						$tagsArray[] = $tag->slug;
					}

					$args_2 = array(
						'post_type' 		=> 'post',
						'posts_per_page'	=> 3,
						'tax_query' => array(
							array(
								'taxonomy' 	=> 'relational_tag',
								'field' 		=> 'slug',
								'terms' 		=> $tagsArray,
								'operator'	=> 'NOT IN'
							)
						),
						'orderby'			=> 'post_date',
						'order' 			=> 'DESC'	
					);

					$singlePost = get_posts( $args_2 );
					$articles = array_merge($singlePost, $articles);
					wp_reset_postdata();



					// On mélange
					if ($articles) {
						$articlesids = array();
						foreach( $articles as $item ) {
							$articledate = get_the_time( 'U', $item->ID );
							$articlesids[$articledate] = $item->ID; 
						}
					}

					krsort($articlesids);
					$uniqueposts = array_unique($articlesids);

					if( $uniqueposts ) {

						$args = array(
								'post__in' 				=> $uniqueposts,
								'orderby'					=> 'post__in',
								'posts_per_page'	=> -1,
						);  

						$wp_query = new WP_Query( $args );

						if ( $wp_query->have_posts() ):
						    while ( $wp_query->have_posts() ) :
						      $wp_query->the_post();
						    	$tags = get_the_terms( $post->ID, 'relational_tag' );

						    	if($tags) {
						    		get_template_part( 'boxes', get_post_format() );
						    	} else {
						    		get_template_part( 'boxes-plain', get_post_format() );
						    	}
						    endwhile;
						endif;
					}


				?>



			</div>

		</div><!-- #aside -->
	</div><!-- #primary -->


<?php get_footer(); ?>
