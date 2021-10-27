<?php
namespace ZeusElementor\Modules\InfoBox\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class InfoBox extends Widget_Base {

	public function get_name() {
		return 'zeus-info-box';
	}

	public function get_title() {
		return __( 'Info Box', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-lamp-bright';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'info',
			'box',
			'zeus',
		];
	}

	public function get_style_depends() {
		return [ 'zeus-info-box' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_info_box',
			[
				'label'         => __( 'General', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'type',
			[
				'label'         => __( 'Type', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'icon',
				'options'       => [
					'none'      => __( 'None', 'zeus-elementor' ),
					'icon'      => __( 'Icon', 'zeus-elementor' ),
					'text'      => __( 'Text', 'zeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label'         => __( 'Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'default'       => [
					'value'     => 'fas fa-snowflake',
					'library'   => 'fa-solid',
				],
				'condition'     => [
					'type' => 'icon',
				],
			]
		);

		$this->add_control(
			'text',
			[
				'label'         => __( 'Text', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => '1',
				'condition'     => [
					'type' => 'text',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_responsive_control(
			'position',
			[
				'label'         => __( 'Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'default'       => 'top',
				'options'       => [
					'left' => [
						'title'   => __( 'Left', 'zeus-elementor' ),
						'icon'    => 'eicon-text-align-left',
					],
					'top' => [
						'title'   => __( 'Top', 'zeus-elementor' ),
						'icon'    => 'eicon-text-align-center',
					],
					'right' => [
						'title'   => __( 'Right', 'zeus-elementor' ),
						'icon'    => 'eicon-text-align-right',
					],
				],
				'prefix_class'  => 'zeus-info-box%s-',
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'         => __( 'Content Alignment', 'zeus-elementor' ),
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
				],
				'default'       => 'center',
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'vertical_position',
			[
				'label'         => __( 'Vertical Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'default'       => 'top',
				'options'       => [
					'top' => [
						'title'   => __( 'Top', 'zeus-elementor' ),
						'icon'    => 'eicon-v-align-top',
					],
					'middle' => [
						'title'   => __( 'Middle', 'zeus-elementor' ),
						'icon'    => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title'   => __( 'Bottom', 'zeus-elementor' ),
						'icon'    => 'eicon-v-align-bottom',
					],
				],
				'condition'     => [
					'position'  => [
						'left',
						'right',
					],
					'type!'  => 'none',
				],
				'selectors'     => [
					'(desktop){{WRAPPER}}.zeus-info-box-left .zeus-info-box' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
					'(desktop){{WRAPPER}}.zeus-info-box-right .zeus-info-box' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
					'(tablet){{WRAPPER}}.zeus-info-box-tablet-left .zeus-info-box' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
					'(tablet){{WRAPPER}}.zeus-info-box-tablet-right .zeus-info-box' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
					'(mobile){{WRAPPER}}.zeus-info-box-mobile-left .zeus-info-box' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
					'(mobile){{WRAPPER}}.zeus-info-box-mobile-right .zeus-info-box' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
				],
				'selectors_dictionary' => [
					'top'          => 'flex-start',
					'middle'       => 'center',
					'bottom'       => 'flex-end',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			[
				'label'         => __( 'Content', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'         => __( 'Title', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'This is the heading', 'zeus-elementor' ),
				'label_block'   => true,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'description',
			[
				'label'         => __( 'Description', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'zeus-elementor' ),
				'placeholder'   => __( 'Enter your description', 'zeus-elementor' ),
				'rows'          => 10,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'title_divider',
			[
				'label'         => __( 'Title Separator', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'no',
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'         => __( 'Title Tag', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'h3',
				'options'       => [
					'h1'     => __( 'H1', 'zeus-elementor' ),
					'h2'     => __( 'H2', 'zeus-elementor' ),
					'h3'     => __( 'H3', 'zeus-elementor' ),
					'h4'     => __( 'H4', 'zeus-elementor' ),
					'h5'     => __( 'H5', 'zeus-elementor' ),
					'h6'     => __( 'H6', 'zeus-elementor' ),
					'div'    => __( 'div', 'zeus-elementor' ),
					'span'   => __( 'span', 'zeus-elementor' ),
					'p'      => __( 'p', 'zeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'link_heading',
			[
				'label'         => __( 'Link', 'zeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'link_type',
			[
				'label'         => __( 'Link Type', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'none',
				'options'       => [
					'none'    => __( 'None', 'zeus-elementor' ),
					'box'     => __( 'Box', 'zeus-elementor' ),
					'title'   => __( 'Title', 'zeus-elementor' ),
					'button'  => __( 'Button', 'zeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'button_size',
			[
				'label'         => __( 'Size', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'md',
				'options'       => [
					'xs' => __( 'Extra Small', 'zeus-elementor' ),
					'sm' => __( 'Small', 'zeus-elementor' ),
					'md' => __( 'Medium', 'zeus-elementor' ),
					'lg' => __( 'Large', 'zeus-elementor' ),
					'xl' => __( 'Extra Large', 'zeus-elementor' ),
				],
				'condition'     => [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => __( 'Link', 'zeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'zeus-elementor' ),
				'condition'     => [
					'link_type!'   => 'none',
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'         => __( 'Button Text', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Learn More', 'zeus-elementor' ),
				'condition'     => [
					'link_type' => 'button',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label'         => __( 'Button Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'default'       => [
					'value'   => '',
					'library' => 'solid',
				],
				'condition'     => [
					'link_type'   => 'button',
				],
			]
		);

		$this->add_control(
			'button_icon_position',
			[
				'label'         => __( 'Icon Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'left',
				'options'       => [
					'left'     => __( 'Before', 'zeus-elementor' ),
					'right'    => __( 'After', 'zeus-elementor' ),
				],
				'condition'     => [
					'link_type'     => 'button',
					'button_icon!'  => '',
				],
			]
		);

		$this->add_control(
			'button_icon_spacing',
			[
				'label'         => __( 'Icon Spacing', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 50,
					],
				],
				'condition'     => [
					'link_type'     => 'button',
					'button_icon!'  => '',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-button.elementor-align-icon-right i' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .zeus-info-box-button.elementor-align-icon-left i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_icon_size',
			[
				'label'         => __( 'Button Icon Size', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min'   => 5,
						'max'   => 100,
						'step'  => 1,
					],
				],
				'size_units'    => [ 'px', 'em' ],
				'condition'     => [
					'type' => 'icon',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-button i, {{WRAPPER}} .zeus-info-box-button svg' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'         => __( 'Info Box', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_info_box' );

		$this->start_controls_tab(
			'tab_info_box_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'          => 'info_box_background',
				'selector'      => '{{WRAPPER}} .zeus-info-box-wrap',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'info_box_border',
				'selector'      => '{{WRAPPER}} .zeus-info-box-wrap',
			]
		);

		$this->add_control(
			'info_box_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'info_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-info-box-wrap',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_info_box_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'          => 'info_box_hover_background',
				'selector'      => '{{WRAPPER}} .zeus-info-box-wrap:hover',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'info_box_hover_border',
				'selector'      => '{{WRAPPER}} .zeus-info-box-wrap:hover',
			]
		);

		$this->add_control(
			'info_box_border_radius_hover',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'info_box_hover_animation',
			[
				'label'         => __( 'Animation', 'zeus-elementor' ),
				'type'          => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'info_box_shadow_hover',
				'selector'      => '{{WRAPPER}} .zeus-info-box-wrap:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'info_box_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'separator'     => 'before',
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label'         => __( 'Icon Style', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'type!' => 'none',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'         => __( 'Icon Size', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min'   => 5,
						'max'   => 500,
						'step'  => 1,
					],
				],
				'size_units'    => [ 'px', 'em' ],
				'condition'     => [
					'type' => 'icon',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'text_typography',
				'label'         => __( 'Typography', 'zeus-elementor' ),
				'condition'     => [
					'type' => 'text',
				],
				'selector'      => '{{WRAPPER}} .zeus-info-box-icon',
			]
		);

		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'icon_background',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-icon' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'         => __( 'Icon Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'icon_background_hover',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'condition'     => [
					'type!' => 'none',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-icon:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label'         => __( 'Icon Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-icon:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_border_color_hover',
			[
				'label'         => __( 'Border Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'condition'     => [
					'type!' => 'none',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-icon:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_hover_animation',
			[
				'label'         => __( 'Icon Animation', 'zeus-elementor' ),
				'type'          => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'icon_border',
				'label'         => __( 'Border', 'zeus-elementor' ),
				'condition'     => [
					'type!' => 'none',
				],
				'selector'      => '{{WRAPPER}} .zeus-info-box-icon',
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'condition'     => [
					'type!' => 'none',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-icon, {{WRAPPER}} .zeus-info-box-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_rotation',
			[
				'label'         => __( 'Icon Rotation', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min'   => 0,
						'max'   => 360,
						'step'  => 1,
					],
				],
				'size_units'    => '',
				'condition'     => [
					'type!' => 'none',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-icon' => '-webkit-transform: rotate( {{SIZE}}deg ); -moz-transform: rotate( {{SIZE}}deg ); -ms-transform: rotate( {{SIZE}}deg ); -o-transform: rotate( {{SIZE}}deg ); transform: rotate( {{SIZE}}deg );',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'placeholder'   => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-icon-wrap' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label'         => __( 'Title & Description', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'title_typography',
				'label'         => __( 'Typography', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-info-box-title',
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label'         => __( 'Margin Bottom', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size'  => 15,
				],
				'range'         => [
					'px' => [
						'min'   => 0,
						'max'   => 100,
						'step'  => 1,
					],
					'%' => [
						'min'   => 0,
						'max'   => 30,
						'step'  => 1,
					],
				],
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'description_heading',
			[
				'label'         => __( 'Description', 'zeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'description_typography',
				'label'         => __( 'Typography', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-info-box-description',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_divider_style',
			[
				'label'         => __( 'Title Separator', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'title_divider' => 'yes',
				],
			]
		);

		$this->add_control(
			'divider_title_border_type',
			[
				'label'         => __( 'Border Type', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'solid',
				'options'       => [
					'none'      => __( 'None', 'zeus-elementor' ),
					'solid'     => __( 'Solid', 'zeus-elementor' ),
					'double'    => __( 'Double', 'zeus-elementor' ),
					'dotted'    => __( 'Dotted', 'zeus-elementor' ),
					'dashed'    => __( 'Dashed', 'zeus-elementor' ),
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-divider' => 'border-bottom-style: {{VALUE}}',
				],
				'condition'     => [
					'title_divider' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'divider_title_width',
			[
				'label'         => __( 'Border Width', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size'  => 30,
				],
				'range'         => [
					'px' => [
						'min'   => 1,
						'max'   => 1000,
						'step'  => 1,
					],
					'%' => [
						'min'   => 1,
						'max'   => 100,
						'step'  => 1,
					],
				],
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-divider' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'title_divider' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'divider_title_border_height',
			[
				'label'         => __( 'Border Height', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size'  => 2,
				],
				'range'         => [
					'px' => [
						'min'   => 1,
						'max'   => 20,
						'step'  => 1,
					],
				],
				'size_units'    => [ 'px' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-divider' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'title_divider' => 'yes',
				],
			]
		);

		$this->add_control(
			'divider_title_border_color',
			[
				'label'         => __( 'Border Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-divider' => 'border-bottom-color: {{VALUE}}',
				],
				'condition'     => [
					'title_divider' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'divider_title_align',
			[
				'label'         => __( 'Alignment', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'flex-start' => [
						'title' => __( 'Left', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'    => [
						'title' => __( 'Center', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'  => [
						'title' => __( 'Right', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-divider-wrap'   => 'display: -webkit-box; display: -webkit-flex; display: -ms-flexbox; display: flex; -webkit-justify-content: {{VALUE}}; justify-content: {{VALUE}};',
				],
				'condition'     => [
					'title_divider' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'divider_title_margin',
			[
				'label'         => __( 'Margin Bottom', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size'  => 20,
				],
				'range'         => [
					'px' => [
						'min'   => 0,
						'max'   => 100,
						'step'  => 1,
					],
					'%' => [
						'min'   => 0,
						'max'   => 30,
						'step'  => 1,
					],
				],
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-divider-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'title_divider' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label'         => __( 'Button', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
				'condition'     => [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_background',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-button' => 'background-color: {{VALUE}}',
				],
				'condition'             => [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-button' => 'color: {{VALUE}}',
				],
				'condition'     => [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'button_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-info-box-button',
				'condition'     => [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
				'condition'     => [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_hover_background',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-button:hover' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-button:hover' => 'color: {{VALUE}}',
				],
				'condition'     => [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'         => __( 'Border Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-button:hover' => 'border-color: {{VALUE}}',
				],
				'condition'     => [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_animation',
			[
				'label'         => __( 'Animation', 'zeus-elementor' ),
				'type'          => Controls_Manager::HOVER_ANIMATION,
				'condition'     => [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'button_hover_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-info-box-button:hover',
				'condition'     => [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'button_border_normal',
				'label'         => __( 'Border', 'zeus-elementor' ),
				'condition'     => [
					'link_type'    => 'button',
					'button_text!' => '',
				],
				'selector'      => '{{WRAPPER}} .zeus-info-box-button',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'button_typography',
				'label'         => __( 'Typography', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-info-box-button',
				'condition'     => [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label'         => __( 'Margin Top', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size'  => 15,
				],
				'range'         => [
					'px' => [
						'min'   => 0,
						'max'   => 100,
						'step'  => 1,
					],
					'%' => [
						'min'   => 0,
						'max'   => 30,
						'step'  => 1,
					],
				],
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-btn-wrap' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrap', 'class', 'zeus-info-box-wrap' );

		if ( $settings['info_box_hover_animation'] ) {
			$this->add_render_attribute( 'wrap', 'class', 'elementor-animation-' . $settings['info_box_hover_animation'] );
		}

		$this->add_render_attribute( 'info-box', 'class', 'zeus-info-box' );
		$this->add_render_attribute( 'icon-wrap', 'class', 'zeus-info-box-icon-wrap' );
		$this->add_render_attribute( 'icon', 'class', 'zeus-info-box-icon' );
		$this->add_render_attribute( 'content', 'class', 'zeus-info-box-content' );
		$this->add_render_attribute( 'title', 'class', 'zeus-info-box-title' );
		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_render_attribute( 'description', 'class', 'zeus-info-box-description' );
		$this->add_inline_editing_attributes( 'description', 'basic' );

		$wrap_tag = 'div';
		$tag = $settings['title_tag'];

		$this->add_render_attribute( 'info-box-button', 'class',
			[
				'zeus-info-box-button',
				'elementor-button',
				'elementor-size-' . $settings['button_size'],
				'elementor-align-icon-' . $settings['button_icon_position'],
			]
		);

		if ( $settings['button_animation'] ) {
			$this->add_render_attribute( 'info-box-button', 'class', 'elementor-animation-' . $settings['button_animation'] );
		}

		if ( $settings['icon_hover_animation'] ) {
			$this->add_render_attribute( 'icon', 'class', 'elementor-animation-' . $settings['icon_hover_animation'] );
		}

		if ( 'none' !== $settings['link_type'] ) {
			if ( ! empty( $settings['link']['url'] ) ) {
				if ( 'box' === $settings['link_type'] ) {
					$wrap_tag = 'a';
					$this->add_link_attributes( 'wrap', $settings['link'] );
				} elseif ( 'title' === $settings['link_type'] ) {
					$tag = 'a';
					$this->add_link_attributes( 'title', $settings['link'] );
				} elseif ( 'button' === $settings['link_type'] ) {
					$this->add_link_attributes( 'info-box-button', $settings['link'] );
				}
			}
		} ?>

		<<?php echo esc_attr( $wrap_tag ); ?> <?php $this->print_render_attribute_string( 'wrap' ); ?>>
			<div <?php $this->print_render_attribute_string( 'info-box' ); ?>>

				<?php
				if ( 'none' !== $settings['type'] ) { ?>
					<div <?php $this->print_render_attribute_string( 'icon-wrap' ); ?>>
						<span <?php $this->print_render_attribute_string( 'icon' ); ?>>
							<?php
							if ( 'icon' === $settings['type'] ) {
								Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
							} elseif ( 'text' === $settings['type'] ) { ?>
								<span class="zeus-icon-text">
									<?php $this->print_unescaped_setting( 'text' ); ?>
								</span>
								<?php
							} ?>
						</span>
					</div>
					<?php
				} ?>

				<div <?php $this->print_render_attribute_string( 'content' ); ?>>
					<?php
					if ( ! empty( $settings['title'] ) ) { ?>
						<<?php echo esc_attr( $tag ); ?> <?php $this->print_render_attribute_string( 'title' ); ?>>
							<?php $this->print_unescaped_setting( 'title' ); ?>
						</<?php echo esc_attr( $tag ); ?>>
						<?php
					} ?>

					<?php
					if ( 'yes' === $settings['title_divider'] ) { ?>
						<div class="zeus-info-box-divider-wrap">
							<div class="zeus-info-box-divider"></div>
						</div>
						<?php
					} ?>

					<?php
					if ( ! empty( $settings['description'] ) ) { ?>
						<div <?php $this->print_render_attribute_string( 'description' ); ?>>
							<?php $this->print_unescaped_setting( 'description' ); ?>
						</div>
						<?php
					} ?>

					<?php
					if ( 'button' === $settings['link_type'] ) { ?>
						<div class="zeus-info-box-btn-wrap">
							<a <?php $this->print_render_attribute_string( 'info-box-button' ); ?>>
								<?php
								if ( ! empty( $settings['button_icon'] ) && 'left' === $settings['button_icon_position'] ) {
									Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
								} ?>

								<?php
								if ( ! empty( $settings['button_text'] ) ) { ?>
									<span <?php $this->print_render_attribute_string( 'button_text' ); ?>>
										<?php echo esc_attr( $settings['button_text'] ); ?>
									</span>
									<?php
								} ?>

								<?php
								if ( ! empty( $settings['button_icon'] ) && 'right' === $settings['button_icon_position'] ) {
									Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
								} ?>
							</a>
						</div>
						<?php
					} ?>
				</div>

			</div>
		</<?php echo esc_attr( $wrap_tag ); ?>>

		<?php
	}

	protected function content_template() { ?>

		<#
		var wrap_tag = 'div',
			tag = 'h3',
			iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' ),
			buttoniconHTML = elementor.helpers.renderIcon( view, settings.button_icon, { 'aria-hidden': true }, 'i' , 'object' ); #>

		<{{{wrap_tag}}} class="zeus-info-box-wrap elementor-animation-{{ settings.info_box_hover_animation }}" href="{{settings.link.url}}">
			<div class="zeus-info-box zeus-info-box-{{ settings.icon_position }}">

				<# if ( 'none' != settings.type ) { #>
					<div class="zeus-info-box-icon-wrap">
						<span class="zeus-info-box-icon elementor-animation-{{ settings.icon_hover_animation }}">
							<# if ( 'icon' == settings.type ) { #>
								<# if ( iconHTML && iconHTML.rendered ) { #>
									{{{ iconHTML.value }}}
								<# } #>
							<# } else if ( 'text' == settings.type ) { #>
								<span class="zeus-icon-text elementor-inline-editing" data-elementor-setting-key="text" data-elementor-inline-editing-toolbar="none">
									{{{ settings.text }}}
								</span>
							<# } #>
						</span>
					</div>
				<# } #>

				<div class="zeus-info-box-content">
					<# if ( settings.title ) { #>
						<{{tag}} class="zeus-info-box-title elementor-inline-editing" data-elementor-setting-key="heading" data-elementor-inline-editing-toolbar="none" href="{{ settings.link.url }}">
							{{{ settings.title }}}
						</{{tag}}>
					<# } #>

					<# if ( 'yes' == settings.title_divider ) { #>
						<div class="zeus-info-box-divider-wrap">
							<div class="zeus-info-box-divider"></div>
						</div>
					<# } #>

					<# if ( settings.description ) { #>
						<div class="zeus-info-box-description elementor-inline-editing" data-elementor-setting-key="description" data-elementor-inline-editing-toolbar="basic">
							{{{ settings.description }}}
						</div>
					<# } #>

					<# if ( 'button' == settings.link_type ) { #>
						<div class="zeus-info-box-btn-wrap">
							<a href="{{ settings.link.url }}" class="zeus-info-box-button elementor-button elementor-size-{{ settings.button_size }} elementor-align-icon-{{ settings.button_icon_position }} elementor-animation-{{ settings.button_animation }}">
								<# if ( settings.button_icon && 'left' == settings.button_icon_position ) { #>
									{{{ buttoniconHTML.value }}}
								<# } #>

								<# if ( settings.button_text ) { #>
									<span class="zeus-button-text elementor-inline-editing" data-elementor-setting-key="button_text" data-elementor-inline-editing-toolbar="none">
										{{{ settings.button_text }}}
									</span>
								<# } #>

								<# if ( settings.button_icon && 'right' == settings.button_icon_position ) { #>
									{{{ buttoniconHTML.value }}}
								<# } #>
							</a>
						</div>
					<# } #>
				</div>

			</div>
		</{{{wrap_tag}}}>

		<?php
	}

}
