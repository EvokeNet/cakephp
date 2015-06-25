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
	public $components = array(/*'Paginator',*/ 'Session');

	public $user = null;

	public function beforeFilter() {
		parent::beforeFilter();
		ini_set('memory_limit', '256M'); // emergencial measure
	}

/**
 * index method
 *
 * @return void
 */
	public function index($mission_id = null, $quest_id = null) {
		
		$user = $this->Group->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$myPoints = $this->Group->User->Point->find('all', array('conditions' => array('Point.user_id' => $this->getUserId())));

		$sumMyPoints = 0;
		
		foreach($myPoints as $point){
			$sumMyPoints += $point['Point']['value'];
		}

		$mission = $this->Group->Phase->Mission->find('first', array('conditions' => array('Mission.id' => $mission_id)));

		$quest = $this->Group->Phase->Mission->Quest->find('first', array('conditions' => array('Quest.id' => $quest_id)));

		$groups = $this->Group->find('all');

		$groupsUsers = $this->Group->GroupsUser->find('all', array('conditions' => array('GroupsUser.user_id' => $this->getUserId())));

		$groups_id = array();

		foreach($groups as $group):
			array_push($groups_id, array('Evokation.group_id' => $group['Group']['id']));
			//array_push($groupsBelongs, array('GroupsUser.group_id' => $group['Group']['id'], 'GroupsUser.user_id' => $this->getUserId()));
		endforeach;

		if(!empty($groups_id)) {
			//retrieve all organizations I am part of as a list to be displayed in a combobox
			$evokations = $this->Group->Evokation->find('all', array(
				'order' => array(
					'Evokation.created DESC'
				),
				'conditions' => array(
					'OR' => $groups_id
				)
			));
		} else {
			$evokations = array();
		}

		$groupsBelongs = array();

		foreach($groupsUsers as $group):
			$g = $this->Group->find('first', array('conditions' => array('Group.id' => $group['GroupsUser']['group_id'])));
			if($g['Group']['user_id'] != $this->getUserId())
				array_push($groupsBelongs, array('Group.id' => $group['GroupsUser']['group_id']));
		endforeach;
		
		if(!empty($groupsUsers) && !(empty($groupsBelongs))) {
			//retrieve all organizations I am part of as a list to be displayed in a combobox
			$groupsIBelong = $this->Group->find('all', array(
				'order' => array(
					'Group.created DESC'
				),
				'conditions' => array(
					'OR' => $groupsBelongs
				)
			));
		} else {
			$groupsIBelong = array();
		}

		$myGroups = $this->Group->find('all', array('conditions' => array('Group.user_id' => $this->getUserId())));

		$mygroups_id = array();

		foreach($myGroups as $g):
			array_push($mygroups_id, array('Evokation.group_id' => $g['Group']['id']));
		endforeach;

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
		} else {
			$myevokations = array();
		}

		$this->loadModel('GroupsUser');
		$users_groups = $this->GroupsUser->find('all');

		$this->set(compact('user','groups', 'myGroups', 'mission', 'evokations', 'myevokations', 'groupsIBelong', 'users_groups', 'sumMyPoints', 'quest_id'));
		
	}

/**
 * evokations method
 *
 * @return void
 */
	public function evokations() {

		$user = $this->Group->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$missions = $this->Group->Phase->Mission->find('all');

		$groups = $this->Group->find('all');

		$evokations = $this->Group->Evokation->find('all');

		$myGroups = $this->Group->find('all', array('conditions' => array('Group.user_id' => $this->getUserId())));

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

		$this->set(compact('missionIssues', 'myevokations', 'evokations', 'groups', 'user', 'myGroups', 'missions', 'users_groups'));
		
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

		//$groups = $this->Group->find('all', array('conditions' => array('Group.mission_id' => $mission_id)));

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
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}

		$user = $this->Auth->user();

		//GROUP
		$group_array = $this->Group->find('first', array(
			'conditions' => array('Group.id' => $id),
			'contain' => array(
				'Leader',
				'Member',
				'Phase' => 'Mission'
			)
		));

		//Separating array for layout variables
		$group = $group_array['Group'];
		$members = $group_array['Member'];
		$groupOwner = $group_array['Leader'];
		$groupMission = $group_array['Phase']['Mission'];

		//MEMBERSHIP
		$group['is_owner'] = $this->Group->isOwner($id, $user['id']);
		$group['is_member'] = $this->Group->isMember($id, $user['id']);

		//GROUP REQUESTS
		$groupsRequestsPending = $this->Group->GroupRequest->find('all', array('conditions' => array('GroupRequest.group_id' => $id, 'GroupRequest.status = 0')));

		$groupsRequests = $this->Group->GroupRequest->find('all', array('conditions' => array('GroupRequest.group_id' => $id, 'GroupRequest.status' => array(1, 2))));

		//Variables
		$this->set(compact('user', 'group', 'groupOwner', 'members', 'groupMission', 'groupsRequests', 'groupsRequestsPending'));
	}

/**
 * Receive group data via post and creates it in the database
 *
 * @return redirect to view the group created
 */
public function addGroup() {
	if ($this->request->is('post')) {
		$this->Group->create();
		if ($this->Group->save($this->request->data)) {

			$me = $this->Group->find('first', array(
				'conditions' => array(
					'Group.id' => $this->Group->id
				)
			));

			//GROUP USER
			$insert_group_user['GroupsUser']['user_id'] = $this->getUserId();
			$insert_group_user['GroupsUser']['group_id'] = $this->Group->id;

			//add owner to groupsusers
			$this->Group->GroupsUser->create();
			$this->Group->GroupsUser->save($insert_group_user);


			//EVOKATION
			$insert_evokation['Evokation']['group_id'] = $this->Group->id;
			$this->Group->Evokation->create();
			$this->Group->Evokation->save($insert_evokation);


			//CREATES RELATED FORUM
			$forum_id = $this->Group->addRelatedForum($me['Group']['id']);


			//CREATES BRAINSTORM AND ASSOCIATIONS FOR ALL PHASE QUESTS
			$phase = $this->Group->Phase->find('first', array(
				'conditions' => array('id' => $me['Group']['phase_id']),
				'contain' => 'Quest'
			));

			//All the quests in the phase
			foreach ($phase['Quest'] as $key => $quest) {
				//Create brainstorm
				$this->loadModel('BrainstormSession.Brainstorm');
				$this->Brainstorm->create();
				$insertData = array('user_id' => $me['Group']['user_id']);
				$this->Brainstorm->save($insertData);

				$brainstorm_id = $this->Brainstorm->id;

				//Create brainstorm association with the two models
				$this->Brainstorm->BrainstormAssociation->create();
				$insertData = array(
					array(
						'brainstorm_id' => $brainstorm_id,
						'model' => 'Group',
						'foreign_id' => $me['Group']['id']
					),
					array(
						'brainstorm_id' => $brainstorm_id,
						'model' => 'Quest',
						'foreign_id' => $quest['id']
					)
				);
				$this->Brainstorm->BrainstormAssociation->saveAll($insertData);
			}

			//RENDER VIEW (OR NOT)
			if ($this->request->is('ajax')) {
				$this->autoRender = false;

				return json_encode(array(
					'group_id' => $me['Group']['id'],
					'mission_id' => $phase['Phase']['mission_id'],
					'phase_id' => $phase['Phase']['id'],
					'forum_id' => $forum_id
				));
			}
			$this->Session->setFlash(__('The group has been saved.'), 'flash_message');
			return $this->redirect(array('action' => 'view', $this->Group->id));
		}
	}

	if ($this->request->is('ajax')) {
		$this->autoRender = false;
		return false;
	}
	$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
}

/**
 * Renders add view (form to add a group)
 * The group is associated with a given quest, and with the currently logged in user
 *
 * @param int $quest_id Id of the quest it will be associated to
 * @return void
 */
	public function add($quest_id = null) {
		if (($quest_id == null) && isset($this->request->data['Group']['quest_id'])) {
			throw new NotFoundException(__('Invalid quest'));
		}

		//QUEST ID
		if ($quest_id == null) {
			$quest_id = $this->request->data['Group']['quest_id'];
		}
		
		//MISSION
		$quest = $this->Group->Quest->findById($quest_id);
		$mission_id = $quest['Quest']['mission_id'];
		$phase_id = $quest['Quest']['phase_id'];

		$user_id = $this->getUserId();
		$this->set(compact('user_id', 'mission_id', 'phase_id', 'quest_id'));

		//AJAX RENDERS ELEMENT DIRECTLY
		if ($this->request->is('post')) {
			$this->layout = 'ajax';
			$this->render('/Elements/Groups/add_group');
		}
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

		if(!$this->isOwner($me, $id) && !$this->isMember($me, $id)) {
			$this->Session->setFlash(__('Only group members are allowed to edit it.'));
			return $this->redirect($this->referer());
		}

		$this->loadModel('Attachment');
		$group_img = $this->Attachment->find('first', array(
			'order' => array(
				'Attachment.id DESC'
			),
			'conditions' => array(
				'Attachment.model' => 'Group',
				'Attachment.foreign_key' => $id
			)
		));

		$group = $this->Group->find('first', array('conditions' => array('Group.' . $this->Group->primaryKey => $id)));
		

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Group->createWithAttachments($this->request->data, true, $id)) {
				$this->Session->setFlash(__('The group has been saved.'));
				return $this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
				return $this->redirect(array('action' => 'view', $id));
			}
		}
		
		$this->set(compact('users', 'group', 'group_img'));
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
		$group = $this->Group->find('first', array(
			'conditions' => array(
				'Group.id' => $id
			)
		));

		if ($this->Group->delete()) {


			//attribute pp to evidence owner
			$this->loadModel('QuestPowerPoint');
			$pps = $this->QuestPowerPoint->find('all', array(
				'conditions' => array(
					'quest_id' => $group['Group']['quest_id']
				)
			));

			foreach($pps as $pp){
				$this->loadModel('UserPowerPoint');
				$old = $this->UserPowerPoint->find('first', array(
					'conditions' => array(
						'user_id' => $group['Group']['user_id'],
						'power_points_id' => $pp['QuestPowerPoint']['power_points_id'],
						'quest_id' => $pp['QuestPowerPoint']['quest_id'],
						'quantity' => ($pp['QuestPowerPoint']['quantity'] * 30),
						'model' => 'Group',
						'foreign_key' => $group['Group']['id']
					)
				));

				if(!empty($old)) {
					$this->UserPowerPoint->id = $old['UserPowerPoint']['id'];
					$this->UserPowerPoint->delete();
				}
			}

			$this->Session->setFlash(__('The group has been deleted.'));
		} else {
			$this->Session->setFlash(__('The group could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


	public function createProject($group_id = null){
		if(!$group_id)
			$this->redirect($this->referer());
		
		
		$group = $this->Group->find('first', array(
			'conditions' => array(
				'Group.id' => $group_id
			)
		));

		if(empty($group))
			$this->redirect($this->referer());


		if($this->isMember($this->getUserId(), $group_id) || $this->isOwner($this->getUserId(), $group_id)) {

			$insertData['Evokation']['title'] = $group['Group']['title'] . "'s Evokation";
			$insertData['Evokation']['group_id'] = $group_id;

			$this->loadModel('Evokation');
			$this->Evokation->create();
			$this->Evokation->save($insertData);

			$this->redirect(array('controller' => 'groupsUsers', 'action' => 'edit', $group_id));
		} else {
			$this->redirect($this->referer());
		}

	}

	public function isMember($user_id = null, $id = null){
		if(!$user_id || !$id) return false;
		$this->loadModel('GroupsUser');
		$users = $this->GroupsUser->find('all', array(
			'contain' => 'User',
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
	// public function admin_index() {
	// 	$this->Group->recursive = 0;
	// 	$this->set('groups', $this->Paginator->paginate());
	// }

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
	}
}
