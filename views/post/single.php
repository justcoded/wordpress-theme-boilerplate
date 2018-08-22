<?php
/**
 * The template for displaying all single posts.
 *
 * @var \JustCoded\WP\Framework\Web\View $this
 */

$this->extends( 'layouts/main' ); ?>

<?php
while ( have_posts() ) :
	the_post();

	$this->include( 'post/_content-single' );

	the_post_navigation();


	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template( '/views/post/_comments.php' );
	}

endwhile; // End of the loop.
