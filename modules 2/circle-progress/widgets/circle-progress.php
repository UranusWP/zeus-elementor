<?php
namespace ZeusElementor\Modules\CircleProgress\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Circle_Progress extends Widget_Base {

	public function get_name() {
		return 'zeus-circle-progress';
	}

	public function get_title() {
		return __( 'Circle Progress', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-spinner4';
	}

	public function get_categories() {
		return array( 'zeus-elements' );
	}

	public function get_keywords() {
		return array(
			'pie',
			'charts',
			'circle',
			'progress',
			'zeus',
		);
	}

	public function get_script_depends() {
		return array( 'zeus-circle-progress' );
	}

	public function get_style_depends() {
		return array( 'zeus-circle-progress' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_circle_progress',
			array(
				'label' => __( 'Circle Progress', 'zeus-elementor' ),
			)
		);

		$this->add_control(
			'goal',
			array(
				'label'   => __( 'Percent', 'zeus-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '60',
			)
		);

		$this->add_control(
			'speed',
			array(
				'label'   => __( 'Speed (s)', 'zeus-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '1',
			)
		);

		$this->add_control(
			'step',
			array(
				'label'   => __( 'Steps', 'zeus-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '1',
			)
		);

		$this->add_control(
			'delay',
			array(
				'label'   => __( 'Delay', 'zeus-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '1',
			)
		);

		$this->add_control(
			'text_before',
			array(
				'label'       => __( 'Text Before', 'zeus-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'text_middle',
			array(
				'label'       => __( 'Text Middle', 'zeus-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'text_after',
			array(
				'label'       => __( 'Text After', 'zeus-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'zeus-elementor' ),
			)
		);

		$this->add_control(
			'content',
			array(
				'label'   => __( 'Content', 'zeus-elementor' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __( 'Add your content here', 'zeus-elementor' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Circle Progress', 'zeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'barsize',
			array(
				'label'   => __( 'Bar Size', 'zeus-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '4',
			)
		);

		$this->add_control(
			'barcap',
			array(
				'label'   => __( 'Bar Cap', 'zeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'round',
				'options' => array(
					'round'  => __( 'Rounded', 'zeus-elementor' ),
					'square' => __( 'Square', 'zeus-elementor' ),
					'butt'   => __( 'Butt', 'zeus-elementor' ),
				),
			)
		);

		$this->add_control(
			'circle_outside_color',
			array(
				'label'     => esc_html__( 'Circle Outside Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress svg ellipse' => 'stroke: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'circle_inside_color',
			array(
				'label'     => esc_html__( 'Circle Inside Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress svg path' => 'stroke: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'circle_padding',
			array(
				'label'      => __( 'Padding', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'text_before_heading',
			array(
				'label'     => __( 'Text Before', 'zeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'text_before_typography',
				'selector' => '{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress .zeus-circle-progress-label .zeus-circle-progress-before',
			)
		);

		$this->add_control(
			'text_before_color',
			array(
				'label'     => esc_html__( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress .zeus-circle-progress-label .zeus-circle-progress-before' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'text_before_margin',
			array(
				'label'      => __( 'Margin', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress .zeus-circle-progress-label .zeus-circle-progress-before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'text_middle_heading',
			array(
				'label'     => __( 'Number/Text Middle', 'zeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'text_middle_typography',
				'selector' => '{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress .zeus-circle-progress-label .zeus-circle-progress-middle',
			)
		);

		$this->add_control(
			'text_middle_color',
			array(
				'label'     => esc_html__( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress .zeus-circle-progress-label .zeus-circle-progress-middle' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'text_middle_margin',
			array(
				'label'      => __( 'Margin', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress .zeus-circle-progress-label .zeus-circle-progress-middle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'text_after_heading',
			array(
				'label'     => __( 'Text After', 'zeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'text_after_typography',
				'selector' => '{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress .zeus-circle-progress-label .zeus-circle-progress-after',
			)
		);

		$this->add_control(
			'text_after_color',
			array(
				'label'     => esc_html__( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress .zeus-circle-progress-label .zeus-circle-progress-after' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'text_after_margin',
			array(
				'label'      => __( 'Margin', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress .zeus-circle-progress-label .zeus-circle-progress-after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress-content',
			)
		);

		$this->add_control(
			'content_background_color',
			array(
				'label'     => __( 'Background Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress-content' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'content_color',
			array(
				'label'     => esc_html__( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress-content' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'content_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress-content',
			)
		);

		$this->add_control(
			'content_border_radius',
			array(
				'label'      => __( 'Border Radius', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_box_shadow',
				'selector' => '{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress-content',
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => __( 'Padding', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_margin',
			array(
				'label'      => __( 'Margin', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-circle-progress-wrap .zeus-circle-progress-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrap', 'class', 'zeus-circle-progress-wrap' );

		$this->add_render_attribute(
			'inner',
			'class',
			array(
				'zeus-circle-progress',
				'pieProgress',
				'zeus-cp-' . $settings['barcap'],
			)
		);

		$this->add_render_attribute( 'inner', 'role', 'progressbar' );

		if ( ! empty( $settings['goal'] ) ) {
			$this->add_render_attribute( 'inner', 'data-goal', $settings['goal'] );
		}

		$this->add_render_attribute( 'inner', 'data-valuemin', '0' );

		if ( ! empty( $settings['speed'] ) ) {
			$this->add_render_attribute( 'inner', 'data-speed', $settings['speed'] * 15 );
		}

		if ( ! empty( $settings['step'] ) ) {
			$this->add_render_attribute( 'inner', 'data-step', $settings['step'] );
		}

		if ( ! empty( $settings['delay'] ) ) {
			$this->add_render_attribute( 'inner', 'data-delay', $settings['delay'] * 1000 );
		}

		if ( ! empty( $settings['barsize'] ) ) {
			$this->add_render_attribute( 'inner', 'data-barsize', intval( $settings['barsize'] ) );
		}

		$this->add_render_attribute( 'inner', 'data-valuemax', '100' );

		$this->add_render_attribute( 'label', 'class', 'zeus-circle-progress-label' );
		$this->add_render_attribute( 'before', 'class', 'zeus-circle-progress-before' );
		$this->add_render_attribute( 'text', 'class', 'zeus-circle-progress-middle' );
		$this->add_render_attribute(
			'number',
			'class',
			array(
				'zeus-circle-progress-number',
				'zeus-circle-progress-middle',
			)
		);
		$this->add_render_attribute( 'after', 'class', 'zeus-circle-progress-after' );
		$this->add_render_attribute( 'content', 'class', 'zeus-circle-progress-content' ); ?>

		<div <?php $this->print_render_attribute_string( 'wrap' ); ?>>
			<div <?php $this->print_render_attribute_string( 'inner' ); ?>>
				<div <?php $this->print_render_attribute_string( 'label' ); ?>>
					<?php
					if ( $settings['text_before'] ) {
						?>
						<div <?php $this->print_render_attribute_string( 'before' ); ?>><?php $this->print_unescaped_setting( 'text_before' ); ?></div>
						<?php
					}

					if ( $settings['text_middle'] ) {
						?>
						<div <?php $this->print_render_attribute_string( 'text' ); ?>><?php $this->print_unescaped_setting( 'text_middle' ); ?></div>
						<?php
					} else {
						?>
						<div <?php $this->print_render_attribute_string( 'number' ); ?>></div>
						<?php
					}

					if ( $settings['text_after'] ) {
						?>
						<div <?php $this->print_render_attribute_string( 'after' ); ?>><?php $this->print_unescaped_setting( 'text_after' ); ?></div>
						<?php
					}
					?>
				</div>
			</div>

			<?php
			if ( $settings['content'] ) {
				?>
				<div <?php $this->print_render_attribute_string( 'content' ); ?>><?php $this->print_unescaped_setting( 'content' ); ?></div>
				<?php
			}
			?>

		</div>

		<?php
	}

}
