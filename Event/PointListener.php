<?php

App::uses('CakeEventListener', 'Event');
// App::uses('PointListener', 'Event');

class PointListener implements CakeEventListener {

	public function implementedEvents() {
        return array(
            'Model.Evidence.add' => 'addEvidencePoints',
            'Model.Evidence.delete' => 'deleteEvidencePoints',

            'Model.UserFriend.follow' => 'followUserPoints',

            'Model.Answer.add' => 'addAnswerPoints',
            'Model.User.add' => 'addRegisterPoints',
            'Model.Group.create' => 'addGroupPoints',
            'Model.GroupsUser.join' => 'joinGroupPoints',
            'Model.Phase.completed' => 'completePhasePoints',
            'Model.Comment.evidence' => 'commentEvidencePoints',
            'Model.Comment.evokation' => 'commentEvokationPoints',
            'Model.Like.evidence' => 'likeEvidencePoints',
            'Model.Vote.evokation' => 'voteEvokationPoints',
            'Model.EvokationFollower.add' => 'followEvokationPoints'
        );
    }

 	public function addEvidencePoints($event){

 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array('user_id' => $event->subject()->data['Evidence']['user_id'], 'origin_id' => $event->subject()->data['Evidence']['id'], 'origin' => 'evidence', 'value' => 20);
 		$point->saveAll($insertData);

 	} 

 	public function deleteEvidencePoints($event){

 		$point = ClassRegistry::init('Point');

 		$exists = $point->find('first', array('conditions' => array('user_id' => $event->data['user_id'], 'origin_id' => $event->data['entity_id'], 'origin' => 'evidence')));

 		if($exists)
 			$exists->delete();

 	}   

 	public function followUserPoints($event){

 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array('user_id' => $event->subject()->data['UserFriend']['user_id'], 'origin_id' => $event->subject()->data['UserFriend']['friend_id'], 'origin' => 'followUser', 'value' => 5);
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

 	public function commentEvidencePoints($event){

 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array('user_id' => $event->subject()->data['Comment']['user_id'], 'origin_id' => $event->subject()->data['Comment']['evidence_id'], 'origin' => 'commentEvidence', 'value' => 5);
 		$point->saveAll($insertData);

 	}

 	public function commentEvokationPoints($event){

 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array('user_id' => $event->subject()->data['Comment']['user_id'], 'origin_id' => $event->subject()->data['Comment']['evokation_id'], 'origin' => 'commentEvokation', 'value' => 5);
 		$point->saveAll($insertData);

 	}

 	public function likeEvidencePoints($event){

 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array('user_id' => $event->subject()->data['Like']['user_id'], 'origin_id' => $event->subject()->data['Like']['evidence_id'], 'origin' => 'likeEvidence', 'value' => 1);
 		$point->saveAll($insertData);
 	}

 	public function voteEvokationPoints($event){

 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array('user_id' => $event->subject()->data['Vote']['user_id'], 'origin_id' => $event->subject()->data['Vote']['evokation_id'], 'origin' => 'voteEvokation', 'value' => 1);
 		$point->saveAll($insertData);
 	}

 	public function followEvokationPoints($event){

 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array('user_id' => $event->subject()->data['EvokationFollower']['user_id'], 'origin_id' => $event->subject()->data['EvokationFollower']['evokation_id'], 'origin' => 'followEvokation', 'value' => 5);
 		$point->saveAll($insertData);

 	}
}

// $evidence = ClassRegistry::init('Evidence');
// $evidence->getEventManager()->attach(new PointListener());