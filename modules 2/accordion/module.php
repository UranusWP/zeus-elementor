<?php
namespace ZeusElementor\Modules\Accordion;

use ZeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Accordion',
		];
	}

	public function get_name() {
		return 'zeus-accordion';
	}
}
