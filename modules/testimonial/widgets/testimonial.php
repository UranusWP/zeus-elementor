<?php
namespace ZeusElementor\Modules\Testimonial\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;
use Elementor\Widget_Base;

class Testimonial extends Widget_Base {

	public function get_name() {
		return 'zeus-testimonial';
	}

	public function get_title() {
		return __( 'Testimonial', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-star';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'testimonial',
			'testimonials',
			'blockquote',
			'testi',
			'review',
			'recommendation',
			'appreciation',
			'feedback',
			'zeus',
		];
	}

	public function get_style_depends() {
		return [ 'zeus-testimonial' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_testimonial',
			[
				'label'         => __( 'Testimonial', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'testimonial_style',
			[
				'label'         => __( 'Style', 'zeus-elementor'),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'classic',
				'options'       => [
					'classic'   => __( 'Classic', 'zeus-elementor'),
					'inline'    => __( 'Inline', 'zeus-elementor'),
					'bubble'    => __( 'Bubble', 'zeus-elementor'),
				],
			]
		);

		$this->add_control(
			'testimonial_inline_image_position',
			[
				'label'         => __( 'Image Alignment', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'default'       => 'before',
				'options'       => [
					'before'        => [
						'title' => __( 'Before', 'zeus-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'after'     => [
						'title' => __( 'After', 'zeus-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'style_transfer' => true,
				'condition'     => [
					'testimonial_style' => 'inline',
				],
			]
		);

		$this->add_control(
			'testimonial_symbol',
			[
				'label'         => __( 'Display Symbol', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'dynamic'       => [
					'active' => true,
				],
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'testimonial_alignment',
			[
				'label'         => __( 'Alignment', 'zeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'default'       => 'center',
				'options'       => [
					'left'      => [
						'title' => __( 'Left', 'zeus-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center'    => [
						'title' => __( 'Center', 'zeus-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right'     => [
						'title' => __( 'Right', 'zeus-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'testimonial_content',
			[
				'label'         => __( 'Content', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'dynamic'       => [
					'active' => true,
				],
				'rows'          => '10',
				'default'       => __( 'Aliquam dignissim lacinia tristique nulla lobortis nunc ac eros scelerisque varius suspendisse sit amet urna vitae urna semper quis at ligula.', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'testimonial_image',
			[
				'label'         => __( 'Choose Image', 'zeus-elementor' ),
				'type'          => Controls_Manager::MEDIA,
				'dynamic'       => [
					'active' => true,
				],
				'default'       => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'          => 'testimonial_image',
				'default'       => 'full',
				'separator'     => 'none',
			]
		);

		$this->add_control(
			'testimonial_name',
			[
				'label'         => __( 'Name', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [
					'active' => true,
				],
				'default'       => __( 'Mark Wolf', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'testimonial_company',
			[
				'label'         => __( 'Company', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [
					'active' => true,
				],
				'default'       => __( 'Web Designer', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => __( 'Link', 'zeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'dynamic'       => [
					'active' => true,
				],
				'placeholder'   => __( 'https://your-link.com', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'testimonial_image_position',
			[
				'label'         => __( 'Image Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'aside',
				'options'       => [
					'aside' => __( 'Aside', 'zeus-elementor' ),
					'top'   => __( 'Top', 'zeus-elementor' ),
				],
				'condition'     => [
					'testimonial_image[url]!' => '',
					'testimonial_style!' => 'inline',
				],
				'separator'     => 'before',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'testimonial_rating',
			[
				'label'         => __( 'Display Rating', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'dynamic'       => [
					'active' => true,
				],
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'testimonial_rating_number',
			[
				'label'         => __( 'Rating Number', 'zeus-elementor'),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'rating-five',
				'options'       => [
					'rating-one'    => __( '1', 'zeus-elementor'),
					'rating-two'    => __( '2', 'zeus-elementor'),
					'rating-three'  => __( '3', 'zeus-elementor'),
					'rating-four'   => __( '4', 'zeus-elementor'),
					'rating-five'   => __( '5', 'zeus-elementor'),
				],
				'condition'     => [
					'testimonial_rating' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_testimonial_icon',
			[
				'label'         => __( 'Quote Icon', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-testimonial-symbol path' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-testimonial-symbol-inner' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-testimonial-symbol-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-testimonial-symbol' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-testimonial-symbol-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_testimonial_content',
			[
				'label'         => __( 'Content', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'         => __( 'Text Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-testimonial-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'content_typography',
				'selector'      => '{{WRAPPER}} .zeus-testimonial-content',
			]
		);

		$this->add_control(
			'content_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-testimonial-content, {{WRAPPER}} .zeus-testimonial-bubble .zeus-testimonial-content, {{WRAPPER}} .zeus-testimonial-bubble .zeus-testimonial-content:after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-testimonial-content, {{WRAPPER}} .zeus-testimonial-bubble .zeus-testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-testimonial-content, {{WRAPPER}} .zeus-testimonial-bubble .zeus-testimonial-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_testimonial_img',
			[
				'label'         => __( 'Image', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'img_width',
			[
				'label'         => __( 'Image Width', 'zeus-elementor'),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 60,
					'unit' => 'px',
				],
				'range'         => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'size_units'    => [ '%', 'px' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-testimonial-image img' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor'),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'body {{WRAPPER}} .zeus-testimonial-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'img_border',
				'label'         => __( 'Border', 'zeus-elementor'),
				'selector'      => '{{WRAPPER}} .zeus-testimonial-image img',
			]
		);

		$this->add_control(
			'img_border_radius',
			[
				'label'         => __( 'Border Radius', 'zeus-elementor'),
				'type'          => Controls_Manager::DIMENSIONS,
				'selectors'     => [
					'{{WRAPPER}} .zeus-testimonial-image img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_testimonial_details',
			[
				'label'         => __( 'Details', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_heading',
			[
				'label'         => __( 'Name', 'zeus-elementor'),
				'type'          => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-testimonial-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'name_typography',
				'selector'      => '{{WRAPPER}} .zeus-testimonial-name',
			]
		);

		$this->add_control(
			'company_heading',
			[
				'label'         => __( 'Company', 'zeus-elementor'),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before'
			]
		);

		$this->add_control(
			'company_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .zeus-testimonial-company' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'company_typography',
				'selector'      => '{{WRAPPER}} .zeus-testimonial-company',
			]
		);

		$this->add_control(
			'rating_heading',
			[
				'label'         => __( 'Rating', 'zeus-elementor'),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before'
			]
		);

		$this->add_control(
			'rating_spacing',
			[
				'label'         => __( 'Spacing', 'zeus-elementor'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-testimonial-rating li' => 'margin-right: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .zeus-testimonial-rating li' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: 0;',
				],
			]
		);

		$this->add_responsive_control(
			'rating_margin',
			[
				'label'         => __( 'Margin', 'zeus-elementor'),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-testimonial-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function testimonial_meta() {
		$settings       = $this->get_settings_for_display();
		$style          = $settings['testimonial_style'];
		$img_position   = $settings['testimonial_image_position'];
		$has_content    = ! ! $settings['testimonial_content'];
		$has_image      = ! ! $settings['testimonial_image']['url'];
		$has_name       = ! ! $settings['testimonial_name'];
		$has_company    = ! ! $settings['testimonial_company'];
		$has_rating     = $settings['testimonial_rating'];

		$this->add_render_attribute( 'meta', 'class', 'zeus-testimonial-meta' );

		if ( $settings['testimonial_image']['url'] ) {
			$this->add_render_attribute( 'meta', 'class', 'zeus-has-image' );
		}

		if ( $img_position && 'inline' !== $style ) {
			$this->add_render_attribute( 'meta', 'class', 'zeus-testimonial-image-position-' . $img_position );
		}

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'link', $settings['link'] );
		}

		if ( $has_rating ) {
			$this->add_render_attribute(
				'rating',
				[
					'class' => [
						'zeus-testimonial-rating',
						$settings['testimonial_rating_number'],
					],
				]
			);
		} ?>
		<div <?php $this->print_render_attribute_string( 'meta' ); ?>>
			<div class="zeus-testimonial-meta-inner">
				<?php
				if ( $has_image && 'inline' !== $style ) {
					?>
					<div class="zeus-testimonial-image">
						<?php
						$image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'testimonial_image' );
						if ( ! empty( $settings['link']['url'] ) ) {
							$image_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $image_html . '</a>';
						}
						echo wp_kses_post( $image_html ); ?>
					</div>
					<?php
				}

				if ( $has_name || $has_company ) { ?>

					<div class="zeus-testimonial-details">
						<?php
						if ( $has_name ) {
							$this->add_render_attribute( 'testimonial_name', 'class', 'zeus-testimonial-name' );
							$this->add_inline_editing_attributes( 'testimonial_name', 'none' );

							if ( ! empty( $settings['link']['url'] ) ) { ?>
								<a <?php $this->print_render_attribute_string( 'testimonial_name' ) . ' ' . $this->get_render_attribute_string( 'link' ); ?>><?php $this->print_unescaped_setting( 'testimonial_name' ); ?></a>
								<?php
							} else { ?>
								<div <?php $this->print_render_attribute_string( 'testimonial_name' ); ?>><?php $this->print_unescaped_setting( 'testimonial_name' ); ?></div>
								<?php
							}
						}

						if ( $has_company ) {

							$this->add_render_attribute( 'testimonial_company', 'class', 'zeus-testimonial-company' );

							$this->add_inline_editing_attributes( 'testimonial_company', 'none' );

							if ( ! empty( $settings['link']['url'] ) ) { ?>
								<a <?php $this->print_render_attribute_string( 'testimonial_company' ) . ' ' . $this->get_render_attribute_string( 'link' ); ?>><?php $this->print_unescaped_setting( 'testimonial_company' ); ?></a>
								<?php
							} else { ?>
								<div <?php $this->print_render_attribute_string( 'testimonial_company' ); ?>><?php $this->print_unescaped_setting( 'testimonial_company' ); ?></div>
								<?php
							}
						}

						if ( 'yes' === $has_rating ) { ?>
							<ul <?php $this->print_render_attribute_string( 'rating' ); ?>>
								<li><svg viewBox="0 -10 511.99143 511" xmlns="http://www.w3.org/2000/svg"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"/></svg></li>
								<li><svg viewBox="0 -10 511.99143 511" xmlns="http://www.w3.org/2000/svg"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"/></svg></li>
								<li><svg viewBox="0 -10 511.99143 511" xmlns="http://www.w3.org/2000/svg"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"/></svg></li>
								<li><svg viewBox="0 -10 511.99143 511" xmlns="http://www.w3.org/2000/svg"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"/></svg></li>
								<li><svg viewBox="0 -10 511.99143 511" xmlns="http://www.w3.org/2000/svg"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"/></svg></li>
							</ul>
							<?php
						} ?>

					</div>

					<?php
				} ?>

			</div>

		</div>
		<?php
	}

	protected function render() {
		$settings       = $this->get_settings_for_display();
		$style          = $settings['testimonial_style'];
		$align          = $settings['testimonial_alignment'];
		$img_align      = $settings['testimonial_inline_image_position'];
		$has_symbol     = $settings['testimonial_symbol'];
		$has_content    = ! ! $settings['testimonial_content'];
		$has_image      = ! ! $settings['testimonial_image']['url'];
		$has_name       = ! ! $settings['testimonial_name'];
		$has_company    = ! ! $settings['testimonial_company'];
		$has_rating     = $settings['testimonial_rating'];

		$this->add_render_attribute( 'wrapper', 'class', 'zeus-testimonial-wrapper' );

		if ( $align ) {
			$this->add_render_attribute( 'wrapper', 'class', 'zeus-testimonial-text-align-' . $align );
		}

		if ( $style ) {
			$this->add_render_attribute( 'wrapper', 'class', 'zeus-testimonial-' . $style );
		}

		if ( 'inline' === $style ) {
			$this->add_render_attribute( 'wrapper', 'class', 'zeus-testimonial-image-' . $img_align );
		}

		if ( ! $has_content && ! $has_image && ! $has_name && ! $has_company ) {
			return;
		} ?>

		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

			<?php
			if ( $has_image && 'inline' === $style && 'before' === $img_align ) {
				?>
				<div class="zeus-testimonial-image">
					<?php
					$image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'testimonial_image' );
					if ( ! empty( $settings['link']['url'] ) ) {
						$image_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $image_html . '</a>';
					}
					echo wp_kses_post( $image_html ); ?>
				</div>
				<?php
			}

			if ( 'yes' === $has_symbol &&
				( 'inline' !== $style || 'inline' === $style && 'after' === $img_align ) ) {
				?>
				<div class="zeus-testimonial-symbol">
					<div class="zeus-testimonial-symbol-inner">
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 33"><path d="M29.480315,7.65354331 C27.5485468,10.0682535 26.5826772,12.5144233 26.5826772,14.992126 C26.5826772,16.042 26.7086602,16.9448781 26.9606299,17.7007874 C28.4304535,16.5669235 30.0262381,16 31.7480315,16 C34.0997493,16 36.0629843,16.7453994 37.6377953,18.2362205 C39.2126063,19.7270416 40,21.7322709 40,24.2519685 C40,26.6036863 39.2021077,28.5669213 37.6062992,30.1417323 C36.0104907,31.7165433 34.0577543,32.503937 31.7480315,32.503937 C28.4304296,32.503937 25.8897726,31.1391213 24.1259843,28.4094488 C22.6561606,26.1417209 21.9212598,23.3071036 21.9212598,19.9055118 C21.9212598,15.5800309 23.023611,11.7060539 25.2283465,8.28346457 C27.4330819,4.86087528 30.7611326,2.09974803 35.2125984,0 L36.4094488,2.33070866 C33.7217713,3.4645726 31.4120831,5.23883307 29.480315,7.65354331 Z M7.55905512,7.65354331 C5.62728693,10.0682535 4.66141732,12.5144233 4.66141732,14.992126 C4.66141732,16.042 4.78740031,16.9448781 5.03937008,17.7007874 C6.46719874,16.5669235 8.06298331,16 9.82677165,16 C12.1364945,16 14.0892309,16.7453994 15.6850394,18.2362205 C17.2808479,19.7270416 18.0787402,21.7322709 18.0787402,24.2519685 C18.0787402,25.805782 17.7007912,27.2125921 16.9448819,28.4724409 C16.1889726,29.7322898 15.1811087,30.7191565 13.9212598,31.4330709 C12.661411,32.1469852 11.2965953,32.503937 9.82677165,32.503937 C6.50916976,32.503937 3.96851276,31.1391213 2.20472441,28.4094488 C0.734900787,26.1417209 0,23.3071036 0,19.9055118 C0,15.5800309 1.10235118,11.7060539 3.30708661,8.28346457 C5.51182205,4.86087528 8.83987276,2.09974803 13.2913386,0 L14.488189,2.33070866 C11.8005115,3.4645726 9.49082331,5.23883307 7.55905512,7.65354331 Z"></path></svg>
					</div>
				</div>
				<?php
			}

			if ( $has_content ) {
				$this->add_render_attribute( 'testimonial_content_wrapper', 'class', 'zeus-testimonial-content' );
				$this->add_render_attribute( 'testimonial_content', 'class', 'zeus-testimonial-content-inner' );
				$this->add_inline_editing_attributes( 'testimonial_content' ); ?>

				<div <?php $this->print_render_attribute_string( 'testimonial_content_wrapper' ); ?>>
					<div <?php $this->print_render_attribute_string( 'testimonial_content' ); ?>>
						<?php echo esc_html( $settings['testimonial_content'] ); ?>
					</div>

					<?php
					if ( 'inline' === $style && ( $has_image || $has_name || $has_company ) ) {
						$this->testimonial_meta();
					} ?>
				</div>
				<?php
			}

			if ( 'inline' !== $style && ( $has_image || $has_name || $has_company ) ) {
				$this->testimonial_meta();
			}

			if ( 'yes' === $has_symbol && 'inline' === $style && 'before' === $img_align ) {
				?>
				<div class="zeus-testimonial-symbol">
					<div class="zeus-testimonial-symbol-inner">
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 33"><path d="M29.480315,7.65354331 C27.5485468,10.0682535 26.5826772,12.5144233 26.5826772,14.992126 C26.5826772,16.042 26.7086602,16.9448781 26.9606299,17.7007874 C28.4304535,16.5669235 30.0262381,16 31.7480315,16 C34.0997493,16 36.0629843,16.7453994 37.6377953,18.2362205 C39.2126063,19.7270416 40,21.7322709 40,24.2519685 C40,26.6036863 39.2021077,28.5669213 37.6062992,30.1417323 C36.0104907,31.7165433 34.0577543,32.503937 31.7480315,32.503937 C28.4304296,32.503937 25.8897726,31.1391213 24.1259843,28.4094488 C22.6561606,26.1417209 21.9212598,23.3071036 21.9212598,19.9055118 C21.9212598,15.5800309 23.023611,11.7060539 25.2283465,8.28346457 C27.4330819,4.86087528 30.7611326,2.09974803 35.2125984,0 L36.4094488,2.33070866 C33.7217713,3.4645726 31.4120831,5.23883307 29.480315,7.65354331 Z M7.55905512,7.65354331 C5.62728693,10.0682535 4.66141732,12.5144233 4.66141732,14.992126 C4.66141732,16.042 4.78740031,16.9448781 5.03937008,17.7007874 C6.46719874,16.5669235 8.06298331,16 9.82677165,16 C12.1364945,16 14.0892309,16.7453994 15.6850394,18.2362205 C17.2808479,19.7270416 18.0787402,21.7322709 18.0787402,24.2519685 C18.0787402,25.805782 17.7007912,27.2125921 16.9448819,28.4724409 C16.1889726,29.7322898 15.1811087,30.7191565 13.9212598,31.4330709 C12.661411,32.1469852 11.2965953,32.503937 9.82677165,32.503937 C6.50916976,32.503937 3.96851276,31.1391213 2.20472441,28.4094488 C0.734900787,26.1417209 0,23.3071036 0,19.9055118 C0,15.5800309 1.10235118,11.7060539 3.30708661,8.28346457 C5.51182205,4.86087528 8.83987276,2.09974803 13.2913386,0 L14.488189,2.33070866 C11.8005115,3.4645726 9.49082331,5.23883307 7.55905512,7.65354331 Z"></path></svg>
					</div>
				</div>
				<?php
			}

			if ( $has_image && 'inline' === $style && 'after' === $img_align ) {
				?>
				<div class="zeus-testimonial-image">
					<?php
					$image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'testimonial_image' );
					if ( ! empty( $settings['link']['url'] ) ) {
						$image_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $image_html . '</a>';
					}
					echo wp_kses_post( $image_html ); ?>
				</div>
				<?php
			} ?>

		</div>

		<?php
	}

	/**
	 * Render Price List widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() { ?>
		<#
		var $style          = settings.testimonial_style,
			$align          = settings.testimonial_alignment,
			$img_align      = settings.testimonial_inline_image_position,
			$has_symbol     = settings.testimonial_symbol,
			$has_content    = settings.testimonial_content,
			$has_image      = settings.testimonial_image.url,
			$has_name       = settings.testimonial_name,
			$has_company    = settings.testimonial_company,
			$has_rating     = settings.testimonial_rating;

		view.addRenderAttribute( 'wrapper', 'class', 'zeus-testimonial-wrapper' );

		if ( '' !== $align ) {
			view.addRenderAttribute( 'wrapper', 'class', 'zeus-testimonial-text-align-' + $align );
		}

		if ( '' !== $style ) {
			view.addRenderAttribute( 'wrapper', 'class', 'zeus-testimonial-' + $style );
		}

		if ( 'inline' == $style ) {
			view.addRenderAttribute( 'wrapper', 'class', 'zeus-testimonial-image-' + $img_align );
		} #>

		<div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>

			<#
			if ( '' !== $has_image && 'inline' == $style && 'before' == $img_align ) { #>
				<?php $this->render_testimonial_img(); ?>
			<# }

			if ( 'yes' == $has_symbol && 
				( 'inline' != $style || 'inline' == $style && 'after' == $img_align ) ) { #>
				<div class="zeus-testimonial-symbol">
					<div class="zeus-testimonial-symbol-inner">
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 33"><path d="M29.480315,7.65354331 C27.5485468,10.0682535 26.5826772,12.5144233 26.5826772,14.992126 C26.5826772,16.042 26.7086602,16.9448781 26.9606299,17.7007874 C28.4304535,16.5669235 30.0262381,16 31.7480315,16 C34.0997493,16 36.0629843,16.7453994 37.6377953,18.2362205 C39.2126063,19.7270416 40,21.7322709 40,24.2519685 C40,26.6036863 39.2021077,28.5669213 37.6062992,30.1417323 C36.0104907,31.7165433 34.0577543,32.503937 31.7480315,32.503937 C28.4304296,32.503937 25.8897726,31.1391213 24.1259843,28.4094488 C22.6561606,26.1417209 21.9212598,23.3071036 21.9212598,19.9055118 C21.9212598,15.5800309 23.023611,11.7060539 25.2283465,8.28346457 C27.4330819,4.86087528 30.7611326,2.09974803 35.2125984,0 L36.4094488,2.33070866 C33.7217713,3.4645726 31.4120831,5.23883307 29.480315,7.65354331 Z M7.55905512,7.65354331 C5.62728693,10.0682535 4.66141732,12.5144233 4.66141732,14.992126 C4.66141732,16.042 4.78740031,16.9448781 5.03937008,17.7007874 C6.46719874,16.5669235 8.06298331,16 9.82677165,16 C12.1364945,16 14.0892309,16.7453994 15.6850394,18.2362205 C17.2808479,19.7270416 18.0787402,21.7322709 18.0787402,24.2519685 C18.0787402,25.805782 17.7007912,27.2125921 16.9448819,28.4724409 C16.1889726,29.7322898 15.1811087,30.7191565 13.9212598,31.4330709 C12.661411,32.1469852 11.2965953,32.503937 9.82677165,32.503937 C6.50916976,32.503937 3.96851276,31.1391213 2.20472441,28.4094488 C0.734900787,26.1417209 0,23.3071036 0,19.9055118 C0,15.5800309 1.10235118,11.7060539 3.30708661,8.28346457 C5.51182205,4.86087528 8.83987276,2.09974803 13.2913386,0 L14.488189,2.33070866 C11.8005115,3.4645726 9.49082331,5.23883307 7.55905512,7.65354331 Z"></path></svg>
					</div>
				</div>
			<# }

			if ( '' !== $has_content ) {
				view.addRenderAttribute( 'testimonial_content_wrapper', 'class', 'zeus-testimonial-content' );
				view.addRenderAttribute( 'testimonial_content', 'class', 'zeus-testimonial-content-inner' );
				view.addInlineEditingAttributes( 'testimonial_content', 'none' ); #>

				<div {{{ view.getRenderAttributeString( 'testimonial_content_wrapper' ) }}}>
					<div {{{ view.getRenderAttributeString( 'testimonial_content' ) }}}>
						{{{ settings.testimonial_content }}}
					</div>

					<#
					if ( 'inline' == $style && ( '' !== $has_image || '' !== $has_name || '' !== $has_company ) ) { #>
						<?php $this->render_testimonial_meta(); ?>
					<# } #>
				</div>
			<#
			}

			if ( 'inline' != $style && ( '' !== $has_image || '' !== $has_name || '' !== $has_company ) ) { #>
				<?php $this->render_testimonial_meta(); ?>
			<# }

			if ( 'yes' == $has_symbol && 'inline' == $style && 'before' == $img_align ) { #>
				<div class="zeus-testimonial-symbol">
					<div class="zeus-testimonial-symbol-inner">
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 33"><path d="M29.480315,7.65354331 C27.5485468,10.0682535 26.5826772,12.5144233 26.5826772,14.992126 C26.5826772,16.042 26.7086602,16.9448781 26.9606299,17.7007874 C28.4304535,16.5669235 30.0262381,16 31.7480315,16 C34.0997493,16 36.0629843,16.7453994 37.6377953,18.2362205 C39.2126063,19.7270416 40,21.7322709 40,24.2519685 C40,26.6036863 39.2021077,28.5669213 37.6062992,30.1417323 C36.0104907,31.7165433 34.0577543,32.503937 31.7480315,32.503937 C28.4304296,32.503937 25.8897726,31.1391213 24.1259843,28.4094488 C22.6561606,26.1417209 21.9212598,23.3071036 21.9212598,19.9055118 C21.9212598,15.5800309 23.023611,11.7060539 25.2283465,8.28346457 C27.4330819,4.86087528 30.7611326,2.09974803 35.2125984,0 L36.4094488,2.33070866 C33.7217713,3.4645726 31.4120831,5.23883307 29.480315,7.65354331 Z M7.55905512,7.65354331 C5.62728693,10.0682535 4.66141732,12.5144233 4.66141732,14.992126 C4.66141732,16.042 4.78740031,16.9448781 5.03937008,17.7007874 C6.46719874,16.5669235 8.06298331,16 9.82677165,16 C12.1364945,16 14.0892309,16.7453994 15.6850394,18.2362205 C17.2808479,19.7270416 18.0787402,21.7322709 18.0787402,24.2519685 C18.0787402,25.805782 17.7007912,27.2125921 16.9448819,28.4724409 C16.1889726,29.7322898 15.1811087,30.7191565 13.9212598,31.4330709 C12.661411,32.1469852 11.2965953,32.503937 9.82677165,32.503937 C6.50916976,32.503937 3.96851276,31.1391213 2.20472441,28.4094488 C0.734900787,26.1417209 0,23.3071036 0,19.9055118 C0,15.5800309 1.10235118,11.7060539 3.30708661,8.28346457 C5.51182205,4.86087528 8.83987276,2.09974803 13.2913386,0 L14.488189,2.33070866 C11.8005115,3.4645726 9.49082331,5.23883307 7.55905512,7.65354331 Z"></path></svg>
					</div>
				</div>
			<# }

			if ( '' !== $has_image && 'inline' == $style && 'after' == $img_align ) { #>
				<?php $this->render_testimonial_img(); ?>
			<# } #>

		</div>

		<?php
	}

	protected function render_testimonial_img() { ?>
		<#
		var image = {
				id: settings.testimonial_image.id,
				url: settings.testimonial_image.url,
				size: settings.testimonial_image_size,
				dimension: settings.testimonial_image_custom_dimension,
				model: view.getEditModel()
			};

		var imageUrl = false;

		if ( '' !== settings.testimonial_image.url ) {
			imageUrl = elementor.imagesManager.getImageUrl( image );

			var imageHtml = '<img src="' + imageUrl + '" alt="testimonial" />';
			if ( settings.link.url ) {
				imageHtml = '<a href="' + settings.link.url + '">' + imageHtml + '</a>';
			}
		}

		if ( imageUrl ) { #>
			<div class="zeus-testimonial-image">{{{ imageHtml }}}</div>
		<# } #>
		<?php
	}

	protected function render_testimonial_meta() { ?>
		<#
		var $style          = settings.testimonial_style,
			$img_position   = settings.testimonial_image_position,
			$has_content    = settings.testimonial_content,
			$has_image      = settings.testimonial_image.url,
			$has_name       = settings.testimonial_name,
			$has_company    = settings.testimonial_company,
			$has_rating     = settings.testimonial_rating;

		view.addRenderAttribute( 'meta', 'class', 'zeus-testimonial-meta' );

		if ( '' !== $has_image ) {
			view.addRenderAttribute( 'meta', 'class', 'zeus-has-image' );
		}

		if ( '' !== $img_position && 'inline' != $style ) {
			view.addRenderAttribute( 'meta', 'class', 'zeus-testimonial-image-position-' + $img_position );
		}

		if ( '' !== $has_rating ) {
			view.addRenderAttribute( 'rating', 'class', 'zeus-testimonial-rating' );
			view.addRenderAttribute( 'rating', 'class', settings.testimonial_rating_number );
		} #>
		<div {{{ view.getRenderAttributeString( 'meta' ) }}}>
			<div class="zeus-testimonial-meta-inner">
				<#
				if ( '' !== $has_image && 'inline' != $style ) { #>
					<?php $this->render_testimonial_img(); ?>
				<# }

				if ( '' !== $has_name || '' !== $has_company ) { #>

					<div class="zeus-testimonial-details">
						<#
						if ( '' !== $has_name ) {
							view.addRenderAttribute( 'testimonial_name', 'class', 'zeus-testimonial-name' );
							view.addInlineEditingAttributes( 'testimonial_name', 'none' );

							if ( settings.link.url ) { #>
								<a href="{{{ settings.link.url }}}" {{{ view.getRenderAttributeString( 'testimonial_name' ) }}}>{{{ settings.testimonial_name }}}</a>
							<#
							} else { #>
								<div {{{ view.getRenderAttributeString( 'testimonial_name' ) }}}>{{{ settings.testimonial_name }}}</div>
							<#
							}

						}

						if ( '' !== $has_company ) {
							view.addRenderAttribute( 'testimonial_company', 'class', 'zeus-testimonial-company' );
							view.addInlineEditingAttributes( 'testimonial_company', 'none' );

							if ( settings.link.url ) { #>
								<a href="{{{ settings.link.url }}}" {{{ view.getRenderAttributeString( 'testimonial_company' ) }}}>{{{ settings.testimonial_company }}}</a>
							<#
							} else { #>
								<div {{{ view.getRenderAttributeString( 'testimonial_company' ) }}}>{{{ settings.testimonial_company }}}</div>
							<#
							}

						}

						if ( 'yes' == $has_rating ) { #>
							<ul {{{ view.getRenderAttributeString( 'rating' ) }}}>
								<li><svg viewBox="0 -10 511.99143 511" xmlns="http://www.w3.org/2000/svg"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"/></svg></li>
								<li><svg viewBox="0 -10 511.99143 511" xmlns="http://www.w3.org/2000/svg"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"/></svg></li>
								<li><svg viewBox="0 -10 511.99143 511" xmlns="http://www.w3.org/2000/svg"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"/></svg></li>
								<li><svg viewBox="0 -10 511.99143 511" xmlns="http://www.w3.org/2000/svg"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"/></svg></li>
								<li><svg viewBox="0 -10 511.99143 511" xmlns="http://www.w3.org/2000/svg"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"/></svg></li>
							</ul>
						<#
						} #>

					</div>

				<#
				} #>

			</div>

		</div>
		<?php
	}

}
