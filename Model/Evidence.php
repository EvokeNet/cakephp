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
        // Throw an exception for the controller
        //throw new Exception(__("This post could not be saved. Please try again"));
    }

   //  public function afterSave($created, $options = array()) {
       
   //     	if($created){
	  //       $value = 1;
   //     		//check to see if admin set a different amount of points for this action
	  //       App::import('model','Quest');
	  //       $quests = new Quest();

	  //       $evidence = $this->find('first', array(
			// 	'conditions' => array('Evidence.id' => $this->id))
			// );

			// if($evidence['Evidence']['evokation'] == 1)
			// 	$entity = 'evokationQuest';
			// else
			// 	$entity = 'evidence';

	  //       $quest = $quests->find('first', array(
	  //       	'conditions' => array(
	  //       		'Quest.id' => $evidence['Evidence']['quest_id'])));

	  //       if($quest)
	  //           $value = $quest['Quest']['points'];

	  //       $event = new CakeEvent('Model.Evidence.create', $this, array(
	  //       	'points' => $value,
	  //       	'entity' => $entity
	  //       ));

	  //       $this->getEventManager()->dispatch($event);

	  //       return true;
	  //   }	
   //  }

    public function beforeDelete() {
       
       $evidence = $this->find('first', array(
			'conditions' => array('Evidence.id' => $this->id))
		);

       $event = new CakeEvent('Model.Group.delete', $this, array(
            'entity_id' => $evidence['Evidence']['id'],
            'user_id' => $evidence['Evidence']['user_id'],
            'entity' => 'evidence'
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
