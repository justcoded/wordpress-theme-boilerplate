<?php

namespace Boilerplate\Theme;

use Boilerplate\Theme\Fields\Employee_Fields;
use Boilerplate\Theme\Fields\Page_Fields;
use Boilerplate\Theme\Fields\Theme_Fields;
use Boilerplate\Theme\Fields\User_Fields;
use Boilerplate\Theme\Jobs\Remove_Revisions;
use Boilerplate\Theme\Post_Type\Employee;
use Boilerplate\Theme\Supports\Autoptimize;
use Boilerplate\Theme\Taxonomy\Department;
use Boilerplate\Theme\Rest\Employees_Controller;
use JustCoded\WP\Framework\Supports\Contact_Form7;
use JustCoded\WP\Framework\ACF\ACF_Support;
use JustCoded\WP\Framework\Supports\Just_Responsive_Images;
use JustCoded\WP\Framework\Supports\Just_Tinymce;

/**
 * Theme main entry point
 *
 * Theme setup functions, assets, post types, taxonomies declarations
 */
class Theme extends \JustCoded\WP\Framework\Theme {
	/**
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 *
	 * @var boolean $auto_title
	 */
	public $auto_title = true;

	/**
	 * Available image sizes in Media upload dialog to insert correctly resized image.
	 *
	 * @var array
	 */
	public $available_image_sizes = array(
		'thumbnail' => 'Thumbnail',
		'medium'    => 'Medium',
		'large'     => 'Large',
		'full'      => 'Full Size',
	);

	/**
	 * Enable support for Post Formats.
	 *
	 * Set FALSE to disable post formats
	 *
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 *
	 * @var array $post_formats
	 */
	public $post_formats = array(
		'image',
		'video',
	);

	/**
	 * Disable gutenberg for posts and custom post type.
	 *
	 * Set TRUE to disable it totally.
	 * Set ARRAY to disable only specific ones.
	 *
	 * @var array|bool $disable_gutenberg
	 */
	public $disable_gutenberg = array(
		'page',
	);

	/**
	 * Additional classes initialize
	 */
	public function init() {
		if ( ACF_Support::check_requirements() ) {
			ACF_Support::instance();
			Theme_Fields::instance();
		}

		// cron jobs
		Remove_Revisions::instance();
	}

	/**
	 * Main theme setup function.
	 *
	 * Register components, theme options, widgets etc
	 *
	 * Should be called on after_theme_setup action hook
	 */
	public function theme_setup() {
		parent::theme_setup();

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'boilerplate' ),
		) );
	}

	/**
	 * Register theme sidebars
	 *
	 * Called on 'widgets_init'
	 */
	public function register_sidebars() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'boilerplate' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

	/**
	 * Register styles and scripts
	 *
	 * Called on 'wp_enqueue_scripts'
	 */
	public function register_assets() {
		// Stylesheets.
		$this->register_assets_css( array(
			'styles.css',
		) );

		// Scripts.
		$this->register_assets_scripts( array(
			'jquery.main.js',
		), array( 'jquery' ) );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Register post types
	 */
	public function register_post_types() {
		Employee::instance();

		// register fields.
		Page_Fields::instance();
		User_Fields::instance();
		Employee_Fields::instance();
	}

	/**
	 * Register taxonomies
	 */
	public function register_taxonomies() {
		Department::instance();
	}

	/**
	 * Register rest endpoint
	 */
	public function register_api_endpoints() {
		Employees_Controller::instance();
	}

	/**
	 * Loads hooks for 3d-party plugins.
	 */
	public function support_plugins() {
		Just_Responsive_Images::instance();
		Just_Tinymce::instance();

		if ( Autoptimize::check_requirements() ) {
			Autoptimize::instance();
		}
	}
}
