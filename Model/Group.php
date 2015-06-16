<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 * @property User $User
 * @property Evokation $Evokation
 * @property GroupRequest $GroupRequest
 * @property User $User
 */
class Group extends AppModel {

/**
 * actsAs array
 *
 */
	public $actsAs = array(
		'Containable',
		'BrainstormSessionEvoke.ActPhaseBrainstorm',
		'Optimum.ForumFilterable'
	);

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

	public function getGroups($options = null) {
		return $this->find('all', $options);
	}


/**
 * Checks if a user is the owner of the group (has created it)
 *
 * @param int Group ID
 * @param int User ID
 * @return boolean True if the user is the owner of the group, false otherwise
 */
	public function isOwner($group_id, $user_id) {
		if (!$this->exists($group_id)) {
			throw new NotFoundException(__('Invalid group'));
		}

		$group = $this->findById($group_id);
		return ($group['Group']['user_id'] == $user_id);
	}

/**
 * Checks if a user is a member of the group
 *
 * @param int Group ID
 * @param int User ID
 * @return boolean True if the user is a member of the group, false otherwise
 */
	public function isMember($group_id, $user_id) {
		if (!$this->exists($group_id)) {
			throw new NotFoundException(__('Invalid group'));
		}

		$is_member = $this->GroupsUser->find('count',array(
			'conditions' => array(
				'group_id' => $group_id,
				'user_id' => $user_id
			)
		));
		return ($is_member > 0);
	}



/**
 * Return the first group in which the user is a member in this mission (if any)
 *
 * @param int Mission ID
 * @param int User ID
 * @param array Contain argument
 * @return Group array or null, if the user is not a member of any group in this mission
 */
	public function getGroupInMission($mission_id, $user_id, $group_contain) {
		$group = $this->find('first', array(
			'joins' => array(
				array(
					'table' => 'groups_users',
					'type' => 'inner',
					'conditions' => array(
						'groups_users.group_id = Group.id',
						'groups_users.user_id' => $user_id
					)
				),
			),
			'fields' => array(
				'Group.*'
			),
			'conditions' => array(
				'Group.mission_id' => $mission_id
			),
			'group' => 'Group.id',
			'contain' => $group_contain
		));

		return $group;
	}


	public function afterSave($created, $options = array()) {
	   
		// if($created){
			// $event = new CakeEvent('Model.Group.create', $this, array(
			// 	'points' => $value
			// ));

			// $this->getEventManager()->dispatch($event);

		// 	return true;
		// }   
	}

	
	
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Leader' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Mission' => array(
			'className' => 'Mission',
			'foreignKey' => 'mission_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Phase' => array(
			'className' => 'Phase',
			'foreignKey' => 'phase_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Quest' => array(
			'className' => 'Quest',
			'foreignKey' => 'quest_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Evokation' => array(
			'className' => 'Evokation',
			'foreignKey' => 'group_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'GroupsUser' => array(
			'className' => 'GroupsUser',
			'foreignKey' => 'group_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'GroupRequest' => array(
			'className' => 'GroupRequest',
			'foreignKey' => 'group_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'GroupRequestsPending' => array(
			'className' => 'GroupRequest',
			'foreignKey' => 'group_id',
			'dependent' => false,
			'conditions' => array('status' => 0),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'GroupRequestsDone' => array(
			'className' => 'GroupRequest',
			'foreignKey' => 'group_id',
			'dependent' => false,
			'conditions' => array('status' => array(1, 2)),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'foreign_key',
			'conditions' => array(
				'Attachment.model' => 'Group',
			)
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Member' => array(
			'className' => 'User',
			'joinTable' => 'groups_users',
			'foreignKey' => 'group_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
