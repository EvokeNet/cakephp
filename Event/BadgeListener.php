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
    }
}