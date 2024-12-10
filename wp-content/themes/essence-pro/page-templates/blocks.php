<?php
/**
 * Essence Pro.
 *
 * This file adds the blocks page template to the Essence Pro Theme.
 *
 * Template Name: Blocks
 *
 * @package Essence_Pro
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/essence/
 */

add_action( 'genesis_meta', 'essence_blocks_genesis_meta' );
/**
 * Adds widget support for homepage. If no widgets active, displays the default loop.
 *
 * @since 1.0.0
 */
function essence_blocks_genesis_meta() {

	// Adds the front page intro description text.
	add_action( 'essence_entry_header', 'essence_intro_description', 11 );

	// Removes the half-width-entries body class.
	remove_filter( 'body_class', 'essence_half_width_entry_class' );

	// Forces full width content layout.
	add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

	// Removes breadcrumbs.
	remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

	// Removes structural wrap from site-inner.
	add_theme_support(
		'genesis-structural-wraps',
		[
			'header',
			'menu-primary',
			'menu-secondary',
			'footer-widgets',
			'footer',
		]
	);

}

/**
 * Adds front page description text.
 *
 * @since 1.2.0
 */
function essence_intro_description() {

	$essence_description   = get_theme_mod( 'essence-description-text', essence_get_default_desc_text() );
	$button_primary_text   = get_theme_mod( 'essence-button-primary-text', essence_get_default_button_primary_text() );
	$button_primary_url    = get_theme_mod( 'essence-button-primary-url', essence_get_default_button_primary_url() );
	$button_secondary_text = get_theme_mod( 'essence-button-secondary-text', essence_get_default_button_secondary_text() );
	$button_secondary_url  = get_theme_mod( 'essence-button-secondary-url', essence_get_default_button_secondary_url() );

	if ( $essence_description && is_front_page() ) {
		echo '<p class="hero-description">' . wp_kses_post( $essence_description ) . '</p>';
	}

	if ( $button_primary_text && is_front_page() ) {
		echo '<a class="button primary" href="' . esc_url( $button_primary_url ) . '">' . wp_kses_post( $button_primary_text ) . '</a>';
	}
	if ( $button_secondary_text && is_front_page() ) {
		echo '<a class="button" href="' . esc_url( $button_secondary_url ) . '">' . wp_kses_post( $button_secondary_text ) . '</a>';
	}

}

// Repositions the breadcrumbs.
remove_action( 'genesis_after_header', 'genesis_do_breadcrumbs', 90 );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs', 12 );

// Runs the Genesis loop.
genesis();
