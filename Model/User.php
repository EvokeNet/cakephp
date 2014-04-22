<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Role $Role
 * @property Facebook $Facebook
 * @property Comment $Comment
 * @property Evidence $Evidence
 * @property EvokationFollower $EvokationFollower
 * @property GroupRequest $GroupRequest
 * @property Group $Group
 * @property Point $Point
 * @property UserBadge $UserBadge
 * @property UserFriend $UserFriend
 * @property UserIssue $UserIssue
 * @property UserOrganization $UserOrganization
 * @property Vote $Vote
 * @property Group $Group
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public function getUsers() {
		return $this->find('all', array(
			'order' => array('User.role_id ASC', 'User.name ASC'))
		);
	}


	public $name = 'User';

    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
    );

    
    var $actsAs = array('Acl' => array('requester'));
 
	function parentNode() {
	    if (!$this->id && empty($this->data)) {
	        return null;
	    }
	    $data = $this->data;
	    if (empty($this->data)) {
	        $data = $this->read();
	    }
	    if ((!isset($data['User']['role_id'])) | (!$data['User']['role_id'])) {
	        return null;
	    } else {
	        return array('Role' => array('id' => $data['User']['role_id']));
	    }
	}


 /**
 * beforeSave method
 *
 * @return void
 */
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}

	    if(!empty($this->data['User']['tmp_password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['tmp_password']); 
        }
     
		return true;
	}

	function hashPasswords($data) {
        return Security::hash($data,'md5',false);
    }

    public function afterSave($created, $options = array()) {
       
       	if($created){
       		$value = 250;
       		//check to see if admin set a different amount of points for this action
	        App::import('model','PointsDefinition');
	        $def = new PointsDefinition();
	        $preset_point = $def->find('first', array(
	            'conditions' => array(
	                'type' => 'Register'
	            )
	        ));
	        if($preset_point)
	            $value = $preset_point['PointsDefinition']['points'];

	        $event = new CakeEvent('Model.User.add', $this, array(
	            'entity_id' => $this->data['User']['id'],
	            'entity' => 'user',
	            'points' => $value
	        ));

	        $this->getEventManager()->dispatch($event);

	        return true;
	    }	
    }

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'AdminNotificationsUser' => array(
			'className' => 'AdminNotificationsUser',
			'foreignKey' => 'user_id',
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
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'user_id',
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
		'Evidence' => array(
			'className' => 'Evidence',
			'foreignKey' => 'user_id',
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
		'EvokationFollower' => array(
			'className' => 'EvokationFollower',
			'foreignKey' => 'user_id',
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
			'foreignKey' => 'user_id',
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
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'user_id',
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
		'Point' => array(
			'className' => 'Point',
			'foreignKey' => 'user_id',
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
		'UserBadge' => array(
			'className' => 'UserBadge',
			'foreignKey' => 'user_id',
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
		'UserFriend' => array(
			'className' => 'UserFriend',
			'foreignKey' => 'user_id',
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
		'UserIssue' => array(
			'className' => 'UserIssue',
			'foreignKey' => 'user_id',
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
		'UserOrganization' => array(
			'className' => 'UserOrganization',
			'foreignKey' => 'user_id',
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
		'UserMission' => array(
			'className' => 'UserMission',
			'foreignKey' => 'user_id',
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
		'UserPowerPoint' => array(
			'className' => 'UserPowerPoint',
			'foreignKey' => 'user_id',
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
		'Vote' => array(
			'className' => 'Vote',
			'foreignKey' => 'user_id',
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
		'Like' => array(
			'className' => 'Like',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Group' => array(
			'className' => 'Group',
			'joinTable' => 'groups_users',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'group_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		// 'UserFriend' => array(
		// 	'className' => 'UserFriend',
		// 	'joinTable' => 'user_friends',
		// 	'foreignKey' => 'user_id',
		// 	'associationForeignKey' => 'friend_id',
		// 	'unique' => 'keepExisting',
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => '',
		// 	'limit' => '',
		// 	'offset' => '',
		// 	'finderQuery' => '',
		// )
	);

}
