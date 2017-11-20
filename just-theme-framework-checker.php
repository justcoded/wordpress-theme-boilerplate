<?php
/**
 * This script is not used within Just Theme Framework itself.
 *
 * This script is meant to be used with your Just Theme Framework-dependent theme or plugin,
 * so that your theme/plugin can verify whether the framework is installed.
 *
 * If JTH is not installed, then the script will display a notice with a link to
 * download. If JTH is installed but not activated, it will display the appropriate notice as well.
 *
 * Also the Just Theme Framework plugin requires Titan Framework plugin to be installed.
 * Appropriate notices will be printed if no plugin is found or plugin is not activated.
 *
 * To use this script, just copy it into your theme/plugin directory then add this in the main file of your project:
 *
 * require_once( 'just-theme-framework-checker.php' );
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
		 * Required plugins settings.
		 *
		 * @var array
		 */
		private $required_plugins = array(
			'just-theme-framework/just-theme-framework.php' => array(
				'Just Theme Framework',
				'//wordpress.org/plugins/just-theme-framework',
			),
			'titan-framework/titan-framework.php'           => array(
				'Titan Framework',
				'//wordpress.org/plugins/titan-framework',
			),
		);

		/**
		 * Just_Theme_Framework_Checker constructor.
		 *
		 * Register admin notices with requirements.
		 *
		 * @throws Exception Show public fatal error if requirements are not met.
		 */
		public function __construct() {

			global $pagenow;
			if ( ! is_admin() &&  'wp-login.php' !== $pagenow && ! $this->check_requirements() ) {
				throw new Exception( 'Your theme requires Just Theme Framework and Titan Framework plugins to be installed and activated.' );
			}
			add_action( 'admin_notices', array( $this, 'display_requirements_admin_notice' ) );

		}

		/**
		 * Check final requirements.
		 *
		 * @return bool
		 */
		public function check_requirements() {
			foreach ( $this->required_plugins as $plugin_file => $plugin_details ) {
				if ( ! is_plugin_active( $plugin_file ) ) {
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
						esc_html( $plugin_details[0] ),
						esc_attr( $plugin_details[1] )
					);
				} elseif ( ! is_plugin_active( $plugin_file ) ) {
					$warnings[] = sprintf( '<strong>%s</strong> plugin should be activated. <a href="%s">Manage Plugins &raquo;</a>',
						esc_html( $plugin_details[0] ),
						esc_attr( admin_url( 'plugins.php' ) )
					);
				}
			}

			$html = '<div class="error"><h3>Please fix the errors below to use current activated theme:</h3><p>' . implode( '</p><p>', $warnings ) . '</p></div>';
			echo wp_kses( $html, 'post' );
		}
	}

	$_jtf_checker = new Just_Theme_Framework_Checker();
} // End if().
