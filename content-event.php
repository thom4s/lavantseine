<?php
/**
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
		
		<div class="inner-entry-content">
			<div class="event-tags">
				<?php
					$post_meta_data = get_post_custom($post->ID);
		
					$tags = wp_get_post_terms($post->ID, 'filtre', array("fields" => "all"));

					$event_dates = get_post_meta( $post->ID, 'eventDetail_dates', true );
					$event_duration = get_post_meta( $post->ID, 'eventDetail_duration', true );
					$event_dates = get_post_meta( $post->ID, 'eventDetail_dates', true );
					$event_repeatable_date = unserialize($post_meta_data['eventDetail_repeatable-date'][0]);
					$event_landscape_media = get_post_meta( $post->ID, 'eventDetail_landscapeMedia', true );
					?>
					

					<?php if ( $event_dates ) : echo "<p>". $event_dates ."</p>"; endif; ?>

					<?php if ( $event_repeatable_date ) : 
						echo '<ul class="event-repeatable-dates">';  
						foreach ($event_repeatable_date as $string) {  
						    echo '<li>'.$string.'</li>';  
						}  
						echo '</ul>';
					endif; ?>

					<?php 
					$count = count($tags);
					if ( $count > 0 ){
					    echo "<ul class='tags-list'>";
					    foreach ( $tags as $term ) {
					    	echo "<li class='saisoned-on-color'>#" . $term->name . "</li>";
					    	echo $term->description;
					    }
					    echo "</ul>";
					} 
					?>

					<?php if ( $event_duration ) : echo "<p> Durée : ". $event_duration ."</p>"; endif; ?>

					<?php $attached = get_post_meta(get_the_ID(), 'wp_custom_attachment', true); ?> 
					<?php if ($attached) : ?>
					<p class="attached-file"><a href="<?php echo $attached['url']; ?>">  
					    Téléchargez le dossier de presse
					</a></p>
					<?php endif; ?>

			</div><!-- .event-tags -->
		</div>

		<div class="inner-entry-content">
			<?php the_content(); ?>
		</div>

		<div class="inner-entry-content">
			<?php the_content(); ?>
		</div>		

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'lavantseine' ),
				'after'  => '</div>',
			) );
		?>
	
	</div><!-- .entry-content -->



	<div class="entry-meta">

		<?php
			$custom_image = $post_meta_data['eventDetail_portraitMedia'][0];  
			echo wp_get_attachment_image($custom_image, ''); 
		?>

		<div class="event-price">
			<?php
				$term_list = wp_get_post_terms($post->ID, 'tarif', array("fields" => "all"));
				$count = count($term_list);
				if ( $count > 0 ){
				    echo "<ul class='tags-list'>";
				    foreach ( $term_list as $term ) {
				    	echo "<li class='saisoned-on-color'>#" . $term->name . "</li>";
				    	echo $term->description;
				    }
				    echo "</ul>";
				}
			?>
		</div><!-- .event-price -->

		<div class="event-dealers">
			<?php
				$event_dealer_link = get_post_meta( $post->ID, 'eventDetail_dealer-link', true );
				$event_dealer_name = get_post_meta( $post->ID, 'eventDetail_dealer-name', true );
			?>		

			<a href="#" class="button saisoned-on-bg">Réservez au Théâtre</a>
			<?php 
				if ( $event_dealer_name ) : ?>
					<a href="<?php echo $event_dealer_link; ?>" target="_blank" class="button saisoned-on-bg">Réservez sur <?php echo $event_dealer_name; ?></a>
			<?php endif; ?>
		</div><!-- .event-dealers -->

		<div class="event-social">
			Facebook | Twitter | G+1
		</div><!-- .event-social -->
	</div><!-- .entry-meta -->


	<footer class="entry-mentions">
		<?php
			$event_distribution = get_post_meta( $post->ID, 'eventDetail_distribution', true );
			if ( $event_distribution ) {
				echo $event_distribution;
			}
		?>
	</footer>

</article><!-- #post-## -->
