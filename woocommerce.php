<?php
/**
 * The wrapper for displaying all WooCommerce pages.
 *
 * @var \JustCoded\WP\Framework\Web\View $this
 */

$this->extends( 'layouts/main' );

woocommerce_content();
