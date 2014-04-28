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

            'Model.UserFriend.notifyFollow' => 'notifyUserFollower',

            'Controller.AdminNotificationsUser.show' => 'notifyAdminNotification'
        );
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

    }

    public function notifyUserFollower($event){

        $note = ClassRegistry::init('Notifications');

        $note->create();

        $insertData = array(
            'user_id' => $event->subject()->data['UserFriend']['friend_id'],  
            'origin' => 'followUser', 
            'action_user_id' => $event->subject()->data['UserFriend']['user_id'],
        );

        $note->saveAll($insertData);

    }
}