<?php
App::uses('AppModel', 'Model');
/**
 * Vote Model
 *
 * @property Evidence $Evidence
 * @property User $User
 */
class Vote extends AppModel {

	public function afterSave($created, $options = array()) {
       
       	if($created){
       		$value = 1;
       		//check to see if admin set a different amount of points for this action
	        App::import('model','PointsDefinition');
	        $def = new PointsDefinition();
	        $preset_point = $def->find('first', array(
	            'conditions' => array(
	                'type' => 'Vote'
	            )
	        ));
	        if($preset_point)
	            $value = $preset_point['PointsDefinition']['points'];

	        App::import('model','Evokation');
	        App::import('model','GroupsUser');
        	
        	$evokations = new Evokation();
        	$groupsUsers = new GroupsUser();

        	$evokation = $evokations->find('first', array(
        		'conditions' => array('Evokation.id' => $this->data['Vote']['evokation_id'])
    		));

    		$groupUsers = $groupsUsers->find('all', array(
    			'conditions' => array('GroupsUser.group_id' => $evokation['Evokation']['group_id'])
			));

    		$aux_array = array();
    		$count = 0;

    		foreach($groupUsers as $g):
    			$count++;
    			array_push($aux_array, $g['GroupsUser']['user_id']);
    		endforeach;

    		$aux_array['array_count'] = $count;
    		//array_push($aux_array, 'array_count' => $count);

    		$event = new CakeEvent('Model.Vote.notifyEvokation', $this, $aux_array);

    		$this->getEventManager()->dispatch($event);

	        $event1 = new CakeEvent('Model.Vote.evokation', $this, array(
	        	'points' => $value
	        ));

	        $this->getEventManager()->dispatch($event1);

	        return true;
	    }	
    }

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Evokation' => array(
			'className' => 'Evokation',
			'foreignKey' => 'evokation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
