<?php
/**
 * The template for displaying custom taxonomy pages.
 */

use JustCoded\WP\Framework\Web\View;

View::layout_open(); ?>

	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php View::render( 'cpt_example/_content' ); ?>

		<?php endwhile; ?>

		<?php the_posts_navigation(); ?>

	<?php else : ?>

		<?php View::render( 'search/_nothing' ); ?>

	<?php endif; ?>

<?php View::layout_close(); ?>
