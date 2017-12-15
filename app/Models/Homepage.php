<?php
namespace Boilerplate\Theme\Models;

use JustCoded\WP\Framework\Objects\Model;
use Boilerplate\Theme\Post_Type;

/**
 * Model to control data of the homepage
 *
 * @property \WP_Query $post_query
 *
 * Fields available through JCF:
 *
 * @property string $field_headline
 */
class Homepage extends Model {
	/**
	 * Get post query to be used in home views in the loop
	 *
	 * @return \WP_Query  query object to be used in loop
	 */
	public function get_hero_query() {
		return $this->wp_query( array(
			'post_type'      => Post_Type\Employee::$ID,
			'post_status'    => Post_Type\Employee::STATUS_PUBLISH,
			'order'          => Post_Type\Employee::SORT_DESC,
			'orderby'        => Post_Type\Employee::ORDERBY_DATE,
			'posts_per_page' => 4,
		), __METHOD__ );
	}

}
