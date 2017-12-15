<?php
/**
 * The template for displaying CPT Example
 */

/* @var \JustCoded\WP\Framework\Web\View $this */

$this->extends( 'layouts/main' ); ?>

	<h1>This is an example of custom post type single template</h1>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php $this->render( 'cpt_example/_content', array(
			'referer' => 'cpt_example-single',
		) ); ?>

	<?php endwhile; // End of the loop. ?>
