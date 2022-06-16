<?php
/**
 * @package  SSBrunoCodeBoil
 */

/*
Plugin Name: SSBruno Code Boilerplate Plugin
Description: This is a boilerplate plugin to startup wordpress plugin projects.
Version: 1.0.0
Author: Bruno Santana Stefani
Author URI: https://ssbruno.com/
Text Domain: ssbruno-code-boilerplate-plugin
*/

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here?' );

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function activateSSBrunoCodeBoil() 
{
	Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activateSSBrunoCodeBoil' );

/**
 * The code that runs during plugin deactivation
 */
function deactivateSSBrunoCodeBoil() 
{
	Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivateSSBrunoCodeBoil' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
	Inc\Init::register_services();
}