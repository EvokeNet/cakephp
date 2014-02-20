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
		//teste

		//$ruser = $this->Auth->user('role_id');//precisa ser arrumado, está causando o redirecionamento automatico para a pagina panels

		//para debug 
     	//$this->set("ruser",$ruser);

     	//verificando a permissão do usuário, coloquei na veriavel para debug
		//$this->set("teste",$this->Acl->check(array('model' => 'Role', 'foreign_key' => $ruser), 'controllers/Panels'));	
     	

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

		//carrega os roles
		$roles = $this->roles();

		//carrega os users.. 
		$users = $this->users();

		$this->usersRole($roles, $users);


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

	public function roles(){
		//carregando roles
		$this->loadModel('Role');
		$roles = $this->Role->getRoles();
		$this->set('roles', $roles);
		return $roles;
	}

	public function users(){
		//carregando users
		$this->loadModel('User');
		$users = $this->User->getUsers();
		$this->set('users', $users);
		return $users;
	}


	public function usersRole($roles, $users){
			
		$matrixU = null;	
		$usersR = null;
		
		foreach ($roles as $role) {
			$k = 0;
			foreach ($users as $user) {
				if($user['User']['role_id']==$role['Role']['id']){
					$matrixU[$role['Role']['id']][$k] = $user;
					$k++;	
				}
			}	
		}
		
		
		$this->set('matrixU', $matrixU);

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