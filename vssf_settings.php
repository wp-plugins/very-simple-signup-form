<?php
/**
 * Plugin Name: Very Simple Signup Form
 * Description: This is a very simple signup form. Use the widget to display form in sidebar. For more info please check readme file.
 * Version: 1.2
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
	if(!is_admin())
	{
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

include 'vssf_main.php';
include 'vssf_widget.php';

?>