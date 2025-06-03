<?php
if ( ! defined('ABSPATH') ) exit;

class HyperSiteReviews {
    public static function init() {
        add_action('admin_menu', [self::class, 'add_admin_menus']);
        add_action('admin_init', [self::class, 'maybe_redirect_to_setup']);

        if (get_option('hsrev_setup_complete')) {
            add_action('init', [self::class, 'register_post_type']);
        }
    }

    public static function register_post_type() {
        register_post_type('reviews', [
            'public' => true,
            'label'  => 'Reviews',
            'supports' => ['title', 'editor', 'custom-fields'],
            'show_in_menu' => false,
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
            null,
            'HyperSite Setup',
            'Setup',
            'manage_options',
            'hypersite-reviews-setup',
            [self::class, 'setup_page']
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

    public static function maybe_redirect_to_setup() {
        if (
            is_admin() &&
            current_user_can('manage_options') &&
            ! get_option('hsrev_setup_complete') &&
            ($_GET['page'] ?? '') !== 'hypersite-reviews-setup'
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
            update_option('hsrev_setup_complete', true);
            wp_safe_redirect(admin_url('admin.php?page=hypersite-reviews'));
            exit;
        }

        include HSREV_PATH . 'includes/admin/templates/setup-page.php';
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
