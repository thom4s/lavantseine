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
		<?php echo do_shortcode("[AjaxWPQSF id=143 formtitle='0']"); ?>
		<?php // echo do_shortcode("[awsqf-form id=145]"); ?>
	</div><!-- .filters -->


	<div id="primary" class="content-area">
		<main id="main" class="site-main backgrounded-box" role="main">


			<?php get_template_part( 'content', 'programmation' ); ?>


		<div class="clearfix"></div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
