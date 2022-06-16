<?php 
/**
 * @package  SSBrunoCodeBoil
 */
namespace Inc\Settings;

use Inc\Base\BaseController;

class AcfSettings extends BaseController{

	public function register() {

		define( 'MY_ACF_PATH', $this->plugin_path . '/includes/acf/' );
        define( 'MY_ACF_URL', $this->plugin_path . '/includes/acf/' );

        // Include the ACF plugin.
        include_once( MY_ACF_PATH . 'acf.php' );

        // Customize the url setting to fix incorrect asset URLs.
        add_filter( 'acf/settings/url', [ $this, 'acfSettings' ] );
        add_filter( 'acf/settings/show_admin', [ $this, 'showAdmin' ] );   

        $this->registerAcfFields();        
	
	}

    public function acfSettings(){
        return MY_ACF_URL;
    }

    public function showAdmin(){
        return false;
    }

    public function registerAcfFields(){

        if( function_exists('acf_add_local_field_group') ):

            acf_add_local_field_group(array (
                'key' => 'useful_group',
                'title' => 'useful group',
                'fields' => array (
                    array (
                        'key' => 'ssb-useful-field',
                        'label' => 'Useful Field',
                        'name' => 'ssb-useful-field',
                        'type' => 'text',
                        'prefix' => '',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '100%',
                            'class' => 'ssb-useful-field',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    )
                ),
                'location' => array (
                    array (
                        array (
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'post',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
            ));
            
        endif;


    }



}