<?php
namespace ZeusElementor\Modules\Timeline\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Timeline extends Widget_Base {

	public function get_name() {
		return 'zeus-timeline';
	}

	public function get_title() {
		return __( 'Timeline', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-pen-drawing';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'timeline',
			'post',
			'zeus',
		];
	}

	public function get_style_depends() {
		return [ 'zeus-timeline' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_timeline_layout',
			[
				'label'         => __( 'Layout', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'source',
			[
				'label'         => __( 'Source', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'post',
				'options'       => [
					'post'      => __( 'Post', 'zeus-elementor' ),
					'custom'    => __( 'Custom Content', 'zeus-elementor' ),
				],
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
				],
				'default'       => 'center',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_query',
			[
				'label'         => __( 'Query', 'zeus-elementor' ),
				'condition'     => [
					'source' => 'post',
				],
			]
		);

		$this->add_control(
			'query_source',
			[
				'label'         => __( 'Source', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => '',
				'options'       => [
					''          => __( 'Show All', 'zeus-elementor' ),
					'manual'    => __( 'Manual Selection', 'zeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'categories',
			[
				'label'         => __( 'Categories', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT2,
				'default'       => '0',
				'multiple'      => true,
				'options'       => $this->get_available_categories(),
				'condition'     => [
					'query_source' => 'manual',
				],
			]
		);

		$this->add_control(
			'number_posts',
			[
				'label'         => __( 'Number of Posts', 'zeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => '4',
			]
		);

		$this->add_control(
			'order',
			[
				'label'         => __( 'Order', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => '',
				'options'       => [
					''          => __( 'Default', 'zeus-elementor' ),
					'DESC'      => __( 'DESC', 'zeus-elementor' ),
					'ASC'       => __( 'ASC', 'zeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'         => __( 'Order By', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'date',
				'options'       => [
					'date'          => __( 'Date', 'zeus-elementor' ),
					'title'         => __( 'Title', 'zeus-elementor' ),
					'category'      => __( 'Category', 'zeus-elementor' ),
					'rand'          => __( 'Random', 'zeus-elementor' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_custom',
			[
				'label'         => __( 'Custom Content', 'zeus-elementor' ),
				'condition'     => [
					'source' => 'custom',
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'timeline_title',
			[
				'name' => 'timeline_title',
				'label' => __( 'Title', 'zeus-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Your timeline title here', 'zeus-elementor' ),
				'label_block' => 'true',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'timeline_date',
			[
				'name' => 'timeline_date',
				'label' => __( 'Date', 'zeus-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '13 October 2018', 'zeus-elementor' ),
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'timeline_image',
			[
				'name' => 'timeline_image',
				'label' => __( 'Image', 'zeus-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'timeline_text',
			[
				'name' => 'timeline_text',
				'label' => __( 'Content', 'zeus-elementor' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'zeus-elementor' ),
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'timeline_link',
			[
				'name' => 'timeline_link',
				'label' => __( 'Item Link', 'zeus-elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'https://your-link.com', 'zeus-elementor' ),
				'default' => '#',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'timeline_icon',
			[
				'name' => 'timeline_icon',
				'label' => __( 'Timeline Icon', 'zeus-elementor' ),
				'type' => Controls_Manager::ICONS,
				'default'       => [
					'value'   => 'fas fa-file-alt',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'items',
			[
				'label'         => __( 'List Items', 'zeus-elementor' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'default'       => [
					[
						'timeline_title' => __( 'Your timeline title here #1', 'zeus-elementor' ),
						'timeline_text' => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'zeus-elementor' ),
						'timeline_icon'  => 'fas fa-file-alt',
					],
					[
						'timeline_title' => __( 'Your timeline title here #2', 'zeus-elementor' ),
						'timeline_text' => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'zeus-elementor' ),
						'timeline_icon'  => 'fas fa-file-alt',
					],
					[
						'timeline_title' => __( 'Your timeline title here #3', 'zeus-elementor' ),
						'timeline_text' => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'zeus-elementor' ),
						'timeline_icon'  => 'fas fa-file-alt',
					],
					[
						'timeline_title' => __( 'Your timeline title here #4', 'zeus-elementor' ),
						'timeline_text' => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'zeus-elementor' ),
						'timeline_icon'  => 'fas fa-file-alt',
					],
				],
				'title_field'   => '{{{ timeline_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional',
			[
				'label'         => __( 'Additional Options', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'show_image',
			[
				'label'         => __( 'Image', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'show_title',
			[
				'label'         => __( 'Title', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'show_meta',
			[
				'label'         => __( 'Meta', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label'         => __( 'Excerpt', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label'         => __( 'Excerpt Length', 'zeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => '20',
				'condition'     => [
					'show_excerpt' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_item_style',
			[
				'label'         => __( 'Item', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'timeline_item_bg',
			[
				'label'         => esc_html__( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-item-main' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'timeline_item_border',
				'selector'      => '{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-item-main',
			]
		);

		$this->add_control(
			'timeline_item_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-item-main' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'timeline_item_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-item-main',
			]
		);

		$this->add_responsive_control(
			'timeline_item_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-item-main' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			[
				'label'         => __( 'Image', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'timeline_image_max_width',
			[
				'label'         => __( 'Max Width', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px', '%' ],
				'range' => [
					'px' => [
						'max' => 1200,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-thumbnail' => 'width: {{SIZE}}{{UNIT}}; margin-left: auto; margin-right: auto;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'timeline_image_border',
				'selector'      => '{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-thumbnail',
			]
		);

		$this->add_control(
			'timeline_image_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'timeline_image_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-thumbnail',
			]
		);

		$this->add_responsive_control(
			'timeline_image_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'timeline_title_typography',
				'selector'      => '{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-title',
			]
		);

		$this->start_controls_tabs( 'tabs_timeline_title_style' );

		$this->start_controls_tab(
			'tab_timeline_title_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'timeline_title_color',
			[
				'label'         => esc_html__( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_timeline_title_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'timeline_title_hover_color',
			[
				'label'         => esc_html__( 'Hover Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'timeline_title_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_meta_style',
			[
				'label'         => __( 'Meta', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'timeline_meta_typography',
				'selector'      => '{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-meta',
			]
		);

		$this->start_controls_tabs( 'tabs_timeline_meta_style' );

		$this->start_controls_tab(
			'tab_timeline_meta_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'timeline_meta_color',
			[
				'label'         => esc_html__( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-meta, {{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-meta a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_timeline_meta_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'timeline_meta_hover_color',
			[
				'label'         => esc_html__( 'Hover Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-meta a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'timeline_meta_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_excerpt_style',
			[
				'label'         => __( 'Excerpt', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'timeline_excerpt_typography',
				'selector'      => '{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-excerpt',
			]
		);

		$this->add_control(
			'timeline_excerpt_color',
			[
				'label'         => esc_html__( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-excerpt' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'timeline_excerpt_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_timeline_icon_style',
			[
				'label'         => __( 'Icon', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'timeline_icon_background_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-icon span' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'timeline_icon_border',
				'placeholder'   => '1px',
				'selector'      => '{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-icon span',
				'separator'     => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'timeline_icon_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-icon span',
			]
		);

		$this->add_responsive_control(
			'timeline_icon_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-icon span' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'timeline_icon_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 35,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-icon span' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_timeline_line_style',
			[
				'label'         => __( 'Line', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'timeline_line_width',
			[
				'label'         => __( 'Width', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-line span' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'timeline_line_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-item-wrap .zeus-timeline-line span' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_timeline_date_style',
			[
				'label'         => __( 'Date', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'timeline_date_typography',
				'selector'      => '{{WRAPPER}} .zeus-timeline .zeus-timeline-date span',
			]
		);

		$this->add_control(
			'timeline_date_bg',
			[
				'label'         => esc_html__( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-date span' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'timeline_date_color',
			[
				'label'         => esc_html__( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-date span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'timeline_date_border',
				'selector'      => '{{WRAPPER}} .zeus-timeline .zeus-timeline-date span',
			]
		);

		$this->add_control(
			'timeline_date_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-date span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'timeline_date_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-timeline .zeus-timeline-date span',
			]
		);

		$this->add_responsive_control(
			'timeline_date_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-timeline .zeus-timeline-date span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function get_available_categories() {

		$categories = get_terms( 'category' );

		$result = array( __( '-- Select --', 'zeus-elementor' ) );

		foreach ( $categories as $category ) {
			$result[ $category->slug ] = $category->name;
		}

		return $result;
	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$source     = $settings['source'];
		$align      = $settings['align'];
		$items      = $settings['items'];

		$this->add_render_attribute( 'wrap', 'class', [
			'zeus-timeline',
			'zeus-timeline-' . $align,
		] );

		$this->add_render_attribute( 'inner', 'class', 'zeus-timeline-inner' );

		// If posts
		if ( 'post' === $source ) {
			global $post;

			$args = array(
				'posts_per_page' => $settings['number_posts'],
				'order'          => $settings['order'],
				'orderby'        => $settings['orderby'],
				'post_status'    => 'publish',
			);

			if ( 'manual' === $settings['query_source'] ) {
				$args['tax_query'][] = array(
					'taxonomy' => 'category',
					'field'    => 'slug',
					'terms'    => $settings['categories'],
				);
			}

			$query = new \WP_Query( $args );

			if ( $query->have_posts() ) : ?> 

				<div <?php $this->print_render_attribute_string( 'wrap' ); ?>>
					<div <?php $this->print_render_attribute_string( 'inner' ); ?>>

						<?php
						$count = 0;

						while ( $query->have_posts() ) :
							$query->the_post();
							$count++;

							$thumbnail      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
							$post_format    = get_post_format() ? '' : 'standard';
							$category       = '';
							$position       = ( 0 === $count % 2 ) ? 'right' : 'left';
							$date_class     = ( 'center' === $align ) ? 'hidden' : 'normal';

							if ( 0 === $count % 2
								&& 'center' === $align ) { ?>
								<div class="zeus-timeline-item">
									<div class="zeus-timeline-date zeus-timeline-date-right"><span><?php echo esc_attr( get_the_date( 'd F Y' ) ); ?></span></div>
								</div>
								<?php
							} ?>

							<div class="zeus-timeline-item zeus-timeline-item-<?php echo esc_attr( $position ); ?>">
								<div class="zeus-timeline-item-wrap">

									<div class="zeus-timeline-line<?php echo $query->current_post + 1 === $query->post_count ? ' zeus-last-line' : ''; ?>"><span></span></div>

									<div class="zeus-timeline-item-container">
										<div class="zeus-timeline-icon zeus-timeline-post-icon zeus-post-format-<?php echo esc_attr( $post_format ); ?>"><span></span></div>

										<div class="zeus-timeline-item-main">
											<span class="zeus-timeline-arrow"></span>

											<?php
											if ( 'yes' === $settings['show_image']
												&& isset( $thumbnail[0] ) ) { ?>
												<div class="zeus-timeline-thumbnail">
													<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
														<img src="<?php echo esc_url( $thumbnail[0] ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
													</a>
												</div>
												<?php
											} ?>

											<div class="zeus-timeline-desc">
												<?php
												if ( 'yes' === $settings['show_title'] ) { ?>
													<h4 class="zeus-timeline-title">
														<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
													</h4>
													<?php
												}

												if ( 'yes' === $settings['show_meta'] ) { ?>
													<ul class="zeus-timeline-meta">
														<li class="zeus-timeline-meta-date zeus-timeline-<?php echo esc_attr( $date_class ); ?>"><?php echo esc_attr( get_the_date( 'd F Y' ) ); ?></li>
														<li><?php echo wp_kses_post( get_the_category_list( ', ' ) ); ?></li>
													</ul>
													<?php
												}

												if ( 'yes' === $settings['show_excerpt'] ) { ?>
													<div class="zeus-timeline-excerpt"><?php do_shortcode( the_excerpt() ); ?></div>
													<?php
												} ?>
											</div>
										</div>
									</div>
								</div>
							</div>

							<?php
							if ( 1 === $count % 2
								&& ( 'center' === $align ) ) { ?>
								<?php
								$position = ( 1 === $count % 2 ) ? 'right' : 'left'; ?>
								<div class="zeus-timeline-item">
									<div class="zeus-timeline-date"><span><?php echo esc_attr( get_the_date( 'd F Y' ) ); ?></span></div>
								</div>
								<?php
							}
						endwhile; ?>
					</div>
				</div>
				<?php
				wp_reset_postdata();
			endif;
		} elseif ( 'custom' === $source ) { ?>

			<div <?php $this->print_render_attribute_string( 'wrap' ); ?>>
				<div <?php $this->print_render_attribute_string( 'inner' ); ?>>

					<?php
					$count = 0;
					$i = 1;

					foreach ( $items as $item ) :
						$count++;

						$position       = ( 0 === $count % 2 ) ? 'right' : 'left';
						$date_class     = ( 'center' === $align ) ? 'hidden' : '';
						$image_url      = wp_get_attachment_image_src( $item['timeline_image']['id'], 'full' );
						$image_url      = ( '' !== $image_url ) ? $image_url[0] : $item['timeline_image']['url'];

						if ( 0 === $count % 2
							&& 'center' === $align ) { ?>
							<div class="zeus-timeline-item">
								<div class="zeus-timeline-date zeus-timeline-date-right"><span><?php echo esc_attr( $item['timeline_date'] ); ?></span></div>
							</div>
							<?php
						} ?>

						<div class="zeus-timeline-item zeus-timeline-item-<?php echo esc_attr( $position ); ?>">
							<div class="zeus-timeline-item-wrap">

								<div class="zeus-timeline-line"><span></span></div>

								<div class="zeus-timeline-item-container">
									<div class="zeus-timeline-icon zeus-timeline-custom-icon"><span><?php \Elementor\Icons_Manager::render_icon( $item['timeline_icon'], [ 'aria-hidden' => 'true' ] ); ?></span></div>

									<div class="zeus-timeline-item-main">
										<span class="zeus-timeline-arrow"></span>

										<?php
										if ( 'yes' === $settings['show_image'] ) { ?>
											<div class="zeus-timeline-thumbnail">
												<a href="<?php echo esc_url( $item['timeline_link'] ); ?>" title="<?php echo esc_attr( $item['timeline_title'] ); ?>">
													<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $item['timeline_title'] ); ?>">
												</a>
											</div>
											<?php
										} ?>

										<div class="zeus-timeline-desc">
											<?php
											if ( 'yes' === $settings['show_title'] ) { ?>
												<h4 class="zeus-timeline-title">
													<a href="<?php echo esc_url( $item['timeline_link'] ); ?>" title="<?php echo esc_attr( $item['timeline_title'] ); ?>"><?php echo esc_html( $item['timeline_title'] ); ?></a>
												</h4>
												<?php
											}

											if ( 'yes' === $settings['show_meta'] ) { ?>
												<ul class="zeus-timeline-meta zeus-timeline-<?php echo esc_attr( $date_class ); ?>">
													<li><?php echo esc_attr( $item['timeline_date'] ); ?></li>
												</ul>
												<?php
											}

											if ( 'yes' === $settings['show_excerpt'] ) { ?>
												<div class="zeus-timeline-excerpt"><?php echo do_shortcode( $item['timeline_text'] ); ?></div>
												<?php
											} ?>
										</div>
									</div>
								</div>

							</div>
						</div>

						<?php
						if ( 1 === $count % 2
							&& ( 'center' === $align ) ) { ?>
							<?php
							$position = ( 1 === $count % 2 ) ? 'right' : 'left'; ?>
							<div class="zeus-timeline-item">
								<div class="zeus-timeline-date"><span><?php echo esc_attr( $item['timeline_date'] ); ?></span></div>
							</div>
							<?php
						}

					endforeach; ?>

				</div>
			</div>

			<?php
		}

	}

}
