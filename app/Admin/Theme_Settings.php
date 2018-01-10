<?php
namespace Boilerplate\Theme\Admin;

/**
 * App backend settings page options
 */
class Theme_Settings extends \JustCoded\WP\Framework\Admin\Theme_Settings {
	/**
	 * Create admin page for theme settings
	 */
	public function init() {
		$panel = static::titan_instance()->createContainer( array(
			'type' => 'admin-page',
			'name' => 'Theme Options',
		) );

		$this->register_general_tab( $panel );
		$this->register_social_tab( $panel );
		$this->register_404_tab( $panel );
	}

	/**
	 * Register fields for General tab
	 *
	 * @param \TitanFrameworkAdminPage $panel  panel object to work with.
	 */
	protected function register_general_tab( $panel ) {
		$tab = $panel->createTab( array(
			'name' => 'General',
		) );

		$tab->createOption( array(
			'name' => 'Footer ',
			'type' => 'heading',
		) );

		$tab->createOption( array(
			'name'    => 'Copyright text',
			'id'      => 'copyright_text',
			'type'    => 'text',
			'default' => '&copy; ' . date( 'Y' ) . '. All rights reserved.',
		) );

		$tab->createOption( array(
			'type' => 'save',
		) );
	}

	/**
	 * Register fields for Social links tab.
	 *
	 * @param \TitanFrameworkAdminPage $panel  panel object to work with.
	 */
	protected function register_social_tab( $panel ) {
		$tab = $panel->createTab( array(
			'name' => 'Social links',
		) );

		$tab->createOption( array(
			'name'        => 'Facebook page',
			'id'          => 'social_fb',
			'type'        => 'text',
			'placeholder' => 'http://facebook.com/my-page',
		) );

		$tab->createOption( array(
			'name'        => 'Twitter account',
			'id'          => 'social_twitter',
			'type'        => 'text',
			'placeholder' => 'http://twitter.com/@some-username',
		) );

		$tab->createOption( array(
			'name'        => 'Google+',
			'id'          => 'social_gplus',
			'type'        => 'text',
			'placeholder' => 'https://plus.google.com/-unique-profile-id-',
		) );

		$tab->createOption( array(
			'type' => 'save',
		) );
	}

	/**
	 * Register fields for 404 tab.
	 *
	 * @param \TitanFrameworkAdminPage $panel  panel object to work with.
	 */
	protected function register_404_tab( $panel ) {
		$tab = $panel->createTab( array(
			'name' => '404 Page',
		) );

		$tab->createOption( array(
			'name'    => 'Title',
			'id'      => '404_title',
			'type'    => 'text',
			'default' => __( 'Oops! That page can&rsquo;t be found.', 'boilerplate' ),
		) );

		$tab->createOption( array(
			'name'    => 'Content',
			'id'      => '404_content',
			'type'    => 'editor',
			'default' => __( 'It looks like nothing was found at this location. Maybe try one of the links in menu or a search?', 'boilerplate' ),
		) );

		$tab->createOption( array(
			'type' => 'save',
		) );
	}
}
