<?php
/**
 * @package  SSBrunoCodeBoil
 */
namespace Inc\Base;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 * 
 */

class Activate
{

	/**
	 * 
	 * Flush Rules and update the options in wordpress options table
	 * 
	 */
	public static function activate() {
		flush_rewrite_rules();
	}
}