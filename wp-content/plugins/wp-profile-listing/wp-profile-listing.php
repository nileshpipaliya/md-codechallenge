<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/nileshpipaliya
 * @since             1.0.0
 * @package           Wp_Profile_Listing
 *
 * @wordpress-plugin
 * Plugin Name:       WP Profile Listing
 * Plugin URI:        https://github.com/nileshpipaliya
 * Description:       This plugin for multidots assignment. a plugin that gives a page with a list of profiles the ability to search and sort.
 * Version:           1.0.0
 * Author:            Nilesh Pipaliya
 * Author URI:        https://github.com/nileshpipaliya/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-profile-listing
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Plugin version.
define( 'WP_PROFILE_LISTING_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-profile-listing-activator.php
 */
function activate_wp_profile_listing() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-profile-listing-activator.php';
	Wp_Profile_Listing_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-profile-listing-deactivator.php
 */
function deactivate_wp_profile_listing() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-profile-listing-deactivator.php';
	Wp_Profile_Listing_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_profile_listing' );
register_deactivation_hook( __FILE__, 'deactivate_wp_profile_listing' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-profile-listing.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_profile_listing() {

	$plugin = new Wp_Profile_Listing();
	$plugin->run();
}
run_wp_profile_listing();
