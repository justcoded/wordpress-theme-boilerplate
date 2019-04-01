<?php

namespace Wpra\Theme\Rest;

use JustCoded\WP\Framework\Objects\RestController;

class RestExample extends RestController {

	static $namespace = 'rest_example';

	public function init() {

		$this->add_route( 'GET', '/id/(?P<id>\d+)', [ $this, 'example_id' ], [
			'id' => [
				'validate_callback' => [ $this, 'validate_id' ]
			]
		] );

		$this->add_route( 'GET', '/slug/(?P<slug>\S+)', [ $this, 'example_slug' ], [
			'slug' => [
				'validate_callback' => [ $this, 'validate_slug' ]
			]
		] );
	}

	public function example_id( $data ) {

		return json_encode( $data['id'] );
	}

	public function example_slug( $data ) {
		RestController::get_permalink( '/slug/(?P<slug>\S+)', [] );
		return json_encode( $data['slug'] );
	}

	public function validate_id( $param, $request, $key ) {
		return is_numeric( $param );
	}

	public function validate_slug( $param, $request, $key ) {
		return is_string( $param );
	}
}