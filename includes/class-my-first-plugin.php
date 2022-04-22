<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://fictional-university/
 * @since      1.0.0
 *
 * @package    My_First_Plugin
 * @subpackage My_First_Plugin/includes
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
 * @package    My_First_Plugin
 * @subpackage My_First_Plugin/includes
 * @author     Tanzeel <tanzeel@gmail.com>
 */
class My_First_Plugin {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      My_First_Plugin_Loader    $loader    Maintains and registers all hooks for the plugin.
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
		if ( defined( 'MY_FIRST_PLUGIN_VERSION' ) ) {
			$this->version = MY_FIRST_PLUGIN_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'my-first-plugin';

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
	 * - My_First_Plugin_Loader. Orchestrates the hooks of the plugin.
	 * - My_First_Plugin_i18n. Defines internationalization functionality.
	 * - My_First_Plugin_Admin. Defines all hooks for the admin area.
	 * - My_First_Plugin_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-my-first-plugin-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-my-first-plugin-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-my-first-plugin-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-my-first-plugin-public.php';

		$this->loader = new My_First_Plugin_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the My_First_Plugin_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new My_First_Plugin_i18n();

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

		$plugin_admin = new My_First_Plugin_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		
		$this->loader->add_action( 'init', $plugin_admin, 'job_post_types');
		$this->loader->add_action( 'init', $plugin_admin, 'application_post_types');

		// Taxonomy hooks
		$this->loader->add_action( 'init', $plugin_admin, 'job_taxonomy');
		$this->loader->add_action( 'init', $plugin_admin, 'application_taxonomy');
		
		// Application column hooks
		$this->loader->add_filter( 'manage_edit-applications_columns', $plugin_admin, 'application_columns');
		$this->loader->add_action( 'manage_applications_posts_custom_column', $plugin_admin, 'manage_application_columns', 10, 2);

		$this->loader->add_filter( 'wp_insert_post_data', $plugin_admin, 'change_application_status', 10, 3);
		
		// Meta Boxes Hooks
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'job_details_box');
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'application_details_box');
		$this->loader->add_action( 'save_post', $plugin_admin,'job_box_save' );

		//job application hook 
		$this->loader->add_action( 'save_post', $plugin_admin,'job_application_box_save' );

		// Hook for Ajax Application Form
		$this->loader->add_action( 'wp_ajax_application_form', $plugin_admin,'ajax_application_form' );
		$this->loader->add_action( 'wp_ajax_nopriv_application_form', $plugin_admin,'ajax_application_form' );
		
		// Export Application settings Hook
		$this->loader->add_action( 'admin_menu', $plugin_admin,'export_application_page' );
		$this->loader->add_action( 'wp_ajax_export_all_posts', $plugin_admin,'export_all_posts' );
		// hook for jobs board plugin settings page
		$this->loader->add_action( 'admin_menu', $plugin_admin,'jobs_board_plugin_settings_page' );
		$this->loader->add_action( 'admin_init', $plugin_admin,'my_settings_init' );
		// ajax action hook for import jobs
		$this->loader->add_action( 'wp_ajax_import_jobs', $plugin_admin,'import_jobs' );
	}
	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() { 

		$plugin_public = new My_First_Plugin_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		// add shortcode
		$this->loader->add_shortcode( 'wp10shortcode1', $plugin_public, 'public_jobs_board' ); //grid 

		/*This is Template Hook and Filter the single_template with our custom function*/
		$this->loader->add_filter('single_template', $plugin_public, 'my_custom_template');
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
	 * @return    My_First_Plugin_Loader    Orchestrates the hooks of the plugin.
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
