<?php
namespace ZeusElementor\Modules\AnimatedHeading\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class AnimatedHeading extends Widget_Base {

	public function get_name() {
		return 'zeus-animated-heading';
	}

	public function get_title() {
		return __( 'Animated Heading', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-handwriting';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'animated heading',
			'heading',
			'title',
			'animated',
			'zeus',
		];
	}

	public function get_script_depends() {
		return [ 'zeus-animated-heading' ];
	}

	public function get_style_depends() {
		return [ 'zeus-animated-heading' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_animated_heading',
			[
				'label' => __( 'Heading', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'heading_layout',
			[
				'label'              => __( 'Layout', 'zeus-elementor' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'animated',
				'options'            => [
					'animated' => __( 'Animated', 'zeus-elementor' ),
					'typed'    => __( 'Typed', 'zeus-elementor' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'pre_heading',
			[
				'label'       => __( 'Pre Heading', 'zeus-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'This is an', 'zeus-elementor' ),
				'placeholder' => __( 'Enter your prefix heading', 'zeus-elementor' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'animated_heading',
			[
				'label'              => __( 'Heading', 'zeus-elementor' ),
				'description'        => __( 'Write animated heading here with comma separated. Such as Animated, Morphing, Awesome', 'zeus-elementor' ),
				'type'               => Controls_Manager::TEXTAREA,
				'default'            => __( 'Animated, Amazing, Awesome', 'zeus-elementor' ),
				'placeholder'        => __( 'Enter your animated heading', 'zeus-elementor' ),
				'dynamic'            => [ 'active' => true ],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'post_heading',
			[
				'label'       => __( 'Post Heading', 'zeus-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Heading', 'zeus-elementor' ),
				'placeholder' => __( 'Enter your suffix heading', 'zeus-elementor' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'link',
			[
				'label'       => __( 'Link', 'zeus-elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'http://your-link.com',
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label'     => __( 'HTML Tag', 'zeus-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => zeus_get_available_tags(),
				'default'   => 'h2',
				'condition' => [
					'link[url]' => '',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'        => __( 'Alignment', 'zeus-elementor' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
					'left'   => [
						'title' => __( 'Left', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'zeus-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'      => 'center',
				'prefix_class' => 'elementor-align%s-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_animation',
			[
				'label'     => __( 'Animation Options', 'zeus-elementor' ),
				'condition' => [
					'heading_animation!' => '',
				],
			]
		);

		$this->add_control(
			'heading_animation',
			[
				'label'              => __( 'Animation', 'zeus-elementor' ),
				'type'               => Controls_Manager::ANIMATION,
				'default'            => 'fadeIn',
				'condition'          => [
					'heading_animation!' => '',
					'heading_layout'     => 'animated',
				],
				'frontend_available' => true,
				'render_type'        => 'template',
			]
		);

		$this->add_control(
			'heading_animation_delay',
			[
				'label'              => __( 'Delay (ms)', 'zeus-elementor' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 2500,
				'min'                => 100,
				'max'                => 7000,
				'step'               => 100,
				'condition'          => [
					'heading_animation!' => '',
					'heading_layout'     => 'animated',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'type_speed',
			[
				'label'              => __( 'Type Speed', 'zeus-elementor' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 50,
				'min'                => 10,
				'max'                => 100,
				'step'               => 5,
				'condition'          => [
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'start_delay',
			[
				'label'              => __( 'Start Delay', 'zeus-elementor' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 1,
				'min'                => 1,
				'max'                => 100,
				'step'               => 1,
				'condition'          => [
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'back_speed',
			[
				'label'              => __( 'Back Speed', 'zeus-elementor' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 30,
				'min'                => 0,
				'max'                => 100,
				'step'               => 2,
				'condition'          => [
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'back_delay',
			[
				'label'              => __( 'Back Delay', 'zeus-elementor' ) . ' (ms)',
				'type'               => Controls_Manager::NUMBER,
				'default'            => 500,
				'min'                => 0,
				'max'                => 3000,
				'step'               => 50,
				'condition'          => [
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'loop',
			[
				'label'              => __( 'Loop', 'zeus-elementor' ),
				'type'               => Controls_Manager::SWITCHER,
				'default'            => 'yes',
				'condition'          => [
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'loop_count',
			[
				'label'              => __( 'Loop Count', 'zeus-elementor' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 0,
				'min'                => 0,
				'condition'          => [
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
					'loop'               => 'yes',
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_pre_heading',
			[
				'label'     => __( 'Pre Heading', 'zeus-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'pre_heading!' => '',
				],
			]
		);

		$this->add_control(
			'pre_heading_color',
			[
				'label'     => __( 'Pre Heading Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zeus-heading-wrap .zeus-pre-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pre_heading_typography',
				'selector' => '{{WRAPPER}} .zeus-heading-wrap .zeus-pre-heading',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'pre_heading_shadow',
				'selector' => '{{WRAPPER}} .zeus-heading-wrap .zeus-pre-heading',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_animated_heading',
			[
				'label' => __( 'Animated Heading', 'zeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'animated_heading_color',
			[
				'label'     => __( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zeus-heading-wrap .zeus-heading-tag' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'animated_heading_typography',
				'selector' => '{{WRAPPER}} .zeus-heading-wrap .zeus-heading-tag',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'animated_heading_shadow',
				'selector' => '{{WRAPPER}} .zeus-heading-wrap .zeus-heading-tag',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_post_heading',
			[
				'label'     => __( 'Post Heading', 'zeus-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'post_heading!' => '',
				],
			]
		);

		$this->add_control(
			'post_heading_color',
			[
				'label'     => __( 'Post Heading Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zeus-heading-wrap .zeus-post-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'post_heading_typography',
				'selector' => '{{WRAPPER}} .zeus-heading-wrap .zeus-post-heading',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'post_heading_shadow',
				'selector' => '{{WRAPPER}} .zeus-heading-wrap .zeus-post-heading',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$id        = $this->get_id();
		$title_tag = $settings['title_html_tag'];

		$this->add_render_attribute( 'heading', 'class', 'zeus-heading-tag' );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'heading', $settings['link'] );
			$title_tag = 'a';
		} ?>

		<div id="zeus-animated-heading-<?php echo esc_attr( $id ); ?>" class="zeus-heading-wrap">
			<<?php echo esc_attr( $title_tag ); ?> <?php $this->print_render_attribute_string( 'heading' ); ?>>

				<?php
				if ( $settings['pre_heading'] ) {
					?>
					<div class="zeus-pre-heading"><?php $this->print_unescaped_setting( 'pre_heading' ); ?></div>
					<?php
				}

				if ( $settings['animated_heading'] ) {
					if ( 'animated' === $settings['heading_layout'] ) {
						?>
						<div class="zeus-animated-heading zeus-heading-<?php echo esc_attr( $id ); ?>">
							<?php rtrim( $this->print_unescaped_setting( 'animated_heading' ), ',' ); ?>
						</div>
						<?php
					} elseif ( 'typed' === $settings['heading_layout'] ) {
						?>
						<div class="zeus-animated-heading zeus-heading-<?php echo esc_attr( $id ); ?>"></div>
						<?php
					}
				}

				if ( $settings['post_heading'] ) {
					?>
					<div class="zeus-post-heading"><?php $this->print_unescaped_setting( 'post_heading' ); ?></div>
					<?php
				}
				?>

			</<?php echo esc_attr( $title_tag ); ?>>
		</div>
		<?php
	}
}
