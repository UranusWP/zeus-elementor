<?php
namespace ZeusElementor\Modules\AdvancedHeading\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class AdvancedHeading extends Widget_Base {

	public function get_name() {
		return 'zeus-advanced-heading';
	}

	public function get_title() {
		return __( 'Advanced Heading', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-text-color';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'heading',
			'advanced',
			'advanced heading',
			'title',
			'zeus',
		];
	}

	public function get_style_depends() {
		return [ 'zeus-advanced-heading' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_advanced_heading',
			[
				'label'         => __( 'Heading', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'main_heading',
			[
				'label'         => __( 'Heading', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Advanced Heading', 'zeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'sub_heading',
			[
				'label'         => __( 'Sub Heading', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Your Sub Heading Here', 'zeus-elementor' ),
				'label_block'   => true,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => __( 'Link', 'zeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => 'http://your-link.com',
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label'         => __( 'HTML Tag', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'h2',
				'options'       => zeus_get_available_tags(),
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'         => __( 'Alignment', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left' => [
						'title' => __( 'Left', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'       => 'center',
				'prefix_class'  => 'elementor-align%s-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_background_heading',
			[
				'label'         => __( 'Background Heading', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'background_heading',
			[
				'label'         => __( 'Background Heading', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Background Heading', 'zeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'background_heading_hide',
			[
				'label'         => __( 'Hide On', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'tm',
				'options'       => [
					'never' => __( 'Never', 'zeus-elementor' ),
					'tm'    => __( 'Tablet and Mobile ', 'zeus-elementor' ),
					'm'     => __( 'Mobile', 'zeus-elementor' ),
				],
			]
		);

		$this->add_responsive_control(
			'background_heading_align',
			[
				'label'         => __( 'Alignment', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left' => [
						'title' => __( 'Left', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'prefix_class' => 'zeus%s-background-heading-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_heading',
			[
				'label'         => __( 'Heading', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'main_heading!' => '',
				],
			]
		);

		$this->add_control(
			'main_heading_advanced_color',
			[
				'label'         => __( 'Advanced Style', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'main_heading_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-advanced-heading .zeus-main-heading' => 'color: {{VALUE}};',
				],
				'condition'     => [
					'main_heading_advanced_color!' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'          => 'main_heading_advanced_color',
				'types'         => [ 'classic', 'gradient' ],
				'selector'      => '{{WRAPPER}} .zeus-advanced-heading .zeus-main-heading > div',
				'condition'     => [
					'main_heading_advanced_color' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'main_heading_typography',
				'selector'      => '{{WRAPPER}} .zeus-advanced-heading .zeus-main-heading',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'          => 'main_heading_shadow',
				'selector'      => '{{WRAPPER}} .zeus-advanced-heading .zeus-main-heading',
			]
		);

		$this->add_control(
			'main_heading_margin',
			[
				'label'      => __( 'Margin', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .zeus-advanced-heading .zeus-main-heading > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'main_heading_line',
			[
				'label'         => __( 'Add Line', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'main_heading_line_color',
			[
				'label'         => __( 'Line Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-advanced-heading .zeus-main-line:after' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'main_heading_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'main_heading_line_width',
			[
				'label'         => __( 'Width', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min'  => 1,
						'max'  => 200,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-advanced-heading .zeus-main-line:after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'main_heading_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'main_heading_line_height',
			[
				'label'         => __( 'Height', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min'  => 1,
						'max'  => 48,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-advanced-heading .zeus-main-line:after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'main_heading_line' => 'yes',
				],
			]
		);

		$this->add_control(
			'main_heading_line_align',
			[
				'label'         => __( 'Line Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'bottom',
				'options'       => [
					'left'       => __( 'Before', 'zeus-elementor' ),
					'right'      => __( 'After', 'zeus-elementor' ),
					'left-right' => __( 'Before and After', 'zeus-elementor' ),
					'bottom'     => __( 'Bottom', 'zeus-elementor' ),
				],
				'condition'     => [
					'main_heading_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'main_heading_line_indent',
			[
				'label'         => __( 'Line Spacing', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 8,
				],
				'range'         => [
					'px' => [
						'max' => 50,
					],
				],
				'condition'     => [
					'main_heading_line' => 'yes',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-advanced-heading .zeus-main-line.zeus-line-align-right'  => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .zeus-advanced-heading .zeus-main-line.zeus-line-align-left'   => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .zeus-advanced-heading .zeus-main-line.zeus-line-align-bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_sub_heading',
			[
				'label'         => __( 'Sub Heading', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'sub_heading!' => '',
				],
			]
		);

		$this->add_control(
			'sub_heading_advanced_color',
			[
				'label'         => __( 'Advanced Style', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'sub_heading_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-advanced-heading .zeus-sub-heading' => 'color: {{VALUE}};',
				],
				'condition'     => [
					'sub_heading_advanced_color!' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'          => 'sub_heading_advanced_color',
				'types'         => [ 'classic', 'gradient' ],
				'selector'      => '{{WRAPPER}} .zeus-advanced-heading .zeus-sub-heading > div',
				'condition'     => [
					'sub_heading_advanced_color' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'sub_heading_typography',
				'selector'      => '{{WRAPPER}} .zeus-advanced-heading .zeus-sub-heading',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'          => 'sub_heading_shadow',
				'selector'      => '{{WRAPPER}} .zeus-advanced-heading .zeus-sub-heading',
			]
		);

		$this->add_control(
			'sub_heading_margin',
			[
				'label'      => __( 'Margin', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .zeus-advanced-heading .zeus-sub-heading > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'sub_heading_line',
			[
				'label'         => __( 'Add Line', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'sub_heading_line_color',
			[
				'label'         => __( 'Line Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-advanced-heading .zeus-sub-line:after' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'sub_heading_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'sub_heading_line_width',
			[
				'label'         => __( 'Width', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min'  => 1,
						'max'  => 200,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-advanced-heading .zeus-sub-line:after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'sub_heading_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'sub_heading_line_height',
			[
				'label'         => __( 'Height', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min'  => 1,
						'max'  => 48,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-advanced-heading .zeus-sub-line:after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'sub_heading_line' => 'yes',
				],
			]
		);

		$this->add_control(
			'sub_heading_line_align',
			[
				'label'         => __( 'Line Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'bottom',
				'options'       => [
					'left'       => __( 'Before', 'zeus-elementor' ),
					'right'      => __( 'After', 'zeus-elementor' ),
					'left-right' => __( 'Before and After', 'zeus-elementor' ),
					'bottom'     => __( 'Bottom', 'zeus-elementor' ),
				],
				'condition'     => [
					'sub_heading_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'sub_heading_line_indent',
			[
				'label'         => __( 'Line Spacing', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 8,
				],
				'range'         => [
					'px' => [
						'max' => 50,
					],
				],
				'condition'     => [
					'sub_heading_line' => 'yes',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-advanced-heading .zeus-sub-line.zeus-line-align-right'  => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .zeus-advanced-heading .zeus-sub-line.zeus-line-align-left'   => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .zeus-advanced-heading .zeus-sub-line.zeus-line-align-bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_background_heading',
			[
				'label'         => __( 'Background Heading', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'background_heading!' => '',
				],
			]
		);

		$this->add_control(
			'background_heading_advanced_color',
			[
				'label'         => __( 'Advanced Style', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'background_heading_advanced_color',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .zeus-advanced-heading .zeus-background-heading > div',
				'condition' => [
					'background_heading_advanced_color' => 'yes',
				],
			]
		);

		$this->add_control(
			'background_heading_color',
			[
				'label'     => __( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zeus-advanced-heading .zeus-background-heading > div' => 'color: {{VALUE}};',
				],
				'condition' => [
					'background_heading_advanced_color!' => 'yes',
				],
			]
		);

		$this->add_control(
			'background_heading_background_color',
			[
				'label'     => __( 'Background Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zeus-advanced-heading .zeus-background-heading > div' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'background_heading_advanced_color!' => 'yes',
				],
			]
		);

		$this->add_control(
			'background_heading_padding',
			[
				'label'      => __( 'Padding', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .zeus-advanced-heading .zeus-background-heading > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'background_heading_typography',
				'selector'  => '{{WRAPPER}} .zeus-advanced-heading .zeus-background-heading > div',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'background_heading_shadow',
				'selector' => '{{WRAPPER}} .zeus-advanced-heading .zeus-background-heading > div',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'background_heading_border',
				'label'       => __( 'Border', 'zeus-elementor' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .zeus-advanced-heading .zeus-background-heading > div',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'background_heading_border_radius',
			[
				'label'      => __( 'Border Radius', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .zeus-advanced-heading .zeus-background-heading > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'background_heading_box_shadow',
				'selector' => '{{WRAPPER}} .zeus-advanced-heading .zeus-background-heading > div',
			]
		);

		$this->add_control(
			'background_heading_opacity',
			[
				'label' => __( 'Opacity', 'zeus-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0.05,
						'max'  => 1,
						'step' => 0.05,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .zeus-advanced-heading .zeus-background-heading > div' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$title_tag  = $settings['title_html_tag'];
		$hide       = $settings['background_heading_hide'];
		$main_line  = $settings['main_heading_line_align'];
		$sub_line   = $settings['sub_heading_line_align'];

		$this->add_render_attribute( 'wrap', 'class', 'zeus-advanced-heading' );

		$this->add_render_attribute( 'background-heading', 'class', 'zeus-background-heading' );

		if ( 'never' !== $hide ) {
			$this->add_render_attribute( 'background-heading', 'class', 'zeus-hide-' . $hide );
		}

		if ( 'yes' === $settings['background_heading_advanced_color'] ) {
			$this->add_render_attribute( 'background-heading', 'class', 'zeus-has-bg' );
		}

		$this->add_render_attribute( 'main-heading', 'class', 'zeus-main-heading' );

		if ( 'yes' === $settings['main_heading_advanced_color'] ) {
			$this->add_render_attribute( 'main-heading', 'class', 'zeus-has-bg' );
		}

		$this->add_render_attribute( 'sub-heading', 'class', 'zeus-sub-heading' );

		if ( 'yes' === $settings['sub_heading_advanced_color'] ) {
			$this->add_render_attribute( 'sub-heading', 'class', 'zeus-has-bg' );
		}

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'heading', $settings['link'] );
			$title_tag = 'a';
		} ?>

		<div <?php $this->print_render_attribute_string( 'wrap' ); ?>>

			<?php
			if ( ! empty( $settings['background_heading'] ) ) { ?>
				<div <?php $this->print_render_attribute_string( 'background-heading' ); ?>>
					<div><?php $this->print_unescaped_setting( 'background_heading' ); ?></div>
				</div>
				<?php
			}

			if ( ! empty( $settings['main_heading'] ) ) { ?>
				<<?php echo esc_attr( $title_tag ); ?> <?php $this->print_render_attribute_string( 'heading' ); ?> <?php $this->print_render_attribute_string( 'main-heading' ); ?>>
					<div>
						<?php $this->print_unescaped_setting( 'main_heading' ); ?>

						<?php
						if ( 'yes' === $settings['main_heading_line'] ) {
							if ( 'left-right' === $main_line ) {
								?>
								<div class="zeus-line zeus-main-line zeus-line-align-left"></div><div class="zeus-line zeus-main-line zeus-line-align-right"></div>
								<?php
							} else {
								?>
								<div class="zeus-line zeus-main-line zeus-line-align-<?php echo esc_attr( $main_line ); ?>"></div>
								<?php
							}
						}
						?>
					</div>
				</<?php echo esc_attr( $title_tag ); ?>>
				<?php
			}

			if ( ! empty( $settings['sub_heading'] ) ) { ?>
				<div <?php $this->print_render_attribute_string( 'sub-heading' ); ?>>
					<div>
						<?php $this->print_unescaped_setting( 'sub_heading' ); ?>

						<?php
						if ( 'yes' === $settings['sub_heading_line'] ) {
							if ( 'left-right' === $sub_line ) {
								?>
								<div class="zeus-line zeus-sub-line zeus-line-align-left"></div><div class="zeus-line zeus-sub-line zeus-line-align-right"></div>
								<?php
							} else {
								?>
								<div class="zeus-line zeus-sub-line zeus-line-align-<?php echo esc_attr( $sub_line ); ?>"></div>
								<?php
							}
						}
						?>
					</div>
				</div>
				<?php
			}
			?>

		</div>

		<?php
	}

	protected function content_template() { ?>
		<#
		view.addRenderAttribute( 'background-heading', 'class', 'zeus-background-heading' );

		if ( 'never' != settings.background_heading_hide ) {
			view.addRenderAttribute( 'background-heading', 'class', 'zeus-hide-' + settings.background_heading_hide );
		}

		if ( 'yes' == settings.background_heading_advanced_color ) {
			view.addRenderAttribute( 'background-heading', 'class', 'zeus-has-bg' );
		}

		var tag = settings.title_html_tag;
		view.addRenderAttribute( 'main-heading', 'class', 'zeus-main-heading' );

		if ( 'yes' == settings.main_heading_advanced_color ) {
			view.addRenderAttribute( 'main-heading', 'class', 'zeus-has-bg' );
		}

		if ( '' !== settings.link.url ) {
			tag = 'a';
			view.addRenderAttribute( 'main-heading', 'href', settings.link.url );
		}

		view.addRenderAttribute( 'sub-heading', 'class', 'zeus-sub-heading' );

		if ( 'yes' == settings.sub_heading_advanced_color ) {
			view.addRenderAttribute( 'sub-heading', 'class', 'zeus-has-bg' );
		} #>

		<div class="zeus-advanced-heading">

			<# if ( settings.background_heading ) { #>
				<div {{{ view.getRenderAttributeString( 'background-heading' ) }}}>
					<div>{{{ settings.background_heading }}}</div>
				</div>
			<# }

			if ( settings.main_heading ) { #>
				<{{ tag }} {{{ view.getRenderAttributeString( 'main-heading' ) }}}>
					<div>
						{{{ settings.main_heading }}}

						<# if ( 'yes' == settings.main_heading_line ) {
							if ( 'left-right' == settings.main_heading_line_align ) { #>
								<div class="zeus-line zeus-main-line zeus-line-align-left"></div><div class="zeus-line zeus-main-line zeus-line-align-right"></div>
							<# } else { #>
								<div class="zeus-line zeus-main-line zeus-line-align-{{ settings.main_heading_line_align }}"></div>
							<# }
						} #>
					</div>
				</{{ tag }}>
			<# }

			if ( settings.sub_heading ) { #>
				<div {{{ view.getRenderAttributeString( 'sub-heading' ) }}}>
					<div>
						{{{ settings.sub_heading }}}

						<# if ( 'yes' == settings.sub_heading_line ) {
							if ( 'left-right' == settings.sub_heading_line_align ) { #>
								<div class="zeus-line zeus-sub-line zeus-line-align-left"></div><div class="zeus-line zeus-sub-line zeus-line-align-right"></div>
							<# } else { #>
								<div class="zeus-line zeus-sub-line zeus-line-align-{{ settings.sub_heading_line_align }}"></div>
							<# }
						} #>
					</div>
				</div>

			<# } #>

		</div>
		<?php
	}
}
