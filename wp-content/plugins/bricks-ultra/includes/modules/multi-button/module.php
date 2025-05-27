<?php
namespace BricksUltra\Modules\MultiButton;

use Bricks\Breakpoints;
use Bricks\Element;

class Module extends Element {

	public $category     = 'ultra';
	public $name         = 'wpvbu-multi-button';
	public $icon         = 'ti-layout-menu-separated';
	public $css_selector = '';
	public $scripts      = [ 'MultiButtons' ];
	public $loop_index   = 0;

	// Methods: Builder-specific
	public function get_label() {
		return esc_html__( 'Multi Buttons', 'wpv-bu' );
	}

	// Enqueue element styles and scripts
	public function enqueue_scripts() {
		wp_enqueue_style( 'bultr-module-style' );
		wp_enqueue_script( 'bultr-module-script' );
	}
	public function set_control_groups() {

		$this->control_groups['buttons'] = [
			'title' => esc_html__( 'Buttons', 'wpv-bu' ),
			'tab'   => 'content',
		];

		$this->control_groups['layout'] = [
			'title' => esc_html__( 'Layout', 'wpv-bu' ),
			'tab'   => 'content',
		];

		$this->control_groups['general_style'] = [
			'title' => esc_html__( 'General Styles', 'wpv-bu' ),
			'tab'   => 'content',
		];

		$this->control_groups['btn_global_style'] = [
			'title' => esc_html__( 'Buttons Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['sept_style']       = [
			'title' => esc_html__( 'Separator Styles', 'wpv-bu' ),
			'tab'   => 'content',
		];
	}
	public function set_controls() {
		// Layout Controls
		$this->layout_controls();

		// Buttons Repeater
		$this->button_repeater_control();

		// General Style Controls
		$this->general_style_controls();

		// Buttons Global Style Controls
		$this->btn_global_style_controls();

		// Separator Style Controls
		$this->sept_style_controls();
	}

	public function layout_controls() {
		$display_group = 'layout';

		$this->controls['button_layout'] = [
			'label'       => esc_html__( 'Layout', 'wpv-bu' ),
			'group'       => $display_group,
			'type'        => 'direction',
			'inline'      => true,
			'exclude'     => [ 'reverse' ],
			'breakpoints' => true,
			'css'         => [
				[
					'property' => 'flex-direction',
					'selector' => '.bultr-btn-layout-horizontal .bultr-multi-button-wrapper',
					'required' => 'row',
				],
				[
					'property' => 'flex-direction',
					'selector' => '.bultr-btn-layout-vertical .bultr-multi-button-wrapper',
					'required' => 'column',
				],
				
			],
		];
		$this->controls['typeInfo'] = [
			'tab' => 'content',
			'group'      => $display_group,
			'content' => esc_html__( 'Reverse Option is not Supported in Layouts.', 'wpv-bu' ),
			'type' => 'info',
			 ];
		$this->controls['layout_align'] = [
			'tab'     => 'content',
			'group'   => $display_group,
			'label'   => esc_html__( 'Align', 'wpv-bu' ),
			'type'    => 'justify-content',
			'css'     => [
				[
					'property' => 'justify-content',
					'selector' => '.bultr-multi-button-container',
				],
			],
			'exclude' => 'space',
		];
	}

	public function button_repeater_control() {
		$display_group                  = 'buttons';
		$this->controls['button_items'] = [
			'tab'           => 'content',
			'group'         => $display_group,
			'type'          => 'repeater',
			'titleProperty' => 'button_text',
			'default'       => [
				[
					'button_text'     => 'Button 1',
					'button_icon'     => [
						'library' => 'themify',
						'icon'    => 'ti-arrow-left',
					],
					'button_icon_pos' => 'left',
					'animation_style' => 'animate-none',
					'sept_icon'       => [
						'library' => 'themify',
						'icon'    => 'ti-star',
					],
				],
				[
					'button_text'     => 'Button 2',
					'button_icon'     => [
						'library' => 'themify',
						'icon'    => 'ti-arrow-right',
					],
					'button_icon_pos' => 'right',
					'animation_style' => 'animate-none',
				],
			],
			'fields'        => [
				'button_text' => [
					'label'  => esc_html__( 'Text', 'wpv-bu' ),
					'group'  => $display_group,
					'type'   => 'text',
					'inline' => true,
				],
				'button_link' => [
					'label'  => esc_html__( 'Link', 'wpv-bu' ),
					'group'  => $display_group,
					'type'   => 'link',
					'inline' => true,
				],
				'button_icon' => [
					'tab'     => 'content',
					'group'   => $display_group,
					'label'   => esc_html__( 'Icon', 'wpv-bu' ),
					'type'    => 'icon',
					'default' => [
						'library' => 'themify',
						'icon'    => 'ti-angle-left',
					],
				],
				'button_icon_pos' => [
					'label'     => esc_html__( 'Icon Position', 'wpv-bu' ),
					'group'     => $display_group,
					'type'      => 'select',
					'options'   => [
						'left'  => 'Left',
						'right' => 'Right',
					],
					'clearable' => false,
					'inline'    => true,
					'default'   => 'left',
				],
				'button_icon_size' => [
					'tab'   => 'content',
					'group' => $display_group,
					'label' => esc_html__( 'Icon Size (px)', 'wpv-bu' ),
					'type'  => 'number',
					'unit'  => 'px',
					'css'   => [
						[
							'property' => 'font-size',
							'selector' => '.bultr-mb-button i',
						],
						[
							'property' => 'font-size',
							'selector' => '.bultr-mb-button svg',
						],
					],
				],
				'sept_icon' => [
					'tab'     => 'content',
					'group'   => $display_group,
					'label'   => esc_html__( 'Separator Icon', 'wpv-bu' ),
					'type'    => 'icon',
					'default' => [
						'library' => 'themify',
						'icon'    => 'ti-angle-left',
					],
				],
				'sept_text' => [
					'label'  => esc_html__( 'Separator Text', 'wpv-bu' ),
					'group'  => $display_group,
					'type'   => 'text',
					'inline' => true,
				],
				'button_css_id' => [
					'tab'   => 'content',
					'group' => $display_group,
					'label' => esc_html__( 'CSS ID', 'wpv-bu' ),
					'type'  => 'text',
				],
				'button_css_class' => [
					'tab'   => 'content',
					'group' => $display_group,
					'label' => esc_html__( 'CSS Class', 'wpv-bu' ),
					'type'  => 'text',
				],
				'button_custom_style' => [
					'tab'     => 'content',
					'group'   => $display_group,
					'label'   => esc_html__( 'Custom Style', 'wpv-bu' ),
					'type'    => 'checkbox',
					'default' => false,
				],
				'animation_style'     => [
					'label'     => esc_html__( 'Animation Style', 'wpv-bu' ),
					'group'     => $display_group,
					'type'      => 'select',
					'options'   => $this->get_animation_styles(),
					'clearable' => false,
					'inline'    => false,
					'default'   => 'bultr-swipe-left',
					'required'  => [ 'button_custom_style', '!=', '' ],
				],
				'btn_typo' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Typography', 'wpv-bu' ),
					'type'     => 'typography',
					'css'      => [
						[
							'property' => 'typography',
							'selector' => '.bultr-custom-style.bultr-mb-button',
						],
					],
					'exclude'  => [ 'color', 'text-align' ],
					'required' => [ 'button_custom_style', '!=', '' ],
				],
				'btn_sep' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Normal', 'wpv-bu' ),
					'type'     => 'separator',
					'required' => [ 'button_custom_style', '!=', '' ],
				],
				'btn_color' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Text Color', 'wpv-bu' ),
					'type'     => 'color',
					'inline'   => true,
					'css'      => [
						[
							'property' => 'color',
							'selector' => '.bultr-custom-style.bultr-mb-button',
						],
					],
					'required' => [ 'button_custom_style', '!=', '' ],
				],
				'btn_icon_color' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Icon Color', 'wpv-bu' ),
					'type'     => 'color',
					'inline'   => true,
					'css'      => [
						[
							'property' => 'color',
							'selector' => '.bultr-custom-style.bultr-mb-button i',
						],
						[
							'property' => 'fill',
							'selector' => '.bultr-custom-style.bultr-mb-button svg',
						],
					],
					'required' => [ 'button_custom_style', '!=', '' ],
				],
				'btn_bg' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Background', 'wpv-bu' ),
					'type'     => 'background',
					'inline'   => true,
					'css'      => [
						[
							'property' => 'background',
							'selector' => '.bultr-custom-style.bultr-mb-button',
						],
						[
							'property' => 'background',
							'selector' => '.bultr-custom-style.bultr-slide-out-half.bultr-mb-button::after',
						],
						[
							'property' => 'background',
							'selector' => '.bultr-custom-style.bultr-slide-out-half.bultr-mb-button::before',
						],
					],
					'required' => [ 'button_custom_style', '!=', '' ],
				],
				'btn_hvr_sep' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Hover', 'wpv-bu' ),
					'type'     => 'separator',
					'required' => [ 'button_custom_style', '!=', '' ],
				],
				'btn_color_hvr' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Text Color', 'wpv-bu' ),
					'type'     => 'color',
					'inline'   => true,
					'css'      => [
						[
							'property' => 'color',
							'selector' => '.bultr-custom-style.bultr-mb-button:hover',
						],
					],
					'required' => [ 'button_custom_style', '!=', '' ],
				],
				'btn_icon_color_hvr' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Icon Color', 'wpv-bu' ),
					'type'     => 'color',
					'inline'   => true,
					'css'      => [
						[
							'property' => 'color',
							'selector' => '.bultr-custom-style.bultr-mb-button:hover i',
						],
						[
							'property' => 'fill',
							'selector' => '.bultr-custom-style.bultr-mb-button:hover svg',
						],
					],
					'required' => [ 'button_custom_style', '!=', '' ],
				],
				'btn_bg_hvr' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Background', 'wpv-bu' ),
					'type'     => 'background',
					'inline'   => true,
					'css'      => [
						[
							'property' => 'background',
							'selector' => '.bultr-custom-style.bultr-mb-button:hover::before',
						],
						[
							'property' => 'background',
							'selector' => '.bultr-custom-style.bultr-mb-button::before',
						],
						[
							'property' => 'background',
							'selector' => '.bultr-custom-style.bultr-slide-out-half.bultr-mb-button',
						],
						[
							'property' => 'background',
							'selector' => '.bultr-custom-style.bultr-slide-out-half.bultr-mb-button',
						],
					],
					'required' => [ 'button_custom_style', '!=', '' ],
				],
				'btn_hvr_end' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'type'     => 'separator',
					'required' => [ 'button_custom_style', '!=', '' ],
				],
				'btn_border' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Border', 'wpv-bu' ),
					'type'     => 'border',
					'css'      => [
						[
							'property' => 'border',
							'selector' => '.bultr-custom-style.bultr-mb-button',
						],
					],
					'required' => [ 'button_custom_style', '!=', '' ],
				],
				'btn_padding' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Padding', 'wpv-bu' ),
					'type'     => 'dimensions',
					'css'      => [
						[
							'property' => 'padding',
							'selector' => '.bultr-custom-style.bultr-mb-button',
						],
					],
					'required' => [ 'button_custom_style', '!=', '' ],
				],

				'button_shadow' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Box Shadow', 'wpv-bu' ),
					'type'     => 'box-shadow',
					'css'      => [
						[
							'property' => 'box-shadow',
							'selector' => '.bultr-custom-style.bultr-mb-button',
						],
					],
					'required' => [ 'button_custom_style', '!=', '' ],
				],
				'button_transform' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Transform', 'wpv-bu' ),
					'type'     => 'transform',
					'css'      => [
						[
							'property' => 'transform',
							'selector' => '.bultr-custom-style.bultr-mb-button',
						],
					],
					'exclude'  => [ 'translateX', 'translateY', 'scaleX', 'scaleY', 'rotateX', 'rotateY', 'rotateZ' ],
					'required' => [ 'button_custom_style', '!=', '' ],
				],
				'sept_sep' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Separator', 'wpv-bu' ),
					'type'     => 'separator',
					'required' => [ 'button_custom_style', '!=', '' ],
				],
				'sept_size' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Size (px)', 'wpv-bu' ),
					'type'     => 'number',
					'unit'     => 'px',
					'css'      => [
						[
							'property' => 'height',
							'selector' => '.bultr-custom-style + .bultr-mb-button-separator',
						],
						[
							'property' => 'width',
							'selector' => '.bultr-custom-style + .bultr-mb-button-separator',
						],
						[
							'property' => 'right',
							'selector' => '.bultr-custom-style + .bultr-mb-button-separator',
							'value'    => 'calc(-%s/2)',
						],
					],
					'required' => [ 'button_custom_style', '!=', '' ],
				],
				'sept_icon_size' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Font Size (px)', 'wpv-bu' ),
					'type'     => 'number',
					'unit'     => 'px',
					'css'      => [
						[
							'property' => 'font-size',
							'selector' => '.bultr-custom-style + .bultr-mb-button-separator',
						],
						[
							'property' => 'height',
							'selector' => '.bultr-custom-style + .bultr-mb-button-separator svg',
						],
					],
					'required' => [ 'button_custom_style', '!=', '' ],
				],
				'sept_color' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Color', 'wpv-bu' ),
					'type'     => 'color',
					'inline'   => true,
					'css'      => [
						[
							'property' => 'color',
							'selector' => '.bultr-custom-style + .bultr-mb-button-separator',
						],
					],
					'required' => [ 'button_custom_style', '!=', '' ],
				],
				'sept_bg_clr' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Background Color', 'wpv-bu' ),
					'type'     => 'color',
					'inline'   => true,
					'css'      => [
						[
							'property' => 'background-color',
							'selector' => '.bultr-custom-style + .bultr-mb-button-separator',
						],
					],
					'required' => [ 'button_custom_style', '!=', '' ],
				],
				'sept_border' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Border', 'wpv-bu' ),
					'type'     => 'border',
					'inline'   => true,
					'css'      => [
						[
							'property' => 'border',
							'selector' => '.bultr-custom-style + .bultr-mb-button-separator',
						],
					],
					'required' => [ 'button_custom_style', '!=', '' ],
				],
				'sept_box_shadow' => [
					'tab'      => 'content',
					'group'    => $display_group,
					'label'    => esc_html__( 'Box Shadow', 'wpv-bu' ),
					'type'     => 'box-shadow',
					'inline'   => true,
					'css'      => [
						[
							'property' => 'box-shadow',
							'selector' => '.bultr-custom-style + .bultr-mb-button-separator',
						],
					],
					'required' => [ 'button_custom_style', '!=', '' ],
				],
			],
		];
	}

	public function separator_controls() {
		$display_group = 'separator';

		$this->controls['sept_g_icon'] = [
			'tab'     => 'content',
			'group'   => $display_group,
			'label'   => esc_html__( 'Icon', 'wpv-bu' ),
			'type'    => 'icon',
			'default' => [
				'library' => 'themify',
				'icon'    => 'ti-angle-left',
			],
		];
		$this->controls['sept_g_text'] = [
			'label'  => esc_html__( 'Text', 'wpv-bu' ),
			'group'  => $display_group,
			'type'   => 'text',
			'inline' => true,
		];
	}

	public function general_style_controls() {
		$display_group                    = 'general_style';
		$this->controls['anim_style']     = [
			'label'     => esc_html__( 'Animation Style', 'wpv-bu' ),
			'group'     => $display_group,
			'type'      => 'select',
			'inline'    => false,
			'options'   => $this->get_animation_styles(),
			'clearable' => false,
			'default'   => 'bultr-swipe-left',
		];
		$this->controls['button_spacing'] = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Spacing (px)', 'wpv-bu' ),
			'type'  => 'number',
			'unit'  => 'px',
			'css'   => [
				[
					'property' => 'margin-right',
					'selector' => '.bultr-btn-layout-horizontal .bultr-mb-button-wrapper:NOT(:last-child) .bultr-mb-button',
				],
				[
					'property' => 'margin-left',
					'selector' => '.bultr-btn-layout-horizontal .bultr-mb-button-wrapper:NOT(:first-child) .bultr-mb-button',
				],
				[
					'property' => 'margin-bottom',
					'selector' => '.bultr-btn-layout-vertical .bultr-mb-button-wrapper:NOT(:last-child) .bultr-mb-button',
				],
				[
					'property' => 'margin-top',
					'selector' => '.bultr-btn-layout-vertical .bultr-mb-button-wrapper:NOT(:first-child) .bultr-mb-button',
				],
			],
		];
		$this->controls['box_padding']   = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-multi-button-container .bultr-multi-button-wrapper',
				],
			],
		];
		$this->controls['box_color']     = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-multi-button-wrapper',
				],
			],
		];
		$this->controls['box_border']    = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Box Border', 'wpv-bu' ),
			'type'  => 'border',
			'css'   => [
				[
					'property' => 'border',
					'selector' => '.bultr-multi-button-wrapper',
				],
			],
		];
		$this->controls['box_shadow']    = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Box shadow', 'wpv-bu' ),
			'type'  => 'box-shadow',
			'css'   => [
				[
					'property' => 'box-shadow',
					'selector' => '.bultr-multi-button-wrapper',
				],
			],
		];
		$this->controls['box_transform'] = [
			'tab'     => 'content',
			'group'   => $display_group,
			'label'   => esc_html__( 'Box Transform', 'wpv-bu' ),
			'type'    => 'transform',
			'css'     => [
				[
					'property' => 'transform',
					'selector' => '.bultr-multi-button-wrapper',
				],
			],
			'exclude' => [ 'translateX', 'translateY', 'scaleX', 'scaleY', 'rotateX', 'rotateY', 'rotateZ' ],
		];
	}

	public function get_animation_styles() {
		$animations = [
			'animate-none'         => 'None',
			'bultr-swipe-right'    => 'Swipe Right',
			'bultr-swipe-left'     => 'Swipe Left',
			'bultr-swipe-bottom'   => 'Swipe Bottom',
			'bultr-swipe-top'      => 'Swipe Top',
			'bultr-bounce-top'     => 'Bounce Top',
			'bultr-bounce-right'   => 'Bounce Right',
			'bultr-bounce-bottom'  => 'Bounce Bottom',
			'bultr-bounce-left'    => 'Bounce Left',
			'bultr-slide-out'      => 'Slide Out',
			'bultr-slide-out-half' => 'Slide Half',
		];
		return $animations;
	}
	public function btn_global_style_controls() {
		$display_group                = 'btn_global_style';
		$this->controls['btn_g_typo'] = [
			'tab'     => 'content',
			'group'   => $display_group,
			'label'   => esc_html__( 'Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-mb-button',
				],
			],
			'exclude' => [ 'color', 'text-align' ],
		];

		$this->controls['btn_g_sep']        = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Normal', 'wpv-bu' ),
			'type'  => 'separator',
		];
		$this->controls['btn_g_color']      = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__( 'Text Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-mb-button',
				],
			],
		];
		$this->controls['btn_g_icon_color'] = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__( 'Icon Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-mb-button i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-mb-button svg',
				],
			],
		];
		$this->controls['btn_g_icon_gap']=[
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Icon Gap', 'wpv-bu' ),
			'type'  => 'number',
			'units'  => true,
			'css'   => [
				[
					'property' => 'gap',
					'selector' => '.bultr-mb-button',
				],
				
			],

		];
		$this->controls['btn_g_bg']         = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__( 'Background', 'wpv-bu' ),
			'type'   => 'background',
			'inline' => true,
			'css'    => [
				[
					'property' => 'background',
					'selector' => '.bultr-mb-button',
				],
				[
					'property' => 'background',
					'selector' => '.bultr-slide-out-half.bultr-mb-button::after',
				],
				[
					'property' => 'background',
					'selector' => '.bultr-slide-out-half.bultr-mb-button::before',
				],
			],
		];

		$this->controls['btn_g_hvr_sep']        = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Hover', 'wpv-bu' ),
			'type'  => 'separator',
		];
		$this->controls['btn_g_color_hvr']      = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__( 'Text Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-mb-button:hover',
				],
			],
		];
		$this->controls['btn_g_icon_color_hvr'] = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__( 'Icon Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-mb-button:hover i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-mb-button:hover svg',
				],
			],
		];
		$this->controls['btn_g_bg_hvr']         = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__( 'Background', 'wpv-bu' ),
			'type'   => 'background',
			'inline' => true,
			'css'    => [
				[
					'property' => 'background',
					'selector' => '.bultr-mb-button:hover::before',
				],
				[
					'property' => 'background',
					'selector' => '.bultr-mb-button::before',
				],
				[
					'property' => 'background',
					'selector' => '.bultr-slide-out-half.bultr-mb-button',
				],
				[
					'property' => 'background',
					'selector' => '.bultr-slide-out-half.bultr-mb-button',
				],
				[
					'property' => 'background',
					'selector' => '.animate-none.bultr-mb-button:hover',
				],
			],
		];
		$this->controls['btn_g_hvr_end']        = [
			'tab'   => 'content',
			'group' => $display_group,
			'type'  => 'separator',
		];
		$this->controls['btn_g_border']         = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Border', 'wpv-bu' ),
			'type'  => 'border',
			'css'   => [
				[
					'property' => 'border',
					'selector' => '.bultr-mb-button',
				],
			],
		];
		$this->controls['btn_g_padding']        = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-mb-button',
				],
			],
		];

		$this->controls['button_g_shadow']    = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Box shadow', 'wpv-bu' ),
			'type'  => 'box-shadow',
			'css'   => [
				[
					'property' => 'box-shadow',
					'selector' => '.bultr-mb-button',
				],
			],
		];
		$this->controls['button_g_transform'] = [
			'tab'     => 'content',
			'group'   => $display_group,
			'label'   => esc_html__( 'Box Transform', 'wpv-bu' ),
			'type'    => 'transform',
			'css'     => [
				[
					'property' => 'transform',
					'selector' => '.bultr-mb-button',
				],
			],
			'exclude' => [ 'translateX', 'translateY', 'scaleX', 'scaleY', 'rotateX', 'rotateY', 'rotateZ' ],
		];
	}

	public function sept_style_controls() {
		$display_group = 'sept_style';

		$this->controls['sept_size']       = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Size (px)', 'wpv-bu' ),
			'type'  => 'number',
			'unit'  => 'px',
			'css'   => [
				[
					'property' => 'height',
					'selector' => '.bultr-mb-button-separator',
				],
				[
					'property' => 'width',
					'selector' => '.bultr-mb-button-separator',
				],
				[
					'property' => 'right',
					'selector' => '.bultr-mb-button-separator',
					'value'    => 'calc(-%s/2)',
				],
			],
		];
		$this->controls['sept_icon_size']  = [
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Font Size (px)', 'wpv-bu' ),
			'type'  => 'number',
			'unit'  => 'px',
			'css'   => [
				[
					'property' => 'font-size',
					'selector' => '.bultr-mb-button-separator i',
				],
				[
					'property' => 'height',
					'selector' => '.bultr-mb-button-separator svg',
				],
				[
					'property' => 'font-size',
					'selector' => '.bultr-mb-button-separator',
				],
			],
		];
		$this->controls['sept_gap']		=[
			'tab'   => 'content',
			'group' => $display_group,
			'label' => esc_html__( 'Gap', 'wpv-bu' ),
			'type'  => 'number',
			'units'  => true,
			'css'   => [
				[
					'property' => 'gap',
					'selector' => '.bultr-mb-button-separator',
				],
			],
			'default'	=> '3px',
		];
		$this->controls['sept_color']      = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__( 'Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-mb-button-separator',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-mb-button-separator svg',
				],
			],
		];
		$this->controls['sept_bg_clr']     = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-mb-button-separator',
				],
			],
		];
		$this->controls['sept_border']     = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__( 'Border', 'wpv-bu' ),
			'type'   => 'border',
			'inline' => true,
			'css'    => [
				[
					'property' => 'border',
					'selector' => '.bultr-mb-button-separator',
				],
			],
		];
		$this->controls['sept_box_shadow'] = [
			'tab'    => 'content',
			'group'  => $display_group,
			'label'  => esc_html__( 'Box Shadow', 'wpv-bu' ),
			'type'   => 'box-shadow',
			'inline' => true,
			'css'    => [
				[
					'property' => 'box-shadow',
					'selector' => '.bultr-mb-button-separator',
				],
			],
		];
	}

	public function render() {
		$settings      = $this->settings;
		$button_items  = $settings['button_items'] ?? [];
		$button_layout = $settings['button_layout'] ?? 'horizontal';
		if ( $button_layout === 'column' ) {
			$button_layout = 'vertical';
		} else {
			$button_layout = 'horizontal';
		}
		$this->set_attribute( 'mb-container', 'class', 'bultr-multi-button-container' );
		$this->set_attribute( 'mb-container', 'class', ' bultr-btn-layout-' . $button_layout );

		$breakpoints_data = Breakpoints::get_breakpoints();
		$breakpoints_len  = count( $breakpoints_data );
		$layouts          = [];
		$default_value    = $settings['button_layout'] ?? 'horizontal';
		for ( $i = 0; $i < $breakpoints_len; $i++ ) {
			if ( isset( $settings[ 'button_layout:' . $breakpoints_data[ $i ]['key'] ] ) ) {
				$index         = $i;
				$default_value = $settings[ 'button_layout:' . $breakpoints_data[ $i ]['key'] ];
			}
			$layouts[ $breakpoints_data[ $i ]['key'] ] = $settings[ 'button_layout:' . $breakpoints_data[ $i ]['key'] ] ?? $default_value;
		}

		$this->set_attribute( 'mb-container', 'data-settings', wp_json_encode( $layouts ) );
		?>
		<div <?php echo $this->render_attributes( '_root' ); ?>>
			<div <?php echo $this->render_attributes( 'mb-container' ); ?>>
				<div class="bultr-multi-button-wrapper">
					<?php
					foreach ( $button_items as $index => $button ) {
						self::render_button( $button, $settings );
					}
					?>
				</div>
			</div>
		</div>
			<?php
	}

	public function render_button( $item, $settings ) {
		$index          = $this->loop_index;
		$button_text    = $item['button_text'] ?? false;
		$button_icon    = $item['button_icon'] ?? false;
		$icon_postition = $item['button_icon_pos'] ?? 'left';

		$this->set_attribute( "button-wrap-{$index}", 'class', 'bultr-mb-button-wrapper' );
		$this->set_attribute( "button-wrap-{$index}", 'class', 'repeater-item' );

		if ( isset( $item['button_css_id'] ) ) {
			$this->set_attribute( "button-{$index}", 'id', $item['button_css_id'] );
		}
		if ( isset( $item['button_css_class'] ) ) {
			$this->set_attribute( "button-{$index}", 'class', $item['button_css_class'] );
		}
		if ( isset( $item['button_custom_style'] ) ) {
			$this->set_attribute( "button-{$index}", 'class', 'bultr-custom-style' );
			$animation_style = $item['animation_style'] ?? 'bultr-swipe-right';
			if ( $animation_style ) {
				if ( $animation_style !== 'animate-none' ) {
					$this->set_attribute( "button-{$index}", 'class', 'bultr-mb-animate' );
				}
				$this->set_attribute( "button-{$index}", 'class', $animation_style );
			} else {
				$this->set_attribute( "button-{$index}", 'class', 'animate-none' );
			}
		} else {
			$anim_style = $settings['anim_style'] ?? 'bultr-swipe-right';
			if ( $anim_style !== 'animate-none' ) {
				$this->set_attribute( "button-{$index}", 'class', 'bultr-mb-animate' );
			} else {
				$this->set_attribute( "button-{$index}", 'class', 'animate-none' );
			}
			$this->set_attribute( "button-{$index}", 'class', $anim_style );
		}

		$this->set_attribute( "button-{$index}", 'class', 'bultr-mb-button' );
		$this->set_attribute( "button-{$index}", 'class', 'bultr-background-primary' );
		$this->set_attribute( "button-{$index}", 'class', 'bultr-icon-' . $icon_postition );
		if ( isset( $item['button_link'] ) ) {
			$this->set_link_attributes( "button-{$index}", $item['button_link'] );
		}
		?>
		<div <?php echo $this->render_attributes( "button-wrap-{$index}" ); ?>>
			<a <?php echo $this->render_attributes( "button-{$index}" ); ?> >
				<?php
				if ( $button_icon ) {
					echo self::render_icon( $button_icon );
				}
				if ( $button_text ) {
					echo $this->render_dynamic_data( $item['button_text'] );
				}
				?>
			</a>
			<?php
			if ( ( isset( $item['sept_icon'] ) && $item['sept_icon']['library'] !== '' ) || isset( $item['sept_text'] ) ) {
				echo '<div class="bultr-mb-button-separator">';
				echo $item['sept_text'] ?? '';
				if ( isset( $item['sept_icon'] ) ) {
					echo self::render_icon( $item['sept_icon'] );
				}
				echo '</div>';
			}
			?>
		</div>
		<?php
		$this->loop_index++;
	}
}
