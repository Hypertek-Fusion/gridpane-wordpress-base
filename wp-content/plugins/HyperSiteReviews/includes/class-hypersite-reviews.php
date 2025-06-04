<?php
if ( ! defined('ABSPATH') ) exit;

class HyperSiteReviews {
    private static $accounts = [];
    private static $account_locations = [];

    public static function init() {
        try {
            add_action('admin_menu', [self::class, 'add_admin_menus']);
            add_action('admin_init', [self::class, 'maybe_redirect_to_setup']);

            if(HSREV_DEBUG) {
                add_action('admin_menu', [self::class, 'add_debug_admin_menus']);
            }

            if (get_option('hsrev_setup_complete')) {
                add_action('init', [self::class, 'register_post_type']);
            }
        } catch (Exception $e) {
            error_log('Error initializing HyperSiteReviews: ' . $e);
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

        add_submenu_page(
            null,
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

    public static function maybe_redirect_to_setup() {
        if ( ! is_admin() || ! current_user_can('manage_options') ) {
            return;
        }

        if ( get_option('hsrev_setup_complete') || get_option('hsrev_bypass_setup_page')) {
            return;
        }

        $current_page = $_GET['page'] ?? '';

        $is_hsrev_page = in_array($current_page, [
            'hypersite-reviews',
            'hypersite-reviews-settings',
        ], true);

        if ( $is_hsrev_page && $current_page !== 'hypersite-reviews-setup' && ! get_option('hsrev_bypass_setup_page') ) {
            wp_redirect(admin_url('admin.php?page=hypersite-reviews-setup'));
            exit;
        }
    }

    public static function main_page() {
        echo '<div class="wrap"><h1>HyperSite Review</h1></div>';
    }

    public static function setup_page() {
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized');
        }

        $client = self::get_google_client();

        // Disconnect handler - revoke token on Google and delete locally
        if (isset($_POST['disconnect']) && check_admin_referer('hsrev_google_disconnect')) {
            if ($client->getAccessToken()) {
                $client->revokeToken();
            }
            delete_option('hsrev_google_oauth_token');
            echo '<div class="notice notice-success"><p>Disconnected from Google account.</p></div>';
        }

        // OAuth callback handler
        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

            if (isset($token['error'])) {
                $error = $token['error_description'] ?? $token['error'];
            } else {
                update_option('hsrev_google_oauth_token', $token);
                update_option('hsrev_setup_complete', true);

                wp_safe_redirect(admin_url('admin.php?page=hypersite-reviews'));
                exit;
            }
        }

        $token = get_option('hsrev_google_oauth_token');
        $authUrl = $client->createAuthUrl();

        include HSREV_PATH . 'includes/admin/templates/setup-page.php';
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

    public static function settings_page() {
        echo '<div class="wrap"><h1>HyperSite Review Settings</h1></div>';
    }

    public static function google_connect_page() {
        if ( ! current_user_can('manage_options') ) {
            wp_die('Unauthorized user');
        }

        $message = '';
        $error = false;

        if ( ! empty($_GET['code']) ) {
            $code = sanitize_text_field(wp_unslash($_GET['code']));
            $client = self::get_google_client();

            try {
                $token = $client->fetchAccessTokenWithAuthCode($code);

                if (!empty($token['refresh_token'])) {
                    error_log('Refresh token found: '. $token['refresh_token']);
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

    public static function get_google_client(): Google_Client {
        $client = new Google_Client();
        $client->setClientId(HSREV_GOOGLE_CLIENT_ID);
        $client->setClientSecret(HSREV_GOOGLE_CLIENT_SECRET);
        $client->setRedirectUri(admin_url(HSREV_GOOGLE_REDIRECT_URI));
        $client->addScope('https://www.googleapis.com/auth/business.manage');
        $client->setAccessType('offline'); // refresh tokens
        $client->setPrompt('consent');

        $token = get_option('hsrev_google_oauth_token');
        if ($token) {
            $client->setAccessToken($token);
        }

        return $client;
    }

    /**
     * Checks if the access token is expired, refreshes it if needed,
     * updates the stored token, or clears tokens if refresh fails.
     */
    public static function refresh_google_token_if_needed(): bool {
        $client = self::get_google_client();

        if ($client->isAccessTokenExpired()) {
            $refreshToken = $client->getRefreshToken();

            if ($refreshToken) {
                $newToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);

                if (isset($newToken['error'])) {
                    error_log('Error refreshing Google token: ' . ($newToken['error_description'] ?? $newToken['error']));
                    // Token invalid, clear saved tokens to force reconnect
                    delete_option('hsrev_google_oauth_token');
                    return false;
                } else {
                    // Update the stored token with new token data
                    update_option('hsrev_google_oauth_token', $client->getAccessToken());
                    return true;
                }
            } else {
                error_log('No refresh token available for Google API.');
                delete_option('hsrev_google_oauth_token');
                return false;
            }
        }
        // Token still valid, no action needed
        return true;
    }

    // Gets Google Accounts
    public static function get_google_accounts() {
        $client = HyperSiteReviews::get_google_client();

        if (!HyperSiteReviews::refresh_google_token_if_needed()) {
            wp_redirect(admin_url('admin.php?page=hypersite-reviews-setup'));
            exit;
        }

        // Create the My Business Account Management service
        $service = new Google\Service\MyBusinessAccountManagement($client);

        // Call the API to list accounts
        try {
            $response = $service->accounts->listAccounts();

            foreach($response->getAccounts() as $account) {
                self::$accounts[$account->getName()] = $account;
            }
        } catch (Exception $e) {
            error_log('Error fetching business accounts: ' . $e->getMessage());
            echo '<div class="notice notice-error"><p>Failed to fetch accounts: ' . esc_html($e->getMessage()) . '</p></div>';
        }
    }

    public static function get_accounts() {
        if(empty(self::$accounts)) self::get_google_accounts();
        return self::$accounts;
    }

    public static function get_account_locations() {
        if(empty(self::$accounts_locations)) self::get_locations_by_account();
        return self::$account_locations;
    }

    // Takes an Account Object and returns the account ID
    public static function get_google_account_id($acc) {
        try {
            if(! method_exists($acc, 'getName')) throw new Exception("Method 'getName()' does not exist.");
            return str_replace('accounts/', '', $acc->getName());
        } catch (Exception $e) {
            error_log('Error getting Google Account ID: ' . $e->getMessage());
            echo '<div class="notice notice-error"><p>Failed to get Google Account ID: ' . esc_html($e->getMessage()) . '</p></div>';
        }
    }

    // Gets the locations for each account
    public static function get_locations_by_account() {
        try {
            $client = HyperSiteReviews::get_google_client();

            if (!HyperSiteReviews::refresh_google_token_if_needed()) {
                wp_redirect(admin_url('admin.php?page=hypersite-reviews-setup'));
                exit;
            }

            $service = new Google\Service\MyBusinessBusinessInformation($client);
            if(empty(self::$accounts)) throw new Exception('No accounts found.');

            foreach(self::$accounts as $account) {
                $curr_account = $account->getName();
                $response = $service->accounts_locations->listAccountsLocations(
                    $curr_account,
                    ['readMask' => 'name,title']
                );
                foreach($response as $location) {
                    self::$account_locations[$curr_account] = $location;
                }
            }
        } catch (Exception $e) {
            error_log('Error getting Google Account ID: ' . $e->getMessage());
            wp_redirect(admin_url('admin.php?page=hypersite-reviews-setup'));
            echo '<div class="notice notice-error"><p>Failed to get Google Account ID: ' . esc_html($e->getMessage()) . '</p></div>';
        }
    }

    public static function activate() {
        self::register_post_type();
        flush_rewrite_rules();
    }

    public static function deactivate() {
        flush_rewrite_rules();
    }
}
