<?php
/**
 * General functions file for the plugin.
 *
 * @package xAPI_Mozilla_Badges
 * @subpackage Functions
 */


/**
 * Get the custom template if is set
 *
 * @since 0.0.1
 */

function xapimozbadge_template_hierarchy( $template ) {

    // Get the template slug
    $template_slug = rtrim( $template, '.php' );
    $template = $template_slug . '.php';

    // Check if a custom template exists in the theme folder,
    // if not, load the plugin template file
    if ( $theme_file = locate_template( array( '/xapimozbadge_template/' . $template ) ) ) {
        $file = $theme_file;
    }
    else {
       $file = XAPIMOZBADGE_TEMPLATES . $template;
    }

    return apply_filters( 'xapimozbadge_repl_template_' . $template, $file );
}

/*
|--------------------------------------------------------------------------
| FILTERS
|--------------------------------------------------------------------------
*/

add_filter( 'template_include', 'xapimozbadge_template_chooser');

/*
|--------------------------------------------------------------------------
| PLUGIN FUNCTIONS
|--------------------------------------------------------------------------
*/

/**
 * Returns template file
 *
 * @since 0.0.1
 */

function xapimozbadge_template_chooser( $template ) {

	$post_slug = $post->post_name;

    // For all other CPT
    //if ( $post_slug != 'ckeditor-test-page' ) {
        //return $template;
    //}

	//return xapimozbadge_template_hierarchy( 'page-xapimozbadge' );

    // Post ID
    $post_id = get_the_ID();

    // For all other CPT
    if ( get_post_type( $post_id ) != 'xapimozbadge' ) {
        return $template;
    }

    // Else use custom template
    if ( is_single() ) {
       return xapimozbadge_template_hierarchy( 'page-xapimozbadge' );
    }

    return $template;

}

?>