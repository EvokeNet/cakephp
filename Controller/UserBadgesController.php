<?php
App::uses('AppController', 'Controller');
/**
 * UserBadges Controller
 *
 * @property UserBadge $UserBadge
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserBadgesController extends AppController {

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
			$this->UserBadge->create();
			if ($this->UserBadge->save($this->request->data)) {
				$this->Session->setFlash(__('The user badge has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user badge could not be saved. Please, try again.'));
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

		if (!$this->UserBadge->exists($id)) {
			throw new NotFoundException(__('Invalid user badge'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserBadge->save($this->request->data)) {
				$this->Session->setFlash(__('The user badge has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user badge could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserBadge.' . $this->UserBadge->primaryKey => $id));
			$this->request->data = $this->UserBadge->find('first', $options);
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

		$this->UserBadge->id = $id;
		if (!$this->UserBadge->exists()) {
			throw new NotFoundException(__('Invalid user badge'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UserBadge->delete()) {
			$this->Session->setFlash(__('The user badge has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user badge could not be deleted. Please, try again.'));
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
			$this->UserBadge->create();
			if ($this->UserBadge->save($this->request->data)) {
				$this->Session->setFlash(__('The user badge has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user badge could not be saved. Please, try again.'));
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

		if (!$this->UserBadge->exists($id)) {
			throw new NotFoundException(__('Invalid user badge'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserBadge->save($this->request->data)) {
				$this->Session->setFlash(__('The user badge has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user badge could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserBadge.' . $this->UserBadge->primaryKey => $id));
			$this->request->data = $this->UserBadge->find('first', $options);
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

		$this->UserBadge->id = $id;
		if (!$this->UserBadge->exists()) {
			throw new NotFoundException(__('Invalid user badge'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UserBadge->delete()) {
			$this->Session->setFlash(__('The user badge has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user badge could not be deleted. Please, try again.'));
		}
	}
}
