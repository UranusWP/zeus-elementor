<?php
namespace ZeusElementor\Modules\Toggle\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Toggle extends Widget_Base {

	public function get_name() {
		return 'zeus-toggle';
	}

	public function get_title() {
		return __( 'Toggle', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-toggle-on2';
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
		return array( 'zeus-toggle' );
	}

	public function get_style_depends() {
		return array( 'zeus-toggle' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_primary',
			array(
				'label' => __( 'Primary', 'zeus-elementor' ),
			)
		);

		$this->add_control(
			'primary_label',
			array(
				'label'   => __( 'Label', 'zeus-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Monthly', 'zeus-elementor' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'primary_type',
			array(
				'label'   => __( 'Content Type', 'zeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'content'  => __( 'Content', 'zeus-elementor' ),
					'template' => __( 'Template', 'zeus-elementor' ),
					'image'    => __( 'Image', 'zeus-elementor' ),
				),
				'default' => 'content',
			)
		);

		$this->add_control(
			'primary_content',
			array(
				'label'     => __( 'Content', 'zeus-elementor' ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => __( 'Add your content here', 'zeus-elementor' ),
				'condition' => array(
					'primary_type' => 'content',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'primary_template',
			array(
				'label'     => __( 'Choose Template', 'zeus-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => zeus_get_available_templates(),
				'default'   => '0',
				'condition' => array(
					'primary_type' => 'template',
				),
			)
		);

		$this->add_control(
			'primary_image',
			array(
				'label'     => __( 'Image', 'zeus-elementor' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'primary_type' => 'image',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'primary_image',
				'label'     => __( 'Image Size', 'zeus-elementor' ),
				'default'   => 'large',
				'condition' => array(
					'primary_type' => 'image',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_secondary',
			array(
				'label' => __( 'Secondary', 'zeus-elementor' ),
			)
		);

		$this->add_control(
			'secondary_label',
			array(
				'label'   => __( 'Label', 'zeus-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Yearly', 'zeus-elementor' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'secondary_type',
			array(
				'label'   => __( 'Content Type', 'zeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'content'  => __( 'Content', 'zeus-elementor' ),
					'template' => __( 'Template', 'zeus-elementor' ),
					'image'    => __( 'Image', 'zeus-elementor' ),
				),
				'default' => 'content',
			)
		);

		$this->add_control(
			'secondary_content',
			array(
				'label'     => __( 'Content', 'zeus-elementor' ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => __( 'Add your content here', 'zeus-elementor' ),
				'condition' => array(
					'secondary_type' => 'content',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'secondary_template',
			array(
				'label'     => __( 'Choose Template', 'zeus-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => zeus_get_available_templates(),
				'default'   => '0',
				'condition' => array(
					'secondary_type' => 'template',
				),
			)
		);

		$this->add_control(
			'secondary_image',
			array(
				'label'     => __( 'Image', 'zeus-elementor' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'secondary_type' => 'image',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'secondary_image',
				'label'     => __( 'Image Size', 'zeus-elementor' ),
				'default'   => 'large',
				'condition' => array(
					'secondary_type' => 'image',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => esc_html__( 'Toggle', 'zeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'toggle_align',
			array(
				'label'     => __( 'Alignment', 'zeus-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Left', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => __( 'Center', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => __( 'Right', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .zeus-toggle-container .zeus-toggle-wrap' => 'display: -webkit-box; display: -webkit-flex; display: -ms-flexbox; display: flex; -webkit-justify-content: {{VALUE}}; justify-content: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'toggle_size',
			array(
				'label'      => __( 'Size', 'zeus-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 14,
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-toggle' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'toggle_labels_spacing',
			array(
				'label'      => __( 'Labels Spacing', 'zeus-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 25,
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-toggle-container .zeus-toggle-wrap .zeus-toggle' => 'margin: 0 {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'toggle_margin',
			array(
				'label'      => __( 'Margin', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-toggle-container .zeus-toggle-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_toggle_style' );

		$this->start_controls_tab(
			'tab_toggle_normal',
			array(
				'label' => __( 'Normal', 'zeus-elementor' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'toggle_normal_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .zeus-toggle-container .zeus-toggle-wrap .zeus-toggle span:before',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'toggle_normal_border',
				'label'    => __( 'Border', 'zeus-elementor' ),
				'selector' => '{{WRAPPER}} .zeus-toggle-container .zeus-toggle-wrap .zeus-toggle span:before',
			)
		);

		$this->add_control(
			'toggle_normal_border_radius',
			array(
				'label'      => __( 'Border Radius', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-toggle-container .zeus-toggle-wrap .zeus-toggle span:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_toggle_active',
			array(
				'label' => __( 'Active', 'zeus-elementor' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'toggle_activel_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .zeus-toggle-container .zeus-toggle-wrap.zeus-toggle-on span:before',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'toggle_active_border',
				'label'    => __( 'Border', 'zeus-elementor' ),
				'selector' => '{{WRAPPER}} .zeus-toggle-container .zeus-toggle-wrap.zeus-toggle-on span:before',
			)
		);

		$this->add_control(
			'toggle_active_border_radius',
			array(
				'label'      => __( 'Border Radius', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-toggle-container .zeus-toggle-wrap.zeus-toggle-on span:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'controller_heading',
			array(
				'label'     => __( 'Controller', 'zeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'controller_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .zeus-toggle-container .zeus-toggle-wrap .zeus-toggle span:after',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'controller_border',
				'label'    => __( 'Border', 'zeus-elementor' ),
				'selector' => '{{WRAPPER}} .zeus-toggle-container .zeus-toggle-wrap .zeus-toggle span:after',
			)
		);

		$this->add_control(
			'controller_border_radius',
			array(
				'label'      => __( 'Border Radius', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-toggle-container .zeus-toggle-wrap .zeus-toggle span:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_labels_style',
			array(
				'label' => __( 'Labels', 'zeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'labels_typography',
				'label'    => __( 'Typography', 'zeus-elementor' ),
				'selector' => '{{WRAPPER}} .zeus-toggle-container .zeus-toggle-wrap .zeus-text',
			)
		);

		$this->start_controls_tabs( 'tabs_labels_style' );

		$this->start_controls_tab(
			'tab_primary_label',
			array(
				'label' => __( 'Primary', 'zeus-elementor' ),
			)
		);

		$this->add_control(
			'primary_label_color',
			array(
				'label'     => __( 'Label Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-toggle-container .zeus-toggle-wrap .zeus-text.zeus-primary' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'active_primary_label_color',
			array(
				'label'     => __( 'Active Label Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-toggle-container .zeus-toggle-wrap.zeus-toggle-on .zeus-text.zeus-primary' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_secondary_label',
			array(
				'label' => __( 'Secondary', 'zeus-elementor' ),
			)
		);

		$this->add_control(
			'secondary_label_color',
			array(
				'label'     => __( 'Label Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-toggle-container .zeus-toggle-wrap .zeus-text.zeus-secondary' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'active_secondary_label_color',
			array(
				'label'     => __( 'Active Label Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-toggle-container .zeus-toggle-wrap.zeus-toggle-on .zeus-text.zeus-secondary' => 'color: {{VALUE}}',
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
				'condition'     => [
					'primary_type' => 'content',
				],
			)
		);

		$this->add_responsive_control(
			'content_align',
			array(
				'label'     => __( 'Alignment', 'zeus-elementor' ),
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
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .zeus-toggle-container' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => __( 'Typography', 'zeus-elementor' ),
				'selector' => '{{WRAPPER}} .zeus-toggle-container .zeus-toggle-primary-wrap, {{WRAPPER}} .zeus-toggle-container .zeus-toggle-secondary-wrap',
			)
		);

		$this->add_control(
			'content_color',
			array(
				'label'     => __( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-toggle-container' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			array(
				'label' => __( 'Image', 'zeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'primary_type' => 'image',
				],
			)
		);

		$this->add_responsive_control(
			'image_width',
			array(
				'label'          => __( 'Width', 'zeus-elementor' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => array(
					'unit' => '%',
				),
				'tablet_default' => array(
					'unit' => '%',
				),
				'mobile_default' => array(
					'unit' => '%',
				),
				'size_units'     => array( '%', 'px', 'vw' ),
				'range'          => array(
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
					'vw' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'      => array(
					'{{WRAPPER}} .zeus-toggle-img img' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_space',
			array(
				'label'          => __( 'Max Width', 'zeus-elementor' ) . ' (%)',
				'type'           => Controls_Manager::SLIDER,
				'default'        => array(
					'unit' => '%',
				),
				'tablet_default' => array(
					'unit' => '%',
				),
				'mobile_default' => array(
					'unit' => '%',
				),
				'size_units'     => array( '%' ),
				'range'          => array(
					'%' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'      => array(
					'{{WRAPPER}} .zeus-toggle-img img' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'image_opacity',
			array(
				'label'     => __( 'Opacity', 'zeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .zeus-toggle-img img' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'image_border',
				'selector' => '{{WRAPPER}} .zeus-toggle-img img',
			)
		);

		$this->add_responsive_control(
			'image_padding',
			array(
				'label'      => __( 'Padding', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-toggle-img img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_margin',
			array(
				'label'      => __( 'Margin', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-toggle-img img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_border_radius',
			array(
				'label'      => __( 'Border Radius', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-toggle-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .zeus-toggle-img img',
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Vars
		$primary_type        = $settings['primary_type'];
		$secondary_type      = $settings['secondary_type'];
		$primary_templates   = $settings['primary_template'];
		$secondary_templates = $settings['secondary_template'];

		$this->add_render_attribute( 'primary', 'class', 'zeus-toggle-primary-wrap show' );
		$this->add_render_attribute( 'secondary', 'class', 'zeus-toggle-secondary-wrap hide' );

		if ( 'image' === $primary_type ) {
			$this->add_render_attribute( 'primary', 'class', 'zeus-toggle-img' );
		}

		if ( 'image' === $secondary_type ) {
			$this->add_render_attribute( 'secondary', 'class', 'zeus-toggle-img' );
		} ?>

		<div class="zeus-toggle-container">
			<div class="zeus-toggle-wrap">
				<?php if ( $settings['primary_label'] ) { ?>
					<div class="zeus-text zeus-primary">
						<?php echo esc_attr( $settings['primary_label'] ); ?>
					</div>
				<?php } ?>
				<div class="zeus-toggle">
					<label class="zeus-toggle-label">
						<input type="checkbox">
						<span></span>
					</label>
				</div>
				<?php if ( $settings['secondary_label'] ) { ?>
					<div class="zeus-text zeus-secondary">
						<?php echo esc_attr( $settings['secondary_label'] ); ?>
					</div>
				<?php } ?>
			</div>

			<div <?php $this->print_render_attribute_string( 'primary' ); ?>>
				<?php
				if ( 'content' === $primary_type ) {
					$this->print_text_editor( $settings['primary_content'] );
				} elseif ( 'template' === $primary_type ) {
					if ( '0' !== $primary_templates && ! empty( $primary_templates ) ) {
						echo Plugin::instance()->frontend->get_builder_content_for_display( $primary_templates ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
				} elseif ( 'image' === $primary_type ) {
					echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'primary_image' ) );
				}
				?>
			</div>

			<div <?php $this->print_render_attribute_string( 'secondary' ); ?>>
				<?php
				if ( 'content' === $secondary_type ) {
					$this->print_text_editor( $settings['secondary_content'] );
				} elseif ( 'template' === $secondary_type ) {
					if ( '0' !== $secondary_templates && ! empty( $secondary_templates ) ) {
						echo Plugin::instance()->frontend->get_builder_content_for_display( $secondary_templates ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
				} elseif ( 'image' === $secondary_type ) {
					echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'secondary_image' ) );
				}
				?>
			</div>
		</div>

		<?php
	}

}
