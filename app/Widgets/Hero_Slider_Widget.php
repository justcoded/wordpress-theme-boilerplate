<?php

namespace Boilerplate\Theme\Widgets;

use JustCoded\WP\Framework\Page_Builder\v25\Page_Builder_Widget;
use JustCoded\WP\Framework\Web\View;

/**
 * Class Hero_Slider_Widget
 * Custom image wordpress widget based on siteorigin widgets bundle
 */
class Hero_Slider_Widget extends Page_Builder_Widget {

	/**
	 * Full slider type template name
	 */
	const TYPE_FULL = 'hero-slider-full';

	/**
	 * Default slider type template name
	 */
	const TYPE_DEFAULT = 'hero-slider-default';

	/**
	 * Hero_Slider_Widget constructor.
	 */
	function __construct() {
		parent::__construct(
			'hero-slider',
			__( 'Hero Slider' ),
			array(
				'description' => __( 'Hero Slider' ),
				'has_preview' => false,
			),
			array(),
			false,
			''
		);
	}

	/**
	 * Return a list of images to be shown as preview.
	 * By default it's widget {id_base}.png with $this->name
	 *
	 * @return array
	 */
	public function get_preview_images() {
		return array(
			'hero-slider.png' => 'Preview of the slider widget',
		);
	}

	/**
	 * Form fields configuration
	 *
	 * @return array
	 */
	function get_widget_form() {
		return
			array(
				'images'      => array(
					'type'       => 'repeater',
					'label'      => __( 'Images', 'boilerplate' ),
					'item_name'  => __( 'Image', 'boilerplate' ),
					'item_label' => array(
						'selector'     => "[name*='title']",
						'update_event' => 'change',
						'value_method' => 'val',
					),

					'fields' => array(
						'image'       => array(
							'type'  => 'media',
							'label' => __( 'Image', 'boilerplate' ),
						),
						'title'       => array(
							'type'  => 'text',
							'label' => __( 'Image title', 'boilerplate' ),
						),
						'description' => array(
							'type'  => 'text',
							'label' => __( 'Description', 'boilerplate' ),
						),
						'button_text'        => array(
							'type'  => 'text',
							'label' => __( 'Button text', 'boilerplate' ),
						),
						'button_link'        => array(
							'type'  => 'link',
							'label' => __( 'Button link', 'boilerplate' ),
						),
					),
				),
				'widget_type' => array(
					'type'    => 'select',
					'label'   => __( 'Choose widget type', 'boilerplate' ),
					'options' => array(
						self::TYPE_DEFAULT => __( 'Default', 'boilerplate' ),
						self::TYPE_FULL    => __( 'Full width', 'boilerplate' ),
					),
					'default' => 'full',
				),
			);

	}

	/**
	 * Modify form submitted values before save.
	 *
	 * @param array $instance submitted form values.
	 *
	 * @return array
	 */
	public function modify_instance( $instance ) {

		return $instance;
	}

	/**
	 * Print widget method.
	 *
	 * @param array $args Widget display arguments.
	 * @param array $instance Widget settings.
	 */
	public function widget( $args, $instance ) {
		$instance = $this->get_template_variables( $instance, $args );
		if ( ! empty( $instance['images'] ) ) {
			$template = ( self::TYPE_FULL === $instance['widget_type'] ) ? 'hero-slider-full' : 'hero-slider-default';
			View::instance()->include( 'widgets/' . $template, array(
				'instance' => $instance,
				'before_widget' => $args['before_widget'],
				'after_widget' => $args['after_widget'],
			) );
		}
	}
}