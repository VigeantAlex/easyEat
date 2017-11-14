<?php
/*
Plugin Name: Socials Ignited
Description: The Socials Ignited plugin gives you a widget, allowing you to display and link icons on your website of more than 50 social networks. Once activated go to Settings > Socials Ignited to add your social profiles and then to Appearance > Widgets to use the widget :)
Version: 1.10
License: GPL
Plugin URI: http://www.cssigniter.com/ignite/socials-ignited
Author: The CSSIgniter Team
Author URI: http://www.cssigniter.com/
Text Domain: socials-ignited
Domain Path: /languages

==========================================================================

Copyright 2011-2012  CSSIgniter

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

// plugin folder url
if ( ! defined( 'CISIW_PLUGIN_URL' ) ) {
	define( 'CISIW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

// plugin folder path
if ( ! defined( 'CISIW_PLUGIN_PATH' ) ) {
	define( 'CISIW_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}

// plugin root file
if ( ! defined( 'CISIW_PLUGIN_FILE' ) ) {
	define( 'CISIW_PLUGIN_FILE', __FILE__ );
}

if ( ! defined( 'CISIW_BASENAME' ) ) {
	define( 'CISIW_BASENAME', plugin_basename( __FILE__ ) );
}

load_plugin_textdomain( 'socials-ignited', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );


// Includes
include( 'includes/admin-page.php' );
include( 'includes/widget.php' );

if ( ! function_exists( 'cisiw_get_services' ) ):
function cisiw_get_services() {
	$services = apply_filters( 'cisiw_services', array(
		'addthis'     => esc_html_x( 'AddThis', 'website name', 'socials-ignited' ),
		'amazon'      => esc_html_x( 'Amazon', 'website name', 'socials-ignited' ),
		'amazon_alt'  => esc_html_x( 'Amazon (alternative icon)', 'website name', 'socials-ignited' ),
		'apple'       => esc_html_x( 'Apple', 'website name', 'socials-ignited' ),
		'apple_alt'   => esc_html_x( 'Apple (alternative icon)', 'website name', 'socials-ignited' ),
		'blogger'     => esc_html_x( 'Blogger', 'website name', 'socials-ignited' ),
		'behance'     => esc_html_x( 'Behance', 'website name', 'socials-ignited' ),
		'delicious'   => esc_html_x( 'Delicious', 'website name', 'socials-ignited' ),
		'designfloat' => esc_html_x( 'Design Float', 'website name', 'socials-ignited' ),
		'designbump'  => esc_html_x( 'Design Bump', 'website name', 'socials-ignited' ),
		'deviantart'  => esc_html_x( 'DeviantArt', 'website name', 'socials-ignited' ),
		'digg'        => esc_html_x( 'Digg', 'website name', 'socials-ignited' ),
		'dopplr'      => esc_html_x( 'Dopplr', 'website name', 'socials-ignited' ),
		'dribbble'    => esc_html_x( 'Dribbble', 'website name', 'socials-ignited' ),
		'email'       => esc_html_x( 'Email', 'website name', 'socials-ignited' ),
		'evernote'    => esc_html_x( 'Evernote', 'website name', 'socials-ignited' ),
		'facebook'    => esc_html_x( 'Facebook', 'website name', 'socials-ignited' ),
		'flickr'      => esc_html_x( 'Flickr', 'website name', 'socials-ignited' ),
		'forrst'      => esc_html_x( 'Forrst', 'website name', 'socials-ignited' ),
		'friendfeed'  => esc_html_x( 'FriendFeed', 'website name', 'socials-ignited' ),
		'github'      => esc_html_x( 'GitHub', 'website name', 'socials-ignited' ),
		'github_alt'  => esc_html_x( 'GitHub (alternative icon)', 'website name', 'socials-ignited' ),
		'gplus'       => esc_html_x( 'Google+', 'website name', 'socials-ignited' ),
		'grooveshark' => esc_html_x( 'Grooveshark', 'website name', 'socials-ignited' ),
		'gtalk'       => esc_html_x( 'Gtalk', 'website name', 'socials-ignited' ),
		'instagram'   => esc_html_x( 'Instagram', 'website name', 'socials-ignited' ),
		'lastfm'      => esc_html_x( 'LastFM', 'website name', 'socials-ignited' ),
		'linkedin'    => esc_html_x( 'LinkedIn', 'website name', 'socials-ignited' ),
		'myspace'     => esc_html_x( 'MySpace', 'website name', 'socials-ignited' ),
		'netvibes'    => esc_html_x( 'Netvibes', 'website name', 'socials-ignited' ),
		'newsvine'    => esc_html_x( 'Newsvine', 'website name', 'socials-ignited' ),
		'orkut'       => esc_html_x( 'Orkut', 'website name', 'socials-ignited' ),
		'path'        => esc_html_x( 'Path', 'website name', 'socials-ignited' ),
		'paypal'      => esc_html_x( 'Paypal', 'website name', 'socials-ignited' ),
		'picasa'      => esc_html_x( 'Picasa', 'website name', 'socials-ignited' ),
		'pinterest'   => esc_html_x( 'Pinterest', 'website name', 'socials-ignited' ),
		'posterous'   => esc_html_x( 'Posterous', 'website name', 'socials-ignited' ),
		'reddit'      => esc_html_x( 'Reddit', 'website name', 'socials-ignited' ),
		'rss'         => esc_html_x( 'RSS', 'website name', 'socials-ignited' ),
		'sharethis'   => esc_html_x( 'ShareThis', 'website name', 'socials-ignited' ),
		'skype'       => esc_html_x( 'Skype', 'website name', 'socials-ignited' ),
		'soundcloud'  => esc_html_x( 'SoundCloud', 'website name', 'socials-ignited' ),
		'spotify'     => esc_html_x( 'Spotify', 'website name', 'socials-ignited' ),
		'stumble'     => esc_html_x( 'StumbleUpon', 'website name', 'socials-ignited' ),
		'technorati'  => esc_html_x( 'Technorati', 'website name', 'socials-ignited' ),
		'tumblr'      => esc_html_x( 'Tumblr', 'website name', 'socials-ignited' ),
		'twitter'     => esc_html_x( 'Twitter', 'website name', 'socials-ignited' ),
		'viddler'     => esc_html_x( 'Viddler', 'website name', 'socials-ignited' ),
		'vimeo'       => esc_html_x( 'Vimeo', 'website name', 'socials-ignited' ),
		'virb'        => esc_html_x( 'Virb', 'website name', 'socials-ignited' ),
		'virb_alt'    => esc_html_x( 'Virb (alternative icon)', 'website name', 'socials-ignited' ),
		'yahoo'       => esc_html_x( 'Yahoo', 'website name', 'socials-ignited' ),
		'yahoo_alt'   => esc_html_x( 'Yahoo (alternative icon)', 'website name', 'socials-ignited' ),
		'youtube'     => esc_html_x( 'YouTube', 'website name', 'socials-ignited' ),
		'youtube_alt' => esc_html_x( 'YouTube (alternative icon)', 'website name', 'socials-ignited' ),
		'windows'     => esc_html_x( 'Windows', 'website name', 'socials-ignited' ),
		'wordpress'   => esc_html_x( 'WordPress', 'website name', 'socials-ignited' ),
		'zerply'      => esc_html_x( 'Zerply', 'website name', 'socials-ignited' )
	) );

	return $services;
}
endif;

if ( ! function_exists( 'cisiw_get_icon_sets' ) ):
function cisiw_get_icon_sets() {
	// Note that the set's names, variations and sizes must match the folder value.
	$icon_sets = apply_filters( 'cisiw_icon_sets', array(
		// First level is the set's name.
		'square' => array(
			// Second level are the available variations
			'default' => array(
				// Third level are the available sizes for the specific variation.
				'16',
				'24',
				'32',
				'48',
				'64'
			)
		),
		'round'  => array(
			'dark'  => array( '32' ),
			'light' => array( '32' )
		)
	) );

	return $icon_sets;
}
endif;

if ( ! function_exists( 'cisiw_get_icon_set_names' ) ):
function cisiw_get_icon_set_names() {
	$icon_set_names = apply_filters( 'cisiw_icon_set_names', array(
		'square' => esc_html_x( 'Square', 'icons set name', 'socials-ignited' ),
		'round'  => esc_html_x( 'Round', 'icons set name', 'socials-ignited' )
	) );

	return $icon_set_names;
}
endif;

if ( ! function_exists( 'cisiw_get_lookup_paths' ) ):
function cisiw_get_lookup_paths() {
	$lookup_paths = apply_filters( 'cisiw_lookup_paths', array(
		// icon_set => base_path, base_url
		'dir' => array( CISIW_PLUGIN_PATH ),
		'url' => array( CISIW_PLUGIN_URL )
	) );

	return $lookup_paths;
}
endif;

// The icon should be passed in the form  set/variation/size/service.png
if ( ! function_exists( 'cisiw_get_icon_path' ) ):
function cisiw_get_icon_path( $icon ) {
	$lookup_paths = cisiw_get_lookup_paths();

	$icon = 'images/' . $icon;

	$i     = 0;
	$found = false;
	foreach ( $lookup_paths['dir'] as $path ) {
		if ( is_readable( $path . $icon ) ) {
			$found = $i;
			break;
		}
		$i ++;

	}
	if ( $found !== false ) {
		$icon_url = $lookup_paths['url'][ $found ] . $icon;

		return $icon_url;
	}

	return false;

}
endif;

add_filter( 'plugin_action_links_' . CISIW_BASENAME, 'cisiw_plugin_action_links' );
if ( ! function_exists( 'cisiw_plugin_action_links' ) ):
function cisiw_plugin_action_links( $links ) {
	$url = admin_url( 'options-general.php?page=cisiw-options' );
	array_unshift( $links, '<a href="' . esc_url( $url ) . '">' . esc_html__( 'Settings', 'socials-ignited' ) . '</a>' );

	return $links;
}
endif;

add_action( 'in_plugin_update_message-' . CISIW_BASENAME, 'cisiw_plugin_update_message', 10, 2 );
if ( ! function_exists( 'cisiw_plugin_update_message' ) ):
function cisiw_plugin_update_message( $plugin_data, $r ) {
	if ( ! empty( $r->upgrade_notice ) ) {
		printf( '<p style="margin: 3px 0 0 0; border-top: 1px solid #ddd; padding-top: 3px">%s</p>', $r->upgrade_notice );
	}
}
endif;

function _cisiw_deprecated_widget_is_assigned() {
	$deprecated_widget_assigned = false;
	$sidebars_widgets           = wp_get_sidebars_widgets();
	if ( ! empty( $sidebars_widgets ) ) {
		foreach ( $sidebars_widgets as $sidebar ) {
			if ( ! empty( $sidebar ) ) {
				foreach ( $sidebar as $widget ) {
					if ( strpos( $widget, 'ci_socials_ignited' ) === 0 ) {
						$deprecated_widget_assigned = true;
					}
				}
			}
		}
	}

	return $deprecated_widget_assigned;
}

if ( ! function_exists( 'cisiw_sanitize_hex_color' ) ):
/**
 * Returns a sanitized hex color code.
 *
 * @param string $str The color string to be sanitized.
 * @param bool $return_hash Whether to return the color code prepended by a hash.
 * @param string $return_fail The value to return on failure.
 * @return string A valid hex color code on success, an empty string on failure.
 */
function cisiw_sanitize_hex_color( $str, $return_hash = true, $return_fail = '' ) {

	// Include the hash if not there.
	// The regex below depends on in.
	if ( substr( $str, 0, 1 ) != '#' ) {
		$str = '#' . $str;
	}

	$matches = array();
	/*
	 * Example on success:
	 * $matches = array(
	 * 		[0] => #1a2b3c
	 * 		[1] => #
	 * 		[2] => 1a2b3c
	 * )
	 *
	 */
	preg_match( '/(#)([0-9a-fA-F]{6})/', $str, $matches );

	if ( count( $matches ) == 3 ) {
		if ( $return_hash ) {
			return $matches[1] . $matches[2];
		} else {
			return $matches[2];
		}
	} else {
		return $return_fail;
	}
}
endif;

if ( ! function_exists( 'cisiw_absint_or_empty' ) ):
/**
 * Return a positive integer value, or an empty string instead of zero.
 *
 * @uses absint()
 *
 * @param mixed $value A value to convert to integer.
 * @return mixed Empty string on zero, or a positive integer.
 */
function cisiw_absint_or_empty( $value ) {
	$value = absint( $value );
	if ( $value == 0 ) {
		return '';
	} else {
		return $value;
	}
}
endif;

if ( ! function_exists( 'cisiw_sanitize_checkbox' ) ):
/**
 * Sanitizes a checkbox value, by comparing $input with $allowed_value
 *
 * @param string $input The checkbox value that was sent through the form.
 * @param string $allowed_value The only value that the checkbox can have (default 'on').
 * @return string The $allowed_value on success, or an empty string on failure.
 */
function cisiw_sanitize_checkbox( &$input, $allowed_value = 'on' ) {
	if ( isset( $input ) and $input == $allowed_value ) {
		return $allowed_value;
	} else {
		return '';
	}
}
endif;
