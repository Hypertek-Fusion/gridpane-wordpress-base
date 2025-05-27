<?php
namespace BricksUltra\includes\ImageHotspot;
use Bricks\Helpers;
use Bricks\Element;
class Module extends Element {
	public $category     = 'ultra';
	public $name         = 'wpvbu-image-hotspot';
	public $icon         = 'ti-image';
	public $css_selector = '';
	public $scripts      = ['ImageHostpot'];

    public function get_label()
    {
        return esc_html__('Image Hotspot', 'wpv-bu');
    }

    public function get_keywords()
    {
        return ['image', 'hotspot', 'image hotspot'];
    }

    public function enqueue_scripts(){
        wp_enqueue_style('bricks-animate');
        wp_enqueue_style( 'bultr-module-style' );
        wp_enqueue_script('bultr-module-script');

		wp_enqueue_script('bultr-ihp', WPV_BU_URL . 'assets/vendor/tippy/popper.js', [], WPV_BU_VERSION, true);
        wp_enqueue_script('bultr-iht', WPV_BU_URL . 'assets/vendor/tippy/tippy.js', [], WPV_BU_VERSION, true);
        wp_enqueue_script('bultr-lottie', WPV_BU_URL . 'assets/vendor/lottie/lottie.min.js', ['jquery'], WPV_BU_VERSION, true);

	}

	public function set_control_groups() {
        $this->control_groups['marker_settings'] = [
			'title'         => esc_html__( 'Markers', 'wpv-bu' ),
			'tab'           => 'content',
		]; 
        $this->control_groups['marker_style'] = [
			'title'         => esc_html__( 'Markers Style', 'wpv-bu' ),
			'tab'           => 'content',
		];
        $this->control_groups['tooltip_style'] = [
            'title'         => esc_html__( 'Tooltip Style', 'wpv-bu' ),
            'tab'           => 'content',
        ];
        $this->control_groups['hotspot_tour'] = [
			'title'         => esc_html__( 'Hotspot Tour', 'wpv-bu' ),
			'tab'           => 'content',
            'required'      => ['enable_hotspot_tour','=',true],
		];
        $this->control_groups['close_btn_style'] = [
            'title'         => esc_html__( 'Close Button Style', 'wpv-bu' ),
            'tab'           => 'content',
            'required'      => ['enable_close_btn','=',true],
        ];
    }

    public function set_controls() {
        $this->controls['bg_image'] = [
            'type'          => 'image',
            'label'         => esc_html__( 'Image', 'wpv-bu' ),
            'default'       => [
                'full' => 'https://source.unsplash.com/random/800x400?earth',
                'url'  => 'https://source.unsplash.com/random/800x400?earth',
            ],
            'tab'           => 'content',
        ];
        $this->controls['trigger_on']=[
            'tab'           => 'content',
            'label'         => esc_html__( 'Trigger On', 'wpv-bu' ),
            'type'          => 'select',
            'options'       => [
                'hover'     => esc_html__( 'Hover', 'wpv-bu' ),
                'click'     => esc_html__( 'Click', 'wpv-bu' ),
            ],
            'default'       => 'click',
            'clearable'     => false,
            'inline'        => true,
            'info'          =>'When you choose "hover" here, then the button, close button, and Hotspot tour in the tooltip will not work.',
        ];
        $this->controls['enable_close_btn'] = [
            'tab'           => 'content',
            'label'         => esc_html__( 'Enable Close Button', 'wpv-bu' ),
            'type'          => 'checkbox',
            'default'       => 'false',
        ];
        $this->controls['enable_hotspot_tour'] = [
            'tab'           => 'content',
            'label'         => esc_html__( 'Enable Hotspot Tour', 'wpv-bu' ),
            'type'          => 'checkbox',
            'default'       => true,
        ];

        $this->controls['marker_data'] = [
			'tab'           => 'content',
			'group'         => 'marker_settings',
			'placeholder'   => esc_html__( 'Marker Details', 'wpv-bu' ),
			'type'          => 'repeater',
			'titleProperty' => 'admin_label',
            
            'fields'        => [
                'admin_label'       => [
                    'label'         => esc_html__( 'Admin Label', 'wpv-bu' ),
                    'inline'        => true,
                    'type'          => 'text',
                ],

                'marker_seperator'  => [
                    'label'             => esc_html__( 'Marker', 'wpv-bu' ),
                    'type'              => 'separator',
                ],

                'marker_type'     => [
                    'label'         => esc_html__( 'Type', 'wpv-bu' ),
                    'type'          => 'select',
                    'inline'        => true,
                    'options'       => [
                        'none'      => esc_html__( 'None', 'wpv-bu' ),
                        'image'     => esc_html__( 'Image', 'wpv-bu'),
                        'iconText'  => esc_html__( 'Text/Icon', 'wpv-bu' ),
                        'lottie'    => esc_html__('Lottie','wpv-bu'),
                    ],
                    'clearable'     => false,
                ],
                'marker_image'      => [
                    'label'         => esc_html__( 'Image', 'wpv-bu' ),
                    'type'          => 'image',
                    'required'      => ['marker_type','=','image'],
                ],
                'marker_icon'       => [
                    'label'         => esc_html__( 'Icon', 'wpv-bu' ),
                    'type'          => 'icon',
                    'required'      => ['marker_type','=','iconText'],
                ],
                'marker_text'       => [
                    'label'         => esc_html__( 'Text', 'wpv-bu' ),
                    'type'          => 'text',
                    'required'      => ['marker_type','=','iconText'],
                    'inline'        => true,
                ],
                'lottie_type' => [
                    'label'         => esc_html__( 'Source', 'wpv-bu' ),
                    'type'          => 'select',
                    'options'       => [
                        'media'     => __('Medial File','wpv-bu'),
                        'external'  => __('External URL','wpv-bu'),
                    ],
                    'inline'        => true,
                    'required'      => ['marker_type', '=', 'lottie'],
                    'default'       => 'media',
                ],
                'lottie_media' => [
                    'label'         => esc_html__( 'Upload JSON File', 'wpv-bu' ),
                    'type'          => 'file',
                    'pasteStyles'   => false,
                    'required'      => [
                            ['marker_type', '=', 'lottie'],
                            ['lottie_type', '=', 'media'],
                    ],
                ],
                'lottie_url' => [
                    'label'     => esc_html__( 'Lottie JSON URL', 'wpv-bu' ),
                    'type'      => 'text',
                    'description' => __("Get JSON code URL from <a href = 'https://lottiefiles.com/' target='_blank'>here</a>.", 'wpv-bu'),
                    'required'  => [
                        ['marker_type', '=', 'lottie'],
                        ['lottie_type', '=', 'external'],
                    ],

                ],
                'lottie_loop' => [
                    'label'     => esc_html__( 'Loop', 'wpv-bu' ),
                    'type'      => 'checkbox',
                    'required'  => [
                        ['marker_type', '=', 'lottie'],
                    ],
                    'default'   => true,
                ],
                'lottie_reverse' => [
                    'label'     => esc_html__( 'Reverse', 'wpv-bu' ),
                    'type'      => 'checkbox',
                    'required'  => [
                        ['marker_type', '=', 'lottie'],
                    ],
                ],

                'marker_position_hori' => [
                    'label'         => esc_html__( 'Horizontal Position', 'wpv-bu' ),
                    'type'          => 'number',
                    'min'           => 0,
                    'max'           => 100,
                    'default'       => 50,
                    'css'           => [
                        [
                        'property'  => 'left',
                        'selector'  => '.bultr-ih-marker'
                        ],
                    ],
                    'inline'        => true,
                ],
                'marker_position_ver' => [
                    'label'         => esc_html__( 'Vertical Position', 'wpv-bu' ),
                    'type'          => 'number',
                    'min'           => 0,
                    'max'           => 100,
                    'default'       => 50,
                    'css'           => [
                        [
                        'property'  => 'top',
                        'selector'  => '.bultr-ih-marker'
                        ],
                    ],
                    
                    'inline'        => true,
                ],

                'tooltip_seperator' => [
                    'label'         => esc_html__( 'Tooltip', 'wpv-bu' ),
                    'type'          => 'separator',
                ],
                'rep_tooltip_preview'   => [
                    'label'         => esc_html__( 'Preview', 'wpv-bu' ),
                    'type'          => 'checkbox',
                    'default'       => 'false',
                ], 
                'tooltip_select'    => [
                    'label'         => esc_html__( 'Media', 'wpv-bu' ),
                    'type'          => 'select',
                    'inline'        => true,
                    'options'       => [
                        'none'      => esc_html__( 'None', 'wpv-bu' ),
                        'image'     => esc_html__( 'Image', 'wpv-bu' ),
                        'icon'      => esc_html__( 'Icon', 'wpv-bu' ),
                    ],
                    'clearable'     => false,
                ],
                'tooltip_image'     => [
                    'label'         => esc_html__( 'Image', 'wpv-bu' ),
                    'type'          => 'image',
                    'required'      => ['tooltip_select','=','image'],
                ],
                'tooltip_icon'      => [
                    'label'         => esc_html__( 'Icon', 'wpv-bu' ),
                    'type'          => 'icon',
                    'required'      => ['tooltip_select','=','icon'],
                ],
                'heading'           => [
                    'label'         => esc_html__( 'Heading', 'wpv-bu' ),
                    'type'          => 'text',
                ],
                'short_description' => [
                    'label'     => esc_html__( 'Short Description', 'wpv-bu' ),
                    'type' => 'editor',
                    'inlineEditing' => [
                      'selector' => '.text-editor', 
                      'toolbar' => true, 
                    ],
                ],
                'description'       => [
                    'label'     => esc_html__( 'Description', 'wpv-bu' ),
                    'type' => 'editor',
                    'inlineEditing' => [
                      'selector' => '.text-editor', 
                      'toolbar' => true, 
                    ],
                ],
                'tooltip_button'    => [
                    'label'     => esc_html__( 'Button', 'wpv-bu' ),
                    'type'      => 'text',
                ],
                'tooltip_btn_icon'  =>[
                    'label'         => esc_html__( 'Icon', 'wpv-bu' ),
                    'type'          => 'icon',
                ],
                'tooltip_btn_link'  => [
                    'label'         => esc_html__( 'Link', 'wpv-bu' ),
                    'type'          => 'link',
                ],

                'marker_style_sep'  => [
                    'label'         => esc_html__( 'Custom Marker Style', 'wpv-bu' ),
                    'type'          => 'separator',
                ],
                'ctm_icon_color'    =>[
                    'label'         => esc_html__( 'Icon Color', 'wpv-bu' ),
                    'type'          => 'color',
                    'css'           => [
                        [
                        'property'  => 'color',
                        'selector'  => '.bultr-ih-marker i'
                        ],
                        [
                        'property'  => 'fill',
                        'selector'  => '.bultr-ih-marker svg'
                        ],
                    ],
                    'inline'        => true,
                    'required'      => [['marker_icon','!=',''],
                    ['marker_type','=','iconText'],],
                ],
                'ctm_text_color'    => [
                    'group'         => 'marker_style',
                    'label'         => esc_html__( 'Text Color', 'wpv-bu' ),
                    'type'          => 'color',
                    'css'           => [
                        [
                        'property' => 'color',
                        'selector'  => '.bultr-ih-marker .bultr-ih-marker-text'
                        ],
                    ],
                    'required'      => [['marker_text','!=',''],
                                        ['marker_type','=','iconText'],],
                      
                    'inline'        => true,
                ],
                'ctm_lottie_height'=>[
                    'label'         => esc_html__( 'Height', 'wpv-bu' ),
                    'type'          => 'number',
                    'units'         => true,
                    'min'           => 0,
                    'max'           => 1000,
                    'css'           => [
                        [
                        'property'  => 'height',
                        'selector'  => '.bultr-ih-lottie'
                        ],
                    ],
                    'required'      => ['marker_type','=','lottie'],
                    'inline'        => true,
                ],
                'ctm_marker_bg'     =>[
                    'label'         => esc_html__( 'Background Color', 'wpv-bu' ),
                    'type'          => 'background',
                    'css'           => [
                        [
                        'property'  => 'background',
                        'selector'  => '.bultr-ih-marker'
                        ],
                    ],
                    'inline'        => true,
                ],
                'ctm_marker_border' =>[
                    'group'         => 'marker_style',
                    'label'         => esc_html__( 'Border', 'wpv-bu' ),
                    'type'          => 'border',
                    'css'           => [
                        [
                        'property'  => 'border',
                        'selector'  => '.bultr-ih-marker'
                        ],
                    ],
                    'inline'        => true,
                ],
                'ctm_marker_box_shadow' =>[
                    'group'         => 'marker_style',
                    'label'         => esc_html__( 'Box Shadow', 'wpv-bu' ),
                    'type'          => 'box-shadow',
                    'css'           => [
                        [
                        'property'  => 'box-shadow',
                        'selector'  => '.bultr-ih-marker'
                        ],
                    ],
                    'inline'        => true,
                ],

                'tooltip_style_sep'  => [
                    'label'         => esc_html__( 'Custom Tooltip Style', 'wpv-bu' ),
                    'type'          => 'separator',
                ],
                'ctm_tooltip_bg_color' => [ 
                    'label'         => esc_html__( 'Background', 'wpv-bu' ),
                    'type'          => 'background',
                    'css'           => [
                        [
                        'property'  => 'background',
                        'selector' =>'.tippy-box',
                        ],
                    ],
                    'inline'        => true,
                ],
                'ctm_tooltip_arrow_color' => [ 
                    'label'         => esc_html__( 'Arrow Color', 'wpv-bu' ),
                    'type'          => 'color',
                    'css'           => [
                        [
                        'property'  => 'color',
                        'selector' =>'.tippy-arrow',
                        ],
                    ],
                    'inline'        => true,
                ],
                'ctm_tooltip_content_bg'=>[
                    'label'         => esc_html__( 'Content Background', 'wpv-bu' ),
                    'type'          => 'color',
                    'css'           => [
                        [
                        'property'  => 'background-color',
                        'selector'  => '.bultr-ih-tooltip-content'
                        ],
                    ],
                ],
                
                'ctm_tooltip_img_sep'=>[
                    'label'         => esc_html__( 'Image/Icon', 'wpv-bu' ),
                    'type'          => 'separator',
                    'required'      => ['tooltip_select','=',['image','icon']],
                ],
                'ctm_tooltip_bg'=>[
                    'label'         => esc_html__( 'Background', 'wpv-bu' ),
                    'type'          => 'color',
                    'css'           => [
                        [
                        'property'  => 'background-color',
                        'selector'  => '.bultr-ih-tooltip-icon::before'
                        ],
                        [
                        'property'  => 'background-color',
                        'selector'  => '.bultr-ih-tooltip-image',
                        ],
                    ],
                    'required'      => ['tooltip_select','=',['image','icon']],
                ],
                'ctm_tooltip_icon_clr'=>[
                    'label'         => esc_html__( 'Icon Color', 'wpv-bu' ),
                    'type'          => 'color',
                    'css'           => [
                        [
                        'property'  => 'color',
                        'selector'  => '.bultr-ih-tooltip-icon'
                        ],
                        [
                        'property'  => 'fill',
                        'selector'  => '.bultr-ih-tooltip-icon svg'
                        ],
                    ],
                    'required'      => ['tooltip_select','=',['image','icon']],
                    'inline'        => true,
                ],
                'ctm_tooltip_image_border'=>[
                    'label'         => esc_html__( 'Border', 'wpv-bu' ),
                    'type'          => 'border',
                    'css'           => [
                        [
                        'property'  => 'border',
                        'selector'  => '.bultr-ih-tooltip-img'
                        ],
                        ['property'  => 'border',
                        'selector'  => '.bultr-ih-tooltip-icon'
                        ],
                    ],
                    'required'      => ['tooltip_select','=',['image','icon']],
                    'inline'        => true,
                ],

                'ctm_tooltip_heading_sep'=>[
                    'label'         => esc_html__( 'Heading', 'wpv-bu' ),
                    'type'          => 'separator',
                    'required'      => ['heading','!=',''],
                ],
                'ctm_tooltip_heading_color'=>[
                    'label'         => esc_html__( 'Color', 'wpv-bu' ),
                    'type'          => 'color',
                    'css'           => [
                        [
                        'property'  => 'color',
                        'selector'  => '.bultr-ih-content-heading'
                        ],
                    ],
                    'required'      => ['heading','!=',''],
                ],
                'ctm_tooltip_heading_bg'=>[
                    'label'         => esc_html__( 'Background Color', 'wpv-bu' ),
                    'type'          => 'color',
                    'css'           => [
                        [
                        'property'  => 'background-color',
                        'selector'  => '.bultr-ih-content-heading'
                        ],
                    ],
                    'inline'        => true,
                    'required'      => ['heading','!=',''],
                ],

                'ctm_tooltip_des_sep'=>[
                    'label'         => esc_html__( 'Description', 'wpv-bu' ),
                    'type'          => 'separator',
                    'required'      => ['description','!=',''],
                ],
                'ctm_tooltip_des_color'=>[
                    'label'         => esc_html__( 'Text Color', 'wpv-bu' ),
                    'type'          => 'color',
                    'css'           => [
                        [
                        'property'  => 'color',
                        'selector'  => '.bultr-ih-content-description'
                        ],
                    ],
                    'required'      => ['description','!=',''],
                ],
                'ctm_tooltip_des_bg'=>[
                    'tab'           => 'content',
                    'group'         => 'tooltip_style',
                    'label'         => esc_html__( 'Background Color', 'wpv-bu' ),
                    'type'          => 'color',
                    'css'           => [
                        [
                        'property'  => 'background-color',
                        'selector'  => '.bultr-ih-content-description'
                        ],
                    ],
                    'inline'        => true,
                    'required'      => ['description','!=',''],
                ],

                'ctm_tooltip_short_des_sep'=>[
                    'label'         => esc_html__( 'Short Description', 'wpv-bu' ),
                    'type'          => 'separator',
                    'required'      => ['short_description','!=',''],
                ],
                'tooltip_short_des_typo'=>[
                    'label'         => esc_html__( 'Typography', 'wpv-bu' ),
                    'type'          => 'typography',
                    'css'           => [
                        [
                        'property'  => 'typography',
                        'selector'  => '.bultr-ih-content-short-des'
                        ],
                    ],
                    'required'      => ['short_description','!=',''],
                ],
                'tooltip_short_des_bg'=>[
                    'label'         => esc_html__( 'Background Color', 'wpv-bu' ),
                    'type'          => 'color',
                    'css'           => [
                        [
                        'property'  => 'background-color',
                        'selector'  => '.bultr-ih-content-short-des'
                        ],
                    ],
                    'inline'        => true,
                    'required'      => ['short_description','!=',''],
                ],

                'ctm_tooltip_btn_sep'=>[
                    'label'         => esc_html__( 'Button', 'wpv-bu' ),
                    'type'          => 'separator',
                    'required'      => [['tooltip_button','!=',''],],
                ],
                'ctm_tooltip_btn_icon_color'=>[
                    'label'         => esc_html__( 'Icon Color', 'wpv-bu' ),
                    'type'          => 'color',
                    'css'           => [
                        [
                        'property'  => 'color',
                        'selector'  => '.bultr-ih-content-btn i'
                        ],
                        [
                            'property'  => 'fill',
                            'selector'  => '.bultr-ih-content-btn svg'
                            ],
                    ],
                    'required'      => [['tooltip_btn_icon','!=',''],],
                    'inline'        => true,
                ],
                'ctm_tooltip_btn_color'=>[
                    'label'         => esc_html__( 'Text Color', 'wpv-bu' ),
                    'type'          => 'color',
                    'css'           => [
                        [
                        'property'  => 'color',
                        'selector'  => '.bultr-ih-tooltip-btn'
                        ],
                    ],
                    'required'      => [['tooltip_button','!=',''],],
                ],
                'ctm_tooltip_btn_bg'=>[
                    'label'         => esc_html__( 'Background Color', 'wpv-bu' ),
                    'type'          => 'color',
                    'css'           => [
                        [
                        'property'  => 'background-color',
                        'selector'  => '.bultr-ih-tooltip-btn'
                        ],
                    ],
                    'inline'        => true,
                    'required'      => [['tooltip_button','!=',''],],
                ],
            ],
            'default'       => [
				[
					'marker_type' => 'iconText',
                    'marker_icon'   =>  [
                        'library'   => 'ionicons',
                        'icon'      => 'ion-ios-add-circle',
                    ],
                    'marker_position_hori'  => '10%',
                    'marker_position_ver'   => '30%',
                    'tooltip_select'    => 'none',
                    'heading' => 'Add Your Tooltip Content Here',
		        ],
                [
					'marker_type' => 'iconText',
                    'marker_icon'   =>  [
                        'library'   => 'ionicons',
                        'icon'      => 'ion-ios-add-circle',
                    ],
                    'marker_position_hori'  => '35%',
                    'marker_position_ver'   => '70%',
                    'tooltip_select'    => 'none',
                    'heading' => 'Add Your Tooltip Content Here',
		        ],
                [
					'marker_type' => 'iconText',
                    'marker_icon'   =>  [
                        'library'   => 'ionicons',
                        'icon'      => 'ion-ios-add-circle',
                    ],
                    'marker_position_hori'  => '70%',
                    'marker_position_ver'   => '40%',
                    'tooltip_select'    => 'none',
                    'heading' => 'Add Your Tooltip Content Here',
		        ],
            ],
        ];

        $this->marker_style();
        $this->tooltip_style();
        $this->hotspot_tour();
        $this->close_btn_style();
    }

    public function marker_style(){
        $this->controls['image_height'] = [
            'tab'           => 'content',
            'group'         => 'marker_style',
            'label'         => esc_html__( 'Image Height', 'wpv-bu' ),
            'type'          =>'number',
            'units'         => true,
            'min'           =>0,
            'max'           =>100,
            'css'           => [
                [
                'property'  => 'height',
                'selector'  => '.bultr-ih-marker-img'
                ],
            ],
            'inline'        => true,
        ];
        
        $this->controls['icon_seperator']=[
            'tab'           => 'content',
            'group'         => 'marker_style',
            'label'         => esc_html__( 'Icon', 'wpv-bu' ),
            'type'          => 'separator',
        ];
        $this->controls['marker_icon_pos']=[
            'tab'           => 'content',
            'group'         => 'marker_style',
            'label'         => esc_html__( 'Position', 'wpv-bu' ),
            'type'          => 'select',
            'options'       => [
                'left'      => esc_html__( 'Left', 'wpv-bu' ),
                'right'     => esc_html__( 'Right', 'wpv-bu' ),
            ],
            'inline'        => true,
        ];
        $this->controls['marker_icon_size'] = [
            'tab'           => 'content',
            'group'         => 'marker_style',
            'label'         => esc_html__( 'Size', 'wpv-bu' ),
            'type'          =>'number',
            'units'         => true,
            'min'           => 0,
            'max'           => 100,
            'css'           => [
                [
                'property'  => 'font-size',
                'selector'  => '.bultr-ih-marker-wrapper .bultr-ih-marker i'
                ],
                [
                'property'  => 'font-size',
                'selector'  => '.bultr-ih-marker-wrapper .bultr-ih-marker svg'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['marker_icon_color'] = [
            'tab'           => 'content',
            'group'         => 'marker_style',
            'label'         => esc_html__( 'Color', 'wpv-bu' ),
            'type'          => 'color',
            'css'           => [
                [
                'property'  => 'color',
                'selector'  => '.bultr-ih-marker-wrapper .bultr-ih-marker i'
                ],
                [
                    'property'  => 'fill',
                    'selector'  => '.bultr-ih-marker-wrapper .bultr-ih-marker svg'
                    ],
            ],
            'default'       => '#e6b000',
            'inline'        => true,
        ];
        $this->controls['marker_icon_gap']=[
            'tab'           => 'content',
            'group'         => 'marker_style',
            'label'         => esc_html__( 'Gap', 'wpv-bu' ),
            'type'          =>'number',
            'units'         => true,
            'min'           => 0,
            'max'           => 100,
            'css'           => [
                [
                'property'  => 'gap',
                'selector'  => '.bultr-ih-marker-wrapper .bultr-ih-marker'
                ],
            ],
            'inline'        => true,
        ];

        $this->controls['text_seperator']=[
            'tab'           => 'content',
            'group'         => 'marker_style',
            'label'         => esc_html__( 'Text', 'wpv-bu' ),
            'type'          => 'separator',
        ];
        $this->controls['text_typo'] = [
            'tab'           => 'content',
            'group'         => 'marker_style',
            'label'         => esc_html__( 'Typography', 'wpv-bu' ),
            'type'          => 'typography',
            'css'           => [
                [
                'property' => 'typography',
                'selector'  => '.bultr-ih-marker .bultr-ih-marker-text'
                ],
            ],
            'inline'        => true,
        ];

        $this->controls['lottie_sep']=[
            'tab'           => 'content',
            'group'         => 'marker_style',
            'label'         => esc_html__( 'Lottie', 'wpv-bu' ),
            'type'          => 'separator',
        ];
        $this->controls['lottie_height']=[
            'tab'           => 'content',
            'group'         => 'marker_style',
            'label'         => esc_html__( 'Height', 'wpv-bu' ),
            'type'          => 'number',
            'units'         => true,
            'min'           => 0,
            'max'           => 1000,
            'css'           => [
                [
                'property'  => 'height',
                'selector'  => '.bultr-ih-marker .bultr-ih-lottie'
                ],
            ],
            'inline'        => true,
        ];

        $this->controls['box_seperator']=[
            'tab'           => 'content',
            'group'         => 'marker_style',
            'type'          => 'separator',
        ];
        $this->controls['marker_bg_color']=[ 
            'tab'           => 'content',
            'group'         => 'marker_style',
            'label'         => esc_html__( 'Background Color', 'wpv-bu' ),
            'type'          => 'color',
            'css'           => [
                [
                'property'  => 'background-color',
                'selector'  => '.bultr-ih-marker-wrapper .bultr-ih-marker'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['marker_border'] =[
            'tab'           => 'content',
            'group'         => 'marker_style',
            'label'         => esc_html__( 'Border', 'wpv-bu' ),
            'type'          => 'border',
            'css'           => [
                [
                'property'  => 'border',
                'selector'  => '.bultr-ih-marker-wrapper .bultr-ih-marker'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['marker_box_shadow']=[
            'tab'           => 'content',
            'group'         => 'marker_style',
            'label'         => esc_html__( 'Box Shadow', 'wpv-bu' ),
            'type'          => 'box-shadow',
            'css'           => [
                [
                'property'  => 'box-shadow',
                'selector'  => '.bultr-ih-marker-wrapper .bultr-ih-marker'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['marker_padding'] =[
            'tab'           => 'content',    
            'group'         => 'marker_style',
            'label'         => esc_html__( 'Padding', 'wpv-bu' ),
            'type'          => 'spacing',
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ih-marker-wrapper .bultr-ih-marker'
                ],
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ih-marker-wrapper .bultr-ih-marker-none'
                ],
            ],
        ];

        $this->controls['marker_animation_sep']=[
            'tab'           => 'content',
            'label'         => esc_html__( 'Animation', 'wpv-bu' ),
            'group'         => 'marker_style',
            'type'          => 'separator',
        ];
        $this->controls['marker_animation']=[
            'tab'           => 'content',
            'group'         => 'marker_style',
            'label'         => esc_html__( 'Animation', 'wpv-bu' ),
            'type'          => 'select',
            'options'       => [
                'none'      => esc_html__( 'None', 'wpv-bu' ),
                'bounce'    => esc_html__( 'Bounce', 'wpv-bu' ),
                'bounceInDown' => esc_html__( 'Bounce In Down', 'wpv-bu' ),
                'flash'     => esc_html__( 'Flash', 'wpv-bu' ),
                'pulse'     => esc_html__( 'Pulse', 'wpv-bu' ),
                'swing'     => esc_html__( 'Swing', 'wpv-bu' ),
                'tada'      => esc_html__( 'Tada', 'wpv-bu' ),
                'wobble'    => esc_html__( 'Wobble', 'wpv-bu' ),
                'jello'     => esc_html__( 'Jello', 'wpv-bu' ),
                'heartBeat' => esc_html__( 'Heart Beat', 'wpv-bu' ),
            ],
            'inline'        => true,
        ];
        $this->controls['marker_animation_infi']=[
            'tab'           => 'content',
            'group'         => 'marker_style',
            'label'         => esc_html__( 'Continuous Animation', 'wpv-bu' ),
            'type'          => 'checkbox',
            'default'       => false,
            'rerender'      => true,
            'info'          =>__('Enable to make the animation run endlessly.','wpv-bu'),
            'inline'        => true,
            'required'      => [
                ['marker_animation', '!=', 'none'],
            ],
        ];
        $this->controls['marker_animation_duration']=[
            'tab'           => 'content',
            'group'         => 'marker_style',
            'label'         => esc_html__( 'Duration', 'wpv-bu' ),
            'type'          =>'number',
            'unitless'         => true,
            'min'           => 0,
            'max'           => 100,
            'css'           => [
                [
                'property'  => 'animation-duration',
                'selector'  => '.bultr-ih-marker-wrapper .bultr-ih-marker',
                'value'     => '%ss',
                ],
            ],
            'inline'        => true,
            'required'      => [
                ['marker_animation', '!=', 'none'],
            ],
        ];

    }

    public function tooltip_style(){
        $this->controls['tooltip_preview'] = [
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Preview Tooltip ', 'wpv-bu' ),
            'type'          => 'checkbox',
            'default'       => false,
            'rerender'      => true,
            'info'          =>__('Enable to preview "Tooltip" Button in editor.','wpv-bu'),
        ];
       
        $this->controls['tooltip_bg_color']=[ 
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Background Color', 'wpv-bu' ),
            'type'          => 'background',
            'css'           => [
                [
                'property'  => 'background',
                'selector' =>'.tippy-box',
                ],
            ],
            'default' => [
                'color' => [
                'hex' => '#e6b000',
                ],
              ],
            
            'inline'        => true,
        ];
        $this->controls['tooltip_arrow_color']=[ 
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Arrow Color', 'wpv-bu' ),
            'type'          => 'color',
            'css'           => [
                [
                'property'  => 'color',
                'selector' =>'.tippy-arrow',
                ],
            ],
            'default' => '#e6b000',
            'inline'        => true,
        ];
        $this->controls['tooltip_border']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Border', 'wpv-bu' ),
            'type'          => 'border',
            'css'           => [
                [
                'property'  => 'border',
                'selector'  => '.tippy-content'
                ],
            
            ],
            'exclude'   => ['radius'],
            'inline'        => true,
        ];
        $this->controls['tooltip_border_radius']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Border Radius', 'wpv-bu' ),
            'type'          => 'border',
            'css'           => [
                [
                'property'  => 'border-radius',
                'selector'  => '.tippy-content'
                ],
                [
                    'property'  => 'border-radius',
                    'selector'  => '.tippy-box'
                    ],
            ],
            'exclude'   => ['width','style','color'],
            'inline'        => true,
        ];
        $this->controls['tooltip_box_shadow']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Box Shadow', 'wpv-bu' ),
            'type'          => 'box-shadow',
            'css'           => [
                [
                'property'  => 'box-shadow',
                'selector'  => '.tippy-content'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['tooltip_box_padding'] =[
            'tab'           => 'content',    
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Box Padding', 'wpv-bu' ),
            'type'          => 'spacing',
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.tippy-content'
                ],
            ],
        ];
        $this->controls['tooltip_width']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Width', 'wpv-bu' ),
            'type'          =>'number',
            'units'         => true,
            'min'           => 0,
            'css'           => [
                [
                'property'  => 'width',
                'selector'  => '.bultr-add-tooltip'
                ],
            ],
            'default'       => 250,
            'inline'        => true,
        ];

        $this->controls['tooltip_content_seperator']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Content', 'wpv-bu' ),
            'type'          => 'separator',
        ];
        $this->controls['tooltip_content_bg'] =[
            'tab'           => 'content',    
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Background', 'wpv-bu' ),
            'type'          => 'background',
            'css'           => [
                [
                'property'  => 'background',
                'selector'  => '.bultr-ih-tooltip-content'
                ],
            ],
           
        ];
        $this->controls['tooltip_content_gap']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Gap', 'wpv-bu' ),
            'type'          =>'number',
            'units'         => true,
            'min'           =>0,
            'css'           => [
                [
                'property'  => 'gap',
                'selector'  => '.bultr-ih-tooltip-wrapper .bultr-ih-tooltip-content'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['tooltip_content_align']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Vertical Alignment', 'wpv-bu' ),
            'type'          => 'justify-content',
            'css'           => [
            [
                'property' => 'justify-content',
                'selector'  => '.bultr-ih-tooltip-wrapper .bultr-ih-tooltip-content'
            ],
            ],
            'required'      =>[
                                ['tooltip_image_position','=',['row','row-reverse']],
                            ],
        ];
        $this->controls['tooltip_content_align_hor']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Horizontal Alignment', 'wpv-bu' ),
            'type'          => 'text-align',
            'css'           => [
            [
                'property'  => 'text-align',
                'selector'  => '.bultr-ih-tooltip-content .bultr-ih-content-heading'
            ],
            [
                'property'  => 'text-align',
                'selector'  => '.bultr-ih-tooltip-content .bultr-ih-content-description'
            ],
            [
                'property'  => 'text-align',
                'selector'  => '.bultr-ih-tooltip-content .bultr-ih-content-short-des'
            ],
            ],
            'exclude'       => ['justify'],
            'inline'        => true,
        ];
        $this->controls['tooltip_content_padding'] =[
            'tab'           => 'content',    
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Padding', 'wpv-bu' ),
            'type'          => 'spacing',
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ih-tooltip-wrapper .bultr-ih-tooltip-content'
                ],
            ],
        ];
       
        $this->controls['tooltip_seperator']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Image/Icon', 'wpv-bu' ),
            'type'          => 'separator',
        ];
        $this->controls['tooltip_image_bg']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Background', 'wpv-bu' ),
            'type'          => 'color',
            'css'           => [
                [
                'property'  => 'background-color',
                'selector'  => '.bultr-ih-tooltip-icon'
                ],
                [
                'property'  => 'background-color',
                'selector'  => '.bultr-ih-tooltip-image'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['tooltip_image_width']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Image Width', 'wpv-bu' ),
            'type'          =>'number',
            'units'         => true,
            'min'           =>0,
            'css'           => [
                [
                'property'  => 'width',
                'selector'  => '.bultr-ih-tooltip-img'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['tooltip_icon_size']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Icon Size', 'wpv-bu' ),
            'type'          =>'number',
            'units'         => true,
            'min'           =>0,
            'css'           => [
                [
                'property'  => 'font-size',
                'selector'  => '.bultr-ih-tooltip-icon'
                ],
                [
                    'property'  => 'font-size',
                    'selector'  => '.bultr-ih-tooltip-icon svg'
                    ],
            ],
            'inline'        => true,
        ];
        $this->controls['tooltip_icon_clr']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Icon Color', 'wpv-bu' ),
            'type'          => 'color',
            'css'           => [
                [
                'property'  => 'color',
                'selector'  => '.bultr-ih-tooltip-icon'
                ],
                [
                    'property'  => 'fill',
                    'selector'  => '.bultr-ih-tooltip-icon svg'
                    ],
            ],
        ];
        $this->controls['tooltip_image_position'] = [
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Position', 'wpv-bu' ),
            'type'          => 'direction',
            'css'           => [
                [
                'property' => 'flex-direction',
                'selector'  => '.bultr-ih-tooltip-wrapper'
                ],
            ],
            'default'       => 'column',
            'inline'        => true,
            'clearable'     => false,
        ];
        $this->controls['tooltip_image_align']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Alignment', 'wpv-bu' ),
            'type'          => 'justify-content',
            'direction'     => 'row',
            'css'           => [
            [
                'property' => 'justify-content',
                'selector'  => '.bultr-ih-tooltip-image'
            ],
            ],
            'exclude'       => ['space'],
            'default'       => 'center',
            'clearable'     => false,
            'inline'        => true,
            'required'      =>[
                                ['tooltip_image_position','=',['column','column-reverse']],
                            ],
        ];
        $this->controls['tooltip_image_align_ver']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Alignment', 'wpv-bu' ),
            'type'          => 'align-items',
            'direction'     => 'row',
            'css'           => [
            [
                'property' => 'align-items',
                'selector'  => '.bultr-ih-tooltip-image'
            ],
            ],
            'exclude'       => ['stretch'],
            'clearable'     => false,
            'inline'        => true,
            'required'      =>[
                ['tooltip_image_position','=',['row','row-reverse']],
            ],
        ];
        $this->controls['tooltip_img_icon_border']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Border', 'wpv-bu' ),
            'type'          => 'border',
            'css'           => [
                [
                'property'  => 'border',
                'selector'  => '.bultr-ih-tooltip-image .bultr-ih-tooltip-img'
                ],
                ['property'  => 'border',
                'selector'  => '.bultr-ih-tooltip-image .bultr-ih-tooltip-icon'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['tooltip_img_icon_padding']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Padding', 'wpv-bu' ),
            'type'          => 'spacing',
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ih-tooltip-image'
               ],
                // [
                // 'property'  => 'padding',
                // 'selector'  => '.bultr-ih-tooltip-image.bultr-ih-tooltip-icon'
                // ],
            ],
        ];

        $this->controls['tooltip_heading_seperator']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Heading', 'wpv-bu' ),
            'type'          => 'separator',
        ];
        $this->controls['tooltip_heading_typo']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Typography', 'wpv-bu' ),
            'type'          => 'typography',
            'css'           => [
                [
                'property'  => 'typography',
                'selector'  => '.bultr-ih-tooltip-content .bultr-ih-content-heading'
                ],
            ],
            'default'       => [
                'color'     => [
                'hex'       => '#383838',
                ],
              ],
        ];
        $this->controls['tooltip_heading_bg']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Background Color', 'wpv-bu' ),
            'type'          => 'color',
            'css'           => [
                [
                'property'  => 'background-color',
                'selector'  => '.bultr-ih-tooltip-content .bultr-ih-content-heading'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['tooltip_heading_padding']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Padding', 'wpv-bu' ),
            'type'          => 'spacing',
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ih-tooltip-content .bultr-ih-content-heading'
                ],
            ],
        ];

        $this->controls['tooltip_short_des_seperator']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Short Description', 'wpv-bu' ),
            'type'          => 'separator',
        ];
        $this->controls['tooltip_short_des_typo']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Typography', 'wpv-bu' ),
            'type'          => 'typography',
            'css'           => [
                [
                'property'  => 'typography',
                'selector'  => '.bultr-ih-tooltip-content .bultr-ih-content-short-des'
                ],
            ],
            
        ];
        $this->controls['tooltip_short_des_bg']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Background Color', 'wpv-bu' ),
            'type'          => 'color',
            'css'           => [
                [
                'property'  => 'background-color',
                'selector'  => '.bultr-ih-tooltip-content .bultr-ih-content-short-des'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['tooltip_short_des_padding']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Padding', 'wpv-bu' ),
            'type'          => 'spacing',
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ih-tooltip-content .bultr-ih-content-short-des'
                ],
            ],
        ];

        $this->controls['tooltip_des_seperator']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Description', 'wpv-bu' ),
            'type'          => 'separator',
        ];
        $this->controls['tooltip_des_typo']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Typography', 'wpv-bu' ),
            'type'          => 'typography',
            'css'           => [
                [
                'property'  => 'typography',
                'selector'  => '.bultr-ih-tooltip-content .bultr-ih-content-description'
                ],
            ], 
        ];
        $this->controls['tooltip_des_bg']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Background Color', 'wpv-bu' ),
            'type'          => 'color',
            'css'           => [
                [
                'property'  => 'background-color',
                'selector'  => '.bultr-ih-tooltip-content .bultr-ih-content-description'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['tooltip_des_padding']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Padding', 'wpv-bu' ),
            'type'          => 'spacing',
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ih-tooltip-content .bultr-ih-content-description'
                ],
            ],
        ];
       
        $this->controls['tooltip_btn_seperator']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Button', 'wpv-bu' ),
            'type'          => 'separator',
        ];
        $this->controls['tooltip_btn_pos']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Icon Position', 'wpv-bu' ),
            'type'          => 'select',
            'options'       => [
                'left'      => esc_html__( 'Left', 'wpv-bu' ),
                'right'     => esc_html__( 'Right', 'wpv-bu' ),
            ],
            'inline'        => true,
        ];
        $this->controls['tooltip_btn_icon_size']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Icon Size', 'wpv-bu' ),
            'type'          =>'number',
            'units'         => true,
            'min'           =>0,
            'css'           => [
                [
                'property'  => 'font-size',
                'selector'  => '.bultr-ih-content-btn i'
                ],
                [
                    'property'  => 'font-size',
                    'selector'  => '.bultr-ih-content-btn svg'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['tooltip_btn_icon_color']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Icon Color', 'wpv-bu' ),
            'type'          => 'color',
            'css'           => [
                [
                'property'  => 'color',
                'selector'  => '.bultr-ih-content-btn i'
                ],
                [
                    'property'  => 'fill',
                    'selector'  => '.bultr-ih-content-btn svg'
                    ],
            ],
            'inline'        => true,
        ];
        $this->controls['tooltip_btn_gap']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Gap', 'wpv-bu' ),
            'type'          =>'number',
            'units'         => true,
            'min'           =>0,
            'css'           => [
                [
                'property'  => 'gap',
                'selector'  => '.bultr-ih-tooltip-btn'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['tooltip_btn_typo']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Typography', 'wpv-bu' ),
            'type'          => 'typography',
            'css'           => [
                [
                'property'  => 'typography',
                'selector'  => '.bultr-ih-tooltip-btn'
                ],
            ],
        ];
        $this->controls['tooltip_btn_bg']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Background Color', 'wpv-bu' ),
            'type'          => 'color',
            'css'           => [
                [
                'property'  => 'background-color',
                'selector'  => '.bultr-ih-tooltip-btn'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['tooltip_btn_border']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Border', 'wpv-bu' ),
            'type'          => 'border',
            'css'           => [
                [
                'property'  => 'border',
                'selector'  => '.bultr-ih-tooltip-btn'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['tooltip_btn_width']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Width', 'wpv-bu' ),
            'type'          =>'number',
            'units'         => true,
            'min'           =>0,
            'css'           => [
                [
                'property'  => 'width',
                'selector'  => '.bultr-ih-tooltip-btn'
                ],
            ],
            'placeholder'   => '100%',
            'inline'        => true,
        ];
        $this->controls['tooltip_btn_align']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Alignment', 'wpv-bu' ),
            'type'          => 'justify-content',
            'css'           => [
            [
                'property' => 'justify-content',
                'selector'  => '.bultr-ih-content-btn'
            ],
            ],
            'exclude'       => ['space'],
            'clearable'     => false,
            'inline'        => true,
        ];
        $this->controls['tooltip_btn_padding'] =[
            'tab'           => 'content',    
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Padding', 'wpv-bu' ),
            'type'          => 'spacing',
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ih-tooltip-btn'
                ],
            ],
        ];
      
        $this->controls['tooltip_animation_sep']=[
            'tab'           => 'content',
            'label'         => esc_html__( 'Animation', 'wpv-bu' ),
            'group'         => 'tooltip_style',
            'type'          => 'separator',
        ];
        $this->controls['tooltip_animation']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Animation', 'wpv-bu' ),
            'type'          => 'select',
            'options'       => [
                'none'      => esc_html__( 'None', 'wpv-bu' ),
                'bounce'    => esc_html__( 'Bounce', 'wpv-bu' ),
                'bounceInDown' => esc_html__( 'Bounce In Down', 'wpv-bu' ),
                'flash'     => esc_html__( 'Flash', 'wpv-bu' ),
                'pulse'     => esc_html__( 'Pulse', 'wpv-bu' ),
                'swing'     => esc_html__( 'Swing', 'wpv-bu' ),
                'tada'      => esc_html__( 'Tada', 'wpv-bu' ),
                'wobble'    => esc_html__( 'Wobble', 'wpv-bu' ),
                'jello'     => esc_html__( 'Jello', 'wpv-bu' ),
                'heartBeat' => esc_html__( 'Heart Beat', 'wpv-bu' ),
            ],
           
            'inline'        => true,
        ];
        
        $this->controls['tooltip_animation_dur']=[
            'tab'           => 'content',
            'group'         => 'tooltip_style',
            'label'         => esc_html__( 'Duration', 'wpv-bu' ),
            'type'          =>'number',
            'unitless'         => true,
            'min'           => 0,
            'max'           => 100,
            'css'           => [
                [
                'property'  => 'animation-duration',
                'selector'  => '.bultr-ih-animation',
                'value'     => '%ss',
                ],
            ],
            'inline'        => true,
            'required'      => [
                ['marker_animation', '!=', 'none'],
            ],
        ];

    }

    public function hotspot_tour(){
        // $this->controls['hotspot_content_sep']=[
        //     'tab'           => 'content',
        //     'group'         => 'hotspot_tour',
        //     'label'         => esc_html__( 'Content', 'wpv-bu' ),
        //     'type'          => 'separator',
        // ];
        $this->controls['hotspot_content_bg']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Background Color', 'wpv-bu' ),
            'type'          => 'background',
            'css'           => [
                [
                'property'  => 'background',
                'selector'  => '.bultr-ih-image-container .bultr-ih-tooltip-tour'
                ],
            ],
            'default' => [
                'color' => [
                'hex' => '#292d32',
                ],
              ],
            'inline'        => true,
        ];
        $this->controls['hotspot_content_gap']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Gap', 'wpv-bu' ),
            'type'          => 'number',
            'units'         => true,
            'min'           => 0,
            'max'           => 100,
            'css'           => [
                [
                'property'  => 'gap',
                'selector'  => '.bultr-ih-image-container .bultr-ih-tooltip-tour'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['tour_align']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Alignment', 'wpv-bu' ),
            'type'          => 'justify-content',
            'css'           => [
            [
                'property' => 'justify-content',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-tour-content',
            ],
            ],
        ];
        $this->controls['tour_gap']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Next/Previous Gap', 'wpv-bu' ),
            'type'          => 'number',
            'units'         => true,
            'min'           => 0,
            'max'           => 100,
            'css'           => [
                [
                'property'  => 'gap',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-tooltip-pre-nxt-btn'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['hotspot_content_border'] =[
            'tab'           => 'content',    
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Border', 'wpv-bu' ),
            'type'          => 'border',
            'css'           => [
                [
                'property'  => 'border',
                'selector'  => '.bultr-ih-image-container .bultr-ih-tooltip-tour'
                ],
            ],
        ];
        $this->controls['hotspot_content_box_shadow'] =[
            'tab'           => 'content',    
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Box Shadow', 'wpv-bu' ),
            'type'          => 'box-shadow',
            'css'           => [
                [
                'property'  => 'box-shadow',
                'selector'  => '.bultr-ih-image-container .bultr-ih-tooltip-tour'
                ],
            ],
        ];
        $this->controls['hotspot_content_padding'] =[
            'tab'           => 'content',    
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Padding', 'wpv-bu' ),
            'type'          => 'spacing',
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ih-image-container .bultr-ih-tooltip-tour'
                ],
            ],
        ];
        $this->controls['hotspot_content_margin'] =[
            'tab'           => 'content',    
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Margin', 'wpv-bu' ),
            'type'          => 'spacing',
            'css'           => [
                [
                'property'  => 'margin',
                'selector'  => '.bultr-ih-image-container .bultr-ih-tooltip-tour'
                ],
            ],
        ];

        $this->controls['count_sep']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Count', 'wpv-bu' ),
            'type'          => 'separator',
        ];
        $this->controls['enable_count']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Enable Count', 'wpv-bu' ),
            'type'          => 'checkbox',
            'default'       => true,
        ];
        $this->controls['count_typo']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Typography', 'wpv-bu' ),
            'type'          => 'typography',
            'css'           => [
                [
                'property'  => 'typography',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-count'
                ],
            ],
            'inline'        => true,
            'required'      => ['enable_count','=',true],
            'default' => [
                'color' => [
                'hex' => '#e6b000',
                ],
              ],
        ];
        $this->controls['count_typo_bg']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Background Color', 'wpv-bu' ),
            'type'          => 'color',
            'css'           => [
                [
                'property'  => 'background-color',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-count'
                ],
            ],
            'inline'        => true,
            'required'      => ['enable_count','=',true],           
        ];
        $this->controls['count_tour_gap']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Gap', 'wpv-bu' ),
            'type'          => 'number',
            'units'         => true,
            'min'           => 0,
            'max'           => 100,
            'css'           => [
                [
                'property'  => 'gap',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-tour-content'
                ],
            ],
            'inline'        => true,
            'required'      => ['enable_count','=',true],           
        ];

        $this->controls['next_tour_sep']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Next Tour', 'wpv-bu' ),
            'type'          => 'separator',
        ];
        $this->controls['next_tour']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Next Tour', 'wpv-bu' ),
            'type'          => 'text',
            'placeholder'   => esc_html__( 'Next »', 'wpv-bu' ),
            'required'      => ['enable_hotspot_tour','=',true],
        ];
        $this->controls['next_tour_icon']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Icon', 'wpv-bu' ),
            'type'          => 'icon',
        ];
        $this->controls['next_tour_icon_clr']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Icon Color', 'wpv-bu' ),
            'type'          => 'color',
            'css'           => [
                [
                'property'  => 'color',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-next-tour i'
                ],
                [
                    'property'  => 'fill',
                    'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-next-tour svg'
                    ],
            ],
            'inline'        => true,
            'required'      => ['next_tour_icon','!=',''],
        ];
        $this->controls['next_tour_icon_size']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Icon Size', 'wpv-bu' ),
            'type'          =>'number',
            'units'         => true,
            'min'           =>0,
            'css'           => [
                [
                'property'  => 'font-size',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-next-tour i'
                ],
                [
                    'property'  => 'font-size',
                    'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-next-tour svg'
                    ],
            ],
            'inline'        => true,
            'required'      => ['next_tour_icon','!=',''],
        ];
        $this->controls['next_tour_icon_gap']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Icon Gap', 'wpv-bu' ),
            'type'          =>'number',
            'units'         => true,
            'min'           =>0,
            'css'           => [
                [
                'property'  => 'gap',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-next-tour'
                ],
            ],
            'inline'        => true,
            'required'      => ['next_tour_icon','!=',''],
        ];
        $this->controls['next_tour_typo']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Typography', 'wpv-bu' ),
            'type'          => 'typography',
            'css'           => [
                [
                'property'  => 'typography',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-next-tour'
                ],
            ],
            'default' => [
                'color' => [
                'hex' => '#e6b000',
                ],
              ],
            'inline'        => true,
        ];
        $this->controls['next_tour_bg']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Background Color', 'wpv-bu' ),
            'type'          => 'color',
            'css'           => [
                [
                'property'  => 'background-color',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-next-tour'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['next_tour_border']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Border', 'wpv-bu' ),
            'type'          => 'border',
            'css'           => [
                [
                'property'  => 'border',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-next-tour'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['next_tour_padding']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Padding', 'wpv-bu' ),
            'type'          => 'spacing',
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-tooltip-pre-nxt-btn .bultr-ih-next-tour'
                ],
            ],
        ];
      
        
        $this->controls['prev_tour_sep']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Previous Tour', 'wpv-bu' ),
            'type'          => 'separator',
        ];
        $this->controls['prev_tour']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Previous Tour', 'wpv-bu' ),
            'type'          => 'text',
            'placeholder'   => esc_html__( '« Previous', 'wpv-bu' ),
            'required'      => ['enable_hotspot_tour','=',true],
        ];
        $this->controls['prev_tour_icon']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Icon', 'wpv-bu' ),
            'type'          => 'icon',
        ];
        $this->controls['prev_tour_icon_clr']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Icon Color', 'wpv-bu' ),
            'type'          => 'color',
            'css'           => [
                [
                'property'  => 'color',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-prev-tour i'
                ],
                [
                    'property'  => 'fill',
                    'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-prev-tour svg'
                    ],
            ],
            'inline'        => true,
            'required'      => ['prev_tour_icon','!=',''],
        ];
        $this->controls['prev_tour_icon_size']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Icon Size', 'wpv-bu' ),
            'type'          =>'number',
            'units'         => true,
            'min'           =>0,
            'css'           => [
                [
                'property'  => 'font-size',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-prev-tour i'
                ],
                [
                    'property'  => 'font-size',
                    'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-prev-tour svg'
                    ],
            ],
            'inline'        => true,
            'required'      => ['prev_tour_icon','!=',''],
        ];
        $this->controls['prev_tour_icon_gap']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Icon Gap', 'wpv-bu' ),
            'type'          =>'number',
            'units'         => true,
            'min'           =>0,
            'css'           => [
                [
                'property'  => 'gap',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-prev-tour'
                ],
            ],
            'inline'        => true,
            'required'      => ['prev_tour_icon','!=',''],
        ];
        $this->controls['prev_tour_typo']=[
            'tab'       => 'content',
            'group'     => 'hotspot_tour',
            'label'     => esc_html__( 'Typography', 'wpv-bu' ),
            'type'      => 'typography',
            'css'       => [
                [
                'property'  => 'typography',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-prev-tour',
                ],
            ],
            'default' => [
                'color' => [
                'hex' => '#e6b000',
                ],
              ],
        ];
        $this->controls['pre_tour_bg']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Background Color', 'wpv-bu' ),
            'type'          => 'color',
            'css'           => [
                [
                'property'  => 'background-color',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-prev-tour'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['pre_tour_border']=[
            'tab'       => 'content',
            'group'     => 'hotspot_tour',
            'label'     => esc_html__( 'Border', 'wpv-bu' ),
            'type'      => 'border',
            'css'       => [
                [
                'property'  => 'border',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-prev-tour'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['pre_tour_padding']=[
            'tab'       => 'content',
            'group'     => 'hotspot_tour',
            'label'     => esc_html__( 'Padding', 'wpv-bu' ),
            'type'      => 'spacing',
            'css'       => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-tooltip-pre-nxt-btn .bultr-ih-prev-tour'
                ],
            ],
        ];
        
        

        $this->controls['end_tour_sep']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'End Tour', 'wpv-bu' ),
            'type'          => 'separator',
        ];
        $this->controls['end_tour']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'End Tour', 'wpv-bu' ),
            'type'          => 'text',
            'placeholder'   => esc_html__( 'End Tour', 'wpv-bu' ),
            'required'      => ['enable_hotspot_tour','=',true],
        ];
        $this->controls['end_tour_typo']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Typography', 'wpv-bu' ),
            'type'          => 'typography',
            'css'           => [
                [
                'property'  => 'typography',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-end-tour'
                ],
            ],
            'default' => [
                'color' => [
                'hex' => '#e6b000',
                ],
              ],
            'inline'        => true,
        ];
        $this->controls['end_tour_bg']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Background Color', 'wpv-bu' ),
            'type'          => 'color',
            'css'           => [
                [
                'property'  => 'background-color',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-end-tour'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['end_tour_border']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Border', 'wpv-bu' ),
            'type'          => 'border',
            'css'           => [
                [
                'property'  => 'border',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-end-tour'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['end_tour_padding']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Padding', 'wpv-bu' ),
            'type'          => 'spacing',
            'css'           => [
                [
                'property'  => 'padding',
                'selector'  => '.bultr-ih-end-tour-wrapper .bultr-ih-end-tour'
                ],
            ],
        ];
        $this->controls['end_tour_align']=[
            'tab'           => 'content',
            'group'         => 'hotspot_tour',
            'label'         => esc_html__( 'Alignment', 'wpv-bu' ),
            'type'          => 'text-align',
            'css'           => [
            [
                'property' => 'text-align',
                'selector'  => '.bultr-ih-tooltip-tour .bultr-ih-end-tour-wrapper',
            ],
            ],
            'exclude'       => ['justify'],
            'clearable'     => false,
            'inline'        => true,
        ];

    }

    public function close_btn_style(){
        $this->controls['close_btn_icon']=[
            'tab'           => 'content',
            'group'         => 'close_btn_style',
            'label'         => esc_html__( 'Icon', 'wpv-bu' ),
            'type'          => 'icon',
            'default' => [
				'library' => 'ionicons',
				'icon'    => 'ion-md-close',
			],
        ];
        $this->controls['close_btn_pos_top']=[
            'tab'           => 'content',
            'group'         => 'close_btn_style',
            'label'         => esc_html__( 'Top Position', 'wpv-bu' ),
                'type'      => 'number',
                'units'     => true,
                'css'       => [
                    [
                    'property' => 'top',
                    'selector' => '.bultr-ih-tooltip-content .bultr-ih-tooltip-close',

                    ],
                ],
        ];
        $this->controls['close_btn_pos_right']=[
            'tab'           => 'content',
            'group'         => 'close_btn_style',
            'label'         => esc_html__( 'Right Position', 'wpv-bu' ),
                'type'      => 'number',
                'units'     => true,
                'css'       => [
                    [
                    'property' => 'right',
                    'selector' => '.bultr-ih-tooltip-content .bultr-ih-tooltip-close',

                    ],
                ],
        ];
        $this->controls['close_btn_size']=[
            'tab'           => 'content',
            'group'         => 'close_btn_style',
            'label'         => esc_html__( 'Size', 'wpv-bu' ),
            'type'          => 'number',
            'units'         => true,
            'css'           => [
                [
                'property'  => 'font-size',
                'selector'  => '.bultr-ih-tooltip-content .bultr-ih-tooltip-close i'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['close_btn_color']=[
            'tab'           => 'content',
            'group'         => 'close_btn_style',
            'label'         => esc_html__( 'Color', 'wpv-bu' ),
            'type'          => 'color',
            'css'           => [
                [
                'property'  => 'color',
                'selector'  => '.bultr-ih-tooltip-content .bultr-ih-tooltip-close i'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['close_btn_bg']=[
            'tab'           => 'content',
            'group'         => 'close_btn_style',
            'label'         => esc_html__( 'Background Color', 'wpv-bu' ),
            'type'          => 'background',
            'css'           => [
                [
                'property'  => 'background-color',
                'selector'  => '.bultr-ih-tooltip-content .bultr-ih-tooltip-close i'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['close_btn_border']=[
            'tab'           => 'content',
            'group'         => 'close_btn_style',
            'label'         => esc_html__( 'Border', 'wpv-bu' ),
            'type'          => 'border',
            'css'           => [
                [
                'property'  => 'border',
                'selector'  => '.bultr-ih-tooltip-content .bultr-ih-tooltip-close i'
                ],
            ],
            'inline'        => true,
        ];
        $this->controls['close_btn_box_sh']=[
            'tab'           => 'content',
            'group'         => 'close_btn_style',
            'label'         => esc_html__( 'Box Shadow', 'wpv-bu' ),
            'type'          => 'box-shadow',
            'css'           => [
                [
                'property'  => 'box-shadow',
                'selector'  => '.bultr-ih-tooltip-content .bultr-ih-tooltip-close'
                ],
            ],
            'inline'        => true,
        ];
    }


    public function render(){
        $settings = $this->settings;
        // echo '<pre>';
        // print_r($settings);
        // echo $settings['tooltip_preview'];
        // echo '</pre>';

        $bg_image =isset( $settings['bg_image']['size'] ) ? $settings['bg_image']['size'] : BRICKS_DEFAULT_IMAGE_SIZE;

         //background image
         if (isset($settings['bg_image']['id'])) {
            $atts  = [
                '_brx_disable_lazy_loading' => true,
                'class' => 'bultr-ih-container-img',
            ];
            $img_src = wp_get_attachment_image($settings['bg_image']['id'], $bg_image, false, $atts);
        } 
       
        elseif (isset($settings['bg_image']['full'])) {
            
            $img_src = '<img src="' .$settings["bg_image"]["full"] . '" class="bultr-ih-container-img"/>';
        }
            
        else {
            $img_src = '<img src="' .\Bricks\Builder::get_template_placeholder_image(). '"/>';
        }

        $this->set_attribute('_root', 'class', 'bultr-ih-image-hotspot');

        $options['trigger'] = $settings['trigger_on'];
        
        if(isset($settings['tooltip_animation'])){
            $options['tltp_animation'] = $settings['tooltip_animation'];
        }
        if (isset($settings['tooltip_preview']) && $settings['tooltip_preview'] == '1') {
            if (bricks_is_builder() || bricks_is_builder_call()) {
                $options['tooltip_preview'] = $settings['tooltip_preview'];      
            }
        } 
        
       
        if(isset($settings['marker_data'])){
             foreach ($settings['marker_data'] as $index => $marker_items) {
                if(isset($marker_items['rep_tooltip_preview'])){
                    if (bricks_is_builder() || bricks_is_builder_call()) {
                    $options['rep_tooltip_preview'] = $marker_items['rep_tooltip_preview'];
                    }
                }
            }
        }
    
        $this->set_attribute('container', 'data-settings', wp_json_encode($options));
       
        $this->set_attribute('container', 'class', 'bultr-ih-image-container');

       
        ?>
         <div <?php echo  $this->render_attributes('_root');?>>
            <div <?php echo  $this->render_attributes('container');?>>
                <?php echo $img_src;
                if(isset($settings['marker_data'])){
                ?> <div class="bultr-marker-colleciton"> <?php
                foreach ($settings['marker_data'] as $index => $marker_items) { 
                   
                    $this->layout($marker_items, $index);
                }
            }?>
            </div>
            </div>
         </div>
        <?php
        
    }

    public function layout($marker_items, $index){
       
        $settings = $this->settings;
       
        $tooltip_img = isset( $marker_items['tooltip_image']['size'] ) ? $marker_items['tooltip_image']['size'] : BRICKS_DEFAULT_IMAGE_SIZE;
        $marker_image = isset( $marker_items['marker_image']['size'] ) ? $marker_items['marker_image']['size'] : BRICKS_DEFAULT_IMAGE_SIZE;
        $index = array_search($marker_items, $this->settings['marker_data']);
        if ($index !== false) {
            $index_data = (int)$index + 1;
        }
        
        $prev_text = isset($settings['prev_tour']) ? $settings['prev_tour'] : '« Previous';
        $next_text = isset($settings['next_tour']) ? $settings['next_tour'] : 'Next »';
        $end_text = isset($settings['end_tour']) ? $settings['end_tour'] : 'End Tour';
        $content_btn_pos = isset($settings['tooltip_btn_pos']) ? $settings['tooltip_btn_pos'] : 'left';
        //tooltip image
        if(isset($marker_items['tooltip_image']['id'])){
            $atts  = [
                '_brx_disable_lazy_loading' => true,
                'class' => 'bultr-ih-tooltip-img',
            ];
            $tooltip_img_src = wp_get_attachment_image($marker_items['tooltip_image']['id'],$tooltip_img, false, $atts);
        }
        else{
            $tooltip_img_src = '<img src="' .\Bricks\Builder::get_template_placeholder_image(). '"/>';
        }
       
        
        $class =[];

        $class[] ='bultr-ih-marker';

        if (isset($marker_items['marker_type']) && $marker_items['marker_type'] == 'none') {
            // Add a class
            $class[] = 'bultr-ih-marker-none';
        }
    
        if (isset($marker_items['rep_tooltip_preview']) && $marker_items['rep_tooltip_preview'] == '1') {
            if (bricks_is_builder() || bricks_is_builder_call()) {
                $class[] = 'bultr-ih-rep-tooltip-show';
            }    
        }  
        if (isset($settings['tooltip_preview']) && $settings['tooltip_preview'] == '1') {
            if (bricks_is_builder() || bricks_is_builder_call()) {
                // $this->set_attribute('container', 'class', 'bultr-ih-tooltip-show');
                $class[] = 'bultr-ih-tooltip-show';
                      
            }
        }  
         
        if(isset($settings['marker_icon_pos'])){
            $class[] = 'bultr-ih-marker-icon-'.$settings['marker_icon_pos'];
        }

        if(isset($marker_items['marker_type'])) {
            $this->set_attribute("repeater-{$index}", 'class', 'bultr-ih-rep-'.$marker_items['marker_type']);
        }

        if(isset($settings['marker_animation'])){
            $class[]   ='brx-animated';
            $class[] = 'brx-animate-'.$settings['marker_animation'];
        }
        if(isset($settings['marker_animation_infi'])){
            //add inline css on marker
            $this->set_attribute("marker-{$index}", 'style', 'animation-iteration-count: infinite;');
        }

        $this->set_attribute("repeater-{$index}", 'class', 'bultr-ih-marker-wrapper');
        $this->set_attribute("repeater-{$index}", 'class', 'repeater-item');


        $this->set_attribute("marker-{$index}", 'class',$class);
        $this->set_attribute("marker-{$index}", 'data-marker', $index_data);  

        $this->set_attribute("tooltip-{$index}", 'class','bultr-ih-tooltip');
        $this->set_attribute("tooltip-{$index}", 'id', 'tooltip-'.$index_data);

        $this->set_attribute("tltp-wrapper-{$index}", 'class', 'bultr-ih-tooltip-wrapper');
        
        $this->set_attribute("tooltip_media-{$index}", 'class', 'bultr-ih-tooltip-image');
        if(isset($marker_items['tooltip_select']) && $marker_items['tooltip_select'] == 'icon'){
            $this->set_attribute("tooltip_media-{$index}", 'class', 'bultr-ih-tooltip-icon');
        }
        $this->set_attribute("content_btn", 'class', 'bultr-ih-content-btn');
        
        $this->set_attribute("tooltip_btn-{$index}", 'class', 'bultr-ih-tooltip-btn');
        $this->set_attribute("tooltip_btn-{$index}", 'class', 'bultr-ih-tooltip-btn-'.$content_btn_pos);
        if(!empty($marker_items['tooltip_btn_link'])){
        $this->set_link_attributes( "tooltip_btn-{$index}", $marker_items['tooltip_btn_link'] );
        }
        ?>
		
        <div <?php echo $this->render_attributes("repeater-{$index}");?>>
            <div <?php echo $this->render_attributes("marker-{$index}");?>>
                <?php 
                    if(isset($marker_items['marker_type']) && $marker_items['marker_type'] == 'image'){
                        $atts  = [
                            '_brx_disable_lazy_loading' => true,
                            'class' => 'bultr-ih-marker-img',
                        ];
                        $marker_img_src = wp_get_attachment_image($marker_items['marker_image']['id'],$marker_image, false, $atts);
                        echo $marker_img_src;
                    }
                    if(isset($marker_items['marker_type']) && $marker_items['marker_type'] == 'iconText'){
                        if(!empty($marker_items['marker_icon'])){
                            $icon = !empty($marker_items['marker_icon']) ? $marker_items['marker_icon'] : false;
                            $icon = self::render_icon($icon, []);
                            echo $icon;
                        }
                        if(isset($marker_items['marker_text'])){
                            echo '<div class="bultr-ih-marker-text">'. $marker_items['marker_text'] .'</div>';
                        }
                    }
                    if (isset($marker_items['marker_type']) && $marker_items['marker_type'] == 'lottie') {
                        echo $this->render_lottie($index, $marker_items);
                    }
                    
                ?>
            </div>
            <div <?php echo $this->render_attributes("tooltip-{$index}");?>>
                    <div <?php echo $this->render_attributes("tltp-wrapper-{$index}");?>>
                        <?php if (isset($marker_items['tooltip_select']) && $marker_items['tooltip_select'] !== 'none') { ?>
                            <div <?php echo $this->render_attributes("tooltip_media-{$index}");?>>
                                <?php if (isset($marker_items['tooltip_select']) && $marker_items['tooltip_select'] == 'image') {
                                    echo $tooltip_img_src;
                                    }
                                
                                    elseif(isset($marker_items['tooltip_select']) && $marker_items['tooltip_select'] == 'icon'){
                                        if(!empty($marker_items['tooltip_icon'])){
                                            $icon = !empty($marker_items['tooltip_icon']) ? $marker_items['tooltip_icon'] : false;
                                            $icon = self::render_icon($icon, []);
                                            echo $icon;
                                        }
                                    }?>
                            </div>
                        <?php } ?>
                        <div class="bultr-ih-tooltip-content"><?php 
                            if(isset($marker_items['heading'])){ ?>
                                <div class="bultr-ih-content-heading">
                                    <?php echo $marker_items['heading'] ?>
                                </div><?php 
                            } 
                            if(isset($marker_items['short_description'])){ ?>
                                <div class="bultr-ih-content-short-des">
                                    <?php  
                                    $content = $this->render_dynamic_data( $marker_items['short_description'] );
                                    $content = Helpers::parse_editor_content( $content );
                                    echo $content; ?>
                                </div><?php 
                            } 
                            if(isset($marker_items['description'])){ ?>
                                <div class="bultr-ih-content-description">
                                    <?php 
                                    $content = $this->render_dynamic_data( $marker_items['description']);
                                    $content = Helpers::parse_editor_content( $content );
                                    echo $content; ?>
                                </div><?php 
                            } 
                            if(isset($marker_items['tooltip_button']) || isset($marker_items['tooltip_btn_icon']) ){?>
                        
                                <div <?php echo $this->render_attributes("content_btn");?> >
                                    <a <?php echo $this->render_attributes("tooltip_btn-{$index}");?>> <?php 
                                    if (isset($marker_items['tooltip_btn_icon'])) {
                                        echo self::render_icon($marker_items['tooltip_btn_icon']);
                                    }
                                    if (isset($marker_items['tooltip_button'])) {
                                    echo $marker_items['tooltip_button'] ;
                                    } ?></a>
                                </div><?php 
                            } 
                            
                            if(isset($settings['enable_close_btn']) && $settings['enable_close_btn'] == 'true'){ ?>

                                <a class="bultr-ih-tooltip-close"  data-tooltipid=<?php echo $index_data ?>><?php
                                if(!empty($settings['close_btn_icon'])){
                                            $icon = !empty($settings['close_btn_icon']) ? $settings['close_btn_icon'] : false;
                                            $icon = self::render_icon($icon, []);
                                            echo $icon;
                                        }
                                ?> </a> <?php 
                            } ?>
                        </div>
                    </div>
                    <?php if(isset($settings['enable_hotspot_tour']) && $settings['enable_hotspot_tour'] == true){ ?>
                        <div class="bultr-ih-tooltip-tour">
                            <div class="bultr-ih-tour-content">
                                <?php if(isset($settings['enable_count']) && $settings['enable_count']== true){?>
                                    <div class="bultr-tooltip-count-tour">
                                        <div class="bultr-ih-count"><?php echo ($index_data) . " of " . count($settings['marker_data']); ?></div>
                                    </div>
                                <?php } ?>
                                <div class="bultr-tooltip-pre-nxt-btn">
                                    <a class="bultr-ih-prev-tour" data-tooltipid=<?php echo $index_data ?>>
                                    <?php 
                                    $icon = '';
                                        if (isset($settings['prev_tour_icon'])) {
                                        $icon = self::render_icon($settings['prev_tour_icon']);
                                    }
                                    echo $icon , $prev_text ; ?>
                                    </a>
                                    <a class="bultr-ih-next-tour" data-tooltipid=<?php echo $index_data ?>>
                                    <?php 
                                        $icon = '';
                                        if (isset($settings['next_tour_icon'])) {
                                        $icon = self::render_icon($settings['next_tour_icon']);
                                    }
                                    echo $next_text, $icon ; ?>
                                    </a>
                                </div>
                            </div>
                            <div class="bultr-ih-end-tour-wrapper">
                                <a class="bultr-ih-end-tour" data-tooltipid=<?php echo $index_data ?>>
                                <?php echo $end_text ;?>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
        </div>
        <?php
    }

    public function render_lottie($index,$marker_items){
      
        if(isset($marker_items['lottie_type']) && $marker_items['lottie_type'] === "media"){
            $lottie_url = isset($marker_items['lottie_media']) ? $marker_items['lottie_media']['url'] : '';
        }
        else{
            $lottie_url = !empty($marker_items['lottie_url']) ? $marker_items['lottie_url'] : '';
        }
        $lottie_options = [
            'url'       => $lottie_url,
            'loop'      => isset($marker_items['lottie_loop']) ? $marker_items['lottie_loop'] : false,
            'direction' => isset( $marker_items['lottie_reverse'] ) ? true : false,
        ];
        $this->set_attribute("lottie-{$index}", 'class', "bultr-ih-lottie bultr-ih-lottie-animation");
        $this->set_attribute("lottie-{$index}", 'data-lottie-settings', wp_json_encode($lottie_options));
        $this->set_attribute("lottie-{$index}", 'data-lottie-id', "bultr-istk-".rand(10,1000));


        ?>
        <div <?php echo $this->render_attributes("lottie-{$index}");?>></div>
        <?php
    }

}


