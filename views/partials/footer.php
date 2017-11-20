<?php \JustCoded\WP\Framework\Web\View::footer_begin(); ?>
<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="site-info">
		<?php
		$copy = Boilerplate\Theme\Admin\Theme_Settings::get( 'copyright_text' );
		echo esc_html( $copy );
		?>

		<span class="sep"> | </span>

		<a href="<?php echo esc_url( __( 'https://wordpress.org/', '_jmvt' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', '_jmvt' ), 'WordPress' ); ?></a>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
