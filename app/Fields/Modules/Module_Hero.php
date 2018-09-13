<?php

namespace Boilerplate\Theme\Fields\Modules;

use JustCoded\WP\Framework\ACF\ACF_Definition;

class Module_Hero extends ACF_Definition {
	/**
	 * Init fields configuration method
	 */
	public function init() {
		$this->has(
			$this->build( 'module_hero' )
				->addText( 'hero_title' )
				->setWidth( '50%' )
				->addText( 'hero_sub_title' )
				->setWidth( '50%' )
				->addImage( 'hero_image' )
				->addWysiwyg( 'hero_text' )
		);
	}
}
