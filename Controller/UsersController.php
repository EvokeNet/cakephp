<?php

require APP.'Vendor'.DS.'facebook'.DS.'php-sdk'.DS.'src'.DS.'facebook.php';

// require_once APP.'Vendor'.DS.'google-login'.DS.'src'.DS.'Google_Client.php';
// require_once APP.'Vendor'.DS.'google-login'.DS.'src'.DS.'contrib'.DS.'Google_Oauth2Service.php';

require_once APP.'Vendor'.DS.'google'.DS. 'apiclient'.DS.'src'.DS.'Google'.DS.'Client.php';
require_once APP.'Vendor'.DS.'google'.DS. 'apiclient'.DS.'src'.DS.'Google'.DS.'Service'.DS.'Oauth2.php';

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
  //public $components = array('MathCaptcha', 'Visit');

  public $components = array('UserRole');

  public $uses = array('User', 'Friend');

  public $user = null;

  public $helpers = array('Menu', 'Phase');

  public $paginate;

/**
*
* beforeFilter method
*
* @return void
*/
  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('add', 'login', 'logout', 'register', 'forgot', 'changelanguage');
  }

  // public function createTempPassword($len) {
  // 		$pass = '';
  // 		$lchar = 0;
  // 		$char = 0;
  // 		for($i = 0; $i < $len; $i++) {
  // 			while($char == $lchar) {
  // 				$char = rand(48, 109);
  // 				if($char > 57) $char += 7;
  // 				if($char > 90) $char += 6;
  // 			}
  // 			$pass .= chr($char);
  // 			$lchar = $char;
  // 		}
  // 		return $pass;
  // 	}

  public function changeLanguage($lang){
    parent::changeLanguage($lang);
  }

  public function changePassword() {
    $usr = $this->User->find('first', array(
      'conditions' => array(
        'User.id' => $this->getUserId()
      )
    ));

    if(empty($usr))
      $this->redirect($this->referer());


    if ($this->request->is('post')) {
      if(AuthComponent::password($this->request->data['User']['password']) == $usr['User']['password']) {
        if($this->request->data['User']['tmp'] == $this->request->data['User']['tmp2']) {
          $this->User->id = $this->getUserId();
          $insert['User']['id'] = $this->getUserId();
          $insert['User']['role_id'] = $this->getUserRole();
          $insert['User']['password'] = $this->request->data['User']['tmp'];
          $this->User->save($insert);
          $this->Session->setFlash(__("Your password was changed."), 'flash_message');
          $this->redirect(array('action' => 'dashboard'));
        } else {
          $this->Session->setFlash(__("The new passwords do not match."), 'flash_message');
          $this->redirect(array('action' => 'changePassword'));
        }
      } else {
        $this->Session->setFlash(__("The current password does not match."), 'flash_message');
        $this->redirect(array('action' => 'changePassword'));
      }
    }

    $this->set(compact('usr'));
    // die();
  }

/**
 * login method
 *
 * @return void
 */
  public function login() {

    $this->loadModel('Mission');
    $missions = $this->Mission->find('all');
    $video_url = 'http://player.vimeo.com/video/94984840';

    //---------------------------------
    //TRANSLATION

    $lang = $this->getCurrentLanguage();

    if ($lang == 'es') {
      $video_url = 'http://player.vimeo.com/video/93164917';

      //Missions
      foreach($missions as &$mission) {
        $mission['Mission']['title'] = $mission['Mission']['title_es'];
        $mission['Mission']['description'] = $mission['Mission']['description_es'];
      }
    }

    $client = new Google_Client();
    $client->setApplicationName('Evoke');
    $client->setClientId(Configure::read('google_client_id'));
    $client->setClientSecret(Configure::read('google_client_secret'));
    $client->setRedirectUri(Configure::read('google_redirect_uri'));
    $client->setDeveloperKey(Configure::read('google_developer_key'));

    $google_oauthV2 = new Google_Service_Oauth2($client);

    $client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
    $client->addScope(Google_Service_Oauth2::USERINFO_PROFILE);

    if (isset($this->params['url']['code'])) {
      $client->authenticate($this->params['url']['code']);
      $_SESSION['access_token'] = $client->getAccessToken();

    if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
      $user_profile = $google_oauthV2->userinfo->get();
      $_SESSION['user']['name'] = $user_profile['name'];
      $_SESSION['user']['google_id'] = $user_profile['id'];
      $_SESSION['user']['email'] = $user_profile['email'];

      $user_google = $this->User->find('first', array('conditions' => array('User.id' => $_SESSION['user']['email'])));

      if(empty($user_google)) {

        // User does not exist in DB, so we are going to create
        $this->User->create();
        $user_google['User']['google_id'] = $user_profile['id'];
        $user_google['User']['google_token'] = $client->getAccessToken();
        $user_google['User']['name'] = $user_profile['name'];
        $user_google['User']['email'] = $user_profile['email'];
        $user_google['User']['role_id'] = 3;

        if($this->User->save($user_google)) {
          $user_google['User']['id'] = $this->User->id;
          $this->Auth->login($user_google);
          $date = date('Y:m:d', $_SERVER['REQUEST_TIME']);

          return $this->redirect(array('action' => 'edit', $this->User->id));
        } else {
          $this->Session->setFlash(__('There was some interference in your connection.'), 'error');
          return $this->redirect(array('action' => 'login'));
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

        return $this->redirect(array('controller' => 'users', 'action' => 'profile', $this->User->id));

      }
    }
    }else {
      $authUrl = $client->createAuthUrl();

      if(isset($authUrl)) { //user is not logged in, show login button
        $this->set('authUrl', $authUrl);
      }
    }

    //debug($this->Auth);
    $facebook = new Facebook(array(
      'appId' => Configure::read('fb_app_id'),
      'secret' => Configure::read('fb_app_secret'),
      'allowSignedRequest' => false,

    ));

    if(isset($this->params['url']['code'])) {

      $token = $facebook->getAccessToken();

      if (!empty($token)) {

        $userFbData = $facebook->getUser();
        $user_profile = '';

        try {
          $user_profile = $facebook->api('/me');
          $this->Session->write('User', $user_profile);
        } catch (FacebookApiException $e) {
          error_log($e);
          $userFbData = null;
        }

        $user = $this->User->find('first', array('conditions' => array('facebook_id' => $user_profile['id'])));

        if(empty($user)) {

          // User does not exist in DB, so we are going to create

          $this->User->create();
          $user['User']['facebook_id'] = $user_profile['id'];
          $user['User']['facebook_token'] = $token;
          $user['User']['name'] = $user_profile['name'];
          $user['User']['sex'] = $user_profile['gender'];
          $user['User']['login'] = $user_profile['username'];
          $user['User']['facebook'] = $user_profile['link'];
          $user['User']['role_id'] = 3;

          if($this->User->save($user)) {
            $user['User']['id'] = $this->User->id;
            $this->Auth->login($user);
            $this->Session->setFlash('', 'opening_lightbox_message');

            $date = date('Y:m:d', $_SERVER['REQUEST_TIME']);

            return $this->redirect(array('action' => 'edit', $this->User->id));
          } else {
            $this->Session->setFlash(__('There was some interference in your connection.'), 'error');
            return $this->redirect(array('action' => 'login'));
          }

        } else {

          // User exists, so we just force login
          // TODO: check if any data changed since last Facebook login, then update in our table

          // We need to update the Facebook token, once web tokens are short-term only
          $this->User->id = $user['User']['id'];
          $this->User->set('facebook_token', $token);
          $this->User->save();

          $user['User']['id'] = $this->User->id;
          $this->Auth->login($user);

          $date = date('Y:m:d', $_SERVER['REQUEST_TIME']);

          return $this->redirect(array('controller' => 'users', 'action' => 'profile', $this->User->id));

        }

      }

    } else if ($this->Auth->login()) {

      $date = date('Y:m:d', $_SERVER['REQUEST_TIME']);

      return $this->redirect(array('controller' => 'users', 'action' => 'profile', $this->Auth->user('id')));

    } else if(isset($this->request->data['User']['username'])){

      $user2 = $this->User->find('first', array('conditions' => array('User.username' => $this->request->data['User']['username'])));

      if(empty($user2)){
        $this->Session->setFlash(__('Your login and/or password was incorrect. Please try again.'));
        return $this->redirect(array('action' => 'login'));
      }

    } else {
      $fbLoginUrl = $facebook->getLoginUrl();
      $this->set(compact('fbLoginUrl'));
      $this->Session->write('fbLoginUrl', $fbLoginUrl); //Stores facebook URL in session to be accessed by other views/controllers
    }

    $this->set(compact('missions','video_url'));
  }

/**
 * logout method
 *
 * @return void
 */
  public function logout() {
    $this->Session->destroy();
    $this->redirect($this->Auth->logout());
  }

/**
 * index method
 *
 * @return void
 */
  public function index() {
    $this->User->recursive = 0;
  }

/**
 * Return the HTML code for a set of evidences
 *
 * @param int $lastOne Id of the last evidence (it will start by the next ID)
 * @param int $limit Limit of evidences to get in the find query
 * @param int $user_id Default -1. If different, the evidences returned will have been created by this user
 * @return string HTML code
 */
  public function moreEvidences($lastOne, $limit = 1, $user_id = -1){
    $this->autoRender = false; // We don't render a view in this example
    $this->request->onlyAllow('ajax'); // No direct access via browser URL

    $last = $this->User->Evidence->find('first', array(
      'conditions' => array(
        'Evidence.id' => $lastOne
      )
    ));

    $lang = $this->getCurrentLanguage();

    if(empty($last))
        return json_encode(array());

    if($user_id==-1) {
      $obj = $this->User->Evidence->find('all', array(
        'order' => array(
          'Evidence.created DESC'
        ),
        'conditions' => array(
          'Evidence.title != ' => '',
          'Evidence.modified <' => $last['Evidence']['modified']
        ),
        'limit' => $limit
      ));
    } else {
      $obj = $this->User->Evidence->find('all', array(
        'order' => array(
          'Evidence.created DESC'
        ),
        'conditions' => array(
          'Evidence.title != ' => '',
          'Evidence.modified <' => $last['Evidence']['modified'],
          'Evidence.user_id' => $user_id
        ),
        'limit' => $limit
      ));
    }

    $el = 'evidence';
    $ind = 'Evidence';

    $data = "";

    $str = "lastBegin-1lastEnd";
    $older = "";
    foreach ($obj as $key => $value) {
      $view = new View($this, false);
      $content = ($view->element($el, array('e' => $value, 'lang' => $lang)));

      $data .= $content .' ';

      $older = $value[$ind]['id'];
    }
    if($older != "") {
      $str = "lastBegin".$older."lastEnd";
    }
    return $str.$data;
  }


  public function moreEvokations($lastOne, $limit = 1, $user_id = -1){
    $this->autoRender = false; // We don't render a view in this example
    $this->request->onlyAllow('ajax'); // No direct access via browser URL

    $this->loadModel('Evokation');
    $last = $this->Evokation->find('first', array(
      'conditions' => array(
        'Evokation.id' => $lastOne
      )
    ));

    if(empty($last))
        return json_encode(array());

    $obj = $this->Evokation->find('all', array(
      'order' => array(
        'Evokation.modified DESC'
      ),
      'conditions' => array(
        'Evokation.sent ' => 1,
        'Evokation.modified <' => $last['Evokation']['modified']
      ),
      'limit' => $limit
    ));

    $evokationsFollowing = $this->User->EvokationFollower->find('all', array(
      'conditions' => array(
        'EvokationFollower.user_id' => $this->getUserId()
      )
    ));

    if($user_id == -1) {
      $myEvokations = array();
      foreach ($obj as $evokation) {
        $mine = false;
        if($evokation['Group']['user_id'] == $id)
          $mine = true;

        $this->loadModel('Group');
        $group_evokation = $this->Group->GroupsUser->find('first', array(
          'conditions' => array(
            'GroupsUser.group_id' => $evokation['Group']['id'],
            'GroupsUser.user_id' => $id
          )
        ));

        if(!empty($group_evokation))
          $mine = true;

        if($mine){
          array_push($myEvokations, $evokation);
        }
      }

      $common = $myEvokations;
    } else {
      $viewerEvokation = array();
      $myEvokations = array();
      foreach ($evokations as $evokation) {
        $his = false;
        $mine = false;
        if($evokation['Group']['user_id'] == $id)
          $his = true;

        if($evokation['Group']['user_id'] == $this->getUserId())
          $mine = true;

        $op = array('GroupsUser.user_id' => $id, 'GroupsUser.user_id' => $this->getUserId());

        $this->loadModel('Group');
        $group_evokation = $this->Group->GroupsUser->find('first', array(
          'conditions' => array(
            'GroupsUser.group_id' => $evokation['Group']['id'],
            'OR' => $op
          )
        ));

        if(!empty($group_evokation) && $group_evokation['GroupsUser']['user_id'] == $id)
          $his = true;

        if(!empty($group_evokation) && $group_evokation['GroupsUser']['user_id'] == $this->getUserId())
          $mine = true;

        if($his){
          array_push($myEvokations, $evokation);
        }

        if($mine){
          array_push($viewerEvokation, $evokation);
        }
      }
      $obj = $myEvokations;
      $common = $viewerEvokation;

    }



    $el = 'evokation';
    $ind = 'Evokation';


    $data = "";

    $str = "lastBegin-1lastEnd";
    $older = "";
    foreach ($obj as $key => $value) {
      $showFollowButton = true;
      foreach($common as $my) :
        if(array_search($my['Evokation']['id'], $value['Evokation'])) {
          $showFollowButton = false;
          break;
        }
      endforeach;

      $view = new View($this, false);

      if($showFollowButton)
        $content = ($view->element($el, array('e' => $value, 'evokationsFollowing' => $evokationsFollowing, 'my_id' => $this->getUserId())));
      else
        $content = ($view->element($el, array('e' => $value, 'mine' => true, 'my_id' => $this->getUserId())));

      $data .= $content .' ';

      $older = $value[$ind]['id'];
    }
    if($older != "") {
      $str = "lastBegin".$older."lastEnd";
    }
    return $str.$data;
  }



/**
 *
 * register method
 *
 * @return void
 */
  public function register() {
    if ($this->request->is('post')) {
      if($this->request->data['User']['password'] == $this->request->data['User']['confirm_password']) {

        $this->User->createWithAttachments($this->request->data);

        if ($this->User->save($this->request->data)) {
          $this->Session->setFlash(__('O usuário foi salvo com sucesso.'));

          $user = $this->User->find('first', array('conditions' => array('User.id' => $this->User->id)));
          $this->Auth->login($user['User']);

          // REDIRECT TO THE MATCHING PAGE
          return $this->redirect(array('action' => 'matching', $this->User->id));
        }
        else {
          $this->Session->setFlash(__('O usuário não pôde ser salvo. Por favor, tente novamente.'));
        }
      }
      else {
        $this->Session->setFlash(__("Typed passwords don't match"));
      }
    }
  }


/**
 * allies method
 *
 * @return void
 */
  // public function allies($id) {
  // 	if (!$this->User->exists($id)) {
  // 		throw new NotFoundException(__('Invalid user'));
  // 	}

  // 	$user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

  // 	$users = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

  // 	$allies = array();

  // 	$friends = $this->User->UserFriend->find('all', array('conditions' => array('UserFriend.user_id' => $id))); //this->getUserId()

  // 	$are_friends = array();
  // 	//$allies = array();

  // 	foreach($friends as $friend){
  // 		array_push($are_friends, array('User.id' => $friend['UserFriend']['friend_id']));
  // 	}

  // 	if(!empty($are_friends)){
  // 		$allies = $this->User->find('all', array(
  // 			'conditions' => array(
  // 				'OR' => $are_friends
  // 		)));
  // 	} else{
  // 		$allies = array();
  // 		//$notifies = array();
  // 	}

  // 	$this->set(compact('user', 'users', 'friends', 'allies'));
  // }

/**
 *
 * profile method
 *
 * @return void
 */
  public function profile($id = null) {

    if (!$this->User->exists($id)) {
      throw new NotFoundException(__('Invalid user'));
    }

    $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

    $users = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

    /**
    *
    *get superhero id, get the social innovators ids, find them in the DB and send them to the view to put in place of the psychometric analisys
    *
    */
    $this->loadModel('SuperheroIdentity');

    $superhero = $this->SuperheroIdentity->find('first', array(
      'conditions' => array(
        'id' => $user['User']['superhero_identity_id']
      )
    ));

    // // check if the user has answered the asessment questionnaire
    // if(empty($superhero)){
    // 	// redirect to the questionnaire
    // 	return $this->redirect(array('action' => 'matching', $id));
    // }

    //LEVEL AND POINTS
    $this->loadModel('Level');

    $points = $this->User->Point->find('all', array('conditions' => array('Point.user_id' => $id)));

    $sumPoints = $this->getPoints($id);

    $level = $this->getLevel($sumPoints);

    $otherLevel = $this->Level->find('first', array('conditions' => array('Level.level' => $level+1)));

    if(!empty($otherLevel))
      $percentage = round(($sumPoints / $otherLevel['Level']['points']) * 100);
    else
      $percentage = 0;

    // MISSIONS
    if ($is_current_user) {
      $this->loadModel('Mission');
      $this->loadModel('UserMission');
      $this->loadModel('Phase');
      $this->loadModel('Quest');

      $available_missions = array();
      $current_phases = array();
      $quests = array();

      if (!$user['User']['basic_training']) {
        $available_missions[]= $this->Mission->find('first', array('conditions' => array('Mission.basic_training' => 1)));
      } else {
        $available_missions = $this->get_available_missions($id);
      }

      foreach($available_missions as $available_mission) {
        $current_phases[]= $this->Phase->getCurrentPhase($user_id, $available_mission['Mission']['id'])['Phase'];
      }

      foreach($current_phases as $current_phase) {
        $quests[]= $this->Quest->find('all',array(
          'conditions' => array('phase_id' => $current_phase['id']),
          'limit' => 5
        ));
      }
    }

    //LEADERBOARD
    $max_leaderboard_users = 6; //Total of leaders on the leaderboard (including the top ones)

    $leaderboard_users = $this->User->find('all', array(
      'joins' => array(
        array(
          'table' => 'points',
          'alias' => 'Points',
          'type' => 'left',  //join of your choice left, right, or inner
          'conditions' => array(
            'Points.user_id = User.id'
          )
        ),
      ),
      'fields' => array(
        'User.*',
        'sum(Points.value) as total_points'
      ),
      'group' => 'Points.user_id',
      'order' => array('total_points DESC'),
      'limit' => 60
    ));

    //FRIENDS
    $is_friend = $this->User->UserFriend->find('first', array(
      'conditions' => array(
        'UserFriend.user_id' => $this->getUserId(),
        'UserFriend.friend_id' => $id
      )
    ));

    $allies = array();

    $friends = $this->User->UserFriend->find('all', array(
      'conditions' => array('UserFriend.user_id' => $id),
      'contain' => 'Friend'
    ));

    //EVIDENCES
    $myevidences = $this->User->Evidence->find('all', array(
      'order' => array(
        'Evidence.modified DESC'
      ),
      'conditions' => array(
        'Evidence.user_id' => $id,
        'Evidence.title != ' => ''
      ),
      'limit' => 8 // CHANGE 8
    ));

    //GROUPS AND EVOKATION
    $this->loadModel('Group');
    $this->loadModel('GroupsUser');
    $users_groups = $this->GroupsUser->find('all', array('conditions' => array('GroupsUser.user_id' => $id)));

    $mygroups_id = array();

    foreach($users_groups as $g):
      array_push($mygroups_id, array('Evokation.group_id' => $g['GroupsUser']['group_id']));
    endforeach;

    $myevokations = array();

    if(!empty($mygroups_id)) {
      //retrieve all organizations I am part of as a list to be displayed in a combobox
      $myevokations = $this->Group->Evokation->find('all', array(
        'order' => array(
          'Evokation.created DESC'
        ),
        'conditions' => array(
          'Evokation.sent' => 1,
          'OR' => $mygroups_id
        )
      ));
    }

    $this->loadModel('Evokation');
    $evokations = $this->Evokation->find('all', array(
      'recursive' => 0,
      'order' => array(
        'Evokation.created DESC'
      ),
      'conditions' => array(
        'Evokation.sent' => 1
      ),
      'limit' => 8 // CHANGE 8
    ));


    $evokationsFollowing = $this->User->EvokationFollower->find('all', array(
      'recursive' => 0,
      'conditions' => array(
        'EvokationFollower.user_id' => $this->getUserId()
      )
    ));

    $viewerEvokation = array();
    $myEvokations = array();
    foreach ($evokations as $evokation) {
      $his = false;
      $mine = false;
      if($evokation['Group']['user_id'] == $id)
        $his = true;

      if($evokation['Group']['user_id'] == $this->getUserId())
        $mine = true;

      $op = array('GroupsUser.user_id' => $id, 'GroupsUser.user_id' => $this->getUserId());

      $this->loadModel('Group');
      $group_evokation = $this->Group->GroupsUser->find('first', array(
        'conditions' => array(
          'GroupsUser.group_id' => $evokation['Group']['id'],
          'OR' => $op
        )
      ));

      if(!empty($group_evokation) && $group_evokation['GroupsUser']['user_id'] == $id)
        $his = true;

      if(!empty($group_evokation) && $group_evokation['GroupsUser']['user_id'] == $this->getUserId())
        $mine = true;

      if($his){
        array_push($myEvokations, $evokation);
      }

      if($mine){
        array_push($viewerEvokation, $evokation);
      }
    }

    //BADGES
    $this->loadModel('Badge');

    $badges = $this->User->UserBadge->find('all', array(
      'recursive' => 0,
      'conditions' => array(
        'UserBadge.user_id' => $id
      )
    ));

    foreach ($badges as $b => $badge) {

      $this->loadModel('Attachment');
      $badge_img = $this->Attachment->find('first', array(
        'conditions' => array(
          'Attachment.model' => 'Badge',
          'Attachment.foreign_key' => $badge['Badge']['id']
        )
      ));
      if(!empty($badge_img)) {
        $badges[$b]['Badge']['img_dir'] = $badge_img['Attachment']['dir'];
        $badges[$b]['Badge']['img_attachment'] = $badge_img['Attachment']['attachment'];
      } else {

      }

    }

    //SIMILAR USERS
    //List of similar users (for now, any 4 users; later, matching results)
    $similar_users = $this->User->find('all', array(
      'conditions' => 'User.id != '.$this->getUserId(),
      'limit' => 6,
      'order' => 'rand()'
    ));

    /**
    *
    *get superhero id, get the social innovators ids, find them in the DB and send them to the view to put in place of the psychometric analisys
    *
    */
    $this->loadModel('SuperheroIdentity');

    $superhero = $this->SuperheroIdentity->find('first', array(
      'conditions' => array(
        'id' => $user['User']['superhero_identity_id']
      )
    ));

    $this->loadModel('SocialInnovatorQuality');
    $first_quality = $this->SocialInnovatorQuality->find('first', array(
      'conditions' => array(
        'id' => $superhero['SuperheroIdentity']['quality_1']
      )
    ));

    $second_quality = $this->SocialInnovatorQuality->find('first', array(
      'conditions' => array(
        'id' => $superhero['SuperheroIdentity']['quality_2']
      )
    ));



    $this->set(compact(
      'superhero',
      'first_quality',
      'second_quality',
      'myevokations',
      'user', 'users',
      'is_friend',
      'friends',
      'followers',
      'evidence',
      'myevidences',
      'evokations',
      'evokationsFollowing',
      'myEvokations',
      'missions',
      'missionIssues',
      'issues',
      'imgs',
      'sumPoints',
      'sumMyPoints',
      'level',
      'myLevel',
      'similar_users',
      'current_mission',
      'current_phases',
      'quests',
      'available_missions',
      'completed_missions',
      'allies',
      'allusers',
      'viewerEvokation',
      'points_users',
      'leaderboard_users',
      'percentage',
      'percentageOtherUser',
      'basic_training',
      'notifies',
      'badges',
      'show_basic_training',
      'similar_users'
    ));

    if ($is_current_user) {
      $this->render('dashboard');
    }
  }

/**
 *
 * matching questions
 *
 * @return void
 */
  public function matching($id = null) {

    //debug($this->request->data);
    //die();
    //List issues (all, and already saved)
    $issues = $this->User->UserIssue->Issue->find('list');
    $selectedIssues = $this->User->UserIssue->find('list', array('fields' => array('UserIssue.issue_id'), 'conditions' => array('UserIssue.user_id' => $id)));

    //List all matching questions
    $this->loadModel('MatchingQuestion');
    $matching_questions = $this->MatchingQuestion->find('all');

    //For each question, list possible answers
    foreach ($matching_questions as &$question) {
      $question['MatchingAnswer'] = $this->MatchingQuestion->MatchingAnswer->find('list',array(
        'conditions' => array('matching_question_id' => $question['MatchingQuestion']['id'])
      ));
    }

    $user_id = $id;

    //SUBMITTING FORM
    if ($this->request->is('post', 'put')) {
      //SAVE USER_MATCHING_ANSWER
      if (isset($this->request->data['UserMatchingAnswer']['matching_answer'])) {
        $this->loadModel('MatchingAnswer');
        $matching_answers = $this->MatchingAnswer->find('all');
        $qualities = array(); // each position represents on of the social innovator qualities [0] is nothing
        $user_answers = array();
        $user_id = $this->request->data['UserMatchingAnswer']['user_id'];
        foreach($this->request->data['UserMatchingAnswer']['matching_answer'] as $question_id => $u) {
          //ESSAY
          if (isset($u['description'])) {
            $this->User->UserMatchingAnswer->saveChoiceAnswer($user_id, $question_id, $u['description']);
          }
          //SINGLE-CHOICE
          elseif (!is_array($u['matching_answer_id'])) {
            $this->User->UserMatchingAnswer->saveChoiceAnswer($user_id, $question_id, $u['matching_answer_id']);
            $user_answers[] = $u['matching_answer_id'];
          }
          //MULTIPLE-CHOICE
          else {
            foreach($u['matching_answer_id'] as $k => $m_id) {
              $this->User->UserMatchingAnswer->saveChoiceAnswer($user_id, $question_id, $m_id);
            }
          }
        }
        foreach ($user_answers as $ua) {
          foreach($matching_answers as $ma){
            if($ua == $ma['MatchingAnswer']['id']){
              $q_id = $ma['MatchingAnswer']['social_innovator_quality_id'];
              //if it is not setted, put 1, else ++
              $qualities[$q_id] = !isset($qualities[$q_id]) ? 1 : $qualities[$q_id] + 1;
              break;
            }
          }
        }

        $user_answers = array();
        if(isset($this->request->data['orderAnswer'])){
          $user_id = $this->request->data['UserMatchingAnswer']['user_id'];
          foreach ( $this->request->data['orderAnswer'] as $question_id => $answer) {
            foreach ($answer as $answer_id => $order) {
              $this->User->UserMatchingAnswer->saveOrderAnswer($user_id, $question_id, $answer_id, $order);
              $user_answers[$answer_id] = $order;
            }
          }
          //this array represents the weights for each answer in the order quastions
          $weights = array( 1 => 3, 2 => 2, 3 => 1, 4 => 0);
          foreach ($user_answers as $ua_id => $ua) {

            foreach($matching_answers as $ma){
              if($ua_id == $ma['MatchingAnswer']['id']){
                $q_id = $ma['MatchingAnswer']['social_innovator_quality_id'];
                // the right weight has to be added to the quality, according to the order
                $qualities[$q_id] = !isset($qualities[$q_id]) ? $weights[$ua] : $qualities[$q_id] + $weights[$ua];
                break;
              }
            }
          }
        }
        // sort in decreasing order
        arsort($qualities);
      }

      return $this->redirect(array('controller' => 'users', 'action' => 'matching_results', $id, array_keys($qualities)[0], array_keys($qualities)[1]));
    }

    $this->set(compact('matching_questions', 'user_id', 'issues', 'selectedIssues'));
  }

/**
 *
 * matching results
 *
 * @return void
 */
  public function matching_results($id = null, $quality_1, $quality_2) {
    // find superhero and prepare the text for the qualities
    $this->loadModel('SuperheroIdentity');
    $superhero = $this->SuperheroIdentity->find('first', array(
      'conditions' => array(
        'quality_1' => $quality_1,
        'quality_2' => $quality_2
      ),
    ));

    $user = $this->User->find('first', array(
      'conditions' => array(
        'id' => $id
      ),
    ));

    //save user's superhero identity id
    $user['User']['superhero_identity_id'] = $superhero['SuperheroIdentity']['id'];
    unset($user['User']['password']);
    //update session user
    $this->Session->write('Auth.User.superhero_identity_id',$superhero['SuperheroIdentity']['id']);
    $this->User->save($user);

    $this->loadModel('SocialInnovatorQuality');

    $first_quality = $this->SocialInnovatorQuality->find('first', array(
      'conditions' => array(
        'id' => $quality_1
      ),
    ));

    $second_quality = $this->SocialInnovatorQuality->find('first', array(
      'conditions' => array(
        'id' => $quality_2
      ),
    ));

    //List of similar users (same superhero identity for now)
    $similar_users = $this->User->find('all', array(
      'conditions' => array(
        'User.id != '.$this->getUserId(),
        'User.superhero_identity_id' => $superhero['SuperheroIdentity']['id']
      ),
      'limit' => 4,
      'order' => 'rand()'
    ));

    //FRIENDS
    $friends_ids = $this->User->UserFriend->find('list', array(
      'fields' => 'UserFriend.friend_id',
      'conditions' => array(
        'UserFriend.user_id' => $this->getUserId()
      )
    ));

    $this->set(compact('similar_users', 'friends_ids', 'superhero', 'first_quality', 'second_quality'));
  }

/**
 *
 * View all users
 *
 * @return void
 */
  public function view_all() {
    //All users but current user
    $all_users = $this->User->find('all', array(
      'conditions' => 'User.id != '.$this->getUserId()
    ));

    //Friends
    $friends_ids = $this->User->UserFriend->find('list', array(
      'fields' => 'UserFriend.friend_id',
      'conditions' => array(
        'UserFriend.user_id' => $this->getUserId()
      )
    ));

    $this->set(compact('all_users','friends_ids'));
  }

/**
 *
 * enter site
 *
 * @return void
 */
  public function enter_site($id = null) {
    $this->set('user_id', $this->getUserId());
  }

/**
 *
 * leaderboard
 *
 * @return void
 */
  public function leaderboard() {

    $user = $this->Auth->user();
    $userid = $this->getUserId();

    //POSITION OF THIS USER
    $user_position = $this->User->getLeaderboardPosition($userid);

    //USERS ORDERED BY NUMBER OF POINTS
    $this->User->virtualFields['total_points'] = 'SUM(Points.value)';
    $this->paginate = $this->User->getLeaderboardQuery();
    $points_users = $this->paginate('User');

    $this->set(compact('userid', 'user', 'user_position', 'points_users'));
  }

/**
 * add_friend method
 *
 * We are using here the HABTM relationship (Has And Belongs To Many, N <-> N approach), in which
 * we created a relationship from model User to itselft, using friends table as join table,
 * which holds two user's id and the DATETIME created to keep track of a friendship start.
 *
 * @param int $user_to User id of the friend that will be added
 * @param bool $redirect Boolean indicating if the function should redirect after adding the friend. Default true.
 * @return string Text saying if the user has been added or not. Returned when the user is not redirected.
 */
  public function add_friend($user_to = null, $redirect = null) {
    $this->request->data['User']['id'] = $this->getUserId();
    $this->request->data['Friend']['id'] = $user_to;

    if($result = $this->User->saveAll($this->request->data)) {
      if (is_null($redirect)) {
        $this->redirect(array('action' => 'view', $user_to));
      }
    }
    elseif (is_null($redirect)) {
      $this->redirect(array('action' => 'view', $user_to));
    }
  }

/**
 * remove_friend method
 *
 * @return void
 */
  public function remove_friend($user_to = null) {

    $user_from = $this->getUserId();

    if($this->User->FriendsUser->deleteAll(array('FriendsUser.user_from' => $user_from, 'FriendsUser.user_to' => $user_to))) {
      $this->redirect(array('action' => 'view', $user_to));
    } else {
      $this->redirect(array('action' => 'view', $user_to));
    }

  }

/**
 * add method
 *
 * @return void
 */
  public function add() {
    $this->autoRender = false;

    if ($this->request->is('post')) {
      $this->User->create();
      if ($this->User->save($this->request->data)) {
        $this->Session->setFlash(__('The user has been saved.'));
        return $this->redirect($this->referer());
      } else {
        $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
      }
    }
  }

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
  public function panel_edit($id = null) {
    if (!$this->User->exists($id)) {
      throw new NotFoundException(__('Invalid user'));
    }

    $this->User->id = $id;
    if ($this->request->is(array('post', 'put'))) {
      if ($this->User->save($this->request->data)) {
        $this->Session->setFlash(__('The user has been saved.'));
        return $this->redirect($this->referer());
      } else {
        $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
      }
    } else {
      $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
      $this->request->data = $this->User->find('first', $options);
      unset($this->request->data['User']['password']);
    }
  }

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
  public function panel_delete($id = null) {
    $this->User->id = $id;
    if (!$this->User->exists()) {
      throw new NotFoundException(__('Invalid user'));
    }
    //$this->request->onlyAllow('post', 'delete');
    if ($this->User->delete()) {
      $this->Session->setFlash(__('The user has been deleted.'));
    } else {
      $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
    }
    return $this->redirect($this->referer());
  }

/**
* admin_edit method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
  public function edit($id = null) {
    if (!$this->User->exists($id)) {
      throw new NotFoundException(__('Invalid user'));
    }
    if ($this->request->is(array('post', 'put'))) {
      $this->User->id = $id;
      $this->User->createWithAttachments($this->request->data,true,$id);

      if ($this->User->save($this->request->data)) {
        //Refresh auth data
        $user_data = $this->User->findById($this->Auth->User('id'));
        $this->Auth->login($user_data['User']);

        $this->Session->setFlash(__('The user has been saved.'));
        return $this->redirect(array('action' => 'profile', $id));
      } else {
        $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
      }
    } else {
      $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
      $user = $this->User->find('first', $options);
      $this->set('user', $user['User']);
      $this->request->data = $user;
    }
  }


/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
  public function delete($id = null) {
    if(is_null($id)){
      $id = $this->getUserId();
    }

    //check to see if user is an admin
    //if so, he can delete whoever he likes
    //otherwise, you are not allowed to edit agents but
    // yourself and will be redirected home
    if($this->getUserRole() != 1) {
      if($id != $this->getUserId()) {
        $this->Session->setFlash(__("You can't delete other users. Permission denied."));
        $this->redirect($this->referer());
      }
    }

    $this->User->id = $id;
    if (!$this->User->exists()) {
      throw new NotFoundException(__('Invalid user'));
    }
    $this->request->onlyAllow('post', 'delete');
    if ($this->User->delete()) {
      $this->Session->setFlash(__('The user has been deleted.'));
    } else {
      $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
    }
    // return $this->redirect(array('action' => 'index'));
    return $this->redirect($this->referer());
  }


/**
 * admin_add method
 *
 * @return void
 */
  public function admin_add() {
    $this->autoRender = false;

    if ($this->request->is('post')) {
      $this->User->create();
      if ($this->User->save($this->request->data)) {
        $this->Session->setFlash(__('The user has been saved.'));
        return $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
      }
    }
  }

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
  public function admin_edit($id = null) {
    $this->autoRender = false;

    if (!$this->User->exists($id)) {
      throw new NotFoundException(__('Invalid user'));
    }
    if ($this->request->is(array('post', 'put'))) {
      if ($this->User->save($this->request->data)) {
        $this->Session->setFlash(__('The user has been saved.'));
        return $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
      }
    } else {
      $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
      $this->request->data = $this->User->find('first', $options);
    }
  }

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
  public function admin_delete($id = null) {
    $this->autoRender = false;

    $this->User->id = $id;
    if (!$this->User->exists()) {
      throw new NotFoundException(__('Invalid user'));
    }
    $this->request->onlyAllow('post', 'delete');
    if ($this->User->delete()) {
      $this->Session->setFlash(__('The user has been deleted.'));
    } else {
      $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
    }
  }

  /**
   * Gets User from ID
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  private function get_user($id = null) {
    return $this->User->find('first', array('conditions' => array('User.id' => $id)));
  }

  private function get_available_missions($user_id) {
    return $this->Mission->find('all', array(
      'joins' => array(
        array(
          'table' => 'user_missions',
          'alias' => 'UserMission',
          'type' => 'LEFT',
          'foreign_key' => false,
          'conditions' => array(
            'UserMission.user_id' => $user_id,
            'UserMission.completed' => 0
          )
        )
      ),
      'conditions' => array(
        'Mission.basic_training' => 0
      )
    ));
  }
}
