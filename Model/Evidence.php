<?php
App::uses('AppModel', 'Model');
App::uses('CakeEvent', 'Event');

/**
 * Evidence Model
 *
 * @property User $User
 * @property Quest $Quest
 * @property Mission $Mission
 * @property Phase $Phase
 * @property Comment $Comment
 * @property EvidenceTag $EvidenceTag
 * @property Vote $Vote
 */
class Evidence extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

	public $actsAs = array(
        'Containable'
    );

	public function createWithAttachments($data, $hasPrev = false, $id = null) {
        // Sanitize your images before adding them
        $images = array();
        if (!empty($data['Attachment'][0]) || !empty($data['Attachment'][1])) {
        	foreach ($data['Attachment'] as $i => $image) {
                if($i == 'Old') continue; //if its an already existing attachment, ignore it
                if (is_array($data['Attachment'][$i])) {
                    // Force setting the `model` field to this model
                    $image['model'] = 'Evidence';

                    // Unset the foreign_key if the user tries to specify it
                    if (isset($image['foreign_key'])) {
                        unset($image['foreign_key']);
                    }

                    $images[] = $image;
                }
            }
        }
        $data['Attachment'] = $images;

        // Try to save the data using Model::saveAll()
        if(!$hasPrev) $this->create();
        else {
        	$this->id = $id;
        	$data['Evidence']['id'] = $id;
        }
        if ($this->saveAll($data)) {
            return true;
        }
        return false;
    }

    // public function getGroupIdFromUser($user_id){
    // 	return $this->User->Group->GroupsUser->find('first', array(
    // 		'conditions'=> array('user_id' => $user_id),
    // 		'fields' 	=> array('group_id')
    // 	))['GroupsUser']['group_id'];
    // }

    // public function getUsersFromGroup($group_id){
    // 	return Hash::extract($this->User->Group->GroupsUser->find('all', array(
    // 		'conditions' => array('group_id' => $group_id),
    // 		'fields'     => array('user_id')
    // 	)), '{n}.GroupsUser.user_id');
    // }

    // Returns an array of the evidences submitted in this mission in the $phase_id resquested
    public function getGroupEvidences($user_id, $quest_id, $phase_id){

    	//debug($phase_id);

    	// get the id of the group which this user belongs
    	$group_id = $this->User->Group->GroupsUser->find('first', array(
    		'conditions'=> array('user_id' => $user_id),
    		'fields' 	=> array('group_id')
    	))['GroupsUser']['group_id']; //getGroupIdFromUser($user_id);

    	// get the users id's of the users who belong to the same group ($group_id)
    	$users = Hash::extract($this->User->Group->GroupsUser->find('all', array(
    		'conditions' => array('group_id' => $group_id),
    		'fields'     => array('user_id')
    	)), '{n}.GroupsUser.user_id'); //getUsersFromGroup($group_id);

		$evidences = $this->find('all', array(
			'conditions' => array(
				'user_id' => $users,
				'quest_id' => $quest_id,
				'phase_id' => $phase_id
			)
		));

		return $evidences;
    }

    public function getEvokationParts($evokation_id){
    	return $this->find('all', array(
    		'conditions' => array(
    			'evokation_id' => $evokation_id
    		)
    	));
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
		'Evokation' => array(
			'className' => 'Evokation',
			'foreignKey' => 'evokation_id',
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
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'evidence_id',
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
		'EvidenceTag' => array(
			'className' => 'EvidenceTag',
			'foreignKey' => 'evidence_id',
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
			'foreignKey' => 'evidence_id',
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
	                'Attachment.model' => 'Evidence',
	            ),
	    )
	);

}
