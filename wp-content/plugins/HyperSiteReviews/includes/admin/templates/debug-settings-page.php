<div class="wrap">
    <h1>HyperSite Reviews Debug Settings</h1>
    <h2>Flags</h2>
    <p>Handle any settings for debug purposes here.</p>
    <form method="post">
        <?php wp_nonce_field('hsrev_debug_setting_set'); ?>
        <label>Setup Complete? : </label>
        <input type="checkbox" name="is-setup" <?php checked(get_option('hsrev_setup_complete'), true); ?>>
        <label>Bypass Setup? : </label>
        <input type="checkbox" name="bypass-setup-page" <?php checked(get_option('hsrev_bypass_setup_page'), true); ?>>
        <label>Force Delete Google Oauth : </label>
        <input type="checkbox" name="force-delete-google-oauth">
        <input type="submit" value="Update Settings" class="button button-primary">
    </form>
    <br>
    <br>
    <h2>Data (Read-Only)</h2>

    <p>Current Oauth Token:<?php echo get_option('hsrev_google_oauth_token'); ?></p>
    <p>Current Refresh Token: <?php echo get_option('hsrev_google_refresh_token'); ?></p>
    <p>Total locations: <?php echo HyperSiteReviews::get_total_locations_length(); ?></p>

    <?php 
    
    foreach(HyperSiteReviews::get_accounts() as $acc_k => $acc_o) {
    ?>
        <h3>Account: <?php echo $acc_k ?></h3>
        <p>Length: <?php echo HyperSiteReviews::get_account_locations_length($acc_k); ?></p>
    <?php
    }
    
    ?>
</div>