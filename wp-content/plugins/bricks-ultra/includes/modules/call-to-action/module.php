<?php
namespace BricksUltra\includes\CallToAction;

use Bricks\Element;
class Module extends Element {
	public $category     = 'ultra';
	public $name         = 'wpvbu-call-to-action';
	public $icon         = 'ion-md-play';
	public $css_selector = '';
	public $scripts      = [ '' ];
	public function get_label() {
		return esc_html__( 'Call To Action', 'wpv-bu' );
	}
    public function get_keywords() {
		return [ 'cta', 'call-to-action', 'info','banner','image-box', 'info-box'];
	}

    public function set_control_groups() {
		$this->control_groups['cta_image'] = [
			'title' => esc_html__( 'Image', 'wpv-bu' ),
			'tab'   => 'content',
		];
        $this->control_groups['cta_content'] = [
			'title' => esc_html__( 'Content', 'wpv-bu' ),
			'tab'   => 'content',
            
		];
        $this->control_groups['cta_ribbon'] = [
			'title' => esc_html__( 'Ribbon', 'wpv-bu' ),
			'tab'   => 'content',
		];

        $this->control_groups['cta_image_style'] = [
			'title' => esc_html__( 'Box Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
        $this->control_groups['cta_graphic_style'] = [
			'title' => esc_html__( 'Graphic Element Style', 'wpv-bu' ),
			'tab'   => 'content',
            'required' => [
				[ 'cta-content-select', '=', ['image','icon'] ],
			],
		];

        $this->control_groups['cta_content_style'] = [
			'title' => esc_html__( 'Content Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
        $this->control_groups['cta_button_style'] = [
			'title' => esc_html__( 'button Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
        $this->control_groups['cta_ribbon_style'] = [
			'title' => esc_html__( 'Ribbon Style', 'wpv-bu' ),
			'tab'   => 'content',
            'required'=>[ 
                [ 'cta-ribbon-check', '!=', false ],
              
            ],
		];
        
        $this->control_groups['cta_hover_style'] = [
			'title' => esc_html__( 'Overlay Effects', 'wpv-bu' ),
			'tab'   => 'content',
		];
       

    }

    public function set_controls()
    {
        $img_src =  \Bricks\Builder::get_template_placeholder_image();
        $this->controls['cta-image-layout'] = [
            'tab'     => 'content',
            'group'   => 'cta_image',
            'label' => esc_html__( 'Layout', 'wpv-bu' ),
            'type'  => 'select',
            'options' => [
                'default' => esc_html__('Cover', 'wpv-bu' ),
                'split' => esc_html__( 'Split', 'wpv-bu' ),
            ],
        
            'inline'      => true,     
            'default' => 'default',
            'rerender'=> true,
            'clearable'   => false,
        ];
        
        $this->controls['cta_image_position'] = [
            'tab'     => 'content',
            'group'   => 'cta_image',
            'label' => esc_html__( 'Position', 'wpv-bu' ),
            'type'  => 'direction',
            'inline'      => true,     
            'css'   => [  
                            
                [
                    'property' => 'flex-direction',
                    'selector' => '&.bultr-cta-main-split',                  
                ],
            ],
            'default' => 'row',
            'required' => [
                [ 'cta-image-layout', '=', 'split' ],
                
            ],
        
        ];
        
        $this->controls['cta-image-choose'] = [
            'tab'     => 'content',
            'group'   => 'cta_image',
            'label' => esc_html__( 'Choose Image', 'wpv-bu' ),
            'type' => 'image', 
            'rerender' => true,
            'required' => [
                [ 'cta-image-hide', '=', false ],
                
            ],
        ]; 
        $this->controls['cta-image-hide']=[
            'tab'       => 'content',
            'group'     => 'cta_image',
            'label'     => esc_html__( 'Hide Image', 'wpv-bu' ),
            'type'      => 'checkbox',
            'default'   => false,
                
        ];
        $this->controls['placeHolderImage'] = [
            'tab'     => 'content',
            'group'   => 'cta_image',
            'default'     => $img_src,
            'placeholder' => esc_html__( 'I am a button', 'bricks' ),
            'hidden'      => true,
        ];
        //graphic element
        $this->controls['cta-content-select'] = [
            'tab'     => 'content',
            'group'   => 'cta_content',
            'label' => esc_html__( 'Graphic Element', 'wpv-bu' ),
            'type'  => 'select',     
            'options'=>[
                'default'=>esc_html__('None','wpv-bu'),
                'image'=>esc_html__('Image','wpv-bu'),
                'icon'=>esc_html__('Icon','wpv-bu'),
            ],
            'clearable' => false,
            'default'=>__('default','wpv-bu'),
        ];
        $this->controls['cta-content-image'] = [
            'tab'     => 'content',
            'group'   => 'cta_content',
            'label' => esc_html__( 'Image', 'wpv-bu' ),
            'type'  => 'image',     
            'required'=>[  'cta-content-select', '=', 'image' ]
        ];
        $this->controls['cta-content-icon'] = [
            'tab'     => 'content',
            'group'   => 'cta_content',
            'label' => esc_html__( 'Primary Icon', 'wpv-bu' ),
            'type'  => 'icon',     
            'required'=>[  'cta-content-select', '=', 'icon' ]
        ];
        //content 
        $this->controls['cta-content-title'] = [
            'tab'     => 'content',
            'group'   => 'cta_content',
            'label' => esc_html__( 'Title', 'wpv-bu' ),
            'type' => 'text',     
            'inlineEditing' => true,
            'default' => __('This is the Title','wpv-bu'),
            'rerender' => true,
        ];
        $this->controls['cta-title-tag'] = [
			'tab'         => 'content',
            'group'   => 'cta_content',

			'label'       => esc_html__( 'Tag', 'wpv-bu' ),
			'type'        => 'select',
			'options'     => [
				'h1'     => 'h1',
				'h2'     => 'h2',
				'h3'     => 'h3',
				'h4'     => 'h4',
				'h5'     => 'h5',
				'h6'     => 'h6',
			],
			'inline'      => true,
            'default' => __('h3', 'wpv-bu')
		];
        $this->controls['cta-content-subtitle'] = [
            'tab'     => 'content',
            'group'   => 'cta_content',
            'label' => esc_html__( 'Sub Title', 'wpv-bu' ),
            'type' => 'text',     
            'inlineEditing' => true,
            'default' => __('This is the Sub Title','wpv-bu'),
            'rerender' => true,
        ];
        $this->controls['cta-subtitle-tag'] = [
			'tab'         => 'content',
            'group'   => 'cta_content',

			'label'       => esc_html__( 'Tag', 'wpv-bu' ),
			'type'        => 'select',
			'options'     => [
				'h1'     => 'h1',
				'h2'     => 'h2',
				'h3'     => 'h3',
				'h4'     => 'h4',
				'h5'     => 'h5',
				'h6'     => 'h6',
			],
			'inline'      => true,
            'default' => __('h5', 'wpv-bu')

		];
        $this->controls['cta-content-description'] = [
            'tab'     => 'content',
            'group'   => 'cta_content',
            'label' => esc_html__( 'Description', 'wpv-bu' ),
            'type' => 'text',     
            'inlineEditing' => true,
            'default' => __('Lorem ipsum dolor sit amet consectetur adipiscing elit dolor','wpv-bu'),
            'rerender' => true,
        ];
        //buttons
        $this->controls['cta-button'] = [
            'tab'   => 'content',
            'group' => 'cta_content',
            'label' => esc_html__( 'Button', 'wpv-bu' ),
            'type'  => 'separator',
        ];

        $this->controls['cta-primary-button'] = [
            'tab'     => 'content',
            'group'   => 'cta_content',
            'label' => esc_html__( 'Primary Button', 'wpv-bu' ),
            'type' => 'text',     
            'default'=>__('Buy Now','wpv-bu'),
        ];
        $this->controls['cta-primary-icon'] = [
            'tab'     => 'content',
            'group'   => 'cta_content',
            'label' => esc_html__( 'Primary Icon', 'wpv-bu' ),
            'type'  => 'icon',     
            'css'   => [
                [
                    'selector' => '.bultr-cta-icon-right a',
                ],
                [
                    'selector' => '.bultr-cta-icon-left a',
                ],
                
            ], 
        ];
        $this->controls['cta-primary-link'] = [
            'tab'         => 'content',
            'group'   => 'cta_content',
            'label'       => esc_html__( 'Link', 'wpv-bu' ),
            'type'        => 'link',
            'pasteStyles' => false,
            'placeholder' => esc_html__( 'http://yoursite.com', 'bricks' ),
            
        ];
        $this->controls['cta-primary-icon-position'] = [
            'tab'     => 'content',
            'group'   => 'cta_content',
            'label' => esc_html__( 'Position', 'wpv-bu' ),
            'type'  => 'select',  
            'options'=>[
                'right'=> esc_html__('Right','wpv-bu'),
                'left'=> esc_html__('Left','wpv-bu'),
            ],   
            'default'=>__('right','wpv-bu'),
            'clearable' => false,
            'required'=>[  'cta-primary-icon', '!=', '' ]
        ];
        $this->controls['cta-primary-icon-gap'] = [
            'tab'     => 'content',
            'group'   => 'cta_content',
            'label' => esc_html__( 'Gap', 'wpv-bu' ),
            'type'  => 'number',
            'unit'=>'px', 
            'css'   => [
                [
                    'property' => 'gap',
                    'selector' => '.bultr-cta-icon-right a',
                ],
                [
                    'property' => 'gap',
                    'selector' => '.bultr-cta-icon-left a',
                ],
            ],
            'default'=>'5',
            'required'=>[  'cta-primary-icon', '!=', '' ]
        ];
        $this->controls['cta-secondary-button'] = [
            'tab'     => 'content',
            'group'   => 'cta_content',
            'label' => esc_html__( 'Secondary Button', 'wpv-bu' ),
            'type'  => 'text',     
            'default'=>__('Read More', 'wpv-bu'),
        ];
        $this->controls['cta-secondary-icon'] = [
            'tab'     => 'content',
            'group'   => 'cta_content',
            'label' => esc_html__( 'Secondary Icon', 'wpv-bu' ),
            'type'  => 'icon',     
            'css'   => [
                [
                    'selector' => '.bultr-cta-icon-s-right a',
                ],
                [
                    'selector' => '.bultr-cta-icon-s-left a',
                    ],
                
            ], 
        ];
        $this->controls['cta-secondary-link'] = [
            'tab'         => 'content',
            'group'   => 'cta_content',
            'label'       => esc_html__( 'Link', 'wpv-bu' ),
            'type'        => 'link',
            'pasteStyles' => false,
            'placeholder' => esc_html__( 'http://yoursite.com', 'bricks' ),
            
        ];
        $this->controls['cta-secondary-icon-position'] = [
            'tab'     => 'content',
            'group'   => 'cta_content',
            'label' => esc_html__( 'Position', 'wpv-bu' ),
            'type'  => 'select',  
            'options'=>[
                'right'=> esc_html__('Right','wpv-bu'),
                'left'=> esc_html__('Left','wpv-bu'),
            ] ,
            'default'=>__('right','wpv-bu'),
            'clearable' => false,
            'required'=>[  'cta-secondary-icon', '!=', '' ]  
            
        ];
        $this->controls['cta-secondary-icon-gap'] = [
            'tab'     => 'content',
            'group'   => 'cta_content',
            'label' => esc_html__( 'Gap', 'wpv-bu' ),
            'type'  => 'number',
            'unit'=>'px', 
            'css'   => [
                [
                    'property' => 'gap',
                    'selector' => '.bultr-cta-icon-s-right a',
                ],
                [
                    'property' => 'gap',
                    'selector' => '.bultr-cta-icon-s-left a',
                    ],
            ], 
            'default'=>'5',
            'required'=>[  'cta-secondary-icon', '!=', '' ] 
        ];

        //Ribbon
        $this->controls['cta-ribbon-check'] = [
            'tab'     => 'content',
            'group'   => 'cta_ribbon',
            'label' => esc_html__( 'Show', 'wpv-bu' ),
            'type'  => 'checkbox',
            'default'=> false,
        ];
        $this->controls['cta-ribbon'] = [
            'tab'     => 'content',
            'group'   => 'cta_ribbon',
            'label' => esc_html__( 'Text', 'wpv-bu' ),
            'type'  => 'text', 
            'default'=>__('Sale Now' ,'wpv-bu'), 
            'required' => [
                [ 'cta-ribbon-check', '!=', false ],
                
            ],
        ];
        $this->controls['cta-ribbon-position'] = [
            'tab'     => 'content',
            'group'   => 'cta_ribbon',
            'label' => esc_html__( 'Position', 'wpv-bu' ),
            'type'  => 'select',  
            'options'=>[
                'left'=> esc_html__('Left','wpv-bu'),
                'right'=> esc_html__('Right','wpv-bu'),
            ],
            'default'=>__('left','wpv-bu'),  
            'inline' => true, 
            'clearable' => false,
            'required'=>[ 
                [ 'cta-ribbon-check', '!=', false ],
                
            ],
        ];
        
        //Box Style
        $this->controls['cta-box-style'] = [
            'tab'   => 'content',
            'group' => 'cta_image_style',
            'label' => esc_html__( 'Box', 'wpv-bu' ),
            'type'  => 'separator',
        ];
        $this->controls['cta-box-height'] = [
            'tab'     => 'content',
            'group'   => 'cta_image_style',
            'label' => esc_html__( 'Height (in px)', 'wpv-bu' ),
            'type'  => 'number',  
            'unit' => 'px',
            'min' => 0,
            'max' =>'1000' ,             
                'step' => '1',
            'css' => [
                
                [
                    'property' => 'min-height',
                    'selector' => '&.bultr-cta-main-default .bultr-cta-content',
                ],
            
            ],
            'required' => [
                [ 'cta-image-layout', '=', 'default' ],
                
            ],
        ];
        $this->controls['cta-box-width'] = [
            'tab'     => 'content',
            'group'   => 'cta_image_style',
            'label' => esc_html__( 'Width (in %)', 'wpv-bu' ),
            'type'  => 'number',  
            'unit' => '%',
            'min' => 0,
            'max' =>'100' ,             
                'step' => '1',
            'css' => [
                
                [
                    'property' => 'width',
                    'selector' => '&.bultr-cta-main-wrapper',
                ],
                
            ],
        ];
        $this->controls['cta-box-sheight'] = [
            'tab'     => 'content',
            'group'   => 'cta_image_style',
            'label' => esc_html__( 'Height (in px)', 'wpv-bu' ),
            'type'  => 'number',  
            'unit' => 'px',
            'min' => 0,
            'max' =>'1000' ,             
                'step' => '1',
            'css' => [
                
                [
                    'property' => 'min-height',
                    'selector' => '&.bultr-cta-main-wrapper.bultr-cta-main-split ',
                ],
                [
                    'property' => 'min-height',
                    'selector' => '&.bultr-cta-main-wrapper.bultr-cta-main-split .bultr-cta-content',
                ],
            ],
            'required' => [
                [ 'cta-image-layout', '=', 'split' ],
                
            ],
        ];
        $this->controls['cta-box-align'] = [
            'tab'     => 'content',
            'group'   => 'cta_image_style',
            'label' => esc_html__( 'Box Alignment', 'wpv-bu' ),
            'type'  => 'align-items', 
            'inline'      => true,    
            'css' => [
                [
                    'property' => 'align-self',
                    'selector' => '&.bultr-cta-main-wrapper',
                    ],
            ],
            'exclude' => [
                'stretch',
                
            ],
            
            
        ];
        $this->controls['cta-box-border'] = [
            'tab'     => 'content',
            'group'   => 'cta_image_style',
            'label' => esc_html__( 'Border', 'wpv-bu' ),
            'type'  => 'border',
            'css' => [
                [
                'property' => 'border',
                'selector' => '&.bultr-cta-main-wrapper ',
                ],
            ],    
        ];
        $this->controls['cta-box-shadow'] = [
            'tab'     => 'content',
            'group'   => 'cta_image_style',
            'label' => esc_html__( 'Box Shadow', 'wpv-bu' ),
            'type'  => 'box-shadow',
            'css' => [
                [
                'property' => 'box-shadow',
                'selector' => '&.bultr-cta-main-wrapper ',
                ],
            ],    
        ];
        //Image Style
        $this->controls['cta-image-style'] = [
            'tab'   => 'content',
            'group' => 'cta_image_style',
            'label' => esc_html__( 'Image', 'wpv-bu' ),
            'type'  => 'separator',
        ]; 
        $this->controls['cta-image-height'] = [
            'tab'     => 'content',
            'group'   => 'cta_image_style',
            'label' => esc_html__( 'Height (in px)', 'wpv-bu' ),
            'type'  => 'number',  
            'unit' => 'px',
            'min' => 0,
            'max' =>'1000' ,             
                'step' => '1',
            'css' => [
                [
                'property' => 'max-height',
                'selector' => '&.bultr-cta-main-split .bultr-cta-image',
                ],
            ],
            
            'required' => [
                [ 'cta-image-layout', '=', 'split' ],
                
            ],
        
            
        ];
        $this->controls['cta-image-width'] = [
            'tab'     => 'content',
            'group'   => 'cta_image_style',
            'label' => esc_html__( 'Width (in %)', 'wpv-bu' ),
            'type'  => 'number',  
            'unit' => '%',
            'min' => 0,
            'max' =>'100' ,             
                'step' => '1',
            'css' => [
                [
                'selector' => '',    
                'property' => '--image_width',
                'value' => '%s',
                ],
            ],
            'required' => [
                    [ 'cta_image_position', '!=', 'column' ],
                    [ 'cta_image_position', '!=', 'column-reverse' ],
                    [ 'cta-image-layout', '=', 'split' ],
                
            ],
        ];
        $this->controls['cta-image-align'] = [
            'tab'     => 'content',
            'group'   => 'cta_image_style',
            'label' => esc_html__( 'Image Alignment', 'wpv-bu' ),
            'type'  => 'align-items', 
            'inline'      => true,    
            'css' => [
                [
                    'property' => 'align-self',
                    'selector' => '.bultr-cta-image',
                    ],
            ],
            'exclude' => [
                'stretch',
                
            ],
            'required' => [
                [ 'cta-image-layout', '=', 'split' ],
                
                ],
            
        ];
        $this->controls['cta-image-padding'] = [
            'tab'     => 'content',
            'group'   => 'cta_image_style',
            'label' => esc_html__( 'Image Padding', 'wpv-bu' ),
            'type'  => 'dimensions', 
            'css'   => [
                [
                    'property' => 'padding',
                    'selector' => '.bultr-cta-image',
                                        
                ],   
                ], 
        ];
        $this->controls['cta-image-bgcolor'] = [
            'tab'     => 'content',
            'group'   => 'cta_image_style',
            'label' => esc_html__( 'Image Background', 'wpv-bu' ),
            'type'  => 'background', 
            'css'   => [
                [
                    'property' => 'background-color',
                    'selector' => '.bultr-cta-image',
                                        
                ],   
                ], 
        ];
        //hover image
        $this->controls['cta-img-hover-style']=[
            'tab'=>'content',
            'group'=>'cta_image_style',
            'label'=> esc_html__('Hover','wpv-bu'),
            'type'=>'separator',
        ];
        $this->controls['cta-hover-effect-animation'] = [
            'tab' => 'content',
            'group'=>'cta_image_style',
            'label' => esc_html__( 'Hover Animation', 'wpv-bu' ),
            'type' => 'select',
            'options' => [
                'none' => esc_html__( 'None', 'wpv-bu' ),
                'zoom-in' => esc_html__( 'Zoom-In', 'wpv-bu' ),
                'zoom-out' => esc_html__( 'Zoom-Out', 'wpv-bu' ),
                'move-left' => esc_html__( 'Move-Left', 'wpv-bu' ),
                'move-right' => esc_html__( 'Move-Right', 'wpv-bu' ),
                'move-up' => esc_html__( 'Move-Up', 'wpv-bu' ),
                'move-down' => esc_html__( 'Move-down', 'wpv-bu' ),
            ],
            'inline' => true,
            'clearable' => false,
            
        ];
        
        $this->controls['cta-hover-effect-transition'] = [
            'tab' => 'content',
            'group'=>'cta_image_style',
            'label' => esc_html__( 'Transition Duration', 'wpv-bu' ),
            'type' => 'number',
            'unit'=>'ms',
            'min'=> 0,
            'max'=>'3000',
            'step'=>'1',
            'css' => [
                [
                'property' => 'transition-duration',
                'selector' => '&.bultr-bg-transform .bultr-cta-image ',
            
                ],
                
            ], 
        ];
        //Content Style
        $this->controls['cta-content-bcolor'] = [
            'tab' => 'content',
            'group'=>'cta_content_style',
            'label' => esc_html__( 'Background Color', 'wpv-bu' ),
            'type' => 'gradient',
            'info' =>  __("In \"Apply to\" field use only background option.",'wpv-bu'),
            'css' => [
                [
                'property' => 'background',
                'selector' => '.bultr-cta-content',
                
                ],
            ],
        ];
        $this->controls['cta-content-border'] = [
            'tab' => 'content',
            'group'=>'cta_content_style',
            'label' => esc_html__( 'Border', 'wpv-bu' ),
            'type' => 'border',
            'css' => [
                [
                'property' => 'border',
                'selector' => '.bultr-cta-content',
                
                ],
            ],
        ];
        $this->controls['cta-content-boxShd'] = [
            'tab' => 'content',
            'group'=>'cta_content_style',
            'label' => esc_html__( 'Box Shadow', 'wpv-bu' ),
            'type' => 'box-shadow',
            'css' => [
                [
                'property' => 'box-shadow',
                'selector' => '.bultr-cta-content',
                
                ],
            ],
        ];
        $this->controls['cta_content_vposition'] = [
            'tab'     => 'content',
            'group'   => 'cta_content_style',
            'label' => esc_html__( 'Vertical Position', 'wpv-bu' ),
            'type'  => 'align-items',
            'inline'      => true,     
            'css'   => [
                [
                    'property' => 'align-self',
                    'selector' => '&.bultr-cta-main-default .bultr-cta-content',
                                        
                ],   
            ],

            'exclude' => [
                'stretch'
            ],
            'required' => [
                [ 'cta-image-layout', '=', 'default' ],
            ],                        
        ];
        $this->controls['cta_content_hposition'] = [
            'tab'     => 'content',
            'group'   => 'cta_content_style',
            'label' => esc_html__( 'Horizontal Position', 'wpv-bu' ),
            'type'  => 'align-items',
            'inline'      => true,     
            'css'   => [
                [
                    'property' => 'align-items',
                    'selector' => '.bultr-cta-content',
                                        
                ],   
                [
                    'property' => 'align-items',
                    'selector' => '&.bultr-cta-main-default .bultr-cta-graphic-element',
                                        
                ],  
            ],
            'required' => [
                ['cta-image-layout', '=', 'default' ],
            ],
            'exclude' => [
                'stretch',
                
            ],
        ];
        $this->controls['cta_content_halignment'] = [
            'tab'     => 'content',
            'group'   => 'cta_content_style',
            'label' => esc_html__( 'Alignment', 'wpv-bu' ),
            'type'  => 'align-items',
            'inline'      => true,     
            'css'   => [
                [
                    'property' => 'align-items',
                    'selector' => '&.bultr-cta-main-split .bultr-cta-content',
                                        
                ], 
                [
                    'property' => 'align-items',
                    'selector' => '&.bultr-cta-main-split .bultr-cta-graphic-element',
                                        
                ],   
            ],
            'required' => [
                ['cta-image-layout', '=', 'split' ],
            ],
            'exclude' => [
                'stretch',
                
            ],
        ];

        $this->controls['cta_content_valignment'] = [
            'tab'     => 'content',
            'group'   => 'cta_content_style',
            'label' => esc_html__( 'Vertical Alignment', 'wpv-bu' ),
            'type'  => 'justify-content',
            'inline'      => true,     
            'css'   => [
                [
                    'property' => 'justify-content',
                    'selector' => '.bultr-cta-content',
                                        
                ],   
            ],
            'required' => [
                [ 'cta-image-layout', '=', 'split' ],
            ],
            'exclude' => [
                'space',
                
            ],
        ];
        $this->controls['cta-content-padding'] = [
            'tab'     => 'content',
            'group'   => 'cta_content_style',
            'label' => esc_html__( 'Content Padding', 'wpv-bu' ),
            'type'  => 'dimensions', 
            'css'   => [
                [
                    'property' => 'padding',
                    'selector' => '.bultr-cta-content',
                                        
                ],   
            ], 
        ];
        $this->controls['cta-content-gap']=[
            'tab'     => 'content',
            'group'   => 'cta_content_style',
            'label' => esc_html__( 'Content Gap', 'wpv-bu' ),
            'type'  => 'number', 
            'css'   => [
                [
                    'property' => 'gap',
                    'selector' => '.bultr-cta-content',
                                        
                ],   
            ], 
        ];
        
        $this->controls['cta-content-magin'] = [
            'tab'     => 'content',
            'group'   => 'cta_content_style',
            'label' => esc_html__( 'Content Margin', 'wpv-bu' ),
            'type'  => 'dimensions', 
            'css'   => [
                [
                    'property' => 'margin',
                    'selector' => '.bultr-cta-content',
                                        
                ],   
            ], 
        ];
        //title style
        $this->controls['cta-content-heading']      = [
            'tab'   => 'content',
            'group' => 'cta_content_style',
            'label' => esc_html__( 'Title', 'wpv-bu' ),
            'type'  => 'separator',
            'required'=>[ 
                [ 'cta-content-title', '!=', '' ],
                
            ],
        ];
        $this->controls['cta-heading-typography'] = [
            'tab' => 'content',
            'group'=>'cta_content_style',
            'label' => esc_html__( 'Typography', 'wpv-bu' ),
            'type' => 'typography',
            'css' => [
                [
                    'property' => 'typography',
                    'selector' => '.bultr-cta-content .bultr-cta-title',
                ],
            ],
            'inline' => true,
            'required'=>[ 
                [ 'cta-content-title', '!=', '' ],
                
            ],
        ];
        $this->controls['cta-content-hspacing'] = [
            'tab'     => 'content',
            'group'   => 'cta_content_style',
            'label' => esc_html__( 'Spacing', 'wpv-bu' ),
            'type'  => 'number',  
            'unit' => 'px',
            'min' => 0,
            'max' =>'100' ,             
                'step' => '1',
            'css' => [
                [
                    'property' => 'padding-bottom',
                    'selector' => '.bultr-cta-content .bultr-cta-title',
                ],
            ],
            'required'=>[ 
                [ 'cta-content-title', '!=', '' ],
                
            ],
        ]; 
        $this->controls['cta-content-title-padding'] = [
            'tab'     => 'content',
            'group'   => 'cta_content_style',
            'label' => esc_html__( 'Padding', 'wpv-bu' ),
            'type'  => 'dimensions', 
            'css'   => [
                [
                    'property' => 'padding',
                    'selector' => '.bultr-cta-content .bultr-cta-title',
                                        
                ],   
            ], 
            'required'=>[ 
                [ 'cta-content-title', '!=', '' ],
            
            ],
        ]; 
        //Sub title style
        $this->controls['cta-content-subheading']= [
            'tab'   => 'content',
            'group' => 'cta_content_style',
            'label' => esc_html__( 'Sub Title', 'wpv-bu' ),
            'type'  => 'separator',
            'required'=>[ 
                [ 'cta-content-subtitle', '!=', '' ],
                
            ],
        ];
        $this->controls['cta-subheading-typography'] = [
            'tab' => 'content',
            'group'=>'cta_content_style',
            'label' => esc_html__( 'Typography', 'wpv-bu' ),
            'type' => 'typography',
            'css' => [
                [
                    'property' => 'typography',
                    'selector' => '.bultr-cta-content .bultr-cta-sub-title',
                ],
            ],
            'required'=>[ 
                [ 'cta-content-subtitle', '!=', '' ],
                
            ],
            'inline' => true,
        ];
        $this->controls['cta-content-sub-hspacing'] = [
            'tab'     => 'content',
            'group'   => 'cta_content_style',
            'label' => esc_html__( 'Spacing', 'wpv-bu' ),
            'type'  => 'number',  
            'unit' => 'px',
            'min' => 0,
            'max' =>'100' ,             
                'step' => '1',
            'css' => [
                [
                    'property' => 'padding-bottom',
                    'selector' => '.bultr-cta-content .bultr-cta-sub-title',
                ],
            ],
            'required'=>[ 
                [ 'cta-content-subtitle', '!=', '' ],
                
            ],
        ];  
        $this->controls['cta-content-sub-title-padding'] = [
            'tab'     => 'content',
            'group'   => 'cta_content_style',
            'label' => esc_html__( 'Padding', 'wpv-bu' ),
            'type'  => 'dimensions', 
            'css'   => [
                [
                    'property' => 'padding',
                    'selector' => '.bultr-cta-content .bultr-cta-sub-title',

                ],   
            ], 
            'required'=>[ 
                [ 'cta-content-subtitle', '!=', '' ],  
            ],
        ];
        //Description Style
        $this->controls['cta-content-sdescription']= [
            'tab'   => 'content',
            'group' => 'cta_content_style',
            'label' => esc_html__( 'Description', 'wpv-bu' ),
            'type'  => 'separator',
            'required'=>[ 
                [ 'cta-content-description', '!=', '' ],
            ],
            
        ];
        $this->controls['cta-description-typography'] = [
            'tab' => 'content',
            'group'=>'cta_content_style',
            'label' => esc_html__( 'Typography', 'wpv-bu' ),
            'type' => 'typography',
            'css' => [
                [
                'property' => 'typography',
                'selector' => '.bultr-cta-content p',
                ],
            ],
            'required'=>[ 
                [ 'cta-content-description', '!=', '' ],
            ],
            'inline' => true,
        ];
        $this->controls['cta-content-spacing-button'] = [
            'tab'     => 'content',
            'group'   => 'cta_content_style',
            'label' => esc_html__( 'Spacing', 'wpv-bu' ),
            'type'  => 'number',  
            'unit' => 'px',
            'min' => 0,
            'max' =>'100' ,             
                'step' => '1',
            'css' => [
                [
                'property' => 'padding-bottom',
                'selector' => '.bultr-cta-content p',
                ],
            ],
            'required'=>[ 
                [ 'cta-content-description', '!=', '' ],
                
            ],
        ];
        $this->controls['cta-content-description-padding'] = [
            'tab'     => 'content',
            'group'   => 'cta_content_style',
            'label' => esc_html__( 'Padding', 'wpv-bu' ),
            'type'  => 'dimensions', 
            'css'   => [
                [
                    'property' => 'padding',
                    'selector' => '.bultr-cta-content .bultr-cta-description',
                    
                ],   
            ], 
            'required'=>[ 
                [ 'cta-content-description', '!=', '' ],
                
            ],
        ];
        // hover Effects
        $this->controls['cta-content-style'] = [
            'tab'   => 'content',
            'group' => 'cta_content_style',
            'label' => esc_html__( 'Hover Effects', 'wpv-bu' ),
            'type'  => 'separator',
            'required'=>[
                ['cta-image-layout','=', 'default'  ]
            ],
            
        ];
        $this->controls['cta-hover-effect-content'] = [
            'tab' => 'content',
            'group'=>'cta_content_style',
            'label' => esc_html__( 'Hover Animation', 'wpv-bu' ),
            'type' => 'select',
            'inline' => true,
            'options'=>[ 
                'none'=>esc_html__('None','wpv-bu'),
                'grow'=>esc_html__('Grow','wpv-bu'),
                'shrink'=>esc_html__('Shrink','wpv-bu'),
                'move-right'=>esc_html__('Move Right','wpv-bu'),
                'move-left'=>esc_html__('Move Left','wpv-bu'),
                'move-up'=>esc_html__('Move Up','wpv-bu'),
                'move-down'=>esc_html__('Move Down','wpv-bu'),
                'slide-out-right'=>esc_html__('Slide Out Right','wpv-bu'),
                'slide-out-left'=>esc_html__('Slide Out Left','wpv-bu'),
                'slide-out-up'=>esc_html__('Slide Out Up','wpv-bu'),
                'slide-out-down'=>esc_html__('Slide Out Down','wpv-bu'),
                'zoom-in'=>esc_html__('Zoom In','wpv-bu'),
                'zoom-out'=>esc_html__('Zoom Out','wpv-bu'),
                'fade-out'=>esc_html__('Fade Out','wpv-bu'),
                'slide-in-right'=>esc_html__('Slide In Right','wpv-bu'),
                'slide-in-left'=>esc_html__('Slide In Left','wpv-bu'),
                'slide-in-up'=>esc_html__('Slide In Up','wpv-bu'),
                'slide-in-down'=>esc_html__('Slide In Down','wpv-bu'),
                'fade-in'=>esc_html__('Fade In','wpv-bu'),
            ], 
            'css'=>[
                [
                    'property'=>'transform',
                    'selector'=> '.bultr-animated-item--',
                    

                ],
            ],
            'rerender'=>true,
            'clearable' => false,
            'required' => ['cta-image-layout', '=', 'default'],
        ];

        $this->controls['cta-hover-effect-content-transition'] = [
            'tab' => 'content',
            'group'=>'cta_content_style',
            'label' => esc_html__( 'Transition Duration', 'wpv-bu' ),
            'type' => 'number',
            'unit'=>'ms',
            'min'=> 0,
            'max'=>3000,
            'step'=>'1',
            'css' => [
                [
                    'property' => 'transition-duration',
                    'selector' => '&.bultr-cta-main-default .bultr-cta-content ',
                ],
            ], 
            'required' => ['cta-image-layout', '=', 'default'],
            
        ];
        //Button Style
        $this->controls['cta-button-icon-size'] = [
            'tab'     => 'content',
            'group'   => 'cta_button_style',
            'label' => esc_html__( 'Icon Size', 'wpv-bu' ),
            'type'  => 'number',  
            'unit' => 'px',
            'min' => 0,
            'max' =>'100' ,             
                'step' => '1',
            'css' => [
                [
                    'property' => 'font-size',
                    'selector' => '.bultr-cta-button i',
                ],
                [
                    'property' => 'font-size',
                    'selector' => '.bultr-cta-button svg',
                ],
            ],
            
        ];
        $this->controls['cta-button-icon-align'] = [
            'tab'     => 'content',
            'group'   => 'cta_button_style',
            'label' => esc_html__( 'Icon Alignment', 'wpv-bu' ),
            'type'  => 'align-items', 
            'inline'      => true,    
            'css' => [
                [
                    'property' => 'align-self',
                    'selector' => '.bultr-cta-button i',
                ],
            ],
            'exclude' => [
                'stretch',
                
            ],
            
        ];
        $this->controls['cta-button-padding'] = [
            'tab'     => 'content',
            'group'   => 'cta_button_style',
            'label' => esc_html__( 'Padding', 'wpv-bu' ),
            'type'  => 'dimensions',  
            'css'   => [
                [
                    'property' => 'padding',
                    'selector' => '.bultr-cta-button-primary a',
                                        
                ],  
                [
                    'property' => 'padding',
                    'selector' => '.bultr-cta-button-secondary a',
                                        
                ],   
            ], 
        ];
        $this->controls['cta_button_position'] = [
            'tab'     => 'content',
            'group'   => 'cta_button_style',
            'label' => esc_html__( 'Position', 'wpv-bu' ),
            'type'  => 'direction',
            'inline'      => true,     
            'css'   => [
                [
                    'property' => 'flex-direction',
                    'selector' => '.bultr-cta-buttons',                  
                ],
                
                [
                    'property' => 'display',
                    'value'=>'flex',
                    'selector' => '.bultr-cta-buttons',
                    
                ],
                            
            ],
        ];
        $this->controls['cta-content-bspacing'] = [
            'tab'     => 'content',
            'group'   => 'cta_button_style',
            'label' => esc_html__( 'Spacing', 'wpv-bu' ),
            'type'  => 'number',  
            'unit' => 'px',
            'min' => '0',
            'max' =>'100' ,             
                'step' => 1,
            'css' => [
                [
                    'property' => 'gap',
                    'selector' => '.bultr-cta-buttons',
                ],
            ],
        ];
        $this->controls['cta-button-primary-style'] = [
            'tab'   => 'content',
            'group'=>'cta_button_style',
            'label' => esc_html__( 'Primary ', 'wpv-bu' ),
            'type'  => 'separator',
        ];
        $this->controls['cta-button-typography'] = [
            'tab' => 'content',
            'group'=>'cta_button_style',
            'label' => esc_html__( 'Typography', 'wpv-bu' ),
            'type' => 'typography',
            'css' => [
                [
                    'property' => 'typography',
                    'selector' => '.bultr-cta-button-primary a',
                ],
            ],
            'inline' => true,
            'exclude' => ['color'],
        ];
        $this->controls['cta-button-typography-color'] = [
            'tab' => 'content',
            'group'=>'cta_button_style',
            'label' => esc_html__( 'Color', 'wpv-bu' ),
            'type' => 'color',
            'css' => [
                [
                    'property' => 'color',
                    'selector' => '.bultr-cta-button-primary a',
                ],
                [
                    'property' => 'fill',
                    'selector' => '.bultr-cta-button-primary a svg',
                ],
            ],
            'inline' => true,
        ];
        $this->controls['cta-button-color'] = [
            'tab' => 'content',
            'group'=>'cta_button_style',
            'label' => esc_html__( 'Background Color', 'wpv-bu' ),
            'type' => 'color',
            'css' => [
                [
                    'property' => 'background-color',
                    'selector' => '.bultr-cta-button-primary a',
                ],
            ],
        ];
        $this->controls['cta-button-border'] = [
            'tab' => 'content',
            'group'=>'cta_button_style',
            'label' => esc_html__( 'Border', 'wpv-bu' ),
            'type' => 'border',
            'css' => [  
                [
                    'property' => 'border',
                    'selector' => '.bultr-cta-button-primary a',
            
                ],
                
            ], 
        ];
        $this->controls['cta-button-boxshd'] = [
            'tab' => 'content',
            'group'=>'cta_button_style',
            'label' => esc_html__( 'Box Shadow', 'wpv-bu' ),
            'type' => 'box-shadow',
            'css' => [  
                [
                    'property' => 'box-shadow',
                    'selector' => '.bultr-cta-button-primary a',
            
                ],
                
            ], 
        ];

        $this->controls['cta-button-sec-style'] = [
            'tab'   => 'content',
            'group'=>'cta_button_style',
            'label' => esc_html__( 'Secondary ', 'wpv-bu' ),
            'type'  => 'separator',
        ];

        $this->controls['cta-button-stypography'] = [
            'tab' => 'content',
            'group'=>'cta_button_style',
            'label' => esc_html__( 'Typography', 'wpv-bu' ),
            'type' => 'typography',
            'css' => [
                [
                    'property' => 'typography',
                    'selector' => '.bultr-cta-button-secondary a',
                ],
            ],
            'exclude' => ['color'],
            'inline' => true,
        ];
        $this->controls['cta-button-stypography-color'] = [
            'tab' => 'content',
            'group'=>'cta_button_style',
            'label' => esc_html__( 'Color', 'wpv-bu' ),
            'type' => 'color',
            'css' => [
                [
                    'property' => 'color',
                    'selector' => '.bultr-cta-button-secondary a',
                ],
                [
                    'property' => 'fill',
                    'selector' => '.bultr-cta-button-secondary a svg',
                ],
            ],
            'inline' => true,
        ];
        $this->controls['cta-button-scolor'] = [
            'tab' => 'content',
            'group'=>'cta_button_style',
            'label' => esc_html__( 'Background Color', 'wpv-bu' ),
            'type' => 'color',
            'css' => [
                [
                    'property' => 'background-color',
                    'selector' => '.bultr-cta-button-secondary a',
                ],
            ],
        ];
        $this->controls['cta-button-sborder'] = [
            'tab' => 'content',
            'group'=>'cta_button_style',
            'label' => esc_html__( 'Border', 'wpv-bu' ),
            'type' => 'border',
            'css' => [  
                [
                    'property' => 'border',
                    'selector' => '.bultr-cta-button.bultr-cta-button-secondary a',
            
                ],
                
            ], 
        ];
        $this->controls['cta-button-sboxshd'] = [
            'tab' => 'content',
            'group'=>'cta_button_style',
            'label' => esc_html__( 'Box Shadow', 'wpv-bu' ),
            'type' => 'box-shadow',
            'css' => [  
                [
                    'property' => 'box-shadow',
                    'selector' => '.bultr-cta-button.bultr-cta-button-secondary a',
            
                ],
                
            ], 
        ];
        

        //Ribbon style
        $this->controls['cta-ribbon-color'] = [
            'tab' => 'content',
            'group'=>'cta_ribbon_style',
            'label' => esc_html__( 'Background Color', 'bricks' ),
            'type' => 'color',
            'css' => [
                [
                    'property' => 'background-color',
                    'selector' => '.bultr-cta-ribbon p',
                ],
            ],
        ];
        $this->controls['cta-ribbon-typography'] = [
            'tab' => 'content',
            'group'=>'cta_ribbon_style',
            'label' => esc_html__( 'Typography', 'wpv-bu' ),
            'type' => 'typography',
            'css' => [
                [
                    'property' => 'typography',
                    'selector' => '.bultr-cta-ribbon p',
                ],
            ],
            'inline' => true,
        ];
        $this->controls['cta-ribbon-distance'] = [
            'tab'     => 'content',
            'group'   => 'cta_ribbon_style',
            'label' => esc_html__( 'Distance', 'wpv-bu' ),
            'type'  => 'number',  
            
            'css' => [
                [
                    'property' => 'margin-top',
                    'selector'=>' .bultr-cta-ribbon p '
                ],
                [
                    'property' => 'left',
                    'selector'=>' .bultr-cta-ribbon p '
                ],
            ],
            'min' => 0,
            'max' => 50,
            'step' => 1,
            'unit' => 'px',
        ];
        $this->controls['cta-ribbon-shadow'] = [
            'tab' => 'content',
            'group'=>'cta_ribbon_style',
            'label' => esc_html__( 'Box Shadow', 'wpv-bu' ),
            'type' => 'box-shadow',
            'css' => [
                [
                    'property' => 'box-shadow',
                    'selector' => '&.bultr-cta-main-wrapper .bultr-cta-ribbon p',
                ],
            ],
            'inline' => true,
            'small' => true,
        ];
        //Graphic element style
        $this->controls['cta-graphic-element-spacing'] = [
            'tab' => 'content',
            'group'=>'cta_graphic_style',
            'label' => esc_html__( 'Spacing', 'wpv-bu' ),
            'type' => 'number',
            'unit'=>'px',
            'min'=>'1',
            'max'=>'50',
            'step' => '1',
            'default' => 20,
            'css' => [
                [
                    'property' => 'padding-bottom',
                    'selector' => '.bultr-cta-graphic-element',
                ],
            ],
        ];
        $this->controls['cta-graphic-element-border'] = [
            'tab' => 'content',
            'group'=>'cta_graphic_style',
            'label' => esc_html__( 'Border', 'wpv-bu' ),
            'type' => 'border',
            'css' => [
                [
                    'property' => 'border',
                    'selector' => '.bultr-cta-graphic-element img',
                ],
                [
                    'property' => 'border',
                    'selector' => '.bultr-cta-graphic-element i:before',
                ],
                
            ], 
        ];  
        $this->controls['cta-graphic-element-padding'] = [
            'tab' => 'content',
            'group'=>'cta_graphic_style',
            'label' => esc_html__( 'Padding', 'wpv-bu' ),
            'type' => 'dimensions',
            'css' => [
                [
                    'property' => 'padding',
                    'selector' => '.bultr-cta-graphic-element img',
                ],
                [
                    'property' => 'padding',
                    'selector' => '.bultr-cta-graphic-element i:before',
                ],
                
                
            ], 
        ];
        $this->controls['cta-graphic-element-size'] = [
            'tab' => 'content',
            'group'=>'cta_graphic_style',
            'label' => esc_html__( 'Size', 'wpv-bu' ),
            'type' => 'number',
            'units'=>true,
            'min'=>'1',
            'max'=>'100',
            'step' => '1',
            'css' => [
                [
                    'property' => 'width',
                    'selector' => '.bultr-cta-graphic-element img',
                ],
    
            ],
            'required'=>[
                ['cta-content-select', '=', 'image']
            ],
            

        ];
        $this->controls['cta-graphic-element-size-i'] = [
            'tab' => 'content',
            'group'=>'cta_graphic_style',
            'label' => esc_html__( 'Size', 'wpv-bu' ),
            'type' => 'number',
            'unit'=>'px',
            'min'=>1,
            'max'=>100,
            'step' => '1',
            'css' => [
                [
                    'property' => 'font-size',
                    'selector' => '.bultr-cta-graphic-element i',
                ],
            
            ],
            'required'=>[
                ['cta-content-select', '=', 'icon']
            ]
        ];
        $this->controls['cta-graphic-element-color'] = [
            'tab' => 'content',
            'group'=>'cta_graphic_style',
            'label' => esc_html__( 'Primary Color', 'wpv-bu' ),
            'type' => 'color',
            'css' => [
                [
                    'property' => 'color',
                    'selector' => '.bultr-cta-graphic-element i',
                ],
            ],
            'required'=>[
                ['cta-content-select', '=', 'icon']
            ]
        ];
        $this->controls['cta-hover-effect-overlay'] = [
            'tab' => 'content',
            'group'=>'cta_hover_style',
            'label' => esc_html__( 'Overlay', 'wpv-bu' ),
            'type' => 'color',
            'css' => [
                [
                    'property' => 'background-color',
                    'selector' => '&.bultr-cta-main-wrapper:not(:hover) .bultr-cta-overlay',               
                ],
                
            ], 
        ];
        $this->controls['cta-hover-effect-filters'] = [
            'tab' => 'content',
            'group'=>'cta_hover_style',
            'label' => esc_html__( 'CSS filters', 'bricks' ),
            'type' => 'filters',
            'inline' => true,
            'css' => [
                [
                    'property' => 'filter',
                    'selector' => '.bultr-cta-image img',
                ],
            ],
        ];
        $this->controls['cta-hover-effect-mode'] = [
            'tab' => 'content',
            'group'=>'cta_hover_style',
            'label' => esc_html__( 'Blend Mode', 'bricks' ),
            'type' => 'select',
            'inline' => true,
            'clearable' => false,
            'options'=>[
                'normal'=>esc_html__('Normal','wpv-bu'),
                'multiply'=>esc_html__('Multiply','wpv-bu'),
                'screen'=>esc_html__('Screen','wpv-bu'),
                'overlay'=>esc_html__('Overlay','wpv-bu'),
                'darken'=>esc_html__('Darken','wpv-bu'),
                'lighten'=>esc_html__('Lighten','wpv-bu'),
                'color-dodge'=>esc_html__('Color Dodge','wpv-bu'),
                'color-burn'=>esc_html__('Color Burn','wpv-bu'),
                'hard-light'=>esc_html__('Hard Light','wpv-bu'),
                'soft-light'=>esc_html__('Soft Light','wpv-bu'),
                'difference'=>esc_html__('Difference','wpv-bu'),
                'exclusion'=>esc_html__('Exclusion','wpv-bu'),
                'hue'=>esc_html__('Hue','wpv-bu'),
                'saturation'=>esc_html__('Saturation','wpv-bu'),
                'color'=>esc_html__('Color','wpv-bu'),
                'luminosity'=>esc_html__('Luminosity','wpv-bu'),
            
            ],
            'css' => [
                [
                    'property' => 'mix-blend-mode',
                    'selector' => '.bultr-cta-overlay',
                ],
            ],
        ];
        //overlay hover
        $this->controls['cta-hover-style']=[
            'tab'=>'content',
            'group'=>'cta_hover_style',
            'label'=> esc_html__('Hover','wpv-bu'),
            'type'=>'separator',
        ];
        $this->controls['cta-hover-effect-over'] = [
            'tab' => 'content',
            'group'=>'cta_hover_style',
            'label' => esc_html__( 'Overlay', 'wpv-bu' ),
            'type' => 'color',
            'css' => [
                [
                    'property' => 'background-color',
                    'selector' => '&.bultr-cta-main-wrapper:hover .bultr-cta-overlay',
            
                ],
                
            ], 
        ];
        $this->controls['cta-hover-effect-hfilters'] = [
            'tab' => 'content',
            'group'=>'cta_hover_style',
            'label' => esc_html__( 'CSS filters', 'bricks' ),
            'type' => 'filters',
            'inline' => true,
            'css' => [
                [
                    'property' => 'filter',
                    'selector' => '&.bultr-cta-main-wrapper:hover .bultr-cta-image img',
                ],
            ],
        ];
        $this->controls['cta-hover-effect-hmode'] = [
            'tab' => 'content',
            'group'=>'cta_hover_style',
            'label' => esc_html__( 'Blend Mode', 'bricks' ),
            'type' => 'select',
            'inline' => true,
            'clearable' => false,
            'options'=>[
                'normal'=>esc_html__('Normal','wpv-bu'),
                'multiply'=>esc_html__('Multiply','wpv-bu'),
                'screen'=>esc_html__('Screen','wpv-bu'),
                'overlay'=>esc_html__('Overlay','wpv-bu'),
                'darken'=>esc_html__('Darken','wpv-bu'),
                'lighten'=>esc_html__('Lighten','wpv-bu'),
                'color-dodge'=>esc_html__('Color Dodge','wpv-bu'),
                'color-burn'=>esc_html__('Color Burn','wpv-bu'),
                'hard-light'=>esc_html__('Hard Light','wpv-bu'),
                'soft-light'=>esc_html__('Soft Light','wpv-bu'),
                'difference'=>esc_html__('Difference','wpv-bu'),
                'exclusion'=>esc_html__('Exclusion','wpv-bu'),
                'hue'=>esc_html__('Hue','wpv-bu'),
                'saturation'=>esc_html__('Saturation','wpv-bu'),
                'color'=>esc_html__('Color','wpv-bu'),
                'luminosity'=>esc_html__('Luminosity','wpv-bu'),
            
            ],
            'css' => [
                [
                    'property' => 'mix-blend-mode',
                    'selector' => '&.bultr-cta-main-wrapper:hover .bultr-cta-overlay',
                ],
            ],
        ];
            
           
    }       



    public function enqueue_scripts() {
        wp_enqueue_style( 'bultr-module-style' );
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
            
    public function render(){
        $settings = $this->settings;
        if(!isset($settings['cta-image-choose']) && empty($settings['cta-content-title']) && empty($settings['cta-content-description']) && empty($settings['cta-primary-button']) && empty($settings['cta-secondary-button'])){
            return $this->render_element_placeholder(
				[
					'title' => esc_html__( 'No Content or Image Selected.', 'wpv-bu' ),
				]
			);
        }
        if ( isset( $settings['cta-primary-link'] ) ) {
            $this->set_link_attributes( 'button1', $settings['cta-primary-link'] );
        }
        if ( isset( $settings['cta-secondary-link'] ) ) {
            $this->set_link_attributes( 'button2', $settings['cta-secondary-link'] );
        }
        $layout = $settings['cta-content-select'] ?? 'none';
        $position = $settings['cta-image-layout'] ?? 'default';
        $image_position = isset($settings['cta_image_position']) ? $settings['cta_image_position'] : 'row';
        $elements = $settings['cta-content-select'] ?? 'none' ; 
        $button_icon = $settings['cta-primary-icon-position'] ?? 'left';
        $button_icon_s = $settings['cta-secondary-icon-position'] ?? 'left';
        $ribbon_position = isset($settings['cta-ribbon-position']) ? $settings['cta-ribbon-position']: 'left';
        $hover_effect = $settings['cta-hover-effect-animation'] ?? '';
        $hover_effect_content = $settings['cta-hover-effect-content'] ?? 'none';
        $this->set_attribute( '_root', 'class', 'bultr-cta-main-wrapper' );
        
        $this->set_attribute( '_root', 'class', 'bultr-cta-main-' . $position );
        if($position === "split"){
            $this->set_attribute( '_root', 'class', 'bultr-cta-main-split-' .$image_position);
        }
        if(isset($settings['cta-image-hide']) && $settings['cta-image-hide'] === true ){
            $this->set_attribute('_root','class', 'bultr-img-hide');
        }
        $this->set_attribute( 'elements', 'class', 'bultr-cta-content');
        $this->set_attribute( 'elements', 'class', 'bultr-cta-content-' . $elements );
        $this->set_attribute( 'button', 'class', 'bultr-cta-buttons');
        $this->set_attribute( 'button-icon', 'class', 'bultr-cta-button bultr-cta-button-primary');
        $this->set_attribute( 'button-icon', 'class', 'bultr-cta-icon-' . $button_icon );
        $this->set_attribute( 'button-icon_s', 'class', 'bultr-cta-button bultr-cta-button-secondary' );
        $this->set_attribute( 'button-icon_s', 'class', 'bultr-cta-icon-s-' . $button_icon_s );
        $this->set_attribute( 'primary', 'class', 'bultr-primary-button' );
        $this->set_attribute( 'secondary', 'class', 'bultr-secondary-button' );
        $this->set_attribute( 'ribbon-position', 'class', 'bultr-cta-ribbon');
        $this->set_attribute( 'ribbon-position', 'class', 'bultr-cta-ribbon-' . $ribbon_position );
        $this->set_attribute( 'graphic-element', 'class', 'bultr-cta-graphic-element' );
        $this->set_attribute( 'hover_effect', 'class', 'bultr-cta-image' );
        $this->set_attribute( '_root', 'class', 'bultr-bg-transform' );
        if(!isset($settings['cta-hover-effect-animation'])){
            $this->set_attribute( '_root', 'class', 'bultr-bg-transform-zoom-out'  );
        }
        else{
            $this->set_attribute( '_root', 'class', 'bultr-bg-transform-' . $hover_effect );
        }
        
        
        $this->set_attribute( 'elements', 'class', 'bultr-animated-item--' . $hover_effect_content );
        ?>  
        
            <div <?php echo $this->render_attributes( '_root' ); ?>>
                <div <?php echo $this->render_attributes( 'hover_effect' ); ?>>
                <?php          
                    $image = $this->get_normalized_image_settings($settings, 'cta-image-choose');
                    if(isset($image['url']) && !empty($image['url'])){
                    ?>
                        <img width="auto" height="auto" loading="eager" src="<?php echo $image['url'];?>">
                    <?php
                    }
                    ?>
                    <div class="bultr-cta-overlay">
                    </div>
                </div>
                <?php           
                if ( isset( $this->settings['cta-ribbon-check'] ) == true ) {
                    if(!empty($this->settings['cta-ribbon'])){
                ?>
                    <div <?php echo $this->render_attributes( 'ribbon-position' ); ?>>
                    
                    <p><?php echo $this->settings['cta-ribbon'];?></p>

                    </div>
                <?php  }} ?>
                <div <?php echo $this->render_attributes( 'elements' ); ?>>
                    <?php           
                        if ( isset( $this->settings['cta-content-image'] )  ) {
                    ?>
                        <?php 
                            if($layout=='image') { 
                        ?>
                            <span <?php echo $this->render_attributes( 'graphic-element' ); ?>>
                                <?php
                                    $atts['_brx_disable_lazy_loading']  = true;
                                    $atts['loading'] = "eager";
                                    echo wp_get_attachment_image(
                                        $this->settings['cta-content-image']['id'],
                                        $this->settings['cta-content-image']['size'], false,$atts ); 
                                ?>
                            </span>
                    <?php } }?>
                    <?php 
                        if($layout=='icon') { 
                    ?>
                        <span <?php echo $this->render_attributes( 'graphic-element' ); ?>>
                            <?php
                                $icon = ! empty( $settings['cta-content-icon'] ) ? self::render_icon( $settings['cta-content-icon'], '' ) : false ;
                                echo $icon
                            ?>
                        </span>
                    <?php } ?>
                                        
                    <?php           
                    if ( isset( $this->settings['cta-content-title'] )  ) {
                        $titletag = isset($this->settings['cta-title-tag']) ? $this->settings['cta-title-tag'] : __('h3','wpv-bu');
                    ?>
                
                        <<?php echo $titletag?> class = "bultr-cta-title"> 
                            <?php echo $this->settings['cta-content-title'];?>
                        </<?php echo $titletag?>>
                    <?php } ?>
                    <?php           
                        if ( isset( $this->settings['cta-content-subtitle'] )  ) {
                            $subTitleTag = isset($this->settings['cta-subtitle-tag']) ? $this->settings['cta-subtitle-tag'] : __('h5','wpv-bu');
                    ?>
                        <<?php echo $subTitleTag ?> class="bultr-cta-sub-title" >
                            <?php echo $this->settings['cta-content-subtitle'];?>
                        </<?php echo $subTitleTag?>>
                    <?php } ?>
                    <?php           
                        if ( isset( $this->settings['cta-content-description'] )  ) {
                    ?>
                        <p class="bultr-cta-description">
                            <?php echo $this->settings['cta-content-description'];?>
                        </p>
                    <?php } ?>
                    <?php           
                        if ( isset( $this->settings['cta-primary-button'] )  ) {
                    ?>
                    <span <?php echo $this->render_attributes( 'button' ); ?>>
                            <span <?php echo $this->render_attributes( 'button-icon' ); ?>>
                                <a <?php echo $this->render_attributes( 'button1' ); ?>>
                                    <?php echo $this->settings['cta-primary-button'];?> 
                                    <?php $icon = ! empty( $settings['cta-primary-icon'] ) ? self::render_icon( $settings['cta-primary-icon'], '' ) : false ;
                                    echo $icon
                                    ?>
                                </a>
                            </span>
                    <?php } ?>
                    <?php           
                        if ( isset( $this->settings['cta-secondary-button'] )  ) {
                    ?>        
                        <span <?php echo $this->render_attributes( 'button-icon_s' ); ?>>            
                            <a <?php echo $this->render_attributes( 'button2' ); ?>>
                                <?php echo $this->settings['cta-secondary-button'];?>  
                                <?php $icon = ! empty( $settings['cta-secondary-icon'] ) ? self::render_icon( $settings['cta-secondary-icon'], '' ) : false ;
                                echo $icon
                                ?> 
                            </a>
                        </span>
                    <?php } ?>
                    </span>
                </div>
            </div>
    
    <?php
    }

    public static function render_builder() { 
    ?>
        <script type="text/x-template" id="tmpl-bricks-element-wpvbu-call-to-action">
            <component
                v-if = "settings['cta-image-choose'] || settings['cta-content-title'] || settings['cta-content-description'] || settings['cta-primary-button'] || settings['cta-secondary-button']" 
                :is="'div'" 
                :class= "['bultr-cta-main-wrapper','bultr-is-editor',
                settings['cta-image-layout'] ? `bultr-cta-main-${settings['cta-image-layout']}`: 'bultr-cta-main-default',
                'bultr-bg-transform', 
                settings['cta-hover-effect-animation'] ? `bultr-bg-transform-${settings['cta-hover-effect-animation']}`: 'bultr-bg-transform-zoom-out', 
                settings['cta-image-layout'] === 'split' && settings['cta_image_position'] ? `bultr-cta-main-split-${settings['cta_image_position']}`:'bultr-cta-main-split-column',
                settings['cta-image-hide'] === true ? 'bultr-img-hide' : '']">
                <div :class= "['bultr-cta-image']" >
                    <img :src="settings['cta-image-choose'] ? `${settings['cta-image-choose'].url}` : `${settings.placeHolderImage}`" />   
                    <div :class= "['bultr-cta-overlay']">   
                    </div>           
                </div>
                <div 
                    v-if="settings['cta-ribbon-check'] === true && settings['cta-ribbon'] != null"
                    :class= "['bultr-cta-ribbon',
                    settings['cta-ribbon-position'] ? `bultr-cta-ribbon-${settings['cta-ribbon-position']}` : 'bultr-cta-ribbon-left']">
                    <p>{{settings['cta-ribbon']}}</p>
                </div>
                <div
                    :class= "['bultr-cta-content',
                    'bultr-cta-content-default' ,
                    settings['cta-hover-effect-content'] ? `bultr-animated-item--${settings['cta-hover-effect-content']}`: null]">
                    <span
                        :class= "['bultr-cta-graphic-element']"
                        v-if="settings['cta-content-select'] === 'image'"
                    >
                        <img :src="settings['cta-content-image'] ? `${settings['cta-content-image'].url}` : null" />
                    </span>
                    <span
                        :class= "['bultr-cta-graphic-element']"
                        v-else-if="settings['cta-content-select'] === 'icon'">
                        <icon-svg v-if="settings['cta-content-icon']?. icon || settings['cta-content-icon']?. svg" :iconSettings="settings['cta-content-icon']"/>
                    </span>
                    <component :is = "settings['cta-title-tag']" class= 'bultr-cta-title' v-if="settings['cta-content-title']">{{settings['cta-content-title']}}
                    </component>
                    <component :is = "settings['cta-subtitle-tag']"
                        :class="['bultr-cta-sub-title']"
                        v-if="settings['cta-content-subtitle']">{{settings['cta-content-subtitle']}}
                    </component>
                    <p 
                        :class="['bultr-cta-description']"
                        v-if="settings['cta-content-description']">{{settings['cta-content-description']}}
                    </p>
                    <span
                        :class="['bultr-cta-buttons']"> 
                        <span v-if ="settings['cta-primary-button'] || settings['cta-primary-icon']?. icon || settings['cta-primary-icon']?. svg"
                            :class="['bultr-cta-button','bultr-cta-button-primary',
                            settings['cta-primary-icon-position'] ? `bultr-cta-icon-${settings['cta-primary-icon-position']}`:null]">
                            <a>
                                {{settings['cta-primary-button']}} 
                                <icon-svg v-if="settings['cta-primary-icon']?. icon || settings['cta-primary-icon']?. svg" :iconSettings="settings['cta-primary-icon']"/>
                            </a>
                        </span>
                        <span v-if ="settings['cta-secondary-button'] || settings['cta-secondary-icon']?. icon || settings['cta-secondary-icon']?. svg" 
                        :class="['bultr-cta-button','bultr-cta-button-secondary',settings['cta-secondary-icon-position'] ? `bultr-cta-icon-s-${settings['cta-secondary-icon-position']}`:null]">
                            <a>
                                {{settings['cta-secondary-button']}}
                                <icon-svg v-if="settings['cta-secondary-icon']?. icon || settings['cta-secondary-icon']?. svg" :iconSettings="settings['cta-secondary-icon']"/>
                            </a>
                        </span>
                    </span>
                </div>        
            </component>  
            <div v-else v-html="renderElementPlaceholder()"> </div>
                
        </script> 
        
    <?php
    }
    
}

    