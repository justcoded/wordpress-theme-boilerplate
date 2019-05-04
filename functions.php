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

$theme = \JustCoded\WP\Framework\Theme_Starter\Theme_Starter::instance();

if ( ! $theme->is_theme_created() ) {
	$theme->start_theme( 'boilerplate_namespace' );
}
