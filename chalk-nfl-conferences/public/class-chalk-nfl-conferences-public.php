<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://soo.casa
 * @since      1.0.0
 *
 * @package    Chalk_Nfl_Conferences
 * @subpackage Chalk_Nfl_Conferences/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Chalk_Nfl_Conferences
 * @subpackage Chalk_Nfl_Conferences/public
 * @author     Josh Galloway <pascalli@gmail.com>
 */
class Chalk_Nfl_Conferences_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/chalk-nfl-conferences-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/chalk-nfl-conferences-public.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	 * Processes shortcode chalk_teamlist
	 *
	 * @param   array	$atts		The attributes from the shortcode
	 *
	 * @uses	chalk api key
	 *
	 * @return	mixed	$output		Table output data for display
	 */
	public function chalk_teamlist() {
		$api_key = get_option( 'chalk_nfl_api_key' );
		
		if ( empty( $api_key ) ) { return; }
		$url = 'http://delivery.chalk247.com/team_list/NFL.JSON?api_key='.$api_key; // path to your JSON file
		$json_data = file_get_contents($url); // put the contents of the file into a variable
		 
		$array_data = json_decode($json_data,true);// decode the JSON feed
		$cols_array = $array_data['results']['columns'];
		$team_data_array = $array_data['results']['data']['team'];
		
		$output = '<table id="teamTable"><tr>';
		$cols_array_values = array_values($cols_array);
		for($i = 0; $i < count($cols_array); ++$i) {
			$output .= '<th onclick="sortTable('.$i.')">'.$cols_array_values[$i].'</th>';
		}
		$output .= '</tr>';
		foreach($team_data_array as $team)
		{
			$output .= '<tr>';
			foreach($team as $key => $item)
			{
				$output .= '<td>'.$item.'</td>';
			}
			$output .= '</tr>';

		}


		$output .= '</table>';

		return $output;
	} // chalk_teamlist()
	
	/**
	 * Registers all shortcodes at once
	 *
	 * @return [type] [description]
	 */
	public function register_shortcodes() {
		add_shortcode( 'chalk_teamlist', array( $this, 'chalk_teamlist' ) );
		
	} // register_shortcodes()

}
