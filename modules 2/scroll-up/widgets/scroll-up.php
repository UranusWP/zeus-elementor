<?php
namespace ZeusElementor\Modules\ScrollUp\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Scroll_Up extends Widget_Base {

	public function get_name() {
		return 'zeus-scroll-up';
	}

	public function get_title() {
		return __( 'Scroll Up', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-mouse-click-both';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'scroll',
			'up',
			'top',
			'zeus',
		];
	}

	public function get_script_depends() {
		return [ 'zeus-scroll-up' ];
	}

	public function get_style_depends() {
		return [ 'zeus-scroll-up' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_scroll_up',
			[
				'label'         => __( 'Scroll Up', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'fixed_position',
			[
				'label'         => __( 'Fixed Button', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'prefix_class'  => 'zeus-fixed-',
			]
		);

		$this->add_control(
			'button_position',
			[
				'label'         => __( 'Button Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'default'       => 'center',
				'options'       => [
					'left' => [
						'title' => __( 'Left', 'zeus-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'zeus-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default'       => 'right',
				'prefix_class'  => 'zeus-button-position-',
				'condition'     => [
					'fixed_position' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'right_spacing',
			[
				'label'         => __( 'Right Spacing', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}}.zeus-fixed-yes' => 'right: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'fixed_position' => 'yes',
					'button_position' => 'right',
				],
			]
		);

		$this->add_responsive_control(
			'left_spacing',
			[
				'label'         => __( 'Left Spacing', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}}.zeus-fixed-yes.zeus-button-position-left' => 'left: {{SIZE}}{{UNIT}}; right: auto',
				],
				'condition'     => [
					'fixed_position' => 'yes',
					'button_position' => 'left',
				],
			]
		);

		$this->add_responsive_control(
			'bottom_spacing',
			[
				'label'         => __( 'Bottom Spacing', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}}.zeus-fixed-yes' => 'bottom: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'fixed_position' => 'yes',
				],
			]
		);

		$this->add_control(
			'add_text',
			[
				'label'         => __( 'Add Text', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'no',
			]
		);

		$this->add_control(
			'text',
			[
				'label'         => __( 'Text', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Scroll Up', 'zeus-elementor' ),
				'label_block'   => true,
				'condition'     => [
					'add_text' => 'yes',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'         => __( 'Alignment', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left'    => [
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
					'justify' => [
						'title' => __( 'Justified', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'default'       => '',
				'prefix_class' => 'zeus%s-align-',
				'condition'     => [
					'fixed_position' => 'no',
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label'         => __( 'Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'label_block'   => true,
				'default'       => [
					'value'     => 'fas fa-angle-up',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label'         => __( 'Icon Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'left',
				'options'       => [
					'left' => __( 'Before', 'zeus-elementor' ),
					'right' => __( 'After', 'zeus-elementor' ),
				],
				'condition'     => [
					'icon!' => '',
					'add_text' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label'         => __( 'Icon Spacing', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 4,
				],
				'range'         => [
					'px' => [
						'max' => 50,
					],
				],
				'condition'     => [
					'icon!' => '',
					'add_text' => 'yes',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-scroll-button .elementor-align-icon-right' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .zeus-scroll-button .elementor-align-icon-left' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label'         => __( 'Button', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label'         => __( 'Min Width', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-scroll-button a' => 'min-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label'         => __( 'Min Height', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-scroll-button a' => 'min-height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'scroll_button_typography',
				'selector'      => '{{WRAPPER}} .zeus-scroll-button a',
			]
		);

		$this->start_controls_tabs( 'tabs_scroll_button_style' );

		$this->start_controls_tab(
			'tab_scroll_button_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'scroll_button_background_color',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-scroll-button a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'scroll_button_text_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-scroll-button a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_scroll_button_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'scroll_button_hover_background_color',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-scroll-button a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'scroll_button_hover_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-scroll-button a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'scroll_button_hover_border_color',
			[
				'label'         => __( 'Border Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-scroll-button a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'scroll_button_border',
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .zeus-scroll-button a',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'scroll_button_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-scroll-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'scroll_button_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-scroll-button a',
			]
		);

		$this->add_responsive_control(
			'scroll_button_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-scroll-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'scroll_button_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-scroll-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render_icon( $icon ) { ?>
		<span <?php $this->print_render_attribute_string( 'button-icon' ); ?>>
			<?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
		</span>
		<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$text = $settings['add_text'];
		$icon = $settings['icon'];
		$align = $settings['icon_align'];

		$this->add_render_attribute( 'button-wrap', 'class', 'zeus-scroll-button' );

		$this->add_render_attribute( 'button', 'href', '#' );

		$this->add_render_attribute( 'button', 'class',
			[
				'button',
				'elementor-button',
			]
		);

		$this->add_render_attribute( 'button-text', 'class',
			[
				'zeus-button-text',
				'elementor-align-icon-' . $align,
			]
		);

		$this->add_render_attribute( 'button-icon', 'class', 'zeus-button-icon' ); ?>

		<div <?php $this->print_render_attribute_string( 'button-wrap' ); ?>>
			<a <?php $this->print_render_attribute_string( 'button' ); ?>>
				<?php
				if ( 'yes' === $text ) {
					if ( ! empty( $icon ) && 'left' === $align ) {
						$this->render_icon( $icon );
					} ?>

					<span <?php $this->print_render_attribute_string( 'button-text' ); ?>><?php echo esc_attr( $settings['text'] ); ?></span>

					<?php
					if ( ! empty( $icon ) && 'right' === $align ) {
						$this->render_icon( $icon );
					}
				} else {
					if ( ! empty( $icon ) ) {
						$this->render_icon( $icon );
					}
				} ?>
			</a>
		</div>

		<?php
	}

	public function render_plain_content() {}

}
