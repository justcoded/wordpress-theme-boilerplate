<?php
/**
 * The template for displaying homepage.
 */

use JustCoded\WP\Framework\Web\View;
use Boilerplate\Theme\Models\Homepage;

$model = new Homepage();

View::layout_open(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php View::render( 'page/_content', array(
				'headline' => $model->field_headline,
		) ); ?>

	<?php endwhile; // End of the loop. ?>

	<?php if ( is_active_sidebar( 'homepage-bottom' ) ) : ?>
		<aside class="homepage-bottom widget-area" role="complementary">
			<?php dynamic_sidebar( 'homepage-bottom' ); ?>
		</aside>
	<?php endif; ?>

<?php View::layout_close(); ?>
