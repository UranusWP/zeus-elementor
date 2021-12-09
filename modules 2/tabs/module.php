<?php
namespace ZeusElementor\Modules\Tabs;

use ZeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Tabs',
		];
	}

	public function get_name() {
		return 'zeus-tabs';
	}
}
