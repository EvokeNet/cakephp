<?php
App::uses('AppController', 'Controller');

class PanelsController extends AppController {
/**
* Components
*
* @var array
*/
	public $components = array('Paginator','Access');
	public $uses = array('User', 'Organization', 'Issue', 'Badge', 'Role', 'Group', 'MissionIssue');

/*
* index method
* Loads basic informations from database to local variables to be shown in the administrator's panel
*/
	public function index() {
		//test to get user data from proper index
		// if(is_null($this->Session->read('Auth.User.role_id'))) {
		// 	$current_role = $this->Session->read('Auth.User.User.role_id');
		// 	$current_id = $this->Session->read('Auth.User.User.id');
		// }else{
		// 	$current_role = $this->Session->read('Auth.User.role_id');
		// 	$current_id = $this->Session->read('Auth.User.id');
		// }
		
		// //checking Acl permission
		// if(!$this->Access->check($current_role,'controllers/Panels')) {
		// 	$this->Session->setFlash(__("You don't have permission to access this area."));	
		// 	$this->redirect(array('controller' => 'users', 'action' => 'dashboard', $current_id));
		// }
		
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

		$this->set(compact('organizations','issues','badges','roles','users','groups','missions_issues'));
	}


}
?>
