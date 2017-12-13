<?php
/**
 * Main layout loaded by default
 * Extended from "html" layout
 */

/* @var \JustCoded\WP\Framework\Web\View $this */

$this->extends( 'layouts/html' );

?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'boilerplate' ); ?></a>

<?php $this->render( 'partials/header' ); ?>

	<div id="content" class="site-content">

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php echo $content; ?>

				<?php $this->render( 'partials/sidebar' ); ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- #content -->

<?php $this->render( 'partials/footer' ); ?>
