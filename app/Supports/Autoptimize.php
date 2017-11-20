<?php
namespace Boilerplate\Theme\Supports;

/**
 * Class AutoOptimize
 * AutoOptimize plugin extension which allows to add advanced configuration of this plugin.
 * Also add patches for multi-site and "/cms" folder installation
 */
class Autoptimize extends \JustCoded\WP\Framework\Supports\Autoptimize {
	/**
	 * List of custom domains to add to DNS pre-fetch block
	 *
	 * @var array
	 */
	protected $dns_prefetch_domains = array();

	/**
	 * Add scripts to be moved BEFORE autoOptimized minified script loaded
	 *
	 * @param array $scripts  scripts list.
	 *
	 * @return array
	 */
	public function js_move_first( $scripts ) {
		$scripts = array_merge( $scripts, [
			// string parts to be searched inside scripts to place scripts at the beginning. Like jQuery.
		] );

		return $scripts;
	}

	/**
	 * Add scripts to be moved AFTER autoOptimized minified script loaded
	 *
	 * @param array $scripts   scripts list.
	 *
	 * @return array
	 */
	public function js_move_last( $scripts ) {
		// add share this.
		$scripts = array_merge( $scripts, [
			// string parts to be searched inside scripts to place scripts at the end. Like sharethis.
			'sharethis.com',
		] );

		return $scripts;
	}
}
