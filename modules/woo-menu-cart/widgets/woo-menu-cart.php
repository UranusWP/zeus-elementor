<?php
namespace ZeusElementor\Modules\WooMenuCart\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use ZeusElementor\Modules\WooMenuCart\Module;

class WooMenuCart extends Widget_Base {

	public function get_name() {
		return 'zeus-woo-menu-cart';
	}

	public function get_title() {
		return __( 'Woo - Menu Cart', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-cart-full';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'woo',
			'woocommerce',
			'ecommerce',
			'cart',
			'menu cart',
			'icon',
			'button',
			'header',
			'site',
			'zeus',
		];
	}

	public function get_style_depends() {
		return [ 'zeus-woo-menu-cart' ];
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
				'section_cart_icon',
				[
					'label' => __( 'Cart Icon', 'zeus-elementor' ),
				]
			);

			$this->add_control(
				'align',
				[
					'label'         => __( 'Align', 'zeus-elementor' ),
					'type'          => Controls_Manager::CHOOSE,
					'options'       => [
						'left' => [
							'title' => __( 'Left', 'zeus-elementor' ),
							'icon' => 'eicon-h-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'zeus-elementor' ),
							'icon' => 'eicon-h-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'zeus-elementor' ),
							'icon' => 'eicon-h-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}}' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'show_cart_count',
				[
					'label'         => __( 'Cart Count', 'zeus-elementor' ),
					'type'          => Controls_Manager::SWITCHER,
					'return_value'  => 'yes',
					'default'       => 'yes',
					'prefix_class'  => 'zeus-cart-count-',
				]
			);

			$this->add_control(
				'show_cart_total',
				[
					'label'         => __( 'Cart Total', 'zeus-elementor' ),
					'type'          => Controls_Manager::SWITCHER,
					'return_value'  => 'yes',
					'default'       => 'yes',
					'prefix_class'  => 'zeus-cart-total-',
				]
			);

			$this->add_control(
				'dropdown_align',
				[
					'label'         => __( 'Dropdown Align', 'zeus-elementor' ),
					'type'          => Controls_Manager::CHOOSE,
					'options'       => [
						'left' => [
							'title' => __( 'Left', 'zeus-elementor' ),
							'icon' => 'eicon-h-align-left',
						],
						'right' => [
							'title' => __( 'Right', 'zeus-elementor' ),
							'icon' => 'eicon-h-align-right',
						],
					],
					'prefix_class'  => 'zeus-dropdown-align-',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_style_icon',
				[
					'label'         => __( 'Icon', 'zeus-elementor' ),
					'tab'           => Controls_Manager::TAB_STYLE,

				]
			);

			$this->add_control(
				'icon_size',
				[
					'label'         => __( 'Size', 'zeus-elementor' ),
					'type'          => Controls_Manager::SLIDER,
					'range'         => [
						'px' => [
							'min' => 0,
							'max' => 50,
						],
					],
					'size_units'    => [ 'px', 'em' ],
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .zeus-menu-cart-link svg' => 'font-size: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_icon_style' );

			$this->start_controls_tab(
				'tab_icon_normal',
				[
					'label'         => __( 'Normal', 'zeus-elementor' ),
				]
			);

			$this->add_control(
				'icon_bg',
				[
					'label'         => __( 'Background Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .zeus-menu-cart-link' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .zeus-menu-cart-link' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_icon_hover',
				[
					'label'         => __( 'Hover', 'zeus-elementor' ),
				]
			);

			$this->add_control(
				'icon_bg_hover',
				[
					'label'         => __( 'Background Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .zeus-menu-cart-link:hover' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'icon_color_hover',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .zeus-menu-cart-link:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'icon_border_color_hover',
				[
					'label'         => __( 'Border Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .zeus-menu-cart-link:hover' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'icon_border',
					'label'         => __( 'Border', 'zeus-elementor' ),
					'placeholder'   => '1px',
					'default'       => '1px',
					'selector'      => '{{WRAPPER}} .zeus-menu-cart .zeus-menu-cart-link',
					'separator'     => 'before',
				]
			);

			$this->add_control(
				'icon_border_radius',
				[
					'label'         => __( 'Border Radius', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .zeus-menu-cart-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'icon_padding',
				[
					'label'         => __( 'Padding', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em' ],
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .zeus-menu-cart-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'items_count_style',
				[
					'label'         => __( 'Items Count', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
					'condition'     => [
						'show_cart_count' => 'yes',
					],
				]
			);

			$this->add_control(
				'items_count_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .zeus-menu-cart-count' => 'color: {{VALUE}}',
					],
					'condition'     => [
						'show_cart_count' => 'yes',
					],
				]
			);

			$this->add_control(
				'items_count_background_color',
				[
					'label'         => __( 'Background Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .zeus-menu-cart-count' => 'background-color: {{VALUE}}',
					],
					'condition'     => [
						'show_cart_count' => 'yes',
					],
				]
			);

			$this->add_control(
				'items_count_distance',
				[
					'label'         => __( 'Distance', 'zeus-elementor' ),
					'type'          => Controls_Manager::SLIDER,
					'default'       => [
						'unit' => 'px',
					],
					'range'         => [
						'px' => [
							'min' => 0,
							'max' => 50,
							'step' => 1,
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .zeus-menu-cart-count' => 'margin-left: {{SIZE}}{{UNIT}}',
						'body.rtl {{WRAPPER}} .zeus-menu-cart .zeus-menu-cart-count' => 'margin-right: {{SIZE}}{{UNIT}}',
					],
					'condition'     => [
						'show_cart_count' => 'yes',
					],
				]
			);

			$this->add_control(
				'subtotal_style',
				[
					'label'         => __( 'Total', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
					'condition'     => [
						'show_cart_total' => 'yes',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'subtotal_typo',
					'selector'      => '{{WRAPPER}} .zeus-menu-cart .zeus-menu-cart-total',
					'condition'     => [
						'show_cart_total' => 'yes',
					],
				]
			);

			$this->add_control(
				'subtotal_distance',
				[
					'label'         => __( 'Distance', 'zeus-elementor' ),
					'type'          => Controls_Manager::SLIDER,
					'default'       => [
						'unit' => 'px',
					],
					'range'         => [
						'px' => [
							'min' => 0,
							'max' => 50,
							'step' => 1,
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .zeus-menu-cart-total' => 'margin-left: {{SIZE}}{{UNIT}}',
						'body.rtl {{WRAPPER}} .zeus-menu-cart .zeus-menu-cart-total' => 'margin-right: {{SIZE}}{{UNIT}}',
					],
					'condition'     => [
						'show_cart_total' => 'yes',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_subtotal_style' );

			$this->start_controls_tab(
				'tab_subtotal_normal',
				[
					'label'         => __( 'Normal', 'zeus-elementor' ),
					'condition'     => [
						'show_cart_total' => 'yes',
					],
				]
			);

			$this->add_control(
				'subtotal_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .zeus-menu-cart-total' => 'color: {{VALUE}};',
					],
					'condition'     => [
						'show_cart_total' => 'yes',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_subtotal_hover',
				[
					'label'         => __( 'Hover', 'zeus-elementor' ),
					'condition'     => [
						'show_cart_total' => 'yes',
					],
				]
			);

			$this->add_control(
				'subtotal_color_hover',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .zeus-menu-cart-link:hover .zeus-menu-cart-total' => 'color: {{VALUE}};',
					],
					'condition'     => [
						'show_cart_total' => 'yes',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->end_controls_section();

			$this->start_controls_section(
				'section_cart_dropdown_style',
				[
					'label'         => __( 'Dropdown', 'zeus-elementor' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'cart_dropdown_width',
				[
					'label'         => __( 'Width', 'zeus-elementor' ),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => [ 'px' ],
					'default' => [
						'unit' => 'px',
						'size' => 350,
					],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .zeus-menu-cart .widget_shopping_cart_content' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'cart_dropdown_bg',
				[
					'label'         => __( 'Background Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .widget_shopping_cart_content' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'cart_dropdown_border',
					'label'         => __( 'Border', 'zeus-elementor' ),
					'placeholder'   => '1px',
					'selector'      => '{{WRAPPER}} .zeus-menu-cart .widget_shopping_cart_content',
					'separator'     => 'before',
				]
			);

			$this->add_control(
				'cart_dropdown_border_radius',
				[
					'label'         => __( 'Border Radius', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .widget_shopping_cart_content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'cart_dropdown_padding',
				[
					'label'         => __( 'Padding', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .widget_shopping_cart_content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_products_style',
				[
					'label'         => __( 'Products', 'zeus-elementor' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'cart_product_title_style',
				[
					'label'         => __( 'Product Title', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'cart_product_title_typo',
					'selector'      => '{{WRAPPER}} .zeus-menu-cart li.woocommerce-mini-cart-item a:not(.remove)',
				]
			);

			$this->start_controls_tabs( 'tabs_cart_product_title_style' );

			$this->start_controls_tab(
				'tab_cart_product_title_normal',
				[
					'label'         => __( 'Normal', 'zeus-elementor' ),
				]
			);

			$this->add_control(
				'cart_product_title_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart li.woocommerce-mini-cart-item a:not(.remove)' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_cart_product_title_hover',
				[
					'label'         => __( 'Hover', 'zeus-elementor' ),
				]
			);

			$this->add_control(
				'cart_product_title_color_hover',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart li.woocommerce-mini-cart-item a:not(.remove):hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_control(
				'cart_product_quantity_style',
				[
					'label'         => __( 'Product Quantity', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);

			$this->add_control(
				'cart_product_quantity_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart li.woocommerce-mini-cart-item .quantity' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'cart_product_quantity_typo',
					'selector'      => '{{WRAPPER}} .zeus-menu-cart li.woocommerce-mini-cart-item .quantity',
				]
			);

			$this->add_control(
				'cart_product_price_style',
				[
					'label'         => __( 'Product Price', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);

			$this->add_control(
				'cart_product_price_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart li.woocommerce-mini-cart-item .quantity .amount' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'cart_product_price_typo',
					'selector'      => '{{WRAPPER}} .zeus-menu-cart li.woocommerce-mini-cart-item .quantity .amount',
				]
			);

			$this->add_control(
				'cart_remove_button_style',
				[
					'label'         => __( 'Remove Button', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);

			$this->start_controls_tabs( 'tabs_cart_remove_button_style' );

			$this->start_controls_tab(
				'tab_cart_remove_button_normal',
				[
					'label'         => __( 'Normal', 'zeus-elementor' ),
				]
			);

			$this->add_control(
				'cart_remove_button_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart li.woocommerce-mini-cart-item a.remove' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_cart_remove_button_hover',
				[
					'label'         => __( 'Hover', 'zeus-elementor' ),
				]
			);

			$this->add_control(
				'cart_remove_button_color_hover',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart li.woocommerce-mini-cart-item a.remove:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_control(
				'cart_divider_style',
				[
					'label'         => __( 'Divider', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);

			$this->add_control(
				'cart_divider_border_style',
				[
					'label'         => __( 'Style', 'zeus-elementor' ),
					'type'          => Controls_Manager::SELECT,
					'options'       => [
						''          => __( 'None', 'zeus-elementor' ),
						'solid'     => __( 'Solid', 'zeus-elementor' ),
						'double'    => __( 'Double', 'zeus-elementor' ),
						'dotted'    => __( 'Dotted', 'zeus-elementor' ),
						'dashed'    => __( 'Dashed', 'zeus-elementor' ),
						'groove'    => __( 'Groove', 'zeus-elementor' ),
					],
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart li.woocommerce-mini-cart-item' => 'border-bottom-style: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'cart_divider_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart li.woocommerce-mini-cart-item' => 'border-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'cart_divider_width',
				[
					'label'         => __( 'Weight', 'zeus-elementor' ),
					'type'          => Controls_Manager::SLIDER,
					'range'         => [
						'px' => [
							'min' => 0,
							'max' => 10,
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart li.woocommerce-mini-cart-item' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_subtotal_style',
				[
					'label'         => __( 'Subtotal', 'zeus-elementor' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'cart_subtotal_bg',
				[
					'label'         => __( 'Background Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart p.woocommerce-mini-cart__total' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'cart_subtotal_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart p.woocommerce-mini-cart__total strong' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'cart_subtotal_border_style',
				[
					'label'         => __( 'Border Style', 'zeus-elementor' ),
					'type'          => Controls_Manager::SELECT,
					'options'       => [
						''          => __( 'None', 'zeus-elementor' ),
						'solid'     => __( 'Solid', 'zeus-elementor' ),
						'double'    => __( 'Double', 'zeus-elementor' ),
						'dotted'    => __( 'Dotted', 'zeus-elementor' ),
						'dashed'    => __( 'Dashed', 'zeus-elementor' ),
						'groove'    => __( 'Groove', 'zeus-elementor' ),
					],
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart p.woocommerce-mini-cart__total' => 'border-bottom-style: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'cart_subtotal_border_color',
				[
					'label'         => __( 'Border Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart p.woocommerce-mini-cart__total' => 'border-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'cart_subtotal_width',
				[
					'label'         => __( 'Border Weight', 'zeus-elementor' ),
					'type'          => Controls_Manager::SLIDER,
					'range'         => [
						'px' => [
							'min' => 0,
							'max' => 10,
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart p.woocommerce-mini-cart__total' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'cart_subtotal_typo',
					'selector'      => '{{WRAPPER}} .zeus-menu-cart p.woocommerce-mini-cart__total strong',
				]
			);

			$this->add_control(
				'cart_subtotal_padding',
				[
					'label'         => __( 'Padding', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart p.woocommerce-mini-cart__total' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'cart_subtotal_price_style',
				[
					'label'         => __( 'Price', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);

			$this->add_control(
				'cart_subtotal_price_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart p.woocommerce-mini-cart__total .amount' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'cart_subtotal_price_typo',
					'selector'      => '{{WRAPPER}} .zeus-menu-cart p.woocommerce-mini-cart__total .amount',
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

			$this->add_control(
				'cart_view_cart_style',
				[
					'label'         => __( 'View Cart', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);

			$this->start_controls_tabs( 'tabs_cart_view_cart_style' );

			$this->start_controls_tab(
				'tab_cart_view_cart_normal',
				[
					'label'         => __( 'Normal', 'zeus-elementor' ),
				]
			);

			$this->add_control(
				'cart_view_cart_bg',
				[
					'label'         => __( 'Background Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .buttons .button:first-child' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'cart_view_cart_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .buttons .button:first-child' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_cart_view_cart_hover',
				[
					'label'         => __( 'Hover', 'zeus-elementor' ),
				]
			);

			$this->add_control(
				'cart_view_cart_bg_hover',
				[
					'label'         => __( 'Background Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .buttons .button:first-child:hover' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'cart_view_cart_color_hover',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .buttons .button:first-child:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'cart_view_cart_border_color_hover',
				[
					'label'         => __( 'Border Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .buttons .button:first-child:hover' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'cart_view_cart_border',
					'label'         => __( 'Border', 'zeus-elementor' ),
					'placeholder'   => '1px',
					'selector'      => '{{WRAPPER}} .zeus-menu-cart .buttons .button:first-child',
				]
			);

			$this->add_control(
				'cart_view_cart_border_radius',
				[
					'label'         => __( 'Border Radius', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .buttons .button:first-child' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'cart_view_cart_padding',
				[
					'label'         => __( 'Padding', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .buttons .button:first-child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'cart_view_cart_typo',
					'selector'      => '{{WRAPPER}} .zeus-menu-cart .buttons .button:first-child',
				]
			);

			$this->add_control(
				'cart_checkout_style',
				[
					'label'         => __( 'Checkout', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);

			$this->start_controls_tabs( 'tabs_cart_checkout_style' );

			$this->start_controls_tab(
				'tab_cart_checkout_normal',
				[
					'label'         => __( 'Normal', 'zeus-elementor' ),
				]
			);

			$this->add_control(
				'cart_checkout_bg',
				[
					'label'         => __( 'Background Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .buttons .button.checkout' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'cart_checkout_color',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .buttons .button.checkout' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_cart_checkout_hover',
				[
					'label'         => __( 'Hover', 'zeus-elementor' ),
				]
			);

			$this->add_control(
				'cart_checkout_bg_hover',
				[
					'label'         => __( 'Background Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .buttons .button.checkout:hover' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'cart_checkout_color_hover',
				[
					'label'         => __( 'Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .buttons .button.checkout:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'cart_checkout_border_color_hover',
				[
					'label'         => __( 'Border Color', 'zeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .buttons .button.checkout:hover' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'cart_checkout_border',
					'label'         => __( 'Border', 'zeus-elementor' ),
					'placeholder'   => '1px',
					'selector'      => '{{WRAPPER}} .zeus-menu-cart .buttons .button.checkout',
				]
			);

			$this->add_control(
				'cart_checkout_border_radius',
				[
					'label'         => __( 'Border Radius', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .buttons .button.checkout' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'cart_checkout_padding',
				[
					'label'         => __( 'Padding', 'zeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .zeus-menu-cart .buttons .button.checkout' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'cart_checkout_typo',
					'selector'      => '{{WRAPPER}} .zeus-menu-cart .buttons .button.checkout',
				]
			);

			$this->end_controls_section();

		}

	}

	protected function render() {

		// Return if not activated
		if ( ! is_woocommerce_active() ) {
			return;
		}

		Module::render_menu_cart();
	}

	public function render_plain_content() {}

}
