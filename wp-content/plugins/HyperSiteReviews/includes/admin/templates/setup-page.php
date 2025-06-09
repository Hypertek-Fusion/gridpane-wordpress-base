<div class="wrap">
    <?php if (!empty($error)) : ?>
        <div class="notice notice-error">
            <p><?php echo esc_html($error); ?></p>
        </div>
    <?php endif; ?>

    <?php
    $token = get_option('hsrev_google_oauth_token');
    if ($token) {
        $client = GoogleOAuthClient::get_client(); // Use GoogleOAuthClient instead
        if ($client->isAccessTokenExpired()) {
            echo '<div class="notice notice-error"><p>Google account connection expired. Please reconnect.</p></div>';
            $authUrl = $client->createAuthUrl();
            echo '<p><a href="' . esc_url($authUrl) . '" class="button button-primary">Reconnect with Google</a></p>';
        } else {
    ?>
            <form method="post">
                <div class="setup-page" data-page="1">
                    <div class="selection-table" data-select-type="account" data-select="single">
                        <p>Select the Account you would like to use.</p>
                        <div class="selection-table__heading-row">
                            <div class="selection-table__heading"><p>Select</p></div>
                            <div class="selection-table__heading"><p>Account ID</p></div>
                            <div class="selection-table__heading"><p>Account Name</p></div>
                            <div class="selection-table__heading"><p>Account Type</p></div>
                            <div class="selection-table__heading"><p># of Locations</p></div>
                        </div>
                        <div id="account-rows"></div>
                    </div>
                </div>

                <div class="setup-page" data-page="2">
                    <div class="selection-table" data-select-type="location" data-select="single">
                        <p>Select the Location you would like to use.</p>
                        <div class="selection-table__heading-row">
                            <div class="selection-table__heading"><p>Select</p></div>
                            <div class="selection-table__heading"><p>Location ID</p></div>
                            <div class="selection-table__heading"><p>Location Name</p></div>
                            <div class="selection-table__heading"><p># of Reviews</p></div>
                        </div>
                        <div id="location-rows"></div>
                    </div>
                </div>

                <div class="setup-page" data-page="3">
                    <div class="selection-table" data-select-type="review">
                        <p>Reviews for the selected location:</p>
                        <div class="selection-table__heading-row">
                            <div class="selection-table__heading"><input id="select-all-reviews" type="checkbox" name="select-all-reviews"></div>
                            <div class="selection-table__heading"><p>Reviewer</p></div>
                            <div class="selection-table__heading"><p>Rating</p></div>
                            <div class="selection-table__heading"><p>Comment</p></div>
                            <div class="selection-table__heading"><p>Date</p></div>
                        </div>
                        <div id="review-rows"></div>
                        <div class="pagination-controls">
                            <label for="reviews-per-page">Reviews per page:</label>
                            <select id="reviews-per-page">
                                <option value="5">5</option>
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                            </select>
                            <button id="reviews-prev" disabled>Previous</button>
                            <button id="reviews-next" disabled>Next</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="button-wrapper">
                <button data-button-type="form-flow" class="page-prev" disabled>Previous Page</button>
                <button data-button-type="form-flow" class="page-next" disabled>Next Page</button>
            </div>
            <p><a href="<?php echo esc_url(admin_url('admin.php?page=hypersite-reviews')); ?>" class="button button-primary">Continue to Plugin</a></p>
    <?php
        }
    } else {
        $client = GoogleOAuthClient::get_client(); // Use GoogleOAuthClient instead
        $authUrl = $client->createAuthUrl();
    ?>
        <p><a href="<?php echo esc_url($authUrl); ?>" class="button button-primary">Connect with Google</a></p>
    <?php
    }
    ?>
</div>
