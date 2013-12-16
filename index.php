<?php
/**
 * The main template file.
 *
 * @package lavantseine
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main backgrounded-box" role="main">

			<div class="featured-media">
				<img class="" src="<?php bloginfo( 'template_url' ); ?>/img/pano-lorem-img.png">
				<h1>Prochainement</h1>
			</div>

			<div class="next-events">

				<?php
					// Query last fourth events (event post type)
					$args = array(
						'post_type' => 'event',
						'posts_per_page' => '4',
						'meta_key' => 'eventDetail_repeatable-date',
						'orderby' => 'meta_value',
						'order' => 'ASC'
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
				<div class="clearfix"></div>
			</div>

		</main><!-- #main -->
		<div class="clearfix"></div>


		<div id="attached-content" class="">
	
			<h1>Le <b>Magazine</b> de l'Avant Seine</h1>
			
			<div id="homeGrid" class="last-posts" data-columns>
				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

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

			</div>

		</div><!-- #aside -->

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
