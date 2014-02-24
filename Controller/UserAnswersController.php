<?php
App::uses('AppController', 'Controller');
/**
 * UserAnswers Controller
 *
 * @property UserAnswer $UserAnswer
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserAnswersController extends AppController {

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
		$this->UserAnswer->recursive = 0;
		$this->set('userAnswers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserAnswer->exists($id)) {
			throw new NotFoundException(__('Invalid user answer'));
		}
		$options = array('conditions' => array('UserAnswer.' . $this->UserAnswer->primaryKey => $id));
		$this->set('userAnswer', $this->UserAnswer->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			debug($this->request->data);
			/*foreach ($this->request->data['UserAnswer'] as $data) {
				if(isset($data['description'])){
					//its an essay
				}
			}

			$this->UserAnswer->create();
			if ($this->UserAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The user answer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user answer could not be saved. Please, try again.'));
			}*/
		}
		$users = $this->UserAnswer->User->find('list');
		$questions = $this->UserAnswer->Question->find('list');
		$answers = $this->UserAnswer->Answer->find('list');
		$this->set(compact('users', 'questions', 'answers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserAnswer->exists($id)) {
			throw new NotFoundException(__('Invalid user answer'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The user answer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user answer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserAnswer.' . $this->UserAnswer->primaryKey => $id));
			$this->request->data = $this->UserAnswer->find('first', $options);
		}
		$users = $this->UserAnswer->User->find('list');
		$questions = $this->UserAnswer->Question->find('list');
		$answers = $this->UserAnswer->Answer->find('list');
		$this->set(compact('users', 'questions', 'answers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserAnswer->id = $id;
		if (!$this->UserAnswer->exists()) {
			throw new NotFoundException(__('Invalid user answer'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserAnswer->delete()) {
			$this->Session->setFlash(__('The user answer has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user answer could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
