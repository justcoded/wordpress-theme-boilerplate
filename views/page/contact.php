<?php
/**
 * Template Name: Contact Example
 *
 * @var \JustCoded\WP\Framework\Web\View $this
 */

$this->extends( 'layouts/main' );
?>

<h1>This is an example of custom page template</h1>
<?php
/* Start the Loop */
while ( have_posts() ) :
	the_post();

	$this->include( 'page/_content' );

endwhile;
?>
