<?php
App::uses('AppController', 'Controller');

class PanelsController extends AppController {
/**
* Components
*
* @var array
*/
	public $components = array('Paginator','Access');
	public $uses = array('User', 'Organization', 'Issue', 'Badge', 'Role', 'Group', 'MissionIssue', 'Mission', 'Phase', 'Quest');
	public $user = null;

/**
*
* beforeFilter method
*
* @return void
*/
	public function beforeFilter() {
        parent::beforeFilter();
        //test to get user data from proper index
		if(is_null($this->Session->read('Auth.User.role_id'))) {
			$current_role = $this->Session->read('Auth.User.User.role_id');
			$current_id = $this->Session->read('Auth.User.User.id');
		}else{
			$current_role = $this->Session->read('Auth.User.role_id');
			$current_id = $this->Session->read('Auth.User.id');
		}
		
		//there was some problem in retrieving user's info concerning his/her role : send him home
		if(!isset($current_role) || is_null($current_role)) {
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}

		//checking Acl permission
		if(!$this->Access->check($current_role,'controllers/Panels')) {
			$this->Session->setFlash(__("You don't have permission to access this area."));	
			$this->redirect(array('controller' => 'users', 'action' => 'dashboard', $current_id));
		}
    }
	
/*
* index method
* Loads basic informations from database to local variables to be shown in the administrator's panel
*/
	public function index($args = 'organizations') {
		$organizations_tab = $this->defineCurrentTab('organizations', $args);
		$missions_tab = $this->defineCurrentTab('missions', $args);
		$levels_tab = $this->defineCurrentTab('levels', $args);
		$badges_tab = $this->defineCurrentTab('badges', $args);
		$users_tab = $this->defineCurrentTab('users', $args);
		$media_tab = $this->defineCurrentTab('media', $args);
		$statistics_tab = $this->defineCurrentTab('statistics', $args);

		//carrega infos do usuário
		$this->loadInfo();

		$organizations = $this->Organization->getOrganizations();
		
		$issues = $this->Issue->getIssues();
		
		$badges = $this->Badge->getBadges();
		
		$roles = $this->Role->getRoles();
				
		$users = $this->User->getUsers();
		
		$groups = $this->Group->getGroups();
		
		$missions_issues = $this->MissionIssue->Mission->find('all', array(
			'order' => array('Mission.title ASC'))
		);

		//needed to issues' add form
		$parentIssues = $this->Issue->ParentIssue->find('list');
		
		$this->set(compact('organizations','issues','badges','roles','users','groups','missions_issues', 'parentIssues', 
			'organizations_tab', 'missions_tab', 'levels_tab', 'badges_tab', 'users_tab', 'media_tab', 'statistics_tab'));
	}



	public function loadInfo() {
		$username = explode(' ', $this->Session->read('Auth.User.User.name'));
		$this->set(compact('username'));

		$userid = $this->Session->read('Auth.User.User.id');
		$this->set(compact('userid'));
	}

/*
* add_mission method
* adds a new mission via admin panel, setting its issue and phases 
*/
	public function add_mission($id = null, $args = 'mission') {
		
		$mission_tag = $this->defineCurrentTab('mission', $args);
		$phases_tag = $this->defineCurrentTab('phase', $args);
		$quests_tag = $this->defineCurrentTab('quest', $args);
		$badges_tag = $this->defineCurrentTab('badge', $args);
		$points_tag = $this->defineCurrentTab('point', $args);

		//list of issues to be loaded at the combo box..
		$issues = $this->Issue->find('list');

		//list of phases to be shown at the 'add phases to a mission' scenario..
		$phases = $this->Phase->find('all', array(
			'conditions' => array(
				'mission_id' => $id
			),
			'order' => array(
				'Phase.position'
			)
		));


		$mission = null;

		if ($this->request->is('post')) {
			
			if(!$this->Mission->exists($id)) {
				//it's a new mission, so let's add it..
				$this->Mission->create();
				if ($mission = $this->Mission->save($this->request->data)) {
					$id = $mission['Mission']['id'];
					//saves the issue related to it..
					$this->request->data['MissionIssue']['mission_id'] = $id;
					if($this->MissionIssue->save($this->request->data)) {
						$this->Session->setFlash(__('mission issue saved'));
						
						//redirects to the same page, but with the tab phase active
						$this->redirect(array('action' => 'add_mission', $id, 'phase'));
					} else {
						$this->Session->setFlash(__('mission issue failed saving.'));
					}
				} else {
					$this->Session->setFlash(__('The mission could not be saved. Please, try again.'));
				}
			} else {
				//it already exists, so let's save any alterations and move on..
				$this->Mission->id = $id;
				if ($this->Mission->save($this->request->data)) {
					$mission = $this->Mission->find('first', array('conditions' => array('id' => $id)));
					
					//saves the issue related to it..
					$this->request->data['MissionIssue']['mission_id'] = $id;
					$this->MissionIssue->id = $this->MissionIssue->find('first', array('conditions' => array('mission_id' => $id)));
					if($this->MissionIssue->save($this->request->data)) {
						$this->Session->setFlash(__('mission issue saved'));

						//redirects to the same page, but with the tab phase active
						$this->redirect(array('action' => 'add_mission', $id, 'phase'));
					} else {
						$this->Session->setFlash(__('mission issue failed saving.'));
					}
				} else {
					$this->Session->setFlash(__('The mission could not be saved. Please, try again.'));
				}
			}
		} else{
			//it could be a request from one of the other tabs
			if(!is_null($id) && $args == 'phase'){
				//sets variable mission to be the mission being added now..
				$mission = $this->Mission->find('first', array('conditions' => array('id' => $id)));
			}
			if(!is_null($id) && $args == 'mission'){
				//sets variable mission to be the mission being added now..
				$mission = $this->Mission->find('first', array('conditions' => array('id' => $id)));
			}
		}
		$this->set(compact('mission_tag', 'phases_tag', 'quests_tag', 'badges_tag', 'points_tag', 'id','mission', 'issues', 'phases'))	;
	}

/*
* edit_mission method
* edit an existing mission via admin panel, setting its issue and phases 
*/
	public function edit_mission($id = null, $args = 'mission') {
		
		$mission_tag = $this->defineCurrentTab('mission', $args);
		$phases_tag = $this->defineCurrentTab('phase', $args);
		$quests_tag = $this->defineCurrentTab('quest', $args);
		$badges_tag = $this->defineCurrentTab('badge', $args);
		$points_tag = $this->defineCurrentTab('point', $args);

		//list of issues to be loaded at the combo box..
		$issues = $this->Issue->find('list');

		//list of phases to be shown at the 'add phases to a mission' scenario..
		$phases = $this->Phase->find('all', array(
			'conditions' => array(
				'mission_id' => $id
			),
			'order' => array(
				'Phase.position'
			)
		));


		$mission = null;

		if ($this->request->is('post')) {
			
			if($this->Mission->exists($id)) {
				//it already exists, so let's save any alterations and move on..
				$this->Mission->id = $id;
				if ($this->Mission->save($this->request->data)) {
					$mission = $this->Mission->find('first', array('conditions' => array('id' => $id)));
					
					//saves the issue related to it..
					$this->request->data['MissionIssue']['mission_id'] = $id;
					$this->MissionIssue->id = $this->MissionIssue->find('first', array('conditions' => array('mission_id' => $id)));
					if($this->MissionIssue->save($this->request->data)) {
						$this->Session->setFlash(__('mission issue saved'));

						//redirects to the same page, but with the tab phase active
						$this->redirect(array('action' => 'edit_mission', $id, 'phase'));
					} else {
						$this->Session->setFlash(__('mission issue failed saving.'));
					}
				} else {
					$this->Session->setFlash(__('The mission could not be saved. Please, try again.'));
				}
			} else{
				//you shouldn't be here, go back to the admin panel
				$this->redirect(array('action' => 'index'));
			}
		} else{
			//you shouldn't be here, go back to the admin panel
			if(is_null($id)) $this->redirect(array('action' => 'index'));
			//it could be a request from one of the other tabs
			if(!is_null($id) && $args == 'phase'){
				//sets variable mission to be the mission being added now..
				$mission = $this->Mission->find('first', array('conditions' => array('id' => $id)));
			}
			if(!is_null($id) && $args == 'mission'){
				//sets variable mission to be the mission being added now..
				$mission = $this->Mission->find('first', array('conditions' => array('id' => $id)));
			}
		}
		$this->set(compact('mission_tag', 'phases_tag', 'quests_tag', 'badges_tag', 'points_tag', 'id','mission', 'issues', 'phases'))	;
	}


/*
* add_phase method
* adds a new phase to the 'current-adding' mission  
*/
	function add_phase($id, $origin = 'add_mission') {
		if ($this->request->is('post')) {
			$this->request->data['Phase']['mission_id'] = $id;
			if($this->Phase->save($this->request->data)){
				$this->Session->setFlash(__('phase saved.'));
				//if it came from add mission, go back to it, else...
				if($origin == 'add_mission')
					$this->redirect(array('action' => 'add_mission', $id, 'phase'));
				else 
					$this->redirect(array('action' => 'edit_mission', $id, 'phase'));
			} else {
				$this->Session->setFlash(__('mission issue failed saving.'));
			}
		} else {
			$this->redirect(array('action' => 'index'));
		}
		
	}

/*
* add_quest method
* adds a new quest to the specific phase of the 'current-adding' mission  
*/
	public function add_quest($id, $origin = 'add_mission'){
		if ($this->request->is('post')) {
			$this->Quest->create();
			if ($this->Quest->save($this->request->data)) {
				$this->Session->setFlash(__('The quest has been saved.'));
				//if it came from add mission, go back to it, else...
				if($origin == 'add_mission')
					$this->redirect(array('action' => 'add_mission', $id, 'phase'));
				else 
					$this->redirect(array('action' => 'edit_mission', $id, 'phase'));
			} else {
				$this->Session->setFlash(__('The quest could not be saved. Please, try again.'));
			}
		} else {
			$this->redirect(array('action' => 'index'));
		}

	}


/*
* edit_quest method
* edits a quest of the specific phase of the 'current-adding' mission  
*/
	public function edit_quest($id, $quest_id, $origin = 'add_mission'){
		if ($this->request->is(array('post', 'put'))) {
			$this->Quest->id = $quest_id;
			if ($this->Quest->save($this->request->data)) {
				$this->Session->setFlash(__('The quest has been saved.'));
				//if it came from add mission, go back to it, else...
				if($origin == 'add_mission')
					$this->redirect(array('action' => 'add_mission', $id, 'phase'));
				else 
					$this->redirect(array('action' => 'edit_mission', $id, 'phase'));
			} else {
				$this->Session->setFlash(__('The quest could not be saved. Please, try again.'));
			}
		} else {
			$this->redirect(array('action' => 'index'));
		}

	}

/*
* delete_quest method
* deletes a quest of the specific phase of the 'current-adding' mission  
*/
	public function delete_quest($id, $quest_id, $origin = 'add_mission'){
		$this->Quest->id = $quest_id;
		if (!$this->Quest->exists()) {
			throw new NotFoundException(__('Invalid quest'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Quest->delete()) {
			$this->Session->setFlash(__('The quest has been deleted.'));
			//if it came from add mission, go back to it, else...
				if($origin == 'add_mission')
					$this->redirect(array('action' => 'add_mission', $id, 'phase'));
				else 
					$this->redirect(array('action' => 'edit_mission', $id, 'phase'));
		} else {
			$this->Session->setFlash(__('The quest could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


/*
* delete_phase method
* deletes a phase of the 'current-adding' mission  
*/
	public function delete_phase($id, $phase_id, $origin = 'add_mission'){
		$this->Phase->id = $phase_id;
		if (!$this->Phase->exists()) {
			throw new NotFoundException(__('Invalid phase'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Phase->delete()) {
			$this->Session->setFlash(__('The phase has been deleted.'));
			//if it came from add mission, go back to it, else...
				if($origin == 'add_mission')
					$this->redirect(array('action' => 'add_mission', $id, 'phase'));
				else 
					$this->redirect(array('action' => 'edit_mission', $id, 'phase'));
		} else {
			$this->Session->setFlash(__('The phase could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/*
* defineCurrentTab method
* auxiliary method to help with defining which tab is to be active on 'add mission' panel
*/
	public function defineCurrentTab($expected, $income) {
		if($expected == $income) {
			return 'active';
		} else{
			return '';
		}
	}

/*
* add_org method
* adds an organization via admin panel and returns to it
*/
	public function add_org() {
		if ($this->request->is('post')) {
			$this->Organization->create();
			if ($this->Organization->save($this->request->data)) {
				$this->Session->setFlash(__('The organization has been saved.'));
				return $this->redirect(array('action' => 'index', 'organizations'));
			} else {
				$this->Session->setFlash(__('The organization could not be saved. Please, try again.'));
			}
		}
	}

/*
* add_issue method
* adds an issue via admin panel and returns to it
*/
	public function add_issue() {
		if ($this->request->is('post')) {
			$this->Issue->create();
			if ($this->Issue->save($this->request->data)) {
				$this->Session->setFlash(__('The issue has been saved.'));
				return $this->redirect(array('action' => 'index', 'missions'));
			} else {
				$this->Session->setFlash(__('The issue could not be saved. Please, try again.'));
			}
		}
	}


/*
* add_badge method
* adds a badge via admin panel and returns to it
*/
	public function add_badge() {
		if ($this->request->is('post')) {
			$this->Badge->create();
			if ($this->Badge->save($this->request->data)) {
				$this->Session->setFlash(__('The badge has been saved.'));
				return $this->redirect(array('action' => 'index', 'badges'));
			} else {
				$this->Session->setFlash(__('The badge could not be saved. Please, try again.'));
			}
		}
	}

}