<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 * @property Evidence $Evidence
 * @property User $User
 */
class Comment extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Evidence' => array(
			'className' => 'Evidence',
			'foreignKey' => 'evidence_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function getUser($id){

		$option=array(             
        'joins' =>
				array(
				array(
				    'table' => 'comments',
				    'alias' => 'Comment',
				    'type' => 'inner',
				    'conditions'=> array("Comment." . $this->Comment->primaryKey => $id)
				),
				array(
				    'table' => 'users',
				    'alias' => 'CommentUser',
				    'type' => 'inner',
				    'conditions'=> array("Comment.user_id = CommentUser.id")
				),           
		     )  
		);

		return $this->Comment->User->find('all', $option);
	}
}
