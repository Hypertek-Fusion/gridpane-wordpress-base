<?php
namespace Bricks;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Woocommerce_Helpers {
	/**
	 * Product query controls (products, related products, upsells)
	 *
	 * @param array $args Arguments to merge (e.g. control 'group').
	 */
	public static function get_product_query_controls( $args = false ) {
		$query_controls = [
			'posts_per_page'          => [
				'tab'   => 'content',
				'label' => esc_html__( 'Products per page', 'bricks' ),
				'type'  => 'number',
				'min'   => -1,
				'step'  => 1,
			],

			'orderby'                 => [
				'tab'         => 'content',
				'label'       => esc_html__( 'Order by', 'bricks' ),
				'type'        => 'select',
				'options'     => [
					'price'      => esc_html__( 'Price', 'bricks' ),
					'popularity' => esc_html__( 'Popularity', 'bricks' ),
					'rating'     => esc_html__( 'Rating', 'bricks' ),
					'name'       => esc_html__( 'Name', 'bricks' ),
					'rand'       => esc_html__( 'Random', 'bricks' ),
					'date'       => esc_html__( 'Published date', 'bricks' ),
					'modified'   => esc_html__( 'Modified date', 'bricks' ),
					'menu_order' => esc_html__( 'Menu order', 'bricks' ),
					'id'         => esc_html__( 'Product ID', 'bricks' ),
					'_default'   => esc_html__( 'Default', 'bricks' ), // Use WP default order (@since 1.12)
				],
				'inline'      => true,
				'placeholder' => esc_html__( 'Date', 'bricks' ),
			],

			'order'                   => [
				'tab'         => 'content',
				'label'       => esc_html__( 'Order', 'bricks' ),
				'type'        => 'select',
				'options'     => [
					'ASC'  => esc_html__( 'Ascending', 'bricks' ),
					'DESC' => esc_html__( 'Descending', 'bricks' ),
				],
				'inline'      => true,
				'placeholder' => esc_html__( 'Descending', 'bricks' ),
			],

			'productType'             => [
				'tab'         => 'content',
				'label'       => esc_html__( 'Product type', 'bricks' ),
				'type'        => 'select',
				'options'     => wc_get_product_types(),
				'multiple'    => true,
				'placeholder' => esc_html__( 'Select product type', 'bricks' ),
			],

			'include'                 => [
				'tab'         => 'content',
				'label'       => esc_html__( 'Include', 'bricks' ),
				'type'        => 'select',
				'optionsAjax' => [
					'action'   => 'bricks_get_posts',
					'postType' => 'product',
				],
				'multiple'    => true,
				'searchable'  => true,
				'placeholder' => esc_html__( 'Select products', 'bricks' ),
			],

			'exclude'                 => [
				'tab'         => 'content',
				'label'       => esc_html__( 'Exclude', 'bricks' ),
				'type'        => 'select',
				'optionsAjax' => [
					'action'   => 'bricks_get_posts',
					'postType' => 'product',
				],
				'multiple'    => true,
				'searchable'  => true,
				'placeholder' => esc_html__( 'Select products', 'bricks' ),
			],

			'categories'              => [
				'tab'      => 'content',
				'label'    => esc_html__( 'Product categories', 'bricks' ),
				'type'     => 'select',
				'options'  => Woocommerce::$product_categories,
				'multiple' => true,
			],

			'tags'                    => [
				'tab'      => 'content',
				'label'    => esc_html__( 'Product tags', 'bricks' ),
				'type'     => 'select',
				'options'  => Woocommerce::$product_tags,
				'multiple' => true,
			],

			'onSale'                  => [
				'tab'   => 'content',
				'label' => esc_html__( 'On sale', 'bricks' ),
				'type'  => 'checkbox',
			],

			'featured'                => [
				'tab'   => 'content',
				'label' => esc_html__( 'Featured', 'bricks' ),
				'type'  => 'checkbox',
			],

			'hideOutOfStock'          => [
				'tab'   => 'content',
				'label' => esc_html__( 'Hide out of stock', 'bricks' ),
				'type'  => 'checkbox',
			],

			'is_archive_main_query'   => [
				'tab'    => 'content',
				'label'  => esc_html__( 'Is main query', 'bricks' ),
				'type'   => 'checkbox',
				'inline' => true,
			],

			'woo_disable_query_merge' => [
				'tab'    => 'content',
				'label'  => esc_html__( 'Disable query merge', 'bricks' ),
				'type'   => 'checkbox',
				'inline' => true,
			],
		];

		// Display info if builderQueryMaxResults is set (@since 1.11)
		$builder_query_max_results = Builder::get_query_max_results();
		if ( $builder_query_max_results ) {
			$query_controls = array_merge(
				[
					'queryMaxResultsInfo' => [
						'tab'     => 'content',
						'type'    => 'info',
						'content' => Builder::get_query_max_results_info(),
					],
				],
				$query_controls
			);
		}

		if ( is_array( $args ) ) {
			foreach ( $query_controls as $key => $control ) {
				$query_controls[ $key ] = array_merge( $query_controls[ $key ], $args );
			}
		}

		return $query_controls;
	}

	/**
	 * Default order by control options
	 */
	public static function get_default_orderby_control_options() {
		// NOTE: Undocumented
		$options = apply_filters(
			'bricks/woocommerce/products_orderby_options',
			[
				'menu_order' => esc_html__( 'Default sorting', 'bricks' ),
				'popularity' => esc_html__( 'Sort by popularity', 'bricks' ),
				'rating'     => esc_html__( 'Sort by average rating', 'bricks' ),
				'date'       => esc_html__( 'Sort by latest', 'bricks' ),
				'price'      => esc_html__( 'Sort by price: low to high', 'bricks' ),
				'price-desc' => esc_html__( 'Sort by price: high to low', 'bricks' ),
			]
		);

		return $options;
	}

	public static function get_filters_list( $flat = true ) {
		$options['other'] = [
			'reset'  => [
				'name'  => 'reset',
				'group' => 'other',
				'label' => esc_html__( 'Reset filters', 'bricks' ),
			],
			'price'  => [
				'name'  => 'price',
				'group' => 'other',
				'label' => esc_html__( 'Product price', 'bricks' ),
			],
			'rating' => [
				'name'  => 'rating',
				'group' => 'other',
				'label' => esc_html__( 'Product rating', 'bricks' ),
			],
			'stock'  => [
				'name'  => 'stock',
				'group' => 'other',
				'label' => esc_html__( 'Product stock', 'bricks' ),
			],
			'search' => [
				'name'  => 'search',
				'group' => 'other',
				'label' => esc_html__( 'Product search', 'bricks' ),
			],
		];

		// Taxonomies
		$taxonomies = get_object_taxonomies( 'product', 'objects' );

		foreach ( $taxonomies as $name => $taxonomy ) {
			$group = strpos( $name, 'pa_' ) === 0 ? 'attribute' : 'taxonomy';

			$options[ $group ][ $name ] = [
				'name'  => $name,
				'group' => $group,
				'label' => $taxonomy->label,
				'query' => 'taxonomy',
			];
		}

		if ( $flat ) {
			$options_flat = [];

			foreach ( $options as $group => $list ) {
				$options_flat = array_merge( $options_flat, $list );
			}

			return $options_flat;
		}

		return $options;
	}

	/**
	 * Is product archive page
	 *
	 * @return boolean
	 */
	public static function is_archive_product() {
		$is_default_product_archive = is_tax( 'product_cat' ) || is_tax( 'product_tag' ) || is_post_type_archive( 'product' );

		if ( $is_default_product_archive ) {
			return $is_default_product_archive;
		}

		// Check for product archive of a custom taxonomy (since 1.5)
		$queried_object = get_queried_object();

		if ( is_a( $queried_object, 'WP_Term' ) ) {
			$taxonomy = get_taxonomy( $queried_object->taxonomy );

			return isset( $taxonomy->object_type ) && in_array( 'product', $taxonomy->object_type );
		}

		return false;
	}

	/**
	 * Calculate the filters query args based on the URL parameters and element settings
	 * DO NOT early return!
	 * WooCommerce query
	 *
	 * https://github.com/woocommerce/woocommerce/wiki/wc_get_products-and-WC_Product_Query
	 * https://docs.woocommerce.com/wc-apidocs/class-WC_Product.html
	 *
	 * @since 1.5
	 *
	 * @param array  $settings The element settings.
	 * @param array  $bricks_query_var Generated query_vars from Bricks_Query.
	 * @param string $element_name The element name.
	 * @return array
	 */
	public static function filters_query_args( $settings, $bricks_query_var = [], $element_name = '' ) {
		// STEP: Convert Query Loop settings into Products settings (e.g. posts_per_page, orderby, order ...)
		if ( isset( $settings['query'] ) ) {
			$settings = wp_parse_args( $settings, $settings['query'] );
		}

		// Flag if the element is a Products element
		$is_products_element = $element_name === 'woocommerce-products';

		// STEP: Calculate the product query args
		$product_args = [];
		$tax_query    = [];

		// Check if loading a Bricks template, set preview
		if ( get_post_type() === BRICKS_DB_TEMPLATE_SLUG ) {
			$post_id      = get_the_ID();
			$preview_type = Helpers::get_template_setting( 'templatePreviewType', $post_id );

			if ( $preview_type == 'archive-term' ) {
				$preview_term = Helpers::get_template_setting( 'templatePreviewTerm', $post_id );

				if ( ! empty( $preview_term ) ) {
					$preview_term     = explode( '::', $preview_term );
					$preview_taxonomy = isset( $preview_term[0] ) ? $preview_term[0] : '';
					$preview_term_id  = isset( $preview_term[1] ) ? intval( $preview_term[1] ) : '';

					if ( $preview_taxonomy && $preview_term_id ) {
						$tax_query[ $preview_taxonomy ] = [
							'taxonomy' => $preview_taxonomy,
							'field'    => 'term_id',
							'terms'    => $preview_term_id,
						];
					}
				}
			}
			// Note: We don't need to run the check against the CPT archive preview, the products query will always return products
			// elseif ( $preview_type == 'archive-cpt' ) {
			// $template_preview_post_type = Helpers::get_template_setting( 'templatePreviewPostType', $post_id );
			// }
		}

		// Appends meta queries from filter 'woocommerce_product_query_meta_query'
		$product_args['meta_query'] = WC()->query->get_meta_query();

		// Get the product visibility terms, will be used in the query in multiple places
		$product_visibility_terms = wc_get_product_visibility_term_ids();

		// Settings: Exclude Out of Stock
		if ( isset( $settings['hideOutOfStock'] ) ) {
			$product_visibility_not_in[] = $product_visibility_terms['outofstock'];

			if ( ! empty( $product_visibility_not_in ) ) {
				$tax_query['product_visibility_not_in'] = [
					'taxonomy' => 'product_visibility',
					'field'    => 'term_taxonomy_id',
					'terms'    => $product_visibility_not_in,
					'operator' => 'NOT IN',
				];
			}
		}

		// Settings: Product type (tax_query)
		if ( ! empty( $settings['productType'] ) ) {
			$tax_query['product_type'] = [
				'taxonomy' => 'product_type',
				'field'    => 'slug',
				'terms'    => $settings['productType'],
			];
		}

		// Settings: Product category (tax_query)
		if ( ! empty( $settings['categories'] ) ) {
			$tax_query['product_cat'] = [
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $settings['categories'],
			];
		}

		// Settings: Product tag (tax_query)
		if ( ! empty( $settings['tags'] ) ) {
			$tax_query['product_tag'] = [
				'taxonomy' => 'product_tag',
				'field'    => 'term_id',
				'terms'    => $settings['tags'],
			];
		}

		// Settings: Include products
		if ( ! empty( $settings['include'] ) ) {
			$product_args['post__in'] = $settings['include'];
		}

		// Query Loop (since 1.5)
		elseif ( ! empty( $settings['post__in'] ) ) {
			$product_args['post__in'] = $settings['post__in'];
		}

		// Settings: Exclude products
		if ( ! empty( $settings['exclude'] ) ) {
			$product_args['post__not_in'] = $settings['exclude'];
		}

		// Query Loop (since 1.5)
		elseif ( ! empty( $settings['post__not_in'] ) ) {
			$product_args['post__not_in'] = $settings['post__not_in'];
		}

		// @since 1.8 - Consider exclude current post
		if ( isset( $settings['exclude_current_post'] ) ) {
			if ( is_single() || is_page() ) {
				$product_args['post__not_in'][] = get_the_ID();
			}
		}

		// Show only products on sale (post__in)
		if ( isset( $settings['onSale'] ) ) {
			$post_in                  = isset( $product_args['post__in'] ) ? $product_args['post__in'] : [];
			$product_args['post__in'] = array_merge( $post_in, wc_get_product_ids_on_sale() );

			// Ensure no products are returned if no "on sale" products are published.
			// Necessary as empty 'post__in' array returns all prodcts instead of no products (@since 1.6)
			if ( ! count( $product_args['post__in'] ) ) {
				$product_args['post__in'] = [ 999999 ];
			}
		}

		// Show only products featured (tax_query)
		if ( isset( $settings['featured'] ) ) {
			$visibility_term_ids = wc_get_product_visibility_term_ids();

			$tax_query['product_visibility'] = [
				'taxonomy' => 'product_visibility',
				'field'    => 'term_taxonomy_id',
				'terms'    => [ $visibility_term_ids['featured'] ],
			];
		}

		// Upsell (@since 1.10)
		if ( isset( $settings['upSells'] ) ) {
			// Default: Array with 0 to return no products
			$upsell_post_ids = [ 0 ];

			// Get the current product
			$product_id = Database::$page_data['preview_or_post_id'] ?? get_the_ID();
			$product    = wc_get_product( $product_id );

			// Ensure it's a product
			if ( is_a( $product, 'WC_Product' ) ) {
				// Get upsell products
				$upsell_ids = $product->get_upsell_ids();

				// Only use the upsell products if there are any
				if ( ! empty( $upsell_ids ) ) {
					$upsell_post_ids = $upsell_ids;
				}
			}

			// Set the post__in query arg and overwrite post__in
			$product_args['post__in'] = $upsell_post_ids;
		}

		// Cart Cross-sell (@since 1.10)
		if ( isset( $settings['cartCrossSells'] ) ) {
			// Default to an array with 0 to return no products
			$cross_sell_post_ids = [ 0 ];

			// Cross-sells should only get from cart data
			if ( function_exists( 'WC' ) && WC()->cart ) {
				// Get cross-sell products
				$cross_sell_ids = WC()->cart->get_cross_sells();

				// Only use the cross-sell products if there are any
				if ( ! empty( $cross_sell_ids ) ) {
					$cross_sell_post_ids = $cross_sell_ids;
				}
			}

			// Set the post__in query arg and overwrite post__in
			$product_args['post__in'] = $cross_sell_post_ids;
		}

		// Product Cross-sell (@since 1.11.1)
		if ( isset( $settings['crossSells'] ) ) {
			// Get the current product
			$product_id = Database::$page_data['preview_or_post_id'] ?? get_the_ID();
			$product    = wc_get_product( $product_id );

			// Ensure it's a product
			if ( is_a( $product, 'WC_Product' ) ) {
				// Get cross-sell products
				$cross_sell_ids = $product->get_cross_sell_ids();

				// Only use the cross-sell products if there are any
				if ( ! empty( $cross_sell_ids ) ) {
					$product_args['post__in'] = $cross_sell_ids;
				}
			}
		}

		// Related Products (@since 1.10)
		if ( isset( $settings['relatedProducts'] ) ) {
			// Get the current product
			$product_id = Database::$page_data['preview_or_post_id'] ?? get_the_ID();
			$product    = wc_get_product( $product_id );

			// Ensure it's a product
			if ( is_a( $product, 'WC_Product' ) ) {
				// Get related products
				$limit       = $settings['posts_per_page'] ?? 5;
				$related_ids = wc_get_related_products( $product_id, $limit, $product->get_upsell_ids() );

				// Only use the related products if there are any
				if ( ! empty( $related_ids ) ) {
					$product_args['post__in'] = $related_ids;
				}
			}
		}

		// Ensure post_type is set to product and product_variation for cross-sells and upsells (@since 1.10)
		if ( isset( $settings['crossSells'] ) || isset( $settings['upSells'] ) || isset( $settings['cartCrossSells'] ) ) {
			if ( ! isset( $product_args['post_type'] ) ) {
				$product_args['post_type'] = [ 'product', 'product_variation' ];
			}

			elseif ( is_array( $product_args['post_type'] ) ) {
				if ( ! in_array( 'product_variation', $product_args['post_type'] ) ) {
					$product_args['post_type'][] = 'product_variation';
				}
				if ( ! in_array( 'product', $product_args['post_type'] ) ) {
					$product_args['post_type'][] = 'product';
				}
			}

			else {
				$selected_post_type = $product_args['post_type'];
				if ( $selected_post_type !== 'product' && $selected_post_type !== 'product_variation' ) {
					$product_args['post_type'] = [ 'product', 'product_variation' ];
				} else {
					$product_args['post_type'] = [ $selected_post_type, 'product_variation', 'product' ];
				}
			}
		}

		// Posts per page
		if ( $is_products_element ) {
			// Retrieve the posts per page from the Products element settings (@since 1.11.1.1)
			$product_args['posts_per_page'] = isset( $settings['posts_per_page'] ) ? intval( $settings['posts_per_page'] ) : get_option( 'posts_per_page' );
		} else {
			// Retrieve the posts per page from the Query Loop settings
			$product_args['posts_per_page'] = isset( $bricks_query_var['posts_per_page'] ) ? intval( $bricks_query_var['posts_per_page'] ) : get_option( 'posts_per_page' );
		}

		$woo_sort_url = ''; // Sorting parameter by Products orderby element

		// Related to Filter, only run these if the 'woo_disable_query_merge' is not set
		if ( ! isset( $settings['woo_disable_query_merge'] ) ) {
			// Filter: Orderby
			if ( isset( $_GET['orderby'] ) ) {
				$woo_sort_url = sanitize_text_field( wp_unslash( $_GET['orderby'] ) );
			}

			// Filter: Rating (tax_query)
			if ( isset( $_GET['b_rating'] ) ) {
				$rating_filter = array_filter( array_map( 'absint', (array) wp_unslash( $_GET['b_rating'] ) ) );

				// Include products rated with equal or higher ratings
				if ( count( $rating_filter ) == 1 ) {
					$rating_filter = range( $rating_filter[0], 5 );
				}

				$rating_terms = [];

				foreach ( range( 1, 5 ) as $key ) {
					if ( in_array( $key, $rating_filter, true ) && isset( $product_visibility_terms[ 'rated-' . $key ] ) ) {
						$rating_terms[] = $product_visibility_terms[ 'rated-' . $key ];
					}
				}

				if ( ! empty( $rating_terms ) ) {
					$tax_query['product_visibility_rating'] = [
						'taxonomy'      => 'product_visibility',
						'field'         => 'term_taxonomy_id',
						'terms'         => $rating_terms,
						'operator'      => 'IN',
						'rating_filter' => true,
					];
				}
			}

			// Filter: Stock (meta_query)
			if ( isset( $_GET['b_stock'] ) ) {
				$filter = array_filter( array_map( 'sanitize_text_field', (array) wp_unslash( $_GET['b_stock'] ) ) );

				// Default stock query instock, outofstock or onbackorder
				$stock_defaults = wc_get_product_stock_status_options();
				$default_filter = array_intersect( $filter, array_keys( $stock_defaults ) );

				if ( ! empty( $default_filter ) ) {
					$product_args['meta_query'][] = [
						'key'     => '_stock_status',
						'value'   => $default_filter,
						'compare' => 'IN',
					];

				} elseif ( in_array( 'lowstock', $filter ) ) {
					$low_amount                             = absint( max( get_option( 'woocommerce_notify_low_stock_amount' ), 2 ) );
					$product_args['meta_query']['relation'] = 'AND';
					$product_args['meta_query'][]           = [
						'key'     => '_stock',
						'type'    => 'numeric',
						'value'   => $low_amount,
						'compare' => '<=',
					];
					$product_args['meta_query'][]           = [
						'key'     => '_stock_status',
						'value'   => 'instock',
						'compare' => '=',
					];
				}
			}

			// Filter: Search (s)
			if ( ( ! empty( $_GET['b_search'] ) || ! empty( $_GET['s'] ) ) ) {
				$product_args['s'] = ! empty( $_GET['b_search'] ) ? sanitize_text_field( $_GET['b_search'] ) : sanitize_text_field( $_GET['s'] );
			}

			// Filter: Products Pagination (paged)
			if ( ! empty( $_GET['product-page'] ) && ! isset( $settings['woo_disable_query_merge'] ) ) {
				$product_args['paged'] = sanitize_text_field( $_GET['product-page'] );
			}

			// Filter by price (meta query)
			$product_args = self::set_price_query_args( $product_args );
		}

		// Tax Query logic Start
		// Merge tax_query with the filters
		if ( ! isset( $settings['woo_disable_query_merge'] ) ) {
			// Get the possible filters list
			$filters = self::get_filters_list();

			foreach ( $filters as $name => $filter ) {
				if ( ! isset( $_GET[ 'b_' . $name ] ) || ! isset( $filter['query'] ) || 'taxonomy' != $filter['query'] ) {
					continue;
				}

				$value = wp_unslash( $_GET[ 'b_' . $name ] );

				if ( ! empty( $value ) ) {
					$terms = array_filter( array_map( 'absint', (array) $value ) );

					if ( array_key_exists( $name, $tax_query ) ) {
						$terms = array_intersect( $terms, (array) $tax_query[ $name ]['terms'] );
					}

					$tax_query[ $name ] = [
						'taxonomy' => $name,
						'field'    => 'term_id',
						'terms'    => $terms,
					];
				}
			}
		}

		// Add tax_query to the main query args
		if ( ! empty( $tax_query ) ) {
			$tax_query = array_values( $tax_query );

			if ( count( $tax_query ) > 1 ) {
				$tax_query['relation'] = 'AND';
			}
		}

		$product_args['tax_query'] = WC()->query->get_tax_query( $tax_query, false );

		unset( $tax_query );
		// Tax Query logic End

		// Order & Orderby
		// Has sorting parameter, directly use the orderby and order generated by WooCommerce
		if ( $woo_sort_url !== '' ) {
			// Using the sorting parameter from Products orderby element
			if ( $woo_sort_url == 'price' ) {
				$woo_sort_url = 'price-asc';
			}

			if ( $woo_sort_url == 'date' ) {
				$woo_sort_url = 'date-desc';
			}

			$orderby_value = explode( '-', $woo_sort_url ); // e.g. orderby=price-desc
			$wc_order_by   = esc_attr( $orderby_value[0] );
			$wc_order      = strtoupper( isset( $orderby_value[1] ) && ! empty( $orderby_value[1] ) ? $orderby_value[1] : '' );

			// @see: WC_Shortcode_Products::parse_query_args() [woocommerce/includes/shortcodes/class-wc-shortcode-products.php]
			// price, popularity, and rating will add posts_clauses to the query
			$ordering_args           = WC()->query->get_catalog_ordering_args( $wc_order_by, $wc_order );
			$product_args['orderby'] = $ordering_args['orderby'];
			$product_args['order']   = $ordering_args['order'];

			// Ordering by meta key
			if ( $ordering_args['meta_key'] ) {
				$product_args['meta_key'] = $ordering_args['meta_key'];
			}

		}

		// Use the orderby and order from the element settings
		else {

			// Check if this query loop has order settings (not products element)
			$query_loop_has_order_settings = ! $is_products_element && isset( $bricks_query_var['orderby'] );

			// If this is products element or the query loop without order settings, use WooCommerce default order settings
			if ( $is_products_element || ! $query_loop_has_order_settings ) {
				$products_element_orderby = $is_products_element && ! empty( $settings['orderby'] ) && is_string( $settings['orderby'] ) ? $settings['orderby'] : 'date';
				$products_element_order   = $is_products_element && ! empty( $settings['order'] ) && is_string( $settings['order'] ) ? $settings['order'] : 'DESC';

				// orderby already unset if this is query loop with order settings, check if brx_default_orderby is set (@since 1.12)
				$query_loop_use_wp_default = ! $is_products_element && isset( $bricks_query_var['brx_default_orderby'] );

				// Default Woo Sorting (@since 1.12)
				if ( $products_element_orderby === '_default' || $query_loop_use_wp_default ) {
					$products_element_orderby = '';
					$products_element_order   = '';
				}

				$orderby_value = explode( '-', $products_element_orderby ); // e.g. orderby=price-desc
				$wc_order_by   = esc_attr( $orderby_value[0] );
				$wc_order      = strtoupper( isset( $orderby_value[1] ) && ! empty( $orderby_value[1] ) ? $orderby_value[1] : $products_element_order );

				// @see: WC_Shortcode_Products::parse_query_args() [woocommerce/includes/shortcodes/class-wc-shortcode-products.php]
				// price, popularity, and rating will add posts_clauses to the query
				$ordering_args = WC()->query->get_catalog_ordering_args( $wc_order_by, $wc_order );

				if ( isset( $ordering_args['orderby'] ) ) {
					$product_args['orderby'] = $ordering_args['orderby'];
				}

				if ( isset( $ordering_args['order'] ) ) {
					$product_args['order'] = $ordering_args['order'];
				}

				// Ordering by meta key
				if ( isset( $ordering_args['meta_key'] ) ) {
					$product_args['meta_key'] = $ordering_args['meta_key'];
				}
			}

			// Query loop with user defined orderby and order settings
			else {

				// Query loop with user defined orderby and order settings
				$product_args['orderby'] = $bricks_query_var['orderby'] ?? 'date'; // Default orderby
				$product_args['order']   = $bricks_query_var['order'] ?? 'DESC'; // Default order

				// Ordering by meta key
				if ( isset( $bricks_query_var['meta_key'] ) ) {
					$product_args['meta_key'] = $bricks_query_var['meta_key'];
				}
			}
		}

		return $product_args;
	}

	/**
	 * Set query args for price filter
	 *
	 * @param array $args
	 * @return array
	 */
	public static function set_price_query_args( $args ) {
		if ( ! isset( $_GET['max_price'] ) && ! isset( $_GET['min_price'] ) ) {
			return $args;
		}

		$value_min = isset( $_GET['min_price'] ) ? floatval( wp_unslash( $_GET['min_price'] ) ) : 0;
		$value_max = isset( $_GET['max_price'] ) ? floatval( wp_unslash( $_GET['max_price'] ) ) : PHP_INT_MAX;

		if ( wc_tax_enabled() && 'incl' === get_option( 'woocommerce_tax_display_shop' ) && ! wc_prices_include_tax() ) {
			$tax_class = apply_filters( 'woocommerce_price_filter_widget_tax_class', '' );
			$tax_rates = WC_Tax::get_rates( $tax_class );

			if ( $tax_rates ) {
				$value_min -= WC_Tax::get_tax_total( WC_Tax::calc_inclusive_tax( $value_min, $tax_rates ) );
				$value_max -= WC_Tax::get_tax_total( WC_Tax::calc_inclusive_tax( $value_max, $tax_rates ) );
			}
		}

		$args['meta_query'][] = [
			'key'     => '_price',
			'value'   => [ $value_min, $value_max ],
			'compare' => 'BETWEEN',
			'type'    => 'NUMERIC',
		];

		return $args;
	}

	/**
	 * Gets the first element from a flat list that contains a products query (Products element or Query Loop builder set to products)
	 *
	 * @since 1.5
	 *
	 * @param array $data
	 * @return array|boolean
	 */
	public static function get_products_element( $data = [] ) {
		// Get data from Database::$active_templates instead of $post_id (@since 1.9.5)
		$data = ! empty( $data ) ? $data : Database::get_data( Database::$active_templates['content'], 'content' );

		if ( empty( $data ) || ! is_array( $data ) ) {
			return false;
		}

		foreach ( $data as $element ) {
			if (
				$element['name'] === 'woocommerce-products' ||
				(
					isset( $element['settings']['hasLoop'] ) &&
					! empty( $element['settings']['query']['post_type'] ) &&
					in_array( 'product', $element['settings']['query']['post_type'] ) &&
					( empty( $element['settings']['query']['objectType'] ) || $element['settings']['query']['objectType'] == 'post' )
				)
			 ) {
				return $element;
			}
		}

		return false;
	}

	/**
	 * Get the products query based on a Products element present in the content of a page
	 *
	 * @param string $post_id
	 * @return WP_Query|boolean false if products element not found
	 */
	public static function get_products_element_query( $post_id ) {
		$cache_key = "get_products_element_query_$post_id";

		$query = wp_cache_get( $cache_key, 'bricks' );

		if ( $query !== false ) {
			return $query;
		}

		$query_element = self::get_products_element();

		if ( ! $query_element ) {
			return false;
		}

		// Force the post type to feed the Bricks Query class
		if ( empty( $query_element['settings']['query'] ) ) {
			$query_element['settings']['query'] = [
				'post_type'           => [ 'product' ],
				'ignore_sticky_posts' => 1
			];
		}
		// Query
		$query_object = new Query( $query_element );

		$query = $query_object->query_result;

		// Infinite loop if query is empty result inside builder (@since 1.8.2) (#862k16hwz)
		$query_object->destroy();

		wp_cache_set( $cache_key, $query, 'bricks', MINUTE_IN_SECONDS );

		return $query;
	}

	/**
	 * Helper function to set the cart variables for better builder preview
	 *
	 * @return void
	 */
	public static function maybe_init_cart_context() {
		if ( is_cart() ) {
			return;
		}

		wc_maybe_define_constant( 'WOOCOMMERCE_CART', true );

		// Check cart items are valid
		do_action( 'woocommerce_check_cart_items' );

		// Calculate totals
		if ( WC()->cart ) {
			WC()->cart->calculate_totals();
		}
	}

	/**
	 * Maybe add products to the cart if cart is empty for better builder preview
	 *
	 * @since 1.5
	 *
	 * @return void
	 */
	public static function maybe_populate_cart_contents() {
		if ( WC()->cart->is_empty() && ( bricks_is_builder() || bricks_is_builder_call() ) ) {
			$products = wc_get_products( [ 'limit' => 5 ] );

			if ( $products ) {
				foreach ( $products as $product ) {
					if ( $product->is_purchasable() ) {
						WC()->cart->add_to_cart( $product->get_id() );
					}
				}
			}
		}
	}

	/**
	 * Maybe load the cart - render using WP REST API
	 *
	 * @since 1.5
	 */
	public static function maybe_load_cart() {
		if ( bricks_is_builder_call() && is_null( WC()->cart ) ) {
			wc_load_cart();
		}
	}

	/**
	 * Add or remove actions in the repeated_wc_template_hooks
	 *
	 * Used in {do_action} which the action is inside the repeated_wc_template_hooks hooks
	 * To avoid duplicate ouput which already exists in Bricks elements
	 *
	 * @since 1.7
	 *
	 * @param string $template required (ex: 'content-single-product', 'content-product').
	 * @param string $action remove, add.
	 * @param string $hook optional.
	 *
	 * @return void
	 */
	public static function execute_actions_in_wc_template( $template = '', $action = 'remove', $hook = '' ) {
		if ( ! $template ) {
			return;
		}

		$hooks = self::repeated_wc_template_hooks( $template );

		// No supported hooks found
		if ( ( empty( $hooks ) || ! is_array( $hooks ) ) && ! in_array( $hook, array_keys( $hooks ) ) ) {
			return;
		}

		$do = $action === 'remove' ? 'remove_action' : 'add_action';

		$target_hook = $hooks;

		// Remove or add a specific action
		if ( $hook != '' ) {
			// Check if the hook exists
			$target_hook = array_filter(
				$hooks,
				function( $key ) use ( $hook ) {
					return $key === $hook;
				},
				ARRAY_FILTER_USE_KEY
			);

			if ( empty( $target_hook ) ) {
				return;
			}
		}

		// Remove or add the actions
		foreach ( $target_hook as $hook_name => $hook_details ) {
			$actions = $hook_details['actions'];

			foreach ( $actions as $action ) {
				$do( $hook_name, $action['callback'], $action['priority'] );
			}
		}
	}

	/**
	 * All woo template hooks that might be causing duplicated ouput when using together with Bricks WooCommerce elements
	 *
	 * @see woocommerce/includes/wc-template-hooks.php
	 *
	 * @since 1.7
	 *
	 * @param string $template
	 *
	 * @return array
	 */
	public static function repeated_wc_template_hooks( $template = '' ) {
		// @see woocommerce/templates/content-product.php
		$hooks['content-product'] = [
			'woocommerce_before_shop_loop_item'       => [
				'label'   => esc_html( 'Before shop loop item', 'bricks' ),
				'actions' => [
					[
						// Not needed
						'callback' => 'woocommerce_template_loop_product_link_open',
						'priority' => 10
					],
				],
			],
			'woocommerce_before_shop_loop_item_title' => [
				'label'   => esc_html( 'Before shop loop item title', 'bricks' ),
				'actions' => [
					[
						// Not needed, can set at Bricks settings
						'callback' => 'woocommerce_show_product_loop_sale_flash',
						'priority' => 10
					],
					[
						// Should use {featured_image}
						'callback' => 'woocommerce_template_loop_product_thumbnail',
						'priority' => 10
					],
				],
			],
			'woocommerce_shop_loop_item_title'        => [
				'label'   => esc_html( 'Shop loop item title', 'bricks' ),
				'actions' => [
					[
						// Should use Product title element.
						'callback' => 'woocommerce_template_loop_product_title',
						'priority' => 10
					],
				],
			],
			'woocommerce_after_shop_loop_item_title'  => [
				'label'   => esc_html( 'After shop loop item title', 'bricks' ),
				'actions' => [
					[
						// Should use {woo_product_rating}
						'callback' => 'woocommerce_template_loop_rating',
						'priority' => 5
					],
					[
						// Should use Product price element.
						'callback' => 'woocommerce_template_loop_price',
						'priority' => 10
					],
				],
			],
			'woocommerce_after_shop_loop_item'        => [
				'label'   => esc_html( 'After shop loop item', 'bricks' ),
				'actions' => [
					[
						// Not needed
						'callback' => 'woocommerce_template_loop_product_link_close',
						'priority' => 5
					],
					[
						// Should use Add to cart element.
						'callback' => 'woocommerce_template_loop_add_to_cart',
						'priority' => 10
					],
				],
			],
		];

		// @see woocommerce/templates/content-single-product.php
		$hooks['content-single-product'] = [
			'woocommerce_before_single_product'         => [
				'label'   => esc_html( 'Before single product', 'bricks' ),
				'actions' => [
				// [
				// Notices should be handled by the new WooCommerce notice element.
				// 'callback' => 'woocommerce_output_all_notices',
				// 'priority' => 10
				// ],
				],
			],
			'woocommerce_before_single_product_summary' => [
				'label'   => esc_html( 'Before single product summary', 'bricks' ),
				'actions' => [
					[
						// Not needed, can use {woo_product_on_sale}
						'callback' => 'woocommerce_show_product_sale_flash',
						'priority' => 10
					],
					[
						// Should use Product gallery element, or {featured_image}
						'callback' => 'woocommerce_show_product_images',
						'priority' => 20
					],
				],
			],
			'woocommerce_single_product_summary'        => [
				'label'   => esc_html( 'Single product summary', 'bricks' ),
				'actions' => [
					[
						// Should use Product title element
						'callback' => 'woocommerce_template_single_title',
						'priority' => 5
					],
					[
						// Should use Product rating element
						'callback' => 'woocommerce_template_single_rating',
						'priority' => 10
					],
					[
						// Should use Product price element
						'callback' => 'woocommerce_template_single_price',
						'priority' => 10
					],
					[
						// Should use Product short description element
						'callback' => 'woocommerce_template_single_excerpt',
						'priority' => 20
					],
					[
						// Should use Add to cart element
						'callback' => 'woocommerce_template_single_add_to_cart',
						'priority' => 30
					],
					[
						// Should use Product meta element
						'callback' => 'woocommerce_template_single_meta',
						'priority' => 40
					],
					[
						// Can use {do_action:woocommerce_share} in anywhere
						'callback' => 'woocommerce_template_single_sharing',
						'priority' => 50
					],
				],
			],
			'woocommerce_after_single_product_summary'  => [
				'label'   => esc_html( 'After single product summary', 'bricks' ),
				'actions' => [
					[
						// Should use Products tabs element
						'callback' => 'woocommerce_output_product_data_tabs',
						'priority' => 10
					],
					[
						// Should use Product up/cross-sells element
						'callback' => 'woocommerce_upsell_display',
						'priority' => 15
					],
					[
						// Should use Related products element
						'callback' => 'woocommerce_output_related_products',
						'priority' => 20
					],
				],
			],
		];

		// @see woocommerce/templates/archive-product.php
		$hooks['archive-product'] = [
			'woocommerce_before_main_content' => [
				'label'   => esc_html( 'Before main content', 'bricks' ),
				'actions' => [
					[
						// This will wrap the content, not necessary as user should design by layout elements
						'callback' => 'woocommerce_output_content_wrapper',
						'priority' => 10
					],
					[
						// Should use Breadcumbs element
						'callback' => 'woocommerce_breadcrumb',
						'priority' => 20
					],
				],
			],
			'woocommerce_archive_description' => [
				'label'   => esc_html( 'Archive description', 'bricks' ),
				'actions' => [
					[
						// Should use Products archive description element
						'callback' => 'woocommerce_taxonomy_archive_description',
						'priority' => 10
					],
					[
						// Should use Products archive description element
						'callback' => 'woocommerce_product_archive_description',
						'priority' => 10
					],
				],
			],
			'woocommerce_before_shop_loop'    => [
				'label'   => esc_html( 'Before shop loop', 'bricks' ),
				'actions' => [
					// [
					// Notices should be handled by the new WooCommerce notice element.
					// 'callback' => 'woocommerce_output_all_notices',
					// 'priority' => 10
					// ],
					[
						// Should use Products total results element
						'callback' => 'woocommerce_result_count',
						'priority' => 20
					],
					[
						// Should use Products orderby element
						'callback' => 'woocommerce_catalog_ordering',
						'priority' => 30
					],
				],
			],
			'woocommerce_after_shop_loop'     => [
				'label'   => esc_html( 'After shop loop', 'bricks' ),
				'actions' => [
					[
						// Should use Products pagination element
						'callback' => 'woocommerce_pagination',
						'priority' => 10
					],
				],
			],
			'woocommerce_after_main_content'  => [
				'label'   => esc_html( 'After main content', 'bricks' ),
				'actions' => [
					[
						// This will wrap the content, not necessary as user should design by layout elements
						'callback' => 'woocommerce_output_content_wrapper_end',
						'priority' => 10
					],
				],
			],
		];

		// @see woocommerce/templates/cart/cart.php
		$hooks['cart'] = [
			'woocommerce_before_cart' => [
				'label'   => esc_html( 'Before cart', 'bricks' ),
				'actions' => [
					// [
					// Notices should be handled by the new WooCommerce notice element.
					// 'callback' => 'woocommerce_output_all_notices',
					// 'priority' => 10
					// ],
				],
			],
		];

		// @see woocommerce/templates/cart/cart-empty.php
		$hooks['cart-empty'] = [
			'woocommerce_cart_is_empty' => [
				'label'   => esc_html( 'Cart is empty', 'bricks' ),
				'actions' => [
					// [
					// Notices should be handled by the new WooCommerce notice element.
					// 'callback' => 'woocommerce_output_all_notices',
					// 'priority' => 5
					// ],
					[
						// Empty messages should be freely customized by the user with any element.
						'callback' => 'wc_empty_cart_message',
						'priority' => 10
					],
				],
			],
		];

		if ( ! empty( $template ) ) {
			return isset( $hooks[ $template ] ) ? $hooks[ $template ] : [];
		}

		return $hooks;
	}

	/**
	 * Find the template hooks array by using the action name.
	 *
	 * @since 1.7
	 *
	 * @param string $action
	 *
	 * @return array
	 */
	public static function get_repeated_wc_template_hooks_by_action( $action = '' ) {
		if ( empty( $action ) ) {
			return [];
		}

		$repeated_hooks = self::repeated_wc_template_hooks();

		$template = array_filter(
			$repeated_hooks,
			function ( $hooks ) use ( $action ) {
				return in_array( $action, array_keys( $hooks ) );
			}
		);

		return $template;
	}

	/**
	 * Bricks helper function to render the product rating.
	 * single-product/rating.php
	 *
	 * @param WC_Product $product Product instance.
	 * @param array      $params  Keys: show_empty_stars, hide_reviews_link, $wrapper.
	 * @param bool       $render  Render (echo) or return.
	 *
	 * @since 1.8
	 */
	public static function render_product_rating( $product = null, $params = [], $render = true ) {
		if ( ! is_a( $product, 'WC_Product' ) || ! wc_review_ratings_enabled() ) {
			return;
		}

		$show_empty_stars  = isset( $params['show_empty_stars'] ) ? $params['show_empty_stars'] : true;
		$hide_reviews_link = isset( $params['hide_reviews_link'] ) ? $params['hide_reviews_link'] : true;
		$wrapper           = isset( $params['wrapper'] ) ? $params['wrapper'] : true;

		$rating_count = $product->get_rating_count();
		$review_count = $product->get_review_count();
		$average      = $product->get_average_rating();

		$html = '';

		if ( $rating_count > 0 || $show_empty_stars ) {
			// Add filter to show empty star
			if ( $show_empty_stars ) {
				add_filter( 'woocommerce_product_get_rating_html', [ '\Bricks\Woocommerce_Helpers', 'show_empty_stars' ], 10, 3 );
			}

			// Populate rating html
			$html .= $wrapper ? '<div class="woocommerce-product-rating">' : '';
			$html .= wc_get_rating_html( $average, $rating_count );

			// Populate review link
			if ( comments_open() && ! $hide_reviews_link ) {
				$html .= '<a href="#reviews" class="woocommerce-review-link" rel="nofollow">';
				// translators: %s: review count
				$html .= sprintf( _n( '%s customer review', '%s customer reviews', $review_count, 'woocommerce' ), '<span class="count">' . esc_html( $review_count ) . '</span>' );
				$html .= '</a>';
			}

			$html .= $wrapper ? '</div>' : '';

			// Remove filter
			if ( $show_empty_stars ) {
				remove_filter( 'woocommerce_product_get_rating_html', [ '\Bricks\Woocommerce_Helpers', 'show_empty_stars' ], 10, 3 );
			}
		}

		// Render or return (for dynamic data tag {woo_product_rating})
		if ( $render ) {
			echo $html;
		} else {
			return $html;
		}
	}

	/**
	 * Hooked to woocommerce_product_get_rating_html
	 *
	 * @since 1.8
	 */
	public static function show_empty_stars( $html, $rating, $count ) {
		// translators: %s: rating
		$label = sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $rating );
		$html  = '<div class="star-rating" role="img" aria-label="' . esc_attr( $label ) . '">' . wc_get_star_rating_html( $rating, $count ) . '</div>';

		return $html;
	}

	/**
	 * Get product stock amount value
	 *
	 * Previously in get_stock_html(), but refactored into a separate function for reusability and readability.
	 * Bare in mind if the product is not managed stock, the value will be 0 even stock status is instock.
	 *
	 * @param \WC_Product $product
	 * @return int
	 *
	 * @since 1.6.1
	 * @since 1.11.1: Moved here from provider-woo.php.
	 */
	public static function get_stock_amount( $product ) {
		$stock_amount = $product->get_stock_quantity();

		if ( $product->is_type( 'variable' ) ) {
			$variations = $product->get_available_variations();

			foreach ( $variations as $variation ) {
				if ( empty( $variation['is_in_stock'] ) ) {
					continue;
				}

				$variation_obj = new \WC_Product_variation( $variation['variation_id'] );

				$stock_amount += $variation_obj->get_stock_quantity();
			}
		}

		return (int) $stock_amount; // Possible to return negative value when using backorders (#861n84vua)
	}

	/**
	 * Similar function to wc_format_stock_for_display but adapted to be possible to use the stock sum up of the product variations
	 *
	 * @since 1.5.7
	 * @since 1.11.1: Moved here from provider-woo.php.
	 */
	public static function format_stock_for_display( $product, $stock_amount ) {
		$display = __( 'In stock', 'woocommerce' );

		switch ( get_option( 'woocommerce_stock_format' ) ) {
			case 'low_amount':
				if ( $stock_amount <= wc_get_low_stock_amount( $product ) ) {
					/* translators: %s: stock amount */
					$display = sprintf( __( 'Only %s left in stock', 'woocommerce' ), wc_format_stock_quantity_for_display( $stock_amount, $product ) );
				}
				break;
			case '':
				/* translators: %s: stock amount */
				$display = sprintf( __( '%s in stock', 'woocommerce' ), wc_format_stock_quantity_for_display( $stock_amount, $product ) );
				break;
		}

		if ( $product->backorders_allowed() && $product->backorders_require_notification() ) {
			$display .= ' ' . __( '(can be backordered)', 'woocommerce' );
		}

		return $display;
	}
}
