<?php
/**
 * The template part for displaying the event listing for programmation pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package lavantseine
 */
?>

			<div class="next-events">

				<?php
					$previous_month = false;

					// Query events to come
					$args = array(
					   	'post_type' => 'event',
					   	'meta_key' => 'eventDetail_first_date',
					   	'orderby' => 'meta_value_num',
					   	'order' => 'ASC',
					   	'meta_query' => array(
					       	array(
					           'key' => 'eventDetail_first_date',
					           'value' => $today,
					           'compare' => '>=',
					        )
					    )
					);

					$query = new WP_Query( $args );
				?>

				<?php if ( $query->have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>

						<?php 

							$event_first_date = get_post_meta( $post->ID, 'eventDetail_first_date', true );
							$month = date( 'Y/m', $event_first_date );

							// Get Month of present event  $event_date
							// test if egal at previous month  $previous_month
							// if event month == previous month, go on
							// if event month != previous month, display event month

							if ( $previous_month != $month ):
								?>
								<div class="box-month" data-date="<?php print strtotime($month.'/01') ?>">
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

				<?php 
					/* Restore original Post Data */
					wp_reset_postdata();
				?>
			</div>


