<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package lavantseine
 */


//if page have subpages redirect to the first one
$args = array(
			'post_type' 		=> 	'page',
			'post_parent' 		=> 	get_the_ID(),
			'orderby' 			=> 	'menu_order',
			'order'				=> 	'ASC',
			'posts_per_page'	=>	1
			);
query_posts($args);

if ( have_posts() ):
	the_post();
	wp_redirect(get_permalink(get_the_ID()), 301);
	exit();
endif;

wp_reset_query();


get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

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

			<div id="related-content" class="related-posts" data-columns>
			    <?php

					// Remontée des événements puis des articles liés à l'événement en cours.
				    // Basé sur un related post à partir de la taxonomie 'tag' (tag relationnel)
					$backup = $post;  // backup the current object
					$taxonomy = 'arborescence';//  e.g. post_tag, category, custom taxonomy
					$param_type = 'arborescence'; //  e.g. tag__in, category__in, but genre__in will NOT work
					$post_types = array('event', 'post' );
					$tax_args=array('orderby' => 'none');
					$tags = wp_get_post_terms( $post->ID , $taxonomy, $tax_args);
					if ($tags) {
						foreach ($post_types as $post) {
						  foreach ($tags as $tag) {
						    $args=array(
						      "$param_type" => $tag->slug,
						      'post__not_in' => array($backup->ID),
						      'post_type' => $post,
						      'showposts'=>-1,
						      'caller_get_posts'=>1
						    );
						    $my_query = null;
						    $my_query = new WP_Query($args);
						    if( $my_query->have_posts() ) {
						      while ($my_query->have_posts()) : $my_query->the_post();
						      	get_template_part( 'boxes', get_post_format() );
						      endwhile;
						    }
						  }
						}
					}
					wp_reset_query();

			    ?>
			</div><!-- /.related-posts -->
		</div>	<!-- #attached-content -->

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
