<?php
App::uses('AppController', 'Controller');
/**
 * ForumTopics Controller
 *
 * @property ForumTopic $ForumTopic
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ForumTopicsController extends AppController {

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
		$this->ForumTopic->recursive = 0;
		$this->set('forumTopics', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ForumTopic->exists($id)) {
			throw new NotFoundException(__('Invalid forum topic'));
		}
		$options = array('conditions' => array('ForumTopic.' . $this->ForumTopic->primaryKey => $id));

		//FORUM POSTS
		$this->loadModel('ForumPost');
		$alias = $this->ForumPost->alias;

		//CUSTOM PAGINATOR FOR FORUM TOPICS
		$this->paginate = array(
			'fields' => array(
				'id',
				'title',
				'content',
				'User.id',
				'User.name',
				'created'
			),
			'joins' => array(
				array(
					'table' => 'forum_topics',
					'alias' => 'ForumTopic',
					'type' => 'INNER',
					'conditions' => array(
						'ForumPost.forum_topic_id = ForumTopic.id'
					),
				),
				array(
					'table' => 'users',
					'alias' => 'User',
					'type' => 'INNER',
					'conditions' => array(
						'ForumPost.user_id = User.id'
					),
				),
			),
			'conditions' => array(
				'ForumTopic.forum_categorie_id ='.$id
			),
			'order' => array(
				'created' => 'asc'
			)

		);

		$forumPosts = $this->paginate($alias);

		// SET VARIABLES
		$this->set('forumPosts', $forumPosts);
		$this->set('forumTopic', $this->ForumTopic->find('first', $options));

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ForumTopic->create();
			if ($this->ForumTopic->save($this->request->data)) {
				$this->Session->setFlash(__('The forum topic has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum topic could not be saved. Please, try again.'));
			}
		}
		$users = $this->ForumTopic->User->find('list');
		$forumCategories = $this->ForumTopic->ForumCategorie->find('list');
		$this->set(compact('users', 'forumCategories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ForumTopic->exists($id)) {
			throw new NotFoundException(__('Invalid forum topic'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ForumTopic->save($this->request->data)) {
				$this->Session->setFlash(__('The forum topic has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum topic could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ForumTopic.' . $this->ForumTopic->primaryKey => $id));
			$this->request->data = $this->ForumTopic->find('first', $options);
		}
		$users = $this->ForumTopic->User->find('list');
		$forumCategories = $this->ForumTopic->ForumCategorie->find('list');
		$this->set(compact('users', 'forumCategories'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ForumTopic->id = $id;
		if (!$this->ForumTopic->exists()) {
			throw new NotFoundException(__('Invalid forum topic'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ForumTopic->delete()) {
			$this->Session->setFlash(__('The forum topic has been deleted.'));
		} else {
			$this->Session->setFlash(__('The forum topic could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ForumTopic->recursive = 0;
		$this->set('forumTopics', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ForumTopic->exists($id)) {
			throw new NotFoundException(__('Invalid forum topic'));
		}
		$options = array('conditions' => array('ForumTopic.' . $this->ForumTopic->primaryKey => $id));
		$this->set('forumTopic', $this->ForumTopic->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ForumTopic->create();
			if ($this->ForumTopic->save($this->request->data)) {
				$this->Session->setFlash(__('The forum topic has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum topic could not be saved. Please, try again.'));
			}
		}
		$users = $this->ForumTopic->User->find('list');
		$forumCategories = $this->ForumTopic->ForumCategorie->find('list');
		$this->set(compact('users', 'forumCategories'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ForumTopic->exists($id)) {
			throw new NotFoundException(__('Invalid forum topic'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ForumTopic->save($this->request->data)) {
				$this->Session->setFlash(__('The forum topic has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum topic could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ForumTopic.' . $this->ForumTopic->primaryKey => $id));
			$this->request->data = $this->ForumTopic->find('first', $options);
		}
		$users = $this->ForumTopic->User->find('list');
		$forumCategories = $this->ForumTopic->ForumCategorie->find('list');
		$this->set(compact('users', 'forumCategories'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ForumTopic->id = $id;
		if (!$this->ForumTopic->exists()) {
			throw new NotFoundException(__('Invalid forum topic'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ForumTopic->delete()) {
			$this->Session->setFlash(__('The forum topic has been deleted.'));
		} else {
			$this->Session->setFlash(__('The forum topic could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
