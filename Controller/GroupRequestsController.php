<?php
App::uses('AppController', 'Controller');
/**
 * GroupRequests Controller
 *
 * @property GroupRequest $GroupRequest
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class GroupRequestsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$this->GroupRequest->create();
			if ($this->GroupRequest->save($this->request->data)) {
				$this->Session->setFlash(__('The group request has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group request could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->autoRender = false;
		if (!$this->GroupRequest->exists($id)) {
			throw new NotFoundException(__('Invalid group request'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->GroupRequest->save($this->request->data)) {
				$this->Session->setFlash(__('The group request has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group request could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('GroupRequest.' . $this->GroupRequest->primaryKey => $id));
			$this->request->data = $this->GroupRequest->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->autoRender = false;
		$this->GroupRequest->id = $id;
		if (!$this->GroupRequest->exists()) {
			throw new NotFoundException(__('Invalid group request'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->GroupRequest->delete()) {
			$this->Session->setFlash(__('The group request has been deleted.'));
		} else {
			$this->Session->setFlash(__('The group request could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * decline method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function decline($uid = null, $gid = null) {
		$this->autoRender = false;

		if($uid)
			$user_id = $uid;
		else
			$user_id = $this->params['url']['arg'];

		if($gid)
			$group_id = $gid;
		else
			$group_id = $this->params['url']['arg2'];

		//Update request status
    	$request = $this->GroupRequest->find('first', array(
    		'conditions' => array(
    			'GroupRequest.user_id' => $user_id,
    			'GroupRequest.group_id' => $group_id
    		),
    		'contain' => 'User'
    	));

    	if ($request) {
    		//Update request status
    		$this->GroupRequest->id = $request['GroupRequest']['id'];
    		$this->GroupRequest->save(array('status' => 2));

        	//Group details
        	$group = $this->GroupRequest->Group->find('first', array(
        		'conditions' => array(
        			'Group.id' => $group_id
        		),
        		'contain' => array('Leader', 'Phase')
        	));

			$Email = new CakeEmail('smtp');
			$Email->from(array('no-reply@quanti.ca' => $group['Group']['title']));
			$Email->to($request['User']['email']);
			$Email->subject(__('(Evoke) Request declined to join group "%s"', $group['Group']['title']));
			$Email->emailFormat('html');
			$Email->template('group_request_declined', 'default');
			$Email->viewVars(array('recipient' => $request['User'], 'group' => $group['Group'], 'phase' => $group['Phase']));
			$Email->send();

    		$this->Session->setFlash(__('The request was declined'));
    		return $this->redirect(array('controller' => 'groups', 'action' => 'view', $group_id));
    	} else {
    		return $this->redirect(array('controller' => 'groups', 'action' => 'view', $group_id));
    	}
	}


/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$this->GroupRequest->create();
			if ($this->GroupRequest->save($this->request->data)) {
				$this->Session->setFlash(__('The group request has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group request could not be saved. Please, try again.'));
			}
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
		$this->autoRender = false;
		if (!$this->GroupRequest->exists($id)) {
			throw new NotFoundException(__('Invalid group request'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->GroupRequest->save($this->request->data)) {
				$this->Session->setFlash(__('The group request has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group request could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('GroupRequest.' . $this->GroupRequest->primaryKey => $id));
			$this->request->data = $this->GroupRequest->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->autoRender = false;
		$this->GroupRequest->id = $id;
		if (!$this->GroupRequest->exists()) {
			throw new NotFoundException(__('Invalid group request'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->GroupRequest->delete()) {
			$this->Session->setFlash(__('The group request has been deleted.'));
		} else {
			$this->Session->setFlash(__('The group request could not be deleted. Please, try again.'));
		}
	}
}
