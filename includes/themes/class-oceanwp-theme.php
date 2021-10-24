<?php
/**
 * OceanWP theme
 */

class Zeus_OceanWP_Theme {
	private static $instance;

	/**
	 * Instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Initiator
	 */
	public function __construct() {
		add_action( 'wp', [ $this, 'hooks' ] );
	}

	/**
	 * Run all the Actions / Filters.
	 */
	public function hooks() {
		if ( zeus_header_enabled() ) {
			add_action( 'template_redirect', [ $this, 'setup_header' ] );
			add_action( 'ocean_header', 'zeus_render_header' );
		}

		if ( zeus_footer_enabled() ) {
			add_action( 'template_redirect', [ $this, 'setup_footer' ] );
			add_action( 'ocean_footer', 'zeus_render_footer' );
		}
	}

	/**
	 * Disable header from the theme.
	 */
	public function setup_header() {
		remove_action( 'ocean_top_bar', 'oceanwp_top_bar_template' );
		remove_action( 'ocean_header', 'oceanwp_header_template' );
		remove_action( 'ocean_page_header', 'oceanwp_page_header_template' );
	}

	/**
	 * Disable footer from the theme.
	 */
	public function setup_footer() {
		remove_action( 'ocean_footer', 'oceanwp_footer_template' );
	}

}

new Zeus_OceanWP_Theme();
