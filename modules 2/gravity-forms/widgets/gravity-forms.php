<?php
namespace ZeusElementor\Modules\GravityForms\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Gravity_Forms extends Widget_Base {

	public function get_name() {
		return 'zeus-gravity-forms';
	}

	public function get_title() {
		return __( 'Gravity Forms', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-envelope-open2';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'form',
			'contact',
			'gravity',
			'zeus',
		];
	}

	protected function register_controls() {

		// Return if not activated
		if ( ! is_gravity_forms_active() ) {

			$this->start_controls_section( 'warning', [
				'label'             => __( 'Warning!', 'zeus-elementor' ),
			] );

			$this->add_control( 'warning_text', [
				'type'              => Controls_Manager::RAW_HTML,
				'raw'               => __( '<strong>Gravity Forms</strong> is not installed or activated on your site. Please install and activate it first to be able to use this widget.', 'zeus-elementor' ),
			] );

			$this->end_controls_section();

		} else {

			$this->start_controls_section(
				'section_gravity_forms',
				[
					'label'         => __( 'Form', 'zeus-elementor' ),
				]
			);

			$this->add_control(
				'form',
				[
					'label'         => __( 'Select Form', 'zeus-elementor' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => '0',
					'options'       => $this->get_available_forms(),
				]
			);

			$this->add_control(
				'form_title',
				[
					'label'         => __( 'Title', 'zeus-elementor' ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
				]
			);

			$this->add_control(
				'form_description',
				[
					'label'         => __( 'Description', 'zeus-elementor' ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
				]
			);

			$this->add_control(
				'form_ajax',
				[
					'label'         => __( 'Use Ajax', 'zeus-elementor' ),
					'description'   => __( 'Use ajax to submit the form', 'zeus-elementor' ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
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

			$this->add_responsive_control(
				'title_description_alignment',
				[
					'label'         => __( 'Alignment', 'zeus-elementor' ),
					'type'          => Controls_Manager::CHOOSE,
					'options'       => [
						'left'      => [
							'title' => __( 'Left', 'zeus-elementor' ),
							'icon'  => 'eicon-text-align-left',
						],
						'center'    => [
							'title' => __( 'Center', 'zeus-elementor' ),
							'icon'  => 'eicon-text-align-center',
						],
						'right'     => [
							'title' => __( 'Right', 'zeus-elementor' ),
							'icon'  => 'eicon-text-align-right',
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .gform_wrapper .gform_heading' => 'text-align: {{VALUE}};',
						'{{WRAPPER}} .gform_wrapper span.gform_description' => 'width: 100%;',
					],
				]
			);

			$this->add_control(
				'title_heading',
				[
					'label'         => __( 'Title', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gform_wrapper h3.gform_title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'title_typo',
					'selector'      => '{{WRAPPER}} .gform_wrapper h3.gform_title',
				]
			);

			$this->add_responsive_control(
				'title_margin',
				[
					'label'         => __( 'Margin', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em' ],
					'selectors'     => [
						'{{WRAPPER}} .gform_wrapper h3.gform_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .gform_wrapper span.gform_description' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'description_typo',
					'selector'      => '{{WRAPPER}} .gform_wrapper span.gform_description',
				]
			);

			$this->add_responsive_control(
				'description_margin',
				[
					'label'         => __( 'Margin', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em' ],
					'selectors'     => [
						'{{WRAPPER}} .gform_wrapper span.gform_description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_style',
				[
					'label'         => __( 'Labels & Descriptions', 'zeus-elementor' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'labels_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gfield label' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'labels_typo',
					'selector'      => '{{WRAPPER}} .gfield label',
				]
			);

			$this->add_responsive_control(
				'labels_margin',
				[
					'label'         => __( 'Margin', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em' ],
					'selectors'     => [
						'{{WRAPPER}} .gfield label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'labels_alignment',
				[
					'label'         => __( 'Alignment', 'zeus-elementor' ),
					'type'          => Controls_Manager::CHOOSE,
					'options'       => [
						'left'      => [
							'title' => __( 'Left', 'zeus-elementor' ),
							'icon'  => 'eicon-text-align-left',
						],
						'center'    => [
							'title' => __( 'Center', 'zeus-elementor' ),
							'icon'  => 'eicon-text-align-center',
						],
						'right'     => [
							'title' => __( 'Right', 'zeus-elementor' ),
							'icon'  => 'eicon-text-align-right',
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .gfield label' => 'display: block; text-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'inputs_description_heading',
				[
					'label'         => __( 'Description', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);

			$this->add_control(
				'inputs_description_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gfield .gfield_description' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'inputs_description_typo',
					'selector'      => '{{WRAPPER}} .gfield .gfield_description',
				]
			);

			$this->add_responsive_control(
				'inputs_description_margin',
				[
					'label'         => __( 'Margin', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em' ],
					'selectors'     => [
						'{{WRAPPER}} .gfield .gfield_description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_inputs_style',
				[
					'label'         => __( 'Inputs & Textarea', 'zeus-elementor' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);

			$this->start_controls_tabs( 'tabs_inputs_style' );

			$this->start_controls_tab(
				'tab_inputs_normal',
				[
					'label'         => __( 'Normal', 'zeus-elementor' ),
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'inputs_background',
					'selector'      => '{{WRAPPER}} .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .gfield textarea',
				]
			);

			$this->add_control(
				'inputs_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .gfield textarea' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_inputs_hover',
				[
					'label' => __( 'Hover', 'zeus-elementor' ),
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'inputs_hover_background',
					'selector'      => '{{WRAPPER}} .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):hover, {{WRAPPER}} .gfield textarea:hover',
				]
			);

			$this->add_control(
				'inputs_hover_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):hover, {{WRAPPER}} .gfield textarea:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'inputs_hover_border_color',
				[
					'label'         => __( 'Border Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):hover, {{WRAPPER}} .gfield textarea:hover' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_inputs_focus',
				[
					'label' => __( 'Focus', 'zeus-elementor' ),
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'inputs_focus_background',
					'selector'      => '{{WRAPPER}} .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}} .gfield textarea:focus',
				]
			);

			$this->add_control(
				'inputs_focus_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}} .gfield textarea:focus' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'inputs_focus_border_color',
				[
					'label'         => __( 'Border Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}} .gfield textarea:focus' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'inputs_typo',
					'selector'      => '{{WRAPPER}} .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .gfield textarea',
					'separator'     => 'before',
				]
			);

			$this->add_control(
				'inputs_placeholder_color',
				[
					'label'         => __( 'Placeholder Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gfield input[type="text"]::-webkit-input-placeholder, {{WRAPPER}} .gfield textarea::-webkit-input-placeholder' => 'color: {{VALUE}}',
						'{{WRAPPER}} .gfield input[type="text"]::-moz-placeholder, {{WRAPPER}} .gfield textarea::-moz-placeholder'                   => 'color: {{VALUE}}',
						'{{WRAPPER}} .gfield input[type="text"]:-ms-input-placeholder, {{WRAPPER}} .gfield textarea:-ms-input-placeholder'           => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'inputs_border',
					'selector'      => '{{WRAPPER}} .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .gfield textarea',
				]
			);

			$this->add_control(
				'inputs_border_radius',
				[
					'label'         => __( 'Border Radius', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .gfield textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'inputs_box_shadow',
					'selector'      => '{{WRAPPER}} .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .gfield textarea',
				]
			);

			$this->add_responsive_control(
				'inputs_padding',
				[
					'label'         => __( 'Padding', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .gfield textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'inputs_margin',
				[
					'label'         => __( 'Margin', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .gfield textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_button_style',
				[
					'label'         => __( 'Submit Button', 'zeus-elementor' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);

			$this->start_controls_tabs( 'tabs_button_style' );

			$this->start_controls_tab(
				'tab_button_normal',
				[
					'label'         => __( 'Normal', 'zeus-elementor' ),
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'button_background',
					'selector'      => '{{WRAPPER}} .gform_footer input[type="submit"]',
				]
			);

			$this->add_control(
				'button_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gform_footer input[type="submit"]' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_button_hover',
				[
					'label' => __( 'Hover', 'zeus-elementor' ),
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'button_hover_background',
					'selector'      => '{{WRAPPER}} .gform_footer input[type="submit"]:hover',
				]
			);

			$this->add_control(
				'button_hover_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gform_footer input[type="submit"]:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_hover_border_color',
				[
					'label'         => __( 'Border Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gform_footer input[type="submit"]:hover' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_button_focus',
				[
					'label' => __( 'Focus', 'zeus-elementor' ),
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'button_focus_background',
					'selector'      => '{{WRAPPER}} .gform_footer input[type="submit"]:focus',
				]
			);

			$this->add_control(
				'button_focus_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gform_footer input[type="submit"]:focus' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_focus_border_color',
				[
					'label'         => __( 'Border Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gform_footer input[type="submit"]:focus' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'button_typo',
					'selector'      => '{{WRAPPER}} .gform_footer input[type="submit"]',
					'separator'     => 'before',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'button_border',
					'selector'      => '{{WRAPPER}} .gform_footer input[type="submit"]',
				]
			);

			$this->add_control(
				'button_border_radius',
				[
					'label'         => __( 'Border Radius', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .gform_footer input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'button_box_shadow',
					'selector'      => '{{WRAPPER}} .gform_footer input[type="submit"]',
				]
			);

			$this->add_responsive_control(
				'button_padding',
				[
					'label'         => __( 'Padding', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .gform_footer input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'button_margin',
				[
					'label'         => __( 'Margin', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .gform_footer input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'button_fullwidth',
				[
					'label'         => __( 'Fullwidth Button', 'zeus-elementor' ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => '',
					'return_value'  => 'block',
					'selectors'     => [
						'{{WRAPPER}} .gform_footer input[type="submit"]' => 'display: {{VALUE}}; width: 100%;',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_alerts_style',
				[
					'label'         => __( 'Alerts', 'zeus-elementor' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'error_heading',
				[
					'label'         => __( 'Error Messages', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'alerts_typo',
					'selector'      => '{{WRAPPER}} .gfield .validation_message',
				]
			);

			$this->add_control(
				'error_background',
				[
					'label'         => __( 'Background Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gform_wrapper li.gfield.gfield_error, {{WRAPPER}} .gform_wrapper li.gfield.gfield_error.gfield_contains_required.gfield_creditcard_warning' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'error_label_color',
				[
					'label'         => __( 'Label Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gform_wrapper .gfield_error .gfield_label' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'error_text_color',
				[
					'label'         => __( 'Text Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gform_wrapper .validation_message' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'error_border_color',
				[
					'label'         => __( 'Border Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gform_wrapper li.gfield.gfield_error, {{WRAPPER}} .gform_wrapper li.gfield.gfield_error.gfield_contains_required.gfield_creditcard_warning' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'sent_heading',
				[
					'label'         => __( 'Thank You Message', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'sent_typo',
					'selector'      => '{{WRAPPER}} .gform_confirmation_wrapper .gform_confirmation_message',
					'separator'     => 'before',
				]
			);

			$this->add_control(
				'sent_background',
				[
					'label'         => __( 'Background Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gform_confirmation_wrapper .gform_confirmation_message' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'sent_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .gform_confirmation_wrapper .gform_confirmation_message' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'sent_border',
					'selector'      => '{{WRAPPER}} .gform_confirmation_wrapper .gform_confirmation_message',
				]
			);

			$this->add_control(
				'sent_border_radius',
				[
					'label'         => __( 'Border Radius', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .gform_confirmation_wrapper .gform_confirmation_message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'sent_box_shadow',
					'selector'      => '{{WRAPPER}} .gform_confirmation_wrapper .gform_confirmation_message',
				]
			);

			$this->add_responsive_control(
				'sent_padding',
				[
					'label'         => __( 'Padding', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .gform_confirmation_wrapper .gform_confirmation_message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

		}

	}

	protected function get_available_forms() {

		// Return if not activated
		if ( ! is_gravity_forms_active() ) {
			return;
		}

		$forms = \RGFormsModel::get_forms( null, 'title' );

		if ( empty( $forms ) ) {
			return array();
		}

		$result = array( __( '-- Select --', 'zeus-elementor' ) );

		foreach ( $forms as $item ) {
			$result[ $item->id ] = $item->title;
		}

		return $result;
	}

	protected function render() {
		$settings = $this->get_settings();

		$form               = $settings['form'];
		$form_title         = $settings['form_title'];
		$form_description   = $settings['form_description'];
		$form_ajax          = $settings['form_ajax'];

		if ( '0' !== $form && ! empty( $form ) ) {
			gravity_form( $form, $form_title, $form_description, $display_inactive = false, $field_values = null, $form_ajax, '', $echo = true );
		}
	}

}
