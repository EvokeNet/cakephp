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
 * add method
 *
 * @return void
 */
	public function add() {
		$this->autoRender = false;

		if ($this->request->is('post')) {
			$this->Vote->create();
			if ($this->Vote->save($this->request->data)) {
				$this->Session->setFlash(__('The vote has been saved.'));
				//return $this->redirect(array('controller' => 'evokations', 'action' => 'view', $this->request->data['Vote']['evokation_id']));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The vote could not be saved. Please, try again.'));
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

		if (!$this->Vote->exists($id)) {
			throw new NotFoundException(__('Invalid vote'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Vote->save($this->request->data)) {
				$this->Session->setFlash(__('The vote has been saved.'));
				//return $this->redirect(array('controller' => 'evokations', 'action' => 'view', $this->request->data['Vote']['evokation_id']));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The vote could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Vote.' . $this->Vote->primaryKey => $id));
			$this->request->data = $this->Vote->find('first', $options);
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
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->autoRender = false;

		if ($this->request->is('post')) {
			$this->Vote->create();
			if ($this->Vote->save($this->request->data)) {
				$this->Session->setFlash(__('The vote has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vote could not be saved. Please, try again.'));
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
	}
}
