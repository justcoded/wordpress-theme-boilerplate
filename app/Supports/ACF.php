<?php

namespace Boilerplate\Theme\Supports;

use JustCoded\WP\Framework\Objects\Singleton;
use StoutLogic\AcfBuilder\FieldsBuilder;


class ACF {

	use Singleton;

	public $fields = array();


	/**
	 * AutoOptimize constructor.
	 */
	protected function __construct() {
		add_action( 'acf/init', array( $this, 'set_fields' ) );
		add_action( 'acf/init', array( $this, 'create_fields' ) );
	}

	/**
	 * Check that required plugin is installed and activated
	 *
	 * @return bool
	 */
	public static function check_requirements() {
		return is_plugin_active( 'advanced-custom-fields-pro/acf.php' );
	}


	public function set_fields() {
		$banner = new FieldsBuilder( 'banner' );
		$additional_title = new FieldsBuilder( 'additional_title' );


		$banner
			->addText( 'title' )
			->addWysiwyg( 'content' )
			->addImage( 'background_image' )
			->setLocation( 'post_type', '==', 'page' )
			->or( 'post_type', '==', 'post' );

		$additional_title
			->addText( 'additional_title' )
			->setLocation( 'post_type', '==', 'page' )
			->or( 'post_type', '==', 'post' );


		$this->fields[] = $banner;
		$this->fields[] = $additional_title;

	}

	public function create_fields() {
		foreach ( $this->fields as $field ) {
			acf_add_local_field_group( $field->build() );
		}
	}


}