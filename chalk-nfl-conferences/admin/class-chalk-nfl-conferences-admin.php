<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://soo.casa
 * @since      1.0.0
 *
 * @package    Chalk_Nfl_Conferences
 * @subpackage Chalk_Nfl_Conferences/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Chalk_Nfl_Conferences
 * @subpackage Chalk_Nfl_Conferences/admin
 * @author     Josh Galloway <pascalli@gmail.com>
 */
class Chalk_Nfl_Conferences_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}
/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'chalk_nfl';
	
	
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Chalk_Nfl_Conferences_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Chalk_Nfl_Conferences_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/chalk-nfl-conferences-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Chalk_Nfl_Conferences_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Chalk_Nfl_Conferences_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/chalk-nfl-conferences-admin.js', array( 'jquery' ), $this->version, false );

	}
	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {
	
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'chalk_nfl_conferences', 'chalk-nfl-conferences' ),
			__( 'chalk_nfl_conferences', 'chalk-nfl-conferences' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);
	
	}
	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {
		include_once 'partials/chalk-nfl-conferences-admin-display.php';
	}
	
	/**
	 * Registers settings sections with WordPress
	 */
	public function register_sections() {
		add_settings_section(
			$this->option_name . '_general',
			__( 'General', 'chalk-nfl-conferences' ),
			array( $this, $this->option_name . '_general_cb' ),
			$this->plugin_name
		);
		
	}
	/**
	 * Register all related settings of this plugin
	 *
	 * @since  1.0.0
	 */
	public function register_settings() {
		
		add_settings_field(
			$this->option_name . '_api_key',
			__( 'API Key', 'chalk-nfl-conferences' ),
			array( $this, $this->option_name . '_api_key_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_api_key' )
		);
		
		register_setting( $this->plugin_name, $this->option_name . '_api_key' );
	}
	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function chalk_nfl_general_cb() {
		echo '<p>' . __( 'Please enter your chalk api key.', 'chalk-nfl-conferences' ) . '</p>';
	}
	/**
	 * Render the api key input for this plugin
	 *
	 * @since  1.0.0
	 */
	public function chalk_nfl_api_key_cb() {
		$api_key = get_option( $this->option_name . '_api_key' );
		echo '<input type="text" name="' . $this->option_name . '_api_key' . '" id="' . $this->option_name . '_api_key' . '" value="' . $api_key . '"> ';
	}

}
