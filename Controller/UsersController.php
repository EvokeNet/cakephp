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
	public $components = array('Paginator');

	public $uses = array('User', 'Friend');

	public $user = null;

/**
*
* beforeFilter method
*
* @return void
*/
	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout', 'register');
    }

/**
 * login method
 *
 * @return void
 */
	public function login() {

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

					if($this->User->save($user)) {
						$this->Auth->login($user);
						// $this->Session->write('Auth.User.id', $this->User->getLastInsertID());
						return $this->redirect(array('action' => 'dashboard', $this->User->id));
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

					$this->Auth->login($user);
					// $this->Session->write('Auth.User.id', $user['User']['id']);
					return $this->redirect(array('action' => 'dashboard', $this->User->id));

				}
				
			}

		} else if ($this->Auth->login()) {
			return $this->redirect($this->Auth->redirect());
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

/**
 *
 * register method
 *
 * @return void
 */
	public function register() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$user = $this->User->save($this->request->data);
				$this->Session->setFlash(__('The user has been saved.'));
				$this->Auth->login($user);
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
		if(is_null($id)){
			//send him to his on dashboard

		}
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}

		$user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

		$evidence = $this->User->Evidence->find('all', array('order' => array('Evidence.created DESC')));

		$this->loadModel('Evokation');
		$evokations = $this->Evokation->find('all', array('order' => array('Evokation.created DESC')));

		$this->loadModel('Mission');
		$missions = $this->Mission->find('all');
		$missionIssues = $this->Mission->MissionIssue->find('all');
		$issues = $this->Mission->MissionIssue->Issue->find('all');

		$this->set(compact('user', 'evidence', 'evokations', 'missions', 'missionIssues', 'issues'));

	}

/**
 *
 * dashboard issue
 * @throws NotFoundException
 * @param string $id
 * @param string $user_id
 *
 * @return void
 */
	public function dashboardByIssue($user_id = null, $id = null) {
		if (!$this->User->exists($user_id)) {
			throw new NotFoundException(__('Invalid user'));
		}

		$user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));

		$evidence = $this->User->Evidence->find('all', array('order' => array('Evidence.created DESC')));

		$this->loadModel('Mission');
		$missions = $this->Mission->find('all');
		$issue = $this->Mission->MissionIssue->Issue->find('first', array('conditions' => array('Issue.id' => $id)));
		$missionIssues = $this->Mission->MissionIssue->find('all');
		$missionIssue = $this->Mission->MissionIssue->find('all', array('conditions' => array('MissionIssue.issue_id' => $id)));

		$this->set(compact('user', 'evidence', 'issue', 'missions', 'missionIssues', 'missionIssue'));

	}

/**
 *
 * leaderboard
 *
 * @return void
 */
	public function leaderboard() {

		$user = $this->Auth->user();
		
		$userid = $user['id'];

		$username = explode(' ', $user['name']);
		
		$this->set(compact('userid', 'username'));

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
		$user = $this->Auth->user();

		$this->request->data['User']['id'] = $user['id'];
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

		$user_from = $this->Auth->user();
		$user_from = $user_from['id'];

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

		$me = $this->Auth->user();
		$user_from = $me['id'];

		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}

		$user = $this->User->read(null, $id);

		//check if it's myself, if it is, send to dashboard
		if($user_from == $id) {
			$this->redirect(array('action' => 'dashboard', $id));
		}

		$username = explode(' ', $me['name']);
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
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}

		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$user = $this->User->find('first', $options);
		$this->set(compact('user'));

		//$this->loadModel('UserIssue');

		$issues = $this->User->UserIssue->Issue->find('list');
		$this->set(compact('issues'));

		$selectedIssues = $this->User->UserIssue->find('list', array('fields' => array('UserIssue.issue_id'), 'conditions' => array('UserIssue.user_id' => $id)));
		$this->set(compact('selectedIssues'));

		if ($this->request->is(array('post', 'put'))) {
			
			if (!empty($this->request->data)) {

				$user = $this->request->data['User']['id'];

				$this->User->UserIssue->deleteAll(array('UserIssue.user_id' => $user), false);

				foreach ($this->request->data['UserIssue']['issue_id'] as $a) {	  
			        $insertData = array('user_id' => $user, 'issue_id' => $a);

			        $exists = $this->User->UserIssue->find('first', array('conditions' => array('UserIssue.user_id' => $id, 'UserIssue.issue_id' => $a)));
			        if(!$exists) $this->User->UserIssue->saveAssociated($insertData);
			    }

			    if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved.'));
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
	}}
