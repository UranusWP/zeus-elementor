<?php
namespace ZeusElementor\Modules\CalderaForms;

use ZeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Caldera_Forms',
		];
	}

	public function get_name() {
		return 'zeus-caldera-forms';
	}
}
