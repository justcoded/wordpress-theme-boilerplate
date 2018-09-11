<?php
/**
 * The template for 404 Error not found.
 *
 * @var \JustCoded\WP\Framework\Web\View $this
 */

use Boilerplate\Theme\Admin\Theme_Settings;

$this->extends( 'layouts/main' );

// TODO: replace with theme getter from acf.

$title   = Theme_Settings::get( '404_title' );
$content = Theme_Settings::get( '404_content' );
?>

<section class="error-404 not-found">
	<header class="page-header">
		<h1 class="page-title"><?php echo wp_kses( apply_filters( 'the_title', $title ), array() ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php echo apply_filters( 'the_content', $content ); ?>

		<?php get_search_form(); ?>
	</div><!-- .page-content -->
</section><!-- .error-404 -->
