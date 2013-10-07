<?php
/**
 * Plugin Name: xAPI Mozilla Badges
 * Plugin URI: http://.../xapimozbadge
 * Description: This plugin was developed as an <acronym title="Advanced Distributed Learning">ADL</acronym> design team project for the Experience <acronym title="Application Programming Interface">API</acronym>
 * Version: 0.0.1
 * Author: Dustin Vietzke
 * Author URI: http://vitzkrieg.net
 *
 * === RELEASE NOTES ===
 * 2013-09-18 - v1.0 - first version
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 * Online: http://www.gnu.org/licenses/gpl.txt
 *
 * @package xAPI_Mozilla_Badges
 * @version 0.0.1
 * @author Dustin Vietzke <dustin@vitzkrieg.net>
 * @copyright Copyright (c) 2013, Dustin Vietzke
 * @link http://.../xapimozbadge
 * @license http://www.gnu.org/licenses/gpl.txt
 */

/*
*/

/**
 * @since 0.2.0
 */
class xAPI_Mozilla_Badges_Load {

	/**
	 * PHP4 constructor method.  This will be removed once the plugin only supports WordPress 3.2,
	 * which is the version that drops PHP4 support.
	 *
	 * @since 0.0.1
	 */
	function xAPI_Mozilla_Badges_Load() {
		$this->__construct();
	}

	/**
	 * PHP5 constructor method.
	 *
	 * @since 0.0.1
	 */
	function __construct() {
		global $xapimozbadge;

		/* Set up an empty class for the global $xapimozbadge object.
		$xapimozbadge = new stdClass;*/

		/* Set the constants needed by the plugin. */
		add_action( 'plugins_loaded', array( &$this, 'constants' ), 1 );

		/* Internationalize the text strings used.*/
		add_action( 'plugins_loaded', array( &$this, 'i18n' ), 2 );

		/* Load the functions files. */
		add_action( 'plugins_loaded', array( &$this, 'includes' ), 3 );

		// if both logged in and not logged in users can send this AJAX request,
		// add both of these actions, otherwise add only the appropriate one
		add_action( 'wp_ajax_nopriv_myajax-submit', array( &$this, 'myajax_submit' ), 4 );
		add_action( 'wp_ajax_myajax-submit', array( &$this, 'myajax_submit' ), 4 );
		add_action( 'wp_ajax_nopriv_myajax-button', array( &$this, 'myajax_button' ), 4 );
		add_action( 'wp_ajax_myajax-button', array( &$this, 'myajax_button' ), 4 );

		/* Load the necessary JavaScript files */
		add_action("init", array( &$this, 'xapimozbadge_scripts' ), 10 );

		/* Load the admin files.
		add_action( 'plugins_loaded', array( &$this, 'admin' ), 4 );*/

		/* Register activation hook. */
		register_activation_hook( __FILE__, array( &$this, 'activation' ) );
	}

	/**
	 * Defines constants used by the plugin.
	 *
	 * @since 0.0.1
	 */
	function constants() {

		/*
		 * Used on back end
		 */

		/* Set the version number of the plugin. */
		define( 'XAPIMOZBADGE_VERSION', '0.0.1' );

		/* Set constant path to the xapimozbadge plugin directory. */
		define( 'XAPIMOZBADGE_BASE_FILE', __FILE__ );

		/* Set constant path to the xapimozbadge plugin directory. */
		define( 'XAPIMOZBADGE_DIR', trailingslashit( plugin_dir_path( XAPIMOZBADGE_BASE_FILE ) ) );

		/* Set constant path to the xapimozbadge plugin URL. */
		define( 'XAPIMOZBADGE_URI', trailingslashit( plugin_dir_url( XAPIMOZBADGE_BASE_FILE ) ) );

		/* Set the constant path to the xapimozbadge includes directory. */
		define( 'XAPIMOZBADGE_INCLUDES', XAPIMOZBADGE_DIR . trailingslashit( 'includes' ) );

		/* Set the constant path to the xapimozbadge admin directory.
		define( 'XAPIMOZBADGE_ADMIN', XAPIMOZBADGE_DIR . trailingslashit( 'admin' ) );*/

		/* Set the constant path to the xapimozbadge templates directory. */
		define( 'XAPIMOZBADGE_TEMPLATES', XAPIMOZBADGE_DIR . trailingslashit( 'templates' ) );

		/*
		 * Used on front end
		 */

		/* Set the constant path to the xapimozbadge js directory. */
		define( 'XAPIMOZBADGE_JS', XAPIMOZBADGE_URI . trailingslashit( 'js' ) );

		/* Set the constant path to the xapimozbadge ajax directory. */
		define( 'XAPIMOZBADGE_AJAX', XAPIMOZBADGE_URI . trailingslashit( 'ajax' ) );
	}


	/**
	 * Loads the initial files needed by the plugin.
	 *
	 * @since 0.0.1
	 */
	function includes() {

		/* Load the plugin custom post type file. */
		require_once( XAPIMOZBADGE_INCLUDES . 'xapimozbadge_post_type.php' );

		/* Load the plugin functions file. */
		require_once( XAPIMOZBADGE_INCLUDES . 'functions.php' );

		/* Load the update functionality.
		require_once( XAPIMOZBADGE_INCLUDES . 'update.php' );*/

		/* Load the admin bar functions.
		require_once( XAPIMOZBADGE_INCLUDES . 'admin-bar.php' );*/

		/* Load the functions related to capabilities.
		require_once( XAPIMOZBADGE_INCLUDES . 'capabilities.php' );*/

		/* Load the content permissions functions.
		require_once( XAPIMOZBADGE_INCLUDES . 'content-permissions.php' );*/

		/* Load the private site functions.
		require_once( XAPIMOZBADGE_INCLUDES . 'private-site.php' );*/

		/* Load the shortcodes functions file.
		require_once( XAPIMOZBADGE_INCLUDES . 'shortcodes.php' );*/

		/* Load the template functions.
		require_once( XAPIMOZBADGE_INCLUDES . 'template.php' );*/

		/* Load the widgets functions file.
		require_once( XAPIMOZBADGE_INCLUDES . 'widgets.php' );*/// embed the javascript file that makes the AJAX request
	}

	/**
	 * Loads the translation files.
	 *
	 * @since 0.0.1
	 */
	function i18n() {

		/* Load the translation of the plugin. */
		load_plugin_textdomain( 'xapimozbadge', false, 'xapimozbadge/languages' );
	}

	/**
	 * Loads the admin functions and files.
	 *
	 * @since 0.0.1
	 */
	function admin() {

		/* Only load files if in the WordPress admin. */
		if ( is_admin() ) {

			/* Load the main admin file. */
			require_once( XAPIMOZBADGE_ADMIN . 'admin.php' );

			/* Load the plugin settings. */
			require_once( XAPIMOZBADGE_ADMIN . 'settings.php' );
		}
	}

	/**
	 * Method that runs only when the plugin is activated.
	 *
	 * @since 0.0.1
	 */
	function activation() {

		/* Get the administrator role. */
		$role =& get_role( 'administrator' );

		/* If the administrator role exists, add required capabilities for the plugin. */
		if ( !empty( $role ) ) {

			/* xAPI MozBadge management capabilities. */
			$role->add_cap( 'edit_xapimozbadge' );
			$role->add_cap( 'read_xapimozbadge' );
			$role->add_cap( 'delete_xapimozbadge' );
			$role->add_cap( 'edit_xapimozbadges' );
			$role->add_cap( 'edit_others_xapimozbadges' );
			$role->add_cap( 'publish_xapimozbadges' );
			$role->add_cap( 'read_private_xapimozbadges' );

			/* MozBadge Taxonomy permissions capabilities. */
			$role->add_cap( 'manage_mozbadges' );
			$role->add_cap( 'edit_mozbadges' );
			$role->add_cap( 'delete_mozbadges' );
			$role->add_cap( 'assign_mozbadges' );
		}

	}

	function xapimozbadge_scripts(){

		wp_enqueue_script( 'google-jquery',
			'//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', array( 'jquery' ) ,
			'', false );

		wp_enqueue_script( 'ckeditor',
			get_bloginfo('url') .'/wp-content/plugins/ckeditor-for-wordpress/ckeditor/ckeditor.js',
			array( 'google-jquery' ),
			'', false );

		wp_enqueue_script( 'ckeditor-jquery',
			get_bloginfo('url') .'/wp-content/plugins/ckeditor-for-wordpress/ckeditor/adapters/jquery.js',
			array( 'ckeditor' ),
			'', false );

		wp_enqueue_script( 'adl-verbs',
			XAPIMOZBADGE_JS. 'verbs.js',
			array( 'ckeditor-jquery' ),
			'', false );

		wp_enqueue_script( 'xapimozbadge',
			XAPIMOZBADGE_JS. 'xapimozbadge.js',
			array( 'adl-verbs' ),
			'', false );

		global $post;
		global $wp_query;
		$postID = $post-ID;

		wp_localize_script( 'xapimozbadge', 'MyAjax', array(
			// URL to wp-admin/admin-ajax.php to process the request
			'ajaxurl'          => admin_url( 'admin-ajax.php' ),

			// generate a nonce with a unique ID "myajax-post-comment-nonce"
			// so that you can check it later when an AJAX request is sent
			'postCommentNonce' => wp_create_nonce( 'myajax-post-comment-nonce' ),
			'post' => $post,
			'postID' => $postID,
			'wp_query' => $wp_query,
			)
		);

	}

	function myajax_submit() {

	    $nonce = $_POST['postCommentNonce'];

	    // check to see if the submitted nonce matches with the
	    // generated nonce we created earlier
	    if ( ! wp_verify_nonce( $nonce, 'myajax-post-comment-nonce' ) ){
	        die ( 'Busted!');
	    }


	    $name = (isset($data["name"])) ? $data["name"] : "Unknown User";
	    $verb = (isset($data["verb"])) ? $data["verb"] : "answered";
	    $response = (isset($data["result"])) ? $data["result"]["response"] : NULL;

	    $statement = $name;

	    $statement .= " " . $verb;

	    $statement .= " with " . $object;

	    $is_valid = false;


	    if($response){
	        if ($errors = validate_user_html('' . $response)) {
	            $valid_str = " is valid.";
	            $is_valid = true;
	        } else {
	            $valid_str = " is not valid.";

	            foreach ($errors as $error) {
	                $valid_str .= PHP_EOL . $error;
	            }
	        }

	        $statement .= " and " . $valid_str . PHP_EOL . $response;
	    }

	    $result =  array(
						"success" => $is_valid
						);

		$postID = $_POST["postID"];

	    echo $this->grassblade_dynamic($postID, $verb, $object, $result);

	    // IMPORTANT: don't forget to "exit"
	    exit;
	}



	function myajax_button() {

		echo "myajax_button()";

	    $nonce = $_POST['postCommentNonce'];

	    // check to see if the submitted nonce matches with the
	    // generated nonce we created earlier
	    if ( ! wp_verify_nonce( $nonce, 'myajax-post-comment-nonce' ) ){
	        die ( 'Busted!');
	    }

	    $data = $_POST["data"];
	    $name = (isset($data["name"])) ? $data["name"] : "a button";
	    $verb = (isset($data["verb"])) ? $data["verb"] : "interacted";

		$postID = $_POST["postID"];

	    echo $this->grassblade_dynamic($postID, $verb, $name, null);

	    // IMPORTANT: don't forget to "exit"
	    exit;
	}

	/*
	@verb = supported xAPI verb
	@result = was the activity completed succesfully?
	@object = the WordPress page the activity was attempted on
	@context = the larger picture the activity is included in (Moz Badge)
	*/
	function grassblade_dynamic($postID, $verb, $object, $result){

		$return = 'grassblade_dynamic()' . '<br />';

		if ( !function_exists ( "grassblade_send_statements" ) ) {
		$return .= "grassblade_send_statements() does not exist." . '<br />';
			return $return;
		}

		if(!$uri = get_permalink( $postID )){
			$uri = "http://example.com";
		}

		$pTitle = "No title";

		$pDesc = "Post data unavailable";

		if ( $pObj = get_post( $postID ) ) {

			$pTitle = $pObj->post_title;
			$pDesc = $pObj->post_excerpt;

		}

		if($object){
			$uri .= "#" . $object;

			$pTitle = $object;
			$pDesc = "CKEditor button: " . $object;
		}

		if (is_string($verb)) {
			$verb =  grassblade_getverb($verb);
		}

		$statement = 	array(
								"actor" => grassblade_getactor($guest_tracking = true),
								"verb" => $verb,
								/*
								Make this be the page they are currently on
								*/
								//"object" => grassblade_getobject("http://domain.com/wordpress/quizzes/quiz-1/", "Walkthrough Link", "Test Desc", "http://adlnet.gov/expapi/activities/interaction"),
								//object" => $this->getxAPIPostObject($postID),
								"object" => grassblade_getobject($uri, $pTitle, $pDesc, "http://adlnet.gov/expapi/activities/assessment"),
								/*
								Need to customize this
								Probably have it realate to the Moz Badge(s)
								"context" => array(
												"contextActivities" => array(
													"parent" => grassblade_getobject("http://domain.com/wordpress/course/course-1/", "Test Parent", "Test Parent Desc", "http://adlnet.gov/expapi/activities/course"),
													"grouping" => grassblade_getobject("http://domain.com/wordpress/course/course-1/", "Test Parent", "Test Parent Desc", "http://adlnet.gov/expapi/activities/course"),
												)
											),
											*/
								"context" => $this->getxAPIPostContext($postID),
								);

		if($result){
			$statement[	"result" ] =  $result;
		}

		$statements = array($statement);

		//Uncomment to debug
		/*
		$return .= "<h3>Statement</h3>" . '<br />';
		$return .=  "<pre>" . '<br />';
		$return .= print_r($statements) . '<br />';
		$return .= "</pre>" . '<br />';
		$return .= "<h3>Return Value</h3>" . '<br />';
		$return .= "<pre>" . '<br />';
		$return .= print_r(grassblade_send_statements($statements)) . '<br />';
		$return .= "</pre>";

		return $return;
*/
		grassblade_send_statements($statements);
	}

	function getxAPIPostObject($id){

		if(!$uri = get_permalink( $id )){
			$uri = "http://example.com";
		}

		$pTitle = "No title";

		$pDesc = "Post data unavailable";

		if($pObj = get_post($id)){

			$pTitle = $pObj->post_title;
			$pDesc = $pObj->post_excerpt;

		}

		return grassblade_getobject($uri, $pTitle, $pDesc, "http://adlnet.gov/expapi/activities/assessment");
	}

	function getxAPIPostContext($id){

		$pObj = get_post($id);

		$contextParent = NULL;

		if($parent = $pObj->post_parent){
			$contextParent = $this->getxAPIPostObject( $pObj->post_parent );
		}

		$context = array (
				//"registration" => get_permalink( $id ),
				"contextActivities" => array(
											"parent" => $this->getxAPIPostObject( $pObj->post_parent )
										),
				);

		return $context;
	}
}

$xapimozbadge_load = new xAPI_Mozilla_Badges_Load();

?>