<?php
/**
 * Plugin Name: Jetpack Legacy Google Analytics
 * Plugin URI: https://github.com/Automattic/jetpack-legacy-google-analytics
 * Description: Jetpack's legacy Google Analytics feature.
 * Author: Automattic
 * Version: 1.0.0
 * Author URI: https://jetpack.com
 * License: GPL2+
 * Text Domain: jetpack-google-analytics
 * Domain Path: /languages/
 *
 * @package automattic/jetpack-google-analytics
 *
 * Credits
 * -------
 * This plugin is based off Jetpack's Google Analytics feature.
 * The feature will be removed from Jetpack in version 13.7.
 *
 * Released under the GPL license
 * https://www.opensource.org/licenses/gpl-license.php
 *
 * **********************************************************************
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * *****************************************************************
 */

namespace Jetpack_Legacy_Google_Analytics;

use Automattic\Jetpack\Redirect;

require_once plugin_dir_path( __FILE__ ) . '/vendor/autoload_packages.php';

/**
 * Load plugin files.
 *
 * We only want to load this plugin if:
 * 1. You use the Jetpack plugin.
 * 2. You do not already use Jetpack's Google Analytics feature.
 */
function load_plugin() {
	if (
		! class_exists( 'Jetpack' )
		|| \Jetpack::is_module_active( 'google-analytics' )
	) {
		return;
	}

	// Load plugin.
	require_once plugin_dir_path( __FILE__ ) . 'src/google-analytics.php';
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\load_plugin' );

/**
 * Add settings link.
 *
 * @param array $links the array of links.
 */
function add_settings_link( $links ) {
	$url = Redirect::get_url( 'calypso-marketing-traffic', array( 'anchor' => 'analytics' ) );
	$settings_link = '<a href="' . $url . '">' . esc_html__( 'Settings', 'jetpack' ) . '</a>';
	array_unshift( $links, $settings_link );

	return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), __NAMESPACE__ . '\add_settings_link' );
