<?php
App::uses('AppModel', 'Model');
/**
 * Mission Model
 *
 * @property Evidence $Evidence
 * @property MissionIssue $MissionIssue
 * @property Phase $Phase
 * @property Quest $Quest
 */
class Mission extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';


	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	public function getMissions() {
		return $this->find('all');
	}

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * getEvidences function returns evidences that belong to the selected mission
 *
 */
	public function getEvidences($id = null) {
		return $this->Evidence->find('all', array(
			'conditions' => array(
				'Evidence.mission_id' => $id
			),
			'order' => array('Evidence.created DESC'),
		));
	}

/**
 * getMissionIssues returns the issues for the selected mission
 *
 */
	public function getMissionIssues($id = null) {
		return $this->MissionIssue->find('all', array(
			'conditions' => array(
				'MissionIssue.mission_id' => $id
			)
		));
	}


	public function createWithAttachments($data, $hasPrev = false, $id = null) {
        // Sanitize your images before adding them
        $images = array();
        if (!empty($data['Attachment'][0]) || !empty($data['Attachment'][1])) {
        	foreach ($data['Attachment'] as $i => $image) {
                if (is_array($data['Attachment'][$i])) {
                	
                    // Force setting the `model` field to this model
                    $image['model'] = 'Mission';

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
        	$data['Mission']['id'] = $id;
        }
        if ($this->saveAll($data)) {
            
            return $this->find('first', array('conditions' => array('Mission.id' => $this->id)));
        }
        //return false;
        // Throw an exception for the controller
        throw new Exception(__("This post could not be saved. Please try again"));
    }



/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Evidence' => array(
			'className' => 'Evidence',
			'foreignKey' => 'mission_id',
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
		'MissionIssue' => array(
			'className' => 'MissionIssue',
			'foreignKey' => 'mission_id',
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
		'Phase' => array(
			'className' => 'Phase',
			'foreignKey' => 'mission_id',
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
		'Quest' => array(
			'className' => 'Quest',
			'foreignKey' => 'mission_id',
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
	                'Attachment.model' => 'Mission',
	            ),
	    )
	);


	// public $hasOne = array(
		
	// );
}
