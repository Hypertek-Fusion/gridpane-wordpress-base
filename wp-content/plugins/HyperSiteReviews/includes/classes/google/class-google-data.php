<?php


class GoogleDataHandler
{

    // Determine if the review count needs to be updated based on a timestamp
    private static function should_update_review_count($loc)
    {
        global $wpdb;
        $last_checked = $wpdb->get_var($wpdb->prepare(
            "SELECT last_review_check FROM {$wpdb->prefix}locations WHERE location_id = %s",
            $loc
        ));
        $current_time = current_time('timestamp');
        // Check if the last checked time is older than 1 hour
        return ($current_time - strtotime($last_checked)) > HOUR_IN_SECONDS;
    }

    // Update the last review count check timestamp
    private static function update_review_count_timestamp($loc)
    {
        global $wpdb;
        $wpdb->update(
            "{$wpdb->prefix}locations",
            ['last_review_check' => current_time('mysql')],
            ['location_id' => $loc]
        );
    }


    /**
     * Get Google Business accounts.
     *
     * @return array
     * @throws Exception
     */
    public static function get_google_accounts()
    {
        global $wpdb;

        $client = GoogleOAuthClient::get_client();

        if (!$client->getAccessToken()) {
            wp_redirect(admin_url('admin.php?page=hypersite-reviews-setup'));
            exit;
        }

        $service = new Google\Service\MyBusinessAccountManagement($client);

        try {
            $response = $service->accounts->listAccounts();
            foreach ($response->getAccounts() as $account) {
                $wpdb->replace(
                    $wpdb->prefix . 'accounts',
                    [
                        'account_id' => $account->getName(),
                        'account_name' => $account->getAccountName(),
                        'account_number' => $account->getAccountNumber(),
                        'permission_level' => $account->getPermissionLevel(),
                        'primary_owner' => $account->getPrimaryOwner(),
                        'role' => $account->getRole(),
                        'type' => $account->getType(),
                        'verification_state' => $account->getVerificationState(),
                        'vetted_state' => $account->getVettedState(),
                    ]
                );
            }
            return $wpdb->get_results("SELECT * FROM {$wpdb->prefix}accounts", ARRAY_A);
        } catch (Exception $e) {
            error_log('Error fetching business accounts: ' . $e->getMessage());
            throw new Exception('Failed to fetch accounts: ' . $e->getMessage());
        }
    }

    /**
     * Get locations for each account.
     *
     * @return array
     * @throws Exception
     */
    public static function get_locations_by_account($account_id, $page, $per_page)
    {
        global $wpdb;
        try {
            if (self::is_locations_table_empty()) {
                self::get_initial_google_locations();
            }

            // Calculate offset
            $offset = ($page - 1) * $per_page;

            return $wpdb->get_results($wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}locations WHERE parent_account_id = %s LIMIT %d OFFSET %d",
                $account_id,
                $per_page,
                $offset
            ), ARRAY_A);
        } catch (Exception $e) {
            error_log('Error fetching locations for account ' . $account_id . ': ' . $e->getMessage());
            throw new Exception('Failed to fetch locations: ' . $e->getMessage());
        }
    }


    /**
     * Get reviews for each location.
     *
     * @return array
     * @throws Exception
     */
    public static function get_initial_google_reviews()
    {
        global $wpdb;

        $client = GoogleOAuthClient::get_client();

        try {
            if (self::is_locations_table_empty()) {
                self::get_initial_google_locations();
            }
            $locations = self::get_all_locations();
            foreach ($locations as $location) {
                $location_id = $location['location_id'];
                $httpClient = $client->authorize();
                $nextPageToken = '';

                do {
                    $url = "https://mybusiness.googleapis.com/v4/{$location['parent_account_id']}/{$location_id}/reviews";
                    if (!empty($nextPageToken)) {
                        $url .= '?pageToken=' . urlencode($nextPageToken);
                    }

                    $response = $httpClient->get($url);

                    if ($response->getStatusCode() === 200) {
                        $reviewsData = json_decode($response->getBody()->getContents(), true);
                        $fetchedReviews = $reviewsData['reviews'] ?? [];
                        $nextPageToken = $reviewsData['nextPageToken'] ?? null;

                        foreach ($fetchedReviews as $review) {
                            $review_comment = $review['comment'] ?? null;
                            if($review_comment) {
                                    $wpdb->replace(
                                    $wpdb->prefix . 'reviews',
                                    [
                                        'review_id' => $review['reviewId'],
                                        'location_id' => $location_id,
                                        'reviewer_display_name' => $review['reviewer']['displayName'],
                                        'reviewer_profile_photo_url' => $review['reviewer']['profilePhotoUrl'],
                                        'star_rating' => $review['starRating'],
                                        'comment' => $review['comment'],
                                        'create_time' => $review['createTime'],
                                        'update_time' => $review['updateTime'],
                                        'review_reply_comment' => $review['reviewReply']['comment'] ?? null,
                                        'review_reply_update_time' => $review['reviewReply']['updateTime'] ?? null,
                                    ]
                                );
                            }
                        }
                    } else {
                        error_log('Failed to fetch reviews, HTTP code: ' . $response->getStatusCode());
                        throw new Exception('Failed to fetch reviews, HTTP code: ' . $response->getStatusCode());
                    }
                } while (!empty($nextPageToken));
            }
            return $wpdb->get_results("SELECT * FROM {$wpdb->prefix}reviews", ARRAY_A);
        } catch (Exception $e) {
            error_log('Error fetching reviews: ' . $e->getMessage());
            throw new Exception('Failed to fetch reviews: ' . $e->getMessage());
        }
    }

    public static function get_initial_location_reviews($loc_id)
    {
        global $wpdb;

        $client = GoogleOAuthClient::get_client();

        try {
            if (!self::location_exists($loc_id)) {
                self::get_initial_google_locations();
            }

            $locations = self::get_location($loc_id);
            $httpClient = $client->authorize();
            $nextPageToken = '';
            $reviews = [];

            do {
                $url = "https://mybusiness.googleapis.com/v4/{$locations['parent_account_id']}/{$locations['location_id']}/reviews";
                if (!empty($nextPageToken)) {
                    $url .= '?pageToken=' . urlencode($nextPageToken);
                }

                $response = $httpClient->get($url);

                if ($response->getStatusCode() === 200) {
                    $reviewsData = json_decode($response->getBody()->getContents(), true);
                    $fetchedReviews = $reviewsData['reviews'] ?? [];
                    $nextPageToken = $reviewsData['nextPageToken'] ?? null;

                    foreach ($fetchedReviews as $review) {
                        $review_comment = $review['comment'] ?? null;
                        if($review_comment) {
                            $wpdb->replace(
                                $wpdb->prefix . 'reviews',
                                [
                                    'review_id' => $review['reviewId'],
                                    'location_id' => $locations['location_id'],
                                    'reviewer_display_name' => $review['reviewer']['displayName'],
                                    'reviewer_profile_photo_url' => $review['reviewer']['profilePhotoUrl'],
                                    'star_rating' => $review['starRating'],
                                    'comment' => $review['comment'],
                                    'create_time' => $review['createTime'],
                                    'update_time' => $review['updateTime'],
                                    'review_reply_comment' => $review['reviewReply']['comment'] ?? null,
                                    'review_reply_update_time' => $review['reviewReply']['updateTime'] ?? null,
                                ]
                            );
                        }
                    }
                    $reviews = array_merge($reviews, $fetchedReviews);
                } else {
                    error_log('Failed to fetch reviews, HTTP code: ' . $response->getStatusCode());
                    throw new Exception('Failed to fetch reviews, HTTP code: ' . $response->getStatusCode());
                }
            } while (!empty($nextPageToken));

            return $reviews;
        } catch (Exception $e) {
            error_log('Error fetching reviews: ' . $e->getMessage());
            throw new Exception('Failed to fetch reviews: ' . $e->getMessage());
        }
    }

    public static function get_locations_reviews_length()
    {
        global $wpdb;

        try {
            $locations = $wpdb->get_results("SELECT location_id FROM {$wpdb->prefix}locations", ARRAY_A);

            foreach ($locations as $location) {
                $location_id = $location['location_id'];
                $review_count = $wpdb->get_var($wpdb->prepare(
                    "SELECT COUNT(*) FROM {$wpdb->prefix}reviews WHERE location_id = %s",
                    $location_id
                ));

                error_log("Location ID: $location_id, Review Count: $review_count");
            }
        } catch (Exception $e) {
            error_log('Error getting reviews count: ' . $e->getMessage());
            echo '<div class="notice notice-error"><p>Error getting reviews: ' . esc_html($e->getMessage()) . '</p></div>';
        }
    }

    public static function get_location_reviews_length($loc)
    {
        global $wpdb;

        $client = GoogleOAuthClient::get_client();

        try {
            // Check if data is stale based on a last updated timestamp.
            //$shouldUpdate = self::should_update_review_count($loc);

            // Fetch the count from the database
            $indexed_count = $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}reviews WHERE location_id = %s",
                $loc
            ));

            if($indexed_count <= 0) {
                self::get_initial_location_reviews($loc);
            }

            if (false) {
                $parent_account_id = $wpdb->get_var($wpdb->prepare(
                    "SELECT parent_account_id FROM {$wpdb->prefix}locations WHERE location_id = %s",
                    $loc
                ));

                $url = "https://mybusiness.googleapis.com/v4/{$parent_account_id}/{$loc}/reviews";
                $httpClient = $client->authorize();
                $response = $httpClient->get($url);

                if ($response->getStatusCode() === 200) {
                    $reviewsData = json_decode($response->getBody()->getContents(), true);
                    $review_count = $reviewsData['totalReviewCount'] ?? null;

                    if ($review_count !== null && $indexed_count !== $review_count) {
                        self::get_initial_location_reviews($loc);
                        $indexed_count = $wpdb->get_var($wpdb->prepare(
                            "SELECT COUNT(*) FROM {$wpdb->prefix}reviews WHERE location_id = %s",
                            $loc
                        ));
                    }

                    // Update the last checked timestamp
                    self::update_review_count_timestamp($loc);
                } else {
                    error_log('Failed to fetch reviews, HTTP code: ' . $response->getStatusCode());
                    throw new Exception('Failed to fetch reviews, HTTP code: ' . $response->getStatusCode());
                }
            }

            return $indexed_count !== null ? $indexed_count : 0;
        } catch (Exception $e) {
            error_log('Error getting reviews count: ' . $e->getMessage());
            throw new Exception('Failed to get reviews count: ' . $e->getMessage());
        }
    }

    /**
     * Get the total number of locations for a specific account.
     *
     * @param string $account_id The account ID.
     * @return int The number of locations for the specified account.
     */
    public static function get_account_locations_total($account_id)
    {
        global $wpdb;

        try {
            if (self::is_accounts_table_empty()) {
                self::get_google_accounts();
            }

            if (self::is_locations_table_empty()) {
                self::get_initial_google_locations();
            }

            $location_count = $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}locations WHERE parent_account_id = %s",
                $account_id
            ));

            return $location_count !== null ? $location_count : 0;
        } catch (Exception $e) {
            error_log('Error getting location count: ' . $e->getMessage());
            throw new Exception('Failed to get location count: ' . $e->getMessage());
        }
    }


    /**
     * Get all accounts.
     *
     * @return array
     */
    public static function get_all_accounts($page = 1, $per_page = 10) {
        global $wpdb;

        if (self::is_accounts_table_empty()) {
            self::get_google_accounts();
        }

        // Calculate offset
        $offset = ($page - 1) * $per_page;

        return $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}accounts LIMIT %d OFFSET %d",
            $per_page,
            $offset
        ), ARRAY_A);
    }

    /**
     * Get all locations.
     *
     * @return array
     */
    public static function get_all_locations()
    {
        global $wpdb;


        return $wpdb->get_results("SELECT * FROM {$wpdb->prefix}locations", ARRAY_A);
    }

    public static function get_all_accounts_locations()
    {
        global $wpdb;

        try {
            // Fetch all accounts

            if (self::is_accounts_table_empty()) {
                self::get_google_accounts();
            }
            $accounts = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}accounts", ARRAY_A);

            // Initialize an array to hold accounts and their locations
            $accounts_locations = [];

            // Fetch locations for each account
            foreach ($accounts as $account) {
                $account_id = $account['account_id'];

                // Fetch locations for the current account
                $locations = $wpdb->get_results($wpdb->prepare(
                    "SELECT * FROM {$wpdb->prefix}locations WHERE parent_account_id = %s",
                    $account_id
                ), ARRAY_A);

                // Store account data along with its locations
                $accounts_locations[$account_id] = [
                    'account' => $account,
                    'locations' => $locations,
                ];
            }

            return $accounts_locations;
        } catch (Exception $e) {
            error_log('Error fetching all accounts and their locations: ' . $e->getMessage());
            throw new Exception('Failed to fetch all accounts and locations: ' . $e->getMessage());
        }
    }

    public static function is_accounts_table_empty()
    {
        global $wpdb;

        $count = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}accounts");

        return $count == 0;
    }

    public static function is_locations_table_empty()
    {
        global $wpdb;

        $count = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}locations");

        return $count == 0;
    }

    public static function is_reviews_table_empty()
    {
        global $wpdb;

        $count = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}reviews");

        return $count == 0;
    }

    public static function is_location_reviews_empty($loc)
    {
        global $wpdb;

        $count = $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}reviews WHERE location_id = %s",
                $loc
        ));

        return $count == 0;
    }

    /**
     * Check if an account exists in the database.
     *
     * @param string $account_id The account ID to check.
     * @return bool True if the account exists, false otherwise.
     */
    public static function account_exists($account_id)
    {
        global $wpdb;

        $exists = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM {$wpdb->prefix}accounts WHERE account_id = %s",
            $account_id
        ));

        return $exists > 0;
    }

    /**
     * Check if a location exists in the database.
     *
     * @param string $location_id The location ID to check.
     * @return bool True if the location exists, false otherwise.
     */
    public static function location_exists($location_id)
    {
        global $wpdb;

        $exists = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM {$wpdb->prefix}locations WHERE location_id = %s",
            $location_id
        ));

        return $exists > 0;
    }

    public static function get_location($location_id)
    {
        global $wpdb;

        if (self::location_exists($location_id)) {
            // Use get_row to fetch the entire row as an associative array
            return $wpdb->get_row($wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}locations WHERE location_id = %s",
                $location_id
            ), ARRAY_A);
        }

        // Return null if the location does not exist
        return null;
    }

    public static function get_reviews($location_id, $page, $per_page)
    {
        global $wpdb;

        $client = GoogleOAuthClient::get_client();

        if (self::location_exists($location_id)) {
            // Calculate offset
            $offset = ($page - 1) * $per_page;

            return $wpdb->get_results($wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}reviews WHERE location_id = %s LIMIT %d OFFSET %d",
                $location_id,
                $per_page,
                $offset
            ), ARRAY_A);
        }

        return null;
    }

        /**
     * Get the selected account.
     *
     * @return array|null The selected account data or null if no account is selected.
     */
    public static function get_selected_account()
    {
        global $wpdb;

        return $wpdb->get_row("SELECT * FROM {$wpdb->prefix}accounts WHERE is_selected = TRUE", ARRAY_A);
    }

                /**
     * Get the selected account ID.
     *
     * @return array|null The selected account data or null if no account is selected.
     */
    public static function get_selected_account_id()
    {
        global $wpdb;

        return $wpdb->get_var("SELECT account_id FROM {$wpdb->prefix}accounts WHERE is_selected = TRUE");
    }

    /**
     * Get the selected account.
     *
     * @return array|null The selected account data or null if no account is selected.
     */
    public static function get_selected_account_locations($account_id, $page, $per_page)
    {
        global $wpdb;

        $client = GoogleOAuthClient::get_client();

        if (self::account_exists($account_id)) {
            // Calculate offset
            $offset = ($page - 1) * $per_page;

            // Update the SQL query to include the is_selected condition
            return $wpdb->get_results($wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}locations WHERE location_id = %s AND is_selected = TRUE LIMIT %d OFFSET %d",
                $account_id,
                $per_page,
                $offset
            ), ARRAY_A);
        }
    }

        /**
     * Get the selected location.
     *
     * @return array|null The selected location data or null if no location is selected.
     */
    public static function get_selected_location()
    {
        global $wpdb;

        return $wpdb->get_row("SELECT * FROM {$wpdb->prefix}locations WHERE is_selected = TRUE", ARRAY_A);
    }

    /**
     * Get the selected locations reviews.
     *
     * @return array|null The selected location data or null if no location is selected.
     */
    public static function get_selected_location_reviews($location_id, $page, $per_page)
    {
        global $wpdb;

        $offset = ($page - 1) * $per_page;

        // Update the SQL query to include the is_selected condition
        return $wpdb->get_results($wpdb->prepare(
            "SELECT reviewer_display_name, reviewer_profile_photo_url, comment, star_rating, create_time FROM {$wpdb->prefix}reviews WHERE location_id = %s AND is_selected = TRUE LIMIT %d OFFSET %d",
            $location_id,
            $per_page,
            $offset
        ), ARRAY_A);
    }

            /**
     * Get the selected location ID.
     *
     * @return array|null The selected location data or null if no location is selected.
     */
    public static function get_selected_location_id()
    {
        global $wpdb;

        return $wpdb->get_var("SELECT location_id FROM {$wpdb->prefix}locations WHERE is_selected = TRUE");
    }

    public static function get_selected_reviews($location_id, $page, $per_page)
    {
        global $wpdb;

        $client = GoogleOAuthClient::get_client();

        if (self::location_exists($location_id)) {
            // Calculate offset
            $offset = ($page - 1) * $per_page;

            // Update the SQL query to include the is_selected condition
            return $wpdb->get_results($wpdb->prepare(
                "SELECT reviewer_display_name, reviewer_profile_photo_url, comment, star_rating, create_time FROM {$wpdb->prefix}reviews WHERE location_id = %s AND is_selected = TRUE LIMIT %d OFFSET %d",
                $location_id,
                $per_page,
                $offset
            ), ARRAY_A);
        }

        return null;
    }

    public static function get_total_selected_reviews($location_id)
    {
        global $wpdb;

        if (self::location_exists($location_id)) {
            // Use get_var to get a single value (count)
            return $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}reviews WHERE location_id = %s AND is_selected = TRUE",
                $location_id
            ));
        }

        return 0; // Return 0 if the location does not exist
    }

    function set_selected_account($account_id) {
    global $wpdb;
    $accounts_table = $wpdb->prefix . 'accounts';
    
    // Unselect any currently selected account
    $wpdb->query("UPDATE $accounts_table SET is_selected = FALSE WHERE is_selected = TRUE");
    
    // Set the desired account to selected
    $wpdb->update(
        $accounts_table,
        array('is_selected' => TRUE),
        array('account_id' => $account_id)
    );
}

    public static function get_total_accounts_count()
    {
        global $wpdb;
        return $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}accounts");
    }

    public static function get_total_locations_count($account_id)
    {
        global $wpdb;
        return $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM {$wpdb->prefix}locations WHERE parent_account_id = %s",
            $account_id
        ));
    }

    public static function get_total_reviews_count($location_id)
    {
        global $wpdb;
        return $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM {$wpdb->prefix}reviews WHERE location_id = %s",
            $location_id
        ));
    }


    public static function get_initial_google_locations()
    {
        global $wpdb;

        $client = GoogleOAuthClient::get_client();

        if (!$client->getAccessToken()) {
            wp_redirect(admin_url('admin.php?page=hypersite-reviews-setup'));
            exit;
        }

        $service = new Google\Service\MyBusinessBusinessInformation($client);

        try {
            $accounts = null;
            // Fetch all accounts
            if (self::is_accounts_table_empty()) {
                $accounts = self::get_google_accounts();
            } else {
                $accounts = self::get_all_accounts();
            }

            if (!$accounts) throw new Exception('$accounts is null');

            foreach ($accounts as $account) {
                $account_id = $account['account_id'];

                // Fetch locations from Google API for the current account
                $response = $service->accounts_locations->listAccountsLocations($account_id, ['readMask' => 'name,title,labels,languageCode,storeCode,websiteUri']);

                foreach ($response->getLocations() as $location) {
                    $url = "https://mybusiness.googleapis.com/v4/{$account_id}/{$location->getName()}/reviews";
                    $httpClient = $client->authorize();
                    $response = $httpClient->get($url);

                    if ($response->getStatusCode() === 200) {
                        $reviewsData = json_decode($response->getBody()->getContents(), true);
                        $total_reviews = $reviewsData['totalReviewCount'] ?? null;

                        if ($total_reviews) {
                            $wpdb->replace(
                                $wpdb->prefix . 'locations',
                                [
                                    'location_id' => $location->getName(),
                                    'parent_account_id' => $account_id,
                                    'title' => $location->getTitle(),
                                    'labels' => json_encode($location->getLabels()),
                                    'language_code' => $location->getLanguageCode(),
                                    'store_code' => $location->getStoreCode(),
                                    'website_uri' => $location->getWebsiteUri(),
                                    'total_reviews' => $total_reviews,
                                ]
                            );
                        } else {
                            $wpdb->replace(
                                $wpdb->prefix . 'locations',
                                [
                                    'location_id' => $location->getName(),
                                    'parent_account_id' => $account_id,
                                    'title' => $location->getTitle(),
                                    'labels' => json_encode($location->getLabels()),
                                    'language_code' => $location->getLanguageCode(),
                                    'store_code' => $location->getStoreCode(),
                                    'website_uri' => $location->getWebsiteUri(),
                                    'total_reviews' => 0,
                                ]
                            );
                        }
                    }
                }
            }
        } catch (Exception $e) {
            error_log('Error fetching and storing locations: ' . $e->getMessage());
            throw new Exception('Failed to fetch and store locations: ' . $e->getMessage());
        }
    }

    public static function get_initial_google_location($acc_id)
    {
        global $wpdb;

        $client = GoogleOAuthClient::get_client();

        if (!$client->getAccessToken()) {
            wp_redirect(admin_url('admin.php?page=hypersite-reviews-setup'));
            exit;
        }

        $service = new Google\Service\MyBusinessBusinessInformation($client);

        try {
            $accounts = null;
            // Fetch all accounts
            if (self::is_accounts_table_empty()) {
                $accounts = self::get_google_accounts();
            } else {
                $accounts = self::get_all_accounts();
            }

            if (!$accounts) throw new Exception('$accounts is null');

            foreach ($accounts as $account) {
                $account_id = $account['account_id'];

                // Fetch locations from Google API for the current account
                $response = $service->accounts_locations->listAccountsLocations($account_id, ['readMask' => 'name,title,labels,languageCode,storeCode,websiteUri']);

                foreach ($response->getLocations() as $location) {
                    $url = "https://mybusiness.googleapis.com/v4/{$account_id}/{$location->getName()}/reviews";
                    $httpClient = $client->authorize();
                    $response = $httpClient->get($url);

                    if ($response->getStatusCode() === 200) {
                        $reviewsData = json_decode($response->getBody()->getContents(), true);
                        $total_reviews = $reviewsData['totalReviewCount'] ?? null;

                        if ($total_reviews) {
                            $wpdb->replace(
                                $wpdb->prefix . 'locations',
                                [
                                    'location_id' => $location->getName(),
                                    'parent_account_id' => $account_id,
                                    'title' => $location->getTitle(),
                                    'labels' => json_encode($location->getLabels()),
                                    'language_code' => $location->getLanguageCode(),
                                    'store_code' => $location->getStoreCode(),
                                    'website_uri' => $location->getWebsiteUri(),
                                    'total_reviews' => $total_reviews,
                                ]
                            );
                        } else {
                            $wpdb->replace(
                                $wpdb->prefix . 'locations',
                                [
                                    'location_id' => $location->getName(),
                                    'parent_account_id' => $account_id,
                                    'title' => $location->getTitle(),
                                    'labels' => json_encode($location->getLabels()),
                                    'language_code' => $location->getLanguageCode(),
                                    'store_code' => $location->getStoreCode(),
                                    'website_uri' => $location->getWebsiteUri(),
                                    'total_reviews' => 0,
                                ]
                            );
                        }
                    }
                }
            }
        } catch (Exception $e) {
            error_log('Error fetching and storing locations: ' . $e->getMessage());
            throw new Exception('Failed to fetch and store locations: ' . $e->getMessage());
        }
    }

    /**
     * Get all reviews.
     *
     * @return array
     */
    public static function get_all_reviews()
    {
        global $wpdb;

        return $wpdb->get_results("SELECT * FROM {$wpdb->prefix}reviews", ARRAY_A);
    }
}
