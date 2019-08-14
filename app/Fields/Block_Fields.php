<?php

namespace Boilerplate\Theme\Fields;

use JustCoded\WP\Framework\ACF\ACF_Register;

class Block_Fields extends ACF_Register {

	/**
	 * Init fields configuration method
	 */
	public function init() {
		$this->has(
			$this->build()
				->addText( 'title' )
				->addTextarea( 'description' )
				->setLocation( 'block', '==', 'acf/testimonial' )
		);
	}
}
