<?php
namespace BricksUltra\includes\AlertBox;

use Bricks\Element;
use Bricks\Breakpoints;
use BricksUltra\includes\Helper;
use Bricks\Helpers;
use BricksUltra\Plugin;
class Module extends Element {
	public $category     = 'ultra';
	public $name         = 'wpvbu-alert-box';
	public $icon         = 'ion-md-alert';
	public $css_selector = '';
	public $scripts      = [ 'alertBox' ];
	public $loop_index   = 0;
	public function get_label() {
		return esc_html__( 'Message Box', 'wpv-bu' );
	}
	public function get_keywords() {
		return [ 'box', 'message-box', 'alert', 'info-box' ];
	}

	public function set_control_groups() {
		$this->control_groups['alert_content'] = [
			'title' => esc_html__( 'Content', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['cta']           = [
			'title'    => esc_html__( 'CTA', 'wpv-bu' ),
			'tab'      => 'content',
			'required' => [
				[ 'enable_cta', '=', true ],
			],
		];
		$this->control_groups['title_style']   = [
			'title' => esc_html__( 'Title Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['desc_style']    = [
			'title' => esc_html__( 'Description Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['cta_style']     = [
			'title'    => esc_html__( 'CTA Style', 'wpv-bu' ),
			'tab'      => 'content',
			'required' => [
				[ 'enable_cta', '=', true ],
			],
		];
		$this->control_groups['icon_style']    = [
			'title' => esc_html__( 'Icon Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['close_style']   = [
			'title' => esc_html__( 'Close Icon Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['box_style']     = [
			'title' => esc_html__( 'Box Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
	}
	public function set_controls() {

		$this->controls['title'] = [
			'tab'     => 'content',
			'group'   => 'alert_content',
			'label'   => __( 'Title', 'wpv-bu' ),
			'type'    => 'text',
			'default' => 'Warning Title !',
		];

		$this->controls['title_tag'] = [
			'tab'         => 'content',
			'group'       => 'alert_content',
			'label'       => esc_html__( 'Tag', 'wpv-bu' ),
			'type'        => 'select',
			'options'     => [
				'h1' => 'h1',
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
			],
			'inline'      => true,
			'clearable'   => false,
			'placeholder' => 'h3',
		];

		$this->controls['description'] = [
			'tab'     => 'content',
			'group'   => 'alert_content',
			'label'   => __( 'Description', 'wpv-bu' ),
			'type'    => 'editor',
			'default' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid pariatur, ipsum similique veniam',
		];

		$this->controls['main_icon'] = [
			'tab'     => 'content',
			'group'   => 'alert_content',
			'label'   => esc_html__( 'Alert Icon', 'wpv-bu' ),
			'type'    => 'icon',
			'css'     => [
				[
					'selector' => '&.icon-svg', // NOTE: Undocumented: & = no space (add to element root)
				],
			],
			'default' => [
				'library' => 'fontawesomeSolid',
				'icon'    => 'fas fa-exclamation-triangle',
			],
		];

		$this->controls['alert_icon_position'] = [
			'tab'      => 'content',
			'group'    => 'alert_content',
			'label'    => esc_html__( 'Alert Icon Position', 'wpv-bu' ),
			'type'     => 'direction',
			'inline'   => true,
			'default'  => 'row',
			'required' => [
				[ 'main_icon', '!=', '' ],
			],
			'css'      => [
				[
					'property' => 'flex-direction',
					'selector' => '.bultr-alert-box.bultr-alert-icon-pos-row',
					'required' => 'row',
				],
				[
					'property' => 'flex-direction',
					'selector' => '.bultr-alert-box.bultr-alert-icon-pos-column',
					'required' => 'column',
				],
			],
		];


		$this->controls['typeInfo'] = [
			'tab' => 'content',
			'group'    => 'alert_content',
			'content' => esc_html__( 'Reverse Option is not Supported in Layouts.', 'wpv-bu' ),
			'type' => 'info',
			 ];

		$this->controls['alert_icon_gap'] = [
			'tab'         => 'content',
			'group'       => 'alert_content',
			'label'       => esc_html__( 'Gap', 'wpv-bu' ),
			'type'        => 'number',
			'min'         => 0,
			'unit'        => 'px',
			'step'        => '1', // Default: 1
			'inline'      => true,
			'default'     => '12',
			'required'    => [
				[ 'alert_icon_position', '=', 'row' ],
			],
			'css'         => [
				[
					'property' => 'gap',
					'selector' => '.bultr-alert-box.bultr-alert-icon-pos-row',
				],
			],
			'description' => esc_html__( 'Add Gap Between Icon and Content', 'wpv-bu' ),
		];

		$this->controls['content_gap'] = [
			'tab'     => 'content',
			'group'   => 'alert_content',
			'label'   => esc_html__( 'Content Gap', 'wpv-bu' ),
			'type'    => 'number',
			'min'     => 0,
			'unit'    => 'px',
			'step'    => '1', // Default: 1
			'inline'  => true,
			'default' => '7',
			'css'     => [
				[
					'property' => 'gap',
					'selector' => '.bultr-alert-box:not(.bultr-alert-icon-pos-row)',
				],
				[
					'property' => 'gap',
					'selector' => '.bultr-alert-content-wrapper',
				],
				[
					'property' => 'gap',
					'selector' => '.bultr-alert-content',
				],
			],
		];

		$this->controls['dismissible'] = [
			'tab'     => 'content',
			'group'   => 'alert_content',
			'label'   => esc_html__( 'Is Dismissible', 'wpv-bu' ),
			'type'    => 'checkbox',
			'inline'  => true,
			'small'   => true,
			'default' => true,
		];

		$this->controls['close_icon'] = [
			'tab'      => 'content',
			'group'    => 'alert_content',
			'label'    => esc_html__( 'Close Icon', 'wpv-bu' ),
			'type'     => 'icon',
			'css'      => [
				[
					'selector' => '&.icon-svg', // NOTE: Undocumented: & = no space (add to element root)
				],
			],
			'default'  => [
				'library' => 'fontawesomeRegular',
				'icon'    => 'fa fa-circle-xmark',
			],
			'required' => [
				[ 'dismissible', '=', true ],
			],
		];

		$this->controls['enable_cta'] = [
			'tab'     => 'content',
			'group'   => 'alert_content',
			'label'   => esc_html__( 'Enable CTA', 'wpv-bu' ),
			'type'    => 'checkbox',
			'inline'  => true,
			'small'   => true,
			'default' => true,
		];

		$this->controls['cta_position'] = [ // Setting key
			'tab'     => 'content',
			'group'   => 'cta',
			'inline'  => true,
			'label'   => esc_html__( 'Position', 'wpv-bu' ),
			'type'    => 'direction',
			'css'     => [
				[
					'property' => 'flex-direction',
					'selector' => '.bultr-alert-content-wrapper',
				],
				[
					'property'  => 'flex-grow',
					'selector'  => '.bultr-alert-content-wrapper .bultr-alert-content',
					'value'     => '1',
					'important' => true,
					'required'  => 'row',
				],
				[
					'property' => 'justify-content',
					'selector' => '.bultr-alert-content-wrapper',
					'value'    => 'space-between',
					'required' => 'row',
				],

			],
			'default' => 'column',
		];

		$this->controls['cta_layout'] = [ // Setting key
			'tab'     => 'content',
			'group'   => 'cta',
			'inline'  => true,
			'label'   => esc_html__( 'Layout', 'wpv-bu' ),
			'type'    => 'direction',
			'css'     => [
				[
					'property' => 'flex-direction',
					'selector' => '.bultr-cta-wrapper',
				],
				[
					'property' => 'display',
					'selector' => '.bultr-cta-wrapper',
					'value'    => 'flex',
				],
			],
			'default' => 'row',
		];

		$this->controls['cta_align'] = [
			'tab'      => 'content',
			'group'    => 'cta',
			'label'    => esc_html__( 'Align', 'wpv-bu' ),
			'type'     => 'align-items',
			'exclude'  => 'stretch',
			'css'      => [
				[
					'property' => 'align-self',
					'selector' => '.bultr-cta-wrapper',
					'required' => 'column',
				],
				[
					'property' => 'justify-content',
					'selector' => '.bultr-cta-wrapper',
					'required' => 'row',
				],
			],
			'inline'   => true,
			'default'  => 'flex-start',
			'required' => [
				[ 'enable_cta', '=', true ],
			],

		];

		$this->controls['buttons'] = [
			'tab'           => 'content',
			'group'         => 'cta',
			'label'         => esc_html__( 'Button', 'wpv-bu' ),
			'type'          => 'repeater',
			'titleProperty' => 'link_title',
			'default'       => [
				[
					'link_title'    => 'Learn More',
					'link_icon'     => [
						'library' => 'themify',
						'icon'    => 'ti-arrow-right',
					],
					'link_action'   => 'link',
					'icon_position' => 'right',
					'minutes'       => '90',
					'link'          => [
						'type' => 'external',
						'url'  => '#',
					],
				],
			],
			'fields'        => [
				'link_title' => [
					'tab'    => 'content',
					'group'  => 'cta',
					'label'  => __( 'Title', 'wpv-bu' ),
					'type'   => 'text',
					'inline' => true,
				],

				'link_icon' => [
					'label' => esc_html__( 'Icon', 'wpv-bu' ),
					'type'  => 'icon',
					'css'   => [
						[
							'selector' => '&.icon-svg', // NOTE: Undocumented: & = no space (add to element root)
						],
					],
				],

				'icon_position' => [
					'label'       => esc_html__( 'Icon Position', 'wpv-bu' ),
					'type'        => 'select',
					'options'     => [
						'left'  => 'Left',
						'right' => 'Right',
					],
					'inline'      => true,
					'placeholder' => esc_html__( 'Select', 'wpv-bu' ),
					'clearable'   => false,
					'default'     => 'left',
				],

				'link_action' => [
					'label'       => esc_html__( 'Action', 'wpv-bu' ),
					'type'        => 'select',
					'options'     => [
						'link'    => 'Link',
						'defer'   => 'Defer',
						'dismiss' => 'Dismiss',
					],
					'inline'      => true,
					'placeholder' => esc_html__( 'Select', 'wpv-bu' ),
					'clearable'   => false,
					'default'     => 'link',
					'multiple'    => true,
				],

				'minutes' => [
					'label'       => esc_html__( 'Expiration time', 'wpv-bu' ),
					'type'        => 'text',
					'inline'      => true,
					'default'     => '1',
					'placeholder' => 'Enter Minutes',
					'description' => 'Leave Blank if don\'t want to show it again',
					'required'    => [
						[ 'link_action', '=', 'defer' ],
					],
				],

				'link' => [
					'label'       => esc_html__( 'Link', 'wpv-bu' ),
					'type'        => 'link',
					'pasteStyles' => false,
					'placeholder' => esc_html__( 'http://yoursite.com', 'wpv-bu' ),
					'required'    => [
						[ 'link_action', '=', 'link' ],
					],
				],

				'button_color' => [
					'label'  => esc_html__( 'Color', 'wpv-bu' ),
					'type'   => 'color',
					'group'  => 'cta_style',
					'inline' => true,
					'css'    => [
						[
							'property' => 'color',
						],
						[
							'selector' => 'i',
							'property' => 'color',
						],
						[
							'selector' => 'svg',
							'property' => 'fill',
						],
					],
				],

				'button_bg_color' => [
					'label'  => esc_html__( 'Background Color', 'wpv-bu' ),
					'type'   => 'color',
					'inline' => true,
					'css'    => [
						[
							'property' => 'background-color',
						],
					],
				],

				'button_typo' => [
					'label'   => esc_html__( 'Typography', 'wpv-bu' ),
					'type'    => 'typography',
					'css'     => [
						[
							'property' => 'typography',
						],
					],
					'default' => [
						'font-size'   => '15px',
						'font-weight' => 500,
						'line-height' => 1,
					],
					'inline'  => true,
					'exclude' => [
						'color',
						'text-align',
					],
				],

				'icon_size'	=>[
					'label'   => esc_html__( 'Icon Size', 'wpv-bu' ),
					'type'    => 'number',
					'unit'    => 'px',
					'inline'  => true,
					'css'     => [
						[
							'selector' => 'i',
							'property' => 'font-size',
						],
						[
							'selector' => 'svg',
							'property' => 'font-size',
						],
						[
							'selector' => 'svg',
							'property' => 'height',
						],
					],
					'default' => '15',
				],

				'button_border' => [
					'label'  => esc_html__( 'Border', 'wpv-bu' ),
					'type'   => 'border',
					'css'    => [
						[
							'property' => 'border',
						],
					],
					'inline' => true,
					'small'  => true,
				],

				'button_icon_spacing' => [
					'label'  => esc_html__( 'Icon Spacing', 'wpv-bu' ),
					'type'   => 'number',
					'unit'   => 'px',
					'inline' => true,
					'css'    => [
						[
							'property' => 'gap',
						],
					],
				],

				'link_padding' => [
					'tab'   => 'content',
					'group' => 'cta_style',
					'label' => esc_html__( 'Padding', 'wpv-bu' ),
					'type'  => 'dimensions',
					'css'   => [
						[
							'property' => 'padding',
						],
					],
				],

			],
			'required'      => [
				[ 'enable_cta', '=', true ],
			],
		];

		$this->controls['title_color'] = [
			'tab'    => 'content',
			'label'  => esc_html__( 'Color', 'wpv-bu' ),
			'type'   => 'color',
			'group'  => 'title_style',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-alert-title',
				],
			],
		];

		$this->controls['title_bg_color'] = [
			'tab'    => 'content',
			'group'  => 'title_style',
			'label'  => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-alert-title',
				],
			],
		];

		$this->controls['title_typo'] = [
			'tab'     => 'content',
			'group'   => 'title_style',
			'label'   => esc_html__( 'Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-alert-title',
				],
			],
			'default' => [
				'font-size'   => '16px',
				'font-weight' => 600,
				'line-height' => '20px',
			],
			'inline'  => true,
			'exclude' => [
				'color',
			],
		];

		$this->controls['title_border'] = [
			'tab'    => 'content',
			'group'  => 'title_style',
			'label'  => esc_html__( 'Border', 'wpv-bu' ),
			'type'   => 'border',
			'css'    => [
				[
					'property' => 'border',
					'selector' => '.bultr-alert-title',
				],
			],
			'inline' => true,
			'small'  => true,
		];

		$this->controls['title_padding'] = [
			'tab'   => 'content',
			'group' => 'title_style',
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-alert-title',
				],
			],
		];

		$this->controls['title_box_shadow'] = [
			'tab'    => 'content',
			'group'  => 'title_style',
			'label'  => esc_html__( 'BoxShadow', 'wpv-bu' ),
			'type'   => 'box-shadow',
			'css'    => [
				[
					'property' => 'box-shadow',
					'selector' => '.bultr-alert-title',
				],
			],
			'inline' => true,
			'small'  => true,
		];

		$this->controls['desc_color'] = [
			'tab'      => 'content',
			'label'    => esc_html__( 'Color', 'wpv-bu' ),
			'type'     => 'color',
			'group'    => 'desc_style',
			'inline'   => true,
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.bultr-alert-desc',
				],
			],
			'required' => [
				[ 'description', '!=', '' ],
			],
		];

		$this->controls['desc_bg_color'] = [
			'tab'      => 'content',
			'group'    => 'desc_style',
			'label'    => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'     => 'color',
			'inline'   => true,
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-alert-desc',
				],
			],
			'required' => [
				[ 'description', '!=', '' ],
			],
		];

		$this->controls['desc_typo'] = [
			'tab'      => 'content',
			'group'    => 'desc_style',
			'label'    => esc_html__( 'Typography', 'wpv-bu' ),
			'type'     => 'typography',
			'css'      => [
				[
					'property' => 'typography',
					'selector' => '.bultr-alert-desc',
				],
			],
			'default'  => [
				'font-size'   => '13px',
				'font-weight' => 400,
				'line-height' => '21px',
			],
			'inline'   => true,
			'exclude'  => [
				'color',
			],
			'required' => [
				[ 'description', '!=', '' ],
			],
		];

		$this->controls['desc_padding'] = [
			'tab'      => 'content',
			'group'    => 'desc_style',
			'label'    => esc_html__( 'Padding', 'wpv-bu' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.bultr-alert-desc',
				],
			],
			'required' => [
				[ 'description', '!=', '' ],
			],
		];

		$this->controls['link_color'] = [
			'tab'    => 'content',
			'label'  => esc_html__( 'Color', 'wpv-bu' ),
			'type'   => 'color',
			'group'  => 'cta_style',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-alert-button',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-alert-button i',
				],
			],
		];

		$this->controls['link_bg_color'] = [
			'tab'    => 'content',
			'group'  => 'cta_style',
			'label'  => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-alert-button',
				],
			],
		];

		$this->controls['link_typo'] = [
			'tab'     => 'content',
			'group'   => 'cta_style',
			'label'   => esc_html__( 'Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-alert-button',
				],
			],
			'default' => [
				'font-size'      => '13px',
				'font-weight'    => 600,
				'line-height'    => 1,
				'text-transform' => 'uppercase',
			],
			'inline'  => true,
			'exclude' => [
				'color',
				'text-align',
			],
		];

		$this->controls['link_align'] = [
			'tab'     => 'content',
			'group'   => 'cta_style',
			'label'   => esc_html__( 'Text Align', 'wpv-bu' ),
			'type'    => 'justify-content',
			'css'     => [
				[
					'property' => 'justify-content',
					'selector' => '.bultr-alert-button',
				],
			],
			'exclude' => [ 'space' ],
		];

		$this->controls['link_gap'] = [
			'tab'     => 'content',
			'group'   => 'cta_style',
			'label'   => esc_html__( 'Gap', 'wpv-bu' ),
			'type'    => 'number',
			'unit'    => 'px',
			'inline'  => true,
			'default' => 5,
			'css'     => [
				[
					'selector' => '.bultr-cta-wrapper',
					'property' => 'gap',
				],
			],
		];

		$this->controls['link_icon_spacing'] = [
			'tab'     => 'content',
			'group'   => 'cta_style',
			'label'   => esc_html__( 'Icon Spacing', 'wpv-bu' ),
			'type'    => 'number',
			'unit'    => 'px',
			'inline'  => true,
			'css'     => [
				[
					'selector' => '.bultr-alert-button',
					'property' => 'gap',
				],
			],
			'default' => '8',
		];

		$this->controls['link_border'] = [
			'tab'    => 'content',
			'group'  => 'cta_style',
			'label'  => esc_html__( 'Border', 'wpv-bu' ),
			'type'   => 'border',
			'css'    => [
				[
					'property' => 'border',
					'selector' => '.bultr-alert-button',
				],
			],
			'inline' => true,
			'small'  => true,
		];

		$this->controls['link_padding'] = [
			'tab'   => 'content',
			'group' => 'cta_style',
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-alert-button',
				],
			],
		];

		$this->controls['link_box_shadow'] = [
			'tab'    => 'content',
			'group'  => 'cta_style',
			'label'  => esc_html__( 'BoxShadow', 'wpv-bu' ),
			'type'   => 'box-shadow',
			'css'    => [
				[
					'property' => 'box-shadow',
					'selector' => '.bultr-alert-button',
				],
			],
			'inline' => true,
			'small'  => true,
		];

		$this->controls['icon_size'] = [
			'tab'     => 'content',
			'group'   => 'icon_style',
			'label'   => esc_html__( 'Size', 'wpv-bu' ),
			'type'    => 'number',
			'unit'    => 'px',
			'inline'  => true,
			'css'     => [
				[
					'selector' => '.bultr-alert-icon i',
					'property' => 'font-size',
				],
				[
					'selector' => '.bultr-alert-icon svg',
					'property' => 'font-size',
				],
			],
			'default' => '20',
		];

		$this->controls['icon_color'] = [
			'tab'    => 'content',
			'label'  => esc_html__( 'Color', 'wpv-bu' ),
			'type'   => 'color',
			'group'  => 'icon_style',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-alert-icon i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-alert-icon svg',
				],
			],
		];

		$this->controls['icon_bg_color'] = [
			'tab'    => 'content',
			'group'  => 'icon_style',
			'label'  => esc_html__( 'Background', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'css'    => [
				[
					'property' => 'background',
					'selector' => '.bultr-alert-icon',
				],
			],
		];

		$this->controls['icon_align'] = [
			'tab'     => 'content',
			'group'   => 'icon_style',
			'label'   => esc_html__( 'Align', 'wpv-bu' ),
			'type'    => 'align-items',
			'exclude' => 'stretch',
			'css'     => [
				[
					'property' => 'align-self',
					'selector' => '.bultr-alert-icon',
				],
			],
			'default' => 'flex-start',
			'inline'  => true,
		];

		$this->controls['icon_border'] = [
			'tab'    => 'content',
			'group'  => 'icon_style',
			'label'  => esc_html__( 'Border', 'wpv-bu' ),
			'type'   => 'border',
			'css'    => [
				[
					'property' => 'border',
					'selector' => '.bultr-alert-icon',
				],
			],
			'inline' => true,
			'small'  => true,
		];

		$this->controls['icon_padding'] = [
			'tab'   => 'content',
			'group' => 'icon_style',
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-alert-icon',
				],
			],
		];

		$this->controls['icon_box_shadow'] = [
			'tab'    => 'content',
			'group'  => 'icon_style',
			'label'  => esc_html__( 'BoxShadow', 'wpv-bu' ),
			'type'   => 'box-shadow',
			'css'    => [
				[
					'property' => 'box-shadow',
					'selector' => '.bultr-alert-icon',
				],
			],
			'inline' => true,
			'small'  => true,
		];

		$this->controls['close_icon_size'] = [
			'tab'     => 'content',
			'group'   => 'close_style',
			'label'   => esc_html__( 'Size', 'wpv-bu' ),
			'type'    => 'number',
			'unit'    => 'px',
			'inline'  => true,
			'css'     => [
				[
					'selector' => '.bultr-dismiss-content i',
					'property' => 'font-size',
				],
				[
					'selector' => '.bultr-dismiss-content svg',
					'property' => 'font-size',
				],
			],
			'default' => 20,
		];

		$this->controls['close_top_position'] = [
			'tab'     => 'content',
			'group'   => 'close_style',
			'label'   => esc_html__( 'Top(%)', 'wpv-bu' ),
			'type'    => 'number',
			'unit'    => '%',
			'inline'  => true,
			'css'     => [
				[
					'selector' => '.bultr-dismiss-content',
					'property' => 'top',
				],
				[
					'selector' => '.bultr-dismiss-content',
					'property' => 'transform',
					'value'    => 'translateY(-%s)',
				],
			],
			'default' => '20',
		];

		$this->controls['close_right_position'] = [
			'tab'     => 'content',
			'group'   => 'close_style',
			'label'   => esc_html__( 'Right(Px)', 'wpv-bu' ),
			'type'    => 'number',
			'unit'    => 'px',
			'inline'  => true,
			'css'     => [
				[
					'selector' => '.bultr-dismiss-content',
					'property' => 'right',
				],
			],
			'default' => '20',
		];

		$this->controls['close_icon_color'] = [
			'tab'    => 'content',
			'label'  => esc_html__( 'Color', 'wpv-bu' ),
			'type'   => 'color',
			'group'  => 'close_style',
			'inline' => true,
			'css'    => [
				[
					'property' => 'color',
					'selector' => '.bultr-dismiss-content i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-dismiss-content svg',
				],
			],
		];

		$this->controls['box_padding'] = [
			'tab'     => 'content',
			'group'   => 'box_style',
			'label'   => esc_html__( 'Padding', 'wpv-bu' ),
			'type'    => 'dimensions',
			'css'     => [
				[
					'property' => 'padding',
					'selector' => '.bultr-alert-box',
				],
			],
			'default' => [
				'top'    => '25',
				'right'  => '25',
				'bottom' => '25',
				'left'   => '25',
			],
		];

		$this->controls['box_background_type'] = [
			'tab'         => 'content',
			'group'       => 'box_style',
			'label'       => esc_html__( 'Background Type', 'wpv-bu' ),
			'type'        => 'select',
			'options'     => [
				'color'    => 'Color',
				'gradient' => 'Gradient',
			],
			'inline'      => true,
			'placeholder' => esc_html__( 'Select tag', 'wpv-bu' ),
			'clearable'   => false,
			'default'     => 'color',
		];

		$this->controls['box_bg_color'] = [ // Setting key
			'tab'      => 'content',
			'group'    => 'box_style',
			'label'    => esc_html__( 'Background', 'wpv-bu' ),
			'type'     => 'background',
			'css'      => [
				[
					'property' => 'background',
					'selector' => '.bultr-bg-color.bultr-alert-box',
				],
			],
			'exclude'  => [
				'videoUrl',
				'videoScale',
			],
			'inline'   => true,
			'small'    => true,
			'required' => [
				[ 'box_background_type', '=', 'color' ],
			],
		];

		$this->controls['box_bg_gradient'] = [
			'tab'      => 'content',
			'group'    => 'box_style',
			'label'    => esc_html__( 'Gradient', 'wpv-bu' ),
			'type'     => 'gradient',
			'css'      => [
				[
					'selector' => '.bultr-bg-gradient.bultr-alert-box',
					'property' => 'background-image',
				],
			],
			'required' => [
				[ 'box_background_type', '=', 'gradient' ],
			],
			'rerender' => true,
		];

		$this->controls['box_border'] = [
			'tab'     => 'content',
			'group'   => 'box_style',
			'label'   => esc_html__( 'Border', 'wpv-bu' ),
			'type'    => 'border',
			'css'     => [
				[
					'property' => 'border',
					'selector' => '.bultr-alert-box',
				],
			],
			'default' => [
				'width'  => [
					'top'    => 1,
					'right'  => 1,
					'bottom' => 1,
					'left'   => 1,
				],
				'style'  => 'solid',
				'color'  => [
					'hex' => '#EAECF0',
				],
				'radius' => [
					'top'    => 10,
					'right'  => 10,
					'bottom' => 10,
					'left'   => 10,
				],
			],
			'inline'  => true,
			'small'   => true,
		];

		$this->controls['box_box_shadow'] = [
			'tab'    => 'content',
			'group'  => 'box_style',
			'label'  => esc_html__( 'BoxShadow', 'wpv-bu' ),
			'type'   => 'box-shadow',
			'css'    => [
				[
					'property' => 'box-shadow',
					'selector' => '.bultr-alert-box',
				],
			],
			'inline' => true,
			'small'  => true,
		];
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'bultr-module-style' );
		wp_enqueue_script( 'bultr-module-script' );
	}

	public function render() {
		$settings = $this->settings;
		$this->set_attribute( '_root', 'class', 'bultr-alert-element' );
		$this->set_attribute( 'box', 'class', 'bultr-alert-box' );
		$breakpoints_data = Breakpoints::get_breakpoints();
		$layouts         = [];
		$breakpoints_len = count( $breakpoints_data );
		$default_value   = 'row';
		$index           = '';
		$baseDevice      = Plugin::$buBaseDevice;
		if ( $baseDevice === 'desktop' ) {
			$default_value = $settings['alert_icon_position'] ?? $default_value;
		} else {
			$default_value = $settings[ 'alert_icon_position:' . $baseDevice ] ?? $default_value;
		}
		if ( isset( $settings['main_icon'] ) ) {
			for ( $i = 0; $i < $breakpoints_len; $i++ ) {
				if ( $breakpoints_data[ $i ]['key'] === 'desktop' ) {
					$layouts[ $breakpoints_data[ $i ]['key'] ] = $settings['alert_icon_position'] ?? $default_value;
				} else {
					$layouts[ $breakpoints_data[ $i ]['key'] ] = $settings[ 'alert_icon_position:' . $breakpoints_data[ $i ]['key'] ] ?? $default_value;
				}
			}
			$this->set_attribute( 'box', 'layouts', wp_json_encode( $layouts ) );
		}

		if ( isset( $settings['box_background_type'] ) ) {
			$this->set_attribute( 'box', 'class', 'bultr-bg-' . $settings['box_background_type'] );
		}
		if ( isset( $settings['dismissible'] ) ) {
			$this->set_attribute( 'box', 'class', 'bultr-alert-dismissible' );
			$this->set_attribute( 'box', 'dismissible', true );
		}
		
		?>
		<div <?php echo $this->render_attributes( '_root' ); ?>>
			<div <?php echo $this->render_attributes( 'box' ); ?>>
				<?php if ( isset( $settings['main_icon'] ) ) { ?>
					<div class="bultr-alert-icon-wrap">
						<div class="bultr-alert-icon">
						<?php
							
							$icon = ! empty( $settings['main_icon'] ) ? self::render_icon( $settings['main_icon'], '' ) : false;
							echo $icon
						?>
						</div>
					</div>
				<?php } ?>	
					<div class="bultr-alert-content-wrapper">
						<div class="bultr-alert-content">
						<?php
						if ( isset( $settings['title'] ) ) {
							$title_tag = $settings['title_tag'] ?? 'h3';
							echo sprintf( '<%1$s class="bultr-alert-title">%2$s</%1$s>', $title_tag, $settings['title'] );
							?>
							<?php } ?>	
							<?php if ( isset( $settings['description'] ) ) { ?>
								<div class="bultr-alert-desc"><?php echo $settings['description']; ?></div>
							<?php } ?>
						</div>	
							<?php if ( isset( $settings['enable_cta'] ) && ( isset( $settings['buttons'] ) && ! empty( $settings['buttons'] ) ) ) { ?>
								<div class="bultr-cta-wrapper">
								<?php
								foreach ( $settings['buttons'] as $button ) {
									if ( isset( $button['link_action'] ) ) {
										if ( ! isset( $button['id'] ) ) {
											$button['id'] = wp_rand( 999, 10000 );
										}
										$this->set_attribute( "alert-button-{$button['id']}", 'class', [ 'bultr-button', 'bultr-alert-button' ] );
										$this->set_attribute( "alert-button-{$button['id']}", 'class', 'repeater-item' );
										if ( isset( $button['icon_position'] ) ) {
											$this->set_attribute( "alert-button-{$button['id']}", 'class', 'bultr-button-icon-' . $button['icon_position'] );
										}
										$action = $button['link_action'];
										if ( empty( $settings['link'] ) ) {
											$this->tag = 'span';
										} else {
											$this->set_link_attributes( '_root', $settings['link'] );
										}
										if ( is_array( $action ) ) {
											$this->set_attribute( "alert-button-{$button['id']}", 'actions', implode( ',', $action ) );
											if ( in_array( 'link', $button['link_action'], true ) ) {
												$this->set_link_attributes( "alert-button-{$button['id']}", $button['link'] );
												$tag = 'a';
											} else {
												$tag = 'span';
											}

											if ( in_array( 'defer', $button['link_action'], true ) ) {
												$hours = $button['minutes'] ?? '0';
												$this->set_attribute( "alert-button-{$button['id']}", 'defer', $hours );
											}
										} else {
											$this->set_attribute( "alert-button-{$button['id']}", 'actions', $action );
											if ( $action === 'link' ) {
												$this->set_link_attributes( "alert-button-{$button['id']}", $button['link'] );
												$tag = 'a';
											} else {
												$hours = $button['minutes'] ?? '0';
												$this->set_attribute( "alert-button-{$button['id']}", 'defer', $hours );
											}
										}
										?>
											<<?php echo $tag; ?> <?php echo $this->render_attributes( "alert-button-{$button['id']}" ); ?>>
												<?php if ( ! empty( $button['link_icon'] ) && $button['icon_position'] === 'left' ) { ?>
															<?php
																$icon = ! empty( $button['link_icon'] ) ? self::render_icon( $button['link_icon'], '' ) : false;
																echo $icon
															?>
													<?php } ?>
													<?php echo $button['link_title']; ?>
													<?php if ( ! empty( $button['link_icon'] ) && $button['icon_position'] === 'right' ) { ?>
														<?php
															$icon = ! empty( $button['link_icon'] ) ? self::render_icon( $button['link_icon'], '' ) : false;
															echo $icon
														?>
													<?php } ?>
											</<?php echo $tag; ?>>
											<?php
									}
								}
								?>
								</div>	
							<?php } ?>				
					</div>
				<?php if ( isset( $settings['dismissible'] ) ) { ?>
					<div class="bultr-dismiss-content">
					<?php
						$close_icon = ! empty( $settings['close_icon'] ) ? self::render_icon( $settings['close_icon'], '' ) : false;
						echo $close_icon
					?>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php
	}

	public function render_cta_buttons( $settings ) {
		?>

		<div class="bu-alert-cta-wrapper">
			<?php
			foreach ( $settings['buttons'] as $button ) {
				if ( isset( $button['link_action'] ) ) {
					if ( ! isset( $button['id'] ) ) {
						$button['id'] = wp_rand( 999, 10000 );
					}

					$this->set_attribute( "alert-button-{$button['id']}", 'class', [ 'bu-button', 'bu-alert-button' ] );
					$this->set_attribute( "alert-button-{$button['id']}", 'class', 'repeater-item' );
					if ( isset( $button['icon_position'] ) ) {
						$this->set_attribute( "alert-button-{$button['id']}", 'class', 'bu-button-icon-' . $button['icon_position'] );
					}
					$action = $button['link_action'];
					if ( is_array( $action ) ) {
						$this->set_attribute( "alert-button-{$button['id']}", 'actions', implode( ',', $action ) );
						if ( in_array( 'link', $button['link_action'], true ) ) {
							$this->set_link_attributes( "alert-button-{$button['id']}", $button['link'] );
							$tag = 'a';
						} else {
							$tag = 'span';
						}

						if ( in_array( 'defer', $button['link_action'], true ) ) {
							$hours = $button['minutes'] ?? '0';
							$this->set_attribute( "alert-button-{$button['id']}", 'defer', $hours );
						}
					} else {
						$this->set_attribute( "alert-button-{$button['id']}", 'actions', $action );
						if ( $action === 'link' ) {
							$this->set_link_attributes( "alert-button-{$button['id']}", $button['link'] );
							$tag = 'a';
						} else {
							$hours = $button['minutes'] ?? '0';
							$this->set_attribute( "alert-button-{$button['id']}", 'defer', $hours );
						}
					}
				} else {
					continue;
				}
				?>
				<<?php echo $tag; ?> <?php echo $this->render_attributes( "alert-button-{$button['id']}" ); ?>>
					<span class="bu-button-content-wrapper">
						<?php if ( ! empty( $button['link_icon'] ) && $button['icon_position'] === 'left' ) { ?>
							<?php
								$icon = ! empty( $button['link_icon'] ) ? self::render_icon( $button['link_icon'], '' ) : false;
								echo $icon
							?>
						<?php } ?>
						<span class="bu-button-text"><?php echo $button['link_title']; ?></span>
						<?php if ( ! empty( $button['link_icon'] ) && $button['icon_position'] === 'right' ) { ?>
							<?php
								$icon = ! empty( $button['link_icon'] ) ? self::render_icon( $button['link_icon'], '' ) : false;
								echo $icon
							?>
						<?php } ?>
					</span>
				</<?php echo $tag; ?>>
				<?php
			}
			?>
		</div>
		<?php
	}

	public function render_cta( $settings ) {
		?>
			<div class="bultr-alert-cta-wrapper" >
			<?php if ( isset( $settings['primary_link_action'] ) && isset( $settings['enable_primary_link'] ) ) { ?>
				<?php
					$action = $settings['primary_link_action'];
					$this->set_attribute( 'alert-pri', 'class', [ 'bultr-button', 'bultr-alert-button-primary' ] );
					$this->set_attribute( 'alert-pri', 'actions', implode( ',', $action ) );
				if ( in_array( 'link', $settings['primary_link_action'], true ) ) {
					$this->set_link_attributes( 'alert-pri', $settings['primary_link'] );
					$tag = 'a';
				} else {
					$tag = 'span';
				}
				if ( in_array( 'defer', $settings['primary_link_action'], true ) ) {
					$hours = $settings['hours'] ?? '0';
					$this->set_attribute( 'alert-pri', 'defer', $hours );
				}
					$primary_title = $settings['primary_link_title'] ?? '';
				?>
				<<?php echo $tag; ?> <?php echo $this->render_attributes( 'alert-pri' ); ?>>
					<span class="bultr-button-content-wrapper">
						<?php if ( ! empty( $settings['primary_link_icon'] ) && $settings['icon_position'] === 'left' ) { ?>
							<?php
								$icon = ! empty( $settings['primary_link_icon'] ) ? self::render_icon( $settings['primary_link_icon'], '' ) : false;
								echo $icon
							?>
						<?php } ?>
						<span class="bultr-button-text"><?php echo $primary_title; ?></span>
						<?php if ( ! empty( $settings['primary_link_icon'] ) && $settings['icon_position'] === 'right' ) { ?>
							<?php
								$icon = ! empty( $settings['primary_link_icon'] ) ? self::render_icon( $settings['primary_link_icon'], '' ) : false;
								echo $icon
							?>
						<?php } ?>
					</span>
				</<?php echo $tag; ?>>
			<?php } ?>
			<?php
			if ( isset( $settings['secondary_link_action'] ) && isset( $settings['enable_secondary_link'] ) ) {
				$sec_action = $settings['secondary_link_action'];
				?>
				<?php
				$this->set_attribute( 'alert-sec', 'class', [ 'bultr-button', 'bultr-alert-button-secondary' ] );
				$this->set_attribute( 'alert-sec', 'actions', implode( ',', $sec_action ) );
				if ( in_array( 'link', $settings['secondary_link_action'], true ) ) {
					$this->set_link_attributes( 'alert-sec', $settings['secondary_link'] );
					$tag = 'a';
				} else {
					$tag = 'span';
				}
				if ( in_array( 'defer', $settings['secondary_link_action'], true ) ) {
					$hours = $settings['secondary_hours'] ?? '0';
					$this->set_attribute( 'alert-sec', 'defer', $hours );
				}
					$secondary_title = $settings['secondary_link_title'] ?? '';
				?>
				<<?php echo $tag; ?> <?php echo $this->render_attributes( 'alert-sec' ); ?>>
					<span class="bultr-button-content-wrapper">
						<?php if ( ! empty( $settings['secondary_link_icon'] ) && $settings['icon_position'] === 'left' ) { ?>
							<?php
								$icon = ! empty( $settings['secondary_link_icon'] ) ? self::render_icon( $settings['secondary_link_icon'], '' ) : false;
								echo $icon
							?>
						<?php } ?>
						<span class="bultr-button-text"><?php echo $secondary_title; ?></span>

						<?php if ( ! empty( $settings['secondary_link_icon'] ) && $settings['icon_position'] === 'right' ) { ?>
							<?php
								$icon = ! empty( $settings['secondary_link_icon'] ) ? self::render_icon( $settings['secondary_link_icon'], '' ) : false;
								echo $icon
							?>
						<?php } ?>
					</span>
				</<?php echo $tag; ?>>
			<?php } ?>
			</div>
		<?php
	}
}
