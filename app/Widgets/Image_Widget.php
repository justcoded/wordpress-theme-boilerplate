<?php

namespace Boilerplate\Theme\Widgets;

use JustCoded\WP\Framework\Page_Builder\v25\Page_Builder_Widget;
use JustCoded\WP\Framework\Web\View;

/**
 * Class Image_Widget
 * Custom image wordpress widget based on siteorigin widgets bundle
 */
class Image_Widget extends Page_Builder_Widget {
	/**
	 * Image_Widget constructor.
	 */
	function __construct() {
		parent::__construct(
			'single-image',
			__( 'Image' ),
			array(
				'description' => __( 'A customizable image widget.' ),
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
			'single-image.png' => 'Single Image. Will be clickable if External URL is set.',
		);
	}

	/**
	 * Form fields configuration
	 *
	 * @return array
	 */
	function get_widget_form() {
		return array(
			'image' => array(
				'type'     => 'media',
				'label'    => __( 'Image file' ),
				'library'  => 'image',
				'fallback' => true,
				'default'  => null,
			),
			'size'  => array(
				'type'    => 'image-size',
				'label'   => __( 'Image size' ),
				'default' => 'thumbnail',
			),
			'link'  => array(
				'type'   => 'section',
				'label'  => __( 'Link' ),
				'fields' => array(
					'url'        => array(
						'type'  => 'link',
						'label' => __( 'Destination URL' ),
					),
					'new_window' => array(
						'type'    => 'checkbox',
						'label'   => __( 'Open in a new tab' ),
						'default' => true,
					),
				),
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
		$instance['link']['url'] = strip_tags( $instance['link']['url'] );

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

		if ( ! empty( $image ) ) {
			View::render( 'widgets/image', array(
				'image'    => $image,
				'instance' => $instance,
			) );
		}
	}
}