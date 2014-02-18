<?php
App::uses('AppController', 'Controller');
/**
 * Votes Controller
 *
 * @property Vote $Vote
 * @property PaginatorComponent $Paginator
 */
class VotesController extends AppController {

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
		$this->Vote->recursive = 0;
		$this->set('votes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Vote->exists($id)) {
			throw new NotFoundException(__('Invalid vote'));
		}
		$options = array('conditions' => array('Vote.' . $this->Vote->primaryKey => $id));
		$this->set('vote', $this->Vote->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($evidence_id = null) {
		if ($this->request->is('post')) {
			$this->Vote->create();
			if ($this->Vote->save($this->request->data)) {
				$this->Session->setFlash(__('The vote has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vote could not be saved. Please, try again.'));
			}
		}
		$evidences = $this->Vote->Evidence->find('list');
		$users = $this->Vote->User->find('list');
		$this->set(compact('evidences', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Vote->exists($id)) {
			throw new NotFoundException(__('Invalid vote'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Vote->save($this->request->data)) {
				$this->Session->setFlash(__('The vote has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vote could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Vote.' . $this->Vote->primaryKey => $id));
			$this->request->data = $this->Vote->find('first', $options);
		}
		$evidences = $this->Vote->Evidence->find('list');
		$users = $this->Vote->User->find('list');
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
		$this->Vote->id = $id;
		if (!$this->Vote->exists()) {
			throw new NotFoundException(__('Invalid vote'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Vote->delete()) {
			$this->Session->setFlash(__('The vote has been deleted.'));
		} else {
			$this->Session->setFlash(__('The vote could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Vote->recursive = 0;
		$this->set('votes', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Vote->exists($id)) {
			throw new NotFoundException(__('Invalid vote'));
		}
		$options = array('conditions' => array('Vote.' . $this->Vote->primaryKey => $id));
		$this->set('vote', $this->Vote->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Vote->create();
			if ($this->Vote->save($this->request->data)) {
				$this->Session->setFlash(__('The vote has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vote could not be saved. Please, try again.'));
			}
		}
		$evidences = $this->Vote->Evidence->find('list');
		$users = $this->Vote->User->find('list');
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
		if (!$this->Vote->exists($id)) {
			throw new NotFoundException(__('Invalid vote'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Vote->save($this->request->data)) {
				$this->Session->setFlash(__('The vote has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vote could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Vote.' . $this->Vote->primaryKey => $id));
			$this->request->data = $this->Vote->find('first', $options);
		}
		$evidences = $this->Vote->Evidence->find('list');
		$users = $this->Vote->User->find('list');
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
		$this->Vote->id = $id;
		if (!$this->Vote->exists()) {
			throw new NotFoundException(__('Invalid vote'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Vote->delete()) {
			$this->Session->setFlash(__('The vote has been deleted.'));
		} else {
			$this->Session->setFlash(__('The vote could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
