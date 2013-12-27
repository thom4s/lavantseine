<?php
/**
 * lavantseine functions and definitions
 *
 * @package lavantseine
 */


error_reporting(0);

define('FB_URL','https://www.facebook.com/lAvantSeine');
define('TWITTER_URL','https://twitter.com/AvantSeine');
define('INSTAGRAM_URL','http://instagram.com/avantseine');
define('GOOGLEPLUS_URL','https://plus.google.com/u/0/b/100144920076066761502/100144920076066761502');
define('VIDEOCHANNEL_URL','https://www.youtube.com/channel/UCtUb1swrX34VbClR53YcagA');

setlocale(LC_TIME, "fr_FR");


if ( ! function_exists( 'lavantseine_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lavantseine_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on lavantseine, use a find and replace
	 * to change 'lavantseine' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'lavantseine', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' ); 

	add_image_size( 'box-thumbnail', 168, 9999 );
	add_image_size( 'featured-post-thumbnail', 578, 9999 );
	add_image_size( 'top-thumbnail', 779, 9999 );
	add_image_size( '2col-thumbnail', 369, 9999 );


	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in 3 possible locations : primary, secondary (top) and footer.
	register_nav_menus( array(
		'primary' => __( 'Menu principal', 'lavantseine' ),
		'secondary' => __( 'Accès directs', 'lavantseine' ),
		'footer' => __( 'Footer', 'lavantseine' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'lavantseine_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // lavantseine_setup
add_action( 'after_setup_theme', 'lavantseine_setup' );


/**
 * Register widgetized area and update sidebar with default widgets.
 * 1 emplacement pour la Sidebar principal ('sidebar')
 * 1 emplacement pour les blocs du footer ('footer-widgets')
 */
function lavantseine_widgets_init() {
	
	register_sidebar( array(
		'name'          => __( 'Sidebar principale', 'lavantseine' ),
		'id'            => 'sidebar',
		'before_widget' => '<aside id="%1$s" class="box-sidebar widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Emplacements Footer ', 'lavantseine' ),
		'id'            => 'footer-widgets',
		'before_widget' => '<aside id="%1$s" class="box-footer widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="box-footer-title">',
		'after_title'   => '</h5>',
	) );


	register_sidebar( array(
		'name'          => __( 'Emplacement Template Contact ', 'lavantseine' ),
		'id'            => 'contact-widgets',
		'before_widget' => '<div id="%1$s" class="box-footer widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="box-footer-title">',
		'after_title'   => '</h5>',
	) );


}
add_action( 'widgets_init', 'lavantseine_widgets_init' );


/**
 * Enqueue scripts and styles for front.
 */
function lavantseine_scripts() {
	// wp_enqueue_style( 'lavantseine-style', get_stylesheet_uri() );
	wp_enqueue_style( 'lavantseine-style', get_template_directory_uri() . '/styles/style.css' );
	wp_enqueue_style( 'lavantseine-custom', get_template_directory_uri() . '/styles/custom.css' );

	wp_enqueue_script( 'lavantseine-scripts', get_template_directory_uri() . '/js/scripts.js', array(), false, true );

	wp_enqueue_script( 'salvatorre', get_template_directory_uri() . '/js/salvatorre.js', array(), false, true );
	wp_enqueue_script( 'bxslider', get_template_directory_uri() . '/js/bxslider.js', array(), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'lavantseine_scripts' );


/**
 * Enqueue scripts and styles for admin.
 */ 
function lavantseine_admin_scripts() {
	wp_enqueue_script('jquery-ui-datepicker');  
	
	wp_enqueue_script( 'lavantseine-admin-scripts', get_template_directory_uri() . '/js/admin-scripts.js', array(), '20120206', true );

	wp_enqueue_style('jquery-ui-custom', get_template_directory_uri().'/styles/jquery-ui-custom.css');

}
add_action( 'admin_enqueue_scripts', 'lavantseine_admin_scripts' );


function lavantseine_customize_css()
{
    ?>
         <style type="text/css">
         	<?php $saisonColor = get_theme_mod('saison_color'); ?>
            .saisoned-on-color { color: <?php echo $saisonColor; ?> !important; }
            .saisoned-on-bg { background-color:<?php echo $saisonColor; ?> !important; }
            h3, h4 { color:<?php echo $saisonColor; ?> !important; }
            .box-month h2 { color:<?php echo $saisonColor; ?> !important; border-color: <?php echo $saisonColor; ?> !important}
            .main-nav .current_page_item > a, .current-menu-ancestor > a, .main-nav .current-menu-item > a { color:<?php echo $saisonColor; ?> !important; }
            a.button, input[type=submit], input[type=button] { background-color:<?php echo $saisonColor; ?> !important; }
         </style>
    <?php
}
add_action( 'wp_head', 'lavantseine_customize_css');




/**
 * Load events custom post type.
 */
require get_template_directory() . '/inc/events-post-type.php';

/**
 * Load custom taxonomies.
 */
require get_template_directory() . '/inc/custom-taxonomies.php';

/**
 * Load custom metas.
 */
require get_template_directory() . '/inc/event-metas.php';
require get_template_directory() . '/inc/post-metas.php';
require get_template_directory() . '/inc/page-metas.php';
require get_template_directory() . '/inc/attachment-metas.php';

/**
 * Load Options Panel.
 */
require get_template_directory() . '/inc/options-panel.php';

/**
 * Load Custom Widgets & replace text widget.
 */
require get_template_directory() . '/inc/custom-widgets.php';
add_action( "widgets_init", "load_custom_widgets" );

function load_custom_widgets() {
	unregister_widget( "WP_Widget_Text" );
	register_widget( "WP_Widget_Text_Custom" );
}



/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



/*
 * Define bloc "la cuisine de l'Avant Seine" 
 */

function get_before_sidebar( ) {

}
add_action( 'before_sidebar', 'get_before_sidebar', 10, 2 );


/*
 * Social Buttons Sharing
 */
function lavantseine_display_share_buttons() {
	echo '<div class="one-button fb-share-button" data-type="button_count"></div>';
	echo '<a href="https://twitter.com/share" class="one-button twitter-share-button" data-lang="fr">Tweeter</a>';
	echo '<div class="one-button g-plusone"></div>';
}



/*
 * Custom Walker Menu
 */
class lavantseine_Walker_Main_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class=\"sub-nav-shadow\"><ul class=\"sub-menu saisoned-on-bg\">\n";
    }
    function end_lvl( &$output, $depth) {
        $output .= '</ul></div>';
    }
}





/*
 * Filter hook for programmation
 */
add_filter('ajax_wpqsf_reoutput', 'customize_output', '', 4);
function customize_output( $results, $args, $id, $getdata ){
	
	// The Query
	$query = new WP_Query( $args );
	ob_start(); $results ='';

	$progFilterID = get_option('progFilterID', '143');
	$magFilterID = get_option('magFilterID', '146');
	
	// The Loop
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();


			if ( $id == $progFilterID ) {
				get_template_part( 'boxes' );
			} elseif ( $id == $magFilterID ) {
				get_template_part( 'boxes' );
			} else {
				echo 'nothing';
			}

		}
	}

	// Restore original Post Data
	wp_reset_postdata();

	// End function and send $results
	$results = ob_get_clean();
	return $results;
}



add_action('init','random_add_rewrite');
function random_add_rewrite() {
       global $wp;
       $wp->add_query_var('random');
       add_rewrite_rule('random/?$', 'index.php?random=1', 'top');
}

add_action('template_redirect','random_template');
function random_template() {
        if (get_query_var('random') == 1) {
       		$args= array(
				'post_type' => 'event',
				'orderby'	=> 'rand',
				'numberposts'=> '1',
				'meta_query' => array(
			       	array(
			           'key' => 'eventDetail_first_date',
			           'value' => $today,
			           'compare' => '>=',
			        )
			   	)
       		);
            $posts = get_posts($args);
            foreach($posts as $post) {
                $link = get_permalink($post);
            }
            wp_redirect($link,307);
            exit;
        }
}


/*
 * Display the category menu on magazine template.
 * method : get all top level terms and loop its children
 */
function display_mag_filter_menu() {
	echo "<div class='filter-column'>";
	echo "<h1>au <b>Sommaire</b></h1>";

	$taxonomy = 'category'; 
	$terms = get_terms( $taxonomy ); 

	// get all terms
	foreach ($terms as $term) {
		$parent = $term->parent;

		// foreach top level term
		if ( $parent=='0' ) {
			echo '<ul>'; 
	
		    $term_id = $term->term_id; 
		    $term_link = get_term_link( $term, $taxonomy );
		    $term_name = $term->name;
		    $term_desc = $term->description;

		    $children = get_terms('category', array( 'parent' => $term_id ) );
		    foreach ($children as $child) {
		     	$child_id = $child->term_id; 
		    	$child_link = get_term_link( $child, $taxonomy );
		    	$child_name = $child->name;
		    	$child_desc = $child->description;
				
				echo '<li><a class="ccats" href="' . $child_link . '"><span class="label">' . $child_name . '</span></a></li>';
		    } // end children foreach

		    echo '<li>> <a class="ccats" href="' . $term_link . '"><span class="label">' . $term_desc . '</span></a></li>';
		}
		echo '</ul>';
	} // end main foreach

	echo "</div>"; // end column

} // end function display_mag_filter_menu()


function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
