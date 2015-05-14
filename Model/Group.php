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
	public $actsAs = array('Containable','BrainstormSessionEvoke.ActPhaseBrainstorm');

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public function getGroups($options = null) {
		return $this->find('all', $options);
	}

	public function afterSave($created, $options = array()) {
       
       	if($created){

       		$value = 1500;
	       	//check to see if admin set a different amount of points for this action
		    /*App::import('model','PointsDefinition');
		    $def = new PointsDefinition();
		    $preset_point = $def->find('first', array(
		        'conditions' => array(
		    	    'type' => 'EvidenceComment'
		        )
		    ));
		    if($preset_point)
		        $value = $preset_point['PointsDefinition']['points'];
			*/

	        $event = new CakeEvent('Model.Group.create', $this, array(
	        	'points' => $value
	        ));

	        $this->getEventManager()->dispatch($event);

	        return true;
	    }	
    }

    public function createWithAttachments($data, $hasPrev = false, $id = null) {
        // Sanitize your images before adding them
        $images = array();
        if (!empty($data['Attachment'][0]) && $data['Attachment'][0]['attachment']['name'] != '') {
        	foreach ($data['Attachment'] as $i => $image) {
                if (is_array($data['Attachment'][$i])) {
                    
                    // Force setting the `model` field to this model
                    $image['model'] = 'Group';

                    // Unset the foreign_key if the user tries to specify it
                    if (isset($image['foreign_key'])) {
                        unset($image['foreign_key']);
                    }
                    $image['foreign_key'] = $data['Group']['id'];

                }
            }
        }
        $insert['Group'] = $data['Group'];
        //$data['Attachment'] = $image;

        // Try to save the data using Model::saveAll()
        if(!$hasPrev) $this->create();
        else {
        	$this->id = $id;
        	$insert['Group']['id'] = $id;
        }

        if(isset($image)) {
        	$photo['Attachment'] = $image;
	        if (!$this->Attachment->save($photo)) {
	        	return false;
	        }
	        $recent = $this->Attachment->find('first', array(
	        	'order' => array(
	        		'Attachment.id DESC'
	        	),
	        	'conditions' => array(
	        		'Attachment.model' => 'Group',
	        		'Attachment.foreign_key' => $data['Group']['id']
	        	)
	        ));
	        $insert['Group']['photo_dir'] = $recent['Attachment']['dir'];
	        $insert['Group']['photo_attachment'] = $recent['Attachment']['attachment'];
    	}
        //debug($data);
        if ($this->save($insert)) {
         	return true;
        }

        //return false;
        // Throw an exception for the controller
        throw new Exception(__("This post could not be saved. Please try again"));
    }

  //   public function beforeDelete() {
       
  //      $group = $this->find('first', array(
		// 	'conditions' => array('Group.id' => $this->id))
		// );

  //      $event = new CakeEvent('Model.Group.delete', $this, array(
  //           'entity_id' => $group['Group']['id'],
  //           'user_id' => $group['Group']['user_id'],
  //           'entity' => 'group'
  //       ));

  //      $this->getEventManager()->dispatch($event);
		
	 //   return true;	
  //   }
	
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
		'User' => array(
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
