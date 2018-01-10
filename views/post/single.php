<?php
/**
 * The template for displaying all single posts.
 */

/* @var \JustCoded\WP\Framework\Web\View $this */

$this->extends( 'layouts/main' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php $this->include( 'post/_content-single' ); ?>

		<?php the_post_navigation(); ?>

		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template( '/views/post/_comments.php' );
		}
		?>

	<?php endwhile; // End of the loop. ?>
