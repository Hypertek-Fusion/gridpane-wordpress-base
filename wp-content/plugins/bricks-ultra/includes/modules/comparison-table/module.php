<?php

namespace BricksUltra\Modules\ComparisonTable;

use Bricks\Element;
use Bricks\Query;
use Bricks\Helpers;
use Bricks\Breakpoints;
use BricksUltra\Plugin;
class Module extends Element {

	public $category     = 'ultra';
	public $name         = 'wpvbu-comparison-table';
	public $icon         = 'fas fa-table-list';
	public $css_selector = '';
	public $scripts      = [ 'InitComparisonTable' ];
	public $loop_index   = 0;
	public $rating_scale = '';
	public $full_icon = '';
	public $half_icon ='';
	public $blank_icon = '';
	public $rating_layout = '';

	// Methods: Builder-specific
	public function get_label() {
		return esc_html__( 'Comparison Table', 'wpv-bu' );
	}
	public function set_control_groups() {
		$this->control_groups['features'] = [
			'title' => esc_html__( 'Features', 'wpv-bu' ),
			'tab'   => 'content',
		];

		$this->add_plan_section();

		$this->control_groups['layout']       = [
			'title' => esc_html__( 'Layout', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['header_style'] = [
			'title' => esc_html__( 'Header Style', 'wpv-bu' ),
			'tab'   => 'content',
		];

		$this->control_groups['price_style'] = [
			'title' => esc_html__( 'Price Style', 'wpv-bu' ),
			'tab'   => 'content',
		];

		$this->control_groups['table_style'] = [
			'title' => esc_html__( 'Table Style', 'wpv-bu' ),
			'tab'   => 'content',
		];

		$this->control_groups['features_style'] = [
			'title' => esc_html__( 'Features Style', 'wpv-bu' ),
			'tab'   => 'content',
		];

		$this->control_groups['cta_style'] = [
			'title'    => esc_html__( 'CTA Style', 'wpv-bu' ),
			'tab'      => 'content',
			'required' => [
				[ 'enable_cta', '=', true ],
			],
		];

		$this->control_groups['filter_style'] = [
			'title' => esc_html__( 'Filter Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
	}

	public function set_controls() {
		$this->controls['table_count'] = [
			'tab'     => 'content',
			'label'   => __( 'No. of Plans', 'wpv-bu' ),
			'type'    => 'number',
			'min'     => 1,
			'max'     => 10,
			'step'    => 1,
			'inline'  => true,
			'default' => 3,
		];

		// Feature Section Controls
		$this->controls['feature_heading'] = [
			'tab'      => 'content',
			'group'    => 'features',
			'type'     => 'text',
			'default'  => 'Features',
			'rerender' => true,
			'label'    => __( 'Heading', 'wpv-bu' ),
		];

		$this->controls['features_text'] = [
			'tab'           => 'content',
			'group'         => 'features',
			'label'         => esc_html__( 'Features', 'wpv-bu' ),
			'type'          => 'repeater',
			'checkLoop'     => true,
			'titleProperty' => 'legend_feature_text', // Default 'title'
			'default'       => [
				[
					'legend_feature_text' => 'Display',
				],
				[
					'legend_feature_text' => 'RAM',
				],
				[
					'legend_feature_text' => 'Storage',
				],
				[
					'legend_feature_text' => 'Touch ID',
				],
			],
			'fields'        => [
				'legend_feature_text' => [
					'label' => esc_html__( 'Feature', 'wpv-bu' ),
					'type'  => 'text',
				],
				'feature_icon' => [
					'label' => esc_html__( 'Icon', 'wpv-bu' ),
					'type'  => 'icon',
					'css'   => [
						[
							'selector' => '.icon-svg', // Use to target SVG file
						],
					],
				],
			],
		];

		$this->controls[ 'feature_icon_position' ] = [
			'tab'      => 'content',
			'group'    => 'features',
			'label'       => esc_html__( 'Icon Position', 'wpv-bu' ),
			'type'        => 'select',
			'options'     => [
				'left'  => 'Left',
				'right' => 'Right',
			],
			'default'     => 'left',
			'placeholder' => 'Select',
			'clearable'   => false,
			'inline'      => true,
		];

		$this->add_table();

		$this->controls['enable_filters'] = [
			'tab'     => 'content',
			'group'   => 'layout',
			'label'   => esc_html__( 'Enable Filter', 'wpv-bu' ),
			'type'    => 'checkbox',
			'inline'  => true,
			'small'   => true,
			'default' => true,
		];

		$this->controls['enable_sticky']  = [
			'tab'     => 'content',
			'group'   => 'layout',
			'label'   => esc_html__( 'Enable Sticky', 'wpv-bu' ),
			'type'    => 'checkbox',
			'inline'  => true,
			'small'   => true,
			'default' => true,
		];

		$this->controls['enable_cta']     = [
			'tab'     => 'content',
			'group'   => 'layout',
			'label'   => esc_html__( 'Enable CTA', 'wpv-bu' ),
			'type'    => 'checkbox',
			'inline'  => true,
			'small'   => true,
			'default' => true,
		];

		$this->controls['cta_title'] = [
			'tab'           => 'content',
			'group'         => 'layout',
			'label'         => esc_html__( 'CTA Title', 'wpv-bu' ),
			'type'          => 'text',
			'spellcheck'    => true,
			'required'      => [
				[ 'enable_cta', '=', true ],
			],
			'inlineEditing' => true,
			'default'       => 'Add to Cart',
		];

		$this->controls['cta_pos'] = [
			'tab'         => 'content',
			'group'       => 'layout',
			'label'       => esc_html__( 'CTA Position', 'wpv-bu' ),
			'type'        => 'select',
			'placeholder' => esc_html__( 'Select', 'wpv-bu' ),
			'options'     => [
				'header' => esc_html__( 'Header', 'wpv-bu' ),
				'footer' => esc_html__( 'Footer', 'wpv-bu' ),
				'both'   => esc_html__( 'Both', 'wpv-bu' ),
			],
			'required'    => [
				[ 'enable_cta', '=', true ],
			],
			'inline'      => true,
			'default'     => 'footer', // Option key
		];

		$this->controls['feature_rating'] = [
			'tab'   => 'content',
			'group'       => 'layout',
			'type'  => 'separator',
			'label' => esc_html__( 'Feature Rating', 'wpv-bu' ),
		];

		$this->controls['rating_layout'] = [
			'tab'   => 'content',
			'group'       => 'layout',
			'label' => esc_html__( 'Rating Layout', 'bricks' ),
			'type' => 'select',
			'options' => [
			  'icon' => 'Icon', // fontawesome/ionicons/themify
			  'icon_with_no' => 'Icon & Number',    // Example: Themify icon class
			],
			'default' => 'icon'
		];

		$this->controls['rating_scale'] = [
			'tab'   => 'content',
			'group'       => 'layout',
			'label' => esc_html__( 'Rating Scale', 'bricks' ),
			'type' => 'select',
			'options' => [
			  '5' => '0-5', // fontawesome/ionicons/themify
			  '10' => '0-10',    // Example: Themify icon class
			],
			'default' => '5'
		];

		$this->controls['rating_full_icon'] = [
			'tab'   => 'content',
			'group'       => 'layout',
			'label' => esc_html__( 'Icon Full', 'bricks' ),
			'type' => 'icon',
			'default' => [
			  'library' => 'fontawesomeSolid', // fontawesome/ionicons/themify
			  'icon' => 'fas fa-star',    // Example: Themify icon class
			],
		];

		$this->controls['rating_half_icon'] = [
			'tab'   => 'content',
			'group' => 'layout',
			'label' => esc_html__( 'Icon Half', 'bricks' ),
			'type'  => 'icon',
			'default' => [
			  'library' => 'fontawesomeSolid', // fontawesome/ionicons/themify
			  'icon' => 'fas fa-star-half-stroke',    // Example: Themify icon class
			],
			'required' => [
				'rating_layout', '=', 'icon'
			]
		];

		$this->controls['rating_blank_icon'] = [
			'tab'   => 'content',
			'group' => 'layout',
			'label' => esc_html__( 'Blank Icon', 'bricks' ),
			'type'  => 'icon',
			'default' => [
			  'library' => 'fontawesomeRegular', // fontawesome/ionicons/themify
			  'icon' => 'fa fa-star',    // Example: Themify icon class
			],
			'required' => [
				'rating_layout', '=', 'icon'
			]
		];

		$this->add_header_style_contols();
		$this->add_price_style_contols();
		$this->add_table_style_contorls();
		$this->add_features_style_controls();
		$this->add_cta_style_controls();
		$this->add_filter_bar_style_controls();
	}

	public function add_table() {
		for ( $i = 1; $i < 11; $i++ ) {
			$this->controls[ 'table_title_' . $i ] = [
				'tab'     => 'content',
				'group'   => 'plan' . $i,
				'type'    => 'text',
				'label'   => esc_html__( 'Title', 'wpv-bu' ),
				'default' => __( 'Our Plan', 'wpv-bu' ),
				'inline'  => true,
			];

			$this->controls[ 'table_image_' . $i ] = [
				'tab'   => 'content',
				'group' => 'plan' . $i,
				'label' => esc_html__( 'Image', 'wpv-bu' ),
				'type'  => 'image',
			];

			$this->controls[ 'table_currency_symbol_' . $i ] = [
				'tab'         => 'content',
				'group'       => 'plan' . $i,
				'type'        => 'text',
				'label'       => esc_html__( 'Currency Symbol', 'wpv-bu' ),
				'default'     => __( '$', 'wpv-bu' ),
				'placeholder' => __( '$', 'wpv-bu' ),
				'inline'      => true,
			];
			$this->controls[ 'table_price_' . $i ]           = [
				'tab'         => 'content',
				'group'       => 'plan' . $i,
				'type'        => 'text',
				'label'       => esc_html__( 'Price', 'wpv-bu' ),
				'default'     => '39.99',
				'placeholder' => __( 'Enter Price', 'wpv-bu' ),
				'inline'      => true,
			];
			$this->controls[ 'table_offer_discount_' . $i ]  = [
				'tab'         => 'content',
				'group'       => 'plan' . $i,
				'label'       => esc_html__( 'Offering Discount', 'wpv-bu' ),
				'type'        => 'checkbox',
				'inline'      => true,
				'description' => esc_html__( 'Enable to show orignal price.', 'wpv-bu' ),
			];

			$this->controls[ 'table_offering_price_' . $i ] = [
				'tab'         => 'content',
				'group'       => 'plan' . $i,
				'type'        => 'text',
				'label'       => esc_html__( 'Offering Price', 'wpv-bu' ),
				'default'     => '29.99',
				'placeholder' => __( 'Enter Price', 'wpv-bu' ),
				'inline'      => true,
				'required'    => [
					'table_offer_discount_' . $i,
					'=',
					[ true ],
				],
			];
			$this->controls[ 'table_duration_' . $i ]       = [
				'tab'     => 'content',
				'group'   => 'plan' . $i,
				'type'    => 'text',
				'label'   => esc_html__( 'Duration', 'wpv-bu' ),
				'default' => esc_html__( '/year', 'wpv-bu' ),
				'inline'  => true,
			];

			$this->controls[ 'button_text_' . $i ] = [
				'tab'         => 'content',
				'group'       => 'plan' . $i,
				'type'        => 'text',
				'label'       => esc_html__( 'Button Text', 'wpv-bu' ),
				'default'     => __( 'Buy Now', 'wpv-bu' ),
				'placeholder' => __( 'Buy Now', 'wpv-bu' ),
				'inline'      => true,
				'required'    => [
					[ 'enable_cta', '=', true ],
				],
			];

			$this->controls[ 'button_icon_' . $i ] = [
				'tab'   => 'content',
				'group' => 'plan' . $i,
				'label' => esc_html__( 'Icon', 'wpv-bu' ),
				'type'  => 'icon',
				'css'   => [
					[
						'selector' => '.icon-svg', // Use to target SVG file
					],
				],
			];

			$this->controls[ 'button_icon_position_' . $i ] = [
				'tab'         => 'content',
				'group'       => 'plan' . $i,
				'label'       => esc_html__( 'Icon', 'wpv-bu' ),
				'type'        => 'select',
				'options'     => [
					'left'  => 'Left',
					'right' => 'Right',
				],
				'default'     => 'left',
				'placeholder' => 'Select',
				'clearable'   => false,
				'inline'      => true,
			];

			$this->controls[ 'item_link_' . $i ] = [
				'tab'      => 'content',
				'group'    => 'plan' . $i,
				'label'    => esc_html__( 'Link', 'wpv-bu' ),
				'type'     => 'link',
				'default'  => [
					'type'   => 'external',
					'url'    => '#',
					'newTab' => true,
				],
				'popup'    => true,
				'required' => [
					[ 'enable_cta', '=', true ],
				],
			];

			$this->controls[ 'button_class_' . $i ] = [
				'tab'         => 'content',
				'group'       => 'plan' . $i,
				'type'        => 'text',
				'label'       => esc_html__( 'Custom Class', 'wpv-bu' ),
				'placeholder' => __( 'Custom Class', 'wpv-bu' ),
				'inline'      => true,
				'required'    => [
					[ 'enable_cta', '=', true ],
				],
			];

			$this->controls[ 'feature_items_' . $i ] = [
				'tab'           => 'content',
				'group'         => 'plan' . $i,
				'label'         => esc_html__( 'Features', 'wpv-bu' ),
				'type'          => 'repeater',
				'titleProperty' => 'feature_text', // Default 'title'
				'default'       => [
					[
						'table_content_type' => 'text',
						'feature_text'       => '25GB',
					],
					[
						'table_content_type' => 'text',
						'feature_text'       => '5GB',
					],
					[
						'table_content_type' => 'text',
						'feature_text'       => '1GB',
					],
					[
						'table_content_type' => 'icon',
						'feature_icon'       => [
							'library' => 'fontawesomeSolid',
							'icon'    => 'fas fa-check',
						],
					],
				],
				'fields'        => [
					'table_content_type' => [
						'label'   => esc_html__( 'Feature', 'wpv-bu' ),
						'type'    => 'select',
						'options' => [
							'icon' => 'Icon',
							'svg'  => 'SVG',
							'text' => 'Text',
							'rating' => 'Rating'
						],
						'default' => 'text',
					],

					'feature_icon' => [
						'label'    => esc_html__( 'Icon', 'wpv-bu' ),
						'type'     => 'icon',
						'default'  => [
							'library' => 'themify', // fontawesome/ionicons/themify
							'icon'    => 'ti-check',    // Example: Themify icon class
						],
						'css'      => [
							[
								'selector' => '.icon-svg', // Use to target SVG file
							],
						],
						'required' => [
							'table_content_type',
							'=',
							'icon',
						],
					],

					

					'feature_text' => [
						'label'       => esc_html__( 'Text', 'wpv-bu' ),
						'type'        => 'text',
						'default'     => __( 'Feature', 'wpv-bu' ),
						'placeholder' => __( 'Enter your feature', 'wpv-bu' ),
						'required'    => [
							'table_content_type',
							'=',
							'text',
						],
					],
					'feature_svg' => [
						'tab'      => 'content',
						'type'     => 'svg',
						'required' => [
							'table_content_type',
							'=',
							'svg',
						],
					],
					'feature_rating' => [
						'tab'      => 'content',
						'type'     => 'number',
						'label'       => esc_html__( 'Rating', 'wpv-bu' ),
						'placeholder' => __( '5', 'wpv-bu' ),
						'required' => [
							'table_content_type',
							'=',
							'rating',
						],
						'inline' => true
					],
					'feature_icon_color' => [
						'type'  => 'color',
						'label' => esc_html__( 'Color', 'bricks' ),
						'css'   => [
							[
								'selector' => 'i.bultr-plan-'.$i,
								'property' => 'color',
								'important' => true,
							],
							[
								'selector' => 'svg.bultr-plan-'.$i,
								'property' => 'fill',
								'important' => true,
							],
						],
						'required'    => ['table_content_type','=',['icon', 'svg']],
					],
				],
			];
		}
	}


	public function add_plan_section() {
		for ( $i = 1; $i < 11; $i++ ) {
			$this->control_groups[ 'plan' . $i ] = [
				// PHPCS:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				'title'    => esc_html__( 'Plan ' . $i, 'wpv-bu' ),
				'tab'      => 'content',
				'required' => [
					'table_count','>=',$i,
				],
			];
		}
	}


	public function add_table_style_contorls() {
		$this->controls['table_col_width'] = [
			'tab'         => 'content',
			'group'       => 'table_style',
			'label'       => esc_html__( 'Min Column Width (PX)', 'wpv-bu' ),
			'type'        => 'number',
			'unit'        => 'px',
			'breakpoints' => true,
			'rerender'    => true,
		];

		$this->controls['table_typography'] = [
			'tab'     => 'content',
			'group'   => 'table_style',
			'label'   => esc_html__( 'Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-comp-table-wrap .items .col .bultr-item-cell.bultr-ct-cell',
				],
			],
			'inline'  => true,
			'exclude' => [
				'color',
				'text-align',
			],
		];

		$this->controls['table_align'] = [
			'tab'     => 'content',
			'group'   => 'table_style',
			'label'   => esc_html__( 'Align', 'wpv-bu' ),
			'type'    => 'justify-content',
			'css'     => [
				[
					'property' => 'justify-content',
					'selector' => '.bultr-comp-table-wrap .items .col .bultr-item-cell.bultr-ct-cell',
				],
			],
			'inline'  => true,
			'exclude' => [
				'space',
			],
		];

		$this->controls['table_even_row_color']    = [
			'tab'   => 'content',
			'group' => 'table_style',
			'label' => esc_html__( 'Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.bultr-comp-table-wrap .col .bultr-ct-cell',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-comp-table-wrap .col .bultr-ct-cell i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-comp-table-wrap .col .bultr-ct-cell svg',
				],
			],
		];

		$this->controls['table_even_row_icon_color']    = [
			'tab'   => 'content',
			'group' => 'table_style',
			'label' => esc_html__( 'Icon Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.bultr-comp-table-wrap .col .bultr-item-cell.bultr-ct-cell i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-comp-table-wrap .col .bultr-item-cell.bultr-ct-cell svg',
				],
			],
		];
		$this->controls['table_even_row_bg_color'] = [
			'tab'   => 'content',
			'group' => 'table_style',
			'label' => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-comp-table-wrap .col .bultr-item-cell.bultr-ct-cell',
				],
			],
		];

		$this->controls['rating_color'] = [
			'tab'   => 'content',
			'group' => 'table_style',
			'label' => esc_html__( 'Rating Color', 'wpv-bu' ),
			'type'  => 'color',
			'default' => '#ffc107',
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.bultr-comp-table-wrap .col .bultr-item-cell.bultr-ct-cell.bultr-ct-rating i',
					'important' => true,
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-comp-table-wrap .col .bultr-item-cell.bultr-ct-cell.bultr-ct-rating svg',
					'important' => true,
				],
			],
		];

		$this->controls['rating_spacing'] = [
			'tab'   => 'content',
			'group' => 'table_style',
			'label' => esc_html__( 'Rating Spacing', 'wpv-bu' ),
			'type'  => 'number',
			'unit'	=> 'px',
			'default' => '2',
			'css'   => [
				[
					'property' => 'gap',
					'selector' => '.bultr-comp-table-wrap .col .bultr-item-cell.bultr-ct-cell',
				],
			],
		];

		$this->controls['table_border'] = [
			'tab'     => 'content',
			'group'   => 'table_style',
			'label'   => esc_html__( 'Border Size', 'wpv-bu' ),
			'type'    => 'number',
			'unit'    => 'px',
			'css'     => [
				[
					'property' => 'border-right-width',
					'selector' => '.bultr-comp-table-wrap .col',
				],
				[
					'property' => 'border-width',
					'selector' => '.bultr-comp-table-wrap .bultr-scroller .header',
				],
				[
					'property' => 'border-width',
					'selector' => '.bultr-comp-table-wrap .bultr-comp-table.wrap',
				],
				[
					'property' => 'border-bottom-width',
					'selector' => '.bultr-comp-table-wrap .items .col .bultr-item-cell',
				],

			],
			'default' => '1',
		];

		$this->controls['table_border_color'] = [
			'tab'     => 'content',
			'group'   => 'table_style',
			'label'   => esc_html__( 'Border Color', 'wpv-bu' ),
			'type'    => 'color',
			'css'     => [
				[
					'property' => 'border-right-color',
					'selector' => '.bultr-comp-table-wrap .col',
				],
				[
					'property' => 'border-color',
					'selector' => '.bultr-comp-table-wrap .bultr-scroller .header',
				],
				[
					'property' => 'border-color',
					'selector' => '.bultr-comp-table-wrap .bultr-comp-table.wrap',
				],
				[
					'property' => 'border-bottom-color',
					'selector' => '.bultr-comp-table-wrap .items .col .bultr-item-cell',
				],

			],
			'default' => '#dddddd',
		];
		$this->controls['table_border_style'] = [
			'tab'         => 'content',
			'group'       => 'table_style',
			'label'       => esc_html__( 'Border Style', 'wpv-bu' ),
			'type'        => 'select',
			'default'     => 'solid',
			'options'     => [
				'none'   => 'None',
				'solid'  => 'Solid',
				'dotted' => 'Dotted',
				'dashed' => 'Dashed',
				'double' => 'Double',
			],
			'inline'      => true,
			'placeholder' => 'select',
			'css'         => [
				[
					'property' => 'border-right-style',
					'selector' => '.bultr-comp-table-wrap .col',
				],
				[
					'property' => 'border-style',
					'selector' => '.bultr-comp-table-wrap .bultr-scroller .header',
				],
				[
					'property' => 'border-style',
					'selector' => '.bultr-comp-table-wrap .bultr-comp-table.wrap',
				],
				[
					'property' => 'border-bottom-style',
					'selector' => '.bultr-comp-table-wrap .items .col .bultr-item-cell',
				],
			],
		];

		$this->controls['table_cell_padding'] = [
			'tab'     => 'content',
			'group'   => 'table_style',
			'label'   => esc_html__( 'Padding', 'wpv-bu' ),
			'type'    => 'dimensions',
			'css'     => [
				[
					'property' => 'padding',
					'selector' => '.bultr-comp-table-wrap .bultr-table-body .bultr-item-cell',
				],
			],
			'default' => [
				'top'    => '10',
				'right'  => '20',
				'bottom' => '10',
				'left'   => '20',
			],
		];
		$this->controls['table_odd_heading']  = [
			'tab'   => 'content',
			'group' => 'table_style',
			'type'  => 'separator',
			'label' => esc_html__( 'Alternate Row', 'wpv-bu' ),
		];

		$this->controls['table_odd_row_color'] = [
			'tab'   => 'content',
			'group' => 'table_style',
			'label' => esc_html__( 'Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.bultr-comp-table-wrap .col .bultr-item-cell.bultr-ct-cell:nth-child(odd)',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-comp-table-wrap .col .bultr-item-cell.bultr-ct-cell:nth-child(odd) i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-comp-table-wrap .col .bultr-item-cell.bultr-ct-cell:nth-child(odd) svg',
				],
			],
		];

		$this->controls['table_even_odd_icon_color']    = [
			'tab'   => 'content',
			'group' => 'table_style',
			'label' => esc_html__( 'Icon Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.bultr-comp-table-wrap .col .bultr-item-cell.bultr-ct-cell:nth-child(odd) i',
					// 'important'	=>	true,
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-comp-table-wrap .col .bultr-item-cell.bultr-ct-cell:nth-child(odd) svg',
					// 'important'	=>	true,
				],
			],
		];

		$this->controls['table_odd_row_bg_color'] = [
			'tab'   => 'content',
			'group' => 'table_style',
			'label' => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-comp-table-wrap .col .bultr-item-cell.bultr-ct-cell:nth-child(odd)',
				],
			],
		];
	}

	public function add_header_style_contols() {
		$this->controls['plans_title_style_heading'] = [
			'tab'   => 'content',
			'group' => 'header_style',
			'type'  => 'separator',
			'label' => esc_html__( 'Plans', 'wpv-bu' ),
		];

		$this->controls['plan_title_typography'] = [
			'tab'    => 'content',
			'group'  => 'header_style',
			'label'  => esc_html__( 'Typography', 'wpv-bu' ),
			'type'   => 'typography',
			'css'    => [
				[
					'property' => 'typography',
					'selector' => '.bultr-comp-table-wrap .header.bultr-plans-header .bultr-plan-title',
				],
			],
			'inline' => true,
		];

		$this->controls['plans_bg_color'] = [
			'tab'     => 'content',
			'group'   => 'header_style',
			'label'   => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'    => 'color',
			'default' => [
				'hex' => '#ffffff',
			],
			'css'     => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-comp-table-wrap .header.bultr-plans-header',
				],
			],
		];

		// Image Size
		$this->controls['plans_image_width'] = [
			'tab'         => 'content',
			'group'       => 'header_style',
			'label'       => esc_html__( 'Image Width', 'wpv-bu' ),
			'type'        => 'number',
			'breakpoints' => true,
			'unit'        => 'px',
			'css'         => [
				[
					'property' => 'width',
					'selector' => '.bultr-comp-table-wrap .header img',
				],
				[
					'property' => 'height',
					'selector' => '.bultr-comp-table-wrap .header img',
					'value'    => 'auto',
				],
			],
		];

		$this->controls['plan_image_border'] = [
			'tab'    => 'content',
			'group'  => 'header_style',
			'label'  => esc_html__( 'Image Border', 'wpv-bu' ),
			'type'   => 'border',
			'css'    => [
				[
					'property' => 'border',
					'selector' => '.bultr-comp-table-wrap .header img',
				],
			],
			'inline' => true,
			'small'  => true,
		];

		// Feature Heading Start
		$this->controls['features_title_style_heading'] = [
			'tab'   => 'content',
			'group' => 'header_style',
			'type'  => 'separator',
			'label' => esc_html__( 'Feature Title', 'wpv-bu' ),
		];

		$this->controls['features_title_typography'] = [
			'tab'     => 'content',
			'group'   => 'header_style',
			'label'   => esc_html__( 'Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-comp-table-wrap .header.feature-title',
				],
			],
			'exclude' => [
				'text-align',
			],
			'inline'  => true,
		];

		$this->controls['features_title_align'] = [
			'tab'     => 'content',
			'group'   => 'header_style',
			'label'   => esc_html__( 'Align Main Axis', 'wpv-bu' ),
			'type'    => 'justify-content',
			'css'     => [
				[
					'property' => 'justify-content',
					'selector' => '.bultr-comp-table-wrap .header.feature-title',
				],

			],
			'inline'  => true,
			'exclude' => [
				'space',
			],
		];

		$this->controls['features_title_cross_align'] = [
			'tab'          => 'content',
			'group'        => 'header_style',
			'label'        => esc_html__( 'Align Cross Axis', 'wpv-bu' ),
			'type'         => 'align-items',
			'css'          => [
				[
					'property' => 'align-items',
					'selector' => '.bultr-comp-table-wrap .header.feature-title',
				],
			],
			'inline'       => true,
			'isHorizontal' => false,
			'exclude'      => [
				'stretch',
			],
		];

		$this->controls['features_title_bg_color'] = [
			'tab'   => 'content',
			'group' => 'header_style',
			'label' => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-comp-table-wrap .header.feature-title',
				],
			],
		];

		// Feature Heading Start
		$this->controls['navigation_style'] = [
			'tab'   => 'content',
			'group' => 'header_style',
			'type'  => 'separator',
			'label' => esc_html__( 'Navigation Style', 'wpv-bu' ),
		];
		
		$this->controls['navigation_bg'] = [
			'tab'   => 'content',
			'group' => 'header_style',
			'label' => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-comp-table-wrap .table-navs a',
				],
			],
		];

		$this->controls['navigation_width'] = [
			'tab'         => 'content',
			'group'       => 'header_style',
			'label'       => esc_html__( 'Width', 'wpv-bu' ),
			'type'        => 'number',
			'breakpoints' => true,
			'unit'        => 'px',
			'css'         => [
				[
					'property' => 'width',
					'selector' => '.bultr-comp-table-wrap .table-navs a',
				],
			],
		];
		$this->controls['navigation_height'] = [
			'tab'         => 'content',
			'group'       => 'header_style',
			'label'       => esc_html__( 'Height', 'wpv-bu' ),
			'type'        => 'number',
			'breakpoints' => true,
			'unit'        => 'px',
			'css'         => [
				[
					'property' => 'height',
					'selector' => '.bultr-comp-table-wrap .table-navs a',
				],
			],
		];

	}
	public function add_price_style_contols() {
		$this->controls['orignal_price_style_heading'] = [
			'tab'         => 'content',
			'group'       => 'price_style',
			'type'        => 'separator',
			'label'       => esc_html__( 'Orignal Price', 'wpv-bu' ),
			'description' => esc_html__( 'It only works on orignal price. To enable orignal price Select Plan > Enable Offering Discount', 'wpv-bu' ),
		];

		$this->controls['orignal_price_typography'] = [
			'tab'     => 'content',
			'group'   => 'price_style',
			'label'   => esc_html__( 'Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-comp-table-wrap .bultr-plans-header .bultr-ct-price-wrapper .bultr-ct-original-price',
				],
			],
			'exclude' => [
				'text-align',
				'text-transform',
				'line-height',
				'letter-spacing',
				'text-shadow',
				'text-decoration',
			],
			'popup'   => true,
			'inline'  => true,
		];

		$this->controls['text_deco_color'] = [
			'tab'   => 'content',
			'group' => 'price_style',
			'label' => esc_html__( 'Strike Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'text-decoration-color',
					'selector' => '.bultr-comp-table-wrap .bultr-plans-header .bultr-ct-price-wrapper .bultr-ct-original-price',
				],
			],
		];

		$this->controls['original_align'] = [
			'tab'     => 'content',
			'group'   => 'price_style',
			'label'   => esc_html__( 'Align', 'wpv-bu' ),
			'type'    => 'align-items',
			'css'     => [
				[
					'property' => 'align-self',
					'selector' => '.bultr-comp-table-wrap .bultr-plans-header .bultr-ct-price-wrapper .bultr-ct-original-price',
				],
			],
			'inline'  => true,
			'exclude' => [
				'stretch',
			],
		];

		$this->controls['currency_style_heading'] = [
			'tab'   => 'content',
			'group' => 'price_style',
			'type'  => 'separator',
			'label' => esc_html__( 'Currency', 'wpv-bu' ),
		];

		$this->controls['currency_typography'] = [
			'tab'     => 'content',
			'group'   => 'price_style',
			'label'   => esc_html__( 'Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-comp-table-wrap .bultr-plans-header .bultr-ct-price-wrapper .bultr-ct-currency',
				],
			],
			'exclude' => [
				'text-align',
				'text-transform',
				'line-height',
				'letter-spacing',
				'text-shadow',
				'text-decoration',
			],
			'inline'  => true,
		];

		$this->controls['currency_align'] = [
			'tab'     => 'content',
			'group'   => 'price_style',
			'label'   => esc_html__( 'Align', 'wpv-bu' ),
			'type'    => 'align-items',
			'css'     => [
				[
					'property' => 'align-self',
					'selector' => '.bultr-comp-table-wrap .bultr-plans-header .bultr-ct-price-wrapper .bultr-ct-currency',
				],
			],
			'inline'  => true,
			'exclude' => [
				'stretch',
			],
		];

		$this->controls['price_style_heading'] = [
			'tab'   => 'content',
			'group' => 'price_style',
			'type'  => 'separator',
			'label' => esc_html__( 'Price', 'wpv-bu' ),
		];

		$this->controls['price_typography'] = [
			'tab'     => 'content',
			'group'   => 'price_style',
			'label'   => esc_html__( 'Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-comp-table-wrap .bultr-plans-header .bultr-ct-price-wrapper .bultr-ct-price',
				],
			],
			'exclude' => [
				'text-align',
				'text-transform',
				'line-height',
				'letter-spacing',
				'text-shadow',
			],
			'default' => [
				'font-size'   => '28px',
				'font-weight' => 700,
				'line-height' => 1,
			],
			'inline'  => true,
		];

		$this->controls['fractional_style_heading'] = [
			'tab'   => 'content',
			'group' => 'price_style',
			'type'  => 'separator',
			'label' => esc_html__( 'Fractional', 'wpv-bu' ),
		];

		$this->controls['fractional_typography'] = [
			'tab'     => 'content',
			'group'   => 'price_style',
			'label'   => esc_html__( 'Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-comp-table-wrap .bultr-plans-header .bultr-ct-price-wrapper .bultr-ct-fractional-price',
				],
			],
			'exclude' => [
				'text-align',
				'text-transform',
				'line-height',
				'letter-spacing',
				'text-shadow',
			],
			'inline'  => true,
		];

		$this->controls['fractional_align'] = [
			'tab'     => 'content',
			'group'   => 'price_style',
			'label'   => esc_html__( 'Align', 'wpv-bu' ),
			'type'    => 'align-items',
			'css'     => [
				[
					'property' => 'align-self',
					'selector' => '.bultr-comp-table-wrap .bultr-plans-header .bultr-ct-price-wrapper .bultr-ct-fractional-price',
				],
			],
			'inline'  => true,
			'exclude' => [
				'stretch',
			],
		];

		$this->controls['duration_style_heading'] = [
			'tab'   => 'content',
			'group' => 'price_style',
			'type'  => 'separator',
			'label' => esc_html__( 'Duration', 'wpv-bu' ),
		];

		$this->controls['duration_typography'] = [
			'tab'     => 'content',
			'group'   => 'price_style',
			'label'   => esc_html__( 'Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-comp-table-wrap .bultr-plans-header .bultr-ct-duration',
				],
			],
			'exclude' => [
				'text-align',
				'line-height',
				'letter-spacing',
				'text-shadow',
			],
			'inline'  => true,
		];
	}
	public function add_features_style_controls() {

		$this->controls['feature_col_width'] = [
			'tab'         => 'content',
			'group'       => 'features_style',
			'label'       => esc_html__( 'Min Column Width (PX)', 'wpv-bu' ),
			'type'        => 'number',
			'breakpoints' => true,
			'unit'        => 'px',
			'rerender'    => true,
		];

		$this->controls['feature_icon_spacing'] = [
			'tab'         => 'content',
			'group'       => 'features_style',
			'label'       => esc_html__( 'Icon Spacing', 'wpv-bu' ),
			'type'        => 'number',
			'breakpoints' => true,
			'unit'        => 'px',
			'rerender'    => true,
			'default'	  => '3',	
			'css'     => [
				[
					'property' => 'gap',
					'selector' => '.bultr-comp-table-wrap .col.left .bultr-item-cell.bultr-ct-feature',
				],
			],
		];


		$this->controls['features_typography'] = [
			'tab'     => 'content',
			'group'   => 'features_style',
			'label'   => esc_html__( 'Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-comp-table-wrap .col.left .bultr-item-cell.bultr-ct-feature',
				],
			],
			'inline'  => true,
			'exclude' => [
				'color',
				'text-align',
			],
		];

		$this->controls['features_align'] = [
			'tab'     => 'content',
			'group'   => 'features_style',
			'label'   => esc_html__( 'Align', 'wpv-bu' ),
			'type'    => 'justify-content',
			'css'     => [
				[
					'property' => 'justify-content',
					'selector' => '.bultr-comp-table-wrap .col.left .bultr-item-cell.bultr-ct-feature',
				],
				[
					'property' => 'justify-content',
					'selector' => '.bultr-comp-table-wrap .col.left .bultr-item-cell.bultr-cta-title',
				],
			],
			'inline'  => true,
			'exclude' => [
				'space',
			],
		];

		$this->controls['features_even_row_color'] = [
			'tab'   => 'content',
			'group' => 'features_style',
			'label' => esc_html__( 'Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.bultr-comp-table-wrap .col.left .bultr-item-cell.bultr-ct-feature',
				],
			],

		];
		$this->controls['features_even_row_bg_color'] = [
			'tab'   => 'content',
			'group' => 'features_style',
			'label' => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-comp-table-wrap .col.left .bultr-item-cell.bultr-ct-feature',
				],
			],

		];
		$this->controls['features_odd_heading'] = [
			'tab'   => 'content',
			'group' => 'features_style',
			'type'  => 'separator',
			'label' => esc_html__( 'Alternate Row', 'wpv-bu' ),
		];

		$this->controls['features_odd_row_color'] = [
			'tab'   => 'content',
			'group' => 'features_style',
			'label' => esc_html__( 'Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.bultr-comp-table-wrap .col.left .bultr-item-cell.bultr-ct-feature:nth-child(odd)',
				],

			],
		];

		$this->controls['features_odd_row_bg_color'] = [
			'tab'   => 'content',
			'group' => 'features_style',
			'label' => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-comp-table-wrap .col.left .bultr-item-cell.bultr-ct-feature:nth-child(odd)',
				],
			],
		];
	}

	public function add_cta_style_controls() {

		$this->controls['cta_title_heading'] = [
			'tab'      => 'content',
			'group'    => 'cta_style',
			'type'     => 'separator',
			'label'    => esc_html__( 'Title', 'wpv-bu' ),
			'required' => [
				[ 'enable_cta', '=', true ],
			],
		];

		$this->controls['cta_title_typography'] = [
			'tab'      => 'content',
			'group'    => 'cta_style',
			'label'    => esc_html__( 'Typography', 'wpv-bu' ),
			'type'     => 'typography',
			'css'      => [
				[
					'property' => 'typography',
					'selector' => '.bultr-comp-table-wrap .col.left .bultr-item-cell.bultr-cta-title',
				],
			],
			'inline'   => true,
			'exclude'  => [
				'color',
				'text-align',
			],
			'required' => [
				[ 'enable_cta', '=', true ],
			],
		];

		$this->controls['cta_title_color'] = [
			'tab'      => 'content',
			'group'    => 'cta_style',
			'label'    => esc_html__( 'Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.bultr-comp-table-wrap .col.left .bultr-item-cell.bultr-cta-title',
				],
			],
			'required' => [
				[ 'enable_cta', '=', true ],
			],
		];

		$this->controls['cta_tiltle_bg_color'] = [
			'tab'      => 'content',
			'group'    => 'cta_style',
			'label'    => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-comp-table-wrap .col.left .bultr-item-cell.bultr-cta-title',
				],
			],
			'required' => [
				[ 'enable_cta', '=', true ],
			],
		];

		$this->controls['cta_button'] = [
			'tab'      => 'content',
			'group'    => 'cta_style',
			'type'     => 'separator',
			'label'    => esc_html__( 'Button', 'wpv-bu' ),
			'required' => [
				[ 'enable_cta', '=', true ],
			],
		];

		$this->controls['cta_button_typography'] = [
			'tab'      => 'content',
			'group'    => 'cta_style',
			'label'    => esc_html__( 'Typography', 'wpv-bu' ),
			'type'     => 'typography',
			'css'      => [
				[
					'property' => 'typography',
					'selector' => '.bultr-comp-table-wrap .col .bultr-item-cell .bultr-cta-btn',
				],
				[
					'property' => 'typography',
					'selector' => '.bultr-comp-table-wrap .header.bultr-item-cell .bultr-cta-btn',
				],
			],
			'inline'   => true,
			'exclude'  => [
				'color',
				'text-align',
			],
			'required' => [
				[ 'enable_cta', '=', true ],
			],
		];

		$this->controls['cta_button_color']      = [
			'tab'      => 'content',
			'group'    => 'cta_style',
			'label'    => esc_html__( 'Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.bultr-comp-table-wrap .col .bultr-item-cell .bultr-cta-btn',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-comp-table-wrap .header.bultr-item-cell .bultr-cta-btn',
				],
			],
			'required' => [
				[ 'enable_cta', '=', true ],
			],
		];
		$this->controls['cta_button_icon_color'] = [
			'tab'      => 'content',
			'group'    => 'cta_style',
			'label'    => esc_html__( 'Icon Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.bultr-comp-table-wrap .col .bultr-item-cell .bultr-cta-btn i',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-comp-table-wrap .header.bultr-item-cell .bultr-cta-btn i',
				],
			],
			'required' => [
				[ 'enable_cta', '=', true ],
			],
		];

		$this->controls['cta_button_bg_color'] = [
			'tab'      => 'content',
			'group'    => 'cta_style',
			'label'    => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-comp-table-wrap .col .bultr-item-cell .bultr-cta-btn',
				],
				[
					'property' => 'background-color',
					'selector' => '.bultr-comp-table-wrap .header.bultr-item-cell .bultr-cta-btn',
				],
			],
			'required' => [
				[ 'enable_cta', '=', true ],
			],
		];

		$this->controls['cta_icon_spacing'] = [
			'tab'     => 'content',
			'group'   => 'cta_style',
			'label'   => esc_html__( 'Icon Spacing', 'wpv-bu' ),
			'type'    => 'number',
			'unit'    => 'px',
			'default' => 5,
			'inline'  => true,
			'css'     => [
				[
					'selector' => '.bultr-cta-btn',
					'property' => 'gap',
				],
			],
		];

		$this->controls['cta_button_border'] = [
			'tab'      => 'content',
			'group'    => 'cta_style',
			'label'    => esc_html__( 'Border', 'wpv-bu' ),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.bultr-comp-table-wrap .col .bultr-item-cell .bultr-cta-btn',
				],
				[
					'property' => 'border',
					'selector' => '.bultr-comp-table-wrap .header.bultr-item-cell .bultr-cta-btn',
				],
			],
			'inline'   => true,
			'small'    => true,
			'required' => [
				[ 'enable_cta', '=', true ],
			],
		];

		$this->controls['cta_row_bg_color'] = [
			'tab'      => 'content',
			'group'    => 'cta_style',
			'label'    => esc_html__( 'Row Background Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-comp-table-wrap .col .bultr-item-cell.bultr-ct-cta',
				],
			],
			'required' => [
				[ 'enable_cta', '=', true ],
			],
		];
		$this->controls['cta_padding']      = [
			'tab'      => 'content',
			'group'    => 'cta_style',
			'label'    => esc_html__( 'Padding', 'wpv-bu' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.bultr-comp-table-wrap .col .bultr-item-cell.bultr-ct-cta .bultr-cta-btn',
				],
			],
			'required' => [
				[ 'enable_cta', '=', true ],
			],
		];
	}

	public function add_filter_bar_style_controls() {

		$this->controls['btn_typography'] = [
			'tab'     => 'content',
			'group'   => 'filter_style',
			'label'   => esc_html__( 'Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-comp-table-wrap .filter-wrap .bultr-table-filter',
				],
				[
					'property' => 'typography',
					'selector' => '.bultr-comp-table-wrap .filter-wrap .bultr-table-reset',
				],
			],
			'inline'  => true,
			'exclude' => [
				'color',
				'text-align',
			],
		];

		$this->controls['filter_bar_bg_color'] = [
			'tab'    => 'content',
			'group'  => 'filter_style',
			'label'  => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-comp-table-wrap .filter-wrap',
				],
			],
			'inline' => true,
		];

		$this->controls['check_active_color'] = [
			'tab'     => 'content',
			'group'   => 'filter_style',
			'label'   => esc_html__( 'Checkbox Active Color', 'wpv-bu' ),
			'type'    => 'color',
			'default' => [
				'hex' => '#9dc997',
			],
			'inline'  => true,
			'css'     => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-comp-table-wrap .bultr-headers .header .check.selected::before',
				],
			],
			'inline'  => true,
		];

		$this->controls['filter_border'] = [
			'tab'    => 'content',
			'group'  => 'filter_style',
			'label'  => esc_html__( 'Border', 'wpv-bu' ),
			'type'   => 'border',
			'css'    => [
				[
					'property' => 'border',
					'selector' => '.bultr-comp-table-wrap .filter-wrap',
				],
			],
			'inline' => true,
			'small'  => true,
		];

		$this->controls['spacing']          = [
			'tab'    => 'content',
			'group'  => 'filter_style',
			'label'  => esc_html__( 'Table Spacing', 'wpv-bu' ),
			'type'   => 'number',
			'min'    => 0,
			'max'    => 200,
			'step'   => '1', // Default: 1
			'inline' => true,
			'unit'   => 'px',
			'css'    => [
				[
					'property' => 'margin-bottom',
					'selector' => '.bultr-comp-table-wrap .filter-wrap',
				],
			],
		];
		$this->controls['button_spacing']   = [
			'tab'    => 'content',
			'group'  => 'filter_style',
			'label'  => esc_html__( 'Button Spacing', 'wpv-bu' ),
			'type'   => 'number',
			'min'    => 0,
			'max'    => 200,
			'step'   => '1', // Default: 1
			'inline' => true,
			'unit'   => 'px',
			'css'    => [
				[
					'property' => 'margin-right',
					'selector' => '.bultr-comp-table-wrap .filter-wrap .bultr-table-filter',
				],
			],
		];
		$this->controls['filter_alignment'] = [
			'tab'     => 'content',
			'group'   => 'filter_style',
			'label'   => esc_html__( 'Align', 'wpv-bu' ),
			'type'    => 'justify-content',
			'css'     => [
				[
					'property' => 'justify-content',
					'selector' => '.bultr-comp-table-wrap .filter-wrap',
				],
			],
			'exclude' => [ 'space' ],
		];
		$this->controls['filter_padding']   = [
			'tab'     => 'content',
			'group'   => 'filter_style',
			'label'   => esc_html__( 'Padding', 'wpv-bu' ),
			'type'    => 'dimensions',
			'css'     => [
				[
					'property' => 'padding',
					'selector' => '.bultr-comp-table-wrap .filter-wrap',
				],
			],
			'default' => [
				'top'    => '5',
				'right'  => '10',
				'bottom' => '5',
				'left'   => '10',
			],
		];

		$this->controls['filter_button_style_heading'] = [
			'tab'   => 'content',
			'group' => 'filter_style',
			'type'  => 'separator',
			'label' => esc_html__( 'Filter Button', 'wpv-bu' ),
		];

		$this->controls['filter_button_color']    = [
			'tab'    => 'content',
			'group'  => 'filter_style',
			'label'  => esc_html__( 'Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-comp-table-wrap .filter-wrap .bultr-table-filter',
				],
			],
			'inline' => true,
		];
		$this->controls['filter_button_bg_color'] = [
			'tab'     => 'content',
			'group'   => 'filter_style',
			'label'   => esc_html__( 'Background color', 'wpv-bu' ),
			'type'    => 'color',
			'inline'  => true,
			'default' => [
				'hex' => '#cccccc',
			],
			'css'     => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-comp-table-wrap .filter-wrap .bultr-table-filter',
				],
			],
			'default' => [
				'color' => [
					'hex' => '#ccc',
				],
			],
		];
		$this->controls['filter_button_border']   = [
			'tab'    => 'content',
			'group'  => 'filter_style',
			'label'  => esc_html__( 'Border', 'wpv-bu' ),
			'type'   => 'border',
			'css'    => [
				[
					'property' => 'border',
					'selector' => '.bultr-comp-table-wrap .filter-wrap .bultr-table-filter',
				],
			],
			'inline' => true,
			'small'  => true,
		];

		$this->controls['filter_button_color_active'] = [
			'tab'     => 'content',
			'group'   => 'filter_style',
			'label'   => esc_html__( 'Active Color', 'wpv-bu' ),
			'type'    => 'color',
			'inline'  => true,
			'default' => [
				'hex' => '#ffffff',
			],
			'css'     => [
				[
					'property' => 'color',
					'selector' => '.bultr-comp-table-wrap.active-filter .filter-wrap .bultr-table-filter',
				],
			],
			'inline'  => true,
		];

		$this->controls['filter_button_bg_color_active'] = [
			'tab'     => 'content',
			'group'   => 'filter_style',
			'label'   => esc_html__( 'Active Background color', 'wpv-bu' ),
			'type'    => 'color',
			'inline'  => true,
			'default' => [
				'hex' => '#9dc997',
			],
			'css'     => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-comp-table-wrap.active-filter .filter-wrap .bultr-table-filter',
				],
			],
		];

		$this->controls['filter_button_border_color_active'] = [
			'tab'    => 'content',
			'group'  => 'filter_style',
			'label'  => esc_html__( 'Active Border color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,

			'css'    => [
				[
					'property' => 'border-color',
					'selector' => '.bultr-comp-table-wrap.active-filter .filter-wrap .bultr-table-filter',
				],
			],
		];

		$this->controls['filter_button_padding'] = [
			'tab'   => 'content',
			'group' => 'filter_style',
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-comp-table-wrap .filter-wrap .bultr-table-filter',
				],
			],
		];

		$this->controls['reset_button_style_heading'] = [
			'tab'   => 'content',
			'group' => 'filter_style',
			'type'  => 'separator',
			'label' => esc_html__( 'Reset Button', 'wpv-bu' ),
		];

		$this->controls['reset_button_color']    = [
			'tab'    => 'content',
			'group'  => 'filter_style',
			'label'  => esc_html__( 'Color', 'wpv-bu' ),
			'type'   => 'color',

			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-comp-table-wrap .filter-wrap .bultr-table-reset',
				],
			],
			'inline' => true,
		];
		$this->controls['reset_button_bg_color'] = [
			'tab'     => 'content',
			'group'   => 'filter_style',
			'label'   => esc_html__( 'Background color', 'wpv-bu' ),
			'type'    => 'color',
			'default' => [
				'hex' => '#9dc997',
			],
			'inline'  => true,
			'css'     => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-comp-table-wrap .filter-wrap .bultr-table-reset',
				],
			],
			'default' => [
				'color' => [
					'hex' => '#ccc',
				],
			],
		];

		$this->controls['reset_button_border']              = [
			'tab'    => 'content',
			'group'  => 'filter_style',
			'label'  => esc_html__( 'Border', 'wpv-bu' ),
			'type'   => 'border',
			'css'    => [
				[
					'property' => 'border',
					'selector' => '.bultr-comp-table-wrap .filter-wrap .bultr-table-reset',
				],
			],
			'inline' => true,
			'small'  => true,
		];
		$this->controls['reset_button_color_active']        = [
			'tab'     => 'content',
			'group'   => 'filter_style',
			'label'   => esc_html__( 'Active Color', 'wpv-bu' ),
			'type'    => 'color',
			'default' => [
				'hex' => '#ffffff',
			],
			'inline'  => true,
			'css'     => [
				[
					'property' => 'color',
					'selector' => '.bultr-comp-table-wrap.filtered .filter-wrap .bultr-table-reset',
				],
			],
			'inline'  => true,
		];
		$this->controls['reset_button_bg_color_active']     = [
			'tab'     => 'content',
			'group'   => 'filter_style',
			'label'   => esc_html__( 'Active Background color', 'wpv-bu' ),
			'type'    => 'color',
			'default' => [
				'hex' => '#9dc997',
			],
			'inline'  => true,
			'css'     => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-comp-table-wrap.filtered .filter-wrap .bultr-table-reset',
				],
			],
		];
		$this->controls['reset_button_border_color_active'] = [
			'tab'    => 'content',
			'group'  => 'filter_style',
			'label'  => esc_html__( 'Border color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'border-color',
					'selector' => '.bultr-comp-table-wrap.filtered .filter-wrap .bultr-table-reset',
				],
			],
		];

		$this->controls['reset_button_padding'] = [
			'tab'   => 'content',
			'group' => 'filter_style',
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-comp-table-wrap .filter-wrap .bultr-table-reset',
				],
			],
		];
	}


	public function get_normalized_image_settings( $settings, $key ) {
		if ( empty( $settings[$key] ) ) {
			return [
				'id'   => 0,
				'url'  => false,
				'size' => BRICKS_DEFAULT_IMAGE_SIZE,
			];
		}

		$image = $settings[$key];

		// Size
		$image['size'] = empty( $image['size'] ) ? BRICKS_DEFAULT_IMAGE_SIZE : $settings[$key]['size'];

		// Image ID or URL from dynamic data
		if ( ! empty( $image['useDynamicData'] ) ) {
			$images = $this->render_dynamic_data_tag( $image['useDynamicData'], 'image', [ 'size' => $image['size'] ] );

			if ( ! empty( $images[0] ) ) {
				if ( is_numeric( $images[0] ) ) {
					$image['id'] = $images[0];
				} else {
					$image['url'] = $images[0];
				}
			}

			// No dynamic data image found (@since 1.6)
			else {
				return;
			}
		}

		$image['id'] = empty( $image['id'] ) ? 0 : $image['id'];

		// If External URL, $image['url'] is already set
		if ( ! isset( $image['url'] ) ) {
			$image['url'] = ! empty( $image['id'] ) ? wp_get_attachment_image_url( $image['id'], $image['size'] ) : false;
		} else {
			// Parse dynamic data in the external URL
			$image['url'] = $this->render_dynamic_data( $image['url'] );
		}
		return $image;
	}




	public function render() {
		$settings = $this->settings;
		$table_data       = [];
		$fet_col_width    = [];
		$table_col_width  = [];
		$breakpoints_data = Breakpoints::get_breakpoints();
		$breakpoints_len  = count( $breakpoints_data );
		$fet_def_width    = '210';
		$table_def_width  = '310';
		$baseDevice       = Plugin::$buBaseDevice;
		$this->rating_scale = $settings['rating_scale'];
		$this->blank_icon = $settings['rating_blank_icon'];
		$this->half_icon = $settings['rating_half_icon'];
		$this->full_icon = $settings['rating_full_icon'];
		$this->rating_layout = $settings['rating_layout'];
		if ( $baseDevice === 'desktop' ) {
			$fet_def_width   = $settings['feature_col_width'] ?? $fet_def_width;
			$table_def_width = $settings['table_col_width'] ?? $table_def_width;
		} else {
			$fet_def_width   = $settings[ 'feature_col_width:' . $baseDevice ] ?? $fet_def_width;
			$table_def_width = $settings[ 'table_col_width:' . $baseDevice ] ?? $table_def_width;
		}

		for ( $i = 0; $i < $breakpoints_len; $i++ ) {
			if ( $breakpoints_data[ $i ]['key'] === 'desktop' ) {
				$fet_col_width['desktop']   = $settings['feature_col_width'] ?? $fet_def_width;
				$table_col_width['desktop'] = $settings['table_col_width'] ?? $table_def_width;
			} else {
				$fet_col_width[ $breakpoints_data[ $i ]['key'] ]   = $settings[ 'feature_col_width:' . $breakpoints_data[ $i ]['key'] ] ?? $fet_def_width;
				$table_col_width[ $breakpoints_data[ $i ]['key'] ] = $settings[ 'table_col_width:' . $breakpoints_data[ $i ]['key'] ] ?? $table_def_width;
			}
		}
		
		$table_data = [
			'feature_col_width' => $fet_col_width,
			'table_count'       => $settings['table_count'],
			'table_col_width'   => $table_col_width,
		];

		$this->set_attribute( 'scroller', 'class', [ 'bultr-scroller' ] );
		$this->set_attribute( 'headers', 'class', [ 'bultr-table-header bultr-headers' ] );
		if ( isset( $settings['enable_sticky'] ) && $settings['enable_sticky'] === true ) {
			$this->set_attribute( 'headers', 'class', 'sticky' );
		}
		$this->set_attribute( 'table', 'class', 'bultr-comp-table-wrap' );
		$this->set_attribute( 'table', 'data-settings', wp_json_encode( $table_data ) );
		if ( isset( $settings['enable_filters'] ) && $settings['enable_filters'] === true ) {
			$this->set_attribute( 'table', 'data-table-filter', true );
		} else {
			$this->set_attribute( 'table', 'data-table-filter', false );
		}
		$this->set_attribute( 'table', 'data-cols', $settings['table_count'] );
		?>
			<div <?php echo $this->render_attributes( '_root' ); ?>>
				<div <?php echo $this->render_attributes( 'table' ); ?>>
					<?php if ( isset( $settings['enable_filters'] ) && $settings['enable_filters'] === true ) { ?>
							<div class="filter-wrap">
							<button class="bultr-table-filter apply-filter">Filter</button>
							<button class="bultr-table-reset reset-filter">Reset</button>
							</div>
					<?php } ?>
					<!--  -->
					<div class="bultr-comp-table wrap">
						<!-- Header -->
						<div <?php echo $this->render_attributes( 'headers' ); ?>>
							<div class="bultr-table-navs table-navs">
								<a href="#" class="prev">Prev</a>
								<a href="#" class="next">Next</a>
							</div>
							<div <?php echo $this->render_attributes( 'scroller' ); ?>>
								<div class="feature-title header bultr-item-cell">
									<?php
										$heading = isset( $settings['feature_heading'] ) ? $settings['feature_heading'] : '';
										echo $heading;
									?>
								</div>
								<?php
								for ( $i = 1; $i <= $settings['table_count']; $i++ ) {
									?>
										<div class="header bultr-item-cell bultr-plans-header <?php echo 'bultr-plan-' . $i; ?>">
											<!-- TODO : Add Control -->
										<?php if ( isset( $settings['enable_filters'] ) && $settings['enable_filters'] === true ) { ?>
												<div class="check" data-cell=<?php echo $i; ?>></div>
											<?php } ?>
										<?php
							
											
										

										$image = $this->get_normalized_image_settings( $settings, 'table_image_' . $i );
										
										if(isset($image['url'])){
											
											if(isset($image['id']) && $image['id'] > 0){

												$size = isset( $team_member['image']['size'] ) ? $team_member['image']['size'] : BRICKS_DEFAULT_IMAGE_SIZE;
												$atts  = [
													'_brx_disable_lazy_loading' => true,
												];

												$image = wp_get_attachment_image( $image['id'], $size, false, $atts );
											}else{
												if(isset($image['url']) && $image['url'] != ''){
													$image = '<img src="' . $image['url'] . '" />';
												}else{
													$image = '';
												}
											}
											echo $image;
										}
										
									
										$title = '';
										$title = isset( $settings[ 'table_title_' . $i ] ) ? $settings[ 'table_title_' . $i ] : '';
										?>
											<h3 class="bultr-plan-title"><?php echo $title; ?></h3>
											<?php
											if ( isset( $settings[ 'table_price_' . $i ] ) ) {
												?>
												<div class="bultr-ct-price-wrapper">
													<?php if ( isset( $settings[ 'table_offer_discount_' . $i ] ) && $settings[ 'table_offer_discount_' . $i ] === true ) { ?>
														<span class="bultr-ct-original-price">
															<?php echo $settings[ 'table_currency_symbol_' . $i ] . $settings[ 'table_price_' . $i ]; ?>
														</span>
														<?php
													}
													if ( isset( $settings[ 'table_offer_discount_' . $i ] ) && $settings[ 'table_offer_discount_' . $i ] === true ) {
														$price = $settings[ 'table_offering_price_' . $i ];
													} else {
														$price = $settings[ 'table_price_' . $i ];
													}
													$price            = explode( '.', $price );
													$fractional_price = '';
													if ( count( $price ) > 1 ) {
														$fractional_price = '<span class="bultr-ct-fractional-price">' . $price[1] . '</span>';
													}
													?>
													<span class="bultr-ct-currency"> <?php echo $settings[ 'table_currency_symbol_' . $i ]; ?> </span>
													<span class="bultr-ct-price"><?php echo $price[0]; ?></span>
													<?php echo $fractional_price; ?>
												</div>
												<?php if ( isset( $settings[ 'table_duration_' . $i ] ) ) { ?>
														<span class="bultr-ct-duration"><?php echo $settings[ 'table_duration_' . $i ]; ?></span>
													<?php
												}
											}
											?>
											<?php
											if ( ( isset( $settings['enable_cta'] ) && $settings['enable_cta'] === true ) && ( isset( $settings['cta_pos'] ) && ( $settings['cta_pos'] === 'header' || $settings['cta_pos'] === 'both' ) ) ) {

												$this->set_attribute( "item-{$i}" . '-link-attributes', 'class', 'bultr-cta-btn' );
												if ( isset( $settings[ 'button_class_' . $i ] ) ) {
													$this->set_attribute( "item-{$i}" . '-link-attributes', 'class', $settings[ 'button_class_' . $i ] );
												}
												$this->set_attribute( "item-{$i}" . '-link-attributes', 'class', 'bultr-button-icon-pos-' . $settings[ 'button_icon_position_' . $i ] );
												$this->set_link_attributes( "item-{$i}" . '-link-attributes', $settings[ 'item_link_' . $i ] );

												if ( isset( $settings[ 'item_link_' . $i ] ) && isset( $settings[ 'button_text_' . $i ] ) ) {
													?>
												<div class="cta-wrap">
													<a <?php echo $this->render_attributes( "item-{$i}" . '-link-attributes' ); ?>> 
													<?php if ( ! empty( $settings[ 'button_icon_' . $i ]['icon'] ) ) { ?>
															<?php
																$icon = ! empty( $settings[ 'button_icon_' . $i ] ) ? self::render_icon( $settings[ 'button_icon_' . $i ], '' ) : false;
																echo $icon
															?>
													<?php } ?>
													<?php echo $settings[ 'button_text_' . $i ]; ?>
												</a>
												</div>
													<?php
												}
											}
											?>
										</div>
										<?php
								}
								?>
							</div>
						</div>
						<!-- Body -->
						<div class="body bultr-table-body">
							<?php
							$count = count( $settings['features_text'] );

							$this->set_attribute( 'items', 'class', [ 'items', 'bultr-comp-items' ] );
							$this->set_attribute( 'col-left', 'class', [ 'col', 'bultr-cols', 'left' ] );
							if ( ( isset( $settings['enable_cta'] ) && $settings['enable_cta'] === true ) && ( isset( $settings['cta_pos'] ) && ( $settings['cta_pos'] === 'footer' || $settings['cta_pos'] === 'both' ) ) ) {
								$temp_count = $count + 1;
								$this->set_attribute( 'col-left', 'style', 'grid-template-rows:repeat(' . $temp_count . ', 1fr)' );
							} else {
								$this->set_attribute( 'col-left', 'style', 'grid-template-rows:repeat(' . $count . ', 1fr)' );
							}

							?>
							<div <?php echo $this->render_attributes( 'items' ); ?>>
								<div <?php echo $this->render_attributes( 'col-left' ); ?>>
									<?php
									for ( $x = 1; $x <= $count; $x++ ) { ?>
										<div class="bultr-item-cell bultr-ct-feature">
											<?php 
												$icon = '';
												if(isset($settings['features_text'][ $x - 1 ]['feature_icon']['icon'])){
													$icon = $settings['features_text'][ $x - 1 ]['feature_icon']; 
													$icon = ! empty( $icon ) ? self::render_icon( $icon ) : false;	
												}
												if(isset($settings['feature_icon_position']) && $settings['feature_icon_position'] == 'left'){
													?>
													<span class=""><?php echo $icon; ?></span>
													<?php
												}
											?>
											<?php
												if(isset($settings['features_text'][ $x - 1 ] ['legend_feature_text'])){ 
													echo $settings['features_text'][ $x - 1 ] ['legend_feature_text']; 
												}
											?>
											<?php 
												if(isset($settings['feature_icon_position']) && $settings['feature_icon_position'] == 'right'){
													?>
													<span class=""><?php echo $icon; ?></span>
													<?php
												}
											?>	
										</div>		
										<?php
									}
									if ( ( isset( $settings['enable_cta'] ) && $settings['enable_cta'] === true ) && ( isset( $settings['cta_pos'] ) && ( $settings['cta_pos'] === 'footer' || $settings['cta_pos'] === 'both' ) ) ) {
										$cta_title = isset( $settings['cta_title'] ) ? $settings['cta_title'] : '';
										echo '<div class="bultr-item-cell bultr-cta-title">' . $cta_title . '</div>';
									}
									?>
								</div>
								<?php
								for ( $i = 1; $i <= $settings['table_count']; $i++ ) {
									$this->set_attribute( "table-col-{$i}", 'class', [ 'col', 'bultr-content-col', 'bultr-plan-' . $i ] );
									$this->set_attribute( "table-col-{$i}", 'data-col', $i );
									if ( ( isset( $settings['enable_cta'] ) && $settings['enable_cta'] === true ) && ( isset( $settings['cta_pos'] ) && ( $settings['cta_pos'] === 'footer' || $settings['cta_pos'] === 'both' ) ) ) {
										$temp_count = $count + 1;
										$this->set_attribute( "table-col-{$i}", 'style', 'grid-template-rows:repeat(' . $temp_count . ', 1fr)' );
									} else {
										$this->set_attribute( "table-col-{$i}", 'style', 'grid-template-rows:repeat(' . $count . ', 1fr)' );
									}
									?>
									<div <?php echo $this->render_attributes( "table-col-{$i}" ); ?>>
										<?php
										for ( $x = 1; $x <= $count; $x++ ) {
											$content_type = '';
											$style = '';
											if(isset($settings['feature_items_' . $i][ $x - 1 ]['table_content_type']) && $settings['feature_items_' . $i][ $x - 1 ]['table_content_type'] == 'rating'){
												$content_type = 'bultr-ct-rating';
											}											
											?>
												<div class="bultr-item-cell bultr-ct-cell repeater-item <?php echo $content_type; ?>">
												<?php
												if ( isset( $settings[ 'feature_items_' . $i ][ $x - 1 ] ) ) {
													$this->render_cell_data( $settings[ 'feature_items_' . $i ][ $x - 1 ], $i);
												}
												?>
												</div>
												<?php
										}
										?>
										<?php
										if ( ( isset( $settings['enable_cta'] ) && $settings['enable_cta'] === true ) && ( isset( $settings['cta_pos'] ) && ( $settings['cta_pos'] === 'footer' || $settings['cta_pos'] === 'both' ) ) ) {
											$this->set_attribute( "item-{$i}" . '-link-attributes', 'class', 'bultr-cta-btn' );
											if ( isset( $settings[ 'button_class_' . $i ] ) ) {
												$this->set_attribute( "item-{$i}" . '-link-attributes', 'class', $settings[ 'button_class_' . $i ] );
											}
											$this->set_attribute( "item-{$i}" . '-link-attributes', 'class', 'bultr-button-icon-pos-' . $settings[ 'button_icon_position_' . $i ] );
											?>
											<div class="bultr-item-cell bultr-ct-cta">
												<?php
												if ( isset( $settings[ 'item_link_' . $i ] ) && isset( $settings[ 'button_text_' . $i ] ) ) {
													$this->set_link_attributes( "item-{$i}" . '-link-attributes', $settings[ 'item_link_' . $i ] );
													?>
													<a <?php echo $this->render_attributes( "item-{$i}" . '-link-attributes' ); ?>> 
														<?php if ( ! empty( $settings[ 'button_icon_' . $i ]['icon'] ) ) { ?>
															<?php
																$icon = ! empty( $settings[ 'button_icon_' . $i ] ) ? self::render_icon( $settings[ 'button_icon_' . $i ], '' ) : false;
																echo $icon
															?>
														<?php } ?>
														<?php echo $settings[ 'button_text_' . $i ]; ?>
													</a>
												<?php } ?>	
											</div>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
	}

	public function render_cell_data( $cell_data ,$i) {
		if ( ! isset( $cell_data['table_content_type'] ) ) {
			return;
		}
		$content_type = $cell_data['table_content_type'];
		switch ( $content_type ) {
			case 'text':
				echo do_shortcode( $cell_data['feature_text'] );
				break;
			case 'icon':
				$attr = [
					'class' => ['bultr-plan-'.$i],
				];
							
				$icon = ! empty( $cell_data['feature_icon'] ) ? self::render_icon( $cell_data['feature_icon'],$attr) : false;
							echo $icon;
				break;
			case 'svg':
				$attr = [
					'class' => ['bultr-plan-'.$i],
				];
				$file_path =  ! empty( $cell_data['feature_svg']['id']) ? get_attached_file( $cell_data['feature_svg']['id'] ) : false;
				$svg = Helpers::file_get_contents( $file_path);
				echo self::render_svg( $svg, $attr );
				break;
			case 'rating' : 
				$rating = 	! empty( $cell_data['feature_rating'] ) ? $cell_data['feature_rating'] : false;
				if(!empty($rating)){
					if($this->rating_layout == 'icon'){
						$html =  $this->render_stars($rating);
						echo $html;
					}else{
						echo $rating;
						echo self::render_icon( $this->full_icon );
					}
					
				}
		}
	}

	protected function get_rating($num) {
		$rs = (int) $this->rating_scale;
		$rating = (float) $num > $rs ? $rs : $num;
		return [ $rating, $rs ];		        
	}

	protected function render_stars($rating) {
		$rating_data = $this->get_rating($rating);
		$rating = (float) $rating_data[0];
		$floored_rating = floor( $rating );
		$stars_html = '';
		for ( $stars = 1.0; $stars <= $rating_data[1]; $stars++ ) {
				if ( $stars <= $floored_rating ) {
						$stars_html .= self::render_icon( $this->full_icon );
				} elseif ( $floored_rating + 1 === $stars && $rating !== $floored_rating ) {
						$stars_html .= self::render_icon( $this->half_icon );
				} else {
						$stars_html .= self::render_icon($this->blank_icon);
				}
		}

		return $stars_html;
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'bultr-module-style' );
		wp_enqueue_script( 'bultr-module-script' );
		wp_enqueue_script( 'bu-comparisonTable', WPV_BU_URL . 'assets/lib/comparison-table/comparisonTable.min.js', '', WPV_BU_VERSION, true );
	}
}
