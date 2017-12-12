<?php
/**
 * Main layout loaded by default
 * Extended from "html" layout
 */
use \JustCoded\WP\Framework\Web\View;

View::extends( 'layouts/html' );
?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'boilerplate' ); ?></a>

<?php View::render( 'partials/header' ); ?>

	<div id="content" class="site-content">

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php echo $content; ?>

				<?php View::render( 'partials/sidebar' ); ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- #content -->

<?php View::render( 'partials/footer' ); ?>
