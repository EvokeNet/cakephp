<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

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
	public $components = array('Cookie');

/**
 * storeFileId method
 *
 * AJAX call to store the fileID from Google Drive in the Database and
 * use it in further calls in document updating.
 *
 * @return boolean TRUE if succeeded, FALSE otherwise
 */
	// public function storeFileInfo() {
	// 	$this->autoRender = false;

	// 	if ($this->request->is('ajax')) {

	// 		if(isset($this->request->data['id'])) {

	// 			$this->loadModel('Evokation');
	// 			$this->Evokation->read(null, $this->request->data['id']);
	// 			$this->Evokation->set('title', $this->request->data['title']);
	// 			$this->Evokation->set('abstract', $this->request->data['abstract']);

	// 			if ($this->Evokation->save()) {
	// 				return true;
	// 			} else {
	// 				return false;
	// 			}

	// 		} else {
	// 			$this->loadModel('Evokation');
	// 			$this->Evokation->create();
	// 			$this->request->data['Evokation']['gdrive_file_id'] = $this->request->data['gdrive_file_id'];
	// 			$this->request->data['Evokation']['title'] = $this->request->data['title'];
	// 			$this->request->data['Evokation']['group_id'] = $this->request->data['group_id'];
	// 			$this->request->data['Evokation']['abstract'] = $this->request->data['abstract'];

	// 			if($this->Evokation->save($this->request->data)) {
	// 				return $this->Evokation->id;
	// 			} else {
	// 				return false;
	// 			}

	// 		}
	// 	}
	// }


/**
 * storeFileId method
 *
 * AJAX call to store the fileID from Google Drive in the Database and
 * use it in further calls in document updating.
 *
 * @return boolean TRUE if succeeded, FALSE otherwise
 */
	// public function store_image() {
	// 	$this->autoRender = false;

	// 	if ($this->request->is('ajax')) {

	// 		$type = pathinfo($this->request->data['Evokation']['image_uploader']['tmp_name'], PATHINFO_EXTENSION);

	// 		if(!in_array($type, array('jpg', 'jpeg', 'JPG', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'bmp', 'BMP'))) {

	// 			$dir = 'uploads' . DS . $this->request->data['Evokation']['id'] . DS . $this->Auth->user('User.id');
	// 			if (!file_exists($dir) and !is_dir($dir)) {
	// 				$folder = new Folder();
	// 				if(!$folder->create($dir)) {
	// 					return false;
	// 				}
	// 			}

	// 			$filename = WWW_ROOT . $dir . DS . $this->request->data['Evokation']['image_uploader']['name'];
	// 			if(move_uploaded_file($this->request->data['Evokation']['image_uploader']['tmp_name'], $filename)) {
	// 				$url = $this->webroot . $dir . DS . $this->request->data['Evokation']['image_uploader']['name'];
	// 				$size = getimagesize($filename);
	// 				return '<img src="' . $url . '" width="100%" data-size="' .$size[0]. '"/>';
	// 			} else {
	// 				return false;
	// 			}

	// 		}
	// 		// $data = file_get_contents($this->request->data['image_uploader']['tmp_name']);
	// 		// $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
	// 	}
	// }


/**
 * add method
 *
 * @return void
 */
	public function add($uid = null, $gid = null) {
		$this->autoRender = false;

		//Parameters
		if($uid)
			$user_id = $uid;
		else
			$user_id = $this->params['url']['arg'];

		if($gid)
			$group_id = $gid;
		else
			$group_id = $this->params['url']['arg2'];

		//Add to the group
		$insertData = array('user_id' => $user_id, 'group_id' => $group_id);

		$exists = $this->GroupsUser->find('first', array('conditions' => array('GroupsUser.user_id' => $user_id, 'GroupsUser.group_id' => $group_id)));

		if(!$exists){
			$this->GroupsUser->create();
	        if($this->GroupsUser->save($insertData)){
	        	$this->Session->setFlash(__('The groups user has been saved.'));

	        	//Update request status
	        	$request = $this->GroupsUser->Group->GroupRequest->find('first', array(
	        		'conditions' => array('GroupRequest.user_id' => $user_id, 'GroupRequest.group_id' => $group_id),
	        		'contain' => 'User'
	        	));
	        	if($request){
	        		$this->GroupsUser->Group->GroupRequest->id = $request['GroupRequest']['id'];
	        		$this->GroupsUser->Group->GroupRequest->save(array('status' => 1));
	        	}

	        	//Group details
	        	$group = $this->GroupsUser->Group->find('first', array(
	        		'conditions' => array(
	        			'Group.id' => $group_id
	        		),
	        		'contain' => array('Leader', 'Phase')
	        	));

	        	//Email for requester
				$Email = new CakeEmail('smtp');
				$Email->from(array('no-reply@quanti.ca' => $group['Group']['title']));
				$Email->to($request['User']['email']);
				$Email->subject(__('(Evoke) You joined group "%s"',$group['Group']['title']));
				$Email->emailFormat('html');
				$Email->template('group_request_approved', 'default');
				$Email->viewVars(array('recipient' => $request['User'], 'group' => $group['Group'], 'phase' => $group['Phase']));
				$Email->send();

				return $this->redirect(array('controller' => 'groups', 'action' => 'view', $group_id));
	        }
	        return false;
		} else {
			$this->Session->setFlash(__('This user already belongs to this group.'));
			return $this->redirect(array('controller' => 'groups', 'action' => 'view', $group_id));
		}
	}


/**
 * send method
 * Send an email to the group owner requesting to join the group
 *
 * @return void
 */
	public function send($group_id){
		$this->autoRender = false;

		if (!$this->GroupsUser->Group->exists($group_id)) {
			throw new NotFoundException(__('Invalid group'));
		}

		//Requester is the current logged in user
		$sender = $this->GroupsUser->User->find('first', array(
			'conditions' => array('User.id' => $this->getUserId())
		));

		//Group
		$group = $this->GroupsUser->Group->find('first', array(
			'conditions' => array('Group.id' => $group_id),
			'contain' => array('Leader','Phase')
		));

		//Group owner is the recipient
		$recipient = $group['Leader'];

		/* Adds requests */
		$this->loadModel('GroupRequest');
		$insertData = array('user_id' => $this->getUserId(), 'group_id' => $group_id);
		$exists = $this->GroupRequest->find('first', array('conditions' => array(
			'GroupRequest.user_id' => $this->getUserId(),
			'GroupRequest.group_id' => $group_id
		)));

		//Repeated request
		if(!$exists){
	        if($this->GroupRequest->save($insertData)){
	        	$this->Session->setFlash(__('The request has been sent'));
	        }
	        else $this->Session->setFlash(__('The request could not be sent'));
		}
		else {
			$this->Session->setFlash(__('This user already requested to join this group'));
		}

		//Send email
		if($recipient['email'] != '' && !is_null($recipient['email'])
		 && $sender['User']['email'] != '' && !is_null($sender['User']['email'])) {

			$Email = new CakeEmail('smtp');
			$Email->from(array('no-reply@quanti.ca' => $sender['User']['firstname'].' '.$sender['User']['lastname']));
			$Email->to($recipient['email']);
			$Email->subject(__('(Evoke) Request to join group "%s"',$group['Group']['title']));
			$Email->emailFormat('html');
			$Email->template('group_new_request', 'default');
			$Email->viewVars(array('sender' => $sender['User'], 'recipient' => $recipient, 'group' => $group['Group']));
			$Email->send();
			$this->Session->setFlash(__('The email was sent'), 'flash_message');

			//AJAX
			if ($this->request->is('ajax')) {
				return true;
			}
		}
		else {
			$this->Session->setFlash(__('There was a problem sending the email.'), 'flash_message');

			//AJAX
			if ($this->request->is('ajax')) {
				return false;
			}
		}

		$this->redirect(array('controller' => 'groups', 'action' => 'view', $group_id));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->autoRender = false;

		$gu = $this->GroupsUser->find('first', array(
			'conditions' => array(
				'GroupsUser.user_id' => $id
			)
		));
		$this->GroupsUser->id = $gu['GroupsUser']['id'];
		
		if (!$this->GroupsUser->exists()) {
			throw new NotFoundException(__('Invalid groups user'));
		}

		$group = $this->GroupsUser->Group->find('first', array(
			'conditions' => array(
				'Group.id' => $gu['GroupsUser']['group_id']
			)
		));

		if ($this->GroupsUser->delete()) {
			$this->Session->setFlash(__('The groups user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The groups user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('controller' => 'groups', 'action' => 'view', $group['Group']['id']));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$this->GroupsUser->create();
			if ($this->GroupsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The groups user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The groups user could not be saved. Please, try again.'));
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
}
