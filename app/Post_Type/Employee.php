<?php
namespace Boilerplate\Theme\Post_Type;

use Boilerplate\Theme\Taxonomy\Department;
use JustCoded\WP\Framework\Objects\Post_Type;

/**
 * Custom post type Employee to illustrate single/archive features
 */
class Employee extends Post_Type {
	/**
	 * ID
	 *
	 * @var string
	 */
	public static $ID = 'employee';

	/**
	 * Rewrite URL part
	 *
	 * @var string
	 */
	public static $SLUG = 'employee';

	/**
	 * Registration function
	 */
	public function init() {
		$this->label_singular = 'Employee';
		$this->label_multiple = 'Employees';
		$this->textdomain = 'boilerplate';

		$this->has_single       = true;
		$this->is_searchable    = true;
		$this->rewrite_singular = false;

		$this->is_hierarchical = false;

		$this->admin_menu_pos  = 25;
		$this->admin_menu_icon = 'dashicons-format-gallery';

		$this->taxonomies = array(
			Department::$ID,
		);

		$this->register();
	}
}
