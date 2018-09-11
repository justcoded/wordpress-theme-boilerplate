<?php

namespace Boilerplate\Theme\Fields\Modules;

use JustCoded\WP\Framework\ACF\ACF_Definition;

class Modules_Slider extends ACF_Definition {
	/**
	 * Init fields configuration method
	 */
	public function init() {
		$this->has(
			$this->build( 'module_slider' )
				->addText( 'slider_title' )
				->addImage( 'slider_image' )
				->addWysiwyg( 'slider_text' )
		);
	}
}