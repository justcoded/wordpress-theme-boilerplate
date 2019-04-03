<?php

namespace Boilerplate\Theme\Rest;

use JustCoded\WP\Framework\Objects\RestController;

/**
 * Custom json rest endpoint to illustrate like it work
 */
class RestExample extends RestController {

	/**
	 * @var string
	 */
	protected $namespace = 'rest_example';

	/**
	 * @var array
	 */
	protected $slugs = [
		'id'   => '/id/(?P<id>\d+)',
		'slug' => '/slug/(?P<slug>\S+)',
	];

	/**
	 * Init
	 *
	 * @throws \Exception
	 */
	public function init() {
		$this->add_route( $this->slugs['id'], 'GET', [ $this, 'example_id' ], [
			'id' => [
				'validate_callback' => [ $this, 'validate_id' ]
			]
		] );

		$this->add_route( $this->slugs['slug'], 'GET', [ $this, 'example_slug' ], [
			'slug' => [
				'validate_callback' => [ $this, 'validate_slug' ]
			]
		] );
	}

	/**
	 * Example_id
	 *
	 * @param \WP_REST_Request $data
	 *
	 * @return \WP_REST_Response
	 */
	public function example_id( \WP_REST_Request $data ) {
		$params = $data->get_params();

		return $this->response( get_post( $params['id'] ) );
	}

	/**
	 * Example_slug
	 *
	 * @param \WP_REST_Request $data
	 *
	 * @return \WP_REST_Response
	 */
	public function example_slug( \WP_REST_Request $data ) {
		return $this->response( $data->get_params() );
	}

	/**
	 * Validate_id
	 *
	 * @param $param
	 * @param $request
	 * @param $key
	 *
	 * @return bool
	 */
	public function validate_id( $param, $request, $key ) {
		return is_numeric( $param );
	}

	/**
	 * Validate_slug
	 *
	 * @param $param
	 * @param $request
	 * @param $key
	 *
	 * @return bool
	 */
	public function validate_slug( $param, $request, $key ) {
		return is_string( $param );
	}
}