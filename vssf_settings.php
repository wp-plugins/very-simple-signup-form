<?php
/**
 * Plugin Name: Very Simple Signup Form
 * Description: This is a very simple signup form. Use the widget to display form in sidebar. For more info please check readme file.
 * Version: 1.6
 * Author: Guido van der Leest
 * Author URI: http://www.guidovanderleest.nl
 * License: GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: signupform
 * Domain Path: translation
 */


// Load the plugin's text domain
function vssf_init() { 
	load_plugin_textdomain( 'signupform', false, dirname( plugin_basename( __FILE__ ) ) . '/translation' );
}
add_action('plugins_loaded', 'vssf_init');


// Enqueues plugin scripts
function vssf_scripts() {	
	if(!is_admin())	{
		wp_enqueue_style('vssf_style', plugins_url('vssf_style.css',__FILE__));
	}
}
add_action('wp_enqueue_scripts', 'vssf_scripts');


// The sidebar widget
function register_vssf_widget() {
	register_widget( 'vssf_widget' );
}
add_action( 'widgets_init', 'register_vssf_widget' );


// function to get the IP address of the user
function vssf_get_the_ip() {
	if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
		return $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
		return $_SERVER["HTTP_CLIENT_IP"];
	}
	else {
		return $_SERVER["REMOTE_ADDR"];
	}
}


// Check data before saving it in database 
// Same as sanitize_text_field function but line breaks are allowed 
function vssf_sanitize_text_field($str) {
	$filtered = wp_check_invalid_utf8( $str );

	if ( strpos($filtered, '<') !== false ) {
		$filtered = wp_pre_kses_less_than( $filtered );
		$filtered = wp_strip_all_tags( $filtered, false );
	} else {
		$filtered = trim( preg_replace('/[\t ]+/', ' ', $filtered) );
	}

	$found = false;
	while ( preg_match('/%[a-f0-9]{2}/i', $filtered, $match) ) {
		$filtered = str_replace($match[0], '', $filtered);
		$found = true;
	}

	if ( $found ) {
		$filtered = trim( preg_replace('/ +/', ' ', $filtered) );
	}
	return apply_filters( 'vssf_sanitize_text_field', $filtered, $str );
}


// Add the admin options page
function vssf_menu_page() {
    add_options_page( __( 'VSSF Custom Style', 'signupform' ), __( 'VSSF Custom Style', 'signupform' ), 'manage_options', 'vssf', 'vssf_options_page' );
}
add_action( 'admin_menu', 'vssf_menu_page' );


// Add the admin settings and such 
function vssf_admin_init() {
    register_setting( 'vssf-options', 'vssf-setting', 'vssf_sanitize_text_field' );
    add_settings_section( 'vssf-section', __( 'Description', 'signupform' ), 'vssf_section_callback', 'vssf' );
    add_settings_field( 'vssf-field', __( 'Custom Style', 'signupform' ), 'vssf_field_callback', 'vssf', 'vssf-section' );
}
add_action( 'admin_init', 'vssf_admin_init' );


function vssf_section_callback() {
    echo __( 'On this page you can add Custom Style (CSS) to change the layout of your Very Simple Signup Form.', 'signupform' ); 
}


function vssf_field_callback() {
    $vssf_setting = esc_textarea( get_option( 'vssf-setting' ) );
    echo "<textarea name='vssf-setting' rows='10' cols='60' maxlength='1000'>$vssf_setting</textarea>";
}


// Display the admin options page
function vssf_options_page() {
?>
<div class="wrap"> 
	<div id="icon-plugins" class="icon32"></div> 
	<h2><?php _e( 'Very Simple Signup Form', 'signupform' ); ?></h2> 
	<form action="options.php" method="POST">
	<?php settings_fields( 'vssf-options' ); ?>
	<?php do_settings_sections( 'vssf' ); ?>
	<?php submit_button(__('Save Style', 'signupform')); ?>
	</form>
	<table class="widefat"> 
	<tbody> 
	<tr> 
	<td>
	<p><strong><?php _e( 'Field label', 'signupform' ); ?>:</strong></p>
	<p>#vssf label { }</p>
	<p><strong><?php _e( 'All fields', 'signupform' ); ?>:</strong></p>
	<p>#vssf input { }</p>
	<p><strong><?php _e( 'Fields by name', 'signupform' ); ?>:</strong></p>
	<p>#vssf_name, #vssf_email, #vssf_phonenumber, #vssf_sum { }</p>
	<p><strong><?php _e( 'Submit button', 'signupform' ); ?>:</strong></p>
	<p>#vssf_send { }</p>
	<p>#vssf_send:hover { }</p>
	</td>
	<td>
	<p><strong><?php _e( 'Field error', 'signupform' ); ?>:</strong></p>
	<p>#vssf input.error { }</p>
	<p><strong><?php _e( 'Error and Thank You message', 'signupform' ); ?>:</strong></p>
	<p>#vssf .error { }</p>
	<p>.vssf_info { }</p>
	<p><strong><?php _e( 'Widget', 'signupform' ); ?>:</strong></p>
	<p>.vssf_sidebar { }</p>
	<p><strong><?php _e( 'Plugin Stylesheet', 'signupform' ); ?>:</strong></p>
	<p><?php _e( 'For Default Style', 'signupform' ); ?> <a href="plugin-editor.php?file=very-simple-signup-form/vssf_style.css"><?php _e( 'Click Here', 'signupform' ); ?></a>.</p>
	</td>
	</tr>
	</tbody> 
	</table>
</div>
<?php
}


// Include custom CSS in header 
function vssf_custom_css() {
	$vssf_css = esc_textarea( get_option( 'vssf-setting' ) );
	if (!empty($vssf_css)) {
		echo '<style type="text/css">' . "\n"; 
		echo $vssf_css . "\n";
		echo '</style>' . "\n"; 
	}
}
add_action( 'wp_head', 'vssf_custom_css' );


include 'vssf_main.php';
include 'vssf_widget.php';

?>