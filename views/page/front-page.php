<?php
/**
 * The template for displaying homepage.
 */

use Boilerplate\Theme\Models\Homepage;

/* @var \JustCoded\WP\Framework\Web\View $this */

$this->extends( 'layouts/main' );

$model = new Homepage();
?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php $this->render( 'page/_content', array(
			'headline' => $model->field_headline,
	) ); ?>

<?php endwhile; // End of the loop. ?>

<?php if ( is_active_sidebar( 'homepage-bottom' ) ) : ?>
	<aside class="homepage-bottom widget-area" role="complementary">
		<?php dynamic_sidebar( 'homepage-bottom' ); ?>
	</aside>
<?php endif; ?>

