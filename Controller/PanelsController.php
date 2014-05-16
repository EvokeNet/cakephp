<?php
App::uses('AppController', 'Controller');

class PanelsController extends AppController {
/**
* Components
*
* @var array
*/
	public $components = array('Paginator','Access');
	public $uses = array('User', 'UserIssue', 'Organization', 'UserOrganization', 'UserBadge', 'UserMission', 'Issue', 'Badge', 'Role', 'Group', 
		'DossierLink', 'UserFriend', 'DossierVideo', 'GroupsUser', 'MissionIssue', 'Mission', 'Phase', 'Evokation', 'Quest', 'Questionnaire', 
		'Question', 'Answer', 'Attachment', 'Dossier', 'PointsDefinition', 'PowerPoint', 'QuestPowerPoint', 'BadgePowerPoint', 'Level',
		'AdminNotification', 'Novel', 'Launcher');
	public $user = null;
	public $helpers = array('Media.Media', 'Chosen.Chosen');

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
			$this->Session->setFlash(__("You don't have permission to access this area. If needed, contact the administrator."), 'flash_message');	
			$this->redirect($this->referer());
		}
	}
	
/*
* index method
* Loads basic informations from database to local variables to be shown in the administrator's panel
*/
	public function index($args = 'organizations') {
		//debug($this->getCurrentLanguage());
		$organizations_tab = $this->defineCurrentTab('organizations', $args);
		$missions_tab = $this->defineCurrentTab('missions', $args);
		$issues_tab = $this->defineCurrentTab('issues', $args);
		$levels_tab = $this->defineCurrentTab('levels', $args);
		$powerpoints_tab = $this->defineCurrentTab('powerpoints', $args);
		$badges_tab = $this->defineCurrentTab('badges', $args);
		$users_tab = $this->defineCurrentTab('users', $args);
		$pending_tab = $this->defineCurrentTab('pending', $args);
		$media_tab = $this->defineCurrentTab('media', $args);
		$statistics_tab = $this->defineCurrentTab('statistics', $args);
		$settings_tab = $this->defineCurrentTab('settings', $args);

		//loading infos to be shown at top bar
		$username = explode(' ', $this->user['name']);
		$userid = $this->user['id'];
		$userrole = $this->user['role_id'];

		$user = $this->User->find('first', array('conditions' => array('User.id' => $userid)));

		//loading things that are independent from user role (admin/manager)
		$issues = $this->Issue->getIssues();

		$powerpoints = $this->PowerPoint->find('all');

		//get all general notifications
		$notifications = $this->AdminNotification->find('all', array(
			'conditions' => array(
				'AdminNotification.user_target' => null
			)
		));

		$levels = $this->Level->find('all');

		//needed to issues' add form
		$parentIssues = $this->Issue->ParentIssue->find('list');

		$roles_list = $this->Role->find('list');
		$roles = $this->Role->getRoles();
				
		$all_users = $this->User->getUsers();
		
		$groups = $this->Group->getGroups();

		$allPickedIssues = $this->UserIssue->find('all');
		$pickedIssues = array();
		foreach ($allPickedIssues as $key => $pickedIssue) {
			if(isset($pickedIssues[$pickedIssue['Issue']['id']])) {
				$pickedIssues[$pickedIssue['Issue']['id']]['issue'] = $pickedIssue['Issue']['name'];
				$pickedIssues[$pickedIssue['Issue']['id']]['quantity']++;
			} else {
				$pickedIssues[$pickedIssue['Issue']['id']]['issue'] = $pickedIssue['Issue']['name'];
				$pickedIssues[$pickedIssue['Issue']['id']]['quantity'] = 1;
			}
		}

		$allRelations = $this->UserFriend->find('all');


		$pending_evokations = array();
		$approved_evokations = array();
		//loading things that differ from perspective
		//admin will have access to all data
		//while manager will see only what belongs to his/hers organizations
		if($userrole == 1)	{
			//setting flag to refer from the view..
			$flags = array(
				'_admin' => true,
			);
			
			//always load all info, no matter the owner
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

			$pending_evokations = $this->Evokation->find('all', array(
				'conditions' => array(
					'Evokation.final_sent' => 1,
					'Evokation.approved' => null
				)
			));

			$approved_evokations = $this->Evokation->find('all', array(
				'conditions' => array(
					'Evokation.final_sent' => 1,
					'Evokation.approved' => 1
				)
			));

			$users_of_my_missions = null;

		} else {
			//it's a manager, which means he/she can only access so much
			$flags = array(
				'_admin' => false,
			);

			//only organizations I am part of
			$organizations = $this->Organization->UserOrganization->find('all', array(
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
			foreach ($organizations as $org) {
				$my_orgs_id1[$k] = array('organization_id' => $org['Organization']['id']);
				$my_orgs_id2[$k] = array('Organization.id' => $org['Organization']['id']);
				$k++;
			}

			//retrieve all organizations I am part of as a list to be displayed in a combobox
			$organizations_list = $this->Organization->find('list', array(
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

			//used in the users tab: a manager will only have access to users data from the users enrolled in his missions
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
		
		//points definitions
		$register_points = $this->PointsDefinition->find('first', array(
			'conditions' => array(
				'type' => 'Register'
			)
		));

		$allies_points = $this->PointsDefinition->find('first', array(
			'conditions' => array(
				'type' => 'Allies'
			)
		));

		$like_points = $this->PointsDefinition->find('first', array(
			'conditions' => array(
				'type' => 'Like'
			)
		));

		$vote_points = $this->PointsDefinition->find('first', array(
			'conditions' => array(
				'type' => 'Vote'
			)
		));	

		$evidenceComment_points = $this->PointsDefinition->find('first', array(
			'conditions' => array(
				'type' => 'EvidenceComment'
			)
		));

		$evokationComment_points = $this->PointsDefinition->find('first', array(
			'conditions' => array(
				'type' => 'EvokationComment'
			)
		));

		$evokationFollow_points = $this->PointsDefinition->find('first', array(
			'conditions' => array(
				'type' => 'EvokationFollow'
			)
		));

		$basicTraining_points = $this->PointsDefinition->find('first', array(
			'conditions' => array(
				'type' => 'BasicTraining'
			)
		));

		$this->set(compact('flags', 'allRelations', 'pickedIssues', 'username', 'userid', 'userrole', 'user', 'organizations', 'organizations_list', 'issues','badges','roles', 'roles_list','possible_managers','groups', 
			'all_users', 'users_of_my_missions','missions_issues', 'parentIssues', 'powerpoints', 'levels', 'pending_evokations', 'approved_evokations', 'notifications',
			'register_points', 'allies_points', 'like_points', 'vote_points', 'evidenceComment_points', 'evokationComment_points', 'evokationFollow_points', 'basicTraining_points',
			'organizations_tab', 'missions_tab', 'issues_tab', 'levels_tab', 'powerpoints_tab', 'badges_tab', 'users_tab', 'pending_tab', 'media_tab', 'statistics_tab', 'settings_tab'));
	}

/*
* add_mission method
* adds a new mission via admin panel, setting its issue and phases 
*/
	public function add_mission($id = null, $args = 'mission') {
		
		$mission_tag = $this->defineCurrentTab('mission', $args);
		
		$language = $this->getCurrentLanguage();

		//loading infos to be shown at top bar
		$username = explode(' ', $this->user['name']);
		$userid = $this->user['id'];
		$userrole = $this->user['role_id'];

		$user = $this->User->find('first', array('conditions' => array('User.id' => $userid)));

		//list of issues to be loaded at the combo box..
		$issues = $this->Issue->find('list');

		$powerpoints = $this->PowerPoint->find('all');

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
			
			//it's a new mission, so let's add it.. creating it with possible attachments (mission img)
			if ($mission = $this->Mission->createWithAttachments($this->request->data)) {
			
				$id = $mission['Mission']['id'];
				//saves the issue related to it..
				$this->request->data['MissionIssue']['mission_id'] = $id;
				if($this->MissionIssue->save($this->request->data)) {
					$this->Session->setFlash(__('mission issue saved'));
					
					//redirects to the same page, but with the tab phase activated
					$this->redirect(array('action' => 'edit_mission', $id, 'phase'));
				} else {
					$this->Session->setFlash(__('mission issue failed saving.'));
				}
			} else {
				$this->Session->setFlash(__('The mission could not be saved. Please, try again.'));
			}		 
		} 
		
		$this->set(compact('user', 'language', 'flags', 'username', 'userid', 'userrole', 'mission_tag', 'id','mission', 'issues', 'organizations'));
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
		$dossier_tag = $this->defineCurrentTab('dossier', $args);
		$novel_tag = $this->defineCurrentTab('novel', $args);

		$language = $this->getCurrentLanguage();

		//loading infos to be shown at top bar
		$username = explode(' ', $this->user['name']);
		$userid = $this->user['id'];
		$userrole = $this->user['role_id'];

		$user = $this->User->find('first', array('conditions' => array('User.id' => $userid)));

		//list of issues to be loaded at the combo box..
		$issues = $this->Issue->find('list');

		$powerpoints = $this->PowerPoint->find('all');

		//list of phases to be shown at the 'add phases to a mission' scenario..
		$phases = $this->Phase->find('all', array(
			'conditions' => array(
				'mission_id' => $id
			),
			'order' => array(
				'Phase.position'
			)
		));

		//image attached to mission, to be displayed in mission data tab
		// $mission_img = null;
		// if(!is_null($id)){
		// 	$mission_img = $this->Attachment->find('all', array('order' => array('Attachment.id' => 'desc'), 'conditions' => array('Model' => 'Mission', 'foreign_key' => $id)));
		// }

		$dossier_files = null;
		$dossier = null;
		//checking to see if i already have a dossier and, if so, if I already have files attached to it
		if(!is_null($id)){
			$dossier = $this->Dossier->find('first', array('conditions' => array('Dossier.mission_id' => $id)));
			if(!is_null($dossier) && !empty($dossier)) {
				$dossier_files = $this->Attachment->find('all', array('conditions' => array('Model' => 'Dossier', 'foreign_key' => $dossier['Dossier']['id'])));
			}
		}

		$dossier_links = $this->DossierLink->find('all', array(
			'conditions' => array(
				'DossierLink.mission_id' => $id
			)
		));

		$dossier_videos = $this->DossierVideo->find('all', array(
			'conditions' => array(
				'DossierVideo.mission_id' => $id
			)
		));	

		$launcher = $this->Launcher->find('all', array(
			'conditions' => array(
				'Launcher.mission_id' => $id
			)
		));

		$launchers = array();
		foreach ($launcher as $lkey => $l) {
			$launcherImg = $this->Attachment->find('first', array(
				'order' => array(
					'Attachment.id Desc'
				),
				'conditions' => array(
					'Attachment.model' => 'Launcher',
					'Attachment.foreign_key' => $l['Launcher']['id']
				)
			));	
			$launcher[$lkey]['Launcher']['image_dir'] = null;
			$launcher[$lkey]['Launcher']['image_name'] = null;
			if(!empty($launcherImg)){
				$launcher[$lkey]['Launcher']['image_dir'] = $launcherImg['Attachment']['dir'];
				$launcher[$lkey]['Launcher']['image_name'] = $launcherImg['Attachment']['attachment'];
			}

			$launchers[$l['Launcher']['phase_id']] = $launcher[$lkey]['Launcher'];
		}

		$novels_en = $this->Novel->find('all', array(
			'order' => array(
				'Novel.page Asc'
			),
			'conditions' => array(
				'Novel.mission_id' => $id,
				'Novel.language' => 'en'
			)
		));

		$novels_es = $this->Novel->find('all', array(
			'order' => array(
				'Novel.page Asc'
			),
			'conditions' => array(
				'Novel.mission_id' => $id,
				'Novel.language' => 'es'
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
			$my_orgs_id2 = array();
			$k = 0;
			foreach ($my_orgs as $my_org) {
				$my_orgs_id[$k] = array('Organization.id' => $my_org['Organization']['id']);
				$my_orgs_id2[$k] = array('Mission.organization_id' => $my_org['Organization']['id']);
				$k++;
			}

			$organizations = $this->Organization->find('list', array(
				'order' => array('Organization.name ASC'),
				'conditions' => array(
					'OR' => $my_orgs_id
				)
			));

			//check if I am allowed to edit this (if its a mission of an org of mine)!
			$smth = $this->Mission->find('first', array(
				'conditions' => array(
					'Mission.id' => $id,
					'OR' => $my_orgs_id2
				)
			));
			//ops, it's not my mission to edit it.. Going away..
			if(empty($smth)) $this->redirect(array('action' => 'index'));
			
		}

		$mission = null;

		if ($this->request->is('post')) {
			
			if($this->Mission->exists($id)) {
				//first, check if he sended another img for the mission...
				
				//it already exists, so let's save any alterations and move on..
				if ($this->Mission->createWithAttachments($this->request->data, true, $id)) {
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

		/*$this->Quest->create();
		$data['Quest']['description'] = "Quest description goes here..";
		$data['Quest']['mission_id'] = $id;
		$newQuest = $this->Quest->save($data);
		debug($newQuest);*/

		$this->set(compact('user', 'language', 'flags', 'username', 'userid', 'userrole', 'mission_tag', 'dossier_tag', 'phases_tag', 'quests_tag', 
			'badges_tag', 'points_tag', 'id','mission', 'issues', 'novel_tag', 'novels_es', 'novels_en', 'dossier_links', 'dossier_videos', 'launchers',
			'organizations', 'phases', 'questionnaires', 'answers', 'mission_img', 'dossier', 'dossier_files', 'newQuest', 'powerpoints'));
	}


/*
* dossier method
* save a dossier of a mission, along with its attachments
*/
	function dossier($id, $dossier_id = null, $origin = 'add_mission') {
		// debug($this->request->data);
		// die();
		if ($this->request->is('post')) {
			if($dossier_id == null) {
				if($this->Dossier->createWithAttachments($this->request->data)) {
					//$this->Session->setFlash(__('The mission dossier has been updated.'));

					if(isset($this->request->data['Attachment']['Old'])) {
						//destroy the attachment that shouldn't be here nomore
						$this->destroyAttachments($this->request->data['Attachment']['Old']);
					}
				} else {
					$this->Session->setFlash(__('Problem while updating the dossier.'));
				}
			} else {
				if($this->Dossier->createWithAttachments($this->request->data, true, $dossier_id)) {
					//$this->Session->setFlash(__('The mission dossier has been updated.'));

					//destroy the attachment that shouldn't be here nomore
					if(isset($this->request->data['Attachment']['Old'])) {
						$this->destroyAttachments($this->request->data['Attachment']['Old']);
					}
				} else {
					$this->Session->setFlash(__('Problem while updating the dossier.'));
				}
			}

			//sending back to correct address
			if($origin == 'add_mission')
				$this->redirect(array('action' => 'add_mission', $id, 'dossier'));
			else 
				$this->redirect(array('action' => 'edit_mission', $id, 'dossier'));

		} else {
			$this->redirect(array('action' => 'index'));
		}
	}

	function dossierLinks($id, $origin = 'add_mission') {
		// debug($this->request->data);
		if(isset($this->request->data['NewDossierLink'])) {
			$insert['DossierLink'] = $this->request->data['NewDossierLink'];
			$this->DossierLink->save($insert);

			//sending back to correct address
			if($origin == 'add_mission')
				$this->redirect(array('action' => 'add_mission', $id, 'dossier'));
			else 
				$this->redirect(array('action' => 'edit_mission', $id, 'dossier'));	
		}

		foreach ($this->request->data['DossierLink'] as $index => $link) {
			$insert['DossierLink'] = $this->request->data['DossierLink'][$index];
			if(isset($insert['DossierLink']['delete'])) {
				$this->DossierLink->id = $insert['DossierLink']['id'];
				$this->DossierLink->delete();
			} else {
				$this->DossierLink->save($insert);	
			}
			$insert = array();
		}
		
		//sending back to correct address
		if($origin == 'add_mission')
			$this->redirect(array('action' => 'add_mission', $id, 'dossier'));
		else 
			$this->redirect(array('action' => 'edit_mission', $id, 'dossier'));
	}

	function dossierVideos($id, $origin = 'add_mission') {
		// debug($this->request->data);
		if(isset($this->request->data['NewDossierVideo'])) {
			$insert['DossierVideo'] = $this->request->data['NewDossierVideo'];
			$this->DossierVideo->save($insert);

			//sending back to correct address
			if($origin == 'add_mission')
				$this->redirect(array('action' => 'add_mission', $id, 'dossier'));
			else 
				$this->redirect(array('action' => 'edit_mission', $id, 'dossier'));	
		}

		foreach ($this->request->data['DossierVideo'] as $index => $link) {
			$insert['DossierVideo'] = $this->request->data['DossierVideo'][$index];
			if(isset($insert['DossierVideo']['delete'])) {
				$this->DossierVideo->id = $insert['DossierVideo']['id'];
				$this->DossierVideo->delete();
			} else {
				$this->DossierVideo->save($insert);	
			}
			$insert = array();
		}
		
		//sending back to correct address
		if($origin == 'add_mission')
			$this->redirect(array('action' => 'add_mission', $id, 'dossier'));
		else 
			$this->redirect(array('action' => 'edit_mission', $id, 'dossier'));
	}


	function novelLauncher($id) {
		// debug($this->request->data['Launcher']);
		// die();
		if(isset($this->request->data['Launcher'])) {
			foreach ($this->request->data['Launcher'] as $launcher) {
			
				$att['Attachment'] = $launcher['Attachment'];
				$att['Launcher']['mission_id'] = $id;
				$att['Launcher']['phase_id'] = $launcher['phase_id'];
				if($att['Attachment'][0]['attachment']['error'] != 0)
					// return $this->redirect(array('action' => 'edit_mission', $id, 'novel'));
					continue;
				
				if(!isset($launcher['id'])) {
					// debug($att);
					$this->Launcher->createWithAttachments($att);
				} else {
					$att['Launcher']['id'] = $att['id'];
					$this->Launcher->createWithAttachments($att, true, $att['id']);
					// debug($att);
					// unset($att['Launcher']['id']);
				}
			}
			// die();
		}
		
		$this->redirect(array('action' => 'edit_mission', $id,'novel'));
	}

	function novel($id, $origin = 'add_mission'){
		
		 // debug($this->request->data['Novel']);
		 // die();
		foreach ($this->request->data['Novel'] as $novelIndex => $novelData) {
			// debug($novelData);
			if(isset($novelData['id'])) {
				$insertNovel['Novel']['id'] = $novelData['id'];

				if(isset($novelData['delete'])) {
					$this->Novel->id = $novelData['id'];
					$this->Novel->delete();
				}
			}
			if($novelData['page'] <= 0 || $novelData['Attachment'][0]['attachment']['error'] != 0) continue;

			$insertNovel['Novel']['mission_id'] = $novelData['mission_id'];
			$insertNovel['Novel']['language'] = $novelData['language'];
			$insertNovel['Novel']['page'] = $novelData['page'];
			$insertNovel['Attachment'] = $novelData['Attachment'];
			unset($insertNovel['Novel']['id']);
			// debug($novelData);
					
			if(isset($novelData['id'])) {
				$insertNovel['Novel']['id'] = $novelData['id'];

				if(isset($novelData['delete'])) {
					$this->Novel->id = $novelData['id'];
					$this->Novel->delete();
					
				} else {
					$this->Novel->createWithAttachments($insertNovel, true, $novelData['id']);	
				}
				
			} else {
				$this->Novel->createWithAttachments($insertNovel);
			}
			// debug($insertNovel);
			$insertNovel = array();
		}
		 // die();

		// $this->redirect($this->referer());

		//sending back to correct address
		$this->redirect(array('action' => 'edit_mission', $id, 'novel'));
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
			
			$data = $this->request->data;
			unset($data['Quest']['id']);

			
			$powerInsert['Power'] = $data['Power'];
			unset($data['Power']);

			//creating a quest with its possible attachments
			if ($this->Quest->createWithAttachments($data)) {
				$this->Session->setFlash(__('The quest has been saved.'));
				
				$quest_id = $this->Quest->id;

				$data = $this->request->data;
				
				$data['Quest']['id'] = $quest_id;
				$this->Quest->save($data);

				//create questpowerpoints entries..
				foreach ($powerInsert['Power'] as $powerId => $powerEntry) {
					if($powerEntry['quantity'] > 0){
						$insert['QuestPowerPoint']['quest_id'] = $quest_id;
						$insert['QuestPowerPoint']['power_points_id'] = $powerId;
						$insert['QuestPowerPoint']['quantity'] = $powerEntry['quantity'];

						$this->QuestPowerPoint->create();
						$this->QuestPowerPoint->save($insert);
					}
				}

				//now checking to see if it were a questionnarie type quest (type = 1)
				if($this->request->data['Quest']['type'] == 1) {
					//create a questionnaire..
					$questionnaire_data = array("Questionnaire" => array("quest_id" => $quest_id));
					$this->Questionnaire->create();
					if ($this->Questionnaire->save($questionnaire_data)) {
						$this->Session->setFlash(__('The questionnaire has been saved.'));

						$questionnaire_id = $this->Questionnaire->id;
						
						foreach ($this->request->data['Questions'] as $question) {
							//create questions saving them into the questionnaire
							$question['questionnaire_id'] = $questionnaire_id;
							$this->Question->create();
							if ($this->Question->save($question)) {
								$this->Session->setFlash(__('The question has been saved.'));
								
								$question_id = $this->Question->id;

								//if there are possible answers to this question (i.e. 'single/multiple choice type question'), add them
								if(isset($question['Answer'])) {
									foreach ($question['Answer'] as $answer) {
										//create question answer for each question
										$answer['question_id'] = $question_id;
										$this->Answer->create();
										if ($this->Answer->save($answer)) {
											// $this->Session->setFlash(__('The answer has been saved.'));
										} else {
											// $this->Session->setFlash(__('The answer could not be saved. Please, try again.'));
										}
									}
								}
							} else {
								$this->Session->setFlash(__('The question could not be saved. Please, try again.'));
							}
						}
					} else {
						$this->Session->setFlash(__('The questionnaire could not be saved. Please, try again.'));
					}
				} 

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
			

			$powerInsert['Power'] = $this->request->data['Power'];
			unset($this->request->data['Power']);
			
			//create questpowerpoints entries..
			foreach ($powerInsert['Power'] as $powerId => $powerEntry) {
				if($powerEntry['quantity'] > 0){
					$insert['QuestPowerPoint']['quest_id'] = $quest_id;
					$insert['QuestPowerPoint']['power_points_id'] = $powerId;
					$insert['QuestPowerPoint']['quantity'] = $powerEntry['quantity'];
					
					$old = $this->QuestPowerPoint->find('first', array(
						'conditions' => array(
							'quest_id' => $quest_id,
							'power_points_id' => $powerId
						)
					));

					if($old) {
						$this->QuestPowerPoint->id = $old['QuestPowerPoint']['id'];
					} else {
						$this->QuestPowerPoint->create();
					}
					$this->QuestPowerPoint->save($insert);
				}
			}


			//saves it supporting the addition of new images
			if ($this->Quest->createWithAttachments($this->request->data, true, $quest_id)) {
				
				//check to see if there are img/files that are no loner to be related to the quest...
				if(isset($this->request->data['Attachment']['Old'])) {
					$this->destroyAttachments($this->request->data['Attachment']['Old']);
				}
				
				//now checking to see if it were a questionnarie type quest (type = 1)
				if($this->request->data['Quest']['type'] == 1) {
					//destroy previous questionnaire of this quest and all other subjects
					$this->destroyQuestionnaire($quest_id);

					//create a questionnaire..
					$questionnaire_data = array("Questionnaire" => array("quest_id" => $quest_id));
					$this->Questionnaire->create();
					if ($this->Questionnaire->save($questionnaire_data)) {
						$this->Session->setFlash(__('The questionnaire has been saved.'));

						$questionnaire_id = $this->Questionnaire->id;
						
						foreach ($this->request->data['Questions'] as $question) {
							//create questions
							$question['questionnaire_id'] = $questionnaire_id;
							$this->Question->create();
							if ($this->Question->save($question)) {
								$this->Session->setFlash(__('The question has been saved.'));
								
								$question_id = $this->Question->id;
								//if there are possible answers to this question, add them
								if(isset($question['Answer'])) {
									foreach ($question['Answer'] as $answer) {
										//create question answer for each question
										$answer['question_id'] = $question_id;
										$this->Answer->create();
										if ($this->Answer->save($answer)) {
											$this->Session->setFlash(__('The answer has been saved.'));
										} else {
											$this->Session->setFlash(__('The answer could not be saved. Please, try again.'));
										}
									}
								}
							} else {
								$this->Session->setFlash(__('The question could not be saved. Please, try again.'));
							}
						}
					} else {
						$this->Session->setFlash(__('The questionnaire could not be saved. Please, try again.'));
					}
				} 

				$this->redirect(array('action' => 'edit_mission', $id, 'phase'));
			
			} else {
				$this->Session->setFlash(__('The quest could not be saved. Please, try again.'));
			}
		} else {
			$this->redirect(array('action' => 'index'));
		}
	}


/*
* destroyAttachments method
* erases (only from database) all related attachments from the desired quest
*/

	public function destroyAttachments($data){
		//iterate received array and check if attachment is meant to desapear
		foreach ($data as $d) {
			if(!strpos($d['id'], 'NO-')) {
				//good to go, lets erase it..
				$this->Attachment->id = $d['id'];
				$a['Attachment']['model'] = null;
				$a['Attachment']['foreign_key'] = null;
				if ($this->Attachment->save($a)) {
					$this->Session->setFlash(__('The attachment has been deleted.'));
				} else {
					$this->Session->setFlash(__('The attachment could not be deleted. Please, try again.'));
				}
			}
		}
	}

/*
* destroyQuestionnaire method
* erases all related data from the questionnaire desired
*/

	public function destroyQuestionnaire($quest_id = null) {
		if(!$quest_id) return;
		$questionnaire = $this->Questionnaire->find('first', array(
			'conditions' => array(
				'quest_id' => $quest_id
			)
		));
		$id = $questionnaire['Questionnaire']['id'];
		$this->Questionnaire->id = $id;

		if ($this->Questionnaire->delete()) {
			$this->Session->setFlash(__('The questionnaire has been deleted.'));
			
			//now, find all the questions related to it...
			$questions = $this->Question->find('all', array(
				'conditions' => array(
					'questionnaire_id' => $id
				)
			));

			//and delete them..
			foreach ($questions as $question) {
				$question_id = $question['Question']['id'];
				$this->Question->id = $question_id;

				if ($this->Question->delete()) {
					$this->Session->setFlash(__('The question has been deleted.'));
					
					//and dont forget its answers!
					$answers = $this->Answer->find('all', array(
						'conditions' => array(
							'question_id' => $question_id
						)
					));
					foreach ($answers as $answer) {
						$answer_id = $answer['Answer']['id'];
						$this->Answer->id = $answer_id;
						if ($this->Answer->delete()) {
							$this->Session->setFlash(__('The answer has been deleted.'));
						} else {
							$this->Session->setFlash(__('The answer could not be deleted. Please, try again.'));
						}
					}
				} else {
					$this->Session->setFlash(__('The question could not be deleted. Please, try again.'));
				}
			}
		} else {
			$this->Session->setFlash(__('The questionnaire could not be deleted. Please, try again.'));
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
			if ($this->Quest->delete()) {
				$this->Session->setFlash(__('The quest has been deleted.'));
				
				//now checking to see if it were a questionnarie type quest (type = 1)
				if($this->Quest->type == 1) {
					//destroy previous questionnaire of this quest and all other subjects
					$this->destroyQuestionnaire($quest_id);
				}

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
* quest method
* renders quest view, where user can change data regarding the selected quest. On submit, data will be sent to edit_quest method
*/
	public function quest($phase_id, $mission_id, $id, $origin = null) {
		$me = $this->Quest->find('first', array(
			'conditions' => array(
				'Quest.id' => $id
			)
		));

		//needed to be able to display and edit a quest's questionnaire
		$questionnaires = $this->Questionnaire->find('all');
		$answers = $this->Answer->find('all');

		//finding all quest's attachments
		$attachments = $this->Attachment->find('all', array(
			'conditions' => array(
				'Attachment.model' => 'Quest',
				'Attachment.foreign_key' => $id
			)
		));

		$powerpoints = $this->PowerPoint->find('all');
		
		$this->Quest->id = $id;
		$mypp = $this->Quest->QuestPowerPoint->find('all');

		$this->set(compact('phase_id', 'mission_id', 'me', 'questionnaires', 'answers', 'origin', 'attachments', 'mypp', 'powerpoints'));
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
		if($expected == $income) return 'active';
		else return '';
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

				//something went wrong while saving owners
				$this->Session->setFlash(__('The organization has been saved without owner.'));
				return $this->redirect(array('action' => 'index', 'organizations'));
			} else {
				$this->Session->setFlash(__('The organization could not be saved. Please, try again.'));
			}
		}
	}

/*
* add_powerpoint method
* adds a powerpoint via admin panel and returns to it
*/
	public function add_powerpoint() {
		if ($this->request->is('post')) {
			$this->PowerPoint->create();
			if ($this->PowerPoint->save($this->request->data)) {
				$this->Session->setFlash(__('The powerpoint has been saved.'));
				return $this->redirect(array('action' => 'index', 'powerpoints'));
			} else {
				$this->Session->setFlash(__('The powerpoint could not be saved. Please, try again.'));
			}
		}
	}

/*
* delete_powerpoint method
* delete a powerpoint via admin panel and returns to it
*/
	public function delete_powerpoint($id = null) {
		if ($this->request->is('post')) {

			$this->PowerPoint->id = $id;
			if (!$this->PowerPoint->exists()) {
				throw new NotFoundException(__('Invalid powerpoint'));
			}
			if ($this->PowerPoint->delete()) {
				$this->Session->setFlash(__('The powerpoint has been deleted.'));
				return $this->redirect(array('action' => 'index', 'powerpoints'));
			} else {
				$this->Session->setFlash(__('The powerpoint could not be deleted. Please, try again.'));
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
				return $this->redirect(array('action' => 'index', 'issues'));
			} else {
				$this->Session->setFlash(__('The issue could not be saved. Please, try again.'));
			}
		}
	}


/**
 * delete_issue method
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

				return $this->redirect(array('action' => 'index', 'issues'));
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
			
			$powerInsert['Power'] = $this->request->data['Power'];
			unset($this->request->data['Power']);

			$this->Badge->create();
			if ($this->Badge->createWithAttachments($this->request->data)) {

				$badge_id = $this->Badge->id;
				//create questpowerpoints entries..
				
				foreach ($powerInsert['Power'] as $powerId => $powerEntry) {
					if($powerEntry['quantity'] > 0){
						$insert['BadgePowerPoint']['badge_id'] = $badge_id;
						$insertId = $powerId;
						if($powerId == 0) {
							$insertId = null;
						}
						$insert['BadgePowerPoint']['power_points_id'] = $insertId;
						$insert['BadgePowerPoint']['quantity'] = $powerEntry['quantity'];

						$this->BadgePowerPoint->create();
						$this->BadgePowerPoint->save($insert);
					}
				}

				$this->Session->setFlash(__('The badge has been saved.'));
				return $this->redirect(array('action' => 'index', 'badges'));
			} else {
				$this->Session->setFlash(__('The badge could not be saved. Please, try again.'));
			}
		}
	}

/*
* edit_user_role method
* if it's an admin, he/she can change roles from any user of evoke
*/
	public function edit_user_role($id = null){
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if (!empty($this->request->data)) {
			    if ($this->User->save($this->request->data)) {
			    	$this->Session->setFlash(__('The user role has been saved.'));
					return $this->redirect(array('action' => 'index', 'users'));
			    }
			}
		}
	}

/*
* addNotification method
* inserts notifications to be display as lightboxes to users as they, for instance, log in
*/

	public function addNotification() {
		$this->AdminNotification->create();
		$this->AdminNotification->save($this->request->data);

		//debug($this->request->data);
		return $this->redirect(array('action' => 'index', 'media'));
	}


/*
* deleteNotification method
* deletes notifications in adminpanel
*/

	public function deleteNotification($id = null) {
		if($id == null)
			$this->redirect($this->referer());
		
		$this->AdminNotification->id = $id;
		$this->AdminNotification->delete();

		//debug($this->request->data);
		return $this->redirect(array('action' => 'index', 'media'));
	}


/*
* changeEvokationStatus method
* 
*/

	public function changeEvokationStatus($evo_id = null){
		if($evo_id == null)
			$this->redirect($this->referer());

		$evokation = $this->Evokation->find('first', array(
			'conditions' => array(
				'Evokation.id' => $evo_id
			)
		));

		if(empty($evokation))
			$this->redirect($this->referer());

		$mission = $this->Mission->find('first', array(
			'conditions' => array(
				'Mission.id' => $evokation['Group']['mission_id']
			)
		));

		$missionCompleted = 1;
		$this->Evokation->id = $evo_id;
		//it wasnt approved
		if($this->request->data['Evokation']['approved'] == 0) {
			$this->request->data['Evokation']['final_sent'] = 0;
			$missionCompleted = 0;
		}
		$this->Evokation->save($this->request->data);


		//set as mission completed to each member of the evokation group
		$members = $this->GroupsUser->find('all', array(
			'conditions' => array(
				'GroupsUser.group_id' => $evokation['Evokation']['group_id']
			)
		));

		$socialInnovator = $this->Badge->find('first', array(
			'conditions' => array(
				'Badge.name' => 'Social Innovator'
			)
		));

		$badgeExists = true;
		if(empty($socialInnovator))
			$badgeExists = false;


		foreach ($members as $member) {
			$previous = $this->UserMission->find('first', array(
				'conditions' => array(
					'UserMission.user_id' => $member['GroupsUser']['user_id'],
					'UserMission.mission_id' => $evokation['Group']['mission_id']
				)
			));
			$insert['UserMission']['completed'] = $missionCompleted;
			$insert['UserMission']['user_id'] = $member['GroupsUser']['user_id'];
			$insert['UserMission']['mission_id'] = $evokation['Group']['mission_id'];
			if(empty($previous)) {
				$this->UserMission->create();
			} else {
				$this->UserMission->id = $previous['UserMission']['id'];
				$insert['UserMission']['id'] = $previous['UserMission']['id'];
			}
			$userMission = $this->UserMission->save($insert);

			//debug($mission);
			//dispatch mission completed or evokation failure
			if($missionCompleted == 1) {
				$newData['AdminNotification']['title'] = 'Project Approved';
				$newData['AdminNotification']['description'] = 'Congratulations, agent! Your project '.$evokation['Evokation']['title'].' was approved and you have'.
					'successfully completed the '. $mission['Mission']['title'] .' mission.';
			}else{
				$newData['AdminNotification']['title'] = 'Project Not Approved!';
				$newData['AdminNotification']['description'] = 'Agent, your project'. $evokation['Evokation']['title'] . ' failed!';
			}
			$newData['AdminNotification']['user_id'] = $this->getUserId();
			$newData['AdminNotification']['user_target'] = $member['GroupsUser']['user_id'];
			$this->AdminNotification->create();
			$this->AdminNotification->save($newData);

			if(!$badgeExists || $missionCompleted == 0)
				continue;

			//check to see if he has a social innovator badge yet
			$my_powerpoints = $this->UserPowerPoint->find('all', array(
	        	'conditions' => array(
	        		'UserPowerPoint.user_id' => $member['GroupsUser']['user_id']
	        	)
	        ));
			
			$hasThisBadge = $this->UserBadge->find('first', array(
				'conditions' => array(
					'UserBadge.badge_id' => $socialInnovator['Badge']['id'],
					'UserBadge.user_id' => $member['GroupsUser']['user_id']
				)
			));

			if(!empty($hasThisBadge))
				continue;

	        $gotit = 0;
		    foreach ($my_powerpoints as $my_pp) {
		    	$gotit += $my_pp['UserPowerPoint']['quantity'];
		    }

		    if($gotit >= 3000) {
		    	//dispatch badge won
		  //   	$event = new CakeEvent('Model.BadgesUser.won', $this, array(
				//     'badge_id' => $b['badge_id'],
				//     'user_id' => $this->data['UserPowerPoint']['user_id']
				// ));

				// $this->getEventManager()->dispatch($event);
		    }

		}
		return $this->redirect(array('action' => 'index', 'pending'));
	}

/*
* level method
* defines levels settings (points to each level)
*/
	public function level(){
		$data = $this->request->data;
		if(isset($data['level']['old'])) {
			//there are previous levels to check changes
			foreach ($data['level']['old'] as $levelId => $levelPoints) {
				$this->Level->id = $levelId;
				$insert['Level']['points'] = $levelPoints;
				$this->Level->save($insert);
			}
			unset($data['level']['old']);
		}
		foreach ($data['level']['new'] as $levelLevel => $levelPoints) {
			$insert['Level']['points'] = $levelPoints;
			$insert['Level']['level'] = $levelLevel;

			$this->Level->create();
			$this->Level->save($insert);
		}

		return $this->redirect(array('action' => 'index', 'levels'));
	}


/*
* settings method
* general settings such as max_global of agents per group
*/
	public function settings(){
		$data = $this->request->data;
		if(isset($data['Config']['max_global'])) {
			$change['Group']['max_global'] = $data['Config']['max_global'];
			$groups = $this->Group->find('all');
			foreach ($groups as $group) {
				$this->Group->id = $group['Group']['id'];

				$this->Group->save($change);
			}
			unset($data['Config']);
		}
		
		//points def
		foreach ($data as $type => $point) {
			if($point['points'] != '') {
				$previous_point_setting = $this->PointsDefinition->find('first', array(
					'conditions' => array(
						'type' => $type
					)
				));

				$save_data['PointsDefinition']['type'] = $type;
				$save_data['PointsDefinition']['points'] = $point['points'];

				if($previous_point_setting) {
					$this->PointsDefinition->id = $previous_point_setting['PointsDefinition']['id'];
				} else {
					$this->PointsDefinition->create();
				}

				$this->PointsDefinition->save($save_data);
			}
		}

		$this->redirect(array('controller' => 'panels', 'action' => 'index', 'settings'));
	}
}