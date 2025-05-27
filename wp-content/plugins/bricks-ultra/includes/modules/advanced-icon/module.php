<?php

namespace BricksUltra\includes\AdvancedIcon;

use Bricks\Element;

class Module extends Element
{
    public $category     = 'ultra';
    public $name         = 'wpvbu-advanced-icon';
    public $icon         = 'fas fa-star';
    public $css_selector = '';
    public $scripts      = '';
    public $loop_index   = 0;
    public function get_label()
    {
        return esc_html__('Advanced Icon', 'wpv-bu');
    }
    public function get_keywords()
    {
        return ['icon', 'icon-box', 'framed', 'stacked'];
    }

    public function set_control_groups()
    {
        $this->control_groups['icon_content'] = [
            'title' => esc_html__('Icon', 'wpv-bu'),
            'tab'   => 'content',
        ];
        $this->control_groups['icon_style'] = [
            'title' => esc_html__('Style', 'wpv-bu'),
            'tab'   => 'content',
        ];
    }

    public function set_controls()
    {

        $this->controls['icons'] = [
            'tab'     => 'content',
            'group'   => 'icon_content',
            'label'   => __('Icon', 'wpv-bu'),
            'type'    => 'icon',
            'default' => [
                'library' => 'fontawesome',
                'icon' => 'fas fa-star'
            ],
            'root'     => true,
        ];
        $this->controls['view'] = [
            'tab'         => 'content',
            'group'       => 'icon_content',
            'label'       => esc_html__('View', 'wpv-bu'),
            'type'        => 'select',
            'options'     => [
                'default' => esc_html__('Default', 'wpv-bu'),
                'stacked' => esc_html__('Stacked', 'wpv-bu'),
                'framed'  => esc_html__('Framed', 'wpv-bu'),
            ],
            'default'     => __('default','wpv-bu'),
            'inline'      => true,
            'rerender'    => true,
            'placeholder' => esc_html__('Default', 'wpv-bu'),
        ];
        $this->controls['shape'] = [
            'tab'         => 'content',
            'group'       => 'icon_content',
            'label'       => esc_html__('Shape', 'wpv-bu'),
            'type'        => 'select',
            'options'     => [
                'square' => esc_html__('Square', 'wpv-bu'),
                'circle' => esc_html__('Circle', 'wpv-bu'),
            ],
            'required' => [
                ['view', '!=', ['default', '']],
            ],
            'inline' => true,
        ];

        $this->controls['link'] = [
            'tab'   => 'content',
            'group' => 'icon_content',
            'label' => esc_html__('Link to', 'wpv-bu'),
            'type'  => 'link',
        ];
        $this->controls['iconalignment'] = [
            'tab'       => 'content',
            'group'     => 'icon_content',
            'label'     => esc_html__('Alignment', 'wpv-bu'),
            'type'      => 'align-items',
            'exclude' => 'stretch',
            'css'   => [
                [
                    'property'  => 'align-self',
                    'selector' => '',
                ]
            ],
            'default' => '',
            'inline'    => true,
            'clearable' => true,
            'placeholder' => esc_html__('left', 'wpv-bu'),
        ];
        $this->controls['iconColorPrimary'] = [
            'tab'       => 'content',
            'group'     => 'icon_style',
            'label'     => esc_html__('Primary Color', 'wpv-bu'),
            'type'      => 'color',
            'css'       => [
                [
                    'property' => 'color',
                    'selector' => '&.bultr-ai-wrapper:not(.bultr-icon-view-stacked) i',

                ],
                [
                    'property' => 'fill',
                    'selector' => '&.bultr-ai-wrapper:not(.bultr-icon-view-stacked) svg',

                ],

                [
                    'property' => 'background-color',
                    'selector' => '&.bultr-icon-view-stacked ',
                ],
                [
                    'property' => 'border-color',
                    'selector' => '&.bultr-icon-view-framed',
                ],
                [
                    'property' => 'color',
                    'selector' => '&.bultr-ai-wrapper.bultr-icon-view-framed i',
                ],
                [
                    'property' => 'fill',
                    'selector' => '&.bultr-ai-wrapper.bultr-icon-view-framed svg',
                ],
            ],


        ];
        $this->controls['iconColorSecondary'] = [
            'tab'       => 'content',
            'group'     => 'icon_style',
            'label'     => esc_html__('Secondary Color', 'wpv-bu'),
            'type'      => 'color',
            'css'       => [

                [
                    'property' => 'background-color',
                    'selector' => '&.bultr-icon-view-framed',
                ],
                [
                    'property' => 'border-color',
                    'selector' => '&.bultr-icon-view-stacked',
                ],
                [
                    'property' => 'color',
                    'selector' => '&.bultr-icon-view-stacked.bultr-ai-wrapper i',
                ],
                [
                    'property' => 'fill',
                    'selector' => '&.bultr-icon-view-stacked.bultr-ai-wrapper svg',
                ],
            ],
            'required' => [
                ['view', '!=', ['default', '']],
            ],
            'inline' => true,
        ];
        $this->controls['iconSize'] = [
            'tab'       => 'content',
            'group'     => 'icon_style',
            'label'     => esc_html__('Size', 'wpv-bu'),
            'type'      => 'number',
            'units'      => true,
            'css'       => [
                [
                    'property' => 'font-size',
                    'selector' => '&.bultr-ai-wrapper i',
                ],
                [
                    'property' => 'font-size',
                    'selector' => '&.bultr-ai-wrapper svg',
                ],
            ],

        ];
        $this->controls['iconPadding'] = [
            'tab' => 'content',
            'group' => 'icon_style',
            'label' => esc_html__('Padding', 'wpv-bu'),
            'type' => 'dimensions',
            'defautl' => '10',
            'css' => [
                [
                    'property' => 'padding',
                    'selector' => '&.bultr-icon-view-framed',
                ],
                [
                    'property' => 'padding',
                    'selector' => '&.bultr-icon-view-stacked',
                ],

            ],
            'required' => [
                ['view', '!=', ['default', '']],
            ],
        ];
        $this->controls['iconBorder'] = [
            'tab'       => 'content',
            'group'     => 'icon_style',
            'label'     => esc_html__('Border', 'wpv-bu'),
            'type' => 'border',
            'css' => [

                [
                    'property' => 'border',
                    'selector' => '&.bultr-icon-view-framed',
                ],
            ],
            'inline' => true,
            'small' => true,
            'required' => [
                ['view', '!=', ['', 'default', 'stacked']],
            ],

        ];
        //border radius only for stacked
        $this->controls['iconBorderRds'] = [
            'tab'       => 'content',
            'group'     => 'icon_style',
            'label'     => esc_html__('Box Radius', 'wpv-bu'),
            'type' => 'border',
            'css' => [

                [
                    'property' => 'border-radius',
                    'selector' => '&:not(.bultr-icon-shape-circle)',
                ],

            ],
            'exclude' => [
                'width',
                'style',
                'color',
            ],
            'inline' => true,
            'small' => true,
            'required' => [
                ['view', '=', 'stacked'],
            ],

        ];
        $this->controls['iconBoxShadow'] = [
            'tab' => 'content',
            'group' => 'icon_style',
            'label' => esc_html__('Box Shadow', 'wpv-bu'),
            'type' => 'box-shadow',
            'inline' => true,
            'css' => [
                [
                    'property' => 'box-shadow',
                    'selector' => '&.bultr-ai-wrapper.bultr-icon-view-stacked',
                ],
                [
                    'property' => 'box-shadow',
                    'selector' => '&.bultr-ai-wrapper.bultr-icon-view-framed',
                ],
            ],
            'required' => [
                ['view', '!=', ['default', '']],
            ],

        ];
        $this->controls['iconTextShadow'] = [
            'tab' => 'content',
            'group' => 'icon_style',
            'label' => esc_html__('Icon Shadow', 'wpv-bu'),
            'type' => 'typography',
            'css' => [
                [
                    'property' => 'font',
                    'selector' => '&.bultr-ai-wrapper i',
                ],
            ],
            'exclude' => [
                'font-family',
                'font-weight',
                'text-align',
                'text-transform',
                'font-size',
                'line-height',
                'letter-spacing',
                'color',
                'font-variation-settings',
                'text-decoration',
                'font-style',
            ],
            'inline' => true,

        ];
        $this->controls['iconRotate'] = [
            'tab' => 'content',
            'group' => 'icon_style',
            'label' => esc_html__('Rotate', 'wpv-bu'),
            'type' => 'number',
            'info' => __('Give units in deg. e.g. : \'20deg \' ','wpv-bu'),
            'min'   => 1,
            'max'   => 1000,
            'step'  => 1,
            'css' => [

                [
                    'property' => 'transform',
                    'selector' => '&.bultr-ai-wrapper i',
                    'value'   => 'rotate(%s)',
                ],
                [
                    'property' => 'transform',
                    'selector' => '&.bultr-ai-wrapper svg',
                    'value'   => 'rotate(%s)',
                ],

            ],
            'placeholder' => '20deg',
        ];
        $this->controls['iconSeparator'] = [
            'tab'      => 'content',
            'group'    => 'icon_style',
            'label'    => esc_html__('Hover', 'wpv-bu'),
            'type'     => 'separator',

        ];
        $this->controls['iconHover'] = [
            'tab' => 'content',
            'group' => 'icon_style',
            'label' => esc_html__('Hover', 'wpv-bu'),
            'type' => 'checkbox',
            'inline' => true,
            'small' => true,
            'clearable' => true,
        ];

        $this->controls['iconColorPrimaryHvr'] = [
            'tab'       => 'content',
            'group'     => 'icon_style',
            'label'     => esc_html__('Primary Color', 'wpv-bu'),
            'type'      => 'color',
            'css'       => [
                [
                    'property' => 'color',
                    'selector' => '&.bultr-is-hvr.bultr-ai-wrapper:not(.bultr-icon-view-stacked):hover i',
                ],
                [
                    'property' => 'fill',
                    'selector' => '&.bultr-is-hvr.bultr-ai-wrapper:not(.bultr-icon-view-stacked):hover svg',
                ],
                [
                    'property' => 'background-color',
                    'selector' => '&.bultr-is-hvr.bultr-icon-view-stacked:hover',
                ],
                [
                    'property' => 'border-color',
                    'selector' => '&.bultr-is-hvr.bultr-icon-view-framed:hover',
                ],
                [
                    'property' => 'color',
                    'selector' => '&.bultr-is-hvr.bultr-icon-view-framed:hover i ',
                ],
                [
                    'property' => 'fill',
                    'selector' => '&.bultr-is-hvr.bultr-icon-view-framed:hover svg ',
                ],

            ],
            'required' => ['iconHover', '=', true],


        ];
        $this->controls['iconColorSecondaryHvr'] = [
            'tab'       => 'content',
            'group'     => 'icon_style',
            'label'     => esc_html__('Secondary Color', 'wpv-bu'),
            'type'      => 'color',
            'css'       => [

                [
                    'property' => 'background-color',
                    'selector' => '&.bultr-is-hvr.bultr-icon-view-framed:hover',
                ],

                [
                    'property' => 'color',
                    'selector' => '&.bultr-is-hvr.bultr-ai-wrapper:hover.bultr-icon-view-stacked i',
                ],
                [
                    'property' => 'fill',
                    'selector' => '&.bultr-is-hvr.bultr-ai-wrapper:hover.bultr-icon-view-stacked svg',
                ],


            ],
            'required' => [
                ['iconHover', '=', true],
                ['view', '!=', 'default'],
            ],

        ];
        $this->controls['iconBorderHvr'] = [
            'tab'       => 'content',
            'group'     => 'icon_style',
            'label'     => esc_html__('Border', 'wpv-bu'),
            'type' => 'border',
            'css' => [
                [
                    'property' => 'border',
                    'selector' => '&.bultr-is-hvr.bultr-icon-view-framed:hover',
                ],

            ],
            'inline' => true,
            'small' => true,
            'required' => [
                ['iconHover', '=', true],
                ['view', '!=', ['default', 'stacked']],
            ],

        ];

        $this->controls['iconBoxShadowHvr'] = [
            'tab' => 'content',
            'group' => 'icon_style',
            'label' => esc_html__('Box Shadow', 'wpv-bu'),
            'type' => 'box-shadow',
            'inline' => true,
            'css' => [
                [
                    'property' => 'box-shadow',
                    'selector' => '&.bultr-is-hvr.bultr-icon-view-stacked:hover',
                ],
                [
                    'property' => 'box-shadow',
                    'selector' => '&.bultr-is-hvr.bultr-icon-view-framed:hover',
                ],
            ],
            'required' => [
                ['iconHover', '=', true],
                ['view', '!=', 'default'],
            ],

        ];
        $this->controls['iconTextShdHvr'] = [
            'tab' => 'content',
            'group' => 'icon_style',
            'label' => esc_html__('Icon Shadow', 'wpv-bu'),
            'type' => 'typography',
            'inline' => true,
            'css' => [
                [
                    'property' => 'font',
                    'selector' => '&.bultr-is-hvr.bultr-ai-wrapper:hover i',
                ],
            ],
            'exclude' => [
                'font-family',
                'font-weight',
                'text-align',
                'text-transform',
                'font-size',
                'line-height',
                'letter-spacing',
                'color',
                'font-variation-settings',
                'text-decoration',
                'font-style',
            ],
            'required' => [
                ['iconHover', '=', true],
            ],
        ];

        $this->controls['iconTransformHvr'] = [
            'tab' => 'content',
            'group' => 'icon_style',
            'label' => esc_html__('Transform', 'wpv-bu'),
            'type' => 'transform',
            'css' => [
                [
                    'property' => 'transform',
                    'selector' => '&.bultr-is-hvr.bultr-ai-wrapper:hover',
                ],
            ],
            'required' => ['iconHover', '=', true],
        ];
        $this->controls['iconHoverTrans'] = [
            'tab' => 'content',
            'group' => 'icon_style',
            'label' => esc_html__('Transition Duration', 'wpv-bu'),
            'type' => 'number',
            'units' => ['s', 'ms'],
            'css' => [
                [
                    'property' => 'transition-duration',
                    'selector' => '&.bultr-is-hvr.bultr-ai-wrapper:hover',
                ],
            ],
            'small' => true,
            'inline' => true,
            'required' => ['iconHover', '=', true],
        ];

        $this->controls['iconHoverAnim'] = [
            'tab' => 'content',
            'group' => 'icon_style',
            'label' => esc_html__('Hover Animation', 'wpv-bu'),
            'type' => 'select',
            'options' => [
                'grow' => esc_html__('Grow', 'wpv-bu'),
                'shrink' => esc_html__('Shrink', 'wpv-bu'),
                'pulse' => esc_html__('Pulse', 'wpv-bu'),
                'pulse-grow' => esc_html__('Pulse Grow', 'wpv-bu'),
                'pulse-shrink' => esc_html__('Pulse Shrink', 'wpv-bu'),
                'push' => esc_html__('Push', 'wpv-bu'),
                'pop' => esc_html__('Pop', 'wpv-bu'),
                'bounce-in' => esc_html__('Bounce In', 'wpv-bu'),
                'bounce-out' => esc_html__('Bounce Out', 'wpv-bu'),
                'rotate' => esc_html__('Rotate', 'wpv-bu'),
                'grow-rotate' => esc_html__('Grow Rotate', 'wpv-bu'),
                'float' => esc_html__('Float', 'wpv-bu'),
                'sink' => esc_html__('Sink', 'wpv-bu'),
                'bob' => esc_html__('Bob', 'wpv-bu'),
                'hang' => esc_html__('Hang', 'wpv-bu'),
                'skew' => esc_html__('Skew', 'wpv-bu'),
                'skew-forward' => esc_html__('Skew Forward', 'wpv-bu'),
                'skew-backward' => esc_html__('Skew Backward', 'wpv-bu'),
                'wobble-vertical' => esc_html__('Wobble Vertcal', 'wpv-bu'),
                'wobble-horizontal' => esc_html__('Wobble Horizontal', 'wpv-bu'),
                'wobble-bottom-right' => esc_html__('Wobble To Bottom Right', 'wpv-bu'),
                'wobble-top-right' => esc_html__('Wobble To Top Right', 'wpv-bu'),
                'wobble-top' => esc_html__('Wobble Top', 'wpv-bu'),
                'wobble-bottom' => esc_html__('wobble Bottom', 'wpv-bu'),
                'wobble-skew' => esc_html__('Wobble Skew', 'wpv-bu'),
                'buzz' => esc_html__('Buzz', 'wpv-bu'),
                'buzz-out' => esc_html__('Buzz Out', 'wpv-bu'),
            ],
            'css' => [
                [
                    'property' => 'transform',
                    'selector' => '&.bultr-anim-grow',
                    'value' => 'scale(%s)',
                ],
            ],
            'inline' => true,
            'placeholder' => esc_html__('Select', 'wpv-bu'),
            'required' => ['iconHover', '=', true],
        ];
        $this->controls['iconAnimt'] = [
            'tab'   => 'content',
            'group' => 'icon_style',
            'label' => esc_html__('Animation direction', 'wpv-bu'),
            'type'  => 'select',
            'options' => [
                'fromright' => esc_html__('From Right To Left', 'wpv-bu'),
                'fromleft' => esc_html__('From Left To Right', 'wpv-bu'),
                'fromtop' => esc_html__('From Top To Bottom', 'wpv-bu'),
                'frombottom' => esc_html__('From Bottom To Top', 'wpv-bu'),
            ],

            'inline' => true,
            'required' => [
                ['iconHover', '=', true],

            ],
        ];
    }

    public function enqueue_scripts()
    {
        wp_enqueue_style('bultr-module-style');
        wp_enqueue_script('bultr-module-script');
    }

    public function render()
    {
        $settings = $this->settings;
        if (!empty($settings['link'])) {
            $this->set_link_attributes('link', $settings['link']);
        }
        $link = !empty($settings['link']) ? $settings['link'] : false;
        $icon = isset($settings['icons']) ? $settings['icons'] : false;
        if (!$icon) {
            return $this->render_element_placeholder(
				[
					'title' => esc_html__( 'No Icon Selected.', 'wpv-bu' ),
				]
			);
        }
        $icon = self::render_icon($icon, []);
        $root_classes = [
            'bultr-ai-wrapper'
        ];

        if (isset($this->settings['iconHover']) && $this->settings['iconHover'] ==  true) {
            $root_classes[] = 'bultr-is-hvr';
        }

        if (isset($this->settings['view'])) {
            $root_classes[] = 'bultr-icon-view-' . $this->settings['view'];
            $this->set_attribute('_root', 'data-view', $this->settings['view']);
        }

        if (isset($this->settings['shape']) && $this->settings['view'] != 'default') {
            $root_classes[] = 'bultr-icon-shape-' . $this->settings['shape'];
            $this->set_attribute('_root', 'data-shape', $this->settings['shape']);
        }
        $is_hvr = $this->settings['iconHover'] ?? false;
        if (isset($this->settings['iconHoverAnim']) && $is_hvr == true) {
            $root_classes[] = 'bultr-icon-anim-' . $this->settings['iconHoverAnim'];
        }
        if (isset($this->settings['iconAnimt']) && $is_hvr == true) {
            $root_classes[] = 'bultr-icon-' . $this->settings['iconAnimt'];
        }
        $this->set_attribute('_root', 'class', $root_classes);
        $output = '';

        $output .=  "<div {$this->render_attributes('_root')}>";
        $output .= $this->defaultLayout($link, $icon);
        $output .= "</div>";
        echo $output;
    }
    public function defaultLayout($link, $icon)
    {   $output = '';
        if(!empty($icon)){
            if ($link) {
                $output .= "<a {$this->render_attributes('link')}>".$icon."</a>";
            } else {
                $output .= $icon;
            }
        }
        return $output;
        
    }
    public static function render_builder()
    {
    ?>
        <script type="text/x-template" id="tmpl-bricks-element-wpvbu-advanced-icon">
            <div :class="[
                'bultr-ai-wrapper',
                settings.view? `bultr-icon-view-${settings.view}` : null,
                settings.view !== 'default' ? settings.shape ? `bultr-icon-shape-${settings.shape}` : null : null,
                settings.iconalignment ? settings.iconalignment : null,
                settings.iconHover ? 'bultr-is-hvr' :null,
                settings.iconHoverAnim ? `bultr-icon-anim-${settings.iconHoverAnim}` : null,
                settings.iconAnimt ? `bultr-icon-${settings.iconAnimt}`: null,
                ]" v-if=" settings?.icons?.icon || settings?.icons?.svg">
                <a v-if="settings.link">
                    <icon-svg v-if=" settings?.icons?.icon || settings?.icons?.svg" :iconSettings="settings.icons " />
                </a>
                <icon-svg v-else v-if=" settings?.icons?.icon || settings?.icons?.svg" :iconSettings="settings.icons " />
                
            </div>
            <div v-else v-html="renderElementPlaceholder()"></div>
        </script>
<?php
    }
}
?>