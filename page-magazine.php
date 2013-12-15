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



				<div class="last-event-post">
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
						$lastEventPost = get_posts( $args );

						foreach ( $lastEventPost as $post ) : setup_postdata( $post ); ?>
							<?php array_push($exclude_ids, $post->ID); ?>

							<h1>le prochain <b>Spectacle</b></h1>
							<li>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</li>
						<?php endforeach; 
						wp_reset_postdata();
					?>
				</div><!-- end .last-event-post -->



				<div class="last-post-list">
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
