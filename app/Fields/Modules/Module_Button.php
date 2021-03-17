<?php


namespace JCWP\Theme\Fields\Modules;

use JustCoded\WP\Framework\ACF\ACF_Definition;

/**
 * Class Module_Button
 *
 * @package JCWP\Theme\Fields\Modules
 */
class Module_Button extends ACF_Definition {

	/**
	 * Init
	 */
	public function init() {
		$choices = array(
			'internal' => 'Internal',
			'external' => 'External',
			'anchor'   => 'Anchor',
		);

		$this->has(
			$this->build()
			     ->addTrueFalse( 'button_enabled', [
				     'label'         => __( 'Enable button', 'default' ),
				     'ui'            => false,
				     'default_value' => 1,
			     ] )
			     ->setWidth( '10' )
			     ->addGroup( 'button', [
				     'conditional_logic' => [
					     'field'    => 'button_enabled',
					     'operator' => '==',
					     'value'    => 1,
				     ],
			     ] )
			     ->setWidth( '90' )
			     ->addRadio( 'type', [
				     'label'         => __( 'Button link type', 'default' ),
				     'layout'        => 'horizontal',
				     'other'         => false,
				     'allow_null'    => false,
				     'multiple'      => false,
				     'default_value' => 'internal',
				     'return_format' => 'value',
			     ] )
			     ->setWidth( '90' )
			     ->addChoices( $choices )
			     ->addText( 'title' )
			     ->addPostObject( 'int_link', [
				     'label'             => __( 'Internal page link', 'default' ),
				     'post_type'         => 'page',
				     'post_status'       => 'publish',
				     'allow_null'        => false,
				     'multiple'          => false,
				     'required'          => true,
				     'return_format'     => 'id',
				     'conditional_logic' => [
					     'field'    => 'type',
					     'operator' => '==',
					     'value'    => 'internal',
				     ],
			     ] )
			     ->addUrl( 'ext_link', [
				     'label'             => __( 'External link', 'default' ),
				     'required'          => true,
				     'conditional_logic' => [
					     'field'    => 'type',
					     'operator' => '==',
					     'value'    => 'external',
				     ],
			     ] )
			     ->addText( 'anchor', [
				     'label'             => __( 'Anchor', 'default' ),
				     'conditional_logic' => [
					     'field'    => 'type',
					     'operator' => '==',
					     'value'    => 'anchor',
				     ],
			     ] )
			     ->setWidth( '40' )
			     ->addPostObject( 'anc_link', [
				     'label'             => __( 'Anchor page link', 'default' ),
				     'post_type'         => 'page',
				     'post_status'       => 'publish',
				     'allow_null'        => false,
				     'multiple'          => false,
				     'required'          => true,
				     'return_format'     => 'id',
				     'conditional_logic' => [
					     'field'    => 'type',
					     'operator' => '==',
					     'value'    => 'anchor',
				     ],
			     ] )
			     ->setWidth( '60' )
			     ->endGroup()
		);
	}
}
