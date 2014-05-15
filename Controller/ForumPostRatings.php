<?php
App::uses('AppController', 'Controller');
/**
 * Evidences Controller
 *
 * @property Evidence $Evidence
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EvidencesController extends AppController {

	/**
 * add method
 *
 * @return void
 */
	// public function add() {
	// 	if ($this->request->is('post')) {
	// 		$this->Like->create();
	// 		if ($this->Like->save($this->request->data)) {
	// 			$this->Session->setFlash(__('The like has been saved.'));
	// 			return $this->redirect(array('action' => 'index'));
	// 		} else {
	// 			$this->Session->setFlash(__('The like could not be saved. Please, try again.'));
	// 		}
	// 	}
	// 	$evidences = $this->Like->Evidence->find('list');
	// 	$users = $this->Like->User->find('list');
	// 	$this->set(compact('evidences', 'users'));
	// }

	public function add($user_id = null, $post_id = null, $topic_id = null) {

		if(!$evidence_id) {
			return $this->redirect($this->referer());
		}

		$this->loadModel('Post');
		$post = $this->Post->find('first', array('conditions' => array('Post.id' => $post_id)));
		
		if(empty($post)){
			return $this->redirect($this->referer());
		}

		//$data['ForumPostRating']['evidence_id'] = $evidence_id;
		$data['ForumPostRating']['user_id'] = $user_id;
		$data['ForumPostRating']['post_id'] = $post_id;
		$data['ForumPostRating']['topic_id'] = $topic_id;

		$insertData = array('ForumPostRating.user_id' => $user_id, 'ForumPostRating.post_id' => $post_id, 'ForumPostRating.topic_id' => $topic_id);

		$like = $this->ForumPostRatings->find('first', array('conditions' => $insertData));

		$this->ForumPostRatings->create();
		if ($this->ForumPostRatings->save($data)) {

			$this->Session->setFlash(__('Your like was computed'), 'flash_message');
			
			return $this->redirect($this->referer());
		} else {
			$this->Session->setFlash(__('The like could not be saved. Please, try again.'));
		}
	}

}