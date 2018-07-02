<?php
/**
 * The template for displaying homepage.
 */

use Boilerplate\Theme\Models\Homepage;

/* @var \JustCoded\WP\Framework\Web\View $this */

$this->extends( 'layouts/main' );

?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php the_content(); ?>

<?php endwhile; // End of the loop. ?>



