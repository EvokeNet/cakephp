<?php
App::uses('AppModel', 'Model');
/**
 * UserFriend Model
 *
 * @property User $User
 * @property Friend $Friend
 */
class UserFriend extends AppModel {

	public $actsAs = array('Containable');
	
	public function afterSave($created, $options = array()) {
       
       	if($created){
       		$value = 5;
	       	//check to see if admin set a different amount of points for this action
		    App::import('model','PointsDefinition');
		    $def = new PointsDefinition();
		    $preset_point = $def->find('first', array(
		        'conditions' => array(
		            'type' => 'Allies'
		        )
		    ));
		    if($preset_point)
		        $value = $preset_point['PointsDefinition']['points'];

	        $event = new CakeEvent('Model.UserFriend.follow', $this, array(
	        	'points' => $value
	        ));

	        $this->getEventManager()->dispatch($event);

	        $event2 = new CakeEvent('Model.UserFriend.notifyFollow', $this);

	        $this->getEventManager()->dispatch($event2);

	        return true;
	    }	
    }

  //   public function beforeDelete() {
       
  //      $follower = $this->find('first', array(
		// 	'conditions' => array('UserFriend.id' => $this->id))
		// );

  //      $event = new CakeEvent('Model.UserFriend.unfollow', $this, array(
  //           'entity_id' => $follower['UserFriend']['friend_id'],
  //           'user_id' => $follower['UserFriend']['user_id'],
  //           'entity' => 'followUser'
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
		'Friend' => array(
			'className' => 'User',
			'foreignKey' => 'friend_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
