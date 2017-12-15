<?php
/**
 * The template for displaying CPT Example
 */

/* @var \JustCoded\WP\Framework\Web\View $this */

$this->extends( 'layouts/main' ); ?>

	<h1><?php the_title(); ?></h1>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php $this->render( 'employee/_content', array(
			'referer' => 'employee-single',
		) ); ?>

	<?php endwhile; // End of the loop. ?>
