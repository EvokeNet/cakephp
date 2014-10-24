<?php
App::uses('AppController', 'Controller');
/**
 * MatchingQuestions Controller
 *
 * @property MatchingQuestion $MatchingQuestion
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MatchingQuestionsController extends AppController {

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
		$this->MatchingQuestion->recursive = 0;
		$this->set('matchingQuestions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MatchingQuestion->exists($id)) {
			throw new NotFoundException(__('Invalid matching question'));
		}
		$options = array('conditions' => array('MatchingQuestion.' . $this->MatchingQuestion->primaryKey => $id));
		$this->set('matchingQuestion', $this->MatchingQuestion->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MatchingQuestion->create();
			if ($this->MatchingQuestion->save($this->request->data)) {
				$this->Session->setFlash(__('The matching question has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The matching question could not be saved. Please, try again.'));
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
		if (!$this->MatchingQuestion->exists($id)) {
			throw new NotFoundException(__('Invalid matching question'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MatchingQuestion->save($this->request->data)) {
				$this->Session->setFlash(__('The matching question has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The matching question could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MatchingQuestion.' . $this->MatchingQuestion->primaryKey => $id));
			$this->request->data = $this->MatchingQuestion->find('first', $options);
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
		$this->MatchingQuestion->id = $id;
		if (!$this->MatchingQuestion->exists()) {
			throw new NotFoundException(__('Invalid matching question'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->MatchingQuestion->delete()) {
			$this->Session->setFlash(__('The matching question has been deleted.'));
		} else {
			$this->Session->setFlash(__('The matching question could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->MatchingQuestion->recursive = 0;
		$this->set('matchingQuestions', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->MatchingQuestion->exists($id)) {
			throw new NotFoundException(__('Invalid matching question'));
		}
		$options = array('conditions' => array('MatchingQuestion.' . $this->MatchingQuestion->primaryKey => $id));
		$this->set('matchingQuestion', $this->MatchingQuestion->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->MatchingQuestion->create();
			if ($this->MatchingQuestion->save($this->request->data)) {
				$this->Session->setFlash(__('The matching question has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The matching question could not be saved. Please, try again.'));
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
		if (!$this->MatchingQuestion->exists($id)) {
			throw new NotFoundException(__('Invalid matching question'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MatchingQuestion->save($this->request->data)) {
				$this->Session->setFlash(__('The matching question has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The matching question could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MatchingQuestion.' . $this->MatchingQuestion->primaryKey => $id));
			$this->request->data = $this->MatchingQuestion->find('first', $options);
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
		$this->MatchingQuestion->id = $id;
		if (!$this->MatchingQuestion->exists()) {
			throw new NotFoundException(__('Invalid matching question'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->MatchingQuestion->delete()) {
			$this->Session->setFlash(__('The matching question has been deleted.'));
		} else {
			$this->Session->setFlash(__('The matching question could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
