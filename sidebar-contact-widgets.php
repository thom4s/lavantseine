<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package lavantseine
 */
?>
	<div id="inner-footer-navigations" class="widget-area" role="complementary">
		<?php do_action( 'before_footer-widgets' ); ?>
		<?php if ( ! dynamic_sidebar( 'contact-widgets' ) ) : ?>

			<aside id="archives" class="widget">
				<h1 class="widget-title"><?php _e( 'Archives', 'lavantseine' ); ?></h1>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<h1 class="widget-title"><?php _e( 'Meta', 'lavantseine' ); ?></h1>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

		<?php endif; // end sidebar widget area ?>
	</div><!-- #inner-footer-navigations -->
