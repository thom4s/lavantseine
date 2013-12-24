<?php

$media_items = get_posts(array(
	'post_type'		=>	'attachment',
	'post_parent' 	=> get_the_ID(),
	'posts_per_page' => -1,
	'meta_key'      => '_media_tag',
	'meta_value'	=> 'slide'
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


