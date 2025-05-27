<?php
namespace BricksUltra\includes\BusinessHours;
use Bricks\Element;
class Module extends Element {
    public $category     = 'ultra';
	public $name         = 'wpvbu-business-hours';
	public $icon         = 'ti-briefcase';
	public $css_selector = '';
	public $scripts      = [ 'buBusinessHours' ];
    public $loop_index   = 0;
 
    public function get_label() {
		return esc_html__( 'Business Hours', 'wpv-bu' );
	}
    public function get_keywords() {
		return [ 'hours', 'business-hours', 'opening','closing','time', 'weekdays','working-hours'];
	}
    public function set_control_groups() {
        $this->control_groups['business_hours'] = [
			'title' => esc_html__( 'Business Hours', 'wpv-bu' ),
			'tab'   => 'content',
		];
        $this->control_groups['business_indicators'] = [
			'title' => esc_html__( 'Business Indicators', 'wpv-bu' ),
			'tab'   => 'content',
            'required'=>['indicator','=', true],
		];
        $this->control_groups['rowStyle'] = [
			'title' => esc_html__( 'Business Hours Style', 'wpv-bu' ),
			'tab'   => 'content',
		];
        $this->control_groups['biStyle'] = [
			'title' => esc_html__( 'Business Indicator Style', 'wpv-bu' ),
			'tab'   => 'content',
            'required'=>['indicator','=', true],
		];
        $this->control_groups['hlStyle'] = [
			'title' => esc_html__( 'Highlight Current Day', 'wpv-bu' ),
			'tab'   => 'content',
            'required'=>[['currentDay','=',true],['timeLayout','=','predefined']],
		];

    }

    
    public function set_controls(){
        
        $this->controls['timeLayout']=[
            'tab' => 'content',
            'group' => 'business_hours',
            'label'=> esc_html__('Business Timing', 'wpv-bu'),
            'type'=> 'select',
            'options'=>[
                'predefined' => esc_html__('Predefined', 'custom'),
                'custom' =>esc_html__('Custom', 'wpv-bu'),
            ],
            'default'=> 'predefined',
            'inline'=> true,
            'small'=> true,
        ];
        $this->controls['biInfo'] = [
			'type'     => 'info',
			'content'  => esc_html__( 'Live Business Indicator not working in custom', 'wpv-bu' ),
			'group'    => 'business_hours',
			'required' => [ 'timeLayout', '=', 'custom' ],
		];
        $this->controls['predefinedDays']=[
            'tab'       => 'content',
            'group'     => 'business_hours',
            'label'     => esc_html__('Days', 'wpv-bu'),
            'type'      =>'repeater',
            'clearable' => false,
            'titleProperty' => 'predays',
            'fields'    => [
                'preicon' => [
					'label'    => esc_html__( 'Icon', 'wpv-bu' ),
					'type'     => 'icon',
				],
                'predays'=>[
                    'label' => esc_html__('Days','wpv-bu'),
                    'type' => 'select',
                    'options'=>[
                        'monday'=>__('Monday','wpv-bu'),
                        'tuesday'=>esc_html__('Tuesday','wpv-bu'),
                        'wednesday'=>esc_html__('Wednesday','wpv-bu'),
                        'thursday'=>esc_html__('Thursday','wpv-bu'),
                        'friday'=>esc_html__('Friday','wpv-bu'),
                        'saturday'=>esc_html__('Saturday','wpv-bu'),
                        'sunday'=>esc_html__('Sunday','wpv-bu'),
                    ],
                    'clerable' => false,
                    'default'     => __('monday','wpv-bu'),
					'placeholder' => __( 'Enter your title', 'wpv-bu' ),
                ],
                'preclosed'=>[
                    'label'=> esc_html__('Closed','wpv-bu'),
                    'type'=>'checkbox',
                    'default'=>false,                    
                ],
                'preclosedText'=>[
                    'label'=> esc_html__('Closed Text','wpv-bu'),
                    'type'=>'text',
                    'default'=> esc_html('Closed', 'wpv-bu'),
                    'placeholder'=>esc_html('Enter Message','wpv-bu'),
                    'required'=> ['preclosed', '=', true],   
                ],
                'numSlots'=>[
                    'label'=> esc_html__('No. of Slots','wpv-bu'),
                    'type'=>'text',
                    'min'=> 1,
                    'max'=> 3,
                    'step'=>1,
                    'required'=> ['preclosed', '!=', true],   
                ],
                
                'slotHeading1'=>[
                    'label'=> esc_html__('Slot 1','wpv-bu'),
                    'type'=> 'seperator',
                    'required'=> [
                        ['numSlots','=',[1,2,3]],
                        ['preclosed', '!=', true],
                    ],   

                ],
                'slotOpen1'=>[
                    'label'=>esc_html__('Opening','wpv-bu'),
                    'type'=>'text',
                    'info' => esc_html__( 'Time format should be in 12-hours or 24 hours format (1:00 am/pm or 14:00)', 'wpv-bu' ),
                    'small'=> true,
                    'inline'=> true,
                    'placeholder' => __('8:00 am', 'wpv-bu'),
                    'required'=> [
                        ['preclosed', '!=', true],
                        ['numSlots','=',[1,2,3]],
                    ],
                ],
                'slotClose1'=>[
                    'label'=>esc_html__('Closing','wpv-bu'),
                    'type'=>'text',
                    'small'=> true,
                    'inline'=> true,
                    'info' => esc_html__( 'Time format should be in 12-hours or 24 hours format (1:00 am/pm or 14:00)', 'wpv-bu' ),

                    'placeholder' => __('10:00 pm', 'wpv-bu'),
                    'required'=> [
                        ['preclosed', '!=', true],
                        ['numSlots','=',[1,2,3]],
                    ],
                ],
                'slotLabel1'=>[
                    'label'=>esc_html__('Label','wpv-bu'),
                    'type'=>'text',
                    'placeholder'=> esc_html__('Enter Message','wpv-bu'),
                    'required'=> [
                        ['preclosed', '!=', true],
                        ['numSlots','=',[1,2,3]],
                    ],                
                ],
                'slotHeading2'=>[
                    'label'=> esc_html__('Slot 2','wpv-bu'),
                    'type'=> 'seperator',
                    'required'=> [
                        ['preclosed', '!=', true],
                        ['numSlots','=',[2,3]],
                    ],   

                ],
                'slotOpen2'=>[
                    'label'=>esc_html__('Opening','wpv-bu'),
                    'type'=>'text',
                    'small'=> true,
                    'inline'=> true,
                    'info' => esc_html__( 'Time format should be in 12-hours or 24 hours format (1:00 am/pm or 14:00)', 'wpv-bu' ),

                    'placeholder' => __('8:00 am', 'wpv-bu'),
                    'required'=> [
                        ['preclosed', '!=', true],
                        ['numSlots','=',[2,3]],
                    ],
                ],
                'slotClose2'=>[
                    'label'=>esc_html__('Closing','wpv-bu'),
                    'type'=>'text',
                    'small'=> true,
                    'inline'=> true,
                    'info' => esc_html__( 'Time format should be in 12-hours or 24 hours format (1:00 am/pm or 14:00)', 'wpv-bu' ),

                    'placeholder' => __('10:00 pm', 'wpv-bu'),
                    'required'=> [
                        ['preclosed', '!=', true],
                        ['numSlots','=',[2,3]],
                    ],
                ],
                'slotLabel2'=>[
                    'label'=>esc_html__('Label','wpv-bu'),
                    'type'=>'text',
                    'placeholder'=> esc_html__('Enter Message','wpv-bu'),
                    'required'=> [
                        ['preclosed', '!=', true],
                        ['numSlots','=',[2,3]],
                    ],                
                ],
                'slotHeading3'=>[
                    'label'=> esc_html__('Slot 3','wpv-bu'),
                    'type'=> 'seperator',
                    'required'=> [
                        ['preclosed', '!=', true],
                        ['numSlots','=',[3]],
                    ],   

                ],
                'slotOpen3'=>[
                    'label'=>esc_html__('Opening','wpv-bu'),
                    'type'=>'text',
                    'small'=> true,
                    'inline'=> true,
                    'info' => esc_html__( 'Time format should be in 12-hours or 24 hours format (1:00 am/pm or 14:00)', 'wpv-bu' ),

                    'placeholder' => __('8:00 am', 'wpv-bu'),
                    'required'=> [
                        ['preclosed', '!=', true],
                        ['numSlots','=',[3]],
                    ], 
                ],
                'slotClose3'=>[
                    'label'=>esc_html__('Closing','wpv-bu'),
                    'type'=>'text',
                    'small'=> true,
                    'inline'=> true,
                    'info' => esc_html__( 'Time format should be in 12-hours or 24 hours format (1:00 am/pm or 14:00)', 'wpv-bu' ),

                    'placeholder' => __('10:00 pm', 'wpv-bu'),
                    'required'=> [
                        ['preclosed', '!=', true],
                        ['numSlots','=',[3]],
                    ], 
                ],
                'slotLabel3'=>[
                    'label'=>esc_html__('Label','wpv-bu'),
                    'type'=>'text',
                    'placeholder'=> esc_html__('Enter Message','wpv-bu'),
                    'required'=> [
                        ['preclosed', '!=', true],
                        ['numSlots','=',[3]],
                    ],                 
                ],
                //style
                'preStyle'=>[
                    'label'=> esc_html__('Style','wpv-bu'),
                    'type'=> 'seperator', 

                ],
                'preBackground'=>[
                    'label'  => esc_html__( 'Background', 'wpv-bu' ),
					'type'   => 'color',
					'inline' => true,
					'small'  => true,
                    'css'=>[
                        [
                            'property'=>'background',
                        ],
                    ],
                ],
                'preDayColor'=>[
                    'label'  => esc_html__( 'Weekday Color', 'wpv-bu' ),
					'type'   => 'color',
					'inline' => true,
					'small'  => true,
					'css'    => [
						[
							'property' => 'color',
							'selector' => '.bultr-tl-pre.bultr-bh-day',
						],
					],
                ],
                'preTimeColor'=>[
                    'label'  => esc_html__( 'Time Color', 'wpv-bu' ),
					'type'   => 'color',
					'inline' => true,
					'small'  => true,
					'css'    => [
						[
							'property' => 'color',
							'selector' => '.bultr-tl-pre.bultr-bh-time',
						],
					],
                    'required'=>['preclosed', '!=', true],

                ],
                'preIconColor'=>[
                    'label'  => esc_html__( 'Icon Color', 'wpv-bu' ),
					'type'   => 'color',
					'inline' => true,
					'small'  => true,
					'css'    => [
						[
							'property' => 'color',
							'selector' => '.bultr-tl-pre.bultr-bh-day i',
						],
					],
                ],
                'preCloseTxtClr'=>[
                    'label'  => esc_html__( 'Closed Text Color', 'wpv-bu' ),
					'type'   => 'color',
					'inline' => true,
					'small'  => true,
					'css'    => [
						[
							'property' => 'color',
							'selector' => '.bultr-tl-pre.bultr-bh-time',
						],
					],
                    'required'=>['preclosed', '=', true],

                ],
                'preLabelColor'=>[
                    'label'  => esc_html__( 'Label Color', 'wpv-bu' ),
					'type'   => 'color',
					'inline' => true,
					'small'  => true,
					'css'    => [
						[
							'property' => 'color',
							'selector' => '.bultr-tl-pre.bultr-bh-time .bultr-bh-label',
						],
					],
                    'required'=>['preclosed', '!=', true],

                ],
                'prePadding'=>[
                    'label'  => esc_html__( 'Padding', 'wpv-bu' ),
					'type'   => 'dimensions',
					'css'    => [
						[
							'property' => 'padding',
						],
					],
                ],

            ],
            'default'=>[
                [
                    'predays'=> __('monday','wpv-bu'),
                    'preclosed'=> false,
                    'numSlots'=> 1,
                    'slotOpen1'=>__('8:00 AM','wpv-bu'),
                    'slotClose1'=>__('10:00 PM','wpv-bu'),
                    'slotLabel1'=>'',
                    'slotOpen2'=>'',
                    'slotClose2'=>'',
                    'slotLabel2'=>'',
                    'slotOpen3'=>'',
                    'slotClose3'=>'',
                    'slotLabel3'=>'',
                ],
                [
                    'predays'=>__('tuesday','wpv-bu'),
                    'preclosed'=> false,
                    'numSlots'=> 1,
                    'slotOpen1'=>__('8:00 AM','wpv-bu'),
                    'slotClose1'=>__('10:00 PM','wpv-bu'),
                    'slotLabel1'=>'',
                    'slotOpen2'=>'',
                    'slotClose2'=>'',
                    'slotLabel2'=>'',
                    'slotOpen3'=>'',
                    'slotClose3'=>'',
                    'slotLabel3'=>'',

                ],
                [
                    'predays'=>__('wednesday','wpv-bu'),
                    'preclosed'=> false,
                    'numSlots'=> 1,
                    'slotOpen1'=>__('8:00 AM','wpv-bu'),
                    'slotClose1'=>__('10:00 PM','wpv-bu'),
                    'slotLabel1'=>'',
                    'slotOpen2'=>'',
                    'slotClose2'=>'',
                    'slotLabel2'=>'',
                    'slotOpen3'=>'',
                    'slotClose3'=>'',
                    'slotLabel3'=>'',

                ],
                [
                    'predays'=>__('thursday','wpv-bu'),
                    'preclosed'=> false,
                    'numSlots'=> 1,
                    'slotOpen1'=>__('8:00 AM','wpv-bu'),
                    'slotClose1'=>__('10:00 PM','wpv-bu'),
                    'slotLabel1'=>'',
                    'slotOpen2'=>'',
                    'slotClose2'=>'',
                    'slotLabel2'=>'',
                    'slotOpen3'=>'',
                    'slotClose3'=>'',
                    'slotLabel3'=>'',

                ],
                [
                    'predays'=>__('friday','wpv-bu'),
                    'preclosed'=> false,
                    'numSlots'=> 1,
                    'slotOpen1'=>__('8:00 AM','wpv-bu'),
                    'slotClose1'=>__('10:00 PM','wpv-bu'),
                    'slotLabel1'=>'',
                    'slotOpen2'=>'',
                    'slotClose2'=>'',
                    'slotLabel2'=>'',
                    'slotOpen3'=>'',
                    'slotClose3'=>'',
                    'slotLabel3'=>'',
                ],
                [
                    'predays'=>__('saturday','wpv-bu'),
                    'preclosed'=> false,
                    'numSlots'=> 1,
                    'slotOpen1'=>__('8:00 AM','wpv-bu'),
                    'slotClose1'=>__('10:00 PM','wpv-bu'),
                    'slotLabel1'=>'',
                    'slotOpen2'=>'',
                    'slotClose2'=>'',
                    'slotLabel2'=>'',
                    'slotOpen3'=>'',
                    'slotClose3'=>'',
                    'slotLabel3'=>'',
                ],
                [
                    'predays'=>__('sunday','wpv-bu'),
                    'preclosed'=>true,
                    'numSlots'=> 1,
                    'slotOpen1'=>__('8:00 AM','wpv-bu'),
                    'slotClose1'=>__('10:00 PM','wpv-bu'),
                    'slotLabel1'=>'',
                    'slotOpen2'=>'',
                    'slotClose2'=>'',
                    'slotLabel2'=>'',
                    'slotOpen3'=>'',
                    'slotClose3'=>'',
                    'slotLabel3'=>'',

                ],
            ],
            'required'=>['timeLayout', '=', 'predefined'],
        ];
        $this->controls['customDays']=[
            'tab'       => 'content',
            'group'     => 'business_hours',
            'label'     => esc_html__('Days', 'wpv-bu'),
            'type'      =>'repeater',
            'clearable' => false,
            'titleProperty' => 'cstmDay', 
            'required'=>['timeLayout', '=', 'custom'],
            'fields'=>[
                'cstmIcon' => [
					'label'    => esc_html__( 'Icon', 'wpv-bu' ),
					'type'     => 'icon',
				],
                'cstmDay'=>[
                    'label'=> esc_html__('Days','wpv-bu'),
                    'type' => 'text',
                    'placeholder'=>__('Monday - Friday','wpv-bu'),
                ],
                'cstmClosed'=>[
                    'label'=>__('Closed','wpv-bu'),
                    'type'=>'checkbox',
                    'default'=> false,
                ],
                'cstmClosedText'=>[
                    'label'=>esc_html__('Closed Text','wpv-bu'),
                    'type'=>'text',
                    'placeholder'=>__('Closed','wpv-bu'),
                    'required'=>['cstmClosed','=',true],
                ],
                'cnumSlots'=>[
                    'label'=> esc_html__('No. of Slots','wpv-bu'),
                    'type'=>'text',
                    'min'=> 1,
                    'max'=> 3,
                    'step'=>1,
                    'required'=> ['cstmClosed', '!=', true],   
                ],
                'cslotHeading1'=>[
                    'label'=> esc_html__('Slot 1','wpv-bu'),
                    'type'=> 'seperator',
                    'required'=> [
                        ['cnumSlots','=',[1,2,3]],
                        ['cstmClosed', '!=', true],
                    ],   

                ],
                'cslotOpen1'=>[
                    'label'=>esc_html__('Opening','wpv-bu'),
                    'type'=>'text',
                    'info' => esc_html__( 'Time format should be in 12-hours or 24 hours format (1:00 am/pm or 14:00)', 'wpv-bu' ),
                    'small'=> true,
                    'inline'=> true,
                    'required'=> [
                        ['cstmClosed', '!=', true],
                        ['cnumSlots','=',[1,2,3]],
                    ],
                ],
                'cslotClose1'=>[
                    'label'=>esc_html__('Closing','wpv-bu'),
                    'type'=>'text',
                    'info' => esc_html__( 'Time format should be in 12-hours or 24 hours format (1:00 am/pm or 14:00)', 'wpv-bu' ),
                    'small'=> true,
                    'inline'=> true,
                    'required'=> [
                        ['cstmClosed', '!=', true],
                        ['cnumSlots','=',[1,2,3]],
                    ],
                ],
                'cslotLabel1'=>[
                    'label'=>esc_html__('Label','wpv-bu'),
                    'type'=>'text',
                    'placeholder'=> esc_html__('Enter Message','wpv-bu'),
                    'required'=> [
                        ['cstmClosed', '!=', true],
                        ['cnumSlots','=',[1,2,3]],
                    ],                
                ],
                'cslotHeading2'=>[
                    'label'=> esc_html__('Slot 2','wpv-bu'),
                    'type'=> 'seperator',
                    'required'=> [
                        ['cstmClosed', '!=', true],
                        ['cnumSlots','=',[2,3]],
                    ],   

                ],
                'cslotOpen2'=>[
                    'label'=>esc_html__('Opening','wpv-bu'),
                    'type'=>'text',
                    'info' => esc_html__( 'Time format should be in 12-hours or 24 hours format (1:00 am/pm or 14:00)', 'wpv-bu' ),
                    'small'=> true,
                    'inline'=> true,
                    'required'=> [
                        ['cstmClosed', '!=', true],
                        ['cnumSlots','=',[2,3]],
                    ],
                ],
                'cslotClose2'=>[
                    'label'=>esc_html__('Closing','wpv-bu'),
                    'type'=>'text',
                    'small'=> true,
                    'info' => esc_html__( 'Time format should be in 12-hours or 24 hours format (1:00 am/pm or 14:00)', 'wpv-bu' ),
                    'inline'=> true,
                    'required'=> [
                        ['cstmClosed', '!=', true],
                        ['cnumSlots','=',[2,3]],
                    ],
                ],
                'cslotLabel2'=>[
                    'label'=>esc_html__('Label','wpv-bu'),
                    'type'=>'text',
                    'placeholder'=> esc_html__('Enter Message','wpv-bu'),
                    'required'=> [
                        ['cstmClosed', '!=', true],
                        ['cnumSlots','=',[2,3]],
                    ],                
                ],
                'cslotHeading3'=>[
                    'label'=> esc_html__('Slot 3','wpv-bu'),
                    'type'=> 'seperator',
                    'required'=> [
                        ['cstmClosed', '!=', true],
                        ['cnumSlots','=',[3]],
                    ],   

                ],
                'cslotOpen3'=>[
                    'label'=>esc_html__('Opening','wpv-bu'),
                    'type'=>'text',
                    'info' => esc_html__( 'Time format should be in 12-hours or 24 hours format (1:00 am/pm or 14:00)', 'wpv-bu' ),
                    'small'=> true,
                    'inline'=> true,
                    'required'=> [
                        ['cstmClosed', '!=', true],
                        ['cnumSlots','=',[3]],
                    ], 
                ],
                'cslotClose3'=>[
                    'label'=>esc_html__('Closing','wpv-bu'),
                    'type'=>'text',
                    'small'=> true,
                    'info' => esc_html__( 'Time format should be in 12-hours or 24 hours format (1:00 am/pm or 14:00)', 'wpv-bu' ),
                    'inline'=> true,
                    'required'=> [
                        ['cstmClosed', '!=', true],
                        ['cnumSlots','=',[3]],
                    ], 
                ],
                'cslotLabel3'=>[
                    'label'=>esc_html__('Label','wpv-bu'),
                    'type'=>'text',
                    'placeholder'=> esc_html__('Enter Message','wpv-bu'),
                    'required'=> [
                        ['cstmClosed', '!=', true],
                        ['cnumSlots','=',[3]],
                    ],                 
                ],
                //style
                'preStyle'=>[
                    'label'=> esc_html__('Style','wpv-bu'),
                    'type'=> 'seperator', 

                ],
                'cstmBackground'=>[
                    'label'  => esc_html__( 'Background', 'wpv-bu' ),
					'type'   => 'color',
					'inline' => true,
					'small'  => true,
					
                    'css'=>[
                        [
                            'property'=>'background',
                        ],
                    ],
                ],
                'cstmDayColor'=>[
                    'label'  => esc_html__( 'Weekday Color', 'wpv-bu' ),
					'type'   => 'color',
					'inline' => true,
					'small'  => true,
					'css'    => [
						[
							'property' => 'color',
							'selector' => '.bultr-bh-day',
						],
					],
                ],
                'cstmTimeColor'=>[
                    'label'  => esc_html__( 'Time Color', 'wpv-bu' ),
					'type'   => 'color',
					'inline' => true,
					'small'  => true,
					'css'    => [
						[
							'property' => 'color',
							'selector' => '.bultr-tl-cstm.bultr-bh-time',
						],
					],
                    'required'=>['cstmClosed', '!=', true],

                ],
                'cstmCloseColor'=>[
                    'label'  => esc_html__( 'Close Text Color', 'wpv-bu' ),
					'type'   => 'color',
					'inline' => true,
					'small'  => true,
					'css'    => [
						[
							'property' => 'color',
							'selector' => '.bultr-tl-cstm.bultr-bh-time',
						],
					],
                    'required'=>['cstmClosed', '=', true],

                ],
                'cstmIconColor'=>[
                    'label'  => esc_html__( 'Icon Color', 'wpv-bu' ),
					'type'   => 'color',
					'inline' => true,
					'small'  => true,
					'css'    => [
						[
							'property' => 'color',
							'selector' => '.bultr-tl-cstm.bultr-bh-day i',
						],
					],
                ],
                'cstmLabelColor'=>[
                    'label'  => esc_html__( 'Label Color', 'wpv-bu' ),
					'type'   => 'color',
					'inline' => true,
					'small'  => true,
					'css'    => [
						[
							'property' => 'color',
							'selector' => '.bultr-tl-cstm.bultr-bh-time .bultr-bh-label',
						],
					],
                ],
                'cstmPadding'=>[
                    'label'  => esc_html__( 'Padding', 'wpv-bu' ),
					'type'   => 'dimensions',
					'css'    => [
						[
							'property' => 'padding',
						],
					],
                ],
            ],
            'default'=>[
                [
                    
                    'cstmDay'=>__('Monday - Friday','wpv-bu'),
                    'cnumSlots'=> 1,
                    'cslotOpen1'=>__('9:00 AM','wpv-bu'),
                    'cslotClose1'=>__('8:00 PM','wpv-bu'),
                    'cslotLabel1'=>'',
                    'cslotOpen2'=>'',
                    'cslotClose2'=>'',
                    'cslotLabel2'=>'',
                    'cslotOpen3'=>'',
                    'cslotClose3'=>'',
                    'cslotLabel3'=>'',

                ],
                [
                    'cstmDay'=>__('Saturday','wpv-bu'),
                    'cnumSlots'=> 1,
                    'cslotOpen1'=>__('9:00 AM','wpv-bu'),
                    'cslotClose1'=>__('8:00 PM','wpv-bu'),
                    'cslotLabel1'=>'',
                    'cslotOpen2'=>'',
                    'cslotClose2'=>'',
                    'cslotLabel2'=>'',
                    'cslotOpen3'=>'',
                    'cslotClose3'=>'',
                    'cslotLabel3'=>'',
                ],
                [
                    'cstmDay'=>__('Sunday','wpv-bu'),
                    'cstmClosed'=> true,
                    'closedText'=>__('CLOSED','wpv-bu'),
                ],
            ],

        ];
       
        //time layout settings
        $this->controls['globalIcon']=[
            'tab'       => 'content',
            'group'     => 'business_hours',
            'label'     => esc_html__('Global Icon', 'wpv-bu'),
            'type'      =>'icon',
            'rerender'  => true,
            'default'   => [
                'library' => 'themify',
                'icon'    => 'ti-alarm-clock',
            ],
        ];
        $this->controls['dayFormat']=[
            'tab'       => 'content',
            'group'     => 'business_hours',
            'label'     => esc_html__('Day Format', 'wpv-bu'),
            'type'      =>'select',
            'options'       =>[
                'long'=>__('Long','wpv-bu'),
                'short'=>__('Short','wpv-bu'),
            ],
            'inline'=> true,
            'default'=>__('Long','wpv-bu'),
            'required'=>['timeLayout', '!=', 'custom'],

        ];
        $this->controls['showcurrentDay']=[
            'tab'       => 'content',
            'group'     => 'business_hours',
            'label'     => esc_html__('Show Current Day Only', 'wpv-bu'),
            'type'      =>'checkbox',
            'required'  =>['timeLayout','=','predefined'],
        ];
        $this->controls['currentDay']=[
            'tab'       => 'content',
            'group'     => 'business_hours',
            'label'     => esc_html__('HightLight Current Day', 'wpv-bu'),
            'type'      =>'checkbox',
            'required'  => ['timeLayout','=','predefined'],
        ];
        $this->controls['timeView']=[
            'tab'       => 'content',
            'group'     => 'business_hours',
            'label'     => esc_html__('Time Layout', 'wpv-bu'),
            'type'      =>'select',
            'options'   =>[
                'horizontal'  => __('Horizontal','wpv-bu'),
                'vertical'  => __('Vertical','wpv-bu'),

            ],
            'inline'=> true,

        ];
        $this->controls['timeGap']=[
            'tab'       => 'content',
            'group'     => 'business_hours',
            'label'     => esc_html__('Gap', 'wpv-bu'),
            'type'      =>'number',
            'unit'      =>'px',
            'css'       =>[
                [
                    'property'=>'gap',
                    'selector'=>'.bultr-bh-time',
                ],
            ],
            'inline'=> true,

        ];
        $this->controls['seprator']=[
            'tab'       => 'content',
            'group'     => 'business_hours',
            'label'     => esc_html__('Time Separator', 'wpv-bu'),
            'type'      =>'text',
            'default'   =>__("-",'wpv-bu'),
            'inline'=> true,

        ];
        $this->controls['slotseprator']=[
            'tab'       => 'content',
            'group'     => 'business_hours',
            'label'     => esc_html__('Slots Separator', 'wpv-bu'),
            'type'      =>'text',
            'default'   =>__("/",'wpv-bu'),
            'inline'=> true,
            'required'=>['timeView','=','horizontal'],

        ];
        $this->controls['indicator']=[
            'tab'       => 'content',
            'group'     => 'business_hours',
            'label'     => esc_html__('Show Business Indicator', 'wpv-bu'),
            'type'      =>'checkbox',
            'default' => true,
            'inline'=> true,
        ];
        //business Indicator settings
        $this->bi_settings_controls();
        //style controls Business Hours
        $this->bh_style_controls();
        //highlight currentday
        $this->hl_current_controls();
        //Business Indicators Style
        $this->bi_style_controls();
    }
    //function style controls Business Hours
    public function bh_style_controls(){
       
        $this->controls['boxWidth']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Box Width', 'wpv-bu'),
            'type' => 'number',
            'step'=>'1',
            'units'=> true,
            'css'=>[
                [
                    'property'=>'width',
                    'selector'=>'&.bultr-bh-wrapper',
                ],
            ],

        ];
        $this->controls['boxBorder']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Border', 'wpv-bu'),
            'type' => 'border',
            'css'=>[
                [
                    'property'=>'border',
                    'selector'=>'&.bultr-bh-wrapper',
                ],
            ],
        ];
        $this->controls['boxShd']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Box Shadow', 'wpv-bu'),
            'type' => 'box-shadow',
            'css'=>[
                [
                    'property'=>'box-shadow',
                    'selector'=>'&.bultr-bh-wrapper',
                ],
            ],
        ];
        $this->controls['boxPadding']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Box Padding', 'wpv-bu'),
            'type' => 'dimensions',
            'css'=>[
                [
                    'property'=>'padding',
                    'selector'=>'.bultr-bh-dayHours',
                ],
            ],

        ];
        //row
        $this->controls['rowSept']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Row Style', 'wpv-bu'),
            'type' => 'separator',
            
        ];
        $this->controls['rowsColor']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Color', 'wpv-bu'),
            'type' => 'color',
            'css'=>[
                [
                    'property'=>'color',
                    'selector'=>'.bultr-bh-weekDays'
                ],
            ],

        ];
        $this->controls['altercolor']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Alternate Color', 'wpv-bu'),
            'type' => 'color',
            'css'=>[
                [
                    'property'=>'color',
                    'selector'=>'.bultr-bh-dayHours .bultr-bh-weekDays:nth-child(even)',
                ],
            ],
        ];
        $this->controls['rowsbgColor']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Background', 'wpv-bu'),
            'type' => 'background',
            'css'=>[
                [
                    'property'=>'background',
                    'selector'=>'.bultr-bh-weekDays'
                ],
            ],

        ];
        $this->controls['alterbgcolor']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Alternate Background Color', 'wpv-bu'),
            'type' => 'background',
            'css'=>[
                [
                    'property'=>'background',
                    'selector'=>'.bultr-bh-dayHours .bultr-bh-weekDays:nth-child(even)',
                ],
            ],
        ];
       
        $this->controls['rowsTypo']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Typography', 'wpv-bu'),
            'type' => 'typography',
            'css'=>[
                [
                    'property'=>'font',
                    'selector'=>'.bultr-bh-weekDays'
                ],
            ],
            'exclude'=>[
                'color',
                'font-size',
                'text-align',
            ],

        ];
        $this->controls['rowsBorder']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Border', 'wpv-bu'),
            'type' => 'border',
            'css'=>[
                [
                    'property'=>'border',
                    'selector'=>'.bultr-bh-weekDays'
                ],
            ],

        ];
        $this->controls['rowsShd']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Box Shadow', 'wpv-bu'),
            'type' => 'box-shadow',
            'css'=>[
                [
                    'property'=>'box-shadow',
                    'selector'=>'.bultr-bh-weekDays',
                ],
            ],

        ];
        $this->controls['rowsPadding']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Padding', 'wpv-bu'),
            'type' => 'dimensions',
            'css'=>[
                [
                    'property'=>'padding',
                    'selector'=>'.bultr-bh-weekDays'
                ],
            ],

        ];
        $this->controls['rowsGap']=[
            'tab'   => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Gap', 'wpv-bu'),
            'type'  => 'number',
            'unit'  =>'px',
            'css'=>[
                [
                    'property'=>'gap',
                    'selector'=>'.bultr-bh-dayHours',
                ],
            ],

        ];
        $this->controls['spaceTop']=[
            'tab'   => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Top Row Gap', 'wpv-bu'),
            'type'  => 'number',
            'unit'  =>'px',
            'css'=>[
                [
                    'property'=>'padding-top',
                    'selector'=>'.bultr-bh-dayHours',
                ],
            ],
        ];
        //day
        $this->controls['daySept']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Day Style', 'wpv-bu'),
            'type' => 'separator',
            
        ];
        $this->controls['dayColor']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Color', 'wpv-bu'),
            'type' => 'color',
            'css'=>[
                [
                    'property'=>'color',
                    'selector'=>'.bultr-bh-day'
                ],
            ],

        ];
        $this->controls['dayTypo']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Typography', 'wpv-bu'),
            'type' => 'typography',
            'css'=>[
                [
                    'property'=>'font',
                    'selector'=>'.bultr-bh-day'
                ],
            ],
            'exclude'=>['color','text-align',],


        ];
        //time
        $this->controls['timeSept']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Time Style', 'wpv-bu'),
            'type' => 'separator',
            
        ];
        $this->controls['timeColor']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Color', 'wpv-bu'),
            'type' => 'color',
            'css'=>[
                [
                    'property'=>'color',
                    'selector'=>'.bultr-bh-time'
                ],
            ],

        ];
        $this->controls['timeTypo']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Typography', 'wpv-bu'),
            'type' => 'typography',
            'css'=>[
                [
                    'property'=>'font',
                    'selector'=>'.bultr-bh-time'
                ],
            ],
            'exclude'=>['color','text-align',],

        ];
        //icon
        $this->controls['iconSept']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Icon Style', 'wpv-bu'),
            'type' => 'separator',
            
        ];
        $this->controls['iconColor']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Color', 'wpv-bu'),
            'type' => 'color',
            'css'=>[
                [
                    'property'=>'color',
                    'selector'=>'.bultr-bh-day i'
                ],
                [
                    'property'=>'fill',
                    'selector'=>'.bultr-bh-day svg'
                ],
            ],

        ];
        $this->controls['iconSize']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Icon Size', 'wpv-bu'),
            'type' => 'number',
            'units'=> true,
            'css'=>[
                [
                    'property'=>'font-size',
                    'selector'=>'.bultr-bh-day i',
                ],
                [
                    'property'=>'font-size',
                    'selector'=>'.bultr-bh-day svg',
                ],
            ],

        ];
        $this->controls['iconGap']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Gap', 'wpv-bu'),
            'type' => 'number',
            'units'=> true,
            'css'=>[
                [
                    'property'=>'gap',
                    'selector'=>'.bultr-bh-day'
                ],
            ],

        ];
        
        //label
        $this->controls['labelSept']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Label Style', 'wpv-bu'),
            'type' => 'separator',
        ];
        $this->controls['labelColor']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Color', 'wpv-bu'),
            'type' => 'color',
            'css'=>[
                [
                    'property'=>'color',
                    'selector'=>'.bultr-bh-label',
                ],
            ],


        ];
        $this->controls['labelBgColor']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Background', 'wpv-bu'),
            'type' => 'color',
            'css'=>[
                [
                    'property'=>'background',
                    'selector'=>'.bultr-bh-label',
                ],
            ],

        ];
        $this->controls['labelTypo']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Typography', 'wpv-bu'),
            'type' => 'typography',
            'css'=>[
                [
                    'property'=>'font',
                    'selector'=>'.bultr-bh-label',
                ],
            ],
            'exclude'=>['color','text-align',],
        ];
        $this->controls['labelBorder']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Border', 'wpv-bu'),
            'type' => 'border',
            'css'=>[
                [
                    'property'=>'border',
                    'selector'=>'.bultr-bh-label'
                ],
            ],
        ];
        $this->controls['labelPadding']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Padding', 'wpv-bu'),
            'type' => 'dimensions',
            'css'=>[
                [
                    'property'=>'padding',
                    'selector'=>'.bultr-bh-label'
                ],
            ],
        ];
        $this->controls['labelGap']=[
            'tab'       => 'content',
            'group'     => 'rowStyle',
            'label'     => esc_html__('Gap', 'wpv-bu'),
            'type'      => 'number',
            'unit'      =>'px',

            'css'=>[
                [
                    'property'=>'gap',
                    'selector'=>'.bultr-bh-label-wrap',
                ],
            ],
        ];
        // Closed row style
        $this->controls['closeRowSept']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Closed Row', 'wpv-bu'),
            'type' => 'separator',
            
        ];
        $this->controls['closeRowBg']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Background', 'wpv-bu'),
            'type' => 'color',
            'css'=>[
                [
                    'property'=>'background',
                    'selector'=>'.bultr-bh-weekDays.bultr-bh-closed',
                ],
            ],

        ];
        $this->controls['closeRowDColor']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Date', 'wpv-bu'),
            'type' => 'color',
            'css'=>[
                [
                    'property'=>'color',
                    'selector'=>'.bultr-bh-weekDays.bultr-bh-closed .bultr-bh-day',
                ],
            ],

        ];
        $this->controls['closeRowTColor']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Time', 'wpv-bu'),
            'type' => 'color',
            'css'=>[
                [
                    'property'=>'color',
                    'selector'=>'.bultr-bh-weekDays.bultr-bh-closed .bultr-bh-time',
                ],
            ],

        ];
        $this->controls['closeRowIColor']=[
            'tab' => 'content',
            'group' => 'rowStyle',
            'label' => esc_html__('Icon', 'wpv-bu'),
            'type' => 'color',
            'css'=>[
                [
                    'property'=>'color',
                    'selector'=>'.bultr-bh-weekDays.bultr-bh-closed .bultr-bh-day i',
                ],
            ],

        ];
    }
    //function business Indicator settings
    public function bi_settings_controls(){
        $this->controls['indctTitle']=[
            'tab'       => 'content',
            'group'     => 'business_indicators',
            'label'     => esc_html__('Title', 'wpv-bu'),
            'type'      =>'text',
            'default'   =>__("Business Hours",'wpv-bu'),
            'placeholder'   =>__("Business Hours",'wpv-bu'),
        ];
        //date
        $this->controls['indctDate']=[
            'tab'       => 'content',
            'group'     => 'business_indicators',
            'label'     => esc_html__('Date', 'wpv-bu'),
            'type'      =>'checkbox',
            'inline'=> true,

        ];
        $date_format = [
            'F j, Y'           => gmdate( 'F j, Y' ),
            'F, Y'             => gmdate( 'F, Y' ),
            'l, F jS, Y'       => gmdate( 'l, F jS, Y' ),
            'Y/m/d'            => gmdate( 'Y/m/d' ),
            'Y-m-d'            => gmdate( 'Y-m-d' ),
            'custom'           => __( 'Custom', 'ae-pro' ),
        ];
        $this->controls['indctDateFormat']=[
            'tab'       => 'content',
            'group'     => 'business_indicators',
            'label'     => esc_html__('Format', 'wpv-bu'),
            'type'      =>'select',
            'options'   => $date_format,
            'description' => __('<a href="https://wordpress.org/documentation/article/customize-date-and-time-format/" target="_blank"> Click here</a> for documentation on date and time formatting.', 'wpv-bu'),
            'default'     => 'F j, Y',
            'inline'=> true,
            'required'=>['indctDate', '=', true],

        ];
        $this->controls['indctCstmFormat']=[
            'tab'       => 'content',
            'group'     => 'business_indicators',
            'label'     => esc_html__('Format', 'wpv-bu'),
            'type'      =>'text',
            'placeholder' => __( 'Enter Date Format', 'ae-pro' ),
		    'default'     => 'y:m:d',
            'required'    => ['indctDateFormat','=','custom'],
        ];
        //time
        $this->controls['indctTime']=[
            'tab'       => 'content',
            'group'     => 'business_indicators',
            'label'     => esc_html__('Time', 'wpv-bu'),
            'type'      =>'checkbox',
            'default' => false,
            'inline'=> true,

        ];
        $this->controls['indctTimeFormat']=[
            'tab'       => 'content',
            'group'     => 'business_indicators',
            'label'     => esc_html__('Format', 'wpv-bu'),
            'type'      =>'select',
            'options'   =>[
                '12_hours'=>__('12 Hours','wpv-bu'),
                '24_hours'=>__('24 Hours','wpv-bu'),
            ],
            'inline'=> true,
            'required'=>['indctTime', '=', true],


        ];
        //opening warning text
        $this->controls['indctOpenSept']=[
            'tab'       => 'content',
            'group'     => 'business_indicators',
            'label'     => esc_html__('Opening Warning Message', 'wpv-bu'),
            'type'      =>'separator',
            'required'  =>['timeLayout','=','predefined'],
        ];
        $this->controls['indctOpenWrn']=[
            'tab'       => 'content',
            'group'     => 'business_indicators',
            'label'     => esc_html__('Opening Warning Text', 'wpv-bu'),
            'type'      =>'checkbox',
            'default' => false,
            'inline'=> true,
            'required'  =>['timeLayout','=','predefined'],
        ];
        $this->controls['indctOpenMin']=[
            'tab'       => 'content',
            'group'     => 'business_indicators',
            'label'     => esc_html__('Minutes', 'wpv-bu'),
            'type'      => 'number',
            'info'      => esc_html__('How many minutes before message will be displayed','wpv-bu'),
            'unit'      =>'min',
            'min'       => 1,
            'max'       => 59,
            'step'      =>'1',
            'inline'    => true,
            'required'=>[['indctOpenWrn', '=', true],['timeLayout','=','predefined']],

        ];
        $this->controls['indctOMinText']=[
            'tab'       => 'content',
            'group'     => 'business_indicators',
            'label'     => esc_html__('Opening Warning Text', 'wpv-bu'),
            'type'      => 'text',
            'placeholder'=>__('Enter Message','wpv-bu'),
            'required'=>[['indctOpenWrn', '=', true],['timeLayout','=','predefined']],

        ];
        //closing warning text
        $this->controls['indctCloseSept']=[
            'tab'       => 'content',
            'group'     => 'business_indicators',
            'label'     => esc_html__('CLosing Warning Message', 'wpv-bu'),
            'type'      =>'separator',
            'required'  =>['timeLayout','=','predefined'],
        ];
        $this->controls['indctCloseWrn']=[
            'tab'       => 'content',
            'group'     => 'business_indicators',
            'label'     => esc_html__('Closing Warning Text', 'wpv-bu'),
            'type'      =>'checkbox',
            'default' => false,
            'inline'=> true,
            'required'  =>['timeLayout','=','predefined'],

        ];
        $this->controls['indctCloseMin']=[
            'tab'       => 'content',
            'group'     => 'business_indicators',
            'label'     => esc_html__('Minutes', 'wpv-bu'),
            'type'      => 'number',
            'unit'      =>'min',
            'info'      => esc_html__('How many minutes before message will be displayed','wpv-bu'),
            'min'       => 1,
            'max'       => 59,
            'step'      =>'1',
            'inline'    => true,
            'required'=>[['indctCloseWrn', '=', true],['timeLayout','=','predefined']],

        ];
        $this->controls['indctCMinText']=[
            'tab'       => 'content',
            'group'     => 'business_indicators',
            'label'     => esc_html__('Closing Warning Text', 'wpv-bu'),
            'type'      => 'text',
            'placeholder'=>__('Enter Message','wpv-bu'),
            'required'=>[['indctCloseWrn', '=', true],['timeLayout','=','predefined']],

        ];
        //Label
        $this->controls['indctLabelSept']=[
            'tab'       => 'content',
            'group'     => 'business_indicators',
            'label'     => esc_html__('Open/Close Label', 'wpv-bu'),
            'type'      =>'separator',
            'required'  =>['timeLayout','=','predefined'],
        ];
        $this->controls['indctLabel']=[
            'tab'       => 'content',
            'group'     => 'business_indicators',
            'label'     => esc_html__('Label', 'wpv-bu'),
            'descriptiion'=> esc_html__('Open\close Labels','wpv-bu'),
            'type'      =>'checkbox',
            'default' => false,
            'inline'=> true,
            'required'  =>['timeLayout','=','predefined'],
        ];
        $this->controls['indctLblOpenText']=[
            'tab'       => 'content',
            'group'     => 'business_indicators',
            'label'     => esc_html__('Opening Text', 'wpv-bu'),
            'type'      => 'text',
            'default'   => __('Open','wpv-bu'),
            'placeholder'=>__('Enter Message','wpv-bu'),
            'required'=>[['indctLabel', '=', true],['timeLayout','=','predefined']],

        ];
        $this->controls['indctLblCloseText']=[
            'tab'       => 'content',
            'group'     => 'business_indicators',
            'label'     => esc_html__('Closing Text', 'wpv-bu'),
            'type'      => 'text',
            'default'   => __('Closed','wpv-bu'),
            'placeholder'=>__('Enter Message','wpv-bu'),
            'required'=>[['indctLabel', '=', true],['timeLayout','=','predefined']],

        ];
        
    }
    //function Business Indicators Style
    public function bi_style_controls(){
        $this->controls['biChoosebg']=[
            'tab' => 'content',
            'group'=> 'biStyle',
            'label'=> esc_html__('Background', 'wpv-bu'),
            'type'  =>'select',
            'options'=>[
                'normal'=>__('Image Background','wpv-bu'),
                'gradient'=>__('Gradient Background','wpv-bu'),
            ],
            'default'=>__('normal','wpv-bu'),
            'inline'=>true,
        ];
        $this->controls['biBackground']=[
            'tab' => 'content',
            'group'=> 'biStyle',
            'label'=> esc_html__('Background', 'wpv-bu'),
            'type'  =>'background',
            'css'=>[
                [
                    'property'=>'background',
                    'selector'=>'.bultr-bh-indicator.bultr-bg-normal',
                ],
            ],
            'required'=>['biChoosebg','=','normal'],
        ];
        $this->controls['biBgGradient']=[
            'tab' => 'content',
            'group'=> 'biStyle',
            'label'=> esc_html__('Background Gradient', 'wpv-bu'),
            'type'  =>'gradient',
            'css'=>[
                [
                    'property'=>'background-image',
                    'selector'=>'.bultr-bh-indicator.bultr-bg-gradient',
                ],
            ],
            'required'=>['biChoosebg','=','gradient'],

        ];
        $this->controls['biBorder']=[
            'tab' => 'content',
            'group'=> 'biStyle',
            'label'=> esc_html__('Border', 'wpv-bu'),
            'type'  =>'border',
            'css'=>[
                [
                    'property'=>'border',
                    'selector'=>'.bultr-bh-indicator',
                ],
            ],
        ];
        $this->controls['biBoxShd']=[
            'tab' => 'content',
            'group'=> 'biStyle',
            'label'=> esc_html__('Box Shadow', 'wpv-bu'),
            'type'  =>'box-shadow',
            'css'=>[
                [
                    'property'=>'box-shadow',
                    'selector'=>'.bultr-bh-indicator',
                ],
            ],
        ];
        $this->controls['biPadding']=[
            'tab' => 'content',
            'group'=> 'biStyle',
            'label'=> esc_html__('Padding', 'wpv-bu'),
            'type'  =>'dimensions',
            'css'=>[
                [
                    'property'=>'padding',
                    'selector'=>'.bultr-bh-indicator',
                ],
            ],
        ];
        $this->controls['biMargin']=[
            'tab' => 'content',
            'group'=> 'biStyle',
            'label'=> esc_html__('Margin', 'wpv-bu'),
            'type'  =>'dimensions',
            'css'=>[
                [
                    'property'=>'margin',
                    'selector'=>'.bultr-bh-indicator',
                ],
            ],
        ];
        $this->controls['biLayout']=[
            'tab' => 'content',
            'group'=> 'biStyle',
            'label'=> esc_html__('Layout', 'wpv-bu'),
            'inline'=>true,
            'type'  =>'select',
            'options'=>[
                'lblRight'=> __('Label on Right','wpv-bu'),
                'lblLeft'=> __('Label on Left','wpv-bu'),
            ],
            'required'=>['timeLayout','=','predefined'],
        ];
        $this->controls['biLabelPst']=[
            'tab' => 'content',
            'group'=> 'biStyle',
            'label'=> esc_html__('Label Position', 'wpv-bu'),
            'type'  =>'align-items',
            'css'=>[
                [
                    'property'=>'align-items',
                    'selector'=>'.bultr-bh-indicator',
                ],
            ],
            'exclude'=>[
                'stretch',
            ],
            'inline'=>true,
            'required'=>['timeLayout','=','predefined'],

        ];
        $this->controls['biAlign']=[
            'tab' => 'content',
            'group'=> 'biStyle',
            'label'=> esc_html__('Content Alignment', 'wpv-bu'),
            'type'  =>'align-items',
            'css'=>[
                [
                    'property'=>'align-items',
                    'selector'=>'.bultr-bh-indicator .bultr-bh-bi-left',
                ],
                [
                    'property'=>'align-items',
                    'selector'=>'.bultr-bh-indicator .bultr-bh-bi-cstm-left',
                ],
            ],
            'exclude'=>[
                'stretch',
            ],
            'inline'=>true,
        ];
        //BI Title Style
        $this->controls['biTitleSept']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Title', 'wpv-bu'),
            'type' => 'separator',

        ];
        $this->controls['biTitleColor']=[
            'tab' => 'content',
            'group'=> 'biStyle',
            'label'=> esc_html__('Color', 'wpv-bu'),
            'type'  =>'color',
            'css'=>[
                [
                    'property'=>'color',
                    'selector'=>'.bultr-bh-bi-title',
                ],
            ],

        ];
        
        $this->controls['biTitleFont']=[
            'tab' => 'content',
            'group'=> 'biStyle',
            'label'=> esc_html__('Typography', 'wpv-bu'),
            'type'  =>'typography',
            'css'=>[
                [
                    'property'=>'font',
                    'selector'=>'.bultr-bh-bi-title',
                ],
            ],
            'exclude'=>['color'],

        ];
        $this->controls['biTitleSpace']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Spacing', 'wpv-bu'),
            'type' => 'number',
            'units'=>true,
            'css'=>[
                
                [
                    'property'=> 'padding-bottom',
                    'selector'=>'.bultr-bh-bi-title',
                ],
            ],
        ];
        //BI date style
        $this->controls['biDateSept']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Date', 'wpv-bu'),
            'type' => 'separator',
            'required'=>['indctDate','=',true],
        ];
        $this->controls['biDateColor']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Color', 'wpv-bu'),
            'type' => 'color',
            'css'=>[
                [
                    'property'=> 'color',
                    'selector'=>'.bultr-bh-bi-date',
                ],
            ],
            'required'=>['indctDate','=',true],

        ];
        $this->controls['biDateTypo']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Typography', 'wpv-bu'),
            'type' => 'typography',
            'css'=>[
                [
                    'property'=> 'font',
                    'selector'=>'.bultr-bh-bi-date',
                ],
            ],
            'exclude'=>[
                'color',
            ],
            'required'=>['indctDate','=',true],

        ];
        $this->controls['biDateSpace']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Spacing', 'wpv-bu'),
            'type' => 'number',
            'units'=>true,
            'css'=>[
                [
                    'property'=> 'padding-top',
                    'selector'=>'.bultr-bh-bi-date',
                ],
                [
                    'property'=> 'padding-bottom',
                    'selector'=>'.bultr-bh-bi-date',
                ],
            ],
            'required'=>['indctDate','=',true],

        ];

        
        //BI Time style
        $this->controls['biTimeSept']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Time', 'wpv-bu'),
            'type' => 'separator',
            'required'=>['indctTime','=',true],

        ];
        $this->controls['biTimeColor']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Color', 'wpv-bu'),
            'type' => 'color',
            'css'=>[
                [
                    'property'=> 'color',
                    'selector'=>'.bultr-bh-bi-Time',
                ],
            ],
            'required'=>['indctTime','=',true],

        ];
        $this->controls['biTimeTypo']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Typography', 'wpv-bu'),
            'type' => 'typography',
            'css'=>[
                [
                    'property'=> 'font',
                    'selector'=>'.bultr-bh-bi-Time',
                ],
            ],
            'exclude'=>[
                'color',
            ],
            'required'=>['indctTime','=',true],

        ];
        $this->controls['biTimeSpace']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Spacing', 'wpv-bu'),
            'type' => 'number',
            'units'=>true,
            'css'=>[
                [
                    'property'=> 'padding-top',
                    'selector'=>'.bultr-bh-bi-time',
                ],
                [
                    'property'=> 'padding-bottom',
                    'selector'=>'.bultr-bh-bi-time',
                ],
            ],
            'required'=>['indctTime','=',true],

        ];
        // BI opening warning text
        $this->controls['biOWMSept']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Opening Warning Message', 'wpv-bu'),
            'type' => 'separator',
            'required'=>[['indctOpenWrn','=',true],['timeLayout','=','predefined']],

        ];
        $this->controls['biOWMColor']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Color', 'wpv-bu'),
            'type' => 'color',
            'css'=>[
                [
                    'property'=> 'color',
                    'selector'=>'.bultr-bh-bi-open-wmsg',
                ],
            ],
            'required'=>[['indctOpenWrn','=',true],['timeLayout','=','predefined']],

        ];
        $this->controls['biOWMTypo']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Typography', 'wpv-bu'),
            'type' => 'typography',
            'css'=>[
                [
                    'property'=> 'font',
                    'selector'=>'.bultr-bh-bi-open-wmsg',
                ],
            ],
            'exclude'=>[
                'color',
            ],
            'required'=>[['indctOpenWrn','=',true],['timeLayout','=','predefined']],

        ];
        $this->controls['biOWMSpace']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Spacing', 'wpv-bu'),
            'type' => 'number',
            'units'=>true,
            'css'=>[
                [
                    'property'=> 'padding-top',
                    'selector'=>'.bultr-bh-bi-open-wmsg',
                ],
                [
                    'property'=> 'padding-bottom',
                    'selector'=>'.bultr-bh-bi-open-wmsg',
                ],
            ],
            'required'=>[['indctOpenWrn','=',true],['timeLayout','=','predefined']],

        ];
        // BI closing warning text
        $this->controls['biCWMSept']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Closing Warning Message', 'wpv-bu'),
            'type' => 'separator',
            'required'=>[['indctCloseWrn','=',true],['timeLayout','=','predefined']],

        ];
        $this->controls['biCWMColor']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Color', 'wpv-bu'),
            'type' => 'color',
            'css'=>[
                [
                    'property'=> 'color',
                    'selector'=>'.bultr-bh-bi-close-wmsg',
                ],
            ],
            'required'=>[['indctCloseWrn','=',true],['timeLayout','=','predefined']],

        ];
        $this->controls['biCWMTypo']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Typography', 'wpv-bu'),
            'type' => 'typography',
            'css'=>[
                [
                    'property'=> 'font',
                    'selector'=>'.bultr-bh-bi-close-wmsg',
                ],
            ],
            'exclude'=>[
                'color',
            ],
            'required'=>[['indctCloseWrn','=',true],['timeLayout','=','predefined']],

        ];
        $this->controls['biCWMSpace']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Spacing', 'wpv-bu'),
            'type' => 'number',
            'units'=>true,
            'css'=>[
                [
                    'property'=> 'padding-top',
                    'selector'=>'.bultr-bh-bi-close-wmsg',
                ],
                [
                    'property'=> 'padding-bottom',
                    'selector'=>'.bultr-bh-bi-close-wmsg',
                ],
            ],
            'required'=>[['indctCloseWrn','=',true],['timeLayout','=','predefined']],

        ];
        //bi label 
        $this->controls['biLabel']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Label', 'wpv-bu'),
            'type' => 'separator',
            'required'=>[
                ['indctLabel','=',true],
                ['timeLayout','=','predefined']
            ],

        ];
        $this->controls['biLblTypo']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Typography', 'wpv-bu'),
            'type' => 'typography',
            'css'=>[
                [
                    'property'=> 'font',
                    'selector'=>'.bultr-bi-label .bultr-lbl-open',
                ],
                [
                    'property'=> 'font',
                    'selector'=>'.bultr-bi-label .bultr-lbl-close',
                ],
            ],
            'exclude'=>['color','text-align',],
            'required'=>[
                ['indctLabel','=',true],
                ['timeLayout','=','predefined']
            ],
        ];
        $this->controls['biLblpadding']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Padding', 'wpv-bu'),
            'type' => 'dimensions',
            'css'=>[
                [
                    'property'=>'padding',
                    'selector'=>'.bultr-bi-label .bultr-lbl-open',
                ],
                [
                    'property'=> 'padding',
                    'selector'=>'.bultr-bi-label .bultr-lbl-close',
                ],
            ],
            'required'=>[
                ['indctLabel','=',true],
                ['timeLayout','=','predefined']
            ],
        ];
       
        //BI open text
        $this->controls['biOpenTxtSept']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Open Text', 'wpv-bu'),
            'type' => 'separator',
            'required'=>[['indctLabel','=',true],['timeLayout','=','predefined']],

        ];
        $this->controls['biOpenTxtColor']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Color', 'wpv-bu'),
            'type' => 'color',
            'css'=>[
                [
                    'property'=> 'color',
                    'selector'=>'.bultr-bi-label .bultr-lbl-open',
                ],
            ],
            'required'=>[['indctLabel','=',true],['timeLayout','=','predefined']],

        ];
        $this->controls['biOpenTxtBg']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Background', 'wpv-bu'),
            'type' => 'background',
            'css'=>[
                [
                    'prpperty'=>'background',
                    'selector'=>'.bultr-bi-label .bultr-lbl-open',
                ],
            ],
            'required'=>[['indctLabel','=',true],['timeLayout','=','predefined']],

        ];       
        //BI close Text
        $this->controls['biCloseTxtSept']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Close Text ', 'wpv-bu'),
            'type' => 'separator',
            'required'=>[['indctLabel','=',true],['timeLayout','=','predefined']],

        ];
        $this->controls['biCloseTxtColor']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Color', 'wpv-bu'),
            'type' => 'color',
            'css'=>[
                [
                    'property'=> 'color',
                    'selector'=>'.bultr-bi-label .bultr-lbl-close',
                ],
            ],
            'required'=>[['indctLabel','=',true],['timeLayout','=','predefined']],

        ];
        $this->controls['biCloseTxtBg']=[
            'tab' => 'content',
            'group' => 'biStyle',
            'label' => esc_html__('Background', 'wpv-bu'),
            'type' => 'background',
            'css'=>[
                [
                    'prpperty'=>'background',
                    'selector'=>'.bultr-bi-label .bultr-lbl-close',
                ],
            ],
            'required'=>[['indctLabel','=',true],['timeLayout','=','predefined']],
        ];
       
    }
    //hightlight current day  control
    public function hl_current_controls(){
       
        $this->controls['hlcdayColor']=[
            'tab' => 'content',
            'group' => 'hlStyle',
            'label' => esc_html__('Color', 'wpv-bu'),
            'type' => 'color',
            'css'=>[
                [
                    'property'=>'color',
                    'selector'=>'.bultr-bh-currentday',
                    'important' => true,
                ],
            ],
            'required'=>['currentDay', '=', true],
        ];
        $this->controls['hlcdaybg']=[
            'tab' => 'content',
            'group' => 'hlStyle',
            'label' => esc_html__('Background', 'wpv-bu'),
            'type' => 'background',
            'css'=>[
                [
                    'property'=>'background',
                    'selector'=>'.bultr-bh-currentday',
                    'important' => true,

                ],
            ],
            'required'=>['currentDay', '=', true],
        ];
        $this->controls['hlcdayFont']=[
            'tab' => 'content',
            'group' => 'hlStyle',
            'label' => esc_html__('Typography', 'wpv-bu'),
            'type' => 'typography',
            'css'=>[
                [
                    'property'=>'font',
                    'selector'=>'.bultr-bh-currentday',
                    'important' => true,

                ],
            ],
            'exclude'=>[
                'color',
            ],
            'required'=>['currentDay', '=', true],
        ];
        


    }
    //converting timezone to timezone offset
    public function bu_get_timeZone(){
        $offset  = (float) get_option( 'gmt_offset' );
        $hours   = (int) $offset;
        $minutes = ( $offset - $hours );
        $sign      = ( $offset < 0 ) ? '-' : '+';
        $abs_hour  = abs( $hours );
        $abs_mins  = abs( $minutes * 60 );
        $tz_offset = sprintf( '%s%02d:%02d', $sign, $abs_hour, $abs_mins );
        return $tz_offset;
    }
    public function render(){
        $settings = $this->settings;
        
        $index = $this->loop_index;
        $output = '';
        $globalSettings =[];
        $timezone = $this->bu_get_timeZone();
        $timeCurrent = date_i18n('h:i A');
        $options =[];
        
        //checking empty validation
        if(!isset($settings['timeLayout'])){
            return $this->render_element_placeholder(
				[
					'title' => esc_html__( 'No Business Timing selected.', 'wpv-bu' ),
				]
			);
        }

        if($settings['timeLayout'] == 'predefined' && !isset($settings['predefinedDays'])){
            return $this->render_element_placeholder(
				[
					'title' => esc_html__( 'Invalid Predefined Days.', 'wpv-bu' ),
				]
			);
            
        }
        if($settings['timeLayout'] == 'custom' && !isset($settings['customDays'])){
            return $this->render_element_placeholder(
				[
					'title' => esc_html__( 'Invalid Custom Days.', 'wpv-bu' ),
				]
			);
        }


        $root_classes = [
            'bultr-bh-wrapper'
        ];
        if(isset($settings['timeLayout']) && $settings['timeLayout'] === 'custom'){
            $root_classes[]= 'bultr-bh-ly-'.$this->settings['timeLayout'];
            $repeaterCstm = $settings['customDays'];
    
        }
        else{
            $root_classes[]= 'bultr-bh-ly-'.$this->settings['timeLayout'];
            $repeaterPre = $settings['predefinedDays'];
        }
        //slots layout/ time view
        
        if(isset($settings['indctTimeFormat']) == true && $settings['indctTimeFormat'] == '24_hours'){
            $timeFormat = "false";

        }
        else{
            $timeFormat = "true";
        }
        // storing business indicators in options
        $options=[
            'businessIndicator' => isset($settings['indicator']) && $settings['indicator'] ? $settings['indicator']: false ,
            'openWrnMsg'        => isset($settings['indctOpenWrn']) && $settings['indctOpenWrn'] ? $settings['indctOpenWrn'] : false,
            'openMints'         => !empty($settings['indctOpenMin']) ? $settings['indctOpenMin'] : 5,
            'openWrnMsgTxt'     => !empty($settings['indctOMinText'])? $settings['indctOMinText']: __("we are opening",'wpv-bu'),
            'closeWrnMsg'       => isset($settings['indctCloseWrn']) && $settings['indctCloseWrn']? $settings['indctCloseWrn'] : false,
            'closeMints'        => !empty($settings['indctCloseMin']) ? $settings['indctCloseMin'] : 5,
            'closeWrnMsgText'   => !empty($settings['indctCMinText'])? $settings['indctCMinText']: __("we are closing",'wpv-bu'),
            'indctLabel'         => isset($settings['indctLabel']) && $settings['indctLabel']? $settings['indctLabel'] : false,
            'openLableTxt'      => !empty($settings['indctLblOpenText'])? $settings['indctLblOpenText']: __("Open",'wpv-bu'),
            'closeLabelTxt'     => !empty($settings['indctLblCloseText'])? $settings['indctLblCloseText']: __("Closed",'wpv-bu'),
        ];

        $this->set_attribute('_root','class',$root_classes);
        $this->set_attribute('_root','data-timezone',$timezone);
        $this->set_attribute('_root','data-time',$timeCurrent);
        $this->set_attribute('_root','data-format',$timeFormat);
        $this->set_attribute('_root', 'data-settings', wp_json_encode($options) )

        
        ?>
        <div <?php echo $this->render_attributes( '_root' ); ?>>
            <?php 
            if(isset($settings['indicator']) && $settings['indicator'])
            {
                $indicator = ['bultr-bh-indicator'];
                if(!empty($settings['biLayout'])){
                    $indicator[]= 'bultr-bh-'.$settings['biLayout'];
                }
                $biBackground = isset($settings['biChoosebg']) ? $settings['biChoosebg'] : 'normal';
                if($biBackground === 'normal'){
                    $indicator[] = 'bultr-bg-normal';
                }
                else{
                    $indicator[] = 'bultr-bg-gradient';
                }
                $this->set_attribute('indicator_class','class', $indicator);

            ?>
                <div <?php echo $this->render_attributes( 'indicator_class' ); ?>>
                    <?php echo self::render_indicator()?>
                </div>
            <?php
             }//indictor closing
             ?>
            <div class ="bultr-bh-dayHours">
                <?php 
                    if($settings['timeLayout'] == 'predefined'){
                        if(isset($settings['predefinedDays']) && (count($settings['predefinedDays']) < 7 || count($settings['predefinedDays']) > 7)){
                            return $this->render_element_placeholder(
                                [
                                    'title' => esc_html__( 'Invalid Predefined Days.', 'wpv-bu' ),
                                ]
                            );
                        }
                        foreach($repeaterPre as $index => $preItem){
                            self::render_predefined_weekdays($preItem, $globalSettings);
                        }
                    }
                    else{
                        if(isset($settings['customDays']) && count($settings['customDays']) < 1){
                            return $this->render_element_placeholder(
                                [
                                    'title' => esc_html__( 'Invalid Custom Days.', 'wpv-bu' ),
                                ]
                            );
                        }
                        foreach($repeaterCstm as $index => $cstmItem){
                            self::render_custom_weekdays($cstmItem, $globalSettings);
                        }
                    }
                ?>
            </div>
        </div>

        <?php
    }
   
   public function render_indicator(){
        $settings = $this->settings;
        $indicatorTitle = !empty($settings['indctTitle']) ? $settings['indctTitle'] :'';
        $output ='';
        if($settings['timeLayout'] ==='predefined'){
            $this->set_attribute('bi_left_class', 'class','bultr-bh-bi-left');

        }
        else{
            $this->set_attribute('bi_left_class', 'class','bultr-bh-bi-cstm-left');

        }

        $output.="<div {$this->render_attributes('bi_left_class')}>";
        //title display
        if(!empty($settings['indctTitle'])){
            $output.="<span class='bultr-bh-bi-title'>".$indicatorTitle."</span>";
        }
        //date display
        if(isset($settings['indctDate']) && $settings['indctDate']){
            $output.="<span class ='bultr-bh-bi-date'>";
            if(isset($settings['indctDateFormat']) && $settings['indctDateFormat']==='custom'){
                $output .= date_i18n($settings['indctCstmFormat']);
            }
            else{
                $output .= date_i18n($settings['indctDateFormat']);
            }
            $output.="</span>";
        }
        //time display
        if(isset($settings['indctTime']) && $settings['indctTime']){
            $output.="<span class ='bultr-bh-bi-Time' id= 'bultr-time'>";
            if(isset($settings['indctTimeFormat']) && $settings['indctTimeFormat'] === '24_hours'){
                $output.= date_i18n('G:i:s');
            }
            else{
                $output.= date_i18n('h:i:s A'); 
            }
            $output.="</span>";

        }
        //for displaying time left ot open and close
        $checkOpen  = 0;
        if($settings['timeLayout'] ==='predefined'){
            foreach($settings['predefinedDays'] as $index => $item)
            {

                $day = date('D');
                $cday = ucfirst(substr($item['predays'],0,3));
                if($cday == $day){

                    $slots = $item['numSlots'];
                    
                    $count = 1;
                    for($i = 1; $i<=$slots; $i++){

                        // start == openingTime
                        $openingTime= strtotime($item['slotOpen'.$i]);
                        $currentTime = strtotime(date_i18n("H:i:s"));
                        $closingtime = strtotime($item['slotClose'.$i]);
                        if($openingTime > $currentTime){
                            
                            $min = ceil(($openingTime - $currentTime) / 60);
                           
                            $openMints = !empty($settings['indctOpenMin']) ? $settings['indctOpenMin'] : 5;
                            if( $min <= $openMints){
                                if(isset($settings['indctOpenWrn']) && $settings['indctOpenWrn']== true){
                                    $openingTxt = !empty($settings['indctOMinText']) ? $settings['indctOMinText'] : __("We are opening in ",'wpv-bu');
                                    $output.="<span class='bultr-bh-bi-open-wmsg'>".$openingTxt." ". abs($min)." Minutes</span>"; 
                                }
                            }
                        }
                        
                        if($currentTime > $openingTime || $currentTime < $closingtime){
                            if(isset($settings['indctCloseWrn']) && $settings['indctCloseWrn']){
                                $nstart = strtotime($item['slotClose'.$i]);
                                $nEnd = strtotime(date_i18n("H:i"));
                                $mins = ceil(($nstart - $nEnd)/60);
                                $closeMint = !empty($settings['indctCloseMin']) ? $settings['indctCloseMin'] : 5;

                                if($mins <= $closeMint && $mins>0){
                                    $closingTxt = !empty($settings['indctCMinText']) ? $settings['indctCMinText'] : __("We are closing in ",'wpv-bu');
                                    $output.="<span class='bultr-bh-bi-close-wmsg'>".$closingTxt." ". $mins." Minutes</span>"; 
                                }
                            }
                        }
                    }
        $output.="</div>";//left side indicator closeing with wrn msg for predefined


                    // LABELS
                    //right side indicator starting with LABELS
                    
                    if(isset($settings['indctLabel']) && $settings['indctLabel']){
                        $this->set_attribute('bi_label', 'class', ['bultr-bh-bi-right', 'bultr-bi-label']);
                        
                        $output.="<div {$this->render_attributes('bi_label')} >";
                        for($k=1; $k<=$slots; $k++){
                        
                            $checkOpen = 0;
                            $checkClose = isset($item['preclosed']) && $item['preclosed'] ? $item['preclosed'] : false;
                            $currentTime = strtotime(date_i18n("H:i:s"));
                            $closingTime = strtotime($item['slotClose'.$k]);
                            $openingTime = strtotime($item['slotOpen'.$k]);
                            $labeltext = "";
                            $out = "";
                            
                            if($checkClose){
                                $this->set_attribute("labels-{$count}", 'class',['bultr-labelss','bultr-lbl-close']);
                                $labeltext = !empty($settings['preclosedText']) ? $settings['preclosedText']  : "cClosed";
                                $checkOpen = 0;
                                break;
                            }
                            else{
                                if((int)$currentTime <= (int)$closingTime && (int)$currentTime >= (int)$openingTime){
                                    $this->set_attribute("labels-{$count}", 'class',['bultr-labelss','bultr-lbl-open']);
                                    $labeltext = !empty($settings['indctLblOpenText']) ? $settings['indctLblOpenText']  : "Open";
                                    $checkOpen =1;
                                    break;
                                }
                                else{

                                    $this->set_attribute("labels-{$count}", 'class',['bultr-labelss','bultr-lbl-close']);
                                    $labeltext = !empty($settings['indctLblCloseText']) ? $settings['indctLblCloseText']  : "ccClosed";
                                    $checkOpen = 0;

                                }
                            }

                            if($count != $slots){
                                $count++;
                            }else{
                                break;
                            }
                        
                            
                        } 

                        $out = "<div {$this->render_attributes("labels-{$count}")}>";
                        $out.= $labeltext;
                        $out.= "</div>";
                        $output.= $out;
                        $output.="</div>";
                    }
                }
            }
        }       
        // closing custom left class div because left div is closed in predefined condition
        if($settings['timeLayout'] ==='custom'){
            $output.="</div>";

        }
        return $output;
   }
   public function render_predefined_weekdays($item, $globalsettings){
        $settings = $this->settings;
		$index    = $this->loop_index;
        $seprator = !empty($settings['seprator']) ? $settings['seprator'] : '-';
        $day = date('D');
        $date = date('F d,Y');

        if ( ! isset( $item['id'] ) ) {
			$item['id'] = wp_rand( '9999', '100000' );
		}
        if(isset($item['id'])){
            $this->set_attribute("weekdays-{$index}",'data-bhid',$item['id']);
            $this->set_attribute("weekdays-{$index}",'data-date',$date);
            $this->set_attribute("weekdays-{$index}",'id','bultr-weekdays-'.$item['id']);
            $weekDayClass =['bultr-bh-weekDays', 'repeater-item','bultr-tl-pre'];
           
            $checkClose = isset($item['preclosed']) ? $item['preclosed'] : '';

            if($checkClose == true)
            {
                $weekDayClass[]='bultr-bh-closed';
            }
            else{
                $weekDayClass[]='bultr-bh-open';
                
            }
            // adding class for js to get current dat repeater
            if(ucfirst(substr($item['predays'],0,3)) === $day){
                $weekDayClass[] = 'bultr-currentday';
            } 
            $showday = isset($settings['showcurrentDay']) ? $settings['showcurrentDay'] : false;
            // highlight current day only
            if(isset($settings['currentDay'])){
                if(ucfirst(substr($item['predays'],0,3)) === $day){
                    $weekDayClass[] = 'bultr-bh-currentday';
                } 
            }
            //showing current day only
            if($showday == true){
                if(ucfirst(substr($item['predays'],0,3)) === $day){
                    $weekDayClass[]= 'bultr-bh-currentday-show';
                }
                else{
                    $weekDayClass[]='bultr-bh-currentday-hide';

                } 
            }
            $this->set_attribute("weekdays-{$index}",'class',$weekDayClass);

           
            ?>
            
            <div <?php echo $this->render_attributes( "weekdays-{$index}" )?>>
            <?php  $this->set_attribute("day-class-{$index}",'class', 'bultr-bh-day');
                    if($settings['timeLayout']=== 'predefined'){
                        $this->set_attribute("day-class-{$index}",'class', 'bultr-tl-pre');
                    }
            ?>
                    <div <?php echo $this->render_attributes( "day-class-{$index}" )?>>
                        <?php
                            if(!empty($item['preicon'])){
                                $icon = !empty($item['preicon']) ? $item['preicon'] : false;
                                $icon = self::render_icon($icon, []);
                                echo $icon;
                            }
                            else{
                                if(!empty($settings['globalIcon'])){
                                    $icon = !empty($settings['globalIcon']) ? $settings['globalIcon'] : false;
                                    $icon = self::render_icon($icon, []);
                                    echo $icon;
                                }
                            }
                           
                            if(isset($item['predays'])){
                                if(isset($settings['dayFormat']) && $settings['dayFormat']==='short'){
                                    echo substr($item['predays'],0,3);
                                }
                                else{
                                    echo $item['predays'];
                                }
                            }
                            else{
                                echo __("Monday",'wpv-bu');
                            }
                        ?>
                    </div>
                    <?php 
                        // to get slot open close and label data for each reapeater
                        $timeClass = ['bultr-bh-time'];
                        if($settings['timeLayout']=== 'predefined'){
                            $timeClass[] = 'bultr-tl-pre';

                        }

                        $timeContent = [''];
                        if(isset($settings['timeView']) == true && $settings['timeView'] ==='horizontal' ){
                            $timeClass[]='bultr-bh-time-hrz';
                            $slotseparator = !empty($settings['slotseprator']) ? $settings['slotseprator'] : "/";
                        }
                        else{
                            $timeClass[]='bultr-bh-time-vrt';

                            $slotseparator ="";
                        }
                        $this->set_attribute("time_class-{$index}",'class',$timeClass);

                        //slot 1
                        $i = 1;
                        if($checkClose == false)
                        {
                            if(!empty($item['numSlots']) && $item['numSlots']== 1 || $item['numSlots']==2 || $item['numSlots']== 3  ){
                                $slotOpen = !empty($item['slotOpen1']) ? $item['slotOpen1'] : __('8:00 AM','wpv-bu');
                                $slotClose = !empty($item['slotClose1']) ? $item['slotClose1'] : __('10:00 PM','wpv-bu');
                                $slotLabel = !empty($item['slotLabel1']) ? "<span class='bultr-bh-label'>{$item['slotLabel1']}</span>" : '';
                                $this->set_attribute("slot1-class-{$index}", 'data-open', strtotime($slotOpen));
                                $this->set_attribute("slot1-class-{$index}", 'data-close', strtotime($slotClose));

                                $slotFirst = "{$slotLabel} {$slotOpen} {$seprator} {$slotClose}";
                                $timeContent[] = "<span class = 'bultr-bh-label-wrap' {$this->render_attributes("slot1-class-{$index}")}>{$slotFirst}</span>";
                            } 
                            //slot 2
                            $i =2;
                            if(!empty($item['numSlots']) && $item['numSlots']==2 || $item['numSlots']== 3  ){
                                $slotSecond ="";
                                $slotOpen2 = !empty($item['slotOpen2']) ? $item['slotOpen2'] : __('8:00 AM','wpv-bu');
                                $slotClose2 = !empty($item['slotClose2']) ? $item['slotClose2'] : __('10:00 PM','wpv-bu');
                                $slotLabel2 = !empty($item['slotLabel2']) ? "<span class='bultr-bh-label'>{$item['slotLabel2']}</span>" : '';
                                $this->set_attribute("slot2-class-{$index}", 'data-open', strtotime($slotOpen2));
                                $this->set_attribute("slot2-class-{$index}", 'data-close', strtotime($slotClose2));
                                $slotSecond .= "{$slotLabel2} {$slotOpen2} {$seprator} {$slotClose2}";
                                $timeContent[] = "{$slotseparator}<span class = 'bultr-bh-label-wrap' {$this->render_attributes("slot2-class-{$index}")}>{$slotSecond}</span>";
        
                            } 
                            //slot3
                            $i =3;
                            if(!empty($item['numSlots']) && $item['numSlots']== 3  ){
                                $slotThird="";
                                $slotOpen3 = !empty($item['slotOpen3']) ? $item['slotOpen3'] : __('8:00 AM','wpv-bu');
                                $slotClose3 = !empty($item['slotClose3']) ? $item['slotClose3'] : __('10:00 PM','wpv-bu');
                                $slotLabel3 = !empty($item['slotLabel3']) ? "<span class='bultr-bh-label'>{$item['slotLabel3']}</span>" : '';
                                $this->set_attribute("slot3-class-{$index}", 'data-open', strtotime($slotOpen3));
                                $this->set_attribute("slot3-class-{$index}", 'data-close', strtotime($slotClose3));
                                $slotThird .= "{$slotLabel3} {$slotOpen3} {$seprator} {$slotClose3}";
                                $timeContent[] = "{$slotseparator}<span class = 'bultr-bh-label-wrap' {$this->render_attributes("slot3-class-{$index}")}>{$slotThird}</span>";
        
                            }  
                        }
                        else{
                            $timeContent[] = isset($item['preclosedText']) ? $item['preclosedText'] : __('Closed','wpv-bu');
                        }

                    ?>
                    
                    <div <?php echo $this->render_attributes("time_class-{$index}" )?>><?php echo implode("",$timeContent)?></div>

            </div>
            <?php
            $this->loop_index++;
        }

   }

   public function render_custom_weekdays($item, $globalsettings){
        $settings = $this->settings;
        $index    = $this->loop_index;
        $seprator = !empty($settings['seprator']) ? $settings['seprator'] : __('-','wpv-bu');
        $day = date('D');

        
        if ( ! isset( $item['id'] ) ) {
            $item['id'] = wp_rand( '9999', '100000' );
        }
        if(isset($item['id'])){
            $this->set_attribute("weekdays-{$index}",'data-id',$item['id']);
            $this->set_attribute("weekdays-{$index}",'id','bultr-weekdays-'.$item['id']);
            
            $weekDayClass = ['bultr-bh-weekDays','repeater-item','bultr-tl-cstm'];
            if(isset($item['cstmClosed'])== true)
            {
                $weekDayClass[]='bultr-bh-closed';
            }
            else{
                $weekDayClass[]='bultr-bh-open';
                
            }
            $this->set_attribute("weekdays-{$index}",'class',$weekDayClass);

            ?>
            <div <?php echo $this->render_attributes( "weekdays-{$index}" )?>>
            <?php  $this->set_attribute("day-class-{$index}",'class', 'bultr-bh-day');
                        if($settings['timeLayout']=== 'custom'){
                            $this->set_attribute("day-class-{$index}",'class', 'bultr-tl-cstm');
                        }
                ?>
                    <div <?php echo $this->render_attributes( "day-class-{$index}" )?>>
                    <?php
                        if(!empty($item['cstmIcon'])){
                            $icon = !empty($item['cstmIcon']) ? $item['cstmIcon'] : false;
                            $icon = self::render_icon($icon, []);
                            echo $icon;
                        }
                        else{
                            if(!empty($settings['globalIcon'])){
                                $icon = !empty($settings['globalIcon']) ? $settings['globalIcon'] : false;
                                $icon = self::render_icon($icon, []);
                                echo $icon;
                            }
                        }
                        
                        if(isset($item['cstmDay'])){
                            echo $item['cstmDay'];
                        }
                        else{
                            echo __("Monday - Friday",'wpv-bu');
                        }
                    ?>
                    </div>
                    <?php 
                        $this->set_attribute("time-class-{$index}",'class','bultr-bh-time');
                        if($settings['timeLayout']=== 'custom'){
                            $this->set_attribute("time-class-{$index}",'class','bultr-tl-cstm');
                        }
                        $timeContent = [''];
                        if(isset($settings['timeView']) == true && $settings['timeView'] ==='horizontal' ){
                            $this->set_attribute("time-class-{$index}",'class','bultr-bh-time-hrz');
                            $slotseparator = !empty($settings['slotseprator']) ? $settings['slotseprator'] : __("/",'wpv-bu');
                        }
                        else{
                            $this->set_attribute("time-class-{$index}",'class','bultr-bh-time-vrt');
                            $slotseparator ="";
                        }
                        $cstmClosed = isset($item['cstmClosed']);
                        
                        if($cstmClosed == false){
                            if(!empty($item['cnumSlots']) && $item['cnumSlots']== 1 || $item['cnumSlots']==2 || $item['cnumSlots']== 3  ){

                                $slotOpen = !empty($item['cslotOpen1']) ? $item['cslotOpen1'] : __('9:00 AM','wpv-bu');
                                $slotClose = !empty($item['cslotClose1']) ? $item['cslotClose1'] : __('11:00 AM','wpv-bu');
                                $slotLabel = !empty($item['cslotLabel1']) ? "<span class='bultr-bh-label'>{$item['cslotLabel1']}</span>" : '';
                                
                                $slotFirst = "{$slotLabel} {$slotOpen} {$seprator} {$slotClose}";
                                $timeContent[] = "<span class ='bultr-bh-label-wrap'>{$slotFirst}</span>";
                            } 
                            //slot 2
                            if(!empty($item['cnumSlots']) && $item['cnumSlots']==2 || $item['cnumSlots']== 3  ){
                                $slotSecond ="";
                                $slotOpen2 = !empty($item['cslotOpen2']) ? $item['cslotOpen2'] : __('9:00 AM','wpv-bu');
                                $slotClose2 = !empty($item['cslotClose2']) ? $item['cslotClose2'] : __('11:00 AM','wpv-bu');
                                $slotLabel2 = !empty($item['cslotLabel2']) ? "<span class='bultr-bh-label'>{$item['cslotLabel2']}</span>" : '';

                                $slotSecond .= "{$slotLabel2} {$slotOpen2} {$seprator} {$slotClose2}";
                                $timeContent[] = "{$slotseparator}<span class ='bultr-bh-label-wrap'>{$slotSecond}</span>";
        
                            } 
                            //slot3
                            if(!empty($item['cnumSlots']) && $item['cnumSlots']== 3  ){
                                $slotThird="";
                                $slotOpen3 = !empty($item['cslotOpen3']) ? $item['cslotOpen3'] : __('9:00 AM','wpv-bu');
                                $slotClose3 = !empty($item['cslotClose3']) ? $item['cslotClose3'] :__('11:00 AM','wpv-bu');
                                $slotLabel3 = isset($item['cslotLabel3']) ? "<span class='bultr-bh-label'>{$item['cslotLabel3']}</span>" : '';
                                $slotThird .= "{$slotLabel3} {$slotOpen3} {$seprator} {$slotClose3}";
                                $timeContent[] = "{$slotseparator}<span class ='bultr-bh-label-wrap'>{$slotThird}</span>";
        
                            }                     
                        }
                        else{
                            $timeContent[] = isset($cstmItem['cstmCLosedtext']) ? $cstmItem['cstmClosedtext'] : __('Closed','wpv-bu');
                        }
                    ?>
                    <div <?php echo $this->render_attributes( "time-class-{$index}" )?>><?php echo implode("",$timeContent)?></div>
            </div>
            <?php
            $this->loop_index++;
        }
   }

    public function enqueue_scripts(){
        wp_enqueue_style( 'bultr-module-style' );
		wp_enqueue_script( 'bultr-module-script' );
    }
}
?>