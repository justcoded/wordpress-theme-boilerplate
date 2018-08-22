<?php
/**
 * Example of layout sidebar (which is present on almost all pages)
 */

if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<aside id="sidebar" class="sidebar col-md-2 col-sm-4 col-xs-12">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside>
<?php endif; ?>
