<?php

namespace Boilerplate\Theme\Post_Type;

use Boilerplate\Theme\Taxonomy\Department;
use JustCoded\WP\Framework\Objects\Post_Type;
use JustCoded\WP\Framework\Supports\FakerContent;

/**
 * Custom post type Employee to illustrate single/archive features
 */
class Employee extends Post_Type {
	/**
	 * ID
	 *
	 * @var string
	 */
	public static $ID = 'employee';

	/**
	 * Rewrite URL part
	 *
	 * @var string
	 */
	public static $SLUG = 'employee';

	/**
	 * Registration function
	 */
	public function init() {
		$this->label_singular = 'Employee';
		$this->label_multiple = 'Employees';
		$this->textdomain     = 'boilerplate';

		$this->has_single       = true;
		$this->is_searchable    = true;
		$this->rewrite_singular = false;

		$this->is_hierarchical = false;

		$this->admin_menu_pos  = 25;
		$this->admin_menu_icon = 'dashicons-format-gallery';

		$this->taxonomies = array(
			Department::$ID,
		);

		$this->register();
	}

	/**
	 * Generate faker content
	 */
	public function faker() {
		$fkr = FakerContent::instance();

		return [
			// Post object fields.
			'post_title'          => $fkr->person(),
			'post_content'        => $fkr->html_text( [ 3, 5 ] ),
			'post_featured_image' => $fkr->image_attachment( 1280, 920 ),

			// Simple meta data.
			'level'               => $fkr->faker->randomElement( [ '', 'Junior', 'Middle', 'Senior' ] ),
			'position'            => $fkr->job_title(),
			'bio'                 => $fkr->text( 200 ),

			// Repeater example.
			'gallery'             => $fkr->repeater(
				[ 1, 5 ],
				function () use ( $fkr ) {
					return [
						'image' => $fkr->image_attachment( 480, 240 ),
					];
				}
			),
			// ACF Flexible Content generator and fields examples.
			'flex_content'        => $fkr->flexible_content( [
				$fkr->flexible_layout( 'module_A', [
					'words'        => $fkr->words( 5 ),
					'number'       => $fkr->number(),
					'date'         => $fkr->date(),
					'person_name'  => $fkr->person(),
					'company_name' => $fkr->company(),
					'job_title'    => $fkr->job_title(),
					'email'        => $fkr->email(),
					'domain_name'  => $fkr->faker->domainName,
				] ),
				$fkr->flexible_layout( 'module_B', [
					'text_field' => $fkr->words( 5 ),
				] ),
			] ),
		];
	}
}
