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
		//carregando as orgs
		$this->loadModel('Organization');
		$organizations = $this->Organization->getOrganizations();
		$this->set('organizations', $organizations);		


		//carregando as missions
		$this->loadModel('Mission');
		$missions = $this->Mission->getMissions();
		$this->set('missions', $missions);

	}


	public function badges(){
		//carrega todas as badges	
		$this->loadModel('Badge');
		$badges = $this->Badges->getBadges();
		$this->set('badges', $badges);
	}

	



}