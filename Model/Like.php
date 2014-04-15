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
       		$value = 1;
       		//check to see if admin set a different amount of points for this action
	        App::import('model','PointsDefinition');
	        $def = new PointsDefinition();
	        $preset_point = $def->find('first', array(
	            'conditions' => array(
	                'type' => 'Like'
	            )
	        ));
	        if($preset_point)
	            $value = $preset_point['PointsDefinition']['points'];


	        $event = new CakeEvent('Model.Like.evidence', $this, array(
	        	'points' => $value
	        ));

	        $this->getEventManager()->dispatch($event);

	        App::import('model','Evidence');
	        $evidences = new Evidence();

	  //       $like = $this->find('first', array(
			// 	'conditions' => array('Like.id' => $this->id))
			// );

	        $evidence = $evidences->find('first', array(
				'conditions' => array('Evidence.id' => $this->data['Like']['evidence_id']))
			);

	        $event2 = new CakeEvent('Model.Like.notify', $this, array(
	        	'user_id' => $evidence['Evidence']['user_id'],
	        ));

	        $this->getEventManager()->dispatch($event2);

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
