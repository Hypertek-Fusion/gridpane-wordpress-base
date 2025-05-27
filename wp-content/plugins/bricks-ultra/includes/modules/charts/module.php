<?php

namespace BricksUltra\Modules\Charts;

use Bricks\Element;

class Module extends Element
{
    public $category     = 'ultra';
    public $name         = 'wpvbu-charts';
    public $icon         = 'ti-pie-chart';
    public $css_selector = '';
    public $scripts       = ['buCharts'];
    public $rNo = '';
    public function get_label()
    {
        return esc_html__('Radial Charts','Wpv-bu');
    }

    public function get_keywords()
    {
        return ['chart', 'pie-chart', 'doughnut-chart', 'polar-chart', 'pie', 'doughnut', 'polar', 'circular chart', 'charts', 'radial-charts'];
    }

    public function enqueue_scripts()
    {
       
        wp_enqueue_script('bultr-module-script');
        wp_enqueue_style('bultr-module-style');
        wp_enqueue_script( 'bu-chart', WPV_BU_URL . 'assets/vendor/charts/chart.js', '', WPV_BU_VERSION, true );

    }

    public function set_control_groups()
    {
        $this->control_groups['chart_layout'] = [
            'title' => esc_html__('Layout', 'wpv-bu'),
            'tab' => 'content',
        ];
        $this->control_groups['chart_settings'] = [
            'title' => esc_html__('Chart Settings', 'wpv-bu'),
            'tab' => 'content',
        ];
        $this->control_groups['chart_style'] = [
            'title' => esc_html__('Chart Style', 'wpv-bu'),
            'tab' => 'content',
        ];
        $this->control_groups['polarChart'] = [
            'title' => esc_html__('Polar Area', 'wpv-bu'),
            'tab' => 'content',
            'required'=>['chartType', '=', 'polarArea'],
        ];
    }
   
    public function set_controls()
    {
        
        //chart layout section
        $this->controls['chartType'] = [
            'tab' => 'content',
            'group' => 'chart_layout',
            'label' => esc_html__('Type', 'wpv-bu'),
            'type' => 'select',
            'options' => [
                'pie' => esc_html__('Pie Chart', 'wpv-bu'),
                'doughnut' => esc_html__('Doughnut Chart', 'wpv-bu'),
                'polarArea' => esc_html__('Polar Area Chart', 'wpv-bu'),
            ],
            'inline'      => true,
            'rerender'    => true,
            'default' => __('pie','wpv-bu'),
            'placeholder' => esc_html__('Pie Chart', 'wpv-bu'),

        ];
        $this->controls['datasetLabel'] = [
            'tab' => 'content',
            'group' => 'chart_layout',
            'label' => esc_html__('Dataset Label', 'wpv-bu'),
            'type' => 'text',
            'default'     => esc_html__( '2022', 'bricks' ),
            'placeholder' => esc_html__('2022', 'wpv-bu'),

        ];
        $this->controls['chartData'] = [
            'tab' => 'content',
            'group' => 'chart_layout',
            'label' => esc_html__('Data', 'wpv-bu'),
            'type' => 'repeater',
            'clearable' => false,
            'titleProperty' => 'title',
            'fields' => [
                'category' => [
                    'label' => esc_html__('Label', 'wpv-bu'),
                    'type' => 'text',
                ],
                'value' => [
                    'label' => esc_html__('Value', 'wpv-bu'),
                    'type' => 'text',
                ],
                'highlight' => [
                    'label' => esc_html__('Highlight on Load', 'wpv-bu'),
                    'type' => 'checkbox',
                    'inline' => true,
                    'small' => true,
                ],
                'background' => [
                    'label' => __('Background', 'wpv-bu'),
                    'type' => 'color',
                ],
                'hvrbackground' => [
                    'label' => __('Hover Background', 'wpv-bu'),
                    'type' => 'color',
                ],
                'cborder' => [
                    'label' => __('Border color', 'wpv-bu'),
                    'type' => 'color',
                    
                ],
                'hvrborder' => [
                    'label' => __('Hover Border color', 'wpv-bu'),
                    'type' => 'color',
                    
                ],
            ],
            'default' => [
                
                [
                    'category' => __('Google', 'wpv-bu'),
                    'value' => __('15', 'wpv-bu'),
                   
                    'background' => [
                        'hex' => '#dd4b39',
                    ],
                    'hvrbackground'=> [
                        'hex' => '#DD4B39',
                    ],
                    'cborder' => [
                        'hex' => '#fff',
                        'rgb' => 'rgba(256,256,256)',
                    ],
                    'hvrborder'=> [
                        'hex' => '#fff',
                        'rgb' => 'rgba(256,256,256)',
                    ],
                ],
                [
                    'category' => __('Facebook', 'wpv-bu'),
                    'value' => __('15', 'wpv-bu'),
                    'background' => [
                        'hex' => '#3B5998',
                        'rgb' => 'rgba(59, 89, 152)',
                    ],
                    'hvrbackground' => [
                        'hex' => '#4267B2',
                        'rgb' => 'rgba(59, 89, 152)',
                    ],
                    'cborder' => [
                        'hex' => '#fff',
                        'rgb' => 'rgba(256,256,256)',
                    ],
                    'hvrborder'=> [
                        'hex' => '#fff',
                        'rgb' => 'rgba(256,256,256)',
                    ],
                ],
                [
                    'category' => __('Twitter', 'wpv-bu'),
                    'value' => __('20', 'wpv-bu'),
                    'background' => [
                        'hex' => '#55ACEE',
                        'rgb' => 'rgba(85, 172, 238)',
                    ],
                    'hvrbackground' => [
                        'hex' => '#55ACEE',
                        'rgb' => 'rgba(85, 172, 238)',
                    ],
                    'cborder' => [
                        'hex' => '#fff',
                        'rgb' => 'rgba(256,256,256)',
                    ],
                    'hvrborder'=> [
                        'hex' => '#fff',
                        'rgb' => 'rgba(256,256,256)',
                    ],
                ],
                [
                    'category' => __('Instagram', 'wpv-bu'),
                    'value' => __('50', 'wpv-bu'),
                    'background' => [
                        'hex' => '#0E293E',
                        'rgb' => 'rgba(14, 41, 62)',
                    ],
                    'hvrbackground' => [
                        'hex' => '#0E293E',
                        'rgb' => 'rgba(14, 41, 62)',
                    ],
                    'cborder' => [
                        'hex' => '#fff',
                        'rgb' => 'rgba(256,256,256)',
                    ],
                    'hvrborder'=> [
                        'hex' => '#fff',
                        'rgb' => 'rgba(256,256,256)',
                    ],
                ],
            ],
        ];
        //chart settings section
        $this->controls['chartWidth']=[
            'tab'=> 'content',
            'group'=> 'chart_settings',
            'label'=> esc_html__('Width (in px)', 'wpv-bu'),
            'type'=> 'number',
            'step' => '1', 
            'units' =>['%', 'vh','vw'],
            'css'=> [
                [
                    'selector' => '.bultr-chart-wrap',
                    'property' => '--size',

                ],
            ],
        ];
        $this->controls['highlightOn']=[
            'tab'=>'content',
            'group'=>'chart_settings',
            'label'=> esc_html__('Highlight On ', 'wpv-bu'),
            'type'=> 'select',
            'options'=> [
                'onHover'=> esc_html__('On Hover','wpv-bu'),
                'onClick'=> esc_html__('On Click','wpv-bu'),
            ],
            'inline'=> true,
            'small'=> true,
            'placeholder'=> esc_html__('On Hover', 'wpv-bu'),
        ];
        $this->controls['chartOffset']=[
            'tab'=>'content',
            'group'=>'chart_settings',
            'label'=> esc_html__('Offset Value ', 'wpv-bu'),
            'type'=> 'number',
            'min' => 0,
            'step' => '1', 
            'units' =>false,
            'inline'=> true,
            'small'=> true,
            'required'=> ['highlightOn','!=', 'never'],
        ];
        $this->controls['chartCircular']=[
            'tab'=>'content',
            'group'=>'chart_settings',
            'label'=> esc_html__('Non Circular', 'wpv-bu'),
            'type'=> 'checkbox',
            'inline'=> true,
            'small'=> true,

        ];
        $this->controls['circumference']=[
            'tab'=>'content',
            'group'=>'chart_settings',
            'label'=> esc_html__('Circumference', 'wpv-bu'),
            'type'=> 'number',
            'min' => 0,
            'step' => '1', 
            'unit' =>'deg',
            'inline'=> true,
            'small'=> true,
            'required' => ['chartType' , '!=', 'polarArea'],
        ];
        $this->controls['rotation']=[
            'tab'=>'content',
            'group'=>'chart_settings',
            'label'=> esc_html__('Rotation', 'wpv-bu'),
            'type'=> 'number',
            'min' => 0,
            'step' => '1', 
            'unit' =>'deg',
            'inline'=> true,
            'small'=> true,
            'required' => ['chartType' , '!=', 'polarArea'],


        ];
        $this->controls['radius']=[
            'tab'=>'content',
            'group'=>'chart_settings',
            'label'=> esc_html__('Radius', 'wpv-bu'),
            'type'=> 'number',
            'min' => 0,
            'step' => '1', 
            'unit' =>'%',
            'inline'=> true,
            'small'=> true,
            'required' => ['chartType' , '!=', 'polarArea'],


        ];
        //title seprator
        $this->controls['titleSept'] = [
            'tab'      => 'content',
            'group'    => 'chart_settings',
            'label'    => esc_html__('Title', 'wpv-bu'),
            'type'     => 'separator',
            'small'    => true,

        ];
        $this->controls['enableTitle']=[
            'tab'=>'content',
            'group'=>'chart_settings',
            'label'=> esc_html__('Enable Title', 'wpv-bu'),
            'type'=> 'checkbox',
            'inline'=> true,
            'small'=> true,

        ];
        $this->controls['titleTexts'] = [
            'tab'       => 'content',
            'group'     => 'chart_settings',
            'label'     => esc_html__('Title Text', 'wpv-bu'),
            'type'      => 'text',
            'default'   => esc_html__('Here goes your text ..','wpv-bu'),
            'required'  => ['enableTitle', '=',true],

        ];
        $this->controls['titlePosition']=[
            'tab'=>'content',
            'group'=>'chart_settings',
            'label'=> esc_html__('Position', 'wpv-bu'),
            'type'=> 'select',
            'options'=> [
                'top'=> esc_html__('Top','wpv-bu'),
                'bottom'=> esc_html__('Bottom','wpv-bu'),
                'right'=> esc_html__('Right', 'wpv-bu'),
                'left'=> esc_html__('Left', 'wpv-bu'),

            ],
            'inline'=> true,
            'small'=> true,
            'default' => __('top','wpv-bu'),
            'placeholder'=> esc_html__('Top', 'wpv-bu'),
            'required'=> ['enableTitle', '=',true],

        ];
        $this->controls['titleAlignment']=[
            'tab'=>'content',
            'group'=>'chart_settings',
            'label'=> esc_html__('Alignment', 'wpv-bu'),
            'type'=>'select',
            'options'=>[
                'start'=> esc_html__('Start', 'wpv-bu'),
                'center'=> esc_html__('Center', 'wpv-bu'),
                'end'=> esc_html__('End', 'wpv-bu'),

            ],
            'inline'=> true,
            'small'=> true,
            'required'=> ['enableTitle', '=',true],

        ];
        //legend seperator
        $this->controls['legendSet'] = [
            'tab'      => 'content',
            'group'    => 'chart_settings',
            'label'    => esc_html__('Legend', 'wpv-bu'),
            'type'     => 'separator',
            'small'    => true,

        ];

        $this->controls['enableLegend']=[
            'tab'=>'content',
            'group'=>'chart_settings',
            'label'=> esc_html__('Enable Legend', 'wpv-bu'),
            'type'=> 'checkbox',
            'inline'=> true,
            'small'=> true,
            'default'=> true,

        ];
        $this->controls['lgdPosition']=[
            'tab'=>'content',
            'group'=>'chart_settings',
            'label'=> esc_html__('Position', 'wpv-bu'),
            'type'=> 'select',
            'options'=> [
                'top'=> esc_html__('Top','wpv-bu'),
                'bottom'=> esc_html__('Bottom','wpv-bu'),
                'right'=> esc_html__('Right', 'wpv-bu'),
                'left'=> esc_html__('Left', 'wpv-bu'),

            ],
            'inline'=> true,
            'small'=> true,
            'placeholder'=> esc_html__('Top', 'wpv-bu'),
            'required'=> ['enableLegend', '=',true],

        ];
        $this->controls['lgdShape']=[
            'tab'=>'content',
            'group'=>'chart_settings',
            'label'=> esc_html__('Box Shape', 'wpv-bu'),
            'type'=>'select',
            'options'=>[
                'square'=> esc_html__('Square', 'wpv-bu'),
                'round'=> esc_html__('Round', 'wpv-bu'),
            ],
            'inline'=> true,
            'small'=> true,
            'required'=> ['enableLegend', '=',true],

        ];
        $this->controls['lgdAlignment']=[
            'tab'=>'content',
            'group'=>'chart_settings',
            'label'=> esc_html__('Alignment', 'wpv-bu'),
            'type'=>'select',
            'options'=>[
                'start'=> esc_html__('Start', 'wpv-bu'),
                'center'=> esc_html__('Center', 'wpv-bu'),
                'end'=> esc_html__('End', 'wpv-bu'),

            ],
            'inline'=> true,
            'small'=> true,
            'required'=> ['enableLegend', '=',true],

        ];
        $this->controls['lgdReverse']=[
            'tab'=>'content',
            'group'=>'chart_settings',
            'label'=> esc_html__('Reverse', 'wpv-bu'),
            'type'=> 'checkbox',
            'inline'=> true,
            'small'=> true,
            'required'=> ['enableLegend', '=',true],


        ];
        //tooltip 
        $this->controls['tltpSet'] = [
            'tab'      => 'content',
            'group'    => 'chart_settings',
            'label'    => esc_html__('Tooltip', 'wpv-bu'),
            'type'     => 'separator',
            'small'    => true,

        ];
        $this->controls['enableTooltip']=[
            'tab'=>'content',
            'group'=>'chart_settings',
            'label'=> esc_html__('Enable Tooltip', 'wpv-bu'),
            'type'=> 'checkbox',
            'inline'=> true,
            'small'=> true,
            'default'=> true,


        ];
        //animation
        $this->controls['animationSet'] = [
            'tab'      => 'content',
            'group'    => 'chart_settings',
            'label'    => esc_html__('Animation', 'wpv-bu'),
            'type'     => 'separator',
            'small'    => true,

        ];
        $this->controls['anmtDuration']=[
            'tab'=>'content',
            'group'=>'chart_settings',
            'label'=> esc_html__('Animation Duration', 'wpv-bu'),
            'type'=> 'number',
            'min' => 0,
            'step' => '0.5', 
            'unit' =>'ms',
            'inline'=> true,
            'small'=> true,

        ];
        $this->controls['anmtEasing']=[
            'tab'=>'content',
            'group'=>'chart_settings',
            'label'=> esc_html__('Animation', 'wpv-bu'),
            'small'=> true,
            'inline'=> true,
            'type'=> 'select',
            'options'=>[
                'linear'           => __( 'Linear', 'wts-eae' ),
                'easeInQuad'       => __( 'Ease in Quad', 'wts-eae' ),
                'easeOutQuad'      => __( 'Ease out Quad', 'wts-eae' ),
                'easeInOutQuad'    => __( 'Ease in out Quad', 'wts-eae' ),
                'easeInCubic'      => __( 'Ease in Cubic', 'wts-eae' ),
                'easeOutCubic'     => __( 'Ease out Cubic', 'wts-eae' ),
                'easeInOutCubic'   => __( 'Ease in out Cubic', 'wts-eae' ),
                'easeInQuart'      => __( 'Ease in Quart', 'wts-eae' ),
                'easeOutQuart'     => __( 'Ease out Quart', 'wts-eae' ),
                'easeInOutQuart'   => __( 'Ease in out Quart', 'wts-eae' ),
                'easeInQuint'      => __( 'Ease in Quint', 'wts-eae' ),
                'easeOutQuint'     => __( 'Ease out Quint', 'wts-eae' ),
                'easeInOutQuint'   => __( 'Ease in out Quint', 'wts-eae' ),
                'easeInSine'       => __( 'Ease in Sine', 'wts-eae' ),
                'easeOutSine'      => __( 'Ease out Sine', 'wts-eae' ),
                'easeInOutSine'    => __( 'Ease in out Sine', 'wts-eae' ),
                'easeInExpo'       => __( 'Ease in Expo', 'wts-eae' ),
                'easeOutExpo'      => __( 'Ease out Expo', 'wts-eae' ),
                'easeInOutExpo'    => __( 'Ease in out Cubic', 'wts-eae' ),
                'easeInCirc'       => __( 'Ease in Circle', 'wts-eae' ),
                'easeOutCirc'      => __( 'Ease out Circle', 'wts-eae' ),
                'easeInOutCirc'    => __( 'Ease in out Circle', 'wts-eae' ),
                'easeInElastic'    => __( 'Ease in Elastic', 'wts-eae' ),
                'easeOutElastic'   => __( 'Ease out Elastic', 'wts-eae' ),
                'easeInOutElastic' => __( 'Ease in out Elastic', 'wts-eae' ),
                'easeInBack'       => __( 'Ease in Back', 'wts-eae' ),
                'easeOutBack'      => __( 'Ease out Back', 'wts-eae' ),
                'easeInOutBack'    => __( 'Ease in Out Back', 'wts-eae' ),
                'easeInBounce'     => __( 'Ease in Bounce', 'wts-eae' ),
                'easeOutBounce'    => __( 'Ease out Bounce', 'wts-eae' ),
                'easeInOutBounce'  => __( 'Ease in out Bounce', 'wts-eae' ),
            ],
        ];
        $this->controls['anmtScale']=[
            'tab'=>'content',
            'group'=>'chart_settings',
            'label'=> esc_html__('Enable Scale on Load', 'wpv-bu'),
            'type'=> 'checkbox',
            'inline'=> true,
            'small'=> true,
            'default' => true,

        ];
        $this->controls['anmtRotate']=[
            'tab'=>'content',
            'group'=>'chart_settings',
            'label'=> esc_html__('Enable Rotation on Load', 'wpv-bu'),
            'type'=> 'checkbox',
            'inline'=> true,
            'small'=> true,
            'default' => true,

        ];
        //chart style section
        //chart style
        $this->controls['borderWidth']=[
            'tab'=>'content',
            'group'=>'chart_style',
            'label'=> esc_html__('Border Width', 'wpv-bu'),
            'type'=> 'number',
            'min' => '0',
            'step' => '1', 
            'unit' =>'px',
            'inline'=> true,
            'small'=> true,

        ];
        $this->controls['borderRds']=[
            'tab'=>'content',
            'group'=>'chart_style',
            'label'=> esc_html__('Border Radius', 'wpv-bu'),
            'type'=> 'number',
            'min' => 0,
            'step' => '1', 
            'units' =>['px', '%'],
            'inline'=> true,
            'small'=> true,

        ];
        //title style
        $this->controls['titleSeptStyle'] = [
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Title', 'wpv-bu'),
            'type'     => 'separator',
            'small'    => true,
            'required'=> ['enableTitle', '=',true],

        ];
        $this->controls['titleFont']=[
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Typography', 'wpv-bu'),
            'type'     => 'typography',
            'inline'=> true,
            'small'=> true,
            'exclude' => [
                'text-align',
                'text-transform',
                'letter-spacing',
                'text-decoration',
                'text-shadow',
            ],
            'required'=> ['enableTitle', '=',true],

        ];
        $this->controls['titlePadding']=[
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Gap', 'wpv-bu'),
            'description'=> esc_html__('Padding from top and Bottom', 'wp-bu'),	
            'type'     => 'number',
            'min' => '0',
            'step' => '1', 
            'inline'=> true,
            'small'=> true,
            'default' => 5,
            'required'=> ['enableTitle', '=',true],

        ];
        // legend style
        $this->controls['lgdSept'] = [
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Legend', 'wpv-bu'),
            'type'     => 'separator',
            'small'    => true,
            'required'=> ['enableLegend', '=',true],

        ];
        $this->controls['lgdHeight']=[
            'tab'       => 'content',
            'group'     => 'chart_style',
            'label'     => esc_html__('Box Height', 'wpv-bu'),
            'type'      => 'number',
            'min'       => '0',
            'step'      => '1', 
            'units'      => false,
            'inline'    => true,
            'small'     => true,
            'required'  => ['enableLegend', '=',true],

        ];
        $this->controls['lgdWidth']=[
            'tab'       => 'content',
            'group'     => 'chart_style',
            'label'     => esc_html__('Box Width', 'wpv-bu'),
            'type'      => 'number',
            'min'       => '0',
            'step'      => '1', 
            'units'     => false,
            'inline'    => true,
            'small'     => true,
            'required'  => ['enableLegend', '=',true],

        ];
        
        $this->controls['lgdFont']=[
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Typography', 'wpv-bu'),
            'type'     => 'typography',
            'inline'=> true,
            'small'=> true,
            'exclude' => [
                'text-align',
                'text-transform',
                'letter-spacing',
                'text-decoration',
                'text-shadow',
            ],
            'required'=> ['enableLegend', '=',true],

        ];
        $this->controls['lgdPadding']=[
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Padding', 'wpv-bu'),
            'type'     => 'number',
            'min' => '0',
            'step' => '1', 
            'inline'=> true,
            'small'=> true,
            'default' => 12,
            'required'=> ['enableLegend', '=',true],

        ];
        //tooltip style
        $this->controls['tltpSept'] = [
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Tooltip', 'wpv-bu'),
            'type'     => 'separator',
            'required'=> ['enableTooltip', '=',true],


        ];
        $this->controls['tltpBgColor']=[
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Background', 'wpv-bu'),
            'type'     => 'color',
            'inline'=> true,
            'small'=> true,
           
            'required'=> ['enableTooltip', '=',true],

        ];
        $this->controls['tltpLblFont']=[
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Label Typography', 'wpv-bu'),
            'type'     => 'typography',
            'inline'=> true,
            'small'=> true,
            'exclude' => [
                'text-transform',
                'letter-spacing',
                'text-decoration',
                'text-shadow',
            ],
            'required'=> ['enableTooltip', '=',true],

        ];
        $this->controls['tltpLblMargin']=[
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Label Margin Bottom', 'wpv-bu'),
            'type'     => 'number',
            'min' => '0',
            'step' => '1', 
            'inline'=> true,
            'small'=> true,
            'required'=> ['enableTooltip', '=',true],

        ];
        $this->controls['tltpPadding']=[
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Padding', 'wpv-bu'),
            'type'     => 'dimensions',
            'css'      =>[
                [
                    'property' => 'padding',
                    'selector' => '.bultr-tooltip-wrapper',
                ],
            ],
            'required'=> ['enableTooltip', '=',true],

        ];
        $this->controls['tltpArrowSize']=[
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Arrow Size', 'wpv-bu'),
            'type'     => 'number',
            'min' => '0',
            'step' => '1', 
            'inline'=> true,
            'small'=> true,
            'required'=> ['enableTooltip', '=',true],

        ];
        $this->controls['tltpBdrWidth']=[
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Border Width', 'wpv-bu'),
            'type'     => 'number',
            'min' => '0',
            'step' => '1', 
            'inline'=> true,
            'small'=> true,
            'required'=> ['enableTooltip', '=',true],

        ];
        $this->controls['tltpBdrColor']=[
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Border Color', 'wpv-bu'),
            'type'     => 'color',
            'inline'=> true,
            'small'=> true,
            'required'=> ['enableTooltip', '=',true],

        ];
        $this->controls['tltpBdrRds']=[
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Border Radius', 'wpv-bu'),
            'type'     => 'number',
            'min' => '0',
            'step' => '1', 
            'inline'=> true,
            'small'=> true,
            'required'=> ['enableTooltip', '=',true],

        ];   
        //tooltip box
        $this->controls['tltpBoxSept'] = [
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Tooltip Value Box', 'wpv-bu'),
            'type'     => 'separator',
            'required'=> ['enableTooltip', '=',true],
            'small'=>true,


        ];
        $this->controls['tltpBoxWidth']=[
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Value Box Width', 'wpv-bu'),
            'type'     => 'number',
            'min' => '0',
            'step' => '1', 
            'inline'=> true,
            'small'=> true,
            'required'=> ['enableTooltip', '=',true],

        ];
        $this->controls['tltpBoxHth']=[
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Value Box Height', 'wpv-bu'),
            'type'     => 'number',
            'min' => '0',
            'step' => '1', 
            'inline'=> true,
            'small'=> true,
            'required'=> ['enableTooltip', '=',true],

        ];
        $this->controls['tltpBoxGap']=[
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Gap', 'wpv-bu'),
            'type'     => 'number',
            
            'required'=> ['enableTooltip', '=',true],

        ];
        $this->controls['tltpValueFont']=[
            'tab'      => 'content',
            'group'    => 'chart_style',
            'label'    => esc_html__('Body Typography', 'wpv-bu'),
            'type'     => 'typography',
            'inline'=> true,
            'small'=> true,
            'exclude' => [
                'text-transform',
                'letter-spacing',
                'text-decoration',
                'text-shadow',
            ],
            'required'=> ['enableTooltip', '=',true],

        ];
        //polar Area chart settings
        $this->controls['showTicks']=[
            'tab'       => 'content',
            'group'     => 'polarChart',
            'label'     => esc_html__('Enable Ticks', 'wpv-bu'),
            'type'=> 'checkbox',
            'inline'=> true,
            'small'=> true,
            'default'=> true,
            'required'  => ['chartType','=','polarArea'],
            
            
        ];
        $this->controls['showGrid']=[
            'tab'       => 'content',
            'group'     => 'polarChart',
            'label'     => esc_html__('Enable Grid', 'wpv-bu'),
            'type'      => 'checkbox',
            'default'   => true,
            'small'     => true,
            'required'  => ['chartType','=','polarArea'],
        ];
        $this->controls['showAngle']=[
            'tab'       => 'content',
            'group'     => 'polarChart',
            'label'     => esc_html__('Enable Angle', 'wpv-bu'),
            'type'      => 'checkbox',
            'small'     => true,
            'required'  => ['chartType','=','polarArea'],
        ];
        $this->controls['showPointLbl']=[
            'tab'       => 'content',
            'group'     => 'polarChart',
            'label'     => esc_html__('Enable Point Labels', 'wpv-bu'),
            'type'      => 'checkbox',
            'small'     => true,
            'required'  => ['chartType','=','polarArea'],
        ];
        $this->controls['showPercentage']=[
            'tab'       => 'content',
            'group'     => 'polarChart',
            'label'     => esc_html__('Show Percentage(%)', 'wpv-bu'),
            'type'      => 'checkbox',
            'small'     => true,
            'required'=> [
                ['chartType','=','polarArea'],
                ['showTicks', '=', true]
            ],        
        ];
        $this->controls['centerPoint']=[
            'tab'       => 'content',
            'group'     => 'polarChart',
            'label'     => esc_html__('Center Point Label', 'wpv-bu'),
            'type'      => 'checkbox',
            'small'     => true,
            'required'=> [
                ['chartType','=','polarArea'],
                ['showPointLbl', '=', true]
            ],        
        ];
        $this->controls['polarSept'] = [
            'tab'      => 'content',
            'group'    => 'polarChart',
            'label'    => esc_html__('Style', 'wpv-bu'),
            'type'     => 'separator',
            'required' => ['chartType','=','polarArea'],
            'small'    =>true,
        ];
        // ticks
        $this->controls['tickBgColor']=[
            'tab'      => 'content',
            'group'    => 'polarChart',
            'label'    => esc_html__('Tick Background', 'wpv-bu'),
            'type'     => 'color',
            'inline'=> true,
            'small'=> true,
            'required'=> [
                ['chartType','=','polarArea'],
                ['showTicks', '=', true]
            ],

        ];
        $this->controls['tickColor']=[
            'tab'      => 'content',
            'group'    => 'polarChart',
            'label'    => esc_html__('Tick Color', 'wpv-bu'),
            'type'     => 'color',
            'inline'=> true,
            'small'=> true,
            'required'=> [
                ['chartType','=','polarArea'],
                ['showTicks', '=', true]
            ],

        ];
        $this->controls['tickFont']=[
            'tab'      => 'content',
            'group'    => 'polarChart',
            'label'    => esc_html__('Tick Typography', 'wpv-bu'),
            'type'     => 'typography',
            'inline'=> true,
            'small'=> true,
            'exclude' => [
                'color',
                'text-transform',
                'letter-spacing',
                'text-decoration',
                'text-shadow',
            ],
            'required'=> [
                ['chartType','=','polarArea'],
                ['showTicks', '=', true]
            ],
        ];
        $this->controls['tickPadding']=[
            'tab'      => 'content',
            'group'    => 'polarChart',
            'label'    => esc_html__('Tick Padding', 'wpv-bu'),
            'type'     => 'dimensions',
            
            'required'=> [
                ['chartType','=','polarArea'],
                ['showTicks', '=', true]
            ],
        ];
        //grids
        $this->controls['polarGridSept'] = [
            'tab'      => 'content',
            'group'    => 'polarChart',
            'label'    => esc_html__('Grid Lines', 'wpv-bu'),
            'type'     => 'separator',
            'required'=> [
                ['chartType','=','polarArea'],
                ['showGrid', '=', true]
            ],
            'small'    =>true,
        ];
        $this->controls['gridColor']=[
            'tab'      => 'content',
            'group'    => 'polarChart',
            'label'    => esc_html__('Color', 'wpv-bu'),
            'type'     => 'color',
            'inline'=> true,
            'small'=> true,
            'required'=> [
                ['chartType','=','polarArea'],
                ['showGrid', '=', true]
            ],

        ];
        $this->controls['gridLineWidth']=[
            'tab'      => 'content',
            'group'    => 'polarChart',
            'label'    => esc_html__('Line Width', 'wpv-bu'),
            'type'     => 'number',
            'required'=> [
                ['chartType','=','polarArea'],
                ['showGrid', '=', true]
            ],
        ];

        //angle lines
        $this->controls['polarAngleSept'] = [
            'tab'      => 'content',
            'group'    => 'polarChart',
            'label'    => esc_html__('Angle Lines', 'wpv-bu'),
            'type'     => 'separator',
            'required'=> [
                ['chartType','=','polarArea'],
                ['showAngle', '=', true]
            ],
            'small'    =>true,
        ];
        $this->controls['angleColor']=[
            'tab'      => 'content',
            'group'    => 'polarChart',
            'label'    => esc_html__('Color', 'wpv-bu'),
            'type'     => 'color',
            'inline'=> true,
            'small'=> true,
            'required'=> [
                ['chartType','=','polarArea'],
                ['showAngle', '=', true]
            ],

        ];
        $this->controls['angleLineWidth']=[
            'tab'      => 'content',
            'group'    => 'polarChart',
            'label'    => esc_html__('Line Width', 'wpv-bu'),
            'type'     => 'number',
            'required'=> [
                ['chartType','=','polarArea'],
                ['showAngle', '=', true]
            ],
        ];
        //Point Labels
        $this->controls['polarPointSept'] = [
            'tab'      => 'content',
            'group'    => 'polarChart',
            'label'    => esc_html__('Point Label', 'wpv-bu'),
            'type'     => 'separator',
            'required'=> [
                ['chartType','=','polarArea'],
                ['showPointLbl', '=', true]
            ],
            'small'    =>true,
        ];
        $this->controls['pointBgColor']=[
            'tab'      => 'content',
            'group'    => 'polarChart',
            'label'    => esc_html__('Background', 'wpv-bu'),
            'type'     => 'color',
            'inline'=> true,
            'small'=> true,
            'required'=> [
                ['chartType','=','polarArea'],
                ['showPointLbl', '=', true]
            ],

        ];
        $this->controls['pointColor']=[
            'tab'      => 'content',
            'group'    => 'polarChart',
            'label'    => esc_html__('Color', 'wpv-bu'),
            'type'     => 'color',
            'inline'=> true,
            'small'=> true,
            'required'=> [
                ['chartType','=','polarArea'],
                ['showPointLbl', '=', true]
            ],

        ];
        $this->controls['pointFont']=[
            'tab'      => 'content',
            'group'    => 'polarChart',
            'label'    => esc_html__('Typography', 'wpv-bu'),
            'type'     => 'typography',
            'inline'=> true,
            'small'=> true,
            'exclude' => [
                'color',
                'text-transform',
                'letter-spacing',
                'text-decoration',
                'text-shadow',
            ],
            'required'=> [
                ['chartType','=','polarArea'],
                ['showPointLbl', '=', true]
            ],
        ];
        $this->controls['pointPadding']=[
            'tab'      => 'content',
            'group'    => 'polarChart',
            'label'    => esc_html__('Padding', 'wpv-bu'),
            'type'     => 'dimensions',
            
            'required'=> [
                ['chartType','=','polarArea'],
                ['showPointLbl', '=', true]
            ],
        ];
        $this->controls['pointBdrRds']=[
            'tab'      => 'content',
            'group'    => 'polarChart',
            'label'    => esc_html__('Border Radius', 'wpv-bu'),
            'type'     => 'number',
            'required'=> [
                ['chartType','=','polarArea'],
                ['showPointLbl', '=', true]
            ],
        ];



    }
    public function render()
    {
        $settings = $this->settings;
    
        if(!isset($settings['chartType'])){
            return $this->render_element_placeholder(
				[
					'title' => esc_html__( 'No Chart Type Selected.', 'wpv-bu' ),
				]
			);
        }
        
        
        if(!isset($settings['chartData'])){
            return $this->render_element_placeholder(
				[
					'title' => esc_html__( 'Invalid Data.', 'wpv-bu' ),
				]
			);
        }
        
        $root_classes = [
            'bultr-charts-wrapper'
        ];
        
        $data_chart = $this->get_chart_data();

            //root classes
        $this->set_attribute('_root', 'class', $root_classes);
        $this->set_attribute('chart_wrap', 'data-chart', json_encode($data_chart));
        $this->set_attribute('chart_wrap', 'class', "bultr-chart-wrap");
        $this->set_attribute('canvas', 'class', 'bultr-chart-canvas');
        $this->set_attribute('canvas', 'id', 'bultr-chart-id'.rand(100,200));

        ?>
        <div <?php echo $this->render_attributes('_root');?> >
            <div  <?php echo $this->render_attributes('chart_wrap');?>>
                <canvas <?php echo $this->render_attributes('canvas');?>></canvas>
            </div>
        </div>
        <?php
        
        
    }

    public function get_chart_data(){
        $settings = $this->settings;
        $chart_type = !empty($settings['chartType']) ? $settings['chartType'] : 'pie';
        $hlLabel =[];
        $chartData = $settings['chartData'];
        $chart='';

        foreach ( $chartData as  $item){
            if(  isset($item['highlight']) ===  true){
                $hlLabel= $item['category'];
            }			
        }
        foreach($chartData as $item){
            //background colot
            if(!empty($item['background']['rgb'])){
                $bgcolorData = $item['background']['rgb'];
            }
            elseif($item['background']['hex']){
                $bgcolorData = $item['background']['hex'];
            }
            //hover background color
            if(!empty($item['hvrbackground']['rgb'])){
                $bgcolorHvr = $item['hvrbackground']['rgb'];
            }
            elseif($item['hvrbackground']['hex']){
                $bgcolorHvr = $item['hvrbackground']['hex'];
            }
            //border color
            if(!empty($item['cborder']['rgb'])){
                $borderColor = $item['cborder']['rgb'];
            }
            elseif($item['cborder']['hex']){
                $borderColor = $item['cborder']['hex'];
            }
            //hover border color
            if(!empty($item['hvrborder']['rgb'])){
                $hvrborderColor = $item['hvrborder']['rgb'];
            }
            elseif($item['hvrborder']['hex']){
                $hvrborderColor = $item['hvrborder']['hex'];
            }
           
            $data['labels'][] = !empty($item['category']) ? $item['category'] : '';
            $data['datasets'][0]['label'] = !empty($settings['datasetLabel']) ? $settings['datasetLabel'] : '';
            $data['datasets'][0]['data'][]= !empty($item['value']) ? $item['value'] : '';
            $data['datasets'][0]['backgroundColor'][] = !empty($item['background']) ? $bgcolorData : 'rgba(219,68,55, 0.6)';
            $data['datasets'][0]['hoverBackgroundColor'][] = !empty($item['hvrbackground']) ? $bgcolorHvr : 'rgba(219,68,55)';
            $data['datasets'][0]['borderColor'][] = !empty($item['cborder']) ? $borderColor : '#000';
            $data['datasets'][0]['hoverBorderColor'][] = !empty($item['hvrborder']) ? $hvrborderColor : '#000';
            $data['datasets'][0]['borderWidth'] = !empty($settings['borderWidth']) ? $settings['borderWidth'] : '1';
            $data['datasets'][0]['borderRadius'] = !empty($settings['borderRds']) ? $settings['borderRds'] : '';
            $data['datasets'][0]['circular'] = !empty($settings['chartCircular']) ? !$settings['chartCircular'] : true;
            $data['datasets'][0]['hoverOffset'] = !empty($settings['chartOffset']) ? (int)$settings['chartOffset'] : 20;
            $data['datasets'][0]['circumference'] = !empty($settings['circumference']) ? $settings['circumference'] :'360';
            $data['datasets'][0]['rotation'] = !empty($settings['rotation']) ? $settings['rotation'] :'0';
            $data['datasets'][0]['radius'] = !empty($settings['radius']) ? $settings['radius'] :'100%';
        }
        if(isset($settings['enableLegend'])){
            $display = $settings['enableLegend'];
        }
        elseif(!isset($settings['enableLegend'])){
            $display = false;
        }
	    
        $legend=[
            'display'=> $display,
            'position'=> !empty($settings['lgdPosition']) ? $settings['lgdPosition'] : 'top',
            'align'=> !empty($settings['lgdAlignment']) ? $settings['lgdAlignment'] : 'center',
            'reverse'=> !empty($settings['lgdReverse']) ? $settings['lgdReverse'] : '',
            'labels'=>[
                'boxWidth' => !empty($settings['lgdWidth']) ? (int)$settings['lgdWidth'] : 44,

                'boxHeight' => !empty($settings['lgdHeight']) ? (int)$settings['lgdHeight'] : 16,
                'padding'  => !empty($settings['lgdPadding']) ? (int)$settings['lgdPadding'] : 5,

                'font'=>$font= [
                    'family'    => !empty($settings['lgdFont']['font-family']) ? $settings['lgdFont']['font-family'] : 'Helvetica',
                    'size'      => !empty($settings['lgdFont']['font-size']) ? $settings['lgdFont']['font-size'] : '16',
                    'style'     => !empty($settings['lgdFont']['font-style']) ? $settings['lgdFont']['font-style'] : 'normal',
                    'weight'    => !empty($settings['lgdFont']['font-weight']) ? $settings['lgdFont']['font-weight'] : '400',
                    'lineHeight'=> !empty($settings['lgdFont']['line-height']) ? $settings['lgdFont']['line-height'] : '1em',

                ],
                'usePointStyle'=> !empty($settings['lgdShape']) && $settings['lgdShape']=== 'round' ? true : false,
                'pointStyle' => 'circle',
                'color'    => !empty($settings['lgdFont']['color']['hex']) ? $settings['lgdFont']['color']['hex'] : '#000',

            ],

        ];
        if(isset($settings['enableTitle'])){
            $displayTitle = $settings['enableTitle'];
        }
        elseif(!isset($settings['enableTitle'])) {
            $displayTitle = false;
        }
        $title =[
            'display'   => $displayTitle,
            'text'      => !empty($settings['titleTexts']) ? $settings['titleTexts'] : 'Here goes title...',
            'position'  => !empty($settings['titlePosition']) ? $settings['titlePosition'] : 'top',
            'align'     => !empty($settings['titleAlignment']) ? $settings['titleAlignment'] : 'center',
            'font'=> [
                'family'    => !empty($settings['titleFont']['font-family']) ? $settings['titleFont']['font-family'] : 'Helvetica',
                'size'      => !empty($settings['titleFont']['font-size']) ? $settings['titleFont']['font-size'] : '20',
                'style'     => !empty($settings['titleFont']['font-style']) ? $settings['titleFont']['font-style'] : 'normal',
                'weight'    => !empty($settings['titleFont']['font-weight']) ? $settings['titleFont']['font-weight'] : '500',
                'lineHeight'=> !empty($settings['titleFont']['line-height']) ? $settings['titleFont']['line-height'] : '1.5',

            ],
            'color' => !empty($settings['titleFont']['color']['hex']) ? $settings['titleFont']['color']['hex'] : '',
            'padding'=> [
                'top'   => !empty($settings['titlePadding']) ? $settings['titlePadding'] : '5',
                'bottom'=> !empty($settings['titlePadding']) ? $settings['titlePadding'] : '5',
            ],

        ];
        $displayTltp = isset($settings['enableTooltip']) ? true : false;
        

        // background color check
        if(!empty($settings['tltpBgColor']['rgb'])){
            $bgcolor = $settings['tltpBgColor']['rgb'];
        }
        elseif(!empty($settings['tltpBgColor']['hex'])){
            $bgcolor = $settings['tltpBgColor']['hex'];
        }
        else{
            $bgcolor = '#000';

        }
        if(!empty($settings['tltpBgColor']['font-size'])){
            $boxSize = (int)$settings['tltpBgColor']['font-size'];
        }
        else{
            $boxSize = 16;
        }
        $tooltip = [
            'enabled' => $displayTltp,
            'backgroundColor'=> $bgcolor,
            'titleColor'=>!empty($settings['tltpLblFont']['color']['hex']) ? $settings['tltpLblFont']['color']['hex'] : '#fff',
            'titleFont'=>$font=[
                'family'    => !empty($settings['tltpLblFont']['font-family']) ? $settings['tltpLblFont']['font-family'] : 'Helvetica',
                'size'      => !empty($settings['tltpLblFont']['font-size']) ? (int)$settings['tltpLblFont']['font-size'] : '16px',
                'style'     => !empty($settings['tltpLblFont']['font-style']) ? $settings['tltpLblFont']['font-style'] : 'normal',
                'weight'    => !empty($settings['tltpLblFont']['font-weight']) ? $settings['tltpLblFont']['font-weight'] : '400',
                'lineHeight'=> !empty($settings['tltpLblFont']['line-height']) ? $settings['tltpLblFont']['line-height'] : '1em',
            
            ],
            'titleAlign'=> !empty($settings['tltpLblFont']['text-align']) ? $settings['tltpLblFont']['text-align'] : 'left',
            'titleMarginBottom'=> !empty($settings['tltpLblMargin']) ? (int)$settings['tltpLblMargin'] : 2,
            'bodyColor'=>!empty($settings['tltpValueFont']['color']['hex']) ? $settings['tltpValueFont']['color']['hex'] : '#fff',
            'bodyFont'=>$bfont=[
                'family'    => !empty($settings['tltpValueFont']['font-family']) ? $settings['tltpValueFont']['font-family'] : 'Helvetica',
                'size'      => !empty($settings['tltpValueFont']['font-size']) ? (int)$settings['tltpValueFont']['font-size'] : 16,
                'style'     => !empty($settings['tltpValueFont']['font-style']) ? $settings['tltpValueFont']['font-style'] : 'normal',
                'weight'    => !empty($settings['tltpValueFont']['font-weight']) ? $settings['tltpValueFont']['font-weight'] : '400',
                'lineHeight'=> !empty($settings['tltpValueFont']['line-height']) ? $settings['tltpValueFont']['line-height'] : '1em',
            
            ],
            'bodyAlign'=> !empty($settings['tltpValueFont']['text-align']) ? $settings['tltpValueFont']['text-align'] : 'left',
            'padding'=>$padding= [
                'left' => !empty($settings['tltpPadding']['left']) ? $settings['tltpPadding']['left'] : '5',
                'right' => !empty($settings['tltpPadding']['right']) ? $settings['tltpPadding']['right'] : '5',
                'top' => !empty($settings['tltpPadding']['top']) ? $settings['tltpPadding']['top'] : '5',
                'bottom' => !empty($settings['tltpPadding']['bottom']) ? $settings['tltpPadding']['bottom'] : '5',
            ],
            'caretSize' => !empty($settings['tltpArrowSize']) ? (int)$settings['tltpArrowSize'] : 5,
            'cornerRadius'=> !empty($settings['tltpBdrRds']) ? (int)$settings['tltpBdrRds'] : 5,
            'borderWidth'=>!empty($settings['tltpBdrWidth']) ? (int)$settings['tltpBdrWidth'] : 1,
            'borderColor'=>!empty($settings['tltpBdrColor']['hex']) ? $settings['tltpBdrColor']['hex'] : '#000',
            'boxWidth'=>!empty($settings['tltpBoxWidth']) ? (int)$settings['tltpBoxWidth'] : $boxSize,
            'boxHeight'=>!empty($settings['tltpBoxHth']) ? (int)$settings['tltpBoxHth'] : $boxSize,
            'boxPadding'=>!empty($settings['tltpBoxGap']) ? (int)$settings['tltpBoxGap'] : 1,

        ];
        $animation = [
            'duration'      => !empty($settings['anmtDuration']) ? $settings['anmtDuration'] : '1000',
            'easing'        => !empty($settings['anmtEasing']) ? $settings['anmtEasing'] : 'linear',
            'animateScale'  => !empty($settings['anmtScale']) ? $settings['anmtScale'] : '',
            'animateRotate' => !empty($settings['anmtRotate']) ? $settings['anmtRotate'] : '',

        ];

        $plugin =[
            'legend'=> $legend,
            'tooltip'=> $tooltip,
            'title'=> $title,
        ];
        if(isset($settings['showGrid'])){
            $displayGrid = $settings['showGrid'];
        }
        elseif(!isset($settings['showGrid'])) {
            $displayGrid = false;
        }
        $grid = [
            'display'=> $displayGrid,
            'color' => !empty($settings['gridColor']['hex']) ? $settings['gridColor']['hex'] : '#e8e8e8',
            'lineWidth'=> !empty($settings['gridLineWidth']) ? (int)$settings['gridLineWidth'] : 1, 

        ];
        if(isset($settings['showTicks'])){
            $displayTick = $settings['showTicks'];
        }
        elseif(!isset($settings['showTicks'])) {
            $displayTick = false;
        }
        $ticks =[
            'display'=> $displayTick,
            'backdropColor' => !empty($settings['tickBgColor']['hex']) ? $settings['tickBgColor']['hex'] : '#fff',
            'color' => !empty($settings['tickColor']['hex']) ? $settings['tickColor']['hex'] : '#000',
            'backdropPadding'=>$padding= [
                'left' => !empty($settings['tickPadding']['left']) ? $settings['tickPadding']['left'] : '0',
                'right' => !empty($settings['tickPadding']['right']) ? $settings['tickPadding']['right'] : '0',
                'top' => !empty($settings['tickPadding']['top']) ? $settings['tickPadding']['top'] : '0',
                'bottom' => !empty($settings['tickPadding']['bottom']) ? $settings['tickPadding']['bottom'] : '0',
            ],
            'font'=>$bfont=[
                'family'    => !empty($settings['tickFont']['font-family']) ? $settings['tickFont']['font-family'] : 'Helvetica',
                'size'      => !empty($settings['tickFont']['font-size']) ? (int)$settings['tickFont']['font-size'] : 12,
                'style'     => !empty($settings['tickFont']['font-style']) ? $settings['tickFont']['font-style'] : 'normal',
                'weight'    => !empty($settings['tickFont']['font-weight']) ? $settings['tickFont']['font-weight'] : '400',
                'lineHeight'=> !empty($settings['tickFont']['line-height']) ? $settings['tickFont']['line-height'] : '1em',
            ],
        ];
        if(isset($settings['showAngle'])){
            $displayAngle = $settings['showAngle'];
        }
        elseif(!isset($settings['showAngle'])) {
            $displayAngle = false;
        }
        $angle =[
            'display' => $displayAngle,
            'color' => !empty($settings['angleColor']['hex']) ? $settings['angleColor']['hex'] : '#e8e8e8',
            'lineWidth'=> !empty($settings['angleLineWidth']) ? (int)$settings['angleLineWidth'] : 1, 
        ];
        if(isset($settings['showPointLbl'])){
            $displayPoint = $settings['showPointLbl'];
        }
        elseif(!isset($settings['showPointLbl'])) {
            $displayPoint = false;
        }
        if(isset($settings['centerPoint'])){
            $centerPoint = $settings['centerPoint'];
        }
        elseif(!isset($settings['centerPoint'])) {
            $centerPoint = false;
        }
        $point = [
            'display' => $displayPoint,
            'centerPointLabels'=> $centerPoint,
            'backdropColor' => !empty($settings['pointBgColor']['hex']) ? $settings['pointBgColor']['hex'] : '#fff',
            'color' => !empty($settings['pointColor']['hex']) ? $settings['pointColor']['hex'] : '#000',
            'backdropPadding'=>$padding= [
                'left' => !empty($settings['pointPadding']['left']) ? $settings['pointPadding']['left'] : '0',
                'right' => !empty($settings['pointPadding']['right']) ? $settings['pointPadding']['right'] : '0',
                'top' => !empty($settings['pointPadding']['top']) ? $settings['pointPadding']['top'] : '0',
                'bottom' => !empty($settings['pointPadding']['bottom']) ? $settings['pointPadding']['bottom'] : '0',
            ],
            'font'=>$bfont=[
                'family'    => !empty($settings['pointFont']['font-family']) ? $settings['pointFont']['font-family'] : 'Helvetica',
                'size'      => !empty($settings['pointFont']['font-size']) ? (int)$settings['pointFont']['font-size'] : 12,
                'style'     => !empty($settings['pointFont']['font-style']) ? $settings['pointFont']['font-style'] : 'normal',
                'weight'    => !empty($settings['pointFont']['font-weight']) ? $settings['pointFont']['font-weight'] : '400',
                'lineHeight'=> !empty($settings['pointFont']['line-height']) ? $settings['pointFont']['line-height'] : '1em',
            ],
            'borderRadius' =>!empty($settings['pointBdrRds']) ? (int)$settings['pointBdrRds'] : 0, 

        ];
        $r =[
            'grid'=> $grid,
            'ticks'=> $ticks,
            'pointLabels'=> $point,
            'angleLines'=>$angle,
        ];
        $polar =[
            'r'=> $r,
        ];
        //to add padding in around chart otherwise content is getting sliced off
        $padding = [
            'padding'=> 10,
        ];
        $highlight = isset($settings['highlightOn']) ? $settings['highlightOn'] : 'onHover' ;
        if($highlight === 'onHover'){
            $onEvent = ['mousemove', 'mouseout',  'touchstart', 'touchmove','click'];
        }
        elseif($highlight === 'onClick'){
            $onEvent = ['click'];
        }
        $options=[
            'events'=> $onEvent,
            'responsive'=> true,
            'maintainAspectRatio' => false,
            'aspectRatio'=> 1,
            'plugins'      => $plugin,
            'animation'    => $animation,
            'layout'=> $padding,
            
        ];
        if($settings['chartType']=='polarArea'){
			$options['scales'] =  $polar;
		}	
        $chart = (
            [
                'type'=> $chart_type,
                'data'=> $data,
                'highlight'=>isset($settings['highlightOn']) ? $settings['highlightOn'] : 'onHover' ,
                'highlightLoad'=> !empty($hlLabel) ? $hlLabel: "",	
                'enablePercentage' => isset($settings['showPercentage']) ? $settings['showPercentage'] : false ,
                'offsetValue'=> isset($settings['chartOffset']) ? (int)$settings['chartOffset'] : 20 ,
                'options'=> $options
            ]
        );
        return $chart;
        
    }

}
