<?php
namespace ZeusElementor\Modules\Tabs\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Tabs extends Widget_Base {

	public function get_name() {
		return 'zeus-tabs';
	}

	public function get_title() {
		return __( 'Tabs', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-window-tab';
	}

	public function get_categories() {
		return array( 'zeus-elements' );
	}

	public function get_keywords() {
		return array(
			'tabs',
			'accordion',
			'toggle',
			'zeus',
		);
	}

	public function get_script_depends() {
		return array( 'zeus-tabs' );
	}

	public function get_style_depends() {
		return array( 'zeus-tabs' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_tabs',
			array(
				'label' => __( 'Tabs', 'zeus-elementor' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			array(
				'name'        => 'tab_title',
				'label'       => __( 'Title & Content', 'zeus-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Tab Title', 'zeus-elementor' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'tab_icon',
			array(
				'name'    => 'tab_icon',
				'label'   => __( 'Icon', 'zeus-elementor' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => '',
					'library' => 'solid',
				),
			)
		);

		$repeater->add_control(
			'source',
			array(
				'name'    => 'source',
				'label'   => __( 'Select Source', 'zeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => array(
					'custom'   => __( 'Custom', 'zeus-elementor' ),
					'template' => __( 'Template', 'zeus-elementor' ),
				),
			)
		);

		$repeater->add_control(
			'tab_content',
			array(
				'name'       => 'tab_content',
				'label'      => __( 'Content', 'zeus-elementor' ),
				'type'       => Controls_Manager::WYSIWYG,
				'default'    => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'zeus-elementor' ),
				'show_label' => false,
				'condition'  => array(
					'source' => 'custom',
				),
				'dynamic'    => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'templates',
			array(
				'name'      => 'templates',
				'label'     => __( 'Content', 'zeus-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '0',
				'options'   => zeus_get_available_templates(),
				'condition' => array(
					'source' => 'template',
				),
			)
		);

		$this->add_control(
			'tabs',
			array(
				'label'       => __( 'Items', 'zeus-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'tab_title'   => __( 'Tab #1', 'zeus-elementor' ),
						'tab_content' => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'zeus-elementor' ),
					),
					array(
						'tab_title'   => __( 'Tab #2', 'zeus-elementor' ),
						'tab_content' => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'zeus-elementor' ),
					),
					array(
						'tab_title'   => __( 'Tab #3', 'zeus-elementor' ),
						'tab_content' => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'zeus-elementor' ),
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ tab_title }}}',
			)
		);

		$this->add_control(
			'tab_layout',
			array(
				'label'     => __( 'Layout', 'zeus-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'top',
				'options'   => array(
					'top'    => __( 'Top', 'zeus-elementor' ),
					'bottom' => __( 'Bottom', 'zeus-elementor' ),
					'left'   => __( 'Left', 'zeus-elementor' ),
					'right'  => __( 'Right', 'zeus-elementor' ),
				),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'align',
			array(
				'label'     => __( 'Alignment', 'zeus-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'left',
				'options'   => array(
					'left'    => array(
						'title' => __( 'Left', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => __( 'Center', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => __( 'Right', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-right',
					),
					'justify' => array(
						'title' => __( 'Justified', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'condition' => array(
					'tab_layout' => array( 'top', 'bottom' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional',
			array(
				'label' => __( 'Additional Options', 'zeus-elementor' ),
			)
		);

		$this->add_control(
			'active_item',
			array(
				'label'              => __( 'Active Item No', 'zeus-elementor' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 1,
				'max'                => 20,
				'frontend_available' => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Tab', 'zeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'tab_spacing',
			array(
				'label'     => __( 'Tab Spacing', 'zeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .zeus-tabs-wrap' => 'margin-left: -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .zeus-tabs-wrap .zeus-tab-title' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .zeus-tabs-left .zeus-tabs-wrap .zeus-tab-title, {{WRAPPER}} .zeus-tabs-right .zeus-tabs-wrap .zeus-tab-title' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tab_typography',
				'selector' => '{{WRAPPER}} .zeus-tabs .zeus-tab-title',
			)
		);

		$this->start_controls_tabs( 'tabs_tab_style' );

		$this->start_controls_tab(
			'tab_tab_normal',
			array(
				'label' => __( 'Normal', 'zeus-elementor' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tab_background_color',
				'selector' => '{{WRAPPER}} .zeus-tabs .zeus-tab-title',
			)
		);

		$this->add_control(
			'tab_color',
			array(
				'label'     => __( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-tabs .zeus-tab-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'tab_box_shadow',
				'selector'  => '{{WRAPPER}} .zeus-tabs .zeus-tab-title',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'tab_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .zeus-tabs .zeus-tab-title',
			)
		);

		$this->add_control(
			'tab_border_radius',
			array(
				'label'      => __( 'Border Radius', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-tabs .zeus-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'tab_padding',
			array(
				'label'      => __( 'Padding', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-tabs .zeus-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_tab_active',
			array(
				'label' => __( 'Active', 'zeus-elementor' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tab_active_background_color',
				'selector' => '{{WRAPPER}} .zeus-tabs .zeus-tab-title.zeus-active',
			)
		);

		$this->add_control(
			'tab_active_color',
			array(
				'label'     => __( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-tabs .zeus-tab-title.zeus-active' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'tab_active_box_shadow',
				'selector'  => '{{WRAPPER}} .zeus-tabs .zeus-tab-title.zeus-active',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'tab_active_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .zeus-tabs .zeus-tab-title.zeus-active',
			)
		);

		$this->add_control(
			'tab_active_border_radius',
			array(
				'label'      => __( 'Border Radius', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-tabs .zeus-tab-title.zeus-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => __( 'Content', 'zeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .zeus-tabs .zeus-tab-content',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_background_color',
				'selector' => '{{WRAPPER}} .zeus-tabs .zeus-tabs-content-wrap',
			)
		);

		$this->add_control(
			'content_color',
			array(
				'label'     => __( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-tabs .zeus-tab-content' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_spacing',
			array(
				'label'     => __( 'Content Spacing', 'zeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .zeus-tabs.zeus-tabs-top .zeus-tab-content' => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .zeus-tabs.zeus-tabs-bottom .zeus-tab-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .zeus-tabs.zeus-tabs-left .zeus-tab-content' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .zeus-tabs.zeus-tabs-right .zeus-tab-content' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_box_shadow',
				'selector' => '{{WRAPPER}} .zeus-tabs .zeus-tabs-content-wrap',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'content_border',
				'selector'      => '{{WRAPPER}} .zeus-tabs .zeus-tab-content, {{WRAPPER}} .zeus-tabs .zeus-tab-mobile-title',
			]
		);

		$this->add_control(
			'content_border_radius',
			array(
				'label'      => __( 'Border Radius', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-tabs .zeus-tabs-content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => __( 'Padding', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-tabs .zeus-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			array(
				'label' => __( 'Icon', 'zeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'icon_align',
			array(
				'label'   => __( 'Alignment', 'zeus-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'left'  => array(
						'title' => __( 'Start', 'zeus-elementor' ),
						'icon'  => 'eicon-h-align-left',
					),
					'right' => array(
						'title' => __( 'End', 'zeus-elementor' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default' => is_rtl() ? 'right' : 'left',
			)
		);

		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_icon_normal',
			array(
				'label' => __( 'Normal', 'zeus-elementor' ),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-tabs .zeus-tab-title i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_active',
			array(
				'label' => __( 'Active', 'zeus-elementor' ),
			)
		);

		$this->add_control(
			'icon_active_color',
			array(
				'label'     => __( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-tabs .zeus-tab-title.zeus-active i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_spacing',
			array(
				'label'     => __( 'Spacing', 'zeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .zeus-tabs .zeus-tab-title .zeus-icon-align-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .zeus-tabs .zeus-tab-title .zeus-icon-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$id_int   = substr( $this->get_id_int(), 0, 3 );
		$layout   = $settings['tab_layout'];

		$this->add_render_attribute(
			'wrap',
			'class',
			array(
				'zeus-tabs',
				'zeus-tabs-' . $layout,
			)
		);

		if ( ! empty( $settings['active_item'] ) ) {
			$data = array( $settings['active_item'] );
			$this->add_render_attribute( 'wrap', 'class', 'zeus-has-active-item' );
		}

		$this->add_render_attribute( 'tabs-wrap', 'class', 'zeus-tabs-wrap' );

		if ( 'top' === $layout
			|| 'bottom' === $layout ) {
			$this->add_render_attribute(
				'tabs-wrap',
				'class',
				array(
					'zeus-tabs-normal',
					'zeus-tabs-' . $settings['align'],
				)
			);
		} ?>

		<div <?php $this->print_render_attribute_string( 'wrap' ); ?>>
			<div <?php $this->print_render_attribute_string( 'tabs-wrap' ); ?>>
				<?php
				foreach ( $settings['tabs'] as $index => $item ) :
					$tab_count     = $index + 1;
					$active_item   = ( $tab_count === $settings['active_item'] ) ? ' zeus-active' : '';
					$tab_title_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );

					$this->add_render_attribute(
						$tab_title_key,
						array(
							'id'            => 'zeus-tab-title-' . $id_int . $tab_count,
							'class'         => array( 'zeus-tab-title', $active_item ),
							'data-tab'      => $tab_count,
							'tabindex'      => $id_int . $tab_count,
							'role'          => 'tab',
							'aria-controls' => 'zeus-tab-content-' . $id_int . $tab_count,
						)
					);
					?>

					<div <?php $this->print_render_attribute_string( $tab_title_key ); ?>>
						<?php
						if ( ! empty( $item['tab_icon'] )
							&& 'left' === $settings['icon_align'] ) {
							?>
							<span class="zeus-icon-align-<?php echo esc_html( $settings['icon_align'] ); ?>">
								<?php \Elementor\Icons_Manager::render_icon( $item['tab_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							</span>
							<?php
						}

						if ( $item['tab_title'] ) {
							$this->print_unescaped_setting( 'tab_title', 'tabs', $index );
						}

						if ( ! empty( $item['tab_icon'] )
							&& 'right' === $settings['icon_align'] ) {
							?>
							<span class="zeus-icon-align-<?php echo esc_html( $settings['icon_align'] ); ?>">
								<?php \Elementor\Icons_Manager::render_icon( $item['tab_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							</span>
							<?php
						}
						?>
					</div>
					<?php
				endforeach;
				?>
			</div>

			<div class="zeus-tabs-content-wrap">
				<?php
				foreach ( $settings['tabs'] as $index => $item ) :
					$tab_count            = $index + 1;
					$active_item          = ( $tab_count === $settings['active_item'] ) ? ' zeus-active' : '';
					$tab_content_key      = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );
					$tab_title_mobile_key = $this->get_repeater_setting_key( 'tab_title_mobile', 'tabs', $tab_count );

					$this->add_render_attribute(
						$tab_content_key,
						array(
							'id'              => 'zeus-tab-content-' . $tab_count,
							'class'           => array( 'zeus-tab-content', $active_item ),
							'role'            => 'tabpanel',
							'aria-labelledby' => 'zeus-tab-title-' . $id_int . $tab_count,
						)
					);

					$this->add_render_attribute(
						$tab_title_mobile_key,
						array(
							'class'    => array( 'zeus-tab-title', 'zeus-tab-mobile-title', $active_item ),
							'tabindex' => $id_int . $tab_count,
							'data-tab' => $tab_count,
							'role'     => 'tab',
						)
					);
					?>

					<div <?php $this->print_render_attribute_string( $tab_title_mobile_key ); ?>>
						<?php
						if ( ! empty( $item['tab_icon'] )
							&& 'left' === $settings['icon_align'] ) {
							?>
							<span class="zeus-icon-align-<?php echo esc_html( $settings['icon_align'] ); ?>">
								<?php \Elementor\Icons_Manager::render_icon( $item['tab_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							</span>
							<?php
						}

						if ( $item['tab_title'] ) {
							$this->print_unescaped_setting( 'tab_title', 'tabs', $index );
						}

						if ( ! empty( $item['tab_icon'] )
							&& 'right' === $settings['icon_align'] ) {
							?>
							<span class="zeus-icon-align-<?php echo esc_html( $settings['icon_align'] ); ?>">
								<?php \Elementor\Icons_Manager::render_icon( $item['tab_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							</span>
							<?php
						}
						?>
					</div>

					<div <?php $this->print_render_attribute_string( $tab_content_key ); ?>>
						<?php
						if ( 'custom' === $item['source']
							&& ! empty( $item['tab_content'] ) ) {
							$this->print_text_editor( $item['tab_content'] );
						} elseif ( 'template' === $item['source']
							&& ( '0' !== $item['templates'] && ! empty( $item['templates'] ) ) ) {
							echo Plugin::instance()->frontend->get_builder_content_for_display( $item['templates'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
						?>
					</div>
					<?php
				endforeach;
				?>
			</div>
		</div>

		<?php
	}
}
