<?php
namespace ZeusElementor;

use ZeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Modules_Manager {
	private $modules = [];

	public function register_modules() {

		// Register all activated widgets from the settings page.
		foreach ( $GLOBALS['zeus_widgets'] as $widget => $val ) {
			$class = $val['class'];
			$class_name = __NAMESPACE__ . '\\Modules\\' . $class . '\Module';

			// Check if widgets are enabled.
			$settings = get_option( 'zeus_settings' );
			if ( $settings ) {
				$setting = $settings[ $widget ];
			} else {
				$setting = true;
			}

			if ( true === $setting ) {
				$this->modules[ $widget ] = $class_name::instance();
			}
		}

		// Add query custom control for some widgets.
		$q_name = __NAMESPACE__ . '\\Modules\\QueryPost\Module';
		$this->modules['query-post'] = $q_name::instance();
	}

	private function require_files() {
		require ZEUS_ELEMENTOR_PATH . 'base/module.php';
	}

	public function __construct() {
		$this->require_files();
		$this->register_modules();
	}
}
