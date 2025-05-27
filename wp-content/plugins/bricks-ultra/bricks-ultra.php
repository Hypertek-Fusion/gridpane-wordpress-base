<?php

/**
 * Plugin Name: Bricks Ultra Pro
 * Plugin URI: https://bricksultra.com
 * Description: Extender Bricks Builder with powerful Elements and Features.
 * Version: 1.4.1
 * Update URI: https://api.freemius.com
 * Author: WPVibes
 * Author URI: https://wpvibes.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wpv-bu
 * Domain Path: languages
 */

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

define( 'WPV_BU_URL', plugins_url( '/', __FILE__ ) );
define( 'WPV_BU_PATH', plugin_dir_path( __FILE__ ) );
define( 'WPV_BU_BASE', plugin_basename( __FILE__ ) );
define( 'WPV_BU_FILE', __FILE__ );
define( 'WPV_BU_SCRIPT_SUFFIX', ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' ) );
define( 'WPV_BU_VERSION', '1.4.1' );
define( 'WPV_MIN_PHP', '7.4.0' );

if ( version_compare( PHP_VERSION, WPV_MIN_PHP, '<' ) ) {
    add_action( 'admin_notices', function () {
        $message = sprintf(
            /* translators: 1: Bricks Ultra, 2: Bricks Builder */
            esc_html__( '%1$s requires minimum %2$s ', 'wpv-bu' ),
            '<strong>Bricks Ultra</strong>',
            '<strong>PHP ' . WPV_MIN_PHP . ' </strong>'
        );
        $html = sprintf( '<div class="notice notice-error">%s</div>', wpautop( $message ) );
        echo  wp_kses_post( $html ) ;
    } );
} else {
    $theme = wp_get_theme();
    
    if ( strtolower( $theme->name ) === 'bricks' || strtolower( $theme->template ) === 'bricks' ) {
        
        if ( !function_exists( 'bu_fs' ) ) {
            // Create a helper function for easy SDK access.
            function bu_fs()
            {
                global  $bu_fs ;
                
                if ( !isset( $bu_fs ) ) {
                    // Activate multisite network integration.
                    if ( !defined( 'WP_FS__PRODUCT_11134_MULTISITE' ) ) {
                        define( 'WP_FS__PRODUCT_11134_MULTISITE', true );
                    }
                    // Include Freemius SDK.
                    require_once dirname( __FILE__ ) . '/freemius/start.php';
                    $bu_fs = fs_dynamic_init( array(
                        'id'               => '11134',
                        'slug'             => 'bricks-ultra',
                        'premium_slug'     => 'bricks-ultra',
                        'type'             => 'plugin',
                        'public_key'       => 'pk_35c21e13cedea3fc10d10d1d21cf9',
                        'is_premium'       => true,
                        'has_addons'       => false,
                        'has_paid_plans'   => true,
                        'is_org_compliant' => false,
                        'menu'             => array(
                        'slug'    => 'bultr-settings',
                        'support' => false,
                        'parent'  => array(
                        'slug' => 'bricks',
                    ),
                    ),
                        'is_live'          => true,
                    ) );
                }
                
                return $bu_fs;
            }
            
            // Init Freemius.
            bu_fs();
            // Signal that SDK was initiated.
            do_action( 'bu_fs_loaded' );
        }
        
        require_once WPV_BU_PATH . 'vendor/autoload.php';
        require_once WPV_BU_PATH . 'includes/bootstrap.php';
    } else {
        // TODO : Add Admin Notice to activate Bricks Theme
        add_action( 'admin_notices', function () {
            $message = sprintf(
                /* translators: 1: Bricks Ultra, 2: Bricks Builder */
                esc_html__( '%1$s requires %2$s to be installed and activated', 'wpv-bu' ),
                '<strong>Bricks Ultra</strong>',
                '<strong>Bricks Builder</strong>'
            );
            $html = sprintf( '<div class="notice notice-error">%s</div>', wpautop( $message ) );
            echo  wp_kses_post( $html ) ;
        } );
    }

}
