<?php
App::uses('AppController', 'Controller');

class PanelsController extends AppController {
/**
* Components
*
* @var array
*/
	public $components = array('Paginator');


/*
* index method
* Loads basic informations from database to local variables to be shown in the administrator's panel
*/
	public function index() {
		//teste

		//$ruser = $this->Auth->user('role_id');//precisa ser arrumado, está causando o redirecionamento automatico para a pagina panels

		//para debug 
     	//$this->set("ruser",$ruser);

     	//verificando a permissão do usuário, coloquei na veriavel para debug
		//$this->set("teste",$this->Acl->check(array('model' => 'Role', 'foreign_key' => $ruser), 'controllers/Panels'));	
     	

		//carrega infos do usuário
		$this->loadInfo();

		$this->loadModel('Organization');
		$organizations = $this->Organization->getOrganizations();
		
		$this->loadModel('Issue');
		$issues = $this->Issue->getIssues();
		
		//cria matriz de relação entre issues e missions		
		$this->missionsIssues($issues);

		$this->loadModel('Badge');
		$badges = $this->Badge->getBadges();
		
		$this->loadModel('Role');
		$roles = $this->Role->getRoles();
				
		$this->loadModel('User');
		$users = $this->User->getUsers();
		
		$this->usersRole($roles, $users);

		$this->loadModel('Group');
		$groups = $this->Group->getGroups();
		
		$this->loadModel('MissionIssue');
		$missions_issues = $this->MissionIssue->Mission->find('all', array(
			'order' => array('Mission.title ASC'))
		);//




		$this->set(compact('organizations','issues','badges','roles','users','groups','missions_issues'));
	}


	public function loadInfo(){
		//carrega infos da sessão do user
		$username = explode(' ', $this->Session->read('Auth.User.User.name'));
		$this->set(compact('username'));

		$userid = $this->Session->read('Auth.User.User.id');
		$this->set(compact('userid'));
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
}