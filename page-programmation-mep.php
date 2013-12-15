<?php
define('template_class', 'programmation');
wp_enqueue_script('mep-programmation');
wp_enqueue_style('mep-programmation');

if ( ! isset($exclude) )
	$exclude = array();

$args = array(
	'post_type' => array('event'),
	'post__not_in' => $exclude,
	'paged' => get_query_var('ppage'),
	'posts_per_page'	=>	17,
	'meta_key' => 'start_date',
	'orderby' => 'meta_value',
	'order' => 'ASC'
	);

if ( get_query_var('q') ):
	$args['s'] = get_query_var('q');
endif;


if ( get_query_var('ou') ):
	switch(get_query_var('ou')):
		case 'hors-des-murs':
		case 'hors-les-murs':
			$args['tax_query'][] = array(
					'taxonomy'	=>	'place',
					'field'		=>	'slug',
					'terms'		=>	array('maison-europeenne-de-la-photographie', 'virtuelle'),
					'operator' => 'NOT IN'
				);
		break;
		case 'virtuel':
			$args['tax_query'][] = array(
					'taxonomy'	=>	'place',
					'field'		=>	'slug',
					'terms'		=>	'virtuelle'
				);
		break;
		default:
			$args['tax_query'][] = array(
					'taxonomy'	=>	'place',
					'field'		=>	'slug',
					'terms'		=>	get_query_var('ou')
				);
		break;
	endswitch;
endif;

if ( get_query_var('quoi') ):
	$args['tax_query'][] = array(
			'taxonomy'	=>	'event_category',
			'field'		=>	'slug',
			'terms'		=>	preg_split("#,#", get_query_var('quoi'))
		);
endif;

if ( count($args['tax_query']) > 1):
	$args['tax_query']['relation'] = 'AND';
endif;

if ( get_query_var('quand') ):
	if ( preg_match("#\d+\-\d+?#", get_query_var('quand') ) ):
		$date = strtotime( get_query_var('quand') );
		$args['meta_date_after_key'] = 'end_date';
		$args['meta_date_after'] = date('Y-m-d', strtotime(get_query_var('quand')));
		$args['meta_date_before_key'] = 'start_date';
		$args['meta_date_before'] = date('Y-m-t', strtotime(get_query_var('quand')));
	else:
		$args['meta_date_after_key'] = 'end_date';
		$args['meta_date_after'] = date('Y-m-d', strtotime(get_query_var('quand').'-01-01'));
		$args['meta_date_before_key'] = 'start_date';
		$args['meta_date_before'] = date('Y-m-d', strtotime(get_query_var('quand').'-12-31'));
	endif;

	$args['quand'] = get_query_var('quand');
endif;


if ( ! isset($args['meta_date_after_key']) ):
	$args['meta_date_after_key'] = 'end_date';
	$args['meta_date_after'] = date('Y-m-d');
endif;

global $current_festival;
if ( $current_festival ):
	$args['tax_query'][] = array(
			'taxonomy'	=>	'festival',
			'field'		=>	'slug',
			'terms'		=>	$current_festival
		);
	unset($args['meta_date_after']);
	unset($args['meta_date_after_key']);
	unset($args['meta_date_before']);
	unset($args['meta_date_before_key']);
endif;

if ( isset($args['tax_query']) && count($args['tax_query']) > 1 )
	$args['tax_query']['relation'] = 'AND';

// $args['debug'] = 'xmpr';

if ( ! defined('IS_AJAX') ):

	get_header();
	?>
		<div class="main clearfix hentry" itemscope itemtype="http://schema.org/Article" id="main">
			<h1 class="entry-title clearfix" itemprop="name">
				La programmation
			</h1>
			<aside class="sidebar">
				<?php get_sidebar('programmation') ?>
			</aside>
			<div class="content">
				<div id="grid" class="grid-program clearfix">
					<?php
					query_posts($args);
					get_template_part( 'loop', 'programmation' );
					wp_reset_query();
					?>
				</div><!-- #grid -->
			</div><!-- .content -->
		</div><!-- .main -->
	<?php
	get_footer();

else:

		query_posts($args);
		get_template_part( 'loop', 'programmation' );
		wp_reset_query();
		exit();
endif;


