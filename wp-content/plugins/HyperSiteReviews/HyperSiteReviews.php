<?php
/*
 * Plugin Name: HyperSite Reviews
 * Description: Review management plugin for HyperSite.
 * Version: 0.0.1
 * Requires PHP: 8.0
 */

if ( ! defined('ABSPATH') ) exit;

define('HSREV_PATH', plugin_dir_path(__FILE__));
define('HSREV_URL', plugin_dir_url(__FILE__));

if ( ! defined('HSREV_DEBUG') ) {
    define('HSREV_DEBUG', defined('WP_DEBUG') && WP_DEBUG);
}

require_once HSREV_PATH . 'includes/class-hypersite-reviews.php';
require_once HSREV_PATH . 'includes/google-api-client/autoload.php';

add_action('plugins_loaded', ['HyperSiteReviews', 'init']);
register_activation_hook(__FILE__, ['HyperSiteReviews', 'activate']);
register_deactivation_hook(__FILE__, ['HyperSiteReviews', 'deactivate']);