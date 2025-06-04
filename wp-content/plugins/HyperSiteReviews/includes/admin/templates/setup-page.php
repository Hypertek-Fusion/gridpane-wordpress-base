<?php if (!empty($error)) : ?>
    <div class="notice notice-error"><p><?php echo esc_html($error); ?></p></div>
<?php endif; ?>

<?php if ($token): ?>
        <form method="post">
            <div class="setup-page" data-page="1">
                <?php wp_nonce_field('hsrev_google_disconnect'); ?>
                    <div id="account-selection-table" data-select="single">
                        <p>Select the Account you would like to use.</p>
                        <div class="account-selection-table__heading-row">
                            <div class="account-selection-table__heading" ><p>Select</p></div>
                            <div class="account-selection-table__heading"><p>Account ID</p></div>
                            <div class="account-selection-table__heading"><p>Account Name</p></div>
                            <div class="account-selection-table__heading"><p>Account Type</p></div>
                            <div class="account-selection-table__heading"><p># of Locations</p></div>
                        </div>

                        <?php foreach(HyperSiteReviews::get_accounts() as $acc) : ?>
                            <div class="rows">
                                <div class="account-row-item" data-account-id=<?php echo HyperSiteReviews::get_google_account_id($acc); ?>>
                                    <input type="checkbox" name="selected-account">
                                    <div class="account-row-item__cell" data-type="name"><?php echo $acc['name']; ?></div>
                                    <div class="account-row-item__cell" data-type="account-name"><?php echo $acc['accountName']; ?></div>
                                    <div class="account-row-item__cell" data-type="type"><?php echo $acc['type']; ?></div>
                                    <div class="account-row-item__cell" data-type="location-count"><?php echo HyperSiteReviews::get_account_locations_length($acc['name'], false); ?></div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <input type="submit" name="disconnect" value="Disconnect Google Account" class="button button-secondary">
            </div>
            <pre>
                <?php echo print_r(HyperSiteReviews::get_account_locations(), true); ?>
            </pre>
            <div class="setup-page" data-page="2">
                    <div id="account-selection-table" data-select="single">
                        <p>Select the Location you would like to use.</p>
                        <div class="account-selection-table__heading-row">
                            <div class="account-selection-table__heading" ><p>Select</p></div>
                            <div class="account-selection-table__heading"><p>Location ID</p></div>
                            <div class="account-selection-table__heading"><p>Location Name</p></div>
                            <div class="account-selection-table__heading"><p># of Reviews</p></div>
                        </div>
                        <?php foreach(HyperSiteReviews::get_account_locations() as $acc_k => $loc_o) : ?>
                            <div class="rows">
                                <div class="account-row-item" data-account-id=<?php echo $loc_o['name']; ?>>
                                    <input type="checkbox" name="selected-location">
                                    <div class="account-row-item__cell" data-type="name"><?php echo $loc_o->getName(); ?></div>
                                    <div class="account-row-item__cell" data-type="account-name"><?php echo $loc_o->getTitle(); ?></div>
                                    <div class="account-row-item__cell" data-type="location-count"><?php echo HyperSiteReviews::get_location_reviews_length($loc_o['name'], false); ?></div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
            </div>
        </form>

        <div class="button-wrapper">
            <button data-button-type="form-flow" class="page-prev" disabled>Previous Page</button>
            <button data-button-type="form-flow" class="page-next" disabled>Next Page</button>
        </div>

    <p><a href="<?php echo esc_url(admin_url('admin.php?page=hypersite-reviews')); ?>" class="button button-primary">Continue to Plugin</a></p>
<?php else: ?>
    <p><a href="<?php echo esc_url($authUrl); ?>" class="button button-primary">Connect with Google</a></p>
<?php endif; ?>
