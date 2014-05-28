<?php

require APP.'Vendor'.DS.'facebook'.DS.'php-sdk'.DS.'src'.DS.'facebook.php';

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
	public $components = array('Paginator', 'MathCaptcha', );

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

    public function forgot() {
    	$lang = $this->getCurrentLanguage();
		$flags['_en'] = true;
		$flags['_es'] = false;
		if($lang=='es') {
			$flags['_en'] = false;
			$flags['_es'] = true;
		}

		$this->set(compact('$flags'));
        $this->set('captcha', $this->MathCaptcha->getCaptcha());

    	if ($this->request->is('post')) {
      		$this->User->create();
      		if ($this->MathCaptcha->validate($this->request->data['User']['captcha'])) {
        		$this->User->save($this->request->data);
      		} else {
        		$this->Session->setFlash('The result of the calculation was incorrect. Please, try again.');
      		}
    	} 
    }

    public function changePassword() {
    	$usr = $this->User->find('first', array(
    		'conditions' => array(
    			'User.id' => $this->getUserId()
    		)
    	));

    	if(!$usr)
    		$this->redirect($this->referer());


    	if ($this->request->is('post')) {
    		debug($this->request->data);
    		if(AuthComponent::password($this->request->data['User']['password']) == $usr['User']['password']) {
    			debug('match');
    			if($this->request->data['User']['tmp'] == $this->request->data['User']['tmp2']) {
    				debug('new password match');
    				$this->User->id = $this->getUserId();
    				$insert['User']['id'] = $this->getUserId();
    				$insert['User']['role_id'] = $this->getUserRole();
    				$insert['User']['password'] = $this->request->data['User']['tmp'];
    				$this->User->save($insert);

    			} else {
    				debug('new password dont match');
    			}
    		} else {
    			debug('not a match');
    		}
    		die();
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
		//debug($this->Auth);
		$facebook = new Facebook(array(
			'appId' => Configure::read('fb_app_id'),
			'secret' => Configure::read('fb_app_secret'),
			'allowSignedRequest' => false,
			
		));

		$browserLanguage = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		$this->set(compact('browserLanguage'));

		if(isset($this->params['url']['code'])) {

			$token = $facebook->getAccessToken();

			if (!empty($token)) {

				$userFbData = $facebook->getUser();
				$user_profile = '';

				try {
					$user_profile = $facebook->api('/me');
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
						// $this->Session->write('Auth.User.id', $this->User->getLastInsertID());
						//return $this->redirect(array('action' => 'dashboard'));
						$this->Session->setFlash('', 'opening_lightbox_message');
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
					// $this->Session->write('Auth.User.id', $user['User']['id']);
					return $this->redirect(array('action' => 'dashboard', $this->User->id));

				}
				
			}

		} else if ($this->Auth->login()) {

			return $this->redirect(array('action' => 'dashboard', $this->User->id));

		} else {
			$fbLoginUrl = $facebook->getLoginUrl();
			$this->set(compact('fbLoginUrl'));
		}
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
		$this->set('users', $this->Paginator->paginate());
	}


	public function moreEvidences($lastOne, $limit = 1, $user_id = -1){
		$this->autoRender = false; // We don't render a view in this example
    	$this->request->onlyAllow('ajax'); // No direct access via browser URL

   		$last = $this->User->Evidence->find('first', array(
    		'conditions' => array(
    			'Evidence.id' => $lastOne
    		)
    	));	

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
			$content = ($view->element($el, array('e' => $value)));
			
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
		//check to see if logged in
		if(!is_null($this->Auth->user())) 
			return $this->redirect(array('action' => 'dashboard', $this->User->id));
		
		if ($this->request->is('post')) {
			$this->User->create();
			$this->request->data['User']['role_id'] = 3;//sets user as a common user
			if ($this->User->save($this->request->data)) {
				$user = $this->User->save($this->request->data);
				// $this->Session->setFlash(__('The user has been saved.'));
				$user['User']['id'] = $this->User->id;
				$user['User']['role_id'] = $this->User->role_id;
				$this->Auth->login($user);

				if(empty($user['User']['biography'])){
					//echo $this->element('menu', array('user' => $user));
					$this->Session->setFlash('', 'opening_lightbox_message');
				}

				$this->Session->setFlash('', 'opening_lightbox_message');

				return $this->redirect(array('action' => 'edit', $this->User->id));
				//return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$roles = $this->User->Role->find('list');		
		$this->set(compact("roles"));
	}

/**
 *
 * dashboard method
 *
 * @return void
 */
	public function dashboard($id = null) {
		$me = $this->getUserId();
		if(is_null($id)){
			//send him to his on dashboard
			$id = $me;
		}
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}

		if($id != $this->getUserId()){
			$this->redirect(array('action'=>'profile', $id)); 
		}

		$lang = $this->getCurrentLanguage();
		$flags['_en'] = true;
		$flags['_es'] = false;
		if($lang=='es') {
			$flags['_en'] = false;
			$flags['_es'] = true;
		}

		$user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

		$users = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$myPoints = $this->User->Point->find('all', array('conditions' => array('Point.user_id' => $this->getUserId())));

		$sumMyPoints = $this->getPoints($this->getUserId());
		
		$myLevel = $this->getLevel($sumMyPoints);

		$this->loadModel('Level');

		$thisLevel = $this->Level->find('first', array('conditions' => array('Level.level' => $myLevel+1)));

		if(!empty($thisLevel))
			$percentage = round(($sumMyPoints / $thisLevel['Level']['points']) * 100);
		else
			$percentage = 0;

		$evidence = $this->User->Evidence->find('all', array(
			'order' => array(
				'Evidence.modified DESC'
			),
			'conditions' => array(
				'Evidence.title != ' => ''
			),
			'limit' => 8 // CHANGE 8
		));


		$this->loadModel('Evokation');
		$evokations = $this->Evokation->find('all', array(
			'order' => array(
				'Evokation.modified DESC'
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

		$myEvokations = array();
		foreach ($evokations as $evokation) {
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

		// $myevidences = $this->User->Evidence->find('all', array(
		// 	'order' => array(
		// 		'Evidence.modified DESC'
		// 	),
		// 	'conditions' => array(
		// 		'Evidence.user_id' => $id,
		// 		'Evidence.title != ' => ''
		// 	),
		// 	'limit' => 8
		// ));

		// $allies = array();

		$friends = $this->User->UserFriend->find('all', array('conditions' => array('UserFriend.user_id' => $id))); //this->getUserId()

		$are_friends = array();
		$mine_allies = array();
		$post_allies = array();
		$topic_allies = array();
		$my_notifies = array();
		//$allies = array();

		//debug($friends);

		foreach($friends as $friend){
			array_push($are_friends, array('User.id' => $friend['UserFriend']['friend_id']));
			array_push($mine_allies, array('Notification.user_id' => $friend['UserFriend']['friend_id']));
			array_push($my_notifies, array('Notification.user_id' => $users['User']['id']));
			array_push($post_allies, array('Post.user_id' => $friend['UserFriend']['friend_id']));
			array_push($topic_allies, array('Topic.user_id' => $friend['UserFriend']['friend_id']));
		} 

		//debug($are_friends);

		$this->loadModel('Notification');

		$notifies = array();
		$feed = array();

		// if(!empty($are_friends)){
		// 	$allies = $this->User->find('all', array(
		// 		'conditions' => array(
		// 			'OR' => $are_friends
		// 	)));

		// 	// foreach ($notifies as $key => $value) {
		// 	// 	if($value['Notification']['origin'] == 'evidence' || $value['Notification']['origin'] == 'like' ||
		// 	// 	 $value['Notification']['origin'] == 'commentEvidence') {
		// 	// 		if(is_null($value['Evidence']['id']) || $value['Evidence']['id'] == '') {
		// 	// 			unset($notifies[$key]);
		// 	// 		}
		// 	// 	}
		// 	// }
		// } else{
		// 	$allies = array();
		// }

		if(!empty($mine_allies)){
			$feed = $this->Notification->find('all', array(
				'conditions' => array(
					'OR' => $mine_allies
				), 
				'order' => array(
					'Notification.created DESC'
				)
			));
			
			foreach ($feed as $key => $value) {
			 	if($value['Notification']['origin'] == 'evidence' || $value['Notification']['origin'] == 'like' ||
		 	 		$value['Notification']['origin'] == 'commentEvidence') {
		 	 		if(is_null($value['Evidence']['id']) || $value['Evidence']['id'] == '') {
		 	 			unset($feed[$key]);
		 	 		}
		 	 	}
		 	}
		} 

		if(!empty($my_notifies)){
			$notifies = $this->Notification->find('all', array(
				'conditions' => array(
					'OR' => $my_notifies
				), 
				'order' => array(
					'Notification.created DESC'
				)
			));

			foreach ($notifies as $key => $value) {
			 	if($value['Notification']['origin'] == 'evidence' || $value['Notification']['origin'] == 'like' ||
		 	 		$value['Notification']['origin'] == 'commentEvidence') {
		 	 		if(is_null($value['Evidence']['id']) || $value['Evidence']['id'] == '') {
		 	 			unset($notifies[$key]);
		 	 		}
		 	 	}
		 	}
		} 

		$this->loadModel('Mission');
		$missions = $this->Mission->find('all', array(
			'order' => array('Mission.created')
		));

		$show_basic_training = false;
		$mission_ids = array();
		foreach ($missions as $m => $mission) {
			// $mission_ids[] = array('Attachment.foreign_key' => $mission['Mission']['id'], 'Attachment.model' => 'Mission');
			if($flags['_es']) {
				$missions[$m]['Mission']['title'] = $mission['Mission']['title_es'];
				// $missions[$m]['Mission']['description'] = $mission['Mission']['description_es'];
			}

			if($mission['Mission']['basic_training'] == 1) {
				if($users['User']['basic_training'] == 0) {
					$insert['User']['id'] = $this->getUserId();
					$insert['User']['role_id'] = $this->getUserRole();
					$insert['User']['basic_training'] = 1;

					$this->User->id = $insert['User']['id'];
					$this->User->save($insert);

					$show_basic_training = true;
				}
				$basic_training = $mission;
				unset($missions[$m]);
			}
				
		}

		$allusers = $this->User->find('all');

		//admin notifications check:
		$this->loadModel('AdminNotification');
		
		if(isset($users['AdminNotificationsUser'][0])) {
			//holds the last notification directed to this user
			$last = $users['AdminNotificationsUser'][count($users['AdminNotificationsUser']) - 1];
			//$last['id'] = 0;
		} else {
			$last['admin_notification_id'] = 0;
		}
		
		//get all newer than that one
		$adminNotifications = $this->AdminNotification->find('all', array(
			'conditions' => array(
				'AdminNotification.id >' => $last['admin_notification_id'],
				'AdminNotification.user_target' => null				
			)
		));
		
		foreach ($adminNotifications as $not) {
			//he sees it..
			$insert['AdminNotificationsUser']['user_id'] = $users['User']['id'];
			$insert['AdminNotificationsUser']['admin_notification_id'] = $not['AdminNotification']['id'];

			$this->User->AdminNotificationsUser->create();
			$this->User->AdminNotificationsUser->save($insert);


			$event = new CakeEvent('Controller.AdminNotificationsUser.show', $this, array(
	            'entity_id' => $not['AdminNotification']['id'],
	            'user_id' => $this->getUserId(),
	            'entity' => 'showNotification'
	        ));

	        $this->getEventManager()->dispatch($event);
	        // break;
		}

		//get all newer than that one
		$adminNotificationsToMe = $this->AdminNotification->find('all', array(
			'conditions' => array(
				'AdminNotification.id >' => $last['admin_notification_id'],
				'AdminNotification.user_target' => $this->getUserId()				
			)
		));
		

		foreach ($adminNotificationsToMe as $not) {
			//he sees it..
			$insert['AdminNotificationsUser']['user_id'] = $users['User']['id'];
			$insert['AdminNotificationsUser']['admin_notification_id'] = $not['AdminNotification']['id'];

			$this->User->AdminNotificationsUser->create();
			$this->User->AdminNotificationsUser->save($insert);

			$event = new CakeEvent('Controller.AdminNotificationsUser.show', $this, array(
	            'entity_id' => $not['AdminNotification']['id'],
	            'user_id' => $this->getUserId(),
	            'entity' => 'showNotification'
	        ));

	        $this->getEventManager()->dispatch($event);
	        break;
		}
		
		//$this->loadModel('Badge');

		// $badges = $this->User->UserBadge->find('all', array(
		// 	'conditions' => array(
		// 		'UserBadge.user_id' => $id
		// 	)
		// ));

		// foreach ($badges as $b => $badge) {
		// 	$this->loadModel('Attachment');
		// 	$badge_img = $this->Attachment->find('first', array(
		// 		'conditions' => array(
		// 			'Attachment.model' => 'Badge',
		// 			'Attachment.foreign_key' => $badge['Badge']['id']
		// 		)
		// 	));
		// 	if(!empty($badge_img)) {
		// 		$badges[$b]['Badge']['img_dir'] = $badge_img['Attachment']['dir']; 
		// 		$badges[$b]['Badge']['img_attachment'] = $badge_img['Attachment']['attachment'];
		// 	} else {

		// 	}

		// }
		//$this->set(compact('user', 'users', 'adminNotifications', 'is_friend', 'evidence', 'myevidences', 'evokations', 'evokationsFollowing', 'myEvokations', 'missions', 

		// $badges = $this->User->UserBadge->find('all', array(
		// 	'conditions' => array(
		// 		'UserBadge.user_id' => $id
		// 	)
		// ));

		// foreach ($badges as $b => $badge) {
		// 	$this->loadModel('Attachment');
		// 	$badge_img = $this->Attachment->find('first', array(
		// 		'conditions' => array(
		// 			'Attachment.model' => 'Badge',
		// 			'Attachment.foreign_key' => $badge['Badge']['id']
		// 		)
		// 	));
		// 	if(!empty($badge_img)) {
		// 		$badges[$b]['Badge']['img_dir'] = $badge_img['Attachment']['dir']; 
		// 		$badges[$b]['Badge']['img_attachment'] = $badge_img['Attachment']['attachment'];
		// 	} else {

		// 	}

		// }

		$this->loadModel('Forum.Post');
		$this->loadModel('Forum.Topic');

		$a_posts = array();
		$a_topics = array();

		
		if(!empty($post_allies)){
			$this->Post->recursive = 1;
			$a_posts = $this->Post->find('all', array(
				'conditions' => array(
					'OR' => $post_allies
			)));
		}

		if(!empty($topic_allies)){
			$this->Topic->recursive = 1;
			$a_topics = $this->Topic->find('all', array(
				'conditions' => array(
					'OR' => $topic_allies
			)));
		}
		
		$this->set(compact('feed', 'a_posts', 'a_topics', 'user', 'users', 'adminNotifications', 'evidence', 'myevidences', 'missions', 
			'imgs', 'sumMyPoints', 'myLevel', 'allies', 'allusers', 'powerpoints_users', 'percentage', 'basic_training', 'notifies', 
			'show_basic_training', 'evokations', 'evokationsFollowing', 'myEvokations'));
		//'groups', 'my_photo', 'user_photo',
		
	}

/**
 * logout method
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
		$users_groups = $this->GroupsUser->find('all', array('conditions' => array('GroupsUser.user_id' => $this->getUserId())));

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

		$this->set(compact('user', 'users', 'is_friend', 'followers', 'evidence', 'myevidences', 'evokations', 'evokationsFollowing', 'myEvokations', 'missions', 
			'missionIssues', 'issues', 'imgs', 'sumPoints', 'sumMyPoints', 'level', 'myLevel', 'allies', 'allusers', 'powerpoints_users', 'viewerEvokation',
			'power_points', 'points_users', 'percentage', 'percentageOtherUser', 'basic_training', 'notifies',  'badges', 'show_basic_training'));

	}

/**
 *
 * leaderboard
 *
 * @return void
 */
	public function leaderboard() {
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

		$user = $this->User->find('first', array(
			'conditions' => array(
				'User.id' => $this->getUserId()
			)
		));

		$myPoints = $this->User->Point->find('all', array('conditions' => array('Point.user_id' => $this->getUserId())));

		$sumMyPoints = 0;
		
		foreach($myPoints as $point){
			$sumMyPoints += $point['Point']['value'];
		}

		$level_one = $this->User->find('all', array('conditions' => array('User.level' => 1)));

		$level_two = $this->User->find('all', array('conditions' => array('User.level' => 2)));
		
		$questing_evi = $this->User->Evidence->find('all', array('order' => array('Evidence.created DESC')));

		$aux_evi = array();
		$questing_user = array();

		foreach($questing_evi as $evi):
			array_push($aux_evi, array('User.id' => $evi['Evidence']['user_id']));
		endforeach;

		if(!empty($aux_evi)){
			$questing_user = $this->User->find('all', array(
				'conditions' => array(
					'OR' => $aux_evi
				)
			));
		}

		$this->set(compact('level_one', 'level_two', 'questing_user', 'userid', 'username', 'user', 'users', 'powerpoints_users', 'power_points', 'points_users', 'sumMyPoints'));
	}

/**
 * add_friend method
 *
 * We are using here the HABTM relationship (Has And Belongs To Many, N <-> N approach), in which
 * we created a relationship from model User to itselft, using friends table as join table,
 * which holds two user's id and the DATETIME created to keep track of a friendship start.
 *
 * @return void
 */
	public function add_friend($user_to = null) {

		
		$this->request->data['User']['id'] = $this->getUserId();
		$this->request->data['Friend']['id'] = $user_to;

		if($result = $this->User->saveAll($this->request->data)) {
			$this->redirect(array('action' => 'view', $user_to));
		} else {
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
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		
		$roles = $this->User->Role->find('list');		
		$this->set(compact("roles"));

	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if(is_null($id)){
			$id = $this->getUserId();
		}

		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}

		//check to see if user is an admin
		//if so, he can edit whoever he likes
		//otherwise, you are not allowed to edit agents but
		// yourself and will be redirected home
		
		if($this->getUserRole() != 1) {
			if($id != $this->getUserId()) {
				$this->Session->setFlash(__("You can't edit other users. Permission denied."), 'flash_message');
				$this->redirect(array('action' => 'edit', $this->getUserId()));
			}
		}


		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$user = $this->User->find('first', $options);
		//$this->set(compact('user'));

		$user_photo = $this->User->Attachment->find('first', array(
			'order' => array(
				'Attachment.id DESC'
			),
			'conditions' => array(
				'Attachment.model' => 'User',
				'Attachment.foreign_key' => $id
			)
		));

		$myPoints = $this->User->Point->find('all', array('conditions' => array('Point.user_id' => $this->getUserId())));

		$sumMyPoints = 0;
		
		foreach($myPoints as $point){
			$sumMyPoints += $point['Point']['value'];
		}

		//$this->loadModel('UserIssue');

		$issues = $this->User->UserIssue->Issue->find('list');
		//$this->set(compact('user', 'issues'));

		$selectedIssues = $this->User->UserIssue->find('list', array('fields' => array('UserIssue.issue_id'), 'conditions' => array('UserIssue.user_id' => $id)));
		
		$this->set(compact('user', 'issues', 'selectedIssues', 'sumMyPoints', 'user_photo'));

		if ($this->request->is(array('post', 'put'))) {
			// debug($this->request->data);
			// die();
			if (!empty($this->request->data)) {
				$this->request->data['User']['role_id'] = $user['User']['role_id'];


				$userid = $this->request->data['User']['id'];

				$this->User->UserIssue->deleteAll(array('UserIssue.user_id' => $userid), false);

				if(isset($this->request->data['UserIssue']) && is_array($this->request->data['UserIssue']['issue_id'])) {
					foreach ($this->request->data['UserIssue']['issue_id'] as $a) {	  
				        $insertData = array('user_id' => $id, 'issue_id' => $a);

				        $exists = $this->User->UserIssue->find('first', array('conditions' => array('UserIssue.user_id' => $id, 'UserIssue.issue_id' => $a)));
				        if(!$exists) $this->User->UserIssue->saveAssociated($insertData);
				    }
				}
			    
			    if ($this->User->createWithAttachments($this->request->data, true, $id)) {

			    	$this->Auth->login($user);
			    	//$this->Session->setFlash(__('The user has been saved.'));
			    	$this->Session->setFlash(__('Your informations were succefully saved'), 'flash_message');
					return $this->redirect(array('action' => 'dashboard', $id));

				} 
		        
			} else $this->Session->setFlash(__('The user could not be saved. Please, try again.'));

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
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
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
