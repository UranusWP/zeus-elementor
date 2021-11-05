<?php
/**
 * Integrations tab
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

<div id="integrations" class="zeus-elements zeus-integrations">

	<div class="row">

		<div class="zeus-container">

			<div class="zeus-block zeus-setting">
				<label for="mailchimp_api_key"><?php esc_html_e( 'MailChimp API Key', 'zeus-elementor' ); ?></label>
				<input name="mailchimp_api_key" type="text" id="mailchimp_api_key" value="<?php echo esc_attr( get_option( 'zeus_mailchimp_api_key' ) ); ?>" class="regular-text">
				<p class="description"><?php echo sprintf( esc_html__( 'Used for the MailChimp widget. %1$sFollow this article%2$s to get your API Key.', 'zeus-elementor' ), '<a href="https://zeus-elementor.com/docs/get-your-mailchimp-api-key-and-choose-your-list-id/" target="_blank">', '</a>' ); ?></p>
			</div>

			<div class="zeus-block zeus-setting">
				<label for="google_map_api_key"><?php esc_html_e( 'Google Map API Key', 'zeus-elementor' ); ?></label>
				<input name="google_map_api_key" type="text" id="google_map_api_key" value="<?php echo esc_attr( get_option( 'zeus_google_map_api_key' ) ); ?>" class="regular-text">
				<p class="description"><?php echo sprintf( esc_html__( 'Used for the Google Map widget. %1$sFollow this article%2$s to get your API Key.', 'zeus-elementor' ), '<a href="https://zeus-elementor.com/docs/get-your-google-map-api-key/" target="_blank">', '</a>' ); ?></p>
			</div>

		</div>

		<p class="submit">
			<button type="button" class="button zeus-btn zeus-btn-js"><span><?php esc_html_e( 'Save Settings', 'zeus-elementor' ); ?></span><span class="dashicons dashicons-arrow-<?php echo esc_attr( $icon ); ?>-alt"></span></button>
		</p>

	</div>
</div>
