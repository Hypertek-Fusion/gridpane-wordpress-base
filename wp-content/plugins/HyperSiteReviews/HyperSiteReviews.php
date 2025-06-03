<?php
/*
 * Plugin Name: HyperSite Reviews
 * Version: 0.0.1
 * Requires PHP: 8.0
*/

if ( ! class_exists('HyperSiteReviews') ) {
    class HyperSiteReviews {
        public static function init() {
            add_action('init', [self::class, 'register_post_type']);
            add_action('admin_menu', [self::class, 'add_admin_menus']);
        }

        public static function register_post_type() {
            register_post_type('reviews', [
                'public' => true,
                'label'  => 'Reviews',
                'supports' => ['title', 'editor', 'custom-fields'],
                'show_in_menu' => false, // To avoid duplicate menu
            ]);
        }

        public static function add_admin_menus() {
            add_menu_page(
                'HyperSite Reviews',
                'HyperSite Reviews',
                'manage_options',
                'hypersite-reviews',
                [self::class, 'main_page'],
                'dashicons-star-filled',
                20
            );

            add_submenu_page(
                'hypersite-reviews',
                'HyperSite Review Settings',
                'Settings',
                'manage_options',
                'hypersite-reviews-settings',
                [self::class, 'settings_page']
            );
        }

        public static function main_page() {
            echo '<div class="wrap"><h1>HyperSite Review</h1></div>';
        }

        public static function settings_page() {
            echo '<div class="wrap"><h1>HyperSite Review Settings</h1></div>';
        }

        public static function activate() {
            self::register_post_type();
            flush_rewrite_rules();
        }

        public static function deactivate() {
            flush_rewrite_rules();
        }
    }

    // Init
    HyperSiteReviews::init();

    // Hooks
    register_activation_hook(__FILE__, ['HyperSiteReviews', 'activate']);
    register_deactivation_hook(__FILE__, ['HyperSiteReviews', 'deactivate']);
}
?>
