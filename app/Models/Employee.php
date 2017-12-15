<?php
namespace Boilerplate\Theme\Models;

use JustCoded\WP\Framework\Objects\Model;
use Boilerplate\Theme\Post_Type;

/**
 * Example of getting data for archive pages of custom post type
 *
 * @property \WP_Query $query
 */
class Employee extends Model {
	/**
	 * Get query to be used in home views in the loop
	 *
	 * @return \WP_Query  query object to be used in loop
	 */
	public function get_post_employee() {
		return $this->archive_query( array(
			'post_type'      => Post_Type\Employee::$ID,
			'post_status'    => Post_Type\Employee::STATUS_PUBLISH,
			'order'          => Post_Type\Employee::SORT_DESC,
			'orderby'        => Post_Type\Employee::ORDERBY_DATE,
			'posts_per_page' => 4,
		), __METHOD__ );
	}

}
