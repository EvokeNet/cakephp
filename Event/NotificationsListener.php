<?php

App::uses('CakeEventListener', 'Event');
//App::uses('Session', 'Component');

class NotificationsListener implements CakeEventListener {

	public function implementedEvents() {
        return array(

            'Controller.Evidence.create' => 'notifyEvidenceCreated',

            'Controller.Phase.completed' => 'notifyCompletedPhase',

            //'Model.BadgesUser.notify' => 'notifyBadgeWon',

            'Controller.BasicTraining.completed' => 'notifyCompletedBasicTraining',

            'Controller.User.update' => 'notifyUserUpdate',

            'Model.Like.notify' => 'notifyLike',

            'Model.Comment.notifyEvidence' => 'notifyCommentedEvidence',

            'Model.Comment.notifyUpdateEvokation' => 'notifyCommentedUpdateEvokation',

            'Model.Comment.notifyEvokation' => 'notifyCommentedEvokation',

            'Model.Vote.notifyEvokation' => 'notifyVotedEvokation',

            'Model.UserFriend.notifyFollow' => 'notifyUserFollower',

            'Controller.AdminNotificationsUser.show' => 'notifyAdminNotification',

            'Controller.Mission.grit' => 'notifyGritBadge',
        );
    }

    public function notifyGritBadge($event){
        $note = ClassRegistry::init('Notifications');
        //$badge = ClassRegistry::init('Badges');

        $exists = $note->find('first', array('conditions' => array('user_id' => $event->data['user_id'], 'origin_id' => $event->data['entity_id'], 'origin' => $event->data['entity'])));

        // $note->create();

        //     $insertData = array(
        //         'user_id' => $event->data['user_id'], 
        //         'origin_id' => $event->data['entity_id'], 
        //         'origin' => $event->data['entity'], 
        //     );

        //     $note->saveAll($insertData);

        //     $userBadge = ClassRegistry::init('UserBadge');

        //     $userBadge->create();

        //     $insertData = array(
        //         'user_id' => $event->data['user_id'], 
        //         'badge_id' => $event->data['entity_id'], 
        //     );

        //     $userBadge->saveAll($insertData);

        //     $note->requestAction(array('controller' => 'notifications', 'action' => 'displayBadgeMessage', $event->data['entity_id']));
            
        if(!$exists){
            $note->create();

            $insertData = array(
                'user_id' => $event->data['user_id'], 
                'origin_id' => $event->data['entity_id'], 
                'origin' => $event->data['entity'], 
            );

            $note->saveAll($insertData);

            $userBadge = ClassRegistry::init('UserBadge');

            $userBadge->create();

            $insertData = array(
                'user_id' => $event->data['user_id'], 
                'badge_id' => $event->data['entity_id'], 
            );

            $userBadge->saveAll($insertData);

            $note->requestAction(array('controller' => 'notifications', 'action' => 'displayBadgeMessage', $event->data['entity_id']));

            $note->requestAction(array('controller' => 'notifications', 'action' => 'flushToRedis', $event->data['user_id'], $note->id));

        }
    }

    public function notifyUserUpdate($event){
        $note = ClassRegistry::init('Notifications');

        $note->create();

        $insertData = array(
            'user_id' => $event->data['user_id'], 
            'origin_id' => $event->data['origin_id'], 
            'origin' => $event->data['origin'], 
        );

        $note->saveAll($insertData);
    }
    
    public function notifyEvidenceCreated($event){

        $note = ClassRegistry::init('Notifications');

        $note->create();

        $insertData = array(
            'user_id' => $event->data['user_id'], 
            'origin_id' => $event->data['origin_id'], 
            'origin' => $event->data['origin'], 
        );

        $note->saveAll($insertData);

    }

    public function notifyCompletedPhase($event){

        $note = ClassRegistry::init('Notifications');

        $exists = $note->find('first', array('conditions' => array('user_id' => $event->data['user_id'], 'origin_id' => $event->data['entity_id'], 'origin' => $event->data['entity'])));

        if(!$exists){
            $note->create();

            $insertData = array(
                'user_id' => $event->data['user_id'], 
                'origin_id' => $event->data['entity_id'], 
                'origin' => $event->data['entity'], 
            );

            $note->saveAll($insertData);

            //$note->requestAction(array('controller' => 'notifications', 'action' => 'displayPhaseMessage', $event->data['entity_id'], $event->data['next_phase']));
            $note->requestAction(array('controller' => 'notifications', 'action' => 'displayPhaseMessage', $event->data['phase_name'], $event->data['next_phase'], $event->data['mission_id']));

            $note->requestAction(array('controller' => 'notifications', 'action' => 'flushToRedis', $event->data['user_id'], $note->id));

        }

        //$note->requestAction(array('controller' => 'notifications', 'action' => 'displayPhaseMessage', $event->data['phase_name'], $event->data['next_phase'], $event->data['mission_id']));
        //$note->requestAction(array('controller' => 'notifications', 'action' => 'displayPhaseMessage', $event->data['entity_id'], $event->data['next_phase']));

    }

    public function notifyCompletedBasicTraining($event){

        $note = ClassRegistry::init('Notifications');

        $note->create();

        $insertData = array(
            'user_id' => $event->data['user_id'], 
            'origin_id' => $event->data['entity_id'], 
            'origin' => $event->data['entity'], 
        );

        $note->saveAll($insertData);

        $note->requestAction(array('controller' => 'notifications', 'action' => 'displayBasicTrainingMessage', $event->data['user_id']));

        $note->requestAction(array('controller' => 'notifications', 'action' => 'flushToRedis', $event->data['user_id'], $note->id));

    }


    public function notifyAdminNotification($event){

        $note = ClassRegistry::init('Notifications');

        $note->requestAction(array('controller' => 'notifications', 'action' => 'displayAdminMessage', $event->data['user_id'], $event->data['entity_id']));

    }


    public function notifyLike($event){

        $note = ClassRegistry::init('Notifications');

        $note->create();

        $insertData = array(
            'user_id' => $event->data['user_id'], 
            'origin_id' => $event->subject()->data['Like']['evidence_id'], 
            'origin' => 'like',
            'action_user_id' => $event->subject()->data['Like']['user_id']
        );

        $note->saveAll($insertData);

        // $note->requestAction(array('controller' => 'notifications', 'action' => 'flushToRedis', $event->data['user_id'], $note->id));

        $note->requestAction(array('controller' => 'notifications', 'action' => 'flushToRedis', 
            $event->data['user_id'], $note->id, $event->subject()->data['Like']['user_id'], $event->subject()->data['Like']['evidence_id'], 'like'));

    }

    public function notifyCommentedEvidence($event){

        $note = ClassRegistry::init('Notifications');

        $note->create();

        $insertData = array(
            'user_id' => $event->data['user_id'], 
            'origin_id' => $event->subject()->data['Comment']['evidence_id'], 
            'origin' => 'commentEvidence',
            'action_user_id' => $event->subject()->data['Comment']['user_id']
        );

        $note->saveAll($insertData);

        $note->requestAction(array('controller' => 'notifications', 'action' => 'flushToRedis', 
            $event->data['user_id'], $note->id, $event->subject()->data['Comment']['user_id'], $event->subject()->data['Comment']['evidence_id'], 'comment'));

    }

    public function notifyCommentedEvokation($event){

        $note = ClassRegistry::init('Notifications');

        $note->create();

        $aux = $event->data;

        $insertData = array();

        for($i = 0; $i < $event->data['array_count']; $i++){
            
            $insertData = array(
                'user_id' => $event->data[$i], 
                'origin_id' => $event->subject()->data['Comment']['evokation_id'], 
                'origin' => 'commentEvokation',
                'action_user_id' => $event->subject()->data['Comment']['user_id']
            );

            $note->saveAll($insertData);

            $note->requestAction(array('controller' => 'notifications', 'action' => 'flushToRedis', $event->data['user_id'], $note->id));

        }

    }

    public function notifyVotedEvokation($event){

        $note = ClassRegistry::init('Notifications');

        $note->create();

        $aux = $event->data;

        $insertData = array();

        for($i = 0; $i < $event->data['array_count']; $i++){
            
            $insertData = array(
                'user_id' => $event->data[$i], 
                'origin_id' => $event->subject()->data['Vote']['evokation_id'], 
                'origin' => 'voteEvokation',
                'action_user_id' => $event->subject()->data['Vote']['user_id']
            );

            $note->saveAll($insertData);

            $note->requestAction(array('controller' => 'notifications', 'action' => 'flushToRedis', $event->data['user_id'], $note->id));

        }

    }

    // public function notifyCommentedUpdateEvokation($event){

    //     $note = ClassRegistry::init('Notifications');

    //     $note->create();

    //     $insertData = array(
    //         'user_id' => $event->data['user_id'], 
    //         'origin_id' => $event->subject()->data['Comment']['evokation_id'], 
    //         'origin' => 'commentUpdateEvokation',
    //         'action_user_id' => $event->subject()->data['Comment']['user_id']
    //     );

    //     $note->saveAll($insertData);

    // }

    // public function notifyCommentedEvokation($event){

    //     $note = ClassRegistry::init('Notifications');

    //     $note->create();

    //     $insertData = array(
    //         'user_id' => $event->data['user_id'], 
    //         'origin_id' => $event->subject()->data['Comment']['evokation_id'], 
    //         'origin' => 'commentEvokation',
    //         'action_user_id' => $event->subject()->data['Comment']['user_id']
    //     );

    //     $note->saveAll($insertData);

    // }

    // public function notifyVotedEvokation($event){

    //     $note = ClassRegistry::init('Notifications');

    //     $note->create();

    //     $insertData = array(
    //         'user_id' => $event->data['user_id'], 
    //         'origin_id' => $event->subject()->data['Vote']['evokation_id'], 
    //         'origin' => 'votedEvokation',
    //         'action_user_id' => $event->subject()->data['Vote']['user_id']
    //     );

    //     $note->saveAll($insertData);

    // }

    public function notifyUserFollower($event){

        $note = ClassRegistry::init('Notifications');

        $note->create();

        $insertData = array(
            'user_id' => $event->subject()->data['UserFriend']['friend_id'],  
            'origin' => 'followUser', 
            'action_user_id' => $event->subject()->data['UserFriend']['user_id'],
        );

        $note->saveAll($insertData);

        $note->requestAction(array('controller' => 'notifications', 'action' => 'flushToRedis', $event->data['user_id'], $note->id));

    }
}