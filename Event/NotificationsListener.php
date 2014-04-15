<?php

App::uses('CakeEventListener', 'Event');
// App::uses('PointListener', 'Event');

class NotificationsListener implements CakeEventListener {

	public function implementedEvents() {
        return array(
            'Controller.Phase.notifyCompleted' => 'notifyCompletedPhase',

            'Model.Like.notify' => 'notifyLike',

            'Model.Comment.notifyEvidence' => 'notifyCommentedEvidence',

            'Model.UserFriend.notifyFollow' => 'notifyUserFollower',
        );
    }

    public function notifyCompletedPhase($event){

        $note = ClassRegistry::init('Notifications');

        $note->create();

        $insertData = array(
            'user_id' => $event->data['user_id'], 
            'origin_id' => $event->data['entity_id'], 
            'origin' => $event->data['entity'], 
        );

        $note->saveAll($insertData);

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