<?php
/**
 * The template for displaying Blog page.
 *
 * @var \JustCoded\WP\Framework\Web\View $this
 */

$this->extends( 'layouts/main' ); ?>

<h1>Our blog</h1>

<?php
while ( have_posts() ) :
	the_post();

	$this->include( 'post/_content' );
endwhile; // End of the loop.

the_posts_navigation();
