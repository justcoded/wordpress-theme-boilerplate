<?php
/**
 * The template for displaying search results pages.
 */

use JustCoded\WP\Framework\Web\View;

View::layout_open(); ?>

	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'boilerplate' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</header><!-- .page-header -->

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php View::render( 'search/_item' ); ?>

		<?php endwhile; ?>

		<?php the_posts_navigation(); ?>

	<?php else : ?>

		<?php View::render( 'search/_nothing' ); ?>

	<?php endif; ?>

<?php View::layout_close(); ?>
