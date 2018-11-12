<?php

namespace Boilerplate\Theme\Cron_Job;

use JustCoded\WP\Framework\Objects\Cron;

class Update_Option extends Cron {
	public $ID = 'update_option_events_cronjob';
	public $timestamp = 'yesterday midnight';
	public $schedule = 'manual';
	public $frequency = 'every_1_minute';
	public $interval = 60;


	/**
	 * ArchiveEvents constructor.
	 */
	protected function __construct() {
		parent::__construct();
	}

	/**
	 * Run action
	 */
	public function run() {
		update_option( $this->ID, time() );
	}


}