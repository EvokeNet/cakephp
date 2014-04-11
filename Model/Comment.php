<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 * @property Evidence $Evidence
 * @property User $User
 */
class Comment extends AppModel {

	public function afterSave($created, $options = array()) {
       
       	if($created){

       		if(isset($this->data['Comment']['evidence_id'])){
		        $event = new CakeEvent('Model.Comment.evidence', $this);

		        $this->getEventManager()->dispatch($event);
		    } else if(isset($this->data['Comment']['evokation_id'])){
		        $event = new CakeEvent('Model.Comment.evokation', $this);

		        $this->getEventManager()->dispatch($event);
		    }

	        return true;
	    }	
    }

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
		'Evokation' => array(
			'className' => 'Evokation',
			'foreignKey' => 'evokation_id',
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
}
