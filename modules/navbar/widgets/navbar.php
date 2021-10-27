<?php
namespace ZeusElementor\Modules\Navbar\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Navbar extends Widget_Base {

	public function get_name() {
		return 'zeus-navbar';
	}

	public function get_title() {
		return __( 'Navbar', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-menu2';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'nav',
			'navigation',
			'menu',
			'zeus',
		];
	}

	public function get_script_depends() {
		return [ 'zeus-navbar' ];
	}

	public function get_style_depends() {
		return [ 'zeus-navbar', 'zeus-off-canvas' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_navbar',
			[
				'label'         => __( 'Navbar', 'zeus-elementor' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'selected_icon',
			[
				'label'     => __( 'Icon', 'zeus-elementor' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => [
					'value'     => 'fas fa-home',
					'library'   => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'     => __( 'Title', 'zeus-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Homepage', 'zeus-elementor' ),
				'dynamic'   => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'     => __( 'Link', 'zeus-elementor' ),
				'type'      => Controls_Manager::URL,
				'default'   => [ 'url' => '#' ],
			]
		);

		$this->add_control(
			'navbar',
			[
				'label'         => __( 'Nav Items', 'zeus-elementor' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'default'       => [
					[
						'title'     => __( 'Homepage', 'zeus-elementor' ),
						'selected_icon' => [
							'value'     => 'fas fa-home',
							'library'   => 'fa-solid',
						],
						'link'      => [
							'url' => __( '#', 'zeus-elementor' ),
						],
					],
					[
						'title'     => __( 'Blog', 'zeus-elementor' ),
						'selected_icon' => [
							'value'     => 'fas fa-comment',
							'library'   => 'fa-solid',
						],
						'link'      => [
							'url' => __( '#', 'zeus-elementor' ),
						],
					],
					[
						'title'     => __( 'Shop', 'zeus-elementor' ),
						'selected_icon' => [
							'value'     => 'fas fa-shopping-basket',
							'library'   => 'fa-solid',
						],
						'link'      => [
							'url' => __( '#', 'zeus-elementor' ),
						],
					],
					[
						'title'     => __( 'About Us', 'zeus-elementor' ),
						'selected_icon' => [
							'value'     => 'far fa-user-circle',
							'library'   => 'fa-regular',
						],
						'link'      => [
							'url' => __( '#', 'zeus-elementor' ),
						],
					],
					[
						'title'     => __( 'Contact Us', 'zeus-elementor' ),
						'selected_icon' => [
							'value'     => 'fas fa-envelope',
							'library'   => 'fa-solid',
						],
						'link'      => [
							'url' => __( '#', 'zeus-elementor' ),
						],
					],
				],
				'title_field'   => '{{{ title }}}',
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'zeus-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .zeus-navbar-wrap  a.zeus-navbar-link .zeus-navbar-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'navbar_width',
			[
				'label'         => __( 'Width', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 200,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap' => 'width: {{SIZE}}{{UNIT}};',
					'#zeus-off-canvas-{{ID}}.zeus-off-canvas-wrap.zeus-navbar-off-canvas.zeus-navbar-left .zeus-off-canvas-sidebar' => 'left: {{SIZE}}{{UNIT}};',
					'#zeus-off-canvas-{{ID}}.zeus-off-canvas-wrap.zeus-navbar-off-canvas.zeus-navbar-right .zeus-off-canvas-sidebar' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'navbar_position',
			[
				'label'         => __( 'Navbar Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'left',
				'options'       => [
					'left'   => __( 'Left', 'zeus-elementor' ),
					'right'  => __( 'Right', 'zeus-elementor' ),
				],
			]
		);

		$this->add_responsive_control(
			'navbar_offset',
			[
				'label'         => __( 'Top Offset', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap .zeus-navbar-inner' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_branding',
			[
				'label'         => __( 'Branding', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'show_branding',
			[
				'label'         => __( 'Show Branding Image', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'branding_image',
			[
				'label'         => __( 'Choose Image', 'zeus-elementor' ),
				'type'          => Controls_Manager::MEDIA,
				'condition'     => [
					'show_branding' => 'yes',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'branding_link',
			[
				'label'         => __( 'Custom Link', 'zeus-elementor' ),
				'label'         => __( 'By default, it is your homepage', 'zeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'zeus-elementor' ),
			]
		);

		$this->add_responsive_control(
			'brading_space',
			[
				'label'         => __( 'Space', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 20,
				],
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'condition'     => [
					'show_branding' => 'yes',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap .zeus-navbar-logo' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_off_canvas',
			[
				'label'         => __( 'Off Canvas', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'show_off_canvas',
			[
				'label'         => __( 'Show Off Canvas', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'no',
			]
		);

		$this->add_control(
			'source',
			[
				'label'         => __( 'Source', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'sidebar',
				'options'       => [
					'sidebar'   => __( 'Sidebar', 'zeus-elementor' ),
					'template'  => __( 'Template', 'zeus-elementor' ),
				],
				'condition'     => [
					'show_off_canvas' => 'yes',
				],
			]
		);

		$this->add_control(
			'sidebars',
			[
				'label'         => __( 'Choose Sidebar', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => '0',
				'options'       => zeus_get_available_sidebars(),
				'condition'     => [
					'source' => 'sidebar',
					'show_off_canvas' => 'yes',
				],
			]
		);

		$this->add_control(
			'templates',
			[
				'label'         => __( 'Choose Template', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => '0',
				'options'       => zeus_get_available_templates(),
				'condition'     => [
					'source' => 'template',
					'show_off_canvas' => 'yes',
				],
			]
		);

		$this->add_control(
			'off_canvas_title',
			[
				'label'         => __( 'Title', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Off Canvas', 'zeus-elementor' ),
				'condition'     => [
					'show_off_canvas' => 'yes',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_responsive_control(
			'off_canvas_width',
			[
				'label'         => __( 'Width', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1200,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'condition'     => [
					'show_off_canvas' => 'yes',
				],
				'selectors'     => [
					'#zeus-off-canvas-{{ID}}.zeus-off-canvas-wrap .zeus-off-canvas-sidebar' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_overlay',
			[
				'label'         => __( 'Overlay', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'condition'     => [
					'show_off_canvas' => 'yes',
				],
			]
		);

		$this->add_control(
			'off_canvas_close_button',
			[
				'label'         => __( 'Close Button', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'condition'     => [
					'show_off_canvas' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_mobile',
			[
				'label'         => __( 'Mobile Menu', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'show_mobile',
			[
				'label'         => __( 'Activate Responsive', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'mobile_breakpoint',
			[
				'label'         => __( 'Breakpoints', 'zeus-elementor' ),
				'description'   => __( 'Choose the media query where you want to display the mobile menu', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => '959',
				'options'       => [
					'1280'      => __( 'From 1280px', 'zeus-elementor' ),
					'1080'      => __( 'From 1080px', 'zeus-elementor' ),
					'959'       => __( 'From 959px', 'zeus-elementor' ),
					'767'       => __( 'From 767px', 'zeus-elementor' ),
					'480'       => __( 'From 480px', 'zeus-elementor' ),
					'320'       => __( 'From 320px', 'zeus-elementor' ),
					'custom'    => __( 'Custom media query', 'zeus-elementor' ),
				],
				'condition'     => [
					'show_mobile' => 'yes',
				],
			]
		);

		$this->add_control(
			'mobile_custom_breakpoint',
			[
				'label'         => __( 'Custom Media Query', 'zeus-elementor' ),
				'description'   => __( 'Enter your custom media query where you want to display the mobile menu.', 'zeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'step'          => 1,
				'condition'     => [
					'show_mobile' => 'yes',
					'mobile_breakpoint' => 'custom',
				],
			]
		);

		$this->add_control(
			'mobile_title',
			[
				'label'         => __( 'Title', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Menu', 'zeus-elementor' ),
				'condition'     => [
					'show_mobile' => 'yes',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'mobile_close_title',
			[
				'label'         => __( 'Close Title', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Close', 'zeus-elementor' ),
				'condition'     => [
					'show_mobile' => 'yes',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'         => __( 'Navbar', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'navbar_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .zeus-navbar-wrap.zeus-is-responsive ul.zeus-navbar' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'navbar_border',
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .zeus-navbar-wrap',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'navbar_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'navbar_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-navbar-wrap',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_links_style',
			[
				'label'         => __( 'Links', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'links_font_size',
			[
				'label'         => __( 'Size', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px' ],
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap ul a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
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
			'links_background_color',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap ul a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'links_text_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap ul a' => 'color: {{VALUE}};',
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
			'links_hover_background_color',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap ul a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'links_hover_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap ul a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'links_hover_border_color',
			[
				'label'         => __( 'Border Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap ul a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'links_border',
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .zeus-navbar-wrap ul a',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'links_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap ul a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'links_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-navbar-wrap ul a',
			]
		);

		$this->add_responsive_control(
			'links_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap ul a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'links_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tooltips_style',
			[
				'label'         => __( 'Tooltips', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'tooltips_size',
			[
				'label'         => __( 'Width', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px' ],
				'range'         => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap ul li a .zeus-navbar-tooltip' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'tooltips_typography',
				'selector'      => '{{WRAPPER}} .zeus-navbar-wrap ul li a .zeus-navbar-tooltip',
			]
		);

		$this->add_control(
			'tooltips_background_color',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap ul li a .zeus-navbar-tooltip' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .zeus-navbar-wrap.zeus-navbar-left ul li a .zeus-navbar-tooltip:before' => 'border-right-color: {{VALUE}};',
					'{{WRAPPER}} .zeus-navbar-wrap.zeus-navbar-right ul li a .zeus-navbar-tooltip:before' => 'border-left-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tooltips_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap ul li a .zeus-navbar-tooltip' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'tooltips_border',
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .zeus-navbar-wrap ul li a .zeus-navbar-tooltip',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'tooltips_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap ul li a .zeus-navbar-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'tooltips_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-navbar-wrap ul li a .zeus-navbar-tooltip',
			]
		);

		$this->add_responsive_control(
			'tooltips_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap ul li a .zeus-navbar-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'tooltips_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap.zeus-navbar-left ul li a .zeus-navbar-tooltip, {{WRAPPER}} .zeus-navbar-wrap.zeus-navbar-right ul li a .zeus-navbar-tooltip' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_branding_style',
			[
				'label'         => __( 'Branding', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'branding_background_color',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap .zeus-navbar-logo a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'branding_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap .zeus-navbar-logo a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'branding_border',
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .zeus-navbar-wrap .zeus-navbar-logo a',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'branding_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap .zeus-navbar-logo a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'branding_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-navbar-wrap .zeus-navbar-logo a',
			]
		);

		$this->add_responsive_control(
			'branding_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap .zeus-navbar-logo a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'     => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_off_canvas_style',
			[
				'label'         => __( 'Off Canvas', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'off_canvas_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'#zeus-off-canvas-{{ID}}.zeus-off-canvas-wrap .zeus-off-canvas-sidebar' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'#zeus-off-canvas-{{ID}}.zeus-off-canvas-wrap .zeus-off-canvas-sidebar *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_link_color',
			[
				'label'         => __( 'Link Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'#zeus-off-canvas-{{ID}}.zeus-off-canvas-wrap .zeus-off-canvas-sidebar a' => 'color: {{VALUE}};',
					'#zeus-off-canvas-{{ID}}.zeus-off-canvas-wrap .zeus-off-canvas-sidebar a *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_link_hover_color',
			[
				'label'         => __( 'Link Hover Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'#zeus-off-canvas-{{ID}}.zeus-off-canvas-wrap .zeus-off-canvas-sidebar a:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'off_canvas_box_shadow',
				'selector'      => '#zeus-off-canvas-{{ID}}.zeus-off-canvas-wrap .zeus-off-canvas-sidebar',
			]
		);

		$this->add_responsive_control(
			'off_canvas_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'#zeus-off-canvas-{{ID}}.zeus-off-canvas-wrap .zeus-off-canvas-sidebar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_close_btn_heading',
			[
				'label'         => __( 'Close Button', 'zeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
				'condition'     => [
					'off_canvas_close_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'off_canvas_close_btn_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'condition'     => [
					'off_canvas_close_button' => 'yes',
				],
				'selectors'     => [
					'#zeus-off-canvas-{{ID}}.zeus-off-canvas-wrap .zeus-off-canvas-close svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_close_btn_hover_color',
			[
				'label'         => __( 'Hover Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'condition'     => [
					'off_canvas_close_button' => 'yes',
				],
				'selectors'     => [
					'#zeus-off-canvas-{{ID}}.zeus-off-canvas-wrap .zeus-off-canvas-close:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_widget_style',
			[
				'label'         => __( 'Widgets', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'source' => 'sidebar',
				],
			]
		);

		$this->add_control(
			'off_canvas_widgets_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'condition'     => [
					'source' => 'sidebar',
				],
				'selectors'     => [
					'#zeus-off-canvas-{{ID}}.zeus-off-canvas-wrap .zeus-off-canvas-sidebar .sidebar-box' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'off_canvas_widgets_border',
				'selector'      => '#zeus-off-canvas-{{ID}}.zeus-off-canvas-wrap .zeus-off-canvas-sidebar .sidebar-box',
				'condition'     => [
					'source' => 'sidebar',
				],
			]
		);

		$this->add_responsive_control(
			'off_canvas_widgets_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'condition'     => [
					'source' => 'sidebar',
				],
				'selectors'     => [
					'#zeus-off-canvas-{{ID}}.zeus-off-canvas-wrap .zeus-off-canvas-sidebar .sidebar-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'off_canvas_widgets_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'condition'     => [
					'source' => 'sidebar',
				],
				'selectors'     => [
					'#zeus-off-canvas-{{ID}}.zeus-off-canvas-wrap .zeus-off-canvas-sidebar .sidebar-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_mobile_link_style',
			[
				'label'         => __( 'Mobile Link', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'mobile_link_typography',
				'selector'      => '{{WRAPPER}} .zeus-navbar-wrap.zeus-is-responsive .zeus-mobile-wrap a',
			]
		);

		$this->add_control(
			'mobile_link_background_color',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap.zeus-is-responsive .zeus-mobile-wrap a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'mobile_link_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap.zeus-is-responsive .zeus-mobile-wrap a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .zeus-navbar-wrap.zeus-is-responsive .zeus-mobile-wrap a .zeus-icon use' => 'stroke: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'mobile_link_hover_background_color',
			[
				'label'         => __( 'Background Color: Hover', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap.zeus-is-responsive .zeus-mobile-wrap a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'mobile_link_hover_color',
			[
				'label'         => __( 'Color: Hover', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap.zeus-is-responsive .zeus-mobile-wrap a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .zeus-navbar-wrap.zeus-is-responsive .zeus-mobile-wrap a:hover .zeus-icon use' => 'stroke: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'mobile_link_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-navbar-wrap.zeus-is-responsive .zeus-mobile-wrap a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'     => 'before',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings           = $this->get_settings_for_display();
		$id                 = $this->get_id();
		$source             = $settings['source'];
		$breakpoint         = $settings['mobile_breakpoint'];
		$custom_breakpoint  = $settings['mobile_custom_breakpoint'];

		$this->add_render_attribute( 'wrap', 'class', [
			'zeus-navbar-wrap',
			'zeus-navbar-' . $settings['navbar_position'],
		] );

		if ( 'yes' === $settings['show_off_canvas'] ) {
			$this->add_render_attribute( 'wrap', 'class', 'zeus-has-off-canvas' );
		}

		if ( 'yes' === $settings['show_mobile'] ) {
			$this->add_render_attribute( 'wrap', 'class', 'zeus-is-responsive' );

			if ( '959' === $breakpoint ) {
				$this->add_render_attribute( 'wrap', 'class', 'zeus-default-breakpoint' );
			}
		}

		$this->add_render_attribute( 'inner', 'class', 'zeus-navbar-inner' );
		$this->add_render_attribute( 'logo', 'class', 'zeus-navbar-logo' );

		if ( ! empty( $settings['branding_image']['url'] ) ) {
			$this->add_render_attribute( 'image', 'class', 'zeus-navbar-image' );
			$this->add_render_attribute( 'image-tag', 'src', $settings['branding_image']['url'] );
			$this->add_render_attribute( 'image-tag', 'alt', Control_Media::get_image_alt( $settings['branding_image'] ) );
		}

		$this->add_render_attribute( 'logo-text', 'class', 'zeus-navbar-logo-text' );

		if ( ! empty( $settings['branding_link']['url'] ) ) {
			$this->add_link_attributes( 'logo-link', $settings['branding_link'] );
		} else {
			$this->add_render_attribute( 'logo-link', 'href', esc_url( home_url( '/' ) ) );
		}
		$this->add_render_attribute( 'logo-link', 'title', esc_attr( get_bloginfo( 'name' ) ) );

		$this->add_render_attribute( 'mobile-wrap', 'class', 'zeus-mobile-wrap' );
		$this->add_render_attribute( 'mobile-btn', 'class', 'zeus-mobile-button' );
		$this->add_render_attribute( 'mobile-btn', 'href', '#' );

		$this->add_render_attribute( 'navbar', 'class', 'zeus-navbar' );

		$this->add_render_attribute( 'off-canvas-li', 'class', 'zeus-off-canvas-li' );
		$this->add_render_attribute( 'off-canvas-btn', 'class', 'zeus-off-canvas-button' );
		$this->add_render_attribute( 'off-canvas-btn', 'class', [
			'zeus-off-canvas-button',
			'zeus-navbar-link',
		] );
		$this->add_render_attribute( 'off-canvas-btn', 'href', '#zeus-off-canvas-' . esc_attr( $id ) );

		$this->add_render_attribute( 'off-canvas', 'id', 'zeus-off-canvas-' . esc_attr( $id ) );
		$this->add_render_attribute( 'off-canvas', 'class', [
			'zeus-off-canvas-wrap',
			'zeus-navbar-off-canvas',
			'zeus-navbar-' . $settings['navbar_position'],
		] );

		$this->add_render_attribute( 'off-canvas-close', 'type', 'button' );
		$this->add_render_attribute( 'off-canvas-close', 'class', 'zeus-off-canvas-close' );

		$this->add_render_attribute( 'off-canvas-sidebar', 'class', 'zeus-off-canvas-sidebar' );

		$this->add_render_attribute( 'off-canvas-overlay', 'class', 'zeus-off-canvas-overlay' ); ?>

		<div <?php $this->print_render_attribute_string( 'wrap' ); ?>>
			<div <?php $this->print_render_attribute_string( 'inner' ); ?>>
				<?php
				if ( 'yes' === $settings['show_branding'] ) { ?>
					<div <?php $this->print_render_attribute_string( 'logo' ); ?>>
						<?php
						if ( ! empty( $settings['branding_image']['url'] ) ) { ?>
							<div <?php $this->print_render_attribute_string( 'image' ); ?>>
								<a <?php $this->print_render_attribute_string( 'logo-link' ); ?>>
									<img <?php $this->print_render_attribute_string( 'image-tag' ); ?> />
								</a>
							</div>
							<?php
						} else {
							$string     = get_bloginfo( 'name' );
							$words      = explode( ' ', $string );
							$letters    = '';

							foreach ( $words as $value ) {
								$letters .= substr( $value, 0, 1 );
							} ?>

							<div <?php $this->print_render_attribute_string( 'logo-text' ); ?>>
								<a <?php $this->print_render_attribute_string( 'logo-link' ); ?>>
									<?php echo esc_attr( $letters ); ?>
								</a>
							</div>
							<?php
						} ?>
					</div>
					<?php
				}

				if ( 'yes' === $settings['show_mobile'] ) { ?>
					<div <?php $this->print_render_attribute_string( 'mobile-wrap' ); ?>>
						<a <?php $this->print_render_attribute_string( 'mobile-btn' ); ?>>
							<span class="zeus-mobile-icon">
								<i class="fas fa-bars"></i>
							</span>
							<?php
							if ( ! empty( $settings['mobile_title'] ) ) { ?>
								<span class="zeus-mobile-title"><?php echo esc_html( $settings['mobile_title'] ); ?></span>

								<?php
								if ( ! empty( $settings['mobile_close_title'] ) ) { ?>
									<span class="zeus-mobile-title zeus-mobile-close"><?php echo esc_html( $settings['mobile_close_title'] ); ?></span>
									<?php
								} ?>
								<?php
							} ?>
						</a>
					</div>
					<?php
				} ?>

				<ul <?php $this->print_render_attribute_string( 'navbar' ); ?>>
					<?php
					if ( 'yes' === $settings['show_off_canvas'] ) { ?>
						<li <?php $this->print_render_attribute_string( 'off-canvas-li' ); ?>>
							<a <?php $this->print_render_attribute_string( 'off-canvas-btn' ); ?>>
								<span class="zeus-navbar-icon">
									<i class="fas fa-bars"></i>
								</span>
								<?php
								if ( ! empty( $settings['off_canvas_title'] ) ) { ?>
									<span class="zeus-navbar-tooltip"><?php echo esc_html( $settings['off_canvas_title'] ); ?></span>
									<?php
								} ?>
							</a>
						</li>
						<?php
					} ?>

					<?php
					foreach ( $settings['navbar'] as $index => $item ) :
						$link = $this->get_repeater_setting_key( 'link', 'links', $index );
						$this->add_render_attribute( $link, 'class', 'zeus-navbar-link' );

						if ( ! empty( $item['link']['url'] ) ) {
							$this->add_link_attributes( $link, $item['link'] );
						} ?>

						<li>
							<a <?php $this->print_render_attribute_string( $link ); ?>>
								<?php
								if ( ! empty( $item['selected_icon'] ) ) { ?>
									<span class="zeus-navbar-icon">
										<?php \Elementor\Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
									</span>
									<span class="zeus-navbar-tooltip"><?php echo esc_html( $item['title'] ); ?></span>
									<?php
								} ?>
							</a>
						</li>

						<?php
					endforeach; ?>
				</ul>
			</div>
		</div>

		<?php
		if ( 'yes' === $settings['show_off_canvas'] ) { ?>
			<div <?php $this->print_render_attribute_string( 'off-canvas' ); ?>>
				<div <?php $this->print_render_attribute_string( 'off-canvas-sidebar' ); ?>>
					<?php
					if ( $settings['off_canvas_close_button'] ) { ?>
						<button <?php $this->print_render_attribute_string( 'off-canvas-close' ); ?>>
							<svg width="14" height="14" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
								<path d="M505.943,6.058c-8.077-8.077-21.172-8.077-29.249,0L6.058,476.693c-8.077,8.077-8.077,21.172,0,29.249
									C10.096,509.982,15.39,512,20.683,512c5.293,0,10.586-2.019,14.625-6.059L505.943,35.306
									C514.019,27.23,514.019,14.135,505.943,6.058z"/>
								<path d="M505.942,476.694L35.306,6.059c-8.076-8.077-21.172-8.077-29.248,0c-8.077,8.076-8.077,21.171,0,29.248l470.636,470.636
									c4.038,4.039,9.332,6.058,14.625,6.058c5.293,0,10.587-2.019,14.624-6.057C514.018,497.866,514.018,484.771,505.942,476.694z"/>
							</svg>
						</button>
						<?php
					} ?>

					<?php
					if ( ! empty( $source ) ) {
						if ( 'sidebar' === $source
							&& ( '0' !== $settings['sidebars'] && ! empty( $settings['sidebars'] ) ) ) {
							dynamic_sidebar( $settings['sidebars'] );
						} elseif ( 'template' === $source
							&& ( '0' !== $settings['templates'] && ! empty( $settings['templates'] ) ) ) {
							echo Plugin::instance()->frontend->get_builder_content_for_display( $settings['templates'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
					} ?>
				</div>
				<?php
				if ( $settings['off_canvas_overlay'] ) { ?>
					<div <?php $this->print_render_attribute_string( 'off-canvas-overlay' ); ?>></div>
					<?php
				} ?>
			</div>
			<?php
		} ?>

		<?php
		if ( 'yes' === $settings['show_mobile']
			&& '959' !== $breakpoint ) {
				$mobile_breakpoint = $breakpoint;

			if ( 'custom' === $breakpoint && ! empty( $custom_breakpoint ) && '959' !== $custom_breakpoint ) {
				$mobile_breakpoint = $custom_breakpoint;
			} ?>

			<style type="text/css">
				@media (min-width: <?php echo esc_attr( $mobile_breakpoint ) + 1; ?>px) {
					.zeus-navbar-wrap.zeus-is-responsive ul.zeus-navbar {
						display: block !important;
					}
				}

				@media (max-width: <?php echo esc_attr( $mobile_breakpoint ); ?>px) {
					.zeus-navbar-wrap.zeus-is-responsive {
						width: 100% !important;
						height: 50px;
						top: 32px;
					}

					body .zeus-navbar-wrap.zeus-is-responsive .zeus-mobile-wrap {
						display: block;
						float: right;
					}

					.zeus-navbar-wrap.zeus-is-responsive .zeus-navbar-inner {
						position: relative;
						padding: 0 !important;
					}

					.zeus-navbar-wrap.zeus-is-responsive .zeus-navbar-logo {
						float: left;
						margin: 0 !important;
					}

					.zeus-navbar-wrap.zeus-is-responsive ul.zeus-navbar {
						display: none;
						width: 100%;
						background-color: #e5c063;
						max-height: 400px;
						overflow-y: auto;
						-webkit-box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
						-moz-box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
						box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
					}

					.zeus-navbar-wrap.zeus-is-responsive ul.zeus-navbar li {
						margin-bottom: 0;
					}

					.zeus-navbar-wrap.zeus-is-responsive ul.zeus-navbar li.zeus-off-canvas-li {
						display: none;
					}

					.zeus-navbar-wrap.zeus-is-responsive ul.zeus-navbar li a {
						text-align: left;
					}

					.zeus-navbar-wrap.zeus-is-responsive ul.zeus-navbar li a .zeus-navbar-tooltip {
						position: relative;
						top: auto;
						left: auto;
						right: auto;
						width: auto;
						background-color: transparent;
						color: #fff;
						padding: 0;
						margin-left: 10px;
						border-radius: 0 !important;
						text-align: left;
						visibility: visible;
						opacity: 1;
						-webkit-transition: none;
						-moz-transition: none;
						-ms-transition: none;
						-o-transition: none;
						transition: none;
					}

					.zeus-navbar-wrap.zeus-is-responsive ul.zeus-navbar li a .zeus-navbar-tooltip:before {
						display: none;
					}

					.admin-bar .zeus-navbar-wrap.zeus-is-responsive {
						top: 32px;
					}
				}

				@media only screen and (max-width: 782px) {
					.admin-bar .zeus-navbar-wrap.zeus-is-responsive {
						top: 46px;
					}
				}

				@media only screen and (max-width: 600px) {
					.admin-bar .zeus-navbar-wrap.zeus-is-responsive {
						top: 0;
					}
				}
			</style>
			<?php
		}
	}
}
