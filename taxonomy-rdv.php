<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package lavantseine
 */

get_header(); ?>

	<div id="prog-filters" class="filters backgrounded-box">
		<?php // display_prog_filter_menu(); ?>
		<?php $progFilterID = get_option('progFilterID', '143'); ?>
		<?php echo do_shortcode("[AjaxWPQSF id=". $progFilterID. " formtitle='0']"); ?>
	</div><!-- .filters -->

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
			<?php
				get_template_part( 'part', 'eventarchive' );
			?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
