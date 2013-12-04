<?php

/**
 * Set the custom taxonomies for.
 */


// hook into the init action and call create_taxonomies when it fires
add_action( 'init', 'create_taxonomies', 0 );


function create_taxonomies() {

	/**
	 * Add FILTRES categories (hierarchical)
	 */

	$labels = array(
		'name'              => _x( 'Filtres', 'taxonomy general name' ),
		'singular_name'     => _x( 'filtre', 'taxonomy singular name' ),
		'search_items'      => __( 'Rechercher un filtre' ),
		'all_items'         => __( 'Tous les filtres' ),
		'parent_item'       => __( 'Nom du filtre' ),
		'parent_item_colon' => __( '' ),
		'edit_item'         => __( 'Editer le filtre' ),
		'update_item'       => __( 'Mettre à jour le filtre' ),
		'add_new_item'      => __( 'Ajouter un filtre' ),
		'new_item_name'     => __( 'Nom du nouveau filtre' ),
		'menu_name'         => __( 'Filtres' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'filtre' ),
	);

	register_taxonomy( 'filtre', array( 'event' ), $args );


	/**
	 * Add ARBORESENCE categories (hierarchical)
	 */
	$labels = array(
		'name'              => _x( 'Arborescence', 'taxonomy general name' ),
		'singular_name'     => _x( 'Arborescence', 'taxonomy singular name' ),
		'search_items'      => __( 'Rechercher un terme' ),
		'all_items'         => __( 'Tous les termes' ),
		'parent_item'       => __( 'Nom du terme' ),
		'parent_item_colon' => __( '' ),
		'edit_item'         => __( 'Editer le terme' ),
		'update_item'       => __( 'Mettre à jour le terme' ),
		'add_new_item'      => __( 'Ajouter un terme' ),
		'new_item_name'     => __( 'Nom du nouveau terme' ),
		'menu_name'         => __( 'Arborescence' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'arborescence' ),
	);

	register_taxonomy( 'arborescence', array( 'event', 'page', 'post' ), $args );


	/**
	 * Add TAGS RELATIONNELS (not hierarchical)
	 */	
	$labels = array(
		'name'                       => _x( 'Tags relationnels', 'taxonomy general name' ),
		'singular_name'              => _x( 'tag relationnel', 'taxonomy singular name' ),
		'search_items'               => __( 'Rechercher un tag' ),
		'popular_items'              => __( 'Tags les plus utilisés' ),
		'all_items'                  => __( 'Tous les tags' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Editer le tag' ),
		'update_item'                => __( 'Mettre à jour le tag' ),
		'add_new_item'               => __( 'Ajouter un nouveau tag' ),
		'new_item_name'              => __( 'Nouveau nom du tag' ),
		'separate_items_with_commas' => __( 'Séparer les tags avec une virgule' ),
		'add_or_remove_items'        => __( 'Ajouter ou retirer des tags' ),
		'choose_from_most_used'      => __( 'Choisir parmis les tags les plus utilisés' ),
		'not_found'                  => __( 'Aucun tag trouvé.' ),
		'menu_name'                  => __( 'Tags relationnels' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'tag' ),
	);

	register_taxonomy( 'tag', array( 'event', 'post' ), $args );
}
?>