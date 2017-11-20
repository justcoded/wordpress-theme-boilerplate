<?php
namespace Boilerplate\Theme\Models;

use JustCoded\WP\Framework\Objects\Model;
use Boilerplate\Theme\Post_Type;

/**
 * Example of getting data for archive pages of custom post type
 *
 * @property \WP_Query $query
 */
class Cpt_Example extends Model {
	/**
	 * Get hero query to be used in home views in the loop
	 *
	 * @return \WP_Query  query object to be used in loop
	 */
	public function get_query() {
		return $this->archive_query( array(
			'post_type'      => Post_Type\Example::$ID,
			'post_status'    => Post_Type\Example::STATUS_PUBLISH,
			'order'          => Post_Type\Example::SORT_DESC,
			'orderby'        => Post_Type\Example::ORDERBY_DATE,
			'posts_per_page' => 2,
		), __METHOD__ );
	}

}
