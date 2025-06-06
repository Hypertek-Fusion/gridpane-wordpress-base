<?php
/*
 * Plugin Name: HyperSite Reviews
 * Description: Review management plugin for HyperSite.
 * Version: 0.0.1
 * Requires PHP: 8.0
 */

if (!defined('ABSPATH')) exit;

define('HSREV_PATH', plugin_dir_path(__FILE__));
define('HSREV_URL', plugin_dir_url(__FILE__));

if (!defined('HSREV_DEBUG')) {
    define('HSREV_DEBUG', defined('WP_DEBUG') && WP_DEBUG);
}

// Load Google API dependencies first
require_once HSREV_PATH . 'includes/dependencies/google-api-php/vendor/autoload.php';

// Load core classes
require_once HSREV_PATH . 'includes/classes/core/class-hypersite-reviews.php';

// Load Google-specific classes
require_once HSREV_PATH . 'includes/classes/google/class-google-oauth.php';
require_once HSREV_PATH . 'includes/classes/google/class-google-data.php';

// Initialize the plugin
add_action('plugins_loaded', ['HyperSiteReviews', 'init']);
register_activation_hook(__FILE__, ['HyperSiteReviews', 'activate']);
register_deactivation_hook(__FILE__, ['HyperSiteReviews', 'deactivate']);
