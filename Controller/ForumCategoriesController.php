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
		$this->Paginator->settings = array(
			'fields' => array(
				'id',
				'title',
				'view_count',
				'COUNT(ForumPost.id) as `answers`',
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
				'ForumTopic.answers' => 'desc'
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
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ForumCategory->recursive = 0;
		$this->set('forumCategories', $this->Paginator->paginate());

		$this->loadModel('Organization');
	    $organizations =
	      $this->Organization->find('all', array(
	      'order' => array(
	        'Organization.name ASC'
	      ),
	    ));

	   $this->set('organizations',$organizations);

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
		$options = array(
			'fields' => array(
				'ForumCategory.*',
				'User.name',
				'User.id',
				'Forum.id',
				'Forum.title'
			),
			'joins' => array(
				array(
					'table' => 'users',
					'alias' => 'User',
					'type' => 'INNER',
					'conditions' => array(
						'ForumCategory.user_id = User.id'
					)
				),
				array(
					'table' => 'forums',
					'alias' => 'Forum',
					'type' => 'INNER',
					'conditions' => array(
						'ForumCategory.forum_id = Forum.id'
					)
				)
			),
			'conditions' => array(
				'ForumCategory.' . $this->ForumCategory->primaryKey => $id
			)
		);

		$this->set('forumCategory', $this->ForumCategory->find('first', $options));

		$this->loadModel('Organization');
	    $organizations =
	      $this->Organization->find('all', array(
	      'order' => array(
	        'Organization.name ASC'
	      ),
	    ));

	   $this->set('organizations',$organizations);
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

		$this->loadModel('Organization');
	    $organizations =
	      $this->Organization->find('all', array(
	      'order' => array(
	        'Organization.name ASC'
	      ),
	    ));

	   $this->set('organizations',$organizations);
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

		$this->loadModel('Organization');
	    $organizations =
	      $this->Organization->find('all', array(
	      'order' => array(
	        'Organization.name ASC'
	      ),
	    ));

	   $this->set('organizations',$organizations);
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
