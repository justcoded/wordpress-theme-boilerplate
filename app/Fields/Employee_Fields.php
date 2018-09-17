<?php

namespace Boilerplate\Theme\Fields;

use Boilerplate\Theme\Post_Type\Employee;
use JustCoded\WP\Framework\ACF\ACF_Register;

class Employee_Fields extends ACF_Register {

	/**
	 * Init fields configuration method
	 */
	public function init() {
		$this->remove_content_editor( Employee::$ID );

		$this->has(
			$this->build()
				->addSelect( 'level' )
					->addChoices([
						''       => '',
						'Junior' => 'Junior',
						'Middle' => 'Middle',
						'Senior' => 'Senior',
					])
					->setWidth( '50%' )
				->addText( 'position' )
					->setWidth( '50%' )
				->addTextarea( 'bio' )
				->setLocation( 'post_type', '==', Employee::$ID )
		);
	}
}
