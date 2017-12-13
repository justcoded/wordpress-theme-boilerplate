<?php
/**
 * The template for displaying Blog page.
 */

use JustCoded\WP\Framework\Web\View;

View::extends( 'layouts/main' ); ?>

	<h1>Our blog</h1>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php View::render( 'post/_content' ); ?>

	<?php endwhile; // End of the loop. ?>

	<?php the_posts_navigation(); ?>
