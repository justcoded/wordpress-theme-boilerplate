<?php
/**
 * This file contains different hooks and actions to extend WordPress core.
 */


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function boilerplate_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}

add_filter( 'body_class', 'boilerplate_body_classes' );

//Remove emoji
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
