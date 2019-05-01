<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * For example, it can be some kind of date formatters, array sorters, etc.
 */

/**
 * Support previous versions of WordPress.
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
