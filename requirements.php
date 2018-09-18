<?php
/**
 * This script is not used within Just Theme Framework itself.
 *
 * This script is meant to be used with your Just Theme Framework-dependent theme or plugin,
 * so that your theme/plugin can verify whether the framework is installed.
 *
 * If framework is not installed, then the script will display a notice with a link to
 * download. If it is installed but not activated, it will display the appropriate notice as well.
 *
 * To use this script, just copy it into your theme/plugin directory then add this in the main file of your project:
 *
 * require_once( 'requirements.php' );
 *
 * @version 1.0
 *
 * @package Just Theme Framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Required functions as it is only loaded in admin pages.
require_once ABSPATH . 'wp-admin/includes/plugin.php';


if ( ! class_exists( 'Just_Theme_Framework_Checker' ) ) {

	/**
	 * Class Just_Theme_Framework_Checker
	 */
	class Just_Theme_Framework_Checker {

		/**
		 * Refers to a single instance of this class.
		 *
		 * @var Just_Theme_Framework_Checker
		 */
		private static $instance = null;

		/**
		 * Required plugins settings.
		 *
		 * @var array
		 */
		private $required_plugins = array(
			'wordpress-theme-framework/wordpress-theme-framework.php' => array(
				'\JustCoded\WP\Framework\Autoload',
				'WordPress Theme Framework',
				'https://github.com/justcoded/wordpress-theme-framework',
			),
			'advanced-custom-fields-pro/acf.php' => array(
				'\ACF',
				'Advanced Custom Fields',
				'https://www.advancedcustomfields.com/pro/',
			),
		);

		/**
		 * Just_Theme_Framework_Checker constructor.
		 *
		 * Register admin notices with requirements.
		 *
		 * @throws Exception Show public fatal error if requirements are not met.
		 */
		private function __construct() {
			global $pagenow;
			if ( ! is_admin() && 'wp-login.php' !== $pagenow && ! $this->check_requirements() ) {
				throw new Exception( 'Your theme requires WordPress Theme Framework and Advanced Custom Fields PRO plugins to be installed and activated.' );
			}
			add_action( 'admin_notices', array( $this, 'display_requirements_admin_notice' ) );
		}

		/**
		 * Returns the *Singleton* instance of this class.
		 *
		 * @return Just_Theme_Framework_Checker A single instance of this class.
		 */
		public static function single() {
			if ( null === static::$instance ) {
				static::$instance = new static();
			}

			return static::$instance;
		}

		/**
		 * Check final requirements.
		 *
		 * @return bool
		 */
		public function check_requirements() {
			foreach ( $this->required_plugins as $plugin_file => $plugin_details ) {
				if ( ! class_exists( $plugin_details[0] ) && ! is_plugin_active( $plugin_file ) ) {
					return false;
				}
			}

			return true;
		}

		/**
		 * Print admin notices in case of requirements are not met.
		 * Can print "missing plugin" or "not activated" warnings.
		 */
		public function display_requirements_admin_notice() {
			if ( $this->check_requirements() ) {
				return;
			}

			$warnings = array();
			foreach ( $this->required_plugins as $plugin_file => $plugin_details ) {
				$plugin_path = WP_PLUGIN_DIR . '/' . $plugin_file;

				if ( ! is_file( $plugin_path ) ) {
					$warnings[] = sprintf( '<strong>%s</strong> plugin should be installed. <a href="%s" target="_blank">Download plugin &raquo;</a>',
						esc_html( $plugin_details[1] ),
						esc_attr( $plugin_details[2] )
					);
				} elseif ( ! is_plugin_active( $plugin_file ) ) {
					$warnings[] = sprintf( '<strong>%s</strong> plugin should be activated. <a href="%s">Manage Plugins &raquo;</a>',
						esc_html( $plugin_details[1] ),
						esc_attr( admin_url( 'plugins.php' ) )
					);
				}
			}

			$html = '<div class="error"><h3>Please fix the errors below to use current activated theme:</h3><p>' . implode( '</p><p>', $warnings ) . '</p></div>';
			echo wp_kses( $html, array(
				'div' => [
					'class' => true,
				],
				'h3'  => true,
				'p'   => true,
				'a'   => [
					'href'   => true,
					'target' => true,
				],
			) );
		}
	}

	Just_Theme_Framework_Checker::single();
}
