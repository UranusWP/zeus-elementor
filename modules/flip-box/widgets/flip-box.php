<?php
namespace ZeusElementor\Modules\FlipBox\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class FlipBox extends Widget_Base {

	public function get_name() {
		return 'zeus-flip-box';
	}

	public function get_title() {
		return __( 'Flip Box', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-file-picture';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'flip box',
			'flip',
			'box',
			'banner',
			'zeus',
		];
	}

	public function get_style_depends() {
		return [ 'zeus-flip-box' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_front',
			[
				'label'         => __( 'Front', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'graphic_element',
			[
				'label'         => __( 'Graphic Element', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'label_block'   => false,
				'options'       => [
					'none' => [
						'title' => __( 'None', 'zeus-elementor' ),
						'icon'  => 'eicon-ban',
					],
					'image' => [
						'title' => __( 'Image', 'zeus-elementor' ),
						'icon'  => 'eicon-image-bold',
					],
					'icon' => [
						'title' => __( 'Icon', 'zeus-elementor' ),
						'icon'  => 'eicon-star',
					],
				],
				'default'       => 'icon',
			]
		);

		$this->add_control(
			'image',
			[
				'label'         => __( 'Choose Image', 'zeus-elementor' ),
				'type'          => Controls_Manager::MEDIA,
				'default'       => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'     => [
					'graphic_element' => 'image',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'          => 'image', // Actually its `image_size`
				'label'         => __( 'Image Size', 'zeus-elementor' ),
				'default'       => 'thumbnail',
				'condition'     => [
					'graphic_element' => 'image',
				],
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label'         => __( 'Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'       => [
					'value'     => 'fas fa-snowflake',
					'library'   => 'fa-solid',
				],
				'condition'     => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_view',
			[
				'label'         => __( 'View', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'default',
				'options'       => [
					'default' => __( 'Default', 'zeus-elementor' ),
					'stacked' => __( 'Stacked', 'zeus-elementor' ),
					'framed'  => __( 'Framed', 'zeus-elementor' ),
				],
				'condition'     => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_shape',
			[
				'label'         => __( 'Shape', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'circle',
				'options'       => [
					'circle' => __( 'Circle', 'zeus-elementor' ),
					'square' => __( 'Square', 'zeus-elementor' ),
				],
				'condition'     => [
					'icon_view!'      => 'default',
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'front_title_text',
			[
				'label'         => __( 'Title & Description', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'This is the heading', 'zeus-elementor' ),
				'placeholder'   => __( 'Your Title', 'zeus-elementor' ),
				'separator'     => 'before',
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'front_description_text',
			[
				'label'         => __( 'Description', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'zeus-elementor' ),
				'placeholder'   => __( 'Your Description', 'zeus-elementor' ),
				'title'         => __( 'Input image text here', 'zeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_back',
			[
				'label'         => __( 'Back', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'back_title_text',
			[
				'label'         => __( 'Title & Description', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'This is the heading', 'zeus-elementor' ),
				'placeholder'   => __( 'Your Title', 'zeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'back_description_text',
			[
				'label'         => __( 'Description', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'zeus-elementor' ),
				'placeholder'   => __( 'Your Description', 'zeus-elementor' ),
				'title'         => __( 'Input image text here', 'zeus-elementor' ),
				'separator'     => 'none',
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'         => __( 'Button Text', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Click Here', 'zeus-elementor' ),
				'separator'     => 'before',
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => __( 'Link', 'zeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'http://your-link.com', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'link_click',
			[
				'label'         => __( 'Apply Link On', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'box'    => __( 'Whole Box', 'zeus-elementor' ),
					'button' => __( 'Button Only', 'zeus-elementor' ),
				],
				'default'       => 'button',
				'condition'     => [
					'link[url]!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_settings',
			[
				'label'         => __( 'Settings', 'zeus-elementor' ),
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label'         => __( 'Height', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px', 'vh' ],
				'range'         => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px', '%' ],
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-layer, {{WRAPPER}} .zeus-flip-box-layer-overlay' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'flip_effect',
			[
				'label'         => __( 'Flip Effect', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'flip',
				'options'       => [
					'flip'     => __( 'Flip', 'zeus-elementor' ),
					'slide'    => __( 'Slide', 'zeus-elementor' ),
					'push'     => __( 'Push', 'zeus-elementor' ),
					'zoom-in'  => __( 'Zoom In', 'zeus-elementor' ),
					'zoom-out' => __( 'Zoom Out', 'zeus-elementor' ),
					'fade'     => __( 'Fade', 'zeus-elementor' ),
				],
				'prefix_class'  => 'zeus-flip-box-effect-',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'flip_direction',
			[
				'label'         => __( 'Flip Direction', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'left',
				'options'       => [
					'left'  => __( 'Left', 'zeus-elementor' ),
					'right' => __( 'Right', 'zeus-elementor' ),
					'up'    => __( 'Up', 'zeus-elementor' ),
					'down'  => __( 'Down', 'zeus-elementor' ),
				],
				'condition'     => [
					'flip_effect!' => [
						'fade',
						'zoom-in',
						'zoom-out',
					],
				],
				'prefix_class'  => 'zeus-flip-box-direction-',
			]
		);

		$this->add_control(
			'flip_3d',
			[
				'label'         => __( '3D Depth', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'condition'     => [
					'flip_effect' => 'flip',
				],
				'prefix_class'  => 'zeus-flip-box-3d-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_front',
			[
				'label'         => __( 'Front', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'          => 'front_background',
				'types'         => [ 'classic', 'gradient' ],
				'selector'      => '{{WRAPPER}} .zeus-flip-box-front',
			]
		);

		$this->add_control(
			'front_background_overlay',
			[
				'label'         => __( 'Background Overlay', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'condition'     => [
					'front_background_image[id]!' => '',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-front .zeus-flip-box-layer-overlay' => 'background-color: {{VALUE}};',
				],
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'front_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-front .zeus-flip-box-layer-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'front_alignment',
			[
				'label'         => __( 'Alignment', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'label_block'   => false,
				'options'       => [
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
				'default'       => 'center',
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-front .zeus-flip-box-layer-overlay' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'front_vertical_position',
			[
				'label'         => __( 'Vertical Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'label_block'   => false,
				'options'       => [
					'top' => [
						'title' => __( 'Top', 'zeus-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'zeus-elementor' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'zeus-elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-front .zeus-flip-box-layer-overlay' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'front_border',
				'selector'      => '{{WRAPPER}} .zeus-flip-box-front',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'heading_image_style',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Image', 'zeus-elementor' ),
				'condition'     => [
					'graphic_element' => 'image',
				],
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'image_spacing',
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
					'{{WRAPPER}} .zeus-flip-box-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'graphic_element' => 'image',
				],
			]
		);

		$this->add_control(
			'image_width',
			[
				'label'         => __( 'Size (%)', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ '%' ],
				'default'       => [
					'unit' => '%',
				],
				'range'         => [
					'%' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-image img' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'graphic_element' => 'image',
				],
			]
		);

		$this->add_control(
			'image_opacity',
			[
				'label'         => __( 'Opacity (%)', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 1,
				],
				'range'         => [
					'px' => [
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-image' => 'opacity: {{SIZE}};',
				],
				'condition'     => [
					'graphic_element' => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'image_border',
				'label'         => __( 'Image Border', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-flip-box-image img',
				'condition'     => [
					'graphic_element' => 'image',
				],
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-image img' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'graphic_element' => 'image',
				],
			]
		);

		$this->add_control(
			'heading_icon_style',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Icon', 'zeus-elementor' ),
				'condition'     => [
					'graphic_element' => 'icon',
				],
				'separator'     => 'before',
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
					'{{WRAPPER}} .elementor-icon-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_primary_color',
			[
				'label'         => __( 'Icon Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .elementor-view-framed .elementor-icon, {{WRAPPER}} .elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
				'condition'     => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_secondary_color',
			[
				'label'         => __( 'Secondary Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',
				],
				'condition'     => [
					'graphic_element' => 'icon',
					'icon_view!' => 'default',
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
					'{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'graphic_element' => 'icon',
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
					'{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'graphic_element' => 'icon',
					'icon_view!' => 'default',
				],
			]
		);

		$this->add_control(
			'icon_rotate',
			[
				'label'         => __( 'Icon Rotate', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors'     => [
					'{{WRAPPER}} .elementor-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
				'condition'     => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_border_width',
			[
				'label'         => __( 'Border Width', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'selectors'     => [
					'{{WRAPPER}} .elementor-icon' => 'border-width: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'graphic_element' => 'icon',
					'icon_view' => 'framed',
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
					'{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'graphic_element' => 'icon',
					'icon_view!' => 'default',
				],
			]
		);

		$this->add_control(
			'heading_title_style',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Title', 'zeus-elementor' ),
				'condition'     => [
					'front_title_text!' => '',
				],
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'front_title_spacing',
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
					'{{WRAPPER}} .zeus-flip-box-front .zeus-flip-box-layer-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'front_description_text!' => '',
				],
			]
		);

		$this->add_control(
			'front_title_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-front .zeus-flip-box-layer-title' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'front_title_typography',
				'label'         => __( 'Typography', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-flip-box-front .zeus-flip-box-layer-title',
			]
		);

		$this->add_control(
			'heading_description_style',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Description', 'zeus-elementor' ),
				'condition'     => [
					'front_description_text!' => '',
				],
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'front_description_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-front .zeus-flip-box-layer-desc' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'front_description_typography',
				'label'         => __( 'Typography', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-flip-box-front .zeus-flip-box-layer-desc',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_back',
			[
				'label'         => __( 'Back', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'          => 'back_background',
				'types'         => [ 'classic', 'gradient' ],
				'selector'      => '{{WRAPPER}} .zeus-flip-box-back',
			]
		);

		$this->add_control(
			'back_background_overlay',
			[
				'label'         => __( 'Background Overlay', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'condition'     => [
					'back_background_image[id]!' => '',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-back .zeus-flip-box-layer-overlay' => 'background-color: {{VALUE}};',
				],
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'back_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-back .zeus-flip-box-layer-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'back_alignment',
			[
				'label'         => __( 'Alignment', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'label_block'   => false,
				'options'       => [
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
				'default'       => 'center',
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-back .zeus-flip-box-layer-overlay' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .zeus-flip-box-button' => 'margin-{{VALUE}}: 0',
				],
			]
		);

		$this->add_control(
			'back_vertical_position',
			[
				'label'         => __( 'Vertical Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'label_block'   => false,
				'options'       => [
					'top' => [
						'title' => __( 'Top', 'zeus-elementor' ),
						'icon'  => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'zeus-elementor' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'zeus-elementor' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary' => [
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-back .zeus-flip-box-layer-overlay' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'back_border',
				'selector'      => '{{WRAPPER}} .zeus-flip-box-back',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'heading_back_title_style',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Title', 'zeus-elementor' ),
				'condition'     => [
					'back_title_text!' => '',
				],
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'back_title_spacing',
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
					'{{WRAPPER}} .zeus-flip-box-back .zeus-flip-box-layer-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'back_title_text!' => '',
				],
			]
		);

		$this->add_control(
			'back_title_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-back .zeus-flip-box-layer-title' => 'color: {{VALUE}}',

				],
				'condition'     => [
					'back_title_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'back_title_typography',
				'label'         => __( 'Typography', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-flip-box-back .zeus-flip-box-layer-title',
				'condition'     => [
					'back_title_text!' => '',
				],
			]
		);

		$this->add_control(
			'heading_back_description_style',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Description', 'zeus-elementor' ),
				'condition'     => [
					'back_description_text!' => '',
				],
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'back_description_spacing',
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
					'{{WRAPPER}} .zeus-flip-box-back .zeus-flip-box-layer-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'back_description_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-back .zeus-flip-box-layer-desc' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'description_typography_b',
				'label'         => __( 'Typography', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-flip-box-back .zeus-flip-box-layer-desc',
			]
		);

		$this->add_control(
			'heading_back_button_style',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Button', 'zeus-elementor' ),
				'condition'     => [
					'button_text!' => '',
				],
				'separator'     => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'button_typography',
				'label'         => esc_html__( 'Typography', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-flip-box-button',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label'         => esc_html__( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label'         => esc_html__( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'         => esc_html__( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name'          => 'button_border',
				'label'         => esc_html__( 'Border', 'zeus-elementor' ),
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .zeus-flip-box-button',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'         => esc_html__( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'button_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-flip-box-button',
			]
		);

		$this->add_control(
			'button_text_padding',
			[
				'label'         => esc_html__( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label'         => esc_html__( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label'         => esc_html__( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'         => esc_html__( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'         => esc_html__( 'Border Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-flip-box-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'button_hover_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-flip-box-button:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {
		$settings       = $this->get_settings_for_display();
		$wrap_tag       = 'div';
		$button_tag     = 'a';

		$this->add_render_attribute( 'wrap', 'class', 'zeus-flip-box-layer zeus-flip-box-back' );

		$this->add_render_attribute( 'button', 'class', [
			'zeus-flip-box-button',
			'button',
		] );

		if ( 'box' === $settings['link_click'] ) {
			$wrap_tag = 'a';
			$button_tag = 'button';
			$this->add_link_attributes( 'wrap', $settings['link'] );
		} else {
			$this->add_link_attributes( 'button', $settings['link'] );
			$this->add_render_attribute( 'button', 'class',
				[
					'zeus-flip-box-button',
					'elementor-button',
				]
			);
		}

		if ( 'icon' === $settings['graphic_element'] ) {
			$this->add_render_attribute( 'icon-wrap', 'class', 'elementor-icon-wrap' );
			$this->add_render_attribute( 'icon-wrap', 'class', 'elementor-view-' . $settings['icon_view'] );

			if ( 'default' !== $settings['icon_view'] ) {
				$this->add_render_attribute( 'icon-wrap', 'class', 'elementor-shape-' . $settings['icon_shape'] );
			}

			if ( ! empty( $settings['icon'] ) ) {
				$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
			}
		} ?>

		<div class="zeus-flip-box">

			<div class="zeus-flip-box-layer zeus-flip-box-front">
				<div class="zeus-flip-box-layer-overlay">
					<div class="zeus-flip-box-layer-inner">
						<?php
						if ( 'image' === $settings['graphic_element']
							&& ! empty( $settings['image']['url'] ) ) { ?>
							<div class="zeus-flip-box-image">
								<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings ) ); ?>
							</div>
							<?php
						} elseif ( 'icon' === $settings['graphic_element']
							&& ! empty( $settings['selected_icon'] ) ) { ?>
							<div <?php $this->print_render_attribute_string( 'icon-wrap' ); ?>>
								<div class="elementor-icon">
									<?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								</div>
							</div>
							<?php
						}

						if ( ! empty( $settings['front_title_text'] ) ) { ?>
							<h3 class="zeus-flip-box-layer-title">
								<?php $this->print_unescaped_setting( 'front_title_text' ); ?>
							</h3>
							<?php
						}

						if ( ! empty( $settings['front_description_text'] ) ) { ?>
							<div class="zeus-flip-box-layer-desc">
								<?php $this->print_unescaped_setting( 'front_description_text' ); ?>
							</div>
							<?php
						} ?>
					</div>
				</div>
			</div>

			<<?php echo esc_attr( $wrap_tag ); ?> <?php $this->print_render_attribute_string( 'wrap' ); ?>>
				<div class="zeus-flip-box-layer-overlay">
					<div class="zeus-flip-box-layer-inner">
						<?php
						if ( ! empty( $settings['back_title_text'] ) ) { ?>
							<h3 class="zeus-flip-box-layer-title">
								<?php $this->print_unescaped_setting( 'back_title_text' ); ?>
							</h3>
							<?php
						}

						if ( ! empty( $settings['back_description_text'] ) ) { ?>
							<div class="zeus-flip-box-layer-desc">
								<?php $this->print_unescaped_setting( 'back_description_text' ); ?>
							</div>
							<?php
						}

						if ( ! empty( $settings['button_text'] ) ) { ?>
							<<?php echo esc_attr( $button_tag ); ?> <?php $this->print_render_attribute_string( 'button' ); ?>>
								<?php $this->print_unescaped_setting( 'button_text' ); ?>
							</<?php echo esc_attr( $button_tag ); ?>>
							<?php
						} ?>
					</div>
				</div>
			</<?php echo esc_attr( $wrap_tag ); ?>>

		</div>

		<?php
	}

	protected function content_template() { ?>
		<#
			if ( 'image' === settings.graphic_element && '' !== settings.image.url ) {
				var image = {
					id: settings.image.id,
					url: settings.image.url,
					size: settings.image_size,
					dimension: settings.image_custom_dimension,
					model: view.getEditModel()
				};

				var imageUrl = elementor.imagesManager.getImageUrl( image );
			}

			var wrapperTag = 'div',
				buttonTag = 'a';

			if ( 'box' === settings.link_click ) {
				wrapperTag = 'a';
				buttonTag = 'button';
			}

			if ( 'icon' === settings.graphic_element ) {
				var iconWrapperClasses = 'elementor-icon-wrap';
					iconWrapperClasses += ' elementor-view-' + settings.icon_view;
				if ( 'default' !== settings.icon_view ) {
					iconWrapperClasses += ' elementor-shape-' + settings.icon_shape;
				}
			}

		var iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' ),
			migrated = elementor.helpers.isIconMigrated( settings, 'selected_icon' ); #>

		<div class="zeus-flip-box">
			<div class="zeus-flip-box-layer zeus-flip-box-front">
				<div class="zeus-flip-box-layer-overlay">
					<div class="zeus-flip-box-layer-inner">
						<# if ( 'image' === settings.graphic_element
							&& '' !== settings.image.url ) { #>
							<div class="zeus-flip-box-image">
								<img src="{{ imageUrl }}">
							</div>
						<# } else if ( 'icon' === settings.graphic_element
							&& settings.selected_icon ) { #>
							<div class="{{ iconWrapperClasses }}" >
								<div class="elementor-icon">
									<# if ( iconHTML && iconHTML.rendered && ( ! settings.icon || migrated ) ) { #>
										{{{ iconHTML.value }}}
									<# } else { #>
										<i class="{{ settings.icon }}" aria-hidden="true"></i>
									<# } #>
								</div>
							</div>
						<# } #>

						<# if ( settings.front_title_text ) { #>
							<h3 class="zeus-flip-box-layer-title">{{{ settings.front_title_text }}}</h3>
						<# } #>

						<# if ( settings.front_description_text ) { #>
							<div class="zeus-flip-box-layer-desc">{{{ settings.front_description_text }}}</div>
						<# } #>
					</div>
				</div>
			</div>
			<{{ wrapperTag }} class="zeus-flip-box-layer zeus-flip-box-back">
				<div class="zeus-flip-box-layer-overlay">
					<div class="zeus-flip-box-layer-inner">
						<# if ( settings.back_title_text ) { #>
							<h3 class="zeus-flip-box-layer-title">{{{ settings.back_title_text }}}</h3>
						<# } #>

						<# if ( settings.back_description_text ) { #>
							<div class="zeus-flip-box-layer-desc">{{{ settings.back_description_text }}}</div>
						<# } #>

						<# if ( settings.button_text ) { #>
							<{{ buttonTag }} href="#" class="zeus-flip-box-button elementor-button button">{{{ settings.button_text }}}</{{ buttonTag }}>
						<# } #>
					</div>
				</div>
			</{{ wrapperTag }}>
		</div>

		<?php
	}
}
