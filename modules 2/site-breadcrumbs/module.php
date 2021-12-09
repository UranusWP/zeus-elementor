<?php
namespace ZeusElementor\Modules\SiteBreadcrumbs;

use ZeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'SiteBreadcrumbs',
		];
	}

	public function get_name() {
		return 'zeus-site-breadcrumbs';
	}

	public function __construct() {
		parent::__construct();
		require_once ZEUS_ELEMENTOR_PATH . 'includes/class-zeus-breadcrumb-trail.php';
	}
}
