<?php
namespace ZeusElementor\Modules\WooSlider\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class WooSlider extends Widget_Base {

	private $query = null;

	public function get_name() {
		return 'zeus-woo-slider';
	}

	public function get_title() {
		return __( 'Woo - Slider', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-cart-full';
	}

	public function get_categories() {
		return array( 'zeus-elements' );
	}

	public function get_keywords() {
		return array(
			'woo',
			'woo carousel',
			'woo slider',
			'woocommerce',
			'woocommerce carousel',
			'woocommerce slider',
			'carousel',
			'slider',
			'zeus',
		);
	}

	public function get_script_depends() {
		return array( 'zeus-woo-slider' );
	}

	public function get_style_depends() {
		return array( 'zeus-woo-slider' );
	}

	public function get_query() {
		return $this->query;
	}

	protected function register_controls() {

		// Return if not activated
		if ( ! is_woocommerce_active() ) {

			$this->start_controls_section( 'warning', [
				'label'             => __( 'Warning!', 'zeus-elementor' ),
			] );

			$this->add_control( 'warning_text', [
				'type'              => Controls_Manager::RAW_HTML,
				'raw'               => __( '<strong>WooCommerce</strong> is not installed or activated on your site. Please install and activate it first to be able to use this widget.', 'zeus-elementor' ),
			] );

			$this->end_controls_section();

		} else {

			$this->start_controls_section(
				'section_woo_slider',
				array(
					'label' => __( 'Slider', 'zeus-elementor' ),
				)
			);

			$this->add_control(
				'carousel_effect',
				array(
					'label'       => __( 'Effect', 'zeus-elementor' ),
					'description' => __( 'Sets transition effect', 'zeus-elementor' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'slide',
					'options'     => array(
						'slide'     => __( 'Slide', 'zeus-elementor' ),
						'coverflow' => __( 'Coverflow', 'zeus-elementor' ),
					),
				)
			);

			$this->add_responsive_control(
				'slides_to_show',
				array(
					'label'          => __( 'Products To Display', 'zeus-elementor' ),
					'type'           => Controls_Manager::SLIDER,
					'default'        => array( 'size' => 4 ),
					'tablet_default' => array( 'size' => 2 ),
					'mobile_default' => array( 'size' => 1 ),
					'range'          => array(
						'px' => array(
							'min'  => 1,
							'max'  => 10,
							'step' => 1,
						),
					),
					'size_units'     => '',
					'condition'      => array(
						'carousel_effect' => array( 'slide', 'coverflow' ),
					),
				)
			);

			$this->add_responsive_control(
				'slides_to_scroll',
				array(
					'label'          => __( 'Products To Scroll', 'zeus-elementor' ),
					'type'           => Controls_Manager::SLIDER,
					'default'        => array( 'size' => 4 ),
					'tablet_default' => array( 'size' => 2 ),
					'mobile_default' => array( 'size' => 1 ),
					'range'          => array(
						'px' => array(
							'min'  => 1,
							'max'  => 10,
							'step' => 1,
						),
					),
					'size_units'     => '',
					'condition'      => array(
						'carousel_effect' => array( 'slide', 'coverflow' ),
					),
				)
			);

			$this->add_responsive_control(
				'margin',
				array(
					'label'      => __( 'Items Gap', 'zeus-elementor' ),
					'type'       => Controls_Manager::SLIDER,
					'default'    => array( 'size' => 10 ),
					'range'      => array(
						'px' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					),
					'size_units' => '',
					'condition'  => array(
						'carousel_effect' => array( 'slide', 'coverflow' ),
					),
				)
			);

			$this->add_control(
				'slider_speed',
				array(
					'label'       => __( 'Slider Speed', 'zeus-elementor' ),
					'description' => __( 'Duration of transition between slides (in ms)', 'zeus-elementor' ),
					'type'        => Controls_Manager::SLIDER,
					'default'     => array( 'size' => 400 ),
					'range'       => array(
						'px' => array(
							'min'  => 100,
							'max'  => 3000,
							'step' => 1,
						),
					),
					'size_units'  => '',
				)
			);

			$this->add_control(
				'autoplay',
				array(
					'label'        => __( 'Autoplay', 'zeus-elementor' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'yes',
					'label_on'     => __( 'Yes', 'zeus-elementor' ),
					'label_off'    => __( 'No', 'zeus-elementor' ),
					'return_value' => 'yes',
				)
			);

			$this->add_control(
				'autoplay_speed',
				array(
					'label'      => __( 'Autoplay Speed', 'zeus-elementor' ),
					'type'       => Controls_Manager::SLIDER,
					'default'    => array( 'size' => 2000 ),
					'range'      => array(
						'px' => array(
							'min'  => 500,
							'max'  => 5000,
							'step' => 1,
						),
					),
					'size_units' => '',
					'condition'  => array(
						'autoplay' => 'yes',
					),
				)
			);

			$this->add_control(
				'pause_on_hover',
				array(
					'label'        => __( 'Pause On Hover', 'zeus-elementor' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => '',
					'label_on'     => __( 'Yes', 'zeus-elementor' ),
					'label_off'    => __( 'No', 'zeus-elementor' ),
					'return_value' => 'yes',
					'condition'    => array(
						'autoplay' => 'yes',
					),
				)
			);

			$this->add_control(
				'infinite_loop',
				array(
					'label'        => __( 'Infinite Loop', 'zeus-elementor' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'yes',
					'label_on'     => __( 'Yes', 'zeus-elementor' ),
					'label_off'    => __( 'No', 'zeus-elementor' ),
					'return_value' => 'yes',
				)
			);

			$this->add_control(
				'navigation_heading',
				array(
					'label'     => __( 'Navigation', 'zeus-elementor' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				)
			);

			$this->add_control(
				'arrows',
				array(
					'label'        => __( 'Arrows', 'zeus-elementor' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'yes',
					'label_on'     => __( 'Yes', 'zeus-elementor' ),
					'label_off'    => __( 'No', 'zeus-elementor' ),
					'return_value' => 'yes',
				)
			);

			$this->add_control(
				'dots',
				array(
					'label'        => __( 'Dots', 'zeus-elementor' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'yes',
					'label_on'     => __( 'Yes', 'zeus-elementor' ),
					'label_off'    => __( 'No', 'zeus-elementor' ),
					'return_value' => 'yes',
				)
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_filter',
				array(
					'label' => __( 'Query', 'zeus-elementor' ),
					'tab'   => Controls_Manager::TAB_CONTENT,
				)
			);

			$this->add_control(
				'query_type',
				array(
					'label'   => __( 'Source', 'zeus-elementor' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'all',
					'options' => array(
						'all'    => __( 'All Products', 'zeus-elementor' ),
						'custom' => __( 'Custom Query', 'zeus-elementor' ),
						'manual' => __( 'Manual Selection', 'zeus-elementor' ),
					),
				)
			);

			$this->add_control(
				'category_filter_rule',
				array(
					'label'     => __( 'Cat Filter Rule', 'zeus-elementor' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'IN',
					'options'   => array(
						'IN'     => __( 'Match Categories', 'zeus-elementor' ),
						'NOT IN' => __( 'Exclude Categories', 'zeus-elementor' ),
					),
					'condition' => array(
						'query_type' => 'custom',
					),
				)
			);

			$this->add_control(
				'category_filter',
				array(
					'label'     => __( 'Select Categories', 'zeus-elementor' ),
					'type'      => Controls_Manager::SELECT2,
					'multiple'  => true,
					'default'   => '',
					'options'   => $this->get_product_categories(),
					'condition' => array(
						'query_type' => 'custom',
					),
				)
			);

			$this->add_control(
				'tag_filter_rule',
				array(
					'label'     => __( 'Tag Filter Rule', 'zeus-elementor' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'IN',
					'options'   => array(
						'IN'     => __( 'Match Tags', 'zeus-elementor' ),
						'NOT IN' => __( 'Exclude Tags', 'zeus-elementor' ),
					),
					'condition' => array(
						'query_type' => 'custom',
					),
				)
			);

			$this->add_control(
				'tag_filter',
				array(
					'label'     => __( 'Select Tags', 'zeus-elementor' ),
					'type'      => Controls_Manager::SELECT2,
					'multiple'  => true,
					'default'   => '',
					'options'   => $this->get_product_tags(),
					'condition' => array(
						'query_type' => 'custom',
					),
				)
			);

			$this->add_control(
				'offset',
				array(
					'label'       => __( 'Offset', 'zeus-elementor' ),
					'type'        => Controls_Manager::NUMBER,
					'default'     => 0,
					'description' => __( 'Number of post to displace or pass over.', 'zeus-elementor' ),
					'condition'   => array(
						'query_type' => 'custom',
					),
				)
			);

			$this->add_control(
				'query_manual_ids',
				array(
					'label'     => __( 'Select Products', 'zeus-elementor' ),
					'type'      => 'zeus-query-posts',
					'post_type' => 'product',
					'multiple'  => true,
					'condition' => array(
						'query_type' => 'manual',
					),
				)
			);

			$this->add_control(
				'query_exclude',
				array(
					'label'     => __( 'Exclude', 'zeus-elementor' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => array(
						'query_type!' => 'manual',
					),
				)
			);

			$this->add_control(
				'query_exclude_ids',
				array(
					'label'       => __( 'Select Products', 'zeus-elementor' ),
					'type'        => 'zeus-query-posts',
					'post_type'   => 'product',
					'multiple'    => true,
					'description' => __( 'Select products to exclude from the query.', 'zeus-elementor' ),
					'condition'   => array(
						'query_type!' => 'manual',
					),
				)
			);

			$this->add_control(
				'query_exclude_current',
				array(
					'label'        => __( 'Exclude Current Product', 'zeus-elementor' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Yes', 'zeus-elementor' ),
					'label_off'    => __( 'No', 'zeus-elementor' ),
					'return_value' => 'yes',
					'default'      => '',
					'description'  => __( 'Enable this option to remove current product from the query.', 'zeus-elementor' ),
					'condition'    => array(
						'query_type!' => 'manual',
					),
				)
			);

			$this->add_control(
				'posts_per_page',
				array(
					'label'   => __( 'Products Count', 'zeus-elementor' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => '8',
				)
			);

			$this->add_control(
				'advanced',
				array(
					'label' => __( 'Advanced', 'zeus-elementor' ),
					'type'  => Controls_Manager::HEADING,
				)
			);

			$this->add_control(
				'filter_by',
				array(
					'label'   => __( 'Filter By', 'zeus-elementor' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '',
					'options' => array(
						''         => __( 'None', 'zeus-elementor' ),
						'featured' => __( 'Featured', 'zeus-elementor' ),
						'sale'     => __( 'Sale', 'zeus-elementor' ),
					),
				)
			);

			$this->add_control(
				'orderby',
				array(
					'label'   => __( 'Order by', 'zeus-elementor' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'date',
					'options' => array(
						'date'       => __( 'Date', 'zeus-elementor' ),
						'title'      => __( 'Title', 'zeus-elementor' ),
						'price'      => __( 'Price', 'zeus-elementor' ),
						'popularity' => __( 'Popularity', 'zeus-elementor' ),
						'rating'     => __( 'Rating', 'zeus-elementor' ),
						'rand'       => __( 'Random', 'zeus-elementor' ),
						'menu_order' => __( 'Menu Order', 'zeus-elementor' ),
					),
				)
			);

			$this->add_control(
				'order',
				array(
					'label'   => __( 'Order', 'zeus-elementor' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'desc',
					'options' => array(
						'asc'  => __( 'ASC', 'zeus-elementor' ),
						'desc' => __( 'DESC', 'zeus-elementor' ),
					),
				)
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_arrows_style',
				array(
					'label' => __( 'Arrows', 'zeus-elementor' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				)
			);

			$this->add_control(
				'arrows_size',
				array(
					'label'     => __( 'Size', 'zeus-elementor' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => array( 'size' => 20 ),
					'range'     => array(
						'px' => array(
							'min'  => 10,
							'max'  => 100,
							'step' => 1,
						),
					),
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo-carousel .zeus-swiper-buttons svg' => 'width: {{SIZE}}{{UNIT}};',
					),
				)
			);

			$this->add_control(
				'arrows_color',
				array(
					'label'     => __( 'Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo-carousel .zeus-swiper-buttons svg' => 'fill: {{VALUE}};',
					),
				)
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_item_style',
				array(
					'label' => __( 'Products', 'zeus-elementor' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				)
			);

			$this->add_control(
				'item_background_color',
				array(
					'label'     => __( 'Background Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce li.product' => 'background-color: {{VALUE}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'        => 'item_border',
					'placeholder' => '1px',
					'selector'    => '{{WRAPPER}} .zeus-woo-carousel .woocommerce li.product',
					'separator'   => 'before',
				)
			);

			$this->add_control(
				'item_border_radius',
				array(
					'label'      => __( 'Border Radius', 'zeus-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce li.product' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'item_box_shadow',
					'selector' => '{{WRAPPER}} .zeus-woo-carousel .woocommerce li.product',
				)
			);

			$this->add_responsive_control(
				'item_padding',
				array(
					'label'      => __( 'Padding', 'zeus-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce li.product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'separator'  => 'before',
				)
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_image_style',
				array(
					'label' => __( 'Image', 'zeus-elementor' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				)
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'        => 'image_border',
					'placeholder' => '1px',
					'selector'    => '{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product a img',
				)
			);

			$this->add_control(
				'image_border_radius',
				array(
					'label'      => __( 'Border Radius', 'zeus-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; position: relative; overflow: hidden;',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'image_box_shadow',
					'selector' => '{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product a img',
				)
			);

			$this->add_responsive_control(
				'image_margin',
				array(
					'label'      => __( 'Margin', 'zeus-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product a img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_content_style',
				array(
					'label' => __( 'Content', 'zeus-elementor' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				)
			);

			$this->add_control(
				'title_heading',
				array(
					'label'     => __( 'Title', 'zeus-elementor' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				)
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'     => 'title_typography',
					'selector' => '{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product .woocommerce-loop-product__title',
				)
			);

			$this->start_controls_tabs( 'tabs_title_style' );

			$this->start_controls_tab(
				'tab_title_normal',
				array(
					'label' => __( 'Normal', 'zeus-elementor' ),
				)
			);

			$this->add_control(
				'title_color',
				array(
					'label'     => __( 'Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product .woocommerce-loop-product__title' => 'color: {{VALUE}};',
					),
				)
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_title_hover',
				array(
					'label' => __( 'Hover', 'zeus-elementor' ),
				)
			);

			$this->add_control(
				'title_hover_color',
				array(
					'label'     => __( 'Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product > a:hover .woocommerce-loop-product__title' => 'color: {{VALUE}};',
					),
				)
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_responsive_control(
				'title_margin',
				array(
					'label'      => __( 'Margin', 'zeus-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product .woocommerce-loop-product__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->add_control(
				'rating_heading',
				array(
					'label'     => __( 'Rating', 'zeus-elementor' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				)
			);

			$this->add_control(
				'rating_color',
				array(
					'label'     => esc_html__( 'Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce .star-rating::before' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'rating_fill_color',
				array(
					'label'     => esc_html__( 'Fill Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce .star-rating span' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'price_heading',
				array(
					'label'     => __( 'Price', 'zeus-elementor' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				)
			);

			$this->add_control(
				'price_color',
				array(
					'label'     => esc_html__( 'Price Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product .price' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'     => 'price_typography',
					'selector' => '{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product .price',
				)
			);

			$this->add_control(
				'del_price_color',
				array(
					'label'     => esc_html__( 'Del Price Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'separator' => 'before',
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product .price del .amount' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'     => 'del_price_typography',
					'selector' => '{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product .price del .amount',
				)
			);

			$this->add_responsive_control(
				'price_margin',
				array(
					'label'      => __( 'Margin', 'zeus-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'separator' => 'before',
					'selectors'  => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product .price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_button_style',
				array(
					'label' => __( 'Button', 'zeus-elementor' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				)
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'     => 'button_typography',
					'selector' => '{{WRAPPER}} .zeus-woo-carousel .woocommerce a.button',
				)
			);

			$this->start_controls_tabs( 'tabs_button_style' );

			$this->start_controls_tab(
				'tab_button_normal',
				array(
					'label' => __( 'Normal', 'zeus-elementor' ),
				)
			);

			$this->add_control(
				'button_background_color',
				array(
					'label'     => __( 'Background Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce a.button' => 'background-color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'button_text_color',
				array(
					'label'     => __( 'Text Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce a.button' => 'color: {{VALUE}};',
					),
				)
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_button_hover',
				array(
					'label' => __( 'Hover', 'zeus-elementor' ),
				)
			);

			$this->add_control(
				'button_hover_background_color',
				array(
					'label'     => __( 'Background Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce a.button:hover' => 'background-color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'button_hover_color',
				array(
					'label'     => __( 'Text Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce a.button:hover' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'button_hover_border_color',
				array(
					'label'     => __( 'Border Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce a.button:hover' => 'border-color: {{VALUE}};',
					),
				)
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'        => 'button_border',
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} .zeus-woo-carousel .woocommerce a.button',
					'separator'   => 'before',
				)
			);

			$this->add_control(
				'button_border_radius',
				array(
					'label'      => __( 'Border Radius', 'zeus-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce a.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'button_box_shadow',
					'selector' => '{{WRAPPER}} .zeus-woo-carousel .woocommerce a.button',
				)
			);

			$this->add_responsive_control(
				'button_padding',
				array(
					'label'      => __( 'Padding', 'zeus-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce a.button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'separator'  => 'before',
				)
			);

			$this->add_responsive_control(
				'button_margin',
				array(
					'label'      => __( 'Margin', 'zeus-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce a.button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_badge_style',
				array(
					'label' => __( 'Sale Badge', 'zeus-elementor' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				)
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'     => 'badge_typography',
					'selector' => '{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product .onsale',
				)
			);

			$this->add_control(
				'badge_background_color',
				array(
					'label'     => __( 'Background Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product .onsale' => 'background-color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'badge_color',
				array(
					'label'     => __( 'Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product .onsale' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'        => 'badge_border',
					'placeholder' => '1px',
					'selector'    => '{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product .onsale',
					'separator'   => 'before',
				)
			);

			$this->add_control(
				'badge_border_radius',
				array(
					'label'      => __( 'Border Radius', 'zeus-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product .onsale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'badge_box_shadow',
					'selector' => '{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product .onsale',
				)
			);

			$this->add_responsive_control(
				'badge_padding',
				array(
					'label'      => __( 'Padding', 'zeus-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product .onsale' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'separator'  => 'before',
				)
			);

			$this->add_responsive_control(
				'badge_margin',
				array(
					'label'      => __( 'Margin', 'zeus-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .zeus-woo-carousel .woocommerce ul.products li.product .onsale' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_pagination',
				array(
					'label' => __( 'Pagination', 'zeus-elementor' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				)
			);

			$this->add_control(
				'dots_size',
				array(
					'label'     => __( 'Size', 'zeus-elementor' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => array( 'size' => 8 ),
					'range'     => array(
						'px' => array(
							'min'  => 0,
							'max'  => 30,
							'step' => 1,
						),
					),
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo-carousel .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					),
				)
			);

			$this->add_control(
				'dots_active_color',
				array(
					'label'     => __( 'Active Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo-carousel .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'dots_color',
				array(
					'label'     => __( 'Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo-carousel .swiper-pagination-bullet' => 'background: {{VALUE}};',
					),
				)
			);

			$this->end_controls_section();

		}

	}

	protected function get_product_categories() {

		$product_cat = array();

		$cat_args = array(
			'orderby'    => 'name',
			'order'      => 'asc',
			'hide_empty' => false,
		);

		$product_categories = get_terms( 'product_cat', $cat_args );

		if ( ! empty( $product_categories ) ) {
			foreach ( $product_categories as $key => $category ) {
				$product_cat[ $category->slug ] = $category->name;
			}
		}

		return $product_cat;
	}

	protected function get_product_tags() {

		$product_tag = array();

		$tag_args = array(
			'orderby'    => 'name',
			'order'      => 'asc',
			'hide_empty' => false,
		);

		$product_tag = get_terms( 'product_tag', $tag_args );

		if ( ! empty( $product_tag ) ) {
			foreach ( $product_tag as $key => $tag ) {
				$product_tag[ $tag->slug ] = $tag->name;
			}
		}

		return $product_tag;
	}

	public function query_posts() {
		$settings = $this->get_settings_for_display();

		global $post;

		$query_args = array(
			'post_type'      => 'product',
			'posts_per_page' => $settings['posts_per_page'],
			'post__not_in'   => array(),
		);

		// Default ordering args.
		$ordering_args = WC()->query->get_catalog_ordering_args( $settings['orderby'], $settings['order'] );

		$query_args['orderby'] = $ordering_args['orderby'];
		$query_args['order']   = $ordering_args['order'];

		if ( 'sale' === $settings['filter_by'] ) {
			$query_args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
		} elseif ( 'featured' === $settings['filter_by'] ) {
			$product_visibility_term_ids = wc_get_product_visibility_term_ids();

			$query_args['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'term_taxonomy_id',
				'terms'    => $product_visibility_term_ids['featured'],
			);
		}

		if ( 'custom' === $settings['query_type'] ) {
			if ( ! empty( $settings['category_filter'] ) ) {
				$cat_operator = $settings['category_filter_rule'];

				$query_args['tax_query'][] = array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => $settings['category_filter'],
					'operator' => $cat_operator,
				);
			}

			if ( ! empty( $settings['tag_filter'] ) ) {
				$tag_operator = $settings['tag_filter_rule'];

				$query_args['tax_query'][] = array(
					'taxonomy' => 'product_tag',
					'field'    => 'slug',
					'terms'    => $settings['tag_filter'],
					'operator' => $tag_operator,
				);
			}

			if ( 0 < $settings['offset'] ) {
				$query_args['offset_to_fix'] = $settings['offset'];
			}
		}

		if ( 'manual' === $settings['query_type'] ) {
			$manual_ids             = $settings['query_manual_ids'];
			$query_args['post__in'] = $manual_ids;
		}

		if ( 'manual' !== $settings['query_type'] ) {
			if ( '' !== $settings['query_exclude_ids'] ) {
				$exclude_ids                = $settings['query_exclude_ids'];
				$query_args['post__not_in'] = $exclude_ids;
			}

			if ( 'yes' === $settings['query_exclude_current'] ) {
				$query_args['post__not_in'][] = $post->ID;
			}
		}

		$this->query = new \WP_Query( $query_args );
	}

	protected function render() {

		// Return if not activated
		if ( ! is_woocommerce_active() ) {
			return;
		}

		$settings = $this->get_settings_for_display();

		$this->query_posts();

		$query = $this->get_query();

		if ( ! $query->have_posts() ) {
			return;
		}

		global $woocommerce_loop, $product;

		$woocommerce_loop['columns'] = (int) $settings['slides_to_show'];

		// Data settings
		$this->add_render_attribute(
			'zeus-woo-slider',
			array(
				'class' => array(
					'zeus-woo-slider',
					'zeus-carousel-container',
					'swiper-container',
					'woocommerce columns-' . $woocommerce_loop['columns'],
				),
			)
		);

		if ( 'yes' === $settings['dots'] ) {
			$this->add_render_attribute( 'zeus-woo-slider', 'class', 'has-dots' );
		}

		$carousel_settings = array();

		if ( ! empty( $settings['slides_to_show']['size'] ) ) {
			$carousel_settings['items'] = $settings['slides_to_show']['size'];
		}

		if ( ! empty( $settings['slides_to_show_tablet']['size'] ) ) {
			$carousel_settings['items-tablet'] = $settings['slides_to_show_tablet']['size'];
		}

		if ( ! empty( $settings['slides_to_show_mobile']['size'] ) ) {
			$carousel_settings['items-mobile'] = $settings['slides_to_show_mobile']['size'];
		}

		if ( ! empty( $settings['slides_to_scroll']['size'] ) ) {
			$carousel_settings['slides'] = $settings['slides_to_scroll']['size'];
		}

		if ( ! empty( $settings['slides_to_scroll_tablet']['size'] ) ) {
			$carousel_settings['slides-tablet'] = $settings['slides_to_scroll_tablet']['size'];
		}

		if ( ! empty( $settings['slides_to_scroll_mobile']['size'] ) ) {
			$carousel_settings['slides-mobile'] = $settings['slides_to_scroll_mobile']['size'];
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

		$this->add_render_attribute( 'zeus-woo-slider', 'data-settings', wp_json_encode( $carousel_settings ) ); ?>

		<div class="zeus-woo-carousel swiper-container-wrap">

			<div <?php $this->print_render_attribute_string( 'zeus-woo-slider' ); ?>>

				<ul class="products zeus-row swiper-wrapper">

					<?php
					while ( $query->have_posts() ) :
						$query->the_post();
						?>
						<li <?php wc_product_class( 'swiper-slide', $product ); ?>>
							<?php
							do_action( 'woocommerce_before_shop_loop_item' );
							do_action( 'woocommerce_before_shop_loop_item_title' );
							do_action( 'woocommerce_shop_loop_item_title' );
							do_action( 'woocommerce_after_shop_loop_item_title' );
							do_action( 'woocommerce_after_shop_loop_item' );
							?>
						</li>
						<?php
					endwhile;
					?>

				</ul>

				<?php
				woocommerce_reset_loop();

				wp_reset_postdata();
				?>

			</div>

			<?php
			if ( 'yes' === $settings['arrows'] ) { ?>
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
			}
			?>

		</div>

		<?php
	}

	public function render_plain_content() {}

}
