<?php
/**
 * Example of custom taxonomy and it's archive
 * Delete if you don't have any
 */

namespace Boilerplate\Theme\Taxonomy;

use JustCoded\WP\Framework\Objects\Taxonomy;
use Boilerplate\Theme\Post_Type\Employee;

/**
 * Class Department Taxonomy
 *
 * @package Boilerplate\Theme\Department
 */
class Department extends Taxonomy {
	/**
	 * ID
	 *
	 * @var string
	 */
	public static $ID = 'department';

	/**
	 * Rewrite URL part
	 *
	 * @var string
	 */
	public static $SLUG = 'department';

	/**
	 * Registration function
	 */
	public function init() {
		$this->label_singular = 'Department';
		$this->label_multiple = 'Departments';
		$this->textdomain     = 'boilerplate';

		$this->is_hierarchical  = false;
		$this->has_single       = true;
		$this->rewrite_singular = false;

		$this->has_admin_menu = true;

		$this->post_types = array(
			Employee::$ID,
		);

		$this->register();
	}
}
