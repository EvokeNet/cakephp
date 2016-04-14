<?php
App::uses('AppController', 'Controller');
/**
 * Levels Controller
 *
 * @property Level $Level
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class LevelsController extends AppController {

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
		$this->Level->recursive = 0;
		$this->set('levels', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Level->exists($id)) {
			throw new NotFoundException(__('Invalid level'));
		}
		$options = array('conditions' => array('Level.' . $this->Level->primaryKey => $id));
		$this->set('level', $this->Level->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Level->create();
			if ($this->Level->save($this->request->data)) {
				$this->Session->setFlash(__('The level has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The level could not be saved. Please, try again.'));
			}
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
		if (!$this->Level->exists($id)) {
			throw new NotFoundException(__('Invalid level'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Level->save($this->request->data)) {
				$this->Session->setFlash(__('The level has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The level could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Level.' . $this->Level->primaryKey => $id));
			$this->request->data = $this->Level->find('first', $options);
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
		$this->Level->id = $id;
		if (!$this->Level->exists()) {
			throw new NotFoundException(__('Invalid level'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Level->delete()) {
			$this->Session->setFlash(__('The level has been deleted.'));
		} else {
			$this->Session->setFlash(__('The level could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Level->recursive = 0;
		$this->set('levels', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Level->exists($id)) {
			throw new NotFoundException(__('Invalid level'));
		}
		$options = array('conditions' => array('Level.' . $this->Level->primaryKey => $id));
		$this->set('level', $this->Level->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Level->create();
			if ($this->Level->save($this->request->data)) {
				$this->Session->setFlash(__('The level has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The level could not be saved. Please, try again.'));
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
		if (!$this->Level->exists($id)) {
			throw new NotFoundException(__('Invalid level'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Level->save($this->request->data)) {
				$this->Session->setFlash(__('The level has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The level could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Level.' . $this->Level->primaryKey => $id));
			$this->request->data = $this->Level->find('first', $options);
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
		$this->Level->id = $id;
		if (!$this->Level->exists()) {
			throw new NotFoundException(__('Invalid level'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Level->delete()) {
			$this->Session->setFlash(__('The level has been deleted.'));
		} else {
			$this->Session->setFlash(__('The level could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
