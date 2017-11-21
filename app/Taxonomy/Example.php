<?php
/**
 * Example of custom taxonomy and it's archive
 * Delete if you don't have any
 */

namespace Boilerplate\Theme\Taxonomy;

use JustCoded\WP\Framework\Objects\Taxonomy;

/**
 * Class Example Taxonomy
 *
 * @package Boilerplate\Theme\Taxonomy
 */
class Example extends Taxonomy {
	/**
	 * ID
	 *
	 * @var string
	 */
	public static $ID = 'example';

	/**
	 * Rewrite URL part
	 *
	 * @var string
	 */
	public static $SLUG = 'tax-example';

	/**
	 * Registration function
	 */
	public function init() {
		$this->label_singular = 'Some Taxo';
		$this->label_multiple = 'Some Taxo\'s';
		$this->textdomain     = 'boilerplate';

		$this->is_hierarchical  = false;
		$this->has_single       = true;
		$this->rewrite_singular = false;

		$this->has_admin_menu = true;

		$this->post_types = array(
			\Boilerplate\Theme\Post_Type\Example::$ID,
		);

		$this->register();
	}
}
