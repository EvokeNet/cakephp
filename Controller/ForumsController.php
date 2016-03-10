<?php
App::uses('AppController', 'Controller');
/**
 * Forums Controller
 *
 * @property Forum $Forum
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ForumsController extends AppController {

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
		$this->Forum->recursive = 0;
		$this->set('forums', $this->Paginator->paginate());

		//Forum's categories
		foreach ($this->Paginator->paginate() as $forum){
			$forumCategories[$forum['Forum']['id']] = $this->Forum->ForumCategory->find('all',array('conditions' => array('ForumCategory.forum_id' => $forum['Forum']['id'])));
		}
		$this->set('forumCategories',$forumCategories);
	}
	
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Forum->recursive = 0;
		$this->set('forums', $this->Paginator->paginate());
		
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
		if (!$this->Forum->exists($id)) {
			throw new NotFoundException(__('Invalid forum'));
		}
		$options = array(
			'fields' => array(
				'Forum.*',
				'User.name',
				'User.id'
			),
			'joins' => array(
				array(
					'table' => 'users',
					'alias' => 'User',
					'type' => 'INNER',
					'conditions' => array(
						'Forum.user_id = User.id'
					)
				)
			),
			'conditions' => array(
				'Forum.' . $this->Forum->primaryKey => $id
			)
		);
		$this->set('forum', $this->Forum->find('first', $options));
		
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
			$this->Forum->create();
			if ($this->Forum->save($this->request->data)) {
				return $this->flash(__('The forum has been saved.'), array('action' => 'index'));
			}
		}
		$users = $this->Forum->User->find('list');
		$this->set(compact('users'));
		
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
		if (!$this->Forum->exists($id)) {
			throw new NotFoundException(__('Invalid forum'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Forum->save($this->request->data)) {
				return $this->flash(__('The forum has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Forum.' . $this->Forum->primaryKey => $id));
			$this->request->data = $this->Forum->find('first', $options);
		}
		$users = $this->Forum->User->find('list');
		$this->set(compact('users'));
		
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
		$this->Forum->id = $id;
		if (!$this->Forum->exists()) {
			throw new NotFoundException(__('Invalid forum'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Forum->delete()) {
			return $this->flash(__('The forum has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The forum could not be deleted. Please, try again.'), array('action' => 'index'));
		}

	}	

}
