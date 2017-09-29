<?php

/**
 *
 * @package wp-obscurer
 */

/**
 * Plugin Name: WP Obscurer
 * Plugin URI:  http://ale5000.altervista.org/
 * Description: The latest security hardening plug-in of this month ;)
 * Version:     0.0.0.1
 * Author:      ale5000
 * Author URI:  http://ale5000.altervista.org/
 * License:     GPLv3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: wp-obscurer
 */

// Exit if accessed directly
if(!defined('ABSPATH')) require_once './404.php';

remove_action('wp_head', 'wp_generator', 200);
remove_action('wp_head', 'woo_version', 200);
add_filter('the_generator', '__return_empty_string');
add_filter('revslider_meta_generator', '__return_empty_string');


/* Auto-clean meta generators */

function remove_meta_generators($html)
{
	$patterns = array('/<meta +name *= *"generator" +content *= *"Powered by .+>\n?/i');
	if(defined('WPSEO_VERSION'))
		$patterns[] = '/\<\!\-\- .*Yoast SEO.* \-\-\>\n?/i';
	return preg_replace($patterns, "", $html);
}

function auto_clean_meta_generators()
{
	ob_start('remove_meta_generators');
}

add_action('get_header', 'auto_clean_meta_generators', 9);
add_action('wp_head', function(){ if(ob_get_level()) ob_end_flush(); }, 200);
