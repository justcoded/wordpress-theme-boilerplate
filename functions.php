<?php
/**
 * JustCoded Theme Boilerplate functions and definitions.
 */

/**
 * We need to check that required plugins are active and installed
 */
require_once get_template_directory() . '/requirements.php';
if ( ! Just_Theme_Framework_Checker::single()->check_requirements() ) {
	// terminate if titan plugin is not activated.
	return;
}

require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/hooks.php';
require_once get_template_directory() . '/inc/template-funcs.php';

/**
 * Wrap theme start code into a function to be able to use child theme.
 * this code will be executed inside child theme.
 */
if ( ! function_exists( 'boilerplate_theme_starter' ) ) {
	/**
	 * Theme launcher function
	 */
	function boilerplate_theme_starter() {
		new \JustCoded\WP\Framework\Autoload( 'Boilerplate\Theme', get_template_directory() . '/app' );

		$theme = \Boilerplate\Theme\Theme::instance();
	}
}

/**
 * Finally run our Theme setup
 * and ThemeOptions setup
 */
boilerplate_theme_starter();
