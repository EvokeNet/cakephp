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
 * index method
 *
 * @return void
 */
	public function index() {
		$this->EvidenceTag->recursive = 0;
		$this->set('evidenceTags', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EvidenceTag->exists($id)) {
			throw new NotFoundException(__('Invalid evidence tag'));
		}
		$options = array('conditions' => array('EvidenceTag.' . $this->EvidenceTag->primaryKey => $id));
		$this->set('evidenceTag', $this->EvidenceTag->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EvidenceTag->create();
			if ($this->EvidenceTag->save($this->request->data)) {
				$this->Session->setFlash(__('The evidence tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evidence tag could not be saved. Please, try again.'));
			}
		}
		$evidences = $this->EvidenceTag->Evidence->find('list');
		$tags = $this->EvidenceTag->Tag->find('list');
		$this->set(compact('evidences', 'tags'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
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
		$evidences = $this->EvidenceTag->Evidence->find('list');
		$tags = $this->EvidenceTag->Tag->find('list');
		$this->set(compact('evidences', 'tags'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
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
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->EvidenceTag->recursive = 0;
		$this->set('evidenceTags', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->EvidenceTag->exists($id)) {
			throw new NotFoundException(__('Invalid evidence tag'));
		}
		$options = array('conditions' => array('EvidenceTag.' . $this->EvidenceTag->primaryKey => $id));
		$this->set('evidenceTag', $this->EvidenceTag->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->EvidenceTag->create();
			if ($this->EvidenceTag->save($this->request->data)) {
				$this->Session->setFlash(__('The evidence tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evidence tag could not be saved. Please, try again.'));
			}
		}
		$evidences = $this->EvidenceTag->Evidence->find('list');
		$tags = $this->EvidenceTag->Tag->find('list');
		$this->set(compact('evidences', 'tags'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
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
		$evidences = $this->EvidenceTag->Evidence->find('list');
		$tags = $this->EvidenceTag->Tag->find('list');
		$this->set(compact('evidences', 'tags'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
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
	}}
