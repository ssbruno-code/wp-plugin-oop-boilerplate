<?php 
/**
 * @package  SSBrunoCodeBoil
 */
namespace Inc\Base;

use Inc\Base\BaseController;

/**
* 
*/
class Enqueue extends BaseController
{		

	public function register() {

		add_action( 'admin_enqueue_scripts', array( $this, 'adminEnqueue' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'publicEnqueue' ) );
	
	}

	/**
	 * Register the JavaScript and css for the admin area.
	 *
	 */	
	function adminEnqueue() {

		wp_enqueue_style( 'ssbAdminStyle', $this->plugin_url . 'assets/css/admin-styles.min.css' );
		wp_enqueue_script( 'ssbAdminScript', $this->plugin_url . 'assets/js/admin-scripts.min.js' );

	}


	/**
	 * Register the JavaScript and css for the public area.
	 *
	 */
	function publicEnqueue() {

		wp_enqueue_style( 'ssbPublicStyles', $this->plugin_url . 'assets/css/public-styles.css' );
		wp_enqueue_script( 'ssbPublicScript', $this->plugin_url . 'assets/js/public-scripts.js' );
		
	}



}