<?php
namespace Boilerplate\Theme\Models;

use JustCoded\WP\Framework\Objects\Model;
use Boilerplate\Theme\Post_Type\Employee;

/**
 * Model to control data of the homepage
 *
 * @property \WP_Query $hero_query
 */
class Homepage extends Model {
	/**
	 * Get hero query to be used in home views in the loop
	 *
	 * @return \WP_Query  query object to be used in loop
	 */
	public function get_hero_query() {
		return $this->wp_query( array(
			'post_type'      => Employee::$ID,
			'post_status'    => Employee::STATUS_PUBLISH,
			'order'          => Employee::SORT_DESC,
			'orderby'        => Employee::ORDERBY_DATE,
			'posts_per_page' => 4,
		), __METHOD__ );
	}

}
