<?php
/*
 * Plugin Name: HyperSite Reviews
 * Version: 0.0.1
 * Requires PHP: 8.0
*/

if ( ! class_exists('HyperSiteReviews') ) {
    class HyperSiteReviews {
        public static function init() {
            // Always allow setup and admin menus
            add_action('admin_menu', [self::class, 'add_admin_menus']);
            add_action('admin_init', [self::class, 'maybe_redirect_to_setup']);

            // Load features only after setup
            if (get_option('hsrev_setup_complete')) {
                add_action('init', [self::class, 'register_post_type']);
            }
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
            // Main Page
            add_menu_page(
                'HyperSite Reviews',
                'HyperSite Reviews',
                'manage_options',
                'hypersite-reviews',
                [self::class, 'main_page'],
                'dashicons-star-filled',
                20
            );

            // Initial Setup Page
            add_submenu_page(
                null,
                'HyperSite Setup',
                'Setup',
                'manage_options',
                'hypersite-reviews-setup',
                [self::class, 'setup_page']
            );

            // Settings
            add_submenu_page(
                'hypersite-reviews',
                'HyperSite Review Settings',
                'Settings',
                'manage_options',
                'hypersite-reviews-settings',
                [self::class, 'settings_page']
            );
        }

        public static function maybe_redirect_to_setup() {
            if (
                is_admin() &&
                current_user_can('manage_options') &&
                ! get_option('hsrev_setup_complete') &&
                $_GET['page'] !== 'hypersite-reviews-setup'
            ) {
                wp_redirect(admin_url('admin.php?page=hypersite-reviews-setup'));
                exit;
            }
        }


        public static function main_page() {
            echo '<div class="wrap"><h1>HyperSite Review</h1></div>';
        }

                public static function setup_page() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && check_admin_referer('hsrev_setup')) {
                // Save setup data here
                update_option('hsrev_setup_complete', true);
                wp_safe_redirect(admin_url('admin.php?page=hypersite-reviews'));
                exit;
            }

            echo '<div class="wrap">';
            echo '<h1>HyperSite Reviews Setup</h1>';
            echo '<form method="post">';
            wp_nonce_field('hsrev_setup');
            echo '<p>Welcome! Let\'s get your plugin set up.</p>';
            echo '<input type="submit" value="Complete Setup" class="button button-primary">';
            echo '</form>';
            echo '</div>';
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
