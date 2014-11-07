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

	public $components = array('SocialLogin', 'UserRole');

	public $uses = array('User', 'Friend');

	public $user = null;

	public $helpers = array('Menu');

/**
*
* beforeFilter method
*
* @return void
*/
	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'login', 'logout', 'register', 'forgot');
    }

//    public function forgot() {
//		if ($this->request->is('post')) {
//
//      		if ($this->MathCaptcha->validate($this->request->data['User']['captcha'])) {
//        		$usr = $this->User->find('first', array(
//        			'conditions' => array(
//        				'User.email' => $this->request->data['User']['email']
//        			)
//        		));
//
//        		if(!$usr) {
//        			$this->Session->setFlash('The email does not match with our database.', 'flash_message');
//        			return;
//        		}
//        		$newpass = $this->createTempPassword(8);
//        		$insert['User']['password'] = $newpass;
//        		$insert['User']['id'] = $usr['User']['id'];
//        		$this->User->id = $usr['User']['id'];
//        		if($this->User->save($insert)) {
//
//	        		//sending email with new password
//	        		if($usr['User']['email'] != '' && !is_null($usr['User']['email'])) {
//
//						$Email = new CakeEmail('smtp');
//						//$Email->from(array('no-reply@quanti.ca' => $sender['User']['name']));
//						$Email->to($usr['User']['email']);
//						$Email->subject(__('Evoke - New Password'));
//						// $Email->emailFormat('html');
//						// $Email->template('group', 'group');
//						// $Email->viewVars(array('sender' => $usr, 'recipient' => $usr));
//						$Email->send(__('Your new EVOKE password is') . ' '.$newpass.'. '.__('Please change your password as soon as possible.'));
//						$this->Session->setFlash(__('The email was sent.'), 'flash_message');
//						$this->redirect(array('action' => 'login'));
//					} else {
//						$this->Session->setFlash(__('There was a problem sending the email.', 'flash_message'));
//					}
//				} else {
//					$this->Session->setFlash(__('There was a problem generating the new password.', 'flash_message'));
//				}
//      		} else {
//        		$this->Session->setFlash('The result of the calculation was incorrect. Please, try again.', 'flash_message');
//      		}
//    	}
//        $this->set('captcha', $this->MathCaptcha->getCaptcha());
//    }

		// public function isAuthorized($user = null) {
		// 		if (parent::isAuthorized($user)) {
		// 				return true;
		// 		}
		//
		// 		return false;
		// }

    public function changePassword() {
    	$usr = $this->User->find('first', array(
    		'conditions' => array(
    			'User.id' => $this->getUserId()
    		)
    	));

    	if(empty($usr))
    		$this->redirect($this->referer());


    	if ($this->request->is('post')) {
    		// debug($this->request->data);
    		if(AuthComponent::password($this->request->data['User']['password']) == $usr['User']['password']) {
    			// debug('match');
    			if($this->request->data['User']['tmp'] == $this->request->data['User']['tmp2']) {
    				// debug('new password match');
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

		$googleLoginURL = $this->SocialLogin->create_google_url();

		if (isset($this->params['url']['code'])) {
			// debug($this->params['url']);
			// die();
			$this->SocialLogin->google_login($this->params['url']['code']);

		}

		$facebook = new Facebook(array(
			'appId' => Configure::read('fb_app_id'),
			'secret' => Configure::read('fb_app_secret'),
			'allowSignedRequest' => false,

		));

		$browserLanguage = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		$this->set(compact('browserLanguage'));

		// if(isset($this->params['url']['code'])) {
		//
		// 	$token = $facebook->getAccessToken();
		//
		// 	if (!empty($token)) {
		//
		// 		$userFbData = $facebook->getUser();
		// 		$user_profile = '';
		//
		// 		try {
		// 			$user_profile = $facebook->api('/me');
		// 			$this->Session->write('User', $user_profile);
		// 		} catch (FacebookApiException $e) {
		// 			error_log($e);
		// 			$userFbData = null;
		// 		}
		//
		// 		$user = $this->User->find('first', array('conditions' => array('facebook_id' => $user_profile['id'])));
		//
		// 		if(empty($user)) {
		//
		// 			// User does not exist in DB, so we are going to create
		//
		// 			$this->User->create();
		// 			$user['User']['facebook_id'] = $user_profile['id'];
		// 			$user['User']['facebook_token'] = $token;
		// 			$user['User']['name'] = $user_profile['name'];
		// 			$user['User']['sex'] = $user_profile['gender'];
		// 			$user['User']['login'] = $user_profile['username'];
		// 			$user['User']['facebook'] = $user_profile['link'];
		// 			$user['User']['role_id'] = 3;
		//
		// 			if($this->User->save($user)) {
		// 				$user['User']['id'] = $this->User->id;
		// 				$this->Auth->login($user);
		// 				// $this->Session->write('Auth.User.id', $this->User->getLastInsertID());
		// 				//return $this->redirect(array('action' => 'dashboard'));
		// 				$this->Session->setFlash('', 'opening_lightbox_message');
		//
		// 				// $event = new CakeEvent('Controller.Users.countVisits', $this, array(
		// 		  //           'user_id' => $this->User->id,
		// 		  //           'user_ip' => $_SERVER['SERVER_ADDR'],
		// 		  //           'date' => date('Y:m:d', $_SERVER['REQUEST_TIME']),
		// 		  //       ));
		//
		// 		  //       $this->getEventManager()->dispatch($event);
		//
		// 				$date = date('Y:m:d', $_SERVER['REQUEST_TIME']);
		//
		// 			//$this->Visit->countVisitor($this->User->id, $_SERVER['SERVER_ADDR'], $_SERVER['REQUEST_TIME']);
		//
		// 				return $this->redirect(array('action' => 'edit', $this->User->id));
		// 			} else {
		// 				$this->Session->setFlash(__('There was some interference in your connection.'), 'error');
		// 				return $this->redirect(array('action' => 'login'));
		// 			}
		//
		// 		} else {
		//
		// 			// User exists, so we just force login
		// 			// TODO: check if any data changed since last Facebook login, then update in our table
		//
		// 			// We need to update the Facebook token, once web tokens are short-term only
		// 			$this->User->id = $user['User']['id'];
		// 			$this->User->set('facebook_token', $token);
		// 			$this->User->save();
		//
		// 			$user['User']['id'] = $this->User->id;
		// 			$this->Auth->login($user);
		// 			// $this->Session->write('Auth.User.id', $user['User']['id']);
		// 			// $event = new CakeEvent('Controller.Users.countVisits', $this, array(
		// 	  //           'user_id' => $this->User->id,
		// 	  //           'user_ip' => $_SERVER['SERVER_ADDR'],
		// 	  //           'date' => date('Y:m:d', $_SERVER['REQUEST_TIME']),
		// 	  //       ));
		//
		// 	  //       $this->getEventManager()->dispatch($event);
		//
		// 			$date = date('Y:m:d', $_SERVER['REQUEST_TIME']);
		//
		// 			//$this->Visit->countVisitor($this->User->id, $_SERVER['SERVER_ADDR'], $_SERVER['REQUEST_TIME']);
		//
		// 			return $this->redirect(array('controller' => 'users', 'action' => 'matching', $this->User->id));
		//
		// 		}
		//
		// 	}
		//
		// }
		if ($this->Auth->login()) {

			$date = date('Y:m:d', $_SERVER['REQUEST_TIME']);

			return $this->redirect(array('controller' => 'users', 'action' => 'matching', $this->Auth->user('id')));

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

		$this->set(compact('missions'));
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
*
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		//$this->set('users', $this->Paginator->paginate());
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
				$this->User->create();
				// $this->request->data['User']['password'] = sha1($this->request->data['User']['password']);
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('O usuário foi salvo com sucesso.'));
					$user = $this->User->find('first', array('conditions' => array('User.id' => $this->User->id)));
	        $this->Auth->login($user['User']);
					return $this->redirect(array('action' => 'matching', $this->User->id));
				} else {
					$this->Session->setFlash(__('O usuário não pôde ser salvo. Por favor, tente novamente.'));
				}
			} else {
  			$this->Session->setFlash(__("Typed passwords don't match"));
  			//$this->redirect(array('action' => 'changePassword', '?arg='.$this->params['url']['arg']));
  		}
		}
	}

/**
 * allies method
 *
 * @return void
 */
	public function allies($id) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}

		$user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

		$users = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$allies = array();

		$friends = $this->User->UserFriend->find('all', array('conditions' => array('UserFriend.user_id' => $id))); //this->getUserId()

		$followers = $this->User->UserFriend->find('all', array('conditions' => array('UserFriend.friend_id' => $id))); //this->getUserId()

		$are_friends = array();
		//$allies = array();

		foreach($friends as $friend){
			array_push($are_friends, array('User.id' => $friend['UserFriend']['friend_id']));
		}

		if(!empty($are_friends)){
			$allies = $this->User->find('all', array(
				'conditions' => array(
					'OR' => $are_friends
			)));
		} else{
			$allies = array();
			//$notifies = array();
		}

		$this->set(compact('followers', 'user', 'users', 'friends', 'allies'));
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

		$lang = $this->getCurrentLanguage();
		$flags['_en'] = true;
		$flags['_es'] = false;
		if($lang=='es') {
			$flags['_en'] = false;
			$flags['_es'] = true;
		}
		// debug($lang);

		$user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

		$users = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$this->loadModel('Level');

		$points = $this->User->Point->find('all', array('conditions' => array('Point.user_id' => $id)));

		$sumPoints = $this->getPoints($id);

		$level = $this->getLevel($sumPoints);

		$otherLevel = $this->Level->find('first', array('conditions' => array('Level.level' => $level+1)));

		if(!empty($otherLevel))
			$percentage = round(($sumPoints / $otherLevel['Level']['points']) * 100);
		else
			$percentage = 0;

		$is_friend = $this->User->UserFriend->find('first', array('conditions' => array('UserFriend.user_id' => $this->getUserId(), 'UserFriend.friend_id' => $id)));

		$allies = array();

		$friends = $this->User->UserFriend->find('all', array('conditions' => array('UserFriend.user_id' => $id))); //this->getUserId()

		$followers = $this->User->UserFriend->find('all', array('conditions' => array('UserFriend.friend_id' => $id))); //this->getUserId()

		$are_friends = array();
		//$allies = array();

		foreach($friends as $friend){
			array_push($are_friends, array('User.id' => $friend['UserFriend']['friend_id']));
		}

		if(!empty($are_friends)){
			$allies = $this->User->find('all', array(
				'conditions' => array(
					'OR' => $are_friends
			)));
		}

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
			'order' => array(
				'Evokation.created DESC'
			),
			'conditions' => array(
				'Evokation.sent' => 1
			),
			'limit' => 8 // CHANGE 8
		));


		$evokationsFollowing = $this->User->EvokationFollower->find('all', array(
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

		$this->loadModel('Badge');

		$badges = $this->User->UserBadge->find('all', array(
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

		//List of similar users (for now, any 4 users; later, matching results)
		$similar_users = $this->User->find('all', array('limit' => 6));

		$this->set(compact('myevokations', 'user', 'users', 'is_friend', 'followers', 'evidence', 'myevidences', 'evokations', 'evokationsFollowing', 'myEvokations', 'missions',
			'missionIssues', 'issues', 'imgs', 'sumPoints', 'sumMyPoints', 'level', 'myLevel', 'allies', 'allusers', 'powerpoints_users', 'viewerEvokation',
			'power_points', 'points_users', 'percentage', 'percentageOtherUser', 'basic_training', 'notifies',  'badges', 'show_basic_training', 'lang', 'similar_users'));

	}

/**
 *
 * matching questions
 *
 * @return void
 */
	public function matching($id = null) {
		//List issues (all, and already saved)
		//debug($loggedIn);

		//debug($loggedInUser);

		$issues = $this->User->UserIssue->Issue->find('list');
		$selectedIssues = $this->User->UserIssue->find('list', array('fields' => array('UserIssue.issue_id'), 'conditions' => array('UserIssue.user_id' => $id)));

		//List questions (all, and already saved)
		$this->loadModel('MatchingQuestion');
		$this->loadModel('UserMatchingAnswer');
		$matching_questions = $this->MatchingQuestion->find('all');
		$selected_matching_answer = $this->User->UserMatchingAnswer->find('all', array('conditions' => array('UserMatchingAnswer.user_id' => $id)));

		$user_id = $id;

		if ($this->request->is('post', 'put')) {
			$counter = 0;
			if (isset($this->request->data['UserMatchingAnswer']['matching_answer'])) {
				foreach($this->request->data['UserMatchingAnswer']['matching_answer'] as $key => $u):
					$insert['UserMatchingAnswer']['user_id'] = $this->request->data['UserMatchingAnswer']['user_id'];
					$insert['UserMatchingAnswer']['matching_question_id'] = $this->request->data['UserMatchingAnswer']['matching_question_id'][$counter];
					$insert['UserMatchingAnswer']['matching_answer'] = $u;
					$this->User->UserMatchingAnswer->create();
					$this->User->UserMatchingAnswer->save($insert);
					$counter++;
				endforeach;
			}

			if ($this->request->data['UserIssue']['issue_id']) {
				foreach ($this->request->data['UserIssue']['issue_id'] as $a) {
			        $insert = array('user_id' => $this->request->data['UserMatchingAnswer']['user_id'], 'issue_id' => $a);

			        $exists = $this->User->UserIssue->find('first', array('conditions' => array('UserIssue.user_id' => $this->request->data['UserMatchingAnswer']['user_id'], 'UserIssue.issue_id' => $a)));
			        if(!$exists) $this->User->UserIssue->save($insert);
			    }
			}

			return $this->redirect(array('controller' => 'users', 'action' => 'matching_results', $id));
		}

		$this->set(compact('matching_questions', 'selected_matching_answer', 'user_id', 'issues', 'selectedIssues'));
	}

/**
 *
 * matching results
 *
 * @return void
 */
	public function matching_results($id = null) {
		//List of similar users (for now, any 4 users; later, matching results)
		$similar_users = $this->User->find('all', array('limit' => 4));

		$this->set(compact('similar_users'));
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
 * see a preview of the evokation page
 *
 * @return void
 */
	public function evokation() {

	}


/**
 *
 * leaderboard
 *
 * @return void
 */
	public function leaderboard($label = null) {

		$user = $this->User->find('first', array(
			'conditions' => array(
				'User.id' => $this->getUserId()
			)
		));

		$userid = $this->getUserId();

		$username = explode(' ', $this->getUserName());


		$lang = $this->getCurrentLanguage();
		$flags['_en'] = true;
		$flags['_es'] = false;
		if($lang=='es') {
			$flags['_en'] = false;
			$flags['_es'] = true;
		}
		//getting leaderboard data:
			//getting user power points

		$powerpoints_users = array(); // will contain [pp_id][user_id] = total of that pp

		$points_users = array(); // will contain [points][][user]

		$allusers = $this->User->find('all');

			//debug($vote_rank);

			$this->loadModel('PowerPoint');
			$power_points = $this->PowerPoint->find('all');

			$this->loadModel('Point');
			//$points = $this->Point->find('all');

			foreach ($allusers as $usr) {
				$points = $this->Point->find('all', array(
					'conditions' => array(
						'Point.user_id' => $usr['User']['id']
					)
				));
				$usrpoints = 0;
				foreach ($points as $point) {
					$usrpoints += $point['Point']['value'];
				}

				$usr['User']['level'] = $this->getLevel($usrpoints);
				$points_users[$usrpoints][] = $usr['User'];

				$powerpoints_user = $this->User->UserPowerPoint->find('all', array(
					'conditions' => array(
						'UserPowerPoint.user_id' => $usr['User']['id']
					)
				));

				$tmp = array();
				foreach ($powerpoints_user as $powerpoint_user) {
					if(isset($tmp[$powerpoint_user['UserPowerPoint']['power_points_id']])) {

						$tmp[$powerpoint_user['UserPowerPoint']['power_points_id']] += $powerpoint_user['UserPowerPoint']['quantity'];
					} else {

						$tmp[$powerpoint_user['UserPowerPoint']['power_points_id']] = $powerpoint_user['UserPowerPoint']['quantity'];
					}
				}

				foreach ($power_points as $p_index => $pp) {
					if($flags['_es']) {
						$power_points[$p_index]['PowerPoint']['name'] = $pp['PowerPoint']['name_es'];
						// $missions[$m]['Mission']['description'] = $mission['Mission']['description_es'];
					}
					$qtdUser = 0;
					if(isset($tmp[$pp['PowerPoint']['id']]))
						$qtdUser = $tmp[$pp['PowerPoint']['id']];

					$powerpoints_users[$pp['PowerPoint']['id']][$qtdUser][] = $usr['User'];
				}
			}

			foreach ($power_points as $pp) {

				krsort($powerpoints_users[$pp['PowerPoint']['id']]);

			}
			krsort($points_users);

		$this->set(compact('label', 'userid', 'username', 'user', 'users', 'powerpoints_users', 'power_points', 'points_users', 'lang'));

		if(empty($label)) {
			$this->render('categories/levels');
		}

		if($label == 'evokation') {

			$this->loadModel('Evokation');

			$evokations = $this->Evokation->find('all', array(
				'conditions' => array(
					'Evokation.sent' => 1
				)
			));

			$votes = $this->Evokation->Vote->find('all');

			$vote_rank = array();

			foreach($evokations as $e):
				foreach($votes as $v):
					$var = $v['Vote']['value'] + 1;
					if($v['Vote']['evokation_id'] == $e['Evokation']['id']){
						if(isset($vote_rank[$e['Evokation']['id']]))
							$vote_rank[$e['Evokation']['id']] += $var;
						else
							$vote_rank[$e['Evokation']['id']] = $var;
					}
				endforeach;
				if(!isset($vote_rank[$e['Evokation']['id']]))
					$vote_rank[$e['Evokation']['id']] = 0;
			endforeach;

			arsort($vote_rank);

			$this->set(compact('evokations', 'votes', 'vote_rank'));

			$this->render('categories/evokation');
		}

		if(is_numeric($label)) {

			$this->loadModel('PowerPoint');

			$powerlabel = $this->PowerPoint->find('first', array(
				'conditions' => array(
					'PowerPoint.id' => $label
				)
			));

			$this->set(compact('powerlabel'));

			$this->render('categories/power_points');
		}

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
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$flags = array(
			'_self' => false,
			'_friended' => false
		);


		$user_from = $this->getUserId();

		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}

		$user = $this->User->read(null, $id);


		//check if it's myself, if it is, send to dashboard
		if($user_from == $id) {
			$this->redirect(array('action' => 'dashboard', $id));
		}

		$username = explode(' ', $this->getUserName());

		$this->set(compact('username'));

		$userFriends = $this->User->find('first', array(
			'conditions' => array(
				'User.id' => $user_from
			),
			'contain' => array(
				'Friend' => array(
					'conditions' => array(
						'user_from' => $user_from,
						'user_to' => $id
					)
				)
			)
		));

		$friendship = $userFriends['Friend'];

		if($user['User']['id'] == $user_from) {
			$flags['_self'] = true;
		} else if(isset($friendship) && !empty($friendship)) {
			$flags['_friended'] = true;
		}

		$this->set(compact('user', 'flags'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}

		$roles = $this->User->Role->find('list');
		$this->set(compact("roles"));

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
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'profile', $id));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
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
	// public function admin_index() {
	// 	$this->User->recursive = 0;
	// 	$this->set('users', $this->Paginator->paginate());
	// }

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
		$this->set('user', $this->User->find('first', $options));
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
		return $this->redirect(array('action' => 'index'));
	}
}
