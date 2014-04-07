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
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Like->recursive = 0;
		$this->set('likes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Like->exists($id)) {
			throw new NotFoundException(__('Invalid like'));
		}
		$options = array('conditions' => array('Like.' . $this->Like->primaryKey => $id));
		$this->set('like', $this->Like->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function like($evidence_id = null) {
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

		if(empty($like)) {
			$this->Like->create();
			if ($this->Like->save($data)) {
				//$this->Session->setFlash(__('The like has been saved.'));
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The like could not be saved. Please, try again.'));
			}
		} else {
			$this->Like->id = $like['Like']['id'];
			if ($this->Like->delete()) {
				//$this->Session->setFlash(__('The like has been deleted.'));
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The like could not be deleted. Please, try again.'));
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
		$evidences = $this->Like->Evidence->find('list');
		$users = $this->Like->User->find('list');
		$this->set(compact('evidences', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
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
		return $this->redirect(array('action' => 'index'));
	}}
