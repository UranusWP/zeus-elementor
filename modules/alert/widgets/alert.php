<?php
namespace ZeusElementor\Modules\Alert\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Alert extends Widget_Base {

	public function get_name() {
		return 'zeus-alert';
	}

	public function get_title() {
		return __( 'Alert', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-warning-circle';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'alert',
			'notice',
			'zeus',
		];
	}

	public function get_script_depends() {
		return [ 'zeus-alert' ];
	}

	public function get_style_depends() {
		return [ 'zeus-alert' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_alert',
			[
				'label'         => __( 'Alert', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'type',
			[
				'label'         => __( 'Type', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'notice',
				'options'       => [
					'notice'    => __( 'Notice', 'zeus-elementor' ),
					'error'     => __( 'Error', 'zeus-elementor' ),
					'warning'   => __( 'Warning', 'zeus-elementor' ),
					'success'   => __( 'Success', 'zeus-elementor' ),
					'info'      => __( 'Info', 'zeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'style',
			[
				'label'         => __( 'Style', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'small',
				'options'       => [
					'small'     => __( 'Small', 'zeus-elementor' ),
					'big'       => __( 'Big', 'zeus-elementor' ),
					'minimal'   => __( 'Minimal', 'zeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'         => __( 'Title', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'placeholder'   => __( 'Your Title', 'zeus-elementor' ),
				'default'       => __( 'This is Alert Message', 'zeus-elementor' ),
				'label_block'   => true,
				'dynamic'       => [ 'active' => true ],
				'condition' => [
					'style!' => 'small',
				],
			]
		);

		$this->add_control(
			'content',
			[
				'label'         => __( 'Description', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'placeholder'   => __( 'Your Description', 'zeus-elementor' ),
				'default'       => __( 'Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel.', 'zeus-elementor' ),
				'separator'     => 'none',
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'view',
			[
				'label'         => __( 'View', 'zeus-elementor' ),
				'type'          => Controls_Manager::HIDDEN,
				'default'       => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_type',
			[
				'label'         => __( 'Alert', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'background',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-alert' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label'         => __( 'Border Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-alert' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label'         => __( 'Title', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-alert-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'alert_title',
				'selector'      => '{{WRAPPER}} .zeus-alert-heading',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description',
			[
				'label'         => __( 'Description', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-alert-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'alert_content',
				'selector'      => '{{WRAPPER}} .zeus-alert-content',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Wrapper classes
		$wrap_classes = array( 'zeus-alert' );
		if ( ! empty( $settings['type'] ) ) {
			$wrap_classes[] = 'zeus-alert-' . $settings['type'];
		}
		if ( ! empty( $settings['style'] ) ) {
			$wrap_classes[] = 'zeus-alert-' . $settings['style'];
		}

		// Turn wrap classes into a string
		$wrap_classes = implode( ' ', $wrap_classes );

		// Alert icon
		if ( 'notice' === $settings['type'] ) {
			$alert_icon = 'fas fa-bell';
		} elseif ( 'error' === $settings['type'] ) {
			$alert_icon = 'fas fa-times';
		} elseif ( 'warning' === $settings['type'] ) {
			$alert_icon = 'fas fa-exclamation';
		} elseif ( 'success' === $settings['type'] ) {
			$alert_icon = 'fas fa-check';
		} elseif ( 'info' === $settings['type'] ) {
			$alert_icon = 'fas fa-info';
		}
		?>

		<div class="<?php echo esc_attr( $wrap_classes ); ?>" role="alert">

			<div class="zeus-alert-content-wrap">

				<div class="zeus-alert-icon"><i class="<?php echo esc_attr( $alert_icon ); ?>"></i></div>
				<?php
				// Display content if defined
				if ( ! empty( $settings['content'] ) ) {
					?>
					<div class="zeus-alert-content">
						<?php
						// Display heading if defined
						if ( ! empty( $settings['title'] ) && 'small' !== $settings['style'] ) {
							?>
							<h2 class="zeus-alert-heading">
								<?php echo esc_attr( $settings['title'] ); ?>
							</h2>
							<?php
						}
						echo do_shortcode( $settings['content'] );
						?>
					</div><!-- .zeus-alert-content -->
					<?php
				}
				?>
			</div><!-- .zeus-alert-content -->
		</div><!-- .zeus-alert -->
		<?php
	}

	protected function content_template() { ?>
		<#
			var wrap_classes = 'zeus-alert',
				alert_icon = '';

			if ( '' !== settings.type ) {
				wrap_classes += ' zeus-alert-' + settings.type;
			}
			if ( '' !== settings.style ) {
				wrap_classes += ' zeus-alert-' + settings.style;
			}

			if ( 'notice' === settings.type ) {
				alert_icon = 'fas fa-bell';
			} else if ( 'error' === settings.type ) {
				alert_icon = 'fas fa-times';
			} else if ( 'warning' === settings.type ) {
				alert_icon = 'fas fa-exclamation';
			} else if ( 'success' === settings.type ) {
				alert_icon = 'fas fa-check';
			} else if ( 'info' === settings.type ) {
				alert_icon = 'fas fa-info';
			}
		#>

		<div class="{{ wrap_classes }}" role="alert">
			<div class="zeus-alert-content-wrap">
				<div class="zeus-alert-icon"><i class="{{ alert_icon }}"></i></div>
				<# if ( settings.content ) { #>
					<div class="zeus-alert-content">
						<# if ( settings.title && 'small' !== settings.style ) { #>
							<h2 class="zeus-alert-heading">{{{ settings.title }}}</h2>
						<# } #>
						{{{ settings.content }}}
					</div>
				<# } #>
			</div>
		</div>
		<?php
	}
}
