<?php
/**
 * The template for displaying the Events Programmation
 *
 * Template Name: Page Programmation
 *
 * @package lavantseine
 */
get_header(); ?>

	<div class="filters backgrounded-box">
		<?php // display_prog_filter_menu(); ?>
		<?php $progFilterID = get_option('progFilterID', '143'); ?>
		<?php echo do_shortcode("[AjaxWPQSF id=". $progFilterID. " formtitle='0']"); ?>
	</div><!-- .filters -->


	<div id="primary" class="content-area">
		<main id="main" class="site-main backgrounded-box" role="main">

			<?php get_template_part( 'content', 'programmation' ); ?>

		<div class="clearfix"></div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
