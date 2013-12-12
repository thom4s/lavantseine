<?php

/**
 * Set the custom taxonomies for.
 */


// hook into the init action and call create_taxonomies when it fires
add_action( 'init', 'create_taxonomies', 0 );


function create_taxonomies() {

	/**
	 * Add DISCIPLINE categories (hierarchical)
	 */

	$labels = array(
		'name'              => _x( 'Disciplines', 'taxonomy general name' ),
		'singular_name'     => _x( 'Discipline', 'taxonomy singular name' ),
		'search_items'      => __( 'Rechercher une Discipline' ),
		'all_items'         => __( 'Toutes les Disciplines' ),
		'parent_item'       => __( 'Nom de la Discipline' ),
		'parent_item_colon' => __( '' ),
		'edit_item'         => __( 'Editer la Discipline' ),
		'update_item'       => __( 'Mettre à jour la Discipline' ),
		'add_new_item'      => __( 'Ajouter une Discipline' ),
		'new_item_name'     => __( 'Nom du nouveau Discipline' ),
		'menu_name'         => __( 'Disciplines' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'discipline' ),
	);

	register_taxonomy( 'discipline', array( 'event' ), $args );


	/**
	 * Add RENDEZ-VOUS categories (hierarchical)
	 */

	$labels = array(
		'name'              => _x( 'Rendez-vous', 'taxonomy general name' ),
		'singular_name'     => _x( 'Rendez-vous', 'taxonomy singular name' ),
		'search_items'      => __( 'Rechercher un Rendez-vous' ),
		'all_items'         => __( 'Tous les Rendez-vous' ),
		'parent_item'       => __( 'Nom du Rendez-vous' ),
		'parent_item_colon' => __( '' ),
		'edit_item'         => __( 'Editer le Rendez-vous' ),
		'update_item'       => __( 'Mettre à jour le Rendez-vous' ),
		'add_new_item'      => __( 'Ajouter un Rendez-vous' ),
		'new_item_name'     => __( 'Nom du nouveau Rendez-vous' ),
		'menu_name'         => __( 'Rendez-vous' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'rdv' ),
	);

	register_taxonomy( 'rdv', array( 'event' ), $args );


	/**
	 * Add PUBLIC categories (hierarchical)
	 */

	$labels = array(
		'name'              => _x( 'Publics', 'taxonomy general name' ),
		'singular_name'     => _x( 'Public', 'taxonomy singular name' ),
		'search_items'      => __( 'Rechercher un Public' ),
		'all_items'         => __( 'Tous les Public' ),
		'parent_item'       => __( 'Nom du Public' ),
		'parent_item_colon' => __( '' ),
		'edit_item'         => __( 'Editer le Public' ),
		'update_item'       => __( 'Mettre à jour le Public' ),
		'add_new_item'      => __( 'Ajouter un Public' ),
		'new_item_name'     => __( 'Nom du nouveau Public' ),
		'menu_name'         => __( 'Publics' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'public' ),
	);

	register_taxonomy( 'public', array( 'event' ), $args );


	/**
	 * Add SAISONS categories (hierarchical)
	 */

	$labels = array(
		'name'              => _x( 'Saisons', 'taxonomy general name' ),
		'singular_name'     => _x( 'Saison', 'taxonomy singular name' ),
		'search_items'      => __( 'Rechercher une Saison' ),
		'all_items'         => __( 'Toutes les Saison' ),
		'parent_item'       => __( 'Nom de la Saison' ),
		'parent_item_colon' => __( '' ),
		'edit_item'         => __( 'Editer la Saison' ),
		'update_item'       => __( 'Mettre à jour la Saison' ),
		'add_new_item'      => __( 'Ajouter une Saison' ),
		'new_item_name'     => __( 'Nom de la nouvelleu Saison' ),
		'menu_name'         => __( 'Saisons' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'saison' ),
	);

	register_taxonomy( 'saison', array( 'event' ), $args );


	/**
	 * Add TARIFS categories (hierarchical)
	 */

	$labels = array(
		'name'              => _x( 'Tarifs', 'taxonomy general name' ),
		'singular_name'     => _x( 'Tarif', 'taxonomy singular name' ),
		'search_items'      => __( 'Rechercher un Tarif' ),
		'all_items'         => __( 'Tous les Tarifs' ),
		'parent_item'       => __( 'Nom du Tarif' ),
		'parent_item_colon' => __( '' ),
		'edit_item'         => __( 'Editer le Tarif' ),
		'update_item'       => __( 'Mettre à jour le Tarif' ),
		'add_new_item'      => __( 'Ajouter un Tarif' ),
		'new_item_name'     => __( 'Nom du nouveau Tarif' ),
		'menu_name'         => __( 'Tarifs' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'tarif' ),
	);

	register_taxonomy( 'tarif', array( 'event' ), $args );



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

	register_taxonomy( 'relational_tag', array( 'event', 'post' ), $args );
}
?>