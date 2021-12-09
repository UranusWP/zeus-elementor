<?php
namespace ZeusElementor\Modules\Logo\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Logo extends Widget_Base {

	public function get_name() {
		return 'zeus-logo';
	}

	public function get_title() {
		return __( 'Logo', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-eye';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'logo',
			'header',
			'site',
			'zeus',
		];
	}

	public function get_style_depends() {
		return [ 'zeus-logo' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_logo',
			[
				'label'         => __( 'Logo', 'zeus-elementor' ),
			]
		);

		$this->add_control( 'warning_text', [
			'type'              => Controls_Manager::RAW_HTML,
			'raw'               => __( 'The Logo need to be set on your theme customizer settings.', 'zeus-elementor' ),
		] );

		$this->add_control(
			'logo_link',
			[
				'label'         => __( 'Logo Link', 'zeus-elementor' ),
				'description'   => __( 'Default link is your site url', 'zeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'zeus-elementor' ),
			]
		);

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
			'tagline',
			[
				'label'         => __( 'Add Tagline', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'no',
			]
		);

		$this->add_control(
			'description',
			[
				'label'         => __( 'Description', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'placeholder'   => __( 'Enter your logo tagline', 'zeus-elementor' ),
				'rows'          => 10,
				'dynamic'       => [ 'active' => true ],
				'condition'     => [
					'tagline' => 'yes',
				],
			]
		);

		$this->add_control(
			'desc_tag',
			[
				'label'         => __( 'Description Tag', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'h2',
				'options'       => [
					'h1'     => __( 'H1', 'zeus-elementor' ),
					'h2'     => __( 'H2', 'zeus-elementor' ),
					'h3'     => __( 'H3', 'zeus-elementor' ),
					'h4'     => __( 'H4', 'zeus-elementor' ),
					'h5'     => __( 'H5', 'zeus-elementor' ),
					'h6'     => __( 'H6', 'zeus-elementor' ),
					'div'    => __( 'div', 'zeus-elementor' ),
					'span'   => __( 'span', 'zeus-elementor' ),
					'p'      => __( 'p', 'zeus-elementor' ),
				],
				'condition'     => [
					'tagline' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'         => __( 'Logo', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'max_width',
			[
				'label'         => __( 'Max Width', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'   => 10,
						'max'   => 500,
						'step'  => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .zeus-logo img' => 'max-width: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'max_height',
			[
				'label'         => __( 'Max Height', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'   => 10,
						'max'   => 500,
						'step'  => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .zeus-logo img' => 'max-height: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'         => __( 'Alignment', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left'    => [
						'title' => __( 'Left', 'zeus-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'zeus-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'zeus-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-logo' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'border',
				'selector'      => '{{WRAPPER}} .zeus-logo img',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-logo img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-logo img',
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-logo img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'placeholder'   => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hover_logo',
			[
				'label'         => __( 'Logo: Hover', 'zeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'opacity',
			[
				'label'         => __( 'Opacity', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .zeus-logo a:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'hover_border',
				'selector'      => '{{WRAPPER}} .zeus-logo a:hover img',
			]
		);

		$this->add_control(
			'hover_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-logo a:hover img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'hover_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-logo a:hover img',
			]
		);

		$this->add_responsive_control(
			'hover_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-logo a:hover img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_desc_style',
			[
				'label'         => __( 'Description', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'tagline' => 'yes',
				],
			]
		);

		$this->add_control(
			'desc_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-logo-description' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'tagline' => 'yes',
				],
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-logo-description' => 'color: {{VALUE}}',
				],
				'condition'     => [
					'tagline' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'desc_typography',
				'selector'      => '{{WRAPPER}} .zeus-logo-description',
				'condition'     => [
					'tagline' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'desc_border',
				'selector'      => '{{WRAPPER}} .zeus-logo-description',
			]
		);

		$this->add_control(
			'desc_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-logo-description' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'desc_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-logo-description',
			]
		);

		$this->add_responsive_control(
			'desc_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-logo-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'tagline' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'desc_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'placeholder'   => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-logo-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'tagline' => 'yes',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Get logo.
		$custom_logo_id = get_theme_mod( 'custom_logo' );

		// Description.
		$tag = $settings['desc_tag'];

		// Schema markup
		if ( 'yes' === $settings['schema'] ) {
			$schema = ' itemscope itemtype="https://schema.org/Brand"';
		}

		// Logo URL
		if ( ! empty( $settings['logo_link']['url'] ) ) {
			$this->add_link_attributes( 'link', $settings['logo_link'] );
		} else {
			$this->add_render_attribute( 'link', 'href', esc_url( home_url( '/' ) ) );
			$this->add_render_attribute( 'link', 'rel', 'home' );
		}

		// Description
		$this->add_render_attribute( 'description', 'class', 'zeus-logo-description' );
		$this->add_inline_editing_attributes( 'description', 'basic' ); ?>

		<div class="zeus-logo"<?php echo esc_attr( $schema ); ?>>

			<div class="zeus-logo-inner">
				<a <?php $this->print_render_attribute_string( 'link' ); ?>>
					<?php
					if ( function_exists( 'the_custom_logo' ) && $custom_logo_id ) {
						$logo_url = wp_get_attachment_image_src( $custom_logo_id, 'full' )[0];
						?>
						<img src="<?php echo esc_url( $logo_url ); ?>" />
						<?php
					} else {
						echo esc_html( get_bloginfo( 'name' ) );
					}
					?>
				</a>
			</div>

			<?php
			// Site description.
			if ( 'yes' === $settings['tagline']
				&& ! empty( $settings['description'] ) ) { ?>
				<<?php echo esc_attr( $tag ); ?> <?php $this->print_render_attribute_string( 'description' ); ?>>
				<?php $this->print_unescaped_setting( 'description' ); ?>
				</<?php echo esc_attr( $tag ); ?>>
				<?php
			} ?>

		</div>
		<?php
	}

}
