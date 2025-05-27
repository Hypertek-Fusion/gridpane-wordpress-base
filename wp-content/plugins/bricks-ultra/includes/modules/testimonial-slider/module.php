<?php
namespace BricksUltra\Modules\TestimonialSlider;

use Bricks\Element;
use BricksUltra\includes\Swiper_helper;
use Bricks\Breakpoints;



class Module extends Element {
    public $category     = 'ultra';
	public $name         = 'wpvbu-testimonial-slider';
	public $icon         = 'ti-comment-alt';
	public $css_selector = '';
    public $scripts      = ['bu_testimonial_slider'];
	public $flag = '';
    

    public function get_label() {
		return esc_html__( 'Testimonial Slider', 'wpv-bu' );
	}

    public function get_keywords() {
		return [ 'testimonial', 'testimonial-slider','slider'];
	}

    public function enqueue_scripts(){
        wp_enqueue_style( 'bultr-module-style' );
        wp_enqueue_script('bultr-module-script');

        if(!wp_style_is('bricks-font-awesome','enqueued')){
            wp_enqueue_style( 'bricks-font-awesome', BRICKS_URL_ASSETS . 'css/libs/font-awesome.min.css', [ 'bricks-frontend' ], filemtime( BRICKS_PATH_ASSETS . 'css/libs/font-awesome.min.css' ) );
        }
            wp_enqueue_script( 'bricks-swiper' );
            wp_enqueue_style( 'bricks-swiper' );
    }

	public function set_control_groups() {
        
		$this->control_groups['testimonial_details'] = [
			'title' => esc_html__( 'Testimonial Details', 'wpv-bu' ),
			'tab'   => 'content',
		];

        $this->control_groups['preset_style'] = [
            'title' => esc_html__( 'Preset Style', 'wpv-bu' ),
            'tab'   => 'content',
        ];

        $this->control_groups['rating_style'] = [
            'title' => esc_html__( 'Rating Style', 'wpv-bu' ),
            'tab'   => 'content',
        ];

        $this->control_groups['overlay_style'] = [
            'title'         => esc_html__( 'Image Overlay', 'wpv-bu' ),
            'tab'           => 'content',
            'required'      =>[
                                [ 'preset_select','=','preset3'],
                            ],
        ];

        $this->control_groups['preset1_ordering'] = [
            'title'         => esc_html__( 'Order ', 'wpv-bu' ),
            'tab'           => 'content',
            'required'      =>[
                                [ 'preset_select','=','preset1'],
                            ],
        ];
        $this->control_groups['ordering'] = [
            'title'         => esc_html__( 'Order ', 'wpv-bu' ),
            'tab'           => 'content',
            'required'      =>[
                                [ 'preset_select','!=','preset1'],
                            ],
        ];
        
        $this->control_groups['swiper_test'] = [
            'title' => esc_html__( 'Slider', 'wpv-bu' ),
            'tab'   => 'content',
        ];

        $this->control_groups['swiper-style'] = [
            'title' => esc_html__( 'Slider Style', 'wpv-bu' ),
            'tab'   => 'content',
        ];
        
	}

    public function get_breakpoints_data() {
        $breakpoints = Breakpoints::get_breakpoints();
        $options = [];

        $options = ['none' => __('None', 'wpv-bu')];
        foreach ($breakpoints as $breakpoint) {
            $options[$breakpoint['width']] = $breakpoint['label'];
        }
        return $options;
    }

	public function set_controls(){
		$this->controls['preset_select'] = [
			'tab'               => 'content',
			'label'             => __( 'Select Preset', 'wpv-bu' ),
            'type'              => 'select',
            'options'           => [
                'preset1'       => 'Preset 1',
                'preset2'       => 'Preset 2',
                'preset3'       => 'Preset 3',
            ],
            'default'           => 'preset1',
            'clearable'         => false,
            'inline'            => true,
		];
     
        $this->controls['testimonial_data'] = [
			'tab'           => 'content',
			'group'         => 'testimonial_details',
			'placeholder'   => esc_html__( 'Testimonial Details', 'wpv-bu' ),
			'type'          => 'repeater',
			'titleProperty' => 'author',

            'default'       => [

                [
                    'image'    => [
                        'full' => 'https://source.unsplash.com/random/700x700?man',
						'url'  => 'https://source.unsplash.com/random/700x700?man',
					],
                    'additional_image' =>[
                        'full' => 'https://source.unsplash.com/random/800x800?woman',
						'url'  => 'https://source.unsplash.com/random/800x800?woman',
					],
                    'author'          => esc_html__('Aida Bugg', 'wpv-bu'),
                    'designation'     => esc_html__('CEO', 'wpv-bu'),
                    'company_name'    => esc_html('Google', 'wpv-bu'),
                    'description'     => esc_html('Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'wpv-bu'),
                    'rating'          => 5,
                ], 
                [
                    'image'    => [
                        'full' => 'https://source.unsplash.com/random/700x700?man',
						'url'  => 'https://source.unsplash.com/random/700x700?man',
					],
                    'additional_image' =>[
                        'full' => 'https://source.unsplash.com/random/800x800?woman',
						'url'  => 'https://source.unsplash.com/random/800x800?woman',
					],
                    'author'          => esc_html__('Ray O’Sun', 'wpv-bu'),
                    'designation'     => esc_html__('CFO', 'wpv-bu'),
                    'company_name'    => esc_html__('Google', 'wpv-bu'),
                    'description'     => esc_html__('Sociis natoque penatibus et magnis dis parturient.','wpv-bu'),
                    'rating'          => 5,
                ], 
            ],
            
            'fields'        => [
                    'image'     => [
                        'tab'   => 'content',
                        'label' => esc_html__( 'Avatar', 'wpv-bu' ),
                        'type'  => 'image',
                    ],
                    'additional_image'     => [
                        'tab'   => 'content',
                        'label' => esc_html__( 'Image', 'wpv-bu' ),
                        'type'  => 'image',
                        'required'      => [
                            [ 'preset_select','!=','preset1',
                            ],
                        ],
                    ],
                    'author' => [
                        'tab'   => 'content',
                        'label' => esc_html__( 'Author', 'wpv-bu' ),
                        'type'  => 'text',
                    ],

                    'designation' => [
                        'tab'   => 'content',
                        'label' => esc_html__( 'Designation', 'wpv-bu' ),
                        'type'  => 'text',
                    ],

                    'company_name' => [
                        'tab'   => 'content',
                        'label' => esc_html__( 'Company Name', 'wpv-bu' ),
                        'type'  => 'text',
                    ],
				
                    'description' => [
                        'tab'   => 'content',
                        'label' => esc_html__( 'Description', 'wpv-bu' ),
                        'type'  => 'textarea',
                    ],
                
                    'rating'    =>[
                        'tab'   => 'content',
                        'label' => esc_html__( 'Rating', 'wpv-bu' ),
                        'type'  => 'number',
                        'default' => 5,
                        'min' => 0,
                        'max' => 5,
                        'description' => esc_html__( 'Enter rating between 0 to 5', 'wpv-bu' ),
                    ],
                
			],
		];
        $this->perset_style();
        $this->get_testimonial_rating();
        $this->overlay_style();
        $this->get_ordering();
        $this->preset1_ordering();
        $this->get_testimonail_swiper_controls();
    }

    public function get_testimonail_swiper_controls(){
        $swiperControls = new Swiper_helper();
        $swiperControls->add_swiper_controls($this,
            [
                'control_name'      => 'testimonial_slider',
                'tab'               => 'content',
                'group'             =>  'swiper_test',
                'slides_per_view'   => 1,
            ]
        );
        $swiperControls->add_swiper_style_controls($this,
            [
                'control_name'      => 'testimonial_slider',
                'tab'               => 'content',
                'wrapper-class'     => '.bultr-testimonial-slider',
                'group'             => 'swiper-style',
            ]
        );
    }

    public function perset_style(){
        $this->controls['box_sep'] = [
            'tab'           => 'content',
            'type'          => 'separator',
            'label'         => esc_html__( 'Box', 'wpv-bu' ),
            'group'         => 'preset_style',
        ];
        $this->controls['box_bg_color'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Background', 'wpv-bu' ),
            'type'          => 'background',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'background-color',
                'selector'  => '.bultr-ts-content-wrapper'
                ],
            ],
            'default'       =>[
                'color'     => [
                    'hex'   => '#ebebeb',
                  ],
            ],
            'inline'        => true,
        ];
        $this->controls['preset1_box_alignment']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Alignment', 'wpv-bu' ),
            'type'          => 'select',
            'options'       => [
                'left'      => 'Left',
                'center'    => 'Center',
                'right'     => 'Right',
            ],
            'default'       => 'center',
            'clearable'     => false,
            'inline'        => true,
            'required'      => [
                [ 'preset_select','=','preset1',
                ],
            ],
        ];
        $this->controls['box_border'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Border', 'wpv-bu' ),
            'type'          => 'border',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'border',
                'selector'  => '.bultr-ts-content-wrapper'
                ],
                [
                'property'  => 'border',
                'selector'  => '.bultr-testimonial-slider'
                    ],
            ],
            'inline'        => true,
        ];
        $this->controls['box_padding'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Padding', 'wpv-bu' ),
            'type'          => 'dimensions',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ts-content-wrapper.bultr-ts-preset3'
                ],
            ],
            'required'      => [
                [ 'preset_select','=','preset3',
                ],
            ],
        ];
        $this->controls['preset_box_padding'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Padding', 'wpv-bu' ),
            'type'          => 'dimensions',
            'units'         => true,
            'placeholder'   => [
                'top'       => '50',
                'right'     => '50',
                'bottom'    => '50',
                'left'      => '50',
            ],
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ts-content-wrapper.bultr-ts-preset1'
                ],
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ts-content-wrapper.bultr-ts-preset2'
                ],
            ],
            'required'      => [
                [ 'preset_select','!=','preset3'],
            ],
        ];
       
        $this->controls['content_sep'] = [
            'tab'           => 'content',
            'type'          => 'separator',
            'label'         => esc_html__( 'Content', 'wpv-bu' ),
            'group'         => 'preset_style',
            'required'      => [
                [ 'preset_select','!=','preset1',
                ],
            ],
        ];
        $this->controls['show_rating']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Show Rating', 'wpv-bu' ),
            'type'          => 'checkbox',
            'default'       => true,
            'inline'        => true,
            'required'      => [
                [ 'preset_select','=','preset3'],
            ],
        ];
        $this->controls['show_author']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Show Author', 'wpv-bu' ),
            'type'          => 'checkbox',
            'default'       => true,
            'inline'        => true,
            'required'      => [
                [ 'preset_select','=','preset3'],
            ],
        ];
        $this->controls['show_designation']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Show Designation', 'wpv-bu' ),
            'type'          => 'checkbox',
            'default'       => true,
            'inline'        => true,
            'required'      => [
                [ 'preset_select','=','preset3'],
            ],
        ];
        $this->controls['show_company_name']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Show Company Name', 'wpv-bu' ),
            'type'          => 'checkbox',
            'default'       => false,
            'inline'        => true,
            'required'      => [
                [ 'preset_select','=','preset3'],
            ],
        ];
        $this->controls['content_bg']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Background', 'wpv-bu' ),
            'type'          => 'background',
            'css'           => [
                [
                'property'  => 'background-color',
                'selector'  => '.bultr-ts-content-section',
                ],
            ],
            'inline'        => true,
            'required'      => [
                [ 'preset_select','!=','preset1'],
            ],
        ];
        $this->controls['preset2_hori_alignment']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Horizontal Alignment', 'wpv-bu' ),
            'type'          => 'select',
            'options'       => [
                'left'      => 'Left',
                'center'    => 'Center',
                'right'     => 'Right',
            ],
            'default'       => 'left',
            'clearable'     => false,
            'inline'        => true,
            'required'      => [
                [ 'preset_select','=','preset2'],
            ],
        ];
         $this->controls['preset2_content_align'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Vertical Alignment', 'wpv-bu' ),
            'type'          => 'align-items',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'align-self',
                'selector'  => '.bultr-ts-content-section',
                ],
            ],
            'required'      => [
                [ 'preset_select','=','preset2'],
            ],
        ];
        $this->controls['preset2_content_position']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Position', 'wpv-bu' ),
            'type'          => 'justify-content',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'justify-content',
                'selector'  => '.bultr-ts-preset2 .bultr-ts-content-section',
                ],
            ],
            'exclude'       => ['space'],
            'inline'        => true,
            'required'      => [
                [ 'preset_select','=','preset2'],
                [  'preset2_content_align','=','stretch'],
            ],
        ];

        $this->controls['preset3_hori_alignment']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Horizontal Alignment', 'wpv-bu' ),
            'type'          => 'select',
            'options'       => [
                'left'      => 'Left',
                'center'    => 'Center',
                'right'     => 'Right',
            ],
            'default'       => 'left',
            'clearable'     => false,
            'inline'        => true,
            'required'      => [
                [ 'preset_select','=','preset3'],
            ],
        ];
        $this->controls['preset3_content_align'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Vertical Alignment', 'wpv-bu' ),
            'type'          => 'align-items',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'align-self',
                'selector'  => '.bultr-ts-preset3 .bultr-ts-content-section',
                ],
            ],
            'required'      => [
                [ 'preset_select','=','preset3'],
            ],
        ];
        $this->controls['preset3_content_position']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Position', 'wpv-bu' ),
            'type'          => 'justify-content',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'justify-content',
                'selector'  => '.bultr-ts-preset3 .bultr-ts-content-section',
                ],
            ],
            'exclude'       => ['space'],
            'inline'        => true,
            'required'      => [
                [ 'preset_select','=','preset3'],
                [  'preset3_content_align','=','stretch'],
            ],
        ];
        $this->controls['content_gap']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Gap', 'wpv-bu' ),
            'type'          => 'number',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'gap',
                'selector'  => '.bultr-ts-content-wrapper',
                ],
            ],
            'required'      => [
                [ 'preset_select','!=','preset1'],
            ],
            'inline'        => true,
        ];
        $this->controls['content_padding'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Padding', 'wpv-bu' ),
            'type'          => 'dimensions',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ts-content-section',
                ],
            ],
            'required'      => [
                                [ 'preset_select','!=','preset1'],
                                ],
        ];

        $this->controls['author_sep'] = [
            'tab'           => 'content',
            'type'          => 'separator',
            'label'         => esc_html__( 'Author', 'wpv-bu' ),
            'group'         => 'preset_style',
        ];
        $this->controls['author_bg']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Background', 'wpv-bu' ),
            'type'          => 'background',
            'css'           => [
                [
                'property'  => 'background-color',
                'selector'  => '.bultr-ts-content-wrapper .bultr-ts-name'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['author_typo']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Typography', 'wpv-bu' ),
            'type'          => 'typography',
            'css'           => [
                [
                'property'  => 'typography',
                'selector'  => '.bultr-ts-content-wrapper .bultr-ts-name'
                ],
            ],
            'exclude'       =>['text-align'],
            'inline'        => true,
        ];
        $this->controls['author_padding']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Padding', 'wpv-bu' ),
            'type'          => 'dimensions',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ts-content-wrapper .bultr-ts-name'
                ],
            ],
        ];
        $this->controls['author_margin']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Margin', 'wpv-bu' ),
            'type'          => 'dimensions',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'margin',
                'selector'  => '.bultr-ts-content-wrapper .bultr-ts-name'
                ],
            ],
        ];

        //preset 1nd image style
        $this->controls['preset1_avatar_sep'] = [
            'tab'           => 'content',
            'type'          => 'separator',
            'label'         => esc_html__( 'Avatar', 'wpv-bu' ),
            'group'         => 'preset_style',
            'required'      => [
                [ 'preset_select','=','preset1'],
            ],
        ];
        $this->controls['preset1_avatar_width'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Width', 'wpv-bu' ),
            'type'          => 'number',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'width',
                'selector'  => '.bultr-ts-preset1 .bultr-ts-content-img'
                ],
            ],
            'required'      => [
                [ 'preset_select','=','preset1'],
            ],
            'inline'        => true,
        ];
        $this->controls['preset1_avatar_border'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Border', 'wpv-bu' ),
            'type'          => 'border',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'border',
                'selector'  => '.bultr-ts-preset1 .bultr-ts-content-img'
                ],
            ],
            'required'      => [
                [ 'preset_select','=','preset1'],
            ],
            'inline'        => true,
        ];
        $this->controls['preset1_avatar_box_shadow'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Box Shadow', 'wpv-bu' ),
            'type'          => 'box-shadow',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'box-shadow',
                'selector'  => '.bultr-ts-preset1 .bultr-ts-content-img'
                ],
            ],
            'inline'        => true,
            'required'      => [
                [ 'preset_select','=','preset1'],
            ],
        ];

        //avatar image style
        $this->controls['avatar_sep']=[
            'tab'           =>'content',
            'type'          =>'separator',
            'label'         =>esc_html__( 'avatar', 'wpv-bu' ),
            'group'         =>'preset_style',
            'required'      => [
                [ 'preset_select','!=','preset1'],
            ],
        ];
        $this->controls['avatar_width'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Width', 'wpv-bu' ),
            'type'          => 'number',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'width',
                'selector'  => '.bultr-ts-avatar-image'
                ],
            ],
            'required'      => [
                [ 'preset_select','!=','preset1'],
            ],
            'inline'        => true,
        ];
        $this->controls['avatar_position']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Position', 'wpv-bu' ),
            'type'          => 'select',
            'options'       => [
                'left'      => 'Left',
                'right'     => 'Right',
            ],
            'default'       => 'left',
            'clearable'     => false,
            'inline'        => true,
            'required'      => [
                [ 'preset_select','!=','preset1'],
            ],
        ];
        $this->controls['avatar_gap']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Gap', 'wpv-bu' ),
            'type'          => 'number',
            'units'         => true,
            'css'           => [
                [
                    'property'  => 'gap',
                    'selector'  => '.bultr-ts-author-info-wrapper'
                    ],
            ],
            'required'      => [
                [ 'preset_select','!=','preset1'],
            ],
            'inline'        => true,
        ];
        $this->controls['avatar_border'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Border', 'wpv-bu' ),
            'type'          => 'border',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'border',
                'selector'  => '.bultr-ts-avatar-image img'
                ],
            ],
            'required'      => [
                [ 'preset_select','!=','preset1'],
            ],
            'inline'        => true,
        ];
        $this->controls['avatar_box_shadow'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Box Shadow', 'wpv-bu' ),
            'type'          => 'box-shadow',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'box-shadow',
                'selector'  => '.bultr-ts-avatar-image img'

                ],
            ],
            'required'      => [
                [ 'preset_select','!=','preset1'],
            ],
            'inline'        => true,
        ];
        $this->controls['avatar_margin'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Margin', 'wpv-bu' ),
            'type'          => 'dimensions',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'margin',
                'selector'  => '.bultr-ts-avatar-image'

                ],
            ],
            'required'      => [
                [ 'preset_select','!=','preset1'],
            ],
        ];


        //preset 2nd image style
        $this->controls['preset2_image_sep'] = [
            'tab'           => 'content',
            'type'          => 'separator',
            'label'         => esc_html__( 'Image', 'wpv-bu' ),
            'group'         => 'preset_style',
            'required'      => [
                [ 'preset_select','=','preset2',
                ],
            ],
        ];
        $this->controls['break_points_select'] = [
            'tab'       => 'content',
            'group'         => 'preset_style',
            'label'     => __( 'Hide Image Below', 'wpv-bu' ),
            'type'      => 'select',
            'options'   => $this->get_breakpoints_data(),
            'inline'    => true,
            'clearable' => false,
            'required'      => [
                [ 'preset_select','=','preset2'],
            ],
            'default'   => 'none',
        ];
        $this->controls['preset2_image_position']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Position', 'wpv-bu' ),
            'type'          => 'select',
            'options'       => [
                'left'      => 'Left',
                'right'     => 'Right',
            ],
            'default'       => 'left',
            'clearable'     => false,
            'inline'        => true,
            'required'      => [
                [ 'preset_select','=','preset2',
                ],
            ],
        ];
        $this->controls['preset2_image_width'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Width', 'wpv-bu' ),
            'type'          => 'number',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'width',
                'selector'  => '.bultr-ts-preset2 .bultr-ts-image',
                ],
            ],
            'required'      => [
                [ 'preset_select','=','preset2',
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['preset2_image_align'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Alignment', 'wpv-bu' ),
            'type'          => 'align-items',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'align-self',
                'selector'  => '.bultr-ts-preset2 .bultr-ts-image',
                ],
            ],
            'required'      => [
                [ 'preset_select','=','preset2',
                ],
            ],
        ];
        $this->controls['preset2_image_border'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Border', 'wpv-bu' ),
            'type'          => 'border',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'border',
                'selector'  => '.bultr-ts-preset2 .bultr-ts-content-img'
                ],
            ],
            'required'      => [
                [ 'preset_select','=','preset2',
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['preset2_image_box_shadow'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Box Shadow', 'wpv-bu' ),
            'type'          => 'box-shadow',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'box-shadow',
                'selector'  => '.bultr-ts-preset2 .bultr-ts-content-img'
                ],
            ],
            'required'      => [
                [ 'preset_select','=','preset2',
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['preset2_image_margin']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Margin', 'wpv-bu' ),
            'type'          => 'dimensions',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'margin',
                'selector'  => '.bultr-ts-preset2 .bultr-ts-content-img'
                ],
            ],
            'required'      => [
                [ 'preset_select','=','preset2',
                ],
            ],
        ];


        
        //preset 3rd image style
        $this->controls['preset3_image_sep'] = [
            'tab'           => 'content',
            'type'          => 'separator',
            'label'         => esc_html__( 'Image', 'wpv-bu' ),
            'group'         => 'preset_style',
            'required'      => [
                [ 'preset_select','=','preset3',
                ],
            ],
        ];
        $this->controls['preset3_image_position']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Position', 'wpv-bu' ),
            'type'          => 'select',
            'options'       => [
                'left'      => 'Left',
                'right'     => 'Right',
            ],
            'default'       => 'right',
            'clearable'     => false,
            'inline'        => true,
            'required'      => [
                [ 'preset_select','=','preset3',
                ],
            ],
        ];
        $this->controls['preset3_image_width'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Width', 'wpv-bu' ),
            'type'          => 'number',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'width',
                'selector'  => '.bultr-ts-img-wrapper'
                ],
            ],
            'required'      => [
                [ 'preset_select','=','preset3',
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['preset3_image_border'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Border', 'wpv-bu' ),
            'type'          => 'border',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'border',
                'selector'  => '.bultr-ts-img-wrapper'
                ],
            ],
            'required'      => [
                [ 'preset_select','=','preset3',
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['preset3_image_box_shadow'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Box Shadow', 'wpv-bu' ),
            'type'          => 'box-shadow',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'box-shadow',
                'selector'  => '.bultr-ts-img-wrapper'

                ],
            ],
            'required'      => [
                [ 'preset_select','=','preset3',
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['preset3_image_margin'] = [
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Margin', 'wpv-bu' ),
            'type'          => 'dimensions',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'margin',
                'selector'  => '.bultr-ts-img-wrapper'

                ],
            ],
            'required'      => [
                [ 'preset_select','=','preset3',
                ],
            ],
        ];


        $this->controls['designation_sep'] = [
            'tab'           => 'content',
            'type'          => 'separator',
            'label'         => esc_html__( 'Designation', 'wpv-bu' ),
            'group'         => 'preset_style',
        ];
        $this->controls['designation_bg']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Background', 'wpv-bu' ),
            'type'          => 'background',
            'css'           => [
                [
                'property'  => 'background-color',
                'selector'  => '.bultr-ts-content-wrapper .bultr-ts-designation'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['designation_typo']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Typography', 'wpv-bu' ),
            'type'          => 'typography',
            'css'           => [
                [
                'property'  => 'typography',
                'selector'  => '.bultr-ts-content-wrapper .bultr-ts-designation'
                ],
            ],
            'exclude' => [
                  'text-align',
                ],
           
            'inline'        => true,
        ];   
        $this->controls['designation_padding']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Padding', 'wpv-bu' ),
            'type'          => 'dimensions',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ts-content-wrapper .bultr-ts-designation'
                ],
            ],
        ];
        $this->controls['designation_margin']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Margin', 'wpv-bu' ),
            'type'          => 'dimensions',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'margin',
                'selector'  => '.bultr-ts-content-wrapper .bultr-ts-designation'
                ],
            ],
        ];

        $this->controls['company_sep']= [
            'tab'           => 'content',
            'type'          => 'separator',
            'label'         => esc_html__( 'Company Name', 'wpv-bu' ),
            'group'         => 'preset_style',
        ];
        $this->controls['company_bg']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Background', 'wpv-bu' ),
            'type'          => 'background',
            'css'           => [
                [
                'property'  => 'background-color',
                'selector'  => '.bultr-ts-content-wrapper .bultr-ts-company-name'
                ],
            ],
            'inline'        => true,
        ];  
        $this->controls['company_typo']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Typography', 'wpv-bu' ),
            'type'          => 'typography',
            'css'           => [
                [
                'property'  => 'typography',
                'selector'  => '.bultr-ts-content-wrapper .bultr-ts-company-name'
                ],
            ],
            'exclude' => [
                  'text-align',
                ],

            'inline'        => true,
        ];     
        $this->controls['company_padding']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Padding', 'wpv-bu' ),
            'type'          => 'dimensions',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ts-content-wrapper .bultr-ts-company-name'
                ],
            ],
        ];
        $this->controls['company_margin']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Margin', 'wpv-bu' ),
            'type'          => 'dimensions',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'margin',
                'selector'  => '.bultr-ts-content-wrapper .bultr-ts-company-name'
                ],
            ],
        ];


        $this->controls['description_sep'] = [
            'tab'           => 'content',
            'type'          => 'separator',
            'label'         => esc_html__( 'Description', 'wpv-bu' ),
            'group'         => 'preset_style',
        ];
        $this->controls['description_bg']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Background', 'wpv-bu' ),
            'type'          => 'background',
            'css'           => [
                [
                'property'  => 'background-color',
                'selector'  => '.bultr-ts-content-wrapper .bultr-ts-content-desc'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['description_typo']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Typography', 'wpv-bu' ),
            'type'          => 'typography',
            'css'           => [
                [
                'property'  => 'typography',
                'selector'  => '.bultr-ts-content-wrapper .bultr-ts-content-desc'
                ],
            ],
            'exclude' => [
                  'text-align',
                ],
            'default'=>[
                'line-height'=>'1.3',
            ],
            'inline'        => true,
        ];
        $this->controls['description_padding']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Padding', 'wpv-bu' ),
            'type'          => 'dimensions',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ts-content-wrapper .bultr-ts-content-desc',
                ],
            ],
        ];
        $this->controls['description_margin']=[
            'tab'           => 'content',
            'group'         => 'preset_style',
            'label'         => esc_html__( 'Margin', 'wpv-bu' ),
            'type'          => 'dimensions',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'margin',
                'selector'  => '.bultr-ts-content-wrapper .bultr-ts-content-desc',
                ],
            ],
        ];
    }

    public function get_testimonial_rating(){
        $this->controls['filled_icon']=[
            'tab'           => 'content',
            'group'         => 'rating_style',
            'label'         => esc_html__( 'Marked Icon', 'wpv-bu' ),
            'type'          => 'icon',
            'default'  => [
				'library' => 'fontawesomeSolids',
				'icon'    => 'fas fa-star',
			],
        ];
        $this->controls['half_fill_icon']=[
            'tab'           => 'content',
            'group'         => 'rating_style',
            'label'         => esc_html__( 'Half Marked Icon', 'wpv-bu' ),
            'type'          => 'icon',
            'default'       => [
				'library'   => 'fontawesomeSolids',
				'icon'      => 'fas fa-star-half-stroke',
			],
        ];
        $this->controls['unmarked_icon']=[
            'tab'           => 'content',
            'group'         => 'rating_style',
            'label'         => esc_html__( 'Unmarked Icon', 'wpv-bu' ),
            'type'          => 'icon',
            'default'  => [
				'library'   => 'fontawesomeRegulars',
				'icon'      => 'fa fa-star',
			],
        ];
        $this->controls['rating_size']=[
            'tab'           => 'content',
			'group'         => 'rating_style',
			'label'         => esc_html__( 'Size', 'wpv-bu' ),
			'type'          => 'number',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'font-size',
                'selector'  => '.bultr-ts-rating'
                ],
            ],
            'inline'        => true,

        ];
        $this->controls['mark_color']=[
            'tab'           => 'content',
			'group'         => 'rating_style',
			'label'         => esc_html__( 'Marked Color', 'wpv-bu' ),
			'type'          => 'color',
            'css'           => [
                [
                'property'  => 'color',
                'selector'  => '.bultr-ts-rating .bultr-ts-filled-icon'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['unmark_color']=[
            'tab'           => 'content',
			'group'         => 'rating_style',
			'label'         => esc_html__( 'Unmarked Color', 'wpv-bu' ),
			'type'          => 'color',
            'css'           => [
                [
                'property'  => 'color',
                'selector'  => '.bultr-ts-rating .bultr-ts-unfilled-icon'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['rating_gap']=[
            'tab'           => 'content',
			'group'         => 'rating_style',
			'label'         => esc_html__( 'Gap', 'wpv-bu' ),
			'type'          => 'number',
            'unit'          => 'px',
            'css'           => [
                [
                'property'  => 'gap',
                'selector'  => '.bultr-ts-rating',
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['rating_margin']=[
            'tab'           => 'content',
            'group'         => 'rating_style',
            'label'         => esc_html__( 'Margin', 'wpv-bu' ),
            'type'          => 'dimensions',
            'units'         => true,
            'css'           => [
                [
                    'property'  => 'margin',
                    'selector'  => '.bultr-ts-content-rating'
                    ],
            ],
        ];
    }

    public function overlay_style(){
        $this->controls['overlay_author_sep']=[
            'tab'           => 'content',
            'type'          => 'separator',
            'label'         => esc_html__( 'Author', 'wpv-bu' ),
            'group'         => 'overlay_style',
        ];
        $this->controls['show_overlay_author']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Show Author', 'wpv-bu' ),
            'type'          => 'checkbox',
            'default'       => true,
        ];
        $this->controls['overlay_author_typo']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Typography', 'wpv-bu' ),
            'type'          => 'typography',
            'css'           => [
                [
                'property'  => 'typography',
                'selector'  => '.bultr-ts-overlay-name'
                ],
            ],
            'inline'        => true,
            'default'   =>[
                'color' => [
                    'hex' => '#fff',
                  ],
            ],
       
            'required'      => [
                [ 'show_overlay_author','!=',false,
                ],
            ],
        ];
        $this->controls['overlay_author_padding']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Padding', 'wpv-bu' ),
            'type'          => 'dimensions',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ts-overlay-name'
                ],
            ],
            'required'      => [
                [ 'show_overlay_author','!=',false,
                ],
            ],
        ];

        $this->controls['overlay_designation_sep']=[
            'tab'           => 'content',
            'type'          => 'separator',
            'label'         => esc_html__( 'Designation', 'wpv-bu' ),
            'group'         => 'overlay_style',
        ];
        $this->controls['show_overlay_designation']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Show Designation', 'wpv-bu' ),
            'type'          => 'checkbox',
            'default'       => true,
        ];
        $this->controls['overlay_designation_typo']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Typography', 'wpv-bu' ),
            'type'          => 'typography',
            'css'           => [
                [
                'property'  => 'typography',
                'selector'  => '.bultr-ts-overlay-designation'
                ],
            ],
            'default'       =>[
                'color'     => [
                    'hex'   => '#fff',
                  ],
            ],
            'required'      => [
                [ 'show_overlay_designation','!=',false,
                ],
            ],
        ];

        $this->controls['overlay_company_sep']=[
            'tab'           => 'content',
            'type'          => 'separator',
            'label'         => esc_html__( 'Company Name', 'wpv-bu' ),
            'group'         => 'overlay_style',
        ];
        $this->controls['show_overlay_company']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Show Company Name', 'wpv-bu' ),
            'type'          => 'checkbox',
            'default'       => true,
        ];
        $this->controls['overlay_company_typo']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Typography', 'wpv-bu' ),
            'type'          => 'typography',
            'css'           => [
                [
                'property'  => 'typography',
                'selector'  => '.bultr-ts-overlay-company-name'
                ],
            ],
            'default'   =>[
                'color' => [
                    'hex' => '#fff',
                  ],
            ],
            'required'      => [
                [ 'show_overlay_company','!=',false,
                ],
            ],
        ];
      
        $this->controls['overlay_rating_sep']=[
            'tab'           => 'content',
            'type'          => 'separator',
            'label'         => esc_html__( 'Rating', 'wpv-bu' ),
            'group'         => 'overlay_style',
            ''
        ];
        $this->controls['show_overlay_rating']=[
            'tab'           =>'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Show Rating', 'wpv-bu' ),
            'type'          => 'checkbox',
            'default'       => false,
        ];
        $this->controls['overlay_unmark_color']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Unmarked Color', 'wpv-bu' ),
            'type'          => 'color',
            'css'           => [
                [
                'property'  => 'color',
                'selector'  => '.bultr-ts-rating-container .bultr-ts-rating .bultr-ts-unfilled-icon'
                ],
            ],
            'inline'        => true,
            'default'       =>[
                'color' => [
                    'hex' => '#fff',
                  ],
            ],
            'required'      => [
                [ 'show_overlay_rating','!=',false,
                ],
            ],
        ];
        $this->controls['overlay_mark_color']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Marked Color', 'wpv-bu' ),
            'type'          => 'color',
            'css'           => [
                [
                'property'  => 'color',
                'selector'  => '.bultr-ts-rating-container .bultr-ts-rating .bultr-ts-filled-icon'
                ],
            ],
            'inline'        => true,
            'default'       =>[
                'color' => [
                    'hex' => '#fff',
                  ],
            ],
            'required'      => [
                [ 'show_overlay_rating','!=',false,
                ],
            ],
       ];
        $this->controls['overlay_rating_gap']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Gap', 'wpv-bu' ),
            'type'          => 'number',
            'unit'          => 'px',
            'css'           => [
                [
                'property'  => 'gap',
                'selector'  => '.bultr-ts-rating-container .bultr-ts-rating'
                ],
            ],
            'inline'        => true,
            'required'      => [
                [ 'show_overlay_rating','!=',false,
                ],
            ],
        ];
        $this->controls['overlay_ratingSize']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Size', 'wpv-bu' ),
            'type'          => 'number',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'font-size',
                'selector'  => '.bultr-ts-rating-container .bultr-ts-rating'
                ],
            ],
            'inline'        => true,
            'required'      => [
                [ 'show_overlay_rating','!=',false,
                ],
            ],
        ];
        $this->controls['overlay_rating_align']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Alignment', 'wpv-bu' ),
            'type'          => 'align-items',
            'direction'  => 'row',
            'css'           => [
                [
                'property'  => 'align-self',
                'selector'  => '.bultr-ts-overlay-row-reverse .bultr-ts-rating-container'
                ],
                [
                    'property'  => 'align-self',
                    'selector'  => '.bultr-ts-overlay-row .bultr-ts-rating-container'
                ],
            ],
            'exclude'       => ['stretch'],
            'inline'        => true,
            'required'      => [
                [ 'show_overlay_rating','!=',false],
                ['overlay_direction', '=', ['row','row-reverse']],
            ],
        ];
        $this->controls['overlay_rating_margin']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Margin', 'wpv-bu' ),
            'type'          => 'dimensions',
            'units'         => true,
            'css'           => [
                [
                    'property'  => 'margin',
                    'selector'  => '.bultr-ts-preset3 .bultr-ts-info .bultr-ts-rating'
                    ],
            ],
            'required'      => [
                [ 'show_overlay_rating','!=',false,
                ],
            ],
        ];


        $this->controls['overlay_sep']=[
            'tab'           => 'content',
            'type'          => 'separator',
            'label'         => esc_html__( 'Overlay Style', 'wpv-bu' ),
            'group'         => 'overlay_style',
        ];
        $this->controls['overlay_bg']=[
            'tab'           => 'content',   
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Background', 'wpv-bu' ),
            'type'          => 'background',
            'css'           => [
                [
                'property'  => 'background-color',
                'selector'  => '.bultr-ts-preset3 .bultr-ts-info'
                ],
            ],
        ];
        $this->controls['overlay_border']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Border', 'wpv-bu' ),
            'type'          => 'border',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'border',
                'selector'  => '.bultr-ts-preset3 .bultr-ts-info'
                ],
            ],
        ];
        $this->controls['overlay_box_shadow']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Box Shadow', 'wpv-bu' ),
            'type'          => 'box-shadow',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'box-shadow',
                'selector'  => '.bultr-ts-preset3 .bultr-ts-info'
                ],
            ],
        ];
        $this->controls['overlay_direction']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Layout', 'wpv-bu' ),
            'type'          => 'direction',
            'css'           => [
                [
                'property'  => 'flex-direction',
                'selector'  => '.bultr-ts-preset3 .bultr-ts-info'
                ],
            ],
            'inline'    => true,
        ];
        $this->controls['overlay_align']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Alignment', 'wpv-bu' ),
            'type'          => 'justify-content',
            'css'           => [
                [
                'property'  => 'justify-content',
                'selector'  => '.bultr-ts-preset3 .bultr-ts-overlay-row-reverse.bultr-ts-info'
                ],
                [
                    'property'  => 'justify-content',
                    'selector'  => '.bultr-ts-preset3 .bultr-ts-overlay-row.bultr-ts-info'
                    ],
            ],
            'required'      => ['overlay_direction', '=', ['row','row-reverse']],
            'default'       =>'space-around',

        ];
        $this->controls['overlay_content_pos']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Content Position', 'wpv-bu' ),
            'type'          => 'align-items',
            'css'           => [
                [
                    'property'  => 'align-items',
                    'selector'  => '.bultr-ts-preset3 .bultr-ts-overlay-row-reverse .bultr-ts-info-container'
                ],
                [
                    'property'  => 'align-items',
                    'selector'  => '.bultr-ts-preset3 .bultr-ts-overlay-row .bultr-ts-info-container'
                ],
            ],
            'required'      => ['overlay_direction', '=', ['row','row-reverse']],
            'exclude'       => ['stretch'],
            'inline'        => true,
        ];
        $this->controls['overlay_content_pos_column']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Alignment', 'wpv-bu' ),
            'type'          => 'align-items',
            'css'           => [
                [
                    'property'  => 'align-items',
                    'selector'  => '.bultr-ts-preset3 .bultr-ts-overlay-column-reverse.bultr-ts-info'
                ],
                [
                    'property'  => 'align-items',
                    'selector'  => '.bultr-ts-preset3 .bultr-ts-overlay-column-reverse .bultr-ts-info-container'
                ],
                [
                    'property'  => 'align-self',
                    'selector'  => '.bultr-ts-overlay-column-reverse .bultr-ts-rating-container'
                ],
                [
                    'property'  => 'align-items',
                    'selector'  => '.bultr-ts-preset3 .bultr-ts-overlay-column.bultr-ts-info'
                ],
                [
                    'property'  => 'align-items',
                    'selector'  => '.bultr-ts-preset3 .bultr-ts-overlay-column .bultr-ts-info-container'
                ],
                [
                    'property'  => 'align-self',
                    'selector'  => '.bultr-ts-overlay-column .bultr-ts-rating-container'
                ],
            ],
            'required'      => ['overlay_direction', '=', ['column','column-reverse']],
            'exclude'       => ['stretch'],
            'inline'        => true,
        ];
        $this->controls['overlay_gap']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Content Gap', 'wpv-bu' ),
            'type'          => 'number',
            'unit'          => 'px',
            'css'           => [
                [
                'property'  => 'gap',
                'selector'  => '.bultr-ts-preset3 .bultr-ts-info-container'
                ],   
                [
                    'property'  => 'gap',
                    'selector'  => '.bultr-ts-preset3 .bultr-ts-info'
                ],             
            ],
            'inline'        => true,
        ];
        $this->controls['overlay_padding']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Padding', 'wpv-bu' ),
            'type'          => 'dimensions',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ts-preset3 .bultr-ts-info'
                ],
            ],
        ];
        $this->controls['overlay_margin']=[
            'tab'           => 'content',
            'group'         => 'overlay_style',
            'label'         => esc_html__( 'Margin', 'wpv-bu' ),
            'type'          => 'dimensions',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'margin',
                'selector'  => '.bultr-ts-preset3 .bultr-ts-info'
                ],
            ],
        ];
        
      

    }

    public function preset1_ordering(){
        $this->controls['preset1_description_order']=[
            'tab'           => 'content',
            'group'         => 'preset1_ordering',
            'label'         => esc_html__( 'Description', 'wpv-bu' ),
            'type'          => 'number',
            'placeholder'   => '5',
            'css'           => [
                [
                'property'  => 'order',
                'selector'  => '.bultr-ts-preset1 .bultr-ts-content-desc',
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['preset1_image_order']=[
            'tab'           => 'content',
            'group'         => 'preset1_ordering',
            'label'         => esc_html__( 'Image', 'wpv-bu' ),
            'type'          => 'number',
            'placeholder'   => '10',
            'css'           => [
                [
                'property'  => 'order',
                'selector'  => '.bultr-ts-preset1 .bultr-ts-content-img',
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['preset1_author_order']=[
            'tab'           => 'content',
            'group'         => 'preset1_ordering',
            'label'         => esc_html__( 'Author', 'wpv-bu' ),
            'type'          => 'number',
            'placeholder'   => '15',
            'css'           => [
                [
                'property'  => 'order',
                'selector'  => '.bultr-ts-preset1 .bultr-ts-name',
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['preset1_designation_order']=[
            'tab'           => 'content',
            'group'         => 'preset1_ordering',
            'label'         => esc_html__( 'Designation', 'wpv-bu' ),
            'type'          => 'number',
            'placeholder'   => '20',
            'css'           => [
                [
                'property'  => 'order',
                'selector'  => '.bultr-ts-preset1 .bultr-ts-designation',
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['preset1_company_order']=[
            'tab'           => 'content',
            'group'         => 'preset1_ordering',
            'label'         => esc_html__( 'Company Name', 'wpv-bu' ),
            'type'          => 'number',
            'placeholder'   => '25',
            'css'           => [
                [
                'property'  => 'order',
                'selector'  => '.bultr-ts-preset1 .bultr-ts-company-name',
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['preset1_rating_order']=[
            'tab'           => 'content',
            'group'         => 'preset1_ordering',
            'label'         => esc_html__( 'Rating', 'wpv-bu' ),
            'type'          => 'number',
            'placeholder'   => '30',
            'css'           => [
                [
                'property'  => 'order',
                'selector'  => '.bultr-ts-preset1 .bultr-ts-rating',
                ],
            ],
            'inline'        => true,
        ];
    }

    public function get_ordering(){
        $this->controls['rating_order']=[
            'tab'           => 'content',
            'group'         => 'ordering',
            'label'         => esc_html__( 'Rating', 'wpv-bu' ),
            'type'          => 'number',
            'placeholder'   => '5',
            'css'           => [
                [
                'property'  => 'order',
                'selector'  => '.bultr-ts-preset2 .bultr-ts-rating',
                ],
                [
                    'property'  => 'order',
                    'selector'  => '.bultr-ts-preset3 .bultr-ts-rating',
                    ],
            ],
            'inline'        => true,
        ];
        $this->controls['description_order']=[
            'tab'           => 'content',
            'group'         => 'ordering',
            'label'         => esc_html__( 'Description', 'wpv-bu' ),
            'type'          => 'number',
            'placeholder'   => '10',
            'css'           => [
                [
                'property'  => 'order',
                'selector'  => '.bultr-ts-preset2 .bultr-ts-content-desc',
                ],
                [
                    'property'  => 'order',
                    'selector'  => '.bultr-ts-preset3 .bultr-ts-content-desc',
                    ],
            ],
            'inline'        => true,
        ];
        $this->controls['author_info_order']=[
            'tab'           => 'content',
            'group'         => 'ordering',
            'label'         => esc_html__( 'Author Info', 'wpv-bu' ),
            'type'          => 'number',
            'placeholder'   => '15',
            'css'           => [
                [
                'property'  => 'order',
                'selector'  => '.bultr-ts-preset2 .bultr-ts-author-info-wrapper',
                ],
                [
                'property'  => 'order',
                'selector'  => '.bultr-ts-preset3 .bultr-ts-author-info-wrapper',
                ],
            ],
            'inline'        => true,
        ];
       
    }
   
    public function render(){
        $settings = $this->settings;

        if ( empty($settings['testimonial_data']) ) {
			return $this->render_element_placeholder(
				[
					'title' => esc_html__( 'No testimonial items added.', 'wpv-bu' ),
				]
			);
		}
        $id = $this->id;
        $swiper_control_name = 'testimonial_slider'; 
        $swiperdata = Swiper_helper::get_swiper_data($settings, $swiper_control_name);
        $break_point =isset($settings['break_points_select']) ? $settings['break_points_select'] : 'none';


        $box_alignment = isset($settings['preset1_box_alignment']) ? $settings['preset1_box_alignment'] : 'center';
        if($settings['preset_select'] === "preset2"){
            $img_position = isset($settings['preset2_image_position']) ? $settings['preset2_image_position'] : 'left';
            $this->set_attribute('content','class','bultr-ts-pos-'.$img_position);

        }
        if($settings['preset_select'] === "preset3"){
            $img_position = isset($settings['preset3_image_position']) ? $settings['preset3_image_position'] : 'left';
            $this->set_attribute('content','class','bultr-ts-pos-'.$img_position);

        }
       
        $this->set_attribute('_root', 'class', 'bultr-testimonial-slider');
        $this->set_attribute('_root', 'class', 'bultr-elementid-brxe-' .$id);
       
        $container_classes[] = 'bultr-ts-container';
        $container_classes[] = 'bultr-swiper-outer-wrapper';
        if(isset($settings['testimonial_slider_swPosition']) && $settings['testimonial_slider_swPosition'] === "inside" ){
            $container_classes[] = "bultr-swiper-nav-inside";
            $hpos = isset($settings['testimonial_slider_swHrzPosition']) ? $settings['testimonial_slider_swHrzPosition'] : 'center';
            $vpos = isset($settings['testimonial_slider_swVrtPosition']) ? $settings['testimonial_slider_swVrtPosition'] : 'center';

            $container_classes[] = "bultr-hpos-" .$hpos;
            $container_classes[] = "bultr-vpos-". $vpos;
        }
        else{
            $container_classes[] = "bultr-swiper-nav-outside";
        }
        
        $this->set_attribute('container', 'class', $container_classes);
        $this->set_attribute('container', 'data-stacked',  $break_point);
       
        $this->set_attribute('collection', 'class', 'bultr-ts-collection');
        $this->set_attribute('collection', 'class', 'bultr-swiper-container');
        $this->set_attribute('collection', 'data-script-args', wp_json_encode($swiperdata));
    
        $this->set_attribute('content', 'class', 'bultr-ts-content-wrapper');
        $this->set_attribute('content', 'class', 'bultr-ts-'.$settings['preset_select']);
       
      
        if($settings['preset_select'] === "preset1"){
            $this->set_attribute('content', 'class', 'bultr-ts-align-' .$box_alignment);
        }
        $this->set_attribute('content', 'class', 'swiper-slide');
     
        ?>
        <div <?php echo  $this->render_attributes('_root');?>>
            <div <?php echo $this->render_attributes('container');?>>
                <div <?php echo $this->render_attributes('collection')?>>
                    <div class='swiper-wrapper'><?php
        
                        foreach ($settings['testimonial_data'] as $testimonial_item) { ?>
                            <div <?php echo $this->render_attributes('content')?>>
                                <?php
                                if (isset($settings['preset_select']) && $settings['preset_select'] === "preset1") {
                                    $this->preset1($testimonial_item);
                                } elseif (isset($settings['preset_select']) && $settings['preset_select'] === "preset2") {
                                    $this->preset2($testimonial_item);
                                } 
                                if (isset($settings['preset_select']) && $settings['preset_select'] === "preset3") {
                                    $this->preset3($testimonial_item);
                                }
                                ?>

                                
                            </div >
                        <?php } ?> 
                    </div>
                    <?php 
                    //pagination 
                    if(count($settings['testimonial_data']) > 1){

                        echo Swiper_helper::render_swiper_pagination($settings, $swiper_control_name);
                    
                        // scrollbar
                        echo Swiper_helper::render_swiper_scrollbar($settings,$swiper_control_name);
                        
                        // navigation
                        if(isset($settings['testimonial_slider_swPosition']) && $settings['testimonial_slider_swPosition'] === "inside" ){
                            echo Swiper_helper::render_swiper_navigation($settings,$swiper_control_name);
                        }  
                    }
                    ?> 
                </div><?php
                if(count($settings['testimonial_data']) >  1){

                    if(isset($settings['testimonial_slider_swPosition']) && $settings['testimonial_slider_swPosition'] === "outside" ){
                            echo Swiper_helper::render_swiper_navigation($settings,$swiper_control_name);
                            
                    }
                }?>
            </div>
        </div>
        <?php
    }

    
    public function preset1($testimonial_item) {

        $size = isset( $testimonial_item['image']['size'] ) ? $testimonial_item['image']['size'] : BRICKS_DEFAULT_IMAGE_SIZE;

        if (isset($testimonial_item['description'])) { ?>
            <div class="bultr-ts-content-desc"><?php echo $testimonial_item['description']; ?></div><?php 
        } 

        if (isset($testimonial_item['image']['full'])) { 
            if (isset($testimonial_item['image']['id'])) {
                echo wp_get_attachment_image($testimonial_item['image']['id'], $size, false, array('class' => 'bultr-ts-content-img '. $size));
            } 
            else {?> 
                <img src="<?php echo $testimonial_item['image']['full']; ?>" class="bultr-ts-content-img"> <?php
            }
        } 

        if (isset($testimonial_item['author'])) { ?>
            <div class="bultr-ts-name"><?php echo $testimonial_item['author']; ?></div><?php 
        } 

        if (isset($testimonial_item['designation'])) { ?>
            <div class="bultr-ts-designation"><?php echo $testimonial_item['designation']; ?></div><?php 
        } 

        if (isset($testimonial_item['company_name'])) { ?>
            <div class="bultr-ts-company-name"><?php echo $testimonial_item['company_name']; ?></div><?php 
        } 

        if (isset($testimonial_item['rating'])) {?> 
            <div class="bultr-ts-rating bultr-ts-content-rating"><?php
                $this->render_rating($testimonial_item['rating']);?>
            </div><?php
        } 
    }
     
    public function preset2($testimonial_item) {

        $settings = $this->settings;

        $avatar_size = isset( $testimonial_item['image']['size'] ) ? $testimonial_item['image']['size'] : BRICKS_DEFAULT_IMAGE_SIZE;
        $additional_image =isset( $testimonial_item['additional_image']['size'] ) ? $testimonial_item['additional_image']['size'] : BRICKS_DEFAULT_IMAGE_SIZE;
      
        $this->set_attribute('section', 'class', 'bultr-ts-content-section');
        $box_alignment = isset($settings['preset2_hori_alignment']) ? $settings['preset2_hori_alignment'] : 'left';
        $this->set_attribute('section', 'class', 'bultr-ts-align-' .$box_alignment);
        $avatar_position= isset($settings['avatar_position']) ? $settings['avatar_position'] : 'left';
        $this->set_attribute('wrapper', 'class', 'bultr-ts-author-info-wrapper');
        $this->set_attribute('wrapper', 'class', 'bultr-ts-avt-pos-' .$avatar_position);
        $this->set_attribute('image', 'class', 'bultr-ts-image');

        if (isset($testimonial_item['additional_image']['full'])) {?>
            <div  <?php echo $this->render_attributes('image')?>> <?php
                if (isset($testimonial_item['additional_image']['id'])) {
                    echo wp_get_attachment_image($testimonial_item['additional_image']['id'], $additional_image, false, array('class' => 'bultr-ts-content-img '. $additional_image));
                } 
                else {?> 
                    <img src="<?php echo $testimonial_item['additional_image']['full'] ?>" class="bultr-ts-content-img"> <?php
                }?>
            </div><?php
        }?>

        <div <?php echo $this->render_attributes('section')?>> <?php
            if (isset($testimonial_item['rating'])) {?>
                <div class="bultr-ts-rating bultr-ts-content-rating">
                    <?php $this->render_rating($testimonial_item['rating']); ?>
                </div> <?php
            }

            if (isset($testimonial_item['description'])) {?>
                <div class="bultr-ts-content-desc"><?php echo $testimonial_item['description']; ?></div><?php
            }?>
            <div <?php echo $this->render_attributes('wrapper')?>><?php
                if (isset($testimonial_item['image']['full'])) {
                    ?>
                    <div class="bultr-ts-avatar-image"><?php
                        if (isset($testimonial_item['image']['id'])) {
                            echo wp_get_attachment_image($testimonial_item['image']['id'], $avatar_size, false, array('class' =>  $avatar_size));
                        } 
                        else {
                            ?> <img src="<?php echo $testimonial_item['image']['full'] ?>"> <?php
                        }?>
                    </div><?php
                }?> 
                <div class="bultr-ts-author-info"><?php
                    if (isset($testimonial_item['author'])) {
                        ?>
                        <div class="bultr-ts-name"><?php echo $testimonial_item['author']; ?></div>
                        <?php
                    }

                    if (isset($testimonial_item['designation'])) {
                        ?>
                        <div class="bultr-ts-designation"><?php echo $testimonial_item['designation']; ?></div>
                        <?php
                    }

                    if (isset($testimonial_item['company_name'])) {
                        ?>
                        <div class="bultr-ts-company-name"><?php echo $testimonial_item['company_name']; ?></div>
                        <?php
                    }?>
                    </div>
            </div>
        </div>
        <?php
    }

    public function preset3($testimonial_item){

        $settings = $this->settings;

        $avatar_size = isset( $testimonial_item['image']['size'] ) ? $testimonial_item['image']['size'] : BRICKS_DEFAULT_IMAGE_SIZE;
        $additional_image =isset( $testimonial_item['additional_image']['size'] ) ? $testimonial_item['additional_image']['size'] : BRICKS_DEFAULT_IMAGE_SIZE;
        $this->set_attribute('section', 'class', 'bultr-ts-content-section');
        $box_alignment = isset($settings['preset3_hori_alignment']) ? $settings['preset3_hori_alignment'] : 'left';
        $this->set_attribute('section', 'class', 'bultr-ts-align-' .$box_alignment);
        $avatar_position= isset($settings['avatar_position']) ? $settings['avatar_position'] : 'left';
        $this->set_attribute('wrapper', 'class', 'bultr-ts-author-info-wrapper');
        $this->set_attribute('wrapper', 'class', 'bultr-ts-avt-pos-' .$avatar_position);
        
        $this->set_attribute('overlay_layout','class','bultr-ts-info');
        if(isset($settings['overlay_direction'])){
            $this->set_attribute('overlay_layout','class','bultr-ts-overlay-'.$settings['overlay_direction']);
        }
        ?>
       
        <div <?php echo $this->render_attributes('section')?>>
       
            <?php
            if(isset($settings['show_rating']) && $settings['show_rating'] === true ){
                if (isset($testimonial_item['rating'])) {
                    ?>
                    <div class="bultr-ts-rating bultr-ts-content-rating">
                        <?php $this->render_rating($testimonial_item['rating']); ?>
                    </div>
                    <?php
                }
            }   
            if (isset($testimonial_item['description'])) {
                ?>
                <div class="bultr-ts-content-desc"><?php echo $testimonial_item['description']; ?></div>
                <?php
            }?>

            <div <?php echo $this->render_attributes('wrapper')?>><?php
                if (isset($testimonial_item['image']['full'])) {
                    ?>
                    <div class="bultr-ts-avatar-image"><?php
                        if (isset($testimonial_item['image']['id'])) {
                            echo wp_get_attachment_image($testimonial_item['image']['id'], $avatar_size, false, array('class' => $avatar_size));
                        } 
                        else {
                            ?> <img src="<?php echo $testimonial_item['image']['full'] ?>"> <?php
                        }?>
                    </div><?php
                }   ?> 
                <div class="bultr-ts-author-info"><?php
                    if(isset($settings['show_author']) && $settings['show_author'] === true ){
                        if (isset($testimonial_item['author'])) {
                            ?>
                            <div class="bultr-ts-name"><?php echo  $testimonial_item['author']; ?></div>
                            <?php
                        }
                    }
                    if(isset($settings['show_designation']) && $settings['show_designation'] === true ){
                        if (isset($testimonial_item['designation'])) {
                            ?>
                            <div class="bultr-ts-designation"><?php echo $testimonial_item['designation']; ?></div>
                            <?php
                        }
                    }
                    if(isset($settings['show_company_name']) && $settings['show_company_name'] === true){
                        if (isset($testimonial_item['company_name'])) {
                            ?>
                            <div class="bultr-ts-company-name"><?php echo $testimonial_item['company_name']; ?></div>
                            <?php
                        }
                    }?>
                </div>
            </div>
        </div>
        <div class="bultr-ts-img-wrapper"><?php
            if (isset($testimonial_item['additional_image']['id'])) {
                echo wp_get_attachment_image($testimonial_item['additional_image']['id'], $additional_image, false, array('class' => 'bultr-ts-content-img '. $additional_image));
            } 
            else {
                if (isset($testimonial_item['additional_image']['full'])) {
                ?> <img src="<?php echo $testimonial_item['additional_image']['full']; ?>" class="bultr-ts-content-img"><?php
                }
                else{
                    //render placeholder image
                    $placeholder = isset($settings['placeholder_image']['id']) ? wp_get_attachment_image($settings['placeholder_image']['id'], 'full', false, array('class'=>'bultr-ts-content-img')) : '';
                    echo $placeholder;
                }
            }
            if(isset($settings['show_overlay_author']) && $settings['show_overlay_author'] === true || isset($settings['show_overlay_designation']) && $settings['show_overlay_designation'] === true || isset($settings['show_overlay_company']) && $settings['show_overlay_company'] === true || isset($settings['show_overlay_rating']) && $settings['show_overlay_rating'] === true){?>
                <div class="bultr-ts-overlay-block">
                    <div  <?php echo $this->render_attributes('overlay_layout')?>>
                        <div class=bultr-ts-info-container>
                            <?php
                            if(isset($settings['show_overlay_author'])){    
                                if (isset($testimonial_item['author'])) {
                                    ?>
                                    <div class="bultr-ts-overlay-name"><?php echo $testimonial_item['author']; ?></div>
                                    <?php
                                }
                            }
                            if(isset($settings['show_overlay_designation'])){
                                if (isset($testimonial_item['designation'])) {
                                    ?>
                                    <div class="bultr-ts-overlay-designation"><?php echo $testimonial_item['designation']; ?></div>
                                    <?php
                                }
                            }
                            if(isset($settings['show_overlay_company'])){
                                if (isset($testimonial_item['company_name'])) {
                                    ?>
                                    <div class="bultr-ts-overlay-company-name"><?php echo $testimonial_item['company_name']; ?></div>
                                    <?php
                                }
                            }?>
                        </div> <?php 
                        if (isset($settings['show_overlay_rating'])){?>
                            <div class=bultr-ts-rating-container><?php
                                if (isset($testimonial_item['rating'])) {
                                    ?>
                                    <div class="bultr-ts-rating">
                                        <?php $this->render_rating($testimonial_item['rating']); ?>
                                    </div>
                                    <?php
                                }?> 
                            </div> <?php
                        }?>  
                    </div>
                </div><?php
            }?>
        </div>
     <?php
    }

    public function render_rating($rating) {
        $settings = $this->settings;
        $filled_icon = '';
        $half_fill_icon = '';
        $unmarked_icon = '';
        
        if (isset($settings['filled_icon']) && is_array($settings['filled_icon']) && count($settings['filled_icon']) > 0) {
            $filled_icon = $settings['filled_icon'];
        }
        $class = 'bultr-ts-filled-icon';
        //$filled_icon .= ' ' . $class;
        $filled_attr = [ 
            'class' => [$class]
        ];
        if (isset($settings['half_fill_icon']) && is_array($settings['half_fill_icon']) && count($settings['half_fill_icon']) > 0) {
            $half_fill_icon = $settings['half_fill_icon'];
        }
        $class = 'bultr-ts-filled-icon';
        $half_fill_attr = [
                'class' => [$class]
        ];

        if (isset($settings['unmarked_icon']) && is_array($settings['unmarked_icon']) && count($settings['unmarked_icon']) > 0) {
            $unmarked_icon = $settings['unmarked_icon'];
        }
        $class = 'bultr-ts-unfilled-icon';
        $unmarked_attr = [
            'class' => [$class]
        ];
    
        // Calculate the number of filled and half-filled stars
        $numFilledStars = floor($rating);
        $hasHalfFilledStar = $rating - $numFilledStars > 0;

        // Render filled stars
        for ($i = 1; $i <= $numFilledStars; $i++) {
            // echo '<i class="' . $filled_icon .'"></i>';
            echo self::render_icon( $filled_icon, $filled_attr);
        }
    
        // Render half-filled icon if necessary
        if ($hasHalfFilledStar) {
            echo self::render_icon( $half_fill_icon, $half_fill_attr);
            $numEmptyStars = 5 - $numFilledStars - 1; 
        } else {
            $numEmptyStars = 5 - $numFilledStars;
        }
    
        // Render unfilled stars
        for ($i = 1; $i <= $numEmptyStars; $i++) {
            echo self::render_icon( $unmarked_icon, $unmarked_attr);
            // echo '<i class="' . $unmarked_icon .'"></i>';
        }
    }
    
}
