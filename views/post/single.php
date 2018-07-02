<?php
/**
 * The template for displaying all single posts.
 */

/* @var \JustCoded\WP\Framework\Web\View $this */

$this->extends( 'layouts/main' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php $this->include( 'post/_content-single' ); ?>



	<?php endwhile; // End of the loop. ?>
