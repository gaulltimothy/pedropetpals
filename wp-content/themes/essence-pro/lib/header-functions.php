<?php
/**
 * Essence Pro.
 *
 * This file adds the header wrapper functions to the Essence Pro Theme.
 *
 * @package Essence
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/essence/
 */

/**
 * Opens the hero image section.
 *
 * @since 1.0.0
 */
function essence_header_hero_start() {

	genesis_markup(
		[
			'open'    => '<div %s>',
			'context' => 'header-hero',
		]
	);

}

/**
 * Closes the hero image section.
 *
 * @since 1.0.0
 */
function essence_header_hero_end() {

	genesis_markup(
		[
			'close'   => '</div>',
			'context' => 'header-hero',
		]
	);

}


add_action( 'after_setup_theme', 'essence_additional_schema', 11 );
/**
 * Adds attributes for Footer Navigation if Genesis is outputting schema.
 *
 * @since 1.3.0
 */
function essence_additional_schema() {

	if ( ! genesis_is_wpseo_outputting_jsonld() && ! apply_filters( 'genesis_disable_microdata', false ) ) { // phpcs:ignore -- uses genesis filter function
		add_filter( 'genesis_attr_nav-off-screen', 'StudioPress\Genesis\Functions\Schema\nav_primary' );
	}

}

add_action( 'genesis_header', 'essence_header_right_menu', 9 );
/**
 * Adds header-right menu.
 *
 * @since 1.0.0
 */
function essence_header_right_menu() {

	// Bail out if the off-screen theme is not set up.
	if ( ! has_nav_menu( 'off-screen' ) ) {
		return;
	}

	$menu_text = __( 'Menu', 'essence-pro' );
	$hide_text = __( 'Hide Off Screen Menu', 'essence-pro' );
	$menu_args = [
		'theme_location' => 'off-screen',
		'depth'          => 1,
		'fallback_cb'    => false,
	];

	if ( genesis_is_amp() ) {
		?>
		<amp-lightbox id="off-screen-lightbox" class="off-screen-menu off-screen-content" layout="nodisplay" scrollable>
			<div class="off-screen-container">
				<div class="off-screen-wrapper">
					<div class="wrap">
						<button class="lightbox toggle-off-screen-menu-area close" on="tap:off-screen-lightbox.close"><span class="screen-reader-text"><?php echo esc_html( $hide_text ); ?></span>X</button>
						<?php genesis_nav_menu( $menu_args ); ?>
					</div>
				</div>
			</div>
		</amp-lightbox>
		<div class="header-right">
			<button class="off-screen-item toggle-off-screen-menu-area" on="tap:off-screen-lightbox"><i class="icon ion-md-menu"></i> <?php echo esc_html( $menu_text ); ?></button>
		</div>
		<?php
	} else {
		?>
		<div class="off-screen-menu off-screen-content">
			<div class="off-screen-container">
				<div class="off-screen-wrapper">
					<div class="wrap">
						<button class="toggle-off-screen-menu-area close"><span class="screen-reader-text"><?php echo esc_html( $menu_text ); ?></span>X</button>
						<?php genesis_nav_menu( $menu_args ); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="header-right">
			<button class="off-screen-item toggle-off-screen-menu-area"><i
						class="icon ion-md-menu"></i> <?php echo esc_html( $menu_text ); ?></button>
		</div>
		<?php
	}

}


add_action( 'genesis_header', 'essence_header_left_widget', 9 );
/**
 * Adds header-right search area to header.
 *
 * @since 1.0.0
 */
// Inside essence_header_left_widget() function or any suitable location
function essence_header_left_widget() {
    echo '<div class="header-right">';
    /* get_search_form();*/
    essence_donation_cart();
    echo '</div>';
}
add_action( 'genesis_header', 'essence_header_left_widget', 9 );

add_filter( 'body_class', 'essence_header_menu_body_class' );
/**
 * Defines the header-menu body class.
 *
 * @since 1.0.0
 *
 * @param array $classes Classes array.
 * @return array $classes Updated class array.
 */
function essence_header_menu_body_class( $classes ) {

	$menu_locations = get_theme_mod( 'nav_menu_locations' );

	if ( ! empty( $menu_locations['primary'] ) ) {
		$classes[] = 'header-menu';
	}

	return $classes;

}

add_filter( 'body_class', 'essence_no_off_screen_menu_body_class' );
/**
 * Defines the no-off-screen-menu body class.
 *
 * @since 1.0.0
 *
 * @param array $classes Classes array.
 * @return array $classes Updated class array.
 */
function essence_no_off_screen_menu_body_class( $classes ) {

	if ( ! has_nav_menu( 'off-screen' ) ) {
		$classes[] = 'no-off-screen-menu';
	}

	return $classes;

}

add_filter( 'genesis_customizer_theme_settings_config', 'essence_remove_customizer_settings' );
/**
 * Removes output of genesis header settings in the Customizer.
 *
 * @since 1.0.0
 *
 * @param array $config Original Customizer items.
 * @return array Filtered Customizer items.
 */
function essence_remove_customizer_settings( $config ) {

	unset( $config['genesis']['sections']['genesis_header'] );
	return $config;

}

/**
 * Modifies the default CSS output for custom-header.
 *
 * @since 1.0.0
 */
function essence_header_style() {

	$output   = '';
	$bg_image = '';

	$is_woocommerce_shop_or_product = class_exists( 'WooCommerce' ) && ( is_post_type_archive( 'product' ) || is_singular( 'product' ) );
	$is_woocommerce_archive         = class_exists( 'WooCommerce' ) && ( is_product_category() || is_product_tag() );

	if ( has_post_thumbnail() && is_singular() && ! is_singular( 'product' ) ) {
		$bg_image = genesis_get_image(
			[
				'format' => 'url',
				'size'   => 'header-hero',
			]
		);
	} elseif ( $is_woocommerce_shop_or_product || $is_woocommerce_archive ) {
		$bg_image = genesis_get_image(
			[
				'format'  => 'url',
				'size'    => 'header-hero',
				'post_id' => wc_get_page_id( 'shop' ),
			]
		);
	}

	if ( ! $bg_image ) {
		$bg_image = get_header_image();
	}

	if ( $bg_image ) {
		$output = '<style type="text/css">.header-hero { background-image: linear-gradient(0deg, rgba(0,0,0,0.5) 50%, rgba(0,0,0,0.85) 100%), url(' . esc_url( $bg_image ) . '); }</style>';
	}

	echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}