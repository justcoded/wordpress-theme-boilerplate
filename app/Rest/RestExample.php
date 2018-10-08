<?php

namespace Boilerplate\Theme\Rest;

use JustCoded\WP\Framework\Objects\Rest;
/**
 * Custom json rest endpoint to illustrate like it work
 */
class RestExample extends Rest {
	/**
	 * ROUTE - rest endpoint in format /wp-json/Boilerplate/$ROUTE
	 *
	 * @var string
	 */

	public static $ROUTE = '/rest_example/(?P<id>\d+)';

	public function init() {
		$this->method              = self::METHOD_GET;
		$this->validate_args['id'] = [
			'validate_callback' => function ( $param, $request, $key ) {
				return is_numeric( $param );
			}
		];
	}

	public function callback( $data ) {

		return json_encode( $data['id'] );
	}
}