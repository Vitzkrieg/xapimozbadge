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
		require_once( XAPIMOZBADGE_INCLUDES . 'widgets.php' );*/
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
}

$xapimozbadge_load = new xAPI_Mozilla_Badges_Load();

?>