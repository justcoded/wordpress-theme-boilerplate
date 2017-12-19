<?php
/**
 * The template for displaying custom taxonomy pages.
 */

use JustCoded\WP\Framework\Objects\Termmeta;

/* @var \JustCoded\WP\Framework\Web\View $this */

// get custom fields data
$fields = new Termmeta();

$this->extends( 'layouts/main' ); ?>

	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->

		<div>
			<?php
			// print custom field department, if it exists
			if ( $fields->department ) : ?>
				<h3><?php echo $fields->department; ?></h3>
			<?php endif; ?>
			<?php
			// print custom field floor, if it exists
			if ( $fields->floor ) : ?>
				<h3><?php echo $fields->floor; ?></h3>
			<?php endif; ?>
		</div>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php $this->render( 'employee/_content' ); ?>

		<?php endwhile; ?>

		<?php the_posts_navigation(); ?>

	<?php else : ?>

		<?php $this->render( 'search/_nothing' ); ?>

	<?php endif; ?>
