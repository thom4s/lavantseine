<?php
/**
 * @package lavantseine
 */
?>

<article id="post-<?php the_ID(); ?>" class="box-post backgrounded-box" <?php post_class(); ?>>
	<header class="entry-header">

		<?php if ( 'event' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php lavantseine_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>


		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h2>


		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php lavantseine_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>

	</header><!-- .entry-header -->




	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>


	<div class="entry-content">


	</div><!-- .entry-content -->
	<?php endif; ?>


	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'lavantseine' ) );
				if ( $categories_list && lavantseine_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'lavantseine' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'lavantseine' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'lavantseine' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'lavantseine' ), __( '1 Comment', 'lavantseine' ), __( '% Comments', 'lavantseine' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'lavantseine' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->

