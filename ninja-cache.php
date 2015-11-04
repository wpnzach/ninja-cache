<?php
/**
 * @package ninja_nist
 * @version 0.0
 */
/*
Plugin Name: Ninja Cache Buster
Plugin URI: http://github.com/wpnzach/ninja-cache/
Description: Bust cache for Ninja Forms
Author: Zach Skaggs
Version: 0.0
Author URI: http://zach.support/
*/
// Plugin Folder Path
if ( ! defined( 'NL_PLUGIN_DIR' ) )
		define( 'NL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Plugin Folder URL
if ( ! defined( 'NL_PLUGIN_URL' ) )
		define( 'NL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

//include( NL_PLUGIN_DIR . '/shortcodes.php');

// create shortcode
function nf_cache_busting_function( ) {
nocache_headers();
define('DONOTCACHEPAGE', TRUE);
}
add_shortcode( 'ninja_cache_buster', 'nf_cache_busting_function' );
