<?php
/**
 * The template for displaying all single posts.
 */

use JustCoded\WP\Framework\Web\View;

View::layout_open(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php View::render( 'post/_content-single' ); ?>

		<?php the_post_navigation(); ?>

		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template( '/views/post/_comments.php' );
		}
		?>

	<?php endwhile; // End of the loop. ?>

<?php View::layout_close();
