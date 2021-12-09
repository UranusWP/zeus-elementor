<?php
/**
 * General tab
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div id="general" class="zeus-elements zeus-general active">

	<div class="row">

		<div class="zeus-container">

			<div class="zeus-block zeus-inner">
				<div class="zeus-block-icon">
					<img src="<?php echo plugins_url( '/assets/admin/img/documentation.svg', ZEUS_ELEMENTOR__FILE__ ); ?>" alt="zeus-documentation">
				</div>

				<h4><?php esc_html_e( 'Documentation', 'zeus-elementor' ); ?></h4>
				<div class="zeus-content">
					<p><?php esc_html_e( 'Get familiar with all of our Zeus Elementor widgets by exploring its extensive documentation which explains everything you need to know to build awesome websites.', 'zeus-elementor' ); ?></p>
					<a href="https://zeus-elementor.com/documentation/" class="zeus-btn" target="_blank"><?php esc_html_e( 'Documentation', 'zeus-elementor' ); ?></a>
				</div>
			</div>

			<div class="zeus-block zeus-inner">
				<div class="zeus-block-icon">
					<img src="<?php echo plugins_url( '/assets/admin/img/support.svg', ZEUS_ELEMENTOR__FILE__ ); ?>" alt="zeus-documentation">
				</div>

				<h4><?php esc_html_e( 'Need Help?', 'zeus-elementor' ); ?></h4>
				<div class="zeus-content">
					<p><?php echo sprintf( __( 'A widget issue? Don&#039;t worry! You can reach our free support through the %1$sWordPress Forum%2$s, ask the community on the %3$sFacebook Group%2$s or directly reach our awesome %4$ssupport team%2$s who are always here to help you.', 'zeus-elementor' ), '<a href="https://wordpress.org/support/plugin/zeus-elementor/" target="_blank">', '</a>', '<a href="https://www.facebook.com/groups/zeuselementor" target="_blank">', '<a href="https://uranuswp.com/my-account/support/" target="_blank">' ); ?></p>
					<a href="https://uranuswp.com/my-account/support/" class="zeus-btn" target="_blank"><?php esc_html_e( 'Support', 'zeus-elementor' ); ?></a>
				</div>
			</div>

			<div class="zeus-block zeus-inner">
				<div class="zeus-block-icon">
					<img src="<?php echo plugins_url( '/assets/admin/img/github.svg', ZEUS_ELEMENTOR__FILE__ ); ?>" alt="zeus-documentation">
				</div>

				<h4><?php esc_html_e( 'Contribute to Zeus', 'zeus-elementor' ); ?></h4>
				<div class="zeus-content">
					<p><?php echo sprintf( __( 'Do you love Zeus Elementor and want to improve it? We&#039;ve got you covered! Thanks to %1$sGithub%2$s, you can make it even better by reporting bugs, creating issues or pull requests.', 'zeus-elementor' ), '<a href="https://github.com/uranuswp/zeus-elementor" target="_blank">', '</a>' ); ?></p>
					<a href="https://github.com/uranuswp/zeus-elementor" class="zeus-btn" target="_blank"><?php esc_html_e( 'Report a bug', 'zeus-elementor' ); ?></a>
				</div>
			</div>

			<div class="zeus-block zeus-inner">
				<div class="zeus-block-icon">
					<img src="<?php echo plugins_url( '/assets/admin/img/love.svg', ZEUS_ELEMENTOR__FILE__ ); ?>" alt="zeus-documentation">
				</div>

				<h4><?php esc_html_e( 'Show your Love', 'zeus-elementor' ); ?></h4>
				<div class="zeus-content">
					<p><?php esc_html_e( 'Thanks for being part of the Zeus family! Now it is time to show us some love by sharing the word and if you can take only 1 minute of your time to rate it 5 stars on WordPress, that will encourage users to follow your path', 'zeus-elementor' ); ?></p>
					<a href="https://wordpress.org/support/plugin/zeus-elementor/reviews/?filter=5" class="zeus-btn" target="_blank"><?php esc_html_e( 'Leave a review', 'zeus-elementor' ); ?></a>
				</div>
			</div>

			<div class="zeus-block zeus-inner zeus-templates">
				<div class="zeus-templates-inner">
					<div class="zeus-block-icon">
						<img src="<?php echo plugins_url( '/assets/admin/img/templates.svg', ZEUS_ELEMENTOR__FILE__ ); ?>" alt="zeus-documentation">
					</div>

					<h4><?php esc_html_e( 'Check out our Templates', 'zeus-elementor' ); ?></h4>
					<div class="zeus-content">
					<p><?php echo sprintf( __( 'We&#039;ve built an awesome addon to Zeus Elementor for you! This addon allows you to import any of our templates very easily and the best part is that you can import any page, header or footer that you like from any template!%1$sImport a template in secondes and start a professional website for you or your clients.', 'zeus-elementor' ), '</br>' ); ?></p>
						<a href="https://zeus-elementor.com/zeus-templates/" class="zeus-btn" target="_blank"><?php esc_html_e( 'Check Zeus Templates', 'zeus-elementor' ); ?></a>
					</div>
				</div>

				<div class="zeus-templates-image">
					<img src="<?php echo plugins_url( '/assets/admin/img/templates.png', ZEUS_ELEMENTOR__FILE__ ); ?>">
				</div>
			</div>

			<div class="zeus-block zeus-inner zeus-donation">
				<div class="zeus-block-icon">
					<img src="<?php echo plugins_url( '/assets/admin/img/donation.svg', ZEUS_ELEMENTOR__FILE__ ); ?>" alt="zeus-documentation">
				</div>

				<h4><?php esc_html_e( 'Make a Donation', 'zeus-elementor' ); ?></h4>
				<div class="zeus-content">
					<p><?php esc_html_e( 'As you&#039;ve probably noticed, Zeus Elementor has no limitations, it is completely free and we want it to stay that way. If you want to help us, please think about making a small donation, it would mean the world to us and will encourage us to offer you many great updates in the future! Purchase of the Zeus Templates addon also contribute directly to the project.', 'zeus-elementor' ); ?></p>
					<a href="https://zeus-elementor.com/donate/" class="zeus-btn" target="_blank"><?php esc_html_e( 'Make a donation', 'zeus-elementor' ); ?></a>
				</div>
			</div>

		</div>

	</div>
</div>