<?php
App::uses('AppController', 'Controller');
/**
 * SocialInnovatorQualities Controller
 *
 * @property SocialInnovatorQuality $SocialInnovatorQuality
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SocialInnovatorQualitiesController extends AppController {

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
		$this->SocialInnovatorQuality->recursive = 0;
		$this->set('socialInnovatorQualities', $this->Paginator->paginate());

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
		if (!$this->SocialInnovatorQuality->exists($id)) {
			throw new NotFoundException(__('Invalid social innovator quality'));
		}
		$options = array('conditions' => array('SocialInnovatorQuality.' . $this->SocialInnovatorQuality->primaryKey => $id));
		$this->set('socialInnovatorQuality', $this->SocialInnovatorQuality->find('first', $options));

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
			$this->SocialInnovatorQuality->create();
			if ($this->SocialInnovatorQuality->save($this->request->data)) {
				$this->Session->setFlash(__('The social innovator quality has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The social innovator quality could not be saved. Please, try again.'));
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
		if (!$this->SocialInnovatorQuality->exists($id)) {
			throw new NotFoundException(__('Invalid social innovator quality'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SocialInnovatorQuality->save($this->request->data)) {
				$this->Session->setFlash(__('The social innovator quality has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The social innovator quality could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SocialInnovatorQuality.' . $this->SocialInnovatorQuality->primaryKey => $id));
			$this->request->data = $this->SocialInnovatorQuality->find('first', $options);
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
		$this->SocialInnovatorQuality->id = $id;
		if (!$this->SocialInnovatorQuality->exists()) {
			throw new NotFoundException(__('Invalid social innovator quality'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SocialInnovatorQuality->delete()) {
			$this->Session->setFlash(__('The social innovator quality has been deleted.'));
		} else {
			$this->Session->setFlash(__('The social innovator quality could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
