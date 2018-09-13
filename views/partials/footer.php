<?php

use JustCoded\WP\Framework\Objects\Thememeta;

$fields = new Thememeta();

$this->footer_begin();
?>
<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="site-info">
		<?php
		$copy = $fields->copyright_text;
		echo esc_html( $copy );
		?>

		<span class="sep"> | </span>

		<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'boilerplate' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'boilerplate' ), 'WordPress' ); ?></a>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
