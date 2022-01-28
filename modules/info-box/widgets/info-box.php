<?php
namespace ZeusElementor\Modules\InfoBox\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
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
		return esc_html__('Info Box', 'zeus-elementor' );
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
				'label'         => esc_html__('General', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'type',
			[
				'label'         => esc_html__('Type', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'icon',
				'options'       => [
					'none'      => esc_html__('None', 'zeus-elementor' ),
					'icon'      => esc_html__('Icon', 'zeus-elementor' ),
					'text'      => esc_html__('Text', 'zeus-elementor' ),
					'img'      	=> esc_html__('Image', 'zeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label'         => esc_html__('Icon', 'zeus-elementor' ),
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
				'label'         => esc_html__('Text', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => '1',
				'condition'     => [
					'type' => 'text',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'image',
			[
				'label' 		=> esc_html__('Choose Image', 'elementor' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' => true,
				],
				'condition'     => [
					'type' => 'img',
				],
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_responsive_control(
			'position',
			[
				'label'         => esc_html__('Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'default'       => 'top',
				'options'       => [
					'left' => [
						'title'   => esc_html__('Left', 'zeus-elementor' ),
						'icon'    => 'eicon-text-align-left',
					],
					'top' => [
						'title'   => esc_html__('Top', 'zeus-elementor' ),
						'icon'    => 'eicon-text-align-center',
					],
					'right' => [
						'title'   => esc_html__('Right', 'zeus-elementor' ),
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
				'label'         => esc_html__('Content Alignment', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left'    => [
						'title' => esc_html__('Left', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'       => 'center',
				'prefix_class'  => 'zeus-info-box-align%s-',
				'selectors'     => [
					'(desktop){{WRAPPER}} .zeus-info-box' => '-webkit-justify-content: {{VALUE}}; justify-content: {{VALUE}};',
					'(desktop){{WRAPPER}} .zeus-info-box' => '-webkit-justify-content: {{VALUE}}; justify-content: {{VALUE}};',
					'(tablet){{WRAPPER}} .zeus-info-box' => '-webkit-justify-content: {{VALUE}}; justify-content: {{VALUE}};',
					'(tablet){{WRAPPER}} .zeus-info-box' => '-webkit-justify-content: {{VALUE}}; justify-content: {{VALUE}};',
					'(mobile){{WRAPPER}} .zeus-info-box' => '-webkit-justify-content: {{VALUE}}; justify-content: {{VALUE}};',
					'(mobile){{WRAPPER}} .zeus-info-box' => '-webkit-justify-content: {{VALUE}}; justify-content: {{VALUE}};',
				],
				'selectors_dictionary' => [
					'left'        => 'flex-start',
					'center'      => 'center',
					'right'       => 'flex-end',
				],
			]
		);

		$this->add_responsive_control(
			'vertical_position',
			[
				'label'         => esc_html__('Vertical Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'default'       => 'top',
				'options'       => [
					'top' => [
						'title'   => esc_html__('Top', 'zeus-elementor' ),
						'icon'    => 'eicon-v-align-top',
					],
					'middle' => [
						'title'   => esc_html__('Middle', 'zeus-elementor' ),
						'icon'    => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title'   => esc_html__('Bottom', 'zeus-elementor' ),
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
				'label'         => esc_html__('Content', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'         => esc_html__('Title', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => esc_html__('This is the heading', 'zeus-elementor' ),
				'label_block'   => true,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'description',
			[
				'label'         => esc_html__('Description', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'zeus-elementor' ),
				'placeholder'   => esc_html__('Enter your description', 'zeus-elementor' ),
				'rows'          => 10,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'title_divider',
			[
				'label'         => esc_html__('Title Separator', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'no',
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'         => esc_html__('Title Tag', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'h3',
				'options'       => [
					'h1'     => esc_html__('H1', 'zeus-elementor' ),
					'h2'     => esc_html__('H2', 'zeus-elementor' ),
					'h3'     => esc_html__('H3', 'zeus-elementor' ),
					'h4'     => esc_html__('H4', 'zeus-elementor' ),
					'h5'     => esc_html__('H5', 'zeus-elementor' ),
					'h6'     => esc_html__('H6', 'zeus-elementor' ),
					'div'    => esc_html__('div', 'zeus-elementor' ),
					'span'   => esc_html__('span', 'zeus-elementor' ),
					'p'      => esc_html__('p', 'zeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'link_heading',
			[
				'label'         => esc_html__('Link', 'zeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'link_type',
			[
				'label'         => esc_html__('Link Type', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'none',
				'options'       => [
					'none'    => esc_html__('None', 'zeus-elementor' ),
					'box'     => esc_html__('Box', 'zeus-elementor' ),
					'title'   => esc_html__('Title', 'zeus-elementor' ),
					'button'  => esc_html__('Button', 'zeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'button_size',
			[
				'label'         => esc_html__('Size', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'md',
				'options'       => [
					'xs' => esc_html__('Extra Small', 'zeus-elementor' ),
					'sm' => esc_html__('Small', 'zeus-elementor' ),
					'md' => esc_html__('Medium', 'zeus-elementor' ),
					'lg' => esc_html__('Large', 'zeus-elementor' ),
					'xl' => esc_html__('Extra Large', 'zeus-elementor' ),
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
				'label'         => esc_html__('Link', 'zeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__('https://your-link.com', 'zeus-elementor' ),
				'condition'     => [
					'link_type!'   => 'none',
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'         => esc_html__('Button Text', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => esc_html__('Learn More', 'zeus-elementor' ),
				'condition'     => [
					'link_type' => 'button',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label'         => esc_html__('Button Icon', 'zeus-elementor' ),
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
				'label'         => esc_html__('Icon Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'left',
				'options'       => [
					'left'     => esc_html__('Before', 'zeus-elementor' ),
					'right'    => esc_html__('After', 'zeus-elementor' ),
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
				'label'         => esc_html__('Icon Spacing', 'zeus-elementor' ),
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
				'label'         => esc_html__('Button Icon Size', 'zeus-elementor' ),
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
				'label'         => esc_html__('Info Box', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_info_box' );

		$this->start_controls_tab(
			'tab_info_box_normal',
			[
				'label'         => esc_html__('Normal', 'zeus-elementor' ),
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
				'label'         => esc_html__('Border Radius', 'zeus-elementor' ),
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
				'label'         => esc_html__('Hover', 'zeus-elementor' ),
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
				'label'         => esc_html__('Border Radius', 'zeus-elementor' ),
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
				'label'         => esc_html__('Animation', 'zeus-elementor' ),
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
				'label'         => esc_html__('Padding', 'zeus-elementor' ),
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
				'label'         => esc_html__('Icon Style', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'type!' => 'none',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'         => esc_html__('Icon Size', 'zeus-elementor' ),
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
				'label'         => esc_html__('Typography', 'zeus-elementor' ),
				'condition'     => [
					'type' => 'text',
				],
				'selector'      => '{{WRAPPER}} .zeus-info-box-icon',
			]
		);

		$this->add_responsive_control(
			'img_size',
			[
				'label'         => esc_html__('Image Size', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min'   => 5,
						'max'   => 500,
						'step'  => 1,
					],
				],
				'size_units'    => [ 'px' ],
				'condition'     => [
					'type' => 'img',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box img' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label'         => esc_html__('Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'icon_background',
			[
				'label'         => esc_html__('Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-icon' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'         => esc_html__('Icon Color', 'zeus-elementor' ),
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
				'label'         => esc_html__('Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'icon_background_hover',
			[
				'label'         => esc_html__('Background Color', 'zeus-elementor' ),
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
				'label'         => esc_html__('Icon Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-info-box-icon:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_border_color_hover',
			[
				'label'         => esc_html__('Border Color', 'zeus-elementor' ),
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
				'label'         => esc_html__('Icon Animation', 'zeus-elementor' ),
				'type'          => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'icon_border',
				'label'         => esc_html__('Border', 'zeus-elementor' ),
				'condition'     => [
					'type!' => 'none',
				],
				'selector'      => '{{WRAPPER}} .zeus-info-box-icon',
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label'         => esc_html__('Border Radius', 'zeus-elementor' ),
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
				'label'         => esc_html__('Icon Rotation', 'zeus-elementor' ),
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
				'label'         => esc_html__('Padding', 'zeus-elementor' ),
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
				'label'         => esc_html__('Margin', 'zeus-elementor' ),
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
				'label'         => esc_html__('Title & Description', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'         => esc_html__('Color', 'zeus-elementor' ),
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
				'label'         => esc_html__('Typography', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-info-box-title',
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label'         => esc_html__('Margin Bottom', 'zeus-elementor' ),
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
				'label'         => esc_html__('Description', 'zeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'         => esc_html__('Color', 'zeus-elementor' ),
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
				'label'         => esc_html__('Typography', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-info-box-description',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_divider_style',
			[
				'label'         => esc_html__('Title Separator', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'title_divider' => 'yes',
				],
			]
		);

		$this->add_control(
			'divider_title_border_type',
			[
				'label'         => esc_html__('Border Type', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'solid',
				'options'       => [
					'none'      => esc_html__('None', 'zeus-elementor' ),
					'solid'     => esc_html__('Solid', 'zeus-elementor' ),
					'double'    => esc_html__('Double', 'zeus-elementor' ),
					'dotted'    => esc_html__('Dotted', 'zeus-elementor' ),
					'dashed'    => esc_html__('Dashed', 'zeus-elementor' ),
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
				'label'         => esc_html__('Border Width', 'zeus-elementor' ),
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
				'label'         => esc_html__('Border Height', 'zeus-elementor' ),
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
				'label'         => esc_html__('Border Color', 'zeus-elementor' ),
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
				'label'         => esc_html__('Alignment', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'flex-start' => [
						'title' => esc_html__('Left', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'    => [
						'title' => esc_html__('Center', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'  => [
						'title' => esc_html__('Right', 'zeus-elementor' ),
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
				'label'         => esc_html__('Margin Bottom', 'zeus-elementor' ),
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
				'label'         => esc_html__('Button', 'zeus-elementor' ),
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
				'label'         => esc_html__('Normal', 'zeus-elementor' ),
				'condition'     => [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_background',
			[
				'label'         => esc_html__('Background Color', 'zeus-elementor' ),
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
				'label'         => esc_html__('Text Color', 'zeus-elementor' ),
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
				'label'         => esc_html__('Hover', 'zeus-elementor' ),
				'condition'     => [
					'link_type'    => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_hover_background',
			[
				'label'         => esc_html__('Background Color', 'zeus-elementor' ),
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
				'label'         => esc_html__('Text Color', 'zeus-elementor' ),
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
				'label'         => esc_html__('Border Color', 'zeus-elementor' ),
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
				'label'         => esc_html__('Animation', 'zeus-elementor' ),
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
				'label'         => esc_html__('Border', 'zeus-elementor' ),
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
				'label'         => esc_html__('Border Radius', 'zeus-elementor' ),
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
				'label'         => esc_html__('Typography', 'zeus-elementor' ),
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
				'label'         => esc_html__('Padding', 'zeus-elementor' ),
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
				'label'         => esc_html__('Margin Top', 'zeus-elementor' ),
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
							} elseif ( 'img' === $settings['type'] && ! empty( $settings['image']['url'] ) ) {
								echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'image' ) );
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
			buttoniconHTML = elementor.helpers.renderIcon( view, settings.button_icon, { 'aria-hidden': true }, 'i' , 'object' ),
			image = {
				id: settings.image.id,
				url: settings.image.url,
				size: settings.image_size,
				dimension: settings.image_custom_dimension,
				model: view.getEditModel()
			};

		var imageUrl = elementor.imagesManager.getImageUrl( image ); #>

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
							<# } else if ( 'img' == settings.type ) { #>
								<# if ( imageUrl ) { #>
									<img src="{{ imageUrl }}">
								<# } #>
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
