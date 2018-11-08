<?php

namespace Boilerplate\Theme\Fields;

use JustCoded\WP\Framework\ACF\ACF_Register;

class Theme_Fields extends ACF_Register {

	/**
	 * Init fields configuration method
	 */
	public function init() {
		$this->add_options_page( 'Theme options' );

		$this->has(
			$this->build('theme_options', [
				'style' => 'seamless',
			])
				->addTab( 'General' )
				->addFields( $this->general_tab() )
				->addTab( 'Socials Links' )
				->addFields( $this->socials_tab() )
				->addTab( '404 Page' )
				->addFields( $this->page_404_tab() )
				->setLocation( 'options_page', '==', 'acf-options-theme-options' )
		);
	}

	protected function general_tab() {
		return $this->build( 'general_options' )
			->addImage( 'site_logo' )
			->addText( 'copyright_text' )
			->setDefaultValue( '&copy; ' . date( 'Y' ) . '. All rights reserved.' )
			->addImage( 'image_placeholder', array( 'return_format' => 'id' ) )
			->getRootContext();
	}

	protected function socials_tab() {
		return $this->build( 'socials_options' )
			->addText( 'social_fb', [ 'label' => 'Facebook Page' ] )
			->setDefaultValue( 'http://facebook.com/my-page' )
			->addText( 'social_twitter', [ 'label' => 'Twitter account' ] )
			->setDefaultValue( 'http://twitter.com/@some-username' )
			->addText( 'social_gplus', [ 'label' => 'Google+' ] )
			->setDefaultValue( 'https://plus.google.com/-unique-profile-id-' )
			->getRootContext();
	}

	protected function page_404_tab() {
		return $this->build( '404_options' )
			->addText( 'page_404_title', [ 'label' => '404 Page Title' ] )
			->addWysiwyg( 'page_404_content', [ 'label' => '404 Page Content' ] )
			->getRootContext();
	}
}
