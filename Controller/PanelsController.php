<?php
App::uses('AppController', 'Controller');

class PanelsController extends AppController {
/**
* Components
*
* @var array
*/
	public $components = array('Paginator','Access');
	public $uses = array('User', 'Organization', 'Issue', 'Badge', 'Role', 'Group', 'MissionIssue', 'Mission','Phase');


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
	public function index() {
		
		//carrega infos do usuário
		$this->loadInfo();

		//$this->loadModel('Organization');
		$organizations = $this->Organization->getOrganizations();
		
		//$this->loadModel('Issue');
		$issues = $this->Issue->getIssues();
		
		//$this->loadModel('Badge');
		$badges = $this->Badge->getBadges();
		
		//$this->loadModel('Role');
		$roles = $this->Role->getRoles();
				
		//$this->loadModel('User');
		$users = $this->User->getUsers();
		
		//$this->loadModel('Group');
		$groups = $this->Group->getGroups();
		
		//$this->loadModel('MissionIssue');
		$missions_issues = $this->MissionIssue->Mission->find('all', array(
			'order' => array('Mission.title ASC'))
		);

		//needed to issues' add form
		$parentIssues = $this->Issue->ParentIssue->find('list');
		
		$this->set(compact('organizations','issues','badges','roles','users','groups','missions_issues', 'parentIssues'));
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
						/* this will be inserted afterwards so we can focus on the next tab of the add mission panel
						$phases_tag = 'active';
						$mission_tag = 'inactive';
						*/
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
		}
		$this->set(compact('mission_tag', 'phases_tag', 'quests_tag', 'badges_tag', 'points_tag', 'id','mission', 'issues', 'phases'))	;
	}


/*
* add_phase method
* adds a new phase to the 'current-adding' mission  
*/
	function add_phase($id) {
		if ($this->request->is('post')) {
			$this->request->data['Phase']['mission_id'] = $id;
			if($this->Phase->save($this->request->data)){
				$this->Session->setFlash(__('phase saved.'));
				$this->redirect(array('action' => 'add_mission', $id, 'phase'));
			} else {
				$this->Session->setFlash(__('mission issue failed saving.'));
			}
		} else {
			$this->redirect(array('action' => 'index'));
		}
		
	}

/*
* defineCurrentTab method
* auxiliary method to help with defining which tab is to be active on 'add mission' panel
*/
	public function defineCurrentTab($expected, $income) {
		if($expected == $income) {
			return 'active';
		} else{
			return 'inactive';
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
				return $this->redirect(array('action' => 'index'));
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
				return $this->redirect(array('action' => 'index'));
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
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The badge could not be saved. Please, try again.'));
			}
		}
	}

}