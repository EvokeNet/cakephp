<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

use EtherpadLite\Client;


/**
 * GroupsUsers Controller
 *
 * @property GroupsUser $GroupsUser
 * @property PaginatorComponent $Paginator
 */
class GroupsUsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->GroupsUser->recursive = 0;
		$this->set('groupsUsers', $this->Paginator->paginate());
		
		$userid = $this->getUserId();
		$username = explode(' ', $this->getUserName());
		$user = $this->GroupsUser->User->find('first', array('conditions' => array('User.id' => $userid)));

		$groups = $this->GroupsUser->Group->find('all');

		$this->set(compact('user', 'userid', 'username', 'groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($group_id = null) {

		$apikey = Configure::read('etherpad_api_key');
		$client = new Client($apikey, 'http://localhost:9001');

		$response = $client->checkToken();

		$group = $this->GroupsUser->getGroupAndUsers($group_id);
		
		$users = $this->GroupsUser->find('all', array(
			'conditions' => array(
				'GroupsUser.group_id' => $group_id
			)
		));

		$this->loadModel('Evokation');
		$evokation = $this->Evokation->find('first', array(
			'conditions' => array(
				'group_id' => $group_id
			)
		));

		if(!empty($evokation)) {
			$this->request->data = $evokation;
		}

		$this->set(compact('group', 'users'));

	}

/**
 * storeFileId method
 *
 * AJAX call to store the fileID from Google Drive in the Database and
 * use it in further calls in document updating.
 *
 * @return boolean TRUE if succeeded, FALSE otherwise
 */
	public function storeFileInfo() {
		$this->autoRender = false;

		if ($this->request->is('ajax')) {

			if(isset($this->request->data['id'])) {

				$this->loadModel('Evokation');
				$this->Evokation->read(null, $this->request->data['id']);
				$this->Evokation->set('title', $this->request->data['title']);
				$this->Evokation->set('abstract', $this->request->data['abstract']);
				
				if ($this->Evokation->save()) {
					return true;
				} else {
					return false;
				}

			} else {
				$this->loadModel('Evokation');
				$this->Evokation->create();
				$this->request->data['Evokation']['gdrive_file_id'] = $this->request->data['gdrive_file_id'];
				$this->request->data['Evokation']['title'] = $this->request->data['title'];
				$this->request->data['Evokation']['group_id'] = $this->request->data['group_id'];
				$this->request->data['Evokation']['abstract'] = $this->request->data['abstract'];

				if($this->Evokation->save($this->request->data)) {
					return $this->Evokation->id;
				} else {
					return false;
				}

			}
		}
	}


/**
 * storeFileId method
 *
 * AJAX call to store the fileID from Google Drive in the Database and
 * use it in further calls in document updating.
 *
 * @return boolean TRUE if succeeded, FALSE otherwise
 */
	public function store_image() {
		$this->autoRender = false;

		if ($this->request->is('ajax')) {

			$type = pathinfo($this->request->data['Evokation']['image_uploader']['tmp_name'], PATHINFO_EXTENSION);

			if(!in_array($type, array('jpg', 'jpeg', 'JPG', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'bmp', 'BMP'))) {

				$dir = 'uploads' . DS . $this->request->data['Evokation']['id'] . DS . $this->Auth->user('User.id');
				if (!file_exists($dir) and !is_dir($dir)) {
					$folder = new Folder();
					if(!$folder->create($dir)) {
						return false;
					}
				} 

				$filename = WWW_ROOT . $dir . DS . $this->request->data['Evokation']['image_uploader']['name'];
				if(move_uploaded_file($this->request->data['Evokation']['image_uploader']['tmp_name'], $filename)) {
					$url = $this->webroot . $dir . DS . $this->request->data['Evokation']['image_uploader']['name'];
					$size = getimagesize($filename);
					return '<img src="' . $url . '" width="100%" data-size="' .$size[0]. '"/>';
				} else {
					return false;
				}

			}
			// $data = file_get_contents($this->request->data['image_uploader']['tmp_name']);
			// $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
		}
	}


/**
 * add method
 *
 * @return void
 */
	public function add($uid = null, $gid = null) {
		
		if($uid)
			$user_id = $uid;
		else
			$user_id = $this->params['url']['arg'];

		if($gid)
			$group_id = $gid;
		else
			$group_id = $this->params['url']['arg2'];

		$insertData = array('user_id' => $user_id, 'group_id' => $group_id);

		$exists = $this->GroupsUser->find('first', array('conditions' => array('GroupsUser.user_id' => $user_id, 'GroupsUser.group_id' => $group_id)));

		if(!$exists){
	        if($this->GroupsUser->save($insertData)){
	        	$this->Session->setFlash(__('The groups user has been saved.'));

	        	//Update request status
	        	$request = $this->GroupsUser->Group->GroupRequest->find('first', array('conditions' => array('GroupRequest.user_id' => $user_id, 'GroupRequest.group_id' => $group_id)));
	        	if($request){
	        		$this->GroupsUser->Group->GroupRequest->id = $request['GroupRequest']['id'];
	        		$this->GroupsUser->Group->GroupRequest->save(array('status' => 1));
	        	}

				return $this->redirect(array('controller' => 'groups', 'action' => 'view', $group_id));
	        } else $this->Session->setFlash(__('The groups user could not be saved. Please, try again.'));
		} else {
			$this->Session->setFlash(__('This user already belongs to this group.'));
			return $this->redirect(array('controller' => 'groups', 'action' => 'view', $group_id));
		}
	}

/**
 * send method
 *
 * @return void
 */
	public function send($id, $group_id){

		$user = $this->GroupsUser->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));
		
		$sender = $this->GroupsUser->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$recipient = $this->GroupsUser->User->find('first', array('conditions' => array('User.id' => $id)));

		$group = $this->GroupsUser->Group->find('first', array('conditions' => array('Group.id' => $group_id)));

		/* Adds requests */
		$this->loadModel('GroupRequest');
		$insertData = array('user_id' => $this->getUserId(), 'group_id' => $group_id);
		$exists = $this->GroupRequest->find('first', array('conditions' => array('GroupRequest.user_id' => $this->getUserId(), 'GroupRequest.group_id' => $group_id)));

		if(!$exists){
	        if($this->GroupRequest->save($insertData)){
	        	$this->Session->setFlash(__('The request has been sent'));
	        } else $this->Session->setFlash(__('The request could not be sent'));
		} else {
			$this->Session->setFlash(__('This user already requested to join thsi group'));
		}

		$Email = new CakeEmail('smtp');
		//$Email->from(array('no-reply@quanti.ca' => $sender['User']['name']));
		$Email->to($recipient['User']['email']);
		$Email->subject(__('Evoke - Request to join group'));
		$Email->emailFormat('html');
		$Email->template('group', 'group');
		$Email->viewVars(array('sender' => $sender, 'recipient' => $recipient, 'group' => $group));
		$Email->send();
		$this->Session->setFlash(__('The email was sent'));
		$this->redirect(array('controller' => 'groups', 'action' => 'view', $group_id));
	
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit2($id = null) {
		if (!$this->GroupsUser->exists($id)) {
			throw new NotFoundException(__('Invalid groups user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->GroupsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The groups user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The groups user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('GroupsUser.' . $this->GroupsUser->primaryKey => $id));
			$this->request->data = $this->GroupsUser->find('first', $options);
		}
		$users = $this->GroupsUser->User->find('list');
		$groups = $this->GroupsUser->Group->find('list');
		$this->set(compact('users', 'groups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->GroupsUser->id = $id;
		if (!$this->GroupsUser->exists()) {
			throw new NotFoundException(__('Invalid groups user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->GroupsUser->delete()) {
			$this->Session->setFlash(__('The groups user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The groups user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->GroupsUser->recursive = 0;
		$this->set('groupsUsers', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->GroupsUser->exists($id)) {
			throw new NotFoundException(__('Invalid groups user'));
		}
		$options = array('conditions' => array('GroupsUser.' . $this->GroupsUser->primaryKey => $id));
		$this->set('groupsUser', $this->GroupsUser->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->GroupsUser->create();
			if ($this->GroupsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The groups user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The groups user could not be saved. Please, try again.'));
			}
		}
		$users = $this->GroupsUser->User->find('list');
		$groups = $this->GroupsUser->Group->find('list');
		$this->set(compact('users', 'groups'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->GroupsUser->exists($id)) {
			throw new NotFoundException(__('Invalid groups user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->GroupsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The groups user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The groups user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('GroupsUser.' . $this->GroupsUser->primaryKey => $id));
			$this->request->data = $this->GroupsUser->find('first', $options);
		}
		$users = $this->GroupsUser->User->find('list');
		$groups = $this->GroupsUser->Group->find('list');
		$this->set(compact('users', 'groups'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->GroupsUser->id = $id;
		if (!$this->GroupsUser->exists()) {
			throw new NotFoundException(__('Invalid groups user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->GroupsUser->delete()) {
			$this->Session->setFlash(__('The groups user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The groups user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}