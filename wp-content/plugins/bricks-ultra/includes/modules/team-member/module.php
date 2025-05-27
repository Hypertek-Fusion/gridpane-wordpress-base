<?php

namespace BricksUltra\Modules\TeamMember;

use Bricks\Breakpoints;
use Bricks\Element;
use BricksUltra\includes\Helper;
use BricksUltra\Plugin;

class Module extends Element {

	public $category       = 'ultra';
	public $name           = 'wpvbu-team-member';
	public $icon           = 'ti-id-badge';
	public $css_selector   = '';
	public $scripts        = [ 'bricksUltraTeamMember' ];
	public static $_helper = null;

	// Methods: Builder-specific
	public function get_label() {
		return esc_html__( 'Team Member', 'wpv-bu' );
	}

	// Enqueue element styles and scripts
	public function enqueue_scripts() {
		$layout = $this->settings['layoutType'] ?? 'grid';
		if ( $layout === 'slider' ) {
			if ( (float) BRICKS_VERSION < 1.5 ) {
				wp_register_script( 'bricks-splide', BRICKS_URL_ASSETS . 'js/libs/splide.min.js', [ 'bricks-scripts' ], WPV_BU_VERSION, true );
				wp_register_style( 'bricks-splide', BRICKS_URL_ASSETS . 'css/libs/splide.min.css', [], WPV_BU_VERSION );
			}

			wp_enqueue_script( 'bricks-splide' );
			wp_enqueue_style( 'bricks-splide' );
		}
		wp_enqueue_script( 'bultr-module-script' );
		wp_enqueue_style( 'bultr-module-style' );
	}

	public function set_control_groups() {
		self::$_helper = new Helper();

		$this->control_groups['team-members'] = [
			'title' => esc_html__( 'Team members', 'wpv-bu' ),
			'tab'   => 'content',
		];

		$this->control_groups['layout'] = [
			'title' => esc_html__( 'Layout', 'wpv-bu' ),
			'tab'   => 'content',
		];

		$this->control_groups['image'] = [
			'title' => esc_html__( 'Image', 'wpv-bu' ),
			'tab'   => 'content',
		];

		$this->control_groups['content'] = [
			'title' => esc_html__( 'Content', 'wpv-bu' ),
			'tab'   => 'content',
		];

		$this->control_groups['social_icon'] = [
			'title' => esc_html__( 'Social Icons', 'wpv-bu' ),
			'tab'   => 'content',
		];

		$this->control_groups['carousel_controls'] = [
			'title'    => esc_html__( 'Slider Controls', 'wpv-bu' ),
			'tab'      => 'content',
			'required' => [ 'layoutType', '=', 'slider' ],
		];

		$this->control_groups['navigation_style'] = [
			'title'    => esc_html__( 'Navigation Style', 'wpv-bu' ),
			'tab'      => 'content',
			'required' => [ 'layoutType', '=', 'slider' ],
		];
	}

	public function set_controls() {
		// TEAM MEMBERS
		$this->controls['team_members'] = [
			'tab'           => 'content',
			'group'         => 'team-members',
			'placeholder'   => esc_html__( 'Team member', 'wpv-bu' ),
			'type'          => 'repeater',
			'titleProperty' => 'title',
			'fields'        => [
				'image' => [
					'tab'   => 'content',
					'label' => esc_html__( 'Image', 'wpv-bu' ),
					'type'  => 'image',
				],

				'title' => [
					'tab'   => 'content',
					'label' => esc_html__( 'Title', 'wpv-bu' ),
					'type'  => 'text',
				],

				'subtitle' => [
					'tab'   => 'content',
					'label' => esc_html__( 'Subtitle', 'wpv-bu' ),
					'type'  => 'text',
				],

				'description' => [
					'tab'   => 'content',
					'label' => esc_html__( 'Content', 'wpv-bu' ),
					'type'  => 'textarea',
				],
				'social_icons' => [
					'placeholder'   => esc_html__( 'Social Icons', 'wpv-bu' ),
					'type'          => 'repeater',
					'titleProperty' => 'social_title',
					'fields'        => [
						'social_title' => [
							'tab'    => 'content',
							'label'  => esc_html__( 'Title', 'wpv-bu' ),
							'type'   => 'text',
							'inline' => true,
						],
						'social_icon' => [
							'tab'    => 'content',
							'label'  => esc_html__( 'Icon', 'wpv-bu' ),
							'type'   => 'icon',
							'inline' => true,
						],
						'social_url' => [
							'tab'    => 'content',
							'label'  => esc_html__( 'URL', 'wpv-bu' ),
							'type'   => 'text',
							'inline' => true,
						],
					],
				],
			],
			'default'       => [
				[
					'image'        => [
						'full' => 'https://source.unsplash.com/random/600x600?woman',
						'url'  => 'https://source.unsplash.com/random/600x600?woman',
					],
					'title'        => 'Aida Bugg',
					'subtitle'     => 'CEO',
					'description'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
					'social_icons' => [
						[
							'social_title' => 'Facebook',
							'social_icon'  => [
								'library' => 'fontawesomeBrands',
								'icon'    => 'fab fa-facebook',
							],
							'social_url'   => 'https://www.facebook.com',
						],
						[
							'social_title' => 'Twitter',
							'social_icon'  => [
								'library' => 'fontawesomeBrands',
								'icon'    => 'fab fa-twitter',
							],
							'social_url'   => 'https://www.twitter.com',
						],
						[
							'social_title' => 'Instagram',
							'social_icon'  => [
								'library' => 'fontawesomeBrands',
								'icon'    => 'fab fa-instagram',
							],
							'social_url'   => 'https://www.instagram.com',
						],
					],
				],
				[
					'image'        => [
						'full' => 'https://source.unsplash.com/random/700x700?man',
						'url'  => 'https://source.unsplash.com/random/700x700?man',
					],
					'title'        => 'Ray O’Sun',
					'subtitle'     => 'CFO',
					'description'  => 'Sociis natoque penatibus et magnis dis parturient.',
					'social_icons' => [
						[
							'social_title' => 'Facebook',
							'social_icon'  => [
								'library' => 'fontawesomeBrands',
								'icon'    => 'fab fa-facebook',
							],
							'social_url'   => 'https://www.facebook.com',
						],
						[
							'social_title' => 'Twitter',
							'social_icon'  => [
								'library' => 'fontawesomeBrands',
								'icon'    => 'fab fa-twitter',
							],
							'social_url'   => 'https://www.twitter.com',
						],
						[
							'social_title' => 'Instagram',
							'social_icon'  => [
								'library' => 'fontawesomeBrands',
								'icon'    => 'fab fa-instagram',
							],
							'social_url'   => 'https://www.instagram.com',
						],
					],
				],
				[
					'image'        => [
						'full' => 'https://source.unsplash.com/random/800x800?woman',
						'url'  => 'https://source.unsplash.com/random/800x800?woman',
					],
					'title'        => 'Rose Bush',
					'subtitle'     => 'CMO',
					'description'  => 'Natoque sociis natoque penatibus et magnis dis.',
					'social_icons' => [
						[
							'social_title' => 'Facebook',
							'social_icon'  => [
								'library' => 'fontawesomeBrands',
								'icon'    => 'fab fa-facebook',
							],
							'social_url'   => 'https://www.facebook.com',
						],
						[
							'social_title' => 'Twitter',
							'social_icon'  => [
								'library' => 'fontawesomeBrands',
								'icon'    => 'fab fa-twitter',
							],
							'social_url'   => 'https://www.twitter.com',
						],
						[
							'social_title' => 'Instagram',
							'social_icon'  => [
								'library' => 'fontawesomeBrands',
								'icon'    => 'fab fa-instagram',
							],
							'social_url'   => 'https://www.instagram.com',
						],
					],
				],
				[
					'image'        => [
						'full' => 'https://source.unsplash.com/random/800x800?man',
						'url'  => 'https://source.unsplash.com/random/800x800?man',
					],
					'title'        => 'Hank R. Cheef',
					'subtitle'     => 'CTO',
					'description'  => 'Penatibus sociis natoque penatibus et magnis dis.',
					'social_icons' => [
						[
							'social_title' => 'Facebook',
							'social_icon'  => [
								'library' => 'fontawesomeBrands',
								'icon'    => 'fab fa-facebook',
							],
							'social_url'   => 'https://www.facebook.com',
						],
						[
							'social_title' => 'Twitter',
							'social_icon'  => [
								'library' => 'fontawesomeBrands',
								'icon'    => 'fab fa-twitter',
							],
							'social_url'   => 'https://www.twitter.com',
						],
						[
							'social_title' => 'Instagram',
							'social_icon'  => [
								'library' => 'fontawesomeBrands',
								'icon'    => 'fab fa-instagram',
							],
							'social_url'   => 'https://www.instagram.com',
						],
					],
				],
			],
		];

		// LAYOUT
		$this->layout_controls();

		// IMAGE
		$this->image_controls();

		//CONTENT
		$this->content_controls();

		//SOCIAL ICONS
		$this->social_icon_controls();

		//SPLIDE CONTROLS
		$this->slider_controls();

		//NAV STYLE CONTROLS
		$this->navigation_style_control();
	}

	public function layout_controls() {

		$this->controls['layoutType'] = [
			'tab'         => 'content',
			'group'       => 'layout',
			'label'       => esc_html__( 'Type', 'wpv-bu' ),
			'default'     => 'grid',
			'type'        => 'select',
			'options'     => [
				'grid'   => esc_html__( 'Grid', 'wpv-bu' ),
				'slider' => esc_html__( 'Slider', 'wpv-bu' ),
			],
			'placeholder' => esc_html__( 'Grid', 'wpv-bu' ),
			'inline'      => true,
		];

		$this->controls['membersPerRow'] = [
			'tab'      => 'content',
			'group'    => 'layout',
			'label'    => esc_html__( 'Columns', 'wpv-bu' ),
			'type'     => 'number',
			'default'  => 4,
			'min'      => 1,
			'max'      => 6,
			'css'      => [
				[
					'selector' => '.bultr-team-members',
					'property' => 'grid-template-columns',
					'value'    => 'repeat(%s, 1fr)',
				],
				[
					'selector' => '.bultr-team-members',
					'property' => 'grid-auto-flow',
					'value'    => 'unset',
				],
			],
			'required' => [ 'layoutType', '=', 'grid' ],
		];

		$this->controls['memberGutter'] = [
			'tab'         => 'content',
			'group'       => 'layout',
			'label'       => esc_html__( 'Gap', 'wpv-bu' ),
			'type'        => 'number',
			'units'       => true,
			'default'     => 10,
			'css'         => [
				[
					'selector' => '.bultr-team-members',
					'property' => 'gap',
				],
			],
			'placeholder' => 20,
		];

		$this->controls['contentBackgroundColor'] = [
			'tab'   => 'content',
			'group' => 'layout',
			'label' => esc_html__( 'Background', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-team-member',
				],
			],
		];

		$this->controls['contentBorder'] = [
			'tab'   => 'content',
			'group' => 'layout',
			'label' => esc_html__( 'Border', 'wpv-bu' ),
			'type'  => 'border',
			'css'   => [
				[
					'property' => 'border',
					'selector' => '.bultr-team-member',
				],
			],
		];

		$this->controls['contentBoxShadow'] = [
			'tab'   => 'content',
			'group' => 'layout',
			'label' => esc_html__( 'Box shadow', 'wpv-bu' ),
			'type'  => 'box-shadow',
			'css'   => [
				[
					'property' => 'box-shadow',
					'selector' => '.bultr-team-member',
				],
			],
		];
	}

	public function image_controls() {
		$this->controls['imagePosition'] = [
			'tab'         => 'content',
			'group'       => 'image',
			'label'       => esc_html__( 'Image position', 'wpv-bu' ),
			'type'        => 'select',
			'options'     => [
				'top'    => esc_html__( 'Top', 'wpv-bu' ),
				'right'  => esc_html__( 'Right', 'wpv-bu' ),
				'left'   => esc_html__( 'Left', 'wpv-bu' ),
				'bottom' => esc_html__( 'Bottom', 'wpv-bu' ),
			],
			'clearable'   => false,
			'default'     => 'top',
			'placeholder' => esc_html__( 'Top', 'wpv-bu' ),
			'inline'      => true,
		];
		$this->controls['contentOnHover'] = [
			'tab'      => 'style',
			'group'    => 'image',
			'label'    => esc_html__( 'Content Show On Hover', 'wpv-bu' ),
			'type'     => 'checkbox',
			'default'  => true,
			'inline'   => true,
			'required' => [ 'imagePosition', '=', [ 'background' ] ],
		];


		$this->controls['imageWidth'] = [
			'tab'      => 'content',
			'group'    => 'image',
			'label'    => esc_html__( 'Image width (%)', 'wpv-bu' ),
			'type'     => 'number',
			'unit'     => '%',
			'css'      => [
				[
					'selector' => '.bultr-image-left .bultr-image, .bultr-image-right .bultr-image, .bultr-image-bottom .bultr-image, .bultr-image-top .bultr-image',
					'property' => 'width',
				],
				[
					'selector' => '.bultr-image-left .bultr-content, .bultr-image-right .bultr-content',
					'property' => 'width',
					'value'    => 'calc(100% - %s)',
				],
			],
			'required' => [ 'imagePosition', '!=', 'background' ],
		];

		$this->controls['imageCover'] = [
			'tab'    => 'style',
			'group'  => 'image',
			'label'  => esc_html__( 'Enable Ratio', 'wpv-bu' ),
			'type'   => 'checkbox',
			'inline' => true,
		];
		$this->controls['imageRatio']     = [
			'tab'      => 'content',
			'group'    => 'image',
			'label'    => esc_html__( 'Image Ratio', 'wpv-bu' ),
			'type'     => 'number',
			'unitless' => true,
			'min'      => 0,
			'max'      => 2,
			'step'     => 0.01,
			'css'      => [
				[
					'selector' => '.bultr-image.bultr-cover',
					'property' => 'padding-bottom',
					'value'    => 'calc(%s * 100%)',
				],
			],
			'required' => [
				[ 'imageCover', '!=', '' ],
			],
			'default'  => 0.66,
		];
		$this->controls['imageAlignSelf'] = [
			'tab'     => 'style',
			'group'   => 'image',
			'label'   => esc_html__( 'Align', 'wpv-bu' ),
			'type'    => 'align-items',
			'exclude' => 'stretch',
			'default' => 'center',
			'css'     => [
				[
					'selector' => '.bultr-team-members .bultr-team-member .bultr-image',
					'property' => 'align-self',
				],
			],
			'inline'  => true,
		];

		$this->controls['imagePadding'] = [
			'tab'      => 'content',
			'group'    => 'image',
			'label'    => esc_html__( 'Padding', 'wpv-bu' ),
			'type'     => 'dimensions',
			'default'  => [
				'top'    => 0,
				'right'  => 10,
				'bottom' => 10,
				'left'   => 10,
			],
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.bultr-image-background .bultr-team-member',
				],
			],
			'required' => [ 'imagePosition', '=', 'background' ],
		];

		$this->controls['imageMargin'] = [
			'tab'      => 'content',
			'group'    => 'image',
			'label'    => esc_html__( 'Margin', 'wpv-bu' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'margin',
					'selector' => '.bultr-image',
				],
			],
			'required' => [ 'imagePosition', '!=', 'background' ],
		];

		$this->controls['imageBorder'] = [
			'tab'   => 'content',
			'group' => 'image',
			'label' => esc_html__( 'Image border', 'wpv-bu' ),
			'type'  => 'border',
			'css'   => [
				[
					'property' => 'border',
					'selector' => '.bultr-image',
				],
			],
		];
	}

	public function content_controls() {
		$this->controls['contentPadding']    = [
			'tab'   => 'content',
			'group' => 'content',
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',

			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-content-inner',
				],
			],
		];
		$this->controls['contentMargin']     = [
			'tab'   => 'content',
			'group' => 'content',
			'label' => esc_html__( 'Margin', 'wpv-bu' ),
			'type'  => 'dimensions',
			
			'css'   => [
				[
					'property' => 'margin',
					'selector' => '.bultr-content-inner',
				],
			],
		];
		$this->controls['backdropFilter']    = [
			'tab'      => 'content',
			'group'    => 'content',
			'label'    => esc_html__( 'Backdrop Blur (px)', 'wpv-bu' ),
			'type'     => 'number',
			'inline'   => true,
			'unit'     => 'px',
			'css'      => [
				[
					'property' => 'backdrop-filter',
					'selector' => '.bultr-image-background .bultr-content-inner',
					'value'    => 'blur(%s)',
				],
			],
			'required' => [ 'imagePosition', '=', 'background' ],
		];
		$this->controls['contentBoxBorder']  = [
			'tab'   => 'content',
			'group' => 'content',
			'label' => esc_html__( 'Border', 'wpv-bu' ),
			'type'  => 'border',
			'css'   => [
				[
					'property' => 'border',
					'selector' => '.bultr-content-inner',
				],
			],
		];
		$this->controls['contentBackground'] = [
			'tab'   => 'content',
			'group' => 'content',
			'label' => esc_html__( 'Background', 'wpv-bu' ),
			'type'  => 'background',
			'css'   => [
				[
					'property' => 'background',
					'selector' => '.bultr-content-inner',
				],
			],
		];

		$this->controls['contentAlign'] = [
			'tab'    => 'content',
			'group'  => 'content',
			'label'  => esc_html__( 'Text align', 'wpv-bu' ),
			'type'   => 'text-align',
			'css'    => [
				[
					'property' => 'text-align',
					'selector' => '.bultr-content',
				],
			],
			'inline' => true,
		];

		$this->controls['memberTitleTag'] = [
			'tab'         => 'content',
			'group'       => 'content',
			'label'       => esc_html__( 'Title tag', 'wpv-bu' ),
			'type'        => 'select',
			'options'     => [
				'h2'  => 'h2',
				'h3'  => 'h3',
				'h4'  => 'h4',
				'h5'  => 'h5',
				'h6'  => 'h6',
				'p'   => 'p',
				'div' => 'div',
			],
			'inline'      => true,
			'placeholder' => 'h4',
		];

		$this->controls['memberTitleTypography'] = [
			'tab'   => 'content',
			'group' => 'content',
			'label' => esc_html__( 'Title typography', 'wpv-bu' ),
			'type'  => 'typography',
			'css'   => [
				[
					'property' => 'font',
					'selector' => '.bultr-title',
				],
			],

		];

		$this->controls['memberSubtitleTypography'] = [
			'tab'   => 'content',
			'group' => 'content',
			'label' => esc_html__( 'Subtitle typography', 'wpv-bu' ),
			'type'  => 'typography',
			'css'   => [
				[
					'property' => 'font',
					'selector' => '.bultr-subtitle',
				],
			],
			
		];

		$this->controls['memberDescriptionTypography'] = [
			'tab'   => 'content',
			'group' => 'content',
			'label' => esc_html__( 'Description typography', 'wpv-bu' ),
			'type'  => 'typography',
			'css'   => [
				[
					'property' => 'font',
					'selector' => '.bultr-description',
				],
			],
			
		];
	}

	public function social_icon_controls() {
				$this->controls['iconPadding'] = [
					'tab'   => 'content',
					'group' => 'social_icon',
					'label' => esc_html__( 'Padding', 'wpv-bu' ),
					'type'  => 'dimensions',
					'css'   => [
						[
							'property' => 'padding',
							'selector' => '.bultr-team-member .bultr-content .bultr-social-icons',
						],
					],

				];

				$this->controls['iconAlignSelf'] = [
					'tab'    => 'content',
					'group'  => 'social_icon',
					'label'  => esc_html__( 'Align', 'wpv-bu' ),
					'type'   => 'justify-content',
					'css'    => [
						[
							'selector' => '.bultr-team-member .bultr-content .bultr-social-icons',
							'property' => 'justify-content',
						],
					],
					'inline' => true,
				];

				$this->controls['iconSize']  = [
					'tab'         => 'content',
					'group'       => 'social_icon',
					'label'       => esc_html__( 'Size', 'wpv-bu' ),
					'type'        => 'number',
					'min'         => 6,
					'step'        => 1,
					'max'         => 300,
					'placeholder' => 15,
					'css'         => [
						[
							'property' => 'font-size',
							'selector' => '.bultr-team-member .bultr-content .bultr-social-icon',
							'value'    => '%spx',
						],
					],
				];
				$this->controls['iconColor'] = [
					'tab'    => 'content',
					'group'  => 'social_icon',
					'label'  => esc_html__( 'Color', 'wpv-bu' ),
					'type'   => 'color',
					'css'    => [
						[
							'selector' => '.bultr-team-member .bultr-content .bultr-social-icons i',
							'property' => 'color',
						],
					],
					'inline' => true,
				];
	}

	public function slider_controls() {
		self::$_helper->get_slider_controls(
			$this,
			[
				'control_name' => 'tm',
				'group'        => 'carousel_controls',
			]
		);
		$this->controls['tm_slider_effect']['reloadScripts'] = true;
		//Options
		
	}

	public function navigation_style_control() {
		$this->controls['navigation_control_start'] = [
			'tab'   => 'content',
			'group' => 'navigation_style',
			'type'  => 'separator',
			'label' => esc_html__( 'Arrows', 'wpv-bu' ),
		];

		$this->controls['arrow_size']                  = [
			'tab'         => 'content',
			'group'       => 'navigation_style',
			'label'       => esc_html__( 'Size (px)', 'wpv-bu' ),
			'type'        => 'number',
			'unit'        => 'px',
			'default'     => 25,
			'placeholder' => 25,
			'css'         => [
				[
					'property' => 'font-size',
					'selector' => '.bultr-slider .splide__arrow i',
				],
			],
		];
		$this->controls['arrow_color']                 = [
			'tab'   => 'content',
			'group' => 'navigation_style',
			'label' => esc_html__( 'Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.bultr-slider .splide__arrow i',
				],
			],
		];
		$this->controls['arrow_bg_color']              = [
			'tab'   => 'content',
			'group' => 'navigation_style',
			'label' => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-slider .splide__arrow i',
				],
			],
		];
		$this->controls['arrow_border']                = [
			'tab'   => 'content',
			'group' => 'navigation_style',
			'label' => esc_html__( 'Border', 'wpv-bu' ),
			'type'  => 'border',
			'css'   => [
				[
					'property' => 'border',
					'selector' => '.bultr-slider .splide__arrow i',
				],
			],
		];
		$this->controls['arrow_padding']               = [
			'tab'   => 'content',
			'group' => 'navigation_style',
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-slider .splide__arrow i',
				],
			],
		];
		$this->controls['navigation_pagination_start'] = [
			'tab'      => 'content',
			'group'    => 'navigation_style',
			'type'     => 'separator',
			'label'    => esc_html__( 'Pagination', 'wpv-bu' ),
			'required' => [ 'tm_slider_pagination', '=', 'pagination' ],
		];
		$this->controls['pagination_color']            = [
			'tab'      => 'content',
			'group'    => 'navigation_style',
			'label'    => esc_html__( 'Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-slider .splide__pagination__page',
				],
			],
			'required' => [ 'tm_slider_pagination', '=', 'pagination' ],
		];
		$this->controls['active_color']                = [
			'tab'      => 'content',
			'group'    => 'navigation_style',
			'label'    => esc_html__( 'Active Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-slider .splide__pagination__page.is-active',
				],
			],
			'required' => [ 'tm_slider_pagination', '=', 'pagination' ],
		];
		$this->controls['navigation_size']             = [
			'tab'      => 'content',
			'group'    => 'navigation_style',
			'label'    => esc_html__( 'Size (px)', 'wpv-bu' ),
			'type'     => 'number',
			'unit'     => 'px',
			'default'  => '10px',
			'css'      => [
				[
					'property' => 'height',
					'selector' => '.bultr-slider .splide__pagination__page',
				],
				[
					'property' => 'width',
					'selector' => '.bultr-slider .splide__pagination__page',
				],
			],
			'required' => [ 'tm_slider_pagination', '=', 'pagination' ],
		];

		$this->controls['progress_sep']        = [
			'tab'      => 'content',
			'group'    => 'navigation_style',
			'label'    => esc_html__( 'Progress Bar', 'wpv-bu' ),
			'type'     => 'separator',
			'required' => [ 'tm_slider_pagination', '=', 'progress' ],
		];
		$this->controls['progress_bar_height'] = [
			'tab'      => 'content',
			'group'    => 'navigation_style',
			'label'    => esc_html__( 'Height (px)', 'wpv-bu' ),
			'type'     => 'number',
			'unit'     => 'px',
			'default'  => 5,
			'css'      => [
				[
					'property' => 'height',
					'selector' => '.bultr-slider .bultr-slider-progress-bar',
				],
			],
			'required' => [ 'tm_slider_pagination', '=', 'progress' ],
		];

		$this->controls['progress_bg_color'] = [
			'tab'      => 'content',
			'group'    => 'navigation_style',
			'label'    => esc_html__( 'Background color', 'wpv-bu' ),
			'type'     => 'color',
			'inline'   => true,
			'small'    => true,
			
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-slider .bultr-slider-progress',
				],
			],
			'required' => [ 'tm_slider_pagination', '=', 'progress' ],
		];

		$this->controls['progress_color'] = [
			'tab'      => 'content',
			'group'    => 'navigation_style',
			'label'    => esc_html__( 'color', 'wpv-bu' ),
			'type'     => 'color',
			'inline'   => true,
			'small'    => true,
			
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-slider .bultr-slider-progress-bar',
				],
			],
			'required' => [ 'tm_slider_pagination', '=', 'progress' ],
		];
	}

	public function render() {
		$settings      = $this->settings;
		$team_members  = ! empty( $settings['team_members'] ) ? $settings['team_members'] : false;
		$title_tag     = ! empty( $settings['memberTitleTag'] ) ? esc_attr( $settings['memberTitleTag'] ) : 'h4';
		$layout_type   = $settings['layoutType'] ?? 'grid';
		$imagePosition = $settings['imagePosition'] ?? 'top';
		if ( ! $team_members ) {
			return $this->render_element_placeholder(
				[
					'title' => esc_html__( 'No team members added.', 'wpv-bu' ),
				]
			);
		}

		$this->set_attribute( 'team_members', 'class', 'bultr-team-members' );
		$this->set_attribute( 'team_members', 'class', "bultr-{$layout_type}" );
		if ( $layout_type === 'grid' ) {
			$this->set_attribute( 'team_members', 'data-grid-row-count', $settings['membersPerRow'] );
		}

		$this->set_attribute( 'team_members', 'class', "bultr-image-{$imagePosition}" );

		if ( isset( $settings['contentOnHover'] ) ) {
			$this->set_attribute( 'team_members', 'class', 'bultr-content-hover' );
		}
		$effect = $settings['tm_slider_effect'] ?? 'slide';
		if ( $layout_type === 'slider' ) {
			$main_slider_options = [
				'type'         => $effect,
				'perPage'      => ( isset( $settings['tm_slides_per_page'] ) ) ? $settings['tm_slides_per_page'] : 3,
				'perMove'      => $settings['tm_slides_per_view'] ?? 1,
				'speed'        => isset( $settings['tm_slider_speed'] ) ? $settings['tm_slider_speed'] : '',
				'autoplay'     => isset( $settings['tm_slider_autoplay'] ) && $settings['tm_slider_autoplay'] === true ? true : false,
				'interval'     => isset( $settings['tm_autoplay_interval'] ) ? $settings['tm_autoplay_interval'] : '',
				'pauseOnHover' => isset( $settings['tm_slide_pause_hvr'] ),
				'direction'    => is_rtl() ? 'rtl' : 'ltr',
				'width'        => '100%',
				'arrows'       => isset( $settings['tm_slider_arrows'] ),
				'keyboard'     => isset( $settings['tm_slider_keyboard_control'] ),
				'pagination'   => $settings['tm_slider_pagination'] === 'pagination' ? true : false,
				'gap'          => isset( $settings['memberGutter'] ) ? $settings['memberGutter'] : '10px',
				'breakpoints'  => [],
				
			];
			if ( $effect === 'fade' ) {
				$main_slider_options['perPage'] = 1;
			} else {
				$breakpoints_data = Breakpoints::get_breakpoints();
				$breakpoints_len  = count( $breakpoints_data );
				$baseDevice       = Plugin::$buBaseDevice;
				$default_value    = 3;
				if ( $baseDevice === 'desktop' ) {
					$default_value = $settings['tm_slides_per_page'] ?? $default_value;
				} else {
					$default_value = $settings[ 'tm_slides_per_page:' . $baseDevice ] ?? $default_value;
				}
				for ( $i = 0; $i < $breakpoints_len; $i++ ) {
					if ( $breakpoints_data[ $i ]['key'] === 'desktop' ) {
						$main_slider_options['breakpoints'][ $breakpoints_data[ $i ]['width'] ]['perPage'] = $settings['tm_slides_per_page'] ?? $default_value;
					} else {
						$main_slider_options['breakpoints'][ $breakpoints_data[ $i ]['width'] ]['perPage'] = $settings[ 'tm_slides_per_page:' . $breakpoints_data[ $i ]['key'] ] ?? $default_value;
					}
				}
			}

			
			if ( isset( $settings['tm_slider_loop'] ) && $settings['tm_slider_loop'] && $settings['tm_slider_effect'] === 'slide' ) {
				$main_slider_options['type']   = 'loop';
				$main_slider_options['clones'] = 2;
			}
			$this->set_attribute( 'team_members', 'data-splide', wp_json_encode( $main_slider_options ) );
		}

		echo "<div {$this->render_attributes( '_root' )}>";
		echo "<div {$this->render_attributes( 'team_members' )}>";
		if ( $layout_type === 'slider' ) {
			echo '<div class="splide__arrows splide__arrows--ltr">';
			if ( isset( $settings['tm_slider_icon_prev'] ) ) {
				echo '<button class="splide__arrow splide__arrow--prev" type="button" disabled="" aria-label="Previous slide" aria-controls="image-carousel-track">';
				echo self::render_icon( $settings['tm_slider_icon_prev'] );
				echo '</button>';
			}
			if ( isset( $settings['tm_slider_icon_next'] ) ) {
				echo '<button class="splide__arrow splide__arrow--next" type="button" disabled="" aria-label="Next slide" aria-controls="image-carousel-track">';
				echo self::render_icon( $settings['tm_slider_icon_next'] );
				echo '</button>';
			}
			echo '</div>';
			echo "<div class='splide__track'>";
			echo "<div class='splide__list'>";
		}
		foreach ( $team_members as $index => $team_member ) {
			
			$this->set_attribute( "team_member_{$index}", 'class', 'bultr-team-member' );
			if ( $layout_type === 'slider' ) {
				$this->set_attribute( "team_member_{$index}", 'class', 'splide__slide' );
			}
			echo "<div {$this->render_attributes( "team_member_{$index}" )}>";
			echo "<div class='bultr-team-member-inner'>";

			if ( isset( $team_member['image'] ) ) {
				// Image
				$team_member_image_classes   = [];
				$team_member_image_classes[] = 'bultr-image';
				$team_member_image_classes[] = 'bultr-css-filter';
				if ( isset( $settings['imageCover'] ) ) {
					$team_member_image_classes[] = 'bultr-cover';
				}

				$this->set_attribute( "image-{$index}", 'class', $team_member_image_classes );
				$image = $this->get_normalized_image_settings( $team_member, 'image' );
				if(isset($image['url'])){

					if(isset($image['id']) && $image['id'] > 0){

						$size = isset( $team_member['image']['size'] ) ? $team_member['image']['size'] : BRICKS_DEFAULT_IMAGE_SIZE;
						$atts  = [
							'_brx_disable_lazy_loading' => true,
						];

						$image = wp_get_attachment_image( $image['id'], $size, false, $atts );
					}else{
						$image = '<img src="' . $image['url'] . '" />';
					}
				}
				
				echo "<div {$this->render_attributes( "image-{$index}" )}>";
				if ( $imagePosition && $image !== '' ) {
					echo $image;
				}
				echo '</div>';
			}
			//Content
			echo '<div class="bultr-content">';
			echo '<div class="bultr-content-inner">';
			//Title
			if ( isset( $team_member['title'] ) ) {
				$this->set_attribute( "title-$index", esc_attr( $title_tag ) );
				$this->set_attribute( "title-$index", 'class', [ 'bultr-title' ] );

				echo "<{$this->render_attributes( "title-$index" )}>{$team_member['title']}</{$title_tag}>";
			}
			//Subtitle
			if ( isset( $team_member['subtitle'] ) ) {
				$this->set_attribute( "subtitle-$index", 'class', [ 'bultr-subtitle' ] );

				echo "<div {$this->render_attributes( "subtitle-$index" )}>{$team_member['subtitle']}</div>";
			}
			//Description
			if ( isset( $team_member['description'] ) ) {
				$this->set_attribute( "description-$index", 'class', [ 'bultr-description' ] );

				echo "<div {$this->render_attributes( "description-$index" )}>{$team_member['description']}</div>";
			}
			//Social Icons
			$social_icons = ! empty( $team_member['social_icons'] ) ? $team_member['social_icons'] : false;

			if ( $social_icons ) {
				$this->set_attribute( 'social_icons', 'class', 'bultr-social-icons' );

				echo "<div {$this->render_attributes( 'social_icons' )}>";
				foreach ( $social_icons as $index => $social_icon ) {
					
					$icon = ! empty( $social_icon['social_icon'] ) ? self::render_icon( $social_icon['social_icon'] ) : false;
					if ( $icon ) {
						$icon         = $icon;
						$social_url   = ( isset( $social_icon['social_url'] ) || ! empty( $social_icon['social_url'] ) ) ? $social_icon['social_url'] : false;
						$social_title = ( isset( $social_icon['social_title'] ) && ! empty( $social_icon['social_title'] ) ) ? $social_icon['social_title'] : '';
						if ( $social_url ) {
							$icon = '<a class="bultr-social-icon" href="' . $social_url . '" target="_blank" title="' . $social_title . '">' . $icon . '</a>';
						}
						echo $icon;
					}
				}

				echo '</div>';
			}
			echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}

		if ( $layout_type === 'slider' ) {
			echo '</div>';
			echo '</div>';
			if ( $settings['tm_slider_pagination'] === 'progress' ) {
				echo '<div class="bultr-slider-progress">';
					echo '<div class="bultr-slider-progress-bar"></div>';
				echo '</div>';
			}
		}
		echo '</div>';
		echo '</div>';
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
}
