<?php
namespace Boilerplate\Theme\Page_Builder;

use JustCoded\WP\Framework\Page_Builder\v25\Page_Builder_Loader;

/**
 * Class SiteOriginPanelsLoader
 * Register SiteOrigin Panels special layouts, which can define classes and other html attributes for
 * row/cell wrappers.
 *
 * @package Boilerplate\Theme\Page_Builder
 */
class SiteOrigin_Panels extends Page_Builder_Loader {

	/**
	 * Default namespace of rows/widgets if relative name specified
	 *
	 * @var string
	 */
	public $default_layout_namespace = '\Boilerplate\Theme\Page_Builder';

	/**
	 * Init row/widgets layouts and change disabled plugins list.
	 * Called at the end of the __contruct() method
	 *
	 * To add row layout please call:
	 * $this->register_row_layout( 'LayoutClassName' );
	 *        OR
	 * $this->register_widget_layout( 'LayoutClassName' );
	 *
	 *
	 * To enable back some plugins please do the following:
	 * unset(array_search('Widget_Class_name', $this->disabled_wordpress_widgets));
	 *        OR
	 * unset(array_search('Widget_Class_name', $this->disabled_siteorigin_widgets));
	 */
	public function init() {
		parent::init();

		$this->register_row_layout( '\JustCoded\WP\Framework\Page_Builder\v25\Layouts\Rwd_Row_Layout', 'Default' );
		$this->register_row_layout( 'Row\Wide_Layout' );

		$this->register_widget_layout( '\JustCoded\WP\Framework\Page_Builder\v25\Layouts\Rwd_Widget_Layout', 'Default' );
		$this->register_widget_layout( 'Widget\Hero_Layout' );
	}
}
