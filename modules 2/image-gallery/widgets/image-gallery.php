<?php
namespace ZeusElementor\Modules\ImageGallery\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class ImageGallery extends Widget_Base {

	public function get_name() {
		return 'zeus-image-gallery';
	}

	public function get_title() {
		return __( 'Image Gallery', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-folder-picture';
	}

	public function get_categories() {
		return array( 'zeus-elements' );
	}

	public function get_keywords() {
		return array(
			'image',
			'gallery',
			'zeus',
		);
	}

	public function get_style_depends() {
		return array( 'zeus-image-gallery' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_image_gallery',
			array(
				'label' => __( 'Image Gallery', 'zeus-elementor' ),
			)
		);

		$this->add_control(
			'gallery_images',
			array(
				'label'   => __( 'Add Images', 'zeus-elementor' ),
				'type'    => Controls_Manager::GALLERY,
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'thumbnail',
				'exclude' => array( 'custom' ),
			)
		);

		$this->add_responsive_control(
			'item_ratio',
			array(
				'label'     => __( 'Image Height', 'zeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 250,
				),
				'range'     => array(
					'px' => array(
						'min'  => 50,
						'max'  => 500,
						'step' => 5,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .zeus-image-gallery .zeus-gallery-thumbnail img' => 'height: {{SIZE}}px',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_gallery_layout',
			array(
				'label' => __( 'Layout', 'zeus-elementor' ),
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'          => __( 'Columns', 'zeus-elementor' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '4',
				'tablet_default' => '3',
				'mobile_default' => '1',
				'options'        => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				),
				'selectors'      => array(
					'{{WRAPPER}} .zeus-image-gallery .zeus-gallery-item' => 'width: calc( 100% / {{VALUE}} );',
					'{{WRAPPER}} .zeus-image-gallery .zeus-column' => 'width: calc( 100% / {{VALUE}} );',
				),
			)
		);

		$this->add_responsive_control(
			'item_gap',
			array(
				'label'     => __( 'Column Gap', 'zeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 0,
				),
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .zeus-image-gallery' => 'margin-left: -{{SIZE}}px',
					'{{WRAPPER}} .zeus-image-gallery .zeus-gallery-item' => 'padding-left: {{SIZE}}px',
				),
			)
		);

		$this->add_responsive_control(
			'row_gap',
			array(
				'label'     => __( 'Row Gap', 'zeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 0,
				),
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .zeus-image-gallery' => 'margin-top: -{{SIZE}}px',
					'{{WRAPPER}} .zeus-image-gallery .zeus-gallery-item' => 'margin-top: {{SIZE}}px',
				),
			)
		);

		$this->add_control(
			'add_lightbox',
			array(
				'label'   => __( 'Add Lightbox', 'zeus-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'add_overlay_icon',
			array(
				'label'   => __( 'Add Overlay Icon', 'zeus-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'overlay_icon',
			array(
				'label'     => __( 'Overlay Icon', 'zeus-elementor' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-search',
					'library' => 'solid',
				),
				'condition' => array(
					'add_overlay_icon' => 'yes',
				),
			)
		);

		$this->add_control(
			'icon_size',
			array(
				'label'     => __( 'Icon Size', 'zeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 20,
				),
				'range'     => array(
					'px' => array(
						'min' => 5,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .zeus-image-gallery .zeus-gallery-overlay' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'add_overlay_icon' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_caption',
			array(
				'label'       => __( 'Show Caption', 'zeus-elementor' ),
				'description' => __( 'Captions needs to be added to your images.', 'zeus-elementor' ),
				'type'        => Controls_Manager::SWITCHER,
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
			'overlay_content_alignment',
			array(
				'label'     => __( 'Overlay Content Alignment', 'zeus-elementor' ),
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
					'{{WRAPPER}} .zeus-image-gallery .zeus-gallery-overlay' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'overlay_content_position',
			array(
				'label'                => __( 'Overlay Content Vertical Position', 'zeus-elementor' ),
				'type'                 => Controls_Manager::CHOOSE,
				'options'              => array(
					'top'    => array(
						'title' => __( 'Top', 'zeus-elementor' ),
						'icon'  => 'eicon-v-align-top',
					),
					'middle' => array(
						'title' => __( 'Middle', 'zeus-elementor' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'bottom' => array(
						'title' => __( 'Bottom', 'zeus-elementor' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'selectors_dictionary' => array(
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				),
				'default'              => 'middle',
				'selectors'            => array(
					'{{WRAPPER}} .zeus-image-gallery .zeus-gallery-overlay' => '-webkit-justify-content: {{VALUE}}; justify-content: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_design_layout',
			array(
				'label' => __( 'Items', 'zeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'overlay_animation',
			array(
				'label'   => __( 'Overlay Animation', 'zeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fade',
				'options' => array(
					''                    => __( 'None', 'zeus-elementor' ),
					'fade'                => __( 'Fade', 'zeus-elementor' ),
					'slide-top'           => __( 'Slide Top', 'zeus-elementor' ),
					'slide-bottom'        => __( 'Slide Bottom', 'zeus-elementor' ),
					'slide-left'          => __( 'Slide Left', 'zeus-elementor' ),
					'slide-right'         => __( 'Slide Right', 'zeus-elementor' ),
					'slide-top-medium'    => __( 'Slide Top Medium', 'zeus-elementor' ),
					'slide-bottom-medium' => __( 'Slide Bottom Medium', 'zeus-elementor' ),
					'slide-left-medium'   => __( 'Slide Left Medium', 'zeus-elementor' ),
					'slide-right-medium'  => __( 'Slide Right Medium', 'zeus-elementor' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'item_border',
				'label'       => __( 'Border', 'zeus-elementor' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .zeus-image-gallery .zeus-gallery-thumbnail',
			)
		);

		$this->add_control(
			'item_border_radius',
			array(
				'label'      => __( 'Border Radius', 'zeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .zeus-image-gallery .zeus-gallery-thumbnail, {{WRAPPER}} .zeus-image-gallery .zeus-gallery-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'overlay_heading',
			array(
				'label'     => __( 'Overlay', 'zeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'add_lightbox' => 'yes',
				),
			)
		);

		$this->add_control(
			'overlay_background',
			array(
				'label'     => __( 'Background Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-image-gallery .zeus-gallery-overlay' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'add_lightbox' => 'yes',
				),
			)
		);

		$this->add_control(
			'overlay_icon_color',
			array(
				'label'     => __( 'Icon Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-image-gallery .zeus-gallery-overlay i' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'add_lightbox' => 'yes',
				),
			)
		);

		$this->add_control(
			'overlay_gap',
			array(
				'label'     => __( 'Gap', 'zeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .zeus-image-gallery .zeus-gallery-overlay' => 'margin: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'add_lightbox' => 'yes',
				),
			)
		);

		$this->add_control(
			'caption_heading',
			array(
				'label'     => __( 'Caption', 'zeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'show_caption' => 'yes',
				),
			)
		);

		$this->add_control(
			'caption_color',
			array(
				'label'     => __( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .zeus-image-gallery .zeus-gallery-item-caption' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'show_caption' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'caption_typography',
				'label'     => __( 'Typography', 'zeus-elementor' ),
				'selector'  => '{{WRAPPER}} .zeus-image-gallery .zeus-gallery-item-caption',
				'condition' => array(
					'show_caption' => 'yes',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrap', 'class', 'zeus-image-gallery' );

		if ( 'yes' === $settings['add_lightbox'] ) {
			$this->add_render_attribute( 'wrap', 'class', 'zeus-has-lightbox' );
		} ?>

		<div <?php $this->print_render_attribute_string( 'wrap' ); ?>>
			<?php
			foreach ( $settings['gallery_images'] as $index => $item ) :
				$item_key      = $this->get_repeater_setting_key( 'gallery-item', 'gallery_images', $index );
				$inner_key     = $this->get_repeater_setting_key( 'gallery-inner', 'gallery_images', $index );
				$overlay_key   = $this->get_repeater_setting_key( 'overlay', 'gallery_images', $index );
				$link_key      = $this->get_repeater_setting_key( 'link', 'gallery_images', $index );
				$tag           = 'div';
				$image_url     = Group_Control_Image_Size::get_attachment_image_src( $item['id'], 'thumbnail', $settings );
				$full_image    = wp_get_attachment_image_src( $item['id'], 'full' );
				$image_caption = get_post( $item['id'] );

				$this->add_render_attribute( $item_key, 'class', 'zeus-gallery-item' );

				$this->add_render_attribute( $inner_key, 'class', 'zeus-gallery-item-inner' );

				if ( $settings['add_lightbox'] ) {
					$tag = 'a';

					if ( ! $full_image ) {
						$this->add_render_attribute( $inner_key, 'href', $item['url'] );
						$this->add_render_attribute( $inner_key, 'data-width', 1920 );
						$this->add_render_attribute( $inner_key, 'data-height', 1200 );
					} else {
						$this->add_render_attribute( $inner_key, 'href', $full_image[0] );
						$this->add_render_attribute( $inner_key, 'data-width', $full_image[1] );
						$this->add_render_attribute( $inner_key, 'data-height', $full_image[2] );
					}

					$this->add_render_attribute( $inner_key, 'class', 'no-lightbox' );
					$this->add_render_attribute( $inner_key, 'data-elementor-open-lightbox', 'no' );
				}

				$this->add_render_attribute( $overlay_key, 'class', 'zeus-gallery-overlay' );

				if ( $settings['overlay_animation'] ) {
					$this->add_render_attribute( $overlay_key, 'class', 'zeus-gallery-transition-' . $settings['overlay_animation'] );
				}
				?>

				<div <?php $this->print_render_attribute_string( $item_key ); ?>>
					<<?php echo esc_attr( $tag ); ?> <?php $this->print_render_attribute_string( $inner_key ); ?>>
						<div class="zeus-gallery-thumbnail">
							<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( Control_Media::get_image_alt( $item ) ); ?>">
						</div>

						<?php
						if ( 'yes' === $settings['add_lightbox'] ) {
							?>
							<div <?php $this->print_render_attribute_string( $overlay_key ); ?>>
								<?php
								if ( 'yes' === $settings['add_overlay_icon'] ) {
									?>
									<div class="zeus-gallery-item-icon">
										<?php \Elementor\Icons_Manager::render_icon( $settings['overlay_icon'], array( 'aria-hidden' => 'true' ) ); ?>
									</div>
									<?php
								}

								if ( 'yes' === $settings['show_caption']
									&& ! empty( $image_caption ) ) {
									?>
									<div class="zeus-gallery-item-caption">
										<?php echo $image_caption->post_excerpt; ?>
									</div>
									<?php
								}
								?>
							</div>
							<?php
						}
						?>
					</<?php echo esc_attr( $tag ); ?>>
				</div>

				<?php
			endforeach;
			?>
		</div>

		<?php
	}
}
