<?php

namespace BricksUltra\includes\FlipBoxNested;

use Bricks\Element;
use Bricks\Frontend;


class Module extends Element
{
    public $category     = 'ultra';
    public $name         = 'wpvbu-flip-box-nested';
    public $icon         = 'ti-layers';
    public $css_selector = '';
    public $nestable     = true;

    public function get_label()
    {
        return esc_html__('Flip Box (Nestable)', 'wpv-bu');
    }
    public function get_keywords()
    {
        return ['flipbox', 'flipbox-nestable', 'nestable', 'flip-box', 'flip-box-nestable', 'nested'];
    }
    // Enqueue element styles and scripts
    public function enqueue_scripts()
    {
        wp_enqueue_style('bultr-module-style');
    }
    public function set_controls()
    {
        $this->controls['animtStyle'] = [
            'tab' => 'content',
            'label' => esc_html__('Animantion Style', 'wpv-bu'),
            'type' => 'select',
            'options' => [
                'flip-hrz'  => esc_html__('Flip Horizontal', 'wpv-bu'),
                'flip-vert' => esc_html__('Flip Vertical', 'wpv-bu'),
                'flip-box' => esc_html__('Flip Box', 'wpv-bu'),
                'fade'      => esc_html__('Fade', 'wpv-bu'),
                'flip-box-fade' => esc_html__('Flip Box Fade', 'wpv-bu'),
                'fade-up' => esc_html__('Fade Up', 'wpv-bu'),
                'top-down'  => esc_html__('Cube - Top Down', 'wpv-bu'),
                'down-top'  => esc_html__('Cube - Down Top', 'wpv-bu'),
            ],
            'inline' => true,
            'small' => true,
            'placeholder' => esc_html__('Flip Vertical', 'wpv-bu'),
        ];
        $this->controls['trnsDrtn'] = [
            'tab' => 'content',
            'label' => esc_html__('Transition Duration', 'wpv-bu'),
            'type' => 'number',
            'units' => true,
            'css' => [
                [
                    'property' => 'transition-duration',
                    'selector' => '.bultr-fbn-inner',

                ],
                [
                    'property' => 'transition-duration',
                    'selector' => '.bultr-fbn-front-wrap',

                ],
                [
                    'property' => 'transition-duration',
                    'selector' => '.bultr-fbn-back-wrap',

                ],
            ],

        ];
        $this->controls['height'] = [
            'tab' => 'content',
            'label' => esc_html__('Height', 'wpv-bu'),
            'type' => 'number',
            'units' => true,
            'css' => [
                [
                    'selector' => '.bultr-fbn-inner',
                    'property' => '--bultrheight',

                ],
            ]

        ];
        $this->controls['flipEditor'] = [
            'tab' => 'content',
            'label' => esc_html__('Flip Off(in editor)', 'wpv-bu'),
            'type' => 'checkbox',
            'inline' => true,
            'small' => true,
        ];
        $this->controls['showBack'] = [
            'tab' => 'content',
            'label' => esc_html__('Show Back Card', 'wpv-bu'),
            'type' => 'checkbox',
            'inline' => true,
            'small' => true,
            'required' => ['flipEditor', '=', true],
        ];
        $this->controls['fNnotice'] = [
            'tab' => 'content',
            'content' => esc_html__('Don\'t delete the Front and Back elements. These elements are necessary for the functionality of  Nested Flip box. Please add preferred elements under these elements.','wpv-bu'),
            'type' => 'info',
            
        ];
    }
    public function get_nestable_item()
    {
        return [
            'name'     => 'block',
            'label'    => esc_html__('Content', 'wpv-bu') ,
            'settings' => [
                '_alignItems'     => 'center',
                '_direction'      => 'column',
                '_justifyContent' => 'center',
                '_hidden'         => [
                    '_cssClasses' => 'bultr-fbn-inner',
                ],
            ],
            'children' => [
                [
                    'name'     => 'block',
                    'label'    => esc_html__('Front', 'wpv-bu'),
                    'settings' => [
                        '_rowGap'         => '20px',
                        '_alignItems'     => 'center',
                        '_direction'      => 'column',
                        '_justifyContent' => 'center',
                        '_padding'        => '20px',
                        '_hidden'         => [
                            '_cssClasses' => 'bultr-fbn-front-wrap',
                        ],
                    ],
                    'children' => [
                        [
                            'name'     => 'icon',
                            'settings' => [
                                'icon'     => [
                                    'icon'    => 'ion-ios-star',
                                    'library' => 'ionicons',
                                ],
                                'iconSize' => '3em',
                            ],
                        ],
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
                                'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Est ante in nibh mauris cursus mattis molestie a.','wpv-bu'),
                            ],
                        ],
                    ],
                ],
                [
                    'name'     => 'block',
                    'label'    => esc_html__('Back', 'wpv-bu'),
                    'settings' => [
                        '_rowGap'         => '20px',
                        '_alignItems'     => 'center',
                        '_direction'      => 'column',
                        '_justifyContent' => 'center',
                        '_padding'        => '20px',
                        '_hidden'         => [
                            '_cssClasses' => 'bultr-fbn-back-wrap',
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
                                'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Est ante in nibh mauris cursus mattis molestie a.','wpv-bu'),
                            ],
                        ],
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
    public function render()
    {
        $settings = $this->settings;

        $root_classes = [
            'bultr-fbn-wrapper',
        ];
        if (isset($settings['animtStyle'])) {
            $root_classes[] = 'bultr-animt-' . $this->settings['animtStyle'];
        } else {
            $root_classes[] = 'bultr-animt-flip-hrz';
        }
        $this->set_attribute('_root', 'class', $root_classes);

        $output = "<div {$this->render_attributes('_root')}>";
        $output .= Frontend::render_children($this);
        $output .= "</div>";
        echo $output;
    }
    public static function render_builder()
    {
?>
        <script type="text/x-template" id="tmpl-bricks-element-wpvbu-flip-box-nested">
            
            <div :class="['bultr-fbn-wrapper',
            settings.flipEditor ? 'bultr-fbn-editor' : null,
            !settings.flipEditor ? settings.animtStyle ? `bultr-animt-${settings.animtStyle}`: 'bultr-animt-flip-hrz' : null,
            settings.showBack ? 'bultr-fbn-back-show': null,
            
            
            ]">
                <bricks-element-children :element="element" />
            </div>

        </script>
<?php
    }
}
