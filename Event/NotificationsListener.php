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

        $note = ClassRegistry::init('Notification');

        $note->create();
        
        $insertData = array(
            'user_id' => $event->subject()->data['Evidence']['user_id'], 
            'origin_id' => $event->subject()->data['Evidence']['id'], 
            'origin' => 'evidence', 
            'value' => $value
        );
        $point->saveAll($insertData);

    }
}