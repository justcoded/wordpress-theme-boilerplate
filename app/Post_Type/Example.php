<?php
namespace Boilerplate\Theme\Post_Type;

/**
 * Custom post type to illustrate single/archive features
 */
class Example extends \JustCoded\WP\Framework\Objects\Post_Type {
	/**
	 * ID
	 *
	 * @var string
	 */
	public static $ID = 'cpt_example';

	/**
	 * Rewrite URL part
	 *
	 * @var string
	 */
	public static $SLUG = 'my-content';

	/**
	 * Registration function
	 */
	public function init() {
		$this->label_singular = 'Example Content';
		$this->label_multiple = 'Example Contents';
		$this->textdomain = '_jmvt';

		$this->has_single       = true;
		$this->is_searchable    = true;
		$this->rewrite_singular = false;

		$this->is_hierarchical = false;

		$this->admin_menu_pos  = 25;
		$this->admin_menu_icon = 'dashicons-format-gallery';

		$this->taxonomies = array(
			'category',
		);

		$this->register();
	}
}
