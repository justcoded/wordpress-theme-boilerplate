<?php

namespace Boilerplate\Theme\Fields;

use Boilerplate\Theme\Post_Type\Employee;
use JustCoded\WP\Framework\ACF\ACF_Register;

class Employee_Fields extends ACF_Register {

	/**
	 * Init fields configuration method
	 */
	public function init() {
		$this->has(
			$this->build( 'employee_information' )
			     ->addText( 'position' )
			     ->addTextarea( 'bio' )
			     ->setLocation( 'post_type', '==', Employee::$ID )
		);
	}
}
