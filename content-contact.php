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


	<div class="entry-contact-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'lavantseine' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<div class="entry-contact-aside">
		<h2>Rejoindre la Conversation</h2>

		<?php // get_sidebar( 'contact-widgets' ); ?>

		<div class="fb-activity" data-site="<?php echo FB_URL; ?>" data-action="likes, recommends" data-colorscheme="light" data-header="true"></div>

		<a class="twitter-timeline" data-tweet-limit="5" height="300" ref="https://twitter.com/AvantSeine" data-widget-id="411520589828870144">Tweets de @AvantSeine</a>
	</div><!-- .contact-aside -->




	<?php edit_post_link( __( 'Edit', 'lavantseine' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>


</article><!-- #post-## -->
