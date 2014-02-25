<?php
App::uses('AppController', 'Controller');

class PanelsController extends AppController {
/**
* Components
*
* @var array
*/
	public $components = array('Paginator');


	public function index(){
		//carrega infos do usuário
		$this->loadInfo();

		//carrega as orgs
		$this->organizations();
		
		//carrega as issues
		$issues = $this->issues();

		//cria matriz de relação entre issues e missions		
		$this->missionsIssues($issues);

		//carrega as badges
		$this->badges();

		//carrega os users.. (para colocar nas estatisticas)
		$this->users();

		//carrega os groups.. (para colocar nas estatisticas)
		$this->groups();
	}


	public function loadInfo(){
		//carrega infos da sessão do user
		$username = explode(' ', $this->Session->read('Auth.User.User.name'));
		$this->set(compact('username'));

		$userid = $this->Session->read('Auth.User.User.id');
		$this->set(compact('userid'));
	}

	public function groups(){
		//carregando groups
		$this->loadModel('Group');
		$groups = $this->Group->getGroups();
		$this->set('groups', $groups);
	}

	public function users(){
		//carregando users
		$this->loadModel('User');
		$users = $this->User->getUsers();
		$this->set('users', $users);
	}

	public function missionsIssues($issues){
		//cria matriz de issue X missions
		
		//carrega o model de relacao issue e mission
		$this->loadModel('MissionIssue');
		$matrix = null;	
		//para cada issue...
		foreach ($issues as $issue) {
			//carrega todas as missions (v[]) do issue (x) na variavel matriz[] na posicao x
			$matrix[$issue['Issue']['name']] = $this->MissionIssue->getMissionsFromIssue($issue['Issue']['id']);
		}
		$this->set('matrix', $matrix);

	}

	public function organizations(){
		//carregando as orgs
		$this->loadModel('Organization');
		$organizations = $this->Organization->getOrganizations();
		$this->set('organizations', $organizations);
	}


	public function issues(){
		//carregando as issues
		$this->loadModel('Issue');
		$issues = $this->Issue->getIssues();
		$this->set('issues', $issues);
		return $issues;
	}

	/*
	public function missions(){
		//carregando as missions
		$this->loadModel('Mission');
		$missions = $this->Mission->getMissions();
		$this->set('missions', $missions);

	}
	*/

	public function badges(){
		//carrega todas as badges	
		$this->loadModel('Badge');
		$badges = $this->Badge->getBadges();
		$this->set('badges', $badges);
	}





}