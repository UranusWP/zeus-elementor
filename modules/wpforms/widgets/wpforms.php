<?php
namespace ZeusElementor\Modules\WPForms\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class WPForms extends Widget_Base {

	public function get_name() {
		return 'zeus-wpforms';
	}

	public function get_title() {
		return __( 'WPForms', 'zeus-elementor' );
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
			'wpforms',
			'zeus',
		];
	}

	protected function register_controls() {

		// Return if not activated
		if ( ! is_wpforms_active() ) {

			$this->start_controls_section( 'warning', [
				'label'             => __( 'Warning!', 'zeus-elementor' ),
			] );

			$this->add_control( 'warning_text', [
				'type'              => Controls_Manager::RAW_HTML,
				'raw'               => __( '<strong>WPForms</strong> is not installed or activated on your site. Please install and activate it first to be able to use this widget.', 'zeus-elementor' ),
			] );

			$this->end_controls_section();

		} else {

			$this->start_controls_section(
				'section_wpforms',
				[
					'label'         => __( 'Form', 'zeus-elementor' ),
				]
			);

			$this->add_control(
				'select_form',
				[
					'label'         => __( 'Select Form', 'zeus-elementor' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => '0',
					'options'       => $this->get_available_forms(),
				]
			);

			$this->add_control(
				'display_form_name',
				[
					'label'        => esc_html__( 'Display Form Name', 'zeus-elementor' ),
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'condition'    => [
						'select_form!' => '0',
					],
				]
			);

			$this->add_control(
				'display_form_description',
				[
					'label'        => esc_html__( 'Display Form Description', 'zeus-elementor' ),
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'condition'    => [
						'select_form!' => '0',
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
						'{{WRAPPER}} .wpforms-field label' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'labels_typo',
					'selector'      => '{{WRAPPER}} .wpforms-field label',
				]
			);

			$this->add_responsive_control(
				'labels_margin',
				[
					'label'         => __( 'Margin', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em' ],
					'selectors'     => [
						'{{WRAPPER}} .wpforms-field label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .wpforms-form .wpforms-field-description' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'description_typo',
					'selector'      => '{{WRAPPER}} .wpforms-form .wpforms-field-description',
				]
			);

			$this->add_responsive_control(
				'description_margin',
				[
					'label'         => __( 'Margin', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em' ],
					'selectors'     => [
						'{{WRAPPER}} .wpforms-form .wpforms-field-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'selector'      => '{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .wpforms-field textarea, {{WRAPPER}} .wpforms-field select',
				]
			);

			$this->add_control(
				'inputs_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .wpforms-field textarea, {{WRAPPER}} .wpforms-field select' => 'color: {{VALUE}};',
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
					'selector'      => '{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):hover, {{WRAPPER}} .wpforms-field textarea:hover, {{WRAPPER}} .wpforms-field select:hover',
				]
			);

			$this->add_control(
				'inputs_hover_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):hover, {{WRAPPER}} .wpforms-field textarea:hover, {{WRAPPER}} .wpforms-field select:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'inputs_hover_border_color',
				[
					'label'         => __( 'Border Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):hover, {{WRAPPER}} .wpforms-field textarea:hover, {{WRAPPER}} .wpforms-field select:hover' => 'border-color: {{VALUE}};',
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
					'selector'      => '{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}} .wpforms-field textarea:focus, {{WRAPPER}} .wpforms-field select:focus',
				]
			);

			$this->add_control(
				'inputs_focus_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}} .wpforms-field textarea:focus, {{WRAPPER}} .wpforms-field select:focus' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'inputs_focus_border_color',
				[
					'label'         => __( 'Border Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}} .wpforms-field textarea:focus, {{WRAPPER}} .wpforms-field select:focus' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'inputs_typo',
					'selector'      => '{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .wpforms-field textarea, {{WRAPPER}} .wpforms-field select',
					'separator'     => 'before',
				]
			);

			$this->add_control(
				'inputs_placeholder_color',
				[
					'label'         => __( 'Placeholder Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .wpforms-field input::-webkit-input-placeholder' => 'color: {{VALUE}}',
						'{{WRAPPER}} .wpforms-field input::-moz-placeholder'          => 'color: {{VALUE}}',
						'{{WRAPPER}} .wpforms-field input:-ms-input-placeholder'      => 'color: {{VALUE}}',
						'{{WRAPPER}} .wpforms-field textarea::-webkit-input-placeholder' => 'color: {{VALUE}}',
						'{{WRAPPER}} .wpforms-field textarea::-moz-placeholder'          => 'color: {{VALUE}}',
						'{{WRAPPER}} .wpforms-field textarea:-ms-input-placeholder'      => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'inputs_border',
					'selector'      => '{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .wpforms-field textarea, {{WRAPPER}} .wpforms-field select',
				]
			);

			$this->add_control(
				'inputs_border_radius',
				[
					'label'         => __( 'Border Radius', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .wpforms-field textarea, {{WRAPPER}} .wpforms-field select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'inputs_box_shadow',
					'selector'      => '{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .wpforms-field textarea, {{WRAPPER}} .wpforms-field select',
				]
			);

			$this->add_responsive_control(
				'inputs_padding',
				[
					'label'         => __( 'Padding', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .wpforms-field textarea, {{WRAPPER}} .wpforms-field select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};height: auto;',
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
						'{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .wpforms-field textarea, {{WRAPPER}} .wpforms-field select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'wpforms_invalid_inputs_border_color',
				[
					'label'         => __( 'Input Border Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .wpforms-form .wpforms-field input.wpforms-error, {{WRAPPER}} .wpforms-form .wpforms-field textarea.wpforms-error, {{WRAPPER}} .wpforms-form .wpforms-field select.wpforms-error' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'invalid_inputs_border',
					'selector'      => '{{WRAPPER}} .wpforms-form .wpforms-field input.wpforms-error, {{WRAPPER}} .wpforms-form .wpforms-field textarea.wpforms-error, {{WRAPPER}} .wpforms-form .wpforms-field select.wpforms-error',
				]
			);

			$this->add_control(
				'invalid_inputs_color',
				[
					'label'         => __( 'Text Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .wpforms-form label.wpforms-error' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'invalid_inputs_typo',
					'selector'      => '{{WRAPPER}} .wpforms-form label.wpforms-error',
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
					'selector'      => '{{WRAPPER}} .wpforms-submit-container .wpforms-submit',
				]
			);

			$this->add_control(
				'button_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .wpforms-submit-container .wpforms-submit' => 'color: {{VALUE}};',
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
					'selector'      => '{{WRAPPER}} .wpforms-submit-container .wpforms-submit:hover',
				]
			);

			$this->add_control(
				'button_hover_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .wpforms-submit-container .wpforms-submit:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_hover_border_color',
				[
					'label'         => __( 'Border Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .wpforms-submit-container .wpforms-submit:hover' => 'border-color: {{VALUE}};',
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
					'selector'      => '{{WRAPPER}} .wpforms-submit-container .wpforms-submit:focus',
				]
			);

			$this->add_control(
				'button_focus_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .wpforms-submit-container .wpforms-submit:focus' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_focus_border_color',
				[
					'label'         => __( 'Border Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .wpforms-submit-container .wpforms-submit:focus' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'button_typo',
					'selector'      => '{{WRAPPER}} .wpforms-submit-container .wpforms-submit',
					'separator'     => 'before',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'button_border',
					'selector'      => '{{WRAPPER}} .wpforms-submit-container .wpforms-submit',
				]
			);

			$this->add_control(
				'button_border_radius',
				[
					'label'         => __( 'Border Radius', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .wpforms-submit-container .wpforms-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'button_box_shadow',
					'selector'      => '{{WRAPPER}} .wpforms-submit-container .wpforms-submit',
				]
			);

			$this->add_responsive_control(
				'button_padding',
				[
					'label'         => __( 'Padding', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .wpforms-submit-container .wpforms-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .wpforms-submit-container .wpforms-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .wpforms-submit-container .wpforms-submit' => 'display: {{VALUE}}; width: 100%;',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_success_message_style',
				[
					'label'         => __( 'Success Message', 'zeus-elementor' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'sent_typo',
					'selector'      => '{{WRAPPER}} .wpforms-confirmation-container-full',
				]
			);

			$this->add_control(
				'sent_background_color',
				[
					'label'         => __( 'Background Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .wpforms-confirmation-container-full' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'sent_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .wpforms-confirmation-container-full' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'sent_border',
					'selector'      => '{{WRAPPER}} .wpforms-confirmation-container-full',
				]
			);

			$this->add_control(
				'sent_border_radius',
				[
					'label'         => __( 'Border Radius', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .wpforms-confirmation-container-full' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'sent_padding',
				[
					'label'         => __( 'Padding', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .wpforms-confirmation-container-full' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

		}

	}

	protected function get_available_forms() {

		// Return if not activated
		if ( ! is_wpforms_active() ) {
			return;
		}

		$args = array(
			'post_type'         => 'wpforms',
			'posts_per_page'    => -1,
		);

		$forms = get_posts( $args );

		$result = array( __( '-- Select --', 'zeus-elementor' ) );

		if ( ! empty( $forms ) && ! is_wp_error( $forms ) ) {
			foreach ( $forms as $form ) {
				$result[ $form->ID ] = $form->post_title;
			}
		}

		return $result;
	}

	protected function render() {
		$form = $this->get_settings_for_display( 'select_form' );

		if ( '0' !== $form && ! empty( $form ) ) {
			// Render selected form.
			echo do_shortcode( $this->render_shortcode() );
		}
	}

	public function render_shortcode() {

		return sprintf(
			'[wpforms id="%1$d" title="%2$s" description="%3$s"]',
			absint( $this->get_settings_for_display( 'select_form' ) ),
			sanitize_key( $this->get_settings_for_display( 'display_form_name' ) === 'yes' ? 'true' : 'false' ),
			sanitize_key( $this->get_settings_for_display( 'display_form_description' ) === 'yes' ? 'true' : 'false' )
		);
	}

}
