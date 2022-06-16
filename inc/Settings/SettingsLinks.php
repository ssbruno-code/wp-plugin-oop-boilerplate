<?php
/**
 * @package  SSBrunoCodeBoil
 */

namespace Inc\Settings;

use Inc\Base\BaseController;
/**
 * Show settings link in the plugin page 
 */
class SettingsLinks extends BaseController
{
	public function register() 
	{
        add_filter( 'plugin_action_links_' . $this->plugin, [ $this, 'settings_link' ] );
	}

	public function settings_link( $links ) 
	{
		$settings_link = '<a href="options-general.php?page=ssbruno-code">Settings</a>';
		array_push( $links, $settings_link );
		return $links;
	}
}