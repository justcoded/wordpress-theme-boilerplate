<?php

namespace Boilerplate\Theme\Models;

use JustCoded\WP\Framework\Objects\Model;

class SocialFeeds extends Model {

	public function get_query( $instance = null ) {

		$args = array(
			'post_type'      => 'socials_feed',
			'posts_per_page' => - 1,
		);
		if ( ! empty( $instance ) ) {
			foreach ( $instance['social_networks'] as $key => $val ) {
				if ( ! empty( $val ) ) {
					$args['socials_category'][] = $key;
				}
			}
		}


		return $this->archive_query( $args, __METHOD__ );
	}

}