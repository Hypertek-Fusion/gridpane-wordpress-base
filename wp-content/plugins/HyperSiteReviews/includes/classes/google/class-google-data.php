<?php

class GoogleDataHandler {
    private static $accounts = [];
    private static $account_locations = [];
    private static $location_reviews = [];

    /**
     * Get Google Business accounts.
     *
     * @return array
     * @throws Exception
     */
public static function get_google_accounts() {
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
public static function get_locations_by_account($account_id) {
    global $wpdb;
    try {
        error_log('Account ID: ');
        error_log(print_r($account_id, true));
        // Query the locations table for entries with the specified parent_account_id
        $locations = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}locations WHERE parent_account_id = %s",
            $account_id
        ), ARRAY_A);
        error_log(print_r($locations, true));
    
        return $locations;
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
public static function get_initial_google_reviews() {
    global $wpdb;

    $client = GoogleOAuthClient::get_client();

    try {
        if(self::is_locations_table_empty()) {
            self::get_initial_google_locations();
        }
        $locations = self::get_all_accounts_locations();
        foreach ($locations as $location) {
            $location_id = $location['location_id'];
            $url = "https://mybusiness.googleapis.com/v4/{$location['parent_account_id']}/{$location_id}/reviews";
            $httpClient = $client->authorize();
            $response = $httpClient->get($url);
            
            if ($response->getStatusCode() === 200) {
                $reviewsData = json_decode($response->getBody()->getContents(), true);
                $reviews = $reviewsData['reviews'] ?? null;

                if ($reviews) {
                    foreach ($reviews as $review) {
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
        }
        return $wpdb->get_results("SELECT * FROM {$wpdb->prefix}reviews", ARRAY_A);
    } catch (Exception $e) {
        error_log('Error fetching reviews: ' . $e->getMessage());
        throw new Exception('Failed to fetch reviews: ' . $e->getMessage());
    }
}


public static function get_locations_reviews_length() {
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


public static function get_location_reviews_length($acc, $loc) {
    global $wpdb;

    try {
        $review_count = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM {$wpdb->prefix}reviews WHERE location_id = %s",
            $loc
        ));

        if ($review_count !== null) {
            return $review_count;
        } else {
            error_log('No reviews found for location.');
            throw new Exception('No reviews found for location.');
        }
    } catch (Exception $e) {
        error_log('Error getting reviews count: ' . $e->getMessage());
        echo '<div class="notice notice-error"><p>Error getting reviews: ' . esc_html($e->getMessage()) . '</p></div>';
    }
}


    /**
     * Get the total number of locations for a specific account.
     *
     * @param string $account_id The account ID.
     * @return int The number of locations for the specified account.
     */
public static function get_account_locations_total($account_id) {
    global $wpdb;

    try {
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
public static function get_all_accounts() {
    global $wpdb;

    return $wpdb->get_results("SELECT * FROM {$wpdb->prefix}accounts", ARRAY_A);
}


    /**
     * Get all locations.
     *
     * @return array
     */
public static function get_all_locations() {
    global $wpdb;

    return $wpdb->get_results("SELECT * FROM {$wpdb->prefix}locations", ARRAY_A);
}

public static function get_all_accounts_locations() {
    global $wpdb;

    try {
        // Fetch all accounts
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

public static function is_accounts_table_empty() {
    global $wpdb;

    $count = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}accounts");

    return $count == 0;
}

public static function is_locations_table_empty() {
    global $wpdb;

    $count = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}locations");

    return $count == 0;
}

public static function is_reviews_table_empty() {
    global $wpdb;

    $count = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}reviews");

    return $count == 0;
}



public static function get_initial_google_locations() {
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
        if(self::is_accounts_table_empty()) {
            $accounts = self::get_google_accounts();
        } else {
            $accounts = self::get_all_accounts();
        }

        if(!$accounts) throw new Exception('$accounts is null');
        
        foreach ($accounts as $account) {
            $account_id = $account['account_id'];
            
            // Fetch locations from Google API for the current account
            $response = $service->accounts_locations->listAccountsLocations($account_id, ['readMask' => 'name,title,labels,languageCode,storeCode,websiteUri']);
            
            foreach ($response->getLocations() as $location) {
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
                    ]
                );
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
public static function get_all_reviews() {
    global $wpdb;

    return $wpdb->get_results("SELECT * FROM {$wpdb->prefix}reviews", ARRAY_A);
}

}


?>