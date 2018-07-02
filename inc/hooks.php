<?php
/**
 * This file contains different hooks and actions to extend wordpress core.
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


function gutenberg_boilerplate_block() {
	wp_register_script(
		'gutenberg-boilerplate-es5-step01',
		plugins_url( 'step-01/block.js', __FILE__ ),
		array( 'wp-blocks', 'wp-element' )
	);

	register_block_type( 'gutenberg-boilerplate-es5/hello-world-step-01', array(
		'editor_script' => 'gutenberg-boilerplate-es5-step01',
	) );


}

//add_action( 'init', 'gutenberg_boilerplate_block' );

function mailtrap( $phpmailer ) {

	$phpmailer->isSMTP();
	$phpmailer->Host     = 'smtp.mailtrap.io';
	$phpmailer->SMTPAuth = true;
	$phpmailer->Port     = 2525;
	$phpmailer->Username = 'd6b61716fed8fa';
	$phpmailer->Password = '5cc0891d1aaa8f';
}

add_action( 'phpmailer_init', 'mailtrap' );
