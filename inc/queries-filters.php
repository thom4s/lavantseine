<?php 




function taxonomies_filter($query) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ( $query->is_tax('rdv')) {
      $query->set( '' );
    }
  }
}

add_action('pre_get_posts','taxonomies_filter');





function search_filter($query) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ($query->is_search) {
      $query->set('post_type', array( 'post', 'event', 'page' ) );
    }
  }
}

add_action('pre_get_posts','search_filter');