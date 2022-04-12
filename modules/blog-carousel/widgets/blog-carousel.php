<?php
namespace ZeusElementor\Modules\BlogCarousel\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Blog_Carousel extends Widget_Base {

	public function get_name() {
		return 'zeus-blog-carousel';
	}

	public function get_title() {
		return __( 'Blog Carousel', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-newsletters';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'post',
			'post carousel',
			'post slider',
			'blog post',
			'blog',
			'carousel',
			'slider',
			'zeus',
		];
	}

	public function get_script_depends() {
		return [ 'zeus-blog-carousel', 'swiper' ];
	}

	public function get_style_depends() {
		return [ 'zeus-blog-carousel' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_blog_carousel',
			[
				'label'         => __( 'Carousel', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'carousel_effect',
			[
				'label'       => __( 'Effect', 'zeus-elementor' ),
				'description' => __( 'Sets transition effect', 'zeus-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'slide',
				'options'     => [
					'slide'     => __( 'Slide', 'zeus-elementor' ),
					'fade'      => __( 'Fade', 'zeus-elementor' ),
					'coverflow' => __( 'Coverflow', 'zeus-elementor' ),
				],
			]
		);

		$this->add_responsive_control(
			'items',
			[
				'label'          => __( 'Visible Items', 'zeus-elementor' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [ 'size' => 3 ],
				'tablet_default' => [ 'size' => 2 ],
				'mobile_default' => [ 'size' => 1 ],
				'range'          => [
					'px' => [
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					],
				],
				'size_units'     => '',
				'condition'      => [
					'carousel_effect' => [ 'slide', 'coverflow' ],
				],
			]
		);

		$this->add_responsive_control(
			'slides',
			[
				'label'          => __( 'Items By Slides', 'zeus-elementor' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [ 'size' => 3 ],
				'tablet_default' => [ 'size' => 2 ],
				'mobile_default' => [ 'size' => 1 ],
				'range'          => [
					'px' => [
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					],
				],
				'size_units'     => '',
				'condition'      => [
					'carousel_effect' => [ 'slide', 'coverflow' ],
				],
			]
		);

		$this->add_responsive_control(
			'margin',
			[
				'label'      => __( 'Items Gap', 'zeus-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [ 'size' => 10 ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'size_units' => '',
				'condition'  => [
					'carousel_effect' => [ 'slide', 'coverflow' ],
				],
			]
		);

		$this->add_control(
			'slider_speed',
			[
				'label'       => __( 'Slider Speed', 'zeus-elementor' ),
				'description' => __( 'Duration of transition between slides (in ms)', 'zeus-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [ 'size' => 400 ],
				'range'       => [
					'px' => [
						'min'  => 100,
						'max'  => 3000,
						'step' => 1,
					],
				],
				'size_units'  => '',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'        => __( 'Autoplay', 'zeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'zeus-elementor' ),
				'label_off'    => __( 'No', 'zeus-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'      => __( 'Autoplay Speed', 'zeus-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [ 'size' => 2000 ],
				'range'      => [
					'px' => [
						'min'  => 500,
						'max'  => 5000,
						'step' => 1,
					],
				],
				'size_units' => '',
				'condition'  => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'        => __( 'Pause On Hover', 'zeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Yes', 'zeus-elementor' ),
				'label_off'    => __( 'No', 'zeus-elementor' ),
				'return_value' => 'yes',
				'condition'    => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'infinite_loop',
			[
				'label'        => __( 'Infinite Loop', 'zeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'zeus-elementor' ),
				'label_off'    => __( 'No', 'zeus-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'navigation_heading',
			[
				'label'     => __( 'Navigation', 'zeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'arrows',
			[
				'label'        => __( 'Arrows', 'zeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'zeus-elementor' ),
				'label_off'    => __( 'No', 'zeus-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'dots',
			[
				'label'        => __( 'Dots', 'zeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'zeus-elementor' ),
				'label_off'    => __( 'No', 'zeus-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_query',
			[
				'label' => __( 'Query', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'post_type',
			[
				'label'         => __( 'Post Type', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'post',
				'options'       => zeus_get_available_post_types(),
			]
		);

		$this->add_control(
			'count',
			[
				'label'         => __( 'Post Per Page', 'zeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => '6',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'order',
			[
				'label'         => __( 'Order', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'DESC',
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
				'options'       => zeus_get_orderby_options(),
			]
		);

		$this->add_control(
			'include_categories',
			[
				'label'         => __( 'Include Categories', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT2,
				'label_block'   => true,
				'options'       => wp_list_pluck( get_terms( 'category' ), 'name', 'term_id' ),
				'multiple'      => true,
				'default'       => [],
				'condition'     => [
					'post_type' => 'post',
				],
			]
		);

		$this->add_control(
			'post__not_in',
			[
				'label'         => __( 'Exclude', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT2,
				'label_block'   => true,
				'options'       => zeus_get_post_list(),
				'multiple'      => true,
				'post_type'     => '',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_elements',
			[
				'label' => __( 'Elements', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'image_size',
			[
				'label'         => __( 'Image Size', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'medium',
				'options'       => zeus_get_img_sizes(),
			]
		);

		$this->add_control(
			'title',
			[
				'label'        => __( 'Title', 'zeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'zeus-elementor' ),
				'label_off'    => __( 'No', 'zeus-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'meta',
			[
				'label'        => __( 'Meta', 'zeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'zeus-elementor' ),
				'label_off'    => __( 'No', 'zeus-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'author',
			[
				'label'        => __( 'Author Meta', 'zeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'zeus-elementor' ),
				'label_off'    => __( 'No', 'zeus-elementor' ),
				'return_value' => 'yes',
				'condition'     => [
					'meta' => 'yes',
				],
			]
		);

		$this->add_control(
			'date',
			[
				'label'        => __( 'Date Meta', 'zeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'zeus-elementor' ),
				'label_off'    => __( 'No', 'zeus-elementor' ),
				'return_value' => 'yes',
				'condition'     => [
					'meta' => 'yes',
				],
			]
		);

		$this->add_control(
			'cat',
			[
				'label'        => __( 'Categories Meta', 'zeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'zeus-elementor' ),
				'label_off'    => __( 'No', 'zeus-elementor' ),
				'return_value' => 'yes',
				'condition'     => [
					'meta' => 'yes',
				],
			]
		);

		$this->add_control(
			'comments',
			[
				'label'        => __( 'Comments Meta', 'zeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'zeus-elementor' ),
				'label_off'    => __( 'No', 'zeus-elementor' ),
				'return_value' => 'yes',
				'condition'     => [
					'meta' => 'yes',
				],
			]
		);

		$this->add_control(
			'tags',
			[
				'label'        => __( 'Tags Meta', 'zeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'zeus-elementor' ),
				'label_off'    => __( 'No', 'zeus-elementor' ),
				'return_value' => 'yes',
				'condition'     => [
					'meta' => 'yes',
				],
			]
		);

		$this->add_control(
			'excerpt',
			[
				'label'        => __( 'Excerpt', 'zeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'zeus-elementor' ),
				'label_off'    => __( 'No', 'zeus-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label'         => __( 'Excerpt Length', 'zeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => '15',
			]
		);

		$this->add_control(
			'readmore_text',
			[
				'label'         => __( 'Learn More Text', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Learn More', 'zeus-elementor' ),
				'label_block'   => true,
			]
		);

		$this->add_control(
			'no_posts_text',
			array(
				'label'       => __( 'No Posts Text', 'zeus-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'zeus-elementor' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_arrows',
			[
				'label'         => __( 'Arrows', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'arrows_size',
			[
				'label'      => __( 'Size', 'zeus-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [ 'size' => 20 ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-carousel .zeus-swiper-buttons' => 'font-size: {{SIZE}}{{UNIT}};top: calc(50% - ({{SIZE}}{{UNIT}}/2));',
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-carousel .zeus-swiper-buttons' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_item',
			[
				'label'         => __( 'Item', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_background_color',
			array(
				'label'     => __( 'Background Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-carousel .zeus-carousel-entry-details' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'border',
				'label'         => __( 'Border', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-carousel .zeus-carousel-item',
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-carousel .zeus-carousel-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .zeus-carousel .zeus-carousel-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-carousel .zeus-carousel-item',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label'         => __( 'Title', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typo',
				'selector' => '{{WRAPPER}} .zeus-carousel .zeus-carousel-title',
			)
		);

		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'title_text_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-carousel .zeus-carousel-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-carousel .zeus-carousel-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_meta',
			[
				'label'         => __( 'Meta', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'meta_typo',
				'selector' => '{{WRAPPER}} .zeus-carousel .zeus-meta',
			)
		);

		$this->add_control(
			'meta_icons_color',
			[
				'label'         => __( 'Icons Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-carousel .zeus-meta li svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_meta_style' );

		$this->start_controls_tab(
			'tab_meta_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-carousel .zeus-meta, {{WRAPPER}} .zeus-carousel .zeus-meta li a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_meta_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'meta_hover_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-carousel .zeus-meta li a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_excerpt',
			[
				'label'         => __( 'Excerpt', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'excerpt_typo',
				'selector'      => '{{WRAPPER}} .zeus-carousel .zeus-carousel-entry-excerpt',
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-carousel .zeus-carousel-entry-excerpt' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[
				'label'         => __( 'Button', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'button_typography',
				'selector'      => '{{WRAPPER}} .zeus-carousel .readmore-btn a',
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
					'{{WRAPPER}} .zeus-carousel .readmore-btn a' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .zeus-carousel .readmore-btn a' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .zeus-carousel .readmore-btn a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-carousel .readmore-btn a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'         => __( 'Border Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-carousel .readmore-btn a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'button_border',
				'placeholder'   => '1px',
				'selector'      => '{{WRAPPER}} .zeus-carousel .readmore-btn a',
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
					'{{WRAPPER}} .zeus-carousel .readmore-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'button_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-carousel .readmore-btn a',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-carousel .readmore-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_pagination',
			[
				'label'         => __( 'Pagination', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label'      => __( 'Size', 'zeus-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [ 'size' => 8 ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-carousel .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dots_active_color',
			[
				'label'         => __( 'Active Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-carousel .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-carousel .swiper-pagination-bullet' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();

		// Post type
		$post_type = $settings['post_type'];
		$post_type = $post_type ? $post_type : 'post';

		$args = array(
			'post_type'         => $post_type,
			'posts_per_page'    => $settings['count'],
			'order'             => $settings['order'],
			'orderby'           => $settings['orderby'],
			'no_found_rows'     => true,
		);

		// Include categories
		$include = $settings['include_categories'];

		// Include category
		if ( ! empty( $include ) ) {
			$args['tax_query'] = [];

			$args['tax_query'][] = [
				'taxonomy'  => 'category',
				'field'     => 'term_id',
				'terms'     => $include,
			];

			if ( ! empty( $args['tax_query'] ) ) {
				$args['tax_query']['relation'] = 'AND';
			}
		}

		// Exclude
		if ( ! empty( $settings['post__not_in'] ) ) {
			$args['post__not_in'] = $settings['post__not_in'];
		}

		// Build the WordPress query
		$zeus_query = new \WP_Query( $args );

		$counter = 0;

		//Output posts
		if ( $zeus_query->have_posts() ) :

			// Vars
			$title      = $settings['title'];
			$meta       = $settings['meta'];
			$excerpt    = $settings['excerpt'];
			$readmore   = $settings['readmore_text'];

			// Image size
			$img_size       = $settings['image_size'];
			$img_size       = $img_size ? $img_size : 'medium';

			// Data settings
			$this->add_render_attribute(
				'zeus-carousel-container',
				[
					'class'           => [
						'swiper-container',
						'zeus-carousel-container',
					],
				]
			);

			if ( 'yes' === $settings['dots'] ) {
				$this->add_render_attribute( 'zeus-carousel-container', 'class', 'has-dots' );
			}

			$carousel_settings = [];

			if ( ! empty( $settings['items']['size'] ) ) {
				$carousel_settings['items'] = $settings['items']['size'];
			}

			if ( ! empty( $settings['items_tablet']['size'] ) ) {
				$carousel_settings['items-tablet'] = $settings['items_tablet']['size'];
			}

			if ( ! empty( $settings['items_mobile']['size'] ) ) {
				$carousel_settings['items-mobile'] = $settings['items_mobile']['size'];
			}

			if ( ! empty( $settings['slides']['size'] ) ) {
				$carousel_settings['slides'] = $settings['slides']['size'];
			}

			if ( ! empty( $settings['slides_tablet']['size'] ) ) {
				$carousel_settings['slides-tablet'] = $settings['slides_tablet']['size'];
			}

			if ( ! empty( $settings['slides_mobile']['size'] ) ) {
				$carousel_settings['slides-mobile'] = $settings['slides_mobile']['size'];
			}

			if ( ! empty( $settings['margin']['size'] ) ) {
				$carousel_settings['margin'] = $settings['margin']['size'];
			}
			if ( ! empty( $settings['margin_tablet']['size'] ) ) {
				$carousel_settings['margin-tablet'] = $settings['margin_tablet']['size'];
			}
			if ( ! empty( $settings['margin_mobile']['size'] ) ) {
				$carousel_settings['margin-mobile'] = $settings['margin_mobile']['size'];
			}

			if ( $settings['carousel_effect'] ) {
				$carousel_settings['effect'] = $settings['carousel_effect'];
			}

			if ( ! empty( $settings['slider_speed']['size'] ) ) {
				$carousel_settings['speed'] = $settings['slider_speed']['size'];
			}

			if ( 'yes' === $settings['autoplay'] && ! empty( $settings['autoplay_speed']['size'] ) ) {
				$carousel_settings['autoplay'] = $settings['autoplay_speed']['size'];
			} else {
				$carousel_settings['autoplay'] = '0';
			}

			if ( 'yes' === $settings['pause_on_hover'] ) {
				$carousel_settings['pause-on-hover'] = 'true';
			}

			if ( 'yes' === $settings['infinite_loop'] ) {
				$carousel_settings['loop'] = '1';
			}

			if ( 'yes' === $settings['arrows'] ) {
				$carousel_settings['arrows'] = '1';
			}

			if ( 'yes' === $settings['dots'] ) {
				$carousel_settings['dots'] = '1';
			}

			$this->add_render_attribute( 'zeus-carousel-container', 'data-settings', wp_json_encode( $carousel_settings ) ); ?>

			<div class="zeus-carousel zeus-carousel-blog swiper-container-wrap">

				<div <?php $this->print_render_attribute_string( 'zeus-carousel-container' ); ?>>
					<div class="swiper-wrapper">

						<?php
						// Start loop
						while ( $zeus_query->have_posts() ) :
							$zeus_query->the_post();

							// Create new post object.
							$post = new \stdClass();

							// Get post data
							$get_post = get_post();

							// Post Data
							$post->ID           = $get_post->ID;
							$post->permalink    = get_the_permalink( $post->ID );
							$post->title        = $get_post->post_title;

							// Only display carousel item if there is content to show
							if ( has_post_thumbnail()
								|| 'yes' === $title
								|| 'yes' === $meta
								|| 'yes' === $excerpt
							) { ?>

								<div class="zeus-carousel-slide swiper-slide">
									<div class="zeus-carousel-item">
										<?php
										if ( has_post_thumbnail() ) { ?>
											<div class="zeus-carousel-entry-media">
												<a href="<?php echo esc_url( $post->permalink ); ?>" title="<?php the_title(); ?>" class="zeus-carousel-entry-img">
													<?php
													// Display post thumbnail
													the_post_thumbnail( $img_size, array(
														'alt'       => get_the_title(),
														'itemprop'  => 'image',
													) ); ?>
												</a>
											</div><!-- .zeus-carousel-entry-media -->
											<?php
										}

										// Open details element if the title or excerpt are true
										if ( 'yes' === $title
											|| 'yes' === $meta
											|| 'yes' === $excerpt
										) { ?>

											<div class="zeus-carousel-entry-details">
												<?php
												// Display title if $title is true and there is a post title
												if ( 'yes' === $title ) {
													?>
													<h2 class="zeus-carousel-title">
														<a href="<?php echo esc_url( $post->permalink ); ?>" title="<?php the_title(); ?>"><?php echo esc_html( $post->title ); ?></a>
													</h2>
													<?php
												}

												// Display meta
												if ( 'yes' === $meta ) {
													?>
													<ul class="zeus-meta">
														<?php
														if ( 'yes' === $settings['author'] ) { ?>
															<li class="zeus-meta-author" itemprop="name">
																<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><path d="M256,288.389c-153.837,0-238.56,72.776-238.56,204.925c0,10.321,8.365,18.686,18.686,18.686h439.747 c10.321,0,18.686-8.365,18.686-18.686C494.56,361.172,409.837,288.389,256,288.389z M55.492,474.628 c7.35-98.806,74.713-148.866,200.508-148.866s193.159,50.06,200.515,148.866H55.492z"/><path d="M256,0c-70.665,0-123.951,54.358-123.951,126.437c0,74.19,55.604,134.54,123.951,134.54s123.951-60.35,123.951-134.534 C379.951,54.358,326.665,0,256,0z M256,223.611c-47.743,0-86.579-43.589-86.579-97.168c0-51.611,36.413-89.071,86.579-89.071 c49.363,0,86.579,38.288,86.579,89.071C342.579,180.022,303.743,223.611,256,223.611z"/></svg>
																<?php echo esc_attr( the_author_posts_link() ); ?>
															</li>
															<?php
														}

														if ( 'yes' === $settings['date'] ) { ?>
															<li class="zeus-meta-date" itemprop="datePublished" pubdate>
																<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><path d="M256,0C114.845,0,0,114.839,0,256s114.845,256,256,256c141.161,0,256-114.839,256-256S397.155,0,256,0z M256,474.628 C135.45,474.628,37.372,376.55,37.372,256S135.45,37.372,256,37.372s218.628,98.077,218.628,218.622 C474.628,376.55,376.55,474.628,256,474.628z"/><path d="M343.202,256h-80.973V143.883c0-10.321-8.365-18.686-18.686-18.686s-18.686,8.365-18.686,18.686v130.803 c0,10.321,8.365,18.686,18.686,18.686h99.659c10.321,0,18.686-8.365,18.686-18.686S353.523,256,343.202,256z"/></svg>
																<?php echo esc_attr( get_the_date( 'M j, Y' ) ); ?>
															</li>
															<?php
														}

														if ( 'yes' === $settings['cat'] ) { ?>
															<li class="zeus-meta-cat">
																<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><path d="M480,105.6H244.909L182.08,41.011c-3.616-3.712-8.576-5.811-13.76-5.811H32c-17.645,0-32,14.355-32,32v377.6 c0,17.645,14.355,32,32,32h448c17.645,0,32-14.355,32-32V137.6C512,119.955,497.645,105.6,480,105.6z M473.6,438.4H38.4V73.6 h121.811l62.829,64.589c3.616,3.712,8.576,5.811,13.76,5.811h236.8V438.4z"/></svg>
																<?php the_category( ' / ', get_the_ID() ); ?>
															</li>
															<?php
														}

														if ( 'yes' === $settings['comments'] && comments_open() && ! post_password_required() ) { ?>
															<li class="zeus-meta-comments">
																<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><path d="M345.154,160.478H166.846c-10.552,0-19.104,8.552-19.104,19.104s8.552,19.104,19.104,19.104h178.308 c10.552,0,19.104-8.552,19.104-19.104S355.706,160.478,345.154,160.478z"/><path d="M345.154,236.896H166.846c-10.552,0-19.104,8.552-19.104,19.104s8.552,19.104,19.104,19.104h178.308 c10.552,0,19.104-8.552,19.104-19.104S355.706,236.896,345.154,236.896z"/><path d="M345.154,313.313H166.846c-10.552,0-19.104,8.552-19.104,19.104s8.552,19.104,19.104,19.104h178.308 c10.552,0,19.104-8.552,19.104-19.104S355.706,313.313,345.154,313.313z"/><path d="M256,0C117.302,0,4.458,112.844,4.458,251.542c0,31.516,5.795,62.351,17.251,91.708 c8.903,22.55,20.697,43.265,35.133,61.746L22.55,485.4c-2.751,6.445-1.751,13.87,2.598,19.359C28.81,509.383,34.35,512,40.119,512 c1.089,0,2.191-0.089,3.286-0.287l129.917-22.671c26.02,9.323,53.805,14.042,82.678,14.042 c138.699,0,251.542-112.844,251.542-251.542S394.699,0,256,0z M256,464.876c-26.039,0-50.945-4.496-74.023-13.367 c-3.229-1.242-6.737-1.592-10.138-0.987L71.495,468.034l25.04-58.708c2.866-6.718,1.649-14.488-3.133-20.009 c-15.143-17.474-27.307-37.693-36.12-60.026c-9.699-24.842-14.615-51.003-14.615-77.749C42.667,133.91,138.367,38.209,256,38.209 s213.333,95.701,213.333,213.333S373.633,464.876,256,464.876z"/></svg>
																<?php
																comments_popup_link(
																	esc_html__( '0 Comments', 'zeus-elementor' ),
																	esc_html__( '1 Comment', 'zeus-elementor' ),
																	esc_html__( '% Comments', 'zeus-elementor' ),
																	'comments-link'
																); ?>
															</li>
															<?php
														}

														if ( 'yes' === $settings['tags'] ) {
															$term_separator = apply_filters( 'zeus_elementor_term_separator', _x( ', ', 'Used between list items, there is a space after the comma.', 'zeus-elementor' ), 'tags' );
															$tags_list = get_the_tag_list( '', $term_separator );
			
															if ( $tags_list ) {
																echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
																	'zeus_elementor_tag_list_output',
																	sprintf(
																		'<li class="zeus-meta-tags">
																		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"><path d="M444.07,67.946H302.344c-13.613,0-26.409,5.301-36.034,14.927L65.872,283.312c-9.626,9.625-14.927,22.422-14.927,36.034 s5.301,26.409,14.927,36.034L207.596,497.1c9.934,9.934,22.984,14.9,36.033,14.9s26.099-4.967,36.033-14.902l200.44-200.44 c9.626-9.626,14.927-22.422,14.927-36.034v-141.72C495.029,90.806,472.169,67.946,444.07,67.946z M376.124,237.81 c-28.099,0-50.959-22.86-50.959-50.959s22.86-50.959,50.959-50.959s50.959,22.86,50.959,50.959S404.223,237.81,376.124,237.81z"/><path d="M410.097,0H268.371c-13.613,0-26.409,5.301-36.034,14.927L31.899,215.366c-9.626,9.625-14.927,22.422-14.927,36.034 c0,10.647,3.256,20.788,9.276,29.31c3.999-7.81,9.219-15.04,15.603-21.422L242.288,58.849 c16.041-16.041,37.369-24.876,60.056-24.876h141.724c4.942,0,9.78,0.448,14.493,1.263C451.918,14.81,432.709,0,410.097,0z"/></svg>
																		<span class="screen-reader-text">%1$s</span>
																		%2$s
																		</li> ',
																		esc_html_x( 'Tags', 'Used before tag names.', 'zeus-elementor' ),
																		$tags_list
																	)
																);
															}
														}
														?>
													</ul>

													<?php
												}

												// Display excerpt if $excerpt is true
												if ( 'yes' === $excerpt ) { ?>
													<div class="zeus-carousel-entry-excerpt">
														<?php zeus_excerpt( $settings['excerpt_length'] ); ?>
													</div><!-- .zeus-carousel-entry-excerpt -->
													<?php
												}

												// Display read more
												if ( '' !== $readmore ) { ?>
													<div class="zeus-carousel-entry-readmore readmore-btn">
														<a href="<?php echo esc_url( $post->permalink ); ?>"><?php echo esc_attr( $readmore ); ?></a>
													</div><!-- .zeus-carousel-entry-excerpt -->
												<?php } ?>
											</div><!-- .zeus-carousel-entry-details -->
										<?php } ?>
									</div>
								</div>
								<?php
							}

							$counter++;

						endwhile;

						// Reset the post data to prevent conflicts with WP globals
						wp_reset_postdata(); ?>

					</div>
				</div>

				<?php
				if ( 'yes' === $settings['arrows'] ) {
					?>
					<div class="swiper-button-next zeus-swiper-buttons swiper-button-next-<?php echo esc_attr( $this->get_id() ); ?>">
						<?php
						if ( is_RTL() ) {
							?>
							<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492 492" xml:space="preserve"><path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12 C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084 c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864 l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"/></svg>
							<?php
						} else {
							?>
							<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492.004 492.004" xml:space="preserve"><path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12 c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028 c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265 c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/></svg>
							<?php
						}
						?>
					</div>
					<div class="swiper-button-prev zeus-swiper-buttons swiper-button-prev-<?php echo esc_attr( $this->get_id() ); ?>">
						<?php
						if ( is_RTL() ) {
							?>
							<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492.004 492.004" xml:space="preserve"><path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12 c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028 c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265 c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/></svg>
							<?php
						} else {
							?>
							<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492 492" xml:space="preserve"><path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12 C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084 c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864 l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"/></svg>
							<?php
						}
						?>
					</div>
					<?php
				}

				if ( 'yes' === $settings['dots'] ) {
					?>
					<div class="swiper-pagination swiper-pagination-<?php echo esc_attr( $this->get_id() ); ?>"></div>
					<?php
				} ?>

			</div><!-- .zeus-carousel -->
			<?php
		else :
			$no_posts_text = $settings['no_posts_text'];
			if ( '' !== $no_posts_text ) {
				?>
				<p><?php echo esc_attr( $no_posts_text ); ?></p>
				<?php
			}
		endif;
	}
}
