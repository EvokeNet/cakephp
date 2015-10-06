<?php
App::uses('AppController', 'Controller');
/**
 * Questionnaires Controller
 *
 * @property Questionnaire $Questionnaire
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class QuestionnairesController extends AppController {

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
			$this->Questionnaire->create();
			if ($this->Questionnaire->save($this->request->data)) {
				$this->Session->setFlash(__('The questionnaire has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The questionnaire could not be saved. Please, try again.'));
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

		if (!$this->Questionnaire->exists($id)) {
			throw new NotFoundException(__('Invalid questionnaire'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Questionnaire->save($this->request->data)) {
				$this->Session->setFlash(__('The questionnaire has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The questionnaire could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Questionnaire.' . $this->Questionnaire->primaryKey => $id));
			$this->request->data = $this->Questionnaire->find('first', $options);
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

		$this->Questionnaire->id = $id;
		if (!$this->Questionnaire->exists()) {
			throw new NotFoundException(__('Invalid questionnaire'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Questionnaire->delete()) {
			$this->Session->setFlash(__('The questionnaire has been deleted.'));
		} else {
			$this->Session->setFlash(__('The questionnaire could not be deleted. Please, try again.'));
		}
	}
}
