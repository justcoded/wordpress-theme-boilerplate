<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 */

use JustCoded\WP\Framework\Web\View;

View::layout_open(); ?>

<?php woocommerce_content(); ?>

<?php View::layout_close();
