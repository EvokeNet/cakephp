<?php
App::uses('AppModel', 'Model');
/**
 * UserFriend Model
 *
 * @property User $User
 * @property Friend $Friend
 */
class UserFriend extends AppModel {

	public function afterSave($created, $options = array()) {
       
       	if($created){
	        $event = new CakeEvent('Model.UserFriend.follow', $this);

	        $this->getEventManager()->dispatch($event);

	        return true;
	    }	
    }

    public function beforeDelete() {
       
       $follower = $this->find('first', array(
			'conditions' => array('UserFriend.id' => $this->id))
		);

       $event = new CakeEvent('Model.UserFriend.unfollow', $this, array(
            'entity_id' => $follower['UserFriend']['friend_id'],
            'user_id' => $follower['UserFriend']['user_id'],
            'entity' => 'followUser'
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
