<?php
/**
 * Settings page
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
class Zeus_Settings {

	/**
	 * Start things up
	 */
	public function __construct() {
		// Add panel menu
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 0 );

		// Add scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		// Save settings
		if ( is_admin() ) {
			add_action( 'wp_ajax_zeus_save_settings', array( $this, 'save_settings' ) );
		}
	}

	/**
	 * Registers a new menu page
	 *
	 * @since 1.0.0
	 */
	public function admin_menu() {
		add_menu_page(
			__( 'Zeus Elementor', 'zeus-elementor' ),
			__( 'Zeus Elementor', 'zeus-elementor' ),
			'manage_options',
			'zeus-settings',
			[ $this, 'settings_page' ],
			plugins_url( '/assets/admin/img/zeus.svg', ZEUS_ELEMENTOR__FILE__ ),
			'58.3'
		);
	}

	/**
	 * Loading all essential scripts
	 *
	 * @since 1.0.0
	 */
	public function admin_enqueue_scripts( $hook ) {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_style( 'zeus-elementor-admin-icon', plugins_url( '/assets/admin/css/icon.min.css', ZEUS_ELEMENTOR__FILE__ ) );

		if ( isset( $hook ) && 'toplevel_page_zeus-settings' === $hook ) {
			// Admin style
			wp_enqueue_style( 'zeus-elementor-admin', plugins_url( '/assets/admin/css/style' . $suffix . '.css', ZEUS_ELEMENTOR__FILE__ ) );

			// Admin script
			wp_enqueue_script( 'zeus-elementor-admin', plugins_url( '/assets/admin/js/admin' . $suffix . '.js', ZEUS_ELEMENTOR__FILE__ ), array( 'jquery', 'popper', 'tippy' ), ZEUS_ELEMENTOR_VERSION, true );

			// Tooltip
			wp_register_script( 'popper', plugins_url( '/assets/js/vendors/popper.min.js', ZEUS_ELEMENTOR__FILE__ ), array(), ZEUS_ELEMENTOR_VERSION, true );
			wp_register_script( 'tippy', plugins_url( '/assets/js/vendors/tippy-bundle.umd.min.js', ZEUS_ELEMENTOR__FILE__ ), array(), ZEUS_ELEMENTOR_VERSION, true );

			// JS string translation
			$texts = [
				'saving'    => __( 'Saving Data...', 'zeus-elementor' ),
				'saved'     => __( 'Settings Saved!', 'zeus-elementor' ),
				'error'     => __( 'Oops... Something went wrong!', 'zeus-elementor' ),
			];

			wp_localize_script( 'zeus-elementor-admin', 'localize', array(
				'ajaxurl'   => admin_url( 'admin-ajax.php' ),
				'nonce'     => wp_create_nonce( 'zeus-elementor' ),
				'lang'      => $texts,
			) );
		}
	}

	/**
	 * Create settings page.
	 *
	 * @since 1.0.0
	 */
	public function settings_page() {

		if ( is_RTL() ) {
			$icon = 'left';
		} else {
			$icon = 'right';
		} ?>

		<div class="zeus-settings-wrap">

			<div id="zeus-top-bar-wrap">
				<div class="zeus-top-bar">
					<div class="zeus-top-bar-main">
						<div class="zeus-top-bar-logo">
							<div><img src="<?php echo plugins_url( '/assets/admin/img/parthenon.svg', ZEUS_ELEMENTOR__FILE__ ); ?>" alt="zeus-top-bar"></div>
							<h1><?php echo esc_html__( 'Zeus Elementor', 'zeus-elementor' ); ?></h1>
						</div>
					</div>

					<div class="zeus-top-bar-second">
						<button type="submit" class="button zeus-btn zeus-btn-js"><span><?php echo esc_html__( 'Save Settings', 'zeus-elementor' ); ?></span><span class="dashicons dashicons-arrow-<?php echo esc_attr( $icon ); ?>-alt"></span></button>
					</div>
				</div>
			</div>

			<form id="zeus-settings" action="options.php" method="POST">

				<div class="zeus-settings-tabs">
					<ul class="zeus-tabs">
						<li>
							<a href="#general" class="active">
								<img src="<?php echo plugins_url( '/assets/admin/img/general.svg', ZEUS_ELEMENTOR__FILE__ ); ?>" alt="zeus-general-settings">
								<span><?php echo esc_html__( 'General', 'zeus-elementor' ); ?></span>
							</a>
						</li>
						<li>
							<a href="#widgets">
								<img src="<?php echo plugins_url( '/assets/admin/img/widgets.svg', ZEUS_ELEMENTOR__FILE__ ); ?>" alt="zeus-widgets">
								<span><?php echo esc_html__( 'Widgets', 'zeus-elementor' ); ?></span>
							</a>
						</li>
						<li>
							<a href="#integrations">
								<img src="<?php echo plugins_url( '/assets/admin/img/integrations.svg', ZEUS_ELEMENTOR__FILE__ ); ?>" alt="zeus-integrations">
								<span><?php echo esc_html__( 'Integrations', 'zeus-elementor' ); ?></span>
							</a>
						</li>
						<li>
							<a href="#header-footer">
								<img src="<?php echo plugins_url( '/assets/admin/img/header-footer.svg', ZEUS_ELEMENTOR__FILE__ ); ?>" alt="zeus-header-footer">
								<span><?php echo esc_html__( 'Header/Footer', 'zeus-elementor' ); ?></span>
							</a>
						</li>
					</ul>
					<?php
					include_once ZEUS_ELEMENTOR_PATH . '/includes/admin/general.php';
					include_once ZEUS_ELEMENTOR_PATH . '/includes/admin/widgets.php';
					include_once ZEUS_ELEMENTOR_PATH . '/includes/admin/integrations.php';
					include_once ZEUS_ELEMENTOR_PATH . '/includes/admin/header-footer.php'; ?>
				</div>

			</form>

		</div>

	<?php
	}

	/**
	 * Saving data with ajax request
	 *
	 * @since 1.0.0
	 */
	public function save_settings() {
		check_ajax_referer( 'zeus-elementor', 'security' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( esc_html__('you are not allowed to do this action', 'zeus-elementor' ) );
		}

		if ( ! isset( $_POST['fields'] ) ) {
			return;
		}

		parse_str( $_POST['fields'], $settings );

		// Saving MailChimp Api Key
		if ( isset( $settings['mailchimp_api_key'] ) ) {
			update_option( 'zeus_mailchimp_api_key', sanitize_text_field( $settings['mailchimp_api_key'] ) );
		}

		// Saving Google Map Api Key
		if ( isset( $settings['google_map_api_key'] ) ) {
			update_option( 'zeus_google_map_api_key', sanitize_text_field( $settings['google_map_api_key'] ) );
		}

		// Save header
		if ( isset( $settings['zeus-header-template'] ) ) {
			update_option( 'zeus_header', sanitize_text_field( $settings['zeus-header-template'] ) );
		}

		// Save footer
		if ( isset( $settings['zeus-footer-template'] ) ) {
			update_option( 'zeus_footer', sanitize_text_field( $settings['zeus-footer-template'] ) );
		}

		// Widgets checkboxes
		$defaults = array_fill_keys( array_keys( $GLOBALS['zeus_widgets'] ), false );
		$elements = array_merge( $defaults, array_fill_keys( array_keys( array_intersect_key( $settings, $defaults ) ), true ) );

		// Update new settings
		$updated = update_option( 'zeus_settings', $elements );

		// Return the validated/sanitized options
		wp_send_json( $updated );
	}

	/**
	 * Get option.
	 *
	 * @since 1.0.0
	 * */
	public function get_widgets_option( $option = null ) {
		$defaults = array_fill_keys( array_keys( $GLOBALS['zeus_widgets'] ), true );
		$options = get_option( 'zeus_settings', $defaults );
		$options = array_merge( $defaults, $options );

		return ( isset( $option ) ? ( isset( $options[$option] ) ? $options[$option] : 0 ) : array_keys( array_filter( $options ) ) );
	}

	/**
	 * Elementor templates post type.
	 *
	 * @since 1.0.0
	 * */
	public function get_templates() {

		// Return library templates array
		$templates      = array( '&mdash; ' . esc_html__( 'Select', 'zeus-elementor' ) . ' &mdash;' );
		$get_templates  = get_posts(
			array(
				'post_type' => 'elementor_library',
				'numberposts' => -1,
				'post_status' => 'publish',
			)
		);

		if ( ! empty( $get_templates ) ) {
			foreach ( $get_templates as $template ) {
				$templates[ $template->ID ] = $template->post_title;
			}
		}

		return $templates;

	}

}
new Zeus_Settings();
