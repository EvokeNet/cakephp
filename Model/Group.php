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
	        $event = new CakeEvent('Model.Group.create', $this);

	        $this->getEventManager()->dispatch($event);

	        return true;
	    }	
    }

    public function beforeDelete() {
       
       $group = $this->find('first', array(
			'conditions' => array('Group.id' => $this->id))
		);

       $event = new CakeEvent('Model.Group.delete', $this, array(
            'entity_id' => $like['Group']['id'],
            'user_id' => $like['Group']['user_id'],
            'entity' => 'group'
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
		'Mission' => array(
			'className' => 'Mission',
			'foreignKey' => 'mission_id',
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
