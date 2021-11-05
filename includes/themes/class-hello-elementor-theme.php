<?php
/**
 * Hello Elementor theme
 */

class Zeus_Hello_Elementor_Theme {
	private static $instance = null;

	/**
	 * Instance.
	 *
	 * @return object Class object.
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Initiator
	 */
	public function __construct() {
		if ( ! class_exists( 'Zeus_Default_Theme' ) ) {
			require_once ZEUS_ELEMENTOR_PATH . 'includes/themes/default/class-default-theme.php';
		}
	}
}
Zeus_Hello_Elementor_Theme::get_instance();
