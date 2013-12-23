<?php 

	$event_first_date = get_post_meta( $post->ID, 'eventDetail_first_date', true );
	$month = date( 'Y/m', $event_first_date );

	// Test month of event. Display Month Date
	if ( $previous_month != $month ): ?>
		<div class="box-month" data-date="<?php print strtotime($month.'/01') ?>">
			<h2 class="entry-title">
				<?php print strftime('%B %Y', htmlentities( strtotime($month.'/01')) )?>
			</h2>
		</div><!-- .box -->
		<?php $previous_month = $month;
	endif;
?>