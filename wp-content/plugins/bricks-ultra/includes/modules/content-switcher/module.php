<?php
namespace BricksUltra\Modules\ContentSwitcher;

use Bricks\Element;
use Bricks\Templates;
use Bricks\Query;
use Bricks\Helpers;
use Bricks\Setup;
use Bricks\Frontend;
use Bricks\Theme;
use BricksUltra\includes\Helper;

class Module extends Element {

	public $category           = 'ultra';
	public $name               = 'wpvbu-content-switcher';
	public $icon               = 'ti-layout-tab';
	public $css_selector       = '';
	public $scripts            = [ 'ContentSwitcher' ];
	public $loop_index         = 1;
	public $loop_index_content = 1;
	// Methods: Builder-specific
	public function get_label() {
		return esc_html__( 'Content Switcher', 'wpv-bu' );
	}
	public function get_keywords() {
		return [ 'tab', 'switcher', 'content' ];
	}
	public function set_control_groups() {
		$this->control_groups['content']        = [
			'title' => esc_html__( 'Content', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['display']        = [
			'title' => esc_html__( 'Display', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['switch']         = [
			'title' => esc_html__( 'Switch Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['switch_bar']     = [
			'title' => esc_html__( 'Switch Bar', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['switcher_style'] = [
			'title'    => esc_html__( 'Switcher Control', 'wpv-bu' ),
			'tab'      => 'content',
			'required' => [ 'layout', '!=', 'layout_1' ],
		];
		$this->control_groups['content_style']  = [
			'title' => esc_html__( 'Content Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
	}

	public function set_controls() {
		$this->controls['layout'] = [
			'tab'         => 'content',
			'label'       => esc_html__( 'Layout', 'wpv-bu' ),
			'type'        => 'select',
			'options'     => [
				'layout_1' => 'Layout 1',
				'layout_2' => 'Layout 2',
				'layout_3' => 'Layout 3',
			],
			'inline'      => true,
			'clearable'   => false,
			'placeholder' => esc_html__( 'Select', 'wpv-bu' ),
			'default'     => 'layout_1', // Option key
		];

		$this->controls['layout_info'] = [
			'tab'      => 'content',
			'content'  => esc_html__( 'This layout requires only two items', 'wpv-bu' ),
			'type'     => 'info',
			'required' => [ 'layout', '!=', 'layout_1' ], // Show info control if 'type' = 'custom'
		];

		$this->controls['content_items'] = [
			'tab'           => 'content',
			'group'         => 'content',
			'checkLoop'     => true,
			'label'         => esc_html__( 'Items', 'wpv-bu' ),
			'type'          => 'repeater',
			'titleProperty' => 'item_title', // Default 'title'
			'default'       => [
				[
					'item_title'         => __( 'Primary', 'wpv-bu' ),
					'item_content_type'  => 'editor',
					'editor_content'     => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lectus tellus, faucibus ut condimentum non, viverra elementum mauris. Praesent pharetra turpis nisl, quis elementum mauris imperdiet eu. Maecenas fermentum, quam suscipit laoreet lacinia, felis augue bibendum elit,', 'wpv-bu' ),
					'item_icon_position' => 'left',
				],
				[
					'item_title'         => __( 'Secondary', 'wpv-bu' ),
					'active'             => true,
					'item_content_type'  => 'editor',
					'editor_content'     => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lectus tellus, faucibus ut condimentum non, viverra elementum mauris. Praesent pharetra turpis nisl, quis elementum mauris imperdiet eu.', 'wpv-bu' ),
					'item_icon_position' => 'left',
				],
			],
			'fields'        => [
				'item_title' => [
					'label'       => esc_html__( 'Title', 'wpv-bu' ),
					'type'        => 'text',
					'default'     => __( 'Title', 'wpv-bu' ),
					'placeholder' => __( 'Enter your title', 'wpv-bu' ),
				],

				'item_content_type' => [
					'label'       => esc_html__( 'Content', 'wpv-bu' ),
					'type'        => 'select',
					'options'     => [
						'editor'   => 'Editor',
						'template' => 'Template',
					],
					'default'     => 'editor',
					'placeholder' => __( 'Select', 'wpv-bu' ),
				],

				'template_content' => [
					'tab'         => 'content',
					'label'       => esc_html__( 'Template', 'wpv-bu' ),
					'type'        => 'select',
					'options'     => bricks_is_builder() ? Templates::get_templates_list( get_the_ID() ) : [],
					'searchable'  => true,
					'placeholder' => esc_html__( 'Select template', 'wpv-bu' ),
					'required'    => [
						[ 'item_content_type', '=', 'template' ],
					],
				],

				'editor_content' => [
					'tab'           => 'content',
					'label'         => esc_html__( 'Text editor', 'wpv-bu' ),
					'type'          => 'editor',
					'inlineEditing' => [
						'selector' => '.text-editor', // Mount inline editor to this CSS selector
						'toolbar'  => true, // Enable/disable inline editing toolbar
					],
					'required'      => [
						[ 'item_content_type', '=', 'editor' ],
					],
					'default'       => esc_html__( 'Here goes the content ..', 'wpv-bu' ),
				],

				'item_icon' => [
					'tab'            => 'content',
					'label'          => esc_html__( 'Icon', 'wpv-bu' ),
					'type'           => 'icon',
					'hasDynamicData' => false,
					'default'        => [
						'library' => 'themify', // fontawesome/ionicons/themify
						'icon'    => 'ti-star',    // Example: Themify icon class
					],
				],

				'item_icon_position' => [
					'label'          => esc_html__( 'Icon Position', 'wpv-bu' ),
					'type'           => 'select',
					'hasDynamicData' => false,
					'options'        => [
						'left'  => 'Left',
						'right' => 'Right',
					],
					'default'        => 'left',
					'placeholder'    => __( 'Select', 'wpv-bu' ),
				],
				'active' => [
					'label'  => esc_html__( 'Active', 'wpv-bu' ),
					'type'   => 'checkbox',
					'inline' => true,
					'small'  => true,
				],

			],
		];

		$this->controls = array_replace_recursive( $this->controls, $this->get_loop_builder_controls( 'content' ) );

		// Display Settings Controls
		$this->display_controls();

		// Swith Style Controls
		$this->switch_style_controls();

		// Swith Bar Style Controls
		$this->switch_bar_style_controls();

		// Swticher Style Controls
		$this->switcher_style_controls();

		// Content Style Controls
		$this->content_style_controls();
	}

	public function display_controls() {
		$display_group                          = 'display';
		$this->controls['content_align']        = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Switch Alignment', 'wpv-bu' ),
			'type'     => 'text-align',
			'inline'   => true,
			'default'  => 'center',
			'exclude'  => [ 'justify' ],
			'css'      => [
				[
					'property' => 'text-align',
					'selector' => '.bultr-cs-layout_1 .bultr-cs-switch-container',
				],
			],
			'required' => [ 'layout', '=', 'layout_1' ],
		];
		$this->controls['content_align_toggle'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Switch Alignment', 'wpv-bu' ),
			'type'     => 'justify-content',
			// 'isHorizontal' => true,
			'inline'   => true,
			'default'  => 'center',
			'exclude'  => [ 'space' ],
			'css'      => [
				[
					'property' => 'justify-content',
					'selector' => '.bultr-cs-wrapper:not(.bultr-cs-layout_1) .bultr-cs-switcher-wrapper',
				],
			],
			'required' => [ 'layout', '!=', 'layout_1' ],
		];

		$this->controls['space_between'] = [
			'tab'     => 'content',
			'group'   => $display_group,
			'label'   => esc_html__( 'Space', 'wpv-bu' ),
			'type'    => 'number',
			'default' => 10,
			'unit'    => 'px',
			'css'     => [
				[
					'property' => 'margin-bottom',
					'selector' => '.bultr-cs-switch-container',
				],
			],
		];
		$this->controls['anim_speed']    = [
			'tab'     => 'content',
			'group'   => $display_group,
			'label'   => esc_html__( 'Animation Speed', 'wpv-bu' ),
			'type'    => 'number',
			'default' => 300,
			'unit'    => 'ms',
			'css'     => [
				[
					'property' => 'transition-duration',
					'selector' => '.bultr-cs-switch-container .bultr-content-toggle-switcher:before',
				],
				[
					'property' => 'transition-duration',
					'selector' => '.bultr-cs-switch-container .bultr-content-switch-button:before',
				],
			],
		];
	}

	public function switch_style_controls() {
		$display_group                      = 'switch';
		$this->controls['title_typography'] = [
			'tab'     => 'content',
			'group'   => $display_group,
			'label'   => esc_html__( 'Label Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'default' => [
				'font-size'   => '21px',
				'font-weight' => 400,
				'line-height' => 1,
			],
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-cs-switcher-wrapper .bultr-content-switch-label h5',
				],
				[
					'property' => 'typography',
					'selector' => '.bultr-cs-switcher-wrapper .bultr-content-switch-button',
				],
			],
			'exclude' => [ 'color', 'text-align' ],
			'inline'  => true,
		];
		$this->controls['icon_size']=[
			'tab'     => 'content',
			'group'   => $display_group,
			'label'   => esc_html__( 'Icon Size', 'wpv-bu' ),
			'type'    => 'number',
			'default' => 20,
			'unit'    => 'px',
			'css'     => [
				[
					'property' => 'font-size',
					'selector' => '.bultr-cs-switcher-wrapper .bultr-content-switch-label i',
				],
				[
					'property' => 'font-size',
					'selector' => '.bultr-cs-switcher-wrapper .bultr-content-switch-button i',
				],
				
				[
					'property' => 'font-size',
					'selector' => '.bultr-cs-switcher-wrapper .bultr-content-switch-label svg',
				],
				[
					'property' => 'font-size',
					'selector' => '.bultr-cs-switcher-wrapper .bultr-content-switch-button svg',
				],
			],
		];
		$this->controls['normal_sep']       = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Normal', 'wpv-bu' ),
			'type'  => 'separator',
		];
		$this->controls['label_color']      = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__( 'Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-cs-wrapper .bultr-cs-switcher-wrapper .bultr-content-switch-label',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-cs-switch-container .bultr-cs-switcher-wrapper .bultr-content-switch-button',
				],
			],
		];
		$this->controls['icon_color']       = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__( 'Icon Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-cs-wrapper .bultr-cs-switcher-wrapper .bultr-content-switch-label i',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-cs-switch-container .bultr-cs-switcher-wrapper .bultr-content-switch-button i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-cs-wrapper .bultr-cs-switcher-wrapper .bultr-content-switch-label svg',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-cs-switch-container .bultr-cs-switcher-wrapper .bultr-content-switch-button svg',
				],
			],
		];
		$this->controls['switch_bg_color']  = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'     => 'color',
			'inline'   => true,
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-cs-switcher-wrapper .bultr-content-switch-button',
				],
			],
			'required' => [ 'layout', '=', 'layout_1' ],
		];
		$this->controls['switch_border']    = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Border', 'wpv-bu' ),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.bultr-cs-switcher-wrapper .bultr-content-switch-button',
				],
			],
			'required' => [ 'layout', '=', 'layout_1' ],
			'inline'   => true,
			'small'    => true,
		];
		$this->controls['box_shadow']       = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Box shadow', 'wpv-bu' ),
			'type'  => 'box-shadow',
			'css'   => [
				[
					'property' => 'box-shadow',
					'selector' => '.bultr-cs-switcher-wrapper .bultr-content-switch-button',
				],
			],
		];

		$this->controls['active_sep'] = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Active', 'wpv-bu' ),
			'type'  => 'separator',
		];

		$this->controls['act_label_color']         = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__( 'Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-cs-wrapper .bultr-cs-switcher-wrapper .bultr-content-switch-label.active',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-cs-switch-container .bultr-cs-switcher-wrapper .bultr-content-switch-button.active',
				],
			],
		];
		$this->controls['act_icon_color']          = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__( 'Icon Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-cs-wrapper .bultr-cs-switcher-wrapper  .bultr-content-switch-label.active i',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-cs-switch-container .bultr-cs-switcher-wrapper .bultr-content-switch-button.active i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-cs-wrapper .bultr-cs-switcher-wrapper  .bultr-content-switch-label.active svg',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-cs-switch-container .bultr-cs-switcher-wrapper .bultr-content-switch-button.active svg',
				],
			],
		];
		$this->controls['act_switch_border_color'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Border Color', 'wpv-bu' ),
			'type'     => 'color',
			'inline'   => true,
			'css'      => [
				[
					'property' => 'border-color',
					'selector' => '.bultr-cs-switcher-wrapper .bultr-content-switch-button.active',
				],
			],
			'required' => [ 'layout', '=', 'layout_1' ],
		];

		$this->controls['act_switch_bg_color'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'     => 'color',
			'inline'   => true,
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-cs-switcher-wrapper .bultr-content-switch-button.active:before',
				],
			],
			'required' => [ 'layout', '=', 'layout_1' ],
		];
		
		$this->controls['act_box_shadow'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Box shadow', 'wpv-bu' ),
			'type'     => 'box-shadow',
			'css'      => [
				[
					'property' => 'box-shadow',
					'selector' => '.bultr-cs-switcher-wrapper .bultr-content-switch-button.active',
				],
			],
			'required' => [ 'layout', '=', 'layout_1' ],
		];

		$this->controls['active_end_sep'] = [
			'tab'   => 'content',
			'group' => $display_group,
			'type'  => 'separator',
		];

		$this->controls['icon_space'] = [
			'tab'     => 'content',
			'group'   => $display_group,
			'label'   => esc_html__( 'Icon Space', 'wpv-bu' ),
			'type'    => 'number',
			'default' => 10,
			'unit'    => 'px',
			'css'     => [
				[
					'property' => 'margin-left',
					'selector' => '.bultr-cs-switch-container .bultr-cs-icon-align-right i',
				],
				[
					'property' => 'margin-right',
					'selector' => '.bultr-cs-switch-container .bultr-cs-icon-align-left i',
				],
				[
					'property' => 'margin-left',
					'selector' => '.bultr-cs-switch-container .bultr-cs-icon-align-right svg',
				],
				[
					'property' => 'margin-right',
					'selector' => '.bultr-cs-switch-container .bultr-cs-icon-align-left svg',
				],
			],
		];

		$this->controls['label_space']    = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Label Space', 'wpv-bu' ),
			'type'     => 'number',
			'default'  => 30,
			'unit'     => 'px',
			'css'      => [
				[
					'property' => 'margin-right',
					'selector' => '.bultr-cs-switch-container .bultr-content-switch-label.primary-label',
				],
				[
					'property' => 'margin-left',
					'selector' => '.bultr-cs-switch-container .bultr-content-switch-label.secondary-label',
				],
			],
			'required' => [ 'layout', '!=', 'layout_1' ],
		];
		$this->controls['button_padding'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Padding', 'wpv-bu' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.bultr-cs-switcher-wrapper .bultr-content-switch-button',
				],
			],
			'required' => [ 'layout', '=', 'layout_1' ],
		];
		$this->controls['button_margin']  = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Spacing', 'wpv-bu' ),
			'type'     => 'number',
			'default'  => '10',
			'unit'     => 'px',
			'css'      => [
				[
					'property' => 'gap',
					'selector' => '.bultr-cs-wrapper.bultr-cs-layout_1 .bultr-cs-switcher-wrapper',
				],
			],
			'required' => [ 'layout', '=', 'layout_1' ],
		];

		$this->controls['enable_button_width'] = [
			'tab'     => 'content',
			'group'   => $display_group,
			'label'   => esc_html__( 'Equal Width', 'wpv-bu' ),
			'type'    => 'checkbox',
			'inline'  => true,
			'small'   => true,
			'default' => true, // Default: false
		];

		$this->controls['button_width'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Min Width', 'wpv-bu' ),
			'type'     => 'number',
			'unit'     => 'px',
			'css'      => [
				[
					'property' => 'min-width',
					'selector' => '.bultr-cs-wrapper.bultr-eql-btn .bultr-cs-switcher-wrapper .bultr-content-switch-button',
				],
			],
			'default'  => 150,
			'required' => [
				[ 'layout', '=', 'layout_1' ],
				[ 'enable_button_width', '=', true ],
			],
		];

		$this->controls['box_sep'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Box', 'wpv-bu' ),
			'type'     => 'separator',
			'required' => [ 'layout', '=', 'layout_1' ],
		];

		$this->controls['box_color'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Box Color', 'wpv-bu' ),
			'type'     => 'color',
			'inline'   => true,
			'default'  => [ 'hex' => '#54595f' ],
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-cs-layout_1 .bultr-cs-switcher-wrapper',
				],
			],
			'required' => [ 'layout', '=', 'layout_1' ],
		];

		$this->controls['box_padding'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Padding', 'wpv-bu' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.bultr-cs-layout_1 .bultr-cs-switcher-wrapper',
				],
			],
			'required' => [ 'layout', '=', 'layout_1' ],
		];

		$this->controls['box_border'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Border', 'wpv-bu' ),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.bultr-cs-layout_1 .bultr-cs-switcher-wrapper',
				],
			],
			'required' => [ 'layout', '=', 'layout_1' ],
		];
	}

	public function switch_bar_style_controls() {
		$display_group                        = 'switch_bar';
		$this->controls['switch_bar_padding'] = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-cs-wrapper .bultr-cs-switch-container',
				],
			],
		];
		$this->controls['switch_bar_bg']      = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Background', 'wpv-bu' ),
			'type'  => 'background',
			'css'   => [
				[
					'property' => 'background',
					'selector' => '.bultr-cs-wrapper .bultr-cs-switch-container',
				],
			],
		];
		$this->controls['switch_bar_border']  = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Border', 'wpv-bu' ),
			'type'  => 'border',
			'css'   => [
				[
					'property' => 'border',
					'selector' => '.bultr-cs-wrapper .bultr-cs-switch-container',
				],
			],
		];
		$this->controls['switch_bar_shadow']  = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Box Shadow', 'wpv-bu' ),
			'type'  => 'box-shadow',
			'css'   => [
				[
					'property' => 'box-shadow',
					'selector' => '.bultr-cs-wrapper .bultr-cs-switch-container',
				],
			],
		];
	}

	public function switcher_style_controls() {
		$display_group                             = 'switcher_style';
		$this->controls['hand_border_size']        = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Handler Border Size', 'wpv-bu' ),
			'type'     => 'number',
			'unit'     => 'px',
			'css'      => [
				[
					'property' => 'border-width',
					'selector' => '.bultr-cs-wrapper.bultr-cs-layout_2 .bultr-cs-switcher-wrapper .bultr-content-toggle-switcher:before',
				],
			],
			'required' => [ 'layout', '=', 'layout_2' ],
		];
		$this->controls['slider_border_size']      = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Slider Border Size', 'wpv-bu' ),
			'type'     => 'number',
			'unit'     => 'px',
			'css'      => [
				[
					'property' => 'border-width',
					'selector' => '.bultr-cs-wrapper.bultr-cs-layout_2 .bultr-cs-switcher-wrapper .bultr-content-toggle-switcher',
				],
			],
			'required' => [ 'layout', '=', 'layout_2' ],
		];
		$this->controls['switch_nrml_style']       = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Normal', 'wpv-bu' ),
			'type'  => 'separator',
		];
		$this->controls['handle_color']            = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__( 'Handle Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-cs-wrapper .bultr-cs-switcher-wrapper .bultr-content-toggle-switcher:before',
				],
			],
		];
		$this->controls['handle_border_color']     = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Handle Border Color', 'wpv-bu' ),
			'type'     => 'color',
			'inline'   => true,
			'css'      => [
				[
					'property' => 'border-color',
					'selector' => '.bultr-cs-wrapper.bultr-cs-layout_2 .bultr-cs-switcher-wrapper .bultr-content-toggle-switcher:before',
				],
			],
			'required' => [ 'layout', '=', 'layout_2' ],
		];
		$this->controls['slider_color']            = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__( 'Slider Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-cs-wrapper .bultr-cs-switcher-wrapper .bultr-content-toggle-switcher',
				],
			],
		];
		$this->controls['slider_border_color']     = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Slider Border Color', 'wpv-bu' ),
			'type'     => 'color',
			'inline'   => true,
			'css'      => [
				[
					'property' => 'border-color',
					'selector' => '.bultr-cs-wrapper.bultr-cs-layout_2 .bultr-cs-switcher-wrapper .bultr-content-toggle-switcher',
				],
			],
			'required' => [ 'layout', '=', 'layout_2' ],
		];
		$this->controls['switch_act_style']        = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Active', 'wpv-bu' ),
			'type'  => 'separator',
		];
		$this->controls['handle_color_act']        = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__( 'Handle Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-cs-wrapper .bultr-cs-switcher-wrapper .bultr-content-toggle-switch:checked + .bultr-content-toggle-switcher:before',
				],
			],
		];
		$this->controls['handle_border_color_act'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Handle Border Color', 'wpv-bu' ),
			'type'     => 'color',
			'inline'   => true,
			'css'      => [
				[
					'property' => 'border-color',
					'selector' => '.bultr-cs-wrapper.bultr-cs-layout_2 .bultr-cs-switcher-wrapper .bultr-content-toggle-switch:checked + .bultr-content-toggle-switcher:before',
				],
			],
			'required' => [ 'layout', '=', 'layout_2' ],
		];
		$this->controls['slider_color_act']        = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__( 'Slider Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-cs-wrapper .bultr-cs-switcher-wrapper .bultr-content-toggle-switch:checked + .bultr-content-toggle-switcher',
				],
			],
		];
		$this->controls['slider_border_color_act'] = [
			'tab'      => 'content',
			'group'    => $display_group,
			'label'    => esc_html__( 'Slider Border Color', 'wpv-bu' ),
			'type'     => 'color',
			'inline'   => true,
			'css'      => [
				[
					'property' => 'border-color',
					'selector' => '.bultr-cs-wrapper.bultr-cs-layout_2 .bultr-cs-switcher-wrapper .bultr-content-toggle-switch:checked + .bultr-content-toggle-switcher',
				],
			],
			'required' => [ 'layout', '=', 'layout_2' ],
		];
	}

	public function content_style_controls() {
		$display_group                        = 'content_style';
		$this->controls['content_padding']    = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-cs-wrapper .bultr-cs-content-wrapper',
				],
			],
		];
		$this->controls['content_typo']       = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Typography', 'wpv-bu' ),
			'type'  => 'typography',
			'css'   => [
				[
					'property' => 'typography',
					'selector' => '.bultr-cs-wrapper .bultr-cs-content-wrapper .bultr-cs-content-section',
				],
			],
		];
		$this->controls['content_background'] = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Background', 'wpv-bu' ),
			'type'  => 'background',
			'css'   => [
				[
					'property' => 'background',
					'selector' => '.bultr-cs-wrapper .bultr-cs-content-wrapper',
				],
			],
		];
		$this->controls['cs_content_align']   = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Text Align', 'wpv-bu' ),
			'type'  => 'text-align',
			'css'   => [
				[
					'property' => 'text-align',
					'selector' => '.bultr-cs-wrapper .bultr-cs-content-wrapper',
				],
			],
		];
		$this->controls['content_border']     = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Border', 'wpv-bu' ),
			'type'  => 'border',
			'css'   => [
				[
					'property' => 'border',
					'selector' => '.bultr-cs-wrapper  .bultr-cs-content-wrapper',
				],
			],
		];
		$this->controls['content_box_shadow'] = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Box Shadow', 'wpv-bu' ),
			'type'  => 'box-shadow',
			'css'   => [
				[
					'property' => 'box-shadow',
					'selector' => '.bultr-cs-wrapper .bultr-cs-content-wrapper',
				],
			],
		];
	}
	public function enqueue_scripts() {
		wp_enqueue_style( 'bultr-module-style' );
		wp_enqueue_script( 'bultr-module-script' );
	}

	public function get_active_section( $items ) {
		$active_sec_data = [];

		foreach ( $items as $index => $item ) {
			if ( isset( $item['active'] ) && $item['active'] === true ) {
				$active_sec_data['index_no'] = $index + 1;
			}
		}
		return $active_sec_data;
	}

	public function render() {
		$settings = $this->settings;
		
		$switcher_items = $settings['content_items'];
		$index          = $this->loop_index;
		$active_index   = [];
		if ( ! isset( $settings['layout'] ) ) {
			$layout = 'layout_1';
		} else {
			$layout = $settings['layout'];
		}
		// Query
		if ( isset( $settings['hasLoop'] ) ) {
			$query = new Query(
				[
					'id'       => $this->id,
					'settings' => $settings,
				]
			);
		} else {
			$active_index = $this->get_active_section( $switcher_items );
			if ( empty( $active_index ) ) {
				$active_index['index_no'] = 1;
			}
		}

		$this->set_attribute( 'switcher-container', 'class', 'bultr-cs-switch-container' );
		$this->set_attribute( 'switcher-wrapper', 'class', 'bultr-cs-wrapper' );
		$this->set_attribute( 'switcher-wrapper', 'class', 'bultr-cs-' . $layout );
		if ( isset( $settings['enable_button_width'] ) && $layout === 'layout_1' ) {
			$this->set_attribute( 'switcher-wrapper', 'class', 'bultr-eql-btn' );
		}
		?>
		<div <?php echo $this->render_attributes( '_root' ); ?>>
			<div <?php echo $this->render_attributes( 'switcher-wrapper' ); ?>>
				<div <?php echo $this->render_attributes( 'switcher-container' ); ?>>
					<div class="bultr-cs-switcher-wrapper">
						<?php
						if ( isset( $settings['hasLoop'] ) ) {
							$active_index['index_no'] = 1;
							$switcher_item            = $switcher_items[0];
							if ( $settings['layout'] === 'layout_1' ) {
								$query->render( [ $this, 'render_switcher_button' ], compact( 'switcher_item', 'active_index' ) );
							} else {
								$query->render( [ $this, 'render_switcher' ], compact( 'switcher_item', 'active_index' ) );
							}
						} else {
							foreach ( $switcher_items as $index => $switcher_item ) {
								if ( $settings['layout'] === 'layout_1' ) {
									self::render_switcher_button( $switcher_item, $active_index );
								} else {
									self::render_switcher( $switcher_item, $active_index );
								}
							}
						}
						?>
					</div>
				</div>
					<div class="bultr-cs-content-wrapper">
					<?php
					if ( isset( $settings['hasLoop'] ) ) {
						$active_index['index_no'] = 1;
						$switcher_item            = $switcher_items[0];
						$query->render( [ $this, 'render_switcher_content' ], compact( 'settings', 'switcher_item', 'active_index' ) );
					} else {
						foreach ( $switcher_items as $index => $switcher_item ) {
							self::render_switcher_content( $settings, $switcher_item, $active_index );
						}
					}
					?>
					</div>
				<?php
				if ( isset( $settings['hasLoop'] ) ) {
					$query->destroy();
					unset( $query );
				}
				?>
			</div>
		</div>
		<?php
	}

	public function render_switcher_button( $item, $active_index ) {
		
		$is_active_item = false;
		$index          = $this->loop_index;
		if ( $index === $active_index['index_no'] ) {
			$is_active_item = true;
		}

		$this->set_attribute( "label-wrapper-{$index}", 'class', [ 'bultr-cs-label-wrapper', 'repater-item' ] );
		$this->set_attribute( "switch-button-{$index}", 'href', '#' );
		$this->set_attribute( "switch-button-{$index}", 'class', 'bultr-content-switch-button' );
		if ( $is_active_item ) {
			$this->set_attribute( "switch-button-{$index}", 'class', 'active' );
		}
		$this->set_attribute( "switch-label-{$index}", 'class', 'bultr-content-switch-label' );
		$this->set_attribute( "switch-button-{$index}", 'data-id', $index );
		if ( ! empty( $item['item_icon'] ) ) {
			$icon     = $item['item_icon'];
			$icon_pos = $item['item_icon_position'] ?? 'left';
		}
		if ( isset( $item['item_icon_position'] ) && ! empty( $item['item_icon'] ) ) {
			$this->set_attribute( "switch-button-{$index}", 'class', 'bultr-cs-icon-align-' . $icon_pos );
		}
		?>
			<a <?php echo $this->render_attributes( "switch-button-{$index}" ); ?>>
					<?php
					if ( ! empty( $item['item_icon'] ) && $icon_pos === 'left' ) {
						$icon = ! empty( $icon ) ? self::render_icon( $icon ) : false;
						echo $icon;
					}
					?>
					<span><?php echo $this->render_dynamic_data( $item['item_title'] ); ?></span>
					<?php
					if ( ! empty( $item['item_icon'] ) && $icon_pos === 'right' ) {
						$icon = ! empty( $icon ) ? self::render_icon( $icon ) : false;
								echo $icon;
					}
					?>
			</a>
		<?php
		$this->loop_index++;
	}

	public function render_switcher( $item, $active_index ) {
		$index = $this->loop_index;
		if ( $index > 2 ) {
			return;
		}

		$is_active_item = false;
		$add_checked    = '';
		if ( $index === $active_index['index_no'] ) {
			$is_active_item = true;
		}
		if ( $active_index['index_no'] > 1 ) {
			$add_checked = 'checked';
		}
		$this->set_attribute( "switch-label-{$index}", 'class', 'bultr-content-switch-label' );
		if ( $index === 1 ) {
			$this->set_attribute( "switch-label-{$index}", 'class', 'primary-label' );
		} else {
			$this->set_attribute( "switch-label-{$index}", 'class', 'secondary-label' );
		}
		if ( ! empty( $item['item_icon'] ) ) {
			$icon     = $item['item_icon'];
			$icon_pos = $item['item_icon_position'] ?? 'left';

			$this->set_attribute( "switch-label-{$index}", 'class', 'bultr-cs-icon-align-' . $icon_pos );
		}
		if ( $is_active_item ) {
			$this->set_attribute( "switch-label-{$index}", 'class', 'active' );
		}
		$this->set_attribute( "switch-label-{$index}", 'data-id', $index );
		?>
		<div <?php echo $this->render_attributes( "switch-label-{$index}" ); ?>>
			<?php
			if ( ! empty( $item['item_icon'] ) && $icon_pos === 'left' ) {
				$icon = ! empty( $icon ) ? self::render_icon( $icon ) : false;
				echo $icon;
			}
			?>
			<h5 class="bultr-cs-label"><?php echo $this->render_dynamic_data( $item['item_title'] ); ?></h5>
			<?php
			if ( ! empty( $item['item_icon'] ) && $icon_pos === 'right' ) {
				$icon = ! empty( $icon ) ? self::render_icon( $icon ) : false;
				echo $icon;
			}
			?>
		</div>
		<?php
		if ( $index === 1 ) {
			?>
				<div class="bultr-cs-switch-button">
					<label class="bultr-cs-switch-label">
						<input class="bultr-content-toggle-switch" type="checkbox" <?php echo $add_checked; ?>>
						<span class="bultr-content-toggle-switcher"></span>
					</label>
				</div>
			<?php
		}
		$this->loop_index++;
	}

	public function render_switcher_content( $settings, $item, $active_index ) {
		$is_active_item = false;
		$index          = $this->loop_index_content;

		if ( $settings['layout'] !== 'layout_1' && $index > 2 ) {
			return;
		}
		if ( $index === $active_index['index_no'] ) {
			$is_active_item = true;
		}

		$this->set_attribute( "item-content-{$index}", 'class', [ 'bultr-cs-content-section', 'bultr-content-' . $item['item_content_type'] ] );
		if ( $item['item_content_type'] === 'template' && isset( $item['template_content'] ) ) {
			$this->set_attribute( "item-content-{$index}", 'template_id', $item['template_content'] );
		}
		$this->set_attribute( "item-content-{$index}", 'data-id', $index );
		if ( $is_active_item ) {
			$this->set_attribute( "item-content-{$index}", 'class', 'active' );
		}
		?>
		<div <?php echo $this->render_attributes( "item-content-{$index}" ); ?>>
		<?php
		if ( $item['item_content_type'] === 'template' && isset( $item['template_content'] ) ) {
			$template_id = intval( $item['template_content'] );
			if ( $template_id === $this->post_id || $template_id === get_the_ID() ) {
				return;
			} else {
				$template = Theme::$instance->templates;
				echo $template->render_shortcode(
					[
						'id' => $template_id,
					]
				);
			}
		} else {
			
				echo $this->render_dynamic_data( $item['editor_content'] );
			
		}
		?>
		</div>
		<?php
		$this->loop_index_content++;
	}
}
