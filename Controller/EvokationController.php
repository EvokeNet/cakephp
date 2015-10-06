<?php
App::uses('AppController', 'Controller');

/**
 * Evokations Controller
 *
 * @property Evokation $Evokation
 * @property PaginatorComponent $Paginator
 */
class EvokationController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	
	public function beforeFilter() {
        parent::beforeFilter();
    }

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$this->Evokation->create();
			if ($this->Evokation->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation could not be saved. Please, try again.'));
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
		if (!$this->Evokation->exists($id)) {
			throw new NotFoundException(__('Invalid evokation'));
		}
		$this->request->data['id'] = $id;
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Evokation->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation has been saved.'));
				if($this->request->is('ajax')){
					$this->autoRender = false;
					return true;
				}
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Evokation.' . $this->Evokation->primaryKey => $id));
			$this->request->data = $this->Evokation->find('first', $options);
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
		$this->Evokation->id = $id;
		if (!$this->Evokation->exists()) {
			throw new NotFoundException(__('Invalid evokation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Evokation->delete()) {
			$this->Session->setFlash(__('The evokation has been deleted.'));
		} else {
			$this->Session->setFlash(__('The evokation could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$this->Evokation->create();
			if ($this->Evokation->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation could not be saved. Please, try again.'));
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
		if (!$this->Evokation->exists($id)) {
			throw new NotFoundException(__('Invalid evokation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Evokation->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Evokation.' . $this->Evokation->primaryKey => $id));
			$this->request->data = $this->Evokation->find('first', $options);
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
		$this->Evokation->id = $id;
		if (!$this->Evokation->exists()) {
			throw new NotFoundException(__('Invalid evokation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Evokation->delete()) {
			$this->Session->setFlash(__('The evokation has been deleted.'));
		} else {
			$this->Session->setFlash(__('The evokation could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
