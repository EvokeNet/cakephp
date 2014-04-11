<?php
App::uses('AppModel', 'Model');
/**
 * GroupsUser Model
 *
 * @property User $User
 * @property Group $Group
 */
class GroupsUser extends AppModel {


	public function getGroupAndUsers($group_id = null) {
		return $this->Group->find('first', array(
			'conditions' => array(
				'Group.id' => $group_id
			)
		));
	}

	public function belongsToGroup($group_id = null, $user_id = null){
		return $this->GroupsUser->find('first', array('conditions' => array('GroupsUser.group_id' => $group_id, 'GroupsUser.user_id' => $user_id)));
	}

	public function afterSave($created, $options = array()) {
       
       	if($created){
	        $event = new CakeEvent('Model.GroupsUser.join', $this);

	        $this->getEventManager()->dispatch($event);

	        return true;
	    }	
    }

    public function beforeDelete() {
       
       $group = $this->find('first', array(
			'conditions' => array('GroupsUser.id' => $this->id))
		);

       $event = new CakeEvent('Model.GroupsUser.unjoin', $this, array(
            'entity_id' => $like['GroupsUser']['group_id'],
            'user_id' => $like['GroupsUser']['user_id'],
            'entity' => 'groupJoin'
        ));

       $this->getEventManager()->dispatch($event);
		
	   return true;	
    }

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
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
