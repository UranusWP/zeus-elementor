<?php
namespace ZeusElementor\Modules\WooCategories;

use ZeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'WooCategories',
		];
	}

	public function get_name() {
		return 'zeus-woo-categories';
	}

	public function register_wc_hooks() {
		wc()->frontend_includes();
	}

	public function __construct() {
		parent::__construct();

		// Return if not activated
		if ( ! is_woocommerce_active() ) {
			return;
		}

		// On Editor - Register WooCommerce frontend hooks before the Editor init.
		// Priority = 5, in order to allow plugins remove/add their wc hooks on init.
		if ( ! empty( $_REQUEST['action'] ) && 'elementor' === $_REQUEST['action'] && is_admin() ) {
			add_action( 'init', [ $this, 'register_wc_hooks' ], 5 );
		}

	}
}
