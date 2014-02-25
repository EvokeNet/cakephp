<?php
use Google\Client;
use Google\Service\OAuth2;
use Google\Service\Drive;

class GoogleAuthentication {

    public $CLIENT_ID;
    public $CLIENT_SECRET;
    public $API_KEY;

    public function __construct($client_id, $client_secret, $api_key) {
        $this->CLIENT_ID = $client_id;
        $this->CLIENT_SECRET = $client_secret;
        $this->API_KEY = $api_key;
    }

    public function authorize($project = null) {

        $client = new Google_Client();
        $client->setClientId($this->CLIENT_ID);
        $client->setClientSecret($this->CLIENT_SECRET);
        $client->setDeveloperKey($this->API_KEY);
        $client->setAccessType('offline');
        $client->setRedirectUri('http://localhost/evoke/groups_users/view/3');

        $drive = new Google_Service_Drive($client);
        $client->addScope(Google_Service_Drive::DRIVE_FILE);

        $oauth2 = new Google_Service_Oauth2($client);
        $client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
        $client->addScope(Google_Service_Oauth2::USERINFO_PROFILE);

        if(!empty($project)) {
            if($client->getAuth()->isAccessTokenExpired()) {
                $client->getAuth()->refreshTokenWithAssertion($cred);
            }
        } else {
            if (isset($_GET['code'])) {
                $client->authenticate($_GET['code']);
                $token = $client->getAccessToken();
                $token = json_decode($token);
                // $token = $client->getRefreshToken();
                return $token;
            } else if(!$client->getAccessToken()) {
                header('Location: ' . $client->createAuthUrl());
            }
        }
    }
}