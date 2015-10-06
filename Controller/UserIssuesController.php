<?php
App::uses('AppController', 'Controller');
/**
 * UserIssues Controller
 *
 * @property UserIssue $UserIssue
 * @property PaginatorComponent $Paginator
 */
class UserIssuesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->autoRender = false;

		$id = null;
		if ($this->request->is('post', 'put')) {
			$status = false;
			$id = $this->request->data['UserIssue']['user_id'];
			if(isset($this->request->data['UserIssue']) && is_array($this->request->data['UserIssue']['issue_id'])) {
				foreach ($this->request->data['UserIssue']['issue_id'] as $a) {	  
			        $insert = array('user_id' => $this->request->data['UserIssue']['user_id'], 'issue_id' => $a);

			        $exists = $this->UserIssue->find('first', array('conditions' => array('UserIssue.user_id' => $this->request->data['UserIssue']['user_id'], 'UserIssue.issue_id' => $a)));
			        if(!$exists) $this->UserIssue->save($insert);
			    }
			}

	        $this->Session->setFlash(__('The user issue has been saved.'));
		    return $this->redirect(array('controller' => 'users', 'action' => 'matching_results', $id));
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

		if (!$this->UserIssue->exists($id)) {
			throw new NotFoundException(__('Invalid user issue'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserIssue->save($this->request->data)) {
				$this->Session->setFlash(__('The user issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user issue could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserIssue.' . $this->UserIssue->primaryKey => $id));
			$this->request->data = $this->UserIssue->find('first', $options);
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

		$this->UserIssue->id = $id;
		if (!$this->UserIssue->exists()) {
			throw new NotFoundException(__('Invalid user issue'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserIssue->delete()) {
			$this->Session->setFlash(__('The user issue has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user issue could not be deleted. Please, try again.'));
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
			$this->UserIssue->create();
			if ($this->UserIssue->save($this->request->data)) {
				$this->Session->setFlash(__('The user issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user issue could not be saved. Please, try again.'));
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

		if (!$this->UserIssue->exists($id)) {
			throw new NotFoundException(__('Invalid user issue'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserIssue->save($this->request->data)) {
				$this->Session->setFlash(__('The user issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user issue could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserIssue.' . $this->UserIssue->primaryKey => $id));
			$this->request->data = $this->UserIssue->find('first', $options);
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

		$this->UserIssue->id = $id;
		if (!$this->UserIssue->exists()) {
			throw new NotFoundException(__('Invalid user issue'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserIssue->delete()) {
			$this->Session->setFlash(__('The user issue has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user issue could not be deleted. Please, try again.'));
		}
	}
}
