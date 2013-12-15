<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package lavantseine
 */

get_header(); ?>

	<div class="filters backgrounded-box">
		<?php display_prog_filter_menu(); ?>
	</div>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>


			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>



						<?php 

							// test if month is previous month and display
							// script from mahi-mahi on mep wptheme

							if ( preg_match("#\d+\-\d+?#", get_query_var('quand') ) ):
								$date = get_query_var('quand');
							else:
								$date = get_query_var('quand').'-01-01';
							endif;

							$month = date('Y/m', max(strtotime($date), strtotime(get_post_meta(get_the_ID(), 'eventDetail_repeatable-date', true))));

							if ( $previous_month != $month ):
								?>
								<div class="box<?php echo '-'; echo get_post_type(); ?>" data-date="<?php print strtotime($month.'/01') ?>">
									<h2 class="entry-title">
										<?php print strftime('%B %Y', strtotime($month.'/01')) ?>
									</h2>
								</div><!-- .box -->
								<?php
								$previous_month = $month;
							endif;

						?>



						<?php
							// get box model for each post()
							get_template_part( 'boxes', get_post_format() );
						?>



			<?php endwhile; ?>

			<?php lavantseine_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
