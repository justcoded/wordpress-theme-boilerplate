<?php
namespace Boilerplate\Theme\Models;

use JustCoded\WP\Framework\Objects\Model;

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
	public function get_post_query() {
		return $this->wp_query( array(
			'post_type'   => 'post',
			'post_status' => 'publish',
			'order'       => 'ASC',
			'orderby'     => 'date',
		), __METHOD__ );
	}

}
