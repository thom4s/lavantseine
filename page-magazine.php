<?php
/**
 * The template for displaying the Magazine.
 *
 * Template Name: Page Magazine
 *
 * @package lavantseine
 */

get_header();
$today = time();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div id="main-magazine">

				<?php $exclude_ids = array(); ?>

				<div class="featured-post backgrounded-box">
					<?php
						// Display last Featured Post
						$args = array(
							'post_type'		=> 'post',
							'posts_per_page' => 1,
							'meta_query' => array(
								array(
									'key' => 'postDetail_featured',
									'value' => on,
								)
							)
						);
						$featuredPost = get_posts( $args );

						foreach ( $featuredPost as $post ) : setup_postdata( $post ); ?>
							
							<?php array_push($exclude_ids, $post->ID); ?>

							<div class="featured-media">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail(''); ?>
								</a>	
								<h1>le <b>Magazine</b> de l'Avant Seine</h1>
							</div>

							<div class="featured-content">
								<a href="<?php the_permalink(); ?>"><h2>
									<?php the_title(); ?>
								</h2></a>

								<div class="entry-meta">
									<span class="date-main">Publié le <?php the_time('d/m/Y'); ?></span>
								</div><!-- .entry-meta -->

								<?php $post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );

									echo "<p>".$post_shortText. "</p>";

								?>
							</div>

						<?php endforeach; 
						wp_reset_postdata();
					?>
				</div><!-- end .featured-post -->

				<div id="categories-replaced" class="transparent-background">
					<?php display_mag_filter_menu(); ?>
				</div>

					<?php

						// Query events to come
						$args = array(
							'post_type' 		=> 'event',
							'posts_per_page' 	=> 1,
						   	'meta_key' => 'eventDetail_first_date',
						   	'orderby' => 'meta_value_num',
						   	'order' => 'ASC',
						   	'meta_query' => array(
						       	array(
						           'key' => 'eventDetail_first_date',
						           'value' => $today,
						           'compare' => '>=',
						        )
						    )
						);
						$nextEvent = get_posts( $args );

						foreach ( $nextEvent as $post ) : setup_postdata( $post ); ?>

							<?php array_push($exclude_ids, $post->ID); ?>
							<?php $eventRelTagTerms = wp_get_post_terms( $post->ID, 'relational_tag' ); ?>
							<?php $eventRelTag = $eventRelTagTerms[0]->slug; ?>

							<?php

								// Query events to come
								$args = array(
									'post_type' 		=> 'post',
									'posts_per_page'	=> 1,
									'tax_query' => array(
										array(
											'taxonomy' => 'relational_tag',
											'field' => 'slug',
											'terms' => $eventRelTag
										)
									),
									'orderby'			=> 'post_date',
									'order' 			=> 'ASC'	
								);
								$nextEventPost = get_posts( $args );
							?>

							<?php foreach ($nextEventPost as $post) : ?>
								<?php if($post) : ?>
								<div class="last-event-post backgrounded-box">
								<h1>le prochain <b>Spectacle</b></h1>

								<?php array_push($exclude_ids, $post->ID); ?>

								<div class="featured-content">
									<a href="<?php the_permalink(); ?>">
										<h2>
											<?php the_title(); ?>
										</h2>

									<div class="entry-meta">
										<span class="date-main">Publié le <?php the_time('d/m/Y'); ?></span>
									</div><!-- .entry-meta -->

									<div class="featured-media">
										<?php the_post_thumbnail('2col-thumbnail'); ?>
									</div>

									<?php
										$post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );
										echo "<p>".$post_shortText. "</p>";
									?>
									</a>
								</div><!-- .featured-content -->
								
							</div><!-- end .last-event-post -->
							<?php endif; endforeach; ?>


						<?php endforeach; 
						wp_reset_postdata();
					?>




				<div id="magazineGrid"  data-columns class="last-post-list">
					<?php
						// QUERY ALL POST
						// TODO : Exclude featured post and lastEventPost
						$args = array(
							'post_type' 	=> 'post',
							'order'			=> 'DESC',
							'post__not_in'	=> $exclude_ids
						);
						$query = new WP_Query( $args );
					?>

					<?php if ( $query->have_posts() ) : ?>

						<?php /* Start the Loop */ ?>
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>

							<?php
								get_template_part( 'boxes', get_post_format() );
							?>

						<?php endwhile; ?>

						<?php lavantseine_paging_nav(); ?>

					<?php else : ?>

						<?php get_template_part( 'content', 'none' ); ?>

					<?php endif; ?>

					<?php wp_reset_postdata(); ?>
				</div>

			</div><!-- #main-magazine -->

			<div id="categories-magazine" class="transparent-background">
				<?php display_mag_filter_menu(); ?>
			</div><!-- .categories-magazine -->

		<div class="clearfix"></div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
