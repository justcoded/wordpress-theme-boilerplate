<?php


namespace JCWP\Theme\Models;

/**
 * Class Button
 *
 * @package Credicus\Theme\Models
 */
class Button {

	/**
	 * Button atts array
	 *
	 * @var array $button
	 */
	private $button;

	/**
	 * Current page ID
	 *
	 * @var false|int $page_id .
	 */
	private $page_id;

	/**
	 * Button module fields
	 *
	 * @var false|mixed|null $fields .
	 */
	private $fields;

	/**
	 * Get_button
	 *
	 * @return array|null
	 */
	public static function get_button() {
		$self         = new self();
		$self->button = $self->collect();

		return $self->button;
	}

	/**
	 * Button constructor.
	 */
	private function __construct() {
		$this->page_id = get_the_ID();
		$this->fields  = $this->detect();
	}

	/**
	 * Collect
	 *
	 * @return array
	 */
	private function collect(): array {
		$button = array(
			'exist'  => false,
			'title'  => '',
			'link'   => '',
			'target' => '',
		);

		if ( empty( $this->fields ) || true !== $this->fields['enable'] ) {
			return $button;
		}

		$button['title'] = $this->fields['title'];

		if ( ! empty( $button['title'] ) ) {
			$button['exist'] = true;
		}

		switch ( $this->fields['type'] ) {
			case 'internal':
				$button['link'] = get_permalink( $this->fields['int_link'] );
				break;
			case 'external':
				$button['link']   = $this->fields['ext_link'];
				$button['target'] = 'target="_blank"';
				break;
			case 'anchor':
				$button['link'] = '#' . $this->fields['anchor'];
				break;
			default:
				break;
		}

		return $button;
	}

	/**
	 * Detect
	 *
	 * @return array|null
	 */
	private function detect() {
		if ( empty( $this->page_id ) || 0 === $this->page_id ) {
			return null;
		}

		return get_sub_field( 'button', $this->page_id );
	}
}
