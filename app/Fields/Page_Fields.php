<?php

namespace Boilerplate\Theme\Fields;

use Boilerplate\Theme\Fields\Modules\Fields_Generic;
use Boilerplate\Theme\Fields\Modules\Module_Hero;
use JustCoded\WP\Framework\ACF\ACF_Register;

class Page_Fields extends ACF_Register {

	/**
	 * Init fields configuration method
	 */
	public function init() {
		$this->has(
			$this->build()
				->addFields( Fields_Generic::get( 'subtitle' ) )
				->addFlexibleContent( 'sections' )
					->addLayout( Module_Hero::get() )
					->endFlexibleContent()
				->setLocation( 'post_type', '==', 'page' )
		);
	}
}