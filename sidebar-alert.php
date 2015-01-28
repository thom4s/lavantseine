<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package lavantseine
 */
?>
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'alert' ) ) : ?>
		<?php endif; // end sidebar widget area ?>
