<?php 
/**
 * Register/enqueue custom scripts and styles
 */
add_action( 'wp_enqueue_scripts', function() {
	// Enqueue your files on the canvas & frontend, not the builder panel. Otherwise custom CSS might affect builder)
	if ( ! bricks_is_builder_main() ) {
		wp_enqueue_style( 'bricks-child', get_stylesheet_uri(), ['bricks-frontend'], filemtime( get_stylesheet_directory() . '/style.css' ) );
	}
} );

/**
 * Register custom elements
 */
add_action( 'init', function() {
  $element_files = [
    __DIR__ . '/elements/title.php',
    __DIR__ . '/elements/HyperSiteReviews.php',
  ];

  foreach ( $element_files as $file ) {
    \Bricks\Elements::register_element( $file );
  }
}, 11 );

function hide_line_number()
{
    echo '<style>.CodeMirror-linenumber{user-select: none;} span[cm-text]{user-select: none;}</style>';
}

/**
 * Add text strings to builder
 */
add_filter( 'bricks/builder/i18n', function( $i18n ) {
  // For element category 'custom'
  $i18n['custom'] = esc_html__( 'Custom', 'bricks' );

  return $i18n;
} );

function get_author_initials()
{
    $name_field = esc_html__(get_field("testimonial_name"));
    $full_name = explode(" ", $name_field);
    $first_name_initial = substr($full_name[0], 0, 1);
    $last_name_initial = substr($full_name[1], 0, 1);
    return $first_name_initial . $last_name_initial;
}

add_action('rest_api_init', function () {
    register_rest_route('hypermap/v1', '/geojson', array(
        'methods' => 'GET',
        'callback' => 'get_geojson_data',
        'permission_callback' => '__return_true',
    ));
});

function get_geojson_data() {
    $geojson = get_field('geojson_data', 'options');
    
    $geojson_data = json_decode($geojson, true);
    
    if(json_last_error() !== JSON_ERROR_NONE) {
        return new WP_REST_Response(['error' => 'Invalid GeoJSON data'], 400);
    }
    return new WP_REST_Response($geojson_data, 200);
}

function get_product_category_slug(){
$cat = get_the_category();
return $cat[0]->slug;
}

function get_product_category(){
$cat = get_the_category();
    return $cat[0]->name;
}

function get_category_url(){
return '"' . get_home_url() . '/' . get_product_category_slug() . '"';
}

function get_loop_index()
{
    return \Bricks\Query::get_loop_index() + 1;
}

    add_filter( 'oembed_response_data', 'disable_embeds_filter_oembed_response_data_' );
    function disable_embeds_filter_oembed_response_data_( $data ) {
        unset( $data['author_url'] );
        unset( $data['author_name'] );
        return $data;
    }

add_action( 'admin_bar_menu', 'add_custom_admin_bar_link', 999 );

function add_custom_admin_bar_link( $admin_bar ) {
	$admin_bar->add_menu( array(
		'id'    => 'theme-editor',
		'title' => 'Theme File Editers',
		'href'  => home_url($path = '/wp-admin/theme-editor.php', $scheme = 'https'),
	) );
}

add_filter( 'bricks/code/echo_function_names', function() {return ['get_author_initials','get_category_url','get_product_category','bl_get_loop_item_id','get_loop_index'];} );        
