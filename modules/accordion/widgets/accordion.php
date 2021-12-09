<?php
namespace ZeusElementor\Modules\Accordion\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Accordion extends Widget_Base {

	public function get_name() {
		return 'zeus-accordion';
	}

	public function get_title() {
		return __( 'Accordion', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-send-backward';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [ 'accordion', 'toggle', 'tabs', 'zeus' ];
	}

	public function get_script_depends() {
		return [ 'zeus-accordion' ];
	}

	public function get_style_depends() {
		return [ 'zeus-accordion' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_accordion',
			[
				'label'         => __( 'Accordion', 'zeus-elementor' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'name'          => 'tab_title',
				'label'         => __( 'Title & Content', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Accordion Title', 'zeus-elementor' ),
				'label_block'   => true,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'source',
			[
				'name'          => 'source',
				'label'         => __( 'Select Source', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'custom',
				'options'       => [
					'custom'    => __( 'Custom', 'zeus-elementor' ),
					'template'  => __( 'Template', 'zeus-elementor' ),
				],
			]
		);

		$repeater->add_control(
			'tab_content',
			[
				'name'          => 'tab_content',
				'label'         => __( 'Content', 'zeus-elementor' ),
				'type'          => Controls_Manager::WYSIWYG,
				'default'       => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'zeus-elementor' ),
				'show_label'    => false,
				'condition'     => [
					'source' => 'custom',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'templates',
			[
				'name'          => 'templates',
				'label'         => __( 'Content', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => '0',
				'options'       => zeus_get_available_templates(),
				'condition'     => [
					'source' => 'template',
				],
			]
		);

		$repeater->add_control(
			'custom_icon',
			[
				'label'         => __( 'Custom Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'label_block'   => false,
				'skin'          => 'inline',
			]
		);

		$repeater->add_control(
			'custom_active_icon',
			[
				'label'         => __( 'Custom Active Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'label_block'   => false,
				'skin'          => 'inline',
				'condition'     => [
					'custom_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'tabs',
			[
				'label'         => __( 'Items', 'zeus-elementor' ),
				'type'          => Controls_Manager::REPEATER,
				'default' => [
					[
						'tab_title'     => __( 'Accordion #1', 'zeus-elementor' ),
						'tab_content'   => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'zeus-elementor' ),
					],
					[
						'tab_title'     => __( 'Accordion #2', 'zeus-elementor' ),
						'tab_content'   => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'zeus-elementor' ),
					],
					[
						'tab_title'     => __( 'Accordion #3', 'zeus-elementor' ),
						'tab_content'   => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'zeus-elementor' ),
					],
				],
				'fields' => $repeater->get_controls(),
				'title_field'   => '{{{ tab_title }}}',
			]
		);

		$this->add_control(
			'icon',
			[
				'label'         => __( 'Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'label_block'   => false,
				'default'       => [
					'value'   => 'fas fa-plus',
					'library' => 'solid',
				],
				'skin'          => 'inline',
			]
		);

		$this->add_control(
			'active_icon',
			[
				'label'         => __( 'Active Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'label_block'   => false,
				'default'       => [
					'value'   => 'fas fa-minus',
					'library' => 'solid',
				],
				'skin'          => 'inline',
				'condition'     => [
					'icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label'         => __( 'HTML Tag', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'div',
				'options'       => zeus_get_available_tags(),
			]
		);

		$this->add_control(
			'active_item',
			[
				'label'         => __( 'Active Item No', 'zeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'min'           => 1,
				'max'           => 20,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'         => __( 'Item', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .zeus-accordion .zeus-accordion-title'   => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .zeus-accordion .zeus-accordion-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_spacing',
			[
				'label'         => __( 'Item Spacing', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-accordion .zeus-accordion-item + .zeus-accordion-item' => 'margin-top: {{SIZE}}{{UNIT}};',
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
				'name'          => 'title_typography',
				'selector'      => '{{WRAPPER}} .zeus-accordion .zeus-accordion-title',
			]
		);

		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'          => 'title_background_color',
				'selector'      => '{{WRAPPER}} .zeus-accordion .zeus-accordion-title',
			)
		);

		$this->add_control(
			'title_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-accordion .zeus-accordion-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'title_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-accordion .zeus-accordion-item .zeus-accordion-title',
				'separator'     => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'title_border',
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .zeus-accordion .zeus-accordion-item .zeus-accordion-title',
			]
		);

		$this->add_control(
			'title_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-accordion .zeus-accordion-item .zeus-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-accordion .zeus-accordion-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_active',
			[
				'label'         => __( 'Active', 'zeus-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'          => 'title_active_background_color',
				'selector'      => '{{WRAPPER}} .zeus-accordion .zeus-accordion-item.zeus-active .zeus-accordion-title',
			)
		);

		$this->add_control(
			'title_active_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-accordion .zeus-accordion-item.zeus-active .zeus-accordion-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'title_active_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-accordion .zeus-accordion-item.zeus-active .zeus-accordion-title',
				'separator'     => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'title_active_border',
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .zeus-accordion .zeus-accordion-item.zeus-active .zeus-accordion-title',
			]
		);

		$this->add_control(
			'title_active_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-accordion .zeus-accordion-item.zeus-active .zeus-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label'         => __( 'Icon', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label'         => __( 'Alignment', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left' => [
						'title' => __( 'Start', 'zeus-elementor' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'End', 'zeus-elementor' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'       => is_rtl() ? 'left' : 'right',
				'toggle'        => false,
				'label_block'   => false,
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
			'icon_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-accordion .zeus-accordion-title .zeus-accordion-icon i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_active',
			[
				'label'         => __( 'Active', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'icon_active_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-accordion .zeus-accordion-item.zeus-active .zeus-accordion-title .zeus-accordion-icon i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_spacing',
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
					'{{WRAPPER}} .zeus-accordion .zeus-accordion-icon.zeus-accordion-icon-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .zeus-accordion .zeus-accordion-icon.zeus-accordion-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label'         => __( 'Content', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'content_typography',
				'selector'      => '{{WRAPPER}} .zeus-accordion .zeus-accordion-content',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'          => 'content_background_color',
				'selector'      => '{{WRAPPER}} .zeus-accordion .zeus-accordion-content',
			)
		);

		$this->add_control(
			'content_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-accordion .zeus-accordion-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_spacing',
			[
				'label'         => __( 'Spacing', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'separator'     => 'before',
				'selectors'     => [
					'{{WRAPPER}} .zeus-accordion .zeus-accordion-content'  => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'content_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-accordion .zeus-accordion-content',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'content_border',
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .zeus-accordion .zeus-accordion-content',
			]
		);

		$this->add_control(
			'content_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-accordion .zeus-accordion-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-accordion .zeus-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$id = $this->get_id();
		$title_tag  = $settings['title_html_tag'];
		$data = [];

		if ( ! empty( $settings['active_item'] ) ) {
			$data['active_item'] = $settings['active_item'];
			$this->add_render_attribute( 'wrap', 'class', 'zeus-has-active-item' );
		}

		$this->add_render_attribute( 'wrap', 'id', 'zeus-accordion-' . esc_attr( $id ) );
		$this->add_render_attribute( 'wrap', 'class', 'zeus-accordion' );
		$this->add_render_attribute( 'wrap', 'data-settings', wp_json_encode( $data ) ); ?>

		<div <?php $this->print_render_attribute_string( 'wrap' ); ?>>

			<?php
			foreach ( $settings['tabs'] as $index => $item ) :
				$tab_count = $index + 1;
				$tab_title_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
				$tab_content_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

				$this->add_render_attribute( $tab_title_key, 'class', 'zeus-accordion-title' );
				$this->add_render_attribute( $tab_content_key, 'class', 'zeus-accordion-content' );
				$this->add_inline_editing_attributes( $tab_content_key, 'advanced' ); ?>

				<div class="zeus-accordion-item<?php echo ( $tab_count === $settings['active_item'] ) ? ' zeus-active' : ''; ?>">
					<<?php echo esc_attr( $title_tag ); ?> <?php $this->print_render_attribute_string( $tab_title_key ); ?>>
						<?php
						if ( ! empty( $settings['icon']['value'] ) || ! empty( $item['custom_icon']['value'] ) ) {
							?>
							<span class="zeus-accordion-icon zeus-accordion-icon-<?php echo esc_attr( $settings['icon_align'] ); ?>" aria-hidden="true">
								<?php
								if ( ! empty( $item['custom_icon']['value'] ) ) {
									?>
									<span class="zeus-accordion-icon-closed"><?php Icons_Manager::render_icon( $item['custom_icon'] ); ?></span>
									<?php
								} else {
									?>
									<span class="zeus-accordion-icon-closed"><?php Icons_Manager::render_icon( $settings['icon'] ); ?></span>
									<?php
								}
								if ( ! empty( $item['custom_active_icon']['value'] ) ) {
									?>
									<span class="zeus-accordion-icon-opened"><?php Icons_Manager::render_icon( $item['custom_active_icon'] ); ?></span>
									<?php
								} else {
									?>
									<span class="zeus-accordion-icon-opened"><?php Icons_Manager::render_icon( $settings['active_icon'] ); ?></span>
									<?php
								}
								?>
							</span>
							<?php
						}

						$this->print_unescaped_setting( 'tab_title', 'tabs', $index ); ?>
					</<?php echo esc_attr( $title_tag ); ?>>

					<div <?php $this->print_render_attribute_string( $tab_content_key ); ?>>
						<?php
						if ( 'custom' === $item['source'] && ! empty( $item['tab_content'] ) ) {
							$this->print_text_editor( $item['tab_content'] );
						} elseif ( 'template' === $item['source'] && ( '0' !== $item['templates'] && ! empty( $item['templates'] ) ) ) {
							echo Plugin::instance()->frontend->get_builder_content_for_display( $item['templates'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
						?>
					</div>
				</div>
				<?php
			endforeach; ?>

		</div>

		<?php
	}
}
