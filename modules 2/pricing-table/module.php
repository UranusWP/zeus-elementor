<?php
namespace ZeusElementor\Modules\PricingTable;

use ZeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Pricing_Table',
		];
	}

	public function get_name() {
		return 'zeus-pricing-table';
	}
}
