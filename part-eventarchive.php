<?php
/**
 * Part for event Archives
 *
 * @package lavantseine
 */
?>

		<?php if ( have_posts() ) : ?>

			<header class="archive-header">
				<h1 class="archive-title">
					Tous les événements pour <span class="saisoned-on-color">#<?php single_cat_title(); ?></span>
				</h1>
			</header>

			<div class="next-events">

			<?php // get_template_part( 'box', 'blank' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					// Month Test
					$event_first_date = get_post_meta( $post->ID, 'eventDetail_first_date', true );
					// $month = date( 'Y/m', $event_first_date );

					// Test month of event. Display Month Date
					if ( $previous_month != $month ):
						?>
						<div class="box-month backgrounded-box" data-date="<?php print strtotime($month.'/01') ?>">
							<h2 class="entry-title">
								<?php print strftime('%B %Y', htmlentities( strtotime($month.'/01')) )?>
							</h2>
						</div><!-- .box -->
						<?php
						$previous_month = $month;
					endif;
				?> <!-- end month test -->

				<?php
					get_template_part( 'boxes', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php lavantseine_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

			</div><!-- .nex-events -->
		<?php endif; ?>


