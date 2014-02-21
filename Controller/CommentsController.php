<?php
App::uses('AppController', 'Controller');
/**
 * Comments Controller
 *
 * @property Comment $Comment
 * @property PaginatorComponent $Paginator
 */
class CommentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Comment->recursive = 0;
		$this->set('comments', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {

		if (!$this->Comment->exists($id)) {
			throw new NotFoundException(__('Invalid comment'));
		}
		$options = array('conditions' => array('Comment.' . $this->Comment->primaryKey => $id));
		$this->set('comment', $this->Comment->find('first', $options));

	// 	$array = $this->Comment->find('first', $options);

	// 	$array = Set::extract('/0/Comment', $array);
	// 	pr($array);

	// 	$field_names = array_keys($array[0]['Comment']);
	// 	pr($field_names);

	// 	$ops = $this->Comment->bindModel(array
 //        (
 //            'belongsTo' => array
 //            (
 //                'User' => array
 //                (
 //                    'foreignKey' => false,
 //                    'conditions' => array
 //                    (
 //                        'User.id = Comment.user_id'
 //                    )
 //                )
 //            )
 //        ));

	// 	var_dump($this->Comment->user_id);

 //        debug($this->Comment->User->find('all',array('contain'=>'User.id = Comment.user_id')));

	// 	$com = $this->set('comment', $this->Comment->find('first', $options));
	// 	$option=array(             
 //        'joins' =>
	// 			array(
	// 			array(
	// 			    'table' => 'comments',
	// 			    'alias' => 'Comment',
	// 			    'type' => 'inner',
	// 			    'conditions'=> array("CommentUser.id = Comment.user_id")
	// 			),
	// 			array(
	// 			    'table' => 'users',
	// 			    'alias' => 'CommentUser',
	// 			    'type' => 'inner',
	// 			    'conditions'=> array("CommentUser.id = Comment.user_id")
	// 			),           
	// 	     )  
	// 	);

	// 	debug($this->Comment->User->find('all', $option));

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Comment->create();
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(__('The comment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
			}
		}
		$evidences = $this->Comment->Evidence->find('list');
		$users = $this->Comment->User->find('list');
		$this->set(compact('evidences', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Comment->exists($id)) {
			throw new NotFoundException(__('Invalid comment'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(__('The comment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Comment.' . $this->Comment->primaryKey => $id));
			$this->request->data = $this->Comment->find('first', $options);
		}
		$evidences = $this->Comment->Evidence->find('list');
		$users = $this->Comment->User->find('list');
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
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid comment'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Comment->delete()) {
			$this->Session->setFlash(__('The comment has been deleted.'));
		} else {
			$this->Session->setFlash(__('The comment could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * get user by id method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function getUserById($id = null) {
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid comment'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Comment->delete()) {
			$this->Session->setFlash(__('The comment has been deleted.'));
		} else {
			$this->Session->setFlash(__('The comment could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));

	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Comment->recursive = 0;
		$this->set('comments', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Comment->exists($id)) {
			throw new NotFoundException(__('Invalid comment'));
		}
		$options = array('conditions' => array('Comment.' . $this->Comment->primaryKey => $id));
		$this->set('comment', $this->Comment->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Comment->create();
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(__('The comment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
			}
		}
		$evidences = $this->Comment->Evidence->find('list');
		$users = $this->Comment->User->find('list');
		$this->set(compact('evidences', 'users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Comment->exists($id)) {
			throw new NotFoundException(__('Invalid comment'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(__('The comment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Comment.' . $this->Comment->primaryKey => $id));
			$this->request->data = $this->Comment->find('first', $options);
		}
		$evidences = $this->Comment->Evidence->find('list');
		$users = $this->Comment->User->find('list');
		$this->set(compact('evidences', 'users'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid comment'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Comment->delete()) {
			$this->Session->setFlash(__('The comment has been deleted.'));
		} else {
			$this->Session->setFlash(__('The comment could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
