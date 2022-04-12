<?php
/**
 * Builds our notices.
 *
 * @package Zeus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Zeus_Notices {

	/**
	 * The admin notices key.
	 */
	const ADMIN_NOTICES_KEY = 'zeus_admin_notices';

	/**
	 * Member Variable
	 *
	 * @var object instance
	 */
	private static $instance;

	/**
	 * Initiator
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_notices', array( $this, 'review_notice' ), 20 );
		add_action( 'admin_notices', array( $this, 'olympus_notice' ), 20 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_ajax_zeus_set_admin_notice_viewed', array( $this, 'ajax_set_admin_notice_viewed' ) );
	}

	/**
	 * Get install time.
	 *
	 * @return int Unix timestamp when Zeus was installed.
	 */
	private function get_install_time( $source ) {
		$time = get_option( $source . '_zeus_installed_time' );
		if ( ! $time ) {
			$time = time();
			update_option( $source . '_zeus_installed_time', $time );
		}
		return $time;
	}

	/**
	 * Add a review notice
	 *
	 * @access public
	 */
	public function review_notice() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$notice_id = 'zeus_review_notice';

		if ( $this->is_user_notice_viewed( $notice_id ) ) {
			return;
		}

		// Show notice after 1 week from installed time.
		if ( strtotime( '+1 week', $this->get_install_time( $notice_id ) ) > time() ) {
			return;
		}

		$dismiss_url = add_query_arg( [
			'action' => 'zeus_set_admin_notice_viewed',
			'notice_id' => esc_attr( $notice_id ),
		], admin_url( 'admin-post.php' ) );
		?>
		<div class="notice zeus-notice zeus-review-notice zeus-dismiss-notice" data-notice_id="<?php echo esc_attr( $notice_id ); ?>">
			<div class="zeus-notice-icon">
				<svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="m29.911 13.75-6.229 6.072 1.471 8.576c.064.375-.09.754-.398.978-.174.127-.381.191-.588.191-.159 0-.319-.038-.465-.115l-7.702-4.049-7.701 4.048c-.336.178-.745.149-1.053-.076-.308-.224-.462-.603-.398-.978l1.471-8.576-6.23-6.071c-.272-.266-.371-.664-.253-1.025s.431-.626.808-.681l8.609-1.25 3.85-7.802c.337-.683 1.457-.683 1.794 0l3.85 7.802 8.609 1.25c.377.055.69.319.808.681s.019.758-.253 1.025z"/></svg>
			</div>
			<div class="zeus-notice-content">
				<p><?php esc_html_e( 'Thanks for using Zeus For Elementor! Could you please do me a BIG favor and give it a 5-star rating on WordPress to help us spread the word and boost our motivation?', 'zeus-elementor' ); ?></p>
				<p><strong>~ Nicolas Lecocq<br>President of Zeus For Elementor</strong></p>

				<div class="zeus-notice-buttons">
					<a href="https://wordpress.org/support/plugin/zeus-elementor/reviews/?filter=5#new-post" rel="nofollow" target="_blank"><?php esc_html_e( 'Yes, you deserve it!', 'zeus-elementor' ); ?></a>
					<a href="<?php echo esc_url_raw( $dismiss_url ); ?>" class="zeus-notice-dismiss"><?php esc_html_e( 'I have already did', 'zeus-elementor' ); ?></a>
				</div>
			</div>
			<button type="button" class="notice-dismiss zeus-notice-dismiss"><span class="screen-reader-text"><?php esc_html_e( 'Dismiss this notice.', 'zeus-elementor' ); ?></span></button>
		</div>
		<?php
	}

	/**
	 * Add Olympus notice
	 *
	 * @access public
	 */
	public function olympus_notice() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$notice_id = 'olympus_notice';

		if ( $this->is_user_notice_viewed( $notice_id ) ) {
			return;
		}

		// Don't show if Olympus activated
		if ( 'olympuswp' === get_template() ) {
			return;
		}

		// Show notice after 2 weeks from installed time.
		if ( strtotime( '+2 weeks', $this->get_install_time( $notice_id ) ) > time() ) {
			return;
		}

		$dismiss_url = add_query_arg( [
			'action' => 'zeus_set_admin_notice_viewed',
			'notice_id' => esc_attr( $notice_id ),
		], admin_url( 'admin-post.php' ) );
		?>
		<div class="notice zeus-notice olympus-notice zeus-dismiss-notice" data-notice_id="<?php echo esc_attr( $notice_id ); ?>">
			<div class="zeus-notice-icon">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511 511.99931"><path d="m285.386719 157.222656 72.058593-110.484375s-114.71875-105.160156-272.464843 0c-85.503907 57.003907-91.890625 156.136719-79.808594 234.984375l90.960937-5.539062" fill="#ffffff"/><path d="m312.890625 19.046875c-48.199219-12.367187-115.175781-11.335937-192.480469 40.199219-80.332031 53.554687-90.835937 144.289062-81.789062 220.445312l-33.449219 2.03125c-12.085937-78.84375-5.699219-177.976562 79.8125-234.980468 98.632813-65.757813 180.445313-49.285157 227.90625-27.695313zm0 0" fill="#e9e9e9"/><path d="m303.125 130.019531-17.742188 27.203125-125.53125 118.957032-90.339843 1.625c-.105469-2.335938-.15625-4.683594-.15625-7.042969 0-87.9375 71.289062-159.226563 159.246093-159.226563 26.929688 0 52.289063 6.679688 74.523438 18.484375zm0 0" fill="#e9e9e9"/><path d="m311.621094 181.25-145.664063 64.171875-53.398437 23.519531c-.855469-5.230468-1.324219-10.585937-1.40625-16.046875-.019532-.617187-.019532-1.21875-.019532-1.835937 0-50.730469 33.632813-93.628906 79.832032-107.578125 5.054687-1.542969 10.261718-2.722657 15.597656-3.535157h.03125c5.523438-.832031 11.179688-1.269531 16.941406-1.269531 29.894532 0 57.058594 11.660157 77.1875 30.695313 3.910156 3.6875 7.554688 7.660156 10.898438 11.878906zm0 0" fill="#ffffff" data-original="#ffc84d" class=""/><path d="m165.957031 245.429688-53.402343 23.515624c-.945313-5.8125-1.425782-11.785156-1.425782-17.878906 0-50.742187 33.632813-93.628906 79.832032-107.582031-26.683594 12.984375-35.777344 59.722656-25.003907 101.945313zm0 0" fill="#e9e9e9"/><path d="m311.621094 181.25-95.503906 84.40625-103.558594 3.285156c-.855469-5.230468-1.324219-10.585937-1.40625-16.046875l82.230468-36.21875c.011719-.011719.019532-.023437.019532-.023437l107.320312-47.28125c3.910156 3.6875 7.554688 7.660156 10.898438 11.878906zm0 0" fill="#e9e9e9"/><path d="m317.609375 357.449219 43.023437 154.550781-173.671874-90.816406 7.960937-103.570313-32.144531 17.015625-49.117188 26.007813-17.527344-84.449219 97.246094-42.835938c.011719-.011718.019532-.019531.019532-.019531l130.589843-57.527343 49.386719 192.792968h-27.078125l-25.5-57.359375-73.289063-27.089843-12.753906 49.398437zm0 0" fill="#ffffff" data-original="#ffc84d" class=""/><path d="m162.777344 334.628906-49.117188 26.007813-17.527344-84.449219 97.246094-42.835938c-1.175781 1.148438-44.710937 43.992188-30.601562 101.277344zm0 0" fill="#e9e9e9"/></svg>
			</div>
			<div class="zeus-notice-content">
				<p><?php esc_html_e( 'We noticed you like Zeus For Elementor, I can&rsquo;t thank you enough for your trust. I would like to introduce to you something that you may like too, its name is Olympus and it is the fastest WordPress theme available, you don&rsquo;t believe me? Just try it, it is free!', 'zeus-elementor' ); ?></p>
				<p><strong>~ Nicolas Lecocq<br>President of Zeus For Elementor</strong></p>

				<div class="zeus-notice-buttons">
					<a href="https://wpolympus.com?utm_source=wp_dashboard&utm_medium=zeus" rel="nofollow" target="_blank"><?php esc_html_e( 'I want to try Olympus', 'zeus-elementor' ); ?></a>
					<a href="<?php echo esc_url_raw( $dismiss_url ); ?>" class="zeus-notice-dismiss"><?php esc_html_e( 'I don&rsquo;t want it', 'zeus-elementor' ); ?></a>
				</div>
			</div>
			<button type="button" class="notice-dismiss zeus-notice-dismiss"><span class="screen-reader-text"><?php esc_html_e( 'Dismiss this notice.', 'zeus-elementor' ); ?></span></button>
		</div>
		<?php
	}

	/**
	 * Enqueue scripts
	 *
	 * @access public
	 */
	public function enqueue_scripts() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_style( 'zeus-notice', ZEUS_ASSETS_URL . 'admin/css/notice' . $suffix . '.css', array(), ZEUS_ELEMENTOR_VERSION );
		wp_enqueue_script( 'zeus-notice', ZEUS_ASSETS_URL . 'admin/js/notice' . $suffix . '.js', array(), ZEUS_ELEMENTOR_VERSION, true );
	
		wp_localize_script(
			'zeus-notice',
			'zeusNotice',
			apply_filters(
				'zeus_localize_js_notice',
				array(
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
				)
			)
		);
	}

	/**
	 * Get user notices.
	 *
	 * Retrieve the list of notices for the current user.
	 *
	 * @access private
	 * @static
	 *
	 * @return array A list of user notices.
	 */
	private static function get_user_notices() {
		return get_user_meta( get_current_user_id(), self::ADMIN_NOTICES_KEY, true );
	}

	/**
	 * Is user notice viewed.
	 *
	 * Whether the notice was viewed by the user.
	 *
	 * @access public
	 * @static
	 *
	 * @param int $notice_id The notice ID.
	 *
	 * @return bool Whether the notice was viewed by the user.
	 */
	public static function is_user_notice_viewed( $notice_id ) {
		$notices = self::get_user_notices();

		if ( empty( $notices ) || empty( $notices[ $notice_id ] ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Set admin notice as viewed.
	 *
	 * Flag the user admin notice as viewed using an authenticated ajax request.
	 *
	 * Fired by `wp_ajax_zeus_set_admin_notice_viewed` action.
	 *
	 * @access public
	 * @static
	 */
	public static function ajax_set_admin_notice_viewed() {
		if ( empty( $_REQUEST['notice_id'] ) ) {
			wp_die();
		}

		$notices = self::get_user_notices();
		if ( empty( $notices ) ) {
			$notices = [];
		}

		$notices[ $_REQUEST['notice_id'] ] = 'true';
		update_user_meta( get_current_user_id(), self::ADMIN_NOTICES_KEY, $notices );

		if ( ! wp_doing_ajax() ) {
			wp_safe_redirect( admin_url() );
			die;
		}

		wp_die();
	}
}
Zeus_Notices::get_instance();
