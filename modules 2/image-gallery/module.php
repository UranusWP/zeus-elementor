<?php
namespace ZeusElementor\Modules\ImageGallery;

use ZeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'ImageGallery',
		];
	}

	public function get_name() {
		return 'zeus-image-gallery';
	}
}
