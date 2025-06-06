<?php
if (!defined('ABSPATH')) exit;

class GoogleOAuthClient {
    public static function get_client(): Google_Client {
        $client = new Google_Client();
        $client->setClientId(HSREV_GOOGLE_CLIENT_ID);
        $client->setClientSecret(HSREV_GOOGLE_CLIENT_SECRET);
        $client->setRedirectUri(admin_url(HSREV_GOOGLE_REDIRECT_URI));
        $client->addScope('https://www.googleapis.com/auth/business.manage');
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        $token = get_option('hsrev_google_oauth_token');
        if ($token) {
            $client->setAccessToken($token);
        }

        if ($client->isAccessTokenExpired()) {
            self::refresh_token($client);
        }

        return $client;
    }

    public static function refresh_token(Google_Client $client): bool {
        $refreshToken = get_option('hsrev_google_refresh_token');
        if ($refreshToken) {
            $client->fetchAccessTokenWithRefreshToken($refreshToken);
            if ($client->getAccessToken()) {
                update_option('hsrev_google_oauth_token', $client->getAccessToken());
                return true;
            } else {
                self::clear_tokens();
                return false;
            }
        } else {
            self::clear_tokens();
            return false;
        }
    }

    private static function clear_tokens() {
        delete_option('hsrev_google_oauth_token');
        delete_option('hsrev_google_refresh_token');
    }
}

?>