<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package lavantseine
 */
?>

		<header class="search-header backgrounded-box">
			
			<?php if ( is_404() ) : ?>

				<h1 class="search-title">
					<?php _e( 'La page n\'existe pas...', 'lavantseine' ); ?>
				</h1>
				
				<p><?php _e( 'Oups, aucune page ne correspond à votre recherche. Mais puisqu\'il se passe toujours quelque chose à l\'Avant Seine, retentez votre chance !', 'lavantseine' ); ?></p>
				
			<?php else : ?>
	
				<h1 class="search-title">
					<?php _e( 'Pas de résultat', 'lavantseine' ); ?>
				</h1>
				
				<p><?php _e( 'Oups, aucun résultat ne correspond à votre recherche. Mais puisqu\'il se passe toujours quelque chose à l\'Avant Seine, retentez votre chance !', 'lavantseine' ); ?></p>
			
			<?php endif; ?>

			<?php get_search_form(); ?>
		</header><!-- .page-header -->


		<div class="page-content">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'lavantseine' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>


			<?php endif; ?>
		</div><!-- .page-content -->
