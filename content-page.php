<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package lavantseine
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-media">
		<?php the_post_thumbnail(''); ?>
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
	</div><!-- .entry-content -->

	<?php edit_post_link( __( 'Edit', 'lavantseine' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>


</article><!-- #post-## -->
