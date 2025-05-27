<?php
namespace BricksUltra\Modules\WooCategory;

use Bricks\Element;
use WC_Product_Catgeory;
use Bricks\Breakpoints;
use BricksUltra\Plugin;

class Module extends Element{
    public $category     = 'ultra';
	public $name         = 'wpvbu-woo-category';
	public $icon         = 'fas fa-boxes-stacked';
	public $css_selector = '';
	public $scripts      = ['bricksUltraSwiperCategory'];

    public function get_label() {
		return esc_html__( 'Woo Category', 'wpv-bu' );
	}
    public function get_keywords() {
		return [ 'category', 'woo-category', 'woocommerce', 'woocommerce-category', 'woo-grid', 'category-grid', 'grid', 'slider', 'carousel', 'category-carousel', 'category-slider',  ];
	}
    public function enqueue_scripts() {
        $layout = $this->settings['layout'] ?? 'grid';
		if ( $layout === 'slider' ) {
            wp_enqueue_script( 'bricks-swiper' );
		    wp_enqueue_style( 'bricks-swiper' );
		}

		wp_enqueue_style( 'bultr-module-style' );
		wp_enqueue_script( 'bultr-module-script' );
	}
    public function set_control_groups(){

        $this->control_groups['category_layout'] = [
			'title' => esc_html__( 'Layout', 'wpv-bu' ),
			'tab'   => 'content',
		];
        $this->control_groups['category_query'] = [
			'title' => esc_html__( 'category settings', 'wpv-bu' ),
			'tab'   => 'content',
		];
       
        $this->control_groups['cat_slider_settings']=[
            'title' => esc_html__( 'Slider Controls', 'wpv-bu' ),
			'tab'   => 'content',
            'required' => ['layout', '=', 'slider'],
        ];
        $this->control_groups['cat_nav_arrows'] = [
			'title'    => esc_html__( 'Navigation Arrows', 'wpv-bu' ),
			'tab'      => 'content',
			'required' => [ 'layout', '=', 'slider' ],
		];
        $this->control_groups['cat_nav_dots'] = [
			'title'    => esc_html__( 'Pagination', 'wpv-bu' ),
			'tab'      => 'content',
			'required' => [ 'layout', '=', 'slider' ],
		];
        $this->control_groups['card_style']=[
            'title'    => esc_html__( 'Category Card Style', 'wpv-bu' ),
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
            'group' => 'category_layout',
			'label' => esc_html__( 'Layout', 'wpv-bu' ),
			'type'  => 'select',
            'options' => [
                'grid'      => __('Grid', 'wpv-bu'),
                'slider'    => __('Slider', 'Wpv-bu'),
            ],
            'inline' => true,
        ];
        $this->controls['style']=[
            'tab'   => 'content',
            'group' => 'category_layout',
			'label' => esc_html__( 'Style', 'wpv-bu' ),
			'type'  => 'select',
            'options' => [
                'preset1'     => __('Preset 1', 'wpv-bu'),
                'preset2'     => __('Preset 2', 'Wpv-bu'),
                'preset3'     => __('Preset 3', 'wpv-bu'),
            ],
            'clearable' => false,
            'default' => __('preset1','wpv-bu'),
            'inline' => true,

        ];
        $this->controls['hvrAnmt']=[
            'tab'   => 'content',
            'group' => 'category_layout',
			'label' => esc_html__( 'Hover Animation', 'wpv-bu' ),
			'type'  => 'select',
            'options' => [
                'top'     => __('Top', 'wpv-bu'),
                'left'     => __('Left', 'Wpv-bu'),
                'bottom'     => __('Bottom', 'wpv-bu'),
                'right'     => __('Right', 'wpv-bu'),
            ],
            'clearable' => false,
            'default' => __('bottom','wpv-bu'),
            'inline' => true,
            'required' => ['style', '=', 'preset3'],
        ];
        $this->controls['columns'] =[
            'tab'   => 'content',
            'group' => 'category_layout',
			'label' => esc_html__( 'Columns', 'wpv-bu' ),
			'type'  => 'number',
            'default'  => 4,
			'min'      => 1,
			'max'      => 12,
            'inline' => true,
            'css'       =>[
                [
                    'selector' => '',
                    'property' => '--columns',
                    'value'     => '%s',
                ],
               
                
            ],
            'required' => ['layout', '=', 'grid'],
        ];
        $this->controls['column_gap'] =[
            'tab'   => 'content',
            'group' => 'category_layout',
			'label' => esc_html__( 'Column Gap', 'wpv-bu' ),
			'type'  => 'number',
            'unit'  => 'px',
            'inline' => true,
            'css'       =>[
                [
                    'property' => 'column-gap',
                    'selector' => '.bultr-grid-layout',
                ],
            ],
            'required' => ['layout', '=', 'grid'],

        ];
        $this->controls['row_gap'] =[
            'tab'   => 'content',
            'group' => 'category_layout',
			'label' => esc_html__( 'Row Gap', 'wpv-bu' ),
			'type'  => 'number',
            'unit'  => 'px',
            'inline' => true,
            'css'       =>[
                [
                    'property' => 'row-gap',
                    'selector' => '.bultr-grid-layout',
                ],
            ],
            'required' => ['layout', '=', 'grid'],

        ];
        $this->controls['showContent']=[
            'tab'       => 'content',
            'group'     => 'category_layout',
			'label'     => esc_html__( 'Show Content', 'wpv-bu' ),
			'type'      => 'checkbox',
            'default'   => true,
        ];
        $this->controls['show_title']=[
            'tab'       => 'content',
            'group'     => 'category_layout',
			'label'     => esc_html__( 'Show Title', 'wpv-bu' ),
			'type'      => 'checkbox',
            'default'   => true,
            'required' => ['showContent','=', true],
        ];
        $this->controls['title_tag']=[
            'tab'   => 'content',
            'group' => 'category_layout',
			'label' => esc_html__( 'Title Tag', 'wpv-bu' ),
			'type'  => 'select',
            'options' => [
                'h1' => 'h1',
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
            ],
            'inline' => true,
            'required' => [['show_title', '=', true],['showContent','=', true],],
        ];
        $this->controls['show_count']=[
            'tab'       => 'content',
            'group'     => 'category_layout',
			'label'     => esc_html__( 'Show Count', 'wpv-bu' ),
			'type'      => 'checkbox',
            'default'   => true,
            'required' => ['showContent','=', true],

        ];
        $this->controls['positionCount']=[
            'tab'       => 'content',
            'group'     => 'category_layout',
			'label'     => esc_html__( 'Count Position', 'wpv-bu' ),
			'type'      => 'select',
            'options'   => [
                'inline' => __('Inline','wpv-bu'),
                'outside' => __('Outside','wpv-bu'),
            ],
            'info' => __('Show count inline with title','wpv-bu'),
            'default'   => 'inline',
            'clearable' => false,
            'inline'  => true,
            'required' => [['showContent','=', true],['show_count','=',true]],
        ];
        $this->controls['countAlign']=[
            'tab'       => 'content',
            'group'     => 'category_layout',
			'label'     => esc_html__( 'Count Alignment', 'wpv-bu' ),
			'type'      => 'select',
            'options'   => [
                'left' => __('Left','wpv-bu'),
                'right' => __('Right','wpv-bu'),
            ],
            'default'   => true,
            'inline'  => true,
            'required' => [['showContent','=', true],['show_count','=',true],['positionCount','=','inside']],
        ];
        $this->controls['show_decspt']=[
            'tab'       => 'content',
            'group'     => 'category_layout',
			'label'     => esc_html__( 'Show Description', 'wpv-bu' ),
			'type'      => 'checkbox',
            'default'   => false,
            'required' => ['showContent','=', true],

        ];
        $this->controls['wordLimit'] = [
            'tab'       => 'content',
            'group'     => 'category_layout',
			'label'     => esc_html__( 'Word Limit', 'wpv-bu' ),
			'type'      => 'number',
            'step'      => '1',
            'units'     => false, 
            'default'   => 30,
            'required' => [['show_decspt','=', true],['showContent','=', true],],

        ];
        $this->controls['showChildCat']=[
            'tab'       => 'content',
            'group'     => 'category_layout',
			'label'     => esc_html__( 'Show Child Categories', 'wpv-bu' ),
			'type'      => 'checkbox',
            'default'   => false,
            'required' => ['showContent','=', true],

        ];
        $this->controls['childSeparator'] = [
            'tab'      => 'content',
			'group'    => 'category_layout',
			'label'    => esc_html__( 'Separator', 'wpv-bu' ),
			'type'     => 'text',
            'default'  => __(',','wpv-bu'),
            'placeholder' => __(',','wpv-bu'),
            'required' => ['showChildCat','=', true],
            'inline'   => true,
        ];
        $this->controls['showButton']=[
            'tab'       => 'content',
            'group'     => 'category_layout',
			'label'     => esc_html__( 'Show Button', 'wpv-bu' ),
			'type'      => 'checkbox',
            'default'   => false,
            'required' => ['showContent','=', true],

        ];

        $this->controls['show_image']=[
            'tab'       => 'content',
            'group'     => 'category_layout',
			'label'     => esc_html__( 'Show Featured Image', 'wpv-bu' ),
			'type'      => 'checkbox',
            'default'   => true,
            'required' => ['style', '=', 'preset1'],
        ];
        $this->controls['image_size'] = [
			'tab'         => 'content',
			'group'       => 'category_layout',
			'label'       => esc_html__( 'Image size', 'wpv-bu' ),
			'type'        => 'select',
			'options'     => $this->control_options['imageSizes'],
			'inline'      => true,
			'placeholder' => esc_html__( 'Default', 'wpv-gu' ),
            'required' => ['showContent','=', true],
		];

        $this->get_category_settings_controls();
        $this->get_swiper_slides_controls();
        $this->navigation_style_controls();
        $this->category_card_style_controls();
        $this->order_items_controls();
    }
    public function get_category_settings_controls(){
        $options = $this->get_category_name();

        $parentoptions = $this->get_category_name();
        $parentoptions[0] = __('Only Top Level', 'wpv-bu');

        $this->controls['filterby']=[
            'tab'       => 'content',
            'group'     => 'category_query',
			'label'     => esc_html__( 'Filter By', 'wpv-bu' ),
			'type'      => 'select',
            'options'   => [
                'all'           => __('Show All', 'wpv-bu'),
                'by_parent'     => __('By Parent', 'wpv-bu'),
                'by_id'         => __('Manual Selection','wpv_bu'),
                'current_cat'   => __('Current Subcategories','wpv-bu'),
            ],
            'inline'    => true,

        ];
        $this->controls['include'] =[
            'tab'       => 'content',
            'group'     => 'category_query',
			'label'     => esc_html__( 'Include Categories', 'wpv-bu' ),
			'type'      => 'select',
            'options'   => $options,
            'multiple'  => true,   
            'searchable' => true,
            'inline'    => true,
            'required'  => ['filterby', '=', 'by_id'],
        ];
        $this->controls['parent'] =[
            'tab'       => 'content',
            'group'     => 'category_query',
			'label'     => esc_html__( 'Parent', 'wpv-bu' ),
			'type'      => 'select',
            'options'   => $options,
            'searchable' => true,
            'inline'    => true,
            'required' => ['filterby', '=', 'by_parent'],
            'description' => __('All the subcategories will be shown of the selected parent', 'wpv-bu'),
        ];
        $this->controls['exclude'] =[
            'tab'       => 'content',
            'group'     => 'category_query',
			'label'     => esc_html__( 'Exclude Categories', 'wpv-bu' ),
			'type'      => 'select',
            'options'   => $options,
            'multiple'  => true,   
            'searchable' => true,
            'inline'    => true,
             ];
        $this->controls['exclude_child']=[
            'tab'       => 'content',
            'group'     => 'category_query',
			'label'     => esc_html__( 'Exclude Child Categories', 'wpv-bu' ),
			'type'      => 'checkbox',
             ];
        
        $this->controls['categoryCount']=[
            'tab'       => 'content',
            'group'     => 'category_query',
			'label'     => esc_html__( 'No. of Category to show', 'wpv-bu' ),
			'type'      => 'number',
            'units'     => false,
        ];
        $this->controls['orderby']=[
            'tab'       => 'content',
            'group'     => 'category_query',
			'label'     => esc_html__( 'Order By', 'wpv-bu' ),
			'type'      => 'select',
            'options'   => [
                'name'  => __('Name', 'wpv-bu'),
                'id'    => __('ID', 'wpv-bu'),
                'count' => __('Count', 'wpv-bu'),
                'slug'  => __('Slug','wpv-bu'),
                'term_group' => __('Term Group','wpv-bu'),
                'none'  => __('None', 'wpv-bu'),
            ],
            'inline'    => true,
        ];
        $this->controls['order']=[
            'tab'       => 'content',
            'group'     => 'category_query',
			'label'     => esc_html__( 'Order', 'wpv-bu' ),
			'type'      => 'select',
            'options'   => [
                'asc' => __('Ascending','wpv-bu'),
                'desc' => __('Descending', 'wpv-bu'),
            ],
            'inline'    => true,

            
        ];
        $this->controls['onlyParentCat']=[
            'tab'       => 'content',
            'group'     => 'category_query',
			'label'     => esc_html__( 'Show only top Level', 'wpv-bu' ),
			'type'      => 'checkbox',
            'required'  => ['filterby','!=', 'by_parent'],
        ];
        $this->controls['hide_empty']=[
            'tab'       => 'content',
            'group'     => 'category_query',
			'label'     => esc_html__( 'Hide Empty', 'wpv-bu' ),
			'type'      => 'checkbox',
        ];
    }
    public function get_swiper_slides_controls(){
        $this->controls['effect']=[
            'tab'           => 'content',
            'group'         => 'cat_slider_settings',
            'label'         => esc_html__('Effect', 'wpv-bu'),
            'type'          => 'select',
            'options'       =>[
                'slide'     => __('Slide', 'wpv-bu'),
                'fade'      => __('Fade', 'wpv-bu'),
                'cube'      => __('Cube', 'wpv-bu'),
                'coverflow' => __('Coverflow', 'wpv-bu'),
                'flip'      => __('Flip','wpv-bu'),
            ],
            'clearable'     => false,
            'inline'        => true,
            'default'       => 'slide',
            'placeholder'   => __('Slide', 'wpv-bu'),
	    ];
        $this->controls['slidesToShow']=[
            'tab'           => 'content',
            'group'         => 'cat_slider_settings',
            'label'         => esc_html__('Items to show', 'wpv-bu'),
            'type'          => 'number',
            'min'           => 1,
            'max'           => 12,
            'placeholder'   => 3,
            'breakpoints'   => true,  
            'clearable'     => false, 
            'default'       => 3,
            'required'      => ['effect', '=', ['slide', 'coverflow']],
        ];
        $this->controls['slidesToScroll']=[
            'tab'           => 'content',
            'group'         => 'cat_slider_settings',
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
            'group'         => 'cat_slider_settings',
            'label'         => esc_html__('Slides Shadow', 'wpv-bu'),
            'type'          => 'checkbox',
            'default'       => true,
            'required'      => ['effect', '=', ['coverflow','flip','cube']],

        ];
        $this->controls['cubeshadow']=[
            'tab'           => 'content',
            'group'         => 'cat_slider_settings',
            'label'         => esc_html__('Shadow', 'wpv-bu'),
            'type'          => 'checkbox',
            'default'       => true,
            'required'      => ['effect', '=', 'cube'],
        ];
        $this->controls['cubeShdOffset']=[
            'tab'           => 'content',
            'group'         => 'cat_slider_settings',
            'label'         => esc_html__('Shadow Offset', 'wpv-bu'),
            'type'          => 'number',
            'min'           => 1,
            'step'          => 1,
            'default'       =>  20,
            'required'      => ['effect', '=', 'cube'],
        ];
        $this->controls['cubeShdScale']=[
            'tab'           => 'content',
            'group'         => 'cat_slider_settings',
            'label'         => esc_html__('Shadow Scale', 'wpv-bu'),
            'type'          => 'number',
            'min'           => 0.0,
            'step'          => 0.01,
            'default'       => 0.94,
            'required'      => ['effect', '=', 'cube'],
        ];
        
        $this->controls['gutter'] =[
            'tab'           => 'content',
            'group'         => 'cat_slider_settings',
            'label'         => esc_html__('Spacing (px)', 'wpv-bu'),
            'type'          => 'number',
            'placeholder'   => 0,
            'required'      => ['effect' , '!=', ['cube','flip','fade']],
        ];
        $this->controls['speed']=[
            'tab'           => 'content',
            'group'         => 'cat_slider_settings',
            'label'         => esc_html__('Animation speed in ms', 'wpv-bu'),
            'type'          => 'number',
            'placeholder'   => 300,
            'small'         => true,
        ];
        $this->controls['autoplay']=[
            'tab'           => 'content',
            'group'         => 'cat_slider_settings',
            'label'         => esc_html__('Autoplay', 'wpv-bu'),
            'type'          => 'checkbox',
        ];
        $this->controls['disableInteraction']=[
            'tab'           => 'content',
            'group'         => 'cat_slider_settings',
            'label'         => esc_html__('Enable On Interaction', 'wpv-bu'),
            'type'          => 'checkbox',
            'required'      => [ 'autoplay', '!=', '' ],
        ];
        $this->controls['pauseOnHover']=[
            'tab'           => 'content',
            'group'         => 'cat_slider_settings',
            'label'         => esc_html__('Pause On Hover', 'wpv-bu'),
            'type'          => 'checkbox',
            'required'      => [ 'autoplay', '!=', '' ],
        ];
        $this->controls['stopOnLastSlide']=[
            'tab'           => 'content',
            'group'         => 'cat_slider_settings',
            'label'         => esc_html__('Stop on last slide', 'wpv-bu'),
            'type'          => 'checkbox',
            'info'          => esc_html__( 'No effect with loop enabled', 'bricks' ),
            'required'      => [ 'autoplay', '!=', '' ],
        ];
        $this->controls['autoplaySpeed']=[
            'tab'           => 'content',
            'group'         => 'cat_slider_settings',
            'label'         => esc_html__('Autoplay delay in ms', 'wpv-bu'),
            'type'          => 'number',
            'placeholder'   => 1000,
            'unit'          => 'ms',
            'required'      => [ 'autoplay', '!=', '' ],
            'small'         => true,

        ];
        $this->controls['infinite'] =[
            'tab'           => 'content',
            'group'         => 'cat_slider_settings',
            'label'         => esc_html__('Loop', 'wpv-bu'),
            'type'          => 'checkbox',
			'default'       => false,
        ];
        $this->controls['centerMode']=[
            'tab'           => 'content',
            'group'         => 'cat_slider_settings',
            'label'         => esc_html__('Center Mode', 'wpv-bu'),
            'type'          => 'checkbox',
            'required'      => ['effect' , '!=', ['cube','flip','fade']],

        ];
        $this->controls['adativeHeight']=[
            'tab'           => 'content',
            'group'         => 'cat_slider_settings',
            'label'         => esc_html__('Adaptive Height', 'wpv-bu'),
            'type'          => 'checkbox',
            'info'          => esc_html__('When true, slider wrapper will automatically adjust its height to match the height of the currently active slide.','wpv-bu'),
        ];
        $this->controls['cursor']=[
            'tab'           => 'content',
            'group'         => 'cat_slider_settings',
            'label'         => esc_html__('Grab Cursor', 'wpv-bu'),
            'type'          => 'checkbox',
            'info'          => esc_html__(' When true, hovering over the slider will display the grab cursor.','wpv-bu'),
        ];
        
    }
    public function navigation_style_controls(){
        $this->controls['arrowShow']=[
            'tab' => 'content',
            'group' => 'cat_nav_arrows',
            'label' => esc_html__('Show Arrows','wpv-bu'),
            'type'     => 'checkbox',
			'inline'   => true,
			'default'  => true,
        ];
        $this->controls['prevArrow'] = [
			'tab'      => 'content',
			'group'    => 'cat_nav_arrows',
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
			'group'    => 'cat_nav_arrows',
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
            'group' => 'cat_nav_arrows',
            'label' => esc_html__('Position','wpv-bu'),
            'type'     => 'select',
            'options' => [
                'inside' => __('Inside','wpv-bu'),
                'outside' => __('Outside','wpv-bu'),
            ],
            'default' => 'inside',
            'inline' => true,
            'required'    => [ 'arrowShow', '!=', '' ],

        ];
        $this->controls['hrztPst']=[
            'tab' => 'content',
            'group' => 'cat_nav_arrows',
            'label' => esc_html__('Horizontal Position','wpv-bu'),
            'type'     => 'select',
            'options' => [
                'left' => __('Left','wpv-bu'),
                'center' => __('Side By Side','wpv-bu'),
                'right'   =>__('Right','wpv-bu'),
            ],
            'default' => 'center',
            'inline' => true,
            'required'    => [ 'arrowShow', '!=', '' ],

        ];
        $this->controls['vrtlPstIn']=[
            'tab' => 'content',
            'group' => 'cat_nav_arrows',
            'label' => esc_html__('Vertical Position','wpv-bu'),
            'type'     => 'select',
            'options' => [
                'top' => __('Top','wpv-bu'),
                'middle' => __('Middle','wpv-bu'),
                'bottom'   =>__('Bottom','wpv-bu'),
            ],
            'default' => 'middle',
            'inline' => true,
            'required'    => [[ 'arrowShow', '!=', '' ],['arrowLayout','=','inside']],

        ];
        $this->controls['vrtlPstOut']=[
            'tab' => 'content',
            'group' => 'cat_nav_arrows',
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
            'group' => 'cat_nav_arrows',
            'label' => esc_html__('Horizontal Offset','wpv-bu'),
            'type' => 'number',
            'units'    => true,
            'css' =>[
                [
                    'selector' => '',
                    'property' => '--hrztlOffset',
                    'value'    => '%s',
                ],
            ], 
            'required' => [ 'arrowShow', '!=', '' ],

        ];
        $this->controls['vertlOffset']=[
            'tab' => 'content',
            'group' => 'cat_nav_arrows',
            'label' => esc_html__('Vertical','wpv-bu'),
            'type' => 'number',
            'units'    => true,
            'css' =>[
                [
                    'selector' => '',
                    'property' => '--vertlOffset',
                    'value'    => '%s',
                ],
            ], 
            'required'    => [[ 'arrowShow', '!=', '' ],['arrowLayout','=', 'inside' ],['vrtlPstIn', '!=', 'middle'],],

        ];
        $this->controls['outsidePadding']=[
            'tab'   => 'content',
            'group' => 'cat_nav_arrows',
            'label' => esc_html__('Outside Gap','wpv-bu'),
            'type'  => 'number',
            'units' => false,
            'css'   =>[
                [
                    'selector' => '',
                    'property' => '--outsidegap',
                    'value'    => '%spx',
                ],
            ], 
            'required'    => [
                [ 'arrowShow', '!=', '' ],
                ['arrowLayout','!=', 'inside' ],
            ],

        ];
        $this->controls['arrowHeight'] = [
			'tab'         => 'content',
			'group'       => 'cat_nav_arrows',
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
			'group'       => 'cat_nav_arrows',
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
			'group'       => 'cat_nav_arrows',
			'label'       => esc_html__( 'Gap', 'wpv-bu' ),
			'type'        => 'number',
			'units'       => false,
			'css'         => [
				[
					'property' => 'gap',
					'selector' => '.bultr-navigation-wrap',
				],
			],
			'placeholder' => 0,
			'required'    => [[ 'arrowShow', '!=', '' ],
                            ['hrztPst','!=','center'],],
		];
        $this->controls['arrowColor']=[
            'tab' => 'content',
            'group' => 'cat_nav_arrows',
            'label' => esc_html__('Color','wpv-bu'),
            'type' => 'color',
            'css' =>[
                [
                    'property' => 'color',
                    'selector' => '.bultr-swiper-button i',
                ],
            ], 
            'default' => [
                'hex' => '#000',
                'rgb' => 'rgba(33,33,33,1)',
              ],            
              'required' => [ 'arrowShow', '!=', '' ],

        ];
		$this->controls['arrowBackground'] = [
			'tab'      => 'content',
			'group'    => 'cat_nav_arrows',
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
			'group'    => 'cat_nav_arrows',
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
			'group'    => 'cat_nav_arrows',
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
			'group'    => 'cat_nav_arrows',
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
			'group'    => 'cat_nav_dots',
			'label'    => esc_html__( 'Show dots', 'wpv-bu' ),
			'type'     => 'checkbox',
			'inline'   => true,
			'rerender' => true,
		];
        $this->controls['dotsType']=[
            'tab'      => 'content',
			'group'    => 'cat_nav_dots',
			'label'    => esc_html__( 'Type of Naviation', 'wpv-bu' ),
            'type'     => 'select',
            'options'   => [
                'bullets' => __("Bullets",'wpv-bu'),
                'fraction' => __('Fraction', 'wpv-bu'),
            ],
            'default' => __('bullets','wpv-bu'),
			'required' => [ 'dots', '!=', '' ],
            'inline'     => true,

        ];

		$this->controls['dotsDynamic'] = [
			'tab'      => 'content',
			'group'    => 'cat_nav_dots',
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
			'group'    => 'cat_nav_dots',
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
			'group'    => 'cat_nav_dots',
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
			'group'    => 'cat_nav_dots',
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
			'group'    => 'cat_nav_dots',
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
			'group'    => 'cat_nav_dots',
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
			'group'    => 'cat_nav_dots',
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
			'group'    => 'cat_nav_dots',
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
                ['dotsType', '!=', 'fraction'],
            ],
		];

		$this->controls['dotsWidth'] = [
			'tab'      => 'content',
			'group'    => 'cat_nav_dots',
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
			'group'    => 'cat_nav_dots',
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
			'group'    => 'cat_nav_dots',
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
			'group'    => 'cat_nav_dots',
			'label'    => esc_html__( 'Bottom', 'wpv-bu' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'bottom',
					'selector' => '.bricks-swiper-container  + .swiper-pagination',
				],
			],
            'default' => '10px',
			'required' => [ 'dots', '!=', '' ],
		];

		$this->controls['dotsLeft'] = [
			'tab'      => 'content',
			'group'    => 'cat_nav_dots',
			'label'    => esc_html__( 'Left', 'wpv-bu' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'left',
					'selector' => '.bricks-swiper-container  + .swiper-pagination',
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
			'group'    => 'cat_nav_dots',
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
        ];
    }
    public function category_card_style_controls(){
        //card
        $this->card_style_controls();
        //CONTENT
        $this->content_style_controls();
        
        //Image
        $this->controls['imagesept'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Image', 'wpv-bu' ),
			'type'     => 'separator',
            'required' => ['show_image','=', true],
		];
        $this->controls['imageWidth'] =[
            'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Width', 'wpv-bu' ),
			'type'     => 'number',
            'css'       => [
                [
                    'property' => 'width',
                    'selector' => '.bultr-image',
                ],
                [
                    'property' => 'width',
                    'selector' => '.bultr-category-content',
                    'value'    => 'calc(100% - %s)',
                ],
            ],
            'required' => [
                ['show_image','=', true],
                ['style' , '=', 'preset1'],
                ['direction','=', ['row','row-reverse']],
            ],
            
        ];
        $this->controls['imageSize'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Aspect Ratio', 'wpv-bu' ),
			'type'     => 'number',
            'units' => false,
            'min' => 0,
            'max' => 2,
            'step' => '0.01',
            'placeholder' => __('0.41','wpv-bu'),
            'css' => [
                [
                    'property' => 'aspect-ratio',
                    'selector' => '.bultr-image img',
                ],
            ],
            'required' => ['show_image','=', true],
            'inline' => true,
            'small' => true,
		];
        $this->controls['imagePadding'] =[
            'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Padding', 'wpv-bu' ),
			'type'     => 'dimensions',
            'css'       => [
                [
                    'property' => 'padding',
                    'selector' => '.bultr-image',
                ],
            ],
            'required' => [
                ['show_image','=', true],
                ['style' , '=', 'preset1'],
                ['direction','=', ['row','row-reverse']],
            ],


            
        ];
        $this->controls['imageBorder'] =[
            'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Border', 'wpv-bu' ),
			'type'     => 'border',
            'css'       => [
                [
                    'property' => 'border',
                    'selector' => '.bultr-image img',
                ],
            ],
            'required' => [
                ['show_image','=', true],
                ['style' , '=', 'preset1'],
            ],

            
        ];
        $this->controls['imageBxShd'] =[
            'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Box Shadow', 'wpv-bu' ),
			'type'     => 'box-shadow',
            'css'       => [
                [
                    'property' => 'box-shadow',
                    'selector' => '.bultr-image',
                ],
            ],
            'required' => [
                ['show_image','=', true],
                ['style' , '=', 'preset1'],
            ],

            
        ];
        //title
        $this->controls['titlesept'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Title', 'wpv-bu' ),
			'type'     => 'separator',
            'required' => ['show_title','=', true],
		];
        $this->controls['titleColor'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Color', 'wpv-bu' ),
			'type'     => 'color',
            'css'      => [
                [
                    'property' => 'color',
                    'selector' => '.bultr-category-content .bultr-title',
                ],
            ],
            'required' => ['show_title','=', true],
		];
        $this->controls['titleTypo'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Typography', 'wpv-bu' ),
			'type'     => 'typography',
            'css'      => [
                [
                    'property' => 'font',
                    'selector' => '.bultr-category-content .bultr-title',
                ],
            ],
            'exclude' => ['color'],
            'required' => ['show_title','=', true],
		];
        //description
        $this->controls['countsept'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Count', 'wpv-bu' ),
			'type'     => 'separator',
            'required' => ['show_count','=', true],
		];
        $this->controls['countColor'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Color', 'wpv-bu' ),
			'type'     => 'color',
            'css'      => [
                [
                    'property' => 'color',
                    'selector' => '.bultr-category-content .bultr-count',
                ],
            ],
            'required' => ['show_count','=', true],
		];
        $this->controls['countTypo'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Typography', 'wpv-bu' ),
			'type'     => 'typography',
            'css'      => [
                [
                    'property' => 'font',
                    'selector' => '.bultr-category-content .bultr-count',
                ],
            ],
            'exclude' => ['color'],
            'required' => ['show_count','=', true],
		];
        //description
        $this->controls['dscptsept'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Description', 'wpv-bu' ),
			'type'     => 'separator',
            'required' => ['show_decspt','=', true],
		];
        $this->controls['dscptColor'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Color', 'wpv-bu' ),
			'type'     => 'color',
            'css'      => [
                [
                    'property' => 'color',
                    'selector' => '.bultr-category-content .bultr-description',
                ],
            ],
            'required' => ['show_decspt','=', true],
		];
        $this->controls['dscptTypo'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Typography', 'wpv-bu' ),
			'type'     => 'typography',
            'css'      => [
                [
                    'property' => 'font',
                    'selector' => '.bultr-category-content .bultr-description',
                ],
            ],
            'exclude' => ['color'],
            'required' => ['show_decspt','=', true],
		];
        //category
        $this->child_cat_style_controls();
        //button
        $this->button_style_controls();
    }
    public function card_style_controls(){
        $device_option = $this->get_device_name();
        $this->controls['cardsept'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Card', 'wpv-bu' ),
			'type'     => 'separator',
		];
        $this->controls['direction']=[
            'tab'   => 'content',
            'group' => 'card_style',
			'label' => esc_html__( 'Direction', 'wpv-bu' ),
			'type'  => 'direction',
            'css'   =>[
                [
                    'property' => 'flex-direction',
                    'selector' => '#bultr-style1 .bultr-category-card',
                ],
            ],
            'inline' => true,
            'required' => ['style', '=', 'preset1'],
        ];
        $this->controls['stack']=[
            'tab'   => 'content',
            'group' => 'card_style',
			'label' => esc_html__( 'Stack On ', 'wpv-bu' ),
			'type'  => 'select',
            'options' => $device_option,
            'required' => [
                ['style' , '=', 'preset1'],
                ['direction','=', ['row','row-reverse']],
            ],
            'placeholder' => __('Mobile Potrait', 'wpv-bu'),
            'inline' => true,
        ];
        $this->controls['cardBgType']=[
            'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Background Type', 'wpv-bu' ),
			'type'     => 'select',
            'options'  => [
                'color' => __('Image or Color', 'wpv-bu'),
                'gradient' => __('Gradient','wpv-bu'),
            ],
            'inline' => true,
        ] ;
        $this->controls['cardBg'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Background', 'wpv-bu' ),
			'type'     => 'background',
            'css'      => [
                
                [
                    'property' => 'background',
                    'selector' =>  '.bultr-category-card.bultr-contentbg-color',
                ],
            ],
            'required' => [['cardBgType', '=', 'color']],
		];
        $this->controls['cardBgGradient'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Background', 'wpv-bu' ),
			'type'     => 'gradient',
            'css'      => [
               
                [
                    'property' => 'background-image',
                    'selector' => '.bultr-category-card.bultr-contentbg-gradient' ,
                ],
            ],
            'required' => [['cardBgType', '=', 'gradient']],
		];
        $this->controls['cardborder'] =[
            'tab'   => 'content',
            'group' => 'card_style',
			'label' => esc_html__( 'Border', 'wpv-bu' ),
			'type'  => 'border',
            'inline' => true,
            'css'       =>[
                [
                    'property' => 'border',
                    'selector' => ':not(#bultr-style1) .bultr-category-card',
                ],
                [
                    'property' => 'border',
                    'selector' => '#bultr-style1 .bultr-category-card',
                ],
            
            ],
        ];
        $this->controls['cardbox_shd'] =[
            'tab'   => 'content',
            'group' => 'card_style',
			'label' => esc_html__( 'Box Shadow', 'wpv-bu' ),
			'type'  => 'box-shadow',
            'inline' => true,
            'css'       =>[
                [
                    'property' => 'box-shadow',
                    'selector' => '.bultr-category-card',
                ],
            ],

        ];
        $this->controls['cardPadding'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Padding', 'wpv-bu' ),
			'type'     => 'dimensions',
            'css'      => [
                [
                    'property' => 'padding',
                    'selector' => '.bultr-category-card',

                ],
                
            ],
		];
        $this->controls['cardMargin'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Margin', 'wpv-bu' ),
			'type'     => 'dimensions',
            'css'      => [
                [
                    'property' => 'margin',
                    'selector' => '.bultr-category-card',

                ],
            ],
		];
    }
    public function content_style_controls(){
        $this->controls['contentsept'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Content', 'wpv-bu' ),
			'type'     => 'separator',
		];
        $this->controls['contentBgType']=[
            'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Background Type', 'wpv-bu' ),
			'type'     => 'select',
            'options'  => [
                'color' => __('Image or Color', 'wpv-bu'),
                'gradient' => __('Gradient','wpv-bu'),
            ],
            'inline' => true,
        ] ;
        $this->controls['contentBg'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Background', 'wpv-bu' ),
			'type'     => 'background',
            'css'      => [
                [
                    'property' => 'background',
                    'selector' =>  '.bultr-category-content.bultr-contentbg-color',
                ],
                
            ],
            
            'required' => [['contentBgType', '=', 'color']],
		];
        $this->controls['contentBgGradient'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Background', 'wpv-bu' ),
			'type'     => 'gradient',
            'css'      => [
                [
                    'property' => 'background-image',
                    'selector' =>  '.bultr-category-content.bultr-contentbg-gradient',
                ],
                
            ],
            'required' => [['contentBgType', '=', 'gradient']],
		];
        $this->controls['contentWidth'] =[
            'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Width', 'wpv-bu' ),
			'type'     => 'number',
            'units'    => true,
            'css'      => [
                [
                    'property' => 'width',
                    'selector' => '#bultr-style2 .bultr-category-card .bultr-category-content',
                ],
            ],
            'required' => ['style', '=', 'preset2'],

        ];
        $this->controls['contentHeight'] =[
            'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Height', 'wpv-bu' ),
			'type'     => 'number',
            'units'    => true,
            'css'      => [
                [
                    'property' => 'min-height',
                    'selector' => '#bultr-style2 .bultr-category-card .bultr-category-content',
                ],
            ],
            'required' => ['style', '=', 'preset2'],
            
        ];
        $this->controls['boxPstTop'] =[
            'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Top', 'wpv-bu' ),
			'type'     => 'number',
            'units'    => true,
            'css'      => [
                [
                    'property' => 'top',
                    'selector' => '#bultr-style2 .bultr-category-card .bultr-category-content',
                ],
            ],
            'required' => ['style', '=', 'preset2'],
            
        ];
        $this->controls['boxPstLeft'] =[
            'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Left', 'wpv-bu' ),
			'type'     => 'number',
            'units'    => true,
            'css'      => [
                [
                    'property' => 'left',
                    'selector' => '#bultr-style2 .bultr-category-card .bultr-category-content',
                ],
            ],
            'required' => ['style', '=', 'preset2'],
            
        ];
        $this->controls['boxPstBottom'] =[
            'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Bottom', 'wpv-bu' ),
			'type'     => 'number',
            'units'    => true,
            'css'      => [
                [
                    'property' => 'bottom',
                    'selector' => '#bultr-style2 .bultr-category-card .bultr-category-content',
                ],
            ],
            'required' => ['style', '=', 'preset2'],
            
        ];
        $this->controls['boxPstRight'] =[
            'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Right', 'wpv-bu' ),
			'type'     => 'number',
            'units'    => true,
            'css'      => [
                [
                    'property' => 'right',
                    'selector' => '#bultr-style2 .bultr-category-card .bultr-category-content',
                ],
            ],
            'required' => ['style', '=', 'preset2'],
            
        ];
        $this->controls['contentPadding'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Content Padding', 'wpv-bu' ),
			'type'     => 'dimensions',
            'css'      => [
                [
                    'property' => 'padding',
                    'selector' => '.bultr-category-content',

                ],
            ],
		];
        $this->controls['contentJustify']=[
            'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Justify Content', 'wpv-bu' ),
			'type'     => 'justify-content',
            'css'      => [
                [
                    'property' => 'justify-content',
                    'selector' => '.bultr-category-content',
                ],
            ],
            'required' => [
                ['style' , '=', 'preset1'],
                ['direction','=', ['row','row-reverse']],
            ],
        ];
        $this->controls['contentAlign3']=[
            'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Align Items', 'wpv-bu' ),
			'type'     => 'align-items',
            'css'      => [
                [
                    'property' => 'align-items',
                    'selector' => '.bultr-category-content',
                ],
            ],
        ];
        $this->controls['contentJustify3']=[
            'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Justify Content', 'wpv-bu' ),
			'type'     => 'justify-content',
            'css'      => [
                [
                    'property' => 'justify-content',
                    'selector' => '.bultr-category-content',
                ],
            ],
            'required' => [
                ['style' , '=', ['preset3','preset2']],
            ],
        ];
        $this->controls['contentGap'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Space Between', 'wpv-bu' ),
			'type'     => 'number',
            'unit'     => 'px',
            'css'      => [
                [
                    'property' => 'gap',
                    'selector' => '.bultr-category-content',

                ],
            ],
		];
    }
    public function child_cat_style_controls(){
        $this->controls['childsept'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Child Category', 'wpv-bu' ),
			'type'     => 'separator',
            'required' => ['showChildCat','=', true],
		];
        $this->controls['childDirection']=[
            'tab'   => 'content',
            'group' => 'card_style',
			'label' => esc_html__( 'Direction', 'wpv-bu' ),
			'type'  => 'direction',
            'css'   =>[
                [
                    'property' => 'flex-direction',
                    'selector' => '.bultr-child-category',
                ],
            ],
            'inline' => true,
            'required' => ['showChildCat','=', true],

            
        ];
        $this->controls['childColor'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Color', 'wpv-bu' ),
			'type'     => 'color',
            'css'      => [
                [
                    'property' => 'color',
                    'selector' => '.bultr-category-content .bultr-child-category',
                ],
            ],
            'required' => ['showChildCat','=', true],
		];
        $this->controls['childTypo'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Typography', 'wpv-bu' ),
			'type'     => 'typography',
            'css'      => [
                [
                    'property' => 'font',
                    'selector' => '.bultr-category-content .bultr-child-category',
                ],
            ],
            'exclude' => ['color'],
            'required' => ['showChildCat','=', true],
		];

        $this->controls['childAlignment']=[
            'tab'   => 'content',
            'group' => 'card_style',
			'label' => esc_html__( 'Align-Items', 'wpv-bu' ),
			'type'  => 'align-items',
            'css'   =>[
                [
                    'property' => 'align-items',
                    'selector' => '.bultr-child-category',
                ],
            ],
            'required' => [
                ['showChildCat','=', true],
                ['childDirection' , '=', ['column','column-reverse']],
            ],
        ];
    }
    public function button_style_controls(){
        //button
        $this->controls['buttonsept'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Button', 'wpv-bu' ),
			'type'     => 'separator',
            'required' => ['showButton','=', true],
		];
        $this->controls['buttonText'] = [
            'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Button', 'wpv-bu' ),
			'type'     => 'text',
            'placeholder' => __('Explore','wpv-bu'),
            'required' => ['showButton','=', true],
        ];
        //Icon
        $this->controls['buttonIcon'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Button Icon', 'wpv-bu' ),
			'type'     => 'icon',
			'rerender' => true,
            'required' => ['showButton','=', true],
		];
        $this->controls['iconSize'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Icon Size', 'wpv-bu' ),
			'type'     => 'number',
            'unit'     => 'px',
            'css'      => [
                [
                    'property' => 'font-size',
                    'selector' => '.bultr-buttons i',
                ],
            ],
            'required' => [
                ['showButton','=', true],
                ['buttonIcon', '!=', ''],
            ],
		];
        $this->controls['iconColor'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Icon Color', 'wpv-bu' ),
			'type'     => 'color',
            'css'      => [
                [
                    'property' => 'color',
                    'selector' => '.bultr-buttons i',
                ],
            ],
            'required' => [
                ['showButton','=', true],
                ['buttonIcon', '!=', ''],
            ],
		];
        $this->controls['iconPst'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Icon Position', 'wpv-bu' ),
			'type'     => 'select',
            'options'  => [
                'left' => __('Left','wpv-bu'),
                'right'=> __('Right','wpv-bu'),
            ],
            'required' => [
                ['showButton','=', true],
                ['buttonIcon', '!=', ''],
            ],
            'inline' => true,

		];
        $this->controls['iconGap'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Icon Gap', 'wpv-bu' ),
			'type'     => 'number',
            'units'    => true,
            'css'      => [
                [
                    'property' => 'gap',
                    'selector' => '.bultr-category-card .bultr-buttons',
                ],
            ],
            'required' => [
                ['showButton','=', true],
                ['buttonIcon', '!=', ''],
            ],

		];
        $this->controls['buttonWidth'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Width', 'wpv-bu' ),
			'type'     => 'number',
            'units'    => true,
            'css'      => [
                [
                    'property' => 'width',
                    'selector' =>  '.bultr-buttons',
                ],
            ],
            'required' => ['showButton','=', true],
		]; 
        $this->controls['buttonColor'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Color', 'wpv-bu' ),
			'type'     => 'color',
            'css'      => [
                [
                    'property' => 'color',
                    'selector' =>  '.bultr-buttons',
                ],
            ],
            'required' => ['showButton','=', true],
		];
        $this->controls['buttonBgType']=[
            'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Background Type', 'wpv-bu' ),
			'type'     => 'select',
            'options'  => [
                'color' => __('Image or Color', 'wpv-bu'),
                'gradient' => __('Gradient','wpv-bu'),
            ],
            'required' => ['showButton','=', true],
            'inline' => true,
        ] ;
        $this->controls['buttonBg'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Background', 'wpv-bu' ),
			'type'     => 'background',
            'css'      => [
                [
                    'property' => 'background',
                    'selector' =>  '.bultr-buttons',
                ],
            ],
            'required' => [['showButton','=', true],['buttonBgType', '=', 'color']],
		];
        $this->controls['buttonBgGradient'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Background', 'wpv-bu' ),
			'type'     => 'gradient',
            'css'      => [
                [
                    'property' => 'background-image',
                    'selector' =>  '.bultr-buttons',
                ],
            ],
            'required' => [['showButton','=', true],['buttonBgType', '=', 'gradient']],
		];
        $this->controls['buttonFont'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Typography', 'wpv-bu' ),
			'type'     => 'typography',
            'css'      => [
                [
                    'property' => 'font',
                    'selector' =>  '.bultr-buttons',
                ],
            ],
            'exclude' => ['color'],
            'required' => ['showButton','=', true],
		];
        $this->controls['buttonBorder'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Border', 'wpv-bu' ),
			'type'     => 'border',
            'css'      => [
                [
                    'property' => 'border',
                    'selector' =>  '.bultr-buttons',
                ],
            ],
            'required' => ['showButton','=', true],
		];
        $this->controls['buttonBxShd'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Box Shadow', 'wpv-bu' ),
			'type'     => 'box-shadow',
            'css'      => [
                [
                    'property' => 'box-shadow',
                    'selector' =>  '.bultr-buttons',
                ],
            ],
            'required' => ['showButton','=', true],
		];
        $this->controls['buttonGap'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Gap', 'wpv-bu' ),
			'type'     => 'number',
            'units'    => true,
            'css'      => [
                [
                    'property' => 'margin-top',
                    'selector' =>  '.bultr-buttons',
                ],
            ],
            'required' => ['showButton','=', true],
		];
       
        $this->controls['buttonPadding'] = [
			'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Padding', 'wpv-bu' ),
			'type'     => 'dimensions',
            'css'      => [
                [
                    'property' => 'padding',
                    'selector' =>  '.bultr-buttons',
                ],
            ],
            'required' => ['showButton','=', true],
		];
        $this->controls['buttonPst']=[
            'tab'      => 'content',
			'group'    => 'card_style',
			'label'    => esc_html__( 'Align-self', 'wpv-bu' ),
			'type'     => 'align-items',
            'css'      => [
                [
                    'property' =>'align-self',
                    'selector' => '.bultr-buttons',
                ],
            ],
        ];

    }
    public function order_items_controls(){
        //title
        $this->controls['titleOrder'] = [
			'tab'      => 'content',
			'group'    => 'order_content',
			'label'    => esc_html__( 'Title', 'wpv-bu' ),
			'type'     => 'number',
            'units'    => false,
            'css'      => [
                [
                    'property' => 'order',
                    'selector' => '.bultr-category-content .bultr-heading-wrap',
                ],
            ],
            'required' => ['show_title','=', true],
		];
        $this->controls['countOrder'] = [
			'tab'      => 'content',
			'group'    => 'order_content',
			'label'    => esc_html__( 'Count', 'wpv-bu' ),
			'type'     => 'number',
            'units'    => false,
            'css'      => [
                [
                    'property' => 'order',
                    'selector' => '.bultr-category-content .bultr-count',
                ],
            ],
            'required' => [['show_count','=', true],['positionCount','=','outside']],
		];
        $this->controls['childCatOrder'] = [
			'tab'      => 'content',
			'group'    => 'order_content',
			'label'    => esc_html__( 'Child Category', 'wpv-bu' ),
			'type'     => 'number',
            'units'    => false,
            'css'      => [
                [
                    'property' => 'order',
                    'selector' => '.bultr-category-content .bultr-child-category',
                ],
            ],
            'required' => ['showChildCat','=', true],
		];
        $this->controls['decsptOrder'] = [
			'tab'      => 'content',
			'group'    => 'order_content',
			'label'    => esc_html__( 'Description', 'wpv-bu' ),
			'type'     => 'number',
            'units'    => false,
            'css'      => [
                [
                    'property' => 'order',
                    'selector' => '.bultr-category-content .bultr-description',
                ],
            ],
            'required' => ['show_decspt','=', true],
		];
        $this->controls['buttonOrder'] = [
			'tab'      => 'content',
			'group'    => 'order_content',
			'label'    => esc_html__( 'Button', 'wpv-bu' ),
			'type'     => 'number',
            'units'    => false,
            'css'      => [
                [
                    'property' => 'order',
                    'selector' => '.bultr-category-content .bultr-buttons',
                ],
            ],
            'required' => ['showButton','=', true],
		];

    }
    public function get_device_name(){
        $devices = Breakpoints::get_breakpoints();
        if(!empty($devices)){
            $device_options = [];
            foreach($devices as $key => $device){
                if($device['key'] != 'desktop'){
                    $name = $device['label'];
                    $keys = $device['key'];
                    $device_options[$keys] = $name;
                }
               
            }
        }
        return $device_options;
    }
    public function render(){
        

        $settings = $this->settings;
        $id = "brex-" . $this->id;

        $title_tag = !empty($settings['title_tag']) ? $settings['title_tag'] : __('h3', 'wpv-bu');
        $layout = isset($settings['layout']) ? $settings['layout'] : 'grid';

        $categories = $this->get_category_query($settings);
        $root_classes = ['bultr-woo-cat-wrapper',$id];
        $category_class = ['bultr-category'];
        if($layout === 'grid'){
            $category_class[] = 'bultr-grid-layout';
            $root_data = 'grid';
        }
        else{
            $category_class[] = 'bultr-slider-layout';
            $root_data = 'slider';
            $slider_data = $this->get_slider_options($id);
            $this->set_attribute('category','data-script-args',wp_json_encode($slider_data));
        }
        if(isset($settings['style'])){
            switch ($settings['style']){
                case 'preset1' :
                $category_id = ['bultr-style1'];
                break;
                case 'preset2' :
                    $category_id = ['bultr-style2'];
                break;
                case 'preset3' :
                    $category_id = ['bultr-style3'];
                break;
            }
        }
        if(isset($settings['stack'])){
            $this->set_attribute( '_root', 'data-stack', $settings['stack'] );
        }
        if(isset($settings['arrowLayout'])){
            $category_class[] = 'bultr-arrow-'.$settings['arrowLayout']; 
            if($settings['arrowLayout'] === 'inside'){
                if(isset($settings['vrtlPstIn']) ){
                    $category_class[] = 'bultr-vpst-'.$settings['vrtlPstIn']; 
                }
            }
            else{
                if(isset($settings['vrtlPstOut']) ){
                    $category_class[] = 'bultr-vpst-'.$settings['vrtlPstOut']; 
                }
            }
        }
        if(isset($settings['hrztPst'])){
            $category_class[] = 'bultr-hpst-'.$settings['hrztPst']; 
        }

        $this->set_attribute( '_root', 'class', $root_classes );
        $this->set_attribute( '_root', 'data', $root_data );
        $this->set_attribute('category', 'class', $category_class);

        $this->set_attribute('category', 'id', $category_id);
        //html start
        $output = "";
        $output .= "<div {$this->render_attributes( '_root' )}>"; //wrapper
        if(!empty($categories)){
            $output .= "<div {$this->render_attributes( 'category' )}>";//category-wrap
            if ( $layout === 'slider' ) {
                $output .=  "<div class='swiper-wrapper'>"; //slider wrapper
            }
            if(! empty( $categories ) ){
                foreach($categories as $index => $category){
                    $category_card = ['bultr-category-card'];

                    if(isset($settings['cardBgType'])){
                        $category_card[] = 'bultr-contentbg-'.$settings['cardBgType'];
                    }
                    if(!empty($settings['direction'])){
                        if($settings['direction']==='column' ||$settings['direction']==='column-reverse'){
                            $category_card[] = 'bultr-direction-column';
                        }
                        else{
                            $category_card[] = 'bultr-direction-'.$settings['direction'];
    
                        }
                    }
                    if(isset($settings['hvrAnmt'])){
                        $category_card[] = 'bultr-hvr-'.$settings['hvrAnmt'];
                    }

                    $this->set_attribute("cat-{$index}", 'class',$category_card);
                    if ( $layout === 'slider' ) {
                        $this->set_attribute("cat-{$index}", 'class', 'swiper-slide');
                    }
                    $name = $category->name;
                    $count = $category->count;
                    $id = $category->term_id;
                    $thumb_id    = get_term_meta( $id, 'thumbnail_id', true );
                    $link = get_term_link($id);
                    $image_size = $settings['image_size'] ?? 'thumbnail';
                    $image = wp_get_attachment_image($thumb_id, $image_size);
                    $description = $category->description;
                    $img_src =  \Bricks\Builder::get_template_placeholder_image();
                   if(empty($image)){
                    $image = "<img src= '".$img_src."' >";
                   }
                    $output .= "<div {$this->render_attributes("cat-{$index}")}>";//category card
                    //image
                    if(isset($settings['show_image'])){
                        $output .= "<div class = 'bultr-image'><a href = ". $link.">" . $image . "</a>";
                        if($settings['style'] === 'preset2' || $settings['style'] === 'preset3'){
                            $output .= $this->render_content($settings,$id, $index, $title_tag, $category, $link);
                        }
                        $output  .= "</div>";
                    }
                    if($settings['style'] === 'preset1'){
                        $output .= $this->render_content($settings,$id, $index, $title_tag, $category, $link);

                    }
                   
                    $output .= "</div>";//category-card + swiper-slide
                }
            }
            if ( $layout === 'slider' ) {
                $output .=  "</div>"; //slider wrapper
            }
            if($layout === 'slider'){
                if(isset($settings['arrowShow']) === true && $settings['arrowShow']=== true){
                    if(isset($settings['hrztPst']) && $settings['hrztPst'] !== 'center' ){
                        $output .= "<div class = 'bultr-navigation-wrap'>";//nav-wrap 
                        $output .= $this->render_arrows($settings); // nav arrows with wrap
                        $output .= "</div>";  //nv wrap closing    
                    }
                    else{
                        $output .= $this->render_arrows($settings);//nav arrows without wrap
                    }
                }            
            }//navigation
            $output .= "</div>";//category-wrap
            if($layout === 'slider'){
                if(isset($settings['dots'])=== true && $settings['dots'] === true){
                    $output .= "<div class = 'pagination swiper-pagination'>";
                    $output .= "</div>";//pagination
                }
            }

        }
        else{
            $output .= "<div class = 'bultr-no-category'>";
            $output .= "<i class='ti-package' title='ti-package'></i>";
            $output .= "<span>" .__('No category were found matching your selection.','wpv-bu')."</span>";
            $output .= "</div>";
        }
        $output .= "</div>";//wrapper
        echo $output; 

    }
    public function render_content($settings,$id, $index, $title_tag, $category, $link){
        $output  = "";
        $name = $category->name;
        $count = $category->count;
        $description = $category->description;

        if(isset($settings['showContent'])){
            $content_class = ['bultr-category-content'];

            if(isset($settings['contentBgType'])){
                $content_class[] = 'bultr-contentbg-'.$settings['contentBgType'];
            }
            $this->set_attribute("content-$index", 'class', $content_class);

            $output .= "<div {$this->render_attributes( "content-$index" )}>" ;
            if(isset($settings['positionCount']) && $settings['positionCount'] === 'inline'){
                $head_class = ['bultr-heading-wrap'];
                if(isset($settings['countAlign'])){
                    $head_class[] = 'bultr-pst-'.$settings['countAlign'];
                }
                $this->set_attribute("head-$index",'class',$head_class);
                $output .= "<div {$this->render_attributes("head-$index")}>";

            }
            //title with archive page url
            if(isset($settings['show_title'])){
                $link = get_term_link($id);
                if($title_tag){
                    $this->set_attribute( "title-{$index}", esc_attr( $title_tag ) );

                }
                $this->set_attribute( "title-{$index}", 'class', 'bultr-title');

                $output .= "<{$this->render_attributes( "title-{$index}" )}> <a href=".$link .">".__($name,'wpv-bu'). "</a></{$title_tag}>";// product title

            }
            //count
            if(isset($settings['show_count'])){
                $output .= "<span class='bultr-count'>(" . $count . ")</span>";
            }
            if(isset($settings['positionCount']) && $settings['positionCount'] === 'inline'){
                $output .= "</div>";//heading wrap
            }
            //child Categories
            if(!empty($settings['showChildCat'])){

                $parent_id =  $category->parent;
                if($parent_id === 0){
                    $child_category_ids = get_term_children( $id, 'product_cat' );
                    $sept = "";
                    // if(isset($settings['childDirection']) && ($settings['childDirection'] === 'row' || $settings['childDirection'] === 'row-reverse')){
                        if(!empty($settings['childSeparator'])){
                            $sept  = $settings['childSeparator'];
                        }
                    // }
                    if(!empty($child_category_ids)){
                        $output .= "<ul class = 'bultr-child-category'>";
                        $lastElement = end($child_category_ids);
                        foreach ( $child_category_ids as $indexs => $child_category_id ) {
                            $child_category = get_term_by( 'id', $child_category_id, 'product_cat' );
                            $childLink = get_term_link($child_category_id);
                            $childName = $child_category->name;
                            $childCat_class = ['bultr-child-category-li'];
                            $this->set_attribute("child-$indexs", "class",$childCat_class );
                            $output .= "<li {$this->render_attributes("child-$indexs")}><a href = " .$childLink.">" .$childName;
                            if($child_category_id != $lastElement){
                                $output .=$sept;
                            }
                            $output .= "</a></li>";
                        }
                        $output .= "</ul>";
                    }
                    
                }
            }


            
            if(isset($settings['show_decspt'])){
                if(!empty($settings['wordLimit'])){
                    if(!empty($description)){
                        $output .= "<div class = 'bultr-description'>".wp_trim_words( wc_format_content($description), $settings['wordLimit']) ."</div>";
                    }
                }
                else{
                    if(!empty($description)){
                        $output .= "<div class = 'bultr-description'>".wc_format_content($description) ."</div>";
                    }
                }
            }
            
            
            if(!empty($settings['showButton'])){
                $button_class = ['bultr-buttons'];
                if(isset($settings['iconPst']) && $settings['iconPst'] === 'left'  ){
                    $button_class[] = 'bultr-icon-left';
                }
                else{
                    $button_class[] = 'bultr-icon-right';
                }
                if(isset($settings['buttonBgType'])){
                    $button_class[] = 'bultr-bg-'.$settings['buttonBgType'];
                }
                $this->set_attribute("button-$index",'class', $button_class);
                
                $this->set_attribute("button-$index",'href', $link);
                $output .= "<a {$this->render_attributes("button-$index")}>";

                // check button text is empty or not 

                if(!empty($settings['buttonText'])){
                    $output .= $settings['buttonText'];
                }
                else{
                    $output .= __('Explore','wpv-bu');
                }
                if(!empty($settings['buttonIcon'])){
                    $output .= self::render_icon($settings['buttonIcon']);
                }
                $output .= "</a>"; //buttons 

            }
            $output .= "</div>";//content
            return $output;

        }
    }
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
    public function get_category_query($settings){
        $parent = '';
        $include = '';
        $child_of = '';
        $filterby = $settings['filterby'] ?? 'all';
        if(!empty($filterby)){

            switch ($filterby){
                case 'all' :
                   $parent = '';
                    break;
                case 'by_parent' :
                    $child_of = !empty($settings['parent']) ? $settings['parent'] : '';
                    break;
                case 'by_id' :
                    $include = !empty($settings['include']) ? implode( ',', $settings['include'] ) : '';
                    break;
                case 'current_cat' :
                    $parent = get_queried_object_id();
                    break;
            }
        }
        if(isset($settings['onlyParentCat']) && $settings['onlyParentCat'] === true){
            $parent = 0;
        }
        $orderby = !empty($settings['orderby']) ? $settings['orderby'] : 'name';
        $order = !empty($settings['order']) ? $settings['order'] : 'DESC';
        $exclude = !empty($settings['exclude']) ? $settings['exclude'] : '';
        $number = !empty($settings['categoryCount']) ? $settings['categoryCount'] : '';
        $args = [
            'taxonomy'      => 'product_cat',
            'parent'        => $parent,
            'child_of'      => $child_of,
            'include'       => $include,
            'exclude'       => $exclude,
            'number'        => $number,
            'orderby'       => $orderby,
            'order'         => $order,
            'hide_empty'    => isset($settings['hide_empty']) ? true : false,
        ];
        if(isset($settings['exclude_child'])){
            $args['exclude']    = '';
            $args['exclude_tree'] = $exclude;
        }
        $categories = get_terms($args);
        return $categories;
    }
    public function get_category_name(){
        $terms = get_terms(array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
        ) );

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $cat=[];

            foreach($terms as $key => $term){
                $name = $term->name;
                $catslug = $term->term_id;
                $cat[$catslug] = $name;           
            }

            return $cat;
        } 
    }
    public function get_slider_options($idclass){
        $settings = $this->settings;
        $effect = isset( $settings['effect'] ) ? $settings['effect'] : 'slide';
        $options =[
            'effect'            => $effect,
            'sliderPerView'     => isset($settings['slidesToShow']) ? intval($settings['slidesToShow']) : 1,
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
                'el'  => '.'.$idclass.'.bultr-woo-cat-wrapper .pagination.swiper-pagination',
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
            $defaultPerPage   = isset($settings['slidesToShow']) ? (int)$settings['slidesToShow'] : 3;
            $defaultPerGroup  = isset($settings['slidesToScroll']) ? (int)$settings['slidesToScroll'] : 1;
            $defaultGap       = isset($settings['gutter']) ? (int)$settings['gutter'] : 10;

        }
        else{

            $defaultPerPage   = isset($settings['slidesToShow:'.$baseDevice]) ? (int)$settings['slidesToShow:' .$baseDevice] : $defaultPerPage;
            $defaultPerGroup  = isset($settings['slidesToScroll:'.$baseDevice]) ? (int)$settings['slidesToScroll:'.$baseDevice] : $defaultPerGroup;
            $defaultGap       = isset($settings['gutter:' .$baseDevice]) ? (int)$settings['gutter:'.$baseDevice] : $defaultGap;
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
                if($breakpoints_data[$i]['key'] != $smallestDevice){
                    $breakpoint_option['breakpoints'][$breakpoints_data[$i]['width']] = 
                    [
                        'slidesPerView' => isset($settings['slidesToShow:'. $breakpoints_data[ $i ]['key']] ) ? (int)$settings['slidesToShow:'. $breakpoints_data[ $i ]['key']]  : $defaultPerPage,
                        'slidesPerGroup' => isset($settings['slidesToScroll:'. $breakpoints_data[ $i ]['key']] ) ? (int)$settings['slidesToScroll:'. $breakpoints_data[ $i ]['key']]  : $defaultPerGroup,
                        'spaceBetween'  => isset($settings['gutter:'. $breakpoints_data[ $i ]['key']] ) ? (int)$settings['gutter:'. $breakpoints_data[ $i ]['key']]  : $defaultGap,
                        'deviceLabel'   => $breakpoints_data[ $i ]['key'],
                    ];
                }
                else{
                    $breakpoint_option['breakpoints'][$breakpoints_data[$i]['width']] = 
                    [
                        'slidesPerView' => isset($settings['slidesToShow:'. $breakpoints_data[ $i ]['key']] ) ? (int)$settings['slidesToShow:'. $breakpoints_data[ $i ]['key']]  : 1,
                        'slidesPerGroup' => isset($settings['slidesToScroll:'. $breakpoints_data[ $i ]['key']] ) ? (int)$settings['slidesToScroll:'. $breakpoints_data[ $i ]['key']]  : 1,
                        'spaceBetween'  => isset($settings['gutter:'. $breakpoints_data[ $i ]['key']] ) ? (int)$settings['gutter:'. $breakpoints_data[ $i ]['key']]  : $defaultGap,
                        'deviceLabel'   => $breakpoints_data[ $i ]['key'],
                    ];
                }
                
            }

        }
        $breakData = $breakpoint_option['breakpoints'];
        return $breakData;
	}
}
?>

