<?php

App::uses('CakeEventListener', 'Event');
// App::uses('PointListener', 'Event');

class PointListener implements CakeEventListener {

	public function implementedEvents() {
        return array(

            'Model.Evidence.create' => 'createEvidencePoints',

            'Model.UserFriend.follow' => 'followUserPoints',

            'Model.UserAnswer.add' => 'addUserAnswerPoints',

            'Model.User.add' => 'addRegisterPoints',

            'Model.Group.create' => 'createGroupPoints',

            'Model.GroupsUser.join' => 'joinGroupPoints',

            'Controller.Phase.completed' => 'completePhasePoints',
            
            'Model.Comment.evidence' => 'commentEvidencePoints',
            
            'Model.Comment.evokation' => 'commentEvokationPoints',

            'Model.Like.evidence' => 'likeEvidencePoints',
            
            'Model.Vote.evokation' => 'voteEvokationPoints',
            
            'Model.EvokationFollower.add' => 'followEvokationPoints',
            
            'Model.Evidence.delete' => 'deletePoints',
            'Model.UserFriend.unfollow' => 'deletePoints',
            'Model.Group.delete' => 'deletePoints',
            'Model.GroupsUser.unjoin' => 'deletePoints',
            'Model.CommentRemove.evidence' => 'deletePoints',
            'Model.Unlike.evidence' => 'deletePoints',
            'Model.EvokationFollower.delete' => 'deletePoints',

        );
    }

    public function deletePoints($event){

    	$point = ClassRegistry::init('Point');

 		$exists = $point->find('first', array(
            'conditions' => array(
                'user_id' => $event->data['user_id'], 
                'origin_id' => $event->data['entity_id'], 
                'origin' => $event->data['entity']))
        );

 		if($exists){
	 		$point->delete($exists['Point']['id']);
	 	}
    }

 	public function createEvidencePoints($event){
        // $quests = ClassRegistry::init('Quest');

        // $quest = $quests->find('first', array('conditions' => array('Quest.id' => $event->subject()->data['Evidence']['quest_id'])));

 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array(
            'user_id' => $event->subject()->data['Evidence']['user_id'], 
            'origin_id' => $event->subject()->data['Evidence']['id'], 
            'origin' => $event->data['entity'], 
            'value' => $event->data['points']
        );
 		$point->saveAll($insertData);

 	} 

 	public function followUserPoints($event){
        //get the actual amount of points for this action
        $value = $event->data['points'];

 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array(
            'user_id' => $event->subject()->data['UserFriend']['user_id'], 
            'origin_id' => $event->subject()->data['UserFriend']['friend_id'], 
            'origin' => 'followUser', 
            'value' => $value
        );
 		$point->saveAll($insertData);
 	}

 	public function addRegisterPoints($event){
        //get the actual amount of points for this action
        $value = $event->data['points'];
        
        $point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array(
            'user_id' => $event->subject()->data['User']['id'], 
            'origin_id' => $event->subject()->data['User']['id'], 
            'origin' => 'register', 
            'value' => $value
        );

 		$point->saveAll($insertData);
 	}

 	public function createGroupPoints($event){
        //get the actual amount of points for this action
        $value = $event->data['points'];

 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array(
            'user_id' => $event->subject()->data['Group']['user_id'], 
            'origin_id' => $event->subject()->data['Group']['id'], 
            'origin' => 'group', 
            'value' => $value
        );
 		$point->saveAll($insertData);
 	}

 	public function joinGroupPoints($event){
        //get the actual amount of points for this action
        $value = $event->data['points'];

 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array(
            'user_id' => $event->subject()->data['GroupsUser']['user_id'], 
            'origin_id' => $event->subject()->data['GroupsUser']['group_id'], 
            'origin' => 'groupJoin', 
            'value' => $value
        );
 		$point->saveAll($insertData);
 	}

 	public function addUserAnswerPoints($event){

        $value = $event->data['points'];

 		$point = ClassRegistry::init('Point');

 		$exists = $point->find('first', array('conditions' => array('user_id' => $event->subject()->data['UserAnswer']['user_id'], 'origin_id' => $event->subject()->data['UserAnswer']['question_id'], 'origin' => 'answer')));

 		if(!$exists){
	 		$point->create();
	 		$insertData = array(
                'user_id' => $event->subject()->data['UserAnswer']['user_id'], 
                'origin_id' => $event->subject()->data['UserAnswer']['question_id'], 
                'origin' => 'answer', 
                'value' => $value
            );
	 		$point->saveAll($insertData);
	 	}
 	}

 	public function completePhasePoints($event){

        $value = $event->data['points'];

 		$point = ClassRegistry::init('Point');

 		$exists = $point->find('first', array('conditions' => array('user_id' => $event->data['user_id'], 'origin_id' => $event->data['entity_id'], 'origin' => $event->data['entity'])));

 		if(!$exists){
	 		$point->create();
	 		$insertData = array(
                'user_id' => $event->data['user_id'], 
                'origin_id' => $event->data['entity_id'], 
                'origin' => $event->data['entity'], 
                'value' => $value
            );
	 		$point->saveAll($insertData);
	 	}
 	}

 	public function commentEvidencePoints($event){
        //get the actual amount of points for this action
        $value = $event->data['points'];

 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array(
            'user_id' => $event->subject()->data['Comment']['user_id'], 
            'origin_id' => $event->subject()->data['Comment']['id'], 
            'origin' => 'commentEvidence', 
            'value' => $value
        );
 		$point->saveAll($insertData);

 	}

 	public function commentEvokationPoints($event){
        //get the actual amount of points for this action
        $value = $event->data['points'];

 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array(
            'user_id' => $event->subject()->data['Comment']['user_id'], 
            'origin_id' => $event->subject()->data['Comment']['evokation_id'], 
            'origin' => 'commentEvokation', 
            'value' => $value
        );
 		$point->saveAll($insertData);

 	}

 	public function likeEvidencePoints($event){
        //get the actual amount of points for this action
        $value = $event->data['points'];
        
 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array(
            'user_id' => $event->subject()->data['Like']['user_id'], 
            'origin_id' => $event->subject()->data['Like']['id'], 
            'origin' => 'likeEvidence', 
            'value' => $value
        );
 		$point->saveAll($insertData);
 	}

 	public function voteEvokationPoints($event){
        //get the actual amount of points for this action
        $value = $event->data['points'];

 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array(
            'user_id' => $event->subject()->data['Vote']['user_id'], 
            'origin_id' => $event->subject()->data['Vote']['evokation_id'], 
            'origin' => 'voteEvokation', 
            'value' => $value
        );
 		$point->saveAll($insertData);
 	}

 	public function followEvokationPoints($event){
        //get the actual amount of points for this action
        $value = $event->data['points'];

 		$point = ClassRegistry::init('Point');
 		$point->create();
 		$insertData = array(
            'user_id' => $event->subject()->data['EvokationFollower']['user_id'], 
            'origin_id' => $event->subject()->data['EvokationFollower']['evokation_id'], 
            'origin' => 'followEvokation', 
            'value' => $value
        );
 		$point->saveAll($insertData);

 	}

}

// $evidence = ClassRegistry::init('Evidence');
// $evidence->getEventManager()->attach(new PointListener());