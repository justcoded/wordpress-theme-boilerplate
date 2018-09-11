<?php
namespace Boilerplate\Theme\Fields;

use Boilerplate\Theme\Fields\Modules\Fields_General;
use Boilerplate\Theme\Fields\Modules\Modules_Slider;

class User_Fields extends \JustCoded\WP\Framework\ACF\ACF_Register {

	/**
	 * Init fields configuration method
	 */
	public function init() {
		$this->has(
			$this->build()
				->addImage( 'user_avatar' )
				->setGroupConfig( 'position', 'high' )
				->setLocation( 'user_form', '==', 'all' )
		);
	}
}
