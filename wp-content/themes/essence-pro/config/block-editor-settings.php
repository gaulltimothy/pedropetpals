<?php
/**
 * Block Editor settings specific to Essence Pro.
 *
 * @package Essence Pro
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

$essence_link_color            = get_theme_mod( 'essence_link_color', essence_customizer_get_default_link_color() );
$essence_link_color_contrast   = essence_color_contrast( $essence_link_color );
$essence_link_color_brightness = essence_color_brightness( $essence_link_color, 35 );

return [
	'admin-fonts-url'              => 'https://fonts.googleapis.com/css?family=Alegreya+Sans:400,400i,700|Lora:400,700&display=swap',
	'content-width'                => 860,
	'default-button-bg'            => $essence_link_color,
	'default-button-color'         => $essence_link_color_contrast,
	'default-button-outline-hover' => $essence_link_color_brightness,
	'default-link-color'           => $essence_link_color,
	'default-accent-color'         => $essence_link_color,
	'editor-color-palette'         => [
		[
			'name'  => __( 'Custom color', 'essence-pro' ),
			'slug'  => 'theme-primary',
			'color' => $essence_link_color,
		],
	],
	'editor-font-sizes'            => [
		[
			'name' => __( 'Small', 'essence-pro' ),
			'size' => 16,
			'slug' => 'small',
		],
		[
			'name' => __( 'Normal', 'essence-pro' ),
			'size' => 20,
			'slug' => 'normal',
		],
		[
			'name' => __( 'Large', 'essence-pro' ),
			'size' => 24,
			'slug' => 'large',
		],
		[
			'name' => __( 'Larger', 'essence-pro' ),
			'size' => 28,
			'slug' => 'larger',
		],
	],
];
