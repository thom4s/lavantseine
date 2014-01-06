<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package lavantseine
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php $page_intro = get_post_meta( $post->ID, 'pageDetail_intro', true ); ?>
	<?php $page_right_col = get_post_meta( $post->ID, 'pageDetail_rightCol', true ); ?>

	<div class="entry-media">
		<?php the_post_thumbnail(''); ?>
	</div>

	<header class="entry-practical-header">
		<div class="entry-extract">
			<?php echo $page_intro; ?>
		</div>
		<div class="clearfix"></div>
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->


	<div class="entry-practical-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'lavantseine' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<div class="entry-practical-aside">

		<?php echo apply_filters('the_content', $page_right_col); ?>
		<?php // echo $page_right_col; ?>
		
	</div><!-- .practical-aside -->




	<?php edit_post_link( __( 'Edit', 'lavantseine' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>


</article><!-- #post-## -->
