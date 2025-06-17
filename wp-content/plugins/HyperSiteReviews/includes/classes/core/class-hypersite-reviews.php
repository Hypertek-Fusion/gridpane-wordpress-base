<?php
if (!defined('ABSPATH')) exit;

class HyperSiteReviews
{
    public static function init()
    {
        try {
            // Setup WordPress hooks
            add_action('admin_menu', [self::class, 'add_admin_menus']);
            add_action('admin_init', [self::class, 'maybe_redirect_to_setup']);

            if(HSREV_DEBUG) {
                add_action('admin_menu', [self::class, 'add_debug_admin_menus']);
            }

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
            add_action('wp_enqueue_scripts', [self::class, 'enqueue_frontend_scripts']);


            add_filter('script_loader_tag', function($tag, $handle, $src) {
                // List of script handles to be treated as modules
                $module_scripts = [
                    'hsrev-setup-script',
                    'hsrev-admin-script',
                    'hsrev-main-page-script',
                    'hsrev-form-script'
                ];

                // Check if the handle is in the list of module scripts
                if (in_array($handle, $module_scripts)) {
                    // Modify the script tag to include type="module"
                    $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
                }

                return $tag;
            }, 10, 3);

            if (get_option('hsrev_setup_complete')) {
                add_action('init', [self::class, 'register_post_type']);
            }
        } catch (Exception $e) {
            error_log('Error initializing HyperSiteReviews: ' . $e->getMessage());
        }
    }

    public static function add_admin_menus()
    {
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
            '',
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
            '',
            'Google Connect',
            'Google Connect',
            'manage_options',
            'hypersite-reviews-google-connect',
            [self::class, 'google_connect_page']
        );
    }

    public static function add_debug_admin_menus() {
        add_submenu_page(
            'hypersite-reviews',
            'HyperSite Review Debug Settings',
            'Debug Settings',
            'manage_options',
            'hypersite-reviews-debug-settings',
            [self::class, 'debug_settings_page']
        );
    }

    public static function enqueue_scripts($hook)
    {
        // Conditionally enqueue setup page styles and scripts
        if (isset($_GET['page']) && $_GET['page'] === 'hypersite-reviews-setup') {
            wp_enqueue_style(
                'hsrev-setup-style',
                HSREV_URL . 'admin/css/setup-page.css',
                [],
                null
            );
            wp_enqueue_script(
                'hsrev-setup-script',
                HSREV_URL . 'dist/setupPage.js',
                [],
                null,
                true
            );
        }

        // Always enqueue main admin styles
        wp_enqueue_style(
            'hsrev-main-style',
            HSREV_URL . 'admin/css/main.css',
            [],
            null
        );

        // Enqueue Vite-bundled scripts
        wp_enqueue_script(
            'hsrev-admin-script',
            HSREV_URL . 'dist/admin.js',
            [],
            null,
            true
        );

        wp_enqueue_script(
            'hsrev-main-page-script',
            HSREV_URL . 'dist/mainPage.js',
            [],
            null,
            true
        );

        wp_enqueue_script(
            'hsrev-form-script',
            HSREV_URL . 'dist/forms.js',
            [],
            null,
            true
        );

        // Localize for REST access
        wp_localize_script('hsrev-admin-script', 'HSRevApi', [
            'urls' => [
                'accounts' => rest_url('hsrev/v1/accounts'),
                'locations' => rest_url('hsrev/v1/locations'),
                'accountLocationsBase' => rest_url('hsrev/v1/accounts/%s/locations'),
                'totalAccountLocations' => rest_url('hsrev/v1/accounts/%s/total-locations'),
                'totalLocationReviews' => rest_url('hsrev/v1/accounts/%s/locations/%s/total-reviews'),
                'locationReviewsBase' => rest_url('hsrev/v1/locations/%s/reviews'),
                'selectedLocation' => rest_url('hsrev/v1/public/location'),
            ],
            'nonce' => wp_create_nonce('wp_rest'),
        ]);
    }

    public static function enqueue_frontend_scripts($hook) {
        if (!wp_script_is('hypersite-reviews', 'enqueued')) {
            wp_enqueue_script(
                'hypersite-reviews',
                HSREV_URL . 'public/js/hypersite-reviews.js',
                [],
                '1.0',
                true
            );
            // Localize frontend scripts
            wp_localize_script('hypersite-reviews', 'HyperSiteReviews', [
                'urls' => [
                    'reviews' => rest_url('hsrev/v1/public/reviews'),
                ],
                'nonce' => wp_create_nonce('wp_rest'),
            ]);
        }
    }

    public static function maybe_redirect_to_setup()
    {
        if (!is_admin() || !current_user_can('manage_options')) return;

        if (get_option('hsrev_setup_complete') || get_option('hsrev_bypass_setup_page')) return;

        $current_page = $_GET['page'] ?? '';

        $is_hsrev_page = in_array($current_page, ['hypersite-reviews', 'hypersite-reviews-settings'], true);

        if ($is_hsrev_page && $current_page !== 'hypersite-reviews-setup' && !get_option('hsrev_setup_complete') && !get_option('hsrev_bypass_setup_page')) {
            wp_redirect(admin_url('admin.php?page=hypersite-reviews-setup'));
            exit;
        }
    }

public static function main_page()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        global $wpdb;

        error_log(print_r($_POST, true));

        // Extracting selected reviews
        $selected_reviews = array_keys($_POST);
        $selected_reviews = array_map(function($key) {
            return str_replace('selected-review-', '', $key);
        }, $selected_reviews);
        
        error_log('Selected Reviews: ' . print_r($selected_reviews, true));

        // Retrieve currently selected reviews from the database
        $current_selected_reviews = $wpdb->get_col("SELECT review_id FROM {$wpdb->prefix}reviews WHERE is_selected = TRUE");
        error_log('Current Selected Reviews: ' . print_r($current_selected_reviews, true));

        // Determine reviews to select/unselect
        $reviews_to_select = array_diff($selected_reviews, $current_selected_reviews);
        $reviews_to_unselect = array_diff($current_selected_reviews, $selected_reviews);
        error_log('Reviews to Select: ' . print_r($reviews_to_select, true));
        error_log('Reviews to Unselect: ' . print_r($reviews_to_unselect, true));

        // Update reviews to be selected
        if (!empty($reviews_to_select)) {
            $placeholders_select = implode(', ', array_fill(0, count($reviews_to_select), '%s'));
            $sql_select = $wpdb->prepare(
                "UPDATE {$wpdb->prefix}reviews SET is_selected = TRUE WHERE review_id IN ($placeholders_select)",
                ...$reviews_to_select
            );
            $wpdb->query($sql_select);
        }

        // Update reviews to be unselected
        if (!empty($reviews_to_unselect)) {
            $placeholders_unselect = implode(', ', array_fill(0, count($reviews_to_unselect), '%s'));
            $sql_unselect = $wpdb->prepare(
                "UPDATE {$wpdb->prefix}reviews SET is_selected = FALSE WHERE review_id IN ($placeholders_unselect)",
                ...$reviews_to_unselect
            );
            $wpdb->query($sql_unselect);
        }

        // Log the final state of selected reviews
        $final_selected_reviews = $wpdb->get_col("SELECT review_id FROM {$wpdb->prefix}reviews WHERE is_selected = TRUE");
        error_log('Final Selected Reviews: ' . print_r($final_selected_reviews, true));

        wp_safe_redirect(admin_url('admin.php?page=hypersite-reviews'));
        exit;
    }

    include HSREV_PATH . 'includes/admin/templates/main-page.php';
}

    public static function setup_page()
    {
        if (!current_user_can('manage_options')) wp_die('Unauthorized');

        $client = GoogleOAuthClient::get_client();

        // Handle disconnect
        if (isset($_POST['disconnect']) && check_admin_referer('hsrev_google_disconnect')) {
            if ($client->getAccessToken()) $client->revokeToken();
            delete_option('hsrev_google_oauth_token');
            delete_option('hsrev_google_refresh_token');
            echo '<div class="notice notice-success"><p>Disconnected from Google account.</p></div>';
        }
  
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            global $wpdb;

            error_log(print_r($_POST, true));

            // Unselect all accounts
            $wpdb->query("UPDATE {$wpdb->prefix}accounts SET is_selected = FALSE");

            // Set the selected account to selected
            if (!empty($_POST['selected-account'])) {
                $selected_account = $_POST['selected-account'];
                $wpdb->update(
                    "{$wpdb->prefix}accounts",
                    array('is_selected' => TRUE),
                    array('account_id' => $selected_account)
                );
            }

            // Unselect all locations
            $wpdb->query("UPDATE {$wpdb->prefix}locations SET is_selected = FALSE");

            // Set the selected location to selected
            if (!empty($_POST['selected-location'])) {
                $selected_location = $_POST['selected-location'];
                $wpdb->update(
                    "{$wpdb->prefix}locations",
                    array('is_selected' => TRUE),
                    array('location_id' => $selected_location)
                );
            }

            $selected_reviews = explode(',', $_POST['selected_reviews']);

            $placeholders = implode(', ', array_fill(0, count($selected_reviews), '%s'));

            // Prepare and execute the SQL statement
            $sql = $wpdb->prepare(
                "UPDATE wp_reviews SET is_selected = TRUE WHERE review_id IN ($placeholders)",
                $selected_reviews
            );

            $wpdb->query($sql);

            update_option('hsrev_setup_complete', true);
            wp_redirect(admin_url('admin.php?page=hypersite-reviews'));
        }

        if(get_option('hsrev_setup_complete')) {
            wp_redirect(admin_url('admin.php?page=hypersite-reviews'));
            exit;
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

    public static function settings_page()
    {
        include HSREV_PATH . 'includes/admin/templates/settings-page.php';
    }

    public static function google_connect_page()
    {
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
                    GoogleDataHandler::get_google_accounts();
                    wp_redirect(admin_url('admin.php?page=hypersite-reviews-setup'));
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

    public static function register_post_type()
    {
        register_post_type('reviews', [
            'public' => true,
            'label' => 'Reviews',
            'supports' => ['title', 'editor', 'custom-fields'],
            'show_in_menu' => false,
        ]);
    }

    public static function debug_settings_page() {
        if(HSREV_DEBUG) {
            if($_SERVER['REQUEST_METHOD'] === 'POST' && check_admin_referer('hsrev_debug_setting_set')) {
                $is_setup = isset($_POST['is-setup']) ? true : false;
                update_option('hsrev_setup_complete', $is_setup);
                $bypass_setup = isset($_POST['bypass-setup-page']) ? true : false;
                update_option('hsrev_bypass_setup_page', $bypass_setup);
            }
            include HSREV_PATH . 'includes/admin/templates/debug-settings-page.php';
        }
    }

    public static function register_api_routes()
    {
        // Register REST API routes
        register_rest_route('hsrev/v1', '/accounts', [
            'methods' => 'GET',
            'callback' => [self::class, 'api_get_accounts'],
            'args' => [
                'page' => [
                    'default' => 1,
                    'validate_callback' => function ($param, $request, $key) {
                        return is_numeric($param) && $param > 0;
                    }
                ],
                'per_page' => [
                    'default' => 10,
                    'validate_callback' => function ($param, $request, $key) {
                        return is_numeric($param) && $param > 0;
                    }
                ]
            ],
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
            'args' => [
                'page' => [
                    'default' => 1,
                    'validate_callback' => function ($param, $request, $key) {
                        return is_numeric($param) && $param > 0;
                    }
                ],
                'per_page' => [
                    'default' => 10,
                    'validate_callback' => function ($param, $request, $key) {
                        return is_numeric($param) && $param > 0;
                    }
                ]
            ],
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
            'args' => [
                'page' => [
                    'default' => 1,
                    'validate_callback' => function ($param, $request, $key) {
                        return is_numeric($param) && $param > 0;
                    }
                ],
                'per_page' => [
                    'default' => 10,
                    'validate_callback' => function ($param, $request, $key) {
                        return is_numeric($param) && $param > 0;
                    }
                ]
            ],
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

        register_rest_route('hsrev/v1', '/locations/(?P<location_id>[^\/]+)/reviews', [
            'methods' => 'GET',
            'callback' => [self::class, 'api_get_location_reviews'],
            'args' => [
                'page' => [
                    'default' => 1,
                    'validate_callback' => function ($param, $request, $key) {
                        return is_numeric($param) && $param > 0;
                    }
                ],
                'per_page' => [
                    'default' => 10,
                    'validate_callback' => function ($param, $request, $key) {
                        return is_numeric($param) && $param > 0;
                    }
                ]
            ],
            'permission_callback' => function () {
                $user_id = wp_validate_auth_cookie($_COOKIE[LOGGED_IN_COOKIE] ?? '', 'logged_in');
                if ($user_id) {
                    wp_set_current_user($user_id);
                }
                return current_user_can('manage_options');
            },
        ]);

        register_rest_route('hsrev/v1', 'public/reviews', [
            'methods' => 'GET',
            'callback' => [self::class, 'api_get_location_selected_reviews'],
            'args' => [
                'page' => [
                    'default' => 1,
                    'validate_callback' => function ($param, $request, $key) {
                        return is_numeric($param) && $param > 0;
                    }
                ],
                'per_page' => [
                    'default' => 10,
                    'validate_callback' => function ($param, $request, $key) {
                        return is_numeric($param) && $param > 0;
                    }
                ]
            ],
            'permission_callback' => '__return_true',
        ]);
        register_rest_route('hsrev/v1', 'public/location', [
            'methods' => 'GET',
            'callback' => [self::class, 'api_get_selected_location'],
            'permission_callback' => '__return_true',
        ]);
    }

    public static function api_get_accounts($request)
    {
        try {
            $page = $request->get_param('page');
            $per_page = $request->get_param('per_page');

            // Fetch paginated accounts
            $accounts = GoogleDataHandler::get_all_accounts($page, $per_page);

            // Get total number of accounts for pagination
            $total_accounts = GoogleDataHandler::get_total_accounts_count();

            return rest_ensure_response([
                'accounts' => $accounts,
                'total' => $total_accounts,
                'page' => $page,
                'per_page' => $per_page,
                'total_pages' => ceil($total_accounts / $per_page),
            ]);
        } catch (Exception $e) {
            return new WP_Error('account_fetch_failed', $e->getMessage(), ['status' => 500]);
        }
    }

    public static function api_get_account_locations($request)
    {
        $account_id = $request['account_id'];
        $account_key = 'accounts/' . $account_id;
        try {
            $page = $request->get_param('page');
            $per_page = $request->get_param('per_page');

            // Fetch paginated locations
            $locations = GoogleDataHandler::get_locations_by_account($account_key, $page, $per_page);

            // Get total number of locations for pagination
            $total_locations = GoogleDataHandler::get_total_locations_count($account_id);

            return rest_ensure_response([
                'locations' => $locations,
                'total' => $total_locations,
                'page' => $page,
                'per_page' => $per_page,
                'total_pages' => ceil($total_locations / $per_page),
            ]);
        } catch (Exception $e) {
            return new WP_Error('location_fetch_failed', $e->getMessage(), ['status' => 500]);
        }
    }

    public static function api_get_selected_account_locations($request)
    {
        $account_key = GoogleDataHandler::get_selected_account_id();
        try {
            $page = $request->get_param('page');
            $per_page = $request->get_param('per_page');

            // Fetch paginated locations
            $locations = GoogleDataHandler::get_locations_by_account($account_key, $page, $per_page);

            // Get total number of locations for pagination
            $total_locations = GoogleDataHandler::get_total_locations_count($account_key);

            return rest_ensure_response([
                'locations' => $locations,
                'total' => $total_locations,
                'page' => $page,
                'per_page' => $per_page,
                'total_pages' => ceil($total_locations / $per_page),
            ]);
        } catch (Exception $e) {
            return new WP_Error('location_fetch_failed', $e->getMessage(), ['status' => 500]);
        }
    }

    public static function api_get_all_locations($request)
    {
        try {
            $locations = GoogleDataHandler::get_all_locations();
            return rest_ensure_response($locations);
        } catch (Exception $e) {
            return new WP_Error('location_fetch_failed', $e->getMessage(), ['status' => 500]);
        }
    }

    public static function api_get_account_locations_total($request)
    {
        $account_id = $request['account_id'];
        $account_key = 'accounts/' . $account_id;
        try {
            if (GoogleDataHandler::is_locations_table_empty()) {
                GoogleDataHandler::get_initial_google_locations();
            }
            $locations = GoogleDataHandler::get_account_locations_total($account_key);
            return rest_ensure_response(['total' => $locations ?? []]);
        } catch (Exception $e) {
            return new WP_Error('location_fetch_failed', $e->getMessage(), ['status' => 500]);
        }
    }

    public static function api_get_location_reviews($request)
    {
        $location_id = $request['location_id'];
        $location_key = 'locations/' . $location_id;
        try {
            $page = $request->get_param('page') ?? 1;
            $per_page = $request->get_param('per_page') ?? 10;

            if(GoogleDataHandler::is_reviews_table_empty()) {
                GoogleDataHandler::get_initial_location_reviews($location_key);
            }
            // Fetch paginated reviews
            $reviews = GoogleDataHandler::get_reviews($location_key, $page, $per_page);

            // Get total number of reviews for pagination
            $total_reviews = GoogleDataHandler::get_total_reviews_count($location_key);

            return rest_ensure_response([
                'reviews' => $reviews,
                'total' => $total_reviews,
                'page' => $page,
                'per_page' => $per_page,
                'total_pages' => ceil($total_reviews / $per_page),
            ]);
        } catch (Exception $e) {
            return new WP_Error('reviews_fetch_failed', $e->getMessage(), ['status' => 500]);
        }
    }

    public static function api_get_selected_location($request) {
        try {
            return rest_ensure_response(
                GoogleDataHandler::get_selected_location());
        } catch (Exception $e) {
            return new WP_Error('reviews_fetch_failed', $e->getMessage(), ['status' => 500]);
        }
    }

    public static function api_get_location_selected_reviews($request) {

        // Debugging ONLY
        $location_key = GoogleDataHandler::get_selected_location_id();
        try {
            $page = $request->get_param('page');
            $per_page = $request->get_param('per_page');

            // Fetch paginated reviews
            $reviews = GoogleDataHandler::get_selected_location_reviews($location_key, $page, $per_page);
            $total_reviews = GoogleDataHandler::get_total_selected_reviews($location_key);

            return rest_ensure_response([
                'reviews' => $reviews,
                'total' => $total_reviews,
                'page' => $page,
                'per_page' => $per_page,
                'total_pages' => ceil($total_reviews / $per_page),
            ]);
        } catch (Exception $e) {
            return new WP_Error('reviews_fetch_failed', $e->getMessage(), ['status' => 500]);
        }
    }

    public static function api_get_location_reviews_total($request)
    {
        $location_id = $request['location_id'];
        $location_key = 'locations/' . $location_id;
        try {
            if (GoogleDataHandler::is_locations_table_empty()) {
                GoogleDataHandler::get_initial_google_locations();
            }

            if(GoogleDataHandler::is_location_reviews_empty($location_key)) {
                GoogleDataHandler::get_initial_location_reviews($location_key);
            }

            $reviews = GoogleDataHandler::get_location_reviews_length($location_key);
            return rest_ensure_response(['total' => $reviews ?? []]);
        } catch (Exception $e) {
            return new WP_Error('location_review_total_fetch_failed', $e->getMessage(), ['status' => 500]);
        }
    }

    // Responsible for the initial creation of the database tables.
    private static function wp_create_db_tables()
    {
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
            is_selected BOOLEAN NOT NULL DEFAULT FALSE,
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
            total_reviews SMALLINT UNSIGNED,
            is_selected BOOLEAN NOT NULL DEFAULT FALSE,
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
            is_selected BOOLEAN NOT NULL DEFAULT FALSE,
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

    public static function activate()
    {
        self::register_post_type();
        self::wp_create_db_tables();
        flush_rewrite_rules();
    }

    public static function deactivate()
    {
        flush_rewrite_rules();
    }
}
