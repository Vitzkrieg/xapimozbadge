<?php
/**
 * General functions file for the plugin.
 *
 * @package xAPI_Mozilla_Badges
 * @subpackage Functions
 */

//require_once ('../../../../../wp-load.php');


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

    //$file = locate_template( array( '/xapimozbadge_template/' . $template, XAPIMOZBADGE_TEMPLATES . $template ));

    if (!$file){
        return '';
    }

    return apply_filters( 'xapimozbadge_repl_template_' . $template, $file );
}

/*
|--------------------------------------------------------------------------
| FILTERS
|--------------------------------------------------------------------------
*/

if (function_exists('add_filter')){
    add_filter( 'template_include', 'xapimozbadge_template_chooser');
}

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

    $post_type = get_post_type( $post_id );

    // For all other CPT
    if ( $post_type == 'xapimozbadge' ) {

        $mb_template = '';

        // Else use custom template
        if ( is_single() ) {
           $mb_template = xapimozbadge_template_hierarchy( 'post-' . $post_type );
        } else {
           $mb_template = xapimozbadge_template_hierarchy( 'archive-' . $post_type );
        }

    }

    if ( is_tax('mozbadge') ) {

        $mb_template = xapimozbadge_template_hierarchy( 'taxonomy-mozbadge' );

    }

    return ($mb_template != '') ? $mb_template : $template;

}

/*
|--------------------------------------------------------------------------
| USER HTML VALIDATION
|--------------------------------------------------------------------------
*/

function validate_user_html( $html ) {
    return true;

    //return tidy_is_xhtml($html);

    //$html = "<html><head><title></title></head><body><p>hello</p></body></html>";

    $html = preg_replace('/\s+/', '', $html);

    try{
        //$dom = new MyDOMDocument(new DOMDocument());
        $dom = new DOMDocument();
        $dom->LoadHTML($html);
        if ( $dom->validate() ) {
            return true;
        } else {
            return !$myDoc->hasErrors;
        }
    }catch (Exception $ex) {
        return false;
    }
    /*
    if ($dom->validate()) {
        echo "This document is valid!\n";
    }
    */
}

class MyDOMDocument {
    private $_delegate;
    private $_validationErrors;

    public function __construct (DOMDocument $pDocument) {
        $this->_delegate = $pDocument;
        $this->_validationErrors = array();
    }

    public function __call ($pMethodName, $pArgs) {
        if ($pMethodName == "validate") {
            $eh = set_error_handler(array($this, "onValidateError"));
            $rv = $this->_delegate->validate();
            if ($eh) {
                set_error_handler($eh);
            }
            return $rv;
        }
        else {
            return call_user_func_array(array($this->_delegate, $pMethodName), $pArgs);
        }
    }
    public function __get ($pMemberName) {
        if ($pMemberName == "errors") {
            return $this->_validationErrors;
        }
        elseif ($pMemberName == "hasErrors") {
            return count($this->_validationErrors) > 0;
        }
        else {
            return $this->_delegate->$pMemberName;
        }
    }
    public function __set ($pMemberName, $pValue) {
        $this->_delegate->$pMemberName = $pValue;
    }
    public function onValidateError ($pNo, $pString, $pFile = null, $pLine = null, $pContext = null) {
        $this->_validationErrors[] = preg_replace("/^.+: */", "", $pString);
    }
}

?>