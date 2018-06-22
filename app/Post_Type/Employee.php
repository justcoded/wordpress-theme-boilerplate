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
		$faker = FakerContent::instance();

		return [
			'post_title'          => $faker->words( 2 ),
			'post_content'        => $faker->text( 500 ),
			'post_featured_image' => $faker->attachment_generated( 1280, 920 ),
			'content_fields'      => $faker->flexible_content(
				[
					'name_layout' => [
						[
							'text_field'         => $faker->text( 500 ),
							'image_field'        => $faker->attachment_generated( 1500, 750 ),
							'words_field'        => $faker->words( 5 ),
							'number_field'       => $faker->number(),
							'date_field'         => $faker->date(),
							'timezone_field'     => $faker->timezone(),
							'person_name_field'  => $faker->person(),
							'company_name_field' => $faker->company(),
							'email_field'        => $faker->email(),
							'domain_name_field'  => $faker->domain(),
							'ip_address_field'   => $faker->ip(),
						],
						[
							'text_field'         => $faker->text( 500 ),
							'image_field'        => $faker->attachment_generated( 480, 240 ),
							'words_field'        => $faker->words( 5 ),
							'number_field'       => $faker->number(),
							'date_field'         => $faker->date(),
							'timezone_field'     => $faker->timezone(),
							'person_name_field'  => $faker->person(),
							'company_name_field' => $faker->company(),
							'email_field'        => $faker->email(),
							'domain_name_field'  => $faker->domain(),
							'ip_address_field'   => $faker->ip(),
						],
					],
				]
			),
			'gallery'             => $faker->repeater(
				[
					[
						'link'        => $faker->domain(),
						'image_field' => $faker->attachment_generated( 480, 240 ),
					],
					[
						'link'        => $faker->domain(),
						'image_field' => $faker->attachment_generated( 480, 240 ),
					],
					[
						'link'        => $faker->domain(),
						'image_field' => $faker->attachment_generated( 480, 240 ),
					],
				]
			),
		];
	}
}
