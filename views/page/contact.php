<?php
/**
 * Template Name: Contact Example
 */
use JustCoded\WP\Framework\Web\View;

View::extends('main'); ?>

<h1>This is an example of custom page template</h1>
<?php while ( have_posts() ) : the_post(); ?>

	<?php View::render( 'page/_content', array(
		'referrer' => 'contact',
	) ); ?>

<?php endwhile; // End of the loop. ?>

