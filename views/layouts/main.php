<?php
/**
 * Main layout loaded by default
 * Extended from "html" layout
 *
 * @var \JustCoded\WP\Framework\Web\View $this
 */

$this->extends( 'layouts/html' );
?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'boilerplate' ); ?></a>

<?php $this->include( 'partials/header' ); ?>

	<div id="content" class="site-content">

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php if ( ! empty( $this->params['subheading'] ) ) : ?>
					<p><?php esc_html_e( $this->params['subheading'] ); ?></p>
				<?php endif; ?>

				<?php echo $content; ?>

				<?php $this->include( 'partials/sidebar' ); ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- #content -->

<?php $this->include( 'partials/footer' ); ?>
