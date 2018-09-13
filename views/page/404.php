<?php
/**
 * The template for 404 Error not found.
 *
 * @var \JustCoded\WP\Framework\Web\View $this
 */

use JustCoded\WP\Framework\Objects\Thememeta;

$fields = new Thememeta();

$this->extends( 'layouts/main' );

$title   = $fields->page_404_title;
$content = $fields->page_404_content;
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
