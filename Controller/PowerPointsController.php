<?php
App::uses('AppController', 'Controller');
/**
 * PowerPoints Controller
 *
 * @property PowerPoint $PowerPoint
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PowerPointsController extends AppController {

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
		$this->PowerPoint->recursive = 0;
		$this->set('powerPoints', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PowerPoint->exists($id)) {
			throw new NotFoundException(__('Invalid power point'));
		}
		$options = array('conditions' => array('PowerPoint.' . $this->PowerPoint->primaryKey => $id));
		$this->set('powerPoint', $this->PowerPoint->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PowerPoint->create();
			if ($this->PowerPoint->save($this->request->data)) {
				$this->Session->setFlash(__('The power point has been saved.'));
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The power point could not be saved. Please, try again.'));
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
		if (!$this->PowerPoint->exists($id)) {
			throw new NotFoundException(__('Invalid power point'));
		}
		$this->PowerPoint->id = $id;
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PowerPoint->save($this->request->data)) {
				$this->Session->setFlash(__('The power point has been saved.'));
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The power point could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PowerPoint.' . $this->PowerPoint->primaryKey => $id));
			$this->request->data = $this->PowerPoint->find('first', $options);
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
		$this->PowerPoint->id = $id;
		if (!$this->PowerPoint->exists()) {
			throw new NotFoundException(__('Invalid power point'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->PowerPoint->delete()) {
			$this->Session->setFlash(__('The power point has been deleted.'));
		} else {
			$this->Session->setFlash(__('The power point could not be deleted. Please, try again.'));
		}
		return $this->redirect($this->referer());
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->PowerPoint->recursive = 0;
		$this->set('powerPoints', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->PowerPoint->exists($id)) {
			throw new NotFoundException(__('Invalid power point'));
		}
		$options = array('conditions' => array('PowerPoint.' . $this->PowerPoint->primaryKey => $id));
		$this->set('powerPoint', $this->PowerPoint->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->PowerPoint->create();
			if ($this->PowerPoint->save($this->request->data)) {
				$this->Session->setFlash(__('The power point has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The power point could not be saved. Please, try again.'));
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
		if (!$this->PowerPoint->exists($id)) {
			throw new NotFoundException(__('Invalid power point'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PowerPoint->save($this->request->data)) {
				$this->Session->setFlash(__('The power point has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The power point could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PowerPoint.' . $this->PowerPoint->primaryKey => $id));
			$this->request->data = $this->PowerPoint->find('first', $options);
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
		$this->PowerPoint->id = $id;
		if (!$this->PowerPoint->exists()) {
			throw new NotFoundException(__('Invalid power point'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->PowerPoint->delete()) {
			$this->Session->setFlash(__('The power point has been deleted.'));
		} else {
			$this->Session->setFlash(__('The power point could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
