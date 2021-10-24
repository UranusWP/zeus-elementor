<?php
namespace ZeusElementor\Modules\PageTitle;

use ZeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'PageTitle',
		];
	}

	public function get_name() {
		return 'zeus-page-title';
	}
}
