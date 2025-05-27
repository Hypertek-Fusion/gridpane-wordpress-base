<?php
namespace BricksUltra\includes\AdvanceButton;

use Bricks\Element;
class Module extends Element {
	public $category     = 'ultra';
	public $name         = 'wpvbu-advanced-button';
	public $icon         = 'ion-md-alert';
	public $css_selector = '';
	public $scripts      = [ '' ];
	public function get_label() {
		return esc_html__( 'Advanced Button', 'wpv-bu' );
	}

	public function set_control_groups() {
		$this->control_groups['advance_layout'] = [
			'title' => esc_html__( 'Layout', 'wpv-bu' ),
			'tab'   => 'content',
		];
        $this->control_groups['advance_content'] = [
			'title' => esc_html__( 'Content', 'wpv-bu' ),
			'tab'   => 'content',
		];
        $this->control_groups['advance_icon'] = [
			'title' => esc_html__( 'Icon', 'wpv-bu' ),
			'tab'   => 'content',
		];

        $this->control_groups['advance_separator'] = [
			'title' => esc_html__( 'Separator   ', 'wpv-bu' ),
			'tab'   => 'content',
		];
        $this->control_groups['advance_layout_style'] = [
			'title' => esc_html__( 'Layout Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
        $this->control_groups['advance_content_style'] = [
			'title' => esc_html__( 'Content Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
        $this->control_groups['advance_icon_style'] = [
			'title' => esc_html__( 'Icon Style', 'wpv-bu' ),
			'tab'   => 'content',
		];

        $this->control_groups['advance_separator_style'] = [
			'title' => esc_html__( 'Separator Style', 'wpv-bu' ),
			'tab'   => 'content',
            'required' => [
				[ 'advance-separator-show', '=', true ],
			],
		];
       

    }

    public function set_controls()
    {
        $this->controls['layout'] = [
			    'tab'     => 'content',
		    	'group'   => 'advance_layout',
          'label' => esc_html__( 'Direction', 'wpv-bu' ),
          'type'  => 'direction',
          'inline'      => true,     
          'css'   => [
                [
                    'property' => 'flex-direction',
                    'selector' => '.bultr-advance-button',                 
                ],
                [
                    'property' => 'display',
                    'selector' => '.bultr-advance-button',
                    'value'	=>	'flex'
                ],
            ],
          'default' => 'column',
		    ];

       



        $this->controls['layout_background_type'] = [
            'tab'=>'content',
            'group' => 'advance_layout_style',
            'label'   => esc_html__( 'Background Type', 'wpv-bu' ),
            'type'    => 'select',
            'inline' => true,
            'options' => [
                'background_color' => 'Color',
                'background_gradient'  => 'Gradient',
            ],
            
        ];
        $this->controls['typeInfo'] = [
          'group' => 'advance_layout_style',
          'tab' => 'content',
          'content' => esc_html__( 'In Apply to field only use background option.', 'wpv-bu' ),
          'type' => 'info',
          'required' => ['layout_background_type', '=', 'background_gradient'], // Show info control if 'type' = 'custom'
        ];

        $this->controls['layout_background_color'] = [
            'tab' => 'content',
            'group'   => 'advance_layout_style',
			      'label'   => __( 'Background Color', 'wpv-bu' ),
            'type' => 'color',
            'inline' => true,
            'css' => [
              [
                'property' => 'background-color',
                'selector' => '.bultr-advance-button',
                ]
            ],
            'required' => [ 'layout_background_type', '=', 'background_color' ],
       
       ];

        $this->controls['layout_background_gradient'] = [
            'tab' => 'content',
            'group'   => 'advance_layout_style',
            'label' => esc_html__( 'Gradient', 'bricks' ),
            'type' => 'gradient',
            'css' => [
              [
                'property' => 'background-image',
                'selector' => '.bultr-advance-button',
              ],
            ],
            'required' => [ 'layout_background_type', '=', 'background_gradient' ],
       
        ];
        $this->controls['layoutBorder'] = [
            'tab' => 'content',
            'group'   => 'advance_layout_style',
			      'label'   => __( 'Border', 'wpv-bu' ),
            'type' => 'border',
            'css' => [
              [
                'property' => 'border',
                'selector' => '.bultr-advance-button',
                  ],
            ],
            'inline' => true,
            'small' => true,
            'default' => [
            'width' => [
              'top' => 2,
              'right' => 2,
              'bottom' => 2,
              'left' => 2,
              ],
              'style' => 'solid',
              'color' => [
                 'hex' => '#000000',
              ],
            ],
        ];
        $this->controls['layout_boxshadow'] = [
            'tab' => 'content',
            'label' => esc_html__( 'BoxShadow', 'wpv-bu'),
            'type' => 'box-shadow',
            'group'   => 'advance_layout_style',
            'css' => [
              [
                'property' => 'box-shadow',
                'selector' => '.bultr-advance-button',
            ],
            ],
            'inline' => true,
            'small' => true,
        ];
        $this->controls['layout_padding'] = [
			      'tab'      => 'content',
			      'group'   => 'advance_layout_style',
            'label'    => esc_html__( 'Padding', 'wpv-bu' ),
			      'type'     => 'dimensions',
		      	'css'      => [
		            		[
			          		'property' => 'padding',
                    'selector' => '.bultr-advance-button',
                  ],
				
		          	 ],
		    ];
        $this->controls['layout_align'] = [
          'tab'   => 'content',
          'group'   => 'advance_layout_style',
          'label' => esc_html__( 'Alignment', 'bricks' ),
          'type'  => 'justify-content',
          'css'   => [
            [
              'property' => 'justify-content',
              'selector' => '.bultr-advance-btn',
            ],
          ],
          'exclude' => [
            'space'
          ],
          'inline' => true,
        ];
        $this->controls['layout-spacing'] = [
                'tab' => 'content',
                'label' => esc_html__( 'Spacing', 'wpv-bu'),
                'type' => 'number',
                'group'   => 'advance_layout_style',
           
                'unit' => 'px',
                'inline' => true,
                'css' => [
                  [
                    'property' => 'gap',
                    'selector' => '.bultr-advance-button',
               
                  ],
                ],
                 'default' => 20,
        ];
        
        $this->controls['title'] = [
		      	'tab'     => 'content',
		      	'group'   => 'advance_content',
		      	'label'   => __( 'Title', 'wpv-bu' ),
			      'type'    => 'text',
			      'default' => 'WATCH VIDEO',
		    ];
        $this->controls['description'] = [
          'tab'     => 'content',
          'group'   => 'advance_content',
          'label'   => __( 'Description', 'wpv-bu' ),
          'type'    => 'textarea',
          'default' => 'FOLLOW THE STEP-BY-STEP GUIDE',
	    	];
        $this->controls['link'] = [
            'tab'         => 'content',
            'label'       => esc_html__( 'Link', 'wpv-bu' ),
            'type'        => 'link',
            'group'   => 'advance_content',
            'pasteStyles' => false,
            'placeholder' => esc_html__( 'http://yoursite.com', 'wpv-bu' ),
            'exclude'     => [
             'rel',
             'newTab',
            ],
        ];
        $this->controls['title_typography'] = [
            'tab' => 'content',
            'group' =>'advance_content_style',
            'label' => esc_html__( 'TItle Typography', 'wpv-bu' ),
            'type' => 'typography',
            'css' => [
              [
                'property' => 'typography',
                'selector' => '.bultr-advance-title',
              ],
            ],
            'inline' => true,
        ];
        $this->controls['description_typography'] = [
            'tab' => 'content',
            'group' =>'advance_content_style',
            'label' => esc_html__( 'Description Typography', 'wpv-bu' ),
            'type' => 'typography',
            'css' => [
              [
                'property' => 'typography',
                'selector' => '.bultr-advance-description',
              ],
            ],
            'inline' => true,
        ];

        $this->controls[ 'advance_icon_main' ] = [
            'tab'   => 'content',
            'group' => 'advance_icon',
            'label' => esc_html__( 'Icon', 'wpv-bu' ),
            'type'  => 'icon',
            'css'   => [
                [
                    'selector' => '.icon-svg', // Use to target SVG file
                ],
               ],
            'default' => [
				      'library' => 'fontawesomeSolid',
				      'icon'    => 'fas fa-circle-play',
		          	],
        ];
        $this->controls[ 'advance_icon_view' ]  = [
            'label'   => esc_html__( 'View', 'wpv-bu' ),
            'type'    => 'select',
            'group' => 'advance_icon',
            'options' => [
                'default' => 'Default',
                'stacked' => 'Stacked',
                'framed'  => 'Framed',
              ],
            'default' => 'default',
            'required' => [ 'advance_icon_main.icon', '!=', '' ],
            'inline'      => true,
        ];

        $this->controls[ 'advance_icon_shape' ]  = [
            'label'    => esc_html__( 'Shape', 'wpv-bu' ),
            'type'     => 'select',
            'group' => 'advance_icon',
            'options'  => [
                'circle' => 'Circle',
                'square' => 'Square',
            ],
            'default'  => 'circle',
            'required' => [
                ['advance_icon_view','!=','default'],
                [ 'advance_icon_main.icon', '!=', '' ],
            ],
            'inline'      => true,
        ];

        $this->controls[ 'button_icon_position' ] = [
            'tab'         => 'content',
            'group'       => 'advance_icon',
            'label'       => esc_html__( 'Icon Position',  'wpv-bu' ),
            'type'        => 'select',
            'options'     => [
                'left'  => 'Left',
                'right' => 'Right',
            ],
                'default'     => 'left',
                'clearable'   => false,
                'inline'      => true,
        ];
        $this->controls['icon_align'] = [
            'tab' => 'content',
            'label' => esc_html__( 'Alignment', 'wpv-bu' ),
            'type' => 'justify-content',
            'group'  => 'advance_icon',
            'inline' => true,
             'css' => [
                [
                  'property' => 'align-self',
                  'selector' => ' .bultr-advance-button-icon',
           
                ],
              ],
              'required' => [
                ['layout','!=', 'row'],
                ['layout','!=', 'row-reverse'],
              ],
            'exclude' => [
				'space',
			],
        ];
        $this->controls['icon_size'] = [
            'tab' => 'content',
            'label' => esc_html__( 'Size', 'wpv-bu' ),
            'type' => 'number',
            'group'  => 'advance_icon_style',
            'unit' => 'px',
            'inline' => true,
            'css' => [
              [
                'property' => 'font-size',
                'selector' => '.bultr-advance-button-icon i',
              ],
              [
                'property' => 'font-size',
                'selector' => '.bultr-advance-button-icon svg',
              ],
            ],
            // 'default' => 100,
        ];
        
		$this->controls['icon_primary_color'] = [
			'tab'   => 'content',
            'group'  => 'advance_icon_style',
			'label' => esc_html__( 'Primary Color', 'wpv-bu' ),
			'type'  => 'color',
			'css'   => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-advance-icon-view-stacked i',],
				[
					'property' => 'border-color',
					'selector' => '.bultr-advance-icon-view-framed i',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-advance-icon-view-framed i',
    				],
				[
					'property' => 'color',
          'selector' => '.bultr-advance-icon-view-default  i',
          ],
          


          [
            'property' => 'background-color',
            'selector' => '.bultr-advance-icon-view-stacked svg',],
          [
            'property' => 'border-color',
            'selector' => '.bultr-advance-icon-view-framed svg',
          ],
          [
            'property' => 'fill',
            'selector' => '.bultr-advance-icon-view-framed svg',
              ],
          [
            'property' => 'fill',
            'selector' => '.bultr-advance-icon-view-default  svg',
            ],
			],
		];

		$this->controls['icon_secondary_color'] = [
			'tab'      => 'content',
            'group'  => 'advance_icon_style',
			'label'    => esc_html__( 'Secondary Color', 'wpv-bu' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.bultr-advance-icon-view-framed i',
				],
				[
					'property' => 'color',
					'selector' => '.bultr-advance-icon-view-stacked i',
				],
        [
					'property' => 'background-color',
					'selector' => '.bultr-advance-icon-view-framed svg',
				],
				[
					'property' => 'fill',
					'selector' => '.bultr-advance-icon-view-stacked svg',
				],
				
			],
			
			'required' => [
				'advance_icon_view',
				'!=',
				'default',
			],
		];

        
        $this->controls['icon_padding'] = [
			'tab'      => 'content',
			'group'   => 'advance_icon_style',
            'label'    => esc_html__( 'Padding', 'wpv-bu' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'padding',
					'selector' => '.bultr-advance-button-icon i',
            ],
            [
              'property' => 'padding',
              'selector' => '.bultr-advance-button-icon svg',
                ],
				
			 ],
		];
        $this->controls['icon-border'] = [
            'tab' => 'content',
            'group'   => 'advance_icon_style',
			'label'   => __( 'Border', 'wpv-bu' ),
            'type' => 'border',
            'css' => [
              [
                'property' => 'border',
                'selector' => '.bultr-advance-button-icon i',
              ],
              [
                'property' => 'border',
                'selector' => '.bultr-advance-button-icon svg',
              ],
            ],
            'inline' => true,
            'small' => true,
           
        ];
        $this->controls['icon-spacing'] = [
            'tab' => 'content',
            'label' => esc_html__( 'Spacing', 'wpv-bu'),
            'type' => 'number',
            'group'   => 'advance_icon_style',
       
            'unit' => 'px',
            'inline' => true,
            'default'=> '5px',
            'css' => [
              [
                'property' => 'gap',
                'selector' => '.bultr-advance-button-icon',
         
              ],
            ],
           
        ];
    
        $this->controls['advance-separator-show']  = [
			'tab'      => 'content',
			'group'    => 'advance_separator',
			'label'    => esc_html__( 'Show Separator', 'wpv-bu' ),
			'type'     => 'checkbox',
			'inline'   => true,
			'small'    => true,
			'default'  => true,
		];
        $this->controls[ 'advance_separator_type' ] = [
            'tab'         => 'content',
            'group'       => 'advance_separator',
            'label'       => esc_html__( 'Type',  'wpv-bu' ),
            'type'        => 'select',
            'options' => [
                'solid' => esc_html__( 'Solid', 'wpv-bu' ),
                'double' => esc_html__( 'Double', 'wpv-bu' ),
                'dotted' => esc_html__( 'Dotted', 'wpv-bu' ),
                'dashed' => esc_html__( 'Dashed', 'wpv-bu' ),
            ],
            'default' => 'solid',
            'clearable' => false,
            'inline'      => true,
            'css' => [
                [
                  'property' => 'border-bottom-style',
                  'selector' => '.bultr-layout-column .bultr-advance-separator-col',
           
                ],
                [
                    'property' => 'border-right-style',
                    'selector' => '.bultr-layout-row .bultr-advance-separator-row',
             
                  ],
                  [
                    'property' => 'border-bottom-style',
                    'selector' => '.bultr-layout-column-reverse .bultr-advance-separator-col',
             
                  ],
                  [
                      'property' => 'border-right-style',
                      'selector' => '.bultr-layout-row-reverse .bultr-advance-separator-row',
               
                    ],
              ],
            'required' => [
				[ 'advance-separator-show', '=', true ],
			],
        ];
        $this->controls['separator_size'] = [
            'tab' => 'content',
            'label' => esc_html__( 'Weight', 'wpv-bu' ),
            'type' => 'number',
            'group'  => 'advance_separator',
            'unit' => 'px',
            'inline' => true,
            'default'=>'1px',
            'css' => [
                [
                  'property' => 'border-width',
                  'selector' => '.bultr-advance-separator-col',
           
                ],
                [
                  'property' => 'border-width',
                  'selector' => '.bultr-advance-separator-row',
           
                ],
              ],
              'placeholder'=>'1px',
            'required' => [
				[ 'advance-separator-show', '=', true ],
			],
            
          ];
        
      $this->controls['separator_color'] = [
			'tab'    => 'content',
			'group'  => 'advance_separator_style',
           'label'  => esc_html__( 'Color', 'wpv-bu' ),
			'type'   => 'color',
			'inline' => true,
			'small'  => true,
			'css'    => [
				[
					'property' => 'border-bottom-color',
          'selector' => '.bultr-advance-separator-col',
				],
        [
					'property' => 'border-right-color',
          'selector' => '.bultr-advance-separator-row',
				],
				
			],
		];
      $this->controls['separator_width'] = [
        'tab' => 'content',
        'type' => 'number',
          'group'  => 'advance_separator_style',
          'label'  => esc_html__( 'Width', 'wpv-bu' ),
          'unit' => 'px',
          'inline' => true,
			    'css' => [
				      [
				        	'property' => 'width',
                    'selector' => '.bultr-advance-separator-col',
			      	],
              [
					        'property' => 'height',
                    'selector' => '.bultr-advance-separator-row',
                  ],
			        ],
			    'placeholder'=>'100px',
		];


        $this->controls['separator_align'] = [
            'tab' => 'content',
            'label' => esc_html__( 'Alignment', 'wpv-bu' ),
            'type'     => 'align-items',
			      'exclude'  => 'stretch',
            'group'  => 'advance_separator_style',
            'unit' => 'px',
            'inline' => true,
            'placeholder' => __( '200px', 'wpv-bu' ),
            'css' => [
                [
                  'property' => 'align-self',
                  'selector' => '.bultr-advance-separator-col',
           
                ],
                [
                  'property' => 'align-self',
                  'selector' => '.bultr-advance-separator-row',
           
                ],
              ],
            'required' => [
				      [ 'advance-separator-show', '=', true ],
			      ],
        ];
    }

    public function enqueue_scripts() {
      wp_enqueue_style( 'bultr-module-style' );
    }
    
    public function render(){
        $settings = $this->settings;
        $layout = $settings['layout'] ?? 'column';
        $position = $settings['button_icon_position'];
        $view = $settings['advance_icon_view'] ?? 'stacked';
        $shape = $settings['advance_icon_shape'] ?? 'circle';
        //echo '<pre>';  print_r($settings['link']); echo '</pre>';
        if ( isset( $settings['link'] ) ) {
			    $this->set_link_attributes( 'button', $settings['link'] );
		    }
        
       
        $this->set_attribute( '_root', 'class', 'bultr-alert-element' );
		    $this->set_attribute( 'button', 'class', 'bultr-advance-button' );
        $this->set_attribute( 'button', 'class', 'bultr-layout-' . $layout );
        $this->set_attribute( 'button', 'class', 'button_icon_position-' . $position );
        $this->set_attribute( 'view', 'class', 'bultr-advance-icon-view-' . $view );
        $this->set_attribute( 'view', 'class', 'bultr-advance-icon-shape-' . $shape );
      
		
       ?>
     	<div <?php echo $this->render_attributes( '_root' ); ?>>
        <div class="bultr-advance-btn">
        <a <?php echo $this->render_attributes( 'button' ); ?>>
            <span class="bultr-advance-button-icon">
                <span <?php echo $this->render_attributes( 'view' ); ?>>
            <?php 
				$icon = ! empty( $settings['advance_icon_main'] ) ? self::render_icon( $settings['advance_icon_main'], '' ) : false ;
				    echo $icon
			?>
                </span>
                <?php if(isset($settings['title'] )) {?>
           
                <span class="bultr-advance-title">
                <?php echo $this->settings['title'];?>
                </span>
                <?php } ?>
            </span> 
             <?php if(isset($settings['advance-separator-show'] )) {?>
              <?php if($layout=='column'|| $layout =='column-reverse') { ?>
            <span class="bultr-advance-separator-col"></span>
            <?php } ?>
            <?php if($layout=='row'|| $layout =='row-reverse') { ?>
            <span class="bultr-advance-separator-row"></span>
            <?php } ?>
            <?php }?>           

           <?php if(isset($settings['description'] )) {?>
            <span class="bultr-advance-description">
           <?php echo $this->settings['description'];?>
            </span>
            <?php }?>
        </a>
        </div>
       </div>
       
       <?php
    }
}    