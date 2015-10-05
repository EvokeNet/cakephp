<?php
App::uses('AppController', 'Controller');
/**
 * EvokationTags Controller
 *
 * @property EvokationTag $EvokationTag
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EvokationTagsController extends AppController {

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
			$this->EvokationTag->create();
			if ($this->EvokationTag->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation tag could not be saved. Please, try again.'));
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
		if (!$this->EvokationTag->exists($id)) {
			throw new NotFoundException(__('Invalid evokation tag'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EvokationTag->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation tag could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EvokationTag.' . $this->EvokationTag->primaryKey => $id));
			$this->request->data = $this->EvokationTag->find('first', $options);
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
		$this->EvokationTag->id = $id;
		if (!$this->EvokationTag->exists()) {
			throw new NotFoundException(__('Invalid evokation tag'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->EvokationTag->delete()) {
			$this->Session->setFlash(__('The evokation tag has been deleted.'));
		} else {
			$this->Session->setFlash(__('The evokation tag could not be deleted. Please, try again.'));
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
			$this->EvokationTag->create();
			if ($this->EvokationTag->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation tag could not be saved. Please, try again.'));
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
		if (!$this->EvokationTag->exists($id)) {
			throw new NotFoundException(__('Invalid evokation tag'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EvokationTag->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation tag could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EvokationTag.' . $this->EvokationTag->primaryKey => $id));
			$this->request->data = $this->EvokationTag->find('first', $options);
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
		$this->EvokationTag->id = $id;
		if (!$this->EvokationTag->exists()) {
			throw new NotFoundException(__('Invalid evokation tag'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->EvokationTag->delete()) {
			$this->Session->setFlash(__('The evokation tag has been deleted.'));
		} else {
			$this->Session->setFlash(__('The evokation tag could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
