<?php
namespace ZeusElementor\Modules\WooProducts\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class WooProducts extends Widget_Base {

	private $query = null;

	public function get_name() {
		return 'zeus-woo-products';
	}

	public function get_title() {
		return __( 'Woo - Products', 'zeus-elementor' );
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
			'woocommerce',
			'ecommerce',
			'product',
			'products',
			'zeus',
		);
	}

	public function get_style_depends() {
		return [ 'zeus-woo-products' ];
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
				'section_woo_products',
				array(
					'label' => __( 'Products', 'zeus-elementor' ),
				)
			);

			$this->add_responsive_control(
				'columns',
				[
					'label'          => __( 'Columns', 'zeus-elementor' ),
					'type'           => Controls_Manager::SELECT,
					'default'        => '4',
					'tablet_default' => '2',
					'mobile_default' => '1',
					'options' => array(
						'1'  => '1',
						'2'  => '2',
						'3'  => '3',
						'4'  => '4',
						'5'  => '5',
						'6'  => '6',
						'7'  => '7',
						'8'  => '8',
						'9'  => '9',
						'10' => '10',
					),
					'selectors'     => [
						'{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product' => 'width: calc( 100% / {{VALUE}} - 30px );',
					],
				]
			);

			$this->add_control(
				'posts_per_page',
				array(
					'label'   => __( 'Products Count', 'zeus-elementor' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => '4',
				)
			);

			$this->add_control(
				'pagination',
				array(
					'label'   => __( 'Pagination', 'zeus-elementor' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => '',
				)
			);

			$this->add_control(
				'pagination_position',
				array(
					'label'     => __( 'Pagination Position', 'zeus-elementor' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => array(
						'left'   => array(
							'title' => __( 'Left', 'zeus-elementor' ),
							'icon'  => 'eicon-text-align-left',
						),
						'center' => array(
							'title' => __( 'Center', 'zeus-elementor' ),
							'icon'  => 'eicon-text-align-center',
						),
						'right'  => array(
							'title' => __( 'Right', 'zeus-elementor' ),
							'icon'  => 'eicon-text-align-right',
						),
					),
					'selectors' => array(
						'{{WRAPPER}} ul.page-numbers' => 'text-align: {{VALUE}};',
					),
					'default'   => 'center',
					'condition' => array(
						'pagination' => 'yes',
					),
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
						'{{WRAPPER}} .zeus-woo.woocommerce li.product' => 'background-color: {{VALUE}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'        => 'item_border',
					'placeholder' => '1px',
					'selector'    => '{{WRAPPER}} .zeus-woo.woocommerce li.product',
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
						'{{WRAPPER}} .zeus-woo.woocommerce li.product' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'item_box_shadow',
					'selector' => '{{WRAPPER}} .zeus-woo.woocommerce li.product',
				)
			);

			$this->add_responsive_control(
				'item_padding',
				array(
					'label'      => __( 'Padding', 'zeus-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .zeus-woo.woocommerce li.product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'selector'    => '{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product a img',
				)
			);

			$this->add_control(
				'image_border_radius',
				array(
					'label'      => __( 'Border Radius', 'zeus-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; position: relative; overflow: hidden;',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'image_box_shadow',
					'selector' => '{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product a img',
				)
			);

			$this->add_responsive_control(
				'image_margin',
				array(
					'label'      => __( 'Margin', 'zeus-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product a img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'selector' => '{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product .woocommerce-loop-product__title',
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
						'{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product .woocommerce-loop-product__title' => 'color: {{VALUE}};',
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
						'{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product > a:hover .woocommerce-loop-product__title' => 'color: {{VALUE}};',
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
						'{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product .woocommerce-loop-product__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .zeus-woo.woocommerce .star-rating::before' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'rating_fill_color',
				array(
					'label'     => esc_html__( 'Fill Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo.woocommerce .star-rating span' => 'color: {{VALUE}};',
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
						'{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product .price' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'     => 'price_typography',
					'selector' => '{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product .price',
				)
			);

			$this->add_control(
				'del_price_color',
				array(
					'label'     => esc_html__( 'Del Price Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'separator' => 'before',
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product .price del .amount' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'     => 'del_price_typography',
					'selector' => '{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product .price del .amount',
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
						'{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product .price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'selector' => '{{WRAPPER}} .zeus-woo.woocommerce a.button',
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
						'{{WRAPPER}} .zeus-woo.woocommerce a.button' => 'background-color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'button_text_color',
				array(
					'label'     => __( 'Text Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo.woocommerce a.button' => 'color: {{VALUE}};',
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
						'{{WRAPPER}} .zeus-woo.woocommerce a.button:hover' => 'background-color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'button_hover_color',
				array(
					'label'     => __( 'Text Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo.woocommerce a.button:hover' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'button_hover_border_color',
				array(
					'label'     => __( 'Border Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo.woocommerce a.button:hover' => 'border-color: {{VALUE}};',
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
					'selector'    => '{{WRAPPER}} .zeus-woo.woocommerce a.button',
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
						'{{WRAPPER}} .zeus-woo.woocommerce a.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'button_box_shadow',
					'selector' => '{{WRAPPER}} .zeus-woo.woocommerce a.button',
				)
			);

			$this->add_responsive_control(
				'button_padding',
				array(
					'label'      => __( 'Padding', 'zeus-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .zeus-woo.woocommerce a.button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .zeus-woo.woocommerce a.button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'selector' => '{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product .onsale',
				)
			);

			$this->add_control(
				'badge_background_color',
				array(
					'label'     => __( 'Background Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product .onsale' => 'background-color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'badge_color',
				array(
					'label'     => __( 'Color', 'zeus-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product .onsale' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'        => 'badge_border',
					'placeholder' => '1px',
					'selector'    => '{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product .onsale',
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
						'{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product .onsale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'badge_box_shadow',
					'selector' => '{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product .onsale',
				)
			);

			$this->add_responsive_control(
				'badge_padding',
				array(
					'label'      => __( 'Padding', 'zeus-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product .onsale' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .zeus-woo.woocommerce ul.products li.product .onsale' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				$query_args['post__not_in'] = $settings['query_exclude_ids'];
			}

			if ( 'yes' === $settings['query_exclude_current'] ) {
				$query_args['post__not_in'][] = $post->ID;
			}
		}

		if ( 'yes' === $settings['pagination'] ) {

			// Paged
			$page = get_query_var( 'paged', 1 );

			if ( 1 < $page ) {
				$query_args['paged'] = $page;
			}

			$query_args['posts_per_page'] = $settings['posts_per_page'];
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

		global $woocommerce_loop;

		$woocommerce_loop['columns'] = (int) $settings['columns'];

		echo '<div class="zeus-woo woocommerce columns-' . esc_attr( $woocommerce_loop['columns'] ) . '">';

		woocommerce_product_loop_start();

		while ( $query->have_posts() ) :
			$query->the_post();
			wc_get_template_part( 'content', 'product' );
		endwhile;

		woocommerce_product_loop_end();

		// Display pagination if enabled
		if ( 'yes' === $settings['pagination'] ) {
			zeus_pagination( $query );
		}

		woocommerce_reset_loop();

		wp_reset_postdata();

		echo '</div>';
	}

	public function render_plain_content() {}

}
