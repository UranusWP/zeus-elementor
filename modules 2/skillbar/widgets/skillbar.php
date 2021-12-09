<?php
namespace ZeusElementor\Modules\Skillbar\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Skillbar extends Widget_Base {

	public function get_name() {
		return 'zeus-skillbar';
	}

	public function get_title() {
		return __( 'Skillbar', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-signal';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'skillbar',
			'skill',
			'skills',
			'bar',
			'progress',
			'progress bar',
			'zeus',
		];
	}

	public function get_script_depends() {
		return [ 'zeus-skillbar', 'appear' ];
	}

	public function get_style_depends() {
		return [ 'zeus-skillbar' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_alert',
			[
				'label'         => __( 'Skillbar', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'         => __( 'Title', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Web Design', 'zeus-elementor' ),
				'label_block'   => true,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'percent',
			[
				'label'         => __( 'Percentage', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size'      => 85,
					'unit'      => '%',
				],
				'label_block'   => true,
			]
		);

		$this->add_control(
			'display_percent',
			[
				'label'         => __( 'Display % Number', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'true',
				'options'       => [
					'true'      => __( 'Show', 'zeus-elementor' ),
					'false'     => __( 'Hide', 'zeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'style',
			[
				'label'         => __( 'Style', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'inner',
				'options'       => [
					'inner'     => __( 'Inner', 'zeus-elementor' ),
					'outside'   => __( 'Outside', 'zeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'display_stripe',
			[
				'label'         => __( 'Display Stripe', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'true',
				'options'       => [
					'true'      => __( 'Show', 'zeus-elementor' ),
					'false'     => __( 'Hide', 'zeus-elementor' ),
				],
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
			'section_style',
			[
				'label'         => __( 'Skill Bar', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'background',
			[
				'label'         => __( 'Background', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-skillbar-container' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color',
			[
				'label'         => __( 'Bar Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-skillbar-bar' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'box_shadow',
			[
				'label'         => __( 'Inset Shadow', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'true',
				'options'       => [
					'true'      => __( 'Yes', 'zeus-elementor' ),
					'false'     => __( 'No', 'zeus-elementor' ),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'skillbar_title',
				'selector'      => '{{WRAPPER}} .zeus-skillbar',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings       = $this->get_settings_for_display();

		// Vars
		$elements_style = $settings['style'];
		$percent        = $settings['percent']['size'];
		$title          = $settings['title'];
		$show_percent   = $settings['display_percent'];
		$show_stripe    = $settings['display_stripe'];

		// Wrapper classes
		$wrap_classes = array( 'zeus-skillbar' );
		if ( 'false' === $settings['box_shadow'] ) {
			$wrap_classes[] = 'disable-box-shadow';
		}
		if ( $elements_style ) {
			$wrap_classes[] = 'style-' . $elements_style;
		}
		if ( 'inner' === $elements_style ) {
			$wrap_classes[] = 'zeus-skillbar-container';
		}

		// Turn wrap classes into a string
		$wrap_classes = implode( ' ', $wrap_classes ); ?>

		<div class="<?php echo esc_attr( $wrap_classes ); ?>" data-percent="<?php echo esc_attr( $percent ); ?>&#37;">

			<?php if ( 'inner' === $elements_style ) { ?>

				<div class="zeus-skillbar-title">

					<div class="zeus-skillbar-title-inner">
						<?php echo esc_attr( $title ); ?>
					</div><!-- .zeus-skillbar-title-inner -->

				</div><!-- .zeus-skillbar-title -->

			<?php } elseif ( 'outside' === $elements_style ) { ?>

				<div class="zeus-skillbar-title">
					<?php echo esc_attr( $title ); ?>
				</div><!-- .zeus-skillbar-title-inner -->

				<?php if ( 'true' === $show_percent ) { ?>
					<div class="zeus-skill-bar-percent"><?php echo esc_attr( $percent ); ?>&#37;</div>
				<?php } ?>

				<div style="clear:both"></div>

			<?php } ?>

			<?php if ( $settings['percent'] ) { ?>

				<?php if ( 'outside' === $elements_style ) { ?>
					<div class="zeus-skillbar-container">
				<?php } ?>

					<div class="zeus-skillbar-bar">
						<?php if ( 'true' === $show_percent && 'inner' === $elements_style ) { ?>
							<div class="zeus-skill-bar-percent"><?php echo esc_attr( $percent ); ?>&#37;</div>
						<?php } ?>
						<?php if ( 'true' === $show_stripe ) { ?>
							<div class="zeus-skill-bar-stripe"></div>
						<?php } ?>
					</div><!-- .zeus-skillbar -->

				<?php if ( 'outside' === $elements_style ) { ?>
					</div>
				<?php } ?>

			<?php } ?>

		</div><!-- .zeus-skillbar -->

		<?php
	}

	protected function content_template() { ?>
		<#
			var wrap_classes = 'zeus-skillbar';

			if ( 'false' == settings.box_shadow ) {
				wrap_classes += ' disable-box-shadow';
			}
			if ( '' !== settings.style ) {
				wrap_classes += ' style-' + settings.style;
			}
			if ( 'inner' == settings.style ) {
				wrap_classes += ' zeus-skillbar-container';
			}
		#>

		<div class="{{ wrap_classes }}" data-percent="{{ settings.percent.size }}&#37;">

			<# if ( 'inner' == settings.style ) { #>

				<div class="zeus-skillbar-title">

					<div class="zeus-skillbar-title-inner">
						{{{ settings.title }}}
					</div><!-- .zeus-skillbar-title-inner -->

				</div><!-- .zeus-skillbar-title -->

			<# } else if ( 'outside' == settings.style ) { #>

				<div class="zeus-skillbar-title">
					{{{ settings.title }}}
				</div><!-- .zeus-skillbar-title-inner -->

				<# if ( 'true' == settings.display_percent ) { #>
					<div class="zeus-skill-bar-percent">{{ settings.percent.size }}&#37;</div>
				<# } #>

				<div style="clear:both"></div>

			<# } #>

			<# if ( settings.percent ) { #>

				<# if ( 'outside' == settings.style ) { #>
					<div class="zeus-skillbar-container">
				<# } #>

					<div class="zeus-skillbar-bar">
						<# if ( 'true' == settings.display_percent && 'inner' == settings.style ) { #>
							<div class="zeus-skill-bar-percent">{{ settings.percent.size }}&#37;</div>
						<# } #>
						<# if ( 'true' == settings.display_stripe ) { #>
							<div class="zeus-skill-bar-stripe"></div>
						<# } #>
					</div><!-- .zeus-skillbar -->

				<# if ( 'outside' == settings.style ) { #>
					</div>
				<# } #>

			<# } #>

		</div><!-- .zeus-skillbar -->
		<?php
	}

}
