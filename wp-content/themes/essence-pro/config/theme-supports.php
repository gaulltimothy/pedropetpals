<?php
/**
 * Essence Pro.
 *
 * Theme supports.
 *
 * @package Essence
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/essence/
 */

return [
	'genesis-accessibility'           => [
		'drop-down-menu',
		'headings',
		'search-form',
		'skip-links',
	],
	'genesis-custom-logo'             => [
		'flex-height' => true,
		'flex-width'  => true,
		'height'      => 160,
		'width'       => 600,
	],
	'html5'                           => [
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form',
		'script',
		'style',
	],
	'custom-header'                   => [
		'default-image'    => essence_get_default_hero_background_image(),
		'header-text'      => false,
		'header-selector'  => '.header-hero',
		'flex-height'      => true,
		'flex-width'       => true,
		'height'           => 800,
		'width'            => 1600,
		'wp-head-callback' => 'essence_header_style',
	],
	'genesis-after-entry-widget-area' => '',
	'genesis-lazy-load-images'        => '',
	'genesis-menus'                   => [
		'primary'    => __( 'Header Menu', 'essence-pro' ),
		'secondary'  => __( 'Footer Menu', 'essence-pro' ),
		'off-screen' => __( 'Off Screen', 'essence-pro' ),
	],
];
