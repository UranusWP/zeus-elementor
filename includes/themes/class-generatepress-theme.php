<?php
/**
 * GeneratePress theme
 */

class Zeus_GeneratePress_Theme {
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
			add_action( 'generate_header', 'zeus_render_header' );
		}

		if ( zeus_footer_enabled() ) {
			add_action( 'template_redirect', [ $this, 'setup_footer' ] );
			add_action( 'generate_footer', 'zeus_render_footer' );
		}
	}

	/**
	 * Disable header from the theme.
	 */
	public function setup_header() {
		remove_action( 'generate_header', 'generate_construct_header' );
	}

	/**
	 * Disable footer from the theme.
	 */
	public function setup_footer() {
		remove_action( 'generate_footer', 'generate_construct_footer_widgets', 5 );
		remove_action( 'generate_footer', 'generate_construct_footer' );
	}

}

new Zeus_GeneratePress_Theme();
