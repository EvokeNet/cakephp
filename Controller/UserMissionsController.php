<?php
App::uses('AppController', 'Controller');
/**
 * UserMissions Controller
 *
 * @property UserMission $UserMission
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserMissionsController extends AppController {

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
			$this->UserMission->create();
			if ($this->UserMission->save($this->request->data)) {
				$this->Session->setFlash(__('The user mission has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user mission could not be saved. Please, try again.'));
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

		if (!$this->UserMission->exists($id)) {
			throw new NotFoundException(__('Invalid user mission'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserMission->save($this->request->data)) {
				$this->Session->setFlash(__('The user mission has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user mission could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserMission.' . $this->UserMission->primaryKey => $id));
			$this->request->data = $this->UserMission->find('first', $options);
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

		$this->UserMission->id = $id;
		if (!$this->UserMission->exists()) {
			throw new NotFoundException(__('Invalid user mission'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserMission->delete()) {
			$this->Session->setFlash(__('The user mission has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user mission could not be deleted. Please, try again.'));
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
			$this->UserMission->create();
			if ($this->UserMission->save($this->request->data)) {
				$this->Session->setFlash(__('The user mission has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user mission could not be saved. Please, try again.'));
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

		if (!$this->UserMission->exists($id)) {
			throw new NotFoundException(__('Invalid user mission'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserMission->save($this->request->data)) {
				$this->Session->setFlash(__('The user mission has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user mission could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserMission.' . $this->UserMission->primaryKey => $id));
			$this->request->data = $this->UserMission->find('first', $options);
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

		$this->UserMission->id = $id;
		if (!$this->UserMission->exists()) {
			throw new NotFoundException(__('Invalid user mission'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserMission->delete()) {
			$this->Session->setFlash(__('The user mission has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user mission could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
