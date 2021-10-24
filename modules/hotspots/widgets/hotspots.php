<?php
namespace ZeusElementor\Modules\Hotspots\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Hotspots extends Widget_Base {

	public function get_name() {
		return 'zeus-hotspots';
	}

	public function get_title() {
		return __( 'Hotspots', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-fire';
	}

	public function get_categories() {
		return array( 'zeus-elements' );
	}

	public function get_keywords() {
		return array(
			'hot',
			'spot',
			'hotspot',
			'image',
			'zeus',
		);
	}

	public function get_script_depends() {
		return array( 'zeus-hotspots' );
	}

	public function get_style_depends() {
		return array( 'zeus-hotspots', 'tippy', 'tippy-arrow' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_hotspots_image',
			array(
				'label' => __( 'Image', 'zeus-elementor' ),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => __( 'Choose Image', 'zeus-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'image',
				'label'   => __( 'Image Size', 'zeus-elementor' ),
				'default' => 'large',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_hotspots',
			array(
				'label' => __( 'Hotspots', 'zeus-elementor' ),
			)
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'hotspots_tabs' );

		$repeater->start_controls_tab( 'tab_content', array( 'label' => __( 'Content', 'zeus-elementor' ) ) );

		$repeater->add_control(
			'hotspot_type',
			array(
				'label'   => __( 'Type', 'zeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => array(
					'text'  => __( 'Text', 'zeus-elementor' ),
					'icon'  => __( 'Icon', 'zeus-elementor' ),
					'blank' => __( 'Blank', 'zeus-elementor' ),
				),
			)
		);

		$repeater->add_control(
			'hotspot_text',
			array(
				'label'     => __( 'Text', 'zeus-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( '1', 'zeus-elementor' ),
				'condition' => array(
					'hotspot_type' => 'text',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'hotspot_icon',
			array(
				'label'     => __( 'Icon', 'zeus-elementor' ),
				'type'      => Controls_Manager::ICON,
				'default'   => '',
				'condition' => array(
					'hotspot_type' => 'icon',
				),
			)
		);

		$repeater->add_control(
			'hotspot_link',
			array(
				'label'   => __( 'Link', 'zeus-elementor' ),
				'type'    => Controls_Manager::URL,
				'default' => array(
					'url' => '',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'tab_position', array( 'label' => __( 'Position', 'zeus-elementor' ) ) );

		$repeater->add_control(
			'hotspot_top_position',
			array(
				'label'     => __( 'Top position', 'zeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 0.1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}%;',
				),
			)
		);

		$repeater->add_control(
			'hotspot_left_position',
			array(
				'label'     => __( 'Left position', 'zeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 0.1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}%;',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'tab_tooltip', array( 'label' => __( 'Tooltip', 'zeus-elementor' ) ) );

		$repeater->add_control(
			'tooltip',
			array(
				'label'   => __( 'Tooltip', 'zeus-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$repeater->add_control(
			'tooltip_position',
			array(
				'label'     => __( 'Tooltip Position', 'zeus-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 's',
				'options'   => array(
					'n'      => __( 'Top', 'zeus-elementor' ),
					'ne-alt' => __( 'Top Start', 'zeus-elementor' ),
					'ne'     => __( 'Top End', 'zeus-elementor' ),
					'e'      => __( 'Right', 'zeus-elementor' ),
					'se-alt' => __( 'Right Start', 'zeus-elementor' ),
					'se'     => __( 'Right End', 'zeus-elementor' ),
					's'      => __( 'Bottom', 'zeus-elementor' ),
					'sw-alt' => __( 'Bottom Start', 'zeus-elementor' ),
					'sw'     => __( 'Bottom End', 'zeus-elementor' ),
					'w'      => __( 'Left', 'zeus-elementor' ),
					'nw-alt' => __( 'Left Start', 'zeus-elementor' ),
					'nw'     => __( 'Left End', 'zeus-elementor' ),
				),
				'condition' => array(
					'tooltip' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'tooltip_content',
			array(
				'label'     => __( 'Tooltip Content', 'zeus-elementor' ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => __( 'Add your tooltip content here', 'zeus-elementor' ),
				'condition' => array(
					'tooltip' => 'yes',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tab();

		$this->add_control(
			'hotspots',
			array(
				'label'       => __( 'Hotspots', 'zeus-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'hotspot_text' => '1',
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ hotspot_text }}}',
			)
		);

		$this->add_control(
			'disable_pulse',
			array(
				'label'        => __( 'Disable Pulse Effect', 'zeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'none',
				'selectors'    => array(
					'{{WRAPPER}} .zeus-hotspot-inner:before' => 'display: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_hotspots_tooltip',
			array(
				'label' => __( 'Tooltip', 'zeus-elementor' ),
			)
		);

		$this->add_control(
			'fade_in_time',
			array(
				'label'              => __( 'Fade In Time (ms)', 'zeus-elementor' ),
				'description'        => __( 'Time until tooltips appear.', 'zeus-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'default'            => array(
					'size' => 200,
				),
				'range'              => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'fade_out_time',
			array(
				'label'              => __( 'Fade Out Time (ms)', 'zeus-elementor' ),
				'description'        => __( 'Time until tooltips dissapear.', 'zeus-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'default'            => array(
					'size' => 100,
				),
				'range'              => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'frontend_available' => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			array(
				'label' => __( 'Image', 'zeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'image_border',
				'label'    => __( 'Image Border', 'zeus-elementor' ),
				'selector' => '{{WRAPPER}} .zeus-hotspots-wrap img',
			)
		);

		$this->add_control(
			'image_border_radius',
			array(
				'label'      => __( 'Border Radius', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-hotspots-wrap img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .zeus-hotspots-wrap img',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_hotspots_style',
			array(
				'label' => __( 'Hotspots', 'zeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'hotspots_typo',
				'selector' => '{{WRAPPER}} .zeus-hotspot-inner',
			)
		);

		$this->start_controls_tabs( 'tabs_hotspots_style' );

		$this->start_controls_tab(
			'tab_hotspots_normal',
			array(
				'label' => __( 'Normal', 'zeus-elementor' ),
			)
		);

		$this->add_control(
			'hotspots_background',
			array(
				'label'     => __( 'Background Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-hotspot-inner, {{WRAPPER}} .zeus-hotspot-inner:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'hotspots_color',
			array(
				'label'     => __( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-hotspot-inner, {{WRAPPER}} .zeus-hotspot-inner:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_hotspots_hover',
			array(
				'label' => __( 'Hover', 'zeus-elementor' ),
			)
		);

		$this->add_control(
			'hotspots_hover_background',
			array(
				'label'     => __( 'Background Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-hotspot-inner:hover, {{WRAPPER}} .zeus-hotspot-inner:hover:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'hotspots_hover_color',
			array(
				'label'     => __( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-hotspot-inner:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'hotspots_size',
			array(
				'label'     => __( 'Size', 'zeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 40,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .zeus-hotspot-inner, {{WRAPPER}} .zeus-hotspot-inner:before' => 'min-width: {{SIZE}}{{UNIT}}; min-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .zeus-hotspot-inner' => 'line-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'hotspots_border',
				'label'    => __( 'Border', 'zeus-elementor' ),
				'selector' => '{{WRAPPER}} .zeus-hotspot-inner',
			)
		);

		$this->add_responsive_control(
			'hotspots_border_radius',
			array(
				'label'      => __( 'Border Radius', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-hotspot-inner, {{WRAPPER}} .zeus-hotspot-inner:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'hotspots_box_shadow',
				'selector' => '{{WRAPPER}} .zeus-hotspot-inner',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tooltips_style',
			array(
				'label' => __( 'Tooltips', 'zeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tooltips_typo',
				'selector' => 'div[id*="tippy-"].zeus-hotspot-powertip-{{ID}} .tippy-box',
			)
		);

		$this->add_control(
			'tooltips_background',
			array(
				'label'     => __( 'Background Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'div[id*="tippy-"].zeus-hotspot-powertip-{{ID}} .tippy-box' => 'background-color: {{VALUE}};',
					'div[id*="tippy-"].zeus-hotspot-powertip-{{ID}} .tippy-box > .tippy-svg-arrow' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tooltips_color',
			array(
				'label'     => __( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'div[id*="tippy-"].zeus-hotspot-powertip-{{ID}} .tippy-box' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'tooltips_border',
				'label'    => __( 'Border', 'zeus-elementor' ),
				'selector' => 'div[id*="tippy-"].zeus-hotspot-powertip-{{ID}} .tippy-box',
			)
		);

		$this->add_responsive_control(
			'tooltips_border_radius',
			array(
				'label'      => __( 'Border Radius', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'div[id*="tippy-"].zeus-hotspot-powertip-{{ID}} .tippy-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tooltips_box_shadow',
				'selector' => 'div[id*="tippy-"].zeus-hotspot-powertip-{{ID}} .tippy-box',
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['image']['url'] ) ) {
			return;
		} ?>

		<div class="zeus-hotspots-wrap">
			<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings ) ); ?>

			<?php
			if ( $settings['hotspots'] ) {
				?>
				<div class="zeus-hotspot-wrap">
					<?php
					foreach ( $settings['hotspots'] as $index => $item ) :
						$hotspot_tag = 'div';
						$hotspot     = $this->get_repeater_setting_key( 'hotspot', 'hotspots', $index );
						$text        = $this->get_repeater_setting_key( 'hotspot_text', 'hotspots', $index );
						$icon        = $this->get_repeater_setting_key( 'hotspot_icon', 'hotspots', $index );

						$this->add_render_attribute(
							$hotspot,
							array(
								'class' => array(
									'zeus-hotspot-inner',
									'elementor-repeater-item-' . $item['_id'],
								),
							)
						);

						if ( 'yes' === $item['tooltip'] ) {
							$this->add_render_attribute(
								$hotspot,
								array(
									'class' => array(
										'zeus-hotspot-tooltip',
										'zeus-tooltip-' . $item['tooltip_position'],
									),
									'title' => $this->parse_text_editor( $item['tooltip_content'] ),
								)
							);
						}

						$this->add_render_attribute( $text, 'class', 'zeus-hotspot-text' );

						if ( ! empty( $item['hotspot_link']['url'] ) ) {
							$hotspot_tag = 'a';
							$this->add_link_attributes( $hotspot, $item['hotspot_link'] );
						}
						?>

						<<?php echo esc_attr( $hotspot_tag ); ?> <?php $this->print_render_attribute_string( $hotspot ); ?>>
							<?php
							if ( 'blank' !== $item['hotspot_type'] ) {
								?>
								<span <?php $this->print_render_attribute_string( $text ); ?>>
									<?php
									if ( 'icon' === $item['hotspot_type'] && ! empty( $item['hotspot_icon'] ) ) {
										?>
										<i class="<?php echo esc_attr( $item['hotspot_icon'] ); ?>"></i>
										<?php
									} else {
										$this->print_text_editor( $item['hotspot_text'] );
									}
									?>
								</span>
								<?php
							}
							?>
						</<?php echo esc_attr( $hotspot_tag ); ?>>

						<?php
					endforeach;
					?>
				</div>
				<?php
			}
			?>
		</div>

		<?php
	}

	protected function content_template() {
		?>
		<# if ( settings.image.url ) {
			var image = {
				id: settings.image.id,
				url: settings.image.url,
				size: settings.image_size,
				dimension: settings.image_custom_dimension,
				model: view.getEditModel()
			};

			var image_url = elementor.imagesManager.getImageUrl( image );

			if ( ! image_url ) {
				return;
			} #>

			<div class="zeus-hotspots-wrap">
				<img src="{{ image_url }}" />

				<# if ( settings.hotspots ) { #>
					<div class="zeus-hotspot-wrap">
						<# _.each( settings.hotspots, function( item, index ) {

							var hotspot_tag 	= 'div',
								hotspot 		= view.getRepeaterSettingKey( 'hotspot', 'hotspots', index ),
								text 			= view.getRepeaterSettingKey( 'hotspot_text', 'hotspots', index ),
								icon 			= view.getRepeaterSettingKey( 'hotspot_icon', 'hotspots', index );

							view.addRenderAttribute( hotspot, 'class', [
								'zeus-hotspot-inner',
								'elementor-repeater-item-' + item._id,
							] );

							if ( 'yes' == item.tooltip ) {
								view.addRenderAttribute( hotspot, 'class', 'zeus-hotspot-tooltip' );
								view.addRenderAttribute( hotspot, 'class', 'zeus-tooltip-' + item.tooltip_position );
								view.addRenderAttribute( hotspot, 'title', item.tooltip_content );
							}

							view.addRenderAttribute( text, 'class', 'zeus-hotspot-text' );

							if ( '' != item.hotspot_link.url ) {
								hotspot_tag = 'a';
								view.addRenderAttribute( hotspot, 'href', item.hotspot_link.url );
							} #>

							<{{ hotspot_tag }} {{{ view.getRenderAttributeString( hotspot ) }}}>
								<# if ( 'blank' != item.hotspot_type ) { #>
									<span {{{ view.getRenderAttributeString( text ) }}}>
										<# if ( 'icon' == item.hotspot_type && '' !== item.hotspot_icon ) { #>
											<i class="{{{ item.hotspot_icon }}}"></i>
										<# } else { #>
											{{ item.hotspot_text }}
										<# } #>
									</span>
								<# } #>
							</{{ hotspot_tag }}>
						<# } ); #>
					</div>
				<# } #>
			</div>

		<# } #>
		<?php
	}

}
