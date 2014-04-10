<?php

App::uses('CakeEventListener', 'Event');
// App::uses('PointListener', 'Event');

class PointListener implements CakeEventListener {

	public function implementedEvents() {
        return array(
            'Model.Evidence.add' => 'addEvidencePoints',
            'Model.Answer.add' => 'addAnswerPoints',
            'Model.User.add' => 'addRegisterPoints',
            'Model.Group.create' => 'addGroupPoints',
            'Model.GroupsUser.join' => 'joinGroupPoints',
            'Model.Phase.completed' => 'completePhasePoints'
        );
    }

 	public function addEvidencePoints($event){

 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array('user_id' => $event->subject()->data['Evidence']['user_id'], 'origin_id' => $event->subject()->data['Evidence']['id'], 'origin' => 'evidence', 'value' => 20);
 		$point->saveAll($insertData);

 	}  

 	public function addRegisterPoints($event){

 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array('user_id' => $event->subject()->data['User']['id'], 'origin_id' => $event->subject()->data['User']['id'], 'origin' => 'register', 'value' => 250);
 		$point->saveAll($insertData);
 	}

 	public function addGroupPoints($event){

 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array('user_id' => $event->subject()->data['Group']['user_id'], 'origin_id' => $event->subject()->data['Group']['id'], 'origin' => 'group', 'value' => 1500);
 		$point->saveAll($insertData);
 	}

 	public function addAnswerPoints($event){

 		$point = ClassRegistry::init('Point');

 		$exists = $point->find('first', array('conditions' => array('user_id' => $event->subject()->data['UserAnswer']['user_id'], 'origin_id' => $event->subject()->data['UserAnswer']['question_id'], 'origin' => 'answer')));

 		if(!$exists){
	 		$point->create();
	 		$insertData = array('user_id' => $event->subject()->data['UserAnswer']['user_id'], 'origin_id' => $event->subject()->data['UserAnswer']['question_id'], 'origin' => 'answer', 'value' => 250);
	 		$point->saveAll($insertData);
	 	}
 	}

 	public function joinGroupPoints($event){

 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array('user_id' => $event->subject()->data['GroupsUser']['user_id'], 'origin_id' => $event->subject()->data['GroupsUser']['group_id'], 'origin' => 'groupJoin', 'value' => 1500);
 		$point->saveAll($insertData);
 	}

 	public function completePhasePoints($event){

 		$point = ClassRegistry::init('Point');

 		$exists = $point->find('first', array('conditions' => array('user_id' => $event->data['user_id'], 'origin_id' => $event->data['entity_id'], 'origin' => $event->data['entity'])));

 		if(!$exists){
	 		$point->create();
	 		$insertData = array('user_id' => $event->data['user_id'], 'origin_id' => $event->data['entity_id'], 'origin' => $event->data['entity'], 'value' => 1500);
	 		$point->saveAll($insertData);
	 	}
 	}

}

// $evidence = ClassRegistry::init('Evidence');
// $evidence->getEventManager()->attach(new PointListener());