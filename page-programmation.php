<?php
/**
 * The template for displaying all pages.
 *
 * Template Name: Page Programmation
 *
 * @package lavantseine
 */

get_header(); ?>

	<div class="filters backgrounded-box">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main backgrounded-box" role="main">

			<div class="next-events">

				<?php
					// Query last fourth events (event post type)
					$args = array(
						'post_type' => 'event',
						'post_count' => ''
					);
					$query = new WP_Query( $args );
				?>

				<?php if ( $query->have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>

						<?php
							/* Include the Post-Format-specific template for the content.
							 */
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
		<div class="clearfix"></div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
