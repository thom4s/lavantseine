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
					setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
					$today = time();
					$previous_month = false;

					// Query events to come
					$args = array(
					   	'post_type' => 'event',
					   	'posts_per_page' => '-1', 
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

					<?php while ( $query->have_posts() ) : $query->the_post(); ?>

						<?php
							// Month Test
							$event_first_date = get_post_meta( $post->ID, 'eventDetail_first_date', true );
							$month = date( 'Y/m', $event_first_date );

							// Test month of event. Display Month Date
							if ( $previous_month != $month ):
								?>
								<div class="box-month" data-date="<?php print strtotime($month.'/01') ?>">
									<h2 class="entry-title">
										<?php print strftime('%B %Y', htmlentities( strtotime($month.'/01')) )?>
									</h2>
								</div><!-- .box -->
								<?php
								$previous_month = $month;
							endif;
						?> <!-- end month test -->

						<?php get_template_part( 'boxes', get_post_format() ); ?>

					<?php endwhile; ?>

					<?php lavantseine_paging_nav(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

				<?php wp_reset_postdata(); ?>
			</div>


