<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package lavantseine
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="search-header backgrounded-box">
				<h1 class="search-title">
					Vous avez demandé...
				</h1>

				<p>
					<?php printf( __( 'Votre recherche : %s', 'lavantseine' ), '<span>' . get_search_query() . '</span>' ); ?>
				</p>

				<div class="post-type-filter">
					<form class="search-form-filter clearfix" method="get" action="">
						<?php global $wp_query; ?>
						<label for="search-from-cat">Afficher </label>
							<?php

							foreach(
								array( 
									'any' => 'Tout',
									'event' => 'les Evénements',
									'post' => 'le Magazine',
									'page' => 'Les autres Pages'
									) as $post_type => $type_title ):
								
								$args = $wp_query->query_vars;
								$args['post_type'] = $post_type;
								query_posts($args);
							?>

								<input type="checkbox" name="" value="/?s=<?php print get_search_query() ?>&amp;post_type=<?php print $post_type ?>"> <?php print $type_title ?> (<?php print $wp_query->found_posts ?>)

							<?php 
							endforeach;
							?>
					</form><!-- .search-form-filter -->
					<?php wp_reset_query(); ?>
				</div>

				<p>Effectuer une nouvelle recherche : <?php get_search_form(); ?></p>
			</header><!-- .page-header -->

			<div id="homeGrid" class="last-posts" data-columns>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'boxes', ''); ?>

				<?php endwhile; ?>
			</div>

			<?php lavantseine_paging_nav(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>


		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
