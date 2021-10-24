<?php
namespace ZeusElementor\Modules\Table\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Table extends Widget_Base {

	public function get_name() {
		return 'zeus-table';
	}

	public function get_title() {
		return __( 'Table', 'zeus-elementor' );
	}

	public function get_icon() {
		return 'zeus-icon zeus-grid';
	}

	public function get_categories() {
		return [ 'zeus-elements' ];
	}

	public function get_keywords() {
		return [
			'table',
			'zeus',
		];
	}

	public function get_style_depends() {
		return [ 'zeus-table' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_header',
			[
				'label'         => __( 'Header', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'hide_headers_mobile',
			[
				'label'         => __( 'Hide Headers on Mobile', 'zeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'return_value'  => 'hide',
				'prefix_class'  => 'zeus-table-mobile-header-',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'mobile_display',
			[
				'label'         => __( 'Mobile Display', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'column',
				'options'       => [
					'column'    => __( 'Column', 'zeus-elementor' ),
					'inline'    => __( 'Inline', 'zeus-elementor' ),
				],
				'prefix_class'  => 'zeus-table-mobile-header-',
				'condition'     => [
					'hide_headers_mobile!' => 'hide',
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'cell_text',
			[
				'label'         => __( 'Cell Text', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'cell_icon',
			[
				'label'         => __( 'Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::ICON,
				'default'       => '',
			]
		);

		$repeater->add_control(
			'cell_icon_align',
			[
				'label'         => __( 'Icon Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'left',
				'options'       => [
					'left' => __( 'Before', 'zeus-elementor' ),
					'right' => __( 'After', 'zeus-elementor' ),
				],
				'condition'     => [
					'cell_icon!' => '',
				],
			]
		);

		$repeater->add_control(
			'cell_icon_indent',
			[
				'label'         => __( 'Icon Spacing', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 50,
					],
				],
				'condition'     => [
					'cell_icon!' => '',
				],
				'selectors'     => [
					'{{WRAPPER}} thead {{CURRENT_ITEM}} .zeus-table-text .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} thead {{CURRENT_ITEM}} .zeus-table-text .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_control(
			'cell_span',
			[
				'label'         => __( 'Column Span', 'zeus-elementor' ),
				'title'         => __( 'How many columns should this column span across.', 'zeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => 1,
				'min'           => 1,
				'max'           => 20,
				'step'          => 1,
			]
		);

		$repeater->add_control(
			'cell_row_span',
			[
				'label'         => __( 'Row Span', 'zeus-elementor' ),
				'title'         => __( 'How many rows should this column span across.', 'zeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => 1,
				'min'           => 1,
				'max'           => 20,
				'step'          => 1,
				'separator'     => 'below',
			]
		);

		$repeater->add_control(
			'_item_id',
			[
				'label'         => __( 'CSS ID', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'css_classes',
			[
				'label'         => __( 'CSS Classes', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'header_cells',
			[
				'label'         => __( 'Rows', 'zeus-elementor' ),
				'type'          => Controls_Manager::REPEATER,
				'default'       => [
					[
						'cell_text' => __( 'Header #1', 'zeus-elementor' ),
					],
					[
						'cell_text' => __( 'Header #2', 'zeus-elementor' ),
					],
					[
						'cell_text' => __( 'Header #3', 'zeus-elementor' ),
					],
				],
				'prevent_empty' => true,
				'fields'        => $repeater->get_controls(),
				'title_field'   => '{{{ cell_text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			[
				'label'         => __( 'Content', 'zeus-elementor' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'content_type',
			[
				'label'         => __( 'Element', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'cell',
				'options'       => [
					'row'   => __( 'Row', 'zeus-elementor' ),
					'cell'  => __( 'Cell', 'zeus-elementor' ),
				],
			]
		);

		$repeater->add_control(
			'cell_type',
			[
				'label'         => __( 'Cell Type', 'zeus-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'td',
				'options'   => [
					'td'    => __( 'Default', 'zeus-elementor' ),
					'th'    => __( 'Header', 'zeus-elementor' ),
				],
				'condition' => [
					'content_type' => 'cell',
				],
			]
		);

		$repeater->add_control(
			'content_text',
			[
				'label'         => __( 'Content Text', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'content_icon',
			[
				'label'         => __( 'Icon', 'zeus-elementor' ),
				'type'          => Controls_Manager::ICON,
				'default'       => '',
				'condition' => [
					'content_type' => 'cell',
				],
			]
		);

		$repeater->add_control(
			'content_icon_align',
			[
				'label'         => __( 'Icon Position', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'left',
				'options'       => [
					'left' => __( 'Before', 'zeus-elementor' ),
					'right' => __( 'After', 'zeus-elementor' ),
				],
				'condition'     => [
					'content_icon!' => '',
					'content_type' => 'cell',
				],
			]
		);

		$repeater->add_control(
			'content_icon_indent',
			[
				'label'         => __( 'Icon Spacing', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 50,
					],
				],
				'condition'     => [
					'content_icon!' => '',
					'content_type' => 'cell',
				],
				'selectors'     => [
					'{{WRAPPER}} tbody {{CURRENT_ITEM}} .zeus-table-text .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} tbody {{CURRENT_ITEM}} .zeus-table-text .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_control(
			'content_span',
			[
				'label'         => __( 'Column Span', 'zeus-elementor' ),
				'title'         => __( 'How many columns should this column span across.', 'zeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => 1,
				'min'           => 1,
				'max'           => 20,
				'step'          => 1,
				'condition' => [
					'content_type' => 'cell',
				],
			]
		);

		$repeater->add_control(
			'content_row_span',
			[
				'label'         => __( 'Row Span', 'zeus-elementor' ),
				'title'         => __( 'How many rows should this column span across.', 'zeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => 1,
				'min'           => 1,
				'max'           => 20,
				'step'          => 1,
				'separator'     => 'below',
				'condition' => [
					'content_type' => 'cell',
				],
			]
		);

		$repeater->add_control(
			'content_link',
			[
				'label'         => __( 'Link', 'zeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'condition' => [
					'content_type' => 'cell',
				],
			]
		);

		$repeater->add_control(
			'content_item_id',
			[
				'label'         => __( 'CSS ID', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'content_css_classes',
			[
				'label'         => __( 'CSS Classes', 'zeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'rows',
			[
				'label'         => __( 'Rows', 'zeus-elementor' ),
				'type'          => Controls_Manager::REPEATER,
				'default'       => [
					[
						'content_type'  => 'row',
					],
					[
						'content_type'  => 'cell',
						'content_text'  => __( 'Column #1', 'zeus-elementor' ),
						'cell_type'     => 'td',
					],
					[
						'content_type'  => 'cell',
						'content_text'  => __( 'Column #2', 'zeus-elementor' ),
						'cell_type'     => 'td',
					],
					[
						'content_type'  => 'cell',
						'content_text'  => __( 'Column #3', 'zeus-elementor' ),
						'cell_type'     => 'td',
					],
					[
						'content_type'  => 'row',
					],
					[
						'content_type'  => 'cell',
						'content_text'  => __( 'Column #1', 'zeus-elementor' ),
					],
					[
						'content_type'  => 'cell',
						'content_text'  => __( 'Column #2', 'zeus-elementor' ),
					],
					[
						'content_type'  => 'cell',
						'content_text'  => __( 'Column #3', 'zeus-elementor' ),
					],
				],
				'fields'        => $repeater->get_controls(),
				'title_field'   => 'Start {{ content_type }}: {{{ content_text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'         => esc_html__( 'Table', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'size',
			[
				'label'         => __( 'Size', 'zeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 100,
					'unit' => '%',
				],
				'size_units'    => [ '%', 'px' ],
				'range'         => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1200,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .zeus-table' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
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
				'prefix_class' => 'zeus%s-align-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_rows_style',
			[
				'label'         => esc_html__( 'Rows', 'zeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'row_border',
				'label'         => __( 'Border', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-table-row',
			]
		);

		$this->add_control(
			'row_alternate',
			[
				'label'         => __( 'Alternate', 'zeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'even',
				'options'       => [
					'even'  => __( 'Even', 'zeus-elementor' ),
					'odd'   => __( 'Odd', 'zeus-elementor' ),
				],

			]
		);

		$this->start_controls_tabs( 'tabs_row_style' );

		$this->start_controls_tab(
			'tab_row_default_style',
			[
				'label'         => __( 'Default', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'row_style_heading',
			[
				'label'         => __( 'Default', 'zeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'row_bg',
			[
				'label'     => __( 'Background Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zeus-table-row' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'row_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-table-row .zeus-table-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'row_style_hover_heading',
			[
				'label'     => __( 'Hover', 'zeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'row_hover_bg',
			[
				'label'     => __( 'Background Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zeus-table-row:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'row_hover_color',
			[
				'label'     => __( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zeus-table-row:hover .zeus-table-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_row_alternate_style',
			[
				'label'         => __( 'Alternate', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'row_style_alternate_heading',
			[
				'label'     => __( 'Default', 'zeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'row_alternate_bg',
			[
				'label'     => __( 'Background Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zeus-table-odd .zeus-table-row:nth-child(odd),
					 {{WRAPPER}} .zeus-table-even .zeus-table-row:nth-child(even)' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'row_alternate_color',
			[
				'label'     => __( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zeus-table-odd .zeus-table-row:nth-child(odd) .zeus-table-text,
					 {{WRAPPER}} .zeus-table-even .zeus-table-row:nth-child(even) .zeus-table-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'row_style_alternate_hover_heading',
			[
				'label'     => __( 'Hover', 'zeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'row_alternate_hover_bg',
			[
				'label'     => __( 'Background Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zeus-table-odd .zeus-table-row:nth-child(odd):hover,
					 {{WRAPPER}} .zeus-table-even .zeus-table-row:nth-child(even):hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'row_alternate_hover_color',
			[
				'label'     => __( 'Color', 'zeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zeus-table-odd .zeus-table-row:nth-child(odd):hover .zeus-table-text,
					 {{WRAPPER}} .zeus-table-even .zeus-table-row:nth-child(even):hover .zeus-table-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cells_style',
			[
				'label'     => __( 'Cells', 'zeus-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'cell_typography',
				'label'     => __( 'Typography', 'zeus-elementor' ),
				'selector'  => '{{WRAPPER}} .zeus-table td.zeus-table-cell',
			]
		);

		$this->start_controls_tabs( 'tabs_cell_colors' );

		$this->start_controls_tab(
			'tab_cell_colors',
			[
				'label'         => __( 'Default', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'cell_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-table-cell' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cell_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-table-cell .zeus-table-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_cell_hover_colors',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'cell_hover_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-table-cell:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cell_hover_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .zeus-table-cell:hover .zeus-table-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'cell_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .zeus-table-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'cell_border',
				'label'         => __( 'Border', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} .zeus-table-cell',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_headers_style',
			[
				'label'     => __( 'Headers', 'zeus-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'headers_typography',
				'label'     => __( 'Typography', 'zeus-elementor' ),
				'selector'  => '{{WRAPPER}} .zeus-table th.zeus-table-cell',
			]
		);

		$this->start_controls_tabs( 'tabs_headers_colors' );

		$this->start_controls_tab(
			'tab_headers_colors',
			[
				'label'         => __( 'Default', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'headers_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} th.zeus-table-cell' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .zeus-table-cell[data-title]:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'headers_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} th.zeus-table-cell .zeus-table-text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .zeus-table-cell[data-title]:before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_headers_hover_colors',
			[
				'label'         => __( 'Hover', 'zeus-elementor' ),
			]
		);

		$this->add_control(
			'headers_hover_bg',
			[
				'label'         => __( 'Background Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} th.zeus-table-cell:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'headers_hover_color',
			[
				'label'         => __( 'Color', 'zeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} th.zeus-table-cell:hover .zeus-table-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'headers_padding',
			[
				'label'         => __( 'Padding', 'zeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} th.zeus-table-cell .zeus-table-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .zeus-table-cell[data-title]:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'headers_border',
				'label'         => __( 'Border', 'zeus-elementor' ),
				'selector'      => '{{WRAPPER}} th.zeus-table-cell, {{WRAPPER}} .zeus-table-cell[data-title]:before',
			]
		);

		$this->end_controls_section();

	}

	protected function is_invalid_first_row() {
		$settings = $this->get_settings();

		if ( 'row' === $settings['rows'][0]['content_type'] ) {
			return false;
		}

		return true;
	}

	protected function render() {
		$settings       = $this->get_settings_for_display();

		$counter        = 1;
		$cell_counter   = 0;
		$head_output    = '';
		$output         = '';
		$row_count      = count( $settings['rows'] );

		$this->add_render_attribute( 'table', 'class', [
			'zeus-table',
			'zeus-table-' . $settings['row_alternate'],
		] );

		$this->add_render_attribute( 'row', 'class', 'zeus-table-row' ); ?>

		<table <?php $this->print_render_attribute_string( 'table' ); ?>>

			<?php
			if ( $settings['header_cells'] ) { ?>

				<thead>
					<tr <?php $this->print_render_attribute_string( 'row' ); ?>>

						<?php
						foreach ( $settings['header_cells'] as $index => $row ) {

							$key = $this->get_repeater_setting_key( 'cell_text', 'header_cells', $index );

							$this->add_render_attribute( 'header-' . $counter, 'class', 'zeus-table-cell' );
							$this->add_render_attribute( 'header-' . $counter, 'class', 'elementor-repeater-item-' . $row['_id'] );

							$this->add_render_attribute( 'header-text-' . $counter, 'class', 'zeus-table-text' );
							$this->add_render_attribute( $key, 'class', 'zeus-table-text-inner' );
							$this->add_inline_editing_attributes( $key, 'basic' );

							if ( $row['_item_id'] ) {
								$this->add_render_attribute( 'header-' . $counter, 'id', $row['_item_id'] );
							}

							if ( $row['css_classes'] ) {
								$this->add_render_attribute( 'header-' . $counter, 'class', $row['css_classes'] );
							}

							if ( $row['cell_span'] > 1 ) {
								$this->add_render_attribute( 'header-' . $counter, 'colspan', $row['cell_span'] );
							}

							if ( $row['cell_row_span'] > 1 ) {
								$this->add_render_attribute( 'header-' . $counter, 'rowspan', $row['cell_row_span'] );
							}

							// Output header contents
							$head_output .= '<th ' . $this->get_render_attribute_string( 'header-' . $counter ) . '>';
							$head_output .= '<span ' . $this->get_render_attribute_string( 'header-text-' . $counter ) . '>';

							if ( '' !== $row['cell_icon'] ) {
								$this->add_render_attribute( 'icon-' . $counter, 'class', 'elementor-align-icon-' . $row['cell_icon_align'] );
								$head_output .= '<span ' . $this->get_render_attribute_string( 'icon-' . $counter ) . '>';
									$head_output .= '<i class="' . esc_attr( $row['cell_icon'] ) . '"></i>';
								$head_output .= '</span>';
							}

							$head_output .= '<span ' . $this->get_render_attribute_string( $key ) . '>' . $row['cell_text'] . '</span>';

							$head_output .= '</span>';
							$head_output .= '</th>';

						}

						echo $head_output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</tr>
				</thead>
				<?php
			}

			if ( $settings['rows'] ) { ?>

				<tbody>

					<?php if ( $this->is_invalid_first_row() ) { ?>
						<tr <?php $this->print_render_attribute_string( 'row' ); ?>>
					<?php } ?>

						<?php
						foreach ( $settings['rows'] as $index => $row ) {

							$text_tag       = 'span';
							$header_text    = '';
							$content_key    = $this->get_repeater_setting_key( 'content_text', 'rows', $index );

							if ( ! empty( $row['content_link']['url'] ) ) {
								$text_tag = 'a';
								$this->add_link_attributes( 'text-' . $counter, $row['content_link'] );
							}

							if ( 'cell' === $row['content_type'] ) {

								if ( 'hide' !== $settings['hide_headers_mobile'] ) {

									// Fetch corresponding header cell text
									if ( isset( $settings['header_cells'][ $cell_counter ] ) ) {
										$header_text = $settings['header_cells'][ $cell_counter ]['cell_text'];
									}

									// Increment to next cell
									$cell_counter++;

								}

								$this->add_render_attribute( 'cell-' . $counter, 'class', 'zeus-table-cell' );
								$this->add_render_attribute( 'cell-' . $counter, 'class', 'elementor-repeater-item-' . $row['_id'] );

								$this->add_render_attribute( 'text-' . $counter, 'class', 'zeus-table-text' );
								$this->add_render_attribute( $content_key, 'class', 'zeus-table-text-inner' );
								$this->add_inline_editing_attributes( $content_key, 'basic' );

								if ( $row['content_item_id'] ) {
									$this->add_render_attribute( 'cell-' . $counter, 'id', $row['content_item_id'] );
								}

								if ( $row['content_css_classes'] ) {
									$this->add_render_attribute( 'cell-' . $counter, 'class', $row['content_css_classes'] );
								}

								if ( $header_text ) {
									$this->add_render_attribute( 'cell-' . $counter, 'data-title', $header_text );
								}

								if ( $row['content_span'] > 1 ) {
									$this->add_render_attribute( 'cell-' . $counter, 'colspan', $row['content_span'] );
								}

								if ( $row['content_row_span'] > 1 ) {
									$this->add_render_attribute( 'cell-' . $counter, 'rowspan', $row['content_row_span'] );
								}

								// Output cell contents
								$output .= '<' . $row['cell_type'] . ' ' . $this->get_render_attribute_string( 'cell-' . $counter ) . '>';
								$output .= '<' . $text_tag . ' ' . $this->get_render_attribute_string( 'text-' . $counter ) . '>';

								if ( '' !== $row['content_icon'] ) {

									$this->add_render_attribute( 'icon-' . $counter, 'class', 'elementor-align-icon-' . $row['content_icon_align'] );

									$output .= '<span ' . $this->get_render_attribute_string( 'icon-' . $counter ) . '>';
										$output .= '<i class="' . esc_attr( $row['content_icon'] ) . '"></i>';
									$output .= '</span>';
								}

								$output .= '<span ' . $this->get_render_attribute_string( $content_key ) . '>' . $row['content_text'] . '</span>';
								$output .= '</' . $text_tag . '>';
								$output .= '</' . $row['cell_type'] . '>';

							} else {

								$this->add_render_attribute( 'row-' . $counter, 'class', 'zeus-table-row' );
								$this->add_render_attribute( 'row-' . $counter, 'class', 'elementor-repeater-item-' . $row['_id'] );

								if ( $row['content_item_id'] ) {
									$this->add_render_attribute( 'row-' . $counter, 'id', $row['content_item_id'] );
								}

								if ( $row['content_css_classes'] ) {
									$this->add_render_attribute( 'row-' . $counter, 'class', $row['content_css_classes'] );
								}

								if ( $counter > 1 && $counter < $row_count ) {

									// Break into new row
									$output .= '</tr><tr ' . $this->get_render_attribute_string( 'row-' . $counter ) . '>';

								} elseif ( 1 === $counter && false === $this->is_invalid_first_row() ) {
									$output .= '<tr ' . $this->get_render_attribute_string( 'row-' . $counter ) . '>';
								}

								$cell_counter = 0;
							}

							$counter++;

						}

						echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

					</tr>

				</tbody>

			<?php } ?>

		</table>

		<?php
	}

	protected function content_template() { ?>
		<#
		var counter                 = 1,
			cell_counter            = 0,
			row_count               = settings.rows.length,
			is_invalid_first_row    = false;

		if ( 'row' !== settings.rows[0].type ) {
			is_invalid_first_row = true;
		} #>

		<table class="zeus-table zeus-table-{{ settings.row_alternate }}">

			<# if ( settings.header_cells ) { #>

				<thead>

					<tr class="zeus-table-row">

						<# _.each( settings.header_cells, function( row ) { #>

							<th id="{{ row._item_id }}" class="zeus-table-cell elementor-repeater-item-{{ row._id }} {{ row.css_classes }}" colspan="{{ row.cell_span }}" rowspan="{{ row.cell_row_span }}">
								<span class="zeus-table-text">

									<# if ( '' !== row.cell_icon ) { #>
										<span class="elementor-align-icon-{{ row.cell_icon_align }}">
											<i class="{{ row.cell_icon }}"></i>
										</span>
									<# } #>

									<span class="zeus-table-text-inner elementor-inline-editing" data-elementor-setting-key="header_cells.{{ counter - 1 }}.cell_text" data-elementor-inline-editing-toolbar="basic">{{{ row.cell_text }}}</span>

								</span>
							</th>

						<# counter++;

						} ); counter = 1; #>

					</tr>

				</thead>

			<# } #>

			<# if ( settings.rows ) { #>

				<tbody>

					<# if ( is_invalid_first_row ) { #>
						<tr class="zeus-table-row">
					<# }

						_.each( settings.rows, function( row ) {

							var text_tag            = 'span',
								text_link           = '',
								header_text         = '',
								data_header_text    = '';

							if ( '' !== row.content_link.url ) {
								text_tag = 'a';
								text_link = 'href="' + row.content_link.url + '"';
							}

							if ( row.content_type === 'cell' ) {

								if ( 'hide' !== settings.hide_headers_mobile ) {

									if ( undefined !== settings.header_cells[ cell_counter ] ) {
										header_text = settings.header_cells[ cell_counter ].cell_text;
									}

									cell_counter++;
								}

								if ( header_text ) {
									data_header_text = 'data-title="' + header_text + '"';
								} #>

								<{{ row.cell_type }} id="{{ row.content_item_id }}" class="zeus-table-cell elementor-repeater-item-{{ row._id }} {{ row.content_css_classes }}" colspan="{{ row.content_span }}" rowspan="{{ row.content_row_span }}" {{{ data_header_text }}}>

									<{{ text_tag }} {{ text_link }} class="zeus-table-text">
										<# if ( '' !== row.content_icon ) { #>
											<span class="elementor-align-icon-{{ row.content_icon_align }}">
												<i class="{{ row.content_icon }}"></i>
											</span>
										<# } #>
										<span class="zeus-table-text-inner elementor-inline-editing" data-elementor-setting-key="rows.{{ counter - 1 }}.content_text" data-elementor-inline-editing-toolbar="basic">{{{ row.content_text }}}</span>
									</{{ text_tag }}>

								</{{ row.cell_type }}>

							<# } else {

								if ( counter > 1 && counter < row_count ) { #>
									</tr><tr class="zeus-table-row elementor-repeater-item-{{ row._id }} {{ row.content_css_classes }}" id="{{ row.content_item_id }}">
								<# } else if ( 1 === counter && ! is_invalid_first_row ) { #>
									<tr class="zeus-table-row elementor-repeater-item-{{ row._id }} {{ row.content_css_classes }}" id="{{ row.content_item_id }}">
								<# }

								cell_counter = 0;
							}

						counter++;

						} ); #>

					</tr>

				</tbody>

			<# } #>

		</table>

		<?php
	}

}
