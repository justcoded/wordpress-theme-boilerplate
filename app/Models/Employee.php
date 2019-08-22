<?php
namespace Boilerplate\Theme\Models;

use JustCoded\WP\Framework\Objects\Model;
use Boilerplate\Theme\Post_Type;
use JustCoded\WP\Framework\Objects\Postmeta;

/**
 * Example of getting data for archive pages of custom post type
 *
 * @property \WP_Query $query
 */
class Employee extends Model {
	/**
	 * Postmeta object to easy get meta data.
	 *
	 * @var Postmeta
	 */
	public $fields;

	/**
	 * Employee constructor.
	 * example of usage post meta object inside model for single / archive pages
	 */
	public function __construct() {
		$this->fields = new Postmeta();
	}

	/**
	 * Get query to be used in views in the loop
	 *
	 * @param array $args Arguments.
	 *
	 * @return \WP_Query  query object to be used in loop
	 */
	public function get_query( $args ) {
		$default = array(
			'post_type'      => Post_Type\Employee::$ID,
			'post_status'    => Post_Type\Employee::STATUS_PUBLISH,
			'order'          => Post_Type\Employee::SORT_DESC,
			'orderby'        => Post_Type\Employee::ORDERBY_DATE,
			'posts_per_page' => 4,
		);

		$args = wp_parse_args( $args, $default );

		return $this->archive_query( $args, __METHOD__ );
	}
}
