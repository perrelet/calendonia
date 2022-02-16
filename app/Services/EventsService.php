<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Connection;

class EventsService {

    public function clear ($connection_id) {

        Event::where('connection_id', $connection_id)->delete();

    }

    public function insert ($event_data, Connection $connection) {

        $event = (new Event($event_data));
        $event->brand($connection);

        //dd($event);
        $event->save();

        return $event;

    }

}