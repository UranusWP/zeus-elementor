<?php
/**
 * Hello Elementor theme
 */

class Zeus_Hello_Elementor_Theme {
	private static $instance;

	/**
	 * Instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
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

new Zeus_Hello_Elementor_Theme();
