<?php
/**
 * @package lavantseine
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-media">
		<?php
			$postDetail_mediaMarkup = get_post_meta( $post->ID, 'postDetail_mediaMarkup', true );
			$postDetail_showPic = get_post_meta( $post->ID, 'postDetail_showPic', true );
			
			get_template_part( 'part', 'postslide' );

			if ( !$postDetail_showPic ) {
				the_post_thumbnail(''); 
			}
			if ( $postDetail_mediaMarkup ) {
				echo $postDetail_mediaMarkup;
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
		    Téléchargez le dossier le document ici (.pdf)  
		</a>
		<?php endif; ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php the_date('d/m/Y', '<span class="date-main">Publié le ', '</span>'); ?>

		<div class="post-categories">
			<?php
				$categories = get_the_category();
				$separator = ' ';
				$output = '';
				if($categories){
					foreach($categories as $category) {
						$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" class="saisoned-on-color">#'.$category->cat_name.'</a>'.$separator;
					}
				echo trim($output, $separator);
				}
			?>
		</div><!-- .post-categories -->

		<div class="share-buttons">
			<?php lavantseine_display_share_buttons(); ?>
		</div><!-- .post-social -->

		<?php edit_post_link( __( 'Edit', 'lavantseine' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
