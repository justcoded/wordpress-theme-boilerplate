<?php
/**
 * The template for displaying search results pages.
 *
 * @var \JustCoded\WP\Framework\Web\View $this
 */

$this->extends( 'layouts/main' ); ?>

<?php if ( have_posts() ) : ?>

	<header class="page-header">
		<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'boilerplate' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	</header><!-- .page-header -->

	<?php
	/* Start the Loop */
	while ( have_posts() ) :
		the_post();

		$this->include( 'search/_item' );

	endwhile;

	the_posts_navigation();
	?>

<?php else : ?>

	<?php $this->include( 'search/_nothing' ); ?>

<?php endif; ?>
