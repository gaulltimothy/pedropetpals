/**
 * Adds Genesis layout and WordPress page template classes to the Block Editor admin.
 *
 * @package Essence\JS
 * @author StudioPress
 * @license GPL-2.0-or-later
 * @since 1.2.0
 */
var studiopress = studiopress || {};

/**
 * Adds classes to the block editor admin to help match layout widths based
 * on the chosen page template and Genesis layout.
 *
 * Runs automatically when added via `enqueue_block_editor_assets`.
 * Depends on a global `studiopressConfig` object with a `defaultLayout`
 * property that returns `genesis_get_default_layout()`.
 *
 * See `lib/gutenberg/init.php` to learn more.
 */
studiopress.blockClasses = {

	// The prefix to use for page template classes.
	templateClassPrefix: 'page-template-',

	// The prefix to use for Genesis layout classes.
	layoutClassPrefix: 'genesis-layout-',

	/**
	 * The element to add classes to.
	 *
	 * Note that adding a class to the body element directly causes issues
	 * when using `add_editor_style()`, because of the way the Block Editor
	 * inlines and auto-prefixes styles in the `style-editor.css` stylesheet.
	 * We therefore add the class to an element lower down instead.
	 * This allows us to use selectors such as `.genesis-content-sidebar .wp-block[data-align="wide"]`.
	 */
	elementToAddClassTo: '.editor-writing-flow',

	/**
	 * Gets the layout class from the Genesis layout selector.
	 *
	 * @since 1.2.0
	 */
	getLayoutClass: function() {
		var layoutList = document.querySelectorAll( '.genesis-layout-selector input' );
		var layout = '';
		var i = 0;
		for ( i, len = layoutList.length; i < len; i++ ) {
			if ( layoutList[i].checked ) {
				layout = layoutList[i].getAttribute( 'id' );
				break;
			}
		}
		if ( 'default-layout' === layout ) {
			layout = studiopressConfig.defaultLayout;
		}
		return layout;
	},

	/**
	 * Gets the template class from the block editor template panel.
	 *
	 * @since 1.2.0
	 */
	getTemplateClass: function() {
		var templateSelect = document.querySelector( '.editor-page-attributes__template .components-select-control__input' );
		var currentTemplate = templateSelect.options[templateSelect.selectedIndex]
											.value
											.replace( /.php|page_|page-templates\//gi, '' );

		if ( ! currentTemplate ) {
			currentTemplate = 'default';
		}

		return currentTemplate;
	},

	/**
	 * Replaces any classes with a given prefix with the supplied class and prefix.
	 *
	 * Will add the class to the `elementToAddClassTo` element.
	 *
	 * @since 1.2.0
	 */
	updateClass: function( theClass, prefix ) {
		var rootElement = document.querySelector( studiopress.blockClasses.elementToAddClassTo );
		var classes = rootElement.classList;

		if ( classes ) {

			// Ensure there is only one class with a
			// templateClassPrefix or layoutClassPrefix.
			classes.forEach( function( c ) {
				if ( c.includes( prefix ) ) {
					rootElement.classList.remove( c );
				}
			});

		}

		rootElement.classList.add( prefix + theClass );
	},

	/**
	 * Gets and updates the layout class.
	 *
	 * @since 1.2.0
	 */
	updateLayoutClass: function() {
		var layout = studiopress.blockClasses.getLayoutClass();
		if ( layout ) {
			studiopress.blockClasses.updateClass( layout, studiopress.blockClasses.layoutClassPrefix );
		}
	},

	/**
	 * Gets and updates the template class.
	 *
	 * @since 1.2.0
	 */
	updateTemplateClass: function() {
		var template = studiopress.blockClasses.getTemplateClass();
		if ( template ) {
			studiopress.blockClasses.updateClass( template, studiopress.blockClasses.templateClassPrefix );
		}
	}

};

/**
 * Sets the classes when the admin page is ready.
 *
 * Updates the classes if a new page template or Genesis layout is selected.
 */
wp.domReady( function() {
	var templates = document.querySelector( '.editor-page-attributes__template .components-select-control__input' );
	var layouts = document.querySelector( '.genesis-layout-selector' );

	if ( layouts ) {
		studiopress.blockClasses.updateLayoutClass();
		layouts.addEventListener( 'input', function() {
			studiopress.blockClasses.updateLayoutClass();
		});
	}

	if ( templates ) {
		studiopress.blockClasses.updateTemplateClass();
		templates.addEventListener( 'input', function( e ) {
			studiopress.blockClasses.updateTemplateClass();
		});
	}
});
