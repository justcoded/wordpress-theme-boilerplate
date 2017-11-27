<?php
namespace Boilerplate\Theme\Post_Type;

use JustCoded\WP\Framework\Objects\Post_Type;

/**
 * Hero blocks appear almost on every site right now. So this CPT is included by default
 */
class Hero extends Post_Type {
	/**
	 * ID
	 *
	 * @var string
	 */
	public static $ID = 'hero';

	/**
	 * Rewrite URL part
	 *
	 * @var string
	 */
	public static $SLUG = 'hero';

	/**
	 * Registration function
	 */
	public function init() {
		$this->label_singular = 'Hero post';
		$this->label_multiple = 'Hero posts';
		$this->textdomain = 'boilerplate';

		$this->has_single    = false;
		$this->is_searchable = false;
		$this->redirect      = home_url();

		$this->admin_menu_pos  = 25;
		$this->admin_menu_icon = 'dashicons-screenoptions';

		$this->supports = array(
			self::SUPPORTS_TITLE,
			self::SUPPORTS_EDITOR,
			self::SUPPORTS_FEATURED_IMAGE,
			self::SUPPORTS_REVISIONS,
			self::SUPPORTS_ORDER,
		);

		$this->register();
	}
}
