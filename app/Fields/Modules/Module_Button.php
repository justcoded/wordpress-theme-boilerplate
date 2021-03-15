<?php


namespace Boilerplate\Theme\Fields\Modules;

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
				->addGroup( 'button' )
				->addTrueFalse( 'enable', [
					'label'         => __( 'Enable button', 'jcwp' ),
					'ui'            => false,
					'default_value' => 1,
				] )
				->addText( 'title' )
				->addRadio( 'type', [
					'label'         => __( 'Button link type', 'credicus' ),
					'layout'        => 'vertical',
					'other'         => false,
					'allow_null'    => false,
					'multiple'      => false,
					'default_value' => 'internal',
					'return_format' => 'value',
				] )
				->setWidth( '15' )
				->addChoices( $choices )
				->addPostObject( 'int_link', [
					'label'             => __( 'Internal page link', 'credicus' ),
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
				->setWidth( '85' )
				->addUrl( 'ext_link', [
					'label'             => __( 'External link', 'credicus' ),
					'required'          => true,
					'conditional_logic' => [
						'field'    => 'type',
						'operator' => '==',
						'value'    => 'external',
					],
				] )
				->setWidth( '85' )
				->addText( 'anchor', [
					'label'             => __( 'Anchor', 'credicus' ),
					'conditional_logic' => [
						'field'    => 'type',
						'operator' => '==',
						'value'    => 'anchor',
					],
				] )
				->setWidth( '85' )
				->endGroup()
		);
	}
}