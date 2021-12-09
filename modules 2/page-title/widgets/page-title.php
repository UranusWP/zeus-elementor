<?php
namespace ZeusElementor\Modules\PageTitle\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class PageTitle extends Widget_Base {

	public function get_name() {
		return 'zeus-page-title';
	}

	public function get_title() {
		return __( 'Page Title', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-paper';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'heading',
			'title',
			'page title',
			'header',
			'page header',
			'site',
			'zeus',
		];
	}

	public function get_style_depends() {
		return [ 'zeus-page-title' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label'         => __( 'Page Title', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label'         => __( 'HTML Tag', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'h2',
				'options'       => zeus_get_available_tags(),
			]
		);

		$this->add_responsive_control(
			'align',
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
				'default'       => 'center',
				'prefix_class'  => 'elementor-align%s-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label'         => __( 'Title', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'typography',
				'selector'      => '{{WRAPPER}} .zeus-page-title',
			]
		);

		$this->add_control(
			'color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-page-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render_post_id() {

		// Default value.
		$id = '';

		// If singular get_the_ID.
		if ( is_singular() ) {
			$id = get_the_ID();
		} elseif ( class_exists( 'WooCommerce' ) && is_shop() ) {
			// Get ID of WooCommerce product archive.
			$shop_id = wc_get_page_id( 'shop' );
			if ( isset( $shop_id ) ) {
				$id = $shop_id;
			}
		} elseif ( is_home() && $page_for_posts = get_option( 'page_for_posts' ) ) { // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.FoundInControlStructure
			// Posts page.
			$id = $page_for_posts;
		}

		// Sanitize.
		$id = $id ? $id : '';

		// Return ID.
		return $id;

	}

	protected function render_page_title() {

		// Default title is null.
		$title = null;

		// Get post ID.
		$post_id = $this->render_post_id();

		// Homepage - display blog description if not a static page.
		if ( is_front_page() && ! is_singular( 'page' ) ) {

			if ( get_bloginfo( 'description' ) ) {
				$title = get_bloginfo( 'description' );
			} else {
				$title = esc_html__( 'Recent Posts', 'zeus-elementor' );
			}
		} elseif ( is_home() && ! is_singular( 'page' ) ) {
			// Homepage posts page.
			$title = get_the_title( get_option( 'page_for_posts', true ) );
		} elseif ( is_search() ) {
			// Search needs to go before archives.
			global $wp_query;
			$title = '<span id="search-results-count">' . $wp_query->found_posts . '</span> ' . esc_html__( 'Search Results Found', 'zeus-elementor' );
		} elseif ( is_archive() ) {
			// Archives.

			if ( is_author() ) {
				// Author.
				$title = get_the_archive_title();
			} elseif ( is_post_type_archive() ) {
				// Post Type archive title.
				$title = post_type_archive_title( '', false );
			} elseif ( is_day() ) {
				// Daily archive title.
				$title = sprintf( esc_html__( 'Daily Archives: %s', 'zeus-elementor' ), get_the_date() );
			} elseif ( is_month() ) {
				// Monthly archive title.
				$title = sprintf( esc_html__( 'Monthly Archives: %s', 'zeus-elementor' ), get_the_date( esc_html_x( 'F Y', 'Page title monthly archives date format', 'zeus-elementor' ) ) );
			} elseif ( is_year() ) {
				// Yearly archive title.
				$title = sprintf( esc_html__( 'Yearly Archives: %s', 'zeus-elementor' ), get_the_date( esc_html_x( 'Y', 'Page title yearly archives date format', 'zeus-elementor' ) ) );
			} else {
				// Categories/Tags/Other.

				// Get term title.
				$title = single_term_title( '', false );

				// Fix for plugins that are archives but use pages.
				if ( ! $title ) {
					global $post;
					$title = get_the_title( $post_id );
				}
			}
		} elseif ( is_404() ) {
			// 404 Page.
			$title = esc_html__( '404: Page Not Found', 'zeus-elementor' );
		} elseif ( function_exists( 'is_wc_endpoint_url' ) && is_wc_endpoint_url() ) {
			// Fix for WooCommerce My Accounts pages.
			$endpoint       = WC()->query->get_current_endpoint();
			$endpoint_title = WC()->query->get_endpoint_title( $endpoint );
			$title          = $endpoint_title ? $endpoint_title : $title;
		} elseif ( $post_id ) {
			// Anything else with a post_id defined.

			if ( is_singular( 'page' ) || is_singular( 'attachment' ) ) {
				// Single Pages.
				$title = get_the_title( $post_id );
			} elseif ( is_singular( 'post' ) ) {
				// Single blog posts.
				$title = get_the_title();
			} else {
				// Other posts.
				$title = get_the_title( $post_id );
			}
		}

		// Last check if title is empty.
		$title = $title ? $title : get_the_title();

		// Return title.
		return $title;

	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$tag  = $settings['title_html_tag'];

		$this->add_render_attribute( 'title', 'class', 'zeus-page-title' ); ?>

		<<?php echo esc_attr( $tag ); ?> <?php $this->print_render_attribute_string( 'title' ); ?>><?php echo wp_kses_post( $this->render_page_title() ); ?></<?php echo esc_attr( $tag ); ?>>

		<?php
	}
}
