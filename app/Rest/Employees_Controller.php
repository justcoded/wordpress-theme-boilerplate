<?php

namespace Boilerplate\Theme\Rest;

use JustCoded\WP\Framework\Web\Rest_Controller;
use TheTimes\Theme\Post_Type\Employee as Employee_Post_Type;
use TheTimes\Theme\Models\Employee as Employee_Model;

/**
 * Custom json rest endpoint to illustrate like it work
 */
class Employees_Controller extends Rest_Controller {

	/**
	 * Resource name.
	 *
	 * @var string
	 */
	protected $resource_name = 'employees';

	/**
	 * Init function
	 */
	public function init() {
		$args = array(
			'id' => array(
				'required'    => true,
				'description' => __( 'Unique identifier for the object.' ),
				'type'        => 'integer',
			),
		);

		$this->add_route(
			'get_items',
			\WP_REST_Server::READABLE,
			'/',
			array( $this, 'get_items' ),
			$this->get_collection_params()
		);

		$this->add_route(
			'create_item',
			\WP_REST_Server::CREATABLE,
			'/',
			array( $this, 'create_item' ),
			$this->get_endpoint_args_for_item_schema()
		);

		$this->add_route(
			'get_item',
			\WP_REST_Server::READABLE,
			'/(?P<id>\d+)',
			array( $this, 'get_item' ),
			$args,
			array( $this, 'item_permissions_check' )
		);

		$this->add_route(
			'update_item',
			\WP_REST_Server::EDITABLE,
			'/(?P<id>\d+)',
			array( $this, 'update_item' ),
			array_merge( $args, $this->get_endpoint_args_for_item_schema( \WP_REST_Server::EDITABLE ) ),
			array( $this, 'item_permissions_check' )
		);

		$this->add_route(
			'delete_item',
			\WP_REST_Server::DELETABLE,
			'/(?P<id>\d+)',
			array( $this, 'delete_item' ),
			array_merge( $args, array(
				'force' => array(
					'type'        => 'boolean',
					'default'     => false,
					'description' => __( 'Whether to bypass trash and force deletion.' ),
				),
			) ),
			array( $this, 'item_permissions_check' )
		);
	}

	/**
	 * Get all Employees
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 *
	 * @return \WP_REST_Response
	 */
	public function get_items( $request ) {
		// Retrieve the list of registered collection query parameters.
		$registered = $this->get_collection_params();
		$args       = array();

		/*
		 * This array defines mappings between public API query parameters whose
		 * values are accepted as-passed, and their internal WP_Query parameter
		 * name equivalents (some are the same). Only values which are also
		 * present in $registered will be set.
		 */
		$parameter_mappings = array(
			'page'     => 'paged',
			'per_page' => 'posts_per_page',
			'exclude'  => 'post__not_in',
			'include'  => 'post__in',
			'offset'   => 'offset',
			'order'    => 'order',
			'orderby'  => 'orderby',
		);

		/*
		 * For each known parameter which is both registered and present in the request,
		 * set the parameter's value on the query $args.
		 */
		foreach ( $parameter_mappings as $api_param => $wp_param ) {
			if ( isset( $registered[ $api_param ], $request[ $api_param ] ) ) {
				$args[ $wp_param ] = $request[ $api_param ];
			}
		}

		$employee_model  = new Employee_Model();
		$employees_posts = $employee_model->get_query_rest( $args );

		return $this->response( $employees_posts->get_posts() );
	}

	/**
	 * Creat Employee post.
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 *
	 * @return \WP_Error|\WP_REST_Response
	 */
	public function create_item( $request ) {
		$prepared_post = $this->prepare_item_for_database( $request );

		if ( is_wp_error( $prepared_post ) ) {
			return $prepared_post;
		}

		$prepared_post->post_type   = Employee_Post_Type::$ID;
		$prepared_post->post_status = Employee_Post_Type::STATUS_PUBLISH;

		$post_id = wp_insert_post( wp_slash( (array) $prepared_post ), true );

		if ( is_wp_error( $post_id ) ) {
			$post_id->add_data( array( 'status' => 400 ) );

			if ( 'db_insert_error' === $post_id->get_error_code() ) {
				$post_id->add_data( array( 'status' => 500 ) );
			}

			return $post_id;
		}

		$schema = $this->get_item_schema();

		if ( ! empty( $schema['properties']['acf_field'] ) && isset( $request['acf_field'] ) ) {
			$acf_update = $this->update_acf_value( $request['acf_field'], $post_id );

			if ( is_wp_error( $acf_update ) ) {
				return $acf_update;
			}
		}

		$request->set_param( 'context', 'edit' );

		return $this->response(
			[
				'status'      => 'Employee has been created',
				'id'          => $post_id,
				'title'       => ! empty( $prepared_post->post_title ) ? $prepared_post->post_title : '',
				'post_status' => $prepared_post->post_status,
			],
			201,
			[
				'Location' => rest_url( sprintf( '%s/%s/%d', $this->namespace, $this->resource_name, $post_id ) ),
			]
		);
	}

	/**
	 * Checks if a given request has access to create a post.
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 *
	 * @return true|\WP_Error True if the request has access to create items, WP_Error object otherwise.
	 */
	public function create_item_permissions_check( $request ) {
		if ( ! empty( $request['id'] ) ) {
			return new \WP_Error( 'rest_post_exists', __( 'Cannot create existing post.' ), array( 'status' => 400 ) );
		}

		return true;
	}

	/**
	 * Get_item
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 *
	 * @return \WP_Error|\WP_REST_Response
	 */
	public function get_item( $request ) {
		$post = $this->get_employee( $request['id'] );
		if ( is_wp_error( $post ) ) {
			return $post;
		}

		return $this->response( $post );
	}

	/**
	 * Get_item
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 *
	 * @return \WP_Error|\WP_REST_Response
	 */
	public function update_item( $request ) {
		$prepared_post = $this->prepare_item_for_database( $request );

		if ( is_wp_error( $prepared_post ) ) {
			return $prepared_post;
		}

		$prepared_post->post_type   = Employee_Post_Type::$ID;
		$prepared_post->post_status = Employee_Post_Type::STATUS_PUBLISH;

		$post_id = wp_update_post( wp_slash( (array) $prepared_post ), true );

		if ( is_wp_error( $post_id ) ) {
			$post_id->add_data( array( 'status' => 400 ) );

			if ( 'db_insert_error' === $post_id->get_error_code() ) {
				$post_id->add_data( array( 'status' => 500 ) );
			}

			return $post_id;
		}

		$schema = $this->get_item_schema();

		if ( ! empty( $schema['properties']['acf_field'] ) && isset( $request['acf_field'] ) ) {
			$acf_update = $this->update_acf_value( $request['acf_field'], $post_id );

			if ( is_wp_error( $acf_update ) ) {
				return $acf_update;
			}
		}

		$request->set_param( 'context', 'edit' );

		return $this->response(
			[
				'status'      => 'Employee has been updated',
				'id'          => $post_id,
				'title'       => ! empty( $prepared_post->post_title ) ? $prepared_post->post_title : '',
				'post_status' => $prepared_post->post_status,
			]
		);
	}

	/**
	 * Get_item
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 *
	 * @return \WP_REST_Response
	 */
	public function delete_item( $request ) {
		$request->set_param( 'context', 'edit' );

		$result = wp_delete_post( $request['id'], true );

		if ( is_wp_error( $result ) ) {
			return $result;
		}

		return $this->response(
			[
				'status' => 'Employee has been deleted',
				'id'     => $request['id'],
			]
		);
	}

	/**
	 * Item_permissions_check
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 *
	 * @return bool|\WP_Error True if the request has read access for the item, WP_Error object otherwise.
	 */
	public function item_permissions_check( $request ) {
		$post = $this->get_employee( $request['id'] );
		if ( is_wp_error( $post ) ) {
			return $post;
		}

		return true;
	}

	/**
	 * Get_collection_params
	 *
	 * @return array
	 */
	public function get_collection_params() {
		$query_params = parent::get_collection_params();

		$query_params['context']['default'] = 'view';

		$query_params['exclude'] = array(
			'description' => __( 'Ensure result set excludes specific IDs.' ),
			'type'        => 'array',
			'items'       => array(
				'type' => 'integer',
			),
			'default'     => array(),
		);

		$query_params['include'] = array(
			'description' => __( 'Limit result set to specific IDs.' ),
			'type'        => 'array',
			'items'       => array(
				'type' => 'integer',
			),
			'default'     => array(),
		);

		$query_params['offset'] = array(
			'description' => __( 'Offset the result set by a specific number of items.' ),
			'type'        => 'integer',
		);

		$query_params['order'] = array(
			'description' => __( 'Order sort attribute ascending or descending.' ),
			'type'        => 'string',
			'default'     => 'desc',
			'enum'        => array( 'asc', 'desc' ),
		);

		$query_params['orderby'] = array(
			'description' => __( 'Sort collection by object attribute.' ),
			'type'        => 'string',
			'default'     => 'date',
			'enum'        => array(
				'author',
				'date',
				'id',
				'include',
				'modified',
				'parent',
				'relevance',
				'slug',
				'include_slugs',
				'title',
			),
		);

		return $query_params;
	}

	/**
	 * Get_item_schema
	 *
	 * @return array
	 */
	public function get_item_schema() {
		$schema = array(
			'$schema'    => 'http://json-schema.org/draft-04/schema#',
			'title'      => Employee_Post_Type::$ID,
			'type'       => 'object',
			'properties' => array(
				'title'     => array(
					'description' => sprintf( __( 'The title for the %s.' ), Employee_Post_Type::$ID ),
					'type'        => 'string',
				),
				'content'   => array(
					'description' => sprintf( __( 'The content for the %s.' ), Employee_Post_Type::$ID ),
					'type'        => 'string',
				),
				'acf_field' => array(
					'description' => sprintf( __( 'The ACF field for the %s.' ), Employee_Post_Type::$ID ),
					'type'        => 'object',
				),
			),
		);

		return $this->add_additional_fields_schema( $schema );
	}

	/**
	 * Prepare_item_for_database
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 *
	 * @return object|\stdClass|\WP_Error
	 */
	protected function prepare_item_for_database( $request ) {
		$prepared_post = new \stdClass();

		if ( isset( $request['id'] ) ) {
			$existing_post = $this->get_employee( $request['id'] );
			if ( is_wp_error( $existing_post ) ) {
				return $existing_post;
			}

			$prepared_post->ID = $existing_post->ID;
		}

		$schema = $this->get_item_schema();

		if ( ! empty( $schema['properties']['title'] ) && isset( $request['title'] ) ) {
			if ( is_string( $request['title'] ) ) {
				$prepared_post->post_title = $request['title'];
			}
		}

		if ( ! empty( $schema['properties']['content'] ) && isset( $request['content'] ) ) {
			if ( is_string( $request['content'] ) ) {
				$prepared_post->post_content = $request['content'];
			}
		}

		return $prepared_post;

	}

	/**
	 * Update_acf_value
	 *
	 * @param array $args Arguments.
	 * @param int   $post_id Post ID.
	 *
	 * @return \WP_Error|bool
	 */
	private function update_acf_value( $args, $post_id ) {
		if ( empty( $args ) ) {
			return new \WP_Error( 'rest_employee_empty_acf_object', __( 'Empty ACF fields object.' ), array( 'status' => 500 ) );
		}

		foreach ( $args as $selector => $value ) {
			if ( empty( $value ) ) {
				continue;
			}

			update_field( $selector, $value, $post_id );
		}

		return true;
	}

	/**
	 * Get the Employee post, if the ID is valid.
	 *
	 * @param int $id Supplied ID.
	 *
	 * @return \WP_Post|\WP_Error Post object if ID is valid, WP_Error otherwise.
	 */
	private function get_employee( $id ) {
		$error = new \WP_Error( 'rest_employee_invalid_id', __( 'Invalid employee ID.' ), array( 'status' => 404 ) );
		if ( (int) $id <= 0 ) {
			return $error;
		}

		$post = get_post( (int) $id );
		if ( empty( $post ) || empty( $post->ID ) || Employee_Post_Type::$ID !== $post->post_type ) {
			return $error;
		}

		return $post;
	}
}
