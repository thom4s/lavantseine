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

				<p>N'afficher que </p>

				<p>Effectuer une nouvelle recherche : <?php get_search_form(); ?></p>
			</header><!-- .page-header -->

			<div id="homeGrid" class="last-posts" data-columns>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'boxes', ''); ?>

				<?php endwhile; ?>

				<?php lavantseine_paging_nav(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>
			</div>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
