<?php

namespace Boilerplate\Theme\Jobs;

use JustCoded\WP\Framework\Objects\Cronjob;

/**
 * Class Remove_Revisions
 *
 * @package Boilerplate\Theme\Jobs
 */
class Remove_Revisions extends Cronjob {

	const COUNT_REVISION = 10;

	/**
	 * Cron id
	 *
	 * @var string
	 */
	protected $ID = 'remove_revisions_cronjob';

	/**
	 * Start time.
	 *
	 * @var int|string
	 */
	protected $start = 'yesterday midnight';

	/**
	 * Frequency name.
	 *
	 * @var string
	 */
	protected $frequency = 'weekly';

	/**
	 * Interval in seconds.
	 *
	 * @var int
	 */
	protected $interval = 604800;

	/**
	 * Handle action
	 */
	public function handle() {
		global $wpdb;

		$post_ids = $wpdb->get_results( "SELECT id FROM {$wpdb->posts} as p WHERE p.post_type = 'post'", ARRAY_A );

		foreach ( $post_ids as $key => $id ) {
			$revisions = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT id FROM {$wpdb->posts} as p WHERE p.post_type = 'revision' AND p.post_parent = %d",
					$id['id']
				),
				ARRAY_A
			);

			if ( empty( $revisions ) ) {
				continue;
			}

			$revisions_count = count( $revisions );

			if ( self::COUNT_REVISION >= $revisions_count ) {
				continue;
			}

			$remove_ids = array_slice( $revisions, 0, $revisions_count - self::COUNT_REVISION );
			$remove_ids = implode(
				', ',
				array_map( function ( $array ) {
					return (int) $array['id'];
				}, $remove_ids )
			);

			$this->remove_revisions( $remove_ids );
		}
	}

	/**
	 * Remove revisions.
	 *
	 * @param string $ids .
	 */
	protected function remove_revisions( $ids ) {
		global $wpdb;

		$wpdb->query( "DELETE FROM {$wpdb->posts} WHERE ID IN ({$ids});" );
		$wpdb->query( "DELETE FROM {$wpdb->postmeta} WHERE post_id IN ({$ids});" );
	}
}
