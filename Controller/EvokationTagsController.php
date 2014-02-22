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
 * index method
 *
 * @return void
 */
	public function index() {
		$this->EvokationTag->recursive = 0;
		$this->set('evokationTags', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EvokationTag->exists($id)) {
			throw new NotFoundException(__('Invalid evokation tag'));
		}
		$options = array('conditions' => array('EvokationTag.' . $this->EvokationTag->primaryKey => $id));
		$this->set('evokationTag', $this->EvokationTag->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EvokationTag->create();
			if ($this->EvokationTag->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation tag could not be saved. Please, try again.'));
			}
		}
		$evokations = $this->EvokationTag->Evokation->find('list');
		$tags = $this->EvokationTag->Tag->find('list');
		$this->set(compact('evokations', 'tags'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
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
		$evokations = $this->EvokationTag->Evokation->find('list');
		$tags = $this->EvokationTag->Tag->find('list');
		$this->set(compact('evokations', 'tags'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
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
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->EvokationTag->recursive = 0;
		$this->set('evokationTags', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->EvokationTag->exists($id)) {
			throw new NotFoundException(__('Invalid evokation tag'));
		}
		$options = array('conditions' => array('EvokationTag.' . $this->EvokationTag->primaryKey => $id));
		$this->set('evokationTag', $this->EvokationTag->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->EvokationTag->create();
			if ($this->EvokationTag->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation tag could not be saved. Please, try again.'));
			}
		}
		$evokations = $this->EvokationTag->Evokation->find('list');
		$tags = $this->EvokationTag->Tag->find('list');
		$this->set(compact('evokations', 'tags'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
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
		$evokations = $this->EvokationTag->Evokation->find('list');
		$tags = $this->EvokationTag->Tag->find('list');
		$this->set(compact('evokations', 'tags'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
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
	}}
