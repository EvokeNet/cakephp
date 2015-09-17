<?php

App::uses('CakeEventListener', 'Event');
//App::uses('Session', 'Component');

class BadgeListener implements CakeEventListener {

	public function implementedEvents() {
        return array(
            'Model.BadgesUser.won' => 'notifyBadgeWon',
        );
    }

    public function notifyBadgeWon($event){
        //insert data in BadgesUser then dispatch lightbox notification
        $userBadge = ClassRegistry::init('UserBadge');

        $userBadge->create();

        $insertData = array(
            'user_id' => $event->data['user_id'], 
            'badge_id' => $event->data['badge_id'], 
        );

        $userBadge->saveAll($insertData);
        //now dispatch a notification as a lightbox!..

        $note = ClassRegistry::init('Notifications');
        $note->requestAction(array('controller' => 'notifications', 'action' => 'displayBadgeMessage', $event->data['badge_id']));
    }
}