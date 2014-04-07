<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class GroupsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public $user = null;

/**
 * index method
 *
 * @return void
 */
	public function index($mission_id = null) {
		$this->Group->recursive = 0;
		$this->set('groups', $this->Paginator->paginate());

		$user = $this->Group->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$mission = $this->Group->Mission->find('first', array('conditions' => array('Mission.id' => $mission_id)));

		$groups = $this->Group->find('all', array('conditions' => array('Group.mission_id' => $mission_id)));


		$groups_id = array();
		$groupsBelongs = array();

		foreach($groups as $group):
			array_push($groups_id, array('Evokation.group_id' => $group['Group']['id']));
			array_push($groupsBelongs, array('GroupsUser.group_id' => $group['Group']['id'], 'GroupsUser.user_id' => $this->getUserId()));
		endforeach;

		//retrieve all organizations I am part of as a list to be displayed in a combobox
		$evokations = $this->Group->Evokation->find('all', array(
			'order' => array(
				'Evokation.created DESC'
			),
			'conditions' => array(
				'OR' => $groups_id
			)
		));

		//retrieve all organizations I am part of as a list to be displayed in a combobox
		$groupsIBelong = $this->Group->GroupsUser->find('all', array(
			'order' => array(
				'GroupsUser.created DESC'
			),
			'conditions' => array(
				'OR' => $groupsBelongs
			)
		));

		$myGroups = $this->Group->find('all', array('conditions' => array('Group.mission_id' => $mission_id, 'Group.user_id' => $this->getUserId())));

		$mygroups_id = array();

		foreach($myGroups as $g):
			array_push($mygroups_id, array('Evokation.group_id' => $g['Group']['id']));
		endforeach;

		//retrieve all organizations I am part of as a list to be displayed in a combobox
		$myevokations = $this->Group->Evokation->find('all', array(
			'order' => array(
				'Evokation.created DESC'
			),
			'conditions' => array(
				'OR' => $mygroups_id
			)
		));

		$this->set(compact('user', 'myGroups', 'mission', 'evokations', 'myevokations', 'groupsIBelong'));
	}


	public function by_mission($mission_id = null) {
		if(is_null($mission_id)) {
			$this->redirect(array('action' => 'index'));
		}

		$this->loadModel('Mission');
		$mission = $this->Mission->find('first', array('conditions' => array('Mission.id' => $mission_id)));
		
		if(empty($mission)) {
			$this->redirect(array('action' => 'index'));	
		}

		$evokations = $this->Group->Evokation->find('all', array('order' => array('Evokation.created DESC'), 'conditions' => array('Group.mission_id' => $mission_id)));

		$groups = $this->Group->find('all', array('conditions' => array('Group.mission_id' => $mission_id)));

		$users = $this->Group->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$myGroups = $this->Group->find('all', array('conditions' => array('Group.user_id' => $this->getUserId())));

		$this->set(compact('users', 'myGroups', 'groups', 'mission', 'evokations'));

		$this->render('index');
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$me = $this->getUserId();

		$flags = array(
			'_owner' => false,
			'_member' => false
		);

		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}

		$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
		$group = $this->Group->find('first', $options);

		$user = $this->Group->User->find('first', array('conditions' => array('User.id' => $me)));

		$groupsUsers = $this->Group->GroupsUser->find('all', array('conditions' => array('GroupsUser.group_id' => $id)));

		
		//check to see if i am the owner
		if($this->isOwner($me, $id)) {
			$flags['_owner'] = true;
			$flags['_member'] = true;
		} else {
			//i am not the owner... am i at least part of the group?
			if($this->isMember($me, $id)) {
				$flags['_member'] = true;
			}
		}


		$groupsRequestsPending = $this->Group->GroupRequest->find('all', array('conditions' => array('GroupRequest.group_id' => $id, 'GroupRequest.status = 0')));

		$groupsRequests = $this->Group->GroupRequest->find('all', array('conditions' => array('GroupRequest.group_id' => $id, 'GroupRequest.status' => array(1, 2))));

		$userRequest = $this->Group->GroupRequest->find('all', array('conditions' => array('GroupRequest.group_id' => $id, 'GroupRequest.user_id' => $me)));

		$this->set(compact('user', 'userRequest', 'groupsUsers', 'group', 'groupsRequests', 'groupsRequestsPending', 'flags'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($mission_id = null) {
		if ($this->request->is('post')) {
			$this->Group->create();
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved.'));
				return $this->redirect(array('action' => 'index', $mission_id));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
		}


		$this->loadModel('Mission');
		$missions = $this->Mission->find('list');

		if(!is_null($mission_id)) {
			$tmp = $this->Mission->find('first', array('conditions' => array('Mission.id' => $mission_id)));
			if(!empty($tmp)) {
				$mission = $this->Mission->find('first', array('conditions' => array('Mission.id' => $mission_id)));
			}
		}

		$userid = $this->getUserId();
		$users = $this->Group->User->find('list');
		$evokations = $this->Group->Evokation->find('list');
		$this->set(compact('users', 'userid', 'evokations', 'mission', 'missions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		
		$me = $this->getUserId();
		if(!$this->isOwner($me, $id)) {
			$this->Session->setFlash(__('Only the group owner is allowed to delete it.'));
			return $this->redirect($this->referer());
		}


		if ($this->request->is(array('post', 'put'))) {
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
			$this->request->data = $this->Group->find('first', $options);
		}
		$users = $this->Group->User->find('list');
		$evokations = $this->Group->Evokation->find('list');
		$this->set(compact('users', 'evokations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}

		//checking to see if i own this group
		$me = $this->getUserId();
		if(!$this->isOwner($me, $id)) {
			$this->Session->setFlash(__('Only the group owner is allowed to delete it.'));
			return $this->redirect($this->referer());
		}


		$this->request->onlyAllow('post', 'delete');
		if ($this->Group->delete()) {
			$this->Session->setFlash(__('The group has been deleted.'));
		} else {
			$this->Session->setFlash(__('The group could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function isMember($user_id = null, $id = null){
		if(!$user_id || !$id) return false;
		$this->loadModel('GroupsUser');
		$users = $this->GroupsUser->find('all', array(
			'conditions' => array(
				'GroupsUser.group_id' => $id
			)
		));

		foreach ($users as $usr) {
				if($usr['User']['id'] == $user_id) return true;
		}
		return false;
	}

	public function isOwner($user_id = null, $id = null){
		if(!$user_id || !$id) return false;
		
		$group = $this->Group->find('first', array(
			'conditions' => array(
				'user_id' => $user_id,
				'Group.id' => $id
			)
		));

		if(empty($group)) return false;
		return true;
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Group->recursive = 0;
		$this->set('groups', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
		$this->set('group', $this->Group->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Group->create();
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
		}
		$users = $this->Group->User->find('list');
		$evokations = $this->Group->Evokation->find('list');
		$this->set(compact('users', 'evokations'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
			$this->request->data = $this->Group->find('first', $options);
		}
		$users = $this->Group->User->find('list');
		$evokations = $this->Group->Evokation->find('list');
		$this->set(compact('users', 'evokations'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Group->delete()) {
			$this->Session->setFlash(__('The group has been deleted.'));
		} else {
			$this->Session->setFlash(__('The group could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
