<?php

namespace BricksUltra\includes\Unfold;


use Bricks\Element;
use Bricks\Frontend;

class Module extends Element
{
    public $category     = 'ultra';
    public $name         = 'wpvbu-unfold';
    public $icon         = 'ti-layout-accordion-merged';
    public $css_selector = '';
    public $script       = ['buUnfold'];
    public $loop_index   = 0;
    public $nestable     = true;


    public function get_label()
    {
        return esc_html__('Unfold (Nestable)', 'wpv-bu');
    }
    public function get_keywords()
    {
        return ['unfold', 'content-reveal', 'nestable'];
    }
    public function set_control_groups()
    {
        $this->control_groups['unfold_setting'] = [
            'title' => esc_html__('Settings', 'wpv-bu'),
            'tab'   => 'content',
        ];

        $this->control_groups['unfold_separator'] = [
            'title' => esc_html__('Separator', 'wpv-bu'),
            'tab'   => 'content',
        ];
        $this->control_groups['unfold_button'] = [
            'title' => esc_html__('Button', 'wpv-bu'),
            'tab'   => 'content',
        ];
        $this->control_groups['unfold_button_style'] = [
            'title' => esc_html__('Button Style', 'wpv-bu'),
            'tab'   => 'content',
        ];
    }
    public function set_controls()
    {
        $this->controls['expand'] = [
            'tab' => 'content',
            'label' => esc_html__('Expand (At the time of editing)', 'wpv-bu'),
            'type' => 'checkbox',
            'inline' => true,
            'small' => true,
        ];
        $this->controls['UFnotice']=[
            'tab' => 'content',
            'content' => __("Don't delete <b class ='bultr-info-bold'>Content</b> Element. This element is necessary for the functionality of Nested Unfold. Add any additional Elements under the Content element.", 'wpv-bu'),
            'type' => 'info',
        ];
        //content height
        $this->controls['contentHeight'] = [
            'tab' => 'content',
            'group' => 'unfold_setting',
            'label' => esc_html__('Visible Height (in px)', 'wpv-bu'),
            'type' => 'number',
            'unit' => 'px',
            'css' => [
                [
                    'selector' => '.bultr-uf-content-wrap',
                    'property' => '--cheight',

                ],
            ],
        ];
        //transition
        $this->controls['contentTrans'] = [
            'tab' => 'content',
            'group' => 'unfold_setting',
            'label' => esc_html__('Transition', 'wpv-bu'),
            'type' => 'number',
            'units' => ['ms', 's'],
            'min' => 0,
            'step' => '0.1', // Default: 1
            'inline' => true,
            'css' => [
                [
                    'property' => 'transition-duration',
                    'selector' => '.bultr-uf-content-wrap',
                ],
            ],
        ];
        //fade seperator
        $this->controls['sept'] = [
            'tab' => 'content',
            'group' => 'unfold_separator',
            'label' => esc_html__('Separator', 'wpv-bu'),
            'type' => 'checkbox',
            'inline' => true,
            'small' => true,
            'default' => true,
            'clearable' => true,
        ];
        //seperator height
        $this->controls['septHeight'] = [
            'tab' => 'content',
            'group' => 'unfold_separator',
            'label' => esc_html__('Height', 'wpv-bu'),
            'type' => 'number',
            'units' => ['px', '%'],
            'css' => [
                [

                    'selector' => '.bultr-uf-seperator',
                    'property' => '--sepheight',
                ],
            ],
            'default' => 100,
            'required' => ['sept', '=', true],



        ];
        //seperator background color
        $this->controls['septBgcolor'] = [
            'tab' => 'content',
            'group' => 'unfold_separator',
            'label' => esc_html__('Background', 'wpv-bu'),
            'type' => 'gradient',
            'css' => [
                [
                    'property' => 'background-image',
                    'selector' => '.bultr-uf-seperator',
                ]
            ],
            'required' => ['sept', '=', true],


        ];
        //button Placement
        $this->controls['btnPlacement'] = [
            'tab' => 'content',
            'group' => 'unfold_button',
            'label' => esc_html__('Button Placement', 'wpv_bu'),
            'type' => 'select',
            'options' => [
                'top' => 'Top',
                'bottom' => 'Bottom',
            ],
            'inline' => true,
            

        ];
        // show button
        //sepereator
        $this->controls['septShow'] = [
            'tab'      => 'content',
            'group'    => 'unfold_button',
            'label'    => esc_html__('Show Button', 'wpv-bu'),
            'type'     => 'separator',
        ];
        //button text
        $this->controls['showButton'] = [
            'tab'         => 'content',
            'group'       => 'unfold_button',
            'type'        => 'text',
            'default'     => esc_html__('Show More', 'wpv-bu'),
            'placeholder' => esc_html__('Show More', 'wpv-bu'),
        ];
        //button icon
        $this->controls['showBtnIcon'] = [
            'tab' => 'content',
            'group' => 'unfold_button',
            'label' => esc_html__('Icon', 'wpv-bu'),
            'type'  => 'icon',
        ];

        //hide button
        //button seperator
        $this->controls['septHide'] = [
            'tab'      => 'content',
            'group'    => 'unfold_button',
            'label'    => esc_html__('Hide Button', 'wpv-bu'),
            'type'     => 'separator',
        ];
        //button content
        $this->controls['hideButton'] = [
            'tab'         => 'content',
            'group'       => 'unfold_button',
            'type'        => 'text',
            'default'     => esc_html__('Show Less', 'wpv-bu'),
            'placeholder' => esc_html__('Show Less', 'wpv-bu'),
        ];
        //button icon
        $this->controls['hideBtnIcon'] = [
            'tab' => 'content',
            'group' => 'unfold_button',
            'label' => esc_html__('Icon', 'wpv-bu'),
            'type'  => 'icon',
        ];
        //button style controls
        //button width
        $this->controls['btnWidth'] = [
            'tab'   => 'content',
            'group' => 'unfold_button_style',
            'label' => esc_html__('Width', 'wpv-bu'),
            'type'  => 'number',
            'units' => true,
            'inline' => true,
            'small' => true,
            'css'   => [
                [
                    'property' => 'width',
                    'selector' => '.bultr-uf-button',
                ],
            ],
        ];


        //button paading
        $this->controls['btnPadding'] = [
            'tab'   => 'content',
            'group' => 'unfold_button_style',
            'label' => esc_html__('Padding', 'wpv-bu'),
            'type'  => 'dimensions',
            'css'   => [
                [
                    'property' => 'padding',
                    'selector' => '.bultr-uf-button',
                ],
            ],
        ];
        //button margin
        $this->controls['btnCntGap'] = [
            'tab'   => 'content',
            'group' => 'unfold_button_style',
            'label' => esc_html__('Button Gap ', 'wpv-bu'),
            'type'  => 'number',
            'units' => true,
            'small' => true,
            'inline' => true,
            'css'   => [
                [
                    'property' => 'margin-top',
                    'selector' => '.bultr-uf-sep-bg',
                ],
                [
                    'property' => 'margin-bottom',
                    'selector' => '.bultr-uf-sep-bg',
                ],
            ],
        ];
        //button alignment
        $this->controls['btnAlign'] = [
            'tab'   => 'content',
            'group' => 'unfold_button_style',
            'label' => esc_html__('Alignment', 'wpv-bu'),
            'type'  => 'justify-content',
            'css'   => [
                [
                    'property' => 'justify-content',
                    'selector' => '.bultr-uf-button-wrap',
                ],
            ],
            'exclude' => [
                'space',
            ],
        ];
        // button typography
        $this->controls['btnTypo'] = [
            'tab' => 'content',
            'group' => 'unfold_button_style',
            'label'    => esc_html__('Typography', 'wpv-bu'),
            'type'     => 'typography',
            'css'      => [
                [
                    'property' => 'font',
                    'selector' => '.bultr-uf-button',
                ],
                [
                    'property' => 'font',
                    'selector' => '.bultr-uf-button i',
                ],
            ],
            'exclude' => ['text-align','color'],

        ];
        // show button border
        $this->controls['btnBorder'] = [
            'tab'      => 'content',
            'group'    => 'unfold_button_style',
            'label'    => esc_html__('Border', 'wpv-bu'),
            'type'     => 'border',
            'inline'   => true,
            'small'    => true,
            'css'      => [
                [
                    'property' => 'border',
                    'selector' => '.bultr-uf-button',
                ],
            ],
            'exclude' => ['color'],
        ];
        
        //Button Icon size
        $this->controls['iconSize'] = [
            'tab'      => 'content',
            'group'    => 'unfold_button_style',
            'label'    => esc_html__('Icon Size', 'wpv-bu'),
            'type'     => 'number',
            'inline'   => true,
            'small'    => true,
            'units'    => true,
            'css'      => [
                [
                    'property' => 'font-size',
                    'selector' => '.bultr-uf-button i::before',
                ],
                [
                    'property' => 'font-size',
                    'selector' => '.bultr-uf-button svg',
                ],
            ],
        ];
        //button icon position
        $this->controls['iconPst'] = [
            'tab'         => 'content',
            'group'       => 'unfold_button_style',
            'label'       => esc_html__('Icon Position', 'wpv-bu'),
            'type'        => 'select',
            'options'     => [
                'left' => esc_html__('Left', 'wpv-bu'),
                'right' => esc_html__('Right', 'wpv-bu'),
            ],
            'inline'      => true,
            'placeholder' => esc_html__('Left', 'wpv-bu'),

        ];
        // Icon gap
        $this->controls['IconGap'] = [
            'tab'         => 'content',
            'group'       => 'unfold_button_style',
            'label'       => esc_html__('Icon Gap', 'wpv-bu'),
            'type'        => 'number',
            'units'        => true,
            'css'         => [
                [
                    'property' => 'gap',
                    'selector' => '.bultr-uf-button',
                ],
            ],
        ];
        //show button style separator
        $this->controls['shwbtnStyleSep'] = [
            'tab'      => 'content',
            'group'    => 'unfold_button_style',
            'label'    => esc_html__('Show Button Style', 'wpv-bu'),
            'type'     => 'separator',
        ];
        // show button color
        $this->controls['shwBtnColor'] = [
            'tab'      => 'content',
            'group'    => 'unfold_button_style',
            'label'    => esc_html__('Color', 'wpv-bu'),
            'type'     => 'color',
            'inline'   => true,
            'small'    => true,
            'css'      => [
                [
                    'property' => 'color',
                    'selector' => '.bultr-uf-btn-show',
                ],
            ],
        ];
        //show Button Icon Color
        $this->controls['shwiconColor'] = [
            'tab'      => 'content',
            'group'    => 'unfold_button_style',
            'label'    => esc_html__('Icon Color', 'wpv-bu'),
            'type'     => 'color',
            'inline'   => true,
            'small'    => true,
            'css'      => [
                [
                    'property' => 'color',
                    'selector' => '.bultr-uf-btn-show i::before',
                ],
                [
                    'property' => 'fill',
                    'selector' => '.bultr-uf-btn-show svg',
                ],
            ],
        ];
        // show button background color
        $this->controls['shwBtnBgColor'] = [
            'tab'      => 'content',
            'group'    => 'unfold_button_style',
            'label'    => esc_html__('Background', 'wpv-bu'),
            'type'     => 'color',
            'inline'   => true,
            'small'    => true,
            'css'      => [
                [
                    'property' => 'background-color',
                    'selector' => '.bultr-uf-btn-show',
                ],
            ],
        ];
        // show button border
        $this->controls['shwBtnBorder'] = [
            'tab'      => 'content',
            'group'    => 'unfold_button_style',
            'label'    => esc_html__('Border Color', 'wpv-bu'),
            'type'     => 'color',
            'inline'   => true,
            'small'    => true,
            'css'      => [
                [
                    'property' => 'border-color',
                    'selector' => '.bultr-uf-btn-show',
                ],
            ],
        ];
        // show button box shadow
        $this->controls['shwBtnBxShdw'] = [
            'tab'      => 'content',
            'group'    => 'unfold_button_style',
            'label'    => esc_html__('Box Shadow', 'wpv-bu'),
            'type'     => 'box-shadow',
            'inline'   => true,
            'small'    => true,
            'css'      => [
                [
                    'property' => 'box-shadow',
                    'selector' => '.bultr-uf-btn-show',
                ],
            ],
        ];
        //hide button style separator
        $this->controls['hidebtnStyleSep'] = [
            'tab'      => 'content',
            'group'    => 'unfold_button_style',
            'label'    => esc_html__('Hide Button Style', 'wpv-bu'),
            'type'     => 'separator',
        ];
        // hide button color
        $this->controls['hideBtnColor'] = [
            'tab'      => 'content',
            'group'    => 'unfold_button_style',
            'label'    => esc_html__('Color', 'wpv-bu'),
            'type'     => 'color',
            'inline'   => true,
            'small'    => true,
            'css'      => [
                [
                    'property' => 'color',
                    'selector' => '.bultr-uf-btn-hide',
                ],
            ],
        ];
         //show Button Icon Color
         $this->controls['hideIconColor'] = [
            'tab'      => 'content',
            'group'    => 'unfold_button_style',
            'label'    => esc_html__('Icon Color', 'wpv-bu'),
            'type'     => 'color',
            'inline'   => true,
            'small'    => true,
            'css'      => [
                [
                    'property' => 'color',
                    'selector' => '.bultr-uf-btn-hide i::before',
                ],
                [
                    'property' => 'fill',
                    'selector' => '.bultr-uf-btn-hide svg',
                ],
            ],
        ];
        // hide button background color
        $this->controls['hideBtnBgColor'] = [
            'tab'      => 'content',
            'group'    => 'unfold_button_style',
            'label'    => esc_html__('Background', 'wpv-bu'),
            'type'     => 'color',
            'inline'   => true,
            'small'    => true,
            'css'      => [
                [
                    'property' => 'background-color',
                    'selector' => '.bultr-uf-btn-hide',
                ],
            ],
        ];
        // hide button border
        $this->controls['hideBtnBorder'] = [
            'tab'      => 'content',
            'group'    => 'unfold_button_style',
            'label'    => esc_html__('Border Color', 'wpv-bu'),
            'type'     => 'color',
            'inline'   => true,
            'small'    => true,
            'css'      => [
                [
                    'property' => 'border-color',
                    'selector' => '.bultr-uf-btn-hide',
                ],
            ],
        ];
        
        // show button box shadow
        $this->controls['hideBtnBxShdw'] = [
            'tab'      => 'content',
            'group'    => 'unfold_button_style',
            'label'    => esc_html__('Box Shadow', 'wpv-bu'),
            'type'     => 'box-shadow',
            'inline'   => true,
            'small'    => true,
            'css'      => [
                [
                    'property' => 'box-shadow',
                    'selector' => '.bultr-uf-btn-hide',
                ],
            ],
        ];
    }
    public function get_nestable_item()
    {
        return [
            'name' => 'block',
            'label' => esc_html__('Content', 'wpv-bu'),
            'settings' => [
            '_rowGap' => '10px',
            '_alignItems' => 'center',
            '_direction' => 'coloum',
            '_justifyContent' => 'space_between',
            '_hidden'         => [
                '_cssClasses' => 'hidden class',
            ],
            ],
            'children' => [
            [
                'name'     => 'heading',
                'settings' => [
                    'text' => esc_html__('I am a heading', 'wpv-bu'),
                    'tag'  => 'h3',
                ],
            ],
            [
                'name'     => 'text',
                'settings' => [
                    'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Magna sit amet purus gravida quis blandit turpis cursus. Nunc consequat interdum varius sit amet mattis. Ullamcorper velit sed ullamcorper morbi tincidunt. Risus sed vulputate odio ut enim. A erat nam at lectus urna duis convallis. Dapibus ultrices in iaculis nunc sed augue. Euismod lacinia at quis risus sed vulputate. Ipsum consequat nisl vel pretium lectus. Libero justo laoreet sit amet cursus sit amet dictum. Vitae suscipit tellus mauris a diam maecenas sed enim ut. Libero id faucibus nisl tincidunt eget.

                    Ullamcorper eget nulla facilisi etiam. Facilisi nullam vehicula ipsum a arcu. Mi eget mauris pharetra et ultrices neque ornare aenean. A erat nam at lectus. Erat velit scelerisque in dictum. Natoque penatibus et magnis dis parturient montes. Rhoncus aenean vel elit scelerisque. Vehicula ipsum a arcu cursus vitae congue mauris rhoncus. Vel facilisis volutpat est velit egestas dui id ornare. Blandit cursus risus at ultrices. Non pulvinar neque laoreet suspendisse interdum consectetur libero. Erat pellentesque adipiscing commodo elit at imperdiet dui. Sagittis aliquam malesuada bibendum arcu. Porttitor eget dolor morbi non arcu risus quis. Venenatis a condimentum vitae sapien pellentesque habitant morbi tristique senectus.', 'wpv-bu'),
                ],
            ],
            ], 
        ];
    }
    public function get_nestable_children()
    {
        $children = [];

        for ($i = 0; $i < 1; $i++) {
            $item = $this->get_nestable_item();

            // Replace {item_index} with $index
            $item       = json_encode($item);
            $item       = str_replace('{item_index}', $i + 1, $item);
            $item       = json_decode($item, true);
            $children[] = $item;
        }

        return $children;
    }

    public function enqueue_scripts()
    {
        wp_enqueue_style('bultr-module-style');
        wp_enqueue_script('bultr-module-script');
    }
    public function render()
    {


        $settings = $this->settings;
        $id      = $this->id;
        $shwicon = !empty($settings['showBtnIcon']) ? $settings['showBtnIcon'] : false;
        $shwicon = self::render_icon($shwicon, []);
        $hideicon = !empty($settings['hideBtnIcon']) ? $settings['hideBtnIcon'] : false;
        $hideicon = self::render_icon($hideicon, []);
        $iconpst = !empty($settings['iconPst']) ? $settings['iconPst'] : 'left';
        $shwButton = !empty($settings['showButton']) ? $settings['showButton'] : null;
        $hideButton = !empty($settings['hideButton']) ? $settings['hideButton'] : null;
        $root_classes = [
            'bultr-uf-wrapper'
        ];
        if (isset($settings['btnPlacement'])) {
            $root_classes[] = 'bultr-uf-btn-plc-' . $this->settings['btnPlacement'];
        }
        //root classes
        $this->set_attribute('_root', 'class', $root_classes);
        //show button
        $this->set_attribute('showbutton', 'class', ['bultr-uf-button', 'bultr-uf-btn-show']);
        $this->set_attribute('showbutton', 'class', 'bultr-uf-icon-pst-' . $iconpst);
        if (isset($settings['isHvr']) && $settings['isHvr'] == true) {
            $this->set_attribute('showbutton', 'class', 'bultr-uf-isHvr');
        }
        //hide button
        $this->set_attribute('hidebutton', 'class', ['bultr-uf-button', 'bultr-uf-btn-hide']);
        $this->set_attribute('hidebutton', 'class', 'bultr-uf-icon-pst-' . $iconpst);
        if (isset($settings['isHvr']) && $settings['isHvr'] == true) {
            $this->set_attribute('hidebutton', 'class', 'bultr-uf-isHvr');
        }

        //render
        $output = "<div {$this->render_attributes('_root')} >";
        $output .= "<div class='bultr-uf-content-wrap' id='bultr-uf-content-wrap' data-ufid = {$id}>";
        $output .= Frontend::render_children($this);

        $output .= "</div>";
        $output .= "<div class='bultr-uf-sep-bg'>";
        if (isset($settings['sept']) && $settings['sept'] == true) {
            $output .= "<div class='bultr-uf-seperator bultr-shadow' id='bultr-shadow'></div>";
        }
        $output .=  "<div class='bultr-uf-button-wrap'>";
        $output .= "<a  {$this->render_attributes('showbutton')}  id='bultr-uf-show' data-id = {$id}>";
        if(empty($settings['showBtnIcon']) && empty($settings['showButton'])){
            $output .= trim(esc_html__("Show More",'wpv-bu'));
        }
        else{
            $output .= $shwicon;
            $output .= trim($shwButton);
        }
        $output .= "</a>";
        $output .= "<a {$this->render_attributes('hidebutton')}  id='bultr-uf-hide' data-id = {$id}>";
        if(empty($settings['hideBtnIcon']) && empty($settings['hideButton'])){
            $output .= trim(esc_html__("Show less",'wpv-bu'));
        }
        else{
            $output .= $hideicon;
            $output .= trim($hideButton);
        }
        $output .= "</a>";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";
        echo $output;
    }
    public static function render_builder()
    {
?>
        <script type="text/x-template" id="tmpl-bricks-element-wpvbu-unfold">
           
            <div :class="['bultr-uf-wrapper',
            settings.btnPlacement? `bultr-uf-btn-plc-${settings.btnPlacement}` : null,
            ]">
                <div :class="['bultr-uf-content-wrap',
                settings.expand ? 'bultr-uf-expand': null,
                settings.expand === true ? 'bultr-uf-open' : 'bultr-uf-close',

                ]" :id="['bultr-uf-content-wrap']">
                    <bricks-element-children :element="element" />
                </div>
                <div :class="['bultr-uf-sep-bg']">
                    <div v-if="settings.sept" :class="['bultr-uf-seperator', 'bultr-shadow']" :id="['bultr-shadow']"></div>
                    <div :class="['bultr-uf-button-wrap']">
                        <a :class="[
                            'bultr-uf-button', 
                            'bultr-uf-btn-show' ,
                            settings.iconPst ? `bultr-uf-icon-pst-${settings.iconPst}` : 'bultr-uf-icon-pst-left',
                            settings.isHvr ? `bultr-uf-isHvr` : null,
                            ]" :id="['bultr-uf-show']">
                            <icon-svg v-if=" settings?.showBtnIcon?.icon || settings?.showBtnIcon?.svg" :iconSettings="settings.showBtnIcon " />
                            <span v-if="settings.showButton">{{settings['showButton']}}</span>
                            <span v-if = "!settings.showButton && ( !settings?.showBtnIcon?.icon && !settings?.showBtnIcon?.svg)">Show More</span>
                        
                            
                        </a>
                        <a :class="[
                            'bultr-uf-button',
                            'bultr-uf-btn-hide',
                            settings.iconPst ? `bultr-uf-icon-pst-${settings.iconPst}` : 'bultr-uf-icon-pst-left',
                            settings.isHvr ? `bultr-uf-isHvr` : null,
                            ]" :id="['bultr-uf-hide']">
                            <icon-svg v-if=" settings?.hideBtnIcon?.icon || settings?.hideBtnIcon?.svg" :iconSettings="settings.hideBtnIcon " />
                            <span v-if="settings.hideButton">{{settings['hideButton']}}</span>
                            <span v-if = "!settings.hideButton && (!settings?.hideBtnIcon?.icon && !settings?.hideBtnIcon?.svg)">Show Less</span>
                        </a>
                    </div>
                </div>
            </div>

        </script>
<?php
    }
}
