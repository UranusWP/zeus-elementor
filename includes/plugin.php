<?php
namespace ZeusElementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

use \Elementor\Plugin;

// Elementor Classes
use \Elementor\Controls_Manager;

/**
 * Main Plugin Class
 *
 * Register elementor widget.
 *
 * @since 1.0.0
 */
class ZeusElementorPlugin {

	/**
	 * @var Manager
	 */
	public $modules_manager;

	/**
	 * @var Plugin
	 */
	private static $_instance;
	/**
	 * @var Module_Base[]
	 */
	private $modules = array();

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		spl_autoload_register( array( $this, 'autoload' ) );

		add_action( 'elementor/init', array( $this, 'init' ), 0 );
		add_action( 'elementor/init', array( $this, 'init_panel_section' ), 0 );
		add_action( 'elementor/elements/categories_registered', array( $this, 'init_panel_section' ) );

		// Modules to enqueue styles
		$this->modules = array(
			'accordion',
			'advanced-heading',
			'alert',
			'animated-heading',
			'banner',
			'blog-carousel',
			'blog-grid',
			'brands',
			'business-hours',
			'buttons',
			'call-to-action',
			'circle-progress',
			'content-protection',
			'countdown',
			'flip-box',
			'google-map',
			'hotspots',
			'image-comparison',
			'image-gallery',
			'info-box',
			'instagram',
			'logo',
			'mailchimp',
			'member',
			'member-carousel',
			'modal',
			'navbar',
			'off-canvas',
			'price-list',
			'pricing-table',
			'recipe',
			'scroll-up',
			'search',
			'search-icon',
			'skillbar',
			'table',
			'tabs',
			'testimonial',
			'testimonial-carousel',
			'timeline',
			'toggle',
			'woo-addtocart',
			'woo-products',
			'woo-slider',
			'woo-categories',
		);
	}

	/**
	 * Autoload Classes
	 *
	 * @since 1.0.0
	 */
	public function autoload( $class ) {
		if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
			return;
		}

		$class_to_load = $class;

		if ( ! class_exists( $class_to_load ) ) {
			$filename = strtolower(
				preg_replace(
					array( '/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ),
					array( '', '$1-$2', '-', DIRECTORY_SEPARATOR ),
					$class_to_load
				)
			);
			$filename = ZEUS_ELEMENTOR_PATH . $filename . '.php';

			if ( is_readable( $filename ) ) {
				include $filename;
			}
		}
	}

	/**
	 * Init
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	public function init() {

		// Elementor hooks
		$this->add_actions();

		// Include extensions
		$this->includes();

		// Components
		$this->init_components();

		do_action( 'zeus_elementor/init' );
	}

	/**
	 * Plugin instance
	 *
	 * @since 1.0.0
	 * @return Plugin
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {

		// Front-end Scripts
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_scripts' ) );
		add_action( 'elementor/frontend/after_register_styles', array( $this, 'register_styles' ) );

		// Load some widgets CSS on front end to avoid styling issues
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widgets_styles' ] );

		// Preview Styles
		add_action( 'elementor/preview/enqueue_styles', array( $this, 'preview_styles' ) );

		// Editor Style
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'editor_style' ) );
	}

	/**
	 * Register scripts
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function register_scripts() {

		$ajax_url  	= admin_url( 'admin-ajax.php' );
		$zeus_nonce = wp_create_nonce( 'zeus' );
		$dir_name 	= ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';
		$suffix     = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$map_api 	= get_option( 'zeus_google_map_api_key' );

		// Register vendors scripts.
		wp_enqueue_script(
			'asPieProgress',
			ZEUS_ASSETS_URL . 'js/vendors/asPieProgress.min.js',
			array(),
			false,
			true
		);

		wp_register_script(
			'event-move',
			ZEUS_ASSETS_URL . 'js/vendors/event.move.min.js',
			array(),
			false,
			true
		);
		wp_register_script(
			'twentytwenty',
			ZEUS_ASSETS_URL . 'js/vendors/twentytwenty.min.js',
			array(),
			false,
			true
		);
		wp_register_script(
			'imagesloaded',
			ZEUS_ASSETS_URL . 'js/vendors/imagesloaded.min.js',
			array(),
			false,
			true
		);

		wp_register_script(
			'morphext',
			ZEUS_ASSETS_URL . 'js/vendors/morphext.min.js',
			array(),
			false,
			true
		);
		wp_register_script(
			'typed',
			ZEUS_ASSETS_URL . 'js/vendors/typed.min.js',
			array(),
			false,
			true
		);

		wp_register_script(
			'popper',
			ZEUS_ASSETS_URL . 'js/vendors/popper.min.js',
			array(),
			false,
			true
		);
		wp_register_script(
			'tippy',
			ZEUS_ASSETS_URL . 'js/vendors/tippy-bundle.umd.min.js',
			array(),
			false,
			true
		);

		// Register widgets scripts.
		if ( isset( $map_api ) && ! empty( $map_api ) ) {
			wp_register_script(
				'zeus-google-map-api',
				'https://maps.googleapis.com/maps/api/js?key=' . $map_api,
				'',
				rand()
			);
		} else {
			wp_register_script(
				'zeus-google-map-api',
				'https://maps.googleapis.com/maps/api/js',
				'',
				rand()
			);
		}

		wp_register_script(
			'zeus-accordion',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/accordion' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'zeus-alert',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/alert' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'zeus-animated-heading',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/animated-heading' . $suffix . '.js',
			array( 'elementor-frontend', 'morphext', 'typed' ),
			false,
			true
		);

		wp_register_script(
			'zeus-blog-carousel',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/blog-carousel' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'zeus-blog-grid',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/blog-grid' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'zeus-circle-progress',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/circle-progress' . $suffix . '.js',
			array( 'elementor-frontend', 'asPieProgress' ),
			false,
			true
		);

		wp_register_script(
			'zeus-countdown',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/countdown' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'zeus-google-map',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/google-map' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'zeus-hotspots',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/hotspots' . $suffix . '.js',
			array( 'elementor-frontend', 'popper', 'tippy' ),
			false,
			true
		);

		wp_register_script(
			'zeus-image-comparison',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/image-comparison' . $suffix . '.js',
			array( 'elementor-frontend', 'event-move', 'twentytwenty', 'imagesloaded' ),
			false,
			true
		);

		wp_register_script(
			'zeus-member',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/member' . $suffix . '.js',
			array( 'elementor-frontend', 'popper', 'tippy' ),
			false,
			true
		);

		wp_register_script(
			'zeus-member-carousel',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/member-carousel' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'zeus-menu',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/menu' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'zeus-modal',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/modal' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'zeus-navbar',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/navbar' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'zeus-mailchimp',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/mailchimp' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);
		wp_localize_script(
			'zeus-mailchimp',
			'localize',
			array(
				'ajax_url' => $ajax_url,
				'nonce'    => $zeus_nonce,
			)
		);

		wp_register_script(
			'zeus-off-canvas',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/off-canvas' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'zeus-pricing-table',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/pricing-table' . $suffix . '.js',
			array( 'elementor-frontend', 'popper', 'tippy' ),
			false,
			true
		);

		wp_register_script(
			'zeus-scroll-up',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/scroll-up' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'zeus-search-icon',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/search-icon' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'zeus-search',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/search' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);
		wp_localize_script(
			'zeus-search',
			'searchData',
			array(
				'ajax_url' => $ajax_url,
				'nonce'    => $zeus_nonce,
			)
		);

		wp_register_script(
			'zeus-skillbar',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/skillbar' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'zeus-tabs',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/tabs' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'zeus-testimonial-carousel',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/testimonial-carousel' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'zeus-toggle',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/toggle' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'zeus-tooltip',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/tooltip' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'zeus-woo-slider',
			ZEUS_ASSETS_URL . 'js/' . $dir_name . '/woo-slider' . $suffix . '.js',
			array( 'elementor-frontend' ),
			false,
			true
		);

	}

	/**
	 * Register styles
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function register_styles() {
		$dir_name = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		// General style (match all themes).
		wp_enqueue_style( 'zeus-general', ZEUS_ASSETS_URL . 'css/' . $dir_name . '/general' . $suffix . '.css' );

		// Vendors.
		wp_register_style( 'tippy', ZEUS_ASSETS_URL . 'css/vendors/tippy/tippy.css', array(), '6.3.1', 'all' );

		// Widgets.
		foreach ( $this->modules as $module_name ) {
			wp_register_style(
				'zeus-' . $module_name . '',
				ZEUS_ASSETS_URL . 'css/' . $dir_name . '/' . $module_name . $suffix . '.css',
			);
		}

	}

	/**
	 * Load some widgets CSS on front end to avoid styling issues 
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function widgets_styles() {
		$dir_name = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_style( 'zeus-menu', ZEUS_ASSETS_URL . 'css/' . $dir_name . '/menu' . $suffix . '.css' );
		wp_enqueue_style( 'zeus-site-breadcrumbs', ZEUS_ASSETS_URL . 'css/' . $dir_name . '/site-breadcrumbs' . $suffix . '.css' );
		wp_enqueue_style( 'zeus-page-title', ZEUS_ASSETS_URL . 'css/' . $dir_name . '/page-title' . $suffix . '.css' );

		// Only load if WooCommerce activated
		if ( is_woocommerce_active() ) {
			wp_enqueue_style( 'zeus-woo-menu-cart', ZEUS_ASSETS_URL . 'css/' . $dir_name . '/woo-menu-cart' . $suffix . '.css' );
		}
	}

	/**
	 * Enqueue styles in the editor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function preview_styles() {

		foreach ( $this->modules as $module_name ) {
			wp_enqueue_style( 'zeus-' . $module_name . '' );
		}

	}

	/**
	 * Enqueue style in the editor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function editor_style() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_style( 'zeus-elementor-editor', ZEUS_ASSETS_URL . 'admin/css/editor' . $suffix . '.css' );
		wp_enqueue_style( 'zeus-icons', ZEUS_ASSETS_URL . 'admin/css/zeus-icons.css' );
	}

	/**
	 * Include components
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {

		// Modules
		include_once ZEUS_ELEMENTOR_PATH . 'includes/managers/modules.php';

	}

	/**
	 * Sections init
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	public function init_panel_section() {
		// Add element category in panel
		Plugin::instance()->elements_manager->add_category(
			'zeus-elements',
			array(
				'title' => '<i class="zeus-main-icon zeus-library" aria-hidden="true"></i>' . __( 'Zeus Elements', 'zeus-elementor' ),
			),
			1
		);
	}

	/**
	 * Components init
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function init_components() {
		$this->modules_manager = new Modules_Manager();
	}
}

if ( ! defined( 'ZEUS_ELEMENTOR_TESTS' ) ) {
	// In tests we run the instance manually.
	ZeusElementorPlugin::instance();
}
