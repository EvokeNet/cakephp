<?php
App::uses('AppController', 'Controller');

class AdminDashboardsController extends AppController {
/**
* Components
*
* @var array
*/
//	public $components = array('Access');
	public $uses = false;

	public $components = array('Paginator', 'Session');

	public $accessLevels = array(
		'*' => 'admin',
		'*' => 'manager',
		'' => 'user'
	);

/**
*
* beforeFilter method
*
* @return void
*/
	public function beforeFilter() {
    parent::beforeFilter();
    ini_set('memory_limit', '512M'); // emergencial measure

    $this->user = array();
        //get user data into public var
		$this->user['role_id'] = $this->getUserRole();
		$this->user['id'] = $this->getUserId();
		$this->user['name'] = $this->getUserName();

	}

	public function isAuthorized($user = null) {
			if (parent::isAuthorized($user)) {
			    return true;
			}

		// Will break out on this call
		$this->Session->setFlash(__('Você não está autorizado a visualizar esta página'));
		$this->redirect(array('controller' => 'users', 'action' => 'profile', $this->getUserId()));

		return false;
  }

/*
* index method
* Loads basic informations from database to local variables to be shown in the administrator's panel
*/
	public function index($args = 0) {

    $this->loadModel('Badge');
		$this->loadModel('Level');
		$this->loadModel('Role');
		$this->loadModel('Evokation');
		$this->loadModel('AdminNotification');
		$this->loadModel('MissionIssue');
		$this->loadModel('Organization');
		$this->loadModel('PointsDefinition');
		$this->loadModel('Group');
		$this->loadModel('UserIssue');
		$this->loadModel('UserFriend');

		$user = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$organizations =
			$this->Organization->find('all', array(
			'order' => array(
				'Organization.name ASC'
			),
		));

		$levels = $this->Level->find('all');

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

		$issues = $this->MissionIssue->Issue->find('all');

		$admin_notifications = $this->AdminNotification->find('all', array(
			'conditions' => array(
				'AdminNotification.user_target' => null
			)
		));

		$all_evokations = $this->Evokation->find('all');

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

		$users = $this->User->find('all', array(
			'order' => array(
				'User.created DESC'
			)
		));

		$users_of_my_missions = $this->User->UserMission->find('all', array(
				'order' => array(
					'user_id ASC'
				),
				'contain' => 'User'
			));

			$userLevels['max'] = 0;
			$userLevels['all'] = 0;
			$userLevels['maxP'] = 0;
			$userLevels['allP'] = 0;
			$countries = array();
			$unknown_countries = 0;
			foreach ($users_of_my_missions as $usr) {
				$userPoints = $this->getPoints($usr['User']['id']);
	        	$userLevels['allP'] += $userPoints;
	        	// debug($usr['User']['name'] . ' '.$userPoints);
	        	if($userLevels['maxP'] < $userPoints) {
	        		$userLevels['maxP'] = $userPoints;
	        	}

	        	$userLevel = $this->getLevel($userPoints);

	        	$userLevels['all'] += $userLevel;
	        	if($userLevels['max'] < $userLevel) {
	        		$userLevels['max'] = $userLevel;
	        	}

				if(!is_null($usr['User']['country']) && $usr['User']['country'] != '' && $usr['User']['country'] != ' ') {
					$currentcountry = $usr['User']['country'];
					if(isset($countries[$currentcountry])) {
						$countries[$currentcountry]++;
					} else {
						$countries[$currentcountry] = 1;
					}
				} else {
					$unknown_countries++;
				}

			}

		$allRelations = $this->UserFriend->find('all');

		$all_users = $this->User->getUsers();

		$all_points = $this->PointsDefinition->find('all');
		$register_points = array();
		$allies_points = array();
		$like_points = array();
		$vote_points = array();
		$evidenceComment_points = array();
		$evokationFollow_points = array();
		$basicTraining_points = array();

		foreach ($all_points as $point) {
			if($point['PointsDefinition']['type'] == 'Register') {
				$register_points = $point;
			}
			if($point['PointsDefinition']['type'] == 'Allies') {
				$allies_points = $point;
			}
			if($point['PointsDefinition']['type'] == 'Like') {
				$like_points = $point;
			}
			if($point['PointsDefinition']['type'] == 'Vote') {
				$vote_points = $point;
			}
			if($point['PointsDefinition']['type'] == 'EvidenceComment') {
				$evidenceComment_points = $point;
			}
			if($point['PointsDefinition']['type'] == 'EvokationFollow') {
				$evokationFollow_points = $point;
			}
			if($point['PointsDefinition']['type'] == 'BasicTraining') {
				$basicTraining_points = $point;
			}
		}

		$countries = array();
			$unknown_countries = 0;
			foreach ($all_users as $usr) {
				$userPoints = $this->getPoints($usr['User']['id']);
	        	$userLevels['allP'] += $userPoints;
	        	// debug($usr['User']['name'] . ' '.$userPoints);
	        	if($userLevels['maxP'] < $userPoints) {
	        		$userLevels['maxP'] = $userPoints;
	        	}

	        	$userLevel = $this->getLevel($userPoints);

	        	$userLevels['all'] += $userLevel;
	        	if($userLevels['max'] < $userLevel) {
	        		$userLevels['max'] = $userLevel;
	        	}


				if(!is_null($usr['User']['country']) && $usr['User']['country'] != '' && $usr['User']['country'] != ' ') {
					$currentcountry = $usr['User']['country'];
					if(isset($countries[$currentcountry])) {
						$countries[$currentcountry]++;
					} else {
						$countries[$currentcountry] = 1;
					}
				} else {
					$unknown_countries++;
				}
			}

		$allPickedIssues = $this->UserIssue->find('all', array('contain' => 'Issue'));
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

		$groups = $this->Group->getGroups();

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

		$this->set(compact('user', 'users', 'all_evokations', 'flags', 'userLevels', 'allRelations', 'pickedIssues', 'username', 'userid', 'userrole', 'user', 'organizations',
			'organizations_list', 'issues','badges','roles', 'roles_list','possible_managers','groups', 'unknown_countries', 'countries',
			'all_users', 'users_of_my_missions','missions_issues', 'parentIssues', 'levels', 'pending_evokations', 'approved_evokations', 'admin_notifications', 'notifications',
			'register_points', 'allies_points', 'like_points', 'vote_points', 'evidenceComment_points', 'evokationComment_points', 'evokationFollow_points', 'basicTraining_points',
			'organizations_tab', 'missions_tab', 'issues_tab', 'levels_tab', 'badges_tab', 'users_tab', 'pending_tab', 'media_tab', 'statistics_tab', 'settings_tab'));


		// $this->set(compact('badges', 'missions_issues', 'organizations'));
		// if($args == 1){
		// 	$this->render('new_main');
		// }else{
		// 	$this->render('main');
		// }

	}
}
