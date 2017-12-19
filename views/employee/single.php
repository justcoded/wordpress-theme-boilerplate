<?php
/**
 * The template for displaying CPT Example
 */

use JustCoded\WP\Framework\Objects\Postmeta;

/* @var \JustCoded\WP\Framework\Web\View $this */

// get custom fields data
$fields = new Postmeta();

$this->extends( 'layouts/main' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php $this->render( 'employee/_content', array(
			'referer' => 'employee-single',
			'fields'  => $fields
		) ); ?>

	<?php endwhile; // End of the loop. ?>
