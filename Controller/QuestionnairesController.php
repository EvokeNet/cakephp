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
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Questionnaire->recursive = 0;
		$this->set('questionnaires', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Questionnaire->exists($id)) {
			throw new NotFoundException(__('Invalid questionnaire'));
		}
		$options = array('conditions' => array('Questionnaire.' . $this->Questionnaire->primaryKey => $id));
		$this->set('questionnaire', $this->Questionnaire->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Questionnaire->create();
			if ($this->Questionnaire->save($this->request->data)) {
				$this->Session->setFlash(__('The questionnaire has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The questionnaire could not be saved. Please, try again.'));
			}
		}
		$quests = $this->Questionnaire->Quest->find('list');
		$this->set(compact('quests'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
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
		$quests = $this->Questionnaire->Quest->find('list');
		$this->set(compact('quests'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
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
		return $this->redirect(array('action' => 'index'));
	}}
