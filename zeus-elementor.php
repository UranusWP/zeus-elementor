<?php
/**
 * Plugin Name:         Zeus Elementor
 * Plugin URI:          zeus-elementor.com
 * Description:         Provides a collection of powerful, fully customizable, and extendable widgets on top of any Elementor version and works independently with any WordPress theme.
 * Version:             1.0.0
 * Author:              UranusWP
 * Author URI:          https://zeus-elementor.com/
 * Requires at least:   5.3
 * Tested up to:        5.8.2
 * WC tested up to: 5.9.0
 * Elementor tested up to: 3.4.8
 * Elementor Pro tested up to: 3.5.1
 *
 * Text Domain: zeus-elementor
 * Domain Path: /languages
 *
 * @package Zeus_Elementor
 * @category Core
 * @author UranusWP
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the main instance of Zeus_Elementor to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Zeus_Elementor
 */
function zeus_elementor() {
	return Zeus_Elementor::instance();
}
zeus_elementor();

/**
 * Main Zeus_Elementor Class
 *
 * @class Zeus_Elementor
 * @version 1.0.0
 * @since 1.0.0
 * @package Zeus_Elementor
 */
final class Zeus_Elementor {
	/**
	 * Zeus_Elementor The single instance of Zeus_Elementor.
	 *
	 * @var     object
	 * @access  private
	 * @since   1.0.0
	 */
	private static $instance = null;

	/**
	 * The token.
	 *
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $token;

	/**
	 * The version number.
	 *
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $version;

	// Admin - Start
	/**
	 * The admin object.
	 *
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $admin;

	/**
	 * Current theme template.
	 *
	 * @var String
	 */
	public $template;

	/**
	 * Constructor function.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function __construct() {
		$this->token        = 'zeus-elementor';
		$this->plugin_url   = plugin_dir_url( __FILE__ );
		$this->plugin_path  = plugin_dir_path( __FILE__ );
		$this->version      = '1.0.0';
		$this->template     = get_template();

		define( 'ZEUS_ELEMENTOR__FILE__', __FILE__ );
		define( 'ZEUS_ELEMENTOR_PATH', $this->plugin_path );
		define( 'ZEUS_URL', plugins_url( '/', ZEUS_ELEMENTOR__FILE__ ) );
		define( 'ZEUS_ASSETS_URL', ZEUS_URL . 'assets/' );
		define( 'ZEUS_ELEMENTOR_VERSION', $this->version );

		// If Elementor is not activated.
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'show_notices' ), 30 );
		} else {

			// Widgets.
			$GLOBALS['zeus_widgets'] = require_once ZEUS_ELEMENTOR_PATH . 'widgets.php';

			register_activation_hook( __FILE__, array( $this, 'install' ) );

			add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

			add_action( 'plugins_loaded', array( $this, 'setup' ) );

			register_activation_hook( __FILE__, array( $this, 'save_widgets_db' ) );

		}
	}

	/**
	 * Main Zeus_Elementor instance.
	 *
	 * Ensures that only one instance of Zeus_Elementor is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Zeus_Elementor()
	 * @return Zeus_Elementor Main instance
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	} // End instance()

	/**
	 * Load the localisation file.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'zeus-elementor', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Installation.
	 * Runs on activation. Logs the version number and assigns a notice message to a WordPress option.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function install() {
		$this->log_version_number();
	}

	/**
	 * Log the plugin version number.
	 *
	 * @access  private
	 * @since   1.0.0
	 * @return  void
	 */
	private function log_version_number() {
		// Log the version number.
		update_option( $this->token . '-version', $this->version );
	}

	/**
	 * Check if Elementor is installed.
	 *
	 * @access  private
	 * @since   1.0.1
	 * @return  void
	 */
	private function is_elementor_installed() {
		$file_path = 'elementor/elementor.php';
		$installed_plugins = get_plugins();

		return isset( $installed_plugins[ $file_path ] );
	}

	/**
	 * Add notice if Elementor is not activated.
	 *
	 * @return void
	 */
	public function show_notices() {
		$screen = get_current_screen();
		if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
			return;
		}

		$plugin = 'elementor/elementor.php';

		if ( $this->is_elementor_installed() ) {
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}

			$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );

			$message = '<p>' . __( 'Zeus Elementor is not working because you need to activate the Elementor plugin.', 'zeus-elementor' ) . '</p>';
			$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Elementor Now', 'zeus-elementor' ) ) . '</p>';
		} else {
			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}

			$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );

			$message = '<p>' . __( 'Zeus Elementor is not working because you need to install the Elementor plugin.', 'zeus-elementor' ) . '</p>';
			$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Install Elementor Now', 'zeus-elementor' ) ) . '</p>';
		}

		echo '<div class="error"><p>' . $message . '</p></div>';
	}

	/**
	 * Setup all the things.
	 *
	 * @return void
	 */
	public function setup() {
		require ZEUS_ELEMENTOR_PATH . 'includes/plugin.php';
		require_once ZEUS_ELEMENTOR_PATH . 'includes/admin/settings.php';
		require_once ZEUS_ELEMENTOR_PATH . 'includes/helpers.php';

		// If header or footer selected.
		if ( zeus_header_enabled() || zeus_footer_enabled() ) {
			if ( 'hello-elementor' === $this->template ) {
				require_once ZEUS_ELEMENTOR_PATH . 'includes/themes/class-hello-elementor-theme.php';
			} elseif ( 'generatepress' === $this->template ) {
				require_once ZEUS_ELEMENTOR_PATH . 'includes/themes/class-generatepress-theme.php';
			} elseif ( 'astra' === $this->template ) {
				require_once ZEUS_ELEMENTOR_PATH . 'includes/themes/class-astra-theme.php';
			} elseif ( 'oceanwp' === $this->template ) {
				require_once ZEUS_ELEMENTOR_PATH . 'includes/themes/class-oceanwp-theme.php';
			} elseif ( 'storefront' === $this->template ) {
				require_once ZEUS_ELEMENTOR_PATH . 'includes/themes/class-storefront-theme.php';
			} else {
				require_once ZEUS_ELEMENTOR_PATH . 'includes/themes/default/class-default-theme.php';
			}

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_header_footer_scripts' ) );
		}
	}

	/**
	 * Save default widgets values to database.
	 *
	 * @since 1.0.0
	 */
	public function save_widgets_db() {
		// If the widgets are not already in the database.
		if ( ! get_option( 'zeus_settings' ) ) {
			$defaults = array_fill_keys( array_keys( $GLOBALS['zeus_widgets'] ), 1 );
			$elements = array_merge( $defaults, array_fill_keys( array_keys( $defaults ), true ) );

			// Update new settings.
			return update_option( 'zeus_settings', $elements );
		}
	}

	/**
	 * Enqueue styles and scripts.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_header_footer_scripts() {
		if ( class_exists( '\Elementor\Plugin' ) ) {
			$elementor = \Elementor\Plugin::instance();
			$elementor->frontend->enqueue_styles();
		}

		if ( class_exists( '\ElementorPro\Plugin' ) ) {
			$elementor_pro = \ElementorPro\Plugin::instance();
			$elementor_pro->enqueue_styles();
		}

		if ( zeus_header_enabled() ) {
			if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
				$css_file = new \Elementor\Core\Files\CSS\Post( zeus_header_id() );
			} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
				$css_file = new \Elementor\Post_CSS_File( zeus_header_id() );
			}

			$css_file->enqueue();
		}

		if ( zeus_footer_enabled() ) {
			if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
				$css_file = new \Elementor\Core\Files\CSS\Post( zeus_footer_id() );
			} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
				$css_file = new \Elementor\Post_CSS_File( zeus_footer_id() );
			}

			$css_file->enqueue();
		}
	}

}
