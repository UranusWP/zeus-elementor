<?php
namespace ZeusElementor\Modules\CallToAction\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

class CallToAction extends Widget_Base {

	public function get_name() {
		return 'zeus-call-to-action';
	}

	public function get_title() {
		return __( 'Call To Action', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-stop2';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'call',
			'action',
			'notice',
			'message',
			'banner',
			'cta',
			'zeus',
		];
	}

	public function get_style_depends() {
		return [ 'zeus-call-to-action' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_cta_general',
			[
				'label'         => __( 'General', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label'         => __( 'Style', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'basic',
				'options'       => [
					'basic'     => __( 'Basic', 'zeus-elementor' ),
					'inside'    => __( 'Inside', 'zeus-elementor' ),
					'outside'   => __( 'Outside', 'zeus-elementor' ),
				],
				'render_type'   => 'template',
				'prefix_class'  => 'zeus-cta-style-',
			]
		);

		$this->add_responsive_control(
			'min_height',
			[
				'label'         => __( 'Height', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
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
				'size_units'    => [ 'px', 'vh' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-inner' => 'min-height: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_responsive_control(
			'position',
			[
				'label'         => __( 'Image Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'default'       => 'above',
				'options'       => [
					'left' => [
						'title' => __( 'Left', 'zeus-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'above' => [
						'title' => __( 'Above', 'zeus-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'zeus-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'zeus-cta-%s-image-',
				'condition' => [
					'style' => 'outside',
				],
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'         => __( 'Alignment', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'default'       => 'center',
				'options'       => [
					'left'      => [
						'title'     => __( 'Left', 'zeus-elementor' ),
						'icon'      => 'eicon-text-align-left',
					],
					'center'    => [
						'title'     => __( 'Center', 'zeus-elementor' ),
						'icon'      => 'eicon-text-align-center',
					],
					'right'     => [
						'title'     => __( 'Right', 'zeus-elementor' ),
						'icon'      => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-inner' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'vertical_position',
			[
				'label'         => __( 'Vertical Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
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
				'prefix_class'  => 'zeus-cta-valign-',
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_control(
			'bg_image',
			[
				'label'         => __( 'Choose Image', 'zeus-elementor' ),
				'type'          => Controls_Manager::MEDIA,
				'dynamic'       => [ 'active' => true ],
				'default'       => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'          => 'bg_image',
				'label'         => __( 'Image Resolution', 'zeus-elementor' ),
				'default'       => 'large',
				'condition'     => [
					'bg_image[id]!' => '',
					'style!' => 'basic',
				],
			]
		);

		$this->add_control(
			'overlay',
			[
				'label'         => __( 'Add Overlay?', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'return_value'  => 'yes',
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_control(
			'heading_bg_image',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Image', 'zeus-elementor' ),
				'condition'     => [
					'bg_image[url]!' => '',
					'style!' => 'basic',
				],
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'image_min_width',
			[
				'label'         => __( 'Width', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-bg-wrapper' => 'min-width: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'style!' => 'basic',
					'position!' => 'above',
				],
			]
		);

		$this->add_responsive_control(
			'image_min_height',
			[
				'label'         => __( 'Height', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units'    => [ 'px', 'vh' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-bg-wrapper' => 'min-height: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cta_content',
			[
				'label'         => __( 'Content', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'element',
			[
				'label'         => __( 'Element', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'default'       => 'none',
				'options'       => [
					'none' => [
						'title' => __( 'None', 'zeus-elementor' ),
						'icon' => 'eicon-ban',
					],
					'image' => [
						'title' => __( 'Image', 'zeus-elementor' ),
						'icon' => 'eicon-image-bold',
					],
					'icon' => [
						'title' => __( 'Icon', 'zeus-elementor' ),
						'icon' => 'eicon-star',
					],
				],
			]
		);

		$this->add_control(
			'element_image',
			[
				'label'         => __( 'Choose Image', 'zeus-elementor' ),
				'type'          => Controls_Manager::MEDIA,
				'default'       => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic'       => [ 'active' => true ],
				'show_label'    => false,
				'condition'     => [
					'element' => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'          => 'element_image',
				'default'       => 'thumbnail',
				'condition'     => [
					'element' => 'image',
					'element_image[id]!' => '',
				],
			]
		);

		$this->add_control(
			'selected_cta_icon',
			[
				'label'         => __( 'Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'fa4compatibility' => 'cta_icon',
				'default'       => [
					'value'     => 'far fa-gem',
					'library'   => 'fa-regular',
				],
				'condition'     => [
					'element' => 'icon',
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'         => __( 'Title', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Call to action heading', 'zeus-elementor' ),
				'label_block'   => true,
				'dynamic'       => [ 'active' => true ],
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'description',
			[
				'label'         => __( 'Description', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'zeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
				'rows'          => 5,
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label'         => __( 'HTML Tag', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'h3',
				'options'       => zeus_get_available_tags(),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cta_button',
			[
				'label'         => __( 'Button', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label'         => __( 'Text', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Click me', 'zeus-elementor' ),
				'placeholder'   => __( 'Click me', 'zeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label'         => __( 'Link', 'zeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'zeus-elementor' ),
				'default'       => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'link_click',
			[
				'label'         => __( 'Apply Link On', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'button',
				'options'       => [
					'button' => __( 'Button Only', 'zeus-elementor' ),
					'box' => __( 'Whole Box', 'zeus-elementor' ),
				],
				'condition'     => [
					'btn_link[url]!' => '',
				],
			]
		);

		$this->add_control(
			'selected_btn_icon',
			[
				'label'         => __( 'Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'fa4compatibility' => 'btn_icon',
				'default'       => [
					'value'     => '',
					'library'   => 'fa-regular',
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
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'         => __( 'Icon Size', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 3,
						'max' => 60,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label'         => __( 'Icon Spacing', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 50,
					],
				],
				'condition'     => [
					'icon!' => '',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta-btn .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .zeus-cta-btn .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'secondary_btn',
			[
				'label'         => __( 'Show Secondary Button?', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'return_value'  => 'yes',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			's_btn_text',
			[
				'label'         => __( 'Text', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Click me', 'zeus-elementor' ),
				'placeholder'   => __( 'Click me', 'zeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			's_btn_link',
			[
				'label'         => __( 'Link', 'zeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'zeus-elementor' ),
				'default'       => [
					'url' => '#',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			'selected_s_btn_icon',
			[
				'label'         => __( 'Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'fa4compatibility' => 's_btn_icon',
				'default'       => [
					'value'     => '',
					'library'   => 'fa-regular',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			's_icon_align',
			[
				'label'         => __( 'Icon Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'left',
				'options'       => [
					'left' => __( 'Before', 'zeus-elementor' ),
					'right' => __( 'After', 'zeus-elementor' ),
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			's_icon_size',
			[
				'label'         => __( 'Icon Size', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 3,
						'max' => 60,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			's_icon_indent',
			[
				'label'         => __( 'Icon Spacing', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 50,
					],
				],
				'condition'     => [
					'icon!' => '',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta-btn .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .zeus-cta-btn .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'         => __( 'Box', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'background',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'basic',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'border',
				'label'         => __( 'Border', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-cta',
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'style' => 'basic',
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
					'{{WRAPPER}} .zeus-cta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .zeus-cta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-cta',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'element_style',
			[
				'label'         => __( 'Element', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'element!' => [
						'none',
						'',
					],
				],
			]
		);

		$this->add_control(
			'element_image_spacing',
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
					'{{WRAPPER}} .zeus-cta-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'element' => 'image',
				],
			]
		);

		$this->add_control(
			'element_image_width',
			[
				'label'         => __( 'Size', 'zeus-elementor' ) . ' (%)',
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
					'{{WRAPPER}} .zeus-cta-image img' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'element' => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'element_image_border',
				'selector'      => '{{WRAPPER}} .zeus-cta-image img',
				'condition'     => [
					'element' => 'image',
				],
			]
		);

		$this->add_control(
			'element_image_border_radius',
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
					'{{WRAPPER}} .zeus-cta-image img' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'element' => 'image',
				],
			]
		);

		$this->add_control(
			'element_icon_spacing',
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
					'{{WRAPPER}} .zeus-cta-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'element' => 'icon',
				],
			]
		);

		$this->add_control(
			'element_icon_size',
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
					'{{WRAPPER}} .zeus-cta .zeus-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'element' => 'icon',
				],
			]
		);

		$this->add_control(
			'element_icon_padding',
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
					'{{WRAPPER}} .zeus-cta .zeus-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'element' => 'icon',
				],
			]
		);

		$this->add_control(
			'element_icon_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-icon' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'element' => 'icon',
				],
			]
		);

		$this->add_control(
			'element_icon_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .zeus-cta .zeus-icon svg' => 'fill: {{VALUE}};',
				],
				'condition'     => [
					'element' => 'icon',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'element_icon_border',
				'label'         => __( 'Border', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-cta .zeus-icon',
				'condition'     => [
					'element' => 'icon',
				],
			]
		);

		$this->add_control(
			'element_icon_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'element' => 'icon',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label'         => __( 'Content', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'style' => 'outside',
				],
			]
		);

		$this->add_control(
			'content_background',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}}.zeus-cta-style-outside .zeus-cta .zeus-cta-inner' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'outside',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}}.zeus-cta-style-outside .zeus-cta .zeus-cta-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'style' => 'outside',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label'         => __( 'Title', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-title' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'title_typo',
				'selector'      => '{{WRAPPER}} .zeus-cta .zeus-cta-title',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'title_border',
				'label'         => __( 'Border', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-cta .zeus-cta-title',
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'          => 'title_shadow',
				'selector'      => '{{WRAPPER}} .zeus-cta .zeus-cta-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			[
				'label'         => __( 'Description', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'description_typo',
				'selector'      => '{{WRAPPER}} .zeus-cta .zeus-cta-description',
			]
		);

		$this->add_responsive_control(
			'description_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'          => 'description_shadow',
				'selector'      => '{{WRAPPER}} .zeus-cta .zeus-cta-description',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_buttons_style',
			[
				'label'         => __( 'Buttons', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'button_typography',
				'selector'      => '{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button' => 'color: {{VALUE}};',
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
			'button_background_hover_color',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'         => __( 'Border Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_animation',
			[
				'label'         => __( 'Hover Animation', 'zeus-elementor' ),
				'type'          => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'button_border',
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'button_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_s_btn_style',
			[
				'label'         => __( 'Secondary Button', 'zeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'condition'     => [
					'secondary_btn' => 'yes',
				],
				'separator'     => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 's_button_typography',
				'selector'      => '{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button.zeus-cta-s-btn',
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_s_button_style' );

		$this->start_controls_tab(
			'tab_s_button_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			's_button_background_color',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button.zeus-cta-s-btn' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			's_button_text_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button.zeus-cta-s-btn' => 'color: {{VALUE}};',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_s_button_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			's_button_background_hover_color',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button.zeus-cta-s-btn:hover' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			's_button_hover_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button.zeus-cta-s-btn:hover' => 'color: {{VALUE}};',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			's_button_hover_border_color',
			[
				'label'         => __( 'Border Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button.zeus-cta-s-btn:hover' => 'border-color: {{VALUE}};',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 's_button_border',
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button.zeus-cta-s-btn',
				'separator'     => 'before',
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			's_button_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button.zeus-cta-s-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 's_button_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button.zeus-cta-s-btn',
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			's_button_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-btn .zeus-button.zeus-cta-s-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hover_effects',
			[
				'label'         => __( 'Hover Effects', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_control(
			'content_hover_heading',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Content', 'zeus-elementor' ),
				'condition'     => [
					'style' => 'inside',
				],
			]
		);

		$this->add_control(
			'content_animation',
			[
				'label'         => __( 'Hover Animation', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'groups'        => [
					[
						'label' => __( 'None', 'zeus-elementor' ),
						'options' => [
							'' => __( 'None', 'zeus-elementor' ),
						],
					],
					[
						'label' => __( 'Entrance', 'zeus-elementor' ),
						'options' => [
							'enter-from-right' => 'Slide In Right',
							'enter-from-left' => 'Slide In Left',
							'enter-from-top' => 'Slide In Up',
							'enter-from-bottom' => 'Slide In Down',
							'enter-zoom-in' => 'Zoom In',
							'enter-zoom-out' => 'Zoom Out',
							'fade-in' => 'Fade In',
						],
					],
					[
						'label' => __( 'Reaction', 'zeus-elementor' ),
						'options' => [
							'grow' => 'Grow',
							'shrink' => 'Shrink',
							'move-right' => 'Move Right',
							'move-left' => 'Move Left',
							'move-up' => 'Move Up',
							'move-down' => 'Move Down',
						],
					],
					[
						'label' => __( 'Exit', 'zeus-elementor' ),
						'options' => [
							'exit-to-right' => 'Slide Out Right',
							'exit-to-left' => 'Slide Out Left',
							'exit-to-top' => 'Slide Out Up',
							'exit-to-bottom' => 'Slide Out Down',
							'exit-zoom-in' => 'Zoom In',
							'exit-zoom-out' => 'Zoom Out',
							'fade-out' => 'Fade Out',
						],
					],
				],
				'default'       => 'fade-in',
				'condition'     => [
					'style' => 'inside',
				],
			]
		);

		$this->add_control(
			'animation_class',
			[
				'label'         => __( 'Animation', 'zeus-elementor' ),
				'type'          => Controls_Manager::HIDDEN,
				'default'       => 'animated-content',
				'prefix_class'  => 'zeus-',
				'condition'     => [
					'content_animation!' => '',
					'style' => 'inside',
				],
			]
		);

		$this->add_control(
			'content_animation_duration',
			[
				'label'         => __( 'Animation Duration', 'zeus-elementor' ) . ' (ms)',
				'type'          => Controls_Manager::SLIDER,
				'render_type'   => 'template',
				'default'       => [
					'size' => 1000,
				],
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 3000,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta-content' => 'transition-duration: {{SIZE}}ms',
					'{{WRAPPER}}.zeus-cta-sequenced-animation .zeus-cta-content:nth-child(2)' => 'transition-delay: calc( {{SIZE}}ms / 3 )',
					'{{WRAPPER}}.zeus-cta-sequenced-animation .zeus-cta-content:nth-child(3)' => 'transition-delay: calc( ( {{SIZE}}ms / 3 ) * 2 )',
					'{{WRAPPER}}.zeus-cta-sequenced-animation .zeus-cta-content:nth-child(4)' => 'transition-delay: calc( ( {{SIZE}}ms / 3 ) * 3 )',
				],
				'condition'     => [
					'content_animation!' => '',
					'style' => 'inside',
				],
			]
		);

		$this->add_control(
			'sequenced_animation',
			[
				'label'         => __( 'Sequenced Animation', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'return_value'  => 'zeus-cta-sequenced-animation',
				'prefix_class'  => '',
				'condition'     => [
					'content_animation!' => '',
					'style' => 'inside',
				],
			]
		);

		$this->add_control(
			'background_hover_heading',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Background', 'zeus-elementor' ),
				'separator'     => 'before',
				'condition'     => [
					'style' => 'inside',
				],
			]
		);

		$this->add_control(
			'transformation',
			[
				'label'         => __( 'Hover Animation', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'' => 'None',
					'zoom-in' => 'Zoom In',
					'zoom-out' => 'Zoom Out',
					'move-left' => 'Move Left',
					'move-right' => 'Move Right',
					'move-up' => 'Move Up',
					'move-down' => 'Move Down',
				],
				'default'       => 'zoom-in',
				'prefix_class'  => 'zeus-bg-transform zeus-bg-transform-',
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->start_controls_tabs( 'bg_effects_tabs' );

		$this->start_controls_tab( 'normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_control(
			'overlay_color',
			[
				'label'         => __( 'Overlay Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-bg-overlay' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'          => 'bg_filters',
				'selector'      => '{{WRAPPER}} .zeus-cta .zeus-cta-bg',
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_control(
			'overlay_blend_mode',
			[
				'label'         => __( 'Blend Mode', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'' => __( 'Normal', 'zeus-elementor' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'color-burn' => 'Color Burn',
					'hue' => 'Hue',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'exclusion' => 'Exclusion',
					'luminosity' => 'Luminosity',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-bg-overlay' => 'mix-blend-mode: {{VALUE}}',
				],
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_control(
			'overlay_color_hover',
			[
				'label'         => __( 'Overlay Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta:hover .zeus-cta-bg-overlay' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'          => 'bg_filters_hover',
				'selector'      => '{{WRAPPER}} .zeus-cta:hover .zeus-cta-bg',
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_control(
			'effect_duration',
			[
				'label'         => __( 'Transition Duration', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'render_type'   => 'template',
				'default'       => [
					'size' => 1500,
				],
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 3000,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-cta .zeus-cta-bg, {{WRAPPER}} .zeus-cta .zeus-cta-bg-overlay' => 'transition-duration: {{SIZE}}ms',
				],
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {
		$settings           = $this->get_settings_for_display();
		$bg_image           = '';
		$wrapper_tag        = 'div';
		$btn_tag            = 'a';
		$tag                = $settings['title_html_tag'];
		$animation          = $settings['content_animation'];

		$this->add_render_attribute( 'wrapper', 'class', 'zeus-cta' );

		if ( ! empty( $settings['bg_image']['id'] ) ) {
			$bg_image = Group_Control_Image_Size::get_attachment_image_src( $settings['bg_image']['id'], 'bg_image', $settings );
		} elseif ( ! empty( $settings['bg_image']['url'] ) ) {
			$bg_image = $settings['bg_image']['url'];
		}

		$this->add_render_attribute( [
			'bg_image' => [
				'class' => 'zeus-cta-bg',
				'style' => 'background-image: url(' . $bg_image . ');',
			],
		] );

		$this->add_render_attribute( 'element', [
			'class' => [
				'zeus-cta-item',
				'zeus-cta-content',
			],
		] );

		if ( 'icon' === $settings['element'] ) {
			$this->add_render_attribute( 'element', 'class', 'zeus-cta-icon' );
		} elseif ( 'image' === $settings['element'] && ! empty( $settings['element_image']['url'] ) ) {
			$this->add_render_attribute( 'element', 'class', 'zeus-cta-image' );
		}

		$this->add_render_attribute( 'title', [
			'class' => [
				'zeus-cta-title',
				'zeus-cta-content',
			],
		] );
		$this->add_inline_editing_attributes( 'title' );

		$this->add_render_attribute( 'description', [
			'class' => [
				'zeus-cta-description',
				'zeus-cta-content',
			],
		] );
		$this->add_inline_editing_attributes( 'description' );

		$this->add_render_attribute( 'btn-wrapper', [
			'class' => [
				'zeus-cta-btn',
				'zeus-cta-content',
			],
		] );

		$this->add_render_attribute( 'btn', 'class',
			[
				'zeus-button',
				'elementor-button',
			]
		);

		$this->add_render_attribute( 's-btn', [
			'class' => [
				'zeus-button',
				'elementor-button',
				'zeus-cta-s-btn',
			],
		] );

		if ( ! empty( $settings['btn_link']['url'] ) ) {
			$link_element = 'btn';

			if ( 'box' === $settings['link_click'] ) {
				$wrapper_tag = 'a';
				$btn_tag = 'span';
				$link_element = 'wrapper';
			}

			$this->add_link_attributes( $link_element, $settings['btn_link'] );
		}

		if ( ! empty( $settings['s_btn_link']['url'] ) ) {
			$this->add_link_attributes( 's-btn', $settings['s_btn_link'] );
		}

		if ( $settings['button_hover_animation'] ) {
			$this->add_render_attribute( 'btn', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
			$this->add_render_attribute( 's-btn', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
		}

		if ( ! empty( $animation ) && 'inside' === $settings['style'] ) {
			$animation_class = 'zeus-animated-' . $animation;
			$this->add_render_attribute( 'element', 'class', $animation_class );
			$this->add_render_attribute( 'title', 'class', $animation_class );
			$this->add_render_attribute( 'description', 'class', $animation_class );
			$this->add_render_attribute( 'btn-wrapper', 'class', $animation_class );
		} ?>

		<<?php echo esc_attr( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

			<?php
			if ( 'basic' !== $settings['style']
				&& ! empty( $bg_image ) ) : ?>
				<div class="zeus-cta-bg-wrapper">
					<div <?php $this->print_render_attribute_string( 'bg_image' ); ?>></div>
					<?php
					if ( 'yes' === $settings['overlay'] ) : ?>
						<div class="zeus-cta-bg-overlay"></div>
						<?php
					endif; ?>
				</div>
				<?php
			endif; ?>

			<div class="zeus-cta-inner">
				<?php
				if ( 'image' === $settings['element']
					&& ! empty( $settings['element_image']['url'] ) ) : ?>
					<div <?php $this->print_render_attribute_string( 'element' ); ?>>
						<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'element_image' ) ); ?>
					</div>
					<?php
				elseif ( 'icon' === $settings['element']
					&& ( ! empty( $settings['cta_icon'] ) || ! empty( $settings['selected_cta_icon'] ) ) ) :
					$migrated   = isset( $settings['__fa4_migrated']['selected_cta_icon'] );
					$is_new     = empty( $settings['cta_icon'] ) && Icons_Manager::is_migration_allowed(); ?>
					<div <?php $this->print_render_attribute_string( 'element' ); ?>>
						<div class="zeus-icon">
							<?php
							if ( $is_new || $migrated ) :
								Icons_Manager::render_icon( $settings['selected_cta_icon'], [ 'aria-hidden' => 'true' ] );
							else : ?>
								<i class="<?php echo esc_attr( $settings['cta_icon'] ); ?>" aria-hidden="true"></i>
								<?php
							endif; ?>
						</div>
					</div>
					<?php
				endif;

				if ( ! empty( $settings['title'] ) ) : ?>
					<<?php echo esc_attr( $tag ); ?> <?php $this->print_render_attribute_string( 'title' ); ?>>
						<?php $this->print_unescaped_setting( 'title' ); ?>
					</<?php echo esc_attr( $tag ); ?>>
					<?php
				endif;

				if ( ! empty( $settings['description'] ) ) : ?>
					<div <?php $this->print_render_attribute_string( 'description' ); ?>><?php $this->print_unescaped_setting( 'description' ); ?></div>
					<?php
				endif;

				if ( ! empty( $settings['btn_link']['url'] ) ) : ?>
					<div <?php $this->print_render_attribute_string( 'btn-wrapper' ); ?>>
						<<?php echo esc_attr( $btn_tag ); ?> <?php $this->print_render_attribute_string( 'btn' ); ?>>
							<?php
							if ( 'left' === $settings['icon_align']
								&& ( ! empty( $settings['btn_icon'] ) || ! empty( $settings['selected_btn_icon'] ) ) ) :
								Icons_Manager::render_icon( $settings['selected_btn_icon'], [ 'aria-hidden' => 'true' ] );
							endif; ?>
							<span><?php $this->print_unescaped_setting( 'btn_text' ); ?></span>
							<?php
							if ( 'right' === $settings['icon_align']
								&& ( ! empty( $settings['btn_icon'] ) || ! empty( $settings['selected_btn_icon'] ) ) ) :
								Icons_Manager::render_icon( $settings['selected_btn_icon'], [ 'aria-hidden' => 'true' ] );
							endif; ?>
						</<?php echo esc_attr( $btn_tag ); ?>>

						<?php
						if ( 'yes' === $settings['secondary_btn']
							&& ! empty( $settings['s_btn_link']['url'] ) ) : ?>
							<a <?php $this->print_render_attribute_string( 's-btn' ); ?>>
								<?php
								if ( 'left' === $settings['s_icon_align']
									&& ( ! empty( $settings['s_btn_icon'] ) || ! empty( $settings['selected_s_btn_icon'] ) ) ) :
									Icons_Manager::render_icon( $settings['selected_s_btn_icon'], [ 'aria-hidden' => 'true' ] );
								endif; ?>
								<span><?php $this->print_unescaped_setting( 's_btn_text' ); ?></span>
								<?php
								if ( 'right' === $settings['s_icon_align']
									&& ( ! empty( $settings['s_btn_icon'] ) || ! empty( $settings['selected_s_btn_icon'] ) ) ) :
									Icons_Manager::render_icon( $settings['selected_s_btn_icon'], [ 'aria-hidden' => 'true' ] );
								endif; ?>
							</a>
							<?php
						endif; ?>
					</div>
					<?php
				endif; ?>
			</div>
		</<?php echo esc_attr( $wrapper_tag ); ?>>

		<?php
	}

	/**
	 * Render Call to Action widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() { ?>
		<#
		var wrapperTag          = 'div',
			contentAnimation    = settings.content_animation,
			animationClass,
			iconHTML            = elementor.helpers.renderIcon( view, settings.selected_cta_icon, { 'aria-hidden': true }, 'i' , 'object' ),
			migrated            = elementor.helpers.isIconMigrated( settings, 'selected_cta_icon' ),
			btnIconHTML         = elementor.helpers.renderIcon( view, settings.selected_btn_icon, { 'aria-hidden': true }, 'i' , 'object' ),
			btnMigrated         = elementor.helpers.isIconMigrated( settings, 'selected_btn_icon' ),
			sbtnIconHTML        = elementor.helpers.renderIcon( view, settings.selected_s_btn_icon, { 'aria-hidden': true }, 'i' , 'object' ),
			sbtnMigrated        = elementor.helpers.isIconMigrated( settings, 'selected_s_btn_icon' );

		if ( '' !== settings.bg_image.url ) {
			var bg_image = {
				id: settings.bg_image.id,
				url: settings.bg_image.url,
				size: settings.bg_image_size,
				dimension: settings.bg_image_custom_dimension,
				model: view.getEditModel()
			};

			var bgImageUrl = elementor.imagesManager.getImageUrl( bg_image );
		}

		view.addRenderAttribute( 'wrapper', 'class', 'zeus-cta' );

		view.addRenderAttribute( 'bg_image', 'style', 'background-image: url(' + bgImageUrl + ');' );

		view.addRenderAttribute( 'element', 'class', [ 'zeus-cta-item', 'zeus-cta-content' ] );

		if ( 'icon' === settings.element ) {
			view.addRenderAttribute( 'element', 'class', 'zeus-cta-icon' );
		} else if ( 'image' === settings.element && '' !== settings.element_image.url ) {
			var image = {
				id: settings.element_image.id,
				url: settings.element_image.url,
				size: settings.element_image_size,
				dimension: settings.element_image_custom_dimension,
				model: view.getEditModel()
			};

			var imageUrl = elementor.imagesManager.getImageUrl( image );
			view.addRenderAttribute( 'element', 'class', 'zeus-cta-image' );
		}

		view.addRenderAttribute( 'title', 'class', [ 'zeus-cta-title', 'zeus-cta-content' ] );
		view.addInlineEditingAttributes( 'title' );

		view.addRenderAttribute( 'description', 'class', [ 'zeus-cta-description', 'zeus-cta-content' ] );
		view.addInlineEditingAttributes( 'description' );

		view.addRenderAttribute( 'btn-wrapper', 'class', [ 'zeus-cta-btn', 'zeus-cta-content' ] );

		if ( 'box' === settings.link_click ) {
			wrapperTag = 'a';
			buttonTag = 'span';
			view.addRenderAttribute( 'wrapper', 'href', '#' );
		}

		if ( settings.button_hover_animation ) {
			view.addRenderAttribute( 'btn', 'class', 'elementor-animation-' + settings.button_hover_animation );
			view.addRenderAttribute( 's-btn', 'class', 'elementor-animation-' + settings.button_hover_animation );
		}

		if ( contentAnimation && 'inside' === settings.style ) {
			var animationClass = 'zeus-animated-' + contentAnimation;
			view.addRenderAttribute( 'element', 'class', animationClass );
			view.addRenderAttribute( 'title', 'class', animationClass );
			view.addRenderAttribute( 'description', 'class', animationClass );
			view.addRenderAttribute( 'btn-wrapper', 'class', animationClass );
		} #>

		<{{ wrapperTag }} {{{ view.getRenderAttributeString( 'wrapper' ) }}}>

			<# if ( 'basic' !== settings.style && ! _.isEmpty( bg_image ) ) { #>
				<div class="zeus-cta-bg-wrapper">
					<div class="zeus-cta-bg" {{{ view.getRenderAttributeString( 'bg_image' ) }}}></div>
					<# if ( 'yes' === settings.overlay ) { #>
						<div class="zeus-cta-bg-overlay"></div>
					<# } #>
				</div>
			<# } #>

			<div class="zeus-cta-inner">
				<# if ( 'image' === settings.element
					&& '' !== settings.element_image.url ) { #>
					<div {{{ view.getRenderAttributeString( 'element' ) }}}>
						<img src="{{ imageUrl }}">
					</div>
				<# } else if ( 'icon' === settings.element && ( settings.cta_icon || settings.selected_cta_icon ) ) { #>
					<div {{{ view.getRenderAttributeString( 'element' ) }}}>
						<div class="zeus-icon">
							<# if ( iconHTML && iconHTML.rendered && ( ! settings.cta_icon || migrated ) ) { #>
								{{{ iconHTML.value }}}
							<# } else { #>
								<i class="{{ settings.cta_icon }}"></i>
							<# } #>
						</div>
					</div>
				<# }

				if ( settings.title ) { #>
					<{{ settings.title_html_tag }} {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</{{ settings.title_html_tag }}>
				<# }

				if ( settings.description ) { #>
					<div {{{ view.getRenderAttributeString( 'description' ) }}}>{{{ settings.description }}}</div>
				<# }

				if ( settings.btn_text ) { #>
					<div {{{ view.getRenderAttributeString( 'btn-wrapper' ) }}}>
						<a href="{{ settings.btn_link.url }}" class="zeus-button elementor-button elementor-animation-{{ settings.button_animation }}">
							<#
							if ( 'left' == settings.icon_align && ( btnIconHTML && btnIconHTML.rendered && ( ! settings.btn_icon || btnMigrated ) ) ) { #>
								{{{ btnIconHTML.value }}}
							<# } else { #>
								<i class="{{ settings.btn_icon }}"></i>
							<# } #>
							<span>{{{ settings.btn_text }}}</span>
							<#
							if ( 'right' == settings.icon_align && ( btnIconHTML && btnIconHTML.rendered && ( ! settings.btn_icon || btnMigrated ) ) ) { #>
								{{{ btnIconHTML.value }}}
							<# } else { #>
								<i class="{{ settings.btn_icon }}"></i>
							<# } #>
						</a>

						<# if ( 'yes' == settings.secondary_btn && settings.s_btn_text ) { #>
							<a href="{{ settings.s_btn_link.url }}" class="zeus-button zeus-cta-s-btn elementor-button elementor-animation-{{ settings.button_animation }}">
								<#
								if ( 'left' == settings.s_icon_align && ( sbtnIconHTML && sbtnIconHTML.rendered && ( ! settings.s_btn_icon || sbtnMigrated ) ) ) { #>
									{{{ sbtnIconHTML.value }}}
								<# } else { #>
									<i class="{{ settings.s_btn_icon }}"></i>
								<# } #>
								<span>{{{ settings.s_btn_text }}}</span>
								<#
								if ( 'right' == settings.s_icon_align && ( sbtnIconHTML && sbtnIconHTML.rendered && ( ! settings.s_btn_icon || sbtnMigrated ) ) ) { #>
									{{{ sbtnIconHTML.value }}}
								<# } else { #>
									<i class="{{ settings.s_btn_icon }}"></i>
								<# } #>
							</a>
						<# } #>
					</div>
				<# } #>
			</div>
		</{{ wrapperTag }}>
		<?php
	}

}
