<?php
namespace Boilerplate\Theme\Models;

use JustCoded\WP\Framework\Objects\Model;
use Boilerplate\Theme\Post_Type\Hero;

/**
 * Model to control data of the homepage
 *
 * @property \WP_Query $hero_query
 *
 * Fields available through JCF:
 *
 * @property string $field_headline
 */
class Homepage extends Model {
	/**
	 * Get hero query to be used in home views in the loop
	 *
	 * @return \WP_Query  query object to be used in loop
	 */
	public function get_hero_query() {
		return $this->wp_query( array(
			'post_type'   => Hero::$ID,
			'post_status' => Hero::STATUS_PUBLISH,
			'order'       => Hero::SORT_ASC,
			'orderby'     => Hero::ORDERBY_WEIGHT,
		), __METHOD__ );
	}

}
