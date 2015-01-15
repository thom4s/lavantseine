<?php
/**
 * @package lavantseine
 */
?>

<?php global $filter; ?>
<?php global $i; ?>

<article id="post-<?php the_ID(); ?>" class="box-<?php echo $i; ?> box<?php echo '-'; echo get_post_type(); ?> plain-box" <?php post_class(); ?>>

	<div class="inner-box absoluted full">

		<?php the_post_thumbnail('box-plain'); ?>

		<div class="absoluted full box-content">

			<a href="<?php the_permalink(); ?>" <?php if ( $filter ) { echo 'target="_blank"'; } ?>rel="bookmark">

				<header class="entry-header">

						<h2 class="entry-title">	
								<?php the_title(); ?>
						</h2>

						<div class="entry-meta">
							<span class="date-main">Publié le <?php the_time('d/m/Y'); ?></span>
						</div><!-- .entry-meta -->
						
				</header><!-- .entry-header -->


				<div class="entry-summary">
					<?php
						$post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );

						echo "<p>".$post_shortText. "</p>";
					?>
				</div><!-- .entry-summary -->

			</a>

			<footer class="entry-meta">
					<?php 
						$terms = wp_get_post_terms( $post->ID, array('category'), $args );
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
			</footer><!-- .footer -->


		</div><!-- .absolute -->



	</div>



</article><!-- #post-## -->
