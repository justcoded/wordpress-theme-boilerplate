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
	 * Hero_Slider_Widget constructor.
	 */
	function __construct() {
		parent::__construct(
			'hero-image',
			__( 'Slider image widget' ),
			array(
				'description' => __( 'Slider image widget.' ),
				'has_preview' => true,
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
			'slider-image.png' => 'Preview of the slider widget',
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
					'label'      => __( 'Images', 'so-widgets-bundle' ),
					'item_name'  => __( 'Image', 'so-widgets-bundle' ),
					'item_label' => array(
						'selector'     => "[name*='title']",
						'update_event' => 'change',
						'value_method' => 'val',
					),

					'fields' => array(
						'image'       => array(
							'type'  => 'media',
							'label' => __( 'Image', 'so-widgets-bundle' ),
						),
						'title'       => array(
							'type'  => 'text',
							'label' => __( 'Image title', 'so-widgets-bundle' ),
						),
						'description' => array(
							'type'  => 'text',
							'label' => __( 'Description', 'so-widgets-bundle' ),
						),

						'url'        => array(
							'type'  => 'link',
							'label' => __( 'URL', 'so-widgets-bundle' ),
						),
						'new_window' => array(
							'type'    => 'checkbox',
							'default' => false,
							'label'   => __( 'Open in new window', 'so-widgets-bundle' ),
						),
					),
				),
				'widget_type' => array(
					'type'    => 'select',
					'label'   => __( 'Choose widget type', 'so-widgets-bundle' ),
					'options' => array(
						'full'       => __( 'Full width', 'so-widgets-bundle' ),
						'right-text' => __( 'With right text', 'so-widgets-bundle' ),
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
		if ( ! empty( $instance['image'] ) ) {
			$image = wp_get_attachment_image( $instance['image'], $instance['size'] );
		}
		if ( ! empty( $instance['images'] ) ) {
			if ( 'right-text' === $instance['widget_type'] ) {
				View::render( 'widgets/Right_Text_Slider', array(
					'image_data' => $instance['images'],
				) );
			} else {
				View::render( 'widgets/Full_Width_Slider', array(
					'image_data' => $instance['images'],
				) );
			}
		}
	}
}