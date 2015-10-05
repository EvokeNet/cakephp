<?php
App::uses('AppController', 'Controller');
/**
 * Points Controller
 *
 * @property Point $Point
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PointsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->autoRender = false;

		if ($this->request->is('post')) {
			$this->Point->create();
			if ($this->Point->save($this->request->data)) {
				$this->Session->setFlash(__('The point has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The point could not be saved. Please, try again.'));
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
		$this->autoRender = false;

		if (!$this->Point->exists($id)) {
			throw new NotFoundException(__('Invalid point'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Point->save($this->request->data)) {
				$this->Session->setFlash(__('The point has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The point could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Point.' . $this->Point->primaryKey => $id));
			$this->request->data = $this->Point->find('first', $options);
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
		$this->autoRender = false;

		$this->Point->id = $id;
		if (!$this->Point->exists()) {
			throw new NotFoundException(__('Invalid point'));
		}

		if ($this->Point->delete()) {
			$this->Session->setFlash(__('The point has been deleted.'));
		} else {
			$this->Session->setFlash(__('The point could not be deleted. Please, try again.'));
		}
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->autoRender = false;

		if ($this->request->is('post')) {
			$this->Point->create();
			if ($this->Point->save($this->request->data)) {
				$this->Session->setFlash(__('The point has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The point could not be saved. Please, try again.'));
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

		if (!$this->Point->exists($id)) {
			throw new NotFoundException(__('Invalid point'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Point->save($this->request->data)) {
				$this->Session->setFlash(__('The point has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The point could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Point.' . $this->Point->primaryKey => $id));
			$this->request->data = $this->Point->find('first', $options);
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

		$this->Point->id = $id;
		if (!$this->Point->exists()) {
			throw new NotFoundException(__('Invalid point'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Point->delete()) {
			$this->Session->setFlash(__('The point has been deleted.'));
		} else {
			$this->Session->setFlash(__('The point could not be deleted. Please, try again.'));
		}
	}
}
