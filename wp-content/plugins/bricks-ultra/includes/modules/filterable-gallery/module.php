<?php

namespace BricksUltra\Modules\FilterableGallery;

use Bricks\Element;
class Module extends Element {

	public $category     = 'ultra';
	public $name         = 'wpvbu-filterable-gallery';
	public $icon         = 'ti-gallery';
	public $css_selector = '';
	public $scripts      = [ 'bricksUltraFilterableGallery' ];
	public $loop_index   = 1;
	public $bu_notice    = '';
	public $notice_count = '';
	public $images_added = false;
	// Methods: Builder-specific
	public function get_label() {
		return esc_html__( 'Filterable Gallery', 'wpv-bu' );
	}

	public function enqueue_scripts() {
		$layout                = $this->settings['filterImageLayout'] ?? 'grid';
		$tilt                  = $this->settings['enableTilt'] ?? false;
		$hover_aware_direction = $this->settings['hoverDirectionAware'] ?? false;
		wp_enqueue_script( 'bricks-isotope' );
		wp_enqueue_style( 'bricks-isotope' );

		$link_to       = ! empty( $this->settings['link'] ) ? $this->settings['link'] : false;
		$enableOverlay = $settings['enableOverlay'] ?? false;

		if ( $link_to === 'lightbox' || $enableOverlay ) {
			wp_enqueue_script( 'bricks-photoswipe' );
			wp_enqueue_style( 'bricks-photoswipe' );
		}

		if ( $layout === 'justified' ) {
			wp_enqueue_style( 'bultr-justified', WPV_BU_URL . 'assets/vendor/justifiedGallery/css/justifiedGallery.min.css', '', '3.8.1' );
			wp_enqueue_script( 'bultr-justified', WPV_BU_URL . 'assets/vendor/justifiedGallery/js/justifiedGallery.min.js', [ 'jquery' ], '3.8.1', true );
		}

		if ( $tilt ) {
			wp_enqueue_script( 'bultr-tilt', WPV_BU_URL . 'assets/vendor/vanilla-tilt/vanilla-tilt.min.js', [], '0.0.1', true );
		}

		if ( $hover_aware_direction ) {
			wp_enqueue_script( 'bultr-hover-aware', WPV_BU_URL . 'assets/vendor/hover-aware/directionHoverAware.min.js', [ 'jquery' ], '0.0.1', true );
		}
		wp_enqueue_style( 'bultr-module-style' );
		wp_enqueue_script( 'bultr-module-script' );
	}


	public function set_control_groups() {

		$this->control_groups['filters'] = [
			'title' => esc_html__( 'Filters', 'wpv-bu' ),
			'tab'   => 'content',
		];

		$this->control_groups['settings'] = [
			'title' => esc_html__( 'Settings', 'wpv-bu' ),
			'tab'   => 'content',
		];

		$this->control_groups['filter_style'] = [
			'title' => esc_html__( 'Filters - Style', 'wpv-bu' ),
			'tab'   => 'content',
		];

		$this->control_groups['image_style'] = [
			'title' => esc_html__( 'Image - Style', 'wpv-bu' ),
			'tab'   => 'content',
		];

		$this->control_groups['overlay_style'] = [
			'title'    => esc_html__( 'Overlay - Style', 'wpv-bu' ),
			'tab'      => 'content',
			'required' => [
				[ 'enableOverlay', '!=', '' ],
			],
		];
	}

	public function set_controls() {

		$this->controls['filters'] = [
			'tab'         => 'content',
			'group'       => 'filters',
			'placeholder' => esc_html__( 'Item', 'wpv-bu' ),
			'type'        => 'repeater',
			'checkLoop'   => true,
			'fields'      => [
				'icon' => [
					'label' => esc_html__( 'Icon', 'wpv-bu' ),
					'type'  => 'icon',
				],
				'iconPosition' => [
					'label'       => esc_html__( 'Icon position', 'wpv-bu' ),
					'type'        => 'select',
					'options'     => $this->control_options['iconPosition'],
					'inline'      => true,
					'placeholder' => esc_html__( 'Left', 'wpv-bu' ),
					'required'    => [ 'icon', '!=', '' ],
				],
				'title' => [
					'label' => esc_html__( 'Title', 'wpv-bu' ),
					'type'  => 'text',
					'inline'=>true,
				],
				'items' => [
					'label' => esc_html__( 'Images', 'wpv-bu' ),
					'type'  => 'image-gallery',
				],
				'active_on_load' => [
					'label' => esc_html__( 'Active On Load', 'wpv-bu' ),
					'type'  => 'checkbox',
				],
			],
			'default'     => [
				[
					'title' => esc_html__( 'Filter 1', 'wpv-bu' ),
					'id'    => 'filter-' . wp_rand( 0, 99999 ),
					'items' => [
						[
							'full' => 'https://source.unsplash.com/random/800x400?tech',
							'url'  => 'https://source.unsplash.com/random/800x400?tech',
						],
					],
				],
				[
					'title' => esc_html__( 'Filter 2', 'wpv-bu' ),
					'id'    => 'filter-' . wp_rand( 0, 99999 ),
					'items' => [
						[
							'full' => 'https://source.unsplash.com/random/800x400?contruction',
							'url'  => 'https://source.unsplash.com/random/800x400?contruction',
						],
					],
				],
				[
					'title' => esc_html__( 'Filter 3', 'wpv-bu' ),
					'id'    => 'filter-' . wp_rand( 0, 99999 ),
					'items' => [
						[
							'full' => 'https://source.unsplash.com/random/800x400?building',
							'url'  => 'https://source.unsplash.com/random/800x400?building',
						],
					],
				],
			],
		];

		$this->controls['separator_layout'] = [
			'tab'   => 'content',
			'group' => 'settings',
			'label' => esc_html__( 'Layout', 'wpv-bu' ),
			'type'  => 'separator',
		];

		//Setting Group
		$this->controls['filterImageLayout'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Layout', 'wpv-bu' ),
			'type'        => 'select',
			'options'     => [
				'grid'    => esc_html__( 'Grid', 'wpv-bu' ),
				'masonry' => esc_html__( 'Masonry', 'wpv-bu' ),
				//phpcs ignore: Squiz.PHP.CommentedOutCode.Found
			],
			'placeholder' => esc_html__( 'Grid', 'wpv-bu' ),
			'inline'      => true,
			'rerender'    => true,
			'default'     => 'grid',
			'clearable'   => false,
		];

		$this->controls['enableImageRatio'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Aspect Ratio', 'wpv-bu' ),
			'type'     => 'checkbox',
			'default'  => false,
			'inline'   => true,
			'required' => [ 'filterImageLayout', '!=', [ 'masonry', 'justified' ] ],
		];
		$this->controls['image_ratio']      = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Ratio', 'wpv-bu' ),
			'type'     => 'number',
			'min'      => 0.1,
			'step'     => '0.1', // Default: 1
			'max'      => 2,
			'inline'   => true,
			'default'  => 0.66,
			'required' => [
				[ 'enableImageRatio', '=', true ],
				[ 'filterImageLayout', '!=', [ 'masonry', 'justified' ] ],
			],
			'css'      => [
				[
					'selector' => '.bultr-layout-item.bultr-img-ratio .bultr-layout-item-inner',
					'property' => 'padding-bottom',
					'value'    => 'calc(%s * 100%)',
				],
			],
		];

		
		$this->controls['rowHeight'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Row height', 'wpv-bu' ),
			'type'        => 'number',
			'info'        => esc_html__( 'Precedes image ratio setting.', 'wpv-bu' ),
			'placeholder' => esc_html__( '200', 'wpv-bu' ),
			'required'    => [ 'filterImageLayout', '=', [ 'justified' ] ],
		];

		$this->controls['imageGap'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Gap', 'wpv-bu' ),
			'type'        => 'number',
			'placeholder' => esc_html__( '10', 'wpv-bu' ),
			'required'    => [ 'filterImageLayout', '=', [ 'justified' ] ],
		];

		$this->controls['lastRow'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Last Row', 'wpv-bu' ),
			'type'        => 'select',
			'options'     => [
				'justify'   => esc_html__( 'Justify', 'wpv-bu' ),
				'nojustify' => esc_html__( 'No Justify', 'wpv-bu' ),
				'left'      => esc_html__( 'Left', 'wpv-bu' ),
				'center'    => esc_html__( 'Center', 'wpv-bu' ),
				'right'     => esc_html__( 'Right', 'wpv-bu' ),
				'hide'      => esc_html__( 'Hide', 'wpv-bu' ),
			],
			'inline'      => true,
			'placeholder' => esc_html__( 'Justify', 'wpv-bu' ),
			'required'    => [ 'filterImageLayout', '=', [ 'justified' ] ],
		];

		$this->controls['maxRow'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Max Row', 'wpv-bu' ),
			'type'        => 'number',
			'placeholder' => esc_html__( '0', 'wpv-bu' ),
			'required'    => [ 'filterImageLayout', '=', [ 'justified' ] ],
		];

		$this->controls['spacing'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Spacing', 'wpv-bu' ),
			'type'        => 'number',
			'unit'        => 'px',
			'default'     => 10,
			'css'         => [
				[
					'selector' => '',
					'property' => '--bu-spacing',
					'value'    => '%s',
				],
				
				[
					'property' => 'column-gap',
					'selector' => '.bultr-gal-layout-grid .bultr-gallery',
				],
				[
					'property' => 'row-gap',
					'selector' => '.bultr-gal-layout-grid .bultr-gallery',
				],
				
				[
					'property' => 'margin-bottom',
					'selector' => '.bultr-gal-layout-masonry .bultr-layout-item',
				],

								// NOTE: Undocumented
			],
			'required'    => [ 'filterImageLayout', '!=', [ 'justified' ] ],
			'placeholder' => 0,
			'rerender'    => true,
		];

		$this->controls['masonry_columns'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Columns', 'wpv-bu' ),
			'type'        => 'number',
			'min'         => 1,
			'breakpoints' => true,
			'default'     => 3,
			'required'    => [ 'filterImageLayout', '!=', [ 'justified' ] ],
			'css'         => [
				[
					'selector' => '',
					'property' => '--bu-columns',
					'value'    => '%s',
				],
				
			],
			'required'    => [ 'filterImageLayout', '=', [ 'masonry' ] ],
			'rerender'    => true,
		];

		$this->controls['columns'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Columns', 'wpv-bu' ),
			'type'        => 'number',
			'min'         => 1,
			'breakpoints' => true,
			'default'     => 3,
			'required'    => [ 'filterImageLayout', '!=', [ 'justified' ] ],
			'css'         => [
				

				[
					'selector' => '.bultr-gal-layout-grid .bultr-gallery',
					'property' => 'grid-template-columns',
					'value'    => 'repeat(%s,1fr)', // NOTE: Undocumented (@since 1.3)
				],
			],
			'rerender'    => true,
			'required'    => [ 'filterImageLayout', '=', [ 'grid' ] ],
		];

		$this->controls['link'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Link to', 'wpv-bu' ),
			'type'        => 'select',
			'options'     => [
				'lightbox'   => esc_html__( 'Lightbox', 'wpv-bu' ),
				'attachment' => esc_html__( 'Attachment Page', 'wpv-bu' ),
				'media'      => esc_html__( 'Media File', 'wpv-bu' ),
				'custom'     => esc_html__( 'Custom URL', 'wpv-bu' ),
			],
			'inline'      => true,
			'placeholder' => esc_html__( 'None', 'wpv-bu' ),
		];

		$this->controls['lightboxImageSize'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Lightbox image size', 'wpv-bu' ),
			'type'        => 'select',
			'options'     => $this->control_options['imageSizes'],
			'placeholder' => esc_html__( 'Full', 'wpv-bu' ),
			'required'    => [ 'link', '=', 'lightbox' ],
		];

		$this->controls['linkCustom'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Custom links', 'wpv-bu' ),
			'type'        => 'repeater',
			'fields'      => [
				'link' => [
					'label'   => esc_html__( 'Link', 'wpv-bu' ),
					'type'    => 'link',
					'exclude' => [
						'lightboxImage',
						'lightboxVideo',
					],
				],
			],
			'placeholder' => esc_html__( 'Custom link', 'wpv-bu' ),
			'required'    => [ 'link', '=', 'custom' ],
		];

		$this->controls['enable_all_tab'] = [
			'tab'     => 'content',
			'group'   => 'settings',
			'label'   => esc_html__( 'Enable All Tab', 'wpv-bu' ),
			'type'    => 'checkbox',
			'inline'  => true,
			'small'   => true,
			'default' => true, // Default: false
		];

		$this->controls['allTabText'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'type'        => 'text',
			'label'       => esc_html__( '"ALL" Tab Text', 'wpv-bu' ),
			'default'     => esc_html__( 'All', 'wpv-bu' ),
			'placeholder' => esc_html__( 'All', 'wpv-bu' ),
			'inline'      => true,
			'required'    => [
				[ 'enable_all_tab', '=', true ],
			],
		];

		//Group Tilt

		$this->controls['separator_tilt'] = [
			'tab'   => 'content',
			'group' => 'settings',
			'label' => esc_html__( 'Tilt', 'wpv-bu' ),
			'type'  => 'separator',
		];

		$this->controls['enableTilt'] = [
			'tab'   => 'content',
			'group' => 'settings',
			'label' => esc_html__( 'Enable', 'wpv-bu' ),
			'type'  => 'checkbox',
		];

		$this->controls['tiltMax'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Max Tilt', 'wpv-bu' ),
			'type'        => 'number',
			'min'         => 1,
			'breakpoints' => true,
			'placeholder' => 20,
			'required'    => [ 'enableTilt', '!=', '' ],
		];

		$this->controls['tiltPerspective'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Perspective', 'wpv-bu' ),
			'type'        => 'number',
			'min'         => 100,
			'breakpoints' => true,
			'placeholder' => 800,
			'required'    => [ 'enableTilt', '!=', '' ],
		];

		$this->controls['speedPerspective'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Speed', 'wpv-bu' ),
			'type'        => 'number',
			'min'         => 100,
			'breakpoints' => true,
			'placeholder' => 300,
			'required'    => [ 'enableTilt', '!=', '' ],
		];

		$this->controls['tiltAxis'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Axis', 'wpv-bu' ),
			'type'     => 'select',
			'inline'	=> true,
			'options'  => [
				'both' => __( 'Both', 'wpv-bu' ),
				'x'    => __( 'X', 'wpv-bu' ),
				'y'    => __( 'Y', 'wpv-bu' ),
			],
			'required' => [ 'enableTilt', '!=', '' ],
		];

		$this->controls['tiltGlare'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Glare', 'wpv-bu' ),
			'type'     => 'checkbox',
			'required' => [ 'enableTilt', '!=', '' ],
		];

		$this->controls['tiltMaxGlare'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Max Glare', 'wpv-bu' ),
			'type'        => 'number',
			'min'         => 0,
			'breakpoints' => true,
			'placeholder' => 0.5,
			'required'    => [
				[ 'enableTilt', '!=', '' ],
				[ 'tiltGlare', '!=', '' ],
			],
		];

		$this->controls['separator_hover'] = [
			'tab'   => 'content',
			'group' => 'settings',
			'label' => esc_html__( 'Hover', 'wpv-bu' ),
			'type'  => 'separator',
		];

		$this->controls['enableOverlay'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Overlay', 'wpv-bu' ),
			'type'     => 'checkbox',
			'rerender' => false,
		];

		$this->controls['showOverlay'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Show Overlay', 'wpv-bu' ),
			'type'     => 'select',
			'default'  => 'hover',
			'inline'	=>true,
			'options'  => [
				'hover'         => __( 'On Hover', 'wpv-bu' ),
				'always'        => __( 'Always', 'wpv-bu' ),
				'hide-on-hover' => __( 'Hide on Hover', 'wpv-bu' ),
			],
			'required' => [ 'enableOverlay', '!=', '' ],
		];

		$this->controls['showCaption'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Caption', 'wpv-bu' ),
			'type'     => 'checkbox',
			'rerender' => false,
			'required' => [ 'enableOverlay', '!=', '' ],
		];

		$this->controls['captionType'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Caption Type', 'wpv-bu' ),
			'type'        => 'select',
			'placeholder' => 'Caption',
			'inline'=>true,
			'options'     => [
				'title'       => __( 'Title', 'wpv-bu' ),
				'caption'     => __( 'Caption', 'wpv-bu' ),
				'description' => __( 'Description', 'wpv-bu' ),
			],
			'required'    => [
				[ 'enableOverlay' ],
				[ 'showCaption' ],
			],
		];

		$this->controls['overlayIcon'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Icon', 'wpv-bu' ),
			'type'     => 'icon',
			'default'  => [
				'library' => 'ionicons',
				'icon'    => 'ion-ios-add-circle-outline',
			],
			'rerender' => true,
			'required' => [ 'enableOverlay', '!=', '' ],
		];

		$this->controls['hoverDirectionAware'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Hover Direction Aware', 'wpv-bu' ),
			'type'     => 'checkbox',
			'rerender' => false,
			'required' => [
				[ 'enableOverlay', '!=', '' ],
				[ 'showOverlay', '=', 'hover' ],
			
			]
		];

		$this->controls['overlaySpeed'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Overlay Speed', 'wpv-bu' ),
			'type'        => 'number',
			'min'         => 100,
			'step'        => 100,
			'max'         => 1000,
			'default'     => 500,
			'placeholder' => 500,
			'required'    => [
				[ 'enableOverlay' ],
				[ 'hoverDirectionAware' ],
			],
		];

		$this->controls['enableHoverScale'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Hover Scale', 'wpv-bu' ),
			'type'     => 'checkbox',
			'rerender' => false,
			'required' => [
				[ 'enableImageRatio', '!=', true ],
			],
		];

		$this->controls['hoverScale'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Scale', 'wpv-bu' ),
			'type'        => 'number',
			'min'         => 0,
			'step'        => .1,
			'max'         => 2,
			'default'     => 1.2,
			'placeholder' => 1.1,
			'css'         => [
				[
					'property' => 'transform',
					'selector' => '.bultr-gallery.hover-scale :not(.bultr-img-ratio) .bultr-layout-item-inner:hover img',
					'value'    => 'scale(%s)',
				],
			],
			'required'    => [
				[ 'enableHoverScale', '=', true ],
				[ 'enableImageRatio', '!=', true ],
			],
		];

		// Filter - Style

		$this->controls['filterGrow'] = [
			'tab'   => 'content',
			'group' => 'filter_style',
			'label' => esc_html__( 'Stretch', 'wpv-bu' ),
			'type'  => 'checkbox',
			'css'   => [
				[
					'selector' => '.bultr-filter-title',
					'property' => 'flex-grow',
					'value'    => '1',
				],
			],
		];

		$this->controls['filterJustify'] = [
			'tab'   => 'content',
			'group' => 'filter_style',
			'label' => esc_html__( 'Align', 'wpv-bu' ),
			'type'  => 'justify-content',
			'css'   => [
				[
					'property' => 'justify-content',
					'selector' => '.bultr-filters-title',
				],
			],
		];

		$this->controls['filterGap'] = [
			'tab'     => 'content',
			'group'   => 'filter_style',
			'label'   => esc_html__( 'Gap', 'wpv-bu' ),
			'type'    => 'number',
			'min'     => 0,
			'step'    => 1, // Default: 1
			'max'     => 200,
			'unit'    => 'px',
			'inline'  => true,
			'css'     => [
				[
					'property' => 'gap',
					'selector' => '.bultr-filters-title',
				],
			],
			'default' => 5,
		];
		$this->controls['filterspacing'] = [
			'tab'     => 'content',
			'group'   => 'filter_style',
			'label'   => esc_html__( 'Spacing', 'wpv-bu' ),
			'type'    => 'number',
			'min'     => 0,
			'step'    => 1, // Default: 1
			'max'     => 200,
			'unit'    => 'px',
			'inline'  => true,
			'css'     => [
				[
					'property' => 'margin-bottom',
					'selector' => '.bultr-filters-title',
				],
			],
			'default' => 10,
		];

		$this->controls['filterPadding'] = [
			'tab'     => 'content',
			'group'   => 'filter_style',
			'label'   => esc_html__( 'Padding', 'wpv-bu' ),
			'type'    => 'dimensions',
			'css'     => [
				[
					'property' => 'padding',
					'selector' => '.bultr-filter-title',
				],
			],
			'default' => [
				'top'    => 10,
				'right'  => 20,
				'bottom' => 10,
				'left'   => 20,
			],
		];

		$this->controls['filterTypography'] = [
			'tab'   => 'content',
			'group' => 'filter_style',
			'label' => esc_html__( 'Typography', 'wpv-bu' ),
			'type'  => 'typography',
			'css'   => [
				[
					'property' => 'font',
					'selector' => '.bultr-filter-title span',
				],
			],
		];

		$this->controls['filterBackgroundColor'] = [
			'tab'   => 'content',
			'group' => 'filter_style',
			'label' => esc_html__( 'Background', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-filter-title',
				],
			],
		];

		$this->controls['filterBorder'] = [
			'tab'   => 'content',
			'group' => 'filter_style',
			'label' => esc_html__( 'Border', 'wpv-bu' ),
			'type'  => 'border',
			'css'   => [
				[
					'property' => 'border',
					'selector' => '.bultr-filter-title',
				],
			],
		];

		$this->controls['filterActiveColor'] = [
			'tab'     => 'content',
			'group'   => 'filter_style',
			'label'   => esc_html__( 'Active Color', 'wpv-bu' ),
			'type'    => 'color',
			'css'     => [
				[
					'property' => 'color',
					'selector' => '.bultr-filter-title.active span',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-filter-title.active',
				],
			],
			'default' => [
				'hex' => '#dadada',
			],
		];

		$this->controls['filterActiveBackgroundColor'] = [
			'tab'     => 'content',
			'group'   => 'filter_style',
			'label'   => esc_html__( 'Active background', 'wpv-bu' ),
			'type'    => 'color',
			'css'     => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-filter-title.active',
				],
			],
			'default' => [
				'hex' => '#424242',
			],
		];

		$this->controls['filterActiveBorder'] = [
			'tab'   => 'content',
			'group' => 'filter_style',
			'label' => esc_html__( 'Active border', 'wpv-bu' ),
			'type'  => 'border',
			'css'   => [
				[
					'property' => 'border',
					'selector' => '.bultr-filter-title.active',
				],
			],
		];

		$this->controls['separator_filter_icon_style'] = [
			'tab'   => 'content',
			'group' => 'filter_style',
			'label' => esc_html__( 'Icon', 'wpv-bu' ),
			'type'  => 'separator',
		];

		$this->controls['filterIconColor'] = [
			'tab'     => 'content',
			'group'   => 'filter_style',
			'label'   => esc_html__( 'Color', 'wpv-bu' ),
			'type'    => 'color',
			'css'     => [
				[
					'property' => 'color',
					'selector' => '.bultr-filter-title i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-filter-title svg',
				],
			],
			'default' => [
				'hex' => '#dadada',
			],
		];

		$this->controls['filterActiveIconColor'] = [
			'tab'     => 'content',
			'group'   => 'filter_style',
			'label'   => esc_html__( 'Active Color', 'wpv-bu' ),
			'type'    => 'color',
			'css'     => [
				[
					'property' => 'color',
					'selector' => '.bultr-filter-title.active i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-filter-title.active svg',
				],
			],
			'default' => [
				'hex' => '#dadada',
			],
		];
		$this->controls['filterIconSize'] = [
			'tab'         => 'content',
			'group'       => 'filter_style',
			'label'       => esc_html__( 'Size (PX)', 'wpv-bu' ),
			'type'        => 'number',
			'default'     => 24,
			'min'         => 6,
			'step'        => 1,
			'max'         => 300,
			'placeholder' => 24,
			'css'         => [
				[
					'property' => 'font-size',
					'selector' => '.bultr-filter-title',
					'value'    => '%spx',
				],
				
			],
		];

		$this->controls['filterIconSpacing'] = [
			'tab'         => 'content',
			'group'       => 'filter_style',
			'label'       => esc_html__( 'Spacing (PX)', 'wpv-bu' ),
			'type'        => 'number',
			'defaut'      => 15,
			'css'         => [
				[
					'selector' => '.bultr-filter-title',
					'property' => 'gap',
					'value'    => '%spx',
				],
			],
			'default'     => 5,
			'min'         => 0,
			'step'        => 1,
			'max'         => 300,
			'placeholder' => 5,
		];

		$this->controls['filterIconPadding'] = [
			'tab'   => 'content',
			'group' => 'filter_style',
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'selector' => '.bultr-filter-title i',
					'property' => 'padding',
				],
				[
					'selector' => '.bultr-filter-title svg',
					'property' => 'padding',
				],
			],
		];

		$this->controls['filterIconBorder'] = [
			'tab'    => 'content',
			'group'  => 'filter_style',
			'label'  => esc_html__( 'Border', 'wpv-bu' ),
			'type'   => 'border',
			'css'    => [
				[
					'property' => 'border',
					'selector' => '.bultr-filter-title i',
				],
				[
					'property' => 'border',
					'selector' => '.bultr-filter-title svg',
				],
			],
			'inline' => true,
			'small'  => true,
		];

		$this->controls['filterIconRotate'] = [
			'tab'     => 'content',
			'group'   => 'filter_style',
			'label'   => esc_html__( 'Rotate', 'wpv-bu' ),
			'type'    => 'number',
			'css'     => [
				[
					'selector' => '.bultr-filter-title i, .bultr-filter-title svg',
					'property' => 'transform',
					'value'    => 'rotate(%sdeg)',
				],
			],

			'default' => 0,
		];

		$this->controls['filterImgActive'] = [
			'tab' => 'content',
			'group'  => 'image_style',
			'label' => esc_html__( 'Filter', 'wpv-bu' ),
			'type' => 'filters',
			'inline' => true,
			'css' => [
			  [
				'property' => 'filter',
				'selector' => '.bultr-layout-item-inner img',
			  ],
			],
		  ];
		  $this->controls['filterImgActiveHover'] = [
			'tab' => 'content',
			'group'  => 'image_style',
			'label' => esc_html__( 'Hover Filter', 'wpv-bu' ),
			'type' => 'filters',
			'inline' => true,
			'css' => [
			  [
				'property' => 'filter',
				'selector' => '.bultr-layout-item-inner:hover img',
			  ],
			],
		  ];

		$this->controls['imageBorder'] = [
			'tab'    => 'content',
			'group'  => 'image_style',
			'label'  => esc_html__( 'Border', 'wpv-bu' ),
			'type'   => 'border',
			'css'    => [
				[
					'property' => 'border',
					'selector' => '.bultr-layout-item',
				],
			],
			'inline' => true,
			'small'  => true,
		];

		$this->controls['imageBackgroundColor'] = [
			'tab'   => 'content',
			'group' => 'image_style',
			'label' => esc_html__( 'Background Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-layout-item',
				],
			],
		];

		$this->controls['imagePadding'] = [
			'tab'   => 'content',
			'group' => 'image_style',
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.bultr-layout-item',
				],
			],
		];

		$this->controls['overlayBackgroundColor'] = [
			'tab'     => 'content',
			'group'   => 'overlay_style',
			'label'   => esc_html__( 'Color', 'wpv-bu' ),
			'type'    => 'color',
			'css'     => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-overlay',
				],
			],
			'default' => [
				'hex' => '#00000080',
			],
		];
		$this->controls['overlayContentGap'] = [
			'tab'     => 'content',
			'group'   => 'overlay_style',
			'label'   => esc_html__( 'Gap', 'wpv-bu' ),
			'type'    => 'number',
			'unit'	  => 'px',
			'css'     => [
				[
					'property' => 'gap',
					'selector' => '.bultr-overlay-inner',
				],
			]	
		];

		$this->controls['separator_caption_style'] = [
			'tab'   => 'content',
			'group' => 'overlay_style',
			'label' => esc_html__( 'Caption', 'wpv-bu' ),
			'type'  => 'separator',
		];

		$this->controls['captionTypography'] = [
			'tab'   => 'content',
			'group' => 'overlay_style',
			'label' => esc_html__( 'Typography', 'wpv-bu' ),
			'type'  => 'typography',
			'css'   => [
				[
					'Content Typographyproperty' => 'font',
					'selector' => '.bultr-overlay .bultr-overlay-caption',
				],
			],
		];

		$this->controls['separator_overlay_icon_style'] = [
			'tab'   => 'content',
			'group' => 'overlay_style',
			'label' => esc_html__( 'Icon', 'wpv-bu' ),
			'type'  => 'separator',
		];

		$this->controls['overlayIconColor'] = [
			'tab'     => 'content',
			'group'   => 'overlay_style',
			'label'   => esc_html__( 'Color', 'wpv-bu' ),
			'type'    => 'color',
			'css'     => [
				[
					'property' => 'color',
					'selector' => '.bultr-overlay .bultr-overlay-inner i',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-overlay .bultr-overlay-inner svg',
				],
			],
			'default' => [
				'hex' => '#dadada',
			],
		];

		$this->controls['overlayIconSize'] = [
			'tab'         => 'content',
			'group'       => 'overlay_style',
			'label'       => esc_html__( 'Size (PX)', 'wpv-bu' ),
			'type'        => 'number',
			'default'     => 24,
			'min'         => 6,
			'step'        => 1,
			'max'         => 300,
			'placeholder' => 24,
			'css'         => [
				[
					'property' => 'font-size',
					'selector' => '.bultr-overlay .bultr-overlay-inner',
					'value'    => '%spx',
				],
			],
		];

		$this->controls['overlayIconPadding'] = [
			'tab'   => 'content',
			'group' => 'overlay_style',
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'selector' => '.bultr-overlay .bultr-overlay-inner i',
					'property' => 'padding',
				],
			],
		];

		$this->controls['overlayIconBorder'] = [
			'tab'    => 'content',
			'group'  => 'overlay_style',
			'label'  => esc_html__( 'Border', 'wpv-bu' ),
			'type'   => 'border',
			'css'    => [
				[
					'property' => 'border',
					'selector' => '.bultr-overlay .bultr-overlay-inner i',
				],
			],
			'inline' => true,
			'small'  => true,
		];

		$this->controls['overlayIconRotate'] = [
			'tab'     => 'content',
			'group'   => 'overlay_style',
			'label'   => esc_html__( 'Rotate', 'wpv-bu' ),
			'type'    => 'number',
			'css'     => [
				[
					'selector' => '.bultr-overlay .bultr-overlay-inner i, .bultr-overlay .bultr-overlay-inner svg',
					'property' => 'transform',
					'value'    => 'rotate(%sdeg)',
				],
			],

			'default' => 0,
		];
	}

	public function get_active_filter_tab( $filters ) {
		$active_tab = '';
		foreach ( $filters as $index => $filter ) {
			if ( isset( $filter['active_on_load'] ) ) {
				$active_tab = $filter['id'];
			}
		}
		return $active_tab;
	}

	public function render_filter_items($filter,$gallery_index,$settings){
		
		// die('fadfaf');
		$size   = ! empty( $filter['items']['size'] ) ? $filter['items']['size'] : BRICKS_DEFAULT_IMAGE_SIZE;
		$images = isset($filter['items']['images']) ? $filter['items']['images'] : [];
		//echo '<pre>';  print_r($images); echo '</pre>';
		$link_to = ! empty( $settings['link'] ) ? $settings['link'] : false;
		$layout             = ! empty( $settings['filterImageLayout'] ) ? $settings['filterImageLayout'] : 'grid';
		$tilt               = $settings['enableTilt'] ?? false;
		$enableOverlay      = $settings['enableOverlay'] ?? false;
		$breakpoint_classes = [];
		
		$showOverlay = '';
		$gutter      = isset( $settings['gutter'] ) ? $settings['gutter'] : '0px';
		if(empty($images)){
			return;
		}
		foreach ( $images as $index => $image ) {
			// if(empty($image['url'])){
			// 	continue;
			// }
			$item_classes  = [ 'bultr-layout-item', 'all', $filter['id'] ];
			$image_styles  = [];
			$image_classes = ['bricks-layout-inner'];
			$caption = ! empty( $image['caption'] ) ? $image['caption'] : '';
			$alt     = ! empty( $image['alt'] ) ? $image['alt'] : '';
			$enableOverlay      = $settings['enableOverlay'] ?? false;

			if ( $enableOverlay ) {
				$showOverlay = "overlay-{$settings['showOverlay']}";
			}
			if ( count( $breakpoint_classes ) ) {
				$item_classes = array_merge( $item_classes, $breakpoint_classes );
			}

			if ( $showOverlay !== '' ) {
				$item_classes = array_merge( $item_classes, [ $showOverlay ] );
			}

			if ( $tilt ) {
				$item_classes = array_merge( $item_classes, [ 'bultr-tilt' ] );
			}
			
			// $this->set_attribute( "item-{$index}", 'class', $item_classes );
			$this->set_attribute( "img-{$index}-{$gallery_index}", 'class', $item_classes );
			if ( isset( $settings['enableImageRatio'] ) && $layout === 'grid' ) {
				$this->set_attribute( "img-{$index}-{$gallery_index}", 'class', 'bultr-img-ratio' );
			}
			// Get image url, width and height (Fallback: Placeholder image)
			if ( isset( $item['id'] ) ) {
				$image_src = wp_get_attachment_image_src( $item['id'], $size );
			} elseif ( isset( $item['url'] ) ) {
				$image_src = [ $item['url'], 800, 600 ];
			}

			$image_src = ! empty( $image_src ) && is_array( $image_src ) ? $image_src : [ \Bricks\Builder::get_template_placeholder_image(), 800, 600 ];

			$image_url    = ! empty( $image_src[0] ) ? $image_src[0] : ( isset( $item['url'] ) ? $item['url'] : '' );
			$image_width  = ! empty( $image_src[1] ) ? $image_src[1] : 200;
			$image_height = ! empty( $image_src[2] ) ? $image_src[2] : 200;

			if ( $image_width ) {
				$this->set_attribute( "img-{$index}-{$gallery_index}", 'width', $image_width );
			}

			if ( $image_height ) {
				$this->set_attribute( "img-{$index}-{$gallery_index}", 'height', $image_height );
			}
			if(isset($image['id'])){
				$this->set_attribute( "img-{$index}-{$gallery_index}", 'data-id', $image['id'] );
			}
			
			
			// Image lazy load
			if ( $this->lazy_load() ) {
				$image_classes[] = 'bricks-lazy-hidden';
				//phpcs ignore: Squiz.PHP.CommentedOutCode.Found
			}

			$close_a_tag = false;
			?>
			<li <?php echo $this->render_attributes("img-{$index}-{$gallery_index}");?>>
				<?php
				if($link_to){
					if ( $link_to === 'attachment' && isset( $image['id'] ) ) {
						$close_a_tag = true;
						echo '<a href="' . get_permalink( $image['id'] ) . '" target="_blank" class="bultr-layout-item-inner">';
					} elseif ( $link_to === 'media' ) {
						$close_a_tag = true;
						
						echo '<a href="' . esc_url( $image['url'] ) . '" target="_blank" class="bultr-layout-item-inner">';
					} elseif ( $link_to === 'custom' && isset( $settings['linkCustom'][ 0 ]['link'] ) ) {
						$close_a_tag = true;
		
						$this->set_link_attributes( "a-$index-{$gallery_index}", $settings['linkCustom'][ 0 ]['link'] );
		
						echo "<a {$this->render_attributes( "a-$index-{$gallery_index}" )}  class='bultr-layout-item-inner'>";
					}
					// Lightbox attributes
					elseif ( $link_to === 'lightbox' ) {
						$lightbox_image_size = ! empty( $settings['lightboxImageSize'] ) ? $settings['lightboxImageSize'] : 'full';
						$lightbox_image      = ! empty( $image['id'] ) ? wp_get_attachment_image_src( $image['id'], $lightbox_image_size ) : false;
						$lightbox_image      = ! empty( $lightbox_image ) && is_array( $lightbox_image ) ? $lightbox_image : [ ! empty( $image['url'] ) ? $image['url'] : '', 800, 600 ];
						
						$this->set_attribute( "a-$index-{$gallery_index}", 'class', 'bultr-layout-item-inner' );
						$this->set_attribute( "a-$index-{$gallery_index}", 'href', $lightbox_image[0] );
						$this->set_attribute( "a-$index-{$gallery_index}", 'data-pswp-src', $lightbox_image[0] );
						$this->set_attribute( "a-$index-{$gallery_index}", 'data-pswp-width', $lightbox_image[1] );
						$this->set_attribute( "a-$index-{$gallery_index}", 'data-pswp-height', $lightbox_image[2] );
		
						$close_a_tag = true;
		
						echo "<a {$this->render_attributes( "a-$index-{$gallery_index}" )}>";
					}
				}else{
					?>
					<div class="bultr-layout-item-inner">
					<?php
				}
					
		
					if ( $layout === 'masonry' ) {
						$image_atts = [ 'class' => implode( ' ', $image_classes ) ];
						if(isset($image['id'])){
							echo wp_get_attachment_image( $image['id'], $size, false, $image_atts );	
						}
						
					} else {
						$image_atts = [ 'class' => implode( ' ', $image_classes ) ];
						if(isset($image['id'])){
							echo wp_get_attachment_image( $image['id'], $size, false, $image_atts );
						}
						
					}

					if(isset($settings['enableOverlay']) && $settings['enableOverlay']){
						?>
						<div class="bultr-overlay">
							<div class="bultr-overlay-inner">
								<?php
									if ( ! empty( $settings['overlayIcon'] ) ) {
										$icon = self::render_icon( $settings['overlayIcon'] );
										if ( $icon ) {
											echo $icon;
										}
									}
								?>
								<?php if (isset($settings['showCaption']) && $settings['showCaption'] ) { ?>
									<?php 
										$captionType = $settings['captionType'] ?? 'caption';
										switch ($captionType) {
											case 'title': $caption = get_post_field( 'post_title', $image['id'] );
														  break;
											case 'caption': $caption = get_post_field( 'post_excerpt', $image['id'] );
												break;
												
											case 'description': $caption = get_post_field( 'post_content', $image['id'] );
																break;	
										}
									if(!empty($caption)){
									?>
									<div class="bultr-overlay-caption">
										<?php echo $caption; ?>
									</div>
									<?php } ?>
								<?php } ?>
							</div>
						</div>
						<?php
					}
	
		
					if ( $close_a_tag ) {
						echo '</a>';
					}else{
						echo "</div>";
					}
				?>
			</li>
			<?php
		}
	}


	public function render(){
		$settings              = $this->get_normalized_image_settings( $this->settings );
		//echo '<pre>';  print_r($settings); echo '</pre>';
		$filters               = ! empty( $settings['filters'] ) ? $settings['filters'] : false;
		$layout                = ! empty( $settings['filterImageLayout'] ) ? $settings['filterImageLayout'] : 'grid';
		$active_filter_tab     = '';
		$tilt                  = $settings['enableTilt'] ?? false;
		$hover_aware_direction = $settings['hoverDirectionAware'] ?? false;

		$data_settings = [];

		if ( ! $filters ) {
			return $this->render_element_placeholder(
				[
					'title' => esc_html__( 'No filter item added.', 'wpv-bu' ),
				]
			);
		}
		$active_filter_tab = $this->get_active_filter_tab( $filters );
		if ( isset( $settings['enable_all_tab'] ) ) {
			$all_tab_text = ! empty( $settings['allTabText'] ) ? $settings['allTabText'] : 'All';
		}
		$this->set_attribute('gallery_wapper','class','bultr-full-width bricks-layout-wrapper');
		$this->set_attribute( 'filters_warpper', 'class', ['bultr-filters-wrapper','bultr-filters-title'] );
		
		?>
		<div <?php echo $this->render_attributes('_root');?>>
			<div <?php echo $this->render_attributes('gallery_wapper');?> >
				<div <?php echo $this->render_attributes('filters_warpper');?>>
					<?php
						// Filter Title
						$tab_title_classes = [ 'bultr-filter-title' ];

						// Filter Title - All Tab
						$this->set_attribute( 'filter_title', 'class', $tab_title_classes );
						if ( empty( $active_filter_tab ) && isset( $settings['enable_all_tab'] ) ) {
							$active_filter_tab = 'all';
							$this->set_attribute( 'filter_title', 'class', 'active' );
						}
						$this->set_attribute( 'filter_title', 'data-filter', '.all' );
						if ( isset( $settings['enable_all_tab'] ) ) {?>
							<div <?php echo $this->render_attributes( "filter_title" );?>>
								<?php echo $all_tab_text; ?>
							</div>
						<?php }
						if ( empty( $active_filter_tab ) ) {
							$active_filter_tab = $filters[0]['id'];
						}

						foreach ( $filters as $index => $filter ) {
							$iconPosition = '';
							$iconPosition                      = ( isset( $filter['iconPosition'] ) ) ? "icon-{$filter['iconPosition']}" : 'icon-left';
							$tab_title_classes['iconPosition'] = $iconPosition;
							if ( $filter['id'] === $active_filter_tab ) {
								$this->set_attribute( "filter_title_$index", 'class', 'active' );
							}
							$this->set_attribute( "filter_title_$index", 'class', $tab_title_classes );
							$this->set_attribute( "filter_title_$index", 'data-filter', '.' . $filter['id'] );
							if ( isset($filter['items']['images']) && ( count( $filter['items']['images'] ) <= 0 ) ) {
								continue;
							}
							?>
							<div <?php echo $this->render_attributes("filter_title_$index");?>>
								<?php
								// Icon
								$icon = ! empty( $filter['icon'] ) ? self::render_icon( $filter['icon'] ) : false;

								if ( $icon ) {
									echo $icon;
								}

								if ( ! empty( $filter['title'] ) ) {
									?>
									<span class="bultr-filter"><?php echo $filter['title'];?></span>
									<?php
								}
								?>
							</div>
							<?php
						}
					?>
				</div>	
				<?php
					// Gallery
					$this->set_attribute( 'filters_image', 'class', 'bultr-filters-image' );
					if(isset($settings['filterImageLayout'])){
					$this->set_attribute( 'filters_image', 'class', 'bultr-gal-layout-' . $settings['filterImageLayout'] );
					}
					$this->set_attribute( 'filters_image', 'data-dtab', $active_filter_tab );
					
					if (isset($settings['filterImageLayout']) && $settings['filterImageLayout'] === 'masonry' ) {
						if ( isset( $settings['spacing'] ) ) {
							$this->set_attribute( 'filters_image', 'data-gutter', $settings['spacing'] );
						} else {
							$this->set_attribute( 'filters_image', 'data-gutter', '0' );
						}
					}
					if(isset($settings['filterImageLayout'] )){
					$this->set_attribute( 'filters_image', 'data-layout', $settings['filterImageLayout'] );
					}
					$this->set_attribute( 'images_wrapper', 'class', 'bultr-gallery' );
					if(isset($settings['link']) && $settings['link'] == 'lightbox'){
						$this->set_attribute( 'images_wrapper', 'data-lightbox', 'true' );
						$this->set_attribute( 'images_wrapper', 'class', 'bricks-lightbox' );
					}
					if(isset($settings['enableHoverScale']) && $settings['enableHoverScale'] ){
						$this->set_attribute( 'images_wrapper', 'class', 'hover-scale' );
					}
					if ( $layout === 'justified' ) {
						$jg_data['row_height'] = ! empty( $settings['rowHeight'] ) ? $settings['rowHeight'] : 200;
						$jg_data['max_row']    = ! empty( $settings['maxRow'] ) ? $settings['maxRow'] : 0;
						$jg_data['gap']        = ! empty( $settings['imageGap'] ) ? $settings['imageGap'] : 10;
						$jg_data['last_row']   = ! empty( $settings['lastRow'] ) ? $settings['lastRow'] : 'justify';
						$data_settings         = array_merge( $data_settings, $jg_data );
					}
			
					if ( $tilt ) {
						$tilt_data['tilt']            = $tilt;
						$tilt_data['tiltMax']         = ! empty( $settings['tiltMax'] ) ? $settings['tiltMax'] : 5;
						$tilt_data['tiltPerspective'] = ! empty( $settings['tiltPerspective'] ) ? $settings['tiltPerspective'] : 1000;
						$tilt_data['tiltSpeed']       = ! empty( $settings['tiltSpeed'] ) ? $settings['tiltSpeed'] : 100;
						$tilt_data['tiltAxis']        = ! empty( $settings['tiltAxis'] ) ? $settings['tiltAxis'] : 'both';
						$tilt_data['tiltGlare']       = ! empty( $settings['tiltGlare'] ) ? true : false;
						$tilt_data['tiltMaxGlare']    = ! empty( $settings['tiltMaxGlare'] ) && $settings['tiltGlare'] ? $settings['tiltMaxGlare'] : .5;
						$data_settings                = array_merge( $data_settings, $tilt_data );
					}
			
					if ( $hover_aware_direction ) {
						$hover_aware_data['hoverAware']   = $hover_aware_direction;
						$hover_aware_data['overlaySpeed'] = $settings['overlaySpeed'] ?? 500;
						$data_settings                    = array_merge( $data_settings, $hover_aware_data );
					}
			
					if ( count( $data_settings ) ) {
						$this->set_attribute( 'images_wrapper', 'data-settings', wp_json_encode( $data_settings ) );
					}
						
					?>
					<div <?php echo $this->render_attributes('filters_image');?>>
						<ul <?php echo $this->render_attributes('images_wrapper');?>>
							<?php
							// Gallery Loop
							foreach ( $filters as $index => $filter ) {
								if ( isset($filter['items']['images']) && ( count( $filter['items']['images'] ) <= 0 ) ) {
									continue;
								}
								$item_classes  = [ 'bultr-layout-item', 'all', $filter['id'] ];
								$this->render_filter_items($filter,$index,$settings);
							}
							?>
						</ul>
					</div>
			</div>
		</div>
		<?php

	
	}

	
	public function get_normalized_image_settings( $settings ) {
		$filters        = $settings['filters'] ?? false;
		if(empty($filters)){
			return;
		}
		$backup_filters = $filters;

		foreach ( $filters as $id => $filter ) {
			$items = isset( $filter['items'] ) ? $filter['items'] : [];

			$size = ! empty( $items['size'] ) ? $items['size'] : BRICKS_DEFAULT_IMAGE_SIZE;

			// Dynamic Data
			if ( ! empty( $items['useDynamicData'] ) ) {
				$items['images'] = [];

				$images = $this->render_dynamic_data_tag( $items['useDynamicData'], 'image' );

				if ( is_array( $images ) ) {
					foreach ( $images as $image_id ) {
						$items['images'][] = [
							'id'   => $image_id,
							'full' => wp_get_attachment_image_url( $image_id, 'full' ),
							'url'  => wp_get_attachment_image_url( $image_id, $size ),
						];
					}
				}
			}

			// Either empty OR old data structure used before 1.0 (images were saved as one array directly on $items)
			if ( ! isset( $items['images'] ) ) {
				$images = ! empty( $items ) ? $items : [];

				unset( $items );

				$items['images'] = $images;
			}

			// Get 'size' from first image if not set
			$first_image_size = ! empty( $items['images'][0]['size'] ) ? $items['images'][0]['size'] : false;
			$size             = empty( $items['size'] ) && $first_image_size ? $first_image_size : $size;

			// Calculate new image URL if size is not the same as from the Media Library
			if ( $first_image_size && $first_image_size !== $size ) {
				foreach ( $items['images'] as $key => $image ) {
					$items['images'][ $key ]['size'] = $size;
					$items['images'][ $key ]['url']  = wp_get_attachment_image_url( $image['id'], $size );
				}
			}

			$backup_filters[ $id ]['items']         = $items;
			$backup_filters[ $id ]['items']['size'] = $size;
		}

		$settings['filters'] = $backup_filters;

		return $settings;
	}
}
