<?php

namespace Boilerplate\Theme\Blocks;

use JustCoded\WP\Framework\ACF\ACF_Gutenberg;

class Testimonials_Block extends ACF_Gutenberg {
	/**
	 * Init fields configuration method
	 */
	public function init() {
		$this->slug        = 'testimonial';
		$this->title       = 'Testimonial';
		$this->description = 'Customer testimonial';
		$this->icon        = 'admin-comments';
		$this->keywords    = array( 'testimonial', 'quote' );

		$this->register_block();
	}
}
