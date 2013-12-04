<?php

/**
 * Set the events custom post type.
 */


function codex_custom_init() {
  $labels = array(
    'name'               => 'Evénements',
    'singular_name'      => 'Evénement',
    'add_new'            => 'Ajouter',
    'add_new_item'       => 'Ajouter un événement',
    'edit_item'          => 'Editer un événément',
    'new_item'           => 'Nouvel événement',
    'all_items'          => 'Tous les événements',
    'view_item'          => 'Voir événement',
    'search_items'       => 'Rechercher un événement',
    'not_found'          => 'Aucun événement trouver',
    'not_found_in_trash' => 'Aucun événement dans la corbeille',
    'parent_item_colon'  => '',
    'menu_name'          => 'Evenements'
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'evenements' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => 5,
    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
  );

  register_post_type( 'event', $args );
}
add_action( 'init', 'codex_custom_init' );