<?php
namespace ZeusElementor\Modules\MemberCarousel;

use ZeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Member_Carousel',
		];
	}

	public function get_name() {
		return 'zeus-member-carousel';
	}
}
