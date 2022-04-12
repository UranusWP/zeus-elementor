<?php
namespace ZeusElementor\Modules\BusinessHours\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class BusinessHours extends Widget_Base {

	public function get_name() {
		return 'zeus-business-hours';
	}

	public function get_title() {
		return __( 'Business Hours', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-alarm2';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'business hours',
			'hours',
			'business',
			'zeus',
		];
	}

	public function get_style_depends() {
		return [ 'zeus-business-hours' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_business_hours_settings',
			[
				'label'         => __( 'Business Hours', 'zeus-elementor' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'day',
			[
				'label' => __( 'Day', 'zeus-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => __( 'Monday', 'zeus-elementor' ),
				'options' => [
					__( 'Monday', 'zeus-elementor' )    => __( 'Monday', 'zeus-elementor' ),
					__( 'Tuesday', 'zeus-elementor' )   => __( 'Tuesday', 'zeus-elementor' ),
					__( 'Wednesday', 'zeus-elementor' ) => __( 'Wednesday', 'zeus-elementor' ),
					__( 'Thursday', 'zeus-elementor' )  => __( 'Thursday', 'zeus-elementor' ),
					__( 'Friday', 'zeus-elementor' )    => __( 'Friday', 'zeus-elementor' ),
					__( 'Saturday', 'zeus-elementor' )  => __( 'Saturday', 'zeus-elementor' ),
					__( 'Sunday', 'zeus-elementor' )    => __( 'Sunday', 'zeus-elementor' ),
					'custom'    => __( 'Custom', 'zeus-elementor' ),
				],
			]
		);

		$repeater->add_control(
			'custom_text',
			[
				'label'         => __( 'Custom Text', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Mon-Fri', 'zeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
				'condition'     => [
					'day' => 'custom',
				],
			]
		);

		$repeater->add_control(
			'opening_hours',
			[
				'label' => __( 'Opening Hours', 'zeus-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '08:00',
				'options' => [
					'00:00'    => '12:00 AM',
					'00:30'    => '12:30 AM',
					'01:00'    => '1:00 AM',
					'01:30'    => '1:30 AM',
					'02:00'    => '2:00 AM',
					'02:30'    => '2:30 AM',
					'03:00'    => '3:00 AM',
					'03:30'    => '3:30 AM',
					'04:00'    => '4:00 AM',
					'04:30'    => '4:30 AM',
					'05:00'    => '5:00 AM',
					'05:30'    => '5:30 AM',
					'06:00'    => '6:00 AM',
					'06:30'    => '6:30 AM',
					'07:00'    => '7:00 AM',
					'07:30'    => '7:30 AM',
					'08:00'    => '8:00 AM',
					'08:30'    => '8:30 AM',
					'09:00'    => '9:00 AM',
					'09:30'    => '9:30 AM',
					'10:00'    => '10:00 AM',
					'10:30'    => '10:30 AM',
					'11:00'    => '11:00 AM',
					'11:30'    => '11:30 AM',
					'12:00'    => '12:00 PM',
					'12:30'    => '12:30 PM',
					'13:00'    => '1:00 PM',
					'13:30'    => '1:30 PM',
					'14:00'    => '2:00 PM',
					'14:30'    => '2:30 PM',
					'15:00'    => '3:00 PM',
					'15:30'    => '3:30 PM',
					'16:00'    => '4:00 PM',
					'16:30'    => '4:30 PM',
					'17:00'    => '5:00 PM',
					'17:30'    => '5:30 PM',
					'18:00'    => '6:00 PM',
					'18:30'    => '6:30 PM',
					'19:00'    => '7:00 PM',
					'19:30'    => '7:30 PM',
					'20:00'    => '8:00 PM',
					'20:30'    => '8:30 PM',
					'21:00'    => '9:00 PM',
					'21:30'    => '9:30 PM',
					'22:00'    => '10:00 PM',
					'22:30'    => '10:30 PM',
					'23:00'    => '11:00 PM',
					'23:30'    => '11:30 PM',
					'24:00'    => '12:00 PM',
					'24:30'    => '12:30 PM',
				],
			]
		);

		$repeater->add_control(
			'closing_hours',
			[
				'label' => __( 'Closing Hours', 'zeus-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '19:00',
				'options' => [
					'00:00'    => '12:00 AM',
					'00:30'    => '12:30 AM',
					'01:00'    => '1:00 AM',
					'01:30'    => '1:30 AM',
					'02:00'    => '2:00 AM',
					'02:30'    => '2:30 AM',
					'03:00'    => '3:00 AM',
					'03:30'    => '3:30 AM',
					'04:00'    => '4:00 AM',
					'04:30'    => '4:30 AM',
					'05:00'    => '5:00 AM',
					'05:30'    => '5:30 AM',
					'06:00'    => '6:00 AM',
					'06:30'    => '6:30 AM',
					'07:00'    => '7:00 AM',
					'07:30'    => '7:30 AM',
					'08:00'    => '8:00 AM',
					'08:30'    => '8:30 AM',
					'09:00'    => '9:00 AM',
					'09:30'    => '9:30 AM',
					'10:00'    => '10:00 AM',
					'10:30'    => '10:30 AM',
					'11:00'    => '11:00 AM',
					'11:30'    => '11:30 AM',
					'12:00'    => '12:00 PM',
					'12:30'    => '12:30 PM',
					'13:00'    => '1:00 PM',
					'13:30'    => '1:30 PM',
					'14:00'    => '2:00 PM',
					'14:30'    => '2:30 PM',
					'15:00'    => '3:00 PM',
					'15:30'    => '3:30 PM',
					'16:00'    => '4:00 PM',
					'16:30'    => '4:30 PM',
					'17:00'    => '5:00 PM',
					'17:30'    => '5:30 PM',
					'18:00'    => '6:00 PM',
					'18:30'    => '6:30 PM',
					'19:00'    => '7:00 PM',
					'19:30'    => '7:30 PM',
					'20:00'    => '8:00 PM',
					'20:30'    => '8:30 PM',
					'21:00'    => '9:00 PM',
					'21:30'    => '9:30 PM',
					'22:00'    => '10:00 PM',
					'22:30'    => '10:30 PM',
					'23:00'    => '11:00 PM',
					'23:30'    => '11:30 PM',
					'24:00'    => '12:00 PM',
					'24:30'    => '12:30 PM',
				],
			]
		);

		$repeater->add_control(
			'closed',
			[
				'label' => __( 'Closed', 'zeus-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'return_value' => 'yes',
			]
		);

		$repeater->add_control(
			'closed_text',
			[
				'label' => __( 'Closed Text', 'zeus-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'Closed', 'zeus-elementor' ),
				'default' => __( 'Closed', 'zeus-elementor' ),
				'condition' => [
					'closed' => 'yes',
				],
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'highlight',
			[
				'label' => __( 'Highlight', 'zeus-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'return_value' => 'yes',
			]
		);

		$repeater->add_control(
			'highlight_bg',
			[
				'label' => __( 'Background Color', 'zeus-elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'highlight' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-hours-row{{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'highlight_color',
			[
				'label' => __( 'Text Color', 'zeus-elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'highlight' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-hours-row{{CURRENT_ITEM}} .zeus-business-day, {{WRAPPER}} .zeus-business-hours .zeus-business-hours-row{{CURRENT_ITEM}} .zeus-business-timing' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'business_hours',
			[
				'label'         => '',
				'type'          => Controls_Manager::REPEATER,
				'default'       => [
					[
						'day' => __( 'Monday', 'zeus-elementor' ),
					],
					[
						'day' => __( 'Tuesday', 'zeus-elementor' ),
					],
					[
						'day' => __( 'Wednesday', 'zeus-elementor' ),
					],
				],
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ day }}}',
			]
		);

		$this->add_control(
			'icon',
			[
				'label'         => __( 'Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'label_block'   => true,
				'default'       => [
					'value'   => '',
					'library' => 'solid',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'zeus-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 3,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-day .zeus-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_business_hours',
			[
				'label'         => __( 'Business Hours', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'hours_format',
			[
				'label'         => __( '24 Hours Format?', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'no',
				'return_value'  => 'yes',
			]
		);

		$this->add_control(
			'days_format',
			[
				'label'         => __( 'Days Format', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'long',
				'options'       => [
					'long'  => __( 'Long', 'zeus-elementor' ),
					'short' => __( 'Short', 'zeus-elementor' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_rows_style',
			[
				'label'         => __( 'Rows', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'stripes',
			[
				'label'         => __( 'Striped Rows', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'no',
				'return_value'  => 'yes',
			]
		);

		$this->start_controls_tabs( 'tabs_alternate_style' );

		$this->start_controls_tab(
			'tab_even',
			[
				'label'         => __( 'Even Row', 'zeus-elementor' ),
				'condition'     => [
					'stripes' => 'yes',
				],
			]
		);

		$this->add_control(
			'row_even_bg_color',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '#fbfbfb',
				'condition'     => [
					'stripes' => 'yes',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-hours-row:nth-child(even)' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'row_even_text_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'condition'     => [
					'stripes' => 'yes',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-hours-row:nth-child(even)' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_odd',
			[
				'label'         => __( 'Odd Row', 'zeus-elementor' ),
				'condition'     => [
					'stripes' => 'yes',
				],
			]
		);

		$this->add_control(
			'row_odd_bg_color',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '#ffffff',
				'condition'     => [
					'stripes' => 'yes',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-hours-row:nth-child(odd)' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'row_odd_text_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'condition'     => [
					'stripes' => 'yes',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-hours-row:nth-child(odd)' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->start_controls_tabs( 'tabs_rows_style' );

		$this->start_controls_tab(
			'tab_row_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
				'condition'     => [
					'stripes!' => 'yes',
				],
			]
		);

		$this->add_control(
			'row_bg_color_normal',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'condition'     => [
					'stripes!' => 'yes',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-hours-row' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_row_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
				'condition'     => [
					'stripes!' => 'yes',
				],
			]
		);

		$this->add_control(
			'row_bg_color_hover',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'condition'     => [
					'stripes!' => 'yes',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-hours-row:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'rows_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'separator'     => 'before',
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-hours-row' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rows_margin',
			[
				'label'         => __( 'Margin Bottom', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min'   => 0,
						'max'   => 80,
						'step'  => 1,
					],
				],
				'size_units'    => [ 'px' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-hours-row:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'closed_row_heading',
			[
				'label'         => __( 'Closed Row', 'zeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'closed_row_bg_color',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-hours-row.row-closed' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'closed_row_day_color',
			[
				'label'         => __( 'Day Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-hours-row.row-closed .zeus-business-day' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'closed_row_tex_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-hours-row.row-closed .zeus-business-timing' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'divider_heading',
			[
				'label'         => __( 'Rows Divider', 'zeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'rows_divider_style',
			[
				'label'         => __( 'Divider Style', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'none',
				'options'       => [
					'none'      => __( 'None', 'zeus-elementor' ),
					'solid'     => __( 'Solid', 'zeus-elementor' ),
					'dashed'    => __( 'Dashed', 'zeus-elementor' ),
					'dotted'    => __( 'Dotted', 'zeus-elementor' ),
					'groove'    => __( 'Groove', 'zeus-elementor' ),
					'ridge'     => __( 'Ridge', 'zeus-elementor' ),
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-hours-row:not(:last-child)' => 'border-bottom-style: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rows_divider_color',
			[
				'label'         => __( 'Divider Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'condition'     => [
					'rows_divider_style!' => 'none',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-hours-row:not(:last-child)' => 'border-bottom-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'rows_divider_weight',
			[
				'label'         => __( 'Divider Weight', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [ 'size' => 1 ],
				'range'         => [
					'px' => [
						'min'   => 0,
						'max'   => 30,
						'step'  => 1,
					],
				],
				'size_units'    => [ 'px' ],
				'condition'     => [
					'rows_divider_style!' => 'none',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-hours-row:not(:last-child)' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_pricing_table_style',
			[
				'label'         => __( 'Business Hours', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_hours_style' );

		$this->start_controls_tab(
			'tab_hours_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label'         => __( 'Day', 'zeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'day_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-day' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'title_typography',
				'label'         => __( 'Typography', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-business-hours .zeus-business-day',
			]
		);

		$this->add_control(
			'hours_heading',
			[
				'label'         => __( 'Hours', 'zeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'hours_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-timing' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'hours_typography',
				'label'         => __( 'Typography', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-business-hours .zeus-business-timing',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_hours_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'day_color_hover',
			[
				'label'         => __( 'Day Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-hours-row:hover .zeus-business-day' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'hours_color_hover',
			[
				'label'         => __( 'Hours Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-business-hours-row:hover .zeus-business-timing' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'icon_heading',
			[
				'label'         => __( 'Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
				'condition'     => [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'         => __( 'Icon Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'condition'     => [
					'icon!' => '',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label'         => __( 'Spacing', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min'   => 0,
						'max'   => 100,
						'step'  => 1,
					],
				],
				'size_units'    => [ 'px' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-business-hours .zeus-icon' => 'padding-right: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .zeus-business-hours .zeus-icon' => 'padding-right: 0; padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'business-hours', 'class', 'zeus-business-hours' );
		$i = 1; ?>

		<div <?php $this->print_render_attribute_string( 'business-hours' ); ?>>
			<?php
			foreach ( $settings['business_hours'] as $index => $item ) :

				$this->add_render_attribute( 'row' . $i, 'class', [
					'zeus-business-hours-row',
					'elementor-repeater-item-' . esc_attr( $item['_id'] ),
				] );

				if ( 'yes' === $item['closed'] ) {
					$this->add_render_attribute( 'row' . $i, 'class', 'row-closed' );
				} ?>

				<div <?php $this->print_render_attribute_string( 'row' . $i ); ?>>
					<span class="zeus-business-day">
						<?php
						if ( ! empty( $settings['icon'] ) ) { ?>
							<span class="zeus-icon"><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
							<?php
						}

						if ( 'custom' === $item['day'] && ! empty( $item['custom_text'] ) ) { ?>
							<span class="zeus-custom-text"><?php echo esc_attr( $item['custom_text'] ); ?></span>
							<?php
						} elseif ( 'long' === $settings['days_format'] ) { ?>
							<span class="zeus-day"><?php echo esc_attr( ucwords( $item['day'] ) ); ?></span>
							<?php
						} else { ?>
							<span class="zeus-day"><?php echo esc_attr( ucwords( substr( $item['day'], 0, 3 ) ) ); ?></span>
							<?php
						} ?>
					</span>

					<span class="zeus-business-timing">
						<?php
						if ( 'yes' === $item['closed'] ) {
							echo esc_attr( $item['closed_text'] );
						} else { ?>
							<span class="zeus-opening-hours">
								<?php
								if ( 'yes' === $settings['hours_format'] ) {
									echo esc_attr( $item['opening_hours'] );
								} else {
									echo esc_attr( gmdate( 'g:i A', strtotime( $item['opening_hours'] ) ) );
								} ?>
							</span>
							-
							<span class="zeus-closing-hours">
								<?php
								if ( 'yes' === $settings['hours_format'] ) {
									echo esc_attr( $item['closing_hours'] );
								} else {
									echo esc_attr( gmdate( 'g:i A', strtotime( $item['closing_hours'] ) ) );
								} ?>
							</span>
							<?php
						} ?>
					</span>
				</div>
				<?php
				$i++;
			endforeach; ?>
		</div>
		<?php
	}

	protected function content_template() { ?>
		<#
		function zeus_timeTo12HrFormat(time) {
			// Take a time in 24 hour format and format it in 12 hour format
			var time_part_array = time.split(":");
			var ampm = 'AM';

			if ( time_part_array[0] >= 12 ) {
				ampm = 'PM';
			}

			if ( time_part_array[0] > 12 ) {
				time_part_array[0] = time_part_array[0] - 12;
			}

			formatted_time = time_part_array[0] + ':' + time_part_array[1] + ' ' + ampm;

			return formatted_time;
		} #>

		<# var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' ); #>

		<div class="zeus-business-hours">
			<# _.each( settings.business_hours, function( item ) {
				var closed = ( item.closed == 'yes' ) ? 'row-closed' : ''; #>

				<div class="zeus-business-hours-row elementor-repeater-item-{{ item._id }} {{ closed }}">
					<span class="zeus-business-day">
						<# if ( '' != settings.icon ) { #>
							<span class="zeus-icon">{{{ iconHTML.value }}}</span>
						<# }

						if ( 'custom' == item.day ) { #>
							<span class="zeus-custom-text">{{{ item.custom_text }}}</span>
						<# } else if ( 'long' == settings.days_format ) { #>
							<span class="zeus-day">{{ item.day }}</span>
						<# } else { #>
							<span class="zeus-day">{{ item.day.substring(0,3) }}</span>
						<# } #>
					</span>

					<span class="zeus-business-timing">
						<# if ( 'yes' == item.closed ) { #>
							{{{ item.closed_text }}}
						<# } else { #>
							<span class="zeus-opening-hours">
								<# if ( 'yes' == settings.hours_format ) { #>
									{{ item.opening_hours }}
								<# } else { #>
									{{ zeus_timeTo12HrFormat( item.opening_hours ) }}
								<# } #>
							</span>
							-
							<span class="zeus-closing-hours">
								<# if ( 'yes' == settings.hours_format ) { #>
									{{ item.closing_hours }}
								<# } else { #>
									{{ zeus_timeTo12HrFormat( item.closing_hours ) }}
								<# } #>
							</span>
						<# } #>
					</span>
				</div>

			<# } ); #>
		</div>
		<?php
	}
}
