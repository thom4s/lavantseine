<?php
/**
 * @package lavantseine
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="entry-media">
		<?php
			$eventDetail_mediaMarkup = get_post_meta( $post->ID, 'eventDetail_mediaMarkup', true );
			$eventDetail_showPic = get_post_meta( $post->ID, 'eventDetail_showPic', true );
			
			get_template_part( 'part', 'postslide' );

			if ( !$eventDetail_showPic ) {
		  	the_post_thumbnail('top-thumbnail');
			}
			if ( $eventDetail_mediaMarkup ) {
				echo $eventDetail_mediaMarkup;
			}
		?>
	</div>

	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="relatived">
		<div class="entry-content">
			
			<div class="inner-entry-content">
				<div class="event-tags">
					<?php
						setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');

						$post_meta_data = get_post_custom($post->ID);
		
						$tags = wp_get_post_terms($post->ID, array('discipline', 'rdv'), array("fields" => "all"));

						$event_dates = get_post_meta( $post->ID, 'eventDetail_dates', true );
						$event_duration = get_post_meta( $post->ID, 'eventDetail_duration', true );
						$event_text2 = get_post_meta( $post->ID, 'eventDetail_text2', true );
						$event_first_date = htmlspecialchars( get_post_meta( $post->ID, 'eventDetail_first_date', true ) );
						$event_last_date = htmlspecialchars( get_post_meta( $post->ID, 'eventDetail_last_date', true ) );
						$event_other_dates = unserialize($post_meta_data['eventDetail_otherdates'][0]);
						$event_landscape_media = get_post_meta( $post->ID, 'eventDetail_landscapeMedia', true );
						?>
						

						<?php // if ( $event_dates ) : echo "<span class='date-main'>". $event_dates ."</span>" ; endif; ?>

						<?php if ( $event_first_date ) : 
							echo '<ul class="event-repeatable-dates">';
							    echo '<li>'. strftime('%A %e %b %G - %kh%M', $event_first_date ) .'.</li>'; 

							if ( $event_other_dates ) : 
								foreach ($event_other_dates as $date) { 
									$date = strtotime($date);
								    if ( $date != '' ) : 
								    	echo '<li>'. strftime('%A %e %b %G - %kh%M', $date ) .'.</li>'; 
								    endif;
								} 
							endif; 

							if ( $event_last_date && $event_last_date != $event_first_date ) : 
							    echo '<li>'. strftime('%A %e %b %G - %kh%M', $event_last_date ) .'.</li>'; 							    
							endif;

							echo '</ul>';
						endif; ?>

						<?php 
						$count = count($tags);
						if ( $count > 0 ){
						    echo "<ul class='tags-list'>";
						    foreach ( $tags as $term ) {
				    			$term_link = get_term_link( $term, '' );
						    	echo "<a href='". $term_link ."'><li class='saisoned-on-color'>#" . $term->name . "</li></a>";
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

						<?php if ( $event_text2 ) : echo "<p class=''>". $event_text2 ."</p>"; endif; ?>

				</div><!-- .event-tags -->

				<div class="event-publics">
					<?php
					$publics =  get_the_terms( $post->ID, 'public' );
					if($publics) {
					  foreach ($publics as $public) {
					  	echo '<div class="event-public-item">';
						    $tax_term_id = $public->term_taxonomy_id;
						    $images = get_option('taxonomy_image_plugin');
						    
						    echo '<p class="public-label">A partir de</p>';
						    echo '<div class="public-img">';
						    	echo wp_get_attachment_image( $images[$tax_term_id], '' );
						    	echo '<p class="public-name">'. $public->name .'</p>';
						    echo '</div>';
   					  echo '</div>';
					  }
					}
					?>

				</div>





			</div>

			<div class="inner-entry-main-content">
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

			<div class="event-portrait-media">
				<?php
					$custom_image = $post_meta_data['eventDetail_portraitMedia'][0];  
					echo wp_get_attachment_image($custom_image, ''); 
				?>
			</div><!-- .event-portrait-media -->

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

				<a href="<?php bloginfo('url'); ?>/les-infos-pratiques/tarifs-et-reservations/" class="button saisoned-on-bg">Réservez au Théâtre</a>
				<?php 
					if ( $event_dealer_name ) : ?>
						<a href="<?php echo $event_dealer_link; ?>" target="_blank" class="button saisoned-on-bg">Réservez sur <?php echo $event_dealer_name; ?></a>
				<?php endif; ?>
			</div><!-- .event-dealers -->

			<div class="share-buttons">
				<?php lavantseine_display_share_buttons(); ?>
			</div><!-- .event-social -->

		</div><!-- .entry-meta -->


		<?php $event_distribution = get_post_meta( $post->ID, 'eventDetail_distribution', true ); ?>
		<?php $event_mentions = get_post_meta( $post->ID, 'eventDetail_mentions', true ); ?>
		<?php if ( $event_distribution || $event_mentions ) : ?>
		<footer class="entry-mentions">
			<p id="display-entry-mentions"><a href="#">+ distributions et mentions complètes</a></p>
			
			<div id="inner-entry-mentions">
				<?php
						echo "<p>". $event_distribution ."</p>";
						echo "<p>". $event_mentions ."</p>";
				?>
			</div>
		</footer><!-- .entry-mentions -->
		<?php endif; ?>
	</div><!-- .relatived -->

</article><!-- #post-## -->
