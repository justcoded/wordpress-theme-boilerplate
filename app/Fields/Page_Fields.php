<?php

namespace Boilerplate\Theme\Fields;

use Boilerplate\Theme\Fields\Modules\Fields_General;
use Boilerplate\Theme\Fields\Modules\Modules_Slider;

class Page_Fields extends \JustCoded\WP\Framework\ACF\ACF_Register {

	/**
	 * Init fields configuration method
	 */
	public function init() {
		$this->has(
			$this->build()
				->addFields( Fields_General::get( 'subtitle' ) )
				->addFlexibleContent( 'sections' )
					->addLayout( Modules_Slider::get() )
					->endFlexibleContent()
				->setLocation( 'post_type', '==', 'page' )
		);
	}
}
