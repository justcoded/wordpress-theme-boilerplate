<?php
/**
 * The template for 404 Error not found.
 */

use Boilerplate\Theme\Admin\Theme_Settings;

/* @var \JustCoded\WP\Framework\Web\View $this */

$this->extends( 'layouts/main' );

$title   = Theme_Settings::get( '404_title' );
$content = Theme_Settings::get( '404_content' );
?>

<section class="error-404 not-found">
	<header class="page-header">
		<h1 class="page-title"><?php echo wp_kses( apply_filters( 'the_title', $title ), 'data' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php echo wp_kses( apply_filters( 'the_content', $content ), 'post' ); ?>

		<?php get_search_form(); ?>
	</div><!-- .page-content -->
</section><!-- .error-404 -->
