<?php
App::uses('AppController', 'Controller');
/**
 * Qualities Controller
 *
 * @property Quality $quality
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class QualitiesController extends AppController {

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
		$this->Quality->recursive = 0;
		$this->set('qualities', $this->Paginator->paginate());

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
		if (!$this->Quality->exists($id)) {
			throw new NotFoundException(__('Invalid quality'));
		}
		$options = array('conditions' => array('Quality.' . $this->Quality->primaryKey => $id));
		$this->set('quality', $this->Quality->find('first', $options));

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
			$this->Quality->create();
			if ($this->Quality->save($this->request->data)) {
				$this->Session->setFlash(__('The quality has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quality could not be saved. Please, try again.'));
			}

			$this->loadModel('Organization');
	    $organizations =
	      $this->Organization->find('all', array(
	      'order' => array(
	        'Organization.name ASC'
	      ),
	    ));

	   $this->set('organizations',$organizations);	
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Quality->exists($id)) {
			throw new NotFoundException(__('Invalid quality'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Quality->save($this->request->data)) {
				$this->Session->setFlash(__('The quality has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quality could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('quality.' . $this->Quality->primaryKey => $id));
			$this->request->data = $this->Quality->find('first', $options);
		}

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
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Quality->id = $id;
		if (!$this->Quality->exists()) {
			throw new NotFoundException(__('Invalid quality'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Quality->delete()) {
			$this->Session->setFlash(__('The quality has been deleted.'));
		} else {
			$this->Session->setFlash(__('The quality could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
