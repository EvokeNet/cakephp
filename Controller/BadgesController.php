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
		// $this->Badge->recursive = 0;
		$badges = $this->Badge->find('all');

		$lang = $this->getCurrentLanguage();
		$flags['_en'] = true;
		$flags['_es'] = false;
		if($lang=='es') {
			$flags['_en'] = false;
			$flags['_es'] = true;
		}

		$this->loadModel('PowerPoint');
		$tmp = $this->PowerPoint->find('all');
		$allPowerPoints = array();
		foreach ($tmp as $tmpkey => $tmpvalue) {
			if($flags['_es']){
				$tmp[$tmpkey]['PowerPoint']['name'] = $tmp[$tmpkey]['PowerPoint']['name_es'];
			}
			$allPowerPoints[$tmpvalue['PowerPoint']['id']] = $tmp[$tmpkey]['PowerPoint'];
		}

		foreach ($badges as $b => $badge) {
			if($flags['_es']){
				$badges[$b]['Badge']['name'] = $badge['Badge']['name_es'];
				$badges[$b]['Badge']['description'] = $badge['Badge']['description_es'];
			}

			$this->loadModel('Attachment');
			$badge_img = $this->Attachment->find('first', array(
				'conditions' => array(
					'Attachment.model' => 'Badge',
					'Attachment.foreign_key' => $badge['Badge']['id']
				)
			));
			if(!empty($badge_img)) {
				$badges[$b]['Badge']['img_dir'] = $badge_img['Attachment']['dir']; 
				$badges[$b]['Badge']['img_attachment'] = $badge_img['Attachment']['attachment'];
			} 

			$hasBadge = $this->Badge->UserBadge->find('first', array(
				'conditions' => array(
					'UserBadge.badge_id' => $badge['Badge']['id'],
					'UserBadge.user_id' => $this->getUserId()
				)
			));

			if(empty($hasBadge)) {
				$badges[$b]['Badge']['owns'] = false;
			} else {
				$badges[$b]['Badge']['owns'] = true;
			}

			$pps = array();
			$badgeGoal = 0;
			$badgeCurrent = 0;
			foreach ($badge['BadgePowerPoint'] as $bpp) {
				if($bpp['power_points_id'] == null) {
					//percentage for such power point

					$goal = $bpp['quantity'];
					$current = $this->getUserPowerPoints($this->getUserId());
					
					if($current > $goal)
						$current = $goal;

					$badgeGoal += $goal;
					$badgeCurrent += $current;
					$insert['UserPercentage'] = ($current / $goal) * 100;
					$insert['UserGoal'] = $goal;
					$insert['name'] = __('All powers');

					$pps[] = $insert;
				} else {
					if(isset($allPowerPoints[$bpp['power_points_id']])) {
						//percentage for such power point

						$goal = $bpp['quantity'];
						$current = $this->getUserPowerPoints($this->getUserId(), $bpp['power_points_id']);
						
						if($current > $goal)
							$current = $goal;

						$badgeGoal += $goal;
						$badgeCurrent += $current;

						$allPowerPoints[$bpp['power_points_id']]['UserPercentage'] = ($current / $goal) * 100;
						$allPowerPoints[$bpp['power_points_id']]['UserGoal'] = $goal;
						$pps[] = $allPowerPoints[$bpp['power_points_id']];
					}
				}
			}


			if($badge['Badge']['power_points_only'] == 1) {
				//the badge completition depends only on powerpoints
				if($badgeGoal == 0)
					$badges[$b]['Badge']['UserPercentage'] = 0;
				else
					$badges[$b]['Badge']['UserPercentage'] = ($badgeCurrent / $badgeGoal) * 100;
			}

			$badges[$b]['Badge']['PowerPoints'] = $pps;
		}
		//$this->set('badges', $this->Paginator->paginate());

		$this->loadModel('User');
		$user = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$this->set(compact('user', 'badges'));
	}




	public function getUserPowerPoints($user_id, $power_points_id = null) {
		$this->loadModel('UserPowerPoint');
		$check = array();
		if($power_points_id == null) {
			$check = $this->UserPowerPoint->find('all', array(
				'conditions' => array(
					'UserPowerPoint.user_id' => $user_id
				)
			));
		} else {
			$check = $this->UserPowerPoint->find('all', array(
				'conditions' => array(
					'UserPowerPoint.user_id' => $user_id,
					'UserPowerPoint.power_points_id' => $power_points_id
				)
			));
		}

		$sum = 0;
		foreach ($check as $data) {
			$sum += $data['UserPowerPoint']['quantity'];
		}
		return $sum;
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
				return $this->redirect($this->referer());
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

		$this->Badge->id = $id;
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
				return $this->redirect($this->referer());
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
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Badge->delete()) {
			$this->Session->setFlash(__('The badge has been deleted.'));
		} else {
			$this->Session->setFlash(__('The badge could not be deleted. Please, try again.'));
		}
		//returning to the admin panel
		// return $this->redirect(array('controller' => 'panels', 'action' => 'index', 'badges'));
		return $this->redirect($this->referer());
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
