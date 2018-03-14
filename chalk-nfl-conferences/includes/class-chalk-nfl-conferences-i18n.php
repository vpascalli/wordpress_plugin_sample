<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://soo.casa
 * @since      1.0.0
 *
 * @package    Chalk_Nfl_Conferences
 * @subpackage Chalk_Nfl_Conferences/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Chalk_Nfl_Conferences
 * @subpackage Chalk_Nfl_Conferences/includes
 * @author     Josh Galloway <pascalli@gmail.com>
 */
class Chalk_Nfl_Conferences_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'chalk-nfl-conferences',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
