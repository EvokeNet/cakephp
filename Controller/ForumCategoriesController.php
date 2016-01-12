<?php
App::uses('AppController', 'Controller');
/**
 * ForumCategories Controller
 *
 * @property ForumCategory $ForumCategory
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ForumCategoriesController extends AppController {

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
		$this->ForumCategory->recursive = 0;
		$this->set('forumCategories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ForumCategory->exists($id)) {
			throw new NotFoundException(__('Invalid forum category'));
		}

		$options = array('conditions' => array('ForumCategory.' . $this->ForumCategory->primaryKey => $id));

		// FORUM CATEGORY
		$forumCategory = $this->ForumCategory->find('first', $options);

		//FORUM TOPICS
		$this->loadModel('ForumTopic');
		$alias = $this->ForumTopic->alias;

		//CUSTOM PAGINATOR FOR FORUM TOPICS
		$this->paginate = array(
			'fields' => array(
				'id',
				'title',
				'COUNT(ForumPost.id) `answers`',
				'view_count',
				'user_id',
				'User.name',
				'created'
			),
			'joins' => array(
				array(
					'table' => 'forum_posts',
					'alias' => 'ForumPost',
					'type' => 'LEFT',
					'conditions' => array(
						'ForumPost.forum_topic_id = ForumTopic.id'
					),
				),	
				array(
					'table' => 'users',
					'alias' => 'User',
					'type' => 'LEFT',
					'conditions' => array(
						'User.id = ForumTopic.user_id'
					)
				),
			),
			'conditions' => array(
				'ForumTopic.forum_categorie_id ='.$forumCategory['ForumCategory']['id']
			),
			'order' => array(
				'answers' => 'desc'
			),
			'group' => array(
				'ForumTopic.id'
			)

		);

		$forumTopics = $this->paginate($alias);

		// SET VARIABLES
		$this->set('forumCategory', $forumCategory);
		$this->set('forumTopics', $forumTopics);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ForumCategory->create();
			if ($this->ForumCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The forum category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum category could not be saved. Please, try again.'));
			}
		}
		$users = $this->ForumCategory->User->find('list');
		$forums = $this->ForumCategory->Forum->find('list');
		$this->set(compact('users', 'forums'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ForumCategory->exists($id)) {
			throw new NotFoundException(__('Invalid forum category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ForumCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The forum category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ForumCategory.' . $this->ForumCategory->primaryKey => $id));
			$this->request->data = $this->ForumCategory->find('first', $options);
		}
		$users = $this->ForumCategory->User->find('list');
		$forums = $this->ForumCategory->Forum->find('list');
		$this->set(compact('users', 'forums'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ForumCategory->id = $id;
		if (!$this->ForumCategory->exists()) {
			throw new NotFoundException(__('Invalid forum category'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ForumCategory->delete()) {
			$this->Session->setFlash(__('The forum category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The forum category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ForumCategory->recursive = 0;
		$this->set('forumCategories', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ForumCategory->exists($id)) {
			throw new NotFoundException(__('Invalid forum category'));
		}
		$options = array('conditions' => array('ForumCategory.' . $this->ForumCategory->primaryKey => $id));
		$this->set('forumCategory', $this->ForumCategory->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ForumCategory->create();
			if ($this->ForumCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The forum category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum category could not be saved. Please, try again.'));
			}
		}
		$users = $this->ForumCategory->User->find('list');
		$forums = $this->ForumCategory->Forum->find('list');
		$this->set(compact('users', 'forums'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ForumCategory->exists($id)) {
			throw new NotFoundException(__('Invalid forum category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ForumCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The forum category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ForumCategory.' . $this->ForumCategory->primaryKey => $id));
			$this->request->data = $this->ForumCategory->find('first', $options);
		}
		$users = $this->ForumCategory->User->find('list');
		$forums = $this->ForumCategory->Forum->find('list');
		$this->set(compact('users', 'forums'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ForumCategory->id = $id;
		if (!$this->ForumCategory->exists()) {
			throw new NotFoundException(__('Invalid forum category'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ForumCategory->delete()) {
			$this->Session->setFlash(__('The forum category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The forum category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
