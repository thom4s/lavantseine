<?php
/**
 * The template for displaying the Contacts
 *
 * Template Name: Page Infos pratiques
 *
 * @package lavantseine
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'infospratiques' ); ?>

				<?php
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
		<div class="clearfix"></div>


		<div id="attached-content">

			<div id="related-content" class="related-posts" data-columns>

			    <?php get_template_part( 'related', 'events' ); ?>
				<?php get_template_part( 'related', 'posts' ); ?>

			</div><!-- /.related-posts -->
		</div>	<!-- #attached-content -->
				
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
