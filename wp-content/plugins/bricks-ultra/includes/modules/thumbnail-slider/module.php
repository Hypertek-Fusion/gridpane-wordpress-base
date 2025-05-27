<?php

namespace BricksUltra\Modules\ThumbnailSlider;

use Bricks\Breakpoints;
use Bricks\Query;
use Bricks\Helpers;
use Bricks\Element;
use Bricks\Setup;
use BricksUltra\includes\Helper;
use BricksUltra\Plugin;

class Module extends Element {

	public $category       = 'ultra';
	public $name           = 'wpvbu-thumbnail-slider';
	public $icon           = 'ti-layout-slider';
	public $css_selector   = '';
	public $scripts        = [ 'ThumbnailSlider' ];
	public $loop_index     = 0;
	public static $_helper = null;

	
	// Methods: Builder-specific
	public function get_label() {
		return esc_html__( 'Thumbnail Slider', 'wpv-bu' );
	}

	// Enqueue element styles and scripts
	public function enqueue_scripts() {

		if ( (float) BRICKS_VERSION < 1.5 ) {
			wp_register_script( 'bricks-splide', BRICKS_URL_ASSETS . 'js/libs/splide.min.js', [ 'bricks-scripts' ], WPV_BU_VERSION, true );
			wp_register_style( 'bricks-splide', BRICKS_URL_ASSETS . 'css/libs/splide.min.css', [], WPV_BU_VERSION );
		}

		wp_enqueue_script( 'bricks-splide' );
		wp_enqueue_style( 'bricks-splide' );

		wp_enqueue_script( 'bultr-module-script' );
		wp_enqueue_style( 'bultr-module-style' );
	}
	public function set_control_groups() {
		self::$_helper = new Helper();

		$this->control_groups['slides']           = [
			'title' => esc_html__( 'Slides', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['thumbnails']       = [
			'title' => esc_html__( 'Thumbnails', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['slider_options']   = [
			'title' => esc_html__( 'Slider Options', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['slider_style']     = [
			'title' => esc_html__( 'Slides Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['content_style']    = [
			'title' => esc_html__( 'Content Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['button_style']     = [
			'title' => esc_html__( 'Button Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['navigation_style'] = [
			'title' => esc_html__( 'Navigation Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
		$this->control_groups['thumbnail_style']  = [
			'title' => esc_html__( 'Thumbnail Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
	}

	public function set_controls() {
		$this->controls['slider_items'] = [
			'tab'           => 'content',
			'group'         => 'slides',
			'checkLoop'     => true,
			'type'          => 'repeater',
			'titleProperty' => 'slide_heading', // Default 'title'
			'default'       => [
				[
					'slide_heading' => 'Slide 1 Heading',
					'slide_desc'    => 'Slide 1 Description',
					'button_text'   => 'Click Here',
					'slider_image'  => [
						'full' => 'https://source.unsplash.com/random/800x400?earth',
						'url'  => 'https://source.unsplash.com/random/800x400?earth',
					],
				],
				[
					'slide_heading' => 'Slide 2 Heading',
					'slide_desc'    => 'Slide 2 Description',
					'button_text'   => 'Click Here',
					'slider_image'  => [
						'full' => 'https://source.unsplash.com/random/800x400?moon',
						'url'  => 'https://source.unsplash.com/random/800x400?moon',
					],
				],
				[
					'slide_heading' => 'Slide 3 Heading',
					'slide_desc'    => 'Slide 3 Description',
					'button_text'   => 'Click Here',
					'slider_image'  => [
						'full' => 'https://source.unsplash.com/random/800x400?nature',
						'url'  => 'https://source.unsplash.com/random/800x400?nature',
					],
				],
				[
					'slide_heading' => 'Slide 4 Heading',
					'slide_desc'    => 'Slide 4 Description',
					'button_text'   => 'Click Here',
					'slider_image'  => [
						'full' => 'https://source.unsplash.com/random/800x400?architecture',
						'url'  => 'https://source.unsplash.com/random/800x400?architecture',
					],
				],
			],
			'fields'        => [
				'slider_image'       => [
					'type' => 'image',
				],
				'custom_thumbnail'   => [
					'tab'     => 'content',
					'group'   => 'images_labels',
					'label'   => esc_html__( 'Custom Thumbnail', 'wpv-bu' ),
					'type'    => 'checkbox',
					'inline'  => true,
					'small'   => true,
					'default' => false,
				],
				'thumb_slider_image' => [
					'label'    => esc_html__( 'Thumbnail Image', 'wpv-bu' ),
					'type'     => 'image',
					'default'  => [
						'full' => 'https://source.unsplash.com/random/800x400?moon',
						'url'  => 'https://source.unsplash.com/random/800x400?moon',
					],
					'required' => [ 'custom_thumbnail', '=', true ],
				],
				'slide_heading' => [
					'label' => esc_html__( 'Heading', 'wpv-bu' ),
					'type'  => 'text',
				],
				'slide_desc' => [
					'label' => esc_html__( 'Description', 'wpv-bu' ),
					'type'  => 'textarea',
				],
				'button_text' => [
					'label' => esc_html__( 'Button Text', 'wpv-bu' ),
					'type'  => 'text',
				],
				'button_link' => [
					'label' => esc_html__( 'Link', 'wpv-bu' ),
					'type'  => 'link',
				],
				'button_class' => [
					'label' => esc_html__( 'Custom Class', 'wpv-bu' ),
					'type'  => 'text',
				],
			],
		];
		$this->controls                 = array_replace_recursive( $this->controls, $this->get_loop_builder_controls( 'slides' ) );

		/* Thumbnail Controls Start */
		$this->thumbnail_controls();

		/* Slider Options Controls Start */
		$this->slider_controls();

		// Slider Style Controls
		$this->slides_style_controls();

		// Content Style Controls
		$this->content_style_controls();

		// Button Style Controls
		$this->button_style_controls();

		// Navivation Style Controls
		$this->navigation_style_control();

		// Thumbnail Style Controls
		$this->thumbnail_styles_control();
	}

	public function general_controls() {
		$this->controls['slider_height']       = [
			'tab'     => 'content',
			'group'   => 'slider_style',
			'label'   => esc_html__( 'Height (px)', 'wpv-bu' ),
			'type'    => 'number',
			'unit'    => 'px',
			'default' => '400px',
			'css'     => [
				[
					'property' => 'height',
					'selector' => '.bultr-main-slider .splide__slide .bultr-slide-image',
				],
			],
		];
		$this->controls['image_fit']           = [
			'tab'       => 'content',
			'group'     => 'slider_style',
			'label'     => esc_html__( 'Image Fit', 'wpv-bu' ),
			'type'      => 'select',
			'options'   => [
				'cover'   =>  'Cover',
				'contain' =>  'Contain',
				'auto'    => 'Auto',
			],
			'inline'    => true,
			'default'   => 'cover',
			'clearable' => false,
			'css'       => [
				[
					'property' => 'background-size',
					'selector' => '.bultr-main-slider .splide__slide .bultr-slide-image',
				],
			],
		];
		$this->controls['image_position']      = [
			'tab'       => 'content',
			'group'     => 'slider_style',
			'label'     => esc_html__( 'Image Position', 'wpv-bu' ),
			'type'      => 'select',
			'options'   => [
				'center center' => esc_html__( 'Center Center', 'wpv-bu' ),
				'center left'   => esc_html__( 'Center Left', 'wpv-bu' ),
				'center right'  => esc_html__( 'Center Right', 'wpv-bu' ),
				'top center'    => esc_html__( 'Top Center', 'wpv-bu' ),
				'top left'      => esc_html__( 'Top Left', 'wpv-bu' ),
				'top right'     => esc_html__( 'Top Right', 'wpv-bu' ),
				'bottom center' => esc_html__( 'Bottom Center', 'wpv-bu' ),
				'bottom left'   => esc_html__( 'Bottom Left', 'wpv-bu' ),
				'bottom right'  => esc_html__( 'Bottom Right', 'wpv-bu' ),
			],
			'inline'    => true,
			'default'   => 'center center',
			'clearable' => false,
			'css'       => [
				[
					'property' => 'background-position',
					'selector' => '.bultr-main-slider .bultr-slide-image',
				],
			],
		];
		$this->controls['slider_image_repeat'] = [
			'tab'       => 'content',
			'group'     => 'slider_style',
			'label'     => esc_html__( 'Image Repeat', 'wpv-bu' ),
			'type'      => 'select',
			'options'   => [
				''          => 'Default',
				'repeat'    => 'Repeat', 
				'no-repeat' => 'No Repeat',
				'repeat-x'  => 'Repeat X',
				'repeat-y'  => 'Repeat Y',
			],
			'inline'    => true,
			'default'   => '',
			'clearable' => false,
			'css'       => [
				[
					'property' => 'background-repeat',
					'selector' => '.bultr-main-slider .bultr-slide-image',
				],
			],
			'required' => [ 
				'image_fit', '!=', ['cover'] 
			],
		];
		$this->controls['slide_overlay']       = [
			'tab'     => 'content',
			'group'   => 'slider_style',
			'label'   => esc_html__( 'Slide Overlay', 'wpv-bu' ),
			'type'    => 'checkbox',
			'inline'  => true,
			'small'   => true,
			'default' => false,
		];
		$this->controls['overlay_color']       = [
			'tab'      => 'content',
			'group'    => 'slider_style',
			'label'    => esc_html__( 'Overlay Color', 'wpv-bu' ),
			'type'     => 'color',
			'inline'   => true,
			'small'    => true,
			'default'  => [
				'hex'  => '#1206063a',
				'rgba' => 'rgba(18, 6, 6, 0.229)',
			],
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-main-slider .bultr-slide-image .bultr-slide-overlay',
				],
			],
			'required' => [ 'slide_overlay', '=', true ],
		];
		$this->controls['overlay_blend']       = [
			'tab'       => 'content',
			'group'     => 'slider_style',
			'label'     => esc_html__( 'Blend Mode', 'wpv-bu' ),
			'type'      => 'select',
			'options'   => [
				''            => esc_html__( 'Normal', 'wpv-bu' ),
				'multiply'    => 'Multiply',
				'screen'      => 'Screen',
				'overlay'     => 'Overlay',
				'darken'      => 'Darken',
				'lighten'     => 'Lighten',
				'color-dodge' => 'Color Dodge',
				'color-burn'  => 'Color Burn',
				'hue'         => 'Hue',
				'saturation'  => 'Saturation',
				'color'       => 'Color',
				'exclusion'   => 'Exclusion',
				'luminosity'  => 'Luminosity',
			],
			'inline'    => true,
			'default'   => '',
			'clearable' => false,
			'required'  => [ 'slide_overlay', '=', true ],
			'css'       => [
				[
					'property' => 'mix-blend-mode',
					'selector' => '.bultr-main-slider .bultr-slide-image .bultr-slide-overlay',
				],
			],
		];
	}

	public function thumbnail_controls() {
		$this->controls['thumbs_position']        = [
			'tab'       => 'content',
			'group'     => 'thumbnails',
			'label'     => esc_html__( 'Position', 'wpv-bu' ),
			'type'      => 'select',
			'options'   => [
				'top'    => esc_html__( 'Top', 'wpv-bu' ),
				'right'  => esc_html__( 'Right', 'wpv-bu' ),
				'bottom' => esc_html__( 'Bottom', 'wpv-bu' ),
				'left'   => esc_html__( 'Left', 'wpv-bu' ),
			],
			'inline'    => true,
			'default'   => 'bottom',
			'clearable' => false,
		];
		$this->controls['thumbs_position_mobile'] = [
			'tab'       => 'content',
			'group'     => 'thumbnails',
			'label'     => esc_html__( 'Mobile Position', 'wpv-bu' ),
			'type'      => 'select',
			'options'   => [
				'top'    => esc_html__( 'Top', 'wpv-bu' ),
				'bottom' => esc_html__( 'Bottom', 'wpv-bu' ),
			],
			'inline'    => true,
			'default'   => 'bottom',
			'clearable' => false,
			'required'  => [ 'thumbs_position', '=', [ 'left', 'right' ] ],
		];
	}

	public function slider_controls() {
		self::$_helper->get_slider_controls(
			$this,
			[
				'control_name' => 'ts',
				'group'        => 'slider_options',
			]
		);
		unset( $this->controls['ts_slides_per_page'] );
		
	}

	public function slides_style_controls() {
		// General Controls
		$this->general_controls();
		$this->controls['slider_thumb_space']     = [
			'tab'     => 'content',
			'group'   => 'slider_style',
			'label'   => esc_html__( 'Space Between (px)', 'wpv-bu' ),
			'type'    => 'number',
			'unit'    => 'px',
			'default' => 10,
			'css'     => [
				[
					'property' => 'gap',
					'selector' => '.bultr-thumb-position-bottom, .mobile.bultr-thumb-mobile-position-bottom',
				],
				[
					'property' => 'gap',
					'selector' => '.bultr-thumb-position-top, .mobile.bultr-thumb-mobile-position-top',
				],
				[
					'property' => 'gap',
					'selector' => '.bultr-thumb-position-right',
				],
				[
					'property' => 'gap',
					'selector' => '.bultr-thumb-position-left',
				],
			],
		];
		$this->controls['slide_background_color'] = [
			'tab'    => 'content',
			'group'  => 'slider_style',
			'label'  => esc_html__( 'Background color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'small'  => true,
			'css'    => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-main-slider .bultr-slide-image',
				],
			],
		];
		$this->controls['slider_border']          = [
			'tab'   => 'content',
			'group' => 'slider_style',
			'label' => esc_html__( 'Slider Border', 'wpv-bu' ),
			'type'  => 'border',
			'css'   => [
				[
					'property' => 'border',
					'selector' => '.bultr-main-slider .bultr-slide-image',
				],
			],
		];
		$this->controls['slider_padding']         = [
			'tab'   => 'content',
			'group' => 'slider_style',
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-main-slider .bultr-slider-inner',
				],
			],
		];
	}
	public function content_style_controls() {
		$this->content_style_general();
		$this->heading_style_controls();
		$this->description_style_controls();
	}
	public function content_style_general() {
		$this->controls['horizontal_position'] = [
			'tab'          => 'content',
			'group'        => 'content_style',
			'label'        => esc_html__( 'Horizontal Position', 'wpv-bu' ),
			'type'         => 'justify-content',
			'inline'       => true,
			'default'      => 'center',
			'exclude'      => 'space',
			'isHorizontal' => false,
			'css'          => [
				[
					'property' => 'justify-content',
					'selector' => '.bultr-main-slider .splide__slide .bultr-slide-image',
				],
			],
		];

		$this->controls['vertical_position'] = [
			'tab'     => 'content',
			'group'   => 'content_style',
			'label'   => esc_html__( 'Vertical Position', 'wpv-bu' ),
			'type'    => 'align-items',

			'inline'  => true,
			'default' => 'center',
			'exclude' => 'stretch',
			'css'     => [
				[
					'property' => 'align-items',
					'selector' => '.bultr-main-slider .splide__slide .bultr-slide-image',
				],
			],
		];
		$this->controls['text_align']        = [
			'tab'     => 'content',
			'group'   => 'content_style',
			'label'   => esc_html__( 'Text Align', 'wpv-bu' ),
			'type'    => 'text-align',
			'default' => 'center',
			'exclude' => [ 'justify' ],
			'inline'  => true,
			'css'     => [
				[
					'property' => 'text-align',
					'selector' => '.bultr-main-slider .bultr-slider-inner',
				],
			],
		];
		
		$this->controls['slider_content_width'] = [
			'tab'     => 'content',
			'group'   => 'content_style',
			'label'   => esc_html__( 'Width (%)', 'wpv-bu' ),
			'type'    => 'number',
			'unit'    => '%',
			'default' => 70,
			'css'     => [
				[
					'property' => 'width',
					'selector' => '.bultr-main-slider .bultr-slider-inner',
				],
			],
		];

		$this->controls['content_bg_clr'] = [
			'tab'     => 'content',
			'group'   => 'content_style',
			'label'   => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'    => 'color',
			'default' => [
				'hex' => '#26232347',
			],
			'css'     => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-main-slider .bultr-slide-content',
				],
			],
		];
		$this->controls['content_padding'] = [
			'tab'   => 'content',
			'group' => 'content_style',
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-main-slider .bultr-slide-content',
				],
			],
		];
	}
	public function heading_style_controls() {
		$this->controls['heading_style_sep']  = [
			'tab'   => 'content',
			'group' => 'content_style',
			'type'  => 'separator',
			'label' => esc_html__( 'Heading', 'wpv-bu' ),
		];
		$this->controls['heading_color']      = [
			'tab'   => 'content',
			'group' => 'content_style',
			'label' => esc_html__( 'Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.bultr-main-slider .bultr-slide-content .bultr-slide-heading',
				],
			],
		];
		$this->controls['heading_typography'] = [
			'tab'     => 'content',
			'group'   => 'content_style',
			'label'   => esc_html__( 'Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'default' => [
				'font-size'   => '35px',
				'font-weight' => 700,
				'line-height' => 1,
			],
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-main-slider .bultr-slide-content .bultr-slide-heading',
				],
			],
			'exclude' => [
				'color',
			],
			'inline'  => true,
		];
		$this->controls['heading_spacing']    = [
			'tab'     => 'content',
			'group'   => 'content_style',
			'label'   => esc_html__( 'Spacing (px)', 'wpv-bu' ),
			'type'    => 'number',
			'unit'    => 'px',
			'default' => '30px',
			'css'     => [
				[
					'property' => 'margin-bottom',
					'selector' => '.bultr-main-slider .bultr-slide-content .bultr-slide-heading:not(:last-child)',
				],
			],
		];
	}
	public function description_style_controls() {
		$this->controls['descritpion_style_sep']  = [
			'tab'   => 'content',
			'group' => 'content_style',
			'type'  => 'separator',
			'label' => esc_html__( 'Description', 'wpv-bu' ),
		];
		$this->controls['description_color']      = [
			'tab'   => 'content',
			'group' => 'content_style',
			'label' => esc_html__( 'Color', 'wpv-bu' ),
			'type'  => 'color',
			
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.bultr-main-slider .bultr-slide-content .bultr-slide-description',
				],
			],
		];
		$this->controls['description_typography'] = [
			'tab'     => 'content',
			'group'   => 'content_style',
			'label'   => esc_html__( 'Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'default' => [
				'font-size'   => '17px',
				'line-height' => 1.4,
			],
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-main-slider .bultr-slide-content .bultr-slide-description',
				],
			],
			'exclude' => [
				'color',
			],
			'inline'  => true,
		];
		$this->controls['description_spacing']    = [
			'tab'     => 'content',
			'group'   => 'content_style',
			'label'   => esc_html__( 'Spacing (px)', 'wpv-bu' ),
			'type'    => 'number',
			'unit'    => 'px',
			'default' => '30px',
			'css'     => [
				[
					'property' => 'margin-bottom',
					'selector' => '.bultr-main-slider .bultr-slide-content .bultr-slide-description:not(:last-child)',
				],
			],
		];
	}

	public function button_style_controls() {
		$this->controls['button_typography'] = [
			'tab'     => 'content',
			'group'   => 'button_style',
			'label'   => esc_html__( 'Typography', 'wpv-bu' ),
			'type'    => 'typography',
			'default' => [
				'font-size'   => '35px',
				'font-weight' => 700,
				'line-height' => 1,
			],
			'css'     => [
				[
					'property' => 'typography',
					'selector' => '.bultr-main-slider .bultr-slide-content .bultr-slide-button .bultr-slide-btn-text',
				],
			],
			'exclude' => [
				'color',
			],
			'inline'  => true,
		];

		$this->controls['button_color']            = [
			'tab'   => 'content',
			'group' => 'button_style',
			'label' => esc_html__( 'Color', 'wpv-bu' ),
			'type'  => 'color',
			
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.bultr-main-slider .bultr-slide-content .bultr-slide-button',
				],
			],
		];
		$this->controls['button_bg_color']         = [
			'tab'   => 'content',
			'group' => 'button_style',
			'label' => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-main-slider .bultr-slide-content .bultr-slide-button',
				],
			],
		];
		$this->controls['button_border']           = [
			'tab'   => 'content',
			'group' => 'button_style',
			'label' => esc_html__( 'Border', 'wpv-bu' ),
			'type'  => 'border',
			'css'   => [
				[
					'property' => 'border',
					'selector' => '.bultr-main-slider .bultr-slide-content .bultr-slide-button',
				],
			],
		];
		$this->controls['hover_control_start']     = [
			'tab'   => 'content',
			'group' => 'button_style',
			'type'  => 'separator',
			'label' => esc_html__( 'Hover', 'wpv-bu' ),
		];
		$this->controls['button_color_hvr']        = [
			'tab'   => 'content',
			'group' => 'button_style',
			'label' => esc_html__( 'Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'color',
					'selector' => '.bultr-main-slider .bultr-slide-content .bultr-slide-button:hover',
				],
			],
		];
		$this->controls['button_bg_color_hvr']     = [
			'tab'   => 'content',
			'group' => 'button_style',
			'label' => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-main-slider .bultr-slide-content .bultr-slide-button:hover',
				],
			],
		];
		$this->controls['button_border_color_hvr'] = [
			'tab'   => 'content',
			'group' => 'button_style',
			'label' => esc_html__( 'Border Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'border-color',
					'selector' => '.bultr-main-slider .bultr-slide-content .bultr-slide-button:hover',
				],
			],
		];
		$this->controls['hover_end_sep']           = [
			'tab'   => 'content',
			'group' => 'button_style',
			'type'  => 'separator',
		];
		$this->controls['button_padding']          = [
			'tab'   => 'content',
			'group' => 'button_style',
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-main-slider .bultr-slide-content .bultr-slide-button',
				],
			],
		];
	}

	public function navigation_style_control() {
		$this->controls['navigation_control_start'] = [
			'tab'   => 'content',
			'group' => 'navigation_style',
			'type'  => 'separator',
			'label' => esc_html__( 'Arrows', 'wpv-bu' ),
		];

		$this->controls['arrow_size']                  = [
			'tab'   => 'content',
			'group' => 'navigation_style',
			'label' => esc_html__( 'Size (px)', 'wpv-bu' ),
			'type'  => 'number',
			'unit'  => 'px',
			'css'   => [
				[
					'property' => 'font-size',
					'selector' => '.bultr-main-slider .splide__arrow i',
				],
				[
					'property' => 'font-size',
					'selector' => '.bultr-main-slider .splide__arrow svg',
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
					'selector' => '.bultr-main-slider .splide__arrow i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-main-slider .splide__arrow svg',
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
					'selector' => '.bultr-main-slider .splide__arrow i',
				],
				[
					'property' => 'background-color',
					'selector' => '.bultr-main-slider .splide__arrow svg',
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
					'selector' => '.bultr-main-slider .splide__arrow i',
				],
				[
					'property' => 'border',
					'selector' => '.bultr-main-slider .splide__arrow svg',
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
					'selector' => '.bultr-main-slider .splide__arrow i',
				],
				[
					'property' => 'padding',
					'selector' => '.bultr-main-slider .splide__arrow svg',
				],
			],
		];
		$this->controls['navigation_pagination_start'] = [
			'tab'      => 'content',
			'group'    => 'navigation_style',
			'type'     => 'separator',
			'label'    => esc_html__( 'Pagination', 'wpv-bu' ),
			'required' => [ 'ts_slider_pagination', '=', 'pagination' ],
		];
		$this->controls['pagination_color']            = [
			'tab'      => 'content',
			'group'    => 'navigation_style',
			'label'    => esc_html__( 'Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-main-slider .splide__pagination__page',
				],
			],
			'required' => [ 'ts_slider_pagination', '=', 'pagination' ],
		];
		$this->controls['active_color']                = [
			'tab'      => 'content',
			'group'    => 'navigation_style',
			'label'    => esc_html__( 'Active Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-main-slider .splide__pagination__page.is-active',
				],
			],
			'required' => [ 'ts_slider_pagination', '=', 'pagination' ],
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
					'selector' => '.bultr-main-slider .splide__pagination__page',
				],
				[
					'property' => 'width',
					'selector' => '.bultr-main-slider .splide__pagination__page',
				],
			],
			'required' => [ 'ts_slider_pagination', '=', 'pagination' ],
		];

		$this->controls['progress_sep']        = [
			'tab'      => 'content',
			'group'    => 'navigation_style',
			'label'    => esc_html__( 'Progress Bar', 'wpv-bu' ),
			'type'     => 'separator',
			'required' => [ 'ts_slider_pagination', '=', 'progress' ],
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
					'selector' => '.bultr-main-slider .bultr-slider-progress-bar',
				],
			],
			'required' => [ 'ts_slider_pagination', '=', 'progress' ],
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
					'selector' => '.bultr-main-slider .bultr-slider-progress',
				],
			],
			'required' => [ 'ts_slider_pagination', '=', 'progress' ],
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
					'selector' => '.bultr-main-slider .bultr-slider-progress-bar',
				],
			],
			'required' => [ 'ts_slider_pagination', '=', 'progress' ],
		];
	}

	public function thumbnail_styles_control() {
		$this->controls['thumb_height']           = [
			'tab'       => 'content',
			'group'     => 'thumbnail_style',
			'label'     => esc_html__( 'Height (px)', 'wpv-bu' ),
			'type'      => 'number',
			'unit'      => 'px',
			'default'   => '150',
			'clearable' => false,
			'css'       => [
				
				[
					'property' => 'height',
					'selector' => '.bultr-thumb-position-top .bultr-thumb-slider .bultr-slide-image, .bultr-thumb-position-bottom .bultr-thumb-slider .bultr-slide-image',
				],
			],
			'required'  => [ 'thumbs_position', '=', [ 'top', 'bottom' ] ],
		];
		$this->controls['thumb_width_right_left'] = [
			'tab'       => 'content',
			'group'     => 'thumbnail_style',
			'label'     => esc_html__( 'Width (px)', 'wpv-bu' ),
			'type'      => 'number',
			'unit'      => 'px',
			'default'   => '150',
			'clearable' => false,
			'required'  => [ 'thumbs_position', '=', [ 'left', 'right' ] ],
			'css'       => [
				[
					'property' => 'width',
					'selector' => '.horizontal .bultr-thumbs-wrapper',
				],
				[
					'property' => 'width',
					'selector' => '.horizontal .bultr-main-slider',
					'value'    => 'calc(100% - %s)',
				],

			],
		];
		$this->controls['thumb_width'] = [
			'tab'      => 'content',
			'group'    => 'thumbnail_style',
			'label'    => esc_html__( 'Width (%)', 'wpv-bu' ),
			'type'     => 'number',
			'unit'     => '%',
			'default'  => '100',
			'css'      => [
				[
					'property' => 'width',
					'selector' => '.vertical .bultr-thumb-slider',
				],
			],
			'required' => [ 'thumbs_position', '=', [ 'top', 'bottom' ] ],

		];
		$this->controls['thumb_alignment']        = [
			'tab'          => 'content',
			'group'        => 'thumbnail_style',
			'label'        => esc_html__( 'Alignment', 'wpv-bu' ),
			'type'         => 'align-items',
			'inline'       => true,
			'default'      => 'center',
			'exclude'      => 'stretch',
			'isHorizontal' => true,
			'css'          => [
				[
					'property' => 'justify-content',
					'selector' => '.bultr-thumbs-wrapper',
				],
			],
			'required'     => [ 'thumbs_position', '=', [ 'top', 'bottom' ] ],
		];
		$this->controls['thumbs_view']            = [
			'tab'         => 'content',
			'group'       => 'thumbnail_style',
			'label'       => esc_html__( 'Thumbs Per View', 'wpv-bu' ),
			'type'        => 'number',
			'placeholder' => '3',
			'breakpoints' => true,
		];
		$this->controls['thumbs_space']           = [
			'tab'         => 'content',
			'group'       => 'thumbnail_style',
			'label'       => esc_html__( 'Space Between Thumbs (px)', 'wpv-bu' ),
			'type'        => 'number',
			'placeholder' => '10',
			'default'     => 10,
			'breakpoints' => true,
		];
		$this->controls['thumbs_arrows']          = [
			'tab'   => 'content',
			'group' => 'thumbnail_style',
			'label' => esc_html__( 'Arrows', 'wpv-bu' ),
			'type'  => 'checkbox',
		];
		$this->controls['thumb_slider_icon_prev'] = [
			'tab'      => 'content',
			'group'    => 'thumbnail_style',
			'label'    => esc_html__( 'Icon Prev', 'wpv-bu' ),
			'type'     => 'icon',
			'default'  => [
				'library' => 'themify',
				'icon'    => 'ti-angle-left',
			],
			'required' => [ 'thumbs_arrows', '=', true ],
		];
		$this->controls['thumb_slider_icon_next'] = [
			'tab'      => 'content',
			'group'    => 'thumbnail_style',
			'label'    => esc_html__( 'Icon Next', 'wpv-bu' ),
			'type'     => 'icon',
			'default'  => [
				'library' => 'themify',
				'icon'    => 'ti-angle-right',
			],
			'required' => [ 'thumbs_arrows', '=', true ],
		];
		$this->controls['thumbs_image_fit']       = [
			'tab'       => 'content',
			'group'     => 'thumbnail_style',
			'label'     => esc_html__( 'Image Fit', 'wpv-bu' ),
			'type'      => 'select',
			'options'   => [
				'cover'   => esc_html__( 'Cover', 'wpv-bu' ),
				'contain' => esc_html__( 'Contain', 'wpv-bu' ),
				'auto'    => esc_html__( 'Auto', 'wpv-bu' ),
			],
			'inline'    => true,
			'default'   => 'cover',
			'clearable' => false,
			'css'       => [
				[
					'property' => 'background-size',
					'selector' => '.bultr-thumb-slider .bultr-slide-image',
				],
			],
		];
		$this->controls['thumbs_image_position']  = [
			'tab'       => 'content',
			'group'     => 'thumbnail_style',
			'label'     => esc_html__( 'Image Position', 'wpv-bu' ),
			'type'      => 'select',
			'options'   => [
				''              => esc_html__( 'Default', 'wpv-bu' ),
				'center center' => esc_html__( 'Center Center', 'wpv-bu' ),
				'center left'   => esc_html__( 'Center Left', 'wpv-bu' ),
				'center right'  => esc_html__( 'Center Right', 'wpv-bu' ),
				'top center'    => esc_html__( 'Top Center', 'wpv-bu' ),
				'top left'      => esc_html__( 'Top Left', 'wpv-bu' ),
				'top right'     => esc_html__( 'Top Right', 'wpv-bu' ),
				'bottom center' => esc_html__( 'Bottom Center', 'wpv-bu' ),
				'bottom left'   => esc_html__( 'Bottom Left', 'wpv-bu' ),
				'bottom right'  => esc_html__( 'Bottom Right', 'wpv-bu' ),
			],
			'inline'    => true,
			'default'   => '',
			'clearable' => false,
			'css'       => [
				[
					'property' => 'background-position',
					'selector' => '.bultr-thumb-slider .bultr-slide-image',
				],
			],
		];
		$this->controls['thumbs_image_repeat']    = [
			'tab'       => 'content',
			'group'     => 'thumbnail_style',
			'label'     => esc_html__( 'Image Repeat', 'wpv-bu' ),
			'type'      => 'select',
			'options'   => [
				''          => esc_html__( 'Default', 'wpv-bu' ),
				'repeat'    => esc_html__( 'Repeat', 'wpv-bu' ),
				'no-repeat' => esc_html__( 'No Repeat', 'wpv-bu' ),
				'repeat-x'  => esc_html__( 'Repeat X', 'wpv-bu' ),
				'repeat-y'  => esc_html__( 'Repeat Y', 'wpv-bu' ),
			],
			'inline'    => true,
			'default'   => '',
			'clearable' => false,
			'css'       => [
				[
					'property' => 'background-repeat',
					'selector' => '.bultr-thumb-slider .bultr-slide-image',
				],
			],
			'required' => [
				'thumbs_image_fit', '!=', 'cover'
			]
		];
		$this->controls['thumb_slide_overlay']    = [
			'tab'     => 'content',
			'group'   => 'thumbnail_style',
			'label'   => esc_html__( 'Slide Overlay', 'wpv-bu' ),
			'type'    => 'checkbox',
			'inline'  => true,
			'small'   => true,
			'default' => false,
		];
		$this->controls['thumb_overlay_color']    = [
			'tab'      => 'content',
			'group'    => 'thumbnail_style',
			'label'    => esc_html__( 'Overlay color', 'wpv-bu' ),
			'type'     => 'color',
			'inline'   => true,
			'small'    => true,
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-thumb-slider .bultr-slide-image .bultr-slide-overlay',
				],
			],
			'required' => [ 'thumb_slide_overlay', '=', true ],
		];

		$this->controls['thumb_overlay_act_color'] = [
			'tab'      => 'content',
			'group'    => 'thumbnail_style',
			'label'    => esc_html__( 'Active Overlay color', 'wpv-bu' ),
			'type'     => 'color',
			'inline'   => true,
			'small'    => true,
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-thumb-slider .splide__slide.is-active .bultr-slide-image .bultr-slide-overlay',
				],
			],
			'required' => [ 'thumb_slide_overlay', '=', true ],
		];
		$this->controls['thumbs_style_sep']        = [
			'tab'   => 'content',
			'group' => 'thumbnail_style',
			'type'  => 'separator',
		];
		$this->controls['thumbnail_border']        = [
			'tab'     => 'content',
			'group'   => 'thumbnail_style',
			'label'   => esc_html__( 'Border', 'wpv-bu' ),
			'type'    => 'border',
			'default' => [
				'style' => 'none',
			],
			'css'     => [
				[
					'property' => 'border',
					'selector' => '.bultr-thumb-slider .splide__slide',
				],
			],
		];
		$this->controls['thumbnail_border_active'] = [
			'tab'   => 'content',
			'group' => 'thumbnail_style',
			'label' => esc_html__( 'Active Border Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'border-color',
					'selector' => '.bultr-thumb-slider .splide__slide.is-active',
				],
			],
		];
		$this->controls['thumbnail_arrows_sep']    = [
			'tab'      => 'content',
			'group'    => 'thumbnail_style',
			'type'     => 'separator',
			'label'    => esc_html__( 'Arrows', 'wpv-bu' ),
			'required' => [ 'thumbs_arrows', '=', true ],
		];

		$this->controls['thumb_arrow_size']     = [
			'tab'      => 'content',
			'group'    => 'thumbnail_style',
			'label'    => esc_html__( 'Size (px)', 'wpv-bu' ),
			'type'     => 'number',
			'unit'     => 'px',
			'default'  => '20px',
			'css'      => [
				[
					'property' => 'font-size',
					'selector' => '.bultr-thumb-slider .splide__arrow i',
				],
				[
					'property' => 'font-size',
					'selector' => '.bultr-thumb-slider .splide__arrow svg',
				],
			],
			'required' => [ 'thumbs_arrows', '=', true ],
		];
		$this->controls['thumb_arrow_color']    = [
			'tab'      => 'content',
			'group'    => 'thumbnail_style',
			'label'    => esc_html__( 'Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.bultr-thumb-slider .splide__arrow',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-thumb-slider .splide__arrow svg',
				],
			],
			'required' => [ 'thumbs_arrows', '=', true ],
		];
		$this->controls['thumb_arrow_bg_color'] = [
			'tab'      => 'content',
			'group'    => 'thumbnail_style',
			'label'    => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-thumb-slider .splide__arrow i',
				],
				[
					'property' => 'background-color',
					'selector' => '.bultr-thumb-slider .splide__arrow svg',
				],
			],
			'required' => [ 'thumbs_arrows', '=', true ],
		];
		$this->controls['thumb_arrow_border']   = [
			'tab'      => 'content',
			'group'    => 'thumbnail_style',
			'label'    => esc_html__( 'Border', 'wpv-bu' ),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.bultr-thumb-slider .splide__arrow i',
				],
				[
					'property' => 'border',
					'selector' => '.bultr-thumb-slider .splide__arrow svg',
				],
			],
			'required' => [ 'thumbs_arrows', '=', true ],
		];
		$this->controls['thumb_arrow_padding']  = [
			'tab'      => 'content',
			'group'    => 'thumbnail_style',
			'label'    => esc_html__( 'Padding', 'wpv-bu' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.bultr-thumb-slider .splide__arrow i',
				],
				[
					'property' => 'padding',
					'selector' => '.bultr-thumb-slider .splide__arrow svg',
				],
			],
			'required' => [ 'thumbs_arrows', '=', true ],
		];
	}

	public function render() {
		$settings     = $this->settings;
		$slider_items = $settings['slider_items'] ?? [];
		$index        = $this->loop_index;

		$this->set_attribute( 'bu_ts_wrapper', 'class', 'bultr-thumb-slider-wrapper' );
		$this->set_attribute( 'bu_ts_wrapper', 'class', 'bultr-thumb-position-' . $settings['thumbs_position'] );
		$main_slider_options = [
			'type'         => $settings['ts_slider_effect'],
			'speed'        => $settings['ts_slider_speed'],
			'autoplay'     => isset( $settings['ts_slider_autoplay'] ) && $settings['ts_slider_autoplay'] === true ? true : false,
			'interval'     => $settings['ts_autoplay_interval'],
			'pauseOnHover' => isset( $settings['ts_slide_pause_hvr'] ),
			'direction'    => is_rtl() ? 'rtl' : 'ltr', //$settings['ts_slider_direction'],
			'width'        => '100%',
			'arrows'       => isset( $settings['ts_slider_arrows'] ),
			'keyboard'     => isset( $settings['ts_slider_keyboard_control'] ),
			'pagination'   => $settings['ts_slider_pagination'] === 'pagination',
			'breakpoints'  => [],
			'breakpoints'  => [
				'767' => [
					'height' => isset( $settings['slider_height:mobile_portrait'] ) ? $settings['slider_height:mobile_portrait'] : 400,
				],
			],
		];

		$thumb_space          = $settings['thumbs_space'] ?? 10;
		$thumb_slider_options = [
			'fixedHeight'  => isset( $settings['thumb_height'] ) ? (int) $settings['thumb_height'] : 150,
			'width'        => isset( $settings['thumb_width'] ) ? (int) $settings['thumb_width'] : '100%',
			'perPage'      => isset( $settings['thumbs_view'] ) ? (int) $settings['thumbs_view'] : 3,
			'isNavigation' => true, // slide change on image click
			'pagination'   => false, // pagination bullets show
			'arrows'       => $settings['thumbs_arrows'] ?? false,
			'gap'          => (int) $thumb_space,
			'direction'    => is_rtl() ? 'rtl' : 'ltr',
		];

		if ( $settings['thumbs_position'] === 'right' || $settings['thumbs_position'] === 'left' ) {
			$thumb_slider_options['direction']  = 'ttb';
			$thumb_slider_options['height']     = $settings['slider_height'];
			$thumb_slider_options['width']      = $settings['thumb_width_right_left'];
			$thumb_slider_options['fixedWidth'] = $settings['thumb_width_right_left'];
			unset( $thumb_slider_options['fixedHeight'] );
			$this->set_attribute( 'bu_ts_wrapper', 'class', 'horizontal' );
		} else {
			$this->set_attribute( 'bu_ts_wrapper', 'class', 'vertical' );
		}
		$thumb_slider_options['breakpoints'] = [];
		if ( isset( $settings['ts_slider_loop'] ) && $settings['ts_slider_loop'] && $settings['ts_slider_effect'] === 'slide' ) {
			$main_slider_options['type']   = 'loop';
			$main_slider_options['clones'] = 2;
		}
		
		$breakpoints_data = Breakpoints::get_breakpoints();
		$breakpoints_len  = count( $breakpoints_data );
		$defaultHeight    = 400;
		$defaultWidth     = 100;
		$defaultPerPage   = 3;
		$defaultGap       = 5;
		$index            = '';
		$baseDevice       = Plugin::$buBaseDevice;
		if ( $baseDevice === 'desktop' ) {
			$defaultHeight  = $settings['slider_height'] ?? $defaultHeight;
			$defaultWidth   = $settings['thumb_width'] ?? $defaultWidth;
			$defaultPerPage = $settings['thumbs_view'] ?? $defaultPerPage;
			$defaultGap     = $settings['thumbs_space'] ?? $defaultGap;
		} else {
			$defaultHeight  = $settings[ 'slider_height:' . $baseDevice ] ?? $defaultHeight;
			$defaultWidth   = $settings[ 'thumb_width:' . $baseDevice ] ?? $defaultWidth;
			$defaultPerPage = $settings[ 'thumbs_view:' . $baseDevice ] ?? $defaultPerPage;
			$defaultGap     = $settings[ 'thumbs_space:' . $baseDevice ] ?? $defaultGap;
		}

		for ( $i = 0; $i < $breakpoints_len; $i++ ) {
			if ( $breakpoints_data[ $i ]['key'] === 'desktop' ) {
				$main_slider_options['breakpoints'][ $breakpoints_data[ $i ]['width'] ] =
				[
					'height' => $settings['slider_height'] ?? $defaultHeight,
				];
			} else {
				$main_slider_options['breakpoints'][ $breakpoints_data[ $i ]['width'] ] =
				[
					'height' => $settings[ 'slider_height:' . $breakpoints_data[ $i ]['key'] ] ?? $defaultHeight,
				];

				$thumb_slider_options['breakpoints'][ $breakpoints_data[ $i ]['width'] ] =
				[
					'width'   => isset( $settings[ 'thumb_width:' . $breakpoints_data[ $i ]['key'] ] ) ? (int) $settings[ 'thumb_width:' . $breakpoints_data[ $i ]['key'] ] : $defaultWidth,
					'perPage' => isset( $settings[ 'thumbs_view:' . $breakpoints_data[ $i ]['key'] ] ) ? (int) $settings[ 'thumbs_view:' . $breakpoints_data[ $i ]['key'] ] : $defaultPerPage,
					'gap'     => isset( $settings[ 'thumbs_space:' . $breakpoints_data[ $i ]['key'] ] ) ? (int) $settings[ 'thumbs_space:' . $breakpoints_data[ $i ]['key'] ] : $defaultGap,

				];
				if ( $breakpoints_data[ $i ]['width'] < 768 ) {
					$thumb_slider_options['breakpoints'][ $breakpoints_data[ $i ]['width'] ]['direction']   = 'ltr';
					$thumb_slider_options['breakpoints'][ $breakpoints_data[ $i ]['width'] ]['fixedHeight'] = 80;
				}
			}
		}
		// foreach ( $breakpoints_data as $key => $breakpoint_data ) {
		// 	if ( $breakpoint_data['key'] !== 'desktop' ) {
		// 		$main_slider_options['breakpoints'][ $breakpoint_data['width'] ] =
		// 		[
		// 			'height' => $settings[ 'slider_height:' . $breakpoint_data['key'] ] ?? 400,
		// 		];

		// 		$thumb_slider_options['breakpoints'][ $breakpoint_data['width'] ] =
		// 		[
		// 			'width'   => isset( $settings[ 'thumb_width:' . $breakpoint_data['key'] ] ) ? (int) $settings[ 'thumb_width:' . $breakpoint_data['key'] ] : 100,
		// 			'perPage' => isset( $settings[ 'thumbs_view:' . $breakpoint_data['key'] ] ) ? (int) $settings[ 'thumbs_view:' . $breakpoint_data['key'] ] : 3,
		// 			'gap'     => isset( $settings[ 'thumbs_space:' . $breakpoint_data['key'] ] ) ? (int) $settings[ 'thumbs_space:' . $breakpoint_data['key'] ] : 5,

		// 		];
		// 		if ( $breakpoint_data['width'] < 768 ) {
		// 			$thumb_slider_options['breakpoints'][ $breakpoint_data['width'] ]['direction']   = 'ltr';
		// 			$thumb_slider_options['breakpoints'][ $breakpoint_data['width'] ]['fixedHeight'] = 80;
		// 		}
		// 	}
		// }
		// print_r($bu_ts_wrapper);

		$this->set_attribute( 'bu_ts_wrapper', 'class', 'bultr-thumb-mobile-position-' . $settings['thumbs_position_mobile'] );
		if ( isset( $settings['hasLoop'] ) ) {
			$query = new Query(
				[
					'id'       => $this->id,
					'settings' => $settings,
				]
			);
		}
		?>

		<div <?php echo $this->render_attributes( '_root' ); ?>>
		<div <?php echo $this->render_attributes( 'bu_ts_wrapper' ); ?>>
		<div class="bultr-splide bultr-main-slider" data-splide=<?php echo wp_json_encode( $main_slider_options ); ?>>
		<div class="splide__arrows splide__arrows--ltr">
			<button class="splide__arrow splide__arrow--prev" type="button" disabled="" aria-label="Previous slide" aria-controls="image-carousel-track">
			<?php echo self::render_icon( $settings['ts_slider_icon_prev'] ); ?>
			</button>
			<button class="splide__arrow splide__arrow--next" type="button" disabled="" aria-label="Next slide" aria-controls="image-carousel-track">
			<?php echo self::render_icon( $settings['ts_slider_icon_next'] ); ?>
			</button>
		</div>
		<div class="splide__track">
			<ul class="splide__list">
		<?php
		if ( isset( $settings['hasLoop'] ) ) {
			$slider_item = $slider_items[0];
			$query->render( [ $this, 'render_slide_item' ], compact( 'slider_item', 'settings' ) );
			// We need to destroy the Query to explicitly remove it from the global store
		} else {
			foreach ( $slider_items as $index => $item ) {
				$this->render_slide_item( $item, $settings );
			}
		}
		?>
			</ul>
		</div>
		<?php if ( $settings['ts_slider_pagination'] === 'progress' ) { ?>
		<div class="bultr-slider-progress">
			<div class="bultr-slider-progress-bar"></div>
		</div>
		<?php } ?>
		</div>
		<div class="bultr-thumbs-wrapper">
		<div id="thumb-slider" class="bultr-splide bultr-thumb-slider" data-splide1=<?php echo wp_json_encode( $thumb_slider_options ); ?>>
		<div class="splide__arrows splide__arrows--ltr">
			<button class="splide__arrow splide__arrow--prev" type="button" disabled="" aria-label="Previous slide" aria-controls="image-carousel-track">
			<?php echo self::render_icon( $settings['thumb_slider_icon_prev'] ); ?>
			</button>
			<button class="splide__arrow splide__arrow--next" type="button" disabled="" aria-label="Next slide" aria-controls="image-carousel-track">
			<?php echo self::render_icon( $settings['thumb_slider_icon_next'] ); ?>
			</button>
		</div>
		<div class="splide__track">
			<ul class="splide__list">
			<?php
			if ( isset( $settings['hasLoop'] ) ) {
				$slider_item = $slider_items[0];
				$query->render( [ $this, 'render_thumbnail_item' ], compact( 'slider_item', 'settings' ) );
				// We need to destroy the Query to explicitly remove it from the global store
			} else {
				foreach ( $slider_items as $index => $item ) {
					$this->render_thumbnail_item( $item, $settings );
				}
			}
			?>
			</ul>
		</div>
		</div>	
		</div>
		</div>
	</div>
		<?php
		if ( isset( $settings['hasLoop'] ) ) {
			$query->destroy();
			unset( $query );
		}
	}

	public function render_slide_item( $item, $settings ) {
		$index = $this->loop_index;

		if ( isset( $item['button_link'] ) ) {
			$this->set_link_attributes( "item-{$index}" . '-link-attributes', $item['button_link'] );
		}

		$img = $this->get_normalized_image_settings( $item, 'slider_image' );
		if ( is_null($img)) {
			return;
		}

		?>
		<li class="splide__slide">
			<div class="bultr-slide-image" style="background-image: url('<?php echo $img['url']; ?>');" >
			<?php echo isset( $settings['slide_overlay'] ) ? '<div class="bultr-slide-overlay"></div>' : ''; ?>
		<?php
		if ( isset( $item['slide_heading'] ) || isset( $item['slide_desc'] ) || isset( $item['button_text'] ) ) {
			?>
			<div class="bultr-slider-inner">
				<div class="bultr-slide-content">
				<?php if ( isset( $item['slide_heading'] ) ) { ?>
					<div class="bultr-slide-heading">
						<?php echo $this->render_dynamic_data( $item['slide_heading'] ); ?></div>
						<?php
				}
				if ( isset( $item['slide_desc'] ) ) {
					?>
					<div class="bultr-slide-description">
					<?php echo $this->render_dynamic_data( $item['slide_desc'] ); ?>
					</div>
						<?php
				}
				if ( isset( $item['button_text'] ) ) {
					$this->set_attribute( "item-{$index}" . '-link-attributes', 'class', 'bultr-slide-button' );
					if ( isset( $item['button_class'] ) ) {
						$this->set_attribute( "item-{$index}" . '-link-attributes', 'class', $item['button_class'] );
					}
					?>
					<a <?php echo $this->render_attributes( "item-{$index}" . '-link-attributes' ); ?>> 
						<span class="bultr-slide-btn-text">
					<?php echo $this->render_dynamic_data( $item['button_text'] ); ?>
						</span> 
					</a>
					<?php
				}
				?>
				</div>
			</div>
				<?php
		}
		?>
			</div>
		</li>
		<?php
		$this->loop_index++;
	}

	public function render_thumbnail_item( $item, $settings ) {
		$index = $this->loop_index;

		if ( isset( $item['button_link'] ) ) {
			$this->set_link_attributes( "item-{$index}" . '-link-attributes', $item['button_link'] );
		}

		

		if ( isset( $item['custom_thumbnail'] ) ) {
			$img = $this->get_normalized_image_settings( $item, 'thumb_slider_image' );
		} else {
			$img = $this->get_normalized_image_settings( $item, 'slider_image' );
		}
		
		if ( is_null($img)) {
			return;
		}

		?>
		<li class="splide__slide">
			<div class="bultr-slide-image" style="background-image: url('<?php echo $img['url']; ?>');" >
		<?php echo isset( $settings['thumb_slide_overlay'] ) ? '<div class="bultr-slide-overlay"></div>' : ''; ?>
					</div>
		</li>
		<?php
		$this->loop_index++;
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

	public function get_slide_image( $item ) {
		$img_url = '';
		if ( isset( $item['slider_image']['useDynamicData']['name'] ) ) {
			$img = $this->render_dynamic_data_tag( $item['slider_image']['useDynamicData']['name'], 'image', [ 'size' => $item['slider_image']['size'] ] );
			if ( ! empty( $img[0] ) ) {
				if ( is_numeric( $img[0] ) ) {
					$img_url = wp_get_attachment_image_url( $img[0], $item['slider_image']['size'] );
				} else {
					$img_url = $img[0];
				}
			}
			if ( ! empty( $img_id ) ) {
				?>
					<?php $img_url = wp_get_attachment_image_url( $img_id, $item['slider_image']['size'] ); ?>
					<?php
			}
		} else {
			if ( ! isset( $item['slider_image']['id'] ) ) {
				?>
					<?php $img_url = $item['slider_image']['url']; ?>
					<?php
			} else {
				$img_id = $item['slider_image']['id'];
				?>
					<?php $img_url = wp_get_attachment_image_url( $img_id, $item['slider_image']['size'] ); ?>
					<?php
			}
		}
		return $img_url;
	}
}
