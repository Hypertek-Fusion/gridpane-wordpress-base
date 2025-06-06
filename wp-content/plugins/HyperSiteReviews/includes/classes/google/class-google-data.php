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
        $client = GoogleOAuthClient::get_client();

        if (!$client->getAccessToken()) {
            wp_redirect(admin_url('admin.php?page=hypersite-reviews-setup'));
            exit;
        }

        $service = new Google\Service\MyBusinessAccountManagement($client);

        try {
            $response = $service->accounts->listAccounts();
            foreach ($response->getAccounts() as $account) {
                self::$accounts[$account->getName()] = $account;
            }
            return self::$accounts;
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
    public static function get_locations_by_account() {
        $client = GoogleOAuthClient::get_client();

        if (!$client->getAccessToken()) {
            wp_redirect(admin_url('admin.php?page=hypersite-reviews-setup'));
            exit;
        }

        $service = new Google\Service\MyBusinessBusinessInformation($client);

        if (empty(self::$accounts)) self::get_google_accounts();

        try {
            foreach (self::$accounts as $account) {
                $curr_account = $account->getName();
                $response = $service->accounts_locations->listAccountsLocations($curr_account, ['readMask' => 'name,title']);
                foreach ($response as $location) {
                    self::$account_locations[$curr_account][$location->getName()] = $location;
                }
            }
            return self::$account_locations;
        } catch (Exception $e) {
            error_log('Error fetching locations: ' . $e->getMessage());
            throw new Exception('Failed to fetch locations: ' . $e->getMessage());
        }
    }

    /**
     * Get reviews for each location.
     *
     * @return array
     * @throws Exception
     */
    public static function get_account_location_reviews() {
        $client = GoogleOAuthClient::get_client();

        if (empty(self::$accounts)) self::get_google_accounts();
        if (empty(self::$account_locations)) self::get_locations_by_account();

        try {
            foreach (self::$account_locations as $acc => $loc) {
                foreach ($loc as $loc_k => $loc_v) {
                    $url = "https://mybusiness.googleapis.com/v4/{$acc}/{$loc_k}/reviews";
                    $httpClient = $client->authorize();
                    $response = $httpClient->get($url);

                    if ($response->getStatusCode() === 200) {
                        $reviewsData = json_decode($response->getBody()->getContents(), true);
                        $reviews = $reviewsData['reviews'] ?? null;

                        if ($reviews) {
                            foreach ($reviews as $review) {
                                self::$location_reviews[$loc_k][$review['reviewId']] = $review;
                            }
                        }
                    } else {
                        error_log('Failed to fetch reviews, HTTP code: ' . $response->getStatusCode());
                        throw new Exception('Failed to fetch reviews, HTTP code: ' . $response->getStatusCode());
                    }
                }
            }
            return self::$location_reviews;
        } catch (Exception $e) {
            error_log('Error fetching reviews: ' . $e->getMessage());
            throw new Exception('Failed to fetch reviews: ' . $e->getMessage());
        }
    }

    /**
     * Get the total number of locations for a specific account.
     *
     * @param string $account_id The account ID.
     * @return int The number of locations for the specified account.
     */
    public static function get_account_locations_total($account_id) {
        if (empty(self::$account_locations)) {
            self::get_locations_by_account();
        }

        return isset(self::$account_locations[$account_id]) ? count(self::$account_locations[$account_id]) : 0;
    }

    /**
     * Get all accounts.
     *
     * @return array
     */
    public static function get_all_accounts() {
        if (empty(self::$accounts)) self::get_google_accounts();
        return self::$accounts;
    }

    /**
     * Get all locations.
     *
     * @return array
     */
    public static function get_all_locations() {
        if (empty(self::$account_locations)) self::get_locations_by_account();
        return self::$account_locations;
    }

    /**
     * Get all reviews.
     *
     * @return array
     */
    public static function get_all_reviews() {
        if (empty(self::$location_reviews)) self::get_account_location_reviews();
        return self::$location_reviews;
    }
}


?>