<?php
App::uses('AppController', 'Controller');

class PanelsController extends AppController {
/**
* Components
*
* @var array
*/
	public $components = array('Paginator','Access');
	public $uses = array('User', 'Organization', 'UserOrganization', 'UserMission', 'Issue', 'Badge', 'Role', 'Group', 'MissionIssue', 'Mission', 'Phase', 'Quest');
	public $user = null;

/**
*
* beforeFilter method
*
* @return void
*/
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

		//loading infos to be shown at top bar
		$username = explode(' ', $this->user['name']);
		$userid = $this->user['id'];
		$userrole = $this->user['role_id'];

		//loading things that are independent from user role (admin/manager)
		$issues = $this->Issue->getIssues();

		//needed to issues' add form
		$parentIssues = $this->Issue->ParentIssue->find('list');

		$roles = $this->Role->getRoles();
				
		$all_users = $this->User->getUsers();
		
		$groups = $this->Group->getGroups();

		//loading things that differ from perspective
		//admin will have access to all data
		//while manager will see only what belongs to him/his organizations
		if($userrole == 1)	{
			//setting flag to refer from the view..
			$flags = array(
				'_admin' => true,
			);
			
			$organizations = $this->Organization->getOrganizations(array(
				'order' => array(
					'Organization.name ASC'
				)
			));

			$organizations_list = $this->Organization->find('list', array(
				'order' => array('Organization.name ASC')
			));

			$badges = $this->Badge->getBadges(array(
				'order' => array(
					'Badge.name ASC'
				)
			));

			$missions_issues = $this->MissionIssue->Mission->find('all', array(
				'order' => array(
					'Mission.title ASC'
				)
			));

			$users_of_my_missions = null;

		} else {
			$flags = array(
				'_admin' => false,
			);

			$my_organizations = $this->Organization->UserOrganization->find('all', array(
				'order' => array(
					'Organization.name ASC'
				),
				'conditions' => array(
					array(
						'UserOrganization.user_id' => $userid
					)
				)
			));
			
			//variable to track the id's of all organizations I own and set it as OR condition when finding things that belong to my orgs
			$my_orgs_id1 = array();
			$my_orgs_id2 = array();
			$k = 0;
			foreach ($my_organizations as $org) {
				$my_orgs_id1[$k] = array('organization_id' => $org['Organization']['id']);
				//$my_orgs_id2[$k] = array('Organization.id' => $org['Organization']['id']);
				$my_orgs_id2[$k] = array('Organization.id' => $org['Organization']['id']);
				$k++;
			}

			$organizations_list = $this->Organization->find('list', array(
				'order' => array(
					'Organization.name ASC'
				),
				'conditions' => array(
					'OR' => $my_orgs_id2
				)
			));

			$organizations = $this->Organization->getOrganizations(array(
				'order' => array(
					'Organization.name ASC'
				),
				'conditions' => array(
					'OR' => $my_orgs_id2
				)
			));


			$badges = $this->Badge->getBadges(array(
				'order' => array(
					'Badge.name ASC'
				),
				'conditions' => array(
					'OR' => $my_orgs_id1
				)
			));

			$missions_issues = $this->MissionIssue->Mission->find('all', array(
				'order' => array(
					'Mission.title ASC'
				),
				'conditions' => array(
					'OR' => $my_orgs_id1
				)
			));

			$my_missions_id = array();
			$k = 0;
			foreach ($missions_issues as $my_mission) {
				$my_missions_id[$k] = array('mission_id' => $my_mission['Mission']['id']);
				$k++;
			}

			$users_of_my_missions = $this->User->UserMission->find('all', array(
				'order' => array(
					'User.name ASC'
				),
				'conditions' => array(
					'OR' => $my_orgs_id1
				)
			));
		}
		
		//array that contains all the possible owners of an organization
		$possible_managers = $this->User->find('list', array(
			'conditions' => array(
					'OR' => array( //to be an organization manager you either need.. 
            			array('role_id' => 1), //an admin account..
            			array('role_id' => 2) //or a manager one
        			)
			)
		));		
		
		$this->set(compact('flags', 'username', 'userid', 'userrole', 'organizations', 'organizations_list', 'issues','badges','roles','possible_managers','groups', 
			'all_users', 'users_of_my_missions','missions_issues', 'parentIssues',
			'organizations_tab', 'missions_tab', 'levels_tab', 'badges_tab', 'users_tab', 'media_tab', 'statistics_tab'));
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

		if($this->user['role_id'] == 1){
			$flags = array(
				'_admin' => true 
			);

			//as admin, he can set any organization as responsable for this mission
			$organizations = $this->Organization->find('list', array(
				'order' => array(
					'Organization.name ASC'
				)
			));
		} else {
			$flags = array(
				'_admin' => false 
			);

			//the possible organizations to be responsable for this mission are his own
			$my_orgs = $this->UserOrganization->find('all', array(
				'conditions' => array(
					array(
						'UserOrganization.user_id' => $this->user['id']
					)
				)
			));

			$my_orgs_id = array();
			$k = 0;
			foreach ($my_orgs as $my_org) {
				$my_orgs_id[$k] = array('id' => $my_org['Organization']['id']);
				$k++;
			}

			$organizations = $this->Organization->find('list', array(
				'order' => array('Organization.name ASC'),
				'conditions' => array(
					'OR' => $my_orgs_id
				)
			));
		}

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
					$mission = $this->Mission->find('first', array('conditions' => array('Mission.id' => $id)));
					
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
				$mission = $this->Mission->find('first', array('conditions' => array('Mission.id' => $id)));
			}
			if(!is_null($id) && $args == 'mission'){
				//sets variable mission to be the mission being added now..
				$mission = $this->Mission->find('first', array('conditions' => array('Mission.id' => $id)));
			}
		}
		$this->set(compact('flags', 'mission_tag', 'phases_tag', 'quests_tag', 'badges_tag', 'points_tag', 'id','mission', 'issues', 'organizations', 'phases'))	;
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

		if($this->user['role_id'] == 1){
			$flags = array(
				'_admin' => true 
			);

			//as admin, he can set any organization as responsable for this mission
			$organizations = $this->Organization->find('list', array(
				'order' => array(
					'Organization.name ASC'
				)
			));
		} else {
			$flags = array(
				'_admin' => false 
			);

			//the possible organizations to be responsable for this mission are his own
			$my_orgs = $this->UserOrganization->find('all', array(
				'conditions' => array(
					array(
						'UserOrganization.user_id' => $this->user['id']
					)
				)
			));

			$my_orgs_id = array();
			$k = 0;
			foreach ($my_orgs as $my_org) {
				$my_orgs_id[$k] = array('Organization.id' => $my_org['Organization']['id']);
				$k++;
			}

			$organizations = $this->Organization->find('list', array(
				'order' => array('Organization.name ASC'),
				'conditions' => array(
					'OR' => $my_orgs_id
				)
			));

			//check if I am allowed to edit this!
			$smth = $this->Mission->find('first', array(
				'conditions' => array(
					'Mission.id' => $id,
					'OR' => $my_orgs_id
				)
			));
			if(empty($smth)) $this->redirect(array('action' => 'index'));
			
		}

		$mission = null;

		if ($this->request->is('post')) {
			
			if($this->Mission->exists($id)) {
				
				//it already exists, so let's save any alterations and move on..
				$this->Mission->id = $id;
				if ($this->Mission->save($this->request->data)) {
					$mission = $this->Mission->find('first', array('conditions' => array('Mission.id' => $id)));
					
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
				$mission = $this->Mission->find('first', array('conditions' => array('Mission.id' => $id)));
			}
			if(!is_null($id) && $args == 'mission'){
				//sets variable mission to be the mission being added now..
				$mission = $this->Mission->find('first', array('conditions' => array('Mission.id' => $id)));
			}
		}
		$this->set(compact('flags', 'mission_tag', 'phases_tag', 'quests_tag', 'badges_tag', 'points_tag', 'id','mission', 'issues', 'organizations', 'phases'))	;
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
		if ($this->request->is('post')) {
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
	}


/*
* delete_phase method
* deletes a phase of the 'current-adding' mission  
*/
	public function delete_phase($id, $phase_id, $origin = 'add_mission'){
		if ($this->request->is('post')) {
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

				//saving owner of the recently added org
				$id = $this->Organization->id;
				$this->request->data['UserOrganization']['organization_id'] = $id;

				//if there was more than one owner:
				if(isset($this->request->data['UserOrganization']['users_id'])) {
					
					//save one by one at UserOrganization
					$tmp = $this->request->data['UserOrganization']['users_id'];
					foreach ($tmp as $userdata) {
						$this->request->data = array();
						$this->request->data['UserOrganization']['organization_id'] = $id;
						$this->request->data['UserOrganization']['user_id'] = $userdata;
						
						$this->UserOrganization->create();
						if(!$this->UserOrganization->save($this->request->data)) {
							$this->Session->setFlash(__('The organization has been saved without owner.'));
							return $this->redirect(array('action' => 'index', 'organizations'));
						}

					}
					$this->Session->setFlash(__('The organization has been saved.'));
					return $this->redirect(array('action' => 'index', 'organizations'));					
					
				} else {
					//there's only one, save him
					if($this->UserOrganization->save($this->request->data)) {
						$this->Session->setFlash(__('user organization saved'));

						$this->Session->setFlash(__('The organization has been saved.'));
						return $this->redirect(array('action' => 'index', 'organizations'));
					}
				}

				//something went wrong
				$this->Session->setFlash(__('The organization has been saved without owner.'));
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

/**
 * delete method
 * deletes an issue via admin panel and returns to it
 */
	public function delete_issue($id = null) {
		if ($this->request->is('post')) {
			$this->Issue->id = $id;
			if (!$this->Issue->exists()) {
				throw new NotFoundException(__('Invalid issue'));
			}
			//$this->request->onlyAllow('post', 'delete');
			if ($this->Issue->delete()) {
				$this->Session->setFlash(__('The issue has been deleted.'));

				//deletar todos os registros de missions_issue referentes a esse issue
				$this->loadModel('MissionIssue');
				$this->MissionIssue->deleteAll(array('issue_id = '.$id));

				return $this->redirect(array('action' => 'index', 'missions'));
			} else {
				$this->Session->setFlash(__('The issue could not be deleted. Please, try again.'));
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