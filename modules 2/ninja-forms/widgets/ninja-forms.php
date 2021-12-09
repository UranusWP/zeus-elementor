<?php
namespace ZeusElementor\Modules\NinjaForms\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Ninja_Forms extends Widget_Base {

	public function get_name() {
		return 'zeus-ninja-forms';
	}

	public function get_title() {
		return __( 'Ninja Forms', 'zeus-elementor' );
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
			'ninja',
			'zeus',
		];
	}

	protected function register_controls() {

		// Return if not activated
		if ( ! is_ninja_forms_active() ) {

			$this->start_controls_section( 'warning', [
				'label'             => __( 'Warning!', 'zeus-elementor' ),
			] );

			$this->add_control( 'warning_text', [
				'type'              => Controls_Manager::RAW_HTML,
				'raw'               => __( '<strong>Ninja Forms</strong> is not installed or activated on your site. Please install and activate it first to be able to use this widget.', 'zeus-elementor' ),
			] );

			$this->end_controls_section();

		} else {

			$this->start_controls_section(
				'section_ninja_forms',
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
					'label'         => __( 'Hide Title', 'zeus-elementor' ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => '',
					'return_value'  => 'none',
					'selectors'     => [
						'{{WRAPPER}} .nf-form-title' => 'display: {{VALUE}};',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_style',
				[
					'label'         => __( 'Labels', 'zeus-elementor' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'labels_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .nf-field-label label' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'labels_typo',
					'selector'      => '{{WRAPPER}} .nf-field-label label',
				]
			);

			$this->add_responsive_control(
				'labels_margin',
				[
					'label'         => __( 'Margin', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em' ],
					'selectors'     => [
						'{{WRAPPER}} .nf-field-label label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .nf-field-description' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'description_typo',
					'selector'      => '{{WRAPPER}} .nf-field-description',
				]
			);

			$this->add_responsive_control(
				'description_margin',
				[
					'label'         => __( 'Margin', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em' ],
					'selectors'     => [
						'{{WRAPPER}} .nf-field-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'selector'      => '{{WRAPPER}} .ninja-forms-field:not([type="button"]):not([type="checkbox"]):not([type="radio"])',
				]
			);

			$this->add_control(
				'inputs_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .ninja-forms-field:not([type="button"]):not([type="checkbox"]):not([type="radio"])' => 'color: {{VALUE}};',
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
					'selector'      => '{{WRAPPER}} .ninja-forms-field:not([type="button"]):not([type="checkbox"]):not([type="radio"]):hover',
				]
			);

			$this->add_control(
				'inputs_hover_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .ninja-forms-field:not([type="button"]):not([type="checkbox"]):not([type="radio"]):hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'inputs_hover_border_color',
				[
					'label'         => __( 'Border Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .ninja-forms-field:not([type="button"]):not([type="checkbox"]):not([type="radio"]):hover' => 'border-color: {{VALUE}};',
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
					'selector'      => '{{WRAPPER}} .ninja-forms-field:not([type="button"]):not([type="checkbox"]):not([type="radio"]):focus',
				]
			);

			$this->add_control(
				'inputs_focus_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .ninja-forms-field:not([type="button"]):not([type="checkbox"]):not([type="radio"]):focus' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'inputs_focus_border_color',
				[
					'label'         => __( 'Border Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .ninja-forms-field:not([type="button"]):not([type="checkbox"]):not([type="radio"]):focus' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'inputs_typo',
					'selector'      => '{{WRAPPER}} .ninja-forms-field:not([type="button"]):not([type="checkbox"]):not([type="radio"])',
					'separator'     => 'before',
				]
			);

			$this->add_control(
				'inputs_placeholder_color',
				[
					'label'         => __( 'Placeholder Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .ninja-forms-field::-webkit-input-placeholder' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ninja-forms-field::-moz-placeholder'          => 'color: {{VALUE}}',
						'{{WRAPPER}} .ninja-forms-field:-ms-input-placeholder'      => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'inputs_border',
					'selector'      => '{{WRAPPER}} .ninja-forms-field:not([type="button"]):not([type="checkbox"]):not([type="radio"])',
				]
			);

			$this->add_control(
				'inputs_border_radius',
				[
					'label'         => __( 'Border Radius', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .ninja-forms-field:not([type="button"]):not([type="checkbox"]):not([type="radio"])' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'inputs_box_shadow',
					'selector'      => '{{WRAPPER}} .ninja-forms-field:not([type="button"]):not([type="checkbox"]):not([type="radio"])',
				]
			);

			$this->add_responsive_control(
				'inputs_padding',
				[
					'label'         => __( 'Padding', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .ninja-forms-field:not([type="button"]):not([type="checkbox"]):not([type="radio"])' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ninja-forms-field:not([type="button"]):not([type="checkbox"]):not([type="radio"])' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'invalid_inputs_heading',
				[
					'label'         => __( 'Not Valid Input', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);

			$this->add_control(
				'invalid_inputs_border_color',
				[
					'label'         => __( 'Input Border Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .nf-error .ninja-forms-field:not([type="button"]):not([type="checkbox"]):not([type="radio"])' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'invalid_inputs_color',
				[
					'label'         => __( 'Text Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .nf-error-msg' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'invalid_inputs_typo',
					'selector'      => '{{WRAPPER}} .nf-error-msg',
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
					'selector'      => '{{WRAPPER}} .ninja-forms-field[type="button"]',
				]
			);

			$this->add_control(
				'button_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .ninja-forms-field[type="button"]' => 'color: {{VALUE}};',
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
					'selector'      => '{{WRAPPER}} .ninja-forms-field[type="button"]:hover',
				]
			);

			$this->add_control(
				'button_hover_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .ninja-forms-field[type="button"]:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_hover_border_color',
				[
					'label'         => __( 'Border Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .ninja-forms-field[type="button"]:hover' => 'border-color: {{VALUE}};',
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
					'selector'      => '{{WRAPPER}} .ninja-forms-field[type="button"]:focus',
				]
			);

			$this->add_control(
				'button_focus_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .ninja-forms-field[type="button"]:focus' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_focus_border_color',
				[
					'label'         => __( 'Border Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .ninja-forms-field[type="button"]:focus' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'button_typo',
					'selector'      => '{{WRAPPER}} .ninja-forms-field[type="button"]',
					'separator'     => 'before',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'button_border',
					'selector'      => '{{WRAPPER}} .ninja-forms-field[type="button"]',
				]
			);

			$this->add_control(
				'button_border_radius',
				[
					'label'         => __( 'Border Radius', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .ninja-forms-field[type="button"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'button_box_shadow',
					'selector'      => '{{WRAPPER}} .ninja-forms-field[type="button"]',
				]
			);

			$this->add_responsive_control(
				'button_padding',
				[
					'label'         => __( 'Padding', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .ninja-forms-field[type="button"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ninja-forms-field[type="button"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ninja-forms-field[type="button"]' => 'display: {{VALUE}}; width: 100%;',
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

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'alerts_typo',
					'selector'      => '{{WRAPPER}} .nf-response-msg, {{WRAPPER}} .nf-form-fields-required, {{WRAPPER}} .nf-error-wrap .nf-error-required-error',
				]
			);

			$this->add_control(
				'sent_heading',
				[
					'label'         => __( 'Success Message', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);

			$this->add_control(
				'sent_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .nf-response-msg' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'error_heading',
				[
					'label'         => __( 'Sent Error', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);

			$this->add_control(
				'error_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .wpcf7 div.wpcf7-mail-sent-ng' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'required_alert_heading',
				[
					'label'         => __( 'Required Fields Notice', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);

			$this->add_control(
				'required_alert_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .nf-form-fields-required' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'error_alert_heading',
				[
					'label'         => __( 'Error Messages', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);

			$this->add_control(
				'error_alert_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .nf-error-wrap .nf-error-required-error' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_section();

		}

	}

	protected function get_available_forms() {

		// Return if not activated
		if ( ! is_ninja_forms_active() ) {
			return;
		}

		$forms = \Ninja_Forms()->form()->get_forms();

		$result = array( __( '-- Select --', 'zeus-elementor' ) );

		if ( ! empty( $forms ) && ! is_wp_error( $forms ) ) {
			foreach ( $forms as $form ) {
				$result[ $form->get_id() ] = $form->get_setting( 'title' );
			}
		}

		return $result;
	}

	protected function render() {
		$settings = $this->get_settings();
		$form = $settings['form'];

		if ( '0' !== $form && ! empty( $form ) ) {
			echo do_shortcode( '[ninja_form id="' . $form . '"]' );
		}
	}

}
