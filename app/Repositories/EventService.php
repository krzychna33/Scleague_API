<?php


namespace App\Repositories;
use App\Event;

class EventService{

    public function switchToNotJoinable(Event $event){
        $event->joinable = 0;
        $event->save();
    }
}