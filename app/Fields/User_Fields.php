<?php
namespace Boilerplate\Theme\Fields;

use JustCoded\WP\Framework\ACF\ACF_Register;

class User_Fields extends ACF_Register {

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
