<?php
App::uses('AppModel', 'Model');
/**
 * Like Model
 *
 * @property Evidence $Evidence
 * @property User $User
 */
class Like extends AppModel {

	public function afterSave($created, $options = array()) {
       
       	if($created){
	        $event = new CakeEvent('Model.Like.evidence', $this);

	        $this->getEventManager()->dispatch($event);

	        return true;
	    }	
    }

    public function beforeDelete() {
       
       $like = $this->find('first', array(
			'conditions' => array('Like.id' => $this->id))
		);

       $event = new CakeEvent('Model.Unlike.evidence', $this, array(
            'entity_id' => $like['Like']['id'],
            'user_id' => $like['Like']['user_id'],
            'entity' => 'likeEvidence'
        ));

       $this->getEventManager()->dispatch($event);
		
		return true;	
    }

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
}
