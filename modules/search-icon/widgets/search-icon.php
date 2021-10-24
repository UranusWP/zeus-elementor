<?php
namespace ZeusElementor\Modules\SearchIcon\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class SearchIcon extends Widget_Base {

	public function get_name() {
		return 'zeus-search-icon';
	}

	public function get_title() {
		return __( 'Search Icon', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-search';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'search',
			'search icon',
			'header',
			'site',
			'zeus',
		];
	}

	public function get_script_depends() {
		return [ 'zeus-search-icon' ];
	}

	public function get_style_depends() {
		return [ 'zeus-search-icon' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_search_icon',
			[
				'label'         => __( 'Search Icon', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label'         => __( 'Search Style', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'dropdown',
				'options'       => [
					'dropdown'  => __( 'Drop Down', 'zeus-elementor' ),
					'overlay'   => __( 'Overlay', 'zeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'placeholder',
			[
				'label'         => __( 'Placeholder', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Search', 'zeus-elementor' ),
				'placeholder'   => __( 'Search', 'zeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
				'condition'     => [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'overlay_text',
			[
				'label'         => __( 'Input Text', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Type your search', 'zeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->add_control(
			'source',
			[
				'label'         => _x( 'Source', 'Posts Type', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => $this->get_post_types(),
				'default'       => 'any',
				'label_block'   => true,
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
				'default'       => '',
				'prefix_class' => 'zeus%s-align-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'         => __( 'Search Icon', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'         => __( 'Font Size', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default' => [
					'size' => 12,
				],
				'range' => [
					'min' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .zeus-search-icon-wrap .zeus-search-toggle svg' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-search-icon-wrap .zeus-search-toggle svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_hover',
			[
				'label' => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-search-icon-wrap .zeus-search-toggle:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_dropdown_style',
			[
				'label'         => esc_html__( 'Drop Down', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_responsive_control(
			'dropdown_width',
			[
				'label'         => __( 'Width', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'size' => 260,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .zeus-search-dropdown' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dropdown_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-search-dropdown' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'dropdown_border',
				'label'         => __( 'Border', 'zeus-elementor' ),
				'placeholder'   => '1px',
				'selector'      => '{{WRAPPER}} .zeus-search-dropdown',
				'separator'     => 'before',
				'condition'     => [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'dropdown_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-search-dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'dropdown_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-search-dropdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'style' => 'dropdown',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_overlay_style',
			[
				'label'         => esc_html__( 'Overlay', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->add_control(
			'overlay_bg',
			[
				'label'         => __( 'Background', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'#zeus-search-{{ID}}' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_overlay_close_style',
			[
				'label'         => esc_html__( 'Overlay Close Button', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_overlay_close_style' );

		$this->start_controls_tab(
			'tab_overlay_close_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->add_control(
			'overlay_close_bg',
			[
				'label'         => __( 'Background', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'#zeus-search-{{ID}} a.zeus-search-overlay-close' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->add_control(
			'overlay_close_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'#zeus-search-{{ID}} a.zeus-search-overlay-close span:before, #zeus-search-{{ID}}  a.zeus-search-overlay-close span:after' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_overlay_close_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->add_control(
			'overlay_close_bg_hover',
			[
				'label'         => __( 'Background', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'#zeus-search-{{ID}} a.zeus-search-overlay-close:hover' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->add_control(
			'overlay_close_color_hover',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'#zeus-search-{{ID}} a.zeus-search-overlay-close:hover span:before, #zeus-search-{{ID}}  a.zeus-search-overlay-close:hover span:after' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_input_style',
			[
				'label'         => esc_html__( 'Input', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_input_style' );

		$this->start_controls_tab(
			'tab_input_normal',
			[
				'label' => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'input_bg',
			[
				'label'         => __( 'Background', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} form input' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'input_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} form input, #zeus-search-{{ID}} form input, #zeus-search-{{ID}} form label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_input_hover',
			[
				'label' => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'input_bg_hover',
			[
				'label'         => __( 'Background', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} form input:hover' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'input_color_hover',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} form input:hover, #zeus-search-{{ID}} form input:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_border_color_hover',
			[
				'label'         => __( 'Border Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} form input:hover, #zeus-search-{{ID}} form input:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_input_focus',
			[
				'label' => __( 'Focus', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'input_bg_focus',
			[
				'label'         => __( 'Background', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} form input:focus' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'input_color_focus',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} form input:focus, #zeus-search-{{ID}} form input:focus, #zeus-search-{{ID}} form label:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_border_color_focus',
			[
				'label'         => __( 'Border Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} form input:focus, #zeus-search-{{ID}} form input:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'input_focus_box_shadow',
				'selector'      => '{{WRAPPER}} form input:focus, #zeus-search-{{ID}} form input:focus',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'input_border',
				'label'         => __( 'Border', 'zeus-elementor' ),
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} form input, #zeus-search-{{ID}} form input',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'input_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} form input, #zeus-search-{{ID}} form input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'input_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} form input, #zeus-search-{{ID}} form input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'input_typo',
				'selector'      => '{{WRAPPER}} form input, #zeus-search-{{ID}} form input, #zeus-search-{{ID}} form label',
			]
		);

		$this->end_controls_section();

	}

	private static function get_post_types( $args = [] ) {
		$post_type_args = [
			'show_in_nav_menus' => true,
		];

		if ( ! empty( $args['post_type'] ) ) {
			$post_type_args['name'] = $args['post_type'];
		}

		$_post_types = get_post_types( $post_type_args, 'objects' );

		$post_types  = [];
		$post_types['any']  = esc_html__( 'Any', 'zeus-elementor' );

		foreach ( $_post_types as $post_type => $object ) {
			$post_types[ $post_type ] = $object->label;
		}

		return $post_types;
	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$id         = $this->get_id();

		// Style
		$style = $settings['style'];

		$this->add_render_attribute( 'search-icon-wrap', 'class',
			[
				'zeus-search-icon-wrap',
				'zeus-search-icon-' . $style,
			]
		);

		$this->add_render_attribute( 'form-wrap', 'id', 'zeus-search-' . esc_attr( $id ) );
		$this->add_render_attribute( 'form-wrap', 'class', 'zeus-search-' . $style );

		// Link
		$this->add_render_attribute( 'link', 'href', '#' );
		$this->add_render_attribute( 'link', 'class', 'zeus-search-toggle' );

		if ( ! empty( $style ) ) {
			$this->add_render_attribute( 'link', 'class', 'zeus-' . $style . '-link' );
		}

		$this->add_render_attribute( 'input', 'type', 'text' );
		$this->add_render_attribute( 'input', 'class', 'field' );
		$this->add_render_attribute( 'input', 'name', 's' );

		// Placeholder
		if ( ! empty( $settings['placeholder'] ) ) {
			$this->add_render_attribute( 'input', 'placeholder', $settings['placeholder'] );
		} ?>

		<div <?php $this->print_render_attribute_string( 'search-icon-wrap' ); ?>>
			<a <?php $this->print_render_attribute_string( 'link' ); ?>>
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 512 512"><path d="M495,466.2L377.2,348.4c29.2-35.6,46.8-81.2,46.8-130.9C424,103.5,331.5,11,217.5,11C103.4,11,11,103.5,11,217.5 S103.4,424,217.5,424c49.7,0,95.2-17.5,130.8-46.7L466.1,495c8,8,20.9,8,28.9,0C503,487.1,503,474.1,495,466.2z M217.5,382.9 C126.2,382.9,52,308.7,52,217.5S126.2,52,217.5,52C308.7,52,383,126.3,383,217.5S308.7,382.9,217.5,382.9z"/></svg>
			</a>

			<div <?php $this->print_render_attribute_string( 'form-wrap' ); ?>>
				<?php
				if ( 'dropdown' === $style ) { ?>
					<form method="get" class="zeus-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<input <?php $this->print_render_attribute_string( 'input' ); ?>>
						<?php
						if ( ! empty( $settings['source'] ) && 'any' !== $settings['source'] ) { ?>
							<input type="hidden" name="post_type" value="<?php echo esc_attr( $settings['source'] ); ?>">
							<?php
						} ?>
					</form>
					<?php
				} elseif ( 'overlay' === $style ) { ?>
					<div class="container">
						<form method="get" class="zeus-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<a href="#" class="zeus-search-overlay-close"><span></span></a>
							<input class="zeus-search-overlay-input" type="search" name="s" autocomplete="off" value="">
							<?php
							if ( ! empty( $settings['source'] ) && 'any' !== $settings['source'] ) { ?>
								<input type="hidden" name="post_type" value="<?php echo esc_attr( $settings['source'] ); ?>">
								<?php
							} ?>
							<label><?php echo esc_attr( $settings['overlay_text'] ); ?><span><i></i><i></i><i></i></span></label>
						</form>
					</div>
					<?php
				} ?>
			</div>
		</div>

		<?php
	}

	// No template because it cause a js error in the edit mode
	protected function content_template() {}

}
