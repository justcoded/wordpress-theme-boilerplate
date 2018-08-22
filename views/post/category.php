<?php
/**
 * The template for displaying category pages.
 *
 * @var \JustCoded\WP\Framework\Web\View $this
 */

$this->extends( 'layouts/main' ); ?>

<?php if ( have_posts() ) : ?>

	<header class="page-header">
		<?php
		the_archive_title( '<h1 class="page-title category-title">', '</h1>' );
		the_archive_description( '<div class="taxonomy-description">', '</div>' );
		?>
	</header><!-- .page-header -->

	<?php
	/* Start the Loop */
	while ( have_posts() ) :
		the_post();

		$this->include( 'post/_content' );

	endwhile;

	the_posts_navigation();
	?>

<?php else : ?>

	<?php $this->include( 'search/_nothing' ); ?>

<?php endif; ?>
