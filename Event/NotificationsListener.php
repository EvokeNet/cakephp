<?php

App::uses('CakeEventListener', 'Event');
// App::uses('PointListener', 'Event');

class NotificationsListener implements CakeEventListener {

	public function implementedEvents() {
        return array(
            'Controller.Phase.notifyCompleted' => 'notifyCompletedPhase',
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
}