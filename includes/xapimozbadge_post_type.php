<?php



/*
|--------------------------------------------------------------------------
| CUSTOM POST TYPE FUNCTIONS
|--------------------------------------------------------------------------
*/


// Register Custom Post Type
function register_xapimozbadge_post_type() {

    $labels = array(
        'name'                => _x( 'xAPI MozBadges', 'Post Type General Name', 'xAPI MozBadge' ),
        'singular_name'       => _x( 'xAPI MozBadge', 'Post Type Singular Name', 'xAPI MozBadge' ),
        'menu_name'           => __( 'xAPI MozBadge', 'xAPI MozBadge' ),
        'parent_item_colon'   => __( 'Parent xAPI MozBadge', 'xAPI MozBadge' ),
        'all_items'           => __( 'All xAPI MozBadge', 'xAPI MozBadge' ),
        'view_item'           => __( 'View xAPI MozBadge', 'xAPI MozBadge' ),
        'add_new_item'        => __( 'Add New xAPI MozBadge', 'xAPI MozBadge' ),
        'add_new'             => __( 'New xAPI MozBadge', 'xAPI MozBadge' ),
        'edit_item'           => __( 'Edit xAPI MozBadge', 'xAPI MozBadge' ),
        'update_item'         => __( 'Update xAPI MozBadge', 'xAPI MozBadge' ),
        'search_items'        => __( 'Search xAPI MozBadges', 'xAPI MozBadge' ),
        'not_found'           => __( 'No xAPI MozBadges found', 'xAPI MozBadge' ),
        'not_found_in_trash'  => __( 'No xAPI MozBadges found in Trash', 'xAPI MozBadge' ),
    );
    $rewrite = array(
        'slug'                => 'xapimozbadge',
        'with_front'          => true,
        'pages'               => true,
        'feeds'               => true,
    );
    $capabilities = array(
        'edit_post'           => 'edit_xapimozbadge',
        'read_post'           => 'read_xapimozbadge',
        'delete_post'         => 'delete_xapimozbadge',
        'edit_posts'          => 'edit_xapimozbadges',
        'edit_others_posts'   => 'edit_others_xapimozbadges',
        'publish_posts'       => 'publish_xapimozbadges',
        'read_private_posts'  => 'read_private_xapimozbadges',
    );
    $args = array(
        'label'               => __( 'xapimozbadge', 'xapimozbadge' ),
        'description'         => __( 'xAPI MozBadge Posts', 'xAPI MozBadge' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
        'taxonomies'          => array( 'mozbadge' ),
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => '',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'query_var'           => 'xapimozbadge',
        'rewrite'             => $rewrite,
        'capabilities'        => $capabilities,
    );
    register_post_type( 'xapimozbadge', $args );

}

// Hook into the 'init' action
add_action( 'init', 'register_xapimozbadge_post_type', 0 );


/*
|--------------------------------------------------------------------------
| CUSTOM TAXONOMY FUNCTIONS
|--------------------------------------------------------------------------
*/


if ( ! function_exists('mozbadge_taxonomy') ) {

// Register Custom Taxonomy
function mozbadge_taxonomy()  {

    $labels = array(
        'name'                       => _x( 'MozBadges', 'Taxonomy General Name', 'xapimozbadge' ),
        'singular_name'              => _x( 'MozBadge', 'Taxonomy Singular Name', 'xapimozbadge' ),
        'menu_name'                  => __( 'MozBadge', 'xapimozbadge' ),
        'all_items'                  => __( 'All MozBadges', 'xapimozbadge' ),
        'parent_item'                => __( 'Parent MozBadge', 'xapimozbadge' ),
        'parent_item_colon'          => __( 'Parent MozBadge:', 'xapimozbadge' ),
        'new_item_name'              => __( 'New MozBadge Name', 'xapimozbadge' ),
        'add_new_item'               => __( 'Add New MozBadge', 'xapimozbadge' ),
        'edit_item'                  => __( 'Edit MozBadge', 'xapimozbadge' ),
        'update_item'                => __( 'Update MozBadge', 'xapimozbadge' ),
        'separate_items_with_commas' => __( 'Separate MozBadges with commas', 'xapimozbadge' ),
        'search_items'               => __( 'Search MozBadges', 'xapimozbadge' ),
        'add_or_remove_items'        => __( 'Add or remove MozBadges', 'xapimozbadge' ),
        'choose_from_most_used'      => __( 'Choose from the most used MozBadges', 'xapimozbadge' ),
    );
    $rewrite = array(
        'slug'                       => 'mozbadge',
        'with_front'                 => true,
        'hierarchical'               => true,
    );
    $capabilities = array(
        'manage_terms'               => 'manage_mozbadges',
        'edit_terms'                 => 'edit_mozbadges',
        'delete_terms'               => 'delete_mozbadges',
        'assign_terms'               => 'assign_mozbadges',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'query_var'                  => 'mozbadge',
        'rewrite'                    => $rewrite,
        'capabilities'               => $capabilities,
    );
    register_taxonomy( 'mozbadge', 'xapimozbadge', $args );

}

// Hook into the 'init' action
add_action( 'init', 'mozbadge_taxonomy', 0 );

}

?>