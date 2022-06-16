<?php
/**
 * @package  SSBrunoCodeBoil
 */

namespace Inc\Settings;

class Settings{
    
    private $ssbruno_code_options;

	public function register() {
        add_action( 'admin_menu', array( $this, 'ssbruno_code_add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'ssbruno_code_page_init' ) );
    }

    public function ssbruno_code_add_plugin_page() {
        add_options_page(
            'SSBruno Code', // page_title
            'SSBruno Code', // menu_title
            'manage_options', // capability
            'ssbruno-code', // menu_slug
            array( $this, 'ssbruno_code_create_admin_page' ) // function
        );
    }

    public function ssbruno_code_create_admin_page() {
        $this->ssbruno_code_options = get_option( 'ssbruno_code_option_name' ); ?>

        <div class="wrap">
            <h2>SSBruno Code</h2>


            <form method="post" action="options.php">
                <?php
                    settings_fields( 'ssbruno_code_option_group' );
                    do_settings_sections( 'ssbruno-code-admin' );
                    submit_button();
                ?>
            </form>
        </div>
    <?php }

    public function ssbruno_code_page_init() {
        register_setting(
            'ssbruno_code_option_group', // option_group
            'ssbruno_code_option_name', // option_name
            array( $this, 'ssbruno_code_sanitize' ) // sanitize_callback
        );

        add_settings_section(
            'ssbruno_code_setting_section', // id
            'Settings', // title
            array( $this, 'ssbruno_code_section_info' ), // callback
            'ssbruno-code-admin' // page
        );

        add_settings_field(
            'activate_deactivate_0', // id
            'Deactivate', // title
            array( $this, 'activate_deactivate_0_callback' ), // callback
            'ssbruno-code-admin', // page
            'ssbruno_code_setting_section' // section
        );
    }

    public function ssbruno_code_sanitize($input) {
        $sanitary_values = array();
        if ( isset( $input['activate_deactivate_0'] ) ) {
            $sanitary_values['activate_deactivate_0'] = $input['activate_deactivate_0'];
        }

        return $sanitary_values;
    }

    public function ssbruno_code_section_info() {
        
    }

    public function activate_deactivate_0_callback() {
        printf(
            '<input type="checkbox" name="ssbruno_code_option_name[activate_deactivate_0]" id="activate_deactivate_0" value="activate_deactivate_0" %s> <label for="activate_deactivate_0">Disable plugin functionality</label>',
            ( isset( $this->ssbruno_code_options['activate_deactivate_0'] ) && $this->ssbruno_code_options['activate_deactivate_0'] === 'activate_deactivate_0' ) ? 'checked' : ''
        );
    }

}


/* 
 * Retrieve this value with:
 * $ssbruno_code_options = get_option( 'ssbruno_code_option_name' ); // Array of All Options
 * $activate_deactivate_0 = $ssbruno_code_options['activate_deactivate_0']; // Activate/Deactivate
 */
