<?php
if (!defined('ABSPATH')) exit;

class HyperSiteReviews {
    public static function init() {
        try {
            // Setup WordPress hooks
            add_action('admin_menu', [self::class, 'add_admin_menus']);
            add_action('admin_init', [self::class, 'maybe_redirect_to_setup']);
            add_action('rest_api_init', function () {
                // Validate and set the current user based on the logged-in cookie
                $user_id = wp_validate_auth_cookie($_COOKIE[LOGGED_IN_COOKIE] ?? '', 'logged_in');
                if ($user_id) {
                    wp_set_current_user($user_id);
                } else {
                    error_log('Failed to authenticate user via cookie.');
                }
                HyperSiteReviews::register_api_routes();
            });
            add_action('admin_enqueue_scripts', [self::class, 'enqueue_scripts']);

            if (get_option('hsrev_setup_complete')) {
                add_action('init', [self::class, 'register_post_type']);
            }
        } catch (Exception $e) {
            error_log('Error initializing HyperSiteReviews: ' . $e->getMessage());
        }
    }

    public static function add_admin_menus() {
        // Main menu page
        add_menu_page(
            'HyperSite Reviews',
            'HyperSite Reviews',
            'manage_options',
            'hypersite-reviews',
            [self::class, 'main_page'],
            'dashicons-star-filled',
            20
        );

        // Submenu pages
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

        add_submenu_page(
            null,
            'Google Connect',
            'Google Connect',
            'manage_options',
            'hypersite-reviews-google-connect',
            [self::class, 'google_connect_page']
        );
    }

    public static function enqueue_scripts($hook) {
        if (isset($_GET['page']) && $_GET['page'] === 'hypersite-reviews-setup') {
            wp_enqueue_style(
                'hsrev-setup-style',
                HSREV_URL . 'admin/css/setup-page.css',
                [],
                filemtime(HSREV_PATH . 'admin/css/setup-page.css')
            );
            wp_enqueue_script(
                'hsrev-setup-script',
                HSREV_URL . 'admin/js/setup-page.js',
                [],
                filemtime(HSREV_PATH . 'admin/js/setup-page.js'),
                true
            );
            wp_enqueue_script(
                'hsrev-admin-script',
                HSREV_URL . 'admin/js/admin-scripts.js',
                [],
                filemtime(HSREV_PATH . 'admin/js/admin-scripts.js'),
                true
            );
            wp_localize_script('hsrev-admin-script', 'HSRevApi', [
                'urls' => [
                    'accounts' => rest_url('hsrev/v1/accounts'),
                    'locations' => rest_url('hsrev/v1/locations'),
                    'accountLocationsBase' => rest_url('hsrev/v1/accounts/%s/locations'),
                    'totalAccountLocations' => rest_url('hsrev/v1/accounts/%s/total-locations'),
                    'reviewsBase' => rest_url('hsrev/v1/accounts/%s/locations/%s/reviews'),
                    'totalLocationReviews' => rest_url('hsrev/v1/accounts/%s/locations/%s/total-reviews'),
                ],
                'nonce' => wp_create_nonce('wp_rest'),
            ]);
        }
    }

    public static function maybe_redirect_to_setup() {
        if (!is_admin() || !current_user_can('manage_options')) return;

        if (get_option('hsrev_setup_complete') || get_option('hsrev_bypass_setup_page')) return;

        $current_page = $_GET['page'] ?? '';

        $is_hsrev_page = in_array($current_page, ['hypersite-reviews', 'hypersite-reviews-settings'], true);

        if ($is_hsrev_page && $current_page !== 'hypersite-reviews-setup' && !get_option('hsrev_bypass_setup_page')) {
            wp_redirect(admin_url('admin.php?page=hypersite-reviews-setup'));
            exit;
        }
    }

    public static function main_page() {
        echo '<div class="wrap"><h1>HyperSite Reviews</h1></div>';
    }

    public static function setup_page() {
        if (!current_user_can('manage_options')) wp_die('Unauthorized');

        $client = GoogleOAuthClient::get_client();

        // Handle disconnect
        if (isset($_POST['disconnect']) && check_admin_referer('hsrev_google_disconnect')) {
            if ($client->getAccessToken()) $client->revokeToken();
            delete_option('hsrev_google_oauth_token');
            delete_option('hsrev_google_refresh_token');
            echo '<div class="notice notice-success"><p>Disconnected from Google account.</p></div>';
        }

        // Handle OAuth callback
        if (isset($_GET['code'])) {
            try {
                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                if (isset($token['error'])) {
                    $error = $token['error_description'] ?? $token['error'];
                } else {
                    update_option('hsrev_google_oauth_token', $token);
                    if (!empty($token['refresh_token'])) {
                        update_option('hsrev_google_refresh_token', $token['refresh_token']);
                    }
                    update_option('hsrev_setup_complete', true);
                    wp_safe_redirect(admin_url('admin.php?page=hypersite-reviews'));
                    exit;
                }
            } catch (Exception $e) {
                $error = 'Exception occurred: ' . $e->getMessage();
            }
        }

        $authUrl = $client->createAuthUrl();
        include HSREV_PATH . 'includes/admin/templates/setup-page.php';
    }

    public static function settings_page() {
        include HSREV_PATH . 'includes/admin/templates/settings-page.php';
    }

    public static function google_connect_page() {
        if (!current_user_can('manage_options')) wp_die('Unauthorized user');

        $message = '';
        $error = false;

        if (!empty($_GET['code'])) {
            $client = GoogleOAuthClient::get_client();

            try {
                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                if (!empty($token['refresh_token'])) {
                    update_option('hsrev_google_refresh_token', $token['refresh_token']);
                } else {
                    error_log('No refresh token received from Google OAuth token response.');
                }

                if (isset($token['error'])) {
                    $error = true;
                    $message = 'Error fetching access token: ' . ($token['error_description'] ?? $token['error']);
                } else {
                    update_option('hsrev_google_oauth_token', $token);
                    $message = 'Success! Google API connected and tokens stored.';
                }
            } catch (Exception $e) {
                $error = true;
                $message = 'Exception occurred: ' . $e->getMessage();
            }
        } else {
            $message = 'No authorization code provided.';
        }

        include HSREV_PATH . 'includes/admin/templates/google-connect-page.php';
    }

    public static function register_post_type() {
        register_post_type('reviews', [
            'public' => true,
            'label' => 'Reviews',
            'supports' => ['title', 'editor', 'custom-fields'],
            'show_in_menu' => false,
        ]);
    }

    public static function register_api_routes() {
        // Register REST API routes
        register_rest_route('hsrev/v1', '/accounts', [
            'methods' => 'GET',
            'callback' => [self::class, 'api_get_accounts'],
            'permission_callback' => function () {
                $user_id = wp_validate_auth_cookie($_COOKIE[LOGGED_IN_COOKIE] ?? '', 'logged_in');
                if ($user_id) {
                    wp_set_current_user($user_id);
                }

                return current_user_can('manage_options');
            },
        ]);

        register_rest_route('hsrev/v1', '/accounts/(?P<account_id>[^\/]+)/locations', [
            'methods' => 'GET',
            'callback' => [self::class, 'api_get_account_locations'],
            'permission_callback' => function () {
                $user_id = wp_validate_auth_cookie($_COOKIE[LOGGED_IN_COOKIE] ?? '', 'logged_in');
                if ($user_id) {
                    wp_set_current_user($user_id);
                }

                return current_user_can('manage_options');
            },
        ]);

        register_rest_route('hsrev/v1', '/locations', [
            'methods' => 'GET',
            'callback' => [self::class, 'api_get_all_locations'],
            'permission_callback' => function () {
                $user_id = wp_validate_auth_cookie($_COOKIE[LOGGED_IN_COOKIE] ?? '', 'logged_in');
                if ($user_id) {
                    wp_set_current_user($user_id);
                }

                return current_user_can('manage_options');
            },
        ]);

        register_rest_route('hsrev/v1', '/accounts/(?P<account_id>[^\/]+)/total-locations', [
            'methods' => 'GET',
            'callback' => [self::class, 'api_get_account_locations_total'],
            'permission_callback' => function () {
                $user_id = wp_validate_auth_cookie($_COOKIE[LOGGED_IN_COOKIE] ?? '', 'logged_in');
                if ($user_id) {
                    wp_set_current_user($user_id);
                }

                return current_user_can('manage_options');
            },
        ]);

        register_rest_route('hsrev/v1', '/accounts/(?P<account_id>[^\/]+)/locations/(?P<location_id>[^\/]+)/reviews', [
            'methods' => 'GET',
            'callback' => [self::class, 'api_get_location_reviews'],
            'permission_callback' => function () {
                $user_id = wp_validate_auth_cookie($_COOKIE[LOGGED_IN_COOKIE] ?? '', 'logged_in');
                if ($user_id) {
                    wp_set_current_user($user_id);
                }

                return current_user_can('manage_options');
            },
        ]);

        register_rest_route('hsrev/v1', '/accounts/(?P<account_id>[^\/]+)/locations/(?P<location_id>[^\/]+)/total-reviews', [
            'methods' => 'GET',
            'callback' => [self::class, 'api_get_location_reviews_total'],
            'permission_callback' => function () {
                $user_id = wp_validate_auth_cookie($_COOKIE[LOGGED_IN_COOKIE] ?? '', 'logged_in');
                if ($user_id) {
                    wp_set_current_user($user_id);
                }

                return current_user_can('manage_options');
            },
        ]);
    }

    public static function api_get_accounts($request) {
        try {
            $accounts = GoogleDataHandler::get_google_accounts();
            return rest_ensure_response(['accounts' => $accounts]);
        } catch (Exception $e) {
            return new WP_Error('account_fetch_failed', $e->getMessage(), ['status' => 500]);
        }
    }

    public static function api_get_account_locations($request) {
        $account_id = $request['account_id'];
        $account_key = 'accounts/' . $account_id;
        try {
            $locations = GoogleDataHandler::get_locations_by_account($account_key);
            
            return rest_ensure_response(['locations' => $locations ?? []]);
        } catch (Exception $e) {
            return new WP_Error('location_fetch_failed', $e->getMessage(), ['status' => 500]);
        }
    }

    public static function api_get_all_locations($request) {
        try {
            $locations = GoogleDataHandler::get_all_locations();
            return rest_ensure_response($locations);
        } catch (Exception $e) {
            return new WP_Error('location_fetch_failed', $e->getMessage(), ['status' => 500]);
        }
    }

    public static function api_get_account_locations_total($request) {
        $account_id = $request['account_id'];
        $account_key = 'accounts/' . $account_id;
        try {
            $locations = GoogleDataHandler::get_account_locations_total($account_key);
            return rest_ensure_response(['total' => $locations ?? []]);
        } catch (Exception $e) {
            return new WP_Error('location_fetch_failed', $e->getMessage(), ['status' => 500]);
        }
    }

    public static function api_get_location_reviews($request) {
        $location_id = $request['location_id'];

        $location_key = 'locations/' . $location_id;
        try {
            $reviews = GoogleDataHandler::get_account_location_reviews();
            return rest_ensure_response(['reviews' => $reviews[$location_key] ?? []]);
        } catch (Exception $e) {
            return new WP_Error('reviews_fetch_failed', $e->getMessage(), ['status' => 500]);
        }
    }

    public static function api_get_location_reviews_total($request) {
        $account_id = $request['account_id'];
        $account_key = 'accounts/' . $account_id;
        $location_id = $request['location_id'];
        $location_key = 'locations/' . $location_id;
        try {
            $reviews = GoogleDataHandler::get_location_reviews_length($account_key, $location_key);
            return rest_ensure_response(['total' => $reviews ?? []]);
        } catch (Exception $e) {
            return new WP_Error('location_review_total_fetch_failed', $e->getMessage(), ['status' => 500]);
        }
    }

    // Responsible for the initial creation of the database tables.
    private static function wp_create_db_tables() {
        global $wpdb;

        // Create Accounts table
        $table_name = $wpdb->prefix;
        $charset_collate = $wpdb->get_charset_collate();

        // Create Accounts table
        $accounts_table = $wpdb->prefix . 'accounts';
        $accounts_sql = "CREATE TABLE $accounts_table (
            account_id VARCHAR(255) NOT NULL,
            account_name VARCHAR(255),
            account_number VARCHAR(255),
            permission_level VARCHAR(255),
            primary_owner VARCHAR(255),
            role VARCHAR(255),
            type VARCHAR(255),
            verification_state VARCHAR(255),
            vetted_state VARCHAR(255),
            PRIMARY KEY  (account_id)
        ) $charset_collate;";

        // Create Locations table
        $locations_table = $wpdb->prefix . 'locations';
        $locations_sql = "CREATE TABLE $locations_table (
            location_id VARCHAR(255) NOT NULL,
            parent_account_id VARCHAR(255),
            title VARCHAR(255),
            labels TEXT,
            language_code VARCHAR(10),
            store_code VARCHAR(255),
            website_uri TEXT,
            PRIMARY KEY  (location_id),
            FOREIGN KEY  (parent_account_id) REFERENCES $accounts_table(account_id) ON DELETE CASCADE
        ) $charset_collate;";

        // Create Reviews table
        $reviews_table = $wpdb->prefix . 'reviews';
        $reviews_sql = "CREATE TABLE $reviews_table (
            review_id VARCHAR(255) NOT NULL,
            location_id VARCHAR(255),
            reviewer_display_name VARCHAR(255),
            reviewer_profile_photo_url TEXT,
            star_rating VARCHAR(10),
            comment TEXT,
            create_time DATETIME,
            update_time DATETIME,
            review_reply_comment TEXT,
            review_reply_update_time DATETIME,
            PRIMARY KEY  (review_id),
            FOREIGN KEY  (location_id) REFERENCES $locations_table(location_id) ON DELETE CASCADE
        ) $charset_collate;";

        // Execute the SQL queries
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($accounts_sql);
        dbDelta($locations_sql);
        dbDelta($reviews_sql);
    }

    public static function activate() {
        self::register_post_type();
        self::wp_create_db_tables();
        flush_rewrite_rules();
    }

    public static function deactivate() {
        flush_rewrite_rules();
    }
}
