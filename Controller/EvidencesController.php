<?php
App::uses('AppController', 'Controller');
/**
 * Evidences Controller
 *
 * @property Evidence $Evidence
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EvidencesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public $user = null;

	public $helpers = array('Media.Media');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Evidence->recursive = 0;
		$this->set('evidences', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Evidence->exists($id)) {
			throw new NotFoundException(__('Invalid evidence'));
		}

		$user = $this->Evidence->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$evidence = $this->Evidence->find('first', array('conditions' => array('Evidence.' . $this->Evidence->primaryKey => $id)));
		$comment = $this->Evidence->Comment->find('all', array('conditions' => array('Comment.evidence_id' => $id)));
		$like = $this->Evidence->Like->find('first', array('conditions' => array('Like.evidence_id' => $id, 'Like.user_id' => $this->getUserId())));
		$likes = $this->Evidence->Like->find('all', array('conditions' => array('Like.evidence_id' => $id)));
		$this->set(compact('user', 'evidence', 'comment', 'like', 'likes'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($mission_id, $phase_id, $quest_id = null, $evokation = false) {
		if(!$quest_id) {
			$this->$redirect($this->referer());
		}
		//checking if quest exists..
		$this->loadModel('Quest');
		$quest = $this->Quest->find('first', array(
			'conditions' => array(
				'Quest.id' => $quest_id
			)
		));

		if(empty($quest)) {
			$this->$redirect($this->referer());
		}

		$user = $this->Evidence->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));


		$insertData = array('user_id' => $this->getUserId(), 'mission_id' => $mission_id, 'phase_id' => $phase_id, 'quest_id' => $quest_id); 

		if($evokation) $insertData['evokation'] = '1';
		else $insertData['evokation'] = '0';

		$this->Evidence->create();
		if ($this->Evidence->save($insertData)) {
			$this->Session->setFlash(__('The evidence has been saved.'));
			
			//user has completed a quest, so if he doesnt exist in 'usersmissions', add him now!
			$this->loadModel('UserMission');
			$is_in = $this->UserMission->find('first', array('conditions' => array('UserMission.user_id' => $this->getUserId(), 'UserMission.mission_id' => $mission_id)));
			if(empty($is_in)) {
				$this->UserMission->create();
				$data['UserMission']['user_id'] = $this->getUserId();
				$data['UserMission']['mission_id'] = $mission_id;

				if ($this->UserMission->save($data)) {
					$this->Session->setFlash(__('The user mission has been saved.'));
				} else {
					$this->Session->setFlash(__('The user mission could not be saved. Please, try again.'));
				}
			}
			return $this->redirect(array('action' => 'edit', $this->Evidence->id));
		} else {
			$this->Session->setFlash(__('The evidence could not be saved. Please, try again.'));
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
		if (!$this->Evidence->exists($id)) {
			throw new NotFoundException(__('Invalid evidence'));
		}
		$me = $this->Evidence->find('first', array('conditions' => array('Evidence.id' => $id)));

		if($me['Evidence']['user_id'] != $this->getUserId()) {
			//debug($me);
			$this->Session->setFlash(__('You have no permission to edit an evidence that does not belong to you.'));
			$this->redirect($this->referer());
		}

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Evidence->createWithAttachments($this->request->data, true, $id)) {
				
				//check to see if there are img/files that are no loner to be related to the quest...
				if(isset($this->request->data['Attachment']['Old'])) {
					$this->destroyAttachments($this->request->data['Attachment']['Old']);
				}

				$this->Session->setFlash(__('The evidence has been saved.'));
				return $this->redirect(array('controller' => 'missions', 'action' => 'view', $me['Evidence']['mission_id'], 0 , $me['Evidence']['phase_id']));
			} else {
				$this->Session->setFlash(__('The evidence could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Evidence.' . $this->Evidence->primaryKey => $id));
			$this->request->data = $this->Evidence->find('first', $options);
		}


		$user = $this->Evidence->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$users = $this->Evidence->User->find('list');
		$quests = $this->Evidence->Quest->find('list');
		$missions = $this->Evidence->Mission->find('list');
		$phases = $this->Evidence->Phase->find('list');

		$this->loadModel('Attachment');
		$attachments = $this->Attachment->find('all', array(
			'conditions' => array(
				'Attachment.foreign_key' => $me['Evidence']['id'],
				'Attachment.model' => 'Evidence'
			)
		));

		$this->set(compact('user', 'users', 'quests', 'missions', 'phases', 'attachments'));
	}

	public function destroyAttachments($data){
		//iterate received array and check if attachment is meant to desapear
		foreach ($data as $d) {
			if(!strpos($d['id'], 'NO-')) {
				//good to go, lets erase it..
				$this->loadModel('Attachment');
				$this->Attachment->id = $d['id'];
				$a['Attachment']['model'] = null;
				$a['Attachment']['foreign_key'] = null;
				if ($this->Attachment->save($a)) {
					$this->Session->setFlash(__('The attachment has been deleted.'));
				} else {
					$this->Session->setFlash(__('The attachment could not be deleted. Please, try again.'));
				}
			}
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
		$this->Evidence->id = $id;
		if (!$this->Evidence->exists()) {
			throw new NotFoundException(__('Invalid evidence'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Evidence->delete()) {
			$this->Session->setFlash(__('The evidence has been deleted.'));
		} else {
			$this->Session->setFlash(__('The evidence could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Evidence->recursive = 0;
		$this->set('evidences', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Evidence->exists($id)) {
			throw new NotFoundException(__('Invalid evidence'));
		}
		$options = array('conditions' => array('Evidence.' . $this->Evidence->primaryKey => $id));
		$this->set('evidence', $this->Evidence->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Evidence->create();
			if ($this->Evidence->save($this->request->data)) {
				$this->Session->setFlash(__('The evidence has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evidence could not be saved. Please, try again.'));
			}
		}
		$users = $this->Evidence->User->find('list');
		$quests = $this->Evidence->Quest->find('list');
		$missions = $this->Evidence->Mission->find('list');
		$phases = $this->Evidence->Phase->find('list');
		$this->set(compact('users', 'quests', 'missions', 'phases'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Evidence->exists($id)) {
			throw new NotFoundException(__('Invalid evidence'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Evidence->save($this->request->data)) {
				$this->Session->setFlash(__('The evidence has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evidence could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Evidence.' . $this->Evidence->primaryKey => $id));
			$this->request->data = $this->Evidence->find('first', $options);
		}
		$users = $this->Evidence->User->find('list');
		$quests = $this->Evidence->Quest->find('list');
		$missions = $this->Evidence->Mission->find('list');
		$phases = $this->Evidence->Phase->find('list');
		$this->set(compact('users', 'quests', 'missions', 'phases'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Evidence->id = $id;
		if (!$this->Evidence->exists()) {
			throw new NotFoundException(__('Invalid evidence'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Evidence->delete()) {
			$this->Session->setFlash(__('The evidence has been deleted.'));
		} else {
			$this->Session->setFlash(__('The evidence could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}