<?php
/**
 * The template for displaying CPT Example
 */

use JustCoded\WP\Framework\Objects\Postmeta;

/* @var \JustCoded\WP\Framework\Web\View $this */

// get custom fields data
$fields = new Postmeta();

$this->extends( 'layouts/main' ); ?>

	<h1><?php the_title(); ?></h1>
	<div>
		<?php
		// print custom field position, if it exists
		if ( $fields->position ) : ?>
		<h3><?php echo $fields->position; ?></h3>
		<?php endif; ?>
		<?php
		// print custom field bio, if it exists
		if ( $fields->bio ) : ?>
			<h3><?php echo $fields->bio; ?></h3>
		<?php endif; ?>
	</div>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php $this->render( 'employee/_content', array(
			'referer' => 'employee-single',
		) ); ?>

	<?php endwhile; // End of the loop. ?>
