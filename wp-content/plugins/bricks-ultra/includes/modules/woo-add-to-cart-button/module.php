<?php
namespace BricksUltra\Modules\WooAddToCartButton;

use Bricks\Element;

class Module extends Element {
    public $category        = 'ultra';
    public $name            = 'wpvbu-woo-add-to-cart-button';
    public $icon            = 'fas fa-cart-plus';
    public $scripts         = ['add_to_cart_button'];
    public $css_selector    = '';

   
    public function get_label() {
        return esc_html__('Woo Add to Cart', 'wpv-bu');
    }

    public function get_keywords() {
        return ['woo-add-to-cart', 'woocommerce', 'add-to-cart', 'button'];
    }

    public function enqueue_scripts() {

        wp_enqueue_style( 'bultr-module-style' );
		wp_enqueue_script( 'bultr-module-script' );
    }
    

    public function set_control_groups() {

        $this->control_groups['stock_layout'] = [
            'title'     => esc_html__('Stock', 'wpv-bu'),
            'tab'       => 'content',
        ];
        $this->control_groups['button_style'] = [
            'title'     => esc_html__('Add to Cart Button Style', 'wpv-bu'),
            'tab'       => 'content',
        ];
        $this->control_groups['view_cart_button_style'] = [
            'title'     => esc_html__('View Cart Button Style', 'wpv-bu'),
            'tab'       => 'content',
            'required'  => ['redirect_add_to_cart', '=',  'stay'],
        ];
        $this->control_groups['qty_style'] = [
            'title'     => esc_html__('Quantity Style', 'wpv-bu'),
            'tab'       => 'content',
            'required'  => ['hide_quantity_field', '=', false],
        ];
        $this->control_groups['stock_style'] = [
            'title'     => esc_html__('Stock Style', 'wpv-bu'),
            'tab'       => 'content',
            'required'  => ['stock_status_type', '!=', 'none'],
        ];
    }

    public function set_controls() {

        $this->controls['product'] = [
            'tab'         => 'content',
            'type'        => 'select',
            'label'         => esc_html__('Select Product', 'wpv-bu'),
            'optionsAjax' => [
                'action'   => 'bu_get_single_product',
            ],
            'multiple'    => false,
            'searchable'  => true,
        ];
        $this->controls['button_text'] = array(
            'tab'           => 'content',
            'label'         => esc_html__('Button Text', 'wpv-bu'),
            'type'          => 'text',
            'placeholder'   => esc_html__('Add to Cart', 'wpv-bu'),
        );
        $this->controls['redirect_add_to_cart']=[
            'tab'           => 'content',
            'label'         => esc_html__('After Add to Cart Action', 'wpv-bu'),
            'type'          => 'select',
            'options'       => [
                'stay'      => esc_html__('Stay Here', 'wpv-bu'),
                'cart'      => esc_html__('Redirect to Cart', 'wpv-bu'),
                'checkout'  => esc_html__('Redirect to Checkout', 'wpv-bu'),
            ],
            'default'       => 'stay',
            'clearable'     => false,

        ];
        $this->controls['preview_view_cart'] = array(
            'tab'           => 'content',
            'label'         => esc_html__('Preview View Cart', 'wpv-bu'),
            'type'          => 'checkbox',
            'default'       => false,
            'rerender'      => true,
            'info'          =>__('Enable to preview "View Cart" Button in editor.','wpv-bu'),
            'required'      => ['redirect_add_to_cart', '=', 'stay'],
        );
        $this->controls['view_cart_text'] = array(
            'tab'           => 'content',
            'label'         => esc_html__('View Cart Text', 'wpv-bu'),
            'type'          => 'text',
            'default'       => esc_html__('View Cart', 'wpv-bu'),
            'required'      => ['redirect_add_to_cart', '=', 'stay'],
        );
        $this->controls['hide_quantity_field'] = [
            'tab'           => 'content',
            'label'         => esc_html__('Hide Quantity Field', 'wpv-bu'),
            'type'          => 'checkbox',
            'default'       => false,

        ];
        $this->controls['hide_fields'] = [
            'tab'           => 'content',
            'label'         => esc_html__('Hide Fields', 'wpv-bu'),
            'type'          => 'checkbox',
            'default'       => false,
            'description'   => esc_html__('When the "Add to Cart" button is clicked, the Quantity field and the Add to Cart button will hide.', 'wpv-bu'),
        ];
         
        $this->stock();
        $this->button_style();
        $this->view_cart_button_style();
        $this->quantity_style();
        $this->stock_style();
    }
    
    
    public function stock(){
        $this->controls['stock_status_type'] = [
            'tab'           => 'content',
            'group'         => 'stock_layout',
            'label'         => esc_html__('Stock Status', 'wpv-bu'),
            'type'          => 'select',
            
            'options'       => [
                'none'      => esc_html__('None', 'wpv-bu'),
                'default'   => esc_html__('Default', 'wpv-bu'),
                'custom'    => esc_html__('Custom', 'wpv-bu'),
            ],
            'default'       => 'none',
            'clearable'     => false,
        ];
        $this->controls['in_stock'] = [
            'tab'           => 'content',
            'group'         => 'stock_layout',
            'label'         => esc_html__( 'In Stock Message', 'wpv-bu' ),
            'type'          => 'separator',
            'required'      => ['stock_status_type', '=', 'custom'],
        ]; 
        $this->controls['in_stock_text'] = [
            'tab'           => 'content',
            'group'         => 'stock_layout',
            'label'         => esc_html__('In Stock', 'wpv-bu'),
            'type'          => 'text',
            'placeholder'   => esc_html__('In Stock', 'wpv-bu'),
            'default'       => esc_html__('In Stock', 'wpv-bu'),
            'description'   => __('To get dynamic Quantity add {{qty}}', 'wpv-bu'),
            'required'      => [
                                ['stock_status_type', '=', 'custom'],
                                ],
        
        ];
        $this->controls['in_stock_icon'] = [
            'tab'           => 'content',
            'group'         => 'stock_layout',
            'label'         => esc_html__('In Stock Icon', 'wpv-bu'),
            'type'          => 'icon',
            'required'      => [
                                ['stock_status_type', '=', 'custom'],
                                ['in_stock_text', '!=', '']],
            
        ];
        $this->controls['in_stock_icon_position'] =[
            'tab'           => 'content',
            'group'         => 'stock_layout',
            'label'         => esc_html__('Icon Position', 'wpv-bu'),
            'type'          => 'select',
            'options'       => [
                    'left'  => esc_html__('Left', 'wpv-bu'),
                    'right' => esc_html__('Right', 'wpv-bu'),
                                ],
            'required'      => [['stock_status_type', '=', 'custom'],
                                ['in_stock_text', '!=', '']],
        ];
    
        $this->controls['out_stock']=[
            'tab'           => 'content',
            'group'         => 'stock_layout',
            'label'         => esc_html__('Out Of Stock Message', 'wpv-bu'),
            'type'          => 'separator',
            'required'      => ['stock_status_type', '=', 'custom'],
        ];
        $this->controls['out_stock_text'] = [
            'tab'           => 'content',
            'group'         => 'stock_layout',
            'label'         => esc_html__('Out Of Stock', 'wpv-bu'),
            'type'          => 'text',
            'default'       => esc_html__('Out Of Stock', 'wpv-bu'),
            'placeholder'   => esc_html__('Out Of Stock', 'wpv-bu'),
            'required'      =>[ ['stock_status_type', '=', 'custom'],],
        ];
        $this->controls['out_stock_icon'] = [
            'tab'           => 'content',
            'group'         => 'stock_layout',
            'label'         => esc_html__('Out Of Stock Icon', 'wpv-bu'),
            'type'          => 'icon',
            'required'      => [['stock_status_type', '=', 'custom'],
                                ['out_stock_text', '!=', '']],    
        ];
        $this->controls['out_stock_icon_position'] =[
            'tab'           => 'content',
            'group'         => 'stock_layout',
            'label'         => esc_html__('Icon Position', 'wpv-bu'),
            'type'          => 'select',
            'options'       => [
                    'left'  => esc_html__('Left', 'wpv-bu'),
                    'right' => esc_html__('Right', 'wpv-bu'),
                ],
            'required'      => [['stock_status_type', '=', 'custom'],
                                ['out_stock_text', '!=', '']],
        ];
    }

    public function button_style(){
        $this->controls['icon_sep']=[
            'tab'           =>'content',
            'group'         =>'button_style',
            'label'         =>esc_html__('Before Action Icon', 'wpv-bu'),
            'type'          =>'separator',
        ];
        $this->controls['button_icon'] = [
            'tab'           => 'content',
            'group'         =>'button_style',
            'label'         => esc_html__('Icon', 'wpv-bu'),
            'type'          => 'icon',
        ];
        $this->controls['button_icon_position'] =[
            'tab'           => 'content',
            'label'         => esc_html__('Icon Position', 'wpv-bu'),
            'group'         =>'button_style',
            'type'          => 'select',
            'inline'        => true,
            'options'       => [
                    'left'  => esc_html__('Before', 'wpv-bu'),
                    'right' => esc_html__('After', 'wpv-bu'),
            ],
            'required'      =>['button_icon','!=',''],
        ];
        $this->controls['button_icon_color']=[
            'tab'           =>'content',
            'group'         =>'button_style',
            'label'         =>esc_html__('Icon Color', 'wpv-bu'),
            'type'          =>'color',
            'css'           =>[
                [
                'property'  => 'color',
                'selector'  =>'.bultr-atc-content-wrapper button i',
                ],
                [
                    'property'  => 'fill',
                    'selector'  =>'.bultr-atc-content-wrapper button svg',
                    ],
                   
            ],
            'required'      =>['button_icon','!=',''],
        ];
        $this->controls['button_icon_size']=[
            'tab'           =>'content',
            'group'         =>'button_style',
            'label'         =>esc_html__('Icon Size', 'wpv-bu'),
            'type'          =>'number',
            'units'         => true,
            'min'           =>0,
            'max'           =>100,
            'css'           =>[
                [
                'property'  => 'font-size',
                'selector'  =>'.bultr-atc-content-wrapper button i',
                ],
                [
                    'property' => 'font-size',
                    'selector' => '.bultr-atc-content-wrapper button svg',
                ],

            ],
            'required'      =>['button_icon','!=',''],
        ];
        $this->controls['icon_gap']=[
            'tab'           =>'content',
            'group'         =>'button_style',
            'label'         =>esc_html__('Icon Gap', 'wpv-bu'),
            'type'          =>'number',
            'units'         => true,
            'min'           =>0,
            'max'           =>100,
            'css'           =>[
                [
                'property'  => 'gap',
                'selector'  =>'.bultr-atc-content-wrapper .bultr-before',
                
                ], 
            ],
            'required'      =>['button_icon','!=',''],
        ];

        $this->controls['after_icon_sep']=[
            'tab'           =>'content',
            'group'         =>'button_style',
            'label'         =>esc_html__('After Action Icon', 'wpv-bu'),
            'type'          =>'separator',
        ];
        $this->controls['after_button_icon'] = [
            'tab'           => 'content',
            'group'         =>'button_style',
            'label'         => esc_html__('Icon', 'wpv-bu'),
            'type'          => 'icon',
        ];
        $this->controls['after_button_icon_pos'] =[
            'tab'           => 'content',
            'label'         => esc_html__('Icon Position', 'wpv-bu'),
            'group'         =>'button_style',
            'type'          => 'select',
            'inline'        => true,
            'options'       => [
                    'left'  => esc_html__('Before', 'wpv-bu'),
                    'right' => esc_html__('After', 'wpv-bu'),
            ],
            'required'      =>['after_button_icon','!=',''],
        ];
        $this->controls['after_button_icon_color']=[
            'tab'           =>'content',
            'group'         =>'button_style',
            'label'         =>esc_html__('Icon Color', 'wpv-bu'),
            'type'          =>'color',
            'css'           =>[
                [
                'property'  => 'color',
                'selector'  =>'.bultr-atc-content-wrapper .bultr-after-click-icon i',
                ],
                [
                'property'  => 'fill',
                'selector'  =>'.bultr-atc-content-wrapper .bultr-after-click-icon svg',
                ],
            ],
            'required'      =>['after_button_icon','!=',''],
        ];
        $this->controls['after_button_icon_size']=[
            'tab'           =>'content',
            'group'         =>'button_style',
            'label'         =>esc_html__('Icon Size', 'wpv-bu'),
            'type'          =>'number',
            'units'         => true,
            'min'           =>0,
            'max'           =>100,
            'css'           =>[
                [
                'property'  => 'font-size',
                'selector'  =>'.bultr-atc-content-wrapper .bultr-after-click-icon i',
                ],
                [
                'property'  => 'font-size',
                'selector'  =>'.bultr-atc-content-wrapper .bultr-after-click-icon svg',
                ],
            ],
            'required'      =>['after_button_icon','!=',''],
        ];
        $this->controls['after_icon_gap']=[
            'tab'           =>'content',
            'group'         =>'button_style',
            'label'         =>esc_html__('Icon Gap', 'wpv-bu'),
            'type'          =>'number',
            'units'         => true,
            'min'           =>0,
            'max'           =>100,
            'css'           =>[
                [
                'property'  => 'gap',
                'selector'  =>'.bultr-atc-content-wrapper .bultr-after',
                'values'    =>'flex',
                ], 
            ],
            'required'      =>['after_button_icon','!=',''],
        ];


        $this->controls['button_sep']=[
            'tab'           =>'content',
            'group'         =>'button_style',
            'label'         =>esc_html__('Button Style', 'wpv-bu'),
            'type'          =>'separator',
        ];
        $this->controls['button_typo']=[
            'tab'           =>'content',
            'group'         =>'button_style',
            'label'         =>esc_html__('Typography', 'wpv-bu'),
            'type'          => 'typography',
            'css'           => [
              [
                'property'  => 'typography',
                'selector'  =>'.bultr-qty-btns-wrapper button',
            ],
            ],
            'exclude'       => [
                    'text-align',
                    'text-decoration'
                ],
        ];
        $this->controls['button_bgcolor']=[
            'tab'           =>'content',
            'group'         =>'button_style',
            'label'         =>esc_html__('Background', 'wpv-bu'),
            'type'          => 'background',
            'css'           =>[
                [
                'property'  => 'background',
                'selector'  => '.bultr-qty-btns-wrapper button',
                ],
            ],

        ];
        $this->controls['button_border']=[
            'tab'           =>'content',
            'group'         =>'button_style',
            'label'         =>esc_html__(' Border', 'wpv-bu'),
            'type'          =>'border',
            'css'           =>[
                [
                'property'  => 'border',
                'selector'  => '.bultr-qty-btns-wrapper  button',
                ],
            ],
        ];
        $this->controls['button_box_shadow']=[
            'tab'           =>'content',
            'group'         =>'button_style',
            'label'         =>esc_html__(' Box Shadow', 'wpv-bu'),
            'type'          =>'box-shadow',
            'css'           =>[
                [
                'property'  => 'box-shadow',
                'selector'  => '.bultr-qty-btns-wrapper button',
                ],
            ],
        ];
        $this->controls['button_position']=[
            'tab'           =>'content',
            'label'         =>esc_html__(' Position', 'wpv-bu'),
            'type'          =>'direction',
            'group'         =>'button_style',
            'css'           =>[
                [
                'property'  => 'flex-direction',
                'selector'  => '.bultr-qty-btns-wrapper',
                ],
            ],
        ];
        $this->controls['button_alignment']=[
            'tab'           =>'content',
            'label'         =>esc_html__(' Alignment', 'wpv-bu'),
            'group'         =>'button_style',
            'type'          =>'align-items',
            'css'           =>[
                [
                'property'  => 'align-items',
                'selector'  => '.bultr-qty-btns-wrapper',
                ],
            ],
            'exclude'       => ['stretch'],
            'required'      =>[ ['button_position', '=', ['column', 'column-reverse']],
                            ],
        ];
        $this->controls['button_row_alignment']=[
            'tab'           =>'content',
            'label'         =>esc_html__(' Alignment', 'wpv-bu'),
            'group'         =>'button_style',
            'type'          =>'justify-content',
            'css'           =>[
                [
                'property'  => 'justify-content',
                'selector'  => '.bultr-qty-btns-wrapper',
                ],
            ],
            'exclude'       => ['space'],
            'required'      => [['button_position', '=', ['row', 'row-reverse'],],
                                ],
        ];

        $this->controls['button_padding']=[
            'tab'           =>'content',
            'label'         =>esc_html__(' Padding', 'wpv-bu'),
            'type'          =>'dimensions',
            'group'         =>'button_style',
            'css'           =>[
                [
                'property'  => 'padding',
                'selector'  => '.bultr-qty-btns-wrapper .bultr-add-to-cart',
                ],
            ],
        ];
       
        $this->controls['button_margin']=[
            'tab'           =>'content',
            'label'         =>esc_html__('Margin', 'wpv-bu'),
            'type'          =>'dimensions',
            'group'         =>'button_style',
            'css'           =>[
                [
                'property'  => 'margin',
                'selector'  => '.bultr-qty-btns-wrapper .bultr-add-to-cart',
                ],
            ],
        ];
       
    }
    
    public function view_cart_button_style(){

        $this->controls['view_cart_icon_sep']=[
            'tab'           =>'content',
            'group'         =>'view_cart_button_style',
            'label'         =>esc_html__('Icon', 'wpv-bu'),
            'type'          =>'separator',
        ];
        $this->controls['view_cart_icon'] = [
            'tab'           => 'content',
            'group'         =>'view_cart_button_style',
            'label'         => esc_html__('Icon', 'wpv-bu'),
            'type'          => 'icon',
        ];
        $this->controls['view_cart_icon_position'] =[
            'tab'           => 'content',
            'label'         => esc_html__('Icon Position', 'wpv-bu'),
            'group'         =>'view_cart_button_style',
            'type'          => 'select',
            'options'       => [
                'left'      => esc_html__('Before', 'wpv-bu'),
                'right'     => esc_html__('After', 'wpv-bu'),
            ],
            'inline'        => true,
            'required'      =>['view_cart_icon','!=',''],
        ];
        $this->controls['view_cart_icon_color']=[
            'tab'           =>'content',
            'group'         =>'view_cart_button_style',
            'label'         =>esc_html__('Icon Color', 'wpv-bu'),
            'type'          =>'color',
            'css'           =>[
                [
                'property'  => 'color',
                'selector'  =>'.bultr-atc-content-wrapper .bultr-view-cart-button i',
                ],
            [
                'property'  => 'fill',
                'selector'  =>'.bultr-atc-content-wrapper .bultr-view-cart-button svg',
                ],
                ],
            'required'      =>['view_cart_icon','!=',''],
        ];
        $this->controls['view_cart_icon_size']=[
            'tab'           =>'content',
            'group'         =>'view_cart_button_style',
            'label'         =>esc_html__('Icon Size', 'wpv-bu'),
            'type'          =>'number',
            'units'         => true,
            'min'           =>0,
            'max'           =>100,
            'css'           =>[
                [
                'property'  => 'font-size',
                'selector'  =>'.bultr-atc-content-wrapper .bultr-view-cart-button i',
                ],
                [
                'property'  => 'font-size',
                'selector'  =>'.bultr-atc-content-wrapper .bultr-view-cart-button svg',
                ],
            ],
            'required'      =>['view_cart_icon','!=',''],
        ];
        $this->controls['view_cart_icon_gap']=[
            'tab'           =>'content',
            'group'         =>'view_cart_button_style',
            'label'         =>esc_html__('Icon Gap', 'wpv-bu'),
            'type'          =>'number',
            'units'         => true,
            'min'           =>0,
            'max'           =>100,
            'css'           =>[
                [
                'property'  => 'gap',
                'selector'  =>'.bultr-atc-content-wrapper .bultr-view-cart-button',
                ],
               
            ],
            'required'      =>['view_cart_icon','!=',''],
        ];
        $this->controls['view_cart_sep']=[
            'tab'           =>'content',
            'group'         =>'view_cart_button_style',
            'label'         =>esc_html__(' Button Style', 'wpv-bu'),
            'type'          =>'separator',
        ];
        $this->controls['view_cart_typo']=[
            'tab'           =>'content',
            'group'         =>'view_cart_button_style',
            'label'         =>esc_html__('Typography', 'wpv-bu'),
            'type'          =>'typography',
            'css'           => [
              [
                'property'  => 'typography',
                'selector'  =>'.bultr-qty-btns-wrapper .bultr-view-cart-button',
            ],
            ],
            'exclude'       => [
                        'text-align',
                    ],
        ];
        $this->controls['view_cart_bgcolor']=[
            'tab'           =>'content',
            'group'         =>'view_cart_button_style',
            'label'         =>esc_html__(' Background', 'wpv-bu'),
            'type'          =>'background',
            'css'           =>[
                [
                'property'  => 'background',
                'selector'  => '.bultr-qty-btns-wrapper .bultr-view-cart-button ',
                ],
            ],
            'default' => [
                'color' => [
                  'rgb' => 'rgba(255, 214, 87, 1)',
                  'hex' => '#ffd64f',
                ],
              ],
        ];
        $this->controls['view_cart_border']=[
            'tab'           =>'content',
            'group'         =>'view_cart_button_style',
            'label'         =>esc_html__(' Border', 'wpv-bu'),
            'type'          =>'border',
            'css'           =>[
                [
                'property'  => 'border',
                'selector'  => '.bultr-atc-content-wrapper .bultr-view-cart-button',
                ],
            ],
            'default' => [
                'width' => [
                  'top'     => 1,
                  'right'   => 1,
                  'bottom'  => 1,
                  'left'    => 1,
                ],
                'style' => 'solid',
                'color' => [
                  'hex' => '#000000',
                ],
              ],
        
        ];
        $this->controls['view_cart_box_shadow']=[
            'tab'           =>'content',
            'group'         =>'view_cart_button_style',
            'label'         =>esc_html__(' Box Shadow', 'wpv-bu'),
            'type'          =>'box-shadow',
            'css'           =>[
                [
                'property'  => 'box-shadow',
                'selector'  => '.bultr-atc-content-wrapper .bultr-view-cart-button',
                ],
            ],
        ];
        $this->controls['view_cart_padding']=[
            'tab'           =>'content',
            'label'         =>esc_html__(' Padding', 'wpv-bu'),
            'type'          =>'dimensions',
            'group'         =>'view_cart_button_style',
            'css'           =>[
                [
                'property'  => 'padding',
                'selector'  => '.bultr-atc-content-wrapper .bultr-view-cart-button',
                ],
            ],
        ];
        $this->controls['view_cart_margin']=[
            'tab'           =>'content',
            'label'         =>esc_html__(' Margin', 'wpv-bu'),
            'type'          =>'dimensions',
            'group'         =>'view_cart_button_style',
            'css'           =>[
                [
                'property'  => 'margin',
                'selector'  => '.bultr-atc-content-wrapper .bultr-view-cart-button',
                ],
            ],
        ];
    }

    public function quantity_style(){

        $this->controls['qty_typo']=[
            'tab'           =>'content',
            'group'         =>'qty_style',
            'label'         =>esc_html__('Typography', 'wpv-bu'),
            'type'          => 'typography',
            'css'           => [
              [
                'property'  => 'typography',
                'selector'  =>'.bultr-qty-btns-wrapper input',
            ],
            ],
        ];
        $this->controls['qty_bgcolor']=[
            'tab'           =>'content',
            'group'         =>'qty_style',
            'label'         =>esc_html__('Background', 'wpv-bu'),
            'type'          =>'background',
            'css'           =>[
                [
                'property'  => 'background',
                'selector'  =>'.bultr-qty-btns-wrapper input',
                ],
            ],

        ];
        $this->controls['qty_border']=[
            'tab'           =>'content',
            'group'         =>'qty_style',
            'label'         =>esc_html__(' Border', 'wpv-bu'),
            'type'          =>'border',
            'css'           =>[
                [
                'property'  => 'border',
                'selector'  =>'.bultr-qty-btns-wrapper input',
                ],
            ],
        ];
        $this->controls['qty_box_shadow']=[
            'tab'           =>'content',
            'group'         =>'qty_style',
            'label'         =>esc_html__(' Box Shadow', 'wpv-bu'),
            'type'          =>'box-shadow',
            'css'           =>[
                [
                'property'  => 'box-shadow',
                'selector'  =>'.bultr-qty-btns-wrapper input',
                ],
            ],
        ];
        $this->controls['qty_margin']=[
            'tab'           =>'content',
            'label'         =>esc_html__('Margin', 'wpv-bu'),
            'type'          =>'dimensions',
            'group'         =>'qty_style',
            'css'           =>[
                [
                'property'  => 'margin',
                'selector'  => '.bultr-qty-btns-wrapper .bultr-atc-input',
                ],
            ],
        ];
        $this->controls['qty_height']=[
            'tab'           =>'content',
            'label'         =>esc_html__(' Height', 'wpv-bu'),
            'type'          =>'number',
            'units'         => true,
            'group'         =>'qty_style',
            'css'           =>[
                [
                'property'  => 'height',
                'selector'  => '.bultr-qty-btns-wrapper .bultr-atc-input',
                ],
                ],
        ];
        $this->controls['qty_width']=[
            'tab'           =>'content',
            'label'         =>esc_html__(' Width', 'wpv-bu'),
            'type'          =>'number',
            'units'         => true,
            'group'         =>'qty_style',
            'css'           =>[
                [
                'property'  => 'width',
                'selector'  => '.bultr-qty-btns-wrapper .bultr-atc-input',
                ],
                ],
        ];
    }

    public function stock_style(){
        $this->controls['d_stock_direction']=[
            'tab'           => 'content',
            'group'         => 'stock_style',
			'label'         => esc_html__( 'Direction', 'wpv-bu' ),
			'type'          => 'select',
            'options'       => [
                'right'     => esc_html__( 'Right', 'wpv-bu' ),
                'top'       => esc_html__( 'Top', 'wpv-bu' ),
                'bottom'    => esc_html__( 'Bottom', 'wpv-bu' ),
            ],
            'inline'        => true, 
            'default'       => 'top',
            'clearable'     => false,
            'required'  => ['stock_status_type', '=', 'default'],
        ];
        $this->controls['d_stock_align']=[
            'tab'           => 'content',
            'group'         => 'stock_style',
			'label'         => esc_html__( 'Alignment', 'wpv-bu' ),
			'type'          => 'justify-content',
            'css'           =>[
                [
                'property'  => 'justify-content',
                'selector'  =>'.bultr-stock-default .in-stock',
                ],
                [
                'property'  => 'justify-content',
                'selector'  =>'.bultr-stock-default .out-of-stock',
                    ],
            ],
            'inline'        => true, 
            'exclude'       => ['space'],
            'required'      => [['d_stock_direction', '=', ['top', 'bottom'],],
                                ['stock_status_type', '=', 'default'],],
                                
        ];
        $this->controls['stock_direction']=[
            'tab'           => 'content',
            'group'         => 'stock_style',
			'label'         => esc_html__( 'Direction', 'wpv-bu' ),
			'type'          => 'select',
            'options'       => [
                'right'     => esc_html__( 'Right', 'wpv-bu' ),
                'top'       => esc_html__( 'Top', 'wpv-bu' ),
                'bottom'    => esc_html__( 'Bottom', 'wpv-bu' ),
            ],
            'inline'        => true, 
            'default'       => 'top',
            'clearable'     => false,
            'required'  => ['stock_status_type', '=', 'custom'],
        ];
        $this->controls['stock_align']=[
            'tab'           => 'content',
            'group'         => 'stock_style',
			'label'         => esc_html__( 'Alignment', 'wpv-bu' ),
			'type'          => 'align-items',
            'css'           =>[
                [
                'property'  => 'align-self',
                'selector'  =>'.bultr-stock-custom .in-stock',
                ],
                [
                'property'  => 'align-self',
                'selector'  =>'.bultr-stock-custom .out-of-stock',
                    ],

            ],
            'inline'        => true,
            'exclude'       => ['stretch'],
            'required'  => ['stock_status_type', '=', 'custom'],
        ];
        $this->controls['stock_border']=[
            'tab'           =>'content',
            'group'         => 'stock_style',
            'label'         =>esc_html__(' Border', 'wpv-bu'),
            'type'          =>'border',
            'css'           =>[
                [
                'property'  => 'border',
                'selector'  =>'.out-of-stock',
                ],
                [
                'property'  => 'border',
                'selector'  =>'.in-stock',
                    ],
            ],
        ];
        $this->controls['stock_padding']=[
            'tab'           =>'content',
            'label'         =>esc_html__('Padding', 'wpv-bu'),
            'group'         => 'stock_style',
            'type'          =>'dimensions',
            'css'           =>[
                [
                'property'  => 'padding',
                'selector'  =>'.stock',
                ],
            ],
        ];
        $this->controls['stock_margin']=[
            'tab'           =>'content',
            'label'         =>esc_html__('Margin', 'wpv-bu'),
            'group'         => 'stock_style',
            'type'          =>'dimensions',
            'css'           =>[
                [
                'property'  => 'margin',
                'selector'  =>'.stock',
                ],
            ],
        ];
        $this->controls['stock_width']=[
            'tab'           =>'content',
            'label'         =>esc_html__('Width', 'wpv-bu'),
            'group'         => 'stock_style',
            'type'          => 'number',
            'units'         => true,
            'placeholder'   => '30%',
            'css'           =>[
                [   
                'property'  => 'width',
                'selector'  =>'.in-stock',
                ],
                [   
                    'property'  => 'width',
                    'selector'  =>'.out-of-stock',
                    ],
            ],
        ];

        $this->controls['in_stock_sep']=[
            'tab'           => 'content',
            'group'         => 'stock_style',
            'label'         => esc_html__('In Stock', 'wpv-bu'),
            'type'          => 'separator',
        ];
        $this->controls['in_stock_icon_color']=[
            'tab'           =>'content',
            'group'         => 'stock_style',
            'label'         =>esc_html__('Icon Color', 'wpv-bu'),
            'type'          =>'color',
            'css'           =>[
                [
                'property'  => 'color',
                'selector'  =>'.bultr-stock-custom .in-stock i',
                ],
            ],
            'required'      => [['in_stock_icon', '!=', ''],
                     ['stock_status_type', '=', 'custom'],],
        ];
        $this->controls['in_stock_icon_size']=[
            'tab'           =>'content',
            'group'         => 'stock_style',
            'label'         =>esc_html__('Icon Size', 'wpv-bu'),
            'type'          =>'number',
            'units'         => true,
            'css'           =>[
                [
                'property'  => 'font-size',
                'selector'  =>'.bultr-stock-custom .in-stock i',
                ],
            ],
            'required'      => [['in_stock_icon', '!=', ''],
                                ['stock_status_type', '=', 'custom'],],
        ];
        $this->controls['in_stock_gap']= [
            'tab'           => 'content',
            'label'         => esc_html__('Icon Gap', 'wpv-bu'),
            'type'          => 'number',
            'units'         => true,
            'group'         => 'stock_style',
            'min'           => 0,
            'max'           => 100,
            'step'          => 1,
            'unit'          => 'px',
            'css'           => [
                [
                'property'  => 'gap',
                'selector'  =>'.bultr-stock-custom .in-stock',
                ],
            ],
            'required'      => [['in_stock_icon', '!=', ''],
                                ['stock_status_type', '=', 'custom'],],
        ];
        $this->controls['in_stock_typo']=[
            'tab'           =>'content',
            'group'         => 'stock_style',
            'label'         =>esc_html__('Typography', 'wpv-bu'),
            'type'          => 'typography',
            'css'           => [
              [
                'property'  => 'typography',
                'selector'  =>'.in-stock',
            ],
            ],
            'exclude'       => [
                                'text-align',
                                'text-decoration'
                                ],
        ];
        $this->controls['in_stock_bgcolor']=[
            'tab'           =>'content',
            'group'         => 'stock_style',
            'label'         =>esc_html__('Background', 'wpv-bu'),
            'type'          =>'background',
            'css'           =>[
                [
                'property'  => 'background',
            'selector'      =>'.in-stock',
                ],
            ],
        ];
       
        $this->controls['out_stock_sep']=[
            'tab'           =>'content',
            'group'         => 'stock_style',
            'label'         =>esc_html__('Out Of Stock', 'wpv-bu'),
            'type'          =>'separator',
        ];    
        $this->controls['out_stock_icon_color']=[
            'tab'           =>'content',
            'group'         => 'stock_style',
            'label'         =>esc_html__('Icon Color', 'wpv-bu'),
            'type'          =>'color',
            'css'           =>[
                [
                'property'  => 'color',
                'selector'  =>'.bultr-stock-custom .out-of-stock i',
                ],
            ],
            'required'      => [['out_stock_icon', '!=', ''],
                                ['stock_status_type', '=', 'custom'],],
        ];
        $this->controls['out_stock_icon_size']=[
            'tab'           =>'content',
            'group'         => 'stock_style',
            'label'         =>esc_html__('Icon Size', 'wpv-bu'),
            'type'          =>'number',
            'units'         => true,
            'css'           =>[
                [
                'property'  => 'font-size',
                'selector'  =>'.bultr-stock-custom .out-of-stock i',
                ],
            ],
            'required'      => [['out_stock_icon', '!=', ''],
                                ['stock_status_type', '=', 'custom'],],
        ];
        $this->controls['out_stock_gap']= [
            'tab'           => 'content',
            'label'         => esc_html__('Icon Gap', 'wpv-bu'),
            'type'          => 'number',
            'units'         => true,
            'group'         => 'stock_style',
            'min'           => 0,
            'max'           => 100,
            'step'          => 1,
            'unit'          => 'px',
            'css'           => [
                [
                'property'  => 'gap',
                'selector'  =>'.bultr-stock-custom .out-of-stock',
                ],
            ],
            'required'      => [['out_stock_icon', '!=', ''],
                                ['stock_status_type', '=', 'custom'],],
        ];
        $this->controls['out_stock_typo']=[
            'tab'           =>'content',
            'group'         => 'stock_style',
            'label'         =>esc_html__('Typography', 'wpv-bu'),
            'type'          => 'typography',
            'css'           => [
              [
                'property'  => 'typography',
                'selector'  =>'.out-of-stock',
            ],
            ],
            'exclude'       => [
                                'text-align',
                                'text-decoration'
                            ],
        ];
        $this->controls['out_stock_bgcolor']=[
            'tab'           =>'content',
            'group'         =>'stock_style',
            'label'         =>esc_html__(' Background', 'wpv-bu'),
            'type'          =>'background',
            'css'           =>[
                [
                'property'  => 'background',
                'selector'  =>'.out-of-stock',
                ],
            ],
        ];
       
    }


    public function render() {
        $settings = $this->settings;
        $settings['in_stock_icon_position'] = isset($settings['in_stock_icon_position']) ? $settings['in_stock_icon_position'] : 'left';
        $settings['out_stock_icon_position'] = isset($settings['out_stock_icon_position']) ? $settings['out_stock_icon_position'] : 'left';
        
        if (!isset($settings['product'])) {
            return $this->render_element_placeholder( [ 'title' => esc_html__( 'Please select a product.', 'wpv-bu' ) ] );
            return;
        }

        $product_id = $settings['product'];

        // Get the product object
        $product = wc_get_product($product_id);

        if (!$product) {
            echo 'Invalid product';
            return;
        }
    
        $this->set_attribute('_root', 'class', 'bultr-atc-wrapper');
            
        //stock icon position
        if(isset($settings['stock_status_type']) && $settings['stock_status_type'] == 'custom'){
           
            if($settings['in_stock_icon_position'] == 'left'){
                $this->set_attribute('content', 'class', 'bultr-atc-stock-icon-left');
            }

            if($settings['in_stock_icon_position'] == 'right'){
                $this->set_attribute('content', 'class', 'bultr-atc-stock-icon-right');
            }

            if($settings['out_stock_icon_position'] == 'left'){
                $this->set_attribute('content', 'class', 'bultr-atc-outStock-icon-left');
            }
            if($settings['out_stock_icon_position'] == 'right'){
                $this->set_attribute('content', 'class', 'bultr-atc-outStock-icon-right');
            }
        }
 
        //hide button 
        if(isset($this->settings['hide_fields'])){
            $this->set_attribute('content', 'class', 'bultr-atc-hide-field');
        } 

        //pass value   
        $options=[
            'hide_fields'           => isset($settings['hide_fields']) && $settings['hide_fields'] ? $settings['hide_fields']: 0 ,
            'redirect'              => isset($settings['redirect_add_to_cart']) && $settings['redirect_add_to_cart'] ? $settings['redirect_add_to_cart'] : 'stay',
        ];
        $this->set_attribute('_root', 'data-settings', wp_json_encode($options) );
        
        $this->set_attribute('content', 'class', 'bultr-atc-content-wrapper');

        //buttons position
        if(isset($settings['button_position'])){
            $this->set_attribute('content', 'class', 'bultr-atc-button-pos-'.$settings['button_position']);
        } 
        //view button position
        if(isset($settings['view_cart_position'])){
            $this->set_attribute('content', 'class', 'bultr-view-btn-pos-'.$settings['view_cart_position']);
        }    
        //view cart icon position
        if(isset($settings['view_cart_icon_position'])){
            $this->set_attribute('content', 'class', 'bultr-atc-view-icon-'.$settings['view_cart_icon_position']);
        }

        //hide quantity field
        if(isset($settings['hide_quantity_field'])&& $settings['hide_quantity_field'] == '1'){
        $this->set_attribute('content', 'class', 'bultr-hide-quantity');
        }
  
        //before action button icon position   
         if(isset($settings['button_icon_position'])){
            $this->set_attribute('content', 'class', 'bultr-atc-before-icon-'.$settings['button_icon_position']);
        }
        //after action button icon position
        if(isset($settings['after_button_icon_pos'])){
            $this->set_attribute('content', 'class', 'bultr-atc-after-icon-'.$settings['after_button_icon_pos']);
        }

         //stock status type
         if (isset($settings['stock_status_type']) && ($settings['stock_status_type'] !== 'none')) {
            $this->set_attribute('content', 'class', 'bultr-stock-' . $settings['stock_status_type']);
        }    
        // default stock direction 
        if(isset($settings['stock_status_type']) && $settings['stock_status_type'] == 'default'&& isset($settings['d_stock_direction'])){
            $this->set_attribute('content', 'class', 'bultr-stock-default-'.$settings['d_stock_direction']);
        }
         // custom stock direction 
         if(isset($settings['stock_status_type']) && $settings['stock_status_type'] == 'custom' && isset($settings['stock_direction'])){
            $this->set_attribute('content', 'class', 'bultr-stock-default-'.$settings['stock_direction']);
        }
        ?>

        <div <?php echo $this->render_attributes( '_root' ); ?>> 
            <div <?php echo $this->render_attributes( 'content' ); ?>> 
                        <?php
                        // render stock status
                        if (isset($settings['stock_status_type']) && $settings['stock_status_type'] == 'default' && isset($settings['d_stock_direction']) && ($settings['d_stock_direction'] == 'top' || $settings['d_stock_direction'] == 'bottom')) {
                            echo wc_get_stock_html($product); // woocommerce default stock status
                        }
                        
                         if (isset($settings['stock_status_type']) && $settings['stock_status_type'] == 'custom' && isset($settings['stock_direction']) && ($settings['stock_direction'] == 'top' || $settings['stock_direction'] == 'bottom')) {
                            $this->custom_stock_status();
                        }

                        //check if product is out of stock then show out of stock message
                        if (!$product->is_in_stock()) {
                            if (isset($settings['stock_status_type']) && $settings['stock_status_type'] == 'default' && isset($settings['d_stock_direction']) && ($settings['d_stock_direction'] == 'right')) {
                                echo wc_get_stock_html($product); // woocommerce default stock status
                            }
                            
                             if (isset($settings['stock_status_type']) && $settings['stock_status_type'] == 'custom' && isset($settings['stock_direction']) && ($settings['stock_direction'] == 'right')) {
                                $this->custom_stock_status();
                            }
                        }
        
                        if ( $product->is_in_stock() ) {
                                $this->render_button();
                        }  
                        
            ?></div><?php      
        ?></div><?php         
        
    }

    public function render_button(){
        $settings           = $this->settings;
        $product_id         = $settings['product'];
        $product            = wc_get_product($product_id);
    
        if (isset($settings['button_text'])) {
            $button_text    = $settings['button_text'];
            } else {
            $button_text    = esc_html__($product->single_add_to_cart_text());
        }
        $view_cart_text = '';
        if (isset($settings['view_cart_text'])) {
            $view_cart_text = $settings['view_cart_text'];
        }
        
        //render  button icon when after_action_icon class is active
        
        if (isset($settings['button_icon'])) { 
            $buttonIcon     = self::render_icon($settings['button_icon']);
            } else {
            $buttonIcon     = '';
        }

        if (isset($settings['after_button_icon'])) { 
            $abuttonIcon     = self::render_icon($settings['after_button_icon']);
            } else {
            $abuttonIcon     = '';
        }
        
        if (isset($settings['view_cart_icon'])) { // Render icon
            $viewCartIcon   = self::render_icon($settings['view_cart_icon']);
            } else {
            $viewCartIcon   = '';
        }?>
        
        <form  class="bultr-qty-btns-wrapper" method="post" enctype="multipart/form-data">

            <?php
               echo $this->quantity_field();
             ?>
            <button id="add-to-cart-button" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button button alt bultr-add-to-cart bultr-before<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>">
                <span class="bultr-before-click-icon"><?php echo $buttonIcon; ?></span>
                <span class="bultr-after-click-icon"><?php echo $abuttonIcon; ?></span>
                <span class="button-text"><?php echo esc_html($button_text); ?></span>
            </button>

            <?php
            $cart_url = wc_get_cart_url();
            $class    = '';
            if (isset($settings['redirect_add_to_cart']) && $settings['redirect_add_to_cart'] == 'stay') {
            
                if (isset($settings['preview_view_cart']) && $settings['preview_view_cart'] == '1') {
                    // Check if builder is active
                    if (bricks_is_builder() || bricks_is_builder_call()) {
                        $class = 'bultr-view-cart-show';
                    }
                }   
                ?>  
                <a href="<?php echo $cart_url;?>" id="view-cart-button" class="bultr-view-cart-button <?php echo $class; ?>">
                    <?php echo $viewCartIcon . esc_html__($view_cart_text); ?>
                </a>
                <?php
            }   
                if(isset($settings['stock_status_type'])&& $settings['stock_status_type'] == 'default' && isset($settings['d_stock_direction'])&& $settings['d_stock_direction'] == 'right'){       
                    echo  wc_get_stock_html( $product ); // woocomerce default stock staus
                 }
                
                 if(isset($settings['stock_status_type'])&& $settings['stock_status_type'] == 'custom' && isset($settings['stock_direction'])&& $settings['stock_direction'] == 'right'){       
                    $this->custom_stock_status();
                }   
            ?>
        </form><?php
    }

    public function quantity_field() {
        $settings = $this->settings;
        $hide_quantity_field = isset($settings['hide_quantity_field']) && $settings['hide_quantity_field'];
       
        if (!$hide_quantity_field) {
            if (class_exists('WooCommerce') && function_exists('wc_get_product')) {
                $product_id = $settings['product'];
                $product = wc_get_product($product_id);
                if ($product && !is_bool($product)) {
                    if ($product->is_sold_individually()) { // Product is sold individually and has a limit of 1 item per order
                        ?>
                        <input type="hidden" name="quantity" value="1" id="quantity" class="input-text qty text bultr-atc-input" />
                        <?php
                    } 
                    else {
                        ?>
                        <input type="number" step="1" min="1" name="quantity" value="1" id="quantity" title="<?php esc_attr_e('Qty', 'wpv-bu'); ?>" class="input-text qty text bultr-atc-input" size="4" pattern="[0-9]*" inputmode="numeric" />
                        <?php
                    }
                }
            } 
        }
    }

    public function custom_stock_status() {
        $settings = $this->settings;
        $product_id = $settings['product'];
        $product = wc_get_product($product_id);
        add_shortcode('qty', [$this, 'quantity_short_code']);
       
        if (!$product || is_bool($product)) {
            return; // Exit the function if the product is not found or is a boolean value
        }   
        //show massage if product is Available on backorder
        if ($product->backorders_allowed() && $product->backorders_require_notification()) {
                if (empty($settings['backorder_text'])) {
                    return;
                }
                $availability = __($settings['backorder_text'], 'wpv-bu');
                $backorder = '';
        
                if (isset($settings['backorder_icon'])) {
                    $backorder = self::render_icon($settings['backorder_icon']);
                }
        
                $class = 'available-on-backorder';
                echo '<p class="stock ' . esc_attr($class) . '">'.$backorder . wp_kses_post($availability) . '</p>';
        } 

        if ($product->get_stock_status() === 'outofstock' ) {// Check if product is manually set as "Out of Stock"
            if (empty($settings['out_stock_text'])) {
                return;
            }
            $availability = __($settings['out_stock_text'], 'wpv-bu');
            $outStock = '';
            if (isset($settings['out_stock_icon'])) {
                $outStock = self::render_icon($settings['out_stock_icon']);
            }
            $class = 'out-of-stock';
            echo '<p class="stock ' . esc_attr($class) . '">'.$outStock . wp_kses_post($availability) . '</p>';
        } 
        else{
            if (!$product->managing_stock()) {
                return; // Exit the function if WooCommerce does not manage the stock for this product
            }
    
            if (empty($settings['in_stock_text'])) {
                return;
            }
            $availability = __($settings['in_stock_text'], 'wpv-bu');
    
            $inStock = '';
    
            if (isset($settings['in_stock_icon'])) {
                $inStock = self::render_icon($settings['in_stock_icon']);
            }
            $inStockQty = $settings['in_stock_text'];
            $inStockQty = str_replace('{{', '[', $inStockQty);
            $inStockQty = str_replace('}}', ']', $inStockQty);
            $class = 'in-stock'; 
            echo '<p class="stock ' . esc_attr($class) . '">'.$inStock . do_shortcode($inStockQty) .  '</p>';
        }
    }
    
    public function quantity_short_code() { //create a shortcode for get remaining stock quantity
        $settings = $this->settings;
        $product_id = $settings['product'];
        $product = wc_get_product($product_id);
        $availability = $product->get_stock_quantity();
    
        return $availability;
    }
    
    
    
    
}