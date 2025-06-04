<?php if (!empty($error)) : ?>
    <div class="notice notice-error"><p><?php echo esc_html($error); ?></p></div>
<?php endif; ?>

<?php if ($token): ?>
    <p><strong>Google account is connected.</strong></p>
    <form method="post">
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
                    <div class="account-row-item" data-account-id=<?php echo HyperSiteReviews::get_google_account_id($acc); ?>>
                        <input type="checkbox" name="selected-account">
                        <div class="account-row-item__cell" data-type="name"><?php echo $acc['name']; ?></div>
                        <div class="account-row-item__cell" data-type="account-name"><?php echo $acc['accountName']; ?></div>
                        <div class="account-row-item__cell" data-type="type"><?php echo $acc['type']; ?></div>
                        <div class="account-row-item__cell" data-type="location-count"><?php echo HyperSiteReviews::get_account_locations_length($acc['name'], false); ?></div>
                    </div>
                <?php endforeach ?>
            </div>
        <input type="submit" name="disconnect" value="Disconnect Google Account" class="button button-secondary">
    </form>
    <p><a href="<?php echo esc_url(admin_url('admin.php?page=hypersite-reviews')); ?>" class="button button-primary">Continue to Plugin</a></p>
<?php else: ?>
    <p><a href="<?php echo esc_url($authUrl); ?>" class="button button-primary">Connect with Google</a></p>
<?php endif; ?>
