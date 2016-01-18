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
 * actsAs array
 *
 */
	public $actsAs = array('Containable');

	public $name = 'User';

	public $validate = array(
		'username' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A username is required'
			)
		),
		'password' => array(
			'notEmpty' => array(
							'rule' => array('notEmpty'),
						)
				),
				'email' => array(
						'email' => array(
								'rule' => array('email'),
								'message' => 'Make sure you typed your email correctly'
						),
						'isUnique' => array(
				  'rule' => 'isUnique',
				  'message' => 'This email has already been registered'
			  )
			),
	);


/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	public function createWithAttachments($data, $hasPrev = false, $id = null) {
		// Sanitize your images before adding them
		if (!empty($data['Attachment'][0]) && $data['Attachment'][0]['attachment']['name'] != '') {
			foreach ($data['Attachment'] as $i => $image) {
				if (is_array($data['Attachment'][$i])) {

					// Force setting the `model` field to this model
					$image['model'] = 'User';

					// Unset the foreign_key if the user tries to specify it
					if (isset($image['foreign_key'])) {
						unset($image['foreign_key']);
					}
				}
			}
		}

		$insert['User'] = $data['User'];

		// Try to save the data using Model::saveAll()
		if(!$hasPrev) $this->create();
		else {
			$this->id = $id;
			$insert['User']['id'] = $id;
		}

		if ($this->save($insert)) {
			if(isset($image)) {
				//Now that the user has been saved, it has an id for sure. This id will be used as a foreign key to the image
				$image['foreign_key'] = $this->id;
				$photo['Attachment'] = $image;

				if (!$this->Attachment->save($photo)) {
					return false;
				}

				//Now that the attachment has been saved, it has a directory and a file name for the attachment, that will be stored also in the user table
				$recent = $this->Attachment->findById($this->Attachment->id);

				//The previous attachment has to be deleted
				$added_user = $this->findById($this->id);
				$this->Attachment->deleteAll(array(
					'Attachment.model' => 'User',
					'Attachment.foreign_key' => $added_user['User']['id'],
					'Attachment.dir' => $added_user['User']['photo_dir'],
					'Attachment.attachment' => $added_user['User']['photo_attachment']
				),false, true);

				//The new attachment has to be saved in the user's profile
				$this->saveField('photo_dir', $recent['Attachment']['dir']);
				$this->saveField('photo_attachment', $recent['Attachment']['attachment']);
			}
			
			return true;
		}

		// Could not save because of conflicting registers
		$same_email = $this->find('count', array('conditions' => array('User.email' => $insert['User']['email'])));
		if ($same_email > 0) {
			throw new Exception(__("Your email is already registered in our database."));
		}

		$same_username = $this->find('count', array('conditions' => array('User.username' => $insert['User']['username'])));
		if ($same_username > 0) {
			throw new Exception(__("This username is already in use. Please choose another one."));
		}

		// Throw an exception for the controller
		throw new Exception(__("Sorry, your registered cannot be completed. Please check your data and try again."));
	}

 /**
 * beforeSave method
 *
 * @return void
 */
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new SimplePasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
		}

		if (isset($this->data[$this->alias]['firstname'])) {
			$this->data[$this->alias]['name'] = $this->data[$this->alias]['firstname'].' '.$this->data[$this->alias]['lastname'];
		}

		return true;
	}


	public function afterSave($created, $options = array()) {
		if($created){ //created a user, not edited info
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



	public function getUsers() {
		return $this->find('all', array(
			'order' => array('User.role ASC', 'User.name ASC'))
		);
	}

	/**
	 * Gets the position of the user in the leaderboard
	 * @param int $user_id Id of the user
	 * @return object User with two other fields (rank and total_points)
	 */
	public function getLeaderboardPosition($user_id){
		if (!$this->exists($user_id)) {
			throw new NotFoundException(__('Invalid user'));
		}

		$leaderboard_users = $this->find('all',$this->getLeaderboardQuery());
		
		foreach ($leaderboard_users as $key => $val) {
			if ($val['User']['id'] == $user_id) {
				//Rank
				$val['User']['rank'] = ($key+1);
				//Total points
				$val['User']['total_points'] = $leaderboard_users[$key][0]['total_points'];
				//Updated row
				return $val['User'];
			}
		}
	}

	/**
	 * Gets the query options that generate the leaderboard, ordered by the number of points
	 * @return array Query options
	 */
	public function getLeaderboardQuery(){
		return array(
			'joins' => array(
				array(
					'table' => 'points',
					'alias' => 'Points',
					'type' => 'left',  //join of your choice left, right, or inner
					'conditions' => array(
						'Points.user_id = User.id'
					)
				)
			),
			'fields' => array(
				'User.*',
				'sum(Points.value) as total_points'
			),
			'group' => 'Points.user_id',
			'order' => array('total_points' => 'DESC')
		);
	}
	
	/**
	 * Gets the level that corresponds to the total points of this user
	 * @param int $user_id User id
	 * @return object Level
	 */
	public function getLevel($user_id){
		App::import('model','Level');
		$levelModel = new Level();

		$total_points = $this->getTotalPoints($user_id);
		return $levelModel->getLevel($total_points);
	}


	/**
	 * Gets the total number of points of this user
	 * @param int $user_id User id
	 * @return int Total number of points
	 */
	public function getTotalPoints($user_id){
		$user_points = $this->find('first',array(
			'joins' => array(
				array(
					'table' => 'points',
					'alias' => 'Points',
					'type' => 'inner',
					'conditions' => array(
						'Points.user_id = User.id'
					)
				)
			),
			'conditions' => array('user_id' => $user_id),
			'fields' => array(
				'sum(Points.value) as total_points'
			),
			'group' => 'Points.user_id'
		));

		if ($user_points == null) {
			return 0;
		}
		return $user_points[0]['total_points'];
	}

	


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

	
	function hashPasswords($data) {
		return Security::hash($data,'md5',false);
	}


/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		// 'Role' => array(
		// 	'className' => 'Role',
		// 	'foreignKey' => 'role_id',
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => ''
		// ),
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
		'UserMatchingAnswer' => array(
			'className' => 'UserMatchingAnswer',
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
		),
		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'foreign_key',
			'conditions' => array(
				'Attachment.model' => 'User',
			)
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
