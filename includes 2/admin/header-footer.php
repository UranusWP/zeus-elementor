<?php
/**
 * Integrations tab
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get option
$header = get_option( 'zeus_header' );
$footer = get_option( 'zeus_footer' );

// Return library templates array
$templates  = get_posts(
	array(
		'post_type' => 'elementor_library',
		'numberposts' => -1,
		'post_status' => 'publish',
	)
); ?>

<div id="header-footer" class="zeus-elements zeus-header-footer">
	<div class="row">
		<div class="zeus-container">
			<div class="zeus-block zeus-setting zeus-header">
				<label for="zeus-header-template"><?php esc_html_e( 'Select Your Header', 'zeus-elementor' ); ?></label>
				<select id="zeus-header-template" name="zeus-header-template">
					<option value=""><?php '&mdash; ' . esc_html_e( 'Select', 'zeus-elementor' ) . ' &mdash;'; ?></option>
					<?php
					if ( ! empty( $templates ) ) {
						foreach ( $templates as $template ) {
							$selected = $header == $template->ID ? 'selected' : '';
							echo '<option value="' . esc_attr( $template->ID ) . '" ' . esc_html( $selected ) . '>' . esc_html( $template->post_title ) . '</option>';
						}
					} ?>
				</select>

				<p class="description"><?php echo sprintf( esc_html__( 'Select your header created in %1$sElementor Templates%2$s for your entire site.', 'zeus-elementor' ), '<a href="' . add_query_arg( array( 'post_type' => 'elementor_library' ), esc_url( admin_url( 'edit.php' ) ) ) . '" target="_blank">', '</a>' ); ?>
				</p>
			</div>

			<div class="zeus-block zeus-setting zeus-footer">
				<label for="zeus-footer-template"><?php esc_html_e( 'Select Your Footer', 'zeus-elementor' ); ?></label>
				<select id="zeus-footer-template" name="zeus-footer-template">
					<option value=""><?php '&mdash; ' . esc_html_e( 'Select', 'zeus-elementor' ) . ' &mdash;'; ?></option>
					<?php
					if ( ! empty( $templates ) ) {
						foreach ( $templates as $template ) {
							$selected = $footer == $template->ID ? 'selected' : '';
							echo '<option value="' . esc_attr( $template->ID ) . '" ' . esc_html( $selected ) . '>' . esc_html( $template->post_title ) . '</option>';
						}
					} ?>
				</select>
				<p class="description"><?php echo sprintf( esc_html__( 'Select your footer created in %1$sElementor Templates%2$s for your entire site.', 'zeus-elementor' ), '<a href="' . add_query_arg( array( 'post_type' => 'elementor_library' ), esc_url( admin_url( 'edit.php' ) ) ) . '" target="_blank">', '</a>' ); ?>
			</div>
		</div>
		<p class="submit">
			<button type="button" class="button zeus-btn zeus-btn-js"><span><?php esc_html_e( 'Save Settings', 'zeus-elementor' ); ?></span><span class="dashicons dashicons-arrow-<?php echo esc_attr( $icon ); ?>-alt"></span></button>
		</p>
	</div>
</div>
