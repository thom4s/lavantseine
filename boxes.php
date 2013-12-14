<?php
/**
 * @package lavantseine
 */
?>


<article id="post-<?php the_ID(); ?>" class="box<?php echo '-'; echo get_post_type(); ?> backgrounded-box" <?php post_class(); ?>>

	<header class="entry-header">

		<a href="<?php the_permalink(); ?>" rel="bookmark">

			<div class="entry-meta">
				<?php
					/* Get Meta Values if event */
					if ( 'event' == get_post_type() ) :
						$event_dates = get_post_meta( $post->ID, 'eventDetail_dates', true );
						$event_hour = get_post_meta( $post->ID, 'eventDetail_hour', true );
						$event_landscape_media = get_post_meta( $post->ID, 'eventMedia_landscape', true );

						if ( $event_dates ) {
							echo "<span class='date-main'>". $event_dates . "</span>";
						}
						if ( $event_hour ) {
							echo " - <span class='date-main'>". $event_hour . "</span>";
						}	
						if ( $eventMedia_landscape ) {
							echo $event_dates;
						}
						the_post_thumbnail('box-thumb');
					endif; // End if 'event' == get_post_type()  
				?>
		
			</div><!-- .entry-meta -->


			<h2 class="entry-title">	
					<?php the_title(); ?>
			</h2>


			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<span class="date-main">Publié le <?php the_time('d/m/Y'); ?></span>
			</div><!-- .entry-meta -->
			
			<?php 
				the_post_thumbnail('box-thumb');
				endif; // End if 'post' == get_post_type() 
			?>
		</a>
	</header><!-- .entry-header -->


	<div class="entry-summary">
		<?php
			$event_shortText = get_post_meta( $post->ID, 'eventDetail_shortText', true );
			$post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );

			if ( $event_shortText ) {
				echo "<p>". $event_shortText. "</p>";
			} elseif ($post_shortText) {
				echo "<p>".$post_shortText. "</p>";
			}
		?>
	</div><!-- .entry-summary -->


	<footer class="entry-meta">
		<?php if ( 'event' == get_post_type() ) : ?>
			<?php 
				$terms = wp_get_post_terms( $post->ID, array('discipline', 'rdv'), $args );
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
