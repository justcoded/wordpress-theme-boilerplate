<?php
/**
 * The template for displaying homepage.
 */

use Boilerplate\Theme\Models\Homepage;

/* @var \JustCoded\WP\Framework\Web\View $this */

$this->extends( 'layouts/main' );

$model = new Homepage();
?>

<?php while ( $model->hero_query->have_posts() ) : $model->hero_query->the_post(); ?>
	<?php $this->include( 'page/_front-hero' ); ?>
<?php endwhile; ?>

<?php if ( is_active_sidebar( 'homepage-bottom' ) ) : ?>
	<aside class="homepage-bottom widget-area" role="complementary">
		<?php dynamic_sidebar( 'homepage-bottom' ); ?>
	</aside>
<?php endif; ?>

