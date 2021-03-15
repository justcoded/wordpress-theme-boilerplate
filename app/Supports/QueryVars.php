<?php


namespace JCWP\Theme\Supports;

/**
 * Class QueryVars
 *
 * @package JCWP\Theme\Supports
 */
class QueryVars {

	/**
	 * Query data
	 *
	 * @var array $query_data
	 */
	protected $query_data = array(
		'get'  => array(),
		'post' => array(),
	);

	/**
	 * Query vars
	 *
	 * @var array $query_vars
	 */
	protected $query_vars = array();

	/**
	 * Nonce name
	 *
	 * @var string $nonce_name
	 */
	private $nonce_name;

	/**
	 * Nonce action
	 *
	 * @var string $nonce_action
	 */
	private $nonce_action;

	/**
	 * Enable or disable sanitizing
	 *
	 * @var bool $sanitizing
	 */
	private $sanitizing = true;

	/**
	 * QueryVars constructor.
	 */
	public function __construct() {}

	/**
	 * Configure
	 *
	 * @param $nonce_name
	 * @param $nonce_action
	 */
	public function configure( $nonce_name, $nonce_action ) {
		if ( ! empty( $nonce_name ) && ! empty( $nonce_action ) ) {
			$this->nonce_name   = $nonce_name;
			$this->nonce_action = $nonce_action;
		}
	}

	/**
	 * Use_sanitize
	 *
	 * @return bool
	 */
	public function no_sanitize() : bool {
		return $this->sanitizing = false;
	}

	/**
	 * Get query vars
	 *
	 * @param string $method .
	 * @param string $var .
	 *
	 * @return mixed
	 */
	public function get_query_vars( $method = '', $var = '' ) {
		$this->verify_query_vars();

		if ( ! empty( $var ) && isset( $this->query_data[ $method ][ $var ] ) ) {
			return $this->query_data[ $method ][ $var ];
		}

		if ( ! empty( $method ) ) {
			return $this->query_data[ $method ];
		}

		return $this->query_data;
	}

	/**
	 * Add dynamic query var
	 *
	 * @param string $var .
	 *
	 * @return array
	 */
	public function add_query_var( $var ) : array {
		if ( ! empty( $var ) && ! in_array( $var, $this->query_vars, true ) ) {
			$this->query_vars[] = $var;
		}

		return $this->query_vars;
	}

	/**
	 * Verify vars
	 *
	 * @return array
	 */
	protected function verify_query_vars() : array {
		$methods = array(
			'post' => $_POST,
			'get'  => $_GET,
		);

		$_query_data = array();

		foreach ( $methods as $method => $_vars ) {
			if ( isset( $_vars[ $this->nonce_name ] ) ) {
				if ( ! wp_verify_nonce( $_vars[ $this->nonce_name ], $this->nonce_action ) ) {
					$_query_data = array( $method => 'nonce error' );
					continue;
				}
			}

			foreach ( $this->query_vars as $query_var ) {
				if ( empty( $_vars[ $query_var ] ) ) {
					continue;
				}

				$_query_data[ $method ][ $query_var ] =
					true === $this->sanitizing ? sanitize_text_field( $_vars[ $query_var ] ) : $_vars[ $query_var ];
			}
		}

		return $this->query_data = $_query_data;
	}

}
