<?php
/**
 * The template for displaying the Magazine.
 *
 * Template Name: Page Magazine
 *
 * @package lavantseine
 */

get_header(); ?>

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
								<?php the_post_thumbnail(''); ?>
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



				<div class="last-event-post backgrounded-box">
					<?php

						// Query events to come
						$args = array(
							'post_type' 		=> 'event',
							'posts_per_page' 	=> 1,
							'meta_key' 			=> 'eventDetail_repeatable-date',
							'orderby' 			=> 'meta_value',
							'order' 			=> 'ASC'
						);
						$nextEvent = get_posts( $args );

						foreach ( $nextEvent as $post ) : setup_postdata( $post ); ?>
							
							<?php array_push($exclude_ids, $post->ID); ?>
							<?php $eventRelTagTerms = wp_get_post_terms( $post->ID, 'relational_tag' ); ?>
							<?php $eventRelTag = $eventRelTagTerms[0]->slug; ?>

							<h1>le prochain <b>Spectacle</b></h1>
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
								<?php array_push($exclude_ids, $post->ID); ?>

								<div class="featured-content">
									<a href="<?php the_permalink(); ?>"><h2>
										<?php the_title(); ?>
									</h2></a>

									<div class="entry-meta">
										<span class="date-main">Publié le <?php the_time('d/m/Y'); ?></span>
									</div><!-- .entry-meta -->

									<div class="featured-media">
										<?php the_post_thumbnail('2col-thumbnail'); ?>
									</div>

									<?php $post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );

										echo "<p>".$post_shortText. "</p>";

									?>
								</div>
								

							<?php endforeach; ?>


						<?php endforeach; 
						wp_reset_postdata();
					?>
				</div><!-- end .last-event-post -->



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

					<?php 
						/* Restore original Post Data */
						wp_reset_postdata();
					?>
				</div>


			</div><!-- #main-magazine -->

			<div id="categories-magazine" class=" transparent-background">
				<?php // display_prog_filter_menu(); ?>
				<?php $magFilterID = get_option('magFilterID', '146'); ?>
				<?php echo do_shortcode("[AjaxWPQSF id=". $magFilterID. " formtitle='0']"); ?>
			</div><!-- .categories-magazine -->

			<div id="categories-magazine" class=" transparent-background">
				<h1>Au Sommaire</h1>
				
				<?php
					$args = array(
					  'orderby' => 'name',
					  'parent' => 0
					  );
					$categories = get_categories( $args );
					foreach ( $categories as $category ) {
						echo '<a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a><br/>';
					}
					?>

				
			</div>



		<div class="clearfix"></div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>