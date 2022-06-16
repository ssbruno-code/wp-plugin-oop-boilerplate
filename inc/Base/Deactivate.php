<?php
/**
 * @package  SSBrunoCodeBoil
 */

namespace Inc\Base;

 /**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 */

class Deactivate
{
	/**
	 * Flush Rewrite Rules
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}
}