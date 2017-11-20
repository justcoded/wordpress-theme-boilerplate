<?php
namespace Boilerplate\Theme\Page_Builder\Row;

/**
 * Class Wide_Layout
 *
 * @package Boilerplate\Theme\Page_Builder\Row
 */
class Wide_Layout extends \JustCoded\WP\Framework\Page_Builder\v25\Layouts\Rwd_Row_Layout {
	/**
	 * ID
	 *
	 * @var string
	 */
	public static $ID = 'full-width';

	/**
	 * Display name
	 *
	 * @var string
	 */
	public static $TITLE = 'Full Width';

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
			'wide_layout_bg_strech' => array(
				'name'     => 'Strech background',
				'type'     => 'select',
				'group'    => 'layout',
				'options'  => array(
					'No',
					'Yes',
				),
				'priority' => 15,
			),
			'border_color' => null,
		);
	}

	/**
	 * Adjust html attributes for row wrapper div
	 *
	 * @param array $attributes container attributes.
	 * @param array $panel_data panel data settings.
	 *
	 * @return array    update attributes
	 */
	public function row( $attributes, $panel_data ) {
		$attributes['class'] .= ' full-width-wrapper';

		return $attributes;
	}

	/**
	 * Adjust html attributes for row div
	 *
	 * @param array $attributes container attributes.
	 * @param array $style_data row settings.
	 *
	 * @return array    update attributes
	 */
	public function row_inner( $attributes, $style_data ) {
		$attributes['class'][] = ' full-width';

		return parent::row_inner( $attributes, $style_data );
	}

}
