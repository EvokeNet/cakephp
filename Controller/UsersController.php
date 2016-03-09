<?php

// require APP.'Vendor'.DS.'facebook'.DS.'php-sdk'.DS.'src'.DS.'facebook.php';

// require_once APP.'Vendor'.DS.'google-login'.DS.'src'.DS.'Google_Client.php';
// require_once APP.'Vendor'.DS.'google-login'.DS.'src'.DS.'contrib'.DS.'Google_Oauth2Service.php';

// require_once APP.'Vendor'.DS.'google'.DS. 'apiclient'.DS.'src'.DS.'Google'.DS.'Client.php';
// require_once APP.'Vendor'.DS.'google'.DS. 'apiclient'.DS.'src'.DS.'Google'.DS.'Service'.DS.'Oauth2.php';

App::uses('AppController', 'Controller');
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\GraphUser;

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

  public $uses = array('User', 'Friend');

  public $user = null;

  public $helpers = array('Menu', 'Phase');

  public $paginate;

  public $components = array('Paginator');

/**
*
* beforeFilter method
*
* @return void
*/
  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('add', 'login', 'logout', 'register', 'forgot', 'changelanguage','recover_password','fbLogin','googleLogin');
  }

  public function changeLanguage($lang){
    parent::changeLanguage($lang);
  }

  public function change_password() {
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
          $insert['User']['password'] = $this->request->data['User']['tmp'];
          $this->User->save($insert);
          $this->Session->setFlash(__(""), 'flash_message');
          return $this->flash(__('Your password was changed.'), array('action' => 'profile','admin' => false, AuthComponent::user('id')));   
        } else {
          return $this->flash(__('The new passwords do not match.'), array('action' => 'change_password'));  
        }
      } else {
        return $this->flash(__('The current password does not match.'), array('action' => 'change_password'));  
      }
    }

    $this->set(compact('usr'));
    // die();
  }

/**
 * login with facebook method
 *
 * @return void
 */
public function fbLogin() {
    $this->autoRender = false;
    $session = null;

    try {
        if ($this->request->query('code')) {
            $session = $this->facebook->getSessionFromRedirect();    
        }
    } catch (FacebookRequestException $e) {

    }

    if ($session) {

    $facebook_logout_url = $this->facebook->getLogoutUrl(
      $session,
      Router::url(array('controller' => 'users', 'action' => 'login'), true)
    );

    $this->Session->write('facebook_logout_url', $facebook_logout_url);
        $request = new FacebookRequest($session, 'GET', '/me');
        $profile = null;
        try {
            $response = $request->execute();
            $profile = $response->getGraphObject(GraphUser::className());
        } catch (FacebookRequestException $e) {
        }

        $user_fb = $this->User->find('first', array(
            'conditions' => array(
                'OR' => array(
                    'facebook_id' => $profile->getId(),
                    'email' => $profile->getEmail()
                )
            )
        ));

        if (!empty($user_fb)) {
          $this->User->id = $user_fb['User']['id'];

          if (empty($user_fb['User']['facebook_id'])) {
             $this->User->saveField('facebook_id',$profile->getId());
          }
            // if (empty($user_fb['User']['photo'])) {
            //     $user_fb['User']['photo'] = "http://graph.facebook.com/{$profile->getId()}/picture?type=large";
            //    $save_bool = true;
            // }

          if (empty($user_fb['User']['biography'])) {
            $this->User->saveField('biography',$profile->getProperty('bio'));
          }

          if ($this->Auth->login($user_fb['User'])) {                
                       
            return $this->redirect(array('controller' => 'users', 'action' => 'profile', $this->Auth->user('id')));

          } else {
              $this->flash(__("An error occurred. Please try again."), array("action" => "login"));
          }

        } else {

          //GET COUNTRY NAME
          $hometown = $profile->getProperty('hometown');
          $hometownName = $hometown->getProperty('name');
          $locales = explode(', ',$hometownName);
          $country = $this->getCountry($locales[1]);

          $sex = $profile->getProperty('gender');
          $sex_id = $this->getSex($sex);

          $user_fb = array(
              'User' => array(
                'facebook_id' => $profile->getId(),
                'name'        => $profile->getName(),
                'firstname'   => $profile->getProperty('first_name'),
                'lastname'    => $profile->getProperty('last_name'),
                'username'    => $profile->getProperty('first_name').$profile->getId(),
                'email'       => $profile->getProperty('email'),
                'password'    => AuthComponent::password(uniqid(md5(mt_rand()))),
                'birthdate'    => date("Y-m-d H:i:s", strtotime($profile->getProperty('birthday'))),
                'language'    => $profile->getProperty('locale'),
                'country'     => $country,
                'sex'         => $sex_id,
                //'photo'       => "http://graph.facebook.com/{$profile->getId()}/picture?type=large",
                'biography'   => "",
                'role'        => $this->Permission->scores_id()['USER']
              )
            );
          
          $this->Session->write('User', $user_fb);
          $this->User->save($user_fb['User']);
          
          $user = $this->User->find('first', array('conditions' => array('User.id' => $this->User->id)));
          
          $this->Auth->login($user['User']);

          // REDIRECT TO THE MATCHING PAGE
          $this->redirect(array('action' => 'matching', $user['User']['id']));
        }
    }else{
        $this->flash(__("An error occurred. Please try again."), array("action" => "login"));
    }
}

/**
 * login with google method
 *
 * @return void
 */
public function googleLogin() {
  $this->autoRender = false;
  $session = null;

  if ($this->request->query('code')) {
    $this->googleClient->authenticate($_GET['code']);
    $session = $this->googleClient->getAccessToken();
  }

  if($session){
    $profile = $this->googleService->userinfo->get(); 

    $user_google = $this->User->find('first', array(
            'conditions' => array(
                'OR' => array(
                    'google_id' => $profile['id'],
                    'email' => $profile['email']
                )
            )
        ));


    if(!empty($user_google)){
      $this->User->id = $user_google['User']['id'];

      if (empty($user_google['User']['google_id'])) {
        $this->User->saveField('google_id', $profile['id']);
      }

      if (empty($user_fb['User']['biography'])) {
        $this->User->saveField('biography', $profile['bio']);
      }

      if ($this->Auth->login($user_google['User'])) {                                 
        return $this->redirect(array('controller' => 'users', 'action' => 'profile', $this->Auth->user('id')));
      } else {
        $this->flash(__("An error occurred. Please try again."), array("action" => "login"));
      }

    }else{

      $country = substr($profile['locale'], -2);
      $language = str_replace('-', '_', $profile['locale']);

      $user_google = array(
              'User' => array(
                'google_id'   => $profile['id'],
                'name'        => $profile['name'],
                'firstname'   => $profile['givenName'],
                'lastname'    => $profile['familyName'],
                'username'    => $profile['givenName'].$profile['id'],
                'email'       => $profile['email'],
                'password'    => AuthComponent::password(uniqid(md5(mt_rand()))),
                'language'    => $language,
                'country'     => $country,
                //'photo'       => $profile['picture'],
                'biography'   => "",
                'role'        => $this->Permission->scores_id()['USER']
              )
            );

      $this->Session->write('User', $user_google);
      $this->User->save($user_google['User']);
        
      $user = $this->User->find('first', array('conditions' => array('User.id' => $this->User->id)));
          
      $this->Auth->login($user['User']);

      // REDIRECT TO THE MATCHING PAGE
      $this->redirect(array('action' => 'matching', $user['User']['id']));

    }  

  }else{
    $this->flash(__("An error occurred. Please try again."), array("action" => "login"));
  }

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

    if ($this->Auth->login()) {

      $date = date('Y:m:d', $_SERVER['REQUEST_TIME']);

      return $this->redirect(array('controller' => 'users', 'action' => 'profile', $this->Auth->user('id')));

    } else if(isset($this->request->data['User']['username'])){
      $this->flash(__("Your login and/or password was incorrect. Please try again."), array("action" => "login"));
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
  * generates a random password
  * 
  * @return string
  */
  function randomPassword($size) {
    $alphabet = '!#abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $password = array(); 
    $alphabetLength = strlen($alphabet) - 1; 

    for ($i = 0; $i < $size; $i++) {
        $char = rand(0, $alphabetLength);
        $password[] = $alphabet[$char];
    }

    return implode($password); 
  }

/**
 *
 * recover method
 *
 * @return void
 */
  public function recover_password() {

    if ($this->request->is('post')) {
      App::uses('CakeEmail', 'Network/Email');
      $email = new CakeEmail('smtp');

      $new_password = $this->randomPassword(8);
      $user = $this->User->find('first',array(
        'conditions' => array('email' => $this->request->data['User']['email'])    
      ));

      if(empty($user)){
        return $this->flash(__('Email not found.'), array('controller' => 'users', 'action' => 'recover_password', 'admin' => false));       
      }

      $insert['User']['id'] = $user['User']['id'];
      $insert['User']['password'] = $new_password;
      $this->User->save($insert);

      $email->template('default', 'default')
                      ->emailFormat('both')
                      ->to($this->request->data['User']['email'])
                      ->from('no-reply@quanti.ca')
                      ->subject(__('New Password'))
                      ->send('Hello, '.$user['User']['name'].'<br><br><div>Your new password is <div style="color:#26dee0;">'.$new_password.'</div><br>Please change your password on first login.</div><br>Evoke'); 

      return $this->flash(__('It was sent an email with a new password.'), array('controller' => 'users', 'action' => 'login', 'admin' => false));       
    }     
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
          $this->Session->setFlash(__('O usuÃƒÆ’Ã‚Â¡rio foi salvo com sucesso.'));

          $user = $this->User->find('first', array('conditions' => array('User.id' => $this->User->id)));
          $this->Auth->login($user['User']);

          // REDIRECT TO THE MATCHING PAGE
          return $this->redirect(array('action' => 'matching', $this->User->id));
        }
        else {
          $this->Session->setFlash(__('O usuÃƒÆ’Ã‚Â¡rio nÃƒÆ’Ã‚Â£o pÃƒÆ’Ã‚Â´de ser salvo. Por favor, tente novamente.'));
        }
      }
      else {
        $this->Session->setFlash(__("Typed passwords don't match"));
      }
    }
  }


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

    //LEVEL AND POINTS
    $this->loadModel('Level');

    $points = $this->User->Point->find('all', array('conditions' => array('Point.user_id' => $id)));

    $sumPoints = $this->getPoints($id);

    $level = $this->getLevel($sumPoints);

    $otherLevel = 0; //$this->Level->find('first', array('conditions' => array('Level.level' => $level+1)));

    if(!empty($otherLevel))
      $percentage = round(($sumPoints / $otherLevel['Level']['points']) * 100);
    else
      $percentage = 0;


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

    // debug($user);
    // debug($superhero);
    // die();

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



    $this->set(compact('superhero', 'first_quality', 'second_quality', 'myevokations', 'user', 'users', 'is_friend', 'friends', 'followers', 'evidence', 'myevidences', 'evokations', 'evokationsFollowing', 'myEvokations', 'missions',
      'missionIssues', 'issues', 'imgs', 'sumPoints', 'sumMyPoints', 'level', 'myLevel', 'allies', 'allusers', 'viewerEvokation',
      'points_users', 'leaderboard_users', 'percentage', 'percentageOtherUser', 'basic_training', 'notifies',  'badges', 'show_basic_training', 'similar_users'));

  }

/**
 *
 * matching questions
 *
 * @return void
 */

  public function matching($id = null) {

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
        $qualities = $this->build_qualities_array(); // each position represents on of the social innovator qualities [0] is nothing
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
      //debug($qualities);
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

    $this->loadModel('Power');

    $primary_power = $this->Power->find('first', array(
      'conditions' => array(
        'id' => $superhero['SuperheroIdentity']['primary_power']
      ),
    ));

    $secondary_power = $this->Power->find('first', array(
      'conditions' => array(
        'id' => $superhero['SuperheroIdentity']['secondary_power']
      ),
    ));

        $this->loadModel('Power');

    $primary_power = $this->Power->find('first', array(
      'conditions' => array(
        'id' => $superhero['SuperheroIdentity']['primary_power']
      ),
    ));

    $secondary_power = $this->Power->find('first', array(
      'conditions' => array(
        'id' => $superhero['SuperheroIdentity']['secondary_power']
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

    $this->set(compact('similar_users', 'friends_ids', 'superhero', 'first_quality', 'second_quality','primary_power','secondary_power'));
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
    $alias = $this->User->alias;
    $this->Paginator->settings = $this->User->getLeaderboardQuery();
    $points_users = $this->paginate($alias);

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
      $countries = $this->countries;
      $languages = $this->languages;
      $sex = $this->sex;
      $this->set('countries', $countries);
      $this->set('languages', $languages);
      $this->set('sex', $sex);
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
 * admin_index method
 *
 * @return void
 */
  public function admin_index() {
    $this->User->recursive = 0;
    $this->set('users', $this->Paginator->paginate());

    $this->loadModel('Organization');
    $organizations =
      $this->Organization->find('all', array(
      'order' => array(
        'Organization.name ASC'
      ),
    ));

   $this->set('organizations',$organizations);
  }

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
  public function admin_view($id = null) {
    if (!$this->User->exists($id)) {
      throw new NotFoundException(__('Invalid user'));
    }
    $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
    $user = $this->User->find('first', $options);
    $this->set('user', $user);

    $this->loadModel('Organization');
    $organizations = $this->Organization->find('list');

    $this->loadModel('SuperheroIdentity');
    $this->loadModel('Power');
    $superHeroIdentity = $this->SuperheroIdentity->find('first',array('conditions' => array('id' => $user['User']['superhero_identity_id'])));

    if(empty($superHeroIdentity)){
      $superHeroIdentity['SuperheroIdentity']['name'] = 'Undefined';
      $powers[1] = 'Primary Power';
      $powers[2] = 'Secondary Power';
    }else{
      $powers[1] = $this->Power->find("first",array('conditions' => array('id' => $superHeroIdentity['SuperheroIdentity']['primary_power'])))['Power']['name'];
      $powers[2] = $this->Power->find("first",array('conditions' => array('id' => $superHeroIdentity['SuperheroIdentity']['secondary_power'])))['Power']['name'];
    }

    $this->loadModel('Role');
    $role = $this->Role->find('first',array('conditions' => array('id' => $user['User']['role_id'])));

    $countries = $this->countries;
    $languages = $this->languages;
    $sexes = $this->sex;
    $this->set(compact('organizations', 'groups','superHeroIdentity','role','countries','languages','sexes','powers'));
  }

/**
 * admin_add method
 *
 * @return void
 */
  public function admin_add() {
    if ($this->request->is('post')) {
      $this->User->create();
      if ($this->User->save($this->request->data)) {
        return $this->flash(__('The user has been saved.'), array('action' => 'index'));
      }
    }
    $groups = $this->User->Group->find('list');
    $this->set(compact('groups'));

    $groups = $this->User->Group->find('list'); 
    $this->loadModel('Organization');
    $organizations = $this->Organization->find('list');
    $this->loadModel('SuperheroIdentity');
    $roles = $this->Role->find('list');
    $this->loadModel('Role');
    $superheroIdentities = $this->SuperheroIdentity->find('list',array('fields' => 'name','id'));
    $countries = $this->countries;
    $languages = $this->languages;
    $sexes = $this->sex;
    $this->set(compact('organizations', 'groups','superheroIdentities','roles','countries','languages','sexes'));
  }

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
  public function admin_edit($id = null) {
    if (!$this->User->exists($id)) {
      throw new NotFoundException(__('Invalid user'));
    }
    if ($this->request->is(array('post', 'put'))) {
      //debug($this->request->data);
      if ($this->User->save($this->request->data)) {
        return $this->flash(__('The user has been saved.'), array('action' => 'index'));
      }
    } else {
      $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
      $this->request->data = $this->User->find('first', $options);
    }
    $groups = $this->User->Group->find('list'); 
    $this->loadModel('Organization');
    $organizations = $this->Organization->find('list');
    $this->loadModel('SuperheroIdentity');
    $roles = $this->Role->find('list');
    $this->loadModel('Role');
    $superheroIdentities = $this->SuperheroIdentity->find('list',array('fields' => 'name','id'));
    $countries = $this->countries;
    $languages = $this->languages;
    $sexes = $this->sex;
    $this->set(compact('organizations', 'groups','superheroIdentities','roles','countries','languages','sexes'));
  }

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
  public function admin_delete($id = null) {
    $this->User->id = $id;
    if (!$this->User->exists()) {
      throw new NotFoundException(__('Invalid user'));
    }
    $this->request->allowMethod('post', 'delete');
    if ($this->User->delete()) {
      return $this->flash(__('The user has been deleted.'), array('action' => 'index'));
    } else {
      return $this->flash(__('The user could not be deleted. Please, try again.'), array('action' => 'index'));
    }

    $this->loadModel('Organization');
    $organizations =
      $this->Organization->find('all', array(
      'order' => array(
        'Organization.name ASC'
      ),
    ));

   $this->set('organizations',$organizations);
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

  private function build_qualities_array() {
    $qualities = array();

    for($i = 0; $i <= 6; $i++) {
      $qualities[] = 0;
    }
    return $qualities;
  }
}