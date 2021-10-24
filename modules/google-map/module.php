<?php
namespace ZeusElementor\Modules\GoogleMap;

use ZeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Google_Map',
		];
	}

	public function get_name() {
		return 'zeus-google-map';
	}
}
