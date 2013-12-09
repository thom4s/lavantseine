<?php
/**
 * @package lavantseine
 */
?>



<article id="post-<?php the_ID(); ?>" class="box<?php echo '-'; echo get_post_type(); ?> backgrounded-box" <?php post_class(); ?>>



	<header class="entry-header">

		<div class="entry-meta">
			<?php
				/* Get Meta Values if event */
				if ( 'event' == get_post_type() ) :
					$event_dates = get_post_meta( $post->ID, 'eventDetail_dates', true );
					$event_landscape_media = get_post_meta( $post->ID, 'eventMedia_landscape', true );
					if ( $event_dates ) {
						echo $event_dates;
					}
					if ( $eventMedia_landscape ) {
						echo $event_dates;
					}
					the_post_thumbnail('box-thumb');
				endif; // End if 'event' == get_post_type()  
			?>
	
		</div><!-- .entry-meta -->


		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h2>


		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php the_date(); ?>
		</div><!-- .entry-meta -->
		
		<?php 
			the_post_thumbnail('box-thumb');
			endif; // End if 'post' == get_post_type() 
		?>

	</header><!-- .entry-header -->


	<div class="entry-summary">
		<?php
			$event_shortText = get_post_meta( $post->ID, 'eventDetail_shortText', true );
			if ( $event_shortText ) {
				echo $event_shortText;
			}
		?>
	</div><!-- .entry-summary -->


	<footer class="entry-meta">
		<?php if ( 'event' == get_post_type() ) : ?>
			<?php 
				$terms = wp_get_post_terms( $post->ID, 'filtre', $args );
				$count = count($terms);
				if ( $count > 0 ){
				    echo "<ul>";
				    foreach ( $terms as $term ) {
				    	$term_link = get_term_link( $term, '' );
					    echo "<a href='". $term_link ."'><li class='saisoned-on-color'>#" . $term->name . "</li></a>";
				    }
				    echo "</ul>";
				}
			?>
		<?php endif; // End if 'event' == get_post_type() ?>

	</footer><!-- .entry-meta -->
</article><!-- #post-## -->

