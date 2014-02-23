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

		$user_data = $this->Auth->user();
		$user = $this->Evidence->User->find('first', array('conditions' => array('User.id' => $user_data['id'])));

		$evidence = $this->Evidence->find('first', array('conditions' => array('Evidence.' . $this->Evidence->primaryKey => $id)));
		$comment = $this->Evidence->Comment->find('all', array('conditions' => array('Comment.evidence_id' => $id)));
		$vote = $this->Evidence->Vote->find('first', array('conditions' => array('Vote.evidence_id' => $id, 'Vote.user_id' => $user_data['id'])));
		$this->set(compact('user', 'evidence', 'comment', 'vote'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($mission_id, $phase_id) {
		
		$user_data = $this->getUserData();

		//$user_data = $this->Auth->user();

		$user = $this->Evidence->User->find('first', array('conditions' => array('User.id' => $user_data['id'])));

		$insertData = array('user_id' => $user_data['id'], 'mission_id' => $mission_id, 'phase_id' => $phase_id); 

		$this->Evidence->create();
		if ($this->Evidence->save($insertData)) {
			$this->Session->setFlash(__('The evidence has been saved.'));
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

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Evidence->save($this->request->data)) {
				$this->Session->setFlash(__('The evidence has been saved.'));
				return $this->redirect(array('action' => 'view', $this->Evidence->id));
			} else {
				$this->Session->setFlash(__('The evidence could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Evidence.' . $this->Evidence->primaryKey => $id));
			$this->request->data = $this->Evidence->find('first', $options);
		}

		$user_data = $this->Auth->user();
		$user = $this->Evidence->User->find('first', array('conditions' => array('User.id' => $user_data['id'])));
		$users = $this->Evidence->User->find('list');
		$quests = $this->Evidence->Quest->find('list');
		$missions = $this->Evidence->Mission->find('list');
		$phases = $this->Evidence->Phase->find('list');
		$this->set(compact('user', 'users', 'quests', 'missions', 'phases'));
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
	}}
