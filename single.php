<?php
/**
 * The Template for displaying all single posts.
 *
 * @package lavantseine
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php lavantseine_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->

		<div class="clearfix"></div>


		<div id="attached-content">

			<div class="related-posts">
			    <?php
			        // Remontée des événements puis des articles liés à l'événement en cours.
			    	// Basé sur un related post à partir de la taxonomie 'tag' (tag relationnel)
			   		$tags = wp_get_post_terms( $post->ID, 'tag' );

			        if ($tags) {
			            $first_tag = $tags[0]->term_id;

			            $events_args = array(
			            	'post_type' => 'event',
			                'tag' => $first_tag->slug,
			                'post__not_in' => array($post->ID),
			            );
			            $related_posts_query = new WP_Query($events_args);
			            if( $related_posts_query->have_posts() ) {
			                echo '<div class="last-posts">';
			                while ($related_posts_query->have_posts()) : $related_posts_query->the_post();
			                		get_template_part( 'boxes', get_post_format() );

			                endwhile;
			                echo '</div>';
			            }
			            wp_reset_query();


			            $posts_args = array(
			            	'post_type' => 'post',
			                'tag' => $first_tag->slug,
			                'post__not_in' => array($post->ID),
			            );
			            $related_posts_query = new WP_Query($posts_args);
			            if( $related_posts_query->have_posts() ) {
			                echo '<div class="last-posts">';
			                while ($related_posts_query->have_posts()) : $related_posts_query->the_post();
			                		get_template_part( 'boxes', get_post_format() );

			                endwhile;
			                echo '</div>';
			            }
			            wp_reset_query();
			        }
			    ?>
			</div><!-- /.related-posts -->
		</div>	<!-- #attached-content -->

		<div id="content-to-content">
			<?php // lavantseine_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>
		</div><!-- #content-to-content -->


		
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>