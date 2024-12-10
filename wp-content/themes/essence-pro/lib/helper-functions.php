<?php
/**
 * Essence Pro.
 *
 * This defines the helper functions for use in the Essence Pro Theme.
 *
 * @package Essence_Pro
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/essence/
 */

/**
 * Gets the default link color for Customizer.
 * Abstracted here since at least two functions use it.
 *
 * @since 1.0.0
 *
 * @return string Hex color code for link color.
 */
function essence_customizer_get_default_link_color() {

	return '#a86500';

}

/**
 * Gets the default accent color for Customizer.
 * Abstracted here since at least two functions use it.
 *
 * @since 1.0.0
 *
 * @return string Hex color code for accent color.
 */
function essence_customizer_get_default_accent_color() {

	return '#a86500';

}

/**
 * Get default hero section background image.
 *
 * @since 1.0.0
 *
 * @return string image url.
 */
function essence_get_default_hero_background_image() {

	return get_stylesheet_directory_uri() . '/images/hero-bg.jpg';

}

/**
 * Get default hero section description.
 *
 * @return string Text to use in the description.
 *
 * @since 1.0.0
 */
function essence_get_default_desc_text() {

	return __( 'Join our weekly newsletter and get our best articles about body, mind, soul, style, travel, and culture. No charge. No spam. Only love.', 'essence-pro' );

}

/**
 * Get default primary button text.
 *
 * @return string Text to use in the button.
 *
 * @since 1.2.0
 */
function essence_get_default_button_primary_text() {
	return __( 'Join Us Today', 'essence-pro' );
}

/**
 * Get default secondary button text.
 *
 * @return string Text to use in the button.
 *
 * @since 1.2.0
 */
function essence_get_default_button_secondary_text() {
	return __( 'Get More Info', 'essence-pro' );
}

/**
 * Get default primary button url.
 *
 * @return string URL to use for the primary button.
 *
 * @since 1.2.0
 */
function essence_get_default_button_primary_url() {
	return '#newsletter';
}

/**
 * Get default secondary button url.
 *
 * @return string URL to use for the secondary button.
 *
 * @since 1.2.0
 */
function essence_get_default_button_secondary_url() {
	return '#';
}

/**
 * Calculates if white or black would contrast more with the provided color.
 *
 * @since 1.0.0
 *
 * @param string $color A color in hex format.
 * @return string The hex code for the most contrasting color: dark grey or white.
 */
function essence_color_contrast( $color ) {

	$hexcolor = str_replace( '#', '', $color );

	$red   = hexdec( substr( $hexcolor, 0, 2 ) );
	$green = hexdec( substr( $hexcolor, 2, 2 ) );
	$blue  = hexdec( substr( $hexcolor, 4, 2 ) );

	$luminosity = ( ( $red * 0.2126 ) + ( $green * 0.7152 ) + ( $blue * 0.0722 ) );

	return ( $luminosity > 128 ) ? '#000000' : '#ffffff';

}

/**
 * Generates a lighter or darker color from a starting color.
 * Used to generate complementary hover tints from user-chosen colors.
 *
 * @since 1.0.0
 *
 * @param string $color A color in hex format.
 * @param int    $change The amount to reduce or increase brightness by.
 * @return string Hex code for the adjusted color brightness.
 */
function essence_color_brightness( $color, $change ) {

	$hexcolor = str_replace( '#', '', $color );

	$red   = hexdec( substr( $hexcolor, 0, 2 ) );
	$green = hexdec( substr( $hexcolor, 2, 2 ) );
	$blue  = hexdec( substr( $hexcolor, 4, 2 ) );

	$red   = max( 0, min( 255, $red + $change ) );
	$green = max( 0, min( 255, $green + $change ) );
	$blue  = max( 0, min( 255, $blue + $change ) );

	return '#' . dechex( $red ) . dechex( $green ) . dechex( $blue );

}

/**
 * Generates a lighter or darker color from a starting color.
 * Used to lighten or darken white or black complementary colors.
 *
 * @since 1.0.0
 *
 * @param string $color A color in hex format.
 * @return string Hex code for the adjusted color brightness.
 */
function essence_change_brightness( $color ) {

	$hexcolor = str_replace( '#', '', $color );

	$red   = hexdec( substr( $hexcolor, 0, 2 ) );
	$green = hexdec( substr( $hexcolor, 2, 2 ) );
	$blue  = hexdec( substr( $hexcolor, 4, 2 ) );

	$luminosity = ( ( $red * 0.2126 ) + ( $green * 0.7152 ) + ( $blue * 0.0722 ) );

	return ( $luminosity > 128 ) ? essence_color_brightness( '#000000', 80 ) : essence_color_brightness( '#ffffff', -50 );

}

add_action( 'genesis_entry_header', 'essence_wrapper', 2 );
/**
 * Opens the entry-container wrapper.
 *
 * @since 1.0.0
 */
function essence_wrapper() {

	// Exit early if on a singular entry.
	if ( ! is_singular() ) {

		genesis_markup(
			[
				'open'    => '<div %s>',
				'context' => 'entry-container',
			]
		);

	}

}

add_action( 'genesis_entry_footer', 'essence_wrapper_end', 20 );
/**
 * Closes the entry-container wrapper.
 *
 * @since 1.0.0
 */
function essence_wrapper_end() {

	// Exit early if on a singular entry.
	if ( ! is_singular() ) {

		genesis_markup(
			[
				'open'    => '</div>',
				'context' => 'entry-container',
			]
		);

	}

}

add_filter( 'body_class', 'essence_half_width_entry_class' );
/**
 * Defines the half width entries body class.
 *
 * @since 1.0.0
 *
 * @param array $classes Current classes.
 * @return array $classes Updated class array.
 */
function essence_half_width_entry_class( $classes ) {

	$site_layout = genesis_site_layout();

	$blog_template = ( genesis_is_blog_template() || is_page() && ! genesis_is_blog_template() && genesis_get_custom_field( 'query_args' ) );

	if ( 'full-width-content' === $site_layout && ( is_home() || is_category() || is_tag() || is_author() || is_search() || $blog_template ) ) {
		$classes[] = 'half-width-entries';
	}

	return $classes;

}

add_filter( 'body_class', 'essence_blog_body_class' );
/**
 * Defines the blog (query_args) body class.
 *
 * @since 1.0.0
 *
 * @param array $classes Current classes.
 * @return array $classes Updated class array.
 */
function essence_blog_body_class( $classes ) {

	if ( is_page() && ! genesis_is_blog_template() && genesis_get_custom_field( 'query_args' ) ) {
		$classes[] = 'page-template-page_blog';
	}

	return $classes;

}
