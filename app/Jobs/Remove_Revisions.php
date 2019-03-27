<?php

namespace Boilerplate\Theme\Job;

use JustCoded\WP\Framework\Objects\Cronjob;

/**
 * Class Remove_Revisions
 * @package Boilerplate\Theme\Jobs
 */
class Remove_Revisions extends Cronjob {

	const COUNT_REVISION = 10;

	/**
	 * @var string
	 */
	public $ID = 'remove_revisions_events_cronjob';

	/**
	 * @var string
	 */
	public $start = 'yesterday midnight';

	/**
	 * @var string
	 */
	public $schedule = 'once_week';

	/**
	 * @var string
	 */
	public $schedule_description = 'Once a Week';

	/**
	 * @var int
	 */
	public $interval = 604800;


	/**
	 * Update_Option constructor.
	 *
	 * @throws \Exception
	 */
	protected function __construct() {
		parent::__construct();
	}

	/**
	 * Run action
	 */
	public function run() {
		global $wpdb;

		$post_ids = $wpdb->get_results( "SELECT id FROM {$wpdb->prefix}posts as p WHERE p.post_type = 'post'", ARRAY_A );

		foreach ( $post_ids as $key => $id ) {
			$revisions = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT id FROM {$wpdb->prefix}posts as p WHERE p.post_type = 'revision' AND p.post_parent = %d",
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

		$remove_ids_sql = "DELETE FROM {$wpdb->prefix}posts WHERE ID IN ({$ids});";

		$wpdb->query( $remove_ids_sql );
	}
}