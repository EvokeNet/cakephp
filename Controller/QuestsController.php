<?php
App::uses('AppController', 'Controller');
/**
 * Quests Controller
 *
 * @property Quest $Quest
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class QuestsController extends AppController {

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
		$this->Quest->recursive = 0;
		$this->set('quests', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Quest->exists($id)) {
			throw new NotFoundException(__('Invalid quest'));
		}
		$options = array('conditions' => array('Quest.' . $this->Quest->primaryKey => $id));
		$this->set('quest', $this->Quest->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Quest->create();
			if ($this->Quest->save($this->request->data)) {
				$this->Session->setFlash(__('The quest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quest could not be saved. Please, try again.'));
			}
		}
		$missions = $this->Quest->Mission->find('list');
		$phases = $this->Quest->Phase->find('list');
		$this->set(compact('missions', 'phases'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Quest->exists($id)) {
			throw new NotFoundException(__('Invalid quest'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Quest->save($this->request->data)) {
				$this->Session->setFlash(__('The quest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quest could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Quest.' . $this->Quest->primaryKey => $id));
			$this->request->data = $this->Quest->find('first', $options);
		}
		$missions = $this->Quest->Mission->find('list');
		$phases = $this->Quest->Phase->find('list');
		$this->set(compact('missions', 'phases'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Quest->id = $id;
		if (!$this->Quest->exists()) {
			throw new NotFoundException(__('Invalid quest'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Quest->delete()) {
			$this->Session->setFlash(__('The quest has been deleted.'));
		} else {
			$this->Session->setFlash(__('The quest could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Quest->recursive = 0;
		$this->set('quests', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Quest->exists($id)) {
			throw new NotFoundException(__('Invalid quest'));
		}
		$options = array('conditions' => array('Quest.' . $this->Quest->primaryKey => $id));
		$this->set('quest', $this->Quest->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Quest->create();
			if ($this->Quest->save($this->request->data)) {
				$this->Session->setFlash(__('The quest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quest could not be saved. Please, try again.'));
			}
		}
		$missions = $this->Quest->Mission->find('list');
		$phases = $this->Quest->Phase->find('list');
		$this->set(compact('missions', 'phases'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Quest->exists($id)) {
			throw new NotFoundException(__('Invalid quest'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Quest->save($this->request->data)) {
				$this->Session->setFlash(__('The quest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quest could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Quest.' . $this->Quest->primaryKey => $id));
			$this->request->data = $this->Quest->find('first', $options);
		}
		$missions = $this->Quest->Mission->find('list');
		$phases = $this->Quest->Phase->find('list');
		$this->set(compact('missions', 'phases'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Quest->id = $id;
		if (!$this->Quest->exists()) {
			throw new NotFoundException(__('Invalid quest'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Quest->delete()) {
			$this->Session->setFlash(__('The quest has been deleted.'));
		} else {
			$this->Session->setFlash(__('The quest could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
