<?php
namespace Boilerplate\Theme\Page_Builder\Widget;

/**
 * Class Hero_Layout
 *
 * @package Boilerplate\Theme\Page_Builder\Widget
 */
class Hero_Layout extends \JustCoded\WP\Framework\Page_Builder\v25\Layouts\Rwd_Widget_Layout {
	/**
	 * ID
	 *
	 * @var string
	 */
	public static $ID = 'hero-widget';

	/**
	 * Display name
	 *
	 * @var string
	 */
	public static $TITLE = 'Hero size';

	/**
	 * Image size for background image in case of RWD plugin enabled.
	 *
	 * @var string
	 */
	public $background_image_size = 'large';

	/**
	 * Additional options to add into Row option controls
	 *
	 * @return array
	 */
	public function options() {
		return array(
			'hero_size' => array(
				'name'     => 'Hero size',
				'type'     => 'select',
				'group'    => 'layout',
				'options'  => array(
					'default' => 'Default',
					'big' => 'Really big',
				),
				'priority' => 15,
			),
			'border_color' => null,
		);
	}

	/**
	 * Adjust html attributes for widget div
	 *
	 * @param array $attributes  container attributes.
	 * @param array $style_data  panel data settings.
	 *
	 * @return array    update attributes
	 */
	public function widget( $attributes, $style_data ) {
		return parent::widget( $attributes, $style_data );
	}

	/**
	 * Replace wrapper classes string
	 *
	 * @param array  $classes html attribute.
	 * @param array  $style_data selected style options.
	 * @param string $widget widget class name.
	 * @param array  $instance widget data.
	 *
	 * @return array
	 */
	public function widget_inner_classes( array $classes, $style_data, $widget, $instance ) {
		$classes[] = ' widget-hero';

		return $classes;
	}


}
