<?php
namespace Boilerplate\Theme\Page_Builder;

use Boilerplate\Theme\Page_Builder\Row;
use Boilerplate\Theme\Page_Builder\Widget;
use JustCoded\WP\Framework\Page_Builder\v25\Layouts as Core;
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

		$this->register_row_layout( Core\Rwd_Row_Layout::class, 'Default' );
		$this->register_row_layout( Row\Wide_Layout::class );

		$this->register_widget_layout( Core\Rwd_Widget_Layout::class, 'Default' );
		$this->register_widget_layout( Widget\Hero_Layout::class );
	}
}
