<?php
namespace BricksUltra\Modules\WooProducts;
use Bricks\Element;
use WC_Product_Query;
use Bricks\Breakpoints;
use BricksUltra\Plugin;


class Module extends Element {
    public $category     = 'ultra';
	public $name         = 'wpvbu-woo-products';
	public $icon         = 'ti-bag';
	public $css_selector = '';
	public $scripts      = ['bricksUltraSwiperslider'];
	public $flag = '';
    
    public $loop_index = 0;
    public static $_helper = null;
   

    public function get_label() {
		return esc_html__( 'Woo Products', 'wpv-bu' );
	}
    
    public function enqueue_scripts() {
        $layout = $this->settings['layout'] ?? 'grid';
		if ( $layout === 'slider' ) {
            wp_enqueue_script( 'bricks-swiper' );
		    wp_enqueue_style( 'bricks-swiper' );
		}
            if ( current_theme_supports( 'wc-product-gallery-zoom' ) ) { 
                wp_enqueue_script( 'zoom' );
            }
            if ( current_theme_supports( 'wc-product-gallery-slider' ) ) {
                wp_enqueue_script( 'flexslider' );
            }
            if ( current_theme_supports( 'wc-product-gallery-lightbox' ) ) {
                wp_enqueue_script( 'photoswipe-ui-default' );
                wp_enqueue_style( 'photoswipe-default-skin' );
                add_action( 'wp_footer', 'woocommerce_photoswipe' );
            }
            wp_enqueue_script( 'wc-single-product' );
           
           wp_enqueue_style( 'bu-popup-css' );
           wp_enqueue_script( 'bu-popup-script' );
    
		wp_enqueue_style( 'bultr-module-style' );
		wp_enqueue_script( 'bultr-module-script' );

	}

    public function get_keywords() {
		return [ 'product', 'woo-products', 'woocommerce', 'woocommerce-product', 'woo-grid', 'product-grid', 'grid', 'slider', 'carousel', 'product-carousel', 'product-slider',  ];
	}

    public function set_control_groups(){

        $this->control_groups['product_layout'] = [
			'title' => esc_html__( 'Layout', 'wpv-bu' ),
			'tab'   => 'content',
            'clearable'   => false,
		];

        $this->control_groups['rating'] = [
            'title'=> esc_html__( 'Rating', 'wpv-bu' ),
            'tab'   => 'content',
            'required' => ['hideRating', '=', false],
        ];

        $this->control_groups['product_query'] = [
			'title' => esc_html__( 'Product Query', 'wpv-bu' ),
			'tab'   => 'content',
		];
        
        $this->control_groups['slider_settings']=[
            'title' => esc_html__( 'Slider Controls', 'wpv-bu' ),
			'tab'   => 'content',
            'required' => ['layout', '=', 'slider'],
        ];
        $this->control_groups['nav_arrows'] = [
			'title'    => esc_html__( 'Navigation Arrows', 'wpv-bu' ),
			'tab'      => 'content',
			'required' => [ 'layout', '=', 'slider' ],
		];
        $this->control_groups['nav_dots'] = [
			'title'    => esc_html__( 'Pagination', 'wpv-bu' ),
			'tab'      => 'content',
			'required' => [ 'layout', '=', 'slider' ],
		];
        $this->control_groups['button'] = [
			'title' => esc_html__( 'Button', 'wpv-bu' ),
			'tab'   => 'content',
        ];

        $this->control_groups['preset'] = [
			'title' => esc_html__( 'Preset', 'wpv-bu' ),
			'tab'   => 'content',
           'required' => ['productlayout', '=', 'split'],

		];

        $this->control_groups['cover_preset'] = [
			'title' => esc_html__( 'Preset', 'wpv-bu' ),
			'tab'   => 'content',
           'required' => ['productlayout', '=', 'cover'],

		];

        $this->control_groups['sales_badge']=[
            'title'    => esc_html__( 'Product Badges', 'wpv-bu' ),
			'tab'      => 'content',
        ];
     
        $this->control_groups['order_content']=[
            'title'    => esc_html__( 'Order Content', 'wpv-bu' ),
			'tab'      => 'content',
        ];
      
    }

    public function set_controls(){
        $this->controls['layout']=[
            'tab'   => 'content',
            'group' => 'product_layout',
			'label' => esc_html__( 'Layout', 'wpv-bu' ),
			'type'  => 'select',
            'clearable'   => false,
            'options' => [
                'grid'      => __('Grid', 'wpv-bu'),
                'slider'    => __('Slider', 'Wpv-bu'),
            ],
            'inline' => true,
            'default' => 'grid',
            
        ];

        $this->controls['productlayout']=[
            'tab'   => 'content',
            'group' => 'product_layout',
			'label' => esc_html__( 'Product Layout', 'wpv-bu' ),
			'type'  => 'select',
            'clearable'   => false,
            'options' => [
                'split'      => __('Split', 'wpv-bu'),
                'cover'    => __('Cover', 'Wpv-bu'),
            ],
            'inline' => true,
            'default' => 'split',
            
        ];

        $this->controls['productSplitLayout']=[
            'tab'   => 'content',
            'group' => 'product_layout',
			'label' => esc_html__( 'Split Layout', 'wpv-bu' ),
            'type'  => 'direction',
                'css'   => [
                    [
                      'property' => 'flex-direction',
                      'selector' => '.bultr-content',
                    ],
                    ],
                'clearable'   => false,
            'inline' => true,
            'default' => 'column',
            'required' => ['productlayout', '=', 'split'],
        ];

        $this->controls['productLayoutPresets']=[
            'tab'   => 'content',
            'group' => 'product_layout',
			'label' => esc_html__( 'Preset Layout', 'wpv-bu' ),
			'type'  => 'select',
            'clearable'   => false,
            'options' => [
                'preset1'      => __('Preset 1', 'wpv-bu'),
                'preset2'    => __('Preset 2', 'Wpv-bu'),
            ],
            'inline' => true,
            'default' => 'preset1',
        ];

        $this->controls['columns'] =[
            'tab'   => 'content',
            'group' => 'product_layout',
			'label' => esc_html__( 'Columns', 'wpv-bu' ),
			'type'  => 'number',
			'min'      => 1,
			'max'      => 12,
            'inline' => true,
            'css'       =>[
                [
                    'selector' => '',
                    'property' => '--bultr-woo-columns',
                    'value'     => '%s',
                ],
               
                
            ],
            'required' => ['layout', '=', 'grid'],
        ];

        $this->controls['column_gap'] =[
            'tab'   => 'content',
            'group' => 'product_layout',
			'label' => esc_html__( 'Column Gap', 'wpv-bu' ),
			'type'  => 'number',
            'unit'  => 'px',
            'inline' => true,
            'css'       =>[
                [
                    'property' => 'column-gap',
                    'selector' => '.bultr-layout-grid',
                ],
            ],
           
            'required' => ['layout', '=', 'grid'],

        ];

        $this->controls['row_gap'] =[
            'tab'   => 'content',
            'group' => 'product_layout',
			'label' => esc_html__( 'Row Gap', 'wpv-bu' ),
			'type'  => 'number',
            'unit'  => 'px',
            'inline' => true,
            'css'       =>[
                [
                    'property' => 'row-gap',
                    'selector' => '.bultr-layout-grid',
                ],
            ],
            'required' => ['layout', '=', 'grid'],

        ];
        
        $this->controls['hideImage']=[
            'tab'   => 'content',
            'group' => 'product_layout',
			'label' => esc_html__( 'Hide Image', 'wpv-bu' ),
			'type'  => 'checkbox',
            'default' => false,
            'required' => ['productlayout', '=', 'split'],
        ];
        $this->controls['hideRating']=[
            'tab'   => 'content',
            'group' => 'product_layout',
			'label' => esc_html__( 'Hide Rating', 'wpv-bu' ),
			'type'  => 'checkbox',
            'default' => false,
            
        ];
        $this->controls['titleSept'] = [
            'tab'      => 'content',
            'group' => 'product_layout',
            'label'    => esc_html__( 'Title', 'wpv-bu' ),
            'type'     => 'separator',
        ]; 
        $this->controls['hideTitle']=[
            'tab'   => 'content',
            'group' => 'product_layout',
			'label' => esc_html__( 'Hide Title', 'wpv-bu' ),
			'type'  => 'checkbox',
            'default' => false,
        ];
        $this->controls['titleTTypo'] = [
            'tab'      => 'content',
            'group' => 'product_layout',
            'label'    => esc_html__( 'Typography', 'wpv-bu' ),
            'type'     => 'typography',
            'css'      => [
                [
                    'property' => 'font',
                    'selector' => '.bultr-woo-content-inner .bultr-title',
                ],
               
            ],
            'required' => ['hideTitle', '=', false],

            
        ]; 
        $this->controls['titleGap'] =[
            'tab'   => 'content',
            'group' => 'product_layout',
			'label' => esc_html__( 'Gap', 'wpv-bu' ),
			'type'  => 'number',
            'unit'  => 'px',
            'inline' => true,
            'css'       =>[
                [
                    'property' => 'padding-bottom',
                    'selector' => '.bultr-title',
                ],
            ],
            'required' => ['hideTitle', '=', false],

        ];
       
        $this->controls['ratingGap'] =[
            'tab'   => 'content',
            'group' => 'product_layout',
			'label' => esc_html__( 'Gap', 'wpv-bu' ),
			'type'  => 'number',
            'unit'  => 'px',
            'inline' => true,
            'css'       =>[
                [
                    'property' => 'padding-bottom',
                    'selector' => '.bultr-rating',
                ],
            ],
            'required' => ['hideRating', '=', false],

        ];
        $this->controls['priceSept'] = [ //separator
            'tab'      => 'content',
            'group' => 'product_layout',
            'label'    => esc_html__( 'Price', 'wpv-bu' ),
            'type'     => 'separator',
        ]; 
        $this->controls['hidePrice']=[
            'tab'   => 'content',
            'group' => 'product_layout',
			'label' => esc_html__( 'Hide Price', 'wpv-bu' ),
			'type'  => 'checkbox',
            'default' => false,
        ];
        $this->controls['priceTTypo'] = [
            'tab'      => 'content',
            'group' => 'product_layout',
            'label'    => esc_html__( 'Typography', 'wpv-bu' ),
            'type'     => 'typography',
            'css'      => [
                [
                    'property' => 'font',
                    'selector' => '.bultr-woo-content-inner .bultr-price',
                ],
                [
                    'property' => 'font',
                    'selector' => '.bultr-woo-content-outer .bultr-woo-price .bultr-price',
                ],
               
            ],

            'exclude' => ['text-transform','text-decoration'],
            'required' => ['hidePrice', '=', false],

            
        ]; 
        $this->controls['priceGap'] =[
            'tab'   => 'content',
            'group' => 'product_layout',
			'label' => esc_html__( 'Gap', 'wpv-bu' ),
			'type'  => 'number',
            'unit'  => 'px',
            'inline' => true,
            'css'       =>[
                [
                    'property' => 'padding-bottom',
                    'selector' => '.bultr-price',
                ],
            ],
            'required' => ['hidePrice', '=', false],

        ];
        $this->controls['descSept'] = [ 
            'tab'      => 'content',
            'group' => 'product_layout',
            'label'    => esc_html__( 'Description', 'wpv-bu' ),
            'type'     => 'separator',
        ]; 
        $this->controls['hideDescription']=[
            'tab'   => 'content',
            'group' => 'product_layout',
			'label' => esc_html__( 'Hide Description', 'wpv-bu' ),
			'type'  => 'checkbox',
            'default' => true,
        ];

        $this->controls['descriptionTTypo'] = [
            'tab'      => 'content',
            'group' => 'product_layout',
            'label'    => esc_html__( 'Typography', 'wpv-bu' ),
            'type'     => 'typography',
            'css'      => [
                [
                    'property' => 'font',
                    'selector' => '.bultr-woo-content-inner .bultr-description',
                ],
               
            ],
            'required' => ['hideDescription', '=', false],
        ]; 
        $this->controls['descriptionGap'] =[
            'tab'   => 'content',
            'group' => 'product_layout',
			'label' => esc_html__( 'Gap', 'wpv-bu' ),
			'type'  => 'number',
            'unit'  => 'px',
            'inline' => true,
            'css'       =>[
                [
                    'property' => 'padding-bottom',
                    'selector' => '.bultr-description',
                ],
            ],
            'required' => ['hideDescription', '=', false],

        ];

        $this->controls['wordLimit'] = [
            'tab'       => 'content',
            'group'     => 'product_layout',
			'label'     => esc_html__( 'Word Limit', 'wpv-bu' ),
			'type'      => 'number',
            'min'       => 15,
            'step'      => '1',
            'units'     => false, 
            'default'   => 15,
            'required'  => ['hideDescription','=', false],

        ];
    
        // order
        $this->get_button_settings_controls();
        $this->get_product_settings_controls();
        $this->get_product_rating();
        $this->get_order_controls();
        $this->get_onsales_controls();
        $this->get_swiper_slides_controls();
        $this-> navigation_style_controls();
        $this->nav_dots_controls();
    }

    public function get_product_rating(){
      
        $this->controls['filledIcon'] = [
			'tab'      => 'content',
			'group'    => 'rating',
			'label'    => esc_html__( 'Filled Icon', 'wpv-bu' ),
			'type'     => 'icon',
			'default'  => [
				'library' => 'fontawesomeSolids',
				'icon'    => 'fas fa-star',
			],
            'required' => ['hideRating','=', false],
			'rerender' => true,
		];
        $this->controls['halffillIcon'] = [
			'tab'      => 'content',
			'group'    => 'rating',
			'label'    => esc_html__( 'Half Filled Icon', 'wpv-bu' ),
			'type'     => 'icon',
			'default'  => [
				'library' => 'fontawesomeSolids',
				'icon'    => 'fas fa-star-half-stroke',
			],
            'required' => ['hideRating','=', false],
			'rerender' => true,
		];
        $this->controls['emptyIcon'] = [
			'tab'      => 'content',
			'group'    => 'rating',
			'label'    => esc_html__( 'Unmarked Icon', 'wpv-bu' ),
			'type'     => 'icon',
			'default'  => [
				'library' => 'fontawesomeRegulars',
				'icon'    => 'fa fa-star',
			],
            'required' => ['hideRating','=', false],
			'rerender' => true,
		];
     
        $this->controls['ratingSize']=[
            'tab'       => 'content',
			'group'    => 'rating',
			'label'     => esc_html__( 'Size', 'wpv-bu' ),
			'type'      => 'number',
            'units'     => true,
            'css'       => [
                [
                    'property' => 'font-size',
                    'selector' => '.bultr-rating .bultr-star',
                ],
            ],
            'inline'    => true,
            'required'  => ['hideRating','=', false],
        ];
        $this->controls['markColor']=[
            'tab'       => 'content',
			'group'    => 'rating',
			'label'     => esc_html__( 'Marked Color', 'wpv-bu' ),
			'type'      => 'color',
            'css'       => [
                [
                    'property' => 'color',
                    'selector' => '.bultr-rating .bultr-star.checked'
                ],
            ],
            'inline'    => true,
            'required'  => ['hideRating','=', false],
        ];
        $this->controls['unmarkColor']=[
            'tab'       => 'content',
			'group'    => 'rating',
			'label'     => esc_html__( 'Unmarked Color', 'wpv-bu' ),
			'type'      => 'color',
            'css'       => [
                [
                    'property' => 'color',
                    'selector' => '.bultr-rating .bultr-star'
                ],
            ],
            'inline'    => true,
            'required'  => ['hideRating','=', false],
        ];
        $this->controls['ratingGap']=[
            'tab'       => 'content',
			'group'    => 'rating',
			'label'     => esc_html__( 'Gap', 'wpv-bu' ),
			'type'      => 'number',
            'unit'     => 'px',
            'css'       => [
                [
                    'property' => 'gap',
                    'selector' => '.bultr-rating',
                ],
            ],
            'inline'    => true,
            'required'  => ['hideRating','=', false],
        ];
       
    }
       
    public function get_button_settings_controls(){

        $mediaArgs = [
            'controlName' => 'media',
            'selector' => '.media',
            'defaultEnable' => [
                'showAddToCart' => false,
                'showBuyNow' => true,
                'showLink' => true,
                'showQuickView' => true,
            ]
        ];

        $contentArgs = [
            'controlName' => 'content',
            'selector' => '.content',
            'defaultEnable' => [
                'showAddToCart' => true,
                'showBuyNow' => false,
                'showLink' => false,
                'showQuickView' => false,
            ]
        ];
      

        $this->controls['show'.$mediaArgs['controlName'].'Button']=[
            'tab'   => 'content',
            'group'     => 'button',
            'label' => esc_html__( 'Media Buttons', 'wpv-bu' ),
            'type'  => 'checkbox',
             'default' => true,
             'required' => ['productlayout','=','split'],
        ];
     
        $this->controls['show'. $contentArgs['controlName'].'Button']=[
            'tab'   => 'content',
            'group'     => 'button',
            'label' => esc_html__( 'Content Buttons', 'wpv-bu' ),
            'type'  => 'checkbox',
             'default' => true,
        ];

        $this->controls['showHoverButton']=[
            'tab'   => 'content',
            'group'     => 'button',
            'label' => esc_html__( 'Hover', 'wpv-bu' ),
            'type'  => 'checkbox',
            'default' => true,
            'required' => [['productlayout','=','split'],
                            ['showmediaButton','=',true]],
        ];
 
        $this->get_repeater_buttons_controls($mediaArgs); 
        $this->get_repeater_buttons_controls($contentArgs);
      
    }

    public function get_repeater_buttons_controls($args){ //preset 1
       
        if($args['controlName'] === 'media'){
         
        
        $this->controls['mediaButtonsSept'] = [ //media button
            		'tab'      => 'content',
                    'group'     => 'button',
            		'label'    => esc_html__( 'Media', 'wpv-bu' ),
            		'type'     => 'separator',
                    'required' => [['showmediaButton','=',true],
                                ['productlayout','=','split'],],
             
        ];
        $this->controls['mediaButtonsRepeater'] = [
			'tab'           => 'content',
			'group'         => 'button',
			'placeholder'   => esc_html__( 'Media', 'wpv-bu' ),
			'type'          => 'repeater',
			'titleProperty' => 'action',
			'fields'        => [
			
                'action'=>[
                    'tab'   => 'content',
					'label' => esc_html__( 'Action', 'wpv-bu' ),
					'type'  => 'select',
                    'inline' => true,
                    'options' => [
                        'add_to_cart' => __('Add to Cart','wpv-bu'),
                        'buy_now' => __('Buy Now','wpv-bu'),
                        'link' => __('Link','wpv-bu'),
                        'quick_view' => __('Quick View','wpv-bu'),
                    ],
                ],
				'title' => [
					'tab'   => 'content',
					'label' => esc_html__( 'Title', 'wpv-bu' ),
					'type'  => 'text',
                    'inline' => true,
				],
				
                'icon' => [
                    'tab'    => 'content',
                    'label'  => esc_html__( 'Icon', 'wpv-bu' ),
                    'type'   => 'icon',
                    'inline' => true,
                ],
                
            ],
			'default'       => [
                [
                    'icon'  => [
                        'library' => 'ionicons',
                        'icon'    => 'ion-ios-log-in',
                    ],
					'action'	=> 'buy_now',
				],
                [
                    'icon'  => [
                        'library' => 'ionicons',
                        'icon'    => 'ion-ios-link',
                    ],
                    'action'	=> 'link',
						
				],
                [
                    'icon'  => [
                        'library' => 'ionicons',
                        'icon'    => 'ion-md-eye',
                    ],
					'action'	=> 'quick_view',
						
				],
				],	
                'required' => [['showmediaButton','=',true],
                                ['productlayout','=','split'],],
        ];
        $this->get_buttons_style_controls($args);
        }
        else{
        $this->controls['contentButtonsSept'] = [ //content button
            'tab'      => 'content',
            'group'     => 'button',
            'label'    => esc_html__( 'Content', 'wpv-bu' ),
            'type'     => 'separator',
            'required' => ['showcontentButton','=',true],
     
        ];
        $this->controls['contentButtonsRepeater'] = [
            'tab'           => 'content',
            'group'         => 'button',
            'placeholder'   => esc_html__( 'Content', 'wpv-bu' ),
            'type'          => 'repeater',
            'titleProperty' => 'action',
            'fields'        => [

            'action'=>[
                'tab'   => 'content',
                'label' => esc_html__( 'Action', 'wpv-bu' ),
                'type'  => 'select',
                'inline' => true,
                'options' => [
                    'add_to_cart' => __('Add to Cart','wpv-bu'),
                    'buy_now' => __('Buy Now','wpv-bu'),
                    'link' => __('Link','wpv-bu'),
                    'quick_view' => __('Quick View','wpv-bu'),
                ],
            ],
            'title' => [
                'tab'   => 'content',
                'label' => esc_html__( 'Title', 'wpv-bu' ),
                'type'  => 'text',
                'inline' => true,
            ],

            'icon' => [
                'tab'    => 'content',
                'label'  => esc_html__( 'Icon', 'wpv-bu' ),
                'type'   => 'icon',
                'inline' => true,
            ],

            ],
            'default'       => [
            [
                'icon'  => [
                    'library' => 'ionicons',
                    'icon'    => 'ion-md-cart',
                ], 
                'action' => 'add_to_cart',
            ],
            
        ],	
        'required' => ['showcontentButton','=',true],
        ];
   
        $this->get_buttons_style_controls($args);
        }
        $this->get_split_preset_style_controls();

        $this-> get_cover_preset_style_controls();
    }

    public function get_buttons_style_controls($args){
        // text
        $this->controls[$args['controlName'].'ButtonTTypo'] = [
            'tab'      => 'content',
            'group'    => 'button',
            'label'    => esc_html__( 'Typography', 'wpv-bu' ),
            'type'     => 'typography',
            'css'      => [
                [
                    'property' => 'font',
                    'selector' => '.bultr-woo-'.$args['controlName'].'-buttons a',
                ],               
            ],
            'exclude' => ['text-align'],
            'required' => [
                'show'.$args['controlName'].'Button','=',true,
            ],
        ];

        if($args['controlName'] == 'media'){
            $this->controls['mediaButtonTTypo']['required'] = [
                'productlayout', '=', ['split'],
            ];
        }
        
        //Icon
        $this->controls[$args['controlName'].'ButtonIColor'] = [ 
            'tab'      => 'content',
            'group'    => 'button',
            'label'    => esc_html__( 'Icon Color', 'wpv-bu' ),
            'type'     => 'color',
            'css'      => [
                [
                    'property' => 'color',
                    'selector' => '.bultr-woo-'.$args['controlName'].'-buttons i',
                ],
                [
                    'property' => 'fill',
                    'selector' => '.bultr-woo-'.$args['controlName'].'-buttons svg',
                ],
            ],
            'required' => [
                'show'.$args['controlName'].'Button','=',true,
            ],

        ];
        if($args['controlName'] == 'media'){
            $this->controls['mediaButtonIColor']['required'] = [
                'productlayout', '=', ['split'],
            ];
        }

        $this->controls[$args['controlName'].'ButtonISize'] = [
            'tab'      => 'content',
            'group'    => 'button',
            'label'    => esc_html__( 'Icon Size', 'wpv-bu' ),
            'type'     => 'number',
            'unit'     => 'px',
            'css'      => [
                [
                    'property' => 'font-size',
                    'selector' => '.bultr-woo-'.$args['controlName'].'-buttons i',
                ],
                [
                    'property' => 'font-size',
                    'selector' => '.bultr-woo-'.$args['controlName'].'-buttons svg',
                ],
            ],
           
            'required' => [
                'show'.$args['controlName'].'Button','=',true,
            ],
        ];
        if($args['controlName'] == 'media'){
            $this->controls['mediaButtonISize']['required'] = [
                'productlayout', '=', ['split'],
            ];
        }

        $this->controls[$args['controlName'].'ButtonIconPst']=[
            'tab'      => 'content',
            'group'    => 'button',
            'label'    => esc_html__( 'Icon Position', 'wpv-bu' ),
            'type'     => 'select',
            'clearable' => false,
            'options'  => [
                'left' => __('Left','wpv-bu'),
                'right' => __('Right','wpv-bu'),
            ],
            'default' => 'right',
            'inline'      => true,
            'required' => [
                'show'.$args['controlName'].'Button','=',true,
            ],
        ];
        if($args['controlName'] == 'media'){
                    $this->controls['mediaButtonIconPst']['required'] = [
                        'productlayout', '=', ['split'],
                    ];
        }

         //button style
       
        
        $this->controls[$args['controlName'].'ButtonLayout'] = [
			'tab'         => 'content',
			'group'       => 'button',
			'label'       => esc_html__( 'Button Layout', 'wpv-bu' ),
            'type'     => 'select',
            'options'  => [
                'horizontal' => __('Horizontal','wpv-bu'),
                'vertical' => __('Vertical','wpv-bu'),
            ],
			'clearable'   => false,
			'inline'      => true,
            'required' => ['show'.$args['controlName'].'Button','=',true],
     
		]; 

        if($args['controlName'] == 'media'){
            $this->controls['mediaButtonLayout']['required'] = [
                'productlayout', '=', ['split'],
            ];
        }

        if($args['controlName']!=='content'){
         
            $this->controls['mediaButtonsTop']=[
                'tab'   => 'content',
                'group' => 'button',
                'label' => esc_html__( 'Top', 'wpv-bu' ),
                'type'  => 'number',
                'unit' => 'px',
                'css'   => [
                    [
                        'property' => 'top',
                        'selector' => '.bultr-woo-media-buttons',

                    ],
                    [
                        'property' => 'bottom',
                        'selector' => '.bultr-woo-media-buttons',
                        'value' => 'unset'
                    ],
                ],
                'required' => [['showmediaButton','=',true],
                                ['productlayout', '=', 'split'],],
                
            ];

            $this->controls['mediaButtonsRight']=[
                'tab'   => 'content',
                'group' => 'button',
                'label' => esc_html__( 'Right', 'wpv-bu' ),
                'type'  => 'number',
                'unit' => 'px',
                'css'   => [
                    [
                        'property' => 'right',
                        'selector' => '.bultr-woo-media-buttons',

                    ],
                    [
                        'property' => 'left',
                        'selector' => '.bultr-woo-media-buttons',
                        'value' => 'unset'
                    ],
                ],
              
                'required' => [['showmediaButton','=',true],
                                ['productlayout', '=', 'split'],],
                
        
            ];

            $this->controls['mediaButtonsBottom']=[
                'tab'   => 'content',
                'group' => 'button',
                'label' => esc_html__( 'Bottom', 'wpv-bu' ),
                'type'  => 'number',
                'units' => true,
                'css'   => [
                    [
                        'property' => 'bottom',
                        'selector' => '.bultr-woo-media-buttons',

                    ],
                    [
                        'property' => 'top',
                        'selector' => '.bultr-woo-media-buttons',
                        'value' => 'unset'
                    ],
                ],
                
                'required' => [['showmediaButton','=',true],
                                ['productlayout', '=', 'split'],],
                
        
            ];

            $this->controls['mediaButtonsLeft']=[
                'tab'   => 'content',
                'group' => 'button',
                'label' => esc_html__( 'Left', 'wpv-bu' ),
                'type'  => 'number',
                'units' => true,
                'css'   => [
                    [
                        'property' => 'left',
                        'selector' => '.bultr-woo-media-buttons',

                    ],
                    [
                        'property' => 'right',
                        'selector' => '.bultr-woo-media-buttons',
                        'value' => 'unset'
                    ],
                ],
                
                'required' => [['showmediaButton','=',true],
                ['productlayout', '=', 'split'],],

        
            ];
           
        }
        
        
        if($args['controlName']!== 'media'){
            $this->controls['contentButtonsPosition'] = [
                'tab'         => 'content',
                'group'       => 'button',
                'label'       => esc_html__( 'Button Position', 'wpv-bu' ),
                'type'  => 'direction',
                'css'   => [
                    [
                      'property' => 'flex-direction',
                      'selector' => '.bultr-split .bultr-product-card .bultr-content .bultr-woo-content',
                    ],
                    [
                        'property' => 'flex-direction',
                        'selector' => '.bultr-cover .bultr-product-card .bultr-content .bultr-woo-content',
                      ],
                    ],
                'inline'      => true,
                'required' => ['showcontentButton','=',true],
         
            ];

            $this->controls['splitButtonHColumn'] = [
                'tab'   => 'content',
                'group'     => 'button',
                'label' => esc_html__( 'Button Alignment', 'wpv-bu' ),
                'type'  => 'justify-content',
                'css'   => [
                  [
                    'property' => 'justify-content',
                    'selector' => '.bultr-split-preset1.bultr-split-column .bultr-woo-content-buttons',
                  ],
                  [
                    'property' => 'justify-content',
                    'selector' => '.bultr-split-preset1.bultr-split-column-reverse .bultr-woo-content-buttons',
                  ],
                  [
                    'property' => 'justify-content',
                    'selector' => '.bultr-split-preset1.bultr-split-column .bultr-woo-buttons',
                  ],
                  [
                    'property' => 'justify-content',
                    'selector' => '.bultr-split-preset1.bultr-split-column-reverse .bultr-woo-buttons',
                  ],
                  [
                    'property' => 'justify-content',
                    'selector' => '.bultr-split-preset1.bultr-split-row .bultr-woo-content-buttons',
                  ],
                  [
                    'property' => 'justify-content',
                    'selector' => '.bultr-split-preset1.bultr-split-row-reverse .bultr-woo-content-buttons',
                  ],

                ],
                'inline' => true,
                'required' => [
                ['productlayout', '=', 'split'],
                ['contentButtonsPosition','=',['column','column-reverse']],
                ],
            ];
            
            $this->controls['splitButtonRow'] = [
                'tab'   => 'content',
                'group'     => 'button',
                'label' => esc_html__( 'Button Alignment', 'wpv-bu' ),
                'type'  => 'align-items',
                'css'   => [
                  [
                    'property' => 'align-self',
                    'selector' => '.bultr-btn-row .bultr-woo-buttons',
                  ],
                  [
                    'property' => 'align-self',
                    'selector' => '.bultr-btn-row-reverse .bultr-woo-buttons',
                  ],
                ],
                'inline' => true,
                'exclude' => [
                    'stretch'
                ],
               
                'required' => [
                    ['contentButtonsPosition','=',['row','row-reverse']],
                                ['productlayout', '=', 'split'],
                  
                ],
            ];

            $this->controls['coverButtonColumn'] = [
                'tab'   => 'content',
                'group'     => 'button',
                'label' => esc_html__( 'Button Alignment', 'wpv-bu' ),
                'type'  => 'justify-content',
                'css'   => [
                  [
                    'property' => 'justify-content',
                    'selector' => '.bultr-cover .bultr-product-card .bultr-content .bultr-woo-content .bultr-woo-content-buttons',
                  ],
                ],
                
                'required' => [
                     ['contentButtonsPosition','=',['column','column-reverse']],
                                 ['productlayout', '=', 'cover'],],
            ];

            $this->controls['coverButtonRow'] = [
                'tab'   => 'content',
                'group'     => 'button',
                'label' => esc_html__( 'Button Alignment', 'wpv-bu' ),
                'type'  => 'align-items',
                'css'   => [
                  [
                    'property' => 'align-items',
                    'selector' => '.bultr-cover .bultr-product-card .bultr-content .bultr-woo-content .bultr-woo-content-buttons',
                  ],
                ],
                'inline' => true,
                'exclude' => [
                    'stretch'
                ],
               
                'required' => [
                     ['contentButtonsPosition','=',['row','row-reverse']],
                    ['productlayout', '=', 'cover'],
                   
                  
                ],
            ];
           
        }
         
        $this->controls[$args['controlName'].'ButtonsGap']=[
            'tab'   => 'content',
            'group' => 'button',
			'label' => esc_html__( 'Button Spacing', 'wpv-bu' ),
			'type'  => 'number',
            'units' => true,
            'css'   => [
                [
                    'property' => 'gap',
                    'selector' => '.bultr-woo-'.$args['controlName'].'-buttons ',

                ],
            ],
            
            'required' => ['show'.$args['controlName'].'Button','=',true],
     
        ];
        if($args['controlName'] == 'media'){
            $this->controls['mediaButtonsGap']['required'] = [
                'productlayout', '=', ['split'],
            ];
        }

        $this->controls[$args['controlName'].'ButtonsIconGap']=[
            'tab'   => 'content',
            'group' => 'button',
			'label' => esc_html__( 'Icon Spacing', 'wpv-bu' ),
			'type'  => 'number',
            'units' => true,
            'css'   => [
                [
                    'property' => 'gap',
                    'selector' => '.bultr-woo-'.$args['controlName'].'-icon ',

                ],
            ],
            'required' => [
                'show'.$args['controlName'].'Button','=',true,
            ],
     
        ];
        if($args['controlName'] == 'media'){
            $this->controls['mediaButtonsIconGap']['required'] = [
                'productlayout', '=', ['split'],
            ];
        }

        $this->controls[$args['controlName'].'ButtonBorder'] = [
            'tab' => 'content',
            'group'=> 'button',
            'label' => esc_html__( 'Button Border', 'wpv-bu' ),
            'type' => 'border',
            'css' => [
              [
                'property' => 'border',
                'selector' => '.bultr-woo-'.$args['controlName'].'-buttons a',
              ],
            ],
            'inline' => true,
            'small' => true,
              'required' => ['show'.$args['controlName'].'Button','=',true],
     
        ];
        if($args['controlName'] == 'media'){
            $this->controls['mediaButtonBorder']['required'] = [
                'productlayout', '=', ['split'],
            ];
        }

        $this->controls[$args['controlName'].'ButtonsPadding']=[
                  'tab'     => 'content',
                  'group'   => 'button',
                  'label'   => esc_html__( 'Button Padding', 'wpv-bu' ),
                  'type'    => 'dimensions',
                  'css'     => [
                                    [
                                    'property' => 'padding',
                                    'selector' => '.bultr-woo-'.$args['controlName'].'-buttons a',
                                    ],
                                ],
                  'required' => ['show'.$args['controlName'].'Button','=',true],
     
        ];
        if($args['controlName'] == 'media'){
            $this->controls['mediaButtonsPadding']['required'] = [
                'productlayout', '=', ['split'],
            ];
        }

        $this->controls[$args['controlName'].'ButtonMargin']=[
            'tab' => 'content',
            'group'=> 'button',
            'label' => esc_html__( 'Button Margin', 'wpv-bu' ),
            'type' => 'dimensions',
            'css' => [
              [
                'property' => 'margin',
                'selector' => '.bultr-woo-'.$args['controlName'].'-buttons',
              ]
            ],
            'required' => ['show'.$args['controlName'].'Button','=',true],
     
        ];
        if($args['controlName'] == 'media'){
            $this->controls['mediaButtonMargin']['required'] = [
                'productlayout', '=', ['split'],
            ];
        }

        $this->controls[$args['controlName'].'ButtonsBgcolor'] = [
            'tab'      => 'content',
            'group'    => 'button',
            'label'    => esc_html__( 'Background', 'wpv-bu' ),
            'type'     => 'color',
            'css'      => [
                [
                    'property' => 'background',
                    'selector' => '.bultr-woo-'.$args['controlName'].'-buttons a',
                ],
            ],
            'required' => ['show'.$args['controlName'].'Button','=',true],
     
        ];
        if($args['controlName'] == 'media'){
            $this->controls['mediaButtonsBgcolor']['required'] = [
                'productlayout', '=', ['split'],
            ];
        }

        $this->controls[$args['controlName'].'ButtonsWidth']=[
            'tab'   => 'content',
            'group' => 'button',
			'label' => esc_html__( 'Button Width', 'wpv-bu' ),
			'type'  => 'number',
            'units' => true,
            'css'   => [
                [
                    'property' => 'width',
                    'selector' => '.bultr-woo-'.$args['controlName'].'-buttons a    ',

                ],
            ],
            
            'required' => [['show'.$args['controlName'].'Button','=',true],
            ],  
     
        ];
        if($args['controlName'] == 'media'){
            $this->controls['mediaButtonsWidth']['required'] = [
                'productlayout', '=', ['split'],
            ];
        }
       

     
    }

    public function get_split_preset_style_controls(){

        $this->controls['presetSept'] = [
                'tab'      => 'content',
                'group'     => 'preset',
                'label'    => esc_html__( 'Product Card ', 'wpv-bu' ),
                'type'     => 'separator',
		];
        $this->controls['splitBgColor'] =[
            'tab' => 'content',
            'group' => 'preset',
            'label' => esc_html__( 'Background Color', 'wpv-bu' ),
            'type' => 'background',
            'css' => [
            [
                'property' => 'background',
                'selector' => '.bultr-split .bultr-product-card',
            ],
            ],
            'inline' => true,
            'small' => true,
        ];
        $this->controls['splitBoxBorder'] = [
            'tab' => 'content',
            'group'=> 'preset',
            'label' => esc_html__( 'Box Border', 'wpv-bu' ),
            'type' => 'border',
            'css' => [
              [
                'property' => 'border',
                'selector' => '.bultr-product-card',
              ],
            ],
            'inline' => true,    
        ];
        $this->controls['splitBoxShadow'] = [
            'tab' => 'content',
            'group' => 'preset',
            'label' => esc_html__( 'BoxShadow', 'wpv-bu' ),
            'type' => 'box-shadow',
            'css' => [
                [
                    'property' => 'box-shadow',
                    'selector' => '.bultr-product-card',
                ],
            ],
            'inline' => true,
            'small' => true,
        ];
        $this->controls['splitPadding'] =[
            'tab' => 'content',
            'group' => 'preset',
            'label' => esc_html__( 'Padding', 'wpv-bu' ),
            'type' => 'dimensions',
            'css' => [
            [
                'property' => 'padding',
                'selector' => '.bultr-split .bultr-product-card',
            ],
            ],
        ];

        
        //image width
        $this->controls['presetSeptImg'] = [
			'tab'      => 'content',
            'group'     => 'preset',
			'label'    => esc_html__( 'Image ', 'wpv-bu' ),
			'type'     => 'separator',
            'required' => ['hideImage','=',false],
		]; 
        $this->controls['presetImageWidth']=[
            'tab'   => 'content',
            'group' => 'preset',
			'label' => esc_html__( 'Image Width(%)', 'wpv-bu' ),
			'type'  => 'number',
            'css'   => [
                [
                    'selector' => '',
                    'property' => '--bultr-woo-image-width',
                    'value'     => '%s',
                ],
            ],
            
            'required' =>[ ['productSplitLayout','=',[ 'row-reverse','row']],
                             ['hideImage','=',false],
            ],
        ];
        //image height
        $this->controls['presetImageHeight']=[
            'tab'   => 'content',
            'group' => 'preset',
			'label' => esc_html__( 'Image Height(%)', 'wpv-bu' ),
			'type'  => 'number',
            'unit' => '%',
            'css'   => [
                [
                    'property' => 'height',
                    'selector' => '.bultr-content .bultr-image.bultr-media-button ',
                ],
            ],
            'required' => ['hideImage','=',false],
        ];

        $this->controls['presetImageOverlay'] = [
            'tab'   => 'content',
            'group' => 'preset',
            'label' => esc_html__( 'Overlay', 'wpv-bu' ),
            'type'  => 'select',
            'options' => [
                'none' => esc_html__( 'None', 'wpv-bu' ),
                'always' => esc_html__( 'Always', 'wpv-bu' ),
                'on_hover'=> esc_html__( 'On Hover', 'wpv-bu' ),
            ],
            'inline' => true,
            'default' => 'None',
            'required' => ['hideImage','=',false],
        ];

        $this->controls['overlayGradient'] = [
            'tab' => 'content',
            'group' => 'preset',
            'label' => esc_html__( 'Overlay Color', 'wpv-bu' ),
            'type' => 'gradient',
            
            'css' => [
              [
                'property' => 'background',
                'selector' => '.bultr-split.bultr-split-overlay .bultr-image.bultr-media-button::before',
              ],
              [
                'property' => 'background',
                'selector' => '.bultr-split.bultr-split-overlay.bultr-split-overlay-hover .bultr-product-card .bultr-image.bultr-media-button::before',
              ],
            ],
            'required' => ['presetImageOverlay','!=','none'],

        ];
       
        $this->controls['imageBoxBorder'] = [
            'tab' => 'content',
            'group'=> 'preset',
            'label' => esc_html__( 'Box Border', 'wpv-bu' ),
            'type' => 'border',
            'css' => [
              [
                'property' => 'border',
                'selector' => '.bultr-image',
              ],
            ],
            'inline' => true,  
            'required' => ['hideImage','=',false],  
        ];
        $this->controls['imageBoxShadow'] = [
            'tab' => 'content',
            'group' => 'preset',
            'label' => esc_html__( 'BoxShadow', 'wpv-bu' ),
            'type' => 'box-shadow',
            'css' => [
                [
                    'property' => 'box-shadow',
                    'selector' => '.bultr-image',
                ],
            ],
            'inline' => true,
            'small' => true,
            'required' => ['hideImage','=',false],
        ];

        $this->controls['imagePadding'] =[
            'tab' => 'content',
            'group' => 'preset',
            'label' => esc_html__( 'Padding', 'wpv-bu' ),
            'type' => 'dimensions',
            'css' => [
            [
                'property' => 'padding',
                'selector' => '.bultr-image',
            ],
            ],
            'required' => ['hideImage','=',false],
        ];
        //content
        $this->controls['presetContentSept'] = [
			'tab'      => 'content',
            'group'     => 'preset',
			'label'    => esc_html__( 'Content', 'wpv-bu' ),
			'type'     => 'separator',
		];
    
        $this->controls['splitGradient'] = [
            'tab' => 'content',
            'group' => 'preset',
            'label' => esc_html__( 'Background Color', 'wpv-bu' ),
            'type' => 'gradient',
            
            'css' => [
              [
                'property' => 'background',
                'selector' => '.bultr-split .bultr-woo-content',
              ],
              [
                'property' => 'background',
                'selector' => '.bultr-cover .bultr-woo-content',
              ],
            ],
        ];
        
        $this->controls['presetPadding']=[
            'tab' => 'content',
            'group'=> 'preset',
            'label' => esc_html__( 'Padding', 'wpv-bu' ),
            'type' => 'dimensions',
            'css' => [
              [
                'property' => 'padding',
                'selector' => '.bultr-split .bultr-woo-content',
              ]
            ],       
        ];
        $this->controls['presetContentSpace'] = [
            'tab'   => 'content',
            'group'     => 'preset',
            'label' => esc_html__( 'Content Space', 'wpv-bu' ),
            'type'  => 'justify-content',
            'css'   => [
              [
                'property' => 'justify-content',
                'selector' => '.bultr-split-row .bultr-woo-content',
              ],
              [
                'property' => 'justify-content',
                'selector' => '.bultr-split-row-reverse .bultr-woo-content',
              ],
            ],
            'required' => [['productSplitLayout','=',[ 'row-reverse','row']],

            ],
        ];

        $this->controls['preset2ContentSpace'] = [
            'tab'   => 'content',
            'group'     => 'preset',
            'label' => esc_html__( 'Content Space', 'wpv-bu' ),
            'type'  => 'justify-content',
            'css'   => [
              [
                'property' => 'justify-content',
                'selector' => '.bultr-split-preset2.bultr-split-column .bultr-product-card .bultr-woo-content-outer',
              ],
              [
                'property' => 'justify-content',
                'selector' => '.bultr-split-preset2.bultr-split-column-reverse .bultr-product-card .bultr-woo-content-outer',
              ],
            ],
            'required' => [['productSplitLayout','=',[ 'column-reverse','column']],
                            ['productLayoutPresets','=',[ 'preset2']],
            ],      
        ];

        $this->controls['preset2ContentGap'] = [
                    'tab'   => 'content',
                    'group'     => 'preset',
                    'label' => esc_html__( 'Content Gap', 'wpv-bu' ),
                    'type'  => 'number',
                    'info'  => esc_html__( 'The gap between content and price', 'wpv-bu' ),
                    'css'   => [
                    [
                        'property' => 'gap',
                        'selector' => '.bultr-split-preset2.bultr-split-column .bultr-product-card .bultr-woo-content-outer',
                     ],
                    [
                        'property' => 'gap',
                        'selector' => '.bultr-split-preset2.bultr-split-column-reverse .bultr-product-card .bultr-woo-content-outer',
                    ],
            ],
            'required' => [['productSplitLayout','=',[ 'column-reverse','column']],
                            ['productLayoutPresets','=',[ 'preset2']],
            ],      
        ];
        
        $this->controls['preset1ContentAlignmentHori'] = [
            'tab'   => 'content',
            'group' => 'preset',
            'label' => esc_html__( 'Alignment(Horizontal)', 'wpv-bu' ),
            'type'  => 'align-items',
            'css'   => [  
              [
                'property' => 'align-self',
                'selector' => '.bultr-product-card .bultr-content .bultr-woo-content .bultr-title',
              ],
              [
                'property' => 'align-self',
                'selector' => '.bultr-product-card .bultr-content .bultr-woo-content .bultr-rating',
              ],
              [
                'property' => 'align-self',
                'selector' => '.bultr-product-card .bultr-content .bultr-woo-content .bultr-price',
              ],
                [
                    'property' => 'align-self',
                    'selector' => '.bultr-product-card .bultr-content .bultr-woo-content .bultr-description',
                ],
            ],
            'exclude' => ['stretch'],
        ];

        $this->controls['presetButtonColumnVertical'] = [
            'tab'   => 'content',
            'group'     => 'preset',
            'label' => esc_html__( 'Alignment(Vertical)', 'wpv-bu' ),
            'type'  => 'justify-content',
            'css'   => [
              [
                'property' => 'justify-content',
                'selector' => '.bultr-split-column .bultr-woo-content .bultr-woo-content-inner',
              ],
              [
                'property' => 'justify-content',
                'selector' => '.bultr-split-column-reverse .bultr-woo-content .bultr-woo-content-inner',
              ],
            ],
            'exclude' => ['space'],
            'required' => [['productSplitLayout','=',[ 'column-reverse','column']],

            ],
        ];
    }
   

    public function get_cover_preset_style_controls(){

        $this->controls['coverSeptBox']=[
            'tab' => 'content',
            'group' => 'cover_preset',
            'label' => esc_html__( 'Product Card', 'wpv-bu' ),
            'type' => 'separator',
        ];
        $this->controls['coverBgColor'] =[
            'tab' => 'content',
            'group' => 'cover_preset',
            'label' => esc_html__( 'Background Color', 'wpv-bu' ),
            'type' => 'background',
            'css' => [
            [
                'property' => 'background',
                'selector' => '.bultr-cover .bultr-product-card',
            ],
            ],
            'inline' => true,
            'small' => true,
        ];
        $this->controls['coverBoxBorder'] = [
            'tab' => 'content',
            'group'=> 'cover_preset',
            'label' => esc_html__( 'Box Border', 'wpv-bu' ),
            'type' => 'border',
            'css' => [
              [
                'property' => 'border',
                'selector' => '.bultr-product-card',
              ],
            ],
            'inline' => true,    
        ];
        $this->controls['coverBoxShadow'] = [
            'tab' => 'content',
            'group'=> 'cover_preset',
            'label' => esc_html__( 'BoxShadow', 'wpv-bu' ),
            'type' => 'box-shadow',
            'css' => [
            [
                'property' => 'box-shadow',
                'selector' => '.bultr-product-card',
            ],
            ],
            'inline' => true,
            'small' => true,
        ];
        $this->controls['showContentHover']=[
            'tab'   => 'content',
            'group'     => 'cover_preset',
            'label' => esc_html__( 'Content Hover', 'wpv-bu' ),
            'type'  => 'checkbox',
            'default' => false,
            'required' => [ ['productlayout', '=', 'cover'],
            ['productLayoutPresets', '=', 'preset1'],],
        ];

        $this->controls['contentHvrAnmt']=[
            'tab'   => 'content',
            'group' => 'cover_preset',
            'label' => esc_html__( 'Hover Animation', 'wpv-bu' ),
            'type'  => 'select',
            'options' => [
                'top'     => __('Top', 'wpv-bu'),
                'left'     => __('Left', 'Wpv-bu'),
                'bottom'     => __('Bottom', 'wpv-bu'),
                'right'     => __('Right', 'wpv-bu'),
            ],
            'default' => 'top',
            'required' => [ ['showContentHover', '=', true ],
                            ['productlayout','=','cover'],
                            ['productLayoutPresets', '=', 'preset1'],],
        ];

        $this->controls['coverPadding'] =[
            'tab' => 'content',
            'group' => 'cover_preset',
            'label' => esc_html__( 'Padding', 'wpv-bu' ),
            'type' => 'dimensions',
            'css' => [
                [
                    'property' => 'padding',
                    'selector' => '.bultr-cover .bultr-product-card',
                ],
            ],
        ];
        
        $this->controls['coverMargin'] =[
            'tab' => 'content',
            'group' => 'cover_preset',
            'label' => esc_html__( 'Margin', 'wpv-bu' ),
            'type' => 'dimensions',
            'css' => [
                [
                    'property' => 'margin',
                    'selector' => '.bultr-cover .bultr-product-card',
                ],
            ],
        ];

        $this->controls['coverSeptContent']=[
            'tab' => 'content',
            'group' => 'cover_preset',
            'label' => esc_html__( 'Content', 'wpv-bu' ),
            'type' => 'separator',
        ];

        $this->controls['Gradient'] = [
            'tab' => 'content',
            'group' => 'cover_preset',
            'label' => esc_html__( 'Overlay Color', 'wpv-bu' ),
            'type' => 'gradient',
            
            'css' => [
              [
                'property' => 'background',
                'selector' => '.bultr-cover .bultr-product-card .bultr-content .bultr-woo-content',
              ],
            ],
        ];
        
        $this->controls['preset1ButtonRowVertical'] = [
            'tab'   => 'content',
            'group' => 'cover_preset',
            'label' => esc_html__( 'Alignment(Vertical)', 'wpv-bu' ),
            'type'  => 'justify-content',
            'css'   => [
              [
                'property' => 'justify-content',
                'selector' => '.bultr-cover-preset1 .bultr-product-card .bultr-content .bultr-woo-content',
              ],
            ],
            'required' => [ ['productlayout', '=', 'cover'], 
            ['productLayoutPresets', '=', 'preset1'],],  
        ];

        $this->controls['preset2ContentAlignmentVer'] = [
            'tab'   => 'content',
            'group' => 'cover_preset',
            'label' => esc_html__( 'Alignment', 'wpv-bu' ),
            'type'  => 'justify-content',
            'css'   => [
                [
                    'property' => 'justify-content',
                    'selector' => '.bultr-cover-preset2 .bultr-product-card .bultr-content .bultr-woo-content',
                ],
            ],
           
            'required' => [ ['productlayout', '=', 'cover'], 
            ['productLayoutPresets', '=', 'preset2'],],  
        ];
        $this->controls['preset2ContentAlignmentHori'] = [
            'tab'   => 'content',
            'group' => 'cover_preset',
            'label' => esc_html__( 'Alignment(Horizontal)', 'wpv-bu' ),
            'type'  => 'align-items',
            'css'   => [
              [
                'property' => 'align-items',
                'selector' => '.bultr-product-card .bultr-content .bultr-woo-content',
              ],    
              [
                'property' => 'align-self',
                'selector' => '.bultr-product-card .bultr-content .bultr-woo-content .bultr-title',
              ],
              [
                'property' => 'align-self',
                'selector' => '.bultr-product-card .bultr-content .bultr-woo-content .bultr-rating',
              ],
              [
                'property' => 'align-self',
                'selector' => '.bultr-product-card .bultr-content .bultr-woo-content .bultr-price',
              ],
                [
                    'property' => 'align-self',
                    'selector' => '.bultr-product-card .bultr-content .bultr-woo-content .bultr-description',
                ],
            ],
            'exclude' => ['stretch'],
            
            'required' => [ ['productlayout', '=', 'cover'], 
        ],  
        ];

        $this->controls['coverContentPadding'] = [
            'tab'   => 'content',
            'group' => 'cover_preset',
            'label' => esc_html__( 'Content Padding', 'wpv-bu' ),
            'type'  => 'dimensions',
            'css'   => [
              [
                'property' => 'padding',
                'selector' => '.bultr-cover-preset1 .bultr-product-card .bultr-content .bultr-woo-content-inner',
              ],
              [
                'property' => 'padding',
                'selector' => '.bultr-cover-preset2 .bultr-product-card .bultr-content .bultr-woo-content-inner',
              ],
            ],
            'exclude' => ['space'],
        ];

        $this->controls['coverContentWidth']=[
            'tab'   => 'content',
            'group' => 'cover_preset',
			'label' => esc_html__( 'Content Width(%)', 'wpv-bu' ),
			'type'  => 'number',
            'units' => '%',
            'css'   => [
                [
                    'property' => 'width',
                    'selector' => '.bultr-woo-content',

                ],
            ],
            
            'required' => [ ['productlayout', '=', 'cover'], 
                             ['productLayoutPresets', '=', 'preset1'],],  
     
        ];
       
        $this->controls['coverContentHeight']=[
            'tab'   => 'content',
            'group' => 'cover_preset',
			'label' => esc_html__( 'Content Height', 'wpv-bu' ),
			'type'  => 'number',
            'css'   => [
                [
                    'property' => 'height',
                    'selector' => '.bultr-woo-content',

                ],
            ],
            
            'required' => [ ['productlayout', '=', 'cover'],
                             ],  
     
        ];
        $this->controls['coverHoverContentHeight']=[
            'tab'   => 'content',
            'group' => 'cover_preset',
			'label' => esc_html__( 'Hover Height', 'wpv-bu' ),
			'type'  => 'number',
            'css'   => [
                [
                    'property' => 'height',
                    'selector' => '.bultr-cover-preset2 .bultr-product-card:hover .bultr-woo-content',

                ],
            ],
            
            'required' => [ ['productlayout', '=', 'cover'],
                             ],  
     
        ];
       
      
        $this->controls['coverContentTop']=[
            'tab'   => 'content',
            'group' => 'cover_preset',
            'label' => esc_html__( 'Top(px)', 'wpv-bu' ),
            'type'  => 'number',
            'unit' => 'px',
            'css'   => [
                [
                    'property' => 'top',
                    'selector' => '.bultr-woo-content',

                ],
               
            ],
            'required' => [ ['productlayout', '=', 'cover'], 
            ['productLayoutPresets', '=', 'preset1'],],  
            
        ];

        $this->controls['coverContentLeft']=[
            'tab'   => 'content',
            'group' => 'cover_preset',
            'label' => esc_html__( 'Left(px)', 'wpv-bu' ),
            'type'  => 'number',
            'unit' => 'px',
            'css'   => [
                [
                    'property' => 'left',
                    'selector' => '.bultr-woo-content',

                ],
               
            ],
            'required' => [ ['productlayout', '=', 'cover'], 
            ['productLayoutPresets', '=', 'preset1'],],  
            
        ];

        $this->controls['coverSeptDes']=[
            'tab' => 'content',
            'group' => 'cover_preset',
            'label' => esc_html__( 'Description', 'wpv-bu' ),
            'type' => 'separator',
        ];

    } 

    public function get_order_controls(){
       
        $this->controls['titleOrder'] = [
			'tab'      => 'content',
			'group'    => 'order_content',
			'label'    => esc_html__( 'Title', 'wpv-bu' ),
			'type'     => 'number',
            'units'    => false,
            'css'      => [
                [
                    'property' => 'order',
                    'selector' => '.bultr-content .bultr-title',
                ],
            ],
            'required' => ['hideTitle','=', false],
		];
        $this->controls['dscptOrder'] = [
			'tab'      => 'content',
			'group'    => 'order_content',
			'label'    => esc_html__( 'Description', 'wpv-bu' ),
			'type'     => 'number',
            'units'    => false,
            'css'      => [
                [
                    'property' => 'order',
                    'selector' => '.bultr-content .bultr-description',
                ],
            ],
            'required' => ['hideDescription','=', false],
		];
        $this->controls['ratingOrder'] = [
			'tab'      => 'content',
			'group'    => 'order_content',
			'label'    => esc_html__( 'Rating', 'wpv-bu' ),
			'type'     => 'number',
            'units'    => false,
            'css'      => [
                [
                    'property' => 'order',
                    'selector' => '.bultr-content .bultr-rating',
                ],
            ],
           
            'required' => ['hideRating','=', false],
		];
        $this->controls['priceOrder'] = [
			'tab'      => 'content',
			'group'    => 'order_content',
			'label'    => esc_html__( 'Price', 'wpv-bu' ),
			'type'     => 'number',
            'units'    => false,
            'css'      => [
                [
                    'property' => 'order',
                    'selector' => '.bultr-content .bultr-price',
                ],
            ],
            
            'required' => [['hidePrice','=', false],
                            ['productLayoutPresets','=','preset1']],
		];

        $this->controls['coverPriceOrder'] = [
			'tab'      => 'content',
			'group'    => 'order_content',
			'label'    => esc_html__( 'Price', 'wpv-bu' ),
			'type'     => 'number',
            'units'    => false,
            'css'      => [
                [
                    'property' => 'order',
                    'selector' => '.bultr-content .bultr-price',
                ],
            ],
            
            'required' => [['hidePrice','=', false],
                            ['productlayout','=','cover'],
                            ['productLayoutPresets','=','preset2']],
		];
    }
    
    public function get_onsales_controls(){ 
        $this->controls['hideSaleBadges']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Hide Sales/Out of Stock Badge', 'wpv-bu' ),
			'type'  => 'checkbox',
            'default' => false,
        ];
        $this->controls['disableStockBadge']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Hide Out of stock badge', 'wpv-bu' ),
			'type'  => 'checkbox',
            'default' => true,
            'required' => [
                ['woo_excludeOutStock', '=', false],
                ['hideSaleBadges','=', false],
            ],
        ];
        $this->controls['badgeStyles']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Layout', 'wpv-bu' ),
			'type'  => 'select',
            'options'   => [
                'preset1' => __('Preset1', 'wpv-bu'),
                'preset2' => __('Preset2', 'wpv-bu'),
                'preset3' => __('Preset3', 'wpv-bu'),
                'preset4' => __('Preset4', 'wpv-bu'),
                'preset5' => __('Preset5', 'wpv-bu'),

            ],
            'inline' => true,
            'default' => 'preset1',
            'clearable' => false,
            'required' => ['hideSaleBadges', '=', false],
        ];
        $this->controls['badgePosition']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Position', 'wpv-bu' ),
			'type'  => 'select',
            'options'   => [
                'left' => __('Left', 'wpv-bu'),
                'right' => __('Right', 'wpv-bu'),
            ],
            'clearable' => false,
            'default' => 'left',
            'inline' => true,
            'required' => ['hideSaleBadges', '=', false],

        ];

        $this->controls['salesText']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Sales Badge Text', 'wpv-bu' ),
			'type'  => 'text',
            'clearable' => false,
            'default' => __('Sale!','wpv-bu'),
            'placeholder' => __('Sale!','wpv-bu'),
            'description' => __('To get dynamic discount% add {{discount}}, and to get dynamic price off {{price_off}}.', 'wpv-bu'),
            'required' => ['hideSaleBadges', '=',false],
        ];
        $this->controls['stockText']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Out Of Stock Text', 'wpv-bu' ),
			'type'  => 'text',
            'clearable' => false,
            'default' => __('Out Of Stock','wpv-bu'),
            'placeholder' => __('Out Of Stock','wpv-bu'),

            'required' =>[ ['hideSaleBadges', '=', false],
                            ['disableStockBadge', '=', false],
                            ['woo_excludeOutStock', '=', false],
                        ],
        ];
        //Sales Style
        $this->controls['styleSaleSept']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Sales Badge Style', 'wpv-bu' ),
			'type'  => 'separator',
            'required' => ['hideSaleBadges', '=', false],

        ];
        $this->controls['salebadgecolor']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Color', 'wpv-bu' ),
			'type'  => 'color',
            'css'   => [
                [
                    'property' => 'color',
                    'selector' => '.bultr-woo-sales-tag .bultr-sales',

                ],
            ],
            'required' => ['hideSaleBadges', '=', false],
        ];
        $this->controls['salebadgeBgcolor']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Background', 'wpv-bu' ),
			'type'  => 'color',
            'css'   => [
                [
                    'property' => 'background',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales)',

                ],
                [
                    'property' => 'border-color',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales).bultr-preset2.bultr-left::before',

                ],
                [
                    'property' => 'border-color',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales).bultr-preset2.bultr-right::before',

                ],
                [
                    'property' => 'border-left-color',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales).bultr-preset4.bultr-left::before',

                ],
                [
                    'property' => 'border-right-color',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales).bultr-preset4.bultr-right::before',

                ],
                [
                    'property' => 'background',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales).bultr-preset5::after',

                ],
            ],
            'required' => ['hideSaleBadges', '=', false],
        ];
        $this->controls['salepreset4DotColor']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Dot Color', 'wpv-bu' ),
			'type'  => 'color',
            'css'   => [
                [
                    'property' => 'background',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales).bultr-preset4::after',

                ],
                
            ],
            'required' => [['hideSaleBadges', '=', false],
                                ['badgeStyles', '=', 'preset4'],
                            ],
        ];
        $this->controls['salepreset4DotSize']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Dot Size(px)', 'wpv-bu' ),
			'type'  => 'number',
            'min' => 1,
            'max' => 30,
            'unit' => 'px',
            'css'   => [
                [
                    'property' => 'width',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales).bultr-preset4::after',

                ],
                [
                    'property' => 'height',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales).bultr-preset4::after',

                ],
                
            ],
            'required' => [['hideSaleBadges', '=', false],
            ['badgeStyles', '=', 'preset4'],
            ],
        ];
        $this->controls['salepreset4DotPadding']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Dot Gap', 'wpv-bu' ),
			'type'  => 'number',
            'min' => 1,
            'unit' => 'px',
            'css'   => [
                [
                    'property' => 'padding-right',
                    'selector' => '.bultr-preset4 .bultr-sales',

                ], 
            ],
            'required' => [['hideSaleBadges', '=', false],
            ['badgeStyles', '=', 'preset4'],
            ],
        ];
        $this->controls['salebadgeTypo']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Typography', 'wpv-bu' ),
			'type'  => 'typography',
            'css'   => [
                [
                    'property' => 'font',
                    'selector' => '.bultr-woo-sales-tag .bultr-sales',

                ],
            ],
            'exclude' => [
                'color',
            ],
            'required' => ['hideSaleBadges', '=', false],
        ];
        $this->controls['salebadgeBorder']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Border', 'wpv-bu' ),
			'type'  => 'border',
            'css'   => [
                [
                    'property' => 'border',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales).bultr-preset1',

                ],
            ],
            
            'required' => [
                ['hideSaleBadges', '=', false],
                ['badgeStyles', '=', 'preset1'],
            ],        
        ];
        $this->controls['salebadgeBoxShd']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Box Shadow', 'wpv-bu' ),
			'type'  => 'box-shadow',
            'css'   => [
                [
                    'property' => 'box-shadow',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales).bultr-preset1',

                ],
            ],
            
            'required' => [
                ['hideSaleBadges', '=', false],
                ['badgeStyles', '=', 'preset1'],
            ],
        ];
        $this->controls['salebadgeWidth']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Width', 'wpv-bu' ),
			'type'  => 'number',
            'units' => true,
            'css'   => [
                [
                    'property' => 'width',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales)',

                ],
            ],
            
            'required' => ['hideSaleBadges', '=', false],
        ];
        $this->controls['salebadgeHeight']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Height', 'wpv-bu' ),
			'type'  => 'number',
            'units' => true,
            'css'   => [
                [
                    'property' => 'height',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales).bultr-preset1',
                ],
                [
                    'property' => 'height',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales).bultr-preset2',
                ],
                [
                    'property' => 'height',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales).bultr-preset4',
                ],
                [
                    'property' => '--bultr-woo-border-width',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales)',
                    'value' => '%s',
                ],
                [
                    'property' => 'height',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales).bultr-preset5',
                ],
                [
                    'property' => '--bultr-woo-preset5-height',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales).bultr-preset5',
                    'value' => '%s',
                ],

            ],
            'clearable'=> false,
            'default' => '30px',

            'required' => [
                ['hideSaleBadges', '=', false],
                ['badgeStyles', '=', ['preset1','preset4','preset2','preset5']],
            ],
        ];
        $this->controls['salebadgeBorderRds']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Border Radius', 'wpv-bu' ),
			'type'  => 'number',
            'units' => false,
            'css'   => [
                [
                    'property' => '--bultr-woo-badge-BR',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales)',
                    'value' => '%spx',
                ],
            ],
            'default' => 5,
            'required' => [
                ['hideSaleBadges', '=', false],
                ['badgeStyles', '=', ['preset5']],
            ],
        ];
        $this->controls['salebadgePadding']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
            'css'   => [
                [
                    'property' => 'padding',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales).bultr-preset1',
                ],
                [
                    'property' => 'padding',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales).bultr-preset3',
                ],
            ],
            'required' => [
                ['hideSaleBadges', '=', false],
                ['badgeStyles', '=', ['preset1','preset3']],
            ],
        ];
        $this->controls['salebadgeMargin']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Margin', 'wpv-bu' ),
			'type'  => 'dimensions',
            'css'   => [
                [
                    'property' => 'margin',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-sales)',
                ],
            ],
            
            'required' => ['hideSaleBadges', '=', false],
        ];
        //Out Of Stock Styles
        $this->controls['styleStockSept']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Out of stock badge style', 'wpv-bu' ),
			'type'  => 'separator',
            'required' =>[ ['hideSaleBadges', '=', false],
                            ['disableStockBadge', '=', false],
                            ['woo_excludeOutStock', '=', false],
                        ],

        ];
        $this->controls['stockbadgecolor']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Color', 'wpv-bu' ),
			'type'  => 'color',
            'css'   => [
                [
                    'property' => 'color',
                    'selector' => '.bultr-woo-sales-tag .bultr-stock-out',

                ],
            ],
            'required' =>[ ['hideSaleBadges', '=', false],
            ['disableStockBadge', '=', false],
            ['woo_excludeOutStock', '=', false],
        ],
        ];
        $this->controls['stockbadgeBgcolor']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Background', 'wpv-bu' ),
			'type'  => 'color',
            'css'   => [
                [
                    'property' => 'background',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out)',

                ],
                [
                    'property' => 'border-color',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out).bultr-preset2.bultr-left::before',

                ],
                [
                    'property' => 'border-color',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out).bultr-preset2.bultr-right::before',

                ],
                [
                    'property' => 'border-left-color',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out).bultr-preset4.bultr-left::before',

                ],
                [
                    'property' => 'border-right-color',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out).bultr-preset4.bultr-right::before',

                ],
                [
                    'property' => 'background',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out).bultr-preset5::after',

                ],
            ],
            'required' =>[ ['hideSaleBadges', '=', false],
                            ['disableStockBadge', '=', false],
                            ['woo_excludeOutStock', '=', false],
                        ],
        ];
        $this->controls['stockpreset4DotColor']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Dot Color', 'wpv-bu' ),
			'type'  => 'color',
            'css'   => [
                [
                    'property' => 'background',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out).bultr-preset4::after',

                ],
                
            ],
            'default' => [
                'hex' => '#fff',
            ],
            'required' =>[ ['hideSaleBadges', '=', false],
            ['disableStockBadge', '=', false],
            ['woo_excludeOutStock', '=', false],
            ['badgeStyles', '=', 'preset4'],
        ],
        ];
        $this->controls['stockpreset4DotSize']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Dot Size', 'wpv-bu' ),
			'type'  => 'number',
            'min' => 1,
            'max' => 30,
            'unit' => 'px',
            'css'   => [
                [
                    'property' => 'width',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out).bultr-preset4::after',

                ],
                [
                    'property' => 'height',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out).bultr-preset4::after',

                ],
                
            ],
            'required' =>[ ['hideSaleBadges', '=', false],
                            ['disableStockBadge', '=', false],
                            ['woo_excludeOutStock', '=', false],
                            ['badgeStyles', '=', 'preset4'],
                            ],
        ];
        $this->controls['stockpreset4DotPadding']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Dot Gap', 'wpv-bu' ),
			'type'  => 'number',
            'min' => 1,
            'unit' => 'px',
            'css'   => [
                [
                    'property' => 'padding-right',
                    'selector' => '.bultr-preset4 .bultr-stock-out',

                ], 
            ],
            'required' =>[ ['hideSaleBadges', '=', false],
            ['disableStockBadge', '=', false],
            ['woo_excludeOutStock', '=', false],
            ['badgeStyles', '=', 'preset4'],
            ],
        ];
        $this->controls['stockbadgeTypo']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Typography', 'wpv-bu' ),
			'type'  => 'typography',
            'css'   => [
                [
                    'property' => 'font',
                    'selector' => '.bultr-woo-sales-tag .bultr-stock-out',

                ],
            ],
            'exclude' => [
                'color',
            ],
            'required' =>[ ['hideSaleBadges', '=', false],
            ['disableStockBadge', '=', false],
            ['woo_excludeOutStock', '=', false],
        ],
        ];
        $this->controls['stockbadgeBorder']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Border', 'wpv-bu' ),
			'type'  => 'border',
            'css'   => [
                [
                    'property' => 'border',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out).bultr-preset1',

                ],
            ],
            
            'required' => [['hideSaleBadges', '=', false],
                ['disableStockBadge', '=', false],
                ['woo_excludeOutStock', '=', false],
                ['badgeStyles', '=', 'preset1'],
            ],
        ];
        $this->controls['stockbadgeBoxShd']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Box Shadow', 'wpv-bu' ),
			'type'  => 'box-shadow',
            'css'   => [
                [
                    'property' => 'box-shadow',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out).bultr-preset1',

                ],
            ],
            
            'required' =>[ ['hideSaleBadges', '=', false],
            ['disableStockBadge', '=', false],
            ['woo_excludeOutStock', '=', false],
                ['badgeStyles', '=', 'preset1'],
            ],
        ];
        $this->controls['stockbadgeWidth']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Width', 'wpv-bu' ),
			'type'  => 'number',
            'units' => true,
            'css'   => [
                [
                    'property' => 'width',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out)',

                ],
            ],
            
            'required' =>[ ['hideSaleBadges', '=', false],
                            ['disableStockBadge', '=', false],
                            ['woo_excludeOutStock', '=', false],
                        ],
        ];
        $this->controls['stockbadgeHeight']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Height', 'wpv-bu' ),
			'type'  => 'number',
            'units' => true,
            'css'   => [
                [
                    'property' => 'height',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out).bultr-preset1',

                ],
                [
                    'property' => 'height',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out).bultr-preset2',
                ],
                [
                    'property' => 'height',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out).bultr-preset4',
                ],
                [
                    'property' => '--bultr-woo-border-width',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out)',
                    'value' => '%s',
                ],
                [
                    'property' => 'height',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out).bultr-preset5',
                ],
                [
                    'property' => '--bultr-woo-preset5-height',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out).bultr-preset5',
                    'value' => '%s',
                ],
            ],
            'clearable'=>false,
            'default' => '30px',
            'required' => [['hideSaleBadges', '=', false],
                ['disableStockBadge', '=', false],
                ['woo_excludeOutStock', '=', false],
                ['badgeStyles', '=', ['preset1','preset4','preset5','preset2']],
            ],
        ];
        $this->controls['stockbadgeBorderRds']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Border Radius', 'wpv-bu' ),
			'type'  => 'number',
            'units' => false,
            'css'   => [
                [
                    'property' => '--bultr-woo-badge-BR',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out).bultr-preset5',
                    'value' => '%spx',
                ],
            ],
            'default' => 5,
            'required' =>[ ['hideSaleBadges', '=', false],
                            ['disableStockBadge', '=', false],
                            ['woo_excludeOutStock', '=', false],
                ['badgeStyles', '=', ['preset5']],
            ],
        ];
        $this->controls['stockbadgePadding']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Padding', 'wpv-bu' ),
			'type'  => 'dimensions',
            'css'   => [
                [
                    'property' => 'padding',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out).bultr-preset1',
                ],
                [
                    'property' => 'padding',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out).bultr-preset3',
                ],
            ],
            
            'required' =>[ ['hideSaleBadges', '=', false],
                            ['disableStockBadge', '=', false],
                            ['woo_excludeOutStock', '=', false],
                ['badgeStyles', '=', ['preset1','preset3']],
            ],       
        ];
        $this->controls['stockbadgeMargin']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Margin', 'wpv-bu' ),
			'type'  => 'dimensions',
            'css'   => [
                [
                    'property' => 'margin',
                    'selector' => '.bultr-woo-sales-tag:has(.bultr-stock-out)',
                ],
            ],
            
            'required' =>[ ['hideSaleBadges', '=', false],
                            ['disableStockBadge', '=', false],
                            ['woo_excludeOutStock', '=', false],
                        ],
        ];
        $this->controls['leftbadgeDistance']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Distance', 'wpv-bu' ),
			'type'  => 'number',
            'info' => __('Give units in px','wpv-bu'),
            'max' => 70,
            'placeholder' => '40px',
            'css'   => [
                [
                    'property' => 'top',
                    'selector' => '.bultr-woo-sales-tag.bultr-preset3.bultr-left',
                    'value' => '%s',

                ],
                [
                    'property' => 'left',
                    'selector' => '.bultr-woo-sales-tag.bultr-preset3.bultr-left',
                    'value' => '%s',

                ],
            ],
            'default' => 40,
            'required' =>[ ['hideSaleBadges', '=', false],
                            ['disableStockBadge', '=', false],
                            ['woo_excludeOutStock', '=', false],
                ['badgeStyles' , '=', 'preset3'],
                ['badgePosition','=', 'left'],

            ],
        ];
        $this->controls['rightbadgeDistance']=[
            'tab'   => 'content',
            'group' => 'sales_badge',
			'label' => esc_html__( 'Distance', 'wpv-bu' ),
			'type'  => 'number',
            'info' => __('Give units in px','wpv-bu'),
            'min' => 3,
            'max' => 70,
            'css'   => [
                [
                    'property' => 'top',
                    'selector' => '.bultr-woo-sales-tag.bultr-preset3.bultr-right',
                    'value' => '%s',

                ],
                [
                    'property' => 'right',
                    'selector' => '.bultr-woo-sales-tag.bultr-preset3.bultr-right',
                    'value' => '%s',

                ],
                
            ],
            'default' => 40,
            'required' =>[ ['hideSaleBadges', '=', false],
            ['disableStockBadge', '=', false],
            ['woo_excludeOutStock', '=', false],
                ['badgeStyles' , '=', 'preset3'],
                ['badgePosition','=', 'right'],
            ],
        ];
       
    }
  
    public function get_product_settings_controls(){
        //getting categories key and name
        $category = $this->get_category_name();
        $tags = $this->get_tags_name();
        $this->controls['woo_filterby']   = [
			'tab'   => 'content',
			'group' => 'product_query',
			'label' => esc_html__( 'Filter By', 'wpv-bu' ),
			'type'  => 'select',
			'options' => [
                'recent'        => __('Recent Products', 'wpv-bu'),
                'featured'      => __('Featured Product','wpv-bu'),
                'best-selling'  => __('Best Selling Product','wpv-bu'),
                'sale'          => __('Sale Products', 'wpv-bu'),
                'top-rated'     => __('Top Rated Products', 'wpv-bu'),
                'manual'        => __('Manual Selection','wpv-bu'),
              ],
		];
        
        $this->controls['woo_include_product']=[
            'tab'   => 'content',
			'group' => 'product_query',
			'label' => esc_html__( 'Include Product(s)', 'wpv-bu' ),
			'type'  => 'text',
            'required' => [
                'woo_filterby' , '=', 'manual'
            ],
            'description' => __('Include specific product by giving their product ID. To include multiple products, simply separate the IDs with commas, for example, 3322,4434.', 'wpv-bu'),
        ];

        $this->controls['woo_exclude_product']=[
            'tab'   => 'content',
			'group' => 'product_query',
			'label' => esc_html__( 'Exclude Product(s)', 'wpv-bu' ),
			'type'  => 'text',
            'description' => __('Exclude specific product by giving their product ID. To exclude multiple products, simply separate the IDs with commas, for example, 3322,4434.', 'wpv-bu'),
        ];
        $this->controls['woo_excludeOutStock']=[
            'tab'   => 'content',
			'group' => 'product_query',
			'label' => esc_html__( 'Exclude Out Of Stock ', 'wpv-bu' ),
			'type'  => 'checkbox',
        ];
        $this->controls['woo_order_by'] =[
            'tab'   => 'content',
			'group' => 'product_query',
			'label' => esc_html__( 'Order By', 'wpv-bu' ),
			'type'  => 'select',
            'options' => [
                'ID'          => __('Product Id','wpv-bu'),
                'title'       => __('Product Title', 'wpv-bu'),
                'price'       => __('Price','wpv-bu'),
                'sku'         => __('SKU','wpv-bu'),
                'date'        => __('Date','wpv-bu'),
                'modified'    => __('Last Modified Date','wpv-bu'),
                'parent'      => __('Parent ID', 'wpv-bu'),
                'rand'        => __('Random','wpv-bu'),
                'menu_order'  => __('Menu Order','wpv-bu'),
            ],
            'required' => ['woo_filterby', '!=', ['sale', 'best-selling', 'top-rated']],
        ];
        $this->controls['woo_order']=[
            'tab'   => 'content',
			'group' => 'product_query',
			'label' => esc_html__( 'Order', 'wpv-bu' ),
			'type'  => 'select',
            'options' => [
                'ASC' => __('Ascending','wpv-bu'),
                'DESC' => __('Descending', 'wpv-bu'),
            ],
            'required' => [['woo_filterby', '!=', ['','recent','best-selling', 'top-rated']]],
        ];
        $this->controls['woo_product_count']=[
            'tab'   => 'content',
			'group' => 'product_query',
			'label' => esc_html__( 'Product Count', 'wpv-bu' ),
			'type'  => 'number',
            'min' => 0,
            'step' => '1',
            'inline' => true,
        ];
        $this->controls['woo_offset']=[
            'tab'   => 'content',
			'group' => 'product_query',
			'label' => esc_html__( 'Offset', 'wpv-bu' ),
			'type'  => 'number',
            'min' => 0,
            'step' => '1',
            'inline' => true,
        ];
        $this->controls['woo_product_status'] =[
            'tab'   => 'content',
			'group' => 'product_query',
			'label' => esc_html__( 'Product Status', 'wpv-bu' ),
			'type'  => 'select',
            'options' => [
                'publish' => __('Publish','wpv-bu'),
                'draft' => __('Draft','wpv-bu'),
                'pending' => __('Pending Review','wpv-bu'),
                'future' => __('Schedule','wpv-bu'),
            ],
          
            'multiple' => true, 

        ];
        $this->controls['woo_categorires']=[
            'tab'   => 'content',
			'group' => 'product_query',
			'label' => esc_html__( 'Product Categories', 'wpv-bu' ),
			'type'  => 'select',
            'options' => $category,
            'multiple' => true,   
            'searchable' => true,
          
        ];
        $this->controls['woo_tags']=[
            'tab'   => 'content',
			'group' => 'product_query',
			'label' => esc_html__( 'Product Tag(s)', 'wpv-bu' ),
			'type'  => 'select',
            'options' => $tags,
            'multiple' => true,   
            'searchable' => true,
          
        ];
    }
    public function get_category_name(){
        $terms = get_terms(array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
        ) );

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $categories=[];

            foreach($terms as $key => $term){
                $name = $term->name;
                $catslug = $term->slug;
                $categories[$catslug] = $name;           
            }

            return $categories;
        } 
    }
    public function get_tags_name(){
        $terms = get_terms(array(
            'taxonomy' => 'product_tag',
            'hide_empty' => false,
        ) );

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $tags=[];

            foreach($terms as $key => $term){
                $name = $term->name;
                $tagslug = $term->slug;
                $tags[$tagslug] = $name;           
            }

            return $tags;
        } 
    }
    public function get_product_query(){
        $settings = $this->settings;
        $post_per_page = isset($settings['woo_product_count']) ? $settings['woo_product_count'] : 10;
        $offset = isset($settings['woo_offset']) ? $settings['woo_offset'] : '';
        $order = isset($settings['woo_order']) ? $settings['woo_order'] : __('Desc', 'wpv-bu');
        $product_status = isset($settings['woo_product_status']) ? $settings['woo_product_status'] : __('Publish','wpv-bu');
      
        $product_category = isset($settings['woo_categorires']) ? $settings['woo_categorires'] : '';
        $product_tag = isset($settings['woo_tags']) ? $settings['woo_tags'] : '';
        $product_stock_status = isset($settings['woo_excludeOutStock']) ? "instock" : '';
        $args = [
            'posts_per_page'    => $post_per_page,
			'status'            => $product_status,
			'post_type'         => 'product',
            'offset'            => $offset,
            'category'          => $product_category,
            'tag'               => $product_tag,
            'stock_status'      => $product_stock_status,

        ];

        $args = $this->get_query_values($settings,$args,$order);

        //including products by id
        if (isset($settings['woo_filterby'])&& $settings['woo_filterby'] === 'manual') {

        if(!empty($settings['woo_include_product'])){
            $a = $settings['woo_include_product'];
            $prt_id = explode("," ,$a);
            $args['include'] = $prt_id;
        }
    }
        if(!empty($settings['woo_exclude_product'])){
            $a = $settings['woo_exclude_product'];
            $prt_id = explode("," ,$a);
            $args['exclude'] = $prt_id;
        }
     
        return $args;

    }
    public function get_recent_query($settings, $args){
        $args['order']  =  'Desc';
        $args['orderby'] = isset($settings['woo_order_by']) ? $settings['woo_order_by'] : 'date';
         if(isset($settings['woo_order_by'])){
            $args['orderby'] = $settings['woo_order_by'];
   
               if($settings['woo_order_by'] === 'price'){
                   $args['orderby'] = 'meta_value_num';
                   $args['meta_key']  = '_price';
               }
   
           }
        return $args;
    }
   
    public function get_featured_query($args,$order){
        $tax_query[] = array(
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'featured',
            'operator' => 'IN', // or 'NOT IN' to exclude feature products
        );
        $args['order']  =  $order;
        $args['tax_query'] = $tax_query;
        return $args;
    }
    public function get_sales_query($args,$order){
        $today = date('Y-m-d');
        $args['order']  =  $order;
        $args['orderby'] = 'meta_value_num';
        $args['meta_key']  = '_sale_price';
        $args['meta_query'] = [
            'relation' => 'AND',
            [
                'relation' => 'AND',
                [
                    'key' => '_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'NUMERIC',
                ],
                [
                    'key' => '_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'NUMERIC',
                ],
                
            ],
            [
                'relation' => 'OR',
                [
                    'key' => '_sale_price_dates_from',
                    'value' => $today,
                    'compare' => '<=',
                    'type' => 'DATE',
                ],
                [
                    'key' => '_sale_price_dates_from',
                    'value' => '',
                    'compare' => '=',
                ],

            ],
            [
                'relation' => 'OR',
                [
                    'key' => '_sale_price_dates_to',
                    'value' => $today,
                    'compare' => '>=',
                    'type' => 'DATE',
                ],
                [
                    'key' => '_sale_price_dates_to',
                    'value' => '',
                    'compare' => '=',
                ],
            ]
        ];
        return $args;
    }
    public function get_best_selling_query($args, $order){
        $args['order']  =  $order;
        $args['meta_key']  =  'total_sales';
        $args['orderby'] = 'meta_value_num';
        return $args;
         
    }
    public function get_top_rated_query($args, $order){
        $args['meta_key'] = '_wc_average_rating';
        $args['orderby'] = 'meta_value_num'; 
        $args['order']  =  'DESC';
        return $args;
    }
    public function get_query_values($settings, $args,$order){
        if(isset($settings['woo_order_by'])){
         $args['orderby'] = $settings['woo_order_by'];

            if($settings['woo_order_by'] === 'price'){
                $args['orderby'] = 'meta_value_num';
                $args['meta_key']  = '_price';
            }

        }
       
        

        if(isset($settings['woo_filterby'])){
            switch ($settings['woo_filterby']){
                case 'recent' :
                    $args = $this->get_recent_query($settings, $args);
                    break;
                case 'featured' : 
                    $args = $this->get_featured_query($args, $order);
                    break;
                case 'top-rated' : 
                    $args = $this->get_top_rated_query($args, $order);
                    break;
                case 'best-selling' :
                    $args = $this->get_best_selling_query($args, $order);
                    break;
                case 'sale' :
                    $args = $this->get_sales_query($args, $order);
                    break; 
            }
        }
        return $args;
    }

    // slider
    public function get_swiper_slides_controls(){
        $this->controls['effect']=[
            'tab'           => 'content',
            'group'         => 'slider_settings',
            'label'         => esc_html__('Effect', 'wpv-bu'),
            'type'          => 'select',
            'options'       =>[
                'slide'     => __('Slide', 'wpv-bu'),
                'fade'      => __('Fade', 'wpv-bu'),
                'cube'      => __('Cube', 'wpv-bu'),
                'coverflow' => __('Coverflow', 'wpv-bu'),
                'flip'      => __('Flip','wpv-bu'),
            ],
            'inline'        => true,
            'default'       => 'slide',
            'clearable'     => false,
            'placeholder'   => __('Slide', 'wpv-bu'),
			'info'          => __( '"Fade", "Cube", and "Flip" require "Items To Show" set to 1.', 'wpv-bu' ),
        ];
        $this->controls['slidesToShow']=[
            'tab'           => 'content',
            'group'         => 'slider_settings',
            'label'         => esc_html__('Items to show', 'wpv-bu'),
            'type'          => 'number',
            'min'           => 1,
            'max'           => 12,
            'placeholder'   => 3,
            'default'       => 3,
            'clearable'     => false,
            'breakpoints'   => true,   
            'required'      => ['effect', '=', ['slide', 'coverflow']],
        ];
        $this->controls['slidesToScroll']=[
            'tab'           => 'content',
            'group'         => 'slider_settings',
            'label'         => esc_html__('Items to scroll', 'wpv-bu'),
            'type'          => 'number',
            'min'           => 1,
            'max'           => 12,
            'placeholder'   => 1,
            'default'       => 1,
            'clearable'     => false,
            'breakpoints'   => true,   
            'required'      => ['effect', '=', ['slide', 'coverflow']],

        ];
        $this->controls['slideShd']=[
            'tab'           => 'content',
            'group'         => 'slider_settings',
            'label'         => esc_html__('Slides Shadow', 'wpv-bu'),
            'type'          => 'checkbox',
            'required'      => ['effect', '=', ['coverflow','flip','cube']],

        ];
        $this->controls['cubeshadow']=[
            'tab'           => 'content',
            'group'         => 'slider_settings',
            'label'         => esc_html__('Shadow', 'wpv-bu'),
            'type'          => 'checkbox',
            'required'      => ['effect', '=', 'cube'],
        ];
        $this->controls['cubeShdOffset']=[
            'tab'           => 'content',
            'group'         => 'slider_settings',
            'label'         => esc_html__('Shadow Offset', 'wpv-bu'),
            'type'          => 'number',
            'min'           => 1,
            'step'          => 1,
            'required'      => ['effect', '=', 'cube'],
        ];
        $this->controls['cubeShdScale']=[
            'tab'           => 'content',
            'group'         => 'slider_settings',
            'label'         => esc_html__('Shadow Scale', 'wpv-bu'),
            'type'          => 'number',
            'min'           => 0.0,
            'step'          => 0.01,
            'required'      => ['effect', '=', 'cube'],
        ];
        
        $this->controls['gutter'] =[
            'tab'           => 'content',
            'group'         => 'slider_settings',
            'label'         => esc_html__('Spacing (px)', 'wpv-bu'),
            'type'          => 'number',
            'units'         => false,
            'placeholder'   => 0,
            'required'      => ['effect' , '!=', ['cube','flip','fade']],
        ];
        $this->controls['speed']=[
            'tab'           => 'content',
            'group'         => 'slider_settings',
            'label'         => esc_html__('Animation speed in ms', 'wpv-bu'),
            'type'          => 'number',
            'placeholder'   => 300,
            'small'         => true,
        ];
        $this->controls['autoplay']=[
            'tab'           => 'content',
            'group'         => 'slider_settings',
            'label'         => esc_html__('Autoplay', 'wpv-bu'),
            'type'          => 'checkbox',
        ];
        $this->controls['disableInteraction']=[
            'tab'           => 'content',
            'group'         => 'slider_settings',
            'label'         => esc_html__('Enable On Interaction', 'wpv-bu'),
            'type'          => 'checkbox',
            'required'      => [ 'autoplay', '!=', '' ],
        ];
        $this->controls['pauseOnHover']=[
            'tab'           => 'content',
            'group'         => 'slider_settings',
            'label'         => esc_html__('Pause On Hover', 'wpv-bu'),
            'type'          => 'checkbox',
            'required'      => [ 'autoplay', '!=', '' ],
        ];
        $this->controls['stopOnLastSlide']=[
            'tab'           => 'content',
            'group'         => 'slider_settings',
            'label'         => esc_html__('Stop on last slide', 'wpv-bu'),
            'type'          => 'checkbox',
            'info'          => esc_html__( 'No effect with loop enabled', 'wpv-bu' ),
            'required'      => [ 'autoplay', '!=', '' ],
        ];
        $this->controls['autoplaySpeed']=[
            'tab'           => 'content',
            'group'         => 'slider_settings',
            'label'         => esc_html__('Autoplay delay in ms', 'wpv-bu'),
            'type'          => 'number',
            'placeholder'   => 1000,
            'unit'          => 'ms',
            'required'      => [ 'autoplay', '!=', '' ],
            'small'         => true,

        ];
        $this->controls['infinite'] =[
            'tab'           => 'content',
            'group'         => 'slider_settings',
            'label'         => esc_html__('Loop', 'wpv-bu'),
            'type'          => 'checkbox',
        ];
        $this->controls['centerMode']=[
            'tab'           => 'content',
            'group'         => 'slider_settings',
            'label'         => esc_html__('Center Mode', 'wpv-bu'),
            'type'          => 'checkbox',
            'required'      => ['effect' , '!=', ['cube','flip','fade']],

        ];
        $this->controls['adativeHeight']=[
            'tab'           => 'content',
            'group'         => 'slider_settings',
            'label'         => esc_html__('Adaptive Height', 'wpv-bu'),
            'type'          => 'checkbox',
            'info'          => esc_html__(' When true, slider wrapper will automatically adjust its height to match the height of the currently active slide.','wpv-bu'),
        ];

        $this->controls['cursor']=[
            'tab'           => 'content',
            'group'         => 'slider_settings',
            'label'         => esc_html__('Grab Cursor', 'wpv-bu'),
            'type'          => 'checkbox',
            'info'          => esc_html__('When true, hovering over the slider will display the grab cursor','wpv-bu'),

       ];
        
    }
    public function navigation_style_controls(){
        $this->controls['arrowShow']=[
            'tab' => 'content',
            'group' => 'nav_arrows',
            'label' => esc_html__('Show Arrows','wpv-bu'),
            'type'     => 'checkbox',
			'inline'   => true,
			'default'  => true,
        ];

        $this->controls['prevArrow'] = [
			'tab'      => 'content',
			'group'    => 'nav_arrows',
			'label'    => esc_html__( 'Previous Arrow Icon', 'wpv-bu' ),
			'type'     => 'icon',
			'default'  => [
				'library' => 'ionicons',
				'icon'    => 'ion-ios-arrow-back',
			],
			'css'      => [
				[
					'selector' => '.bricks-swiper-button-prev > *',
				],
			],
			'required'    => [ 'arrowShow', '!=', '' ],
			'rerender' => true,
		];
        $this->controls['nextArrow'] = [
			'tab'      => 'content',
			'group'    => 'nav_arrows',
			'label'    => esc_html__( 'Next Arrow Icon', 'wpv-bu' ),
			'type'     => 'icon',
			'default'  => [
				'library' => 'ionicons',
				'icon'    => 'ion-ios-arrow-forward',
			],
			'css'      => [
				[
					'selector' => '.bricks-swiper-button-next > *',
				],
			],
			'required'    => [ 'arrowShow', '!=', '' ],
			'rerender' => true,
		];
        $this->controls['arrowLayout']=[
            'tab' => 'content',
            'group' => 'nav_arrows',
            'label' => esc_html__('Position','wpv-bu'),
            'type'     => 'select',
            'options' => [
                'inside' => __('Inside','wpv-bu'),
                'outside' => __('Outside','wpv-bu'),
            ],
            'clearable' => false,
            'default' => 'inside',
            'inline' => true,
            'required'    => [ 'arrowShow', '!=', '' ],

        ];
        $this->controls['hrztPst']=[
            'tab' => 'content',
            'group' => 'nav_arrows',
            'label' => esc_html__('Horizontal Position','wpv-bu'),
            'type'     => 'select',
            'options' => [
                'left' => __('Left','wpv-bu'),
                'center' => __('Side by Side','wpv-bu'),
                'right'   =>__('Right','wpv-bu'),
            ],
            'clearable' => false,
            'default' => 'center',
            'inline' => true,
            'required'    => [ 'arrowShow', '!=', '' ],

        ];
        $this->controls['vrtlPstIn']=[
            'tab' => 'content',
            'group' => 'nav_arrows',
            'label' => esc_html__('Vertical Position','wpv-bu'),
            'type'     => 'select',
            'options' => [
                'top' => __('Top','wpv-bu'),
                'middle' => __('Middle','wpv-bu'),
                'bottom'   =>__('Bottom','wpv-bu'),
            ],
            'clearable' => false,
            'default' => 'middle',
            'inline' => true,
            'required'    => [[ 'arrowShow', '!=', '' ],['arrowLayout','=','inside']],

        ];
        $this->controls['vrtlPstOut']=[
            'tab' => 'content',
            'group' => 'nav_arrows',
            'label' => esc_html__('Vertical Position','wpv-bu'),
            'type'     => 'select',
            'options' => [
                'top' => __('Top','wpv-bu'),
                'bottom'   =>__('Bottom','wpv-bu'),
            ],
            'default' => 'top',
            'inline' => true,
            'required'    => [[ 'arrowShow', '!=', '' ],['arrowLayout','=','outside']],

        ];
        $this->controls['hrztlOffset']=[
            'tab' => 'content',
            'group' => 'nav_arrows',
            'label' => esc_html__('Horizontal Offset','wpv-bu'),
            'type' => 'number',
            'units'    =>['%', 'px', 'em', 'rem'],
            'css' =>[
                [
                    'selector' => '',
                    'property' => '--bultr-woo-hrztlOffset',
                    'value'    => '%s',
                ],
            ], 
            'required' => [ 'arrowShow', '!=', '' ],

        ];
        $this->controls['vertlOffset']=[
            'tab' => 'content',
            'group' => 'nav_arrows',
            'label' => esc_html__('Vertical','wpv-bu'),
            'type' => 'number',
            'units'    => ['%', 'px', 'em', 'rem'],
            'css' =>[
                [
                    'selector' => '',
                    'property' => '--bultr-woo-vertlOffset',
                    'value'    => '%s',
                ],
            ], 
            'required'    => [[ 'arrowShow', '!=', '' ],['arrowLayout','=', 'inside' ],['vrtlPstIn', '!=', 'middle'],],

        ];
        $this->controls['outsidePadding']=[
            'tab'   => 'content',
            'group' => 'nav_arrows',
            'label' => esc_html__('Outside Gap','wpv-bu'),
            'type'  => 'number',
            'units' => true,
            'css'   =>[
                [
                    'selector' => '',
                    'property' => '--bultr-woo-outsidegap',
                    'value'    => '%s',
                ],
            ],
            'required'    => [
                [ 'arrowShow', '!=', '' ],
                ['arrowLayout','!=', 'inside' ],
                ['vrtlPst', '!=', 'middle'],
            ],

        ];
        $this->controls['arrowHeight'] = [
			'tab'         => 'content',
			'group'       => 'nav_arrows',
			'label'       => esc_html__( 'Height', 'wpv-bu' ),
			'type'        => 'number',
			'units'       => true,
			'css'         => [
				[
					'property' => 'height',
					'selector' => '.bultr-swiper-button',
				],
			],
			'placeholder' => 50,
			'required'    => [ 'arrowShow', '!=', '' ],
		];
		$this->controls['arrowWidth'] = [
			'tab'         => 'content',
			'group'       => 'nav_arrows',
			'label'       => esc_html__( 'Width', 'wpv-bu' ),
			'type'        => 'number',
			'units'       => true,
			'css'         => [
				[
					'property' => 'width',
					'selector' => '.bultr-swiper-button',
				],
			],
			'placeholder' => 50,
			'required'    => [ 'arrowShow', '!=', '' ],
		];
        $this->controls['arrowGap'] = [
			'tab'         => 'content',
			'group'       => 'nav_arrows',
			'label'       => esc_html__( 'Gap', 'wpv-bu' ),
			'type'        => 'number',
			'units'       => true,
			'css'         => [
				[
					'property' => 'gap',
					'selector' => '.bultr-navigation-wrap',
				],
			],
			'placeholder' => 0,
			'required'    => [[ 'arrowShow', '!=', '' ],['hrztPst', '=', ['left', 'right']]],
		];
        $this->controls['arrowColor']=[
            'tab' => 'content',
            'group' => 'nav_arrows',
            'label' => esc_html__('Color','wpv-bu'),
            'type' => 'color',
            'css' =>[
                [
                    'property' => 'color',
                    'selector' => '.bultr-swiper-button i',
                ],
            ],             
              'required' => [ 'arrowShow', '!=', '' ],

        ];
		$this->controls['arrowBackground'] = [
			'tab'      => 'content',
			'group'    => 'nav_arrows',
			'label'    => esc_html__( 'Background', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-swiper-button',
				],
			],
			'required' => [ 'arrowShow', '!=', '' ],
		];
		$this->controls['arrowBorder'] = [
			'tab'      => 'content',
			'group'    => 'nav_arrows',
			'label'    => esc_html__( 'Border', 'wpv-bu' ),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.bultr-swiper-button',
				],
			],
			'required' => [ 'arrowShow', '!=', '' ],
		];
        $this->controls['arrowBoxShd'] = [
			'tab'      => 'content',
			'group'    => 'nav_arrows',
			'label'    => esc_html__( 'Box Shadow', 'wpv-bu' ),
			'type'     => 'box-shadow',
			'css'      => [
				[
					'property' => 'box-shadow',
					'selector' => '.bultr-swiper-button',
				],
			],
			'required' => [ 'arrowShow', '!=', '' ],
		];
		$this->controls['arrowTypography'] = [
			'tab'      => 'content',
			'group'    => 'nav_arrows',
			'label'    => esc_html__( 'Typography', 'wpv-bu' ),
			'type'     => 'typography',
			'css'      => [
				[
					'property' => 'font',
					'selector' => '.bultr-swiper-button',
				],
			],
			'exclude'  => [
                'color',
				'font-family',
				'font-weight',
				'font-style',
				'text-align',
				'letter-spacing',
				'line-height',
				'text-transform',
                'text-decoration',
                'font-variation-settings',
			],
			'required' => [ 'arrowShow', '!=', '' ],
		];
        // pagination dots
        $this->nav_dots_controls();

    }
    public function nav_dots_controls(){
        $this->controls['dots'] = [
			'tab'      => 'content',
			'group'    => 'nav_dots',
			'label'    => esc_html__( 'Show dots', 'wpv-bu' ),
			'type'     => 'checkbox',
			'inline'   => true,
			'rerender' => true,
		];
        $this->controls['dotsType']=[
            'tab'      => 'content',
			'group'    => 'nav_dots',
			'label'    => esc_html__( 'Types of Pagination', 'wpv-bu' ),
            'type'     => 'select',
            'options'   => [
                'bullets' => __("Bullets",'wpv-bu'),
                'fraction' => __('Fraction', 'wpv-bu'),
            ],
            'clearable' => false,
            'default' => __('bullets','wpv-bu'),
			'required' => [ 'dots', '!=', '' ],
            'inline'     => true,

        ];

		$this->controls['dotsDynamic'] = [
			'tab'      => 'content',
			'group'    => 'nav_dots',
			'label'    => esc_html__( 'Dynamic dots', 'wpv-bu' ),
			'type'     => 'checkbox',
			'inline'   => true,
            'required' => [
                [ 'dots', '!=', '' ],
                ['dotsType', '=', 'bullets'],
            ],		
        ];

        $this->controls['dotTypo'] =[
            'tab'      => 'content',
			'group'    => 'nav_dots',
			'label'    => esc_html__( 'Typograpghy', 'wpv-bu' ),
			'type'     => 'typography',
            'css'      => [
                [
                    'property' => 'font',
                    'selector' => '.swiper-pagination-fraction',
                ],
            ],
            'exclude' => [
                'text-align',
                'text-transform',
                'line-height',
                'text-decoration',
                

            ],
			'required' => [
                [ 'dots', '!=', '' ],
                ['dotsType', '=', 'fraction'],
            ],
        ];
        $this->controls['dotsColor'] = [
			'tab'      => 'content',
			'group'    => 'nav_dots',
			'label'    => esc_html__( 'Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.swiper-pagination-bullet',
				],
				[
					'property' => 'color',
					'selector' => '.swiper-pagination-bullet',
				],
				[
					'property' => 'color',
					'selector' => '.swiper-pagination-fraction .swiper-pagination-current',
				],
			],
			'required' => [ 'dots', '!=', '' ],
		];

		$this->controls['dotsActiveColor'] = [
			'tab'      => 'content',
			'group'    => 'nav_dots',
			'label'    => esc_html__( 'Active color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.swiper-pagination-bullet-active',
				],
				[
					'property' => 'color',
					'selector' => '.swiper-pagination-bullet-active',
				],
				[
					'property' => 'color',
					'selector' => '.swiper-pagination-fraction .swiper-pagination-total',
				],
			],
			'required' => [ 'dots', '!=', '' ],
		];
        $this->controls['dotsBg'] = [
			'tab'      => 'content',
			'group'    => 'nav_dots',
			'label'    => esc_html__( 'Background', 'wpv-bu' ),
			'type'     => 'background',
			'css'      => [
				
                [
					'property' => 'border',
					'selector' => '.swiper-pagination-fraction',
				],
			],
            'required' => [
                [ 'dots', '!=', '' ],
                ['dotsType', '=', 'fraction'],
            ],		
        ];
        $this->controls['dotsBorder'] = [
			'tab'      => 'content',
			'group'    => 'nav_dots',
			'label'    => esc_html__( 'Border', 'wpv-bu' ),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.swiper-pagination-bullet',
				],
                [
					'property' => 'border',
					'selector' => '.swiper-pagination-fraction',
				],
			],
			'required' => [ 'dots', '!=', '' ],
		];
        $this->controls['dotsBoxShd'] = [
			'tab'      => 'content',
			'group'    => 'nav_dots',
			'label'    => esc_html__( 'Box Shadow', 'wpv-bu' ),
			'type'     => 'box-shadow',
			'css'      => [
				
                [
					'property' => 'border',
					'selector' => '.swiper-pagination-fraction',
				],
			],
			'required' => [
                [ 'dots', '!=', '' ],
                ['dotsType', '=', 'fraction'],
            ],
		];
		$this->controls['dotsHeight'] = [
			'tab'      => 'content',
			'group'    => 'nav_dots',
			'label'    => esc_html__( 'Height', 'wpv-bu' ),
			'type'     => 'number',
			'units'    => true,
			'units'    => [
				'px' => [
					'min' => 1,
					'max' => 100,
				],
			],
			'css'      => [
				[
					'property' => 'height',
					'selector' => '.swiper-pagination-bullet',
				],
                
			],
            'required' => [
                [ 'dots', '!=', '' ],
                ['dotsType', '=', 'bullets'],
            ],
		];

		$this->controls['dotsWidth'] = [
			'tab'      => 'content',
			'group'    => 'nav_dots',
			'label'    => esc_html__( 'Width', 'wpv-bu' ),
			'type'     => 'number',
			'units'    => true,
			'units'    => [
				'px' => [
					'min' => 1,
					'max' => 100,
				],
			],
			'css'      => [
				[
					'property' => 'width',
					'selector' => '.swiper-pagination-bullet',
				],
			],
            'required' => [
                [ 'dots', '!=', '' ],
                ['dotsType', '=', 'bullets'],
            ],
		];
       
		$this->controls['dotsTop'] = [
			'tab'      => 'content',
			'group'    => 'nav_dots',
			'label'    => esc_html__( 'Top', 'wpv-bu' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'top',
					'selector' => '.bricks-swiper-container + .swiper-pagination',
				],
                
			],
			'required' => [ 'dots', '!=', '' ],
		];

		$this->controls['dotsRight'] = [
			'tab'      => 'content',
			'group'    => 'nav_dots',
			'label'    => esc_html__( 'Right', 'wpv-bu' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'right',
					'selector' => '.bricks-swiper-container + .swiper-pagination',
				],
				[
					'property' => 'left',
					'value'    => 'auto',
					'selector' => '.bricks-swiper-container + .swiper-pagination',
				],
				[
					'property' => 'transform',
					'selector' => '.bricks-swiper-container + .swiper-pagination',
					'value'    => 'translateX(0)',
				],
			],
			'required' => [ 'dots', '!=', '' ],
		];

		$this->controls['dotsBottom'] = [
			'tab'      => 'content',
			'group'    => 'nav_dots',
			'label'    => esc_html__( 'Bottom', 'wpv-bu' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'bottom',
					'selector' => '.bricks-swiper-container + .swiper-pagination',
				],
			],
			'required' => [ 'dots', '!=', '' ],
		];

		$this->controls['dotsLeft'] = [
			'tab'      => 'content',
			'group'    => 'nav_dots',
			'label'    => esc_html__( 'Left', 'wpv-bu' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'left',
					'selector' => '.bricks-swiper-container + .swiper-pagination',
				],
				[
					'property' => 'transform',
					'selector' => '.bricks-swiper-container + .swiper-pagination',
					'value'    => 'translateX(0)',
				],
			],
			'required' => [ 'dots', '!=', '' ],
		];
		$this->controls['dotsSpacing'] = [
			'tab'      => 'content',
			'group'    => 'nav_dots',
			'label'    => esc_html__( 'Margin', 'wpv-bu' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'margin',
					'selector' => '.swiper-pagination-bullet',
				],
			],
            'required' => [
                [ 'dots', '!=', '' ],
                ['dotsType', '=', 'bullets'],
            ],	
            'default' => [
                'top' => '5px',
                'right' => '5px',
                'bottom' => 0,
                'left' => '5px',
            ],
        ];
    }


    public function render() {

        $settings = $this->settings;
        $wrapid = "brex-" . $this->id;
        
        $id = $this->id;
        $idclass = "brxe-" . $id;
       //if woocommerce plugin is not active

        // Product query
        $product_args = $this->get_product_query();

        $query = new WC_Product_Query($product_args);
        $products = $query->get_products();
        $root_classes = ['bultr-woo-wrapper', $idclass];
        $product_classes = ['bultr-products'];
        $layout = isset($settings['layout']) ? $settings['layout'] : 'grid';



        if ($layout == 'grid') {
            $product_classes[] = 'bultr-layout-grid';
            $root_data = 'grid';
        }  else{
            $product_classes[] = 'bultr-layout-slider';
            $root_data = "slider";
            $swiper_slider_options = $this->get_slider_options($idclass);
            $this->set_attribute( 'product_attributes', 'data-script-args', wp_json_encode( $swiper_slider_options ) );
        }

        if(isset($settings['arrowLayout'])){
            $product_classes[] = 'bultr-arrow-'.$settings['arrowLayout']; 
            if($settings['arrowLayout'] === 'inside'){
                if(isset($settings['vrtlPstIn']) ){
                    $product_classes[] = 'bultr-vpst-'.$settings['vrtlPstIn']; 
                }
            }
            else{
                if(isset($settings['vrtlPstOut']) ){
                    $product_classes[] = 'bultr-vpst-'.$settings['vrtlPstOut']; 
                }
            }
        }
        if(isset($settings['hrztPst'])){
            $product_classes[] = 'bultr-hpst-'.$settings['hrztPst']; 
        }
    
        if (!empty($settings['columns'])) {
            $product_classes[] = 'bultr-columns-' . $settings['columns'];
        }
        if(isset($settings['productlayout'])&& $settings['productlayout'] === 'split'){
            if (isset($settings['showHoverButton'])) {
                $product_classes[] = 'bultr-hover-button'; 
            }
        }   

        if(isset($settings['productlayout'])){
                $product_classes[] = 'bultr-'.$settings['productlayout']; 
                $product_classes[] = 'bultr-'.$settings['productlayout'].'-'.$settings['productLayoutPresets'];
        }
        if(isset($settings['productSplitLayout'])){
            $product_classes[] = 'bultr-split-'.$settings['productSplitLayout']; 
        }
       
        if(isset($settings['showmediaButton'])){
            if(isset($settings['productLayoutPresets']) && $settings['productLayoutPresets'] === 'preset1' ){
                $button_layout = $settings['mediaButtonLayout'] ?? 'vertical'; 
                $product_classes[] = 'bultr-media-btn-layout-'.$button_layout;
              
            }
            else{
            $button_layout = $settings['mediaButtonLayout'] ?? 'horizontal'; 
            $product_classes[] = 'bultr-media-btn-layout-'.$button_layout;

            }
            $icon_position = $settings['mediaButtonIconPst'] ?? 'right';

            if ( $icon_position === 'right' ) {
                $product_classes[] = 'bultr-media-icon-right';
                
            } else {
                $product_classes[] = 'bultr-media-icon-left';
            }
        }
    
      
            
        if(isset($settings['showcontentButton'])){
            $button_layout = $settings['contentButtonLayout'] ?? 'horizontal';
            $product_classes[] = 'bultr-content-btn-layout-'.$button_layout;
               if($settings['productSplitLayout'] === 'column'|| $settings['productSplitLayout'] === 'column-reverse'){
                    $data = $settings['contentButtonsPosition'] ?? 'column';
                }
                if($settings['productSplitLayout'] === 'row'|| $settings['productSplitLayout'] === 'row-reverse'){
                    $data = $settings['contentButtonsPosition'] ?? 'row';
                }
       
             $product_classes[] = 'bultr-btn-'.$data;
            $icon_position = $settings['contentButtonIconPst'] ?? 'right';

            if ( $icon_position === 'right' ) {
                $product_classes[]= 'bultr-content-icon-right';
                
            } else {
                $product_classes[] = 'bultr-content-icon-left';
            }
        }
        if(isset($settings['presetImageOverlay']) && $settings['presetImageOverlay'] === 'always'){
            $product_classes[] = 'bultr-split-overlay';
        }

        if(isset($settings['presetImageOverlay']) && $settings['presetImageOverlay'] === 'on_hover'){
            $product_classes[] = 'bultr-split-overlay';
            $product_classes[] = 'bultr-split-overlay-hover';
        }
        if(isset($settings['productlayout'])&& $settings['productlayout'] === 'cover'){
       
            if(!empty($settings['preset2ContentAlignmentHori'])){
                $product_classes[] = 'bultr-preset2-content-'.$settings['preset2ContentAlignmentHori'];
            }
        }
        if(isset($settings['productlayout'])&& $settings['productlayout'] === 'split'){
       
            if(!empty($settings['preset1ContentAlignmentHori'])){
                $product_classes[] = 'bultr-preset1-content-'.$settings['preset1ContentAlignmentHori'];
            }
        }   

        $this->set_attribute('_root', 'class', $root_classes);
        $this->set_attribute('_root', 'data-layout', $root_data);
        $this->set_attribute('product_attributes', 'class', $product_classes);
    
        // HTML start
        $output = "";
        $output .= "<div {$this->render_attributes('_root')}>"; // Wrapper
    
        if (!empty($products)) {
            $output .= "<div {$this->render_attributes('product_attributes')}>"; // Container (slider or grid)
            
            //slider
            if ( $layout === 'slider' ) {
                $output .=  "<div class='swiper-wrapper'>"; //slider wrapper
            }

                foreach ($products as $index => $product) {
                    $this->flag = 0;
                    setup_postdata($product->get_id());
                    $product_card = ['bultr-product-card'];
        
                    if (isset($settings['cardBgType'])) {
                        $product_card[] = 'bultr-contentbg-' . $settings['cardBgType'];
                    }
        
                    if (!empty($settings['direction'])) {
                        if ($settings['direction'] === 'column' || $settings['direction'] === 'column-reverse') {
                            $product_card[] = 'bultr-direction-column';
                        } else {
                            $product_card[] = 'bultr-direction-' . $settings['direction'];
                        }
                    }
               
                    $this->set_attribute("product_{$index}", 'class', $product_card);

                
                  
                    // slider slide class

                    if($layout === 'slider'){
                        $this->set_attribute("product_{$index}", 'class','swiper-slide'); //slider -slide class

                    }
                    $product_id = $product->get_id();
                    $product_name = $product->get_name();
                    $product_on_sale = $product->is_on_sale();
                    $product_in_stock = $product->is_in_stock();
                    $product_price = $product->get_price_html();
                    $product_featured = $product->get_featured();
                    $product_rating = $product->get_average_rating();
                    $product_url = $product->get_permalink();
                    $product_parent_id = $product->get_parent_id();
                    $product_category = $product->get_category_ids();
                    $product_sku = $product->get_sku();
                    $category_names = array();
        
                    foreach ($product_category as $category_id) {
                        $category_names[] = get_term_by('id', $category_id, 'product_cat')->name;
                    }
        
                    $cat_name = implode(', ', $category_names);
                
                    $output .= "<div {$this->render_attributes("product_{$index}")}>";

                        if(isset($settings['productlayout'])&& $settings['productlayout'] === 'split'){
                            if(isset($settings['productLayoutPresets']) && $settings['productLayoutPresets'] === 'preset1' ){
                                $output.= "{$this->render_preset1($settings,$product,$index,$product_url)}";                      
                                }
                            if(isset($settings['productLayoutPresets']) && $settings['productLayoutPresets'] === 'preset2' ){
                                $output.= "{$this->render_preset2($settings,$product,$index,$product_url)}";                    
                                }
                        }
                    
                        if(isset($settings['productlayout'])&& $settings['productlayout'] === 'cover'){
                            if(isset($settings['productLayoutPresets']) && $settings['productLayoutPresets'] === 'preset1' ){
                                    $output.= "{$this->render_cover_preset1($settings,$product,$index,$product_url)}";            
                                }
                            if(isset($settings['productLayoutPresets']) && $settings['productLayoutPresets'] === 'preset2' ){
                                $output.= "{$this->render_cover_preset2($settings,$product,$index,$product_url)}";            
                                }     
                                
                        }
                        $output .= "</div>"; 
                    $output .= "</div>"; // Product card div closing swiper-slide
                }
            if($layout === 'slider' ){
                $output .= "</div>";//slider wrapper
                
            }
            if($layout === 'slider'){
                
                if(isset($settings['arrowShow']) === true && $settings['arrowShow']=== true){
                    if(isset($settings['hrztPst']) && $settings['hrztPst'] !== 'center'){
                        $output .= "<div class = 'bultr-navigation-wrap'>";//nav-wrap 
                        $output .= $this->render_arrows($settings); //nav arrows with wrapper
                        $output .= "</div>";   //nav-wrap close       
         

                    }  
                    else{
                        $output .= $this->render_arrows($settings); //nav arrows without wrapper
                    } 
                }  
            }
            $output .= "</div>"; 
            
    

        } else {
            $output .= "<div class='bultr-no-product'>";
            $output .= "<i class='ti-package' title='ti-package'></i>";
            $output .= "<span>" . __('No products were found matching your selection.', 'wpv-bu') . "</span>";
            $output .= "</div>";
        }
        if($layout === 'slider'){
            if(isset($settings['dots'])=== true && $settings['dots'] === true){
                $output .= "<div class = 'pagination swiper-pagination'>";
                $output .= "</div>";//pagination
            }
        }
        
        $output .= "</div>"; // Wrapper div closing
        
        echo $output;
    }
    

    public function render_preset1($settings,$product,$index,$product_url){ //preset1 for split layout
  
        $product_name = $product->get_name();
        $product_price = $product->get_price_html();
        $product_url = $product->get_permalink();
        $product_image = $product->get_image();
        $content_class = ['bultr-content'];

        $hide_badges = isset($settings['hideSaleBadges']) ? $settings['hideSaleBadges'] : false;
        $hide_image = isset($settings['hideImage']) ? $settings['hideImage'] : false;
        $hide_title = isset($settings['hideTitle']) ? $settings['hideTitle'] : false;
        $hide_rating = isset($settings['hideRating']) ? $settings['hideRating'] : false;
        $hide_price = isset($settings['hidePrice']) ? $settings['hidePrice'] : false;
        $hide_description = isset($settings['hideDescription']) ? $settings['hideDescription'] : false;
        $output = '';
        $this->set_attribute("wrapper-$index", 'class', $content_class);
       
        $output .= "<div {$this->render_attributes( "wrapper-$index" )}>";

        if(empty($hide_image)){
            $output .= "<div class = 'bultr-image bultr-media-button'>";//image
            $this->set_attribute("mLayout-$index",'class', 'bultr-woo-media-buttons');
           
            if(isset($settings['showmediaButton'])){
               
                $output .= "<div {$this->render_attributes("mLayout-$index") }>";
               
                $output .= $this->render_buttons_html($settings,$product,$index,$product_url,'media');
                $output .= "</div>";
                }
            $output .= $product_image;

            if(empty($hide_badges) ){
                $output .= $this->render_badge($settings, $index, $product);
             }
           
             $output .= "</div>";
            
        }
        $this->set_attribute("content-$index", 'class', 'bultr-woo-content');
       
        $output .= "<div {$this->render_attributes( "content-$index" )}>";
        $output .="<div class = 'bultr-woo-content-inner'>";
       

        if(empty($hide_title)){           
            $this->set_attribute( "title-$index", 'class', 'bultr-title');
            $output .= "<span class = 'bultr-title' > <a href=".$product_url .">".__($product_name,'wpv-bu'). "</a></span>";// product title

        }
        
        if(empty($hide_rating)){
            $product_rating = $product->get_average_rating($product->get_id());
            $output .= $this->render_star_rating($product_rating, $index);//product rating
            
        }

        if(empty($hide_price)){
            $output .= "<span class = 'bultr-price'>".$product_price."</span>";//price
        }

        if(empty($hide_description)){
            $product_description = $product->get_description();
            $product_expert = $product->get_short_description();
    
            if(empty($product_expert)){
                $descpt = $product_description;
            }
            else{
                $descpt = $product_expert;
            }
            if(!empty($settings['wordLimit'])){
                $output .= "<div class = 'bultr-description'>".wp_trim_words( wc_format_content($descpt), $settings['wordLimit']) ."</div>";

            }
            else{
                $output .= "<div class = 'bultr-description'>".wc_format_content($descpt) ."</div>";

            }
        }
        $output .= "</div>";//title inner
        $output .= "<div class= 'bultr-woo-buttons'>";

        $this->set_attribute("cLayout-$index",'class', 'bultr-woo-content-buttons');
           
        if(isset($settings['showcontentButton'])){
            $output .= "<div {$this->render_attributes("cLayout-$index") }>";
          
            $output .= $this->render_buttons_html($settings,$product,$index,$product_url,'content');
            if($this->flag != 1){
                $output .= $this->render_modal_box($product,$index);
                $this->flag++;
            }
                else{
                    $output .= $this->render_modal_box($product,$index);
                }   
            $output .= "</div>";
          
        }
        $output .= "</div>";//content inner
        $output .= "</div>";//content
       
        return $output;
    }

    public function render_preset2($settings,$product,$index,$product_url){ //preset2 for split layout
        $product_name = $product->get_name();
        $product_price = $product->get_price_html();
        $product_url = $product->get_permalink();
        $product_image = $product->get_image();
        $content_class = ['bultr-content'];

        $hide_badges = isset($settings['hideSaleBadges']) ? $settings['hideSaleBadges'] : false;
        $hide_image = isset($settings['hideImage']) ? $settings['hideImage'] : false;
        $hide_price = isset($settings['hidePrice']) ? $settings['hidePrice'] : false;
        $hide_title = isset($settings['hideTitle']) ? $settings['hideTitle'] : false;
        $hide_rating = isset($settings['hideRating']) ? $settings['hideRating'] : false;
        $hide_description = isset($settings['hideDescription']) ? $settings['hideDescription'] : false;
       
        $output = '';
        $this->set_attribute("wrapper-$index", 'class', $content_class);
       
        $output .= "<div {$this->render_attributes( "wrapper-$index" )}>";
         if(empty($hide_image)){
            $output .= "<div class = 'bultr-image bultr-media-button'>";//image
            $this->set_attribute("mLayout-$index",'class', 'bultr-woo-media-buttons');
           
           
            if(isset($settings['showmediaButton'])){
              
                $output .= "<div {$this->render_attributes("mLayout-$index") }>";
               
                $output .= $this->render_buttons_html($settings,$product,$index,$product_url,'media');
                $output .= "</div>";
                }
            $output .= $product_image." </div>";
            if(empty($hide_badges) ){
                $output .= $this->render_badge($settings, $index, $product);
             }
        }

        $this->set_attribute("content-$index", 'class', 'bultr-woo-content');
       
        $output .= "<div {$this->render_attributes( "content-$index" )}>";
        $output .="<div class = 'bultr-woo-content-outer'>";

            $output .="<div class = 'bultr-woo-content-inner'>";
        
                if(empty( $hide_title)){
                    $this->set_attribute( "title-$index", 'class', 'bultr-title');
                    $output .= "<span class = 'bultr-title' > <a href=".$product_url .">".__($product_name,'wpv-bu'). "</a></span>";// product title
                }
                
                if(empty($hide_rating)){
                    $product_rating = $product->get_average_rating($product->get_id());
                    $output .= $this->render_star_rating($product_rating, $index);//product rating
                }

                if(empty($hide_description)){
                    $product_description = $product->get_description();
                    $product_expert = $product->get_short_description();
                    if(empty($product_expert)){
                        $descpt = $product_description;
                    }
                    else{
                        $descpt = $product_expert;
                    }
                    if(!empty($settings['wordLimit'])){
                        $output .= "<div class = 'bultr-description'>".wp_trim_words( wc_format_content($descpt), $settings['wordLimit']) ."</div>";

                    }
                    else{
                        $output .= "<div class = 'bultr-description'>".wc_format_content($descpt) ."</div>";

                    }
                }
            $output .= "</div>";//content inner

            $output .= "<div class= 'bultr-woo-price'>";

                if(empty($hide_price)){
                    $output .= "<span class = 'bultr-price'>".$product_price."</span>";//price
                }

            $output .= "</div>";//price div

        $output .= "</div>";//content outer
        
        $this->set_attribute("cLayout-$index",'class', 'bultr-woo-content-buttons');

        if(isset($settings['showcontentButton'])){
            $output .= "<div {$this->render_attributes("cLayout-$index") }>";
      
            $output .= $this->render_buttons_html($settings,$product,$index,$product_url,'content');
            if($this->flag != 1){
                $output .= $this->render_modal_box($product,$index);
                $this->flag++;
            }
            else{
                $output .= $this->render_modal_box($product,$index);
            }   
          
            $output .= "</div>";//button div
        }

        $output .= "</div>";//wrapper div
        
        return $output;
    }
    
    public function render_cover_preset1($settings,$product,$index,$product_url){
        $product_name = $product->get_name();
        $product_price = $product->get_price_html();
        $product_url = $product->get_permalink();
        $product_image = $product->get_image();
        $content_class = ['bultr-content'];
        $settings['contentHvrAnmt'] = $settings['contentHvrAnmt'] ?? 'left';

        $hide_badges = isset($settings['hideSaleBadges']) ? $settings['hideSaleBadges'] : false;
        $hide_price = isset($settings['hidePrice']) ? $settings['hidePrice'] : false;
        $hide_title = isset($settings['hideTitle']) ? $settings['hideTitle'] : false;
        $hide_rating = isset($settings['hideRating']) ? $settings['hideRating'] : false;
        $hide_description = isset($settings['hideDescription']) ? $settings['hideDescription'] : false;
       
        $output = '';
        $this->set_attribute("wrapper-$index", 'class', $content_class);

        if(!empty($settings['showContentHover'])){
          $this->set_attribute("wrapper-$index", 'class', 'bultr-hover-'.$settings['contentHvrAnmt']);
        }
        
        $output .= "<div {$this->render_attributes( "wrapper-$index" )}>";

            $output .= $product_image;//image

            if(empty($hide_badges) ){
                $output .= $this->render_badge($settings, $index, $product);
             }

            $this->set_attribute("content-$index", 'class', 'bultr-woo-content');

            if(!empty($settings['showContentHover'])){
                $this->set_attribute("content-$index", 'class', 'bultr-hover');
            }
            
        $output .= "<div {$this->render_attributes( "content-$index" )}>";
        $output .="<div class = 'bultr-woo-content-inner'>";
       

        if(empty($hide_title)){
            $this->set_attribute( "title-$index", 'class', 'bultr-title');
            $output .= "<span class = 'bultr-title' > <a href=".$product_url .">".__($product_name,'wpv-bu'). "</a></span>";// product title
        }
        
        if(empty($hide_rating)){
            $product_rating = $product->get_average_rating($product->get_id());
            $output .= $this->render_star_rating($product_rating, $index);//product rating  
        }

        if(empty( $hide_price)){
            $output .= "<span class = 'bultr-price'>".$product_price."</span>";//price
        }

        if(empty($hide_description)){
            $product_description = $product->get_description();
            $product_expert = $product->get_short_description();
            if(empty($product_expert)){
                $descpt = $product_description;
            }
            else{
                $descpt = $product_expert;
            }
            if(!empty($settings['wordLimit'])){
                $output .= "<div class = 'bultr-description'>".wp_trim_words( wc_format_content($descpt), $settings['wordLimit']) ."</div>";

            }
            else{
                $output .= "<div class = 'bultr-description'>".wc_format_content($descpt) ."</div>";

            }
        }
        $output .= "</div>";//content inner
        $this->set_attribute("cLayout-$index",'class', 'bultr-woo-content-buttons');
           
        if(isset($settings['showcontentButton'])){
            $output .= "<div {$this->render_attributes("cLayout-$index") }>";
           
            $output .= $this->render_buttons_html($settings,$product,$index,$product_url,'content');
            if($this->flag != 1){
                $output .= $this->render_modal_box($product,$index);
                $this->flag++;
            }
                else{
                    $output .= $this->render_modal_box($product,$index);
                }   
            $output .= "</div>";
          
        }

        $output .= "</div>";//content
       
        return $output;
    
    }

    public function render_cover_preset2($settings,$product,$index,$product_url){
        $product_name = $product->get_name();
        $product_price = $product->get_price_html();
        $product_url = $product->get_permalink();
        $product_image = $product->get_image();
        $content_class = ['bultr-content'];

        $hide_badges = isset($settings['hideSaleBadges']) ? $settings['hideSaleBadges'] : false;
        $hide_price = isset($settings['hidePrice']) ? $settings['hidePrice'] : false;
        $hide_title = isset($settings['hideTitle']) ? $settings['hideTitle'] : false;
        $hide_rating = isset($settings['hideRating']) ? $settings['hideRating'] : false;
        $hide_description = isset($settings['hideDescription']) ? $settings['hideDescription'] : false;
       
        $output = '';
        $this->set_attribute("wrapper-$index", 'class', $content_class);

        $output .= "<div {$this->render_attributes( "wrapper-$index" )}>";

            $output .= $product_image;//image
            if(empty($hide_badges) ){
                $output .= $this->render_badge($settings, $index, $product);
             }
            $this->set_attribute("content-$index", 'class', 'bultr-woo-content');
       
        $output .= "<div {$this->render_attributes( "content-$index" )}>";
        $output .="<div class = 'bultr-woo-content-inner'>";
       

        if(empty($hide_title)){
            $this->set_attribute( "title-$index", 'class', 'bultr-title');
            $output .= "<span class = 'bultr-title' > <a href=".$product_url .">".__($product_name,'wpv-bu'). "</a></span>";// product title
        }
        
        if(empty($hide_rating)){
            $product_rating = $product->get_average_rating($product->get_id());
            $output .= $this->render_star_rating($product_rating, $index);//product rating   
        }

        if(empty( $hide_price)){
            $output .= "<span class = 'bultr-price'>".$product_price."</span>";//price
        }

        if(empty($hide_description)){
            $product_description = $product->get_description();
            $product_expert = $product->get_short_description();
            if(empty($product_expert)){
                $descpt = $product_description;
            }
            else{
                $descpt = $product_expert;
            }
            if(!empty($settings['wordLimit'])){
                $output .= "<span class = 'bultr-description'>".wp_trim_words( wc_format_content($descpt), $settings['wordLimit']) ."</span>";

            }
            else{
                $output .= "<span class = 'bultr-description'>".wc_format_content($descpt) ."</span>";

            }
        }
       
        $output .= "</div>";//content inner

      
        $this->set_attribute("cLayout-$index",'class', 'bultr-woo-content-buttons');
           
        if(isset($settings['showcontentButton'])){
            $output .= "<div {$this->render_attributes("cLayout-$index") }>";
           
            $output .= $this->render_buttons_html($settings,$product,$index,$product_url,'content');
            if($this->flag != 1){
                $output .= $this->render_modal_box($product,$index);
                $this->flag++;
            }
                else{
                    $output .= $this->render_modal_box($product,$index);
                }   
            $output .= "</div>";
          
        }
        $output .= "</div>";//content
       
        return $output;
    
    }
    
    //popup template
    public function render_modal_box($product,$index){

        $popupClass = ['bultr-woo-modal-box' ,'mfp-hide'];

        $this->set_attribute("popup_{$index}", 'class', $popupClass);            
        $this->set_attribute("popup_{$index}", 'id', 'quickView-popup-' . $product->get_ID());            
        $output = '';
      
        $output .= "<div id='quickView-popup-".$product->get_ID()."' class = 'bultr-woo-modal-box mfp-hide' >";
        ob_start();
        require WPV_BU_PATH . '/includes/modules/woo-products/template/quickviewButton.php';
        $output .= ob_get_contents();
        ob_end_clean();
       
        $output .= "</div>";
        return $output;
       
    }

    //rating start html
    public function render_star_rating($rating,$index){
        
        $fullStars = floor($rating);
        $halfStars = ($rating - $fullStars >= 0.5) ? 1 : 0;
        $emptyStars = 5 - $fullStars - $halfStars;
        $settings = $this->settings;
        $full = '';
        $half ='';
        $empty = '';
        if(!empty($settings['filledIcon'])){
            $full = self::render_icon($settings['filledIcon']);
        }
        if(!empty($settings['halffillIcon'])){
            $half = self::render_icon($settings['halffillIcon']);
        }
        if(!empty($settings['emptyIcon'])){
            $empty = self::render_icon($settings['emptyIcon']);
        }
        $this->set_attribute("rating-{$index}", 'class', 'bultr-rating');

        $out = "";
        $out .= "<span {$this->render_attributes("rating-{$index}")}>";
            for($i = 0; $i < $fullStars; $i++){
                $out.= "<span class='bultr-star checked'>".$full."</span>";
            }
            if($halfStars === 1){
                $out .= "<span class='bultr-star half checked'>".$half."</span>";
            }
            for($i = 0; $i < $emptyStars; $i++){
                $out .= "<span class='bultr-star'>".$empty."</span>";
            }
            
        $out .= "</span>";//rating
        return $out;
    }

    //button html
    public function render_buttons_html($settings,$product,$index,$product_url,$type){

        $product_url = $product->get_permalink();
       
        $output = '';
                    
        $items = $this->settings[$type.'ButtonsRepeater'];
        $addToCartUrl = $product->add_to_cart_url();
        $product_url = $product->get_permalink();
       
        $product_id = $product->get_id();
               //check if product is variable and group then add to cart url will be different
                if ($product->is_type('variable') || $product->is_type('grouped')) {
                    $addToCartUrl = $product_url;
                } elseif ($product->is_type('simple')) {
                    $addToCartUrl = $product->add_to_cart_url();
                }

          foreach ( $items as $item ) {
            if($item['action'] === 'add_to_cart'){
                         $this->set_attribute("cart-$type-$index",'class', 'bultr-woo-'.$type.'-icon');
                        $this->set_attribute("cart-$type-$index",'href', $addToCartUrl);
                       
                        $output .= "<a {$this->render_attributes("cart-$type-$index")}>";
                        if(!empty($item['title'])){
                            $output .=   $item['title']  ;
                        }
                        else{
                            $output .=  '';
                        }
                        if(!empty($item['icon'])){
                            $output .=  self::render_icon( $item['icon']);
                        }
                        else{
                            $output .=  '';
                        }
                        $output .= "</a>";
            }
           
            if($item['action'] === 'buy_now'){
            
                if ($product->is_type('external') || $product->is_type('grouped') || $product->is_type('variable')) {
                    continue; // Skip rendering the "buy now" button 
                }
    
                $this->set_attribute("buy-$type-$index", 'class', 'bultr-woo-'.$type.'-icon');
                $this->set_attribute("buy-$type-$index", 'class', 'bultr-woo-buy-now');
              
                $this->set_attribute("buy-$type-$index", 'data-product-id', $product_id);
                $this->set_attribute("buy-$type-$index", 'data-quantity', 1);

                $output .= "<a {$this->render_attributes("buy-$type-$index")}>";
                        
                        if(!empty($item['title'])){
                            $output .=   $item['title']  ;
                        }
                        else{
                            $output .=  '';
                        }
                        if(!empty($item['icon'])){
                            $output .=  self::render_icon( $item['icon']);
                        }
                        else{
                            $output .=  '';
                        }
                        $output .= "</a>";      
            }

            if($item['action'] === 'link'){
                        $this->set_attribute("link-$type-$index",'class', 'bultr-woo-'.$type.'-icon');
                        $this->set_attribute("link-$type-$index",'href', $product_url);
                       
                        $output .= "<a {$this->render_attributes("link-$type-$index")}>";
                        if(!empty($item['title'])){
                            $output .=   $item['title']  ;
                        }
                        else{
                            $output .=  '';
                        }
                        if(!empty($item['icon'])){
                            $output .=  self::render_icon( $item['icon']);
                        }
                        else{
                            $output .=  '';
                        }
                        $output .= "</a>";
            }

            if($item['action'] === 'quick_view'){
                $styles = [
                                'boxwidth' => !empty($settings['qvboxWidth']) ? $settings['qvboxWidth'] : "65%",
                            ];
                            $this->set_attribute("quickBtn-$type-$index",'class', 'bultr-woo-'.$type.'-icon');
                            $this->set_attribute("quickBtn-$type-$index", 'class', 'open-popup-link');   
                            $this->set_attribute("quickBtn-$type-$index", 'class', 'bultr-woo-quickBtn');         
                            $this->set_attribute("quickBtn-$type-$index", 'data-qvID', $product->get_ID());            
                            $this->set_attribute("quickBtn-$type-$index", 'data-box_styles', json_encode($styles)); 
                            
                            $this->set_attribute("quickBtn-$type-$index", 'href', '#quickView-popup-'. $product->get_ID());            
                            
                
                        $output .= "<a {$this->render_attributes("quickBtn-$type-$index")}>";
                        if(!empty($item['title'])){
                            $output .=   $item['title']  ;
                        }
                        else{
                            $output .=  '';
                        }
                        if(!empty($item['icon'])){
                            $output .=  self::render_icon( $item['icon']);
                        }
                        else{
                            $output .=  '';
                        }
                        $output .= "</a>";                       
            }
            

          }
          return $output;
    }


    //sales  badge html
        public function render_badge($settings, $index, $product){
            $product_on_sale = $product->is_on_sale();
            $product_in_stock = $product->is_in_stock();
            add_shortcode('discount', [$this, 'get_sale_percentage']);
            add_shortcode('price_off', [$this, 'get_sale_off']);//add shortcode
            $hide_badges = isset($settings['hideSaleBadges']) ? $settings['hideSaleBadges'] : false;

            $output = '';
            if(empty($hide_badges)){
                $this->set_attribute("badge_{$index}", 'class', 'bultr-woo-sales-tag');
                if(!empty($settings['badgeStyles'])){
                    $this->set_attribute("badge_{$index}", 'class', 'bultr-'.$settings['badgeStyles']);
                }
                if(!empty($settings['badgePosition'])){
                    $this->set_attribute("badge_{$index}", 'class', 'bultr-'.$settings['badgePosition']);
                }
                if($product_on_sale === true  && $product_in_stock === true){
                    $output .= "<div {$this->render_attributes("badge_{$index}")}> ";
                    if(!empty($settings['salesText'])){
                        $saleText = $settings['salesText'];
                        $saleText = str_replace('{{', '[', $saleText);
                        $saleText =  str_replace('}}', ']', $saleText); 
                        $output .= "<div class = 'bultr-sales'> ";
                        $output .= do_shortcode($saleText);
                        $output .=  " </div>";

                    }
                    $output .= "</div>";
                }
                else{
                    if(!isset($settings['woo_excludeOutStock'])){
                        if(!isset($settings['disableStockBadge'])){
                            if($product_in_stock === false){
                                $output .= "<div {$this->render_attributes("badge_{$index}")}> ";
                                if(!empty($settings['stockText'])){
                                    $output .= "<div class = 'bultr-stock-out'>  ".$settings['stockText']."</div>";
                                }
                                $output .= "</div>";
                            }
                        }
                    }   
                }    
            }
            return $output;
        }
        public function get_sale_percentage(){
            global $product;
            if($product->is_on_sale() && $product->is_in_stock()){
                $percentage = '';
                if($product->get_type() === 'variable'){
                    $variationPrice = $product->get_variation_prices();
                    
                    $max_percentage = 0;
                    foreach ( $variationPrice['regular_price'] as $key  => $regularPrice ){
                        $salePrice =  $variationPrice['sale_price'][$key];
                        if ( $salePrice < $regularPrice){
                            $percentage = round((($regularPrice - $salePrice) / $regularPrice) * 100);
                        }
                        if($percentage > $max_percentage){
                            $max_percentage = $percentage;
                        }
                        else{
                            $percentage = $max_percentage;
                        }
                    }
                    
                }
                elseif( $product->get_type() == 'simple' || $product->get_type() == 'external'){
                    $percentage = round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100);

                }
            }
            return $percentage;
        }
        public function get_sale_off(){
            global $product;
            if($product->is_on_sale() && $product->is_in_stock()){
                $difference = '';
                $currencySymbol = get_woocommerce_currency_symbol();
                if($product->get_type() === 'variable'){
                    $variationPrice = $product->get_variation_prices();
                    
                    $max_percentage = 0;
                    foreach ( $variationPrice['regular_price'] as $key  => $regularPrice ){
                        $salePrice =  $variationPrice['sale_price'][$key];
                        if ( $salePrice < $regularPrice){
                            $difference = round($regularPrice - $salePrice);
                        }
                        if($difference > $max_percentage){
                            $max_percentage = $difference;
                        }
                        else{
                            $difference = $max_percentage;
                        }
                    }
                    
                }
                elseif( $product->get_type() == 'simple' || $product->get_type() == 'external'){
                    $difference = round($product->get_regular_price() - $product->get_sale_price());

                }
            }
            return $currencySymbol . $difference;
        }

   
    // slider arrows
    public function render_arrows($settings){
        $output = "";
        if(!empty($settings['prevArrow'])){
            $prev_arrow = self::render_icon($settings['prevArrow']);
            $output .= "<div class = 'bultr-swiper-button previous bricks-swiper-button-prev'>".$prev_arrow."</div>";
        }
        if(!empty($settings['nextArrow'])){
            $next_arrow = self::render_icon($settings['nextArrow']);
            $output .= "<div class = 'bultr-swiper-button next bricks-swiper-button-next '>".$next_arrow."</div>";
        }
        return $output;
    }

    public function get_slider_options($idclass){
        $settings = $this->settings;
        $effect = isset( $settings['effect'] ) ? $settings['effect'] : 'slide';
        $options =[
            'effect'            => $effect,
            'sliderPerView'     => isset($settings['slidesToShow']) ? $settings['slidesToShow'] : 1,
            'slidesPerGroup'    => isset($settings['slidesToScroll']) ? intval($settings['slidesToScroll']): 1,
        
            'effect'            => $effect,
            'speed'             => isset( $settings['speed'] ) ? intval( $settings['speed'] ) : 300,
            'spaceBetween'      => isset( $settings['gutter'] ) ? intval( $settings['gutter'] ) : 20,
            'loop'              => isset( $settings['infinite'] ),
            'centeredSlides'    => isset( $settings['centerMode'] ),
            'autoheight'        => isset($settings['adativeHeight']),
            'grabCursor'        => isset($settings['cursor']),
        ];

        //effects fade, coverflow , flip ,cube effect parameters
        switch ($effect){
            case "coverflow" :
                $coverflowEffect = [
                    'slideshadow'   => isset($settings['slideShd']) ,
                ];
                $options['coverflowEffect'] = $coverflowEffect;
                break;
            case "cube" : 
                $cubeEffect = [
                    'shadow'        => isset($settings['cubeshadow']),
                    'shadowOffset'  => isset($settings['cubeShdOffset']) ? intval($settings['cubeShdOffset']) : 20,
                    'shadowScale'   => isset($settings['cubeShdScale']) ? intval($settings['cubeShdScale']) : 0.94,
                    'slideshadow'   => isset($settings['slideShd']) ,
                ];
                $options['cubeEffect'] = $cubeEffect;
            
        }
        // breakpoints setting for effect slide and coverflow
        $singleSlideEffects = ['flip', 'fade', 'cube'];
        if(in_array($effect, $singleSlideEffects)){
            $options['sliderPerView'] = 1;
            $options['slidesPerGroup'] = 1;
        }else{
            $breakpoint_options = $this->swiper_breakpoints_options( $settings);
            $options['breakpoints'] = $breakpoint_options;
        }

        //autoplay options
        if(isset($settings['autoplay']) && $settings['autoplay']=== true ){
            $autoplay = [
                'delay' => isset( $settings['autoplaySpeed'] ) ? intval( $settings['autoplaySpeed'] ) : 3000,
                'disableOnInteraction' => !isset( $settings['disableInteraction'] ),
                'pauseOnMouseEnter'    => isset( $settings['pauseOnHover'] ),
                'stopOnLastSlide'      => isset( $settings['stopOnLastSlide'] ),
            ];
            $options['autoplay'] = $autoplay;
        }
        //pagination options
        if(isset($settings['dots']) && $settings['dots']=== true){
            $pagination = [
                'el'  => '.'.$idclass.'.bultr-woo-wrapper .pagination.swiper-pagination',
                'type' => isset($settings['dotsType']) ? $settings['dotsType'] : '',
                'clickable' => true,
                'dynamicBullets' => isset($settings['dotsDynamic']),

            ];
            $options['pagination'] = $pagination;
        }
        //arrows options
        if(isset($settings['arrowShow']) && $settings['arrowShow'] === true){
            $navigation = [
                'nextEl' => ".".$idclass . " " . ".bricks-swiper-button-next",
                'prevEl' => ".".$idclass . " " . ".bricks-swiper-button-prev",
            ];
            $options['navigation'] = $navigation;
        }
        return $options;
    }

    public function swiper_breakpoints_options( $settings ) {

        $breakpoint_option = [];
        $breakpoints_data = Breakpoints::get_breakpoints();
        $length = count($breakpoints_data);
        foreach($breakpoints_data as $key => $value){      
            if($key === $length-1){
                $smallestDevice = $value['key'];
            }
        }
    
        $breakpoints_len  = count( $breakpoints_data );
        $defaultPerPage   = isset($settings['slidesToShow']) ? (int)$settings['slidesToShow'] : 3;
        $defaultPerGroup  = isset($settings['slidesToScroll']) ? (int)$settings['slidesToScroll'] : 1;
        $defaultGap       = 10;
        $baseDevice       = Plugin::$buBaseDevice;
    
        if($baseDevice === 'desktop'){
            $defaultPerPage   = isset($settings['slidesToShow']) ? (int) $settings['slidesToShow'] : 3;
            $defaultPerGroup  = isset($settings['slidesToScroll']) ? (int) $settings['slidesToScroll'] : 1;
            $defaultGap       = isset($settings['gutter']) ? $settings['gutter'] : 10;
        }
        else{
            $defaultPerPage   = isset($settings['slidesToShow:'.$baseDevice]) ? (int)$settings['slidesToShow:' .$baseDevice] : $defaultPerPage;
            $defaultPerGroup  = isset($settings['slidesToScroll:'.$baseDevice]) ? (int)$settings['slidesToScroll:'.$baseDevice] : $defaultPerGroup;
            $defaultGap       = isset($settings['gutter:'.$baseDevice]) ? $settings['gutter:'.$baseDevice] :  $defaultGap;
        }
    
        for($i = 0; $i < $breakpoints_len; $i++){

            
            if($breakpoints_data[$i]['key'] === 'desktop')
            {  
                $breakpoint_option['breakpoints'][$breakpoints_data[$i]['width']] = 
                [
                    'slidesPerView'     => isset($settings['slidesToShow']) ? (int)$settings['slidesToShow'] : $defaultPerPage,
                    'slidesPerGroup'    => isset($settings['slidesToScroll']) ? (int)$settings['slidesToScroll'] : $defaultPerGroup,
                    'spaceBetween'      => isset($settings['gutter']) ? (int)$settings['gutter'] :  $defaultGap,
                    'deviceLabel'       => $breakpoints_data[ $i ]['key'],

                ];
            }
            else{
                if($breakpoints_data[$i]['key'] !=  $smallestDevice){
                    $breakpoint_option['breakpoints'][$breakpoints_data[$i]['width']] = 
                    [
                        'slidesPerView' => isset($settings['slidesToShow:'. $breakpoints_data[ $i ]['key']] ) ? (int) $settings['slidesToShow:'. $breakpoints_data[ $i ]['key']]  : $defaultPerPage,
                        'slidesPerGroup' => isset($settings['slidesToScroll:'. $breakpoints_data[ $i ]['key']] ) ? (int) $settings['slidesToScroll:'. $breakpoints_data[ $i ]['key']]  : $defaultPerGroup,
                        'spaceBetween' => isset($settings['gutter:'. $breakpoints_data[ $i ]['key']] ) ? (int) $settings['gutter:'. $breakpoints_data[ $i ]['key']]  : $defaultGap,
                        'deviceLabel' => $breakpoints_data[ $i ]['key'],
                    ];
                }
                else{
                    $breakpoint_option['breakpoints'][$breakpoints_data[$i]['width']] = 
                    [
                        'slidesPerView' => isset($settings['slidesToShow:'. $breakpoints_data[ $i ]['key']] ) ? (int) $settings['slidesToShow:'. $breakpoints_data[ $i ]['key']]  : 1,
                        'slidesPerGroup' => isset($settings['slidesToScroll:'. $breakpoints_data[ $i ]['key']] ) ? (int) $settings['slidesToScroll:'. $breakpoints_data[ $i ]['key']]  : 1,
                        'spaceBetween' => isset($settings['gutter:'. $breakpoints_data[ $i ]['key']] ) ? (int) $settings['gutter:'. $breakpoints_data[ $i ]['key']]  : $defaultGap,
                        'deviceLabel' => $breakpoints_data[ $i ]['key'],
                    ];
                }
                
            }

        }
        $breakData = $breakpoint_option['breakpoints'];
    
        return $breakData;
    }
}