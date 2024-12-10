<?php
/**
 * Gutenberg theme support.
 *
 * @package Essence Pro
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

add_action( 'wp_enqueue_scripts', 'essence_pro_enqueue_gutenberg_frontend_styles' );
/**
 * Enqueues Gutenberg front-end styles.
 *
 * @since 1.1.0
 */
function essence_pro_enqueue_gutenberg_frontend_styles() {

	wp_enqueue_style(
		genesis_get_theme_handle() . '-gutenberg',
		get_stylesheet_directory_uri() . '/lib/gutenberg/front-end.css',
		[ genesis_get_theme_handle() ],
		genesis_get_theme_version()
	);

}

add_action( 'enqueue_block_editor_assets', 'essence_pro_block_editor_styles' );
/**
 * Enqueues Gutenberg admin editor fonts and styles.
 *
 * @since 1.1.0
 */
function essence_pro_block_editor_styles() {

	$block_editor_settings = genesis_get_config( 'block-editor-settings' );

	wp_enqueue_style(
		genesis_get_theme_handle() . '-gutenberg-fonts',
		$block_editor_settings['admin-fonts-url'],
		[],
		genesis_get_theme_version()
	);

	wp_enqueue_script(
		genesis_get_theme_handle() . '-gutenberg-js',
		get_stylesheet_directory_uri() . '/lib/gutenberg/admin/js/block-classes.js',
		[ 'wp-dom' ],
		genesis_get_theme_version(),
		true
	);

	wp_localize_script(
		genesis_get_theme_handle() . '-gutenberg-js',
		'studiopressConfig',
		[
			'defaultLayout' => genesis_get_option( 'site_layout' ),
		]
	);

}

// Add support for editor styles.
add_theme_support( 'editor-styles' );

// Enqueue editor styles.
add_editor_style( '/lib/gutenberg/style-editor.css' );

// Adds support for block alignments.
add_theme_support( 'align-wide' );

// Make media embeds responsive.
add_theme_support( 'responsive-embeds' );

$essence_block_editor_settings = genesis_get_config( 'block-editor-settings' );

// Adds support for editor font sizes.
add_theme_support( 'editor-font-sizes', $essence_block_editor_settings['editor-font-sizes'] );

// Adds support for editor color palette.
add_theme_support( 'editor-color-palette', $essence_block_editor_settings['editor-color-palette'] );

require_once get_stylesheet_directory() . '/lib/gutenberg/inline-styles.php';

add_action( 'after_setup_theme', 'essence_pro_content_width', 0 );
/**
 * Set content width to match the “wide” Gutenberg block width.
 */
function essence_pro_content_width() {

	$block_editor_settings = genesis_get_config( 'block-editor-settings' );

	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- See https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/924
	$GLOBALS['content_width'] = apply_filters( 'essence_pro_content_width', $block_editor_settings['content-width'] );

}

add_action( 'init', 'essence_custom_block_style' );
/**
 * Adds custom styles to WordPress core blocks.
 *
 * @since 1.4.0
 */
function essence_custom_block_style() {

	if ( ! function_exists( 'register_block_style' ) ) {
		return;
	}

	$names = genesis_get_config( 'block-styles' );

	foreach ( $names as $name => $styles ) {
		foreach ( $styles as $style ) {
			register_block_style( $name, $style );
		}
	}

}
