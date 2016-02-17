<?php
App::uses('AppController', 'Controller');
/**
 * SuperheroIdentities Controller
 *
 * @property SuperheroIdentity $SuperheroIdentity
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SuperheroIdentitiesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->SuperheroIdentity->recursive = 0;
		$this->set('superheroIdentities', $this->Paginator->paginate());

		$this->loadModel('Organization');
	    $organizations =
	      $this->Organization->find('all', array(
	      'order' => array(
	        'Organization.name ASC'
	      ),
	    ));

	   $this->set('organizations',$organizations);
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->SuperheroIdentity->exists($id)) {
			throw new NotFoundException(__('Invalid superhero identity'));
		}
		$options = array('conditions' => array('SuperheroIdentity.' . $this->SuperheroIdentity->primaryKey => $id));
		$this->set('superheroIdentity', $this->SuperheroIdentity->find('first', $options));

		$this->loadModel('Organization');
	    $organizations =
	      $this->Organization->find('all', array(
	      'order' => array(
	        'Organization.name ASC'
	      ),
	    ));

	   $this->set('organizations',$organizations);		
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->SuperheroIdentity->create();
			if ($this->SuperheroIdentity->save($this->request->data)) {
				$this->Session->setFlash(__('The superhero identity has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The superhero identity could not be saved. Please, try again.'));
			}
		}

		$this->loadModel('SocialInnovatorQuality');
  		$qualities = $this->SocialInnovatorQuality->find('list');
  		$this->loadModel('Power');
  		$powers = $this->Power->find('list');
  		$this->loadModel('Organization');
	    $organizations =
	      $this->Organization->find('all', array(
	      'order' => array(
	        'Organization.name ASC'
	      ),
	    ));
	      
  		$this->set(compact('powers','qualities','organizations'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->SuperheroIdentity->exists($id)) {
			throw new NotFoundException(__('Invalid superhero identity'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SuperheroIdentity->save($this->request->data)) {
				$this->Session->setFlash(__('The superhero identity has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The superhero identity could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SuperheroIdentity.' . $this->SuperheroIdentity->primaryKey => $id));
			$this->request->data = $this->SuperheroIdentity->find('first', $options);
		}

		$this->loadModel('SocialInnovatorQuality');
  		$qualities = $this->SocialInnovatorQuality->find('list');
  		$this->loadModel('Power');
  		$powers = $this->Power->find('list');
  		$this->loadModel('Organization');
	    $organizations =
	      $this->Organization->find('all', array(
	      'order' => array(
	        'Organization.name ASC'
	      ),
	    ));
	      
  		$this->set(compact('powers','qualities','organizations'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->SuperheroIdentity->id = $id;
		if (!$this->SuperheroIdentity->exists()) {
			throw new NotFoundException(__('Invalid superhero identity'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SuperheroIdentity->delete()) {
			$this->Session->setFlash(__('The superhero identity has been deleted.'));
		} else {
			$this->Session->setFlash(__('The superhero identity could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
