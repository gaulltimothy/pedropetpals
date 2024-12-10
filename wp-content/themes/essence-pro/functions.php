<?php
/**
 * Essence Pro.
 *
 * This file adds functions to the Essence Pro Theme.
 *
 * @package Essence_Pro
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/essence/
 */

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

add_action( 'after_setup_theme', 'essence_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function essence_localization_setup() {

	load_child_theme_textdomain( genesis_get_theme_handle(), get_stylesheet_directory() . '/languages' );

}

// Adds the theme helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds the theme title functions.
require_once get_stylesheet_directory() . '/lib/header-functions.php';

// Adds the theme title functions.
require_once get_stylesheet_directory() . '/lib/title-functions.php';

// Adds image upload and color select to WordPress Theme Customizer.
require_once get_stylesheet_directory() . '/lib/customizer/customize.php';

// Includes customizer CSS.
require_once get_stylesheet_directory() . '/lib/customizer/output.php';

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Includes the customizer CSS for the WooCommerce plugin.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Includes notice to install Genesis Connect for WooCommerce.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

add_action( 'after_setup_theme', 'essence_theme_support', 1 );
/**
 * Add desired theme supports.
 *
 * See config file at `config/theme-supports.php`.
 *
 * @since 1.3.0
 */
function essence_theme_support() {

	$theme_supports = genesis_get_config( 'theme-supports' );

	foreach ( $theme_supports as $feature => $args ) {
		add_theme_support( $feature, $args );
	}

}

add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * Allows plugins to remove support if required.
 *
 * @since 1.1.0
 */
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.

	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';

}

// Registers the responsive menus.
if ( function_exists( 'genesis_register_responsive_menus' ) ) {
	genesis_register_responsive_menus( genesis_get_config( 'responsive-menus' ) );
}

add_filter( 'body_class', 'essence_body_classes' );
/**
 * Add additional classes to the body element.
 *
 * @since 1.5.1
 *
 * @param array $classes Classes array.
 * @return array $classes Updated class array.
 */
function essence_body_classes( $classes ) {

	if ( ! genesis_is_amp() ) {
		// Add 'no-js' class to the body class values.
		$classes[] = 'no-js';
	}
	return $classes;

}

add_action( 'genesis_before', 'essence_js_nojs_script', 1 );
/**
 * Echo out the script that changes 'no-js' class to 'js'.
 *
 * @since 1.5.1
 */
function essence_js_nojs_script() {

	if ( genesis_is_amp() ) {
		return;
	}

	?>
	<script>
	//<![CDATA[
	(function(){
		var c = document.body.classList;
		c.remove( 'no-js' );
		c.add( 'js' );
	})();
	//]]>
	</script>
	<?php
}

add_action( 'wp_enqueue_scripts', 'essence_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function essence_enqueue_scripts_styles() {

	wp_enqueue_style(
		genesis_get_theme_handle() . '-fonts',
		'https://fonts.googleapis.com/css?family=Alegreya+Sans:400,400i,700|Lora:400,700&display=swap',
		[],
		genesis_get_theme_version()
	);

	wp_enqueue_style(
		'ionicons',
		'https://unpkg.com/ionicons@4.1.2/dist/css/ionicons.min.css',
		[],
		genesis_get_theme_version()
	);

	if ( genesis_is_amp() ) {
		wp_enqueue_style(
			genesis_get_theme_handle() . '-amp',
			get_stylesheet_directory_uri() . '/lib/amp/amp.css',
			[ genesis_get_theme_handle() ],
			genesis_get_theme_version()
		);

		return; // Load no further scripts and styles on AMP pages.
	}

	wp_enqueue_script(
		'global-js',
		get_stylesheet_directory_uri() . '/js/global.js',
		[ 'jquery' ],
		genesis_get_theme_version(),
		true
	);

}

add_filter( 'wp_resource_hints', 'essence_resource_hints', 10, 2 );
/**
 * Add preconnect for Google Fonts.
 *
 * @since 1.5.1
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function essence_resource_hints( $urls, $relation_type ) {

	if ( wp_style_is( genesis_get_theme_handle() . '-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = [
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		];
	}

	return $urls;
}

// Registers default header image.
register_default_headers(
	[
		'child' => [
			'url'           => essence_get_default_hero_background_image(),
			'thumbnail_url' => essence_get_default_hero_background_image(),
			'description'   => __( 'Essence Header Image', 'essence-pro' ),
		],
	]
);

// Adds image sizes.
add_image_size( 'sidebar-featured-thumb', 70, 60, true );
add_image_size( 'featured-image', 800, 400, true );
add_image_size( 'header-hero', 1600, 800, true );

add_filter( 'image_size_names_choose', 'essence_media_library_sizes' );
/**
 * Adds image sizes to Media Library.
 *
 * @since 1.0.0
 *
 * @param array $sizes Array of image sizes and their names.
 * @return array The modified list of sizes.
 */
function essence_media_library_sizes( $sizes ) {

	$sizes['featured-image'] = __( 'Block Featured Image', 'essence-pro' );
	return $sizes;

}

// Removes header right widget area.
unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Registers default layout.
genesis_set_default_layout( 'full-width-content' );

add_filter( 'genesis_skip_links_output', 'essence_content_skip_links_output' );
/**
 * Changes the target of the "Skip to content" skip link.
 *
 * @since 1.0.0
 *
 * @param array $links The list of skip links.
 * @return array $links The modified list of skip links.
 */
function essence_content_skip_links_output( $links ) {

	unset( $links['genesis-content'] );

	$new_links = $links;
	array_splice( $new_links, 1 );

	$new_links['hero-page-title'] = __( 'Skip to content', 'essence-pro' );

	return array_merge( $new_links, $links );

}

add_filter( 'genesis_skip_links_output', 'essence_skip_links_output' );
/**
 * Removes skip link for primary navigation and adds skip link for footer widgets.
 *
 * @since 1.0.0
 *
 * @param array $links The list of skip links.
 * @return array $links The modified list of skip links.
 */
function essence_skip_links_output( $links ) {

	if ( isset( $links['genesis-nav-primary'] ) ) {
		unset( $links['genesis-nav-primary'] );
	}

	$new_links = $links;
	array_splice( $new_links, 3 );

	if ( is_active_sidebar( 'after-content-featured' ) ) {
		$new_links['after-content-featured'] = __( 'Skip to footer', 'essence-pro' );
	}

	return array_merge( $new_links, $links );

}

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 13 );

// Repositions the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

add_filter( 'wp_nav_menu_args', 'essence_secondary_menu_args' );
/**
 * Reduces the secondary navigation menu to one level depth.
 *
 * @since 1.0.0
 *
 * @param array $args The WP navigation menu arguments.
 * @return array The modified menu arguments.
 */
function essence_secondary_menu_args( $args ) {

	if ( 'secondary' === $args['theme_location'] ) {
		$args['depth'] = 1;
	}

	return $args;

}

add_filter( 'genesis_search_text', 'essence_search_button_text' );
/**
 * Changes search form placeholder text.
 *
 * @since 1.0.0
 *
 * @param string $text The search form placeholder text.
 * @return string The modified search form placeholder text.
 */
function essence_search_button_text( $text ) {

	return esc_attr( 'Search' );

}

add_filter( 'get_the_content_limit', 'essence_content_limit_read_more_markup', 10, 3 );
/**
 * Modifies the generic more link markup for posts.
 *
 * @since 1.0.0
 *
 * @param string $output The current full HTML.
 * @param string $content The content HTML.
 * @param string $link The link HTML.
 * @return string The new more link HTML.
 */
function essence_content_limit_read_more_markup( $output, $content, $link ) {

	if ( is_page_template( 'page_blog.php' ) || is_home() || is_archive() || is_search() ) {
		$link = sprintf( '<a href="%s" class="more-link button text">%s</a>', get_the_permalink(), genesis_a11y_more_link( __( 'Continue Reading', 'essence-pro' ) ) );
	}

	$output = sprintf( '<p>%s &#x02026;</p><p class="more-link-wrap">%s</p>', $content, str_replace( '&#x02026;', '', $link ) );

	return $output;

}

add_filter( 'genesis_author_box_gravatar_size', 'essence_author_box_gravatar' );
/**
 * Modifies the size of the Gravatar in the author box.
 *
 * @since 1.0.0
 *
 * @param int $size Current Gravatar size.
 * @return int New size.
 */
function essence_author_box_gravatar( $size ) {

	return 90;

}

add_filter( 'genesis_comment_list_args', 'essence_comments_gravatar' );
/**
 * Modifies the size of the Gravatar in the entry comments.
 *
 * @since 1.0.0
 *
 * @param array $args The comment list arguments.
 * @return array Arguments with new avatar size.
 */
function essence_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;
	return $args;

}

// Moves image above post title.
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 1 );

// Repositions the breadcrumbs.
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs', 90 );

// Removes the entry footer.
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

add_filter( 'genesis_post_info', 'essence_modify_post_info' );
/**
 * Modifies the meta information in the entry header.
 *
 * @since 1.0.0
 *
 * @param string $post_info Current post info.
 * @return string New post info.
 */
function essence_modify_post_info( $post_info ) {

	global $post;

	setup_postdata( $post );

	if ( is_single() ) {
		$post_info = '[post_categories before="" after=" &#47;"] [post_date] <i class="byline">' . __( 'by', 'essence-pro' ) . '</i> [post_author_posts_link] [post_comments before="&#47; "] [post_edit]';
	} else {
		$post_info = '[post_categories before=""]';
	}
	return $post_info;

}

add_filter( 'genesis_customizer_theme_settings_config', 'essence_remove_entry_meta_settings' );
/**
 * Remove Entry Meta options from the Customizer.
 *
 * Shortcodes such as `[post_author_posts_link]` do not currently work outside
 * of the loop. See https://github.com/studiopress/genesis/issues/2550.
 *
 * @param array $config The default Theme Settings config.
 * @return array Config with sections removed.
 */
function essence_remove_entry_meta_settings( $config ) {

	unset( $config['genesis']['sections']['genesis_single']['controls']['entry_meta_before_content'] );
	unset( $config['genesis']['sections']['genesis_single']['controls']['entry_meta_after_content'] );

	return $config;

}

add_filter( 'comment_author_says_text', 'essence_comment_author_says_text' );
/**
 * Modifies the author says text in comments.
 *
 * @since 1.0.0
 *
 * @return string New author says text.
 */
function essence_comment_author_says_text() {

	return '';

}

/**
 * Counts used widgets in given sidebar.
 *
 * @since 1.0.0
 *
 * @param string $id The sidebar ID.
 * @return int|void The number of widgets, or nothing.
 */
function essence_count_widgets( $id ) {

	$sidebars_widgets = wp_get_sidebars_widgets();

	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}

}

/**
 * Gives class name based on widget count.
 *
 * @since 1.0.0
 *
 * @param string $id The widget ID.
 * @return string The class.
 */
function essence_widget_area_class( $id ) {

	$count = essence_count_widgets( $id );

	$class = '';

	if ( 1 === $count ) {
		$class .= ' widget-full';
	} elseif ( 0 === $count % 3 ) {
		$class .= ' widget-thirds';
	} elseif ( 0 === $count % 4 ) {
		$class .= ' widget-fourths';
	} elseif ( 1 === $count % 2 ) {
		$class .= ' widget-halves uneven';
	} else {
		$class .= ' widget-halves';
	}

	return $class;

}

/**
 * Helper function to handle outputting widget markup and classes.
 *
 * @since 1.0.0
 *
 * @param string $id The id of the widget area.
 */
function essence_do_widget( $id ) {

	$count   = essence_count_widgets( $id );
	$columns = essence_widget_area_class( $id );

	genesis_widget_area(
		$id,
		[
			'before' => "<div id=\"$id\" class=\"$id\"><div class=\"flexible-widgets widget-area $columns\"><div class=\"wrap\">",
			'after'  => '</div></div></div>',
		]
	);

}

add_action( 'genesis_before_footer', 'essence_after_content_featured', 13 );
/**
 * Adds a flexible featured widget area above the footer.
 *
 * @since 1.0.0
 */
function essence_after_content_featured() {

	if ( is_active_sidebar( 'after-content-featured' ) ) {
		echo '<h2 class="screen-reader-text">' . esc_html__( 'More Content', 'essence-pro' ) . '</h2>';
		essence_do_widget( 'after-content-featured' );
	}

}

add_action( 'genesis_before_footer', 'essence_front_quote_widget', 15 );
/**
 * Adds the before footer widget area.
 *
 * @since 1.0.0
 */
function essence_front_quote_widget() {

	if ( ! is_front_page() ) {
		return;
	}

	if ( is_active_sidebar( 'front-page-featured' ) ) {
		essence_do_widget( 'front-page-featured' );
	}

}

add_action( 'genesis_before_footer', 'essence_footer_cta', 17 );
/**
 * Adds the above footer widget area.
 *
 * @since 1.0.0
 */
function essence_footer_cta() {

	genesis_widget_area(
		'footer-cta',
		[
			'before' => '<div id="footer-cta" class="footer-cta"><div class="wrap"><div class="widget-area">',
			'after'  => '</div></div></div>',
		]
	);

}

add_action( 'after_setup_theme', 'essence_widget_areas' );
/**
 * Registers essence widget areas.
 *
 * @since 1.5.1
 */
function essence_widget_areas() {

	// Registers widget areas.
	genesis_register_sidebar(
		[
			'id'          => 'after-content-featured',
			'name'        => __( 'After Content Featured', 'essence-pro' ),
			'description' => __( 'This is the featured section that displays after the content area.', 'essence-pro' ),
		]
	);
	genesis_register_sidebar(
		[
			'id'          => 'front-page-featured',
			'name'        => __( 'Front Page Featured', 'essence-pro' ),
			'description' => __( 'This is the front page featured section.', 'essence-pro' ),
		]
	);
	genesis_register_sidebar(
		[
			'id'          => 'footer-cta',
			'name'        => __( 'Footer CTA', 'essence-pro' ),
			'description' => __( 'This is the call to action section above the footer.', 'essence-pro' ),
		]
	);
	function custom_disclosure_shortcode() {
    $disclosure = '<div class="custom-disclosure">
        <h2>Contribution Rules</h2>
        <ol>
            <li>I am a U.S. citizen or lawfully admitted permanent resident (i.e., green card holder).</li>
            <li>This contribution is made from my own funds, and funds are not being provided to me by another person or entity for the purpose of making this contribution.</li>
            <li>I am at least eighteen years old.</li>
            <li>I am not a federal contractor.</li>
            <li>I am making this contribution with my own personal credit card and not with a corporate or business credit card or a card issued to another person.</li>
        </ol>
        <p>Contributions are not tax deductible for federal income tax purposes. Your contribution may be used in connection with federal elections and is subject to the limitations and prohibitions of the Federal Election Campaign Act and the Kentucky Registry of Election Finance. Federal law also requires us to use our best efforts to collect and report the name, mailing address, occupation, and name of employer of individuals whose contributions exceed $200 in a calendar year.</p>
        <p>By proceeding with this transaction, you agree to the LGBTQIA Council for Kentucky Democrats’ terms & conditions.</p>
    </div>';

    return wp_kses_post($disclosure);
}
add_shortcode('custom_disclosure', 'custom_disclosure_shortcode');

}
/* Add Cart Functionality to the Top Right Corner of the Site */
/* remainder of this code is in the header-functions.php file in the lib */
function essence_donation_cart() {
    $cart_count = WC()->cart->get_cart_contents_count();
    ?>
    <div class="donation-cart-wrapper">
        <a href="javascript:void(0);" class="donation-cart-link">
            <i class="ion-ios-heart"></i>
            <?php if ( $cart_count > 0 ) : ?>
               <span class="cart-counter"><?php echo $cart_count; ?></span>
            <?php endif; ?>
        </a>
        <div class="donation-cart-dropdown">
            <?php if ( $cart_count > 0 ) : ?>
                <ul class="cart-items">
					<h3>
						Your Cart
					</h3>
                    <?php foreach ( WC()->cart->get_cart() as $cart_item ) : ?>
                        <li class="cart-item">
                            <?php echo $cart_item['quantity']; ?> x <?php echo $cart_item['data']->get_name(); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p class="cart-total"><?php _e( 'Total:', 'woocommerce' ); ?> <?php echo WC()->cart->get_cart_total(); ?></p>
				<p class="proceed-to-contribute">
                     <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button secondary"><?php _e( 'Review Cart', 'woocommerce' ); ?></a> or <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button spectrumCta"><?php _e( 'Proceed to Contribute', 'woocommerce' ); ?></a>
                </p>
            <?php else : ?>
                <p class="empty-cart">
                    <?php 
                        echo wp_kses_post(
                            sprintf(
                                __( 'Your cart is currently empty. Become a part of our mission.', 'woocommerce'),
                            )
                        ); 
                    ?>
                </p>
			<p class="empty-cart">
                    <?php 
                        echo wp_kses_post(
                            sprintf(
                                __( '<a class="button spectrumCta" href="%s">Join the Council</a>  <em>or</em>  <a class="button secondary" href="%s">Log in</a>.', 'woocommerce' ),
                                esc_url('/join-the-council'),
                                esc_url('/my-account')
                            )
                        ); 
                    ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
    <?php
}


