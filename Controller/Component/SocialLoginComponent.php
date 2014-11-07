<?php

App::uses('Component', 'Controller');

class SocialLoginComponent extends Component {

    public $components = array('Auth', 'Session');

    public function create_google_url() {

      $client = new Google_Client();
      $client->setApplicationName('Evoke');
      $client->setClientId(Configure::read('google_client_id'));
      $client->setClientSecret(Configure::read('google_client_secret'));
      $client->setRedirectUri(Configure::read('google_redirect_uri'));
      $client->setDeveloperKey(Configure::read('google_developer_key'));

      $google_oauthV2 = new Google_Service_Oauth2($client);

      $client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
      $client->addScope(Google_Service_Oauth2::USERINFO_PROFILE);

      $loginURL = $client->createAuthUrl();

      return $loginURL;

    }

    public function google_login($params) {

        $this->User = ClassRegistry::init('User');

        $client = new Google_Client();
        $client->setApplicationName('Evoke');
        $client->setClientId(Configure::read('google_client_id'));
        $client->setClientSecret(Configure::read('google_client_secret'));
        $client->setRedirectUri(Configure::read('google_redirect_uri'));
        $client->setDeveloperKey(Configure::read('google_developer_key'));

        $google_oauthV2 = new Google_Service_Oauth2($client);

        $client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
        $client->addScope(Google_Service_Oauth2::USERINFO_PROFILE);
        $client->authenticate($params);
        $_SESSION['access_token'] = $client->getAccessToken();

        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {

          $user_profile = $google_oauthV2->userinfo->get();

          // $_SESSION['user']['name'] = $user_profile['name'];
          // $_SESSION['user']['firstname'] = $user_profile['givenName'];
          // $_SESSION['user']['lastname'] = $user_profile['familyName'];
          // $_SESSION['user']['email'] = $user_profile['email'];
          // $_SESSION['user']['google_id'] = $user_profile['id'];

          $user_google = $this->User->find('first', array('conditions' => array('User.email' => $user_profile['email'])));

          if(empty($user_google)) {
            // User does not exist in DB, so we are going to create
            $this->User->create();
            $user_google['User']['google_id'] = $user_profile['id'];
            $user_google['User']['google_token'] = $client->getAccessToken();
            $user_google['User']['name'] = $user_profile['name'];
            $user_google['User']['firstname'] = $user_profile['givenName'];
            $user_google['User']['lastname'] = $user_profile['familyName'];
            $user_google['User']['email'] = $user_profile['email'];
            $user_google['User']['role'] = 'user';

            if($this->User->save($user_google)) {
              $user_google['User']['id'] = $this->User->id;
              $this->Auth->login($user_google);
              $date = date('Y:m:d', $_SERVER['REQUEST_TIME']);

              //return $this->User->id; //$this->redirect(array('action' => 'edit', $this->User->id));

            } else {
                $this->Session->setFlash(__('There was some interference in your connection.'), 'error');
                //return null; //$this->redirect(array('action' => 'login'));
            }

          } else {
              // User exists, so we just force login
              // TODO: check if any data changed since last Facebook login, then update in our table

              // We need to update the Facebook token, once web tokens are short-term only
              $this->User->id = $user_google['User']['id'];
              $this->User->set('google_token', $client->getAccessToken());
              $this->User->save();

              $user_google['User']['id'] = $this->User->id;
              $this->Auth->login($user_google);

              $date = date('Y:m:d', $_SERVER['REQUEST_TIME']);

              //return $this->User->id; //$this->redirect(array('controller' => 'users', 'action' => 'matching', $this->User->id));
          }
        }


            // else {
            //     $googleLoginURL = $client->createAuthUrl();
            //
            //     // if(isset($googleLoginURL))
            //     //   $this->Session->write('googleLoginURL', $googleLoginURL); //return $googleLoginURL;
            //
            //     //debug($googleLoginURL);
            //
            //     return $googleLoginURL;
            // }
      }
}
