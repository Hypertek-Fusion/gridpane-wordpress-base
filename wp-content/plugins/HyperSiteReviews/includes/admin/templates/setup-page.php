<?php if (!empty($error)) : ?>
    <div class="notice notice-error"><p><?php echo esc_html($error); ?></p></div>
<?php endif; ?>

<?php if ($token): ?>
    <p><strong>Google account is connected.</strong></p>
    <form method="post">
        <?php wp_nonce_field('hsrev_google_disconnect'); ?>
            <div id="account-selection-table">
                <pre>
                    <?php 
                    
                    $locations = HyperSiteReviews::get_account_locations();

                    foreach($locations as $acc => $loc) {
                        foreach($loc as $loc_k => $loc_v) {
                            echo HyperSiteReviews::get_location_reviews($acc, $loc_k);
                        }
                    }
                    
                    ?>
                </pre>
            </div>
        <input type="submit" name="disconnect" value="Disconnect Google Account" class="button button-secondary">
    </form>
    <p><a href="<?php echo esc_url(admin_url('admin.php?page=hypersite-reviews')); ?>" class="button button-primary">Continue to Plugin</a></p>
<?php else: ?>
    <p><a href="<?php echo esc_url($authUrl); ?>" class="button button-primary">Connect with Google</a></p>
<?php endif; ?>
