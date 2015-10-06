<?php
App::uses('AppController', 'Controller');
/**
 * EvidenceTags Controller
 *
 * @property EvidenceTag $EvidenceTag
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EvidenceTagsController extends AppController {

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
			$this->EvidenceTag->create();
			if ($this->EvidenceTag->save($this->request->data)) {
				$this->Session->setFlash(__('The evidence tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evidence tag could not be saved. Please, try again.'));
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
		if (!$this->EvidenceTag->exists($id)) {
			throw new NotFoundException(__('Invalid evidence tag'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EvidenceTag->save($this->request->data)) {
				$this->Session->setFlash(__('The evidence tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evidence tag could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EvidenceTag.' . $this->EvidenceTag->primaryKey => $id));
			$this->request->data = $this->EvidenceTag->find('first', $options);
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
		$this->EvidenceTag->id = $id;
		if (!$this->EvidenceTag->exists()) {
			throw new NotFoundException(__('Invalid evidence tag'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->EvidenceTag->delete()) {
			$this->Session->setFlash(__('The evidence tag has been deleted.'));
		} else {
			$this->Session->setFlash(__('The evidence tag could not be deleted. Please, try again.'));
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
			$this->EvidenceTag->create();
			if ($this->EvidenceTag->save($this->request->data)) {
				$this->Session->setFlash(__('The evidence tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evidence tag could not be saved. Please, try again.'));
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
		if (!$this->EvidenceTag->exists($id)) {
			throw new NotFoundException(__('Invalid evidence tag'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EvidenceTag->save($this->request->data)) {
				$this->Session->setFlash(__('The evidence tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evidence tag could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EvidenceTag.' . $this->EvidenceTag->primaryKey => $id));
			$this->request->data = $this->EvidenceTag->find('first', $options);
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
		$this->EvidenceTag->id = $id;
		if (!$this->EvidenceTag->exists()) {
			throw new NotFoundException(__('Invalid evidence tag'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->EvidenceTag->delete()) {
			$this->Session->setFlash(__('The evidence tag has been deleted.'));
		} else {
			$this->Session->setFlash(__('The evidence tag could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
