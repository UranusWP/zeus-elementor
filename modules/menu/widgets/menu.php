<?php
namespace ZeusElementor\Modules\Menu\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Menu extends Widget_Base {

	protected $menu_index = 1;

	public function get_name() {
		return 'zeus-menu';
	}

	public function get_title() {
		return __( 'Menu', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-dropdown';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'menu',
			'nav',
			'nav menu',
			'navigation',
			'header',
			'site',
			'zeus',
		];
	}

	public function get_script_depends() {
		return [ 'zeus-menu' ];
	}

	public function get_style_depends() {
		return [ 'zeus-menu' ];
	}

	protected function get_menu_index() {
		return $this->menu_index++;
	}

	private function get_available_menus() {
		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_menu',
			[
				'label'         => __( 'Menu', 'zeus-elementor' ),
			]
		);

		$menus = $this->get_available_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				[
					'label'         => __( 'Menu', 'zeus-elementor' ),
					'type'          => Controls_Manager::SELECT,
					'options'       => $menus,
					'default'       => array_keys( $menus )[0],
					'save_default'  => true,
					'separator'     => 'after',
					'description'   => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'zeus-elementor' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		} else {
			$this->add_control(
				'menu',
				[
					'type'          => Controls_Manager::RAW_HTML,
					'raw'           => '<strong>' . __( 'There are no menus in your site.', 'zeus-elementor' ) . '</strong><br>' . sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'zeus-elementor' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator'     => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}

		$this->add_control(
			'schema',
			[
				'label'         => __( 'Add Schema Markup', 'zeus-elementor' ),
				'description'   => __( 'Schema Markup helps search engines better understand your content, recommended to enable it.', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'layout',
			[
				'label'         => __( 'Layout', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'horizontal',
				'options'       => [
					'horizontal' => __( 'Horizontal', 'zeus-elementor' ),
					'vertical' => __( 'Vertical', 'zeus-elementor' ),
					'dropdown' => __( 'Dropdown', 'zeus-elementor' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'align_items',
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
					'justify' => [
						'title' => __( 'Stretch', 'zeus-elementor' ),
						'icon' => 'eicon-h-align-stretch',
					],
				],
				'prefix_class'  => 'zeus-menu-align-',
				'condition'     => [
					'layout!' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'submenu_icon',
			[
				'label'         => __( 'Submenu Indicator', 'zeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'separator'     => 'before',
				'default'       => [
					'value' => 'fas fa-angle-down',
					'library' => 'solid',
				],
				'recommended'   => [
					'fa-solid' => [
						'chevron-down',
						'angle-down',
						'caret-down',
						'plus',
					],
				],
				'label_block'   => false,
				'skin'          => 'inline',
				'exclude_inline_options' => [ 'svg' ],
			]
		);

		$this->add_control(
			'heading_search_icon',
			[
				'label'         => __( 'Search Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'search_icon',
			[
				'label'         => __( 'Add Search Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'search_post_types',
			array(
				'label'     => __( 'Search Source', 'zeus-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '0',
				'options'   => zeus_get_available_post_types(),
				'condition'     => [
					'search_icon' => 'yes',
				],
			)
		);

		$this->add_control(
			'search_placeholder',
			[
				'label'         => __( 'Search Placeholder', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [
					'active' => true,
				],
				'label_block'   => false,
				'default'       => __( 'Search', 'zeus-elementor' ),
				'condition'     => [
					'search_icon' => 'yes',
				],
			]
		);

		if ( is_woocommerce_active() ) {
			$this->add_control(
				'heading_cart_icon',
				[
					'label'         => __( 'Cart Icon', 'zeus-elementor' ),
					'type'          => Controls_Manager::HEADING,
					'separator'     => 'before',
				]
			);

			$this->add_control(
				'cart_icon',
				[
					'label'         => __( 'Add Cart Icon', 'zeus-elementor' ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'yes',
				]
			);

			$this->add_control(
				'hide_cart_icon',
				[
					'label'         => __( 'Show Only On Dropdown', 'zeus-elementor' ),
					'type'          => Controls_Manager::SWITCHER,
					'default'       => 'no',
					'condition'     => [
						'cart_icon' => 'yes',
					],
				]
			);

			$this->add_control(
				'cart_dropdown_text',
				[
					'label'         => __( 'Cart Dropdown Text', 'zeus-elementor' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic'       => [
						'active' => true,
					],
					'label_block'   => false,
					'default'       => __( 'Your Cart', 'zeus-elementor' ),
					'condition'     => [
						'cart_icon' => 'yes',
					],
				]
			);
		}

		$this->add_control(
			'heading_mobile_dropdown',
			[
				'label'         => __( 'Mobile Dropdown', 'zeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
				'condition'     => [
					'layout!' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'dropdown',
			[
				'label'         => __( 'Breakpoint', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'tablet',
				'options'       => [
					'none' => __( 'None', 'zeus-elementor' ),
					'tablet' => __( 'Tablet (< 1024px)', 'zeus-elementor' ),
					'mobile' => __( 'Mobile (< 767px)', 'zeus-elementor' ),
				],
				'prefix_class'  => 'zeus-menu-dropdown-',
				'condition'     => [
					'layout!' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'toggle_align',
			[
				'label'         => __( 'Toggle Align', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'default'       => 'center',
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
				'prefix_class'  => 'zeus-toggle-align-',
			]
		);

		$this->add_control(
			'dropdown_full_width',
			[
				'label'         => __( 'Dropdown Full Width', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'return_value'  => 'stretch',
				'prefix_class'  => 'zeus-dropdown-',
				'frontend_available' => true,
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'dropdown_offset',
			[
				'label'         => __( 'Dropdown Offset', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 200,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-toggle-dropdown' => 'top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'is_sticky',
			[
				'label'         => __( 'Add Sticky', 'zeus-elementor' ),
				'description'   => __( 'Doesn&#039;t work on Elementor Editor to avoid conflicts.', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'no',
				'frontend_available' => true,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'sticky_breakpoint',
			[
				'label'         => __( 'Sticky Breakpoint', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'none',
				'options'       => [
					'none' => __( 'Stick On All Devices', 'zeus-elementor' ),
					'1024' => __( 'Tablet (< 1024px)', 'zeus-elementor' ),
					'767' => __( 'Mobile (< 767px)', 'zeus-elementor' ),
				],
				'condition'     => [
					'is_sticky' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_menu',
			[
				'label'         => __( 'Main Menu', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'layout!' => 'dropdown',
				],

			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'menu_typography',
				'selector'      => '{{WRAPPER}} .zeus-menu-main .zeus-menu a.zeus-item',
			]
		);

		$this->start_controls_tabs( 'tabs_links_style' );

		$this->start_controls_tab(
			'tab_links_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'links_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-main .zeus-menu a.zeus-item' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'links_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-main .zeus-menu a.zeus-item' => 'color: {{VALUE}};',
					'{{WRAPPER}} .zeus-menu-main .zeus-menu a.zeus-item + .zeus-sub-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .zeus-menu-main .zeus-menu a.zeus-item + .zeus-sub-icon svg,
					{{WRAPPER}} .zeus-menu-main .zeus-menu a.zeus-cart-menu-item svg,
					{{WRAPPER}} .zeus-menu-main .zeus-menu a.zeus-search-menu-item svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_links_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'links_hover_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-main .zeus-menu a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'links_hover_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-main .zeus-menu a.zeus-item:hover,
					{{WRAPPER}} .zeus-menu-main .zeus-menu a.zeus-item:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .zeus-menu-main .zeus-menu a.zeus-item:hover + .zeus-sub-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .zeus-menu-main .zeus-menu a.zeus-item:hover + .zeus-sub-icon svg,
					{{WRAPPER}} .zeus-menu-main .zeus-menu a.zeus-cart-menu-item:hover svg,
					{{WRAPPER}} .zeus-menu-main .zeus-menu a.zeus-search-menu-item:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_links_active',
			[
				'label'         => __( 'Active', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'links_active_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-main .zeus-menu a.zeus-item.zeus-item-active' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'links_active_color',
			[
				'label' => __( 'Color', 'zeus-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .zeus-menu-main .zeus-menu a.zeus-item.zeus-item-active' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'search_cart_size',
			[
				'label'         => __( 'Search/Cart Icons Size', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} li.zeus-cart-menu svg,
					{{WRAPPER}} li.zeus-search-menu svg' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'links_padding_horizontal',
			[
				'label'         => __( 'Horizontal Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-main .zeus-item,
					{{WRAPPER}} .zeus-menu-layout-vertical .zeus-sub-icon' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
				],
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'links_padding_vertical',
			[
				'label'         => __( 'Vertical Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-main .zeus-item,
					{{WRAPPER}} .zeus-menu-layout-vertical .zeus-sub-icon' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'menu_space_between',
			[
				'label'         => __( 'Space Between', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'     => [
					'body:not(.rtl) {{WRAPPER}} .zeus-menu-layout-horizontal .zeus-menu > li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .zeus-menu-layout-horizontal .zeus-menu > li:not(:last-child)' => 'margin-left: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .zeus-menu-main:not(.zeus-menu-layout-horizontal) .zeus-menu > li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_dropdown',
			[
				'label'         => __( 'Dropdown', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'dropdown_description',
			[
				'raw'           => __( 'On desktop, this will affect the submenu. On mobile, this will affect the entire menu.', 'zeus-elementor' ),
				'type'          => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-descriptor',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'dropdown_typography',
				'exclude'       => [ 'line_height' ],
				'selector'      => '{{WRAPPER}} .zeus-menu-dropdown .zeus-sub-item, {{WRAPPER}} .zeus-menu-toggle-dropdown ul a',
				'separator'     => 'before',
			]
		);

		$this->start_controls_tabs( 'tabs_dropdown_style' );

		$this->start_controls_tab(
			'tab_dropdown_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'dropdown_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-dropdown,
					{{WRAPPER}} .zeus-menu-toggle-dropdown ul' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'dropdown_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-dropdown a,
					{{WRAPPER}} .zeus-menu-dropdown .zeus-sub-icon,
					{{WRAPPER}} .zeus-menu-toggle-dropdown ul a,
					{{WRAPPER}} .zeus-menu-toggle-dropdown .zeus-sub-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .zeus-menu-dropdown .zeus-sub-icon svg,
					{{WRAPPER}} .zeus-menu-toggle-dropdown .zeus-sub-icon svg,
					{{WRAPPER}} .zeus-dropdown-menu a.zeus-cart-menu-item svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_dropdown_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'hover_dropdown_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-dropdown a:hover,
					{{WRAPPER}} .zeus-menu-toggle-dropdown ul a:hover,
					{{WRAPPER}} .zeus-menu-toggle-dropdown ul a.zeus-item-active' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'hover_dropdown_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-dropdown a:hover,
					{{WRAPPER}} .zeus-menu-dropdown a:hover + .zeus-sub-icon,
					{{WRAPPER}} .zeus-menu-toggle-dropdown ul a:hover,
					{{WRAPPER}} .zeus-menu-toggle-dropdown a:hover + .zeus-sub-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .zeus-menu-dropdown a:hover + .zeus-sub-icon svg,
					{{WRAPPER}} .zeus-menu-toggle-dropdown a:hover + .zeus-sub-icon svg,
					{{WRAPPER}} .zeus-dropdown-menu a.zeus-cart-menu-item:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_dropdown_active',
			[
				'label'         => __( 'Active', 'zeus-elementor' ),
			]
		);
		$this->add_control(
			'active_dropdown_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-dropdown a.zeus-item-active,
					{{WRAPPER}} .zeus-menu-toggle-dropdown ul a.zeus-item-active' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'active_dropdown_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-dropdown a.zeus-item-active,
					{WRAPPER}} .zeus-menu-toggle-dropdown ul a.zeus-item-active' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'dropdown_border',
				'selector'      => '{{WRAPPER}} .zeus-menu-dropdown, {{WRAPPER}} .zeus-dropdown-menu',
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'dropdown_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-dropdown, {{WRAPPER}} .zeus-dropdown-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .zeus-menu-main .zeus-menu-dropdown li:first-child a' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};',
					'{{WRAPPER}} .zeus-menu-main .zeus-menu-dropdown li:last-child a' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'dropdown_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-menu-dropdown',
			]
		);

		$this->add_responsive_control(
			'padding_horizontal_dropdown',
			[
				'label'         => __( 'Horizontal Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-dropdown a, {{WRAPPER}} .zeus-menu-toggle-dropdown ul a' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
				],
				'separator'     => 'before',

			]
		);

		$this->add_responsive_control(
			'padding_vertical_dropdown',
			[
				'label'         => __( 'Vertical Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-dropdown a, {{WRAPPER}} .zeus-menu-toggle-dropdown ul a' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'heading_dropdown_divider',
			[
				'label'         => __( 'Divider', 'zeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'dropdown_divider',
				'selector'      => '{{WRAPPER}} .zeus-menu-dropdown li:not(:last-child), {{WRAPPER}} .zeus-dropdown-menu li:not(:last-child)',
				'exclude'       => [ 'width' ],
			]
		);

		$this->add_control(
			'dropdown_divider_width',
			[
				'label'         => __( 'Border Width', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-dropdown li:not(:last-child), {{WRAPPER}} .zeus-dropdown-menu li:not(:last-child)' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'dropdown_divider_border!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_toggle',
			[
				'label'         => __( 'Toggle Button', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_toggle_style' );

		$this->start_controls_tab(
			'tab_toggle_style_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'toggle_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-toggle-icon' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'toggle_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-toggle-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_toggle_style_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'hover_toggle_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-toggle-icon:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'hover_toggle_color_hover',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-toggle-icon:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'hover_toggle_border_color',
			[
				'label'         => __( 'Border Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-toggle-icon:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'toggle_size',
			[
				'label'         => __( 'Size', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 15,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-toggle-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'separator'     => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'toggle_border',
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .zeus-menu-toggle-icon',
			]
		);

		$this->add_responsive_control(
			'toggle_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-toggle-icon' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'toggle_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-menu-toggle-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'     => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_sticky',
			[
				'label'         => __( 'On Sticky Navigation', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'is_sticky' => 'yes',
				],
			]
		);

		$this->add_control(
			'sticky_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '#ffffff',
			]
		);

		$this->add_control(
			'heading_sticky_links',
			[
				'label'         => __( 'On Sticky Nav', 'zeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->start_controls_tabs( 'tabs_sticky_links_style' );

		$this->start_controls_tab(
			'tab_sticky_links_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'sticky_links_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-is-sticky .zeus-menu-main .zeus-menu a.zeus-item' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sticky_links_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-is-sticky .zeus-menu-main .zeus-menu a.zeus-item' => 'color: {{VALUE}};',
					'{{WRAPPER}} .zeus-is-sticky .zeus-menu-main .zeus-menu a.zeus-item + .zeus-sub-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .zeus-is-sticky .zeus-menu-main .zeus-menu a.zeus-item + .zeus-sub-icon svg,
					{{WRAPPER}} .zeus-is-sticky .zeus-menu-main .zeus-menu a.zeus-cart-menu-item svg,
					{{WRAPPER}} .zeus-is-sticky .zeus-menu-main .zeus-menu a.zeus-search-menu-item svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_sticky_links_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'sticky_links_hover_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-is-sticky .zeus-menu-main .zeus-menu a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sticky_links_hover_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-is-sticky .zeus-menu-main .zeus-menu a.zeus-item:hover,
					{{WRAPPER}} .zeus-is-sticky .zeus-menu-main .zeus-menu a.zeus-item:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .zeus-is-sticky .zeus-menu-main .zeus-menu a.zeus-item:hover + .zeus-sub-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .zeus-is-sticky .zeus-menu-main .zeus-menu a.zeus-item:hover + .zeus-sub-icon svg,
					{{WRAPPER}} .zeus-is-sticky .zeus-menu-main .zeus-menu a.zeus-cart-menu-item:hover svg,
					{{WRAPPER}} .zeus-is-sticky .zeus-menu-main .zeus-menu a.zeus-search-menu-item:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_sticky_links_active',
			[
				'label'         => __( 'Active', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'sticky_links_active_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-is-sticky .zeus-menu-main .zeus-menu a.zeus-item.zeus-item-active' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sticky_links_active_color',
			[
				'label' => __( 'Color', 'zeus-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .zeus-is-sticky .zeus-menu-main .zeus-menu a.zeus-item.zeus-item-active' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'heading_sticky_toggle',
			[
				'label'         => __( 'On Sticky Toggle Button', 'zeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->start_controls_tabs( 'tabs_sticky_toggle_style' );

		$this->start_controls_tab(
			'tab_sticky_toggle_style_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'sticky_toggle_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-is-sticky .zeus-menu-toggle .zeus-menu-toggle-icon' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'sticky_toggle_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-is-sticky .zeus-menu-toggle .zeus-menu-toggle-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'sticky_toggle_border_color',
			[
				'label'         => __( 'Border Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-is-sticky .zeus-menu-toggle .zeus-menu-toggle-icon' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_sticky_toggle_style_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'hover_sticky_toggle_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-is-sticky .zeus-menu-toggle .zeus-menu-toggle-icon:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'hover_sticky_toggle_color_hover',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-is-sticky .zeus-menu-toggle .zeus-menu-toggle-icon:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'hover_sticky_toggle_border_color',
			[
				'label'         => __( 'Border Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-is-sticky .zeus-menu-toggle .zeus-menu-toggle-icon:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {
		$available_menus = $this->get_available_menus();

		if ( ! $available_menus ) {
			return;
		}

		$settings = $this->get_active_settings();
		$search = $settings['search_icon'];

		if ( is_woocommerce_active() ) {
			$cart = $settings['cart_icon'];
		}

		// Args
		$args = [
			'echo' => false,
			'menu' => $settings['menu'],
			'menu_class' => 'zeus-menu zeus-ul',
			'menu_id' => 'menu-' . $this->get_menu_index() . '-' . $this->get_id(),
			'fallback_cb' => '__return_empty_string',
			'container' => '',
		];

		// Add custom filter to handle Nav Menu HTML output.
		add_filter( 'nav_menu_link_attributes', [ $this, 'menu_link_classes' ], 10, 4 );
		add_filter( 'walker_nav_menu_start_el', [ $this, 'menu_link_icon' ], 10, 4 );
		add_filter( 'nav_menu_link_attributes', [ $this, 'menu_link_tabindex' ], 10, 4 );
		add_filter( 'nav_menu_submenu_css_class', [ $this, 'menu_sub_menu_classes' ] );
		add_filter( 'nav_menu_item_id', '__return_empty_string' );

		if ( is_woocommerce_active() && 'yes' === $cart ) {
			add_filter( 'wp_nav_menu_items', [ $this, 'menu_add_cart' ], 10, 2 );
		}

		if ( 'yes' === $search ) {
			add_filter( 'wp_nav_menu_items', [ $this, 'menu_add_search' ], 11, 2 );
		}

		// General Menu.
		$menu_html = wp_nav_menu( $args );

		// Dropdown Menu.
		$args['menu_class'] = 'zeus-dropdown-menu';
		$args['menu_id'] = 'menu-' . $this->get_menu_index() . '-' . $this->get_id();
		$args['menu_type'] = 'dropdown';
		$dropdown_menu_html = wp_nav_menu( $args );

		// Remove all our custom filters.
		remove_filter( 'nav_menu_link_attributes', [ $this, 'menu_link_classes' ] );
		remove_filter( 'walker_nav_menu_start_el', [ $this, 'menu_link_icon' ] );
		remove_filter( 'nav_menu_link_attributes', [ $this, 'menu_link_tabindex' ] );
		remove_filter( 'nav_menu_submenu_css_class', [ $this, 'menu_sub_menu_classes' ] );
		remove_filter( 'nav_menu_item_id', '__return_empty_string' );

		if ( is_woocommerce_active() && 'yes' === $cart ) {
			remove_filter( 'wp_nav_menu_items', [ $this, 'menu_add_cart' ], 10, 2 );
		}

		if ( 'yes' === $search ) {
			remove_filter( 'wp_nav_menu_items', [ $this, 'menu_add_search' ], 11, 2 );
		}

		if ( empty( $menu_html ) ) {
			return;
		}

		$this->add_render_attribute( 'menu-wrapper', 'class', 'zeus-menu-wrapper' );

		if ( '#ffffff' !== $settings['sticky_bg'] ) {
			$this->add_render_attribute( 'menu-wrapper', 'data-background', $settings['sticky_bg'] );
		}

		if ( 'none' !== $settings['sticky_breakpoint'] ) {
			$this->add_render_attribute( 'menu-wrapper', 'data-destroy-sticky', $settings['sticky_breakpoint'] );
		}

		$this->add_render_attribute( 'menu-toggle', [
			'class' => 'zeus-menu-toggle',
			'role' => 'button',
			'tabindex' => '0',
			'aria-label' => __( 'Menu Toggle', 'zeus-elementor' ),
			'aria-expanded' => 'false',
		] );

		if ( Plugin::instance()->editor->is_edit_mode() ) {
			$this->add_render_attribute( 'menu-toggle', [
				'class' => 'elementor-clickable',
			] );
		}

		$this->add_render_attribute( 'menu-toggle-icon', 'class', 'zeus-menu-toggle-icon' );

		$this->add_render_attribute( 'main-menu', 'role', 'navigation' );
		$this->add_render_attribute( 'menu-toggle-nav', 'class', 'zeus-menu-toggle-dropdown' );
		$this->add_render_attribute( 'menu-toggle-nav', 'role', 'navigation' );
		$this->add_render_attribute( 'menu-toggle-nav', 'aria-hidden', 'true' );

		// Schema markup
		if ( 'yes' === $settings['schema'] ) {
			$this->add_render_attribute( 'main-menu', 'itemscope', 'itemscope' );
			$this->add_render_attribute( 'main-menu', 'itemtype', 'https://schema.org/SiteNavigationElement' );
			$this->add_render_attribute( 'menu-toggle-nav', 'itemscope', 'itemscope' );
			$this->add_render_attribute( 'menu-toggle-nav', 'itemtype', 'https://schema.org/SiteNavigationElement' );
		} ?>

		<div <?php $this->print_render_attribute_string( 'menu-wrapper' ); ?>>

			<?php
			if ( 'dropdown' !== $settings['layout'] ) :
				$this->add_render_attribute( 'main-menu', 'class', [
					'zeus-menu-main',
					'zeus-menu-container',
					'zeus-menu-layout-' . $settings['layout'],
				] );

				// Show cart icon only on dropdown
				if ( is_woocommerce_active() && 'yes' === $settings['hide_cart_icon'] ) {
					$this->add_render_attribute( 'main-menu', 'class', 'zeus-hide-cart' );
				} ?>
				<nav <?php $this->print_render_attribute_string( 'main-menu' ); ?>><?php echo $menu_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></nav>
				<?php
			endif; ?>

			<div <?php $this->print_render_attribute_string( 'menu-toggle' ); ?>>
				<div <?php $this->print_render_attribute_string( 'menu-toggle-icon' ); ?>>
					<svg viewBox="0 0 512 512" aria-hidden="true" role="img" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1em" height="1em"><path d="M0 96c0-13.255 10.745-24 24-24h464c13.255 0 24 10.745 24 24s-10.745 24-24 24H24c-13.255 0-24-10.745-24-24zm0 160c0-13.255 10.745-24 24-24h464c13.255 0 24 10.745 24 24s-10.745 24-24 24H24c-13.255 0-24-10.745-24-24zm0 160c0-13.255 10.745-24 24-24h464c13.255 0 24 10.745 24 24s-10.745 24-24 24H24c-13.255 0-24-10.745-24-24z"></path></svg><svg viewBox="0 0 512 512" aria-hidden="true" role="img" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1em" height="1em"><path d="M71.029 71.029c9.373-9.372 24.569-9.372 33.942 0L256 222.059l151.029-151.03c9.373-9.372 24.569-9.372 33.942 0 9.372 9.373 9.372 24.569 0 33.942L289.941 256l151.03 151.029c9.372 9.373 9.372 24.569 0 33.942-9.373 9.372-24.569 9.372-33.942 0L256 289.941l-151.029 151.03c-9.373 9.372-24.569 9.372-33.942 0-9.372-9.373-9.372-24.569 0-33.942L222.059 256 71.029 104.971c-9.372-9.373-9.372-24.569 0-33.942z"></path></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'zeus-elementor' ); ?></span>
				</div>

				<nav <?php $this->print_render_attribute_string( 'menu-toggle-nav' ); ?>><?php echo $dropdown_menu_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></nav>
			</div>

		</div>

		<?php
	}

	public function menu_link_classes( $atts, $item, $args, $depth ) {
		$classes = $depth ? 'zeus-sub-item' : 'zeus-item';
		$is_anchor = false !== strpos( $atts['href'], '#' );

		if ( ! $is_anchor && in_array( 'current-menu-item', $item->classes ) ) {
			$classes .= ' zeus-item-active';
		}

		if ( $is_anchor ) {
			$classes .= ' zeus-item-anchor';
		}

		if ( empty( $atts['class'] ) ) {
			$atts['class'] = $classes;
		} else {
			$atts['class'] .= ' ' . $classes;
		}

		return $atts;
	}

	public function menu_link_tabindex( $atts, $item, $args ) {
		$settings = $this->get_active_settings();

		// Add `tabindex = -1` to the links if it's a dropdown.
		$is_dropdown = 'dropdown' === $settings['layout'];
		$is_dropdown = $is_dropdown || ( isset( $args->menu_type ) && 'dropdown' === $args->menu_type );

		if ( $is_dropdown ) {
			$atts['tabindex'] = '-1';
		}

		return $atts;
	}

	public function menu_link_icon( $output, $item, $depth, $args ) {
		$settings = $this->get_active_settings();

		// Only add class to 'top level' items.
		if ( 0 === $depth || $depth > 0 ) {
			if ( in_array( 'menu-item-has-children', $item->classes ) ) {
				$output .= '<span class="zeus-sub-icon">' . Icons_Manager::render_font_icon( $settings['submenu_icon'], [ 'aria-hidden' => 'true' ] ) . '</span>';
			}
		}

		return $output;
	}

	public function menu_sub_menu_classes( $classes ) {
		$classes[] = 'zeus-menu-dropdown';

		return $classes;
	}

	public function menu_add_search( $items, $args ) {
		$settings = $this->get_active_settings();
		$post_type = $settings['search_post_types'];
		$text   = $settings['search_placeholder'];

		// Add search item to menu.
		$items .= '<li class="zeus-search-menu">';
		$items .= '<a href="javascript:void(0)" class="zeus-item zeus-search-menu-item" aria-label="' . esc_html__( 'Search Website', 'zeus-elementor' ) . '">';
		$items .= '<span class="screen-reader-text">' . __( 'Search Website', 'zeus-elementor' ) . '</span>';
		$items .= '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 512 512"><path d="M495,466.2L377.2,348.4c29.2-35.6,46.8-81.2,46.8-130.9C424,103.5,331.5,11,217.5,11C103.4,11,11,103.5,11,217.5 S103.4,424,217.5,424c49.7,0,95.2-17.5,130.8-46.7L466.1,495c8,8,20.9,8,28.9,0C503,487.1,503,474.1,495,466.2z M217.5,382.9 C126.2,382.9,52,308.7,52,217.5S126.2,52,217.5,52C308.7,52,383,126.3,383,217.5S308.7,382.9,217.5,382.9z"/></svg>';
		$items .= '</a>';
		$items .= '<ul class="sub-menu zeus-menu-dropdown zeus-searchform-menu">';
		$items .= '<form role="search" method="get" action="' . esc_url( home_url( '/' ) ) . '">';
		$items .= '<span class="screen-reader-text">' . __( 'Search', 'zeus-elementor' ) . '</span>';
		$items .= '<input aria-label="' . __( 'Insert search query', 'zeus-elementor' ) . '" type="text" class="field" name="s" placeholder="' . esc_attr( $text ) . '">';
		if ( '0' !== $post_type ) {
			$items .= '<input type="hidden" name="post_type" value="' . esc_attr( $post_type ) . '">';
		}
		$items .= '</form>';
		$items .= '</ul>';
		$items .= '</li>';

		// Return nav $items.
		return $items;

	}

	public function menu_add_cart( $items, $args ) {
		$settings = $this->get_active_settings();
		$text   = $settings['cart_dropdown_text'];
		$cart_is_hidden = apply_filters( 'woocommerce_widget_cart_is_hidden', is_cart() || is_checkout() );

		// If cart or checkout page
		if ( ! $cart_is_hidden ) {
			$cart_link = wc_get_cart_url();
		} else {
			$cart_link = '#';
		}

		// Add cart item to menu.
		$items .= '<li class="zeus-cart-menu">';
		$items .= '<a href="' . esc_attr( $cart_link ) . '" class="zeus-item zeus-cart-menu-item">';
		$items .= '<svg viewBox="0 0 511.728 511.728" xmlns="http://www.w3.org/2000/svg"><path d="m147.925 379.116c-22.357-1.142-21.936-32.588-.001-33.68 62.135.216 226.021.058 290.132.103 17.535 0 32.537-11.933 36.481-29.017l36.404-157.641c2.085-9.026-.019-18.368-5.771-25.629s-14.363-11.484-23.626-11.484c-25.791 0-244.716-.991-356.849-1.438l-17.775-65.953c-4.267-15.761-18.65-26.768-34.978-26.768h-56.942c-8.284 0-15 6.716-15 15s6.716 15 15 15h56.942c2.811 0 5.286 1.895 6.017 4.592l68.265 253.276c-12.003.436-23.183 5.318-31.661 13.92-8.908 9.04-13.692 21.006-13.471 33.695.442 25.377 21.451 46.023 46.833 46.023h21.872c-3.251 6.824-5.076 14.453-5.076 22.501 0 28.95 23.552 52.502 52.502 52.502s52.502-23.552 52.502-52.502c0-8.049-1.826-15.677-5.077-22.501h94.716c-3.248 6.822-5.073 14.447-5.073 22.493 0 28.95 23.553 52.502 52.502 52.502 28.95 0 52.503-23.553 52.503-52.502 0-8.359-1.974-16.263-5.464-23.285 5.936-1.999 10.216-7.598 10.216-14.207 0-8.284-6.716-15-15-15zm91.799 52.501c0 12.408-10.094 22.502-22.502 22.502s-22.502-10.094-22.502-22.502c0-12.401 10.084-22.491 22.483-22.501h.038c12.399.01 22.483 10.1 22.483 22.501zm167.07 22.494c-12.407 0-22.502-10.095-22.502-22.502 0-12.285 9.898-22.296 22.137-22.493h.731c12.24.197 22.138 10.208 22.138 22.493-.001 12.407-10.096 22.502-22.504 22.502zm74.86-302.233c.089.112.076.165.057.251l-15.339 66.425h-51.942l8.845-67.023 58.149.234c.089.002.142.002.23.113zm-154.645 163.66v-66.984h53.202l-8.84 66.984zm-74.382 0-8.912-66.984h53.294v66.984zm-69.053 0h-.047c-3.656-.001-6.877-2.467-7.828-5.98l-16.442-61.004h54.193l8.912 66.984zm56.149-96.983-9.021-67.799 66.306.267v67.532zm87.286 0v-67.411l66.022.266-8.861 67.145zm-126.588-67.922 9.037 67.921h-58.287l-18.38-68.194zm237.635 164.905h-36.426l8.84-66.984h48.973l-14.137 61.217c-.784 3.396-3.765 5.767-7.25 5.767z"/></svg>';
		$items .= '<span class="zeus-cart-text">' . esc_attr( $text ) . '</span>';
		$items .= '<span class="screen-reader-text">' . __( 'Cart', 'zeus-elementor' ) . '</span>';
		$items .= '</a>';
		$items .= '</li>';

		// Return nav $items.
		return $items;

	}

	public function render_plain_content() {}

}
