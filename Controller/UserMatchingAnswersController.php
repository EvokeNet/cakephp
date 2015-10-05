<?php
App::uses('AppController', 'Controller');
/**
 * UserMatchingAnswers Controller
 *
 * @property UserMatchingAnswer $UserMatchingAnswer
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserMatchingAnswersController extends AppController {

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

		if ($this->request->is('post', 'put')) {
			$counter = 0;
			$check = null;
			foreach($this->request->data['UserMatchingAnswer']['matching_answer'] as $key => $u):
				$insert['UserMatchingAnswer']['user_id'] = $this->request->data['UserMatchingAnswer']['user_id'];
				$insert['UserMatchingAnswer']['matching_question_id'] = $this->request->data['UserMatchingAnswer']['matching_question_id'][$counter];
				$insert['UserMatchingAnswer']['matching_answer'] = $u;
				$this->UserMatchingAnswer->create();
				$this->UserMatchingAnswer->save($insert);

				$counter++;
			endforeach;
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

		if (!$this->UserMatchingAnswer->exists($id)) {
			throw new NotFoundException(__('Invalid user matching answer'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserMatchingAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The user matching answer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user matching answer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserMatchingAnswer.' . $this->UserMatchingAnswer->primaryKey => $id));
			$this->request->data = $this->UserMatchingAnswer->find('first', $options);
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

		$this->UserMatchingAnswer->id = $id;
		if (!$this->UserMatchingAnswer->exists()) {
			throw new NotFoundException(__('Invalid user matching answer'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UserMatchingAnswer->delete()) {
			$this->Session->setFlash(__('The user matching answer has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user matching answer could not be deleted. Please, try again.'));
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
			$this->UserMatchingAnswer->create();
			if ($this->UserMatchingAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The user matching answer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user matching answer could not be saved. Please, try again.'));
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

		if (!$this->UserMatchingAnswer->exists($id)) {
			throw new NotFoundException(__('Invalid user matching answer'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserMatchingAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The user matching answer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user matching answer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserMatchingAnswer.' . $this->UserMatchingAnswer->primaryKey => $id));
			$this->request->data = $this->UserMatchingAnswer->find('first', $options);
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

		$this->UserMatchingAnswer->id = $id;
		if (!$this->UserMatchingAnswer->exists()) {
			throw new NotFoundException(__('Invalid user matching answer'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UserMatchingAnswer->delete()) {
			$this->Session->setFlash(__('The user matching answer has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user matching answer could not be deleted. Please, try again.'));
		}
	}
}
