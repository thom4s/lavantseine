<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package lavantseine
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main backgrounded-box" role="main">
		
			<?php
				get_template_part( 'part', 'eventarchive' );
			?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
