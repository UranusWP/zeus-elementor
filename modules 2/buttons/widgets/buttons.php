<?php
namespace ZeusElementor\Modules\Buttons\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Buttons extends Widget_Base {

	public function get_name() {
		return 'zeus-buttons';
	}

	public function get_title() {
		return __( 'Buttons', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-link';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'button',
			'zeus',
		];
	}

	public function get_style_depends() {
		return [ 'zeus-buttons' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_buttons',
			[
				'label'         => __( 'Buttons', 'zeus-elementor' ),
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'buttons_repeater' );

		$repeater->start_controls_tab(
			'tab_button',
			[
				'label'         => __( 'Button', 'zeus-elementor' ),
			]
		);

		$repeater->add_control(
			'text',
			[
				'label'         => __( 'Text', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Click me', 'zeus-elementor' ),
				'placeholder'   => __( 'Click me', 'zeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'         => __( 'Link', 'zeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'zeus-elementor' ),
				'default'       => [
					'url' => '#',
				],
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label'         => __( 'Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'label_block'   => true,
				'default'       => [
					'value'   => '',
					'library' => 'solid',
				],
			]
		);

		$repeater->add_control(
			'icon_align',
			[
				'label'         => __( 'Icon Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'left',
				'options'       => [
					'left' => __( 'Before', 'zeus-elementor' ),
					'right' => __( 'After', 'zeus-elementor' ),
				],
				'condition'     => [
					'icon!' => '',
				],
			]
		);

		$repeater->add_control(
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
					'{{WRAPPER}} .zeus-buttons li{{CURRENT_ITEM}} .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .zeus-buttons li{{CURRENT_ITEM}} .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_control(
			'button_id',
			[
				'label'         => __( 'CSS ID', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => '',
				'label_block'   => false,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'button_classes',
			[
				'label'         => __( 'CSS Classes', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => '',
				'label_block'   => false,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'tab_style',
			[
				'label'         => __( 'Style', 'zeus-elementor' ),
			]
		);

		$repeater->add_responsive_control(
			'min_width',
			[
				'label'         => __( 'Min Width', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min'   => 10,
						'max'   => 1000,
						'step'  => 1,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-buttons li{{CURRENT_ITEM}} a' => 'min-width: {{SIZE}}px;',
				],
			]
		);

		$repeater->add_control(
			'background_color',
			[
				'label'         => __( 'Normal: Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-buttons li{{CURRENT_ITEM}} a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'button_text_color',
			[
				'label'         => __( 'Normal: Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-buttons li{{CURRENT_ITEM}} a' => 'color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'button_background_hover_color',
			[
				'label'         => __( 'Hover: Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-buttons li{{CURRENT_ITEM}} a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'hover_color',
			[
				'label'         => __( 'Hover: Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-buttons li{{CURRENT_ITEM}} a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'button_hover_border_color',
			[
				'label'         => __( 'Hover: Border Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'condition'     => [
					'border_border!' => '',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-buttons li{{CURRENT_ITEM}} a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'hover_animation',
			[
				'label'         => __( 'Hover Animation', 'zeus-elementor' ),
				'type'          => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'border',
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .zeus-buttons li{{CURRENT_ITEM}} a',
			]
		);

		$repeater->add_control(
			'border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-buttons li{{CURRENT_ITEM}} a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$repeater->add_responsive_control(
			'text_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-buttons li{{CURRENT_ITEM}} a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'buttons',
			[
				'label'         => __( 'buttons', 'zeus-elementor' ),
				'type'          => Controls_Manager::REPEATER,
				'default'   => [
					[
						'text'  => __( 'Button #1', 'zeus-elementor' ),
						'link'  => [
							'url' => '#',
						],
					],
					[
						'text'  => __( 'Button #2', 'zeus-elementor' ),
						'link'  => [
							'url' => '#',
						],
					],
				],
				'fields'        => $repeater->get_controls(),
				'title_field'   => '{{{ text }}}',
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
				'selectors'     => [
					'{{WRAPPER}} .zeus-buttons' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'zeus-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .zeus-buttons .zeus-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'         => __( 'Buttons', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'space',
			[
				'label'         => __( 'Space', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 12,
				],
				'range'         => [
					'px' => [
						'max'   => 100,
						'step'  => 1,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-buttons li' => 'margin-left: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .zeus-buttons li' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'buttons_min_width',
			[
				'label'         => __( 'Min Width', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min'   => 10,
						'max'   => 1000,
						'step'  => 1,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-buttons li a' => 'min-width: {{SIZE}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'buttons_typography',
				'selector'      => '{{WRAPPER}} .zeus-buttons li a',
			]
		);

		$this->start_controls_tabs( 'tabs_buttons_style' );

		$this->start_controls_tab(
			'tab_buttons_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'buttons_background_color',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-buttons li a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'buttons_text_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-buttons li a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_buttons_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'buttons_background_hover_color',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-buttons li a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'buttons_hover_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-buttons li a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'buttons_hover_border_color',
			[
				'label'         => __( 'Border Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-buttons li a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'buttons_border',
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .zeus-buttons li a',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'buttons_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-buttons li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'buttons_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-buttons li a',
			]
		);

		$this->add_responsive_control(
			'buttons_text_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-buttons li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'buttons_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-buttons li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .zeus-buttons li:first-child' => 'margin-left: {{LEFT}}{{UNIT}} !important;',
					'.rtl {{WRAPPER}} .zeus-buttons li:first-child' => 'margin-right: {{RIGHT}}{{UNIT}} !important;',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrap', 'class', 'zeus-buttons' ); ?>

		<ul <?php $this->print_render_attribute_string( 'wrap' ); ?>>
			<?php
			foreach ( $settings['buttons'] as $index => $item ) {

				$inner  = $this->get_repeater_setting_key( 'inner', 'buttons', $index );
				$link   = $this->get_repeater_setting_key( 'link', 'buttons', $index );
				$icon   = $this->get_repeater_setting_key( 'icon', 'buttons', $index );

				$this->add_render_attribute( $inner, 'class', [
					'zeus-button-inner',
					'elementor-repeater-item-' . $item['_id'],
				] );

				if ( ! empty( $item['link']['url'] ) ) {
					$this->add_link_attributes( $link, $item['link'] );
				}

				if ( $item['button_id'] ) {
					$this->add_render_attribute( $link, 'id', $item['button_id'] );
				}

				if ( $item['button_classes'] ) {
					$this->add_render_attribute( $link, 'class', $item['button_classes'] );
				}

				if ( $item['hover_animation'] ) {
					$this->add_render_attribute( $link, 'class', 'elementor-animation-' . $item['hover_animation'] );
				}

				if ( ! empty( $item['icon'] ) ) {
					$this->add_render_attribute( $icon, 'class', [
						'zeus-button-icon',
						'elementor-align-icon-' . $item['icon_align'],
					] );
				} ?>

				<li <?php $this->print_render_attribute_string( $inner ); ?>>
					<a <?php $this->print_render_attribute_string( $link ); ?>>
						<?php
						if ( ! empty( $item['icon'] ) && 'left' === $item['icon_align'] ) { ?>
							<span <?php $this->print_render_attribute_string( $icon ); ?>>
								<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
							<?php
						} ?>

						<span><?php echo esc_attr( $item['text'] ); ?></span>

						<?php
						if ( ! empty( $item['icon'] ) && 'right' === $item['icon_align'] ) { ?>
							<span <?php $this->print_render_attribute_string( $icon ); ?>>
								<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
							<?php
						} ?>
					</a>
				</li>
			<?php } ?>
		</ul>

		<?php
	}

	protected function content_template() { ?>
		<#
		if ( settings.buttons ) { #>

			<ul class="zeus-buttons">
				<#
				_.each( settings.buttons, function( item, index ) {

					var inner       = view.getRepeaterSettingKey( 'inner', 'buttons', index ),
						link        = view.getRepeaterSettingKey( 'link', 'buttons', index ),
						icon        = view.getRepeaterSettingKey( 'icon', 'buttons', index );

					view.addRenderAttribute( inner, 'class', [
						'zeus-button-inner',
						'elementor-repeater-item-' + item._id
					] );

					if ( '' !== item.link.url ) {
						view.addRenderAttribute( link, 'href', item.link.url );
					}

					if ( item.button_id ) {
						view.addRenderAttribute( link, 'id', item.button_id );
					}

					if ( item.button_classes ) {
						view.addRenderAttribute( link, 'class', item.button_classes );
					}

					if ( item.hover_animation ) {
						view.addRenderAttribute( link, 'class', 'elementor-animation-' + item.hover_animation );
					}

					if ( '' !== item.icon ) {
						view.addRenderAttribute( icon, 'class', [
							'zeus-button-icon',
							'elementor-align-icon-' + item.icon_align,
						] );
					} #>

					<# var iconHTML = elementor.helpers.renderIcon( view, item.icon, { 'aria-hidden': true }, 'i' , 'object' ); #>

					<li {{{ view.getRenderAttributeString( inner ) }}}>
						<a {{{ view.getRenderAttributeString( link ) }}}>
							<# if ( '' !== item.icon && 'left' == item.icon_align ) { #>
								<span {{{ view.getRenderAttributeString( icon ) }}}>
									{{{ iconHTML.value }}}
								</span>
							<# } #>

							<span>{{{ item.text }}}</span>

							<# if ( '' !== item.icon && 'right' == item.icon_align ) { #>
								<span {{{ view.getRenderAttributeString( icon ) }}}>
									{{{ iconHTML.value }}}
								</span>
							<# } #>
						</a>
					</li>

				<# } ); #>
			</ul>

		<# } #>

		<?php
	}

}
