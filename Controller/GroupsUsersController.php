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
 * index method
 *
 * @return void
 */
	// public function index() {
	// 	$this->GroupsUser->recursive = 0;
	// 	$this->set('groupsUsers', $this->Paginator->paginate());

	// 	$userid = $this->getUserId();
	// 	$username = explode(' ', $this->getUserName());
	// 	$user = $this->GroupsUser->User->find('first', array('conditions' => array('User.id' => $userid)));

	// 	$groups = $this->GroupsUser->Group->find('all');

	// 	$this->set(compact('user', 'userid', 'username', 'groups'));
	// }

/**
 * edit method
 *
 * @deprecated This method has been emptied out in Evoke 2.0. Previously, it was used for editing evokations and not the group-users relationship, and it used etherpad for evokation content.
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($group_id = null) {
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
	        	$request = $this->GroupsUser->Group->GroupRequest->find('first', array('conditions' => array('GroupRequest.user_id' => $user_id, 'GroupRequest.group_id' => $group_id)));
	        	if($request){
	        		$this->GroupsUser->Group->GroupRequest->id = $request['GroupRequest']['id'];
	        		$this->GroupsUser->Group->GroupRequest->save(array('status' => 1));
	        	}

	        	$me = $this->GroupsUser->Group->find('first', array(
	        		'conditions' => array(
	        			'Group.id' => $gid
	        		)
	        	));

						//A completar - Renata
						$Email = new CakeEmail('smtp');
						$Email->from(array('no-reply@quanti.ca' => $sender['User']['firstname'].' '.$sender['User']['lastname']));
						$Email->to($recipient['email']);
						$Email->subject(__('Evoke - Request to join group '.$group['Group']['title']));
						$Email->emailFormat('html');
						$Email->template('group', 'group');
						$Email->viewVars(array('sender' => $sender['User'], 'recipient' => $recipient, 'group' => $group['Group']));
						$Email->send();
						//A completar - Renata

				return $this->redirect(array('controller' => 'groups', 'action' => 'view', $group_id));
	        } else $this->Session->setFlash(__('The groups user could not be saved. Please, try again.'));
		} else {
			$this->Session->setFlash(__('This user already belongs to this group.'));
			return $this->redirect(array('controller' => 'groups', 'action' => 'view', $group_id));
		}
	}


/**
* publish method
* publish to community setting a list of updates!
* @deprecated This method has been emptied out in Evoke 2.0. Previously, it used etherpad for evokation content.
*/
	public function publish($id = null){
	}

/**
* publish final method
* @deprecated This method has been emptied out in Evoke 2.0. Previously, it used etherpad for evokation content.
*/
	public function publishFinal($id = null){
	}


/**
 * send method
 * Send an email to the group owner requesting to join the group
 *
 * @return void
 */
	public function send($group_id){
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
			'contain' => array('User','Phase')
		));

		//Group owner is the recipient
		$recipient = $group['User'];

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
			$Email->subject(__('Evoke - Request to join group '.$group['Group']['title']));
			$Email->emailFormat('html');
			$Email->template('group', 'group');
			$Email->viewVars(array('sender' => $sender['User'], 'recipient' => $recipient, 'group' => $group['Group']));
			$Email->send();
			$this->Session->setFlash(__('The email was sent'), 'flash_message');
		}
		else {
			$this->Session->setFlash(__('There was a problem sending the email.'), 'flash_message');
		}

		$this->redirect(array('controller' => 'groups', 'action' => 'index', $group['Phase']['mission_id']));
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
		$gu = $this->GroupsUser->find('first', array(
			'conditions' => array(
				'GroupsUser.user_id' => $id
			)
		));
		$this->GroupsUser->id = $gu['GroupsUser']['id'];
		if (!$this->GroupsUser->exists()) {
			throw new NotFoundException(__('Invalid groups user'));
		}
		//$this->request->onlyAllow('post', 'delete');

		$group = $this->GroupsUser->Group->find('first', array(
			'conditions' => array(
				'Group.id' => $gu['GroupsUser']['group_id']
			)
		));

		if ($this->GroupsUser->delete()) {

			//attribute pp to evidence owner
			$this->loadModel('QuestPowerPoint');
			$pps = $this->QuestPowerPoint->find('all', array(
				'conditions' => array(
					'quest_id' => $group['Group']['quest_id']
				)
			));

			foreach($pps as $pp) {
				$this->loadModel('UserPowerPoint');
				$old = $this->UserPowerPoint->find('first', array(
					'conditions' => array(
						'user_id' => $id,
						'power_points_id' => $pp['QuestPowerPoint']['power_points_id'],
						'quest_id' => $pp['QuestPowerPoint']['quest_id'],
						'quantity' => ($pp['QuestPowerPoint']['quantity']*30),
						'model' => 'Group',
						'foreign_key' => $group['Group']['id']
					)
				));

				if(!empty($old)) {
					$this->UserPowerPoint->id = $old['UserPowerPoint']['id'];
					$this->UserPowerPoint->delete();
				}
			}

			$this->Session->setFlash(__('The groups user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The groups user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('controller' => 'groups', 'action' => 'view', $group['Group']['id']));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function deleteMembership($group_id = null, $user_id = null) {
		//Groups user
		$gu = $this->GroupsUser->find('first', array(
			'conditions' => array(
				'GroupsUser.group_id' => $group_id,
				'GroupsUser.user_id' => $user_id
			)
		));

		if (!isset($gu['GroupsUser']) || !isset($gu['GroupsUser']['id'])) {
			throw new NotFoundException(__('Invalid groups user'));
		}


		$this->GroupsUser->id = $gu['GroupsUser']['id'];

		if ($this->GroupsUser->delete()) {
			$this->Session->setFlash(__('The groups user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The groups user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('controller' => 'groups', 'action' => 'view', $group['Group']['id']));
	}

/**
 * admin_index method
 *
 * @return void
 */
	// public function admin_index() {
	// 	$this->GroupsUser->recursive = 0;
	// 	$this->set('groupsUsers', $this->Paginator->paginate());
	// }

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
