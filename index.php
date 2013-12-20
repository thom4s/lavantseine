<?php
/**
 * The main template file.
 *
 * @package lavantseine
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main backgrounded-box" role="main">

			<?php
				setlocale(LC_TIME, "fr_FR");
				$today = time();

				// Query last fourth events (event post type)
				$args = array(
				   	'post_type' => 'event',
					'posts_per_page' => '4',   
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

			<div class="featured-media">
				<?php if ( $query->have_posts() ) : ?>
				  <ul class="bxslider">
		
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<li><?php the_post_thumbnail('top-thumbnail'); ?></li>
					<?php endwhile; ?>

				  </ul><!-- .bxslider -->
				<?php endif; ?>

				<h1>Prochainement</h1>
			</div><!-- .featured-media -->

			<div class="next-events">
				<?php if ( $query->have_posts() ) : ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<?php get_template_part( 'boxes', get_post_format() ); ?>
					<?php endwhile; ?>
					<?php lavantseine_paging_nav(); ?>
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>

				<?php 
					/* Restore original Post Data */
					wp_reset_postdata();
				?>
				<div class="clearfix"></div>
			</div>

		</main><!-- #main -->
		<div class="clearfix"></div>

		<div id="attached-content" class="">
			<h1>Le <b>Magazine</b> de l'Avant Seine</h1>
			
			<div id="homeGrid" class="last-posts" data-columns>
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'boxes', get_post_format() ); ?>
					<?php endwhile; ?>
					<?php lavantseine_paging_nav(); ?>
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>
			</div>

		</div><!-- #aside -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
