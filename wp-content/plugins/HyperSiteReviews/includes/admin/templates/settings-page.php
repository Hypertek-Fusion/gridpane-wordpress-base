<?php if (!defined('ABSPATH')) exit; ?>

<div class="wrap">
    <h1>HyperSite Review Settings</h1>

    <?php
    $token = get_option('hsrev_google_oauth_token');
    if ($token) {
        // Token exists, show the disconnect option
        $client = GoogleOAuthClient::get_client();
        ?>

        <form method="post">
            <?php wp_nonce_field('hsrev_google_disconnect'); ?>
            <input type="submit" name="disconnect" value="Disconnect Google Account" class="button button-secondary">
        </form>

        <?php
        // Handle the disconnect action
        if (isset($_POST['disconnect']) && check_admin_referer('hsrev_google_disconnect')) {
            if ($client->getAccessToken()) {
                $client->revokeToken(); // Revoke the token on Google's side
            }
            delete_option('hsrev_google_oauth_token'); // Delete the token from the database
            echo '<div class="notice notice-success"><p>Disconnected from Google account.</p></div>';
        }
    } else {
        echo '<div class="notice notice-info"><p>No Google account is currently connected.</p></div>';
    }
    ?>
</div>
