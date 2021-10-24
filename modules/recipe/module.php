<?php
namespace ZeusElementor\Modules\Recipe;

use ZeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Recipe',
		];
	}

	public function get_name() {
		return 'zeus-recipe';
	}
}
