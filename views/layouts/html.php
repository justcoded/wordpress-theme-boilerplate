<?php
/**
 * The main layout file for our theme.
 * Basically contains <head> section, main site header/footer and main content wrapper
 * This template can be used in other layouts to extend the layout and add sidebar for example
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page">

	<?php echo $content; ?>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
