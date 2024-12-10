Essence PRO
https://my.studiopress.com/themes/essence/

INSTALL
1. Upload the Essence Pro theme folder via FTP to your wp-content/themes/ directory. (The Genesis parent theme needs to be in the wp-content/themes/ directory as well.)
2. Go to your WordPress dashboard and select Appearance.
3. Activate the Essence theme.
4. Inside your WordPress dashboard, go to Appearance > Customize and configure the settings to your liking. To set up the theme like the demo, please visit https://my.studiopress.com/documentation/essence-pro-theme/.

WIDGET AREAS
Primary Sidebar - This is the primary sidebar if you are using the Content/Sidebar or Sidebar/Content Site Layout option.
Front Page Featured - This is the front page featured section.
After Content Featured - This is the featured section that displays after the content area.
Footer CTA - This is the call to action section above the footer.
After Entry - This is the after entry section that displays after post content.

DEMO PHOTOS
Woman waving white flag by rawpixel https://unsplash.com/photos/TTXBfTdUOuc
Dreamy Sunset by Denys Nevozhai https://unsplash.com/photos/xcI7f25UQSs
Laptop on a wicker tray by Lauren Mancke https://unsplash.com/photos/xcI7f25UQSs
Two people on Glacier Point by Nathan Shipps https://unsplash.com/photos/HrUwIKrmPm0
Cooking by Penchant Styled https://unsplash.com/photos/lBzXD_JCgzQ
Waiting the Night Watch by Enis Yavuz https://unsplash.com/photos/rVH9D9UvPRs
The Book of Happy by Josh Felise https://unsplash.com/photos/yIMy3ERBc3o
Outfit photo by Toa Heftiba https://unsplash.com/photos/KQ1n6HzSahY
Life begins after coffee by Bruno Cervera https://unsplash.com/photos/yxttqGDs1AQ
Path by Jon Flobrant https://unsplash.com/photos/NEgEJmN3JZo
Communication by rawpixel https://unsplash.com/photos/ArqZgXYqhjU
Tea by rawpixel https://unsplash.com/photos/QPyxcalgVuA
Quiet Morning by Penchant Styled https://unsplash.com/photos/R4gN8Ef0WPc

ICON FONTS
The icons used in the Essence Pro theme are free of copyright and courtesy of http://ionicons.com/.

LOCALIZATION
The Essence Pro theme is translation ready.  More information about the translation process can be found at https://my.studiopress.com/documentation/getting-started/translations/translating-genesis-and-studiopress-themes/
SUPPORT
Please visit http://my.studiopress.com/help/ for theme support.

CHANGELOG

= 1.5.2 =

Fixed: WPForms contact form creation during one-click-theme-setup. Requires WPForms Lite 1.7.6+.

= 1.5.1 =

* Added: no-js/js body classes.
* Added: Implement preconnect for Google Fonts.
* Fixed: CSS to improve content layout shift (CLS) scores and user experience (UX).
* Fixed: Front page button alignment due to WP 5.7.
* Fixed: color accessibility of post meta and footer links.
* Fixed: Register widgets on after_setup_theme to ensure widget headings use accessible headings.
* Changed: Font stack for headings.
* Changed: Optimized default header image.
* Removed: Smooth scroll script in favor of CSS.

= 1.5.0 =

Essence Pro 1.5.0 requires the Genesis Blocks plugin.

* Changed: Install Genesis Blocks in place of Atomic Blocks during one-click theme setup.
* Changed: Updated one-click-theme-setup content to use Genesis Blocks.
* Changed: Updated Editor and front-end styles for Genesis Blocks compatibility.
* Changed: Updated imported pricing table content to display wide width blocks.

= 1.4.0 =

Essence Pro 1.4.0 requires WordPress 5.4 or higher.

* Added: CSS styles for WordPress 5.4 Social Icons.
* Added: Editor styles to ensure theme colors work for inline text colors.
* Changed: Updated one-click theme setup content to include WordPress 5.4 button markup.
* Changed: Editor and front-end styles for WordPress 5.4 compatibility, including link color, buttons, headings, and lists.

= 1.3.1 =
* Changed: WordPress more link bottom margin.
* Fixed: Previous/Next archive navigation display.
* Fixed: Readme file typos.
* Fixed: Ensure WooCommerce custom styles are loaded.

= 1.3.0 =
* Added: HTML5 supports for `scripts` and `styles` available in WordPress 5.3.
* Added: Support for `genesis-lazy-load-images` available in Genesis 3.2.
* Added: WordPress 5.3 alignment classes.
* Changed: Use PHP short array syntax.
* Changed: Move theme supports to `config/theme-supports.php`.
* Changed: Block width CSS for nested blocks.
* Changed: Separator and hr styles to allow for block color options.
* Changed: CSS for image, gallery, and gallery item figcaptions.
* Changed: Spacing between WooCommerce products.
* Changed: Use padding instead of margin on lists.
* Changed: CSS for tables for better consistency between editor and front end and to allow for new WordPress 5.3 settings.
* Removed: Squared button styles in favor of new button block border-radius setting.
* Fixed: Set off-screen menu button color to white to override customizer functions.
* Fixed: `genesis_attributes_nav` deprecation notice.

= 1.2.2 =
* Fixed: header h1 styles on archive pages.

= 1.2.1 =
* Changed: Use .entry-title instead of h1 for hero CSS styles.

= 1.2.0 =
Essence Pro 1.2.0 requires Genesis 3.0 or higher.

* Added: AMP Support.
* Added: Switch from widget-based to block-based homepage content area.
* Added: New customizer settings for front page hero content.
* Added: Import homepage and additional sample pages during One-Click Theme Setup.
* Added: Import sample blog posts with featured image during One-Click Theme Setup if the site is new (WordPress `fresh_site` option is true).
* Added: Set up menus during One-Click Theme Setup. Menu items will point to imported sample content.
* Added: Install and activate dependent plugins WPForms Lite and Atomic Blocks during One-Click Theme Setup.
* Added: Admin layout and template CSS classes.
* Added: JavaScript that controls smooth scrolling for non-AMP pages.
* Added: Create a WPForms form during one-click theme setup and insert a WPForms block on the sample contact page.
* Changed: remove rem CSS units.
* Changed: New: Load configuration with the new genesis_get_config() function from Genesis 2.8.0. (See functions.php and the config/ folder.)
* Changed: Improve speed of Google web font loading with font-display swap. 
* Changed: Block editor color style slugs to allow for better theme interoperability.
* Changed: CSS adjustments and additions, including improved button block styling, WPForms styling, and more.
* Changed: Updated normalize.css to latest version.
* Changed: Updated PHP, CSS, and JavaScript to adhere to WordPress coding standards.
* Changed: Update theme tags to include block-related tags.
* Changed: remove matchHeight script and use CSS flex instead to match heights of WooCommerce product lists.
* Changed: Replace version/handle constants with helper functions from Genesis 3.0: `genesis_get_theme_handle()` and `genesis_get_theme_version()`.
* Fixed: Prevent an issue where the WooCommerce shop page layout could be ignored and fall back to the site default layout on sites that use object caching.
* Removed: Import XML file. Sample pages can be imported when first activating the theme from the Appearance -> Themes area, or by visiting `/wp-admin/admin.php?page=genesis-getting-started` if the theme is already active.
* Removed: `add_theme_support( 'genesis-responsive-viewport' );`. Genesis 3.0 loads the viewport meta tag automatically.

= 1.1.0 =
* Add support for Gutenberg editor styling and opt-in features.
* Improve color and font weight contrast for accessibility.
* Update placeholder text CSS.
* WooCommerce: update list styling in product content and short descriptions.
* Remove unused customize.js script.

= 1.0.2 =
* Adjust layout to allow more than 2 posts to display in the front-page-1 section.
* Fix an issue with category archive description display.
* Show off-screen menu on mobile widths if no header menu is set.

= 1.0.1 =
* Clear mobile menu.
* Change primary menu links border method.

= 1.0.0 =
* Initial release
