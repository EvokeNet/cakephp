<?php
App::uses('AppModel', 'Model');
/**
 * EvokationFollower Model
 *
 * @property User $User
 * @property Evokation $Evokation
 */
class EvokationFollower extends AppModel {

	public function afterSave($created, $options = array()) {
       
       	if($created){
	        $value = 5;
       		//check to see if admin set a different amount of points for this action
	        App::import('model','PointsDefinition');
	        $def = new PointsDefinition();
	        $preset_point = $def->find('first', array(
	            'conditions' => array(
	                'type' => 'EvokationFollow'
	            )
	        ));
	        if($preset_point)
	            $value = $preset_point['PointsDefinition']['points'];


	        $event = new CakeEvent('Model.EvokationFollower.add', $this, array(
	        	'points' => $value
	        ));

	        $this->getEventManager()->dispatch($event);

	        return true;
	    }	
    }

  //   public function beforeDelete() {
       
  //      $follower = $this->find('first', array(
		// 	'conditions' => array('EvokationFollower.id' => $this->id))
		// );

  //      $event = new CakeEvent('Model.UserFriend.unfollow', $this, array(
  //           'entity_id' => $follower['EvokationFollower']['evokation_id'],
  //           'user_id' => $follower['EvokationFollower']['user_id'],
  //           'entity' => 'followEvokation'
  //       ));

  //      $this->getEventManager()->dispatch($event);
		
		// return true;	
  //   }

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
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
		)
	);
}
