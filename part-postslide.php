<?php

$media_items = get_posts(array(
	'post_type'		=>	'attachment',
	'_media_tag'	=>	'slide',
	'post_parent' 	=> get_the_ID(),
	'posts_per_page' => -1
));

if ($media_items): ?>
	<ul class="slider bxslider-with-controls">
		<?php foreach ( $media_items as $media_item ) : ?>
			<li class="slide">
				<?php the_attachment_link( $media_item->ID, true, false, false ); ?>
			</li>
		<?php endforeach; ?>
	</ul><!-- slides -->

<?php endif;


