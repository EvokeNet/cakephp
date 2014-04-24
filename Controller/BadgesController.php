<?php
App::uses('AppController', 'Controller');
/**
 * Badges Controller
 *
 * @property Badge $Badge
 * @property PaginatorComponent $Paginator
 */
class BadgesController extends AppController {

/**
 * Components
 *
 * @var array
 */

	public $components = array('Paginator', 'Session', 'Access');
	public $uses = array('Badge', 'UserOrganization', 'Organization');
	public $user = null;

	public function beforeFilter() {
        parent::beforeFilter();
        $this->user = array();
        //get user data into public var
		$this->user['role_id'] = $this->getUserRole();
		$this->user['id'] = $this->getUserId();
		$this->user['name'] = $this->getUserName();
		
		//there was some problem in retrieving user's info concerning his/her role : send him home
		if(!isset($this->user['role_id']) || is_null($this->user['role_id'])) {
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}

		//checking Acl permission
		if(!$this->Access->check($this->user['role_id'],'controllers/'. $this->name .'/'.$this->action)) {
			$this->Session->setFlash(__("You don't have permission to access this area. If needed, contact the administrator."));	
			$this->redirect($this->referer());
		}
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Badge->recursive = 0;
		$this->set('badges', $this->Paginator->paginate());

		$this->loadModel('User');
		$user = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$this->set(compact('user'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Badge->exists($id)) {
			throw new NotFoundException(__('Invalid badge'));
		}
		$options = array('conditions' => array('Badge.' . $this->Badge->primaryKey => $id));
		$this->set('badge', $this->Badge->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		/*
		//test to get user data from proper index
		if(is_null($this->Session->read('Auth.User.role_id'))) {
			$current_role = $this->Session->read('Auth.User.User.role_id');
			$current_id = $this->Session->read('Auth.User.User.id');
		}else{
			$current_role = $this->Session->read('Auth.User.role_id');
			$current_id = $this->Session->read('Auth.User.id');
		}
		
		//checking Acl permission
		if(!$this->Access->check($current_role,'controllers/Badges',"add")) {
			$this->Session->setFlash(__("You don't have permission to access this area."));	
			$this->redirect(array('controller' => 'users', 'action' => 'dashboard', $current_id));
		}
		*/

		if ($this->request->is('post')) {
			$this->Badge->create();
			if ($this->Badge->save($this->request->data)) {
				$this->Session->setFlash(__('The badge has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The badge could not be saved. Please, try again.'));
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
		if (!$this->Badge->exists($id)) {
			throw new NotFoundException(__('Invalid badge'));
		}
		if ($this->request->is(array('post', 'put'))) {

			$powerInsert['Power'] = $this->request->data['Power'];
			unset($this->request->data['Power']);
			
			//create questpowerpoints entries..
			foreach ($powerInsert['Power'] as $powerId => $powerEntry) {
				if($powerEntry['quantity'] > 0){
					$insert['BadgePowerPoint']['quest_id'] = $id;
					$insert['BadgePowerPoint']['power_points_id'] = $powerId;
					$insert['BadgePowerPoint']['quantity'] = $powerEntry['quantity'];
					
					$this->loadModel('BadgePowerPoint');
					$old = $this->BadgePowerPoint->find('first', array(
						'conditions' => array(
							'badge_id' => $id,
							'power_points_id' => $powerId
						)
					));

					if($old) {
						$this->BadgePowerPoint->id = $old['BadgePowerPoint']['id'];
					} else {
						$this->BadgePowerPoint->create();
					}
					$this->BadgePowerPoint->save($insert);
				}
			}


			if ($this->Badge->save($this->request->data)) {
				$this->Session->setFlash(__('The badge has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The badge could not be saved. Please, try again.'));
			}
		} else {
			$this->loadModel('PowerPoint');
			$powerpoints = $this->PowerPoint->find('all');
			
			$this->Badge->id = $id;
			$mypp = $this->Badge->BadgePowerPoint->find('all');

			$options = array('conditions' => array('Badge.' . $this->Badge->primaryKey => $id));
			$this->request->data = $this->Badge->find('first', $options);
			$me = $this->Badge->find('first', $options);

			$this->set(compact('mypp', 'powerpoints', 'me'));

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
		/*
		//test to get user data from proper index
		if(is_null($this->Session->read('Auth.User.role_id'))) {
			$current_role = $this->Session->read('Auth.User.User.role_id');
			$current_id = $this->Session->read('Auth.User.User.id');
		}else{
			$current_role = $this->Session->read('Auth.User.role_id');
			$current_id = $this->Session->read('Auth.User.id');
		}
		
		//checking Acl permission
		if(!$this->Access->check($current_role,'controllers/Badges',"delete")) {
			$this->Session->setFlash(__("You don't have permission to access this area."));	
			$this->redirect(array('controller' => 'users', 'action' => 'dashboard', $current_id));
		}*/

		$this->Badge->id = $id;
		if (!$this->Badge->exists()) {
			throw new NotFoundException(__('Invalid badge'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Badge->delete()) {
			$this->Session->setFlash(__('The badge has been deleted.'));
		} else {
			$this->Session->setFlash(__('The badge could not be deleted. Please, try again.'));
		}
		//returning to the admin panel
		return $this->redirect(array('controller' => 'panels', 'action' => 'index', 'badges'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Badge->recursive = 0;
		$this->set('badges', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Badge->exists($id)) {
			throw new NotFoundException(__('Invalid badge'));
		}
		$options = array('conditions' => array('Badge.' . $this->Badge->primaryKey => $id));
		$this->set('badge', $this->Badge->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Badge->create();
			if ($this->Badge->save($this->request->data)) {
				$this->Session->setFlash(__('The badge has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The badge could not be saved. Please, try again.'));
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
		if (!$this->Badge->exists($id)) {
			throw new NotFoundException(__('Invalid badge'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Badge->save($this->request->data)) {
				$this->Session->setFlash(__('The badge has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The badge could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Badge.' . $this->Badge->primaryKey => $id));
			$this->request->data = $this->Badge->find('first', $options);
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
		$this->Badge->id = $id;
		if (!$this->Badge->exists()) {
			throw new NotFoundException(__('Invalid badge'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Badge->delete()) {
			$this->Session->setFlash(__('The badge has been deleted.'));
		} else {
			$this->Session->setFlash(__('The badge could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
