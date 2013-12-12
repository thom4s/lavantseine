<?php
/**
 * @package lavantseine
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-media">
		<?php
			$postDetail_mediaMarkup = get_post_meta( $post->ID, 'postDetail_mediaMarkup', true );
			if ( $postDetail_mediaMarkup ) {
				echo $postDetail_mediaMarkup;
			} else {
				the_post_thumbnail(''); 
			}
		?>
	</div>

	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'lavantseine' ),
				'after'  => '</div>',
			) );
		?>
	
		<?php $attached = get_post_meta(get_the_ID(), 'wp_custom_attachment', true); ?> 

		<?php if ($attached) : ?>
		<a href="<?php echo $attached['url']; ?>">  
		    Download PDF Here  
		</a>
		<?php endif; ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php the_date('d/m/Y', '<span class="date-main">Publié le ', '</span>'); ?>

		<div class="post-categories">
			<?php the_category(', ') ?>
		</div><!-- .post-categories -->

		<div class="post-social">
			<?php lavantseine_display_share_buttons(); ?>
		</div><!-- .post-social -->

		<?php edit_post_link( __( 'Edit', 'lavantseine' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
