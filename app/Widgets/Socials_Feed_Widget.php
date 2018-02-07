<?php

namespace Boilerplate\Theme\Widgets;

use JustCoded\WP\Framework\Page_Builder\v25\Page_Builder_Widget;
use JustCoded\WP\Framework\Web\View;

/**
 * Class SocialsFeedWidget
 */
// Creating the widget
class Socials_Feed_Widget extends Page_Builder_Widget {


	/**
	 * Full slider type template name
	 */
	const TYPE_FULL = 'socials-feed-full';

	/**
	 * Default slider type template name
	 */
	const TYPE_DEFAULT = 'socials-feed-default';


	/**
	 * Hero_Slider_Widget constructor.
	 */
	function __construct() {
		parent::__construct(
			'socials-feed',
			__( 'Socials Feed' ),
			array(
				'description' => __( 'Socials Feed' ),
				'has_preview' => false,
			),
			array(),
			false,
			''
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
				'social_networks' => array(
					'type' => 'section',
					'label' => __( 'Choose socials network for show' , 'boilerplate' ),
					'hide' => true,
					'fields' => array(
						'facebook' => array(
							'type' => 'checkbox',
							'label' => __( 'Facebook', 'boilerplate' ),
							'default' => false
						),
						'twitter' => array(
							'type' => 'checkbox',
							'label' => __( 'Twitter', 'boilerplate' ),
							'default' => false
						),
						'instagram' => array(
							'type' => 'checkbox',
							'label' => __( 'Instagram', 'boilerplate' ),
							'default' => false
						),
					)
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
			$template = ( self::TYPE_FULL === $instance['widget_type'] ) ? 'socials-feed-full' : 'socials-feed-default';
			View::instance()->include( 'widgets/' . $template, array(
				'instance'      => $instance,
				'before_widget' => $args['before_widget'],
				'after_widget'  => $args['after_widget'],
			) );
	}
} // Class wpb_widget ends here