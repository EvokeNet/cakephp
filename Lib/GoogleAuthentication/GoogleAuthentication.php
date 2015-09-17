<?php
use Google\Client;
use Google\Service\OAuth2;
use Google\Service\Drive;

class GoogleAuthentication {

    public $CLIENT_ID;
    public $CLIENT_SECRET;
    public $API_KEY;
    public $REDIRECT_URI;

    public function __construct($client_id, $client_secret, $api_key) {
        $this->CLIENT_ID = $client_id;
        $this->CLIENT_SECRET = $client_secret;
        $this->API_KEY = $api_key;
        $this->REDIRECT_URI = 'http://localhost/evoke/groups_users/edit/1';
    }
    
    public function authorize($access_token = null, $refresh_token = null) {
        $client = new Google_Client();

        $client->setClientId($this->CLIENT_ID);
        $client->setClientSecret($this->CLIENT_SECRET);
        $client->setDeveloperKey($this->API_KEY);
        // $client->setAccessType('offline');
        $client->setApprovalPrompt('force');
        $client->setRedirectUri('http://localhost/evoke/groups_users/edit/1');

        $drive = new Google_Service_Drive($client);
        $client->addScope(Google_Service_Drive::DRIVE_FILE);

        $oauth2 = new Google_Service_Oauth2($client);
        $client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
        $client->addScope(Google_Service_Oauth2::USERINFO_PROFILE);

        if(!empty($access_token)) {
            $client->setAccessToken($access_token);
            if ($client->isAccessTokenExpired()) {
                $client->refreshToken(json_decode($refresh_token)->refresh_token);
                $token = $client->getAccessToken();
                $client->setAccessToken($token);
                return $token;
            } else {
                return $access_token;
            }

        } elseif (isset($_GET['code']) && empty($access_token)) {
            $client->authenticate($_GET['code']);
            $token = $client->getAccessToken();
            $client->setAccessToken($token);
            return $token;

        } elseif (!$client->getAccessToken()) {
            header('Location: ' . $client->createAuthUrl()); die();
        }
    }
}