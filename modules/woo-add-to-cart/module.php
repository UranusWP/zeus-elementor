<?php
namespace ZeusElementor\Modules\WooAddToCart;

use ZeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'WooAddToCart',
		];
	}

	public function get_name() {
		return 'zeus-woo-addtocart';
	}
}
