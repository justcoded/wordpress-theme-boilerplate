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
	 * Default slider type
	 */
	const TYPE_FULL = 'hero-slider-full';

	/**
	 * Hero_Slider_Widget constructor.
	 */
	function __construct() {
		parent::__construct(
			'hero-slider',
			__( 'Slider image widget' ),
			array(
				'description' => __( 'Slider image widget.' ),
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
					'label'      => __( 'Images', 'wordpress-theme-boilerplate' ),
					'item_name'  => __( 'Image', 'wordpress-theme-boilerplate' ),
					'item_label' => array(
						'selector'     => "[name*='title']",
						'update_event' => 'change',
						'value_method' => 'val',
					),

					'fields' => array(
						'image'       => array(
							'type'  => 'media',
							'label' => __( 'Image', 'wordpress-theme-boilerplate' ),
						),
						'title'       => array(
							'type'  => 'text',
							'label' => __( 'Image title', 'wordpress-theme-boilerplate' ),
						),
						'description' => array(
							'type'  => 'text',
							'label' => __( 'Description', 'wordpress-theme-boilerplate' ),
						),
						'button_text'        => array(
							'type'  => 'text',
							'label' => __( 'Button text', 'wordpress-theme-boilerplate' ),
						),
						'button_link'        => array(
							'type'  => 'link',
							'label' => __( 'Button link', 'wordpress-theme-boilerplate' ),
						),
					),
				),
				'widget_type' => array(
					'type'    => 'select',
					'label'   => __( 'Choose widget type', 'wordpress-theme-boilerplate' ),
					'options' => array(
						'hero-slider-default' => __( 'Default', 'wordpress-theme-boilerplate' ),
						'hero-slider-full'       => __( 'Full width', 'wordpress-theme-boilerplate' ),
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
			View::instance()->render( 'widgets/' . $template, array( 'instance' => $instance ) );
		}
	}
}