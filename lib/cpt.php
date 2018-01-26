<?php

/** Custom post type "Speakers (sprekers)" */

add_action( 'init', 'ncdt_create_speakers_post_type' );
function ncdt_create_speakers_post_type() {

	$labels = array(
        'name' => 'Sprekers',
        'singular_name' => 'Spreker',
        'add_new' => 'Voeg toe',
        'add_new_item' => 'Voeg nieuwe spreker toe',
        'edit_item' => 'Bewerk spreker',
        'new_item' => 'Nieuwe spreker',
        'view_item' => 'Bekijk spreker',
        'search_items' => 'Zoek spreker',
        'not_found' => 'Geen sprekers gevonden',
        'not_found_in_trash' => 'Geen sprekers in de prullenbak gevonden',
        'menu_name' => 'Sprekers',
    );

	    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Informatie over de Sprekers',
        'supports' => array( 'title', 'editor', 'excerpt', 'page-attributes', 'thumbnail', 'genesis-cpt-archives-settings' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 22,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'query_var' => true,
		'has_archive' => true,
        'can_export' => true,
        'rewrite' => array('slug' => 'sprekers'),
        'capability_type' => 'page'
    );


	register_post_type( 'ncdt_speakers', $args );
}


/** Custom post type "talks (praatje)" */

add_action( 'init', 'ncdt_create_talks_post_type' );
function ncdt_create_talks_post_type() {

	$labels = array(
        'name' => 'Presentaties',
        'singular_name' => 'Presentatie',
        'add_new' => 'Voeg toe',
        'add_new_item' => 'Voeg nieuwe presentatie toe',
        'edit_item' => 'Bewerk presentatie',
        'new_item' => 'Nieuwe presentatie',
        'view_item' => 'Bekijk presentatie',
        'search_items' => 'Zoek presentatie',
        'not_found' => 'Geen spresentaties gevonden',
        'not_found_in_trash' => 'Geen presentaties in de prullenbak gevonden',
        'menu_name' => 'Presentaties',
    );

	    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Informatie over de Presentaties',
        'supports' => array( 'title', 'editor', 'page-attributes', 'excerpt', 'thumbnail', 'genesis-cpt-archives-settings' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 21,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'query_var' => true,
		'has_archive' => true,
        'can_export' => true,
        'rewrite' => array('slug' => 'presentaties'),
        'capability_type' => 'page'
    );


	register_post_type( 'ncdt_talks', $args );
}

add_action( 'pre_get_posts', 'ncdt_add_custom_post_type' );
function ncdt_add_custom_post_type( $query ) {

	// get results from all post types
	if ( ( is_category() || is_tax() || is_tag() ) && empty( $query->query_vars['suppress_filters'] ) && !is_admin() && $query->is_main_query() ) {

		$post_types = get_post_types();

		if ( ! is_array( $post_types ) && ! empty( $post_types ) )  {
            $post_types = explode( ',', $post_types );
        }

        if ( empty( $post_types ) ) {
            $post_types[] = 'post';
        }

        $post_types[] = 'ncdt_speakers';
        $post_types[] = 'ncdt_talks';

        $post_types = array_map( 'trim', $post_types );
        $post_types = array_filter( $post_types );

		$query->set('post_type', $post_types);

    }

    $sort_cpt_by_order = array(
                        'ncdt_speakers',
                        'ncdt_talks' );

    if ( is_post_type_archive( $sort_cpt_by_title ) && !is_admin() && !is_search() && $query->is_main_query() ) {

        $query->set( 'orderby', 'menu_order title' );
        $query->set( 'order', 'ASC' );
        $query->set( 'posts_per_page', -1 );

    }


	return $query;
}

add_filter( 'nav_menu_css_class', 'rrwd_active_item_classes', 10, 2 );
function rrwd_active_item_classes( $classes = array(), $menu_item ) {

    if ( is_search() ) {
        return $classes;
    }

    if ( is_singular() ) {
        global $post;
        // echo $menu_item->url . ' - '  . get_post_type_archive_link( $post->post_type) . "<br>";
        if ( $menu_item->url == get_post_type_archive_link( $post->post_type ) ) {
            $classes[] = 'current-page-ancestor';
        }
    }

    if ( is_tax() ) {
            $currentTaxonomy = get_query_var('taxonomy');
            if ($currentTaxonomy) {
                $taxObject = get_taxonomy($currentTaxonomy);
                $postTypeArray = $taxObject->object_type;
            }
            if ( $menu_item->url == get_post_type_archive_link( $postTypeArray[0] ) ) {
                $classes[] = 'current-page-ancestor';
            }
    }

    return $classes;

}
