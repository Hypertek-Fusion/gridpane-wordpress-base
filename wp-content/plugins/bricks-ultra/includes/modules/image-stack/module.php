<?php

namespace BricksUltra\includes\ImageStack;

use Bricks\Element;

class Module extends Element {

	public $category       = 'ultra';
	public $name           = 'wpvbu-image-stack';
	public $icon           = 'ion-md-images';
	public $css_selector   = '';
	public $scripts        = [ 'buImageStack' ];
	public $loop_index     = 0;

	
	public function get_label() {
		return esc_html__( 'Image Stack', 'wpv-bu' );
	}

    public function get_keywords()
    {
        return ['image-stack', 'gallery', 'images', 'stack', 'photo-stack'];
    }

    public function enqueue_scripts(){
        wp_enqueue_style('bultr-module-style');
        wp_enqueue_script('bultr-module-script');
        wp_enqueue_script('bultr-ihp', WPV_BU_URL . 'assets/vendor/tippy/popper.js', [], WPV_BU_VERSION, true);
        wp_enqueue_script('bultr-iht', WPV_BU_URL . 'assets/vendor/tippy/tippy.js', [], WPV_BU_VERSION, true);
        wp_enqueue_script('bultr-lottie', WPV_BU_URL . 'assets/vendor/lottie/lottie.min.js', [], WPV_BU_VERSION, true);

        $lightbox = isset($this->settings['lightbox']) ? true : false;

        if($lightbox === true){
            wp_enqueue_script( 'bultr-lightgallery-script');
            wp_enqueue_script( 'bu-lg-fullscreen-js');
            wp_enqueue_script( 'bu-lg-hash-js');
            wp_enqueue_script( 'bu-lg-share-js');
            wp_enqueue_script( 'bu-lg-zoom-js');
            wp_enqueue_script( 'bu-lg-rotate-js');
            wp_enqueue_style('bultr-lightgallery-style');
        }
    }
    public function set_control_groups()
    {
        $this->control_groups['image_content'] = [
			'title' => esc_html__( 'Content', 'wpv-bu' ),
			'tab'   => 'content',
		];
        $this->control_groups['stack_styling'] = [
			'title' => esc_html__( 'Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
        $this->control_groups['tooltip_styling'] = [
			'title' => esc_html__( 'Tooltip Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
    }
    public function set_controls(){
        $this->controls['source'] =[
            'tab'       => 'content',
			'group'     => 'image_content',
			'label'     => __( 'Source', 'wpv-bu' ),
            'type'      => 'select',
            'options'   => [
                'single'    => __('Media Gallery', 'wpv-bu'),
                'repeater'  => __('Repeater', 'wpv-bu'),
            ],
            'default'   => 'single',
            'inline'    => true,
        ];
        $this->get_single_controls();
        $this->get_repeater_controls();
        $this->get_stack_styling_controls();
        $this->get_tooltip_styling_controls();
    }
    public function get_single_controls(){
        $this->controls['image-gallery'] =[
            'tab'       => 'content',
			'group'     => 'image_content',
			'label'     => __( 'Images', 'wpv-bu' ),
            'type'      => 'image-gallery',
            'required'  => ['source','=', 'single'],
        ];
        $this->controls['single_link'] =[
            'tab'       => 'content',
			'group'     => 'image_content',
			'label'     => __( 'Link', 'wpv-bu' ),
            'type'      => 'select',
            'options'   => [
                'none'      => __('None', 'wpv-bu'),
                'mediafile' => __('Media File', 'wpv-bu'),
                'custom'    => __('Custom URL', 'wpv-bu'),    
            ],
            'rerender'  => true,
            'required'  => ['source','=', 'single'],
        ];
        
        $this->controls['lightbox'] =[
            'tab'       => 'content',
			'group'     => 'image_content',
			'label'     => __( 'Lightbox', 'wpv-bu' ),
            'type'      => 'checkbox',
            'rerender'  => true,
            'required'  => [
                ['source','=', 'single'],
                ['single_link', '=', 'mediafile']
            ],
        ];
        $this->controls['custom_url'] =[
            'tab'       => 'content',
			'group'     => 'image_content',
			'label'     => __( 'Custom URL', 'wpv-bu' ),
            'type'      => 'text',
            'required'  => [
                ['source','=', 'single'],
                ['single_link', '=', 'custom']
            ],
        ];
        $this->controls['single_tooltip'] =[
            'tab'       => 'content',
			'group'     => 'image_content',
			'label'     => __( 'Tooltip', 'wpv-bu' ),
            'type'      => 'select',
            'options'   => [
                'none'      => __('None', 'wpv-bu'),
                'title'     => __('Title', 'wpv-bu'),
                'caption'   => __('Caption', 'wpv-bu'),
                'custom'    => __('Custom', 'wpv-bu'),    
            ],
            'default'   => 'none',
            'required'  => ['source','=', 'single'],
        ];
        $this->controls['tooltip_custm'] =[
            'tab'       => 'content',
			'group'     => 'image_content',
			'label'     => __( 'Custom Tooltip Text', 'wpv-bu' ),
            'type'      => 'text',
            'default'   => __('Add Your Tooltip Text Here.','wpv-bu'),
            'placeholder'   => __('Add Your Tooltip Text Here.','wpv-bu'),
            'required'  => [['source','=', 'single'],['single_tooltip','=','custom']]
        ];
        $this->controls['tooltip_position'] =[
            'tab'       => 'content',
			'group'     => 'image_content',
			'label'     => __( 'Tooltip Position', 'wpv-bu' ),
            'type'      => 'select',
            'options'   => [
                'left'  => __('Left', 'wpv-bu'),
                'top'    => __('Top', 'wpv-bu'),
                'bottom'  => __('Bottom', 'wpv-bu'),
                'right' => __('Right', 'wpv-bu'),
            ],
            'required'  => [['source','=', 'single'],['single_tooltip','!=','none']]
        ];
    }
    public function get_repeater_controls(){
        $this->controls['repeater_elements'] =[
            'tab'       => 'content',
			'group'     => 'image_content',
			'label'     => __( 'Items', 'wpv-bu' ),
            'type'      =>'repeater',
            'fields' => [
                'title'     => [
                    'label'     => esc_html__( 'Title', 'wpv-bu' ),
                    'type'      => 'text',
                ],
                'type'      => [
                    'label'     => esc_html__( 'Type', 'wpv-bu' ),
                    'type'      => 'select',
                    'options'   => [
                        'icon'  => __('Icon','wpv-bu'),
                        'image' => __('Image','wpv-bu'),
                        'text'  => __('Text','wpv-bu'),
                        'lottie' => __('Lottie','wpv-bu'),
                    ],
                    'inline'    => true,
                ],
                'icon'      => [
                    'label'     =>  esc_html__( 'Icon', 'wpv-bu' ),
                    'type'      => 'icon',
                    // 'default'   => [
                    //     'library'   => 'themify', 
                    //     'icon'      => 'ti-star',
                    // ],
                    'required'  => ['type', '=', 'icon'],
                ],
                'image'     => [
                    'label'     =>  esc_html__( 'Image', 'wpv-bu' ),
                    'type'      => 'image',
                    'required'  => ['type', '=', 'image'],
                ],
                'text'      => [
                    'label'     =>  esc_html__( 'Text', 'wpv-bu' ),
                    'type'      => 'text',
                    'required'  => ['type', '=', 'text'],
                ],
                'lottie_type' => [
                    'label'     => esc_html__( 'Source', 'wpv-bu' ),
                    'type'      => 'select',
                    'options'   => [
                        'media' => __('Medial File','wpv-bu'),
                        'external'  => __('External URL','wpv-bu'),
                    ],
                    'inline'    => true,
                    'required' => ['type', '=', 'lottie'],
                ],
                'lottie_media' => [
                    'label'     => esc_html__( 'Upload JSON File', 'wpv-bu' ),
                    'type'      => 'file',
                    'pasteStyles' => false,
                    'required'  => [
                        ['type', '=', 'lottie'],
                        ['lottie_type', '=', 'media'],
                    ],

                ],
                'lottie_url' => [
                    'label'     => esc_html__( 'Lottie JSON URL', 'wpv-bu' ),
                    'type'      => 'text',
                    'description' => __("Get JSON code URL from <a href = 'https://lottiefiles.com/' target='_blank'>here</a>.", 'wpv-bu'),
                    'required'  => [
                        ['type', '=', 'lottie'],
                        ['lottie_type', '=', 'external'],
                    ],

                ],
                'lottie_loop' => [
                    'label'     => esc_html__( 'Loop', 'wpv-bu' ),
                    'type'      => 'checkbox',
                    'required'  => [
                        ['type', '=', 'lottie'],
                    ],
                ],
                'lottie_reverse' => [
                    'label'     => esc_html__( 'Reverse', 'wpv-bu' ),
                    'type'      => 'checkbox',
                    'required'  => [
                        ['type', '=', 'lottie'],
                    ],
                ],
                'link'      =>[
                    'label'     =>  esc_html__( 'Link', 'wpv-bu' ),
                    'type'      => 'link',
                    'required'  => ['type', '!=', 'image'],
                ],
                'img_link'      =>[
                    'label'     =>  esc_html__( 'Link', 'wpv-bu' ),
                    'type'      => 'select',
                    'options'   => [
                        'none'      => __('None', 'wpv-bu'),
                        'mediafile' => __('Media File', 'wpv-bu'),
                        'custom'    => __('Custom URL', 'wpv-bu'),
                    ],
                    'required'  => ['type','=', 'image'],
                ],
                'rep_lightbox' => [
                    'label'     =>  esc_html__( 'Lightbox', 'wpv-bu' ),
                    'type'      => 'checkbox',
                    'required'  => [['type', '=', 'image'],['img_link','=','mediafile']],
                ],
                'rep_cstmUrl' => [
                    'label'     =>  esc_html__( 'Custom Url', 'wpv-bu' ),
                    'type'      => 'text',
                    'required'  => [['type', '=', 'image'],['img_link','=','custom']],
                ],
                'tooltip'   => [
                    'label'     => esc_html__('Tooltip Text', 'wpv-bu'),
                    'type'      => 'text',
                    'placeholder'   => __('Add Your Tooltip Text Here.','wpv-bu'),

                ],
                'tooltip_position' => [
                    'label'     => esc_html__('Tooltip Position', 'wpv-bu'),
                    'type'      => 'select',
                    'options'   => [
                        'left'  => __('Left', 'wpv-bu'),
                        'top'    => __('Top', 'wpv-bu'),
                        'bottom'  => __('Bottom', 'wpv-bu'),
                        'right' => __('Right', 'wpv-bu'),
                    ],
                    'inline'    => true,
                ],
                'color'     => [
                    'label'     =>  esc_html__( 'Color', 'wpv-bu' ),
                    'type'      => 'color',
                    'css'       => [
                        [
                            'property' => 'color',
                        ],
                    ],
                ],
                'bgtype'     => [
                    'label'     =>  esc_html__( 'Background Type', 'wpv-bu' ),
                    'type'      => 'select',
                    'options'   => [
                        'color' => __('Color / Image','wpv-bu'),
                        'gradient' => __('Gradient','wpv-bu'),
                    ],
                ],
                'bgcol'   => [
                    'label'     =>  esc_html__( 'Background', 'wpv-bu' ),
                    'type'      => 'background',
                    'css'       => [
                       
                        [
                            'property' => 'background',  
                            'selector' => '.bultr-istk-inner.bultr-repeat-bg-color',
                            'important' => true,
                        ],
                        
                    ],
                    'rerender' => true,
                    'required' => ['bgtype', '=', 'color'],
                ],
                'bggrd'   => [
                    'label'     =>  esc_html__( 'Background Gradient', 'wpv-bu' ),
                    'type'      => 'gradient',
                    'css'       => [
                        [
                            'property' => 'background-image',
                            'selector' => '.bultr-istk-inner.bultr-repeat-bg-gradient',
                        ],
                    ],
                    'rerender' => true, 
                    'required' => ['bgtype', '=', 'gradient'],

                ],
                'border'   => [
                    'label'     =>  esc_html__( 'Border', 'wpv-bu' ),
                    'type'      => 'border',
                    'css'       => [
                        [
                            'property' => 'border',
                        ],
                    ],
                    'exclude' => ['radius'],
                ],
                'border-rds'   => [
                    'label'     =>  esc_html__( 'Border Radius', 'wpv-bu' ),
                    'type'      => 'border',
                    'css'       => [
                        [
                            'property' => 'border-radius',
                        ],
                        [
                            'property' => 'border-radius',
                            'selector' => 'img',
                        ],

                    ],
                    'exclude' => ['width','style','color'],
                ],
                
            ],
            'default' => [
                [
                    'title' => __('Item 1', 'wpv-bu'),
                    'type' => 'image',
                    'icon' => [
                        'library' =>  'themify', 
                        'icon' => 'ti-star',   
                    ],
                    
                    'text' => __('Text', 'wpv-bu'),
                    'lottie_loop' => true,
                    'lottie_reverse' => true,
                    'tooltip_position' => 'top',
                ],
                [
                    'title' => __('Item 2', 'wpv-bu'),
                    'type' => 'image',
                    'icon' => [
                        'library' =>  'themify', 
                        'icon' => 'ti-star',   
                    ],
                    
                    'text' => __('Text', 'wpv-bu'),
                    'lottie_loop' => true,
                    'lottie_reverse' => true,
                    'tooltip_position' => 'top',
                ],
                [
                    'title' => __('Item 3', 'wpv-bu'),
                    'type' => 'image',
                    'icon' => [
                        'library' =>  'themify', 
                        'icon' => 'ti-star',   
                    ],
                    
                    'text' => __('Text', 'wpv-bu'),
                    'lottie_loop' => true,
                    'lottie_reverse' => true,
                    'tooltip_position' => 'top',
                ],
                [
                    'title' => __('Item 4', 'wpv-bu'),
                    'type' => 'image',
                    'icon' => [
                        'library' =>  'themify', 
                        'icon' => 'ti-star',   
                    ],
                    
                    'text' => __('Text', 'wpv-bu'),
                    'lottie_loop' => true,
                    'lottie_reverse' => true,
                    'tooltip_position' => 'top',
                ],
            ],
            'required'  => ['source','=', 'repeater'],
        ];
    }
    public function get_stack_styling_controls(){
        $this->controls['stack_measurment'] = [
            'tab'       => 'content',
            'group'     => 'stack_styling',
			'label'     => __( 'Item Size', 'wpv-bu' ),
            'type'      =>'number',
            'unit'      => 'px',
            'css'       => [
                
                [
                    'property'  => 'width',
                    'selector'  => '.bultr-istk-img',
                ],
                [
                    'property'  => 'height',
                    'selector'  => '.bultr-istk-img',
                ],
                [
                    'property'  => 'width',
                    'selector'  => '.bultr-istk-item.bultr-istk-icon i',
                ],
                [
                    'property'  => 'height',
                    'selector'  => '.bultr-istk-item.bultr-istk-icon i',
                ],
                [
                    'property'  => 'width',
                    'selector'  => '.bultr-istk-item.bultr-istk-text span',
                ],
                [
                    'property'  => 'height',
                    'selector'  => '.bultr-istk-item.bultr-istk-text span',
                ],
                [
                    'property'  => 'width',
                    'selector'  => '.bultr-istk-item.bultr-istk-lottie .bultr-lottie',
                ],
                [
                    'property'  => 'height',
                    'selector'  => '.bultr-istk-item.bultr-istk-lottie .bultr-lottie',
                ],
            ],
        ];
        $this->controls['stack_icon_size'] = [
            'tab'       => 'content',
            'group'     => 'stack_styling',
			'label'     => __( 'Icon Size', 'wpv-bu' ),
            'type'      =>'number',
            'unit'      => 'px',
            'css'       => [
                [
                    'property'  => 'font-size',
                    'selector'  => '.bultr-istk-item.bultr-istk-icon i',
                ],
            ],
            'required' => [
                ['source' , '=','repeater'],

            ],
        ];
        $this->controls['stack_spacing'] = [
            'tab'       => 'content',
            'group'     => 'stack_styling',
			'label'     => __( 'Spacing', 'wpv-bu' ),
            'type'      =>'number',
            'units'      => true,
            'css'       => [
                [
                    'property'  => 'margin-left',
                    'selector'  => '.bultr-istk-container .bultr-istk-item:not(:first-child)',
                ],
            ],
            
        ];
        $this->controls['stack_hvrspacing'] = [
            'tab'       => 'content',
            'group'     => 'stack_styling',
			'label'     => __( 'Hover Spacing', 'wpv-bu' ),
            'type'      =>'number',
            'unit'      => 'px',
            'css'       => [
                [
                    'property'  => 'margin-left',
                    'selector'  => '.bultr-istk-container:hover .bultr-istk-item:not(:first-child)',
                    'important' => true,
                ],
            ],
           
        ];
        $this->controls['stack_color'] = [
            'tab'       => 'content',
            'group'     => 'stack_styling',
			'label'     => __( 'Color', 'wpv-bu' ),
            'type'      => 'color',
            'css'   => [
                [
                    'property' => 'color',
                    'selector' => '.bultr-istk-item',
                ],
            ],
            'required' => ['source','=', 'repeater'],
            'inline'    => true,
        ];
        $this->controls['stack_bgtype'] = [
            'tab'       => 'content',
            'group'     => 'stack_styling',
			'label'     => __( 'Background Type', 'wpv-bu' ),
            'type'      => 'select',
            'options'   => [
                'color' => __('Color / Image','wpv-bu'),
                'gradient' => __('Gradient','wpv-bu'),
            ],
            'default'   => 'color',
            'inline'    => true,
        ];
        $this->controls['stack_bgColor'] = [
            'tab'       => 'content',
            'group'     => 'stack_styling',
			'label'     => __( 'Background', 'wpv-bu' ),
            'type'      => 'background',
            'css'       => [
                [
                    'property' => 'background',
                    'selector' => '.bultr-istk-bg-color .bultr-istk-inner',
                ],
            ],
            'required' => ['stack_bgtype','=', 'color'], 
        ];
        $this->controls['stack_bgGradient'] = [
            'tab'       => 'content',
            'group'     => 'stack_styling',
			'label'     => __( 'Background Gradient', 'wpv-bu' ),
            'type'      => 'gradient',
            'css'       => [
                [
                    'property' => 'background-image',
                    'selector' => '.bultr-istk-bg-gradient .bultr-istk-inner',
                ]
            ],
            'required' => ['stack_bgtype','=', 'gradient'], 
        ];
        $this->controls['stack_border'] = [
            'tab'       => 'content',
            'group'     => 'stack_styling',
			'label'     => __( 'Border', 'wpv-bu' ),
            'type'      => 'border',
            'css'       => [
                
                [
                    'property'  => 'border',
                    'selector'  => '.bultr-istk-item',
                ],
            ],
            'exclude' => ['radius'],
        ];
        $this->controls['stack_bdRds'] = [
            'tab'       => 'content',
            'group'     => 'stack_styling',
			'label'     => __( 'Border Radius', 'wpv-bu' ),
            'type'      => 'border',
            'css'       => [
                
                [
                    'property'  => 'border-radius',
                    'selector'  => '.bultr-istk-item',
                ],
                [
                    'property'  => 'border-radius',
                    'selector'  => '.bultr-istk-item img',
                ],
            ],
            'exclude' => ['width', 'style', 'color'],
        ];
        $this->controls['stack_boxshd'] = [
            'tab'       => 'content',
            'group'     => 'stack_styling',
			'label'     => __( 'Box Shadow', 'wpv-bu' ),
            'type'      => 'box-shadow',
            'css'       => [
                
                [
                    'property'  => 'box-shadow',
                    'selector'  => '.bultr-istk-item',
                ],
            ],
        ];
        $this->controls['stack_padding'] = [
            'tab'       => 'content',
            'group'     => 'stack_styling',
			'label'     => __( 'Padding', 'wpv-bu' ),
            'type'      => 'dimensions',
            'css'       => [
                
                [
                    'property'  => 'padding',
                    'selector'  => '.bultr-istk-inner',
                ],
            ],
        ];
        $this->controls['text_sep'] = [
            'tab'       => 'content',
            'group'     => 'stack_styling',
			'label'     => __( 'Text', 'wpv-bu' ),
            'type'      => 'separator',
            'required' => ['source','=', 'repeater'],

        ];
        $this->controls['text_font'] = [
            'tab'       => 'content',
            'group'     => 'stack_styling',
			'label'     => __( 'Typography', 'wpv-bu' ),
            'type'      => 'typography',
            'css'       => [
                [
                    'property' => 'typography',
                    'selector' => '.bultr-istk-item.bultr-istk-text .bultr-stack-text'
                ],
            ],
            'exclude' => ['color'],
            'required' => ['source','=', 'repeater'],
        ];
    }
    public function get_tooltip_styling_controls(){
        $this->controls['ttp_width'] =[
            'tab'       => 'content',
			'group'     => 'tooltip_styling',
			'label'     => __( 'Width', 'wpv-bu' ),
            'type'      => 'number',
            'units'     => false,
        ];
        $this->controls['ttp_color'] =[
            'tab'       => 'content',
			'group'     => 'tooltip_styling',
			'label'     => __( 'Color', 'wpv-bu' ),
            'type'      => 'color',
            'css'       => [
                [
                    'property' => 'color',
                    'selector' => '.tippy-box',
                ],
            ],
        ];
        $this->controls['ttp_background'] =[
            'tab'       => 'content',
			'group'     => 'tooltip_styling',
			'label'     => __( 'Background', 'wpv-bu' ),
            'type'      => 'color',
            'css'       => [
                [
                    'property' => 'color',
                    'selector' => '.tippy-arrow',
                ],
                [
                    'property' => 'background-color',
                    'selector' => '.tippy-box',
                ],
            ],
        ];
        $this->controls['ttp_font'] =[
            'tab'       => 'content',
			'group'     => 'tooltip_styling',
			'label'     => __( 'Typography', 'wpv-bu' ),
            'type'      => 'typography',
            'css'       => [
                [
                    'property' => 'typography',
                    'selector' => '.tippy-box',
                ],
            ],
            'exclude'   => ['color'],
        ];
        $this->controls['ttp_padding'] =[
            'tab'       => 'content',
			'group'     => 'tooltip_styling',
			'label'     => __( 'Padding', 'wpv-bu' ),
            'type'      => 'dimensions',
            'css'       => [
                [
                    'property' => 'padding',
                    'selector' => '.tippy-content',
                ],
            ],
        ];
        $this->controls['ttp_bdRadius'] =[
            'tab'       => 'content',
			'group'     => 'tooltip_styling',
			'label'     => __( 'Border Radius', 'wpv-bu' ),
            'type'      => 'border',
            'css'       => [
                [
                    'property' => 'border',
                    'selector' => '.tippy-box',
                ],
            ],
            'exclude'   => ['width', 'style', 'color'],
        ];
       
    }

    public function render(){
        // echo "<pre>"; print_r(wp_get_current_user()); echo "</pre>";

        $settings = $this->settings;
        if(isset($settings['source']) &&$settings['source'] === 'single' ){
            if(empty($settings['image-gallery'])){
                return $this->render_element_placeholder(
                    [
                        'title' => esc_html__( 'Selecte Images from Gallery.', 'wpv-bu' ),
                    ]
                );
            }
        }
        $root_classes = ['bultr-istk-wrapper'];
        $this->set_attribute('_root','class',$root_classes);
        $container_classes = ['bultr-istk-container'];
        $container_classes[] = isset($settings['source']) ? "bultr-istk-".$settings['source'] : "bultr-istk-single";
        if(isset($settings['stack_bgtype'])){
            $container_classes[] = "bultr-istk-bg-".$settings['stack_bgtype'];
        }
        $this->set_attribute('container','class', $container_classes);
        ?>
        <div <?php echo $this->render_attributes('_root');?>>
            <div <?php echo $this->render_attributes('container');?>>

            <?php
                if(isset($settings['source']) && $settings['source'] === 'single'){
                    $this->render_single_source_html($settings);
                }
                else{
                    $this->render_repeater_soucre_html($settings);
                }
            ?>
            </div>
        </div>
        <?php
    }

    public function render_single_source_html($settings){
        foreach($settings['image-gallery']['images'] as $index => $item){

            $item_classes = ['bultr-istk-item'];
            $inner_classes = ['bultr-istk-inner'];
            $this->set_attribute("single-item-{$index}", 'class', $item_classes);
            $this->set_attribute("single-inner-{$index}", 'class', $inner_classes);
            if(isset($settings['single_tooltip']) && $settings['single_tooltip'] != "none"){
                $tooltip_text = $this->get_tooltip_text($settings, $item);
                $tooltip_pst = isset($settings['tooltip_position']) ? $settings['tooltip_position'] : 'top';
                $tooltip_width = !empty($settings['ttp_width']) ? (int)$settings['ttp_width'] : 'none';
                $this->set_attribute("single-item-{$index}", 'data-tooltip-istk', $tooltip_text);
                $this->set_attribute("single-item-{$index}", 'data-placement-istk', $tooltip_pst);
                $this->set_attribute("single-item-{$index}", 'data-width-istk', $tooltip_width);
            }
            ?>
            <div <?php echo $this->render_attributes("single-item-{$index}");?>>
                <div <?php echo $this->render_attributes("single-inner-{$index}");?>>
                    <?php
                        if(isset($settings['single_link']) && $settings['single_link'] !== 'none'){
                            $url ='';
                            $lightbox  = '';
                            $link_class = ['bultr-istk-link'];
                            $link = isset($settings['single_link']) ? $settings['single_link'] : 'none';
                            if($link === 'mediafile'){
                                $url = $item['url'];
                                if(isset($settings['lightbox'])){
                                    $lightbox = isset($settings['lightbox']) ? "true" : "false";  
                                    $link_class[] = 'bultr-is-lightbox';
                                }                      
                            }
                            elseif($link === 'custom'){
                                $url = !empty($settings['custom_url']) ? $settings['custom_url'] : '';
                            }

                            $this->set_attribute( "link-{$index}", 'href', $url);
                            $this->set_attribute( "link-{$index}", 'class', $link_class);
                            $this->set_attribute( "link-{$index}", 'target', '_blank');
                            $this->set_attribute( "link-{$index}", 'data-lightbox', $lightbox);

                    ?>
                            <a <?php echo $this->render_attributes("link-{$index}");?>>
                    <?php
                        }
                                echo  wp_get_attachment_image($item['id'], $settings['image-gallery']['size'],false,array('class' => 'bultr-istk-img'));
                        if(isset($settings['single_link']) && $settings['single_link'] !== 'none'){
                    ?>
                            </a>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <?php
        }
    }
    public function get_tooltip_text($settings, $item){

        $tooltip_type = isset($settings['single_tooltip']) ? $settings['single_tooltip'] : 'none';
        $tooltip_text = '';
        switch ($tooltip_type) {
            case 'title' :
                $tooltip_text = get_the_title( $item['id'] );
                break;
            case 'caption' :
                $tooltip_text = wp_get_attachment_caption( $item['id']);
                break;
            case 'custom' :
                $tooltip_text = !empty($settings['tooltip_custm']) ? $settings['tooltip_custm'] : '';
        }
        return $tooltip_text;


    }
    public function render_repeater_soucre_html($settings){
        $items = $settings['repeater_elements'];
        foreach($items as $index => $item){
            $item_classes = ['bultr-istk-item repeater-item'];
            $item_classes[] = isset($item['type']) ? 'bultr-istk-'.$item['type'] : "bultr-istk-icon";
            
            $inner_classes = ['bultr-istk-inner'];
            if(isset($item['bgtype'])){
                $inner_classes[] = "bultr-repeat-bg-".$item['bgtype'];
            }
            $this->set_attribute("repeat-{$index}", 'class', $item_classes);
            $this->set_attribute("inner-{$index}", 'class', $inner_classes);
            
            if(isset($settings['source']) && $settings['source'] === 'repeater'){
                if(!empty($item['tooltip'])){
                    $tooltip_text = !empty($item['tooltip']) ? $item['tooltip'] : '';
                    $tooltip_placement = !empty($item['tooltip_position']) ? $item['tooltip_position'] : 'top';
                    $tooltip_width = !empty($settings['ttp_width']) ? (int)$settings['ttp_width'] : 'none';

                    $this->set_attribute("repeat-{$index}", 'data-tooltip-istk', $tooltip_text);
                    $this->set_attribute("repeat-{$index}", 'data-placement-istk', $tooltip_placement);
                    $this->set_attribute("repeat-{$index}", 'data-width-istk', $tooltip_width);

                } 
            }
            ?>
            <div <?php echo $this->render_attributes("repeat-{$index}");?>>
                <div <?php echo $this->render_attributes("inner-{$index}");?>>

                    <?php 
                        if(isset($item['type']) && $item['type'] !== "image"){
                            if(isset($item['link'])){
                                $this->set_link_attributes( "rep-link-{$index}", $item['link'] );
                                ?>
                                <a <?php echo $this->render_attributes("rep-link-{$index}"); ?>>
                                <?php 
                            } 
                        }
                        else{
                            if(isset($item['type']) && $item['type'] === "image"){

                                if(isset($item['img_link']) && $item['img_link'] != "none" ){
                                    $url ='';
                                    $lightbox  = 'false';
                                    $link_class = ['bultr-istk-link'];
                                    $link = isset($item['img_link']) ? $item['img_link'] : 'none';
                                    if($link === 'mediafile'){
                                        $url = $item['image']['url'];
                                        if(isset($item['rep_lightbox'])){
                                            $lightbox = isset($item['rep_lightbox']) ? "true" : "false";  
                                            $link_class[] = 'bultr-is-lightbox';
                                        }                      
                                    }
                                    elseif($link === 'custom'){
                                        $url = !empty($item['rep_cstmUrl']) ? $item['rep_cstmUrl'] : '';
                                    }

                                    $this->set_attribute( "link-{$index}", 'href', $url);
                                    $this->set_attribute( "link-{$index}", 'class', $link_class);
                                    $this->set_attribute( "link-{$index}", 'target', '_blank');
                                    $this->set_attribute( "link-{$index}", 'data-lightbox', $lightbox);

                                    ?>
                                    <a <?php echo $this->render_attributes("link-{$index}");?>>
                                    <?php
                                }
                            }
                        } 
                    ?>
                    <?php
                        if(isset($item['type'])){
                            switch ($item['type']){
                                case 'icon' :
                                    echo $this->render_repeater_icon($item);
                                    break;
                                case 'image' :
                                    echo $this->render_repeater_img($item);
                                    break;
                                case 'text':
                                    echo $this->render_repeater_text($item);
                                    break;
                                case "lottie":
                                    echo $this->render_repeater_lottie($index,$item);
                                    break;
                            }
                        }          
                    ?>
                    <?php 
                        if(isset($item['type']) && $item['type'] !== "image"){
                            if(isset($item['link'])){                
                    ?>
                                </a>
                    <?php 
                            } 
                        }
                        else{
                            if(isset($item['type']) && $item['type'] === "image"){
                                ?>
                                </a>
                                <?php
                            }
                            
                        }
                    ?>
                </div>
            </div>
            <?php
        }
    }
    public function render_repeater_icon($item){
        if(!empty($item['icon'])){
            $icon = !empty($item['icon']) ? $item['icon'] : false;
            $icon = self::render_icon($icon, []);
            echo $icon;
        }
    }
    public function render_repeater_lottie($index,$item){
        
        if(isset($item['lottie_type']) && $item['lottie_type'] === "media"){
            $lottie_url = isset($item['lottie_media']) ? $item['lottie_media']['url'] : '';
        }
        else{
            $lottie_url = !empty($item['lottie_url']) ? $item['lottie_url'] : '';
        }
        $lottie_options = [
            'url'       => $lottie_url,
            'loop'      => isset($item['lottie_loop']) ? $item['lottie_loop'] : false,
            'direction' => isset( $item['lottie_reverse'] ) ? true : false,
        ];
        $this->set_attribute("lottie-{$index}", 'class', "bultr-lottie bultr-lottie-animation");
        $this->set_attribute("lottie-{$index}", 'data-lottie-settings', wp_json_encode($lottie_options));
        $this->set_attribute("lottie-{$index}", 'data-lottie-id', "bultr-istk-".rand(10,1000));


        ?>
        <div <?php echo $this->render_attributes("lottie-{$index}");?>></div>
        <?php
    }
    public function render_repeater_img($item){
        $img_src = '';
        
        if(isset($item['image'])){
            $img_src = wp_get_attachment_image($item['image']['id'], $item['image']['size'],false,array('class' => 'bultr-istk-img'));
        }
        else{
            $img_src = '<img src="' .\Bricks\Builder::get_template_placeholder_image(). '" class = "bultr-istk-img"/>';
        }
        return $img_src;
    }
    public function render_repeater_text($item){
        if(!empty($item['text'])){
            $text = !empty($item['text']) ? $item['text'] : false;
            ?>
            <span class = "bultr-stack-text"><?php echo $text; ?></span>
            <?php
        }
    }


}
?>