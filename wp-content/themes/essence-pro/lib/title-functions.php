<?php
/**
 * Essence Pro.
 *
 * This file adds the title customizations to the Essence Pro Theme.
 *
 * @package Essence
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/essence/
 */

/**
 * Opens the hero title section.
 *
 * @since 1.0.0
 */
function essence_header_title_wrap() {

	genesis_markup(
		[
			'open'    => '<div %s><div class="wrap">',
			'context' => 'hero-page-title',
		]
	);

	do_action( 'essence_entry_header' );

}

/**
 * Closes the hero title section.
 *
 * @since 1.0.0
 */
function essence_header_title_end_wrap() {

	genesis_markup(
		[
			'close'   => '</div></div>',
			'context' => 'hero-page-title',
		]
	);

}

add_filter( 'genesis_attr_hero-page-title', 'essence_add_header_attributes' );
/**
 * Adds custom attributes for the header hero title.
 *
 * @since 1.0.0
 *
 * @param array $attributes The element attributes.
 * @return array $attributes The element attributes.
 */
function essence_add_header_attributes( $attributes ) {

	// Adds id.
	$attributes['id'] = 'hero-page-title';

	// Returns the attributes.
	return $attributes;

}

add_filter( 'genesis_attr_entry', 'essence_entry_attributes', 10, 3 );
/**
 * Add itemref attribute to link entry-title.
 *
 * @since  1.0.0
 *
 * @param array $attributes Existing attributes for entry element.
 * @param array $context Current element being filtered.
 * @param array $args The attribute arguments.
 * @return array The new $attributes.
 */
function essence_entry_attributes( $attributes, $context, $args ) {

	if ( is_singular() && ! is_front_page() && ! isset( $args['params']['is_widget'] ) ) {
		$attributes['itemref'] = 'hero-page-title';
	}

	return $attributes;

}

add_action( 'genesis_meta', 'essence_page_hero_header' );
/**
 * Relocates page titles and adds header image wrapper.
 *
 * @since 1.0.0
 */
function essence_page_hero_header() {

	add_action( 'genesis_before_header', 'essence_header_hero_start' );
	add_action( 'genesis_after_header', 'essence_header_title_wrap', 90 );
	add_action( 'genesis_after_header', 'essence_header_title_end_wrap', 98 );
	add_action( 'genesis_after_header', 'essence_header_hero_end', 99 );

	if ( is_single() || is_page() && ! genesis_is_blog_template() && ! genesis_get_custom_field( 'query_args' ) ) {
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
		add_action( 'essence_entry_header', 'genesis_entry_header_markup_open' );
		add_action( 'essence_entry_header', 'genesis_do_post_title' );
		add_action( 'essence_entry_header', 'genesis_post_info' );
		add_action( 'essence_entry_header', 'genesis_entry_header_markup_close' );
	} elseif ( is_home() || is_tag() || is_category() || is_archive() || genesis_is_blog_template() ) {
		remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
		remove_action( 'genesis_before_loop', 'genesis_do_author_title_description', 15 );
		remove_action( 'genesis_before_loop', 'genesis_do_author_box_archive', 15 );
		remove_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );
		remove_action( 'genesis_before_loop', 'genesis_do_date_archive_title' );
		remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );
		remove_action( 'genesis_before_loop', 'genesis_do_blog_template_heading' );
		add_action( 'essence_entry_header', 'genesis_do_blog_template_heading' );
		add_action( 'essence_entry_header', 'genesis_do_taxonomy_title_description' );
		add_action( 'essence_entry_header', 'genesis_do_author_title_description' );
		add_action( 'essence_entry_header', 'genesis_do_author_box_archive' );
		add_action( 'essence_entry_header', 'genesis_do_cpt_archive_title_description' );
		add_action( 'essence_entry_header', 'genesis_do_date_archive_title' );
		add_action( 'essence_entry_header', 'genesis_do_posts_page_heading' );
	} elseif ( is_search() ) {
		remove_action( 'genesis_before_loop', 'genesis_do_search_title' );
		add_action( 'essence_entry_header', 'genesis_do_search_title' );
	}

}

add_action( 'essence_entry_header', 'essence_do_blog_template_heading' );
/**
 * Add custom heading to query_args pages.
 *
 * If we're not on a query_args page, then nothing extra is displayed.
 *
 * @since 2.2.0
 *
 * @return void Return early if not on query_args archive.
 */
function essence_do_blog_template_heading() {

	if ( ! genesis_get_custom_field( 'query_args' ) || genesis_is_blog_template() ) {
		return;
	}

	printf( '<div %s>', genesis_attr( 'blog-template-description' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		genesis_do_post_title();
	echo '</div>';

}

add_action( 'genesis_loop', 'essence_remove_404_title' );
/**
 * Removes default 404 entry title.
 *
 * @since  1.0.0
 */
function essence_remove_404_title() {

	if ( ! is_404() ) {
		return;
	}

	add_filter( 'genesis_markup_entry-title_open', '__return_false' );
	add_filter( 'genesis_markup_entry-title_close', '__return_false' );
	add_filter( 'genesis_404_entry_title', '__return_false' );

}

add_action( 'essence_entry_header', 'essence_404_title', 96 );
/**
 * Defines 404 entry title.
 *
 * @since  1.0.0
 */
function essence_404_title() {

	if ( ! is_404() ) {
		return;
	}

	genesis_markup(
		[
			'open'    => '<h1 %s>',
			'close'   => '</h1>',
			'content' => apply_filters( 'genesis_404_entry_title', __( '404 Page Not Found', 'essence-pro' ) ), // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- preserves the Genesis filter name for plugins to alter.
			'context' => 'entry-title',
		]
	);

}

add_action( 'genesis_after_loop', 'essence_remove_404_title_filters' );
/**
 * Removes 404 entry-title filters.
 *
 * @since 1.0.0
 */
function essence_remove_404_title_filters() {

	remove_filter( 'genesis_markup_entry-title_open', '__return_false' );
	remove_filter( 'genesis_markup_entry-title_close', '__return_false' );

}

add_action( 'be_title_toggle_remove', 'essence_integrate_genesis_title_toggle' );
/**
 * Integrates with Genesis Title Toggle
 *
 * @since  1.0.0
 *
 * @see https://www.billerickson.net/code/genesis-title-toggle-theme-integration
 */
function essence_integrate_genesis_title_toggle() {

	remove_action( 'genesis_after_header', 'essence_header_title_wrap', 90 );
	remove_action( 'essence_entry_header', 'genesis_entry_header_markup_open' );
	remove_action( 'essence_entry_header', 'genesis_do_post_title' );
	remove_action( 'essence_entry_header', 'genesis_entry_header_markup_close' );
	remove_action( 'genesis_after_header', 'essence_header_title_end_wrap', 98 );

}
