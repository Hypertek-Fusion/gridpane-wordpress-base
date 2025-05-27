<?php

namespace BricksUltra\includes\Instagramfeed;

use Automattic\WooCommerce\Blocks\BlockTypes\EmptyCartBlock;
use Bricks\Element;
use WP_Error;
use Bricks\Setup;
use BricksUltra\includes\Lightgallery_helper;
use BricksUltra\includes\Swiper_helper;

class Module extends Element
{
    public $category     = 'ultra';
    public $name         = 'wpvbu-instagram-feed';
    public $icon         = 'fab fa-instagram';
    public $css_selector = '';
    public $scripts      = ['bu_instagram_feed'];

    public function get_label()
    {
        return esc_html__('Instagram Feed', 'wpv-bu');
    }
    public function get_keywords()
    {
        return ['insta', 'instagram feed', 'instagram', 'feed', 'gallery', 'images'];
    }

    public function enqueue_scripts(){

        wp_enqueue_style( 'bricks-animate');
        wp_enqueue_style('bultr-module-style');
        wp_enqueue_script('bultr-module-script');
        wp_enqueue_script('jquery');
        if(!wp_style_is('bricks-font-awesome','enqueued')){
            wp_enqueue_style( 'bricks-font-awesome', BRICKS_URL_ASSETS . 'css/libs/font-awesome.min.css', [ 'bricks-frontend' ], filemtime( BRICKS_PATH_ASSETS . 'css/libs/font-awesome.min.css' ) );

        }

        $lightbox = isset($this->settings['lightbox_link']) ? true : false;

        if($lightbox === true){
            wp_enqueue_script( 'bultr-lightgallery-script');
            wp_enqueue_script( 'bu-lg-video-js');
            wp_enqueue_script( 'bu-lg-fullscreen-js');
            wp_enqueue_script( 'bu-lg-hash-js');
            wp_enqueue_script( 'bu-lg-share-js');
            wp_enqueue_script( 'bu-lg-zoom-js');
            wp_enqueue_script( 'bu-lg-rotate-js');
            wp_enqueue_script( 'bu-lg-thumbnail-js');
            wp_enqueue_style('bultr-lightgallery-style');
        }
       

        $layout = $this->settings['layout'] ?? 'grid';
        if ( $layout === 'carousel' ) {
            wp_enqueue_script( 'bricks-swiper' );
		    wp_enqueue_style( 'bricks-swiper' );
		}
        

    }

    public function set_control_groups(){
        $this->control_groups['insta_profile_settings'] = [
			'title' => esc_html__( 'Profile', 'wpv-bu' ),
			'tab'   => 'content',
		];
        $this->control_groups['insta_layout'] = [
			'title' => esc_html__( 'Layout', 'wpv-bu' ),
			'tab'   => 'content',
		];
        $this->control_groups['insta_profile_link'] = [
			'title' => esc_html__( 'Profile Link', 'wpv-bu' ),
			'tab'   => 'content',
            'required' => ['insta_prf_link', '=', true],
		];
        $this->control_groups['insta_flex_layout'] = [
			'title' => esc_html__( 'Flex Settings', 'wpv-bu' ),
			'tab'   => 'content',
            'required' => ['layout', '=', 'flex'],
		];
        $this->control_groups['insta_carousel_layout'] = [
			'title' => esc_html__( 'Carousel Settings', 'wpv-bu' ),
			'tab'   => 'content',
            'required' => ['layout', '=', 'carousel'],
		];
        
        $this->control_groups['insta_lightgallery'] = [
			'title' => esc_html__( 'Lightbox Settings', 'wpv-bu' ),
			'tab'   => 'content',
            'required' => ['lightbox_link', '=', true],
            
		];
        $this->control_groups['insta_profile_style'] = [
			'title' => esc_html__( 'Profile Style', 'wpv-bu' ),
			'tab'   => 'content',
            'required' => ['insta_prf_link', '=', true],
		];
        $this->control_groups['insta_image_style'] = [
			'title' => esc_html__( 'Image Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
        $this->control_groups['insta_caption_style'] = [
			'title' => esc_html__( 'Caption Style', 'wpv-bu' ),
			'tab'   => 'content',
            'required' => ['show_caption', '=', true],
		];
        $this->control_groups['insta_carousel_style'] = [
			'title' => esc_html__( 'Carousel Style', 'wpv-bu' ),
			'tab'   => 'content',
            'required' => ['layout', '=', 'carousel'],
		];
    }
    public function set_controls(){
        $this->controls['apply'] = [
            'type' => 'info',
            'class' => 'bult-info',
            'content' => __("<button class ='bultr-refresh-cache-btn'>Refresh Cache</button>", 'wpv-bu'),

          ];
        $this->controls['insta_token']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_settings',
			'label'     => __( 'Token', 'wpv-bu' ),
			'type'      => 'textarea',
            'rows'      => 3,
            'rerender'  => true,
        ];
        $this->controls['post_count']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_settings',
			'label'     => __( 'Post Count', 'wpv-bu' ),
			'type'      => 'number',
            'default'   => 6,
            'min'       => 1,
            'max'       => 50,
            'step'      => '1',
            'unit'      => false,

        ];
        $this->controls['insta_image']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_settings',
			'label'     => __( 'Image', 'wpv-bu' ),
			'type'      => 'checkbox',
            'default'   => true,
        ];
        $this->controls['insta_video']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_settings',
			'label'     => __( 'Video', 'wpv-bu' ),
			'type'      => 'checkbox',
            'default'   => true,
        ];
        $this->controls['insta_carousel']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_settings',
			'label'     => __( 'Album', 'wpv-bu' ),
			'type'      => 'checkbox',
            'default'   => true,
        ];
        $this->controls['insta_prf_link']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_settings',
			'label'     => __( 'Profile Link', 'wpv-bu' ),
			'type'      => 'checkbox',
            'default'   => true,
        ];
        $this->controls['cache_timeout']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_settings',
			'label'     => __( 'Cache Timeout', 'wpv-bu' ),
			'type'      => 'select',
            'options'   => [
                'none'  => esc_html__( 'None', 'wpv-bu' ),
                'minute'=> esc_html__( 'Minute', 'wpv-bu' ),
                'hour'  => esc_html__( 'Hour', 'wpv-bu' ),
                'day'   => esc_html__( 'Day', 'wpv-bu' ),
                'week'  => esc_html__( 'Week', 'wpv-bu' ),
            ],
            'default'   => 'hour',
            'inline'    => true,
            'small'     => true,
        ];
        $this->get_insta_layout_controls();
        $this->get_profile_link_controls();
        $this->get_flex_layout_controls();
        $this->get_lightbox_controls();
        $this->get_insta_swiper_controls();
        $this->get_insta_profile_style();
        $this->get_insta_image_style();
        $this->get_insta_caption_style();
        // $this->get_load_more_controls();
    }
    public function get_insta_layout_controls(){
        $this->controls['layout']=[
            'tab'       => 'content',
			'group'     => 'insta_layout',
			'label'     => __( 'Layout', 'wpv-bu' ),
			'type'      => 'select',
            'options'   => [
                'grid'      => esc_html__( 'Grid', 'wpv-bu' ),
                'flex'      => esc_html__( 'Flex', 'wpv-bu' ),
                'masonry'   => esc_html__( 'Masonry', 'wpv-bu' ),
                'carousel'  => esc_html__( 'Carousel', 'wpv-bu' ),
            ],
            'default'   => 'masonry',
            'inline'    => true,
            'small'     => true,
        ];
        $this->controls['columns'] =[
            'tab'       => 'content',
			'group'     => 'insta_layout',
			'label'     => __( 'Columns', 'wpv-bu' ),
			'type'      => 'number',
            'units'     => false,
            'step'      => '1',
            'default'   =>  3,
            'css'       =>[
                [
                    'selector' => '',
                    'property' => '--bu-insta-columns',
                    'value'     => '%s',
                ],
            ],
            'rerender' => true,
            'required'  => ['layout', '=', ['grid', 'masonry']],
        ];
        $this->controls['column_gap'] =[
            'tab'       => 'content',
			'group'     => 'insta_layout',
			'label'     => __( 'Column Gap', 'wpv-bu' ),
			'type'      => 'number',
            'unit'      => 'px',
            'step'      => '1',
            'min'       => '0',
            'css'       =>[
                [
                    'property' => 'column-gap',
                    'selector' => '.bultr-insta-layout-grid .bultr-insta-collection',
                ],
                [
                    'property' => 'column-gap',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-layout-masonry .bultr-insta-collection',
                ],
            ],
            'required'  => ['layout', '=', ['grid', 'masonry']],
        ];
        $this->controls['row_gap'] =[
            'tab'       => 'content',
			'group'     => 'insta_layout',
			'label'     => __( 'Row Gap', 'wpv-bu' ),
			'type'      => 'number',
            'unit'      => 'px',
            'step'      => '1',
            'min'       => '0',
            'css'       =>[
                [
                    'property' => 'row-gap',
                    'selector' => '.bultr-insta-layout-grid .bultr-insta-collection',
                ],
                [
                    'property' => 'row-gap',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-layout-masonry .bultr-insta-collection',
                ],
            ],
            'required'  => ['layout', '=', ['grid', 'masonry']],
        ];
        $this->controls['enable_ratio']=[
            'tab'       => 'content',
			'group'     => 'insta_layout',
			'label'     => __( 'Enable Image Ratio', 'wpv-bu' ),
			'type'      => 'checkbox',
            'required'  => ['layout','!=', 'masonry'],
        ];
        $this->controls['aspect_ratio']=[
            'tab'       => 'content',
			'group'     => 'insta_layout',
			'label'     => __( 'Image Ratio', 'wpv-bu' ),
			'type'      => 'select',
            'options'   => [
                '16/9'  => '16:9',
                '21/9'  => '21:9',
                '4/3'   => '4:3',
                '3/2'   => '3:2',
                '1/1'   => '1:1',
                '9/16'  => '9:16',
            ],
            'css'       =>[
                [
                    'property'  => 'aspect-ratio',
                    'selector'  => '&.bultr-insta-feed-wrapper:not(:has(.bultr-insta-layout-masonry)) .bultr-insta-img-ratio.bultr-insta-collection .bultr-insta-items .bultr-insta-img'
                ],
               
                
            ],  
            'default' => '16/9',
            'inline' => true,
            'small' => true,
            'required' => [['enable_ratio', '=', true ],['layout','!=', 'masonry'],],
        ];
        $this->controls['show_caption']=[
            'tab'       => 'content',
			'group'     => 'insta_layout',
			'label'     => __( 'Show Caption', 'wpv-bu' ),
			'type'      => 'checkbox',

        ];
        $this->controls['caption_size']=[
            'tab'       => 'content',
			'group'     => 'insta_layout',
			'label'     => __( 'Caption Length', 'wpv-bu' ),
			'type'      => 'number',
            'required'  => ['show_caption', '=', true],
        ];
        $this->controls['caption_style']=[
            'tab'       => 'content',
			'group'     => 'insta_layout',
			'label'     => __( 'Caption Style', 'wpv-bu' ),
			'type'      => 'select',
            'options'   => [
                'below'     => __('Below', 'wpv-bu'),
                'onhover'   => __('On Hover', 'wpv-bu'),
                'always'    => __('Always', 'wpv-bu'), 
            ],
            'default'   => 'below',
            'inline' => true,
            'small' => true,
            'required'  => ['show_caption', '=', true],
        ];
        $this->controls['caption_overlay']=[
            'tab'       => 'content',
			'group'     => 'insta_layout',
			'label'     => __( 'Caption Overlay Full', 'wpv-bu' ),
			'type'      => 'checkbox',
            'required'  => [['show_caption', '=', true],['caption_style', '!=', 'below']],
        ];
        $this->controls['insta_link']=[
            'tab'       => 'content',
			'group'     => 'insta_layout',
			'label'     => __( 'Enable Link', 'wpv-bu' ),
			'type'      => 'checkbox',

        ];
        $this->controls['lightbox_link']=[
            'tab'       => 'content',
			'group'     => 'insta_layout',
			'label'     => __( 'LightBox', 'wpv-bu' ),
			'type'      => 'checkbox',
            'required'  => ['insta_link', '=', true],
        ];
        $this->controls['insta_post_icon']=[
            'tab'       => 'content',
			'group'     => 'insta_layout',
			'label'     => __( 'Post Icon', 'wpv-bu' ),
			'type'      => 'checkbox',

        ];
        
    }
    public function get_profile_link_controls(){
        $this->controls['profile_position']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_link',
			'label'     => __( 'Position', 'wpv-bu' ),
			'type'      => 'select',
            'options'   => [
                'above'      => esc_html__( 'Above', 'wpv-bu' ),
                'below'      => esc_html__( 'Below', 'wpv-bu' ),
            ],
            'default'   => 'above',
            'inline'    => true,
            'small'     => true,
        ];
        $this->controls['profile_text']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_link',
			'label'     => __( 'Text', 'wpv-bu' ),
			'type'      => 'text',
            'default'   => esc_html__('Follow us on Instagram', 'wpv-bu'),
            'placeholder'   => esc_html__('Follow us on Instagram', 'wpv-bu'),
            'inline'    => true,

        ];
        $this->controls['profile_link']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_link',
			'label'     => __( 'Link', 'wpv-bu' ),
			'type'      => 'link',
            'inline'    => true,
        ];
        $this->controls['profile_icon']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_link',
			'label'     => __( 'Icon', 'wpv-bu' ),
			'type'      => 'icon',
            'default' => [
                'library' => 'fontawesome', 
                'icon' => 'fab fa-instagram',    
            ],
            'rerender' => true,
        ];
        $this->controls['profile_icon_pst']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_link',
			'label'     => __( 'Icon Position', 'wpv-bu' ),
			'type'      => 'select',
            'options'   => [
                'before'      => esc_html__( 'Before', 'wpv-bu' ),
                'after'      => esc_html__( 'After', 'wpv-bu' ),
            ],
            'inline'    => true,
            'small'     => true,
        ];
        
    }
    public function get_flex_layout_controls(){
        
        $this->controls['insta_flex_direction']=[
            'tab'       => 'content',
			'label'     => __( 'Direction', 'wpv-bu' ),
            'group'     => 'insta_flex_layout',

			'type'      => 'direction',
            'css'       => [
                [
                    'property' => 'flex-direction',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-layout-flex .bultr-insta-collection',
                ],
            ],
            'inline'   => true,
			'rerender' => true,
        ];
        
        $this->controls['flex_justify']=[
            'tab'       => 'content',
			'group'     => 'insta_flex_layout',
			'label'     => __( 'Justify Content', 'wpv-bu' ),
			'type'      => 'justify-content',
            'direction'  => 'row',
            'css'       => [
                [
                    'property' => 'justify-content',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-layout-flex .bultr-insta-collection',
                ],
            ],
            'required'  => ['insta_flex_direction', '=', ['row','row-reverse']],
        ];
        $this->controls['flex_align_items']=[
            'tab'       => 'content',
			'group'     => 'insta_flex_layout',
			'label'     => __( 'Align Items', 'wpv-bu' ),
			'type'      => 'align-items',
            'direction'  => 'row',
            'css'       => [
                [
                    'property' => 'align-items',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-layout-flex .bultr-insta-collection',
                ],
            ],
            'required'  => [['insta_flex_direction', '=',  ['row','row-reverse']],['enable_ratio','=',false]],

        ];
        $this->controls['flex_align_itemsc']=[
            'tab'       => 'content',
			'group'     => 'insta_flex_layout',
			'label'     => __( 'Align Items', 'wpv-bu' ),
			'type'      => 'align-items',
            'direction'  => 'column',
            'css'       => [
                [
                    'property' => 'align-items',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-layout-flex .bultr-insta-collection',
                ],
            ],
            'required'  => ['insta_flex_direction', '=',  ['column','column-reverse']],

        ];
        $this->controls['flex_gap']=[
            'tab'       => 'content',
			'group'     => 'insta_flex_layout',
			'label'     => __( 'Gap', 'wpv-bu' ),
			'type'      => 'number',
            'units'     => true,
            'css'       => [
                [
                    'property' => 'gap',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-layout-flex .bultr-insta-collection',
                ],
            ],
        ];
        $this->controls['flex_wrap']=[
            'tab'       => 'content',
			'group'     => 'insta_flex_layout',
			'label'     => __( 'Wrap', 'wpv-bu' ),
			'type'      => 'select',
            'options'   => [
                'nowrap' => __('No Wrap', 'wpv-bu'),
                'wrap'    => __('Wrap', 'wpv-bu'),
                'wrap-reverse' => __('Wrap Reverse', 'wpv-bu'),
            ],
            'css'       => [
                [
                    'property' => 'flex-wrap',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-layout-flex .bultr-insta-collection',
                ],
            ],
            'inline'    => true,
            'small'     => true,
        ];
        
    }
    public function get_lightbox_controls(){
        $lightgallery = new Lightgallery_helper();
        $lightgallery->add_lightgallery_controls($this,
            [
                'control_name'  => 'lightbox',
                'tab'           => 'content',
                'group'         =>  'insta_lightgallery',
                'required'      => [['lightbox_link', '=', true]],
            ]
        );
    }
    public function get_insta_swiper_controls(){
        $swiperControls = new Swiper_helper();
        $swiperControls->add_swiper_controls($this,
            [
                'control_name'  => 'insta_carousel',
                'tab'           => 'content',
                'group'         =>  'insta_carousel_layout',
                'required'      => [['layout', '=', 'carousel']],
                'default_slide_per_view' => 3,
            ]
        );
        $swiperControls->add_swiper_style_controls($this,
            [
                'control_name'  => 'insta_carousel',
                'tab'           => 'content',
                'wrapper-class'  => '.bultr-insta-feed-wrapper',
                'group'         =>  'insta_carousel_style',
                'required'      => [['layout', '=', 'carousel']],
            ]
        );
    }
    public function get_insta_profile_style(){
        $this->controls['profile_font']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_style',
			'label'     => __( 'Typography', 'wpv-bu' ),
			'type'      => 'typography',
            'css'       => [
                [
                    'property' => 'font',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-profile-link-wrap .bultr-insta-profile',
                ],
            ],
            'exclude'   => [
                'color',
                'text-align',
            ],
        ];
        $this->controls['profile_icon_size']=[
            'tab'       => 'content',
            'group'     => 'insta_profile_style',
            'label'     => __( 'Icon Size', 'wpv-bu' ),
            'type'      => 'number',
            'units'     => true,
            'css'       => [
                [
                    'property' => 'font-size',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-profile-link-wrap .bultr-insta-profile i',
                ],
                [
                    'property' => 'font-size',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-profile-link-wrap .bultr-insta-profile svg',
                ],
            ],
        ];

        $this->controls['profile_color']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_style',
			'label'     => __( 'Color', 'wpv-bu' ),
			'type'      => 'color',
            'css'       => [
                [
                    'property' => 'color',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-profile-link-wrap .bultr-insta-profile',
                ],
                [
                    'property' => 'color',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-profile-link-wrap .bultr-insta-profile i',
                ],
                [
                    'property' => 'fill',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-profile-link-wrap .bultr-insta-profile svg',
                ],
            ],
        ];
        $this->controls['profile_bgColor']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_style',
			'label'     => __( 'Background', 'wpv-bu' ),
			'type'      => 'background',
            'css'       => [
                [
                    'property' => 'background',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-profile-link-wrap .bultr-insta-profile',
                ],
            ],
        ];
        $this->controls['profile_border']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_style',
			'label'     => __( 'Border', 'wpv-bu' ),
			'type'      => 'border',
            'css'       => [
                [
                    'property' => 'border',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-profile-link-wrap .bultr-insta-profile',
                ],
            ],
        ];
        $this->controls['profile_boxshd']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_style',
			'label'     => __( 'Box Shadow', 'wpv-bu' ),
			'type'      => 'box-shadow',
            'css'       => [
                [
                    'property' => 'box-shadow',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-profile-link-wrap .bultr-insta-profile',
                ],
            ],
        ];
        $this->controls['profile_padding']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_style',
			'label'     => __( 'Padding', 'wpv-bu' ),
			'type'      => 'dimensions',
            'css'       => [
                [
                    'property' => 'padding',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-profile-link-wrap .bultr-insta-profile',
                ],
            ],
        ];
        $this->controls['profile_margin']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_style',
			'label'     => __( 'Margin', 'wpv-bu' ),
			'type'      => 'dimensions',
            'css'       => [
                [
                    'property' => 'margin',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-profile-link-wrap .bultr-insta-profile',
                ],
            ],
        ];
        $this->controls['profile_iconSpace']=[
            'tab'       => 'content',
			'group'     => 'insta_profile_style',
			'label'     => __( 'Icon Spacing', 'wpv-bu' ),
			'type'      => 'number',
            'units'     => true,
            'css'       => [
                [
                    'property' => 'gap',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-profile-link-wrap .bultr-insta-profile',
                ],
            ],
        ];
    }
    public function get_insta_image_style(){
        
        $this->controls['image_width']=[
            'tab'       => 'content',
			'group'     => 'insta_image_style',
			'label'     => __( 'Width', 'wpv-bu' ),
			'type'      => 'number',
            'units'     => true,
            'css'       => [
                [
                    'property' => 'width',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-layout-flex .bultr-insta-collection .bultr-insta-items',
                ],
            ],
            'required'  => ['layout', '=', 'flex'],
        ];
        $this->controls['image_bgColor']=[
            'tab'       => 'content',
			'group'     => 'insta_image_style',
			'label'     => __( 'Background', 'wpv-bu' ),
			'type'      => 'background',
            'css'       => [
                [
                    'property' => 'background',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-collection .bultr-insta-items',
                ],
            ],
        ];
        $this->controls['image_geryScale']=[
            'tab'       => 'content',
			'group'     => 'insta_image_style',
			'label'     => __( 'GrayScale Image', 'wpv-bu' ),
			'type'      => 'checkbox',
            
        ];
        $this->controls['image_hvrgeryScale']=[
            'tab'       => 'content',
			'group'     => 'insta_image_style',
			'label'     => __( 'Grayscale Image Onhover', 'wpv-bu' ),
			'type'      => 'checkbox',
            
        ];

        $this->controls['image_border']=[
            'tab'       => 'content',
			'group'     => 'insta_image_style',
			'label'     => __( 'Border', 'wpv-bu' ),
			'type'      => 'border',
            'css'       => [
                [
                    'property' => 'border',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-collection .bultr-insta-items',
                ],
            ],
        ];
        $this->controls['image-boxShd']=[
            'tab'       => 'content',
			'group'     => 'insta_image_style',
			'label'     => __( 'Box Shadow', 'wpv-bu' ),
			'type'      => 'box-shadow',
            'css'       => [
                [
                    'property' => 'box-shadow',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-collection .bultr-insta-items',
                ],
            ],
        ];
        $this->controls['image_padding']=[
            'tab'       => 'content',
			'group'     => 'insta_image_style',
			'label'     => __( 'Padding', 'wpv-bu' ),
			'type'      => 'dimensions',
            'css'       => [
                [
                    'property' => 'padding',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-collection .bultr-insta-items',
                ],
            ],
        ];
        $this->controls['image_postIcon']=[
            'tab'       => 'content',
			'group'     => 'insta_image_style',
			'label'     => __( 'Icon Color', 'wpv-bu' ),
			'type'      => 'color',
            'css'       => [
                [
                    'property' => 'color',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-collection .bultr-insta-items .bultr-insta-feed-icon i',
                ],
            ],
        ];
        
    }
    public function get_insta_caption_style(){
        $this->controls['caption_color']=[
            'tab'       => 'content',
			'group'     => 'insta_caption_style',
			'label'     => __( 'Color', 'wpv-bu' ),
			'type'      => 'color',
            'css'       => [
                [
                    'property' => 'color',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-items .bultr-insta-caption',
                ],
            ],
        ];
        $this->controls['caption_bgColor']=[
            'tab'       => 'content',
			'group'     => 'insta_caption_style',
			'label'     => __( 'Background', 'wpv-bu' ),
			'type'      => 'background',
            'css'       => [
                [
                    'property' => 'background',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-items .bultr-insta-caption',
                ],
            ],
        ];
        $this->controls['caption_font']=[
            'tab'       => 'content',
			'group'     => 'insta_caption_style',
			'label'     => __( 'Typography', 'wpv-bu' ),
			'type'      => 'typography',
            'css'       => [
                [
                    'property' => 'font',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-items .bultr-insta-caption',
                ],
            ],
            'exclude'   => [
                'color',
                'text-align',
            ],
        ];
        $this->controls['caption_padding']=[
            'tab'       => 'content',
			'group'     => 'insta_caption_style',
			'label'     => __( 'Padding', 'wpv-bu' ),
			'type'      => 'dimensions',
            'css'       => [
                [
                    'property' => 'padding',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-items .bultr-insta-caption',
                ],
            ],
        ];
        $this->controls['caption_hAlgin']=[
            'tab'       => 'content',
			'group'     => 'insta_caption_style',
			'label'     => __( 'Horizontal Alignment', 'wpv-bu' ),
			'type'      => 'align-items',
            'css'       => [
                [
                    'property' => 'align-items',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-items .bultr-insta-caption',
                ],
            ],

        ];
        $this->controls['caption_vAlgin']=[
            'tab'       => 'content',
			'group'     => 'insta_caption_style',
			'label'     => __( 'Vertical Alignment', 'wpv-bu' ),
			'type'      => 'justify-content',
            'css'       => [
                [
                    'property' => 'justify-content',
                    'selector' => '&.bultr-insta-feed-wrapper .bultr-insta-items .bultr-insta-caption',
                ],
            ],
            'required'  => ['caption_style', '!=', 'below'],
        ];
        $this->controls['caption_overlaysep']=[
            'tab'       => 'content',
			'group'     => 'insta_caption_style',
			'label'     => __( 'Overlay', 'wpv-bu' ),
            'type'        => 'separator',
        ];
        $this->controls['caption_animation'] = [
            'tab'       => 'content',
			'group'     => 'insta_caption_style',
			'label'     => __( 'Entrance Animation', 'wpv-bu' ),
            'type'        => 'select',
            'options'     => Setup::get_control_options( 'animationTypes' ),
            'searchable'  => true,
            'inline'      => true,

            'placeholder' => esc_html__( 'None', 'wpv-bu' ),
        ];
        $this->controls['caption_animDuration'] = [
            'tab'       => 'content',
			'group'     => 'insta_caption_style',
			'label'     => __( 'Animation Duration', 'wpv-bu' ),
            'type'        => 'select',
            'options'     => [
                'slower'        => __('Slower', 'wpv-bu'),
                'slow'          => __('Slow','wpv-bu'),
                'normal'        => __('Normal','wpv-bu'),
                'fast'          => __('Fast','wpv-bu'),
                'faster'        => __('Faster','wpv-bu'),
            ],
            'inline'      => true,
            'required'    => ['caption_animation', '!=', 'none'],
            'placeholder' => esc_html__( 'Normal', 'wpv-bu' ),
        ];
    }
   


    // instagram api data generate
    private $bultr_insta_graph_api_url = 'https://graph.instagram.com/';

	private $bultr_media_endpoint = '/me/media';

    protected function get_bultr_instagram_token(){

		$token = isset($this->settings['insta_token']) ? $this->render_dynamic_data( $this->settings['insta_token']): '';
        if(empty($token)){
            
            return;
        }
       
		return $token;
	}
    protected function get_bultr_remote_response($insta_url){
        $response = wp_remote_get(
			$insta_url,
			array(
				'timeout'   => 60,
				'sslverify' => false,
			)
		);
        
        $response_code = wp_remote_retrieve_response_code( $response );
        $result = json_decode( wp_remote_retrieve_body( $response ), true );
        if($response_code !== 200){
            $message = isset($result['error']['message']) ? $result['error']['message'] : __( 'No posts found', 'wpv-bu' );
            return new WP_Error($response_code, $message);
        }
        return $result;


    }
    protected function get_bultr_insta_fetch_data(){
        

		$insta_url = $this->bultr_insta_graph_api_url.$this->bultr_media_endpoint;
        $token = $this->get_bultr_instagram_token();
		$insta_url = add_query_arg(
			array(
				'fields'       => 'id,media_type,media_url,thumbnail_url,permalink,caption,likes,username,children',
				'limit'        =>  50,
				'access_token' =>  $this->get_bultr_instagram_token(),
			),
			$insta_url
		);

		return $this->get_bultr_remote_response($insta_url);
	}
    protected function get_bultr_insta_fetch_data_by_id($id){
		$insta_url = $this->bultr_insta_graph_api_url.$id;
       
		$insta_url = add_query_arg(
			array(
				'fields'       => 'id,media_type,media_url,permalink,thumbnail_url',
				'access_token' =>  $this->get_bultr_instagram_token(),
			),
			$insta_url
		);
       
		return $this->get_bultr_remote_response($insta_url);
	}

   
    protected function get_bultr_cache_duration($settings){
        $cache_timeout = isset($settings['cache_timeout']) ? $settings['cache_timeout'] : 'hour';
        $expiration = 0;

        switch($cache_timeout){
            case 'minute':
				$expiration = MINUTE_IN_SECONDS;
				break;
			case 'hour':
				$expiration = HOUR_IN_SECONDS;
				break;
			case 'day':
				$expiration = DAY_IN_SECONDS;
				break;
			case 'week':
				$expiration = WEEK_IN_SECONDS;
				break;
			default:
				break;
        }
        return $expiration;

    }
    protected function check_bultr_insta_cache_data($settings){
        $token = isset($this->settings['insta_token']) ? $this->render_dynamic_data( $this->settings['insta_token']): '';

        $uniquekey = md5($token);
        $count = isset($settings['post_count']) ? $settings['post_count'] : '6';
        $cache_timeout = isset($settings['cache_timeout']) ? $settings['cache_timeout'] : 'hour';
        $caption_size = isset($settings['caption_size']) ? $settings['caption_size'] : '30';

        $transient_key = 'bultr_insta_fetched_data_'.$this->id.'_'.$count.'_'.$cache_timeout.'_'.$caption_size.'_'.$uniquekey;
        $data = get_transient($transient_key);
        if(is_wp_error($data)){
			delete_transient($transient_key);
			$data = [];
		}
        if ( ! empty( $data ) && $cache_timeout !== 'none' ) {
			return $data;
		}

        $data = $this->get_bultr_insta_fetch_data($settings);

        if ( is_wp_error( $data ) ) {
			return $data;
		}
        if ( empty( $data ) ) {
			return [];
		}

        set_transient( $transient_key, $data, $this->get_bultr_cache_duration($settings) );//set the transient 
        
        return $data;


    }
    protected function check_bultr_insta_cache_data_by_id($settings, $id){
        $count = isset($settings['post_count']) ? $settings['post_count'] : '6';
        $cache_timeout = isset($settings['cache_timeout']) ? $settings['cache_timeout'] : 'hour';
        $caption_size = isset($settings['caption_size']) ? $settings['caption_size'] : '30';

        $transient_key = 'bultr_insta_fetched_data_'.$id.'_'.$this->id.'_'.$count.'_'.$cache_timeout.'_'.$caption_size;
        $data = get_transient($transient_key);
        if(is_wp_error($data)){
			delete_transient($transient_key);
			$data = [];
		}
        if ( ! empty( $data ) && $cache_timeout !== 'none' ) {
			return $data;
		}

        $data = $this->get_bultr_insta_fetch_data_by_id($id);

        if ( is_wp_error( $data ) ) {
			return $data;
		}
        if ( empty( $data ) ) {
			return [];
		}

        set_transient( $transient_key, $data, $this->get_bultr_cache_duration($settings) );//set the transient 

        return $data;


    }
    protected function get_bultr_insta_posts($settings){
        $posts = $this->check_bultr_insta_cache_data($settings);
        
        if((is_wp_error($posts) || empty($posts))  && (bricks_is_builder() || bricks_is_builder_call())){
            $message = is_wp_error( $posts ) ? $posts->get_error_message() : esc_html__( 'No pppppPostskkk Found', 'wpv-bu' );
            
            $msg = wp_kses_post( $message );
            return $msg;
        }
        return $posts;
    }

    public function refresh_access_token(){

        $bultr_insta_updated_token = "bultr-insta-access-token-".$this->id;
        
        $updated = get_transient($bultr_insta_updated_token);
        
        if(!empty($updated)){
            return;
        }

        $update_url = 'https://graph.instagram.com/refresh_access_token';

        $access_token = $this->get_bultr_instagram_token();
        
        $endpoint_url = add_query_arg(
            [
                'access_token' => $access_token,
				'grant_type'   => 'ig_refresh_token',
            ],
            $update_url
        );
        $response = wp_remote_get( $endpoint_url );
        if(!$response || 200 !== wp_remote_retrieve_response_code( $response ) || is_wp_error( $response ) ){
			return;
        }
        $body = wp_remote_retrieve_body( $response );
	
		if ( ! $body ) {
			return;
		}
        $body = json_decode( $body, true );
		if ( empty( $body['access_token'] ) || empty( $body['expires_in'] ) ) {
			return;
		}
        set_transient($bultr_insta_updated_token,'updated', 30 * DAY_IN_SECONDS);
    }


    public function render(){
        $settings = $this->settings;
        $id = $this->id;

        if(isset($settings['insta_token']) && !empty($settings['insta_token'])){
            $this->refresh_access_token();
        }
        $swiper_control_name = 'insta_carousel'; 

        if(!isset($settings['insta_token']) && empty($settings['insta_token'])){
            return $this->render_element_placeholder(
				[
					'title' => esc_html__( 'Please Add Access Token.', 'wpv-bu' ),
				]
			);
        }
        $insta_data = $this->get_bultr_insta_posts($settings);

        $layout = isset($settings['layout']) ? $settings['layout'] : 'grid';

        if(isset($settings['enable_ratio'])){
            $aspect= '';
            switch($settings['aspect_ratio']){
                case '16/9' :
                    $aspect = '169';
                    break;
                case '21/9' :
                    $aspect = '219';
                    break;
                case '4/3' : 
                    $aspect = '43';
                    break;
                case '3/2' :
                    $aspect = '32';
                    break;
                case '1/1' :
                    $aspect = '11';
                    break;
                case '9/16' :
                    $aspect = '916';
                    break;
                default :
                    $aspect = '169';
                    break;

            };
            $aspect_ratio = 'bultr-aspect-'.$aspect;
        }

        //classes
        $insta_wrapper_classes = ['bultr-insta-feed-wrapper'];

        $insta_wrapper_classes[] = 'bultr-elementid-brxe-'.$id;

        $insta_wrapper_classes[] = isset($settings['profile_position']) ? "bultr-insta-profile-".$settings['profile_position'] : "bultr-insta-profile-below";
        
        $container_classes = ['bultr-insta-container'];

        $collection_class = ['bultr-insta-collection'];

        $insta_items_classes = ['bultr-insta-items'];

        
        if(isset($settings['enable_ratio'])){
            $container_classes[] = $aspect_ratio;

        }
        
        $container_classes[] = 'bultr-insta-layout-'.$layout;

        if($layout === 'carousel'){
            $swiperdata = esc_attr(wp_json_encode(Swiper_helper::get_swiper_data($settings, $swiper_control_name)));
            $container_classes[] = 'bultr-swiper-outer-wrapper';
            $container_classes[] = 'bultr-iscarousel';
            if(isset($settings['insta_carousel_swPosition']) && $settings['insta_carousel_swPosition'] === "inside" ){
                $container_classes[] = "bultr-swiper-nav-inside";
                $hpos = isset($settings['insta_carousel_swHrzPosition']) ? $settings['insta_carousel_swHrzPosition'] : 'center';
                $vpos = isset($settings['insta_carousel_swVrtPosition']) ? $settings['insta_carousel_swVrtPosition'] : 'center';

                $container_classes[] = "bultr-hpos-" .$hpos;
                $container_classes[] = "bultr-vpos-". $vpos;
            }
            else{
                $container_classes[] = "bultr-swiper-nav-outside";
            }
            //swiper data in container
            $this->set_attribute('collection', 'data-script-args', $swiperdata);
            //swiper class in collection div
            $collection_class[] = 'bultr-swiper-container';
            // swiper wrapper attributes
            $this->set_attribute('swiper-wrap', 'class', 'bultr-insta-posts  swiper-wrapper');
            //swiper items class
            $insta_items_classes[] = 'swiper-slide';



        }

        $collection_class[] = isset($settings['caption_style']) ? "bultr-insta-caption-".$settings['caption_style'] : '';
        $collection_class[] = isset($settings['enable_ratio']) ? "bultr-insta-img-ratio" : '';

        if(isset($settings['insta_link'])){
            if(isset($settings['lightbox_link'])){
                $controlName = 'lightbox';
                $this->set_attribute('collection', 'data-insta-lightgallery', json_encode(Lightgallery_helper::get_lightgallery_data($settings, $controlName)) );
                $collection_class[] = 'bultr-islightbox';
            }
        }


        
       

        $this->set_attribute('_root', 'class', $insta_wrapper_classes);
        $this->set_attribute('container', 'class', $container_classes);
        $this->set_attribute('collection', 'class', $collection_class);

        ?>
            <div <?php echo $this->render_attributes('_root');?>> 
                <?php
                        // instagram profile html
                        if(isset($settings['profile_position']) && $settings['profile_position'] === "above"){
                            $this->get_insta_profile_html($settings);

                        }
                ?>
                <div <?php echo $this->render_attributes('container');?>> 
                    <div <?php echo $this->render_attributes('collection');?>>
                        <?php
                            if($layout === 'carousel'){
                                ?>
                                    <div <?php echo $this->render_attributes('swiper-wrap');?>>
                                <?php
                            }
                        ?>
                                    <?php
                                        if(is_array($insta_data)){
                                            if( !is_wp_error( $insta_data ) && !empty( $insta_data) && count($insta_data) ){
                                                $post_count = 0;
                                                foreach($insta_data['data'] as $index => $insta_post){

                                                    //breaking loop when post_count == settings post count
                                                    $count = isset($settings['post_count']) ? $settings['post_count'] : 6;
                                                    if( $post_count == $count ){
                                                        break;
                                                    }

                                                    $insta_media_type = $insta_post['media_type'];
                                                    $insta_media_url = '';
                                                    switch( $insta_media_type ){
                                                        case 'IMAGE': 
                                                            if( isset($settings['insta_image']) === true ){
                                                                $insta_media_url = $insta_post['media_url'];
                                                            }
                                                            break;
                                                        case 'VIDEO': 
                                                            if( isset($settings['insta_video']) === true ){
                                                                $insta_media_url = $insta_post['thumbnail_url'];
                                                            }
                                                            break;
                                                        case 'CAROUSEL_ALBUM': 
                                                            if( isset($settings['insta_carousel']) === true ){
                                                                $insta_media_url = $insta_post['media_url'];
                                                            }
                                                            break;
                                                    }
                                                    if($insta_media_url == ''){
                                                        continue;
                                                    }
                                                    $this->set_attribute("insta_item-{$index}", 'class', $insta_items_classes);

                                                    
                                                ?>
                                                    <div <?php echo $this->render_attributes("insta_item-{$index}");?>>
                                                        <?php 
                                                            $link_html_tag = "div";
                                                            $this->set_attribute("insta_link-{$index}", 'class', 'bultr-insta-link');
                                                            
                                                            if(isset($settings['insta_link']) === true){ 
                                                                if(isset($settings['lightbox_link'])){
                                                                    $this->get_bultr_link_attribute($index, $insta_post);
                                                                    $link_html_tag = "div";
                                                                }
                                                                else{
                                                                    $this->set_attribute("insta_link-{$index}", 'href', $insta_post['permalink']);
                                                                    $this->set_attribute("insta_link-{$index}", 'target', "_blank");
                                                                    $link_html_tag = "a";

                                                                }
                                                            }
                                                            
                                                        ?>
                                                        <<?php echo esc_attr( $link_html_tag );?> <?php  echo wp_kses_post($this->render_attributes("insta_link-{$index}"));?>> <?php // link tag open?>
                                                            <?php 
                                                            
                                                                $this->set_attribute("insta_image-{$index}", 'src', $insta_media_url);
                                                                if(isset($settings['image_geryScale'])){
                                                                    $this->set_attribute("insta_image-{$index}", 'class', 'bultr-insta-image-grayscale');
                                                                }
                                                                if(isset($settings['image_hvrgeryScale'])){
                                                                    $this->set_attribute("insta_image-{$index}", 'class', 'bultr-insta-image-grayscalehvr');
                                                                }
                                                                $this->set_attribute("insta_image-{$index}", 'class', 'bultr-insta-img');
                                                            ?>
                                                            
                                                            <img <?php echo $this->render_attributes("insta_image-{$index}");?>>
                                                            <?php
                                                                //Insta Caption  on always and hover
                                                                if(isset($settings['caption_overlay'])){
                                                                    $this->get_insta_caption_html($settings, $insta_post, $index);

                                                                }

                                                                // Insta Caption Icon
                                                                if(isset($settings['insta_post_icon'])){
                                                                    $insta_icon = '';
                                                                    if( $insta_post['media_type'] === 'CAROUSEL_ALBUM' ) {
                                                                        $insta_icon = '<i class="fas fa-images"></i>';
                                                                    }else if( $insta_post['media_type'] === 'IMAGE' ){
                                                                        $insta_icon = '<i class="fas fa-image"></i>';
                                                                    }else if( $insta_post['media_type'] === 'VIDEO' ){
                                                                        $insta_icon = '<i class="fas fa-play"></i>';
                                                                    } 
                                                                    
                                                                    if(!empty($insta_icon)){
                                                                        ?>
                                                                        <span class = "bultr-insta-feed-icon"><?php echo $insta_icon; ?></span>
                                                                        <?php
                                                                    }
                                                                }

                                                                // CAROUSEL ALBUM
                                                                if($insta_post['media_type'] === 'CAROUSEL_ALBUM'  && $settings['insta_carousel'] === true){
                                                                    ?>
                                                                    <div class = "bultr-insta-album-children" >
                                                                        <?php
                                                                            if($insta_post['children']['data']){

                                                                                foreach($insta_post['children']['data'] as $key => $children){
                                                                                    if($key != 0 ){
                                                                                        $key = 'ch-'.rand(10,100).$key;
                                                                                        $insta_carousel_data = $this->check_bultr_insta_cache_data_by_id($settings, $children['id']);
                                                                                        $this->set_attribute("insta_link-{$key}", 'class', 'bultr-insta-link');

                                                                                        if( !is_wp_error( $insta_carousel_data ) && !empty( $insta_carousel_data) && count($insta_carousel_data) ){

                                                                                            if(!empty($insta_carousel_data['media_type'])){
                                                                                                $this->get_bultr_link_attribute($key, $insta_post, $insta_carousel_data, true);

                                                                                                if($insta_carousel_data['media_type'] === 'VIDEO'){
                                                                                                    $this->set_attribute("instaa_image-{$key}", 'src', $insta_carousel_data['thumbnail_url']);

                                                                                                }
                                                                                                else{
                                                                                                    $this->set_attribute("instaa_image-{$key}", 'src', $insta_carousel_data['media_url']);

                                                                                                }

                                                                                            }
                                                                                            ?>

                                                                                                    <div <?php echo $this->render_attributes("insta_link-{$key}"); ?>>
                                                                                                        <img <?php  echo $this->render_attributes("instaa_image-{$key}");?>>
                                                                                                    </div>

                                                                                            <?php

                                                                                        } 
                                                                                    }
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </div>
                                                                    <?php
                                                                }

                                                            ?>
                                                        </<?php echo esc_attr( $link_html_tag );?>> <?php // link tag close?>
                                                        <?php
                                                                //Insta Caption on below
                                                                if(!isset($settings['caption_overlay'])){
                                                                    $this->get_insta_caption_html($settings, $insta_post, $index);
                                                                }
                                                        ?>
                                                    </div> 
                                                    <?php
                    
                                                    $post_count = $post_count +1;
                                                }
                                            }
                                        }
                                        else{
                                            if(bricks_is_builder() || bricks_is_builder_call()){
                                                echo $insta_data; //error message no post found
                                            }
                                        }

                                    ?>
                        <?php

                            if($layout === 'carousel'){
                                if(!is_array($insta_data)){
                                    return;
                                }
                                if(is_array($insta_data) && count($insta_data['data']) > 1){
                                    // checking if loop count is greater than 1
                                ?>
                                        </div>
                                    <?php    
                                    //pagination 
                                    echo Swiper_helper::render_swiper_pagination($settings, $swiper_control_name);
                                    
                                    // scrollbar
                                    echo Swiper_helper::render_swiper_scrollbar($settings,$swiper_control_name);
                
                                    // navigation
                                    if(isset($settings['insta_carousel_swPosition']) && $settings['insta_carousel_swPosition'] === "inside" ){
                                        echo Swiper_helper::render_swiper_navigation($settings,$swiper_control_name);
                                    
                                    }
                                }
                            }
                        ?>

                    </div>
                    <?php
                        if($layout === "carousel"){
                            if(count($insta_data['data']) > 1){
                                if(isset($settings['insta_carousel_swPosition']) && $settings['insta_carousel_swPosition'] === "outside" ){
                                    echo Swiper_helper::render_swiper_navigation($settings,$swiper_control_name);
                                
                                }
                            }
                        }
                    ?>
                </div>
                <?php
                        // instagram profile html
                        if(isset($settings['profile_position']) && $settings['profile_position'] === "below"){
                            $this->get_insta_profile_html($settings);

                        }
                ?>
            </div>
        <?php
        
    }

    // caption html
    public function get_insta_caption_html($settings, $insta_post, $index){
        $caption_text = !empty($insta_post['caption'])? $insta_post['caption'] : '';
        $caption_size = !empty($settings['caption_size']) ? $settings['caption_size'] : 30;
        if(trim($caption_text) !== ""){
            if(isset($settings['show_caption'])){
                $this->set_attribute("insta_caption-{$index}",'class', 'bultr-insta-caption');
                if( isset($settings['caption_overlay']) === true ){
					$this->set_attribute( "insta_caption-{$index}", 'class', 'caption-overlay-full' );
				}
                if(isset($settings['caption_animation'])){
                    $this->set_attribute( "insta_caption-{$index}", 'class', 'brx-animated' );
                    $this->set_attribute( "insta_caption-{$index}", 'class', 'brx-animate-'. $settings['caption_animation']);
                    if(isset($settings['caption_animDuration']) && $settings['caption_animDuration'] != 'normal'){
                        $this->set_attribute( "insta_caption-{$index}", 'class', 'brx-animate-'.$settings['caption_animDuration'] );

                    }

                }
                ?>
                <div <?php echo $this->render_attributes("insta_caption-{$index}");?>>
                    <?php echo wp_html_excerpt( $caption_text, $caption_size, '...' ); ?>
                </div>
                <?php
            }
        }

    }
    //  Profile Html
    public function get_insta_profile_html($settings){
        if(isset($settings['insta_prf_link'])){
            $profile_classes = ['bultr-profile-link-wrap'];
            $profile_classes[] = isset($settings['profile_icon_pst']) ? "bultr-insta-icon-pst-".$settings['profile_icon_pst'] : "bultr-insta-icon-pst-before";

            $this->set_attribute('insta_profile', 'class', $profile_classes);
            ?>
                <div <?php echo $this->render_attributes('insta_profile');?>>
                    <?php
                        if(isset($settings['profile_link'])){
                            $this->set_link_attributes( 'profile_link', $settings['profile_link'] );
                        }
                        ?>
                        <a <?php echo $this->render_attributes( 'profile_link' ); ?>>
                            <span class = "bultr-insta-profile">

                                <?php 
                                    
                                    $icon = ! empty( $settings['profile_icon'] ) ? self::render_icon( $settings['profile_icon'], '' ) : false ;
                                    
                                ?>
                                    <span class = "bultr-insta-profile-icon">
                                        <?php echo $icon; ?>
                                    </span>
                                <?php
                                    $profile_text = !empty( $settings['profile_text'] ) ? $settings['profile_text'] : esc_html__('Follow us on Instagram', 'wpv-bu');
                                    echo esc_attr($profile_text);
                                ?>
                            </span>
                        </a>
                        <?php
                    ?>
                </div>
            <?php
        }

    }

    //link attributes 
    public function get_bultr_link_attribute($key, $insta_post, $insta_carousel_data = [], $is_carousel_media = false){
        $caption = $insta_post['caption'];
		if($is_carousel_media){
			$insta_post = $insta_carousel_data;
		}
        
        if($insta_post['media_type'] === 'VIDEO'){
            
            $data_video = '{"source": [{"src":"' . $insta_post['media_url'] .'", "type":"video/mp4"}], "attributes": {"preload": false, "controls": true}}';
            $this->set_attribute("insta_link-{$key}", 'title', $caption);
            $this->set_attribute("insta_link-{$key}", 'data-facebook-share-url', $insta_post['permalink']);
            $this->set_attribute("insta_link-{$key}", 'data-twitter-share-url', $insta_post['permalink']);
            $this->set_attribute("insta_link-{$key}", 'data-pinterest-share-url', $insta_post['permalink']);
            $this->set_attribute("insta_link-{$key}", 'data-tweet-text', $this->convertAll($caption));
            $this->set_attribute("insta_link-{$key}", 'data-pinterest-text', $this->convertAll($caption));
            $this->set_attribute("insta_link-{$key}", 'data-src', '');
            $this->set_attribute("insta_link-{$key}", 'data-download-url', "false");
            $this->set_attribute("insta_link-{$key}", 'data-video', $data_video);
			
		}
        else{
            $this->set_attribute("insta_link-{$key}", 'title', $caption);
            $this->set_attribute("insta_link-{$key}", 'data-facebook-share-url', $insta_post['permalink']);
            $this->set_attribute("insta_link-{$key}", 'data-twitter-share-url', $insta_post['permalink']);
            $this->set_attribute("insta_link-{$key}", 'data-pinterest-share-url', $insta_post['permalink']);
            $this->set_attribute("insta_link-{$key}", 'data-tweet-text', $this->convertAll($caption));
            $this->set_attribute("insta_link-{$key}", 'data-pinterest-text', $this->convertAll($caption));
            $this->set_attribute("insta_link-{$key}", 'data-src', $insta_post['media_url']);
            $this->set_attribute("insta_link-{$key}", 'data-download-url', "");
            $this->set_attribute("insta_link-{$key}", 'data-video', "");
        }
    }
    public function convertAll($str) {
		$regex = "/[@#](\w+)/";
		//type and links
		$hrefs = [
			'#' => '%23',
			'@' => '%40'
		];

		$result = preg_replace_callback($regex, function($matches) use ($hrefs) {
			return sprintf(
				'%s%s',
				$hrefs[$matches[0][0]],
				$matches[1], 
				$matches[0]
			);
		}, $str);

		return($result);
	}

    

    
}
?>
