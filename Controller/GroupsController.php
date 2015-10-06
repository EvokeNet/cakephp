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
				'GroupRequestsPending' => 'User',
				'GroupRequestsDone' => 'User',
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
		$group['GroupRequestsPending'] = $group_array['GroupRequestsPending'];
		$group['GroupRequestsDone'] = $group_array['GroupRequestsDone'];

		//Variables
		$this->set(compact('user', 'group', 'groupOwner', 'members', 'groupMission'));
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

			$this->loadModel('GroupQuestStatus');
			$this->GroupQuestStatus->initQuests($me['Group']['id'], $phase['Phase']['mission_id']);

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
		debug("IF4");
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
			$this->Session->setFlash(__('The group has been deleted.'));
		} else {
			$this->Session->setFlash(__('The group could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$this->Group->create();
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
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
