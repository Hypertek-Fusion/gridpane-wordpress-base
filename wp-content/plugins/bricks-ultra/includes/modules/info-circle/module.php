<?php

namespace BricksUltra\Modules\InfoCircle;

use Bricks\Element;
use BricksUltra\includes\Helper;
use Bricks\Query;

class Module extends Element {

	public $category     = 'ultra';
	public $name         = 'wpvbu-info-circle';
	public $icon         = 'ti-shine';
	public $css_selector = '';
	public $scripts      = [ 'InfoCircle' ];
	public $loop_index   = 0;

	// Methods: Builder-specific
	public function get_label() {
		return esc_html__( 'Info Circle', 'wpv-bu' );
	}

	// Enqueue element styles and scripts
	public function enqueue_scripts() {
		wp_enqueue_script( 'bultr-module-script' );
		wp_enqueue_style( 'bultr-module-style' );
	}
	public function set_control_groups() {
		$this->control_groups['items']         = [
			'title' => esc_html__( 'Items', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['content_style'] = [
			'title' => esc_html__( 'Content Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['icon_style']    = [
			'title' => esc_html__( 'Icon Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
	}
	public function set_controls() {
		$helper = new Helper();
		$this->item_controls();

		$helper->add_icon_controls(
			$this,
			[
				'control_name' => 'global_icon',
				'shape'        => true,
				'view'         => true,
				'tab'          => 'content',
				'group'        => 'items',

			]
		);
		$this->controls['global_icon_view']['default']  = 'framed';
		$this->controls['global_icon_shape']['default'] = 'circle';

		// Content Style Controls
		$this->style_controls();

		// Icon Style Controls
		$this->icon_style_controls();
	}

	public function item_controls() {
		$helper                              = new Helper();
		$loop_controls                       = $this->get_loop_builder_controls( 'items' );
		$this->controls['info_circle_items'] = [
			'tab'           => 'content',
			'group'         => 'items',
			'checkLoop'     => true,
			'label'         => esc_html__( 'Items', 'wpv-bu' ),
			'type'          => 'repeater',
			'titleProperty' => 'slide_heading', // Default 'title'
			'default'       => [
				[
					'title'            => 'MASTER CLEANSE BESPOKE',
					'content'          => 'IPhone tilde pour-over, sustainable cred roof party occupy master cleanse. Godard vegan heirloom sartorial flannel raw denim +1. Sriracha umami meditation, listicle chambray fanny pack blog organic Blue Bottle.',
					'heading_tag'      => 'h3',
					'item_custom_icon' => false,
					'icon'             => [
						'library' => 'themify',
						'icon'    => 'ti-angle-left',
					],
					'view'             => 'global',
					'shape'            => 'circle',
				],
				[
					'title'            => 'ORGANIC BLUE BOTTLE',
					'content'          => 'Godard vegan heirloom sartorial flannel raw denim +1 umami gluten-free hella vinyl. Viral seitan chillwave, before they sold out wayfarers selvage skateboard Pinterest messenger bag.',
					'heading_tag'      => 'h3',
					'item_custom_icon' => false,
					'icon'             => [
						'library' => 'themify',
						'icon'    => 'ti-angle-left',
					],
				],
				[
					'title'            => 'TWEE DIY KALE',
					'content'          => 'Twee DIY kale chips, dreamcatcher scenester mustache leggings trust fund Pinterest pickled. Williamsburg street art Odd Future jean shorts cold-pressed banh mi DIY distillery Williamsburg.',
					'heading_tag'      => 'h3',
					'item_custom_icon' => false,
					'icon'             => [
						'library' => 'themify',
						'icon'    => 'ti-angle-left',
					],
				],
			],
			'fields'        => [
				'title' => [
					'tab'    => 'content',
					'group'  => 'items',
					'label'  => esc_html__( 'Title', 'wpv-bu' ),
					'type'   => 'text',
					'inline' => false,
				],
				'content' => [
					'tab'    => 'content',
					'group'  => 'items',
					'label'  => esc_html__( 'Content', 'wpv-bu' ),
					'type'   => 'textarea',
					'inline' => false,
				],

				'item_custom_icon' => [
					'tab'     => 'content',
					'group'   => 'items',
					'label'   => esc_html__( 'Custom Icon', 'wpv-bu' ),
					'type'    => 'checkbox',
					'inline'  => true,
					'small'   => true,
					'default' => true,
				],

				'icon_type' => [
					'label'    => esc_html__( 'Icon Type', 'wpv-bu' ),
					'type'     => 'select',
					'options'  => [
						'icon'  => 'Icon',
						'image' => 'Image',
						'text'  => 'Text',
						'svg'   => 'SVG',
					],
					'inline'   => true,
					'default'  => 'icon',
					'required' => [ 'item_custom_icon', '!=', '' ],
				],
				'icon' => [
					'label'    => esc_html__( 'Icon', 'wpv-bu' ),
					'type'     => 'icon',
					'default'  => [
						'library' => 'themify',
						'icon'    => 'ti-star',
					],
					'css'      => [
						[
							'selector' => '.icon-svg',
						],
					],
					'required' => [
						[ 'icon_type', '=', 'icon' ],
						[ 'item_custom_icon', '!=', '' ],
					],
				],

				'svg' => [
					'tab'      => 'content',
					'type'     => 'svg',
					'required' => [
						[ 'icon_type', '=', 'svg' ],
						[ 'item_custom_icon', '!=', '' ],
					],
				],

				'image' => [
					'label'    => esc_html__( 'Image', 'wpv-bu' ),
					'type'     => 'image',
					'required' => [
						[ 'icon_type', '=', 'image' ],
						[ 'item_custom_icon', '!=', '' ],
					],
				],

				'text' => [
					'label'         => esc_html__( 'Text', 'wpv-bu' ),
					'type'          => 'text',
					'spellcheck'    => true,
					'inlineEditing' => true,
					'inline'        => true,
					'required'      => [
						[ 'icon_type', '=', 'text' ],
						[ 'item_custom_icon', '!=', '' ],
					],
				],

				'view' => [
					'label'    => esc_html__( 'View', 'wpv-bu' ),
					'type'     => 'select',
					'options'  => [
						'global'  => 'Global',
						'default' => 'Default',
						'stacked' => 'Stacked',
						'framed'  => 'Framed',
					],
					'default'  => 'global',
					'required' => [ [ 'item_custom_icon', '!=', '' ] ],
				],

				'shape' => [
					'label'    => esc_html__( 'Shape', 'wpv-bu' ),
					'type'     => 'select',
					'options'  => [
						'global' => 'Global',
						'circle' => 'Circle',
						'square' => 'Square',
					],
					'default'  => 'global',
					'required' => [
						[ 'view', '!=', 'default' ],
						[ 'item_custom_icon', '!=', '' ],
					],
				],

				'heading_tag' => [
					'tab'     => 'content',
					'group'   => 'items',
					'label'   => esc_html__( 'Heading Tag', 'wpv-bu' ),
					'type'    => 'select',
					'options' => [
						'h1' => esc_html__( 'H1', 'wpv-bu' ),
						'h2' => esc_html__( 'H2', 'wpv-bu' ),
						'h3' => esc_html__( 'H3', 'wpv-bu' ),
						'h4' => esc_html__( 'H4', 'wpv-bu' ),
						'h5' => esc_html__( 'H5', 'wpv-bu' ),
						'h6' => esc_html__( 'H6', 'wpv-bu' ),
					],
					'inline'  => true,
					'default' => 'h3',
				],

				'content_custom_style' => [
					'label'   => esc_html__( 'Content Custom Style', 'wpv-bu' ),
					'type'    => 'checkbox',
					'inline'  => true,
					'small'   => true,
					'default' => false,
				],

				'heading_color' => [
					'tab'      => 'content',
					'group'    => 'items',
					'label'    => esc_html__( 'Heading Color', 'wpv-bu' ),
					'type'     => 'color',
					'inline'   => true,
					'css'      => [
						[
							'property' => 'color',
							'selector' => '.bultr-cust-style .bultr-info-circle-item__content .bultr-ic-heading',
						],
					],
					'required' => [
						[ 'content_custom_style', '=', true ],
					],
				],

				'content_color' => [
					'tab'      => 'content',
					'group'    => 'items',
					'label'    => esc_html__( 'Content Color', 'wpv-bu' ),
					'type'     => 'color',
					'inline'   => true,
					'css'      => [
						[
							'property' => 'color',
							'selector' => '.bultr-cust-style .bultr-info-circle-item__content .bultr-ic-content',
						],
					],
					'required' => [
						[ 'content_custom_style', '=', true ],
					],
				],

				'background' => [
					'tab'      => 'content',
					'group'    => 'items',
					'label'    => esc_html__( 'Background', 'wpv-bu' ),
					'type'     => 'background',
					'inline'   => true,
					'css'      => [
						[
							'property' => 'background',
							'selector' => '.bultr-cust-style.bultr-info-circle-item__content-wrap',
						],
					],
					'required' => [
						[ 'content_custom_style', '=', true ],
					],
				],

				'icon_custom_style' => [
					'label'   => esc_html__( 'Icon Custom Style', 'wpv-bu' ),
					'type'    => 'checkbox',
					'inline'  => true,
					'small'   => true,
					'default' => false,
				],

				'icon_primary_color' => [
					'tab'      => 'content',
					'group'    => 'items',
					'label'    => esc_html__( 'Primary color', 'wpv-bu' ),
					'type'     => 'color',
					'inline'   => true,
					'css'      => [
						[
							'property' => 'fill',
							'selector' => '.bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-framed .bultr-icon svg',
						],
						[
							'property' => 'fill',
							'selector' => '.bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-normal .bultr-icon svg',
						],
						[
							'property' => 'background-color',
							'selector' => '.bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-stacked .bultr-icon svg',
						],
						[
							'property' => 'border-color',
							'selector' => '.bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-framed .bultr-icon svg',
						],




						[
							'property' => 'color',
							'selector' => '.bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-framed .bultr-icon',
						],
						[
							'property' => 'color',
							'selector' => '.bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-normal .bultr-icon',
						],
						[
							'property' => 'background-color',
							'selector' => '.bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-stacked .bultr-icon',
						],
						[
							'property' => 'border-color',
							'selector' => '.bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-framed .bultr-icon',
						],
						
					],
					'required' => [
						[ 'icon_custom_style', '=', true ],
					],
				],

				'icon_secondary_color' => [
					'tab'      => 'content',
					'group'    => 'items',
					'label'    => esc_html__( 'Secondary Color', 'wpv-bu' ),
					'type'     => 'color',
					'inline'   => true,
					'css'      => [
						[
							'property' => 'color',
							'selector' => '.bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-stacked .bultr-icon',
						],
						[
							'property' => 'background-color',
							'selector' => '.bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-framed .bultr-icon',
						],
						[
							'property' => 'fill',
							'selector' => '.bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-stacked .bultr-icon svg',
						],
					],
					'required' => [
						[ 'icon_custom_style', '=', true ],
					],
				],

				'icon_border_color' => [
					'tab'      => 'content',
					'group'    => 'items',
					'label'    => esc_html__( 'Border Color', 'wpv-bu' ),
					'type'     => 'color',
					'inline'   => true,
					'css'      => [
						[
							'property' => 'border-color',
							'selector' => '.bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-framed .bultr-icon',
						],
					],
					'required' => [
						[ 'icon_custom_style', '=', true ],
					],
				],

				'icon_focused_heading' => [
					'tab'      => 'content',
					'label'    => esc_html__( 'Focused', 'wpv-bu' ),
					'type'     => 'separator',
					'required' => [
						[ 'icon_custom_style', '=', true ],
					],
				],

				'icon_focused_primary_color' => [
					'tab'      => 'content',
					'group'    => 'items',
					'label'    => esc_html__( 'Primary color', 'wpv-bu' ),
					'type'     => 'color',
					'inline'   => true,
					'css'      => [
						[
							'property' => 'fill',
							'selector' => '&.bultr-active .bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-framed .bultr-icon svg',
						],
						[
							'property' => 'fill',
							'selector' => '&.bultr-active .bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-normal .bultr-icon svg',
						],
						
						// [
						// 	'property' => 'fill',
						// 	'selector' => '&.bultr-active .bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-framed .bultr-icon svg',
						// ],
						// [
						// 	'property' => 'fill',
						// 	'selector' => '&.bultr-active .bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-normal .bultr-icon svg',
						// ],
						[
							'property' => 'background-color',
							'selector' => '&.bultr-active .bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-stacked .bultr-icon',
						],
						[
							'property' => 'border-color',
							'selector' => '&.bultr-active .bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-framed .bultr-icon',
						],
						[
							'property' => 'color',
							'selector' => '&.bultr-active .bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-framed .bultr-icon',
						],
						[
							'property' => 'color',
							'selector' => '&.bultr-active .bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-normal .bultr-icon',
						],
						



						[
							'property' => 'border-color',
							'selector' => '&.bultr-active .bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-framed .bultr-icon',
						],
						
					],
					'required' => [
						[ 'icon_custom_style', '=', true ],
					],
				],

				'icon_focused_secondary_color' => [
					'tab'      => 'content',
					'group'    => 'items',
					'label'    => esc_html__( 'Secondary Color', 'wpv-bu' ),
					'type'     => 'color',
					'inline'   => true,
					'css'      => [
						[
							'property' => 'color',
							'selector' => '&.bultr-active .bultr-icon-cust-style .bultr-info-icon-wrap.bultr-view-stacked .bultr-icon',
						],
						[
							'property' => 'fill',
							'selector' => '&.bultr-active .bultr-icon-cust-style .bultr-info-icon-wrap.bultr-view-stacked .bultr-icon svg',
						],
						[
							'property' => 'background-color',
							'selector' => '&.bultr-active .bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-framed .bultr-icon',
						],
					],
					'required' => [
						[ 'icon_custom_style', '=', true ],
					],
				],

				'icon_focused_border_color' => [
					'tab'      => 'content',
					'group'    => 'items',
					'label'    => esc_html__( 'Border Color', 'wpv-bu' ),
					'type'     => 'color',
					'inline'   => true,
					'css'      => [
						[
							'property' => 'border-color',
							'selector' => '&.bultr-active .bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-framed .bultr-icon',
						],
						[
							'property' => 'border-color',
							'selector' => '&.bultr-active .bultr-icon-cust-style.bultr-info-icon-wrap.bultr-view-framed .bultr-icon svg',
						],
					],
					'required' => [
						[ 'icon_custom_style', '=', true ],
					],
				],
			],
		];

		$this->controls = array_replace_recursive( $this->controls, $loop_controls );
	}
	public function style_controls() {
		$style_group                     = 'content_style';
		$this->controls['circle_border'] = [
			'tab'     => 'content',
			'group'   => $style_group,
			'label'   => esc_html__( 'Circle Border', 'wpv-bu' ),
			'type'    => 'border',
			'exclude' => [ 'radius' ],
			'css'     => [
				[
					'property' => 'border',
					'selector' => '.bultr-info-circle:before',
				],
			],
		];

		$this->controls['content_autoplay']   = [
			'tab'   => 'content',
			'group' => $style_group,
			'label' => esc_html__( 'Content Autochange', 'wpv-bu' ),
			'type'  => 'checkbox',
		];
		$this->controls['autochange_delay']   = [
			'tab'         => 'content',
			'group'       => $style_group,
			'label'       => esc_html__( 'Autochange Delay', 'wpv-bu' ),
			'type'        => 'number',
			'placeholder' => 1000,
			'required'    => [ 'content_autoplay', '!=', '' ],
		];
		$this->controls['change_mouse_enter'] = [
			'tab'      => 'content',
			'group'    => $style_group,
			'label'    => esc_html__( 'Change on Mouse Enter', 'wpv-bu' ),
			'type'     => 'checkbox',
			'required' => [ 'content_autoplay', '=', false ],
		];
		$this->controls['content_align']      = [
			'tab'     => 'content',
			'group'   => $style_group,
			'label'   => esc_html__( 'Align', 'wpv-bu' ),
			'type'    => 'text-align',
			'inline'  => true,
			'default' => 'center',
			'css'     => [
				[
					'property' => 'text-align',
					'selector' => '.bultr-info-circle-item__content',
				],
			],
		];
		$this->controls['content_width'] = [
			'tab'   => 'content',
			'group' => $style_group,
			'label' => esc_html__( 'Width', 'wpv-bu' ),
			'type'  => 'number',
			'unit'	=> 'px',
			'css'   => [
				[
					'property' => 'width',
					'selector' => '.bultr-info-circle .bultr-info-circle-item__content-wrap',
				],
			],
		];

		$this->controls['content_height'] = [
			'tab'   => 'content',
			'group' => $style_group,
			'label' => esc_html__( 'Height', 'wpv-bu' ),
			'type'  => 'number',
			'unit'	=> 'px',
			'css'   => [
				[
					'property' => 'height',
					'selector' => '.bultr-info-circle .bultr-info-circle-item__content-wrap',
				],
			],
		];

		$this->controls['content_padding']    = [
			'tab'   => 'content',
			'group' => $style_group,
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-info-circle-item__content',
				],
			],
		];
		$this->controls['title_space']        = [
			'tab'   => 'content',
			'group' => $style_group,
			'label' => esc_html__( 'Title Spacing (px)', 'wpv-bu' ),
			'type'  => 'number',
			'unit'  => 'px',
			'css'   => [
				[
					'property' => 'margin-bottom',
					'selector' => '.bultr-ic-heading',
				],
			],
		];
		$this->controls['title_typography']   = [
			'tab'     => 'content',
			'group'   => $style_group,
			'label'   => esc_html__( 'Title Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'default' => [
				'font-size'   => '30px',
				'font-weight' => 700,
				'line-height' => 1,
			],
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-info-circle-item__content .bultr-ic-heading',
				],
			],
			'inline'  => true,
		];
		$this->controls['content_typography'] = [
			'tab'     => 'content',
			'group'   => $style_group,
			'label'   => esc_html__( 'Content Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'default' => [
				'font-size'   => '20px',
				'line-height' => 1.4,
			],
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-info-circle-item__content .bultr-ic-content',
				],
			],
			'inline'  => true,
		];

		$this->controls['background'] = [
			'tab'   => 'content',
			'group' => $style_group,
			'label' => 'Background',
			'type'  => 'background',
			'css'   => [
				[
					'property' => 'background',
					'selector' => '.bultr-info-circle-item__content-wrap',
				],
			],
		];
	}

	public function icon_style_controls() {
		$helper      = new Helper();
		$style_group = 'icon_style';
		$helper->add_icon_style_controls(
			$this,
			[
				'control_name'        => 'global_icon',
				'tab'                 => 'content',
				'group'               => $style_group,
				'wrapper-class'       => '.bultr-info-icon-wrap',
				'size'                => true,
				'rotate'              => true,
				'primary_color'       => true,
				'secondary_color'     => true,
				'shadow'			  => true,	
				'icon_hvr'            => true,
				'hvr_rotate'          => true,
				'primary_hvr_color'   => true,
				'secondary_hvr_color' => true,
				'hvr_shadow'		  => true,	
				'padding'             => true,
				'border'              => true,
			]
		);

		$this->controls['focused_style'] = [
			'tab'   => 'content',
			'group' => $style_group,
			'label' => esc_html__( 'Focused', 'wpv-bu' ),
			'type'  => 'separator',
		];
		$helper->add_icon_style_controls(
			$this,
			[
				'control_name'        => 'focused_icon',
				'tab'                 => 'content',
				'group'               => $style_group,
				'wrapper-class'       => '.bultr-active .bultr-info-icon-wrap',
				'size'                => false,
				'rotate'              => false,
				'primary_color'       => true,
				'secondary_color'     => true,
				'shadow'			  => true,	
				'icon_hvr'            => false,
				'hvr_rotate'          => false,
				'primary_hvr_color'   => false,
				'secondary_hvr_color' => false,
				'hvr_shadow'		  => true,	
				'padding'             => false,
				'border'              => false,
			]
		);

		$this->controls['focused_icon_border_color'] = [
			'tab'      => 'content',
			'group'    => $style_group,
			'label'    => esc_html__( 'Border color', 'wpv-bu' ),
			'type'     => 'color',
			'inline'   => true,
			'small'    => true,
			'css'      => [
				[
					'property'  => 'border-color',
					'selector'  => '.bultr-active .bultr-info-icon-wrap.bultr-view-framed .bultr-icon',
					'important' => true, // Optional
				],
				
			],
			'required' => [ 'global_icon_view', '=', 'framed' ],
		];
	}

	public function render() {
		$settings = $this->settings;
		$items    = $settings['info_circle_items'] ?? [];
		$index    = $this->loop_index;
		$this->set_attribute( 'bultr-info-circle', 'class', 'bultr-info-circle' );
		$this->set_attribute( 'bultr-info-circle', 'data-active-item', '1' );
		$this->set_attribute( 'bultr-info-circle', 'data-autoplay', $settings['content_autoplay'] ?? 'no' );
		$this->set_attribute( 'bultr-info-circle', 'data-mouseenter', $settings['change_mouse_enter'] ?? 'no' );
		$this->set_attribute( 'bultr-info-circle', 'data-delay', $settings['autochange_delay'] ?? 1000 );

		$global_settings = [
			'global_icon_type'  => $settings['global_icon_type'],
			'global_icon_view'  => $settings['global_icon_view'],
			'global_icon_shape' => $settings['global_icon_shape'],
		];
		switch ( $settings['global_icon_type'] ) {
			case 'icon':
				$global_settings = [
					'global_icon_icon' => $settings['global_icon_icon'],
				];
				break;
			case 'image':
				$global_settings = [
					'global_icon_image' => $settings['global_icon_image'],
				];
				break;
			case 'text':
				$global_settings = [
					'global_icon_text' => $settings['global_icon_text'],
				];
				break;
			case 'svg':
				$global_settings = [
					'global_icon_text' => $settings['global_icon_svg'],
				];
				break;
		}

		$global_icon_settings = [
			'global_icon_type'  => $settings['global_icon_type'],
			'global_icon_icon'  => $settings['global_icon_icon'],
			'global_icon_view'  => $settings['global_icon_view'],
			'global_icon_shape' => $settings['global_icon_shape'],
		];
		?>
		<div <?php echo $this->render_attributes( '_root' ); ?>>
			<div class="bultr-info-circle-wrapper">
				<div <?php echo $this->render_attributes( 'bultr-info-circle' ); ?>>
				<?php
				if ( isset( $settings['hasLoop'] ) ) {
					$query   = new Query(
						[
							'id'       => $this->id,
							'settings' => $settings,
						]
					);
					$ic_item = $items[0];
					$query->render( [ $this, 'render_item' ], compact( 'ic_item', 'settings', 'global_icon_settings' ) );
					// We need to destroy the Query to explicitly remove it from the global store
					$query->destroy();
					unset( $query );
				} else {
					foreach ( $items as $index => $item ) {
						$this->render_item( $item, $settings, $global_icon_settings );
					}
				}
				?>
				</div>
			</div>
		</div>
		<?php
	}

	public function render_item( $item, $settings, $global_icon_settings ) {
		$helper = new Helper();
		$index  = $this->loop_index;
		if ( ! isset( $item['id'] ) ) {
			$item['id'] = wp_rand( '9999', '100000' );
		}
		if ( ! isset( $settings['hasLoop'] ) ) {
			$this->set_attribute( "item-wrap-{$index}", 'class', 'repeater-item' );
		}

		$this->set_attribute( "item-wrap-{$index}", 'class', 'bultr-info-circle-item' );
		$this->set_attribute( "item-wrap-{$index}", 'class', "bricks-repeater-item-{$item['id']}" );
		$this->set_attribute( "item-{$index}", 'class', 'bultr-ic-icon-wrap' );
		$this->set_attribute( "item-{$index}", 'id', $item['id'] );
		$this->set_attribute( "item-{$index}", 'data-id', $item['id'] );

		$this->set_attribute( "item-content-wrap-{$index}", 'class', 'bultr-info-circle-item__content-wrap' );
		if ( isset( $item['content_custom_style'] ) ) {
			$this->set_attribute( "item-content-wrap-{$index}", 'class', 'bultr-cust-style' );
		}
		?>
		<div <?php echo $this->render_attributes( "item-wrap-{$index}" ); ?> >
			<div <?php echo $this->render_attributes( "item-{$index}" ); ?> >
				<?php
					$icon_class = 'bultr-info-icon-wrap';
				if ( isset( $item['icon_custom_style'] ) ) {
					$icon_class .= ' bultr-icon-cust-style';
				}
					echo $helper->render_repeater_icon_html( $this, $item, $settings, $global_icon_settings, $index, $icon_class );
				?>
			</div>
			<div <?php echo $this->render_attributes( "item-content-wrap-{$index}" ); ?>>
				<div class="bultr-info-circle-item__content">
				<?php
				printf(
					'<%1$s class="bultr-ic-heading">%2$s</%1$s>',
					$item['heading_tag'],
					$this->render_dynamic_data( $item['title'] )
				);
				?>
					<div class="bultr-ic-content">
						<p><?php echo $this->render_dynamic_data( $item['content'] ); ?></p>
					</div>
				</div>
			</div>
		</div>
		<?php
		$this->loop_index++;
	}
}
