<?php
namespace ZeusElementor\Modules\ContentProtection\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Widget_Base;

class ContentProtection extends Widget_Base {

	public function get_name() {
		return 'zeus-content-protection';
	}

	public function get_title() {
		return __( 'Content Protection', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-lock';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'lock content',
			'protected content',
			'protected',
			'protection',
			'content protection',
			'zeus',
		];
	}

	public function get_style_depends() {
		return [ 'zeus-content-protection' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label'         => __( 'Content', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'content_type',
			[
				'label'         => __( 'Content Type', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'content'  => __( 'Content', 'zeus-elementor' ),
					'template' => __( 'Saved Templates', 'zeus-elementor' ),
				],
				'default'       => 'content',
			]
		);

		$this->add_control(
			'content_field',
			[
				'label'         => __( 'Protected Content', 'zeus-elementor' ),
				'description'   => __( 'This is the content that you want to be protected by either role or password.', 'zeus-elementor' ),
				'type'          => Controls_Manager::WYSIWYG,
				'label_block'   => true,
				'dynamic'       => [
					'active' => true,
				],
				'condition'     => [
					'content_type' => 'content',
				],
			]
		);

		$this->add_control(
			'content_template',
			[
				'label'         => __( 'Choose Template', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => $this->get_templates(),
				'condition'     => [
					'content_type' => 'template',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_type',
			[
				'label'         => __( 'Protection Type', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'type',
			[
				'label'       => __( 'Protection Type', 'zeus-elementor' ),
				'label_block' => false,
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'role'     => __( 'User role', 'zeus-elementor' ),
					'password' => __( 'Password protected', 'zeus-elementor' ),
				],
				'default'     => 'role',
			]
		);

		$this->add_control(
			'role',
			[
				'label'       => __( 'Select Roles', 'zeus-elementor' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => $this->user_roles(),
				'condition'   => [
					'type' => 'role',
				],
			]
		);

		$this->add_control(
			'password',
			[
				'label'      => __( 'Set Password', 'zeus-elementor' ),
				'type'       => Controls_Manager::TEXT,
				'input_type' => 'password',
				'condition'  => [
					'type' => 'password',
				],
			]
		);

		$this->add_control(
			'password_placeholder',
			[
				'label'     => __( 'Input Placeholder', 'zeus-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => [ 'active' => true ],
				'default'   => 'Enter Password',
				'condition' => [
					'type' => 'password',
				],
			]
		);

		$this->add_control(
			'password_submit_btn_txt',
			[
				'label'     => __( 'Submit Button Text', 'zeus-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => [ 'active' => true ],
				'default'   => __( 'Submit', 'zeus-elementor' ),
				'condition' => [
					'type' => 'password',
				],
			]
		);

		$this->add_control(
			'cookie',
			[
				'label'         => __( 'Remember Cookie', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'return_value'  => 'yes',
				'condition'    => [
					'type' => 'password',
				],
			]
		);

		$this->add_control(
			'cookie_expire_time',
			[
				'label'       => __( 'Expire Time', 'zeus-elementor' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 60,
				'min'         => 10,
				'description' => __( 'Cookie expiration time (Minutes)', 'zeus-elementor' ),
				'condition'   => [
					'type' => 'password',
					'cookie' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_icon',
			[
				'label'         => __( 'Show Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'return_value'  => 'yes',
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label'         => __( 'Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'       => [
					'value'     => 'fas fa-lock',
					'library'   => 'fa-solid',
				],
				'condition'     => [
					'show_icon' => 'yes',
				],
			]
		);

		$this->add_control(
			'message_type',
			[
				'label'       => __( 'Message Type', 'zeus-elementor' ),
				'label_block' => false,
				'type'        => Controls_Manager::SELECT,
				'description' => __( 'Set a message or a saved template when the content is protected.', 'zeus-elementor' ),
				'options'     => [
					'none'     => __( 'None', 'zeus-elementor' ),
					'text'     => __( 'Message', 'zeus-elementor' ),
					'template' => __( 'Saved Templates', 'zeus-elementor' ),
				],
				'default'     => 'text',
			]
		);

		$this->add_control(
			'message_text',
			[
				'label'     => __( 'Public Text', 'zeus-elementor' ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => __( 'Protected Content', 'zeus-elementor' ),
				'dynamic'   => [
					'active' => true,
				],
				'condition' => [
					'message_type' => 'text',
				],
			]
		);

		$this->add_control(
			'message_template',
			[
				'label'     => __( 'Choose Template', 'zeus-elementor' ),
				'type'      => Controls_Manager::SELECT2,
				'label_block' => true,
				'default'   => '0',
				'options'   => $this->get_templates(),
				'condition'   => [
					'message_type' => 'template',
				],
			]
		);

		$this->add_control(
			'password_incorrect_heading',
			[
				'label' => __( 'Incorrect Password', 'zeus-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'password_incorrect_message',
			[
				'label' => __( 'Message', 'zeus-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Password does not match', 'zeus-elementor' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'         => __( 'General', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'       => __( 'Alignment', 'zeus-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => [
					'left' => [
						'title' => __( 'Left', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'     => [
						'title' => __( 'Center', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'prefix_class'  => 'zeus-cp-align-',
			]
		);

		$this->add_control(
			'background',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-cp' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'border',
				'label'         => __( 'Border', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-cp',
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cp' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cp' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cp' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-cp',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label'         => __( 'Icon', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_spacing',
			[
				'label'         => __( 'Spacing', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cp-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'show_icon' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label'         => __( 'Icon Size', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cp-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'show_icon' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_padding',
			[
				'label'         => __( 'Icon Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cp-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'show_icon' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-cp-icon' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'show_icon' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-cp-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .zeus-cp-icon svg' => 'fill: {{VALUE}};',
				],
				'condition'     => [
					'show_icon' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'icon_border',
				'label'         => __( 'Border', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-cp-icon',
				'condition'     => [
					'show_icon' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cp-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'show_icon' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_message',
			[
				'label'         => __( 'Permission Message', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'message_text_color',
			[
				'label'     => __( 'Text Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zeus-cp-message' => 'color: {{VALUE}};',
				],
				'condition' => [
					'message_type' => 'text',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'message_text_typography',
				'selector'  => '{{WRAPPER}} .zeus-cp-message',
				'condition' => [
					'message_type' => 'text',
				],
			]
		);

		$this->add_responsive_control(
			'message_text_alignment',
			[
				'label'       => __( 'Text Alignment', 'zeus-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options'     => [
					'left'   => [
						'title' => __( 'Left', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .zeus-cp-message' => 'text-align: {{VALUE}};',
				],
				'condition'   => [
					'message_type' => 'text',
				],
			]
		);

		$this->add_responsive_control(
			'message_text_padding',
			[
				'label'      => __( 'Padding', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .zeus-cp-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'message_type' => 'text',
				],
			]
		);

		$this->add_control(
			'error_message',
			[
				'label'     => __( 'Error Message', 'zeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'error_message_text_color',
			[
				'label'     => __( 'Text Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zeus-cp-error-msg' => 'color: {{VALUE}};',
				],
				'condition' => [
					'message_type' => 'text',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'error_message_text_typography',
				'selector'  => '{{WRAPPER}} .zeus-cp-error-msg',
				'condition' => [
					'message_type' => 'text',
				],
			]
		);

		$this->add_responsive_control(
			'error_message_text_alignment',
			[
				'label'     => __( 'Text Alignment', 'zeus-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options'   => [
					'left' => [
						'title' => __( 'Left', 'zeus-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'zeus-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'zeus-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .zeus-cp-error-msg' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'message_type' => 'text',
				],
			]
		);

		$this->add_responsive_control(
			'error_message_text_padding',
			[
				'label'     => __( 'Padding', 'zeus-elementor' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .zeus-cp-error-msg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'message_type' => 'text',
				],
				'separator' => 'after',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_input',
			[
				'label'         => __( 'Password Field', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' => 'password',
				],
			]
		);

		$this->add_responsive_control(
			'input_width',
			array(
				'label'      => __( 'Input Width', 'zeus-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => '%',
					'size' => 100,
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-cp-form input.zeus-password' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition' => [
					'type' => 'password',
				],
			)
		);

		$this->add_responsive_control(
			'password_input_padding',
			[
				'label'      => __( 'Padding', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .zeus-cp-form input.zeus-password' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'type' => 'password',
				],
			]
		);

		$this->add_responsive_control(
			'password_input_margin',
			[
				'label'      => __( 'Margin', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .zeus-cp-form input.zeus-password' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'type' => 'password',
				],
			]
		);

		$this->add_control(
			'input_border_radius',
			[
				'label'     => __( 'Border Radius', 'zeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .zeus-cp-form input.zeus-password' => 'border-radius: {{SIZE}}px;',
				],
				'condition' => [
					'type' => 'password',
				],
			]
		);

		$this->add_control(
			'password_input_color',
			[
				'label'     => __( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zeus-cp-form input.zeus-password' => 'color: {{VALUE}};',
				],
				'condition' => [
					'type' => 'password',
				],
			]
		);

		$this->add_control(
			'password_input_bg_color',
			[
				'label'     => __( 'Background Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zeus-cp-form input.zeus-password' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'type' => 'password',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'password_input_border',
				'label'     => __( 'Border', 'zeus-elementor' ),
				'selector'  => '{{WRAPPER}} .zeus-cp-form .zeus-password',
				'condition' => [
					'type' => 'password',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'password_input_shadow',
				'selector'  => '{{WRAPPER}} .zeus-cp-form .zeus-password',
				'condition' => [
					'type' => 'password',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[
				'label'         => __( 'Submit Button', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' => 'password',
				],
			]
		);

		$this->start_controls_tabs( 'button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'button_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-cp-form .zeus-submit' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-cp-form .zeus-submit' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'button_hover_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-cp-form .zeus-submit:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-cp-form .zeus-submit:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_hover_color',
			[
				'label'         => __( 'Border Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-cp-form .zeus-submit:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'submit_button_border',
				'selector'  => '{{WRAPPER}} .zeus-cp-form .zeus-submit',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'submit_button_box_shadow',
				'selector'  => '{{WRAPPER}} .zeus-cp-form .zeus-submit',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Get all registered user roles.
	 *
	 * @return array of user roles.
	 */
	public static function user_roles() {
		global $wp_roles;

		$all = $wp_roles->roles;
		$all_roles = array();

		if ( ! empty( $all ) ) {
			foreach ( $all as $key => $value ) {
				$all_roles[ $key ] = $all[ $key ]['name'];
			}
		}

		return $all_roles;
	}

	/**
	 * Get all Elementor templates.
	 *
	 * @return array of templates.
	 */
	public static function get_templates() {
		$templates      = array( '&mdash; ' . esc_html__( 'Select', 'zeus-elementor' ) . ' &mdash;' );
		$get_templates  = get_posts(
			array(
				'post_type' => 'elementor_library',
				'numberposts' => -1,
				'post_status' => 'publish',
			)
		);

		if ( ! empty( $get_templates ) ) {
			foreach ( $get_templates as $template ) {
				$templates[ $template->ID ] = $template->post_title;
			}
		}

		return $templates;
	}

	/**
	 * Check current user role exists inside of the roles array.
	 */
	protected function current_user_privileges( $settings ) {
		if ( ! is_user_logged_in() ) {
			return;
		}

		$user_role = wp_get_current_user()->roles;
		return ! empty( array_intersect( $user_role, (array) $settings['role'] ) );
	}

	protected function zeus_render_message( $settings ) {
		ob_start(); ?>
		<div class="zeus-cp-message">
			<?php
			if ( 'text' === $settings['message_type'] ) { ?>
				<div class="zeus-cp-message-text"><?php $this->print_unescaped_setting( 'message_text' ); ?></div>
				<?php
			} elseif ( 'template' === $settings['message_type'] ) {
				if ( ! empty( $settings['message_template'] ) ) {
					echo Plugin::$instance->frontend->get_builder_content( $settings['message_template'], true ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			} ?>
		</div>
		<?php
		echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	protected function zeus_render_content( $settings ) {
		$editor_content = $this->get_settings_for_display( 'content_field' );
		ob_start(); ?>
		<div id="zeus-cp-render-<?php echo esc_attr( $this->get_id() ); ?>" class="zeus-content-protection">
			<?php
			if ( 'content' === $settings['content_type'] ) {
				?>
				<p><?php $this->parse_text_editor( $editor_content ); ?></p>
				<?php
			} elseif ( 'template' === $settings['content_type'] ) {
				if ( ! empty( $settings['content_template'] ) ) {
					echo Plugin::$instance->frontend->get_builder_content( $settings['content_template'], true ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
			?>
		</div>
		<?php
		return ob_get_clean();
	}

	protected function render() {
		$widget_id = $this->get_id();
		$settings  = $this->get_settings_for_display();

		if ( 'role' === $settings['type'] ) {
			if ( $this->current_user_privileges( $settings ) === true ) {
				echo $this->zeus_render_content( $settings ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} else { ?>
				<div class="zeus-cp">
					<?php
					if ( 'yes' === $settings['show_icon']
						&& ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon'] ) ) ) {
						$migrated   = isset( $settings['__fa4_migrated']['selected_icon'] );
						$is_new     = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed(); ?>

						<div class="zeus-cp-icon">
							<?php
							if ( $is_new || $migrated ) {
								Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
							} else { ?>
								<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
								<?php
							} ?>
						</div>
						<?php
					} ?>

					<?php $this->zeus_render_message( $settings ); ?>
				</div>
				<?php
			}
		} else {

			if ( ! empty( $settings['password'] ) ) {
				$unlocked = false;

				if ( isset( $_POST[ 'password_' . esc_attr( $widget_id ) ] ) ) {
					if ( ( $settings['password'] === $_POST[ 'password_' . esc_attr( $widget_id ) ] ) && wp_verify_nonce( $_POST[ 'nonce_' . esc_attr( $widget_id ) ], 'zeus_protected_nonce' ) ) {
						$unlocked = true;
						$this->remember_cookie( $settings );
					}
				}

				if ( isset( $_COOKIE[ 'password_' . esc_attr( $widget_id ) ] ) || $unlocked ) {
					echo $this->zeus_render_content( $settings ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					$this->scroll();
				} else { ?>
					<div class="zeus-cp">
						<?php
						if ( 'yes' === $settings['show_icon']
							&& ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon'] ) ) ) {
							$migrated   = isset( $settings['__fa4_migrated']['selected_icon'] );
							$is_new     = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed(); ?>

							<div class="zeus-cp-icon">
								<?php
								if ( $is_new || $migrated ) {
									Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
								} else { ?>
									<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
									<?php
								} ?>
							</div>
							<?php
						} ?>

						<?php $this->zeus_render_message( $settings ); ?>

						<div class="zeus-cp-form">
							<form method="post">
								<input type="password" name="password_<?php echo esc_attr( $widget_id ); ?>" class="zeus-password" placeholder="<?php $this->print_unescaped_setting( 'password_placeholder' ); ?>">
								<input type="hidden" name="nonce_<?php echo esc_attr( $widget_id ); ?>" value="<?php echo esc_attr( wp_create_nonce( 'zeus_protected_nonce' ) ); ?>" >
								<input type="submit" value="<?php $this->print_unescaped_setting( 'password_submit_btn_txt' ); ?>" class="zeus-submit">
							</form>

							<?php
							if ( isset( $_POST[ 'password_' . $widget_id ] ) ) {
								if ( $settings[ 'password' ] !== $_POST['password_' . esc_attr( $widget_id )] ) { ?>
									<p class="zeus-cp-error-msg"><?php $this->print_unescaped_setting( 'password_incorrect_message' ); ?></p>
									<?php
								}
							} ?>

						</div>

					</div>
					<?php
				}
			}
		}
	}

	/**
	 * remember_cookie
	 */
	public function remember_cookie() {
		if ( ! isset( $_POST[ 'password_' . esc_attr( $this->get_id() ) ] ) ) {
			return false;
		}
		$remember_cookie = $this->get_settings( 'cookie' );
		if ( 'yes' === $remember_cookie ) {
			$expire_time = (int) $this->get_settings( 'cookie_expire_time' ) * 60 * 1000;
			echo '<script>
				var expires = new Date();
				var expires_time = expires.getTime() + parseInt(' . esc_attr( $expire_time ) . ');
				expires.setTime(expires_time);
				document.cookie = "password_{' . esc_attr( $this->get_id() ) . '} = true;expires=" + expires.toUTCString();
			</script>';
		}
	}

	/**
	 * Scroll down exact location
	 */
	public function scroll() {
		if ( isset( $_POST[ 'password_' . esc_attr( $this->get_id() ) ] ) ) {
			ob_start();
			$form_id = 'elementor-element-' . esc_attr( $this->get_id() ); ?>
			<script>
				jQuery(document).ready(function ($) {
					var id = ".<?php echo esc_attr( $form_id ); ?>";
					$('html, body').animate({scrollTop: $(id).offset().top}, 2000);
				});
			</script>
			<?php
			return ob_get_clean();
		}
		return false;
	}

}
