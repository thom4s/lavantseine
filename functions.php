<?php
/**
 * lavantseine functions and definitions
 *
 * @package lavantseine
 */


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
		'before_widget' => '<aside id="%1$s" class="backgrounded-box box-sidebar widget %2$s">',
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

}
add_action( 'widgets_init', 'lavantseine_widgets_init' );


/**
 * Enqueue scripts and styles for front.
 */
function lavantseine_scripts() {
	// wp_enqueue_style( 'lavantseine-style', get_stylesheet_uri() );
	wp_enqueue_style( 'lavantseine-style', get_template_directory_uri() . '/styles/style.css' );
	wp_enqueue_style( 'lavantseine-custom', get_template_directory_uri() . '/styles/custom.css' );

	wp_enqueue_script( 'lavantseine-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '20120206', true );

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
            .saison-colored { color:<?php echo get_theme_mod('saison_color'); ?>; }
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
require get_template_directory() . '/inc/post-metas.php';
require get_template_directory() . '/inc/event-metas.php';




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

function get_before_sidebar( )
{
	echo 'cuisine bloc';
}

add_action( 'before_sidebar', 'get_before_sidebar', 10, 2 );



