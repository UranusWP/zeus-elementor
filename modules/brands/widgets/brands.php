<?php
namespace ZeusElementor\Modules\Brands\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Brands extends Widget_Base {

	public function get_name() {
		return 'zeus-brands';
	}

	public function get_title() {
		return __( 'Brands', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-photo-album';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'brands',
			'brand',
			'logo',
			'image',
			'zeus',
		];
	}

	public function get_style_depends() {
		return [ 'zeus-brands' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_brands',
			[
				'label'         => __( 'Brands', 'zeus-elementor' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_image',
			[
				'label'         => __( 'Company Logo', 'zeus-elementor' ),
				'type'          => Controls_Manager::MEDIA,
				'default'       => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'item_name',
			[
				'label'         => __( 'Company Name', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'label_block'   => true,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'item_description',
			[
				'label'         => __( 'Company Description', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'item_link',
			[
				'label'         => __( 'Company URL', 'zeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'zeus-elementor' ),
				'default'       => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'brands',
			[
				'label'         => __( 'Brands Items', 'zeus-elementor' ),
				'type'          => Controls_Manager::REPEATER,
				'default'       => [
					[
						'item_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'item_name'     => __( 'Company #1', 'zeus-elementor' ),
						'item_link'     => [
							'url' => '#',
						],
					],
					[
						'item_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'item_name'     => __( 'Company #2', 'zeus-elementor' ),
						'item_link'     => [
							'url' => '#',
						],
					],
				],
				'fields'        => $repeater->get_controls(),
				'title_field'   => '{{{ item_name }}}',
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label'         => __( 'Columns', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => '4',
				'options'       => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-brands .zeus-brands-item' => 'width: calc( 100% / {{VALUE}} );',
				],
			]
		);

		$this->add_control(
			'alignment',
			[
				'label'         => __( 'Alignment', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left' => [
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
				'selectors'     => [
					'{{WRAPPER}} .zeus-brands .zeus-brands-item' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'         => __( 'Brands Items', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'items_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-brands .zeus-brands-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'items_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-brands .zeus-brands-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_logo_style',
			[
				'label'         => __( 'Company Logo', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'logo_wrap_background',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-brands .zeus-brands-img' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'logo_wrap_border',
				'selector'      => '{{WRAPPER}} .zeus-brands .zeus-brands-img',
			]
		);

		$this->add_responsive_control(
			'logo_wrap_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-brands .zeus-brands-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'logo_wrap_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-brands .zeus-brands-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'logo_wrap_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-brands .zeus-brands-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'logo_wrap_box_shadow',
				'selector'      => '{{WRAPPER}} .zeus-brands .zeus-brands-img',
			]
		);

		$this->add_control(
			'logo_heading',
			[
				'label'         => __( 'Image', 'zeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'logo_border',
				'selector'      => '{{WRAPPER}} .zeus-brands img',
			]
		);

		$this->add_responsive_control(
			'logo_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-brands img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_name_style',
			[
				'label'         => __( 'Company Name', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-brands .zeus-brands-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'name_typo',
				'selector'      => '{{WRAPPER}} .zeus-brands .zeus-brands-name',
			]
		);

		$this->add_responsive_control(
			'name_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-brands .zeus-brands-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			[
				'label'         => __( 'Company Description', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-brands .zeus-brands-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'description_typo',
				'selector'      => '{{WRAPPER}} .zeus-brands .zeus-brands-desc',
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-brands .zeus-brands-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display(); ?>

		<div class="zeus-brands">
			<div class="zeus-brands-list">
				<?php
				foreach ( $settings['brands'] as $index => $item ) :

					$key            = $this->get_repeater_setting_key( 'item_image', 'brands', $index );
					$url            = $item['item_image']['url'];
					$alt            = trim( wp_strip_all_tags( get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true ) ) );
					$link           = $item['item_link'];

					$this->add_render_attribute( $key, 'src', $url );

					if ( '' !== $alt ) {
						$this->add_render_attribute( $key, 'alt', $alt );
					} ?>

					<div class="zeus-brands-item">
						<?php
						if ( ! empty( $link['url'] ) ) {
							$link_key = 'link_' . $index;

							$this->add_link_attributes( $link_key, $item['item_link'] );

							$this->add_render_attribute( $link_key, 'class', 'zeus-brands-link' );
							?>
							<a <?php $this->print_render_attribute_string( $link_key ); ?>>
							<?php
						} ?>
						<div class="zeus-brands-img">
							<img <?php $this->print_render_attribute_string( $key ); ?> />
						</div>
						<h5 class="zeus-brands-name"><?php $this->print_text_editor( $item['item_name'] ); ?></h5>
						<div class="zeus-brands-desc"><?php $this->print_text_editor( $item['item_description'] ); ?></div>
						<?php if ( ! empty( $link['url'] ) ) : ?>
							</a>
						<?php endif; ?>
					</div>
					<?php
				endforeach; ?>
			</div>
		</div>
		<?php
	}

	protected function content_template() { ?>
		<div class="zeus-brands">
			<div class="zeus-brands-list zeus-row">
				<# _.each( settings.brands, function( item, index ) {
					var key = view.getRepeaterSettingKey( 'item_image', 'brands', index );
					view.addRenderAttribute( key, 'src', item.item_image.url ); #>

					<div class="zeus-brands-item">
						<# if ( '' !== item.item_link.url ) { #>
							<a class="zeus-brands-link" href="{{ item.item_link.url }}">
						<# } #>
							<div class="zeus-brands-img">
								<img {{{ view.getRenderAttributeString( key ) }}} />
							</div>
							<h5 class="zeus-brands-name">{{{ item.item_name }}}</h5>
							<div class="zeus-brands-desc">{{{ item.item_description }}}</div>
						<# if ( '' !== item.item_link.url ) { #>
							</a>
						<# } #>
					</div>

				<# } ); #>
			</div>
		</div>
		<?php
	}
}
