<?php
/**
 * Genesis Sample child theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis-sample/
 */

/**
 * Genesis responsive menus settings. (Requires Genesis 3.0+.)
 */
return [
	'script' => [
		'menuIconClass'       => 'ionicons-before ion-ios-menu',
		'menuIconOpenedClass' => 'ionicons-before ion-ios-menu',
		'subMenuIconClass'    => 'ionicons-before ion-ios-arrow-down',
		'menuClasses'         => [
			'combine' => [
				'.nav-primary',
				'.nav-off-screen',
			],
			'others'  => [],
		],
	],
];
