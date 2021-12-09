<?php
namespace ZeusElementor\Modules\ScrollUp;

use ZeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Scroll_Up',
		];
	}

	public function get_name() {
		return 'zeus-scroll-up';
	}
}
