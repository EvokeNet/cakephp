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
 * add method
 *
 * @return void
 */
	public function add() {
		$this->autoRender = false;

		if ($this->request->is('post')) {
			$this->MatchingQuestion->create();
			if ($this->MatchingQuestion->save($this->request->data)) {
				$this->Session->setFlash(__('The matching question has been saved.'));
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
		$this->autoRender = false;

		if (!$this->MatchingQuestion->exists($id)) {
			throw new NotFoundException(__('Invalid matching question'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MatchingQuestion->save($this->request->data)) {
				$this->Session->setFlash(__('The matching question has been saved.'));
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
		$this->autoRender = false;

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
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->autoRender = false;

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
		$this->autoRender = false;

		if (!$this->MatchingQuestion->exists($id)) {
			throw new NotFoundException(__('Invalid matching question'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MatchingQuestion->save($this->request->data)) {
				$this->Session->setFlash(__('The matching question has been saved.'));
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
		$this->autoRender = false;

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
	}
}
