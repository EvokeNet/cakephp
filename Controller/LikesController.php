<?php
App::uses('AppController', 'Controller');
/**
 * Likes Controller
 *
 * @property Like $Like
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class LikesController extends AppController {

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
	public function add($evidence_id = null) {
		$this->autoRender = false;

		if(!$evidence_id) {
			return $this->redirect($this->referer());
		}

		$this->loadModel('Evidence');
		$evidence = $this->Evidence->find('first', array('conditions' => array('Evidence.id' => $evidence_id)));
		
		if(empty($evidence)){
			return $this->redirect($this->referer());
		}

		$data['Like']['evidence_id'] = $evidence_id;
		$data['Like']['user_id'] = $this->getUserId();

		$like = $this->Like->find('first', array('conditions' => array('Like.evidence_id' => $evidence_id, 'Like.user_id' => $this->getUserId())));

		$this->Like->create();
		if ($this->Like->save($data)) {
			//AJAX LOAD
			if ($this->request->is('ajax')) {
				return true;
			}

			//NOT AJAX
			$this->Session->setFlash(__('Your like was computed'));
			return $this->redirect(array(
				'header' => $this->request->header, //Use the same header
				$this->referer()
			));
		} else {
			//AJAX LOAD
			if ($this->request->is('ajax')) {
				return false;
			}

			//NOT AJAX
			$this->Session->setFlash(__('The like could not be saved. Please, try again.'));
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

		if (!$this->Like->exists($id)) {
			throw new NotFoundException(__('Invalid like'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Like->save($this->request->data)) {
				$this->Session->setFlash(__('The like has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The like could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Like.' . $this->Like->primaryKey => $id));
			$this->request->data = $this->Like->find('first', $options);
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

		$this->Like->id = $id;

		if (!$this->Like->exists()) {
			throw new NotFoundException(__('Invalid like'));
		}

		$like = $this->Like->find('first', array('conditions' => array('Like.id' => $id)));

		$this->loadModel('Evidence');
		$evidence = $this->Evidence->find('first', array('conditions' => array('Evidence.id' => $like['Like']['evidence_id'])));
		if(empty($evidence)){
			return $this->redirect($this->referer());
		}

		if ($this->Like->delete()) {
			//$this->Session->setFlash(__('The like has been deleted.'));
		} else {
			//$this->Session->setFlash(__('The like could not be deleted. Please, try again.'));
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
			$this->Like->create();
			if ($this->Like->save($this->request->data)) {
				$this->Session->setFlash(__('The like has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The like could not be saved. Please, try again.'));
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

		if (!$this->Like->exists($id)) {
			throw new NotFoundException(__('Invalid like'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Like->save($this->request->data)) {
				$this->Session->setFlash(__('The like has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The like could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Like.' . $this->Like->primaryKey => $id));
			$this->request->data = $this->Like->find('first', $options);
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

		$this->Like->id = $id;
		if (!$this->Like->exists()) {
			throw new NotFoundException(__('Invalid like'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Like->delete()) {
			$this->Session->setFlash(__('The like has been deleted.'));
		} else {
			$this->Session->setFlash(__('The like could not be deleted. Please, try again.'));
		}
	}
}
