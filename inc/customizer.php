<?php
/**
 * lavantseine Theme Customizer
 *
 * @package lavantseine
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 * Add custom color for .saison-color class
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function lavantseine_customize_register( $wp_customize ) {
	$wp_customize->add_setting( 'saison_color' , array(
	    'default'     => '#e00f77',
	    'transport'   => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'saison_color', array(
		'label'        => __( 'Couleur de saison', 'lavantseine' ),
		'section'    => 'colors',
		'settings'   => 'saison_color',
	) ) );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'lavantseine_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function lavantseine_customize_preview_js() {
	wp_enqueue_script( 'lavantseine_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'lavantseine_customize_preview_js' );
