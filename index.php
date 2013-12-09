<?php
/**
 * The main template file.
 *
 * @package lavantseine
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="featured-media">
				<img class="" src="<?php bloginfo( 'template_url' ); ?>/img/pano-lorem-img.png">
				<h1>Prochainement</h1>
			</div>

			<div class="next-events">

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

		</main><!-- #main -->
		<div class="clearfix"></div>


		<div id="attached-content" class="">
	
			<div class="featured-media">
				<h1>Le <b>Magazine</b> de l'Avant Seine</h1>
			</div>		
			
			<div class="last-posts">
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
