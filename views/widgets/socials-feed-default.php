<?php
/* @var $instance array
 *
 * var $before_widget print:
 * <div class="pb-widget pb-widget-num-2 widget_hero-slider" data-index="1" >
 * <div class="pb-widget-inner" >
 *
 * var $after_widget print:
 * </div></div>
 *
 */

$model = new \Boilerplate\Theme\Models\SocialFeeds();
?>

<?php echo $before_widget; ?>

	<?php while ( $model->get_query( $instance )->have_posts() ) : $model->get_query( $instance )->the_post(); ?>

		<div class="container-md">
			<h1><?php the_title(); ?></h1>
			<p><?php the_content(); ?></p>
			<img src="<?php print get_post_meta( get_the_ID(), 'postmeta_image', true ); ?> "<?php ; ?>">
		</div>


	<?php endwhile; ?>

<?php echo $after_widget; ?>