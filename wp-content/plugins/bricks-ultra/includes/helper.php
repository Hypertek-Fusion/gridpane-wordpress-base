<?php

namespace BricksUltra\includes;

use Bricks\Element;
use Bricks\Helpers;

class Helper {

	public function __construct()
	{	
		add_action('wp_ajax_bu_add_to_cart', [$this,'bultr_add_to_cart']);
		add_action('wp_ajax_nopriv_bu_add_to_cart', [$this,'bultr_add_to_cart']);

		add_action( 'wp_ajax_bu_get_single_product', [ $this, 'get_simple_products' ] );
		add_action( 'wp_ajax_nopriv_bu_get_single_product', [ $this, 'get_simple_products' ] );
		
		add_action('wp_ajax_bultr_refresh_insta_cache', [$this,'ajax_refresh_insta_cache']);
		add_action('wp_ajax_nopriv_bultr_refresh_insta_cache', [$this,'ajax_refresh_insta_cache']);
	}
	
	public function bultr_add_to_cart()
	{	
		// Check for nonce security
		$nonce = $_POST['bu_nonce'];
		if (!wp_verify_nonce($nonce, 'wooproduct_script_nonce')) {
			wp_send_json_error('Nonce is invalid');
		}

		// Get product id using js
		$product_id = absint($_POST['product_id']);
		
		// Get product quantity using js
		$product_qty = absint($_POST['quantity']);

		// Add product into cart
		$cart_item_key = WC()->cart->add_to_cart($product_id, $product_qty);

		// Send cart item key to js
		wp_send_json($cart_item_key);
		wp_die();
	}

	public function get_simple_products()
	{
		// Define the product type.
		$product_type = 'simple';
		$post_type = 'product';
		// Set the product_type taxonomy in the query_args.
		$query_args = [
			'post_type' => $post_type,
			'tax_query' => [
				[
					'taxonomy' => 'product_type',
					'field'    => 'slug',
					'terms'    => $product_type,
				],
			],
		];

		$posts = Helpers::get_posts_by_post_id($query_args);

		if (!empty($_GET['include'])) {
			$include = (array)$_GET['include'];

			foreach ($include as $post_id) {
				$post_id = absint($post_id);
				if (!array_key_exists($post_id, $posts)) {
					$posts[$post_id] = get_the_title($post_id);
				}
			}
		}

		// Remove "(Product)" from the product names using regular expressions and trim any extra spaces.
		foreach ($posts as &$post_title) {
			$post_title = preg_replace('/\(product\)/i', '', $post_title);
			$post_title = trim($post_title);
		}

		wp_send_json_success($posts);
	}


	// public static $schemas;
	public function get_modules()
		{
		$modules = [
			'core' => [
				'name'       => 'Core',
				'active'     => true,
				'submodules' => [
					'timeline' => [
						'name'   => 'Timeline',
						'path'   => WPV_BU_PATH . 'includes/modules/timeline/module.php',
						'active' => true,
					],
					'image-compare' => [
						'name'   => 'Image Compare',
						'path'   => WPV_BU_PATH . 'includes/modules/image-compare/module.php',
						'active' => true,
					],
					'filterable-gallery' => [
						'name'   => 'Filterable Gallery',
						'path'   => WPV_BU_PATH . 'includes/modules/filterable-gallery/module.php',
						'active' => true,
					],
					'thumbnail-slider' => [
						'name'   => 'Thumbnail Slider',
						'path'   => WPV_BU_PATH . 'includes/modules/thumbnail-slider/module.php',
						'active' => true,
					],
					'comparison-table' => [
						'name'   => 'Comparison Table',
						'path'   => WPV_BU_PATH . 'includes/modules/comparison-table/module.php',
						'active' => true,
					],
					'info-circle' => [
						'name'   => 'Info Circle',
						'path'   => WPV_BU_PATH . 'includes/modules/info-circle/module.php',
						'active' => true,
					],
					'content-switcher' => [
						'name'   => 'Content Switcher',
						'path'   => WPV_BU_PATH . 'includes/modules/content-switcher/module.php',
						'active' => true,
					],
					'team-member' => [
						'name'   => 'Team Member',
						'path'   => WPV_BU_PATH . 'includes/modules/team-member/module.php',
						'active' => true,
					],
					'multi-button' => [
						'name'   => 'Multi Button',
						'path'   => WPV_BU_PATH . 'includes/modules/multi-button/module.php',
						'active' => true,
					],
					'flip-box' => [
						'name'   => 'Flip Box',
						'path'   => WPV_BU_PATH . 'includes/modules/flip-box/module.php',
						'active' => true,
					],
					'alert-box' => [
						'name'   => 'Alert Box',
						'path'   => WPV_BU_PATH . 'includes/modules/alert-box/module.php',
						'active' => true,
					],
					'progress-bar' => [
						'name'   => 'Progress Bar',
						'path'   => WPV_BU_PATH . 'includes/modules/progress-bar/module.php',
						'active' => true,
					],
					'advanced-button' => [
						'name'   => 'Advanced Button',
						'path'   => WPV_BU_PATH . 'includes/modules/advanced-button/module.php',
						'active' => true,
					],
					'twitter' => [
						'name'   => 'Twitter',
						'path'   => WPV_BU_PATH . 'includes/modules/twitter/module.php',
						'active' => true,
					],
					'content-ticker' => [
						'name'   => 'Content Ticker',
						'path'   => WPV_BU_PATH . 'includes/modules/content-ticker/module.php',
						'active' => true,
					],

					'advanced-icon' => [
						'name'   => 'Advanced Icon',
						'path'   => WPV_BU_PATH . 'includes/modules/advanced-icon/module.php',
						'active' => true,
					],
					'call-to-action' => [
						'name'   => 'Call To Action',
						'path'   => WPV_BU_PATH . 'includes/modules/call-to-action/module.php',
						'active' => true,
					], 
					'charts' => [
						'name'   => 'Radial Charts',
						'path'   => WPV_BU_PATH . 'includes/modules/charts/module.php',
						'active' => true,
					],
					'business-hours' => [
						'name'   => 'Business Hours',
						'path'   => WPV_BU_PATH . 'includes/modules/business-hours/module.php',
						'active' => true,
					], 

					'video-box' => [
						'name'   => 'Video Box',
						'path'   => WPV_BU_PATH . 'includes/modules/video-box/module.php',
            			'active' => true
           			],
					'flip-box-nested' => [
						'name'   => 'Nestable FlipBox',
						'path'   => WPV_BU_PATH . 'includes/modules/flip-box-nested/module.php',
						'active' => true,
					],
					'unfold' => [
						'name'   => 'Nestable Unfold',
						'path'   => WPV_BU_PATH . 'includes/modules/unfold/module.php',
						'active' => true,
					],
					'testimonial-slider' => [
						'name'   => 'Testimonial Slider',
						'path'   => WPV_BU_PATH . 'includes/modules/testimonial-slider/module.php',
						'active' => true,
					],	
					'instagram-feed' => [
						'name'   => 'Instagram Feed',
						'path'   => WPV_BU_PATH . 'includes/modules/instagram-feed/module.php',
						'active' => true,
					],
					'image-hotspot' => [
						'name'   => 'Image Hotspot',
						'path'   => WPV_BU_PATH . 'includes/modules/image-hotspot/module.php',
            			'active' => true,
          			],  
					'image-stack' => [
						'name'   => 'Image Stack',
						'path'   => WPV_BU_PATH . 'includes/modules/image-stack/module.php',
						'active' => true,
					],
				],
			],
			// 'other' => [
			// 	'name' => 'Other',
			// 	'enabled' => true,
			// 	'submodules' => [
			// 		'other_timeline' => [
			// 			'name' => 'Other Timeline',
			// 			'path' => WPV_BU_PATH . 'includes/modules/timeline/module.php',
			// 			'active' => true,
			// 		],
			// 		'other_image-compare' => [
			// 			'name' => 'Other Image Compare',
			// 			'path' => WPV_BU_PATH . 'includes/modules/image-compare/module.php',
			// 			'active' => true,
			// 		],
			// 	],
			// ],
		];
		//checking if WooCommerce Plugin is active
		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {

			$wooProducts = [
				'name'   => 'Woo Products',
				'path'   => WPV_BU_PATH . 'includes/modules/woo-products/module.php',
				'active' => true,
			]; 
			$wooCategory = [
				'name'   => 'Woo Category',
				'path'   => WPV_BU_PATH . 'includes/modules/woo-category/module.php',
				'active' => true,
			];
			$wooAddToCartButton = [
				'name'   => 'Woo Add to Cart',
				'path'   => WPV_BU_PATH . 'includes/modules/woo-add-to-cart-button/module.php',
				'active' => true,
			];
			$modules['core']['submodules']['woo-products'] = $wooProducts;
			$modules['core']['submodules']['woo-category'] = $wooCategory;
			$modules['core']['submodules']['woo-add-to-cart-button'] = $wooAddToCartButton;
		}

		return apply_filters(self::get_domain_prefix() . 'modules', $modules);
	}

	public function get_domain_prefix()
	{
		return 'wpv_bu_';
	}

	public function sanitize_text_or_array_field($array_or_string)
	{
		if (is_string($array_or_string)) {
			$array_or_string = sanitize_text_field($array_or_string);
		} elseif (is_array($array_or_string)) {
			foreach ($array_or_string as $key => &$value) {
				if (is_array($value)) {
					$value = self::sanitize_text_or_array_field($value);
				} else {
					$value = sanitize_text_field($value);
				}
			}
		}

		return $array_or_string;
	}

	public static function get_initial_settings()
	{
		try {
			$settings = get_option('wpv_bu_settings');

			if (empty($settings)) {
				return [
					'message'          => 'Settings not found',
					'is_setting_saved' => false,
					'is_error'         => false,
				];
			}

			$settings['is_setting_saved'] = true;
			$settings['message']          = 'Settings retrieved';
			$settings['is_error']         = false;

			return $settings;
		} catch (\Exception $e) {
			return [
				'message'  => $e->getMessage(),
				'is_error' => true,
			];
		}
	}

	public function add_icon_controls($widget, $args)
	{
		if (!isset($args['control_name'])) {
			return;
		}

		$widget->controls[$args['control_name'] . '_type'] = [
			'label'     => esc_html__('Icon Type', 'wpv-bu'),
			'type'      => 'select',
			'options'   => [
				'icon'  => 'Icon',
				'image' => 'Image',
				'svg'   => 'SVG',
				'text'  => 'Text',
			],
			'inline'    => true,
			'default'   => 'icon',
			'clearable' => false,
			// 'required' => [ $args['required'] ],
		];
		if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_type']['required'] = $args['required'];
		}
		if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_type']['group'] = $args['group'];
		}

		$widget->controls[$args['control_name'] . '_icon'] = [
			'label'    => $args['label'] ?? 'Icon',
			'type'     => 'icon',
			'default'  => $args['default'] ?? [
				'library' => 'themify', // fontawesome/ionicons/themify
				'icon'    => 'ti-star',    // Example: Themify icon class
			],
			'required' => [
				[$args['control_name'] . '_type', '=', 'icon'],
			],
		];
		if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_icon']['required'] = array_merge($widget->controls[$args['control_name'] . '_icon']['required'], $args['required']);
		}
		if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_icon']['group'] = $args['group'];
		}

		$widget->controls[$args['control_name'] . '_svg'] = [
			'label'    => $args['label'] ?? 'SVG',
			'type'     => 'svg',
			'default'  => $args['default'] ?? [
				'library' => 'themify', // fontawesome/ionicons/themify
				'icon'    => 'ti-star',    // Example: Themify icon class
			],
			'required' => [
				[$args['control_name'] . '_type', '=', 'svg'],
				// $args['required'],
			],
		];
		if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_svg']['required'] = array_merge($widget->controls[$args['control_name'] . '_svg']['required'], $args['required']);
		}
		if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_svg']['group'] = $args['group'];
		}

		$widget->controls[$args['control_name'] . '_image'] = [
			'label'    => $args['label'] ?? 'Image',
			'type'     => 'image',
			'default'  => $args['default'] ?? [
				'library' => 'themify', // fontawesome/ionicons/themify
				'icon'    => 'ti-star',    // Example: Themify icon class
			],
			'required' => [
				[$args['control_name'] . '_type', '=', 'image'],
				// $args['required'],
			],
		];
		if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_image']['required'] = array_merge($widget->controls[$args['control_name'] . '_image']['required'], $args['required']);
		}
		if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_image']['group'] = $args['group'];
		}

		$widget->controls[$args['control_name'] . '_text'] = [
			'label'          => $args['label'] ?? 'Text',
			'type'           => 'text',
			'hasDynamicData' => false,
			'default'        => $args['default'] ?? [
				'library' => 'themify', // fontawesome/ionicons/themify
				'icon'    => 'ti-star',    // Example: Themify icon class
			],
			'inline'         => true,
			'required'       => [
				[$args['control_name'] . '_type', '=', 'text'],
				// $args['required'],
			],
		];
		if (isset($args['required'])) {
			$widget->controls[$args['control_name'] . '_text']['required'] = array_merge($widget->controls[$args['control_name'] . '_text']['required'], $args['required']);
		}
		if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_text']['group'] = $args['group'];
		}

		if ($args['view']) {
			$widget->controls[$args['control_name'] . '_view'] = [
				'label'     => 'View',
				'type'      => 'select',
				'options'   => [
					'normal'  => 'Default',
					'stacked' => 'Stacked',
					'framed'  => 'Framed',
				],
				'inline'    => true,
				'default'   => 'normal',
				'clearable' => false,
				// 'required' => [ $args['required'] ],
			];
			if (isset($args['required'])) {
				$widget->controls[$args['control_name'] . '_view']['required'] = $args['required'];
			}
			if (isset($args['group'])) {
				$widget->controls[$args['control_name'] . '_view']['group'] = $args['group'];
			}
		}

		if ($args['shape']) {
			$widget->controls[$args['control_name'] . '_shape'] = [
				'label'     => 'Shape',
				'type'      => 'select',
				'options'   => [
					'circle' => 'Circle',
					'square' => 'Square',
				],
				'default'   => 'circle',
				'inline'    => true,
				'required'  => [
					[$args['control_name'] . '_view', '!=', 'normal'],
					// $args['required'],
				],
				'clearable' => false,
			];
			if (isset($args['required'])) {
				$widget->controls[$args['control_name'] . '_shape']['required'] = array_merge($widget->controls[$args['control_name'] . '_shape']['required'], $args['required']);
			}
			if (isset($args['group'])) {
				$widget->controls[$args['control_name'] . '_shape']['group'] = $args['group'];
			}
		}
	}

	public function add_icon_style_controls($widget, $args)
	{
		// echo '<pre>'; print_r($args); echo "</pre>";
		// die("dfadf");
		if (!isset($args['control_name'])) {
			return;
		}
		if ($args['size']) {
			$widget->controls[$args['control_name'] . '_icon_size'] = [
				'label' => __('Size', 'wpv-bu'),
				'type'  => 'number',
				'unit'  => 'px',
				'min'   => 1,
				'max'   => 1000,
				'step'  => 1,
				'css'   => [
					[
						'property' => 'font-size',
						'selector' => $args['wrapper-class'] . ' .bultr-icon-type-icon i',
					],
					[
						'property' => 'font-size',
						'selector' => $args['wrapper-class'] . ' .bultr-icon svg',
					],
					[
						'property' => 'font-size',
						'selector' => $args['wrapper-class'] . ' .bultr-icon i img',
					],
				],
			];
			if (isset($args['group'])) {
				$widget->controls[$args['control_name'] . '_icon_size']['group'] = $args['group'];
			}
			if (isset($args['required'])) {
				$widget->controls[$args['control_name'] . '_icon_size']['required'] = $args['required'];
			}
		}
		if ($args['primary_color']) {
			$widget->controls[$args['control_name'] . '_primary_color'] = [
				'label' => __('Primary Color', 'wpv-bu'),
				'type'  => 'color',
				'css'   => [
					[
						'property' => 'background-color',
						'selector' => $args['wrapper-class'] . '.bultr-view-stacked .bultr-icon ',
					],
					[
						'property' => 'color',
						'selector' => $args['wrapper-class'] . '.bultr-view-framed .bultr-icon i',
					],

					[
						'property' => 'color',
						'selector' => $args['wrapper-class'] . '.bultr-view-normal .bultr-icon i',
					],
					[
						'property' => 'fill',
						'selector' => $args['wrapper-class'] . '.bultr-view-framed .bultr-icon svg',
					],

					[
						'property' => 'fill',
						'selector' => $args['wrapper-class'] . '.bultr-view-normal .bultr-icon svg',
					],
					[
						'property' => 'border-color',
						'selector' => $args['wrapper-class'] . '.bultr-view-framed .bultr-icon',
					],
				],
			];
			if (isset($args['group'])) {
				$widget->controls[$args['control_name'] . '_primary_color']['group'] = $args['group'];
			}
			if (isset($args['required'])) {
				$widget->controls[$args['control_name'] . '_primary_color']['required'] = $args['required'];
			}
		}
		if ($args['secondary_color']) {
			$widget->controls[$args['control_name'] . '_secondary_color'] = [
				'label'    => __('Secondary Color', 'wpv-bu'),
				'type'     => 'color',
				'css'      => [
					[
						'property' => 'background-color',
						'selector' => $args['wrapper-class'] . '.bultr-view-framed .bultr-icon ',
					],
					[
						'property' => 'color',
						'selector' => $args['wrapper-class'] . '.bultr-view-stacked .bultr-icon-type-icon i',
					],
					[
						'property' => 'fill',
						'selector' => $args['wrapper-class'] . '.bultr-view-stacked .bultr-icon-type-icon i',
					],
					[
						'property' => 'color',
						'selector' => $args['wrapper-class'] . '.bultr-view-stacked .bultr-icon svg',
					],
					[
						'property' => 'fill',
						'selector' => $args['wrapper-class'] . '.bultr-view-stacked .bultr-icon svg',
					],
					
				],
				'required' => [
					[$args['control_name'] . '_view', '!=', 'normal'],
				],
			];
			if (isset($args['group'])) {
				$widget->controls[$args['control_name'] . '_secondary_color']['group'] = $args['group'];
			}
			if (isset($args['required'])) {
				$widget->controls[$args['control_name'] . '_secondary_color']['required'] = array_merge($widget->controls[$args['control_name'] . '_secondary_color']['required'], $args['required']);
			}
		}

		if ((array_key_exists('shadow', $args)) && $args['shadow']) {
			$widget->controls[$args['control_name'] . '_box_shadow'] = [
				'tab' => 'content',
				'label' => esc_html__('BoxShadow', 'bricks'),
				'type' => 'box-shadow',
				'css' => [
					[
						'property' => 'box-shadow',
						'selector' => $args['wrapper-class'] . '.bultr-view-stacked .bultr-icon',
					],
					[
						'property' => 'box-shadow',
						'selector' => $args['wrapper-class'] . '.bultr-view-framed .bultr-icon',
					],
				],
				'inline' => true,
				'small' => true,
				'default' => [
					'values' => [
						'offsetX' => 0,
						'offsetY' => 0,
						'blur' => 2,
						'spread' => 0,
					],
					'color' => [
						'rgb' => 'rgba(0, 0, 0, .1)',
					],
				],
			];
			if (isset($args['group'])) {
				$widget->controls[$args['control_name'] . '_box_shadow']['group'] = $args['group'];
			}
		}
		if ($args['rotate']) {
			$widget->controls[$args['control_name'] . '_icon_rotate'] = [
				'label' => __('Rotate', 'wpv-bu'),
				'type'  => 'number',
				'min'   => 1,
				'max'   => 1000,
				'step'  => 1,
				'css'   => [
					[
						'selector' => '',    
						'property' => '--global_icon_rotate',
						'value' => '%sdeg',
						],
				],
				'unitless'   => true,
				'min'    => 0,
				'max'    => 360,
				'step'   => 1,
				'inline' => true,
			];

			if (isset($args['group'])) {
				$widget->controls[$args['control_name'] . '_icon_rotate']['group'] = $args['group'];
			}
			if (isset($args['required'])) {
				$widget->controls[$args['control_name'] . '_icon_rotate']['required'] = $args['required'];
			}
		}
		if ($args['border']) {
			$widget->controls[$args['control_name'] . '_icon_border'] = [
				'label'    => __('Border', 'wpv-bu'),
				'type'     => 'border',
				'css'      => [
					[
						'property' => 'border',
						'selector' => $args['wrapper-class'] . '.bultr-view-framed .bultr-icon',
					],
				],
				'required' => [
					[$args['control_name'] . '_view', '=', 'framed'],
				],
			];
			if (isset($args['group'])) {
				$widget->controls[$args['control_name'] . '_icon_border']['group'] = $args['group'];
			}
			if (isset($args['required'])) {
				$widget->controls[$args['control_name'] . '_icon_border']['required'] = array_merge($widget->controls[$args['control_name'] . '_icon_border']['required'], $args['required']);
			}
		}

		if ($args['border']) {
			$widget->controls[$args['control_name'] . '_icon_border_radius'] = [
				'label'    => __('Border Radius', 'wpv-bu'),
				'type'     => 'border',
				'exclude'  => [
					'style',
					'width',
					'color',
				],
				'inline'   => true,
				'css'      => [
					[
						'property' => 'border',
						'selector' => $args['wrapper-class'] . '.bultr-view-stacked .bultr-icon',
					],
				],
				'required' => [
					[$args['control_name'] . '_view', '=', 'stacked'],
				],
				'popup'    => false,
			];
			if (isset($args['group'])) {
				$widget->controls[$args['control_name'] . '_icon_border_radius']['group'] = $args['group'];
			}
			if (isset($args['required'])) {
				$widget->controls[$args['control_name'] . '_icon_border_radius']['required'] = array_merge($widget->controls[$args['control_name'] . '_icon_border_radius']['required'], $args['required']);
			}
		}

		if ($args['padding']) {
			$widget->controls[$args['control_name'] . '_icon_padding'] = [
				'label'    => __('Padding', 'wpv-bu'),
				'type'     => 'dimensions',
				'css'      => [
					[
						'property' => 'padding',
						'selector' => $args['wrapper-class'] . '.bultr-view-framed .bultr-icon',
					],
					[
						'property' => 'padding',
						'selector' => $args['wrapper-class'] . '.bultr-view-stacked .bultr-icon',
					],
				],
				'required' => [
					[$args['control_name'] . '_view', '!=', 'normal'],
				],
			];
			if (isset($args['group'])) {
				$widget->controls[$args['control_name'] . '_icon_padding']['group'] = $args['group'];
			}
			if (isset($args['required'])) {
				$widget->controls[$args['control_name'] . '_icon_padding']['required'] = array_merge($widget->controls[$args['control_name'] . '_icon_padding']['required'], $args['required']);
			}
		}

		// --Hover COntrls
		if ($args['icon_hvr']) {
			$widget->controls[$args['control_name'] . '_enable_hove'] = [
				'tab'     => 'content',
				'label'   => esc_html__('Enable Hover', 'wpv-bu'),
				'type'    => 'checkbox',
				'inline'  => true,
				'small'   => true,
				'default' => false, // Default: false
			];
			if (isset($args['group'])) {
				$widget->controls[$args['control_name'] . '_enable_hove']['group'] = $args['group'];
			}
			if (isset($args['required'])) {
				$widget->controls[$args['control_name'] . '_enable_hove']['required'] = $args['required'];
			}

			if ($args['primary_color']) {
				$widget->controls[$args['control_name'] . '_primary_color_hvr'] = [
					'label'    => __('Primary Color', 'wpv-bu'),
					'type'     => 'color',
					'css'      => [
						[
							'property' => 'background-color',
							'selector' => $args['wrapper-class'] . '.bultr-view-stacked:hover .bultr-icon',
						],
						[
							'property' => 'border-color',
							'selector' => $args['wrapper-class'] . '.bultr-view-framed:hover .bultr-icon',
						],
						[
							'property' => 'color',
							'selector' => $args['wrapper-class'] . '.bultr-view-framed:hover .bultr-icon i',
						],
						[
							'property' => 'color',
							'selector' => $args['wrapper-class'] . '.bultr-view-normal:hover .bultr-icon i',
						],
						[
							'property' => 'fill',
							'selector' => $args['wrapper-class'] . '.bultr-view-framed:hover .bultr-icon svg',
						],
	
						[
							'property' => 'fill',
							'selector' => $args['wrapper-class'] . '.bultr-view-normal:hover .bultr-icon svg',
						],



					
						
					],
					'required' => [
						[$args['control_name'] . '_enable_hove', '=', true],
					],
				];
				if (isset($args['group'])) {
					$widget->controls[$args['control_name'] . '_primary_color_hvr']['group'] = $args['group'];
				}
				if (isset($args['required'])) {
					$widget->controls[$args['control_name'] . '_primary_color_hvr']['required'] = array_merge($widget->controls[$args['control_name'] . '_primary_color_hvr']['required'], $args['required']);
				}
			}
			if ($args['secondary_color']) {
				$widget->controls[$args['control_name'] . '_secondary_color_hvr'] = [
					'label'    => __('Secondary Color', 'wpv-bu'),
					'type'     => 'color',
					'css'      => [
						[
							'property' => 'color',
							'selector' => $args['wrapper-class'] . '.bultr-view-stacked:hover .bultr-icon',
						],
						[
							'property' => 'background-color',
							'selector' => $args['wrapper-class'] . '.bultr-view-framed:hover .bultr-icon',
						],
						[
							'property' => 'fill',
							'selector' => $args['wrapper-class'] . '.bultr-view-stacked:hover .bultr-icon svg',
						],
					],
					'required' => [
						[$args['control_name'] . '_view', '!=', 'normal'],
						[$args['control_name'] . '_enable_hove', '=', true],
					],
				];
				if (isset($args['group'])) {
					$widget->controls[$args['control_name'] . '_secondary_color_hvr']['group'] = $args['group'];
				}
				if (isset($args['required'])) {
					$widget->controls[$args['control_name'] . '_secondary_color_hvr']['required'] = array_merge($widget->controls[$args['control_name'] . '_secondary_color_hvr']['required'], $args['required']);
				}
			}

			if ((array_key_exists('shadow', $args)) && $args['hvr_shadow']) {
				$widget->controls[$args['control_name'] . '_hvr_box_shadow'] = [
					'tab' => 'content',
					'label' => esc_html__('BoxShadow', 'bricks'),
					'type' => 'box-shadow',
					'css' => [
						[
							'property' => 'box-shadow',
							'selector' => $args['wrapper-class'] . '.bultr-view-stacked:hover .bultr-icon',
						],
						[
							'property' => 'box-shadow',
							'selector' => $args['wrapper-class'] . '.bultr-view-framed:hover .bultr-icon',
						],
					],
					'inline' => true,
					'small' => true,
					'default' => [
						'values' => [
							'offsetX' => 0,
							'offsetY' => 0,
							'blur' => 2,
							'spread' => 0,
						],
						'color' => [
							'rgb' => 'rgba(0, 0, 0, .1)',
						],
					],
					'required' => [
						[$args['control_name'] . '_enable_hove', '=', true],
					],
				];
				if (isset($args['group'])) {
					$widget->controls[$args['control_name'] . '_hvr_box_shadow']['group'] = $args['group'];
				}
				if (isset($args['required'])) {
					$widget->controls[$args['control_name'] . '_hvr_box_shadow']['required'] = array_merge($widget->controls[$args['control_name'] . '_hvr_box_shadow']['required'], $args['required']);
				}
			}

			if ($args['rotate']) {
				$widget->controls[$args['control_name'] . '_icon_rotate_hvr'] = [
					'label'    => __('Rotate', 'wpv-bu'),
					'type'     => 'number',
					'min'      => 1,
					'max'      => 1000,
					'step'     => 1,
					'css'   => [
						[
							'selector' => '',    
							'property' => '--global_icon_hvr_rotate',
							'value' => '%sdeg',
							],
					],
					'unitless'   => true,
					'min'    => 0,
					'max'    => 360,
					'step'   => 1,
					'inline' => true,
					'required' => [
						[$args['control_name'] . '_enable_hove', '=', true],
					],
				];
				if (isset($args['group'])) {
					$widget->controls[$args['control_name'] . '_icon_rotate_hvr']['group'] = $args['group'];
				}
				if (isset($args['required'])) {
					$widget->controls[$args['control_name'] . '_icon_rotate_hvr']['required'] = array_merge($widget->controls[$args['control_name'] . '_icon_rotate_hvr']['required'], $args['required']);
				}
			}

			if ($args['border']) {
				$widget->controls[$args['control_name'] . '_icon_border_hvr'] = [
					'label'    => __('Border Radius', 'wpv-bu'),
					'type'     => 'border',
					'exclude'  => [
						'style',
						'width',
					],
					'inline'   => true,
					'css'      => [
						[
							'property' => 'border',
							'selector' => $args['wrapper-class'] . '.bultr-view-stacked:hover .bultr-icon',
						],
						[
							'property' => 'border',
							'selector' => $args['wrapper-class'] . '.bultr-view-framed:hover .bultr-icon',
						],
					],
					'required' => [
						[$args['control_name'] . '_view', '=', 'stacked'],
						[$args['control_name'] . '_enable_hove', '=', true],
					],
					'popup'    => false,
				];
				if (isset($args['group'])) {
					$widget->controls[$args['control_name'] . '_icon_border_hvr']['group'] = $args['group'];
				}
				if (isset($args['required'])) {
					$widget->controls[$args['control_name'] . '_icon_border_hvr']['required'] = array_merge($widget->controls[$args['control_name'] . '_icon_border_hvr']['required'], $args['required']);
				}
			}
		}
	}

	public function render_icon_html($widget, $settings, $control_name, $wrapper_class)
	{
		if (!isset($settings[$control_name . '_type']) && !isset($settings[$control_name . '_' . $settings[$control_name . '_type']])) {
			return;
		} else {
			$icon_type = $settings[$control_name . '_type'];
			switch ($icon_type) {
				case 'icon':
					$icon = $settings[$control_name . '_icon'];
					break;
				case 'image':
					$img        = $settings[$control_name . '_image']['id'];
					$image_size = $settings[$control_name . '_image']['size'];
					break;
				case 'text':
					$text = $settings[$control_name . '_text'];
					break;
				case 'svg':
					//echo '<pre>';  print_r($settings[$control_name . '_svg']); echo '</pre>';
					$svg_path = ! empty ($settings[$control_name . '_svg']['id']) ? get_attached_file ($settings[$control_name . '_svg']['id']) : false;
					break;
			}
			$icon_view  = $settings[$control_name . '_view'] ?? 'framed';
			$icon_shape = $settings[$control_name . '_shape'] ?? 'circle';
			$widget->remove_attribute('icon-wrapper', 'class');
			$widget->set_attribute('icon-wrapper', 'class', 'bultr-icon-wrapper');
			if (!empty($wrapper_class)) {
				$widget->set_attribute('icon-wrapper', 'class', $wrapper_class);
			}
			if (!empty($icon_view)) {
				$widget->set_attribute('icon-wrapper', 'class', 'bultr-view-' . $icon_view);
			}

			if (!empty($icon_shape)) {
				$widget->set_attribute('icon-wrapper', 'class', 'bultr-shape-' . $icon_shape);
			}
			if (!empty($icon_type)) {
				$widget->set_attribute('icon-wrapper', 'class', 'bultr-icon-type-' . $icon_type);
			}
		} ?>
		<div <?php echo $widget->render_attributes('icon-wrapper'); ?>>
			<div class="bultr-icon">
				<?php
				switch ($icon_type) {
					case 'icon':
						$icon = !empty($icon) ? Element::render_icon($icon) : false;
						echo $icon;
						break;
					case 'image':
						echo "<i class=''>" . wp_get_attachment_image($img, $image_size) . '</i>';
						break;
					case 'text':
						echo "<i class=''>$text</i>";
						break;
					case 'svg':
						$svg = $svg_path ? Helpers:: file_get_contents($svg_path) : false;
						echo '<i>' . Element::render_svg($svg, []) . '</i>';
						break;
				}
				?>
			</div>
		</div>
	<?php
	}

	public function render_repeater_icon_html($widget, $item, $settings, $global_settings, $index, $wrapper_class)
	{
		$view      = 'bultr-view-' . $global_settings['global_icon_view'];
		$shape     = 'bultr-shape-' . $global_settings['global_icon_shape'];
		$icon_type = 'bultr-icon-type-' . $global_settings['global_icon_type'];

		if (isset($item['icon_type']) && isset($item['item_custom_icon'])) {
			if ($item['view'] !== 'global') {
				$view = 'bultr-view-' . $item['view'];
			}
			if ($item['shape'] !== 'global') {
				$shape = 'bultr-shape-' . $item['shape'];
			}
			$icon_t    = $item['icon_type'];
			$icon_type = 'bultr-icon-type-' . $item['icon_type'];
			switch ($item['icon_type']) {
				case 'icon':
					$icon = $item['icon'];
					break;
				case 'image':
					$img        = $item['image']['id'];
					$image_size = isset($item['image']['size']) ? $item['image']['size'] : 'medium';
					break;
				case 'text':
					$text = $item['text'];
					break;
				case 'svg':
					$svg_path = ! empty ($item['svg']['id']) ? get_attached_file ($item ['svg'] ['id']) : false;
					break;
			}
		} else {
			$icon_t = $settings['global_icon_type'];
			switch ($settings['global_icon_type']) {
				case 'icon':
					$icon = $settings['global_icon_icon'];
					break;
				case 'image':
					$img        = $settings['global_icon_image']['id'];
					$image_size = $settings['global_icon_image']['size'];
					break;
				case 'text':
					$text = $settings['global_icon_text'];
					break;
				case 'svg':
					$svg_path = ! empty ($settings['global_icon_svg']['id']) ? get_attached_file ($settings ['global_icon_svg'] ['id']) : false;
					break;
			}
		}
		$widget->remove_attribute("icon-wrapper-{$index}", 'class');
		$widget->set_attribute("icon-wrapper-{$index}", 'class', 'bultr-icon-wrapper');
		if (!empty($wrapper_class)) {
			$widget->set_attribute("icon-wrapper-{$index}", 'class', $wrapper_class);
		}
		if (!empty($view)) {
			$widget->set_attribute("icon-wrapper-{$index}", 'class', $view);
		}
		if (!empty($shape)) {
			$widget->set_attribute("icon-wrapper-{$index}", 'class', $shape);
		}
		$widget->set_attribute("icon-type-{$index}", 'class', 'bultr-icon');
		if (!empty($icon_type)) {
			$widget->set_attribute("icon-type-{$index}", 'class', $icon_type);
		}
		
	?>
		<div <?php echo $widget->render_attributes("icon-wrapper-{$index}"); ?>>
			<div <?php echo $widget->render_attributes("icon-type-{$index}"); ?>>
				<?php
				switch ($icon_t) {
					case 'icon':
						$icon = !empty($icon) ? Element::render_icon($icon) : false;
						echo $icon;
						break;
					case 'image':
						echo "<i class=''>" . wp_get_attachment_image($img, $image_size) . '</i>';
						break;
					case 'text':
						echo "<i class=''>$text</i>";
						break;
					case 'svg':
						$svg = $svg_path ? Helpers:: file_get_contents($svg_path) : false;
						echo '<i class="bultr-svg-icon">' . Element::render_svg($svg, []) . '</i>';
						break;
				}
				?>
			</div>
		</div>
<?php
	}

	public function get_slider_controls($widget, $args)
	{
		$widget->controls[$args['control_name'] . '_slider_effect'] = [
			'tab'       => 'content',
			'label'     => esc_html__('Effect', 'wpv-bu'),
			'type'      => 'select',
			'options'   => [
				'fade'  => esc_html__('Fade', 'wpv-bu'),
				'slide' => esc_html__('Slide', 'wpv-bu'),
			],
			'inline'    => true,
			'default'   => 'slide',
			'clearable' => false,
		];
		if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_slider_effect']['group'] = $args['group'];
		}
		$widget->controls[$args['control_name'] . '_slides_per_page'] = [
			'tab'         => 'content',
			'label'       => esc_html__('Slides', 'wpv-bu'),
			'type'        => 'number',
			'breakpoints' => true,
			'default'     => 3,
			'min'         => 1,
			'placeholder' => 3,
			'required'    => [$args['control_name'] . '_slider_effect', '!=', 'fade'],
		];
		if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_slides_per_page']['group'] = $args['group'];
		}
		$widget->controls[$args['control_name'] . '_slider_speed'] = [
			'tab'     => 'content',
			'label'   => esc_html__('Speed (ms)', 'wpv-bu'),
			'type'    => 'number',
			'default' => 1000,
		];

		if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_slider_speed']['group'] = $args['group'];
		}
		$widget->controls[$args['control_name'] . '_slider_autoplay'] = [
			'tab'     => 'content',
			'label'   => esc_html__('Autoplay', 'wpv-bu'),
			'type'    => 'checkbox',
			'inline'  => true,
			'small'   => true,
			'default' => false,
		];
		if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_slider_autoplay']['group'] = $args['group'];
		}
		$widget->controls[$args['control_name'] . '_autoplay_interval'] = [
			'tab'      => 'content',
			'label'    => esc_html__('Autoplay Interval (ms)', 'wpv-bu'),
			'type'     => 'number',
			'default'  => 1000,
			'required' => [$args['control_name'] . '_slider_autoplay', '=', true],
		];
		if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_autoplay_interval']['group'] = $args['group'];
		}
		$widget->controls[$args['control_name'] . '_slide_pause_hvr'] = [
			'tab'      => 'content',
			'label'    => esc_html__('Pause on Hover', 'wpv-bu'),
			'type'     => 'checkbox',
			'inline'   => true,
			'small'    => true,
			'default'  => false,
			'required' => [$args['control_name'] . '_slider_autoplay', '=', true],
		];
		if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_slide_pause_hvr']['group'] = $args['group'];
		}
		// $widget->controls[ $args['control_name'] . '_slider_direction' ] = [
		// 	'tab'       => 'content',
		// 	'label'     => esc_html__( 'Direction', 'wpv-bu' ),
		// 	'type'      => 'select',
		// 	'options'   => [
		// 		'ltr' => esc_html__( 'Left', 'wpv-bu' ),
		// 		'rtl' => esc_html__( 'Right', 'wpv-bu' ),
		// 	],
		// 	'inline'    => true,
		// 	'default'   => 'ltr',
		// 	'clearable' => false,
		// ];
		// if ( isset( $args['group'] ) ) {
		// 	$widget->controls[ $args['control_name'] . '_slider_direction' ]['group'] = $args['group'];
		// }
		$widget->controls[$args['control_name'] . '_slider_loop'] = [
			'tab'      => 'content',
			'label'    => esc_html__('Loop', 'wpv-bu'),
			'type'     => 'checkbox',
			'inline'   => true,
			'small'    => true,
			'default'  => true,
			'required' => [$args['control_name'] . '_slider_effect', '=', 'slide'],
		];
		if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_slider_loop']['group'] = $args['group'];
		}
		$widget->controls[$args['control_name'] . '_slider_arrows'] = [
			'tab'     => 'content',
			'label'   => esc_html__('Arrows', 'wpv-bu'),
			'type'    => 'checkbox',
			'inline'  => true,
			'small'   => true,
			'default' => true,
		];
		if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_slider_arrows']['group'] = $args['group'];
		}
		$widget->controls[$args['control_name'] . '_slider_icon_prev'] = [
			'tab'       => 'content',
			'label'     => esc_html__('Icon Prev', 'wpv-bu'),
			'type'      => 'icon',
			'default'   => [
				'library' => 'themify',
				'icon'    => 'ti-angle-left',
			],
			'clearable' => false,
			'required'  => [
				[$args['control_name'] . '_slider_arrows', '!=', ''],
			],
		];
		if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_slider_icon_prev']['group'] = $args['group'];
		}
		$widget->controls[$args['control_name'] . '_slider_icon_next'] = [
			'tab'       => 'content',
			'label'     => esc_html__('Icon Next', 'wpv-bu'),
			'type'      => 'icon',
			'default'   => [
				'library' => 'themify',
				'icon'    => 'ti-angle-right',
			],
			'clearable' => false,
			'required'  => [
				[$args['control_name'] . '_slider_arrows', '!=', ''],
			],
		];
		if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_slider_icon_next']['group'] = $args['group'];
		}
		$widget->controls[$args['control_name'] . '_slider_pagination'] = [
			'tab'       => 'content',
			'label'     => esc_html__('Pagination', 'wpv-bu'),
			'type'      => 'select',
			'options'   => [
				'none'       => esc_html__('None', 'wpv-bu'),
				'pagination' => esc_html__('Pagination', 'wpv-bu'),
				'progress'   => esc_html__('Progress', 'wpv-bu'),
			],
			'inline'    => true,
			'default'   => 'pagination',
			'clearable' => false,
		];
		if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_slider_pagination']['group'] = $args['group'];
		}
		$widget->controls[$args['control_name'] . '_slider_keyboard_control'] = [
			'tab'     => 'content',
			'label'   => esc_html__('Keyboard Control', 'wpv-bu'),
			'type'    => 'checkbox',
			'inline'  => true,
			'small'   => true,
			'default' => true,
		];
		if (isset($args['group'])) {
			$widget->controls[$args['control_name'] . '_slider_keyboard_control']['group'] = $args['group'];
		}
	}

	public function ajax_refresh_insta_cache() {
		$transient_key = $_REQUEST['transient_key'];
		$all_transient_keys = $this->get_transient_keys_with_prefix('bultr_insta_fetched_data');
		foreach ( $all_transient_keys as $key ) {
			$result = delete_transient($key);
		}
		// echo"<pre>"; print_r($this->get_transient_keys_with_prefix('bultr_insta_fetched_data')); echo"</pre>";
		// echo "transit ". $transient_key;	
		// die("dedq");	
		// $result = delete_transient($transient_key);
		return wp_send_json_success( $result );
	}

	function get_transient_keys_with_prefix( $prefix ) {
		global $wpdb;
	
		$prefix = $wpdb->esc_like( '_transient_' . $prefix );
		$sql    = "SELECT `option_name` FROM $wpdb->options WHERE `option_name` LIKE '%s'";
		$keys   = $wpdb->get_results( $wpdb->prepare( $sql, $prefix . '%' ), ARRAY_A );
	
		if ( is_wp_error( $keys ) ) {
			return [];
		}
	
		return array_map( function( $key ) {
			// Remove '_transient_' from the option name.
			return ltrim( $key['option_name'], '_transient_' );
		}, $keys );
	}

	// public function __construct() {
       
    //     // add action to wp_footer to add schema to footer
	// 	add_action( 'wp_footer', array( $this, 'render_schema' ) );
    // }
	// function render_schema(){
	// 	if(self::$schemas == null){
	// 		return;
	// 	}
	// 	// loop through $schema and add schema tag to footer
	// 	foreach ( self::$schemas as $schema ) {
	// 		$video_schema = '<script type="application/ld+json" id="bultr-video-schema" >' . wp_json_encode( $schema ) . '</script>';
	// 		echo $video_schema;
	// 	}
	// }
}
