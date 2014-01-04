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
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
		<div class="clearfix"></div>


		<div id="attached-content">

			<div id="related-content" class="related-posts" data-columns>

			    <?php get_template_part( 'relatedbyarbo', 'events' ); ?>
				<?php get_template_part( 'relatedbyarbo', 'posts' ); ?>

			</div><!-- /.related-posts -->
		</div>	<!-- #attached-content -->

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
