<?php
namespace ZeusElementor\Modules\Banner\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Banner extends Widget_Base {

	public function get_name() {
		return 'zeus-banner';
	}

	public function get_title() {
		return __( 'Banner', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-picture2';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'banner',
			'image',
			'zeus',
		];
	}

	public function get_style_depends() {
		return [ 'zeus-banner' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_banner',
			[
				'label'         => __( 'Banner', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'effect',
			[
				'label'   => __( 'Animation Effect', 'zeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'gaia',
				'options' => [
					'gaia'      => __( 'Gaia', 'zeus-elementor' ),
					'poseidon'  => __( 'Poseidon', 'zeus-elementor' ),
					'cronos'    => __( 'Cronos', 'zeus-elementor' ),
					'hades'     => __( 'Hades', 'zeus-elementor' ),
					'demeter'   => __( 'Demeter', 'zeus-elementor' ),
					'apollo'    => __( 'Apollo', 'zeus-elementor' ),
					'athena'    => __( 'Athena', 'zeus-elementor' ),
					'artemis'   => __( 'Artemis', 'zeus-elementor' ),
					'ares'      => __( 'Ares', 'zeus-elementor' ),
					'hermes'    => __( 'Hermes', 'zeus-elementor' ),
					'eros'      => __( 'Eros', 'zeus-elementor' ),
					'hera'      => __( 'Hera', 'zeus-elementor' ),
					'aphrodite' => __( 'Aphrodite', 'zeus-elementor' ),
					'zeus'      => __( 'Zeus', 'zeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label'         => __( 'Image', 'zeus-elementor' ),
				'type'          => Controls_Manager::MEDIA,
				'default'       => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'          => 'image',
				'label'         => __( 'Image Size', 'zeus-elementor' ),
				'default'       => 'large',
			]
		);

		$this->add_control(
			'title',
			[
				'label'         => __( 'Title', 'zeus-elementor' ),
				'default'       => __( 'This is the title', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'label_block'   => true,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'description',
			[
				'label'         => __( 'Description', 'zeus-elementor' ),
				'default'       => __( 'Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel.', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => __( 'Link', 'zeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'zeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'         => esc_html__( 'General', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_banner_style' );

		$this->start_controls_tab(
			'tab_banner_normal',
			[
				'label'         => __( 'Normal', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'banner_normal_opacity',
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
				'selectors'     => [
					'body {{WRAPPER}} .zeus-banner img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_banner_hover',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'banner_hover_opacity',
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
				'selectors'     => [
					'body {{WRAPPER}} .zeus-banner:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'          => 'banner_background',
				'selector'      => '{{WRAPPER}} .zeus-banner',
				'separator'     => 'before',
			)
		);

		$this->add_control(
			'banner_additional_color',
			[
				'label'         => __( 'Additional Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-banner.zeus-apolo .zeus-banner-text' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .zeus-banner.zeus-bubba figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .zeus-banner.zeus-bubba figcaption:after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .zeus-banner.zeus-chico figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .zeus-banner.zeus-jazz figcaption:after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .zeus-banner.zeus-layla figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .zeus-banner.zeus-layla figcaption:after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .zeus-banner.zeus-ming figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .zeus-banner.zeus-marley .zeus-banner-title:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .zeus-banner.zeus-romeo figcaption:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .zeus-banner.zeus-romeo figcaption:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .zeus-banner.zeus-roxy figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .zeus-banner.zeus-ruby .zeus-banner-text' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .zeus-banner.zeus-sarah .zeus-banner-title:after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'banner_border',
				'selector'      => '{{WRAPPER}} .zeus-banner',
			]
		);

		$this->add_responsive_control(
			'banner_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'banner_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-banner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'banner_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-banner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'banner_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-banner',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label'         => esc_html__( 'Banner Title', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-banner .zeus-banner-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'title_typo',
				'selector'      => '{{WRAPPER}} .zeus-banner .zeus-banner-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			[
				'label'         => esc_html__( 'Banner Description', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-banner .zeus-banner-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'description_typo',
				'selector'      => '{{WRAPPER}} .zeus-banner .zeus-banner-text',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings       = $this->get_settings_for_display();
		$link           = $settings['link'];
		$effect         = $settings['effect'];

		$this->add_render_attribute( 'banner', 'class', 'zeus-banner' );
		if ( ! empty( $effect ) ) {
			$this->add_render_attribute( 'banner', 'class', 'zeus-' . $effect );
		}

		$this->add_render_attribute( 'content', 'class', 'zeus-banner-content' );
		$this->add_render_attribute( 'title', 'class', 'zeus-banner-title' );
		$this->add_render_attribute( 'description', 'class', 'zeus-banner-text' ); ?>

		<figure <?php $this->print_render_attribute_string( 'banner' ); ?>>
			<?php
			if ( ! empty( $link['url'] ) ) {
				$this->add_render_attribute( 'link', 'class', 'zeus-banner-link' );
				$this->add_link_attributes( 'link', $settings['link'] );
				?>
				<a <?php $this->print_render_attribute_string( 'link' ); ?>>
				<?php
			}
			?>
				<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings ) ); ?>
				<figcaption>
					<div <?php $this->print_render_attribute_string( 'content' ); ?>>
						<h5 <?php $this->print_render_attribute_string( 'title' ); ?>><?php $this->print_unescaped_setting( 'title' ); ?></h5>
						<div <?php $this->print_render_attribute_string( 'description' ); ?>><?php $this->print_unescaped_setting( 'description' ); ?></div>
					</div>
				</figcaption>
			<?php if ( ! empty( $link['url'] ) ) : ?>
				</a>
			<?php endif; ?>
		</figure>
		<?php
	}

	protected function content_template() {
		?>
		<#
		view.addRenderAttribute( 'banner', 'class', 'zeus-banner' );

		if ( settings.effect ) {
			view.addRenderAttribute( 'banner', 'class', 'zeus-' + settings.effect );
		}

		view.addRenderAttribute( 'content', 'class', 'zeus-banner-content' );
		view.addRenderAttribute( 'title', 'class', 'zeus-banner-title' );
		view.addRenderAttribute( 'description', 'class', 'zeus-banner-text' );

		var image = {
			id: settings.image.id,
			url: settings.image.url,
			size: settings.image_size,
			dimension: settings.image_custom_dimension,
			model: view.getEditModel()
		};

		var imageUrl = elementor.imagesManager.getImageUrl( image );
		#>

		<figure {{{ view.getRenderAttributeString( 'banner' ) }}}>
			<# if ( settings.link ) { #>
				<a href="#" class="zeus-banner-link">
			<# } #>
				<img src="{{ imageUrl }}">
				<figcaption>
					<div {{{ view.getRenderAttributeString( 'content' ) }}}>
						<h5 {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</h5>
						<div {{{ view.getRenderAttributeString( 'description' ) }}}>{{{ settings.description }}}</div>
					</div>
				</figcaption>
			<# if ( settings.link ) { #>
				</a>
			<# } #>
		</figure>
		<?php
	}
}
