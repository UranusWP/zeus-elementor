<?php
namespace ZeusElementor\Modules\Instagram;

use ZeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Instagram',
		];
	}

	public function get_name() {
		return 'zeus-instagram';
	}

	public function __construct() {
		parent::__construct();
		require_once ZEUS_ELEMENTOR_PATH . 'includes/class-zeus-instagram-api.php';
	}
}
