<?php
/**
 * Template Name: Timeline
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 */

use JustCoded\WP\Framework\Web\View;


$model = new \Boilerplate\Theme\Models\SocialFeeds();

$this->extends( 'layouts/main' ); ?>

<?php while ( $model->get_query(  )->have_posts() ) : $model->get_query(  )->the_post(); ?>

	<h1><?php the_title(); ?></h1>
	<p><?php the_content(); ?></p>
	<img src="<?php print get_post_meta( get_the_ID(), 'postmeta_image', true ); ?> "<?php ; ?>">

<?php endwhile; ?>

