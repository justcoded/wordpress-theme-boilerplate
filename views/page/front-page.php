<?php
/**
 * The template for displaying homepage.
 */

use JustCoded\WP\Framework\Web\View;
use Boilerplate\Theme\Models\Homepage;
View::extends('main');

$model = new Homepage();

?>


	<section id="hero">
		<?php while ( $model->hero_query->have_posts() ) : $model->hero_query->the_post(); ?>
			<?php View::render( 'page/_front-hero' ); ?>
		<?php endwhile; ?>
	</section>

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

