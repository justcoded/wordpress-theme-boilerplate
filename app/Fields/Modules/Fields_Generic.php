<?php

namespace Boilerplate\Theme\Fields\Modules;

use JustCoded\WP\Framework\ACF\ACF_Definition;

class Fields_Generic extends ACF_Definition {
	/**
	 * Init fields configuration method
	 */
	public function init() {
		$this->has(
			$this->build( 'subtitle' )
				->addText( 'subtitle' ),

			$this->build( 'color' )
				->addSelect( 'color' )
				->addChoice( 'red' )
				->addChoice( 'blue' )
				->addChoice( 'green' )
				->setDefaultValue( 'blue' )
		);
	}
}
