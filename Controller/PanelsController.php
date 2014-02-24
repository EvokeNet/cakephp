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
		$this->organizations();
		$this->missions();
		$this->badges();
	}


	public function organizations(){
		//carregando as orgs
		$this->loadModel('Organization');
		$organizations = $this->Organization->getOrganizations();
		$this->set('organizations', $organizations);		
	}

	public function missions(){
		//carregando as missions
		$this->loadModel('Mission');
		$missions = $this->Mission->getMissions();
		$this->set('missions', $missions);

	}

	public function badges(){
		//carrega todas as badges	
		$this->loadModel('Badge');
		$badges = $this->Badge->getBadges();
		$this->set('badges', $badges);
	}

	



}