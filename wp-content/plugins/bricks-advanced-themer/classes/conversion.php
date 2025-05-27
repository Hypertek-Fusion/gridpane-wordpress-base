<?php
namespace Advanced_Themer_Bricks;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AT__Conversion{
    private static function set_option_as_converted($key) {
        $option = get_option('bricks_advanced_themer_builder_settings', []);
    
    
        if (!isset($option['converted']) || !is_array($option['converted'])) {
            $option['converted'] = [];
        }
    
        $option['converted'][$key] = 1;
    
        update_option('bricks_advanced_themer_builder_settings', $option);
    }

    private static function set_grid_utility_classes_as_converted(){
        $option = get_option('bricks_advanced_themer_builder_settings', []);

        if( !AT__Helpers::is_array($option, 'converted') ){
            $option['converted'] = [];
        }

        $option['converted']['grid_utility_classes'] = 1;

        update_option('bricks_advanced_themer_builder_settings', $option);
    }

    private static function has_entry_with_name($array, $name) {
        if(AT__Helpers::is_array($array)){
            foreach ($array as $entry) {
                if ($entry['name'] === $name) {
                    return $entry;
                }
            }
        }
        return false;
    }

    /**
     * Main function to convert grid utility classes.
     */
    public static function convert_grid_utility_classes() {
        if ( (defined('BRICKS_ADVANCED_THEMER_GRID_UTILITY_CLASSES_CONVERTED') && BRICKS_ADVANCED_THEMER_GRID_UTILITY_CLASSES_CONVERTED === true) || !AT__Helpers::is_grids_tab_activated()) {
            return;
        }

        $global_classes = get_option('bricks_global_classes', []);
        $global_classes_cats = get_option('bricks_global_classes_categories', []);

        if (have_rows('field_63b59j871b209', 'bricks-advanced-themer')) :
            while (have_rows('field_63b59j871b209', 'bricks-advanced-themer')) : the_row();

                if (have_rows('field_63b48c6f1b20a', 'bricks-advanced-themer')) :
                    // Ensure category is added if not already present
                    self::ensure_grid_utility_category_exists($global_classes_cats);

                    while (have_rows('field_63b48c6f1b20a', 'bricks-advanced-themer')) :
                        the_row();

                        // Prepare the grid utility data
                        $item = self::prepare_grid_utility_data();

                        // Check and update the class or create a new one
                        self::update_or_create_grid_class($global_classes, $item);

                    endwhile;
                endif;

            endwhile;
        endif;

        update_option('bricks_global_classes', $global_classes);
        self::set_option_as_converted('grid_utility_classes_3_1_4');
    }

    /**
     * Ensures that the grid utility classes category exists in the global classes categories.
     *
     * @param array &$global_classes_cats The global classes categories.
     */
    private static function ensure_grid_utility_category_exists(&$global_classes_cats) {
        if (!in_array("brxc_grid_utility_classes", array_column($global_classes_cats, 'id'))) {
            $global_classes_cats[] = [
                "id"   => "brxc_grid_utility_classes",
                "name" => "Grid Utility Classes",
            ];
            update_option('bricks_global_classes_categories', $global_classes_cats);
        }
    }

    /**
     * Prepares the grid utility data for the current item.
     *
     * @return array The prepared grid utility data.
     */
    private static function prepare_grid_utility_data() {
        return [
            "name"  => get_sub_field('field_63b48c6f1b20b', 'bricks-advanced-themer'),
            "gap"   => get_sub_field('field_63b48d7e1b20e', 'bricks-advanced-themer'),
            "cols"  => get_sub_field('field_63b48c6f1b20c', 'bricks-advanced-themer'),
            "width" => get_sub_field('field_63b48c6f1b20d', 'bricks-advanced-themer'),
        ];
    }

    /**
     * Updates the global classes array by either updating an existing class or creating a new one.
     *
     * @param array &$global_classes The global classes array.
     * @param array $item The grid utility item.
     */
    private static function update_or_create_grid_class(&$global_classes, $item) {
        $id = 'brxc_grid_' . $item["name"];
        $classFound = false;

        foreach ($global_classes as &$class) {
            if ($class['id'] === $id) {
                $class['category'] = 'brxc_grid_utility_classes';
                $class['gridUtility'] = true;
                $class['settings'] = self::generate_grid_class_settings($item);
                $classFound = true;
                break;
            }
        }

        unset($class); // Ensure the reference doesn't persist

        // If class was not found, create a new one
        if (!$classFound) {
            $new_class = [
                'id' => $id,
                'category' => 'brxc_grid_utility_classes',
                'gridUtility' => true,
                'settings' => self::generate_grid_class_settings($item)
            ];
            $global_classes[] = $new_class;
        }
    }

    /**
     * Generates the settings array for a grid utility class.
     *
     * @param array $item The grid utility item.
     * @return array The generated settings.
     */
    private static function generate_grid_class_settings($item) {
        return [
            "gridUtilityGap" => $item['gap'],
            "gridUtilityCols" => $item['cols'],
            "gridUtilityWidth" => $item['width'],
            "_display" => "grid",
            "_gridGap" => "var(--grid-layout-gap)",
            "_cssCustom" => "/* SCOPED VARIABLES */\n.{$item['name']} {\n\t--grid-column-count: {$item['cols']};\n\t--grid-item--min-width: {$item['width']}px;\n\t--grid-layout-gap: {$item['gap']};\n\tgrid-template-columns: repeat(auto-fit, minmax(min(100%, var(--grid-item--min-width)), 1fr))\n}\n\n/* RESPONSIVE CODE */\n@media screen and (min-width: 781px){\n\tbody .{$item['name']} {\n\t\t--gap-count: calc(var(--grid-column-count) - 1);\n\t\t--total-gap-width: calc(var(--gap-count) * var(--grid-layout-gap));\n\t\t--grid-item--max-width: calc((100% - var(--total-gap-width)) / var(--grid-column-count));\n\t\tgrid-template-columns: repeat(auto-fill, minmax(max(var(--grid-item--min-width), var(--grid-item--max-width)), 1fr));\n\t}\n}"
        ];
    }
  
    public static function convert_clamp_settings() {
        global $brxc_acf_fields;
        
        if (defined('BRICKS_ADVANCED_THEMER_CLAMP_SETTINGS_CONVERTED') && BRICKS_ADVANCED_THEMER_CLAMP_SETTINGS_CONVERTED) {
            return;
        }
    
        $categories = get_option('bricks_global_variables_categories', []);
        $variables = get_option('bricks_global_variables', []);
    
        function item_exists($array, $id) {
            if(AT__Helpers::is_array($array)) {
                foreach ($array as $item) {
                    if (isset($item['id']) && $item['id'] === $id) {
                        return true;
                    }
                }
            }
            return false;
        }
    
        if (!item_exists($categories, 'at_clamp-settings')) {
            $categories[] = [
                'id' => 'at_clamp-settings',
                'name' => 'AT - Clamp Settings',
            ];
        }
    
        $new_variables = [
            [
                'id' => 'at_min-viewport',
                'name' => 'min-viewport',
                'value' => $brxc_acf_fields['min_vw'] ?? '360',
                'category' => 'at_clamp-settings'
            ],
            [
                'id' => 'at_max-viewport',
                'name' => 'max-viewport',
                'value' => $brxc_acf_fields['max_vw'] ?? '1600',
                'category' => 'at_clamp-settings'
            ],
            [
                'id' => 'at_base-font',
                'name' => 'base-font',
                'value' => $brxc_acf_fields['base_font'] ?? '10',
                'category' => 'at_clamp-settings'
            ],
            [
                'id' => 'at_clamp-unit',
                'name' => 'clamp-unit',
                'value' => '1' . ($brxc_acf_fields['clamp_unit'] ?? 'vw'),
                'category' => 'at_clamp-settings'
            ]
        ];
    
        foreach ($new_variables as $variable) {
            if (!item_exists($variables, $variable['id'])) {
                $variables[] = $variable;
            }
        }
    
        update_option('bricks_global_variables_categories', $categories);
        update_option('bricks_global_variables', $variables);
    
        self::set_option_as_converted('clamp_settings');
    }    

    public static function convert_global_css_variables(){

        // Skip if already converted
        if(defined(BRICKS_ADVANCED_THEMER_CSS_VARIABLES_CONVERTED) && BRICKS_ADVANCED_THEMER_CSS_VARIABLES_CONVERTED === true) return;

        // CSS Variables are disabled inside the theme settings
        if(!AT__helpers::is_css_variables_category_activated()){
            self::set_option_as_converted('global_css_variables');
            return;
        }

        global $brxc_acf_fields;
        global $wpdb;

        $prefix = strtolower($brxc_acf_fields['global_prefix']);
        $categories = get_option('bricks_global_variables_categories', []);
        $variables = get_option('bricks_global_variables', []);
        $themesArray = get_option('bricks_theme_styles', []);

        foreach ($themesArray as &$theme) {
            if (($theme['settings']['general']['_cssVariables'] ?? null) !== null) {
                foreach ($theme['settings']['general']['_cssVariables'] as &$variable) {
                    
                    // Add prefix
                    if (AT__Helpers::is_value($variable, 'name') && is_string($variable['name']) ){ 
                        $name_final = $prefix !== '' ? $prefix . '-' . $variable['name'] : $variable['name'];
                        $variable['name'] = $name_final;
                    }

                    // Convert group name into group id
                    if (AT__Helpers::is_value($variable, 'group') && is_string($variable['group'])) {

                        // Category
                        $entry = self::has_entry_with_name($categories, $variable['group']);

                        if($entry === false){
                            $category_id = AT__Helpers::generate_unique_string(6);
                            $categories[] = [
                                'id'    => $category_id,
                                'name'  => $variable['group']
                            ];
                        } else {
                            $category_id = $entry['id'];
                        }

                        $variable['category'] = $category_id;
                        unset($variable['group']);
                    }
                    // Remove "order" property
                    if (isset($variable['order'])) {
                        unset($variable['order']); 
                    }

                    // Convert Clamp Values
                    if(isset($variable['type']) && $variable['type'] === "clamp" && isset($variable['min']) && isset($variable['max'])){
                        $variable['value'] = AT__Helpers::clamp_builder((float) $variable['min'], (float) $variable['max']);
                    }
                }
            }
        }
        if(is_array($themesArray) && !empty($themesArray)){
            update_option( 'bricks_theme_styles', $themesArray );
        }

        // Convert Global Variables saved in ACF
        if ( have_rows( 'field_6445ab9f3d498', 'bricks-advanced-themer' ) ) :
            while ( have_rows( 'field_6445ab9f3d498', 'bricks-advanced-themer' ) ) :
                the_row();

                // Typography
                if (  AT__Helpers::is_typography_tab_activated() && have_rows( 'field_63a6a58831bbe', 'bricks-advanced-themer' ) ) :

                    // Category
                    $entry = self::has_entry_with_name($categories, 'typography');

                    if($entry === false){
                        $category_id = AT__Helpers::generate_unique_string(6);
                        $categories[] = [
                            'id'    => $category_id,
                            'name'  => 'typography'
                        ];
                    } else {
                        $category_id = $entry['id'];
                    }

                    // Variables
                    while ( have_rows( 'field_63a6a58831bbe', 'bricks-advanced-themer' ) ) :
                        the_row();

                        $label = get_sub_field('brxc_typography_label', 'bricks-advanced-themer' );
                        $label_final = $prefix !== '' ? $prefix . '-' . $label : $label;
                        $min_value = get_sub_field('brxc_typography_min_value', 'bricks-advanced-themer' );
                        $max_value = get_sub_field('brxc_typography_max_value', 'bricks-advanced-themer' );
                        $variables[] = [
                            'id'        => AT__Helpers::generate_unique_string(6),
                            'name'      => $label_final,
                            'category'  => $category_id,
                            'type'      => 'clamp',
                            'min'       => $min_value,
                            'max'       => $max_value,
                            'value'     => AT__Helpers::clamp_builder((float) $min_value, (float) $max_value),
                        ];
                        
                    endwhile;
                endif;
    
                // Spacing
                if ( AT__Helpers::is_spacing_tab_activated() && have_rows( 'field_63a6a51731bbb', 'bricks-advanced-themer' ) ) :

                    // Category
                    $entry = self::has_entry_with_name($categories, 'spacing');

                    if($entry === false){
                        $category_id = AT__Helpers::generate_unique_string(6);
                        $categories[] = [
                            'id'    => $category_id,
                            'name'  => 'spacing'
                        ];
                    } else {
                        $category_id = $entry['id'];
                    }

                    // Variables
                    while ( have_rows( 'field_63a6a51731bbb', 'bricks-advanced-themer' ) ) :
                        the_row();
    
                        $label = get_sub_field('brxc_spacing_label', 'bricks-advanced-themer' );
                        $label_final = $prefix !== '' ? $prefix . '-' . $label : $label;
                        $min_value = get_sub_field('brxc_spacing_min_value', 'bricks-advanced-themer' );
                        $max_value = get_sub_field('brxc_spacing_max_value', 'bricks-advanced-themer' );
                        $variables[] = [
                            'id'        => AT__Helpers::generate_unique_string(6),
                            'name'      => $label_final,
                            'category'  => $category_id,
                            'type'      => 'clamp',
                            'min'       => $min_value,
                            'max'       => $max_value,
                            'value'     => AT__Helpers::clamp_builder((float) $min_value, (float) $max_value),
                        ];
                        
                    endwhile;
                endif;

                // Border-radius
                if ( AT__Helpers::is_border_radius_tab_activated() && have_rows( 'field_63c8f17f5e2ed', 'bricks-advanced-themer' ) ) :

                    // Category
                    $entry = self::has_entry_with_name($categories, 'border-radius');

                    if($entry === false){
                        $category_id = AT__Helpers::generate_unique_string(6);
                        $categories[] = [
                            'id'    => $category_id,
                            'name'  => 'border-radius'
                        ];
                    } else {
                        $category_id = $entry['id'];
                    }

                    // Variables
                    while ( have_rows( 'field_63c8f17f5e2ed', 'bricks-advanced-themer' ) ) :
                        the_row();

                        $label = get_sub_field('brxc_border_label', 'bricks-advanced-themer' );
                        $label_final = $prefix !== '' ? $prefix . '-' . $label : $label;
                        $min_value = get_sub_field('brxc_border_min_value', 'bricks-advanced-themer' );
                        $max_value = get_sub_field('brxc_border_max_value', 'bricks-advanced-themer' );
                        $variables[] = [
                            'id'        => AT__Helpers::generate_unique_string(6),
                            'name'      => $label_final,
                            'category'  => $category_id,
                            'type'      => 'clamp',
                            'min'       => $min_value,
                            'max'       => $max_value,
                            'value'     => AT__Helpers::clamp_builder((float) $min_value, (float) $max_value),
                        ];
                        
                    endwhile; 
                endif;

                // Border
                if ( AT__Helpers::is_border_tab_activated() && have_rows( 'field_63c8f17ytr545', 'bricks-advanced-themer' ) ) :

                    // Category
                    $entry = self::has_entry_with_name($categories, 'border');

                    if($entry === false){
                        $category_id = AT__Helpers::generate_unique_string(6);
                        $categories[] = [
                            'id'    => $category_id,
                            'name'  => 'border'
                        ];
                    } else {
                        $category_id = $entry['id'];
                    }

                    // Variablies
                    while ( have_rows( 'field_63c8f17ytr545', 'bricks-advanced-themer' ) ) :
                        the_row();

                        $label = get_sub_field('brxc_border_simple_label', 'bricks-advanced-themer' );
                        $label_final = $prefix !== '' ? $prefix . '-' . $label : $label;
                        $value = get_sub_field('brxc_border_simple_value', 'bricks-advanced-themer' );
                        $variables[] = [
                            'id'        => AT__Helpers::generate_unique_string(6),
                            'name'      => $label_final,
                            'category'  => $category_id,
                            'type'      => 'static',
                            'value'     => $value,
                        ];
                        
                    endwhile;
                endif;

                // Box-shadow
                if ( AT__Helpers::is_box_shadow_tab_activated() && have_rows( 'field_63c8f17s4stt6', 'bricks-advanced-themer' ) ) :

                    // Category
                    $entry = self::has_entry_with_name($categories, 'box-shadow');

                    if($entry === false){
                        $category_id = AT__Helpers::generate_unique_string(6);
                        $categories[] = [
                            'id'    => $category_id,
                            'name'  => 'box-shadow'
                        ];
                    } else {
                        $category_id = $entry['id'];
                    }

                    // Variables
                    while ( have_rows( 'field_63c8f17s4stt6', 'bricks-advanced-themer' ) ) :
                        the_row();

                        $label = get_sub_field('brxc_box_shadow_label', 'bricks-advanced-themer' );
                        $label_final = $prefix !== '' ? $prefix . '-' . $label : $label;
                        $value = get_sub_field('brxc_box_shadow_value', 'bricks-advanced-themer' );
                        $variables[] = [
                            'id'     => AT__Helpers::generate_unique_string(6),
                            'name'   => $label_final,
                            'category'  => $category_id,
                            'type'   => 'static',
                            'value'  => $value,
                        ];
                        
                    endwhile;
                endif;

                // Width
                if ( AT__Helpers::is_width_tab_activated() && have_rows( 'field_63c8f17ppo69i', 'bricks-advanced-themer' ) ) :

                    // Category
                    $entry = self::has_entry_with_name($categories, 'width');

                    if($entry === false){
                        $category_id = AT__Helpers::generate_unique_string(6);
                        $categories[] = [
                            'id'    => $category_id,
                            'name'  => 'width'
                        ];
                    } else {
                        $category_id = $entry['id'];
                    }

                    // Variables
                    while ( have_rows( 'field_63c8f17ppo69i', 'bricks-advanced-themer' ) ) :
                        the_row();

                        $label = get_sub_field('brxc_width_label', 'bricks-advanced-themer' );
                        $label_final = $prefix !== '' ? $prefix . '-' . $label : $label;
                        $min_value = get_sub_field('brxc_width_min_value', 'bricks-advanced-themer' );
                        $max_value = get_sub_field('brxc_width_max_value', 'bricks-advanced-themer' );
                        $variables[] = [
                            'id'        => AT__Helpers::generate_unique_string(6),
                            'name'      => $label_final,
                            'category'  => $category_id,
                            'type'      => 'clamp',
                            'min'       => $min_value,
                            'max'       => $max_value,
                            'value'     => AT__Helpers::clamp_builder((float) $min_value, (float) $max_value),
                        ];
                        
                    endwhile;
                endif;

                // Custom Variables

                if ( AT__Helpers::is_custom_variables_tab_activated() && have_rows( 'field_64066a105f7ec', 'bricks-advanced-themer' ) ) :
                    while ( have_rows( 'field_64066a105f7ec', 'bricks-advanced-themer' ) ) :
                        the_row();

                        $group = get_sub_field('brxc_misc_category_label', 'bricks-advanced-themer');
                        // Flexible Content
                        
                        if( have_rows('field_63dd12891d1d9', 'bricks-advanced-themer') ):

                            // Category
                            $entry = self::has_entry_with_name($categories, $group);

                            if($entry === false){
                                $category_id = AT__Helpers::generate_unique_string(6);
                                $categories[] = [
                                    'id'    => $category_id,
                                    'name'  => $group
                                ];
                            } else {
                                $category_id = $entry['id'];
                            }

                            // Variables
                            while ( have_rows('field_63dd12891d1d9', 'bricks-advanced-themer') ) : the_row();
    
                                // Case: Fluid
                                if( get_row_layout() == 'brxc_misc_fluid_variable' ):
                                    $label = get_sub_field('brxc_misc_fluid_label', 'bricks-advanced-themer' );
                                    $label_final = $prefix !== '' ? $prefix . '-' . $label : $label;
                                    $min_value = get_sub_field('brxc_misc_fluid_min_value', 'bricks-advanced-themer' );
                                    $max_value = get_sub_field('brxc_misc_fluid_max_value', 'bricks-advanced-themer' );
                                    $variables[] = [
                                        'id'        => AT__Helpers::generate_unique_string(6),
                                        'name'      => $label_final,
                                        'category'  => $category_id,
                                        'type'      => 'clamp',
                                        'min'       => $min_value,
                                        'max'       => $max_value,
                                        'value'     => AT__Helpers::clamp_builder((float) $min_value, (float) $max_value),
                                    ];
                        
                                // Case: Static
                                elseif( get_row_layout() == 'brxc_misc_static_variable' ): 
                                    $label = get_sub_field('brxc_misc_static_label', 'bricks-advanced-themer' );
                                    $label_final = $prefix !== '' ? $prefix . '-' . $label : $label;
                                    $value = get_sub_field('brxc_misc_static_value', 'bricks-advanced-themer' );
                                    $variables[] = [
                                        'id'        => AT__Helpers::generate_unique_string(6),
                                        'name'      => $label_final,
                                        'category'  => $category_id,
                                        'type'      => 'static',
                                        'value'     => $value,
                                    ];
                        
                                endif;
                                
                            // End Flexible Content
                            endwhile;
                        endif;
                    // End Repeater
                    endwhile;
                endif;

            // End Global repeater
            endwhile;
        endif;

        // Reset database entries
        $option_data = $wpdb->get_results("SELECT option_name, option_value FROM $wpdb->options WHERE option_name LIKE '%bricks-advanced-themer__brxc_%' AND option_name LIKE '%_variables_repeater%'");

        // Delete options
        if(is_array($option_data)){
            foreach ($option_data as $option) {
                delete_option($option->option_name);
            }
        }

        // Update globalVariablesCategories
        if(is_array($categories) && !empty($categories)){
            update_option( 'bricks_global_variables_categories', $categories );
        } 

        // Update globalVariables Array
        if(is_array($variables) && !empty($variables)){
            update_option( 'bricks_global_variables', $variables );  
        } 


        // Update database: CONVERTED
        self::set_option_as_converted('global_css_variables');
    }

    public static function convert_settings_to_logical_properties(array $obj): array {
        $keyTransformations = [
            '_margin' => [
                'newKey' => '_marginLogical',
                'map' => ['top' => 'block-start', 'bottom' => 'block-end', 'left' => 'inline-start', 'right' => 'inline-end']
            ],
            '_padding' => [
                'newKey' => '_paddingLogical',
                'map' => ['top' => 'block-start', 'bottom' => 'block-end', 'left' => 'inline-start', 'right' => 'inline-end']
            ],
            '_border' => [
                'width' => [
                    'newKey' => '_borderWidthLogical',
                    'map' => ['top' => 'block-start-width', 'bottom' => 'block-end-width', 'left' => 'inline-start-width', 'right' => 'inline-end-width']
                ],
                'radius' => [
                    'newKey' => '_borderRadiusLogical',
                    'map' => ['top' => 'start-start-radius', 'bottom' => 'end-start-radius', 'left' => 'end-end-radius', 'right' => 'start-end-radius']
                ],
                'style' => ['newKey' => '_borderStyle'],
                'color' => ['newKey' => '_borderColor']
            ],
            '_top' => ['newKey' => '_insetLogical', 'subKey' => 'block-start'],
            '_bottom' => ['newKey' => '_insetLogical', 'subKey' => 'block-end'],
            '_left' => ['newKey' => '_insetLogical', 'subKey' => 'inline-start'],
            '_right' => ['newKey' => '_insetLogical', 'subKey' => 'inline-end'],
            '_width' => ['newKey' => '_inlineSize'],
            '_widthMin' => ['newKey' => '_inlineSizeMin'],
            '_widthMax' => ['newKey' => '_inlineSizeMax'],
            '_height' => ['newKey' => '_blockSize'],
            '_heightMin' => ['newKey' => '_blockSizeMin'],
            '_heightMax' => ['newKey' => '_blockSizeMax']
        ];
    
        $transformedObj = [];
    
        foreach ($obj as $key => $value) {
            $parts = explode(':', $key, 2);
            $baseKey = $parts[0];
            $suffix = isset($parts[1]) ? ":{$parts[1]}" : '';
    
            if (isset($keyTransformations[$baseKey])) {
                $transform = $keyTransformations[$baseKey];
                if (isset($transform['newKey'])) {
                    if (isset($transform['map']) && is_array($value)) {
                        $newValue = [];
                        foreach ($value as $subKey => $val) {
                            $newSubKey = $transform['map'][$subKey] ?? $subKey;
                            $newValue[$newSubKey] = $val;
                        }
                        $transformedObj[$transform['newKey'] . $suffix] = $newValue;
                    } elseif (isset($transform['subKey'])) {
                        if (!isset($transformedObj[$transform['newKey'] . $suffix])) {
                            $transformedObj[$transform['newKey'] . $suffix] = [];
                        }
                        $transformedObj[$transform['newKey'] . $suffix][$transform['subKey']] = $value;
                    } else {
                        $transformedObj[$transform['newKey'] . $suffix] = $value;
                    }
                } else {
                    foreach ($value as $subKey => $subValue) {
                        if (isset($transform[$subKey]['newKey'])) {
                            $subTransform = $transform[$subKey];
                            if (isset($subTransform['map']) && is_array($subValue)) {
                                $newValue = [];
                                foreach ($subValue as $innerKey => $innerVal) {
                                    $newInnerKey = $subTransform['map'][$innerKey] ?? $innerKey;
                                    $newValue[$newInnerKey] = $innerVal;
                                }
                                $transformedObj[$subTransform['newKey'] . $suffix] = $newValue;
                            } else {
                                $transformedObj[$subTransform['newKey'] . $suffix] = $subValue;
                            }
                        } else {
                            if (!isset($transformedObj[$key . $suffix])) {
                                $transformedObj[$key . $suffix] = [];
                            }
                            $transformedObj[$key . $suffix][$subKey] = $subValue;
                        }
                    }
                }
            } else {
                $transformedObj[$key] = $value;
            }
        }
    
        return $transformedObj;
    }


    public static function convert_global_colors_prefix() {
        if ( (defined('BRICKS_ADVANCED_THEMER_GLOBAL_COLORS_PREFIX_CONVERTED') && BRICKS_ADVANCED_THEMER_GLOBAL_COLORS_PREFIX_CONVERTED === true)) return;
        
        global $brxc_acf_fields;
        $global_colors = get_option('bricks_color_palette', []);
        $old_prefix = !empty($brxc_acf_fields['color_prefix']) ? $brxc_acf_fields['color_prefix'] . '-' : '';
        
        if(AT__Helpers::is_array($global_colors)) {
            foreach($global_colors as &$color){
                if(isset($color["at_framework"]) && $color["at_framework"] === true){
                    $color["prefix"] = "at-";
                } else {
                    $color["prefix"] = $old_prefix;
                }
            }
        }
    
        update_option( 'bricks_color_palette', $global_colors);
        self::set_option_as_converted('global_colors_prefix');
    }  
}
