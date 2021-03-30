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
	 * @param string $type module|page.
	 *
	 * @return array
	 */
	public static function get_button( $type = 'module' ) {
		$self         = new self( $type );
		$self->button = $self->collect();

		return $self->button;
	}

	/**
	 * Button constructor.
	 *
	 * @param $type
	 */
	private function __construct( $type ) {
		$this->page_id = get_the_ID();
		$this->fields  = $this->detect( $type );
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
				if ( ! empty( $this->fields['anc_link'] ) ) {
					$button['link'] = get_permalink( $this->fields['anc_link'] ) . '#' . $this->fields['anchor'];
					break;
				}

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
	 * @param string $type
	 *
	 * @return array|null
	 */
	private function detect( $type = 'module' ) {
		if ( empty( $this->page_id ) || 0 === $this->page_id ) {
			return null;
		}

		switch ( $type ) {
			case 'module':
				return get_sub_field( 'button', $this->page_id );
			case 'page':
				return get_field( 'button', $this->page_id );
			default:
				return null;
		}
	}
}
