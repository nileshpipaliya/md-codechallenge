<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/nileshpipaliya
 * @since      1.0.0
 *
 * @package    Wp_Profile_Listing
 * @subpackage Wp_Profile_Listing/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wp_Profile_Listing
 * @subpackage Wp_Profile_Listing/includes
 * @author     Nilesh Pipaliya <pipaliyanilesh04@gmail.com>
 */
class Wp_Profile_Listing {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wp_Profile_Listing_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'WP_PROFILE_LISTING_VERSION' ) ) {
			$this->version = WP_PROFILE_LISTING_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'wp-profile-listing';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Wp_Profile_Listing_Loader. Orchestrates the hooks of the plugin.
	 * - Wp_Profile_Listing_I18n. Defines internationalization functionality.
	 * - Wp_Profile_Listing_Admin. Defines all hooks for the admin area.
	 * - Wp_Profile_Listing_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'includes/class-wp-profile-listing-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'includes/class-wp-profile-listing-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'admin/class-wp-profile-listing-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'public/class-wp-profile-listing-public.php';

		$this->loader = new Wp_Profile_Listing_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wp_Profile_Listing_I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Wp_Profile_Listing_I18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Wp_Profile_Listing_Admin( $this->get_plugin_name(), $this->get_version() );

		// Enqueue styles for the admin area.
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );

		// Modify plugin row meta data.
		$this->loader->add_filter( 'plugin_row_meta', $plugin_admin, 'profile_plugin_row_meta', 10, 2 );

		// Initialize custom post type for profiles.
		$this->loader->add_action( 'init', $plugin_admin, 'codex_profile_post_type_init' );

		// Initialize custom taxonomies for profiles.
		$this->loader->add_action( 'init', $plugin_admin, 'codex_profile_taxonomies', 0 );

		// Add meta boxes to profile edit screen.
		$this->loader->add_action( 'add_meta_boxes_profile', $plugin_admin, 'adding_profile_meta_boxes' );

		// Save profile meta box data.
		$this->loader->add_action( 'save_post', $plugin_admin, 'save_profile_meta_boxes' );

		// Update profile content when displayed.
		$this->loader->add_action( 'the_content', $plugin_admin, 'codex_update_profile_content' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Wp_Profile_Listing_Public( $this->get_plugin_name(), $this->get_version() );

		// Enqueue styles for the front-end.
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );

		// Enqueue scripts for the front-end.
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		// Initialize custom shortcodes.
		$this->loader->add_action( 'init', $plugin_public, 'codex_profile_shortcodes' );

		// Handle AJAX requests for profile data (for logged-in users).
		$this->loader->add_action( 'wp_ajax_get_profile_data', $plugin_public, 'get_profile_data_callback' );

		// Handle AJAX requests for profile data (for non-logged-in users).
		$this->loader->add_action( 'wp_ajax_nopriv_get_profile_data', $plugin_public, 'get_profile_data_callback' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Wp_Profile_Listing_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}
