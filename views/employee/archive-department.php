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
			// print custom field featured_image, if it exists
			if ( $fields->featured_image ) : ?>
				<?php rwd_attachment_image( $fields->featured_image, 'hd', 'img' ); ?>
			<?php endif; ?>
			<?php
			// print custom field subheading, if it exists
			if ( $fields->subheading ) : ?>
				<h3><?php echo $fields->subheading; ?></h3>
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
