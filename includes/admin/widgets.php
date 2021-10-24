<?php
/**
 * Widgets tab
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_RTL() ) {
	$icon = 'left';
} else {
	$icon = 'right';
} ?>

<div id="widgets" class="zeus-elements zeus-widgets">
	<div class="row">
		<div class="zeus-top">
			<p><?php esc_html_e( 'You can choose to Activate or Deactivate all widgets at once by clicking the buttons below', 'zeus-elementor' ); ?></p>
			<div class="zeus-buttons">
				<button type="button" class="zeus-btn-enable"><span class="dashicons dashicons-yes"></span><span><?php esc_html_e( 'Enable All', 'zeus-elementor' ); ?></span></button>
				<button type="button" class="zeus-btn-disable"><span class="dashicons dashicons-no-alt"></span><span><?php esc_html_e( 'Disable All', 'zeus-elementor' ); ?></span></button>
			</div>
		</div>
		<div class="zeus-container">
			<?php
			foreach ( $GLOBALS['zeus_widgets'] as $widget => $val ) :
				?>
				<div class="zeus-block zeus-checkbox">
					<div class="zeus-widgets-info">
						<p class="zeus-widget-title"><?php echo esc_attr( $val['title'] ); ?></p>
						<?php
						if ( ! empty( $val['demo_link'] ) ) {
							?>
							<a class="zeus-widget-link zeus-demo-link" href="<?php echo esc_url( $val['demo_link'] ); ?>" target="_blank" data-text="<?php esc_html_e( 'Widget Demo', 'zeus-elementor' ); ?>">
								<img src="<?php echo plugins_url( '/assets/admin/img/demo.svg', ZEUS_ELEMENTOR__FILE__ ); ?>" alt="zeus-demo">
							</a>
							<?php
						}
						?>
					</div>
					<input type="checkbox" name="<?php echo esc_attr( $widget ); ?>" id="<?php echo esc_attr( $widget ); ?>" <?php echo checked( 1, $this->get_widgets_option( $widget ), false ); ?>>
					<label for="<?php echo esc_attr( $widget ); ?>"></label>
				</div>
				<?php
			endforeach;
			?>
		</div>
		<p class="submit">
			<button type="button" class="button zeus-btn zeus-btn-js"><span><?php esc_html_e( 'Save Settings', 'zeus-elementor' ); ?></span><span class="dashicons dashicons-arrow-<?php echo esc_attr( $icon ); ?>-alt"></span></button>
		</p>
	</div>
</div>
