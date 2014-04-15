<?php
App::uses('AppController', 'Controller');
/**
 * Likes Controller
 *
 * @property Like $Like
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class LikesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Like->recursive = 0;
		$this->set('likes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Like->exists($id)) {
			throw new NotFoundException(__('Invalid like'));
		}
		$options = array('conditions' => array('Like.' . $this->Like->primaryKey => $id));
		$this->set('like', $this->Like->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	// public function add() {
	// 	if ($this->request->is('post')) {
	// 		$this->Like->create();
	// 		if ($this->Like->save($this->request->data)) {
	// 			$this->Session->setFlash(__('The like has been saved.'));
	// 			return $this->redirect(array('action' => 'index'));
	// 		} else {
	// 			$this->Session->setFlash(__('The like could not be saved. Please, try again.'));
	// 		}
	// 	}
	// 	$evidences = $this->Like->Evidence->find('list');
	// 	$users = $this->Like->User->find('list');
	// 	$this->set(compact('evidences', 'users'));
	// }

	public function add($evidence_id = null) {
		if(!$evidence_id) {
			return $this->redirect($this->referer());
		}

		$this->loadModel('Evidence');
		$evidence = $this->Evidence->find('first', array('conditions' => array('Evidence.id' => $evidence_id)));
		
		if(empty($evidence)){
			return $this->redirect($this->referer());
		}

		$data['Like']['evidence_id'] = $evidence_id;
		$data['Like']['user_id'] = $this->getUserId();

		$like = $this->Like->find('first', array('conditions' => array('Like.evidence_id' => $evidence_id, 'Like.user_id' => $this->getUserId())));

		$this->Like->create();
		if ($this->Like->save($data)) {

			//attribute pp to evidence owner
			$this->loadModel('QuestPowerPoint');
			$pp = $this->QuestPowerPoint->find('first', array(
				'conditions' => array(
					'quest_id' => $evidence['Evidence']['quest_id']
				)
			));

			if(!empty($pp)) {
				$data['UserPowerPoint']['user_id'] = $evidence['Evidence']['user_id'];
				$data['UserPowerPoint']['power_points_id'] = $pp['QuestPowerPoint']['power_points_id'];
				$data['UserPowerPoint']['quest_id'] = $pp['QuestPowerPoint']['quest_id'];
				$data['UserPowerPoint']['quantity'] = $pp['QuestPowerPoint']['quantity'];
				$data['UserPowerPoint']['model'] = 'Evidence';
				$data['UserPowerPoint']['foreign_key'] = $evidence['Evidence']['id'];

				$this->loadModel('UserPowerPoint');
				$this->UserPowerPoint->create();
				$this->UserPowerPoint->save($data);

			}

			$this->Session->setFlash(__('Your like was computed'), 'flash_message');
			
			return $this->redirect($this->referer());
		} else {
			$this->Session->setFlash(__('The like could not be saved. Please, try again.'));
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
		if (!$this->Like->exists($id)) {
			throw new NotFoundException(__('Invalid like'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Like->save($this->request->data)) {
				$this->Session->setFlash(__('The like has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The like could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Like.' . $this->Like->primaryKey => $id));
			$this->request->data = $this->Like->find('first', $options);
		}
		$evidences = $this->Like->Evidence->find('list');
		$users = $this->Like->User->find('list');
		$this->set(compact('evidences', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Like->id = $id;

		if (!$this->Like->exists()) {
			throw new NotFoundException(__('Invalid like'));
		}

		$like = $this->Like->find('first', array('conditions' => array('Like.id' => $id)));

		$this->loadModel('Evidence');
		$evidence = $this->Evidence->find('first', array('conditions' => array('Evidence.id' => $like['Like']['evidence_id'])));
		if(empty($evidence)){
			return $this->redirect($this->referer());
		}

		if ($this->Like->delete()) {

			//attribute pp to evidence owner
			$this->loadModel('QuestPowerPoint');
			$pp = $this->QuestPowerPoint->find('first', array(
				'conditions' => array(
					'quest_id' => $evidence['Evidence']['quest_id']
				)
			));

			if(!empty($pp)) {
				
				$this->loadModel('UserPowerPoint');
				$old = $this->UserPowerPoint->find('first', array(
					'conditions' => array(
						'user_id' => $evidence['Evidence']['user_id'],
						'power_points_id' => $pp['QuestPowerPoint']['power_points_id'],
						'quest_id' => $pp['QuestPowerPoint']['quest_id'],
						'quantity' => $pp['QuestPowerPoint']['quantity'],
						'model' => 'Evidence',
						'foreign_key' => $evidence['Evidence']['id']
					)
				));

				if(!empty($old)) {
					$this->UserPowerPoint->id = $old['UserPowerPoint']['id'];
					$this->UserPowerPoint->delete();
				}
			}

			//$this->Session->setFlash(__('The like has been deleted.'));
		} else {
			//$this->Session->setFlash(__('The like could not be deleted. Please, try again.'));
		}

		return $this->redirect(array('controller' => 'evidences', 'action' => 'view', $like['Like']['evidence_id']));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Like->recursive = 0;
		$this->set('likes', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Like->exists($id)) {
			throw new NotFoundException(__('Invalid like'));
		}
		$options = array('conditions' => array('Like.' . $this->Like->primaryKey => $id));
		$this->set('like', $this->Like->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Like->create();
			if ($this->Like->save($this->request->data)) {
				$this->Session->setFlash(__('The like has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The like could not be saved. Please, try again.'));
			}
		}
		$evidences = $this->Like->Evidence->find('list');
		$users = $this->Like->User->find('list');
		$this->set(compact('evidences', 'users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Like->exists($id)) {
			throw new NotFoundException(__('Invalid like'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Like->save($this->request->data)) {
				$this->Session->setFlash(__('The like has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The like could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Like.' . $this->Like->primaryKey => $id));
			$this->request->data = $this->Like->find('first', $options);
		}
		$evidences = $this->Like->Evidence->find('list');
		$users = $this->Like->User->find('list');
		$this->set(compact('evidences', 'users'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Like->id = $id;
		if (!$this->Like->exists()) {
			throw new NotFoundException(__('Invalid like'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Like->delete()) {
			$this->Session->setFlash(__('The like has been deleted.'));
		} else {
			$this->Session->setFlash(__('The like could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
