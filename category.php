<?php
/**
 * The template for displaying the Magazine.
 *
 * Template Name: Page Magazine
 *
 * @package lavantseine
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<header class="archive-header">
				<h1 class="archive-title">
					Tous les articles pour <span class="saisoned-on-color">#<?php single_cat_title(); ?></span>
				</h1>
			</header>

			<div id="main-magazine">

				<?php if ( have_posts() ) : ?>

				<div id="magazineGrid"  data-columns class="last-post-list">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							get_template_part( 'boxes', get_post_format() );
						?>

					<?php endwhile; ?>

					<?php lavantseine_paging_nav(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>
				</div>

			</div><!-- #main-magazine -->

			<div id="categories-magazine" class="transparent-background">
				<?php display_mag_filter_menu(); ?>
				<?php $magFilterID = get_option('magFilterID', '146'); ?>
				<?php // echo do_shortcode("[AjaxWPQSF id=". $magFilterID. " formtitle='0']"); ?>
			</div><!-- .categories-magazine -->


		<div class="clearfix"></div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
