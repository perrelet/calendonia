<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Connection;

class EventsService {

    public function get_event ($event_data, Connection $connection) {

        $event = Event::
        where('connection_id', '=', $connection->id)
        ->where('external_id', '=', $event_data['external_id'])
        ->first();

        if (is_null($event)) {
            
            $event = (new Event($event_data));

        } else {

            $event->fill($event_data);

        }

        $event->connection_id = $connection->id;

        $event->save();

        if (isset($event_data['tags'])) $event->attachTags($event_data['tags']);
        if ($connection->tags)          $event->attachTags($connection->tags);

        $event->save();
        
        return $event;

    }

    public function delete_by_connection (Connection $connection) {

        Event::where('connection_id', '=', $connection->id)->delete();

    }

    public function delete_unlisted (Array $external_ids, Connection $connection) {

        Event::
        where('connection_id', '=', $connection->id)
        ->whereNotIn('external_id', $external_ids)
        ->delete();

    }

    public function insert ($event_data, Connection $connection) {

        $event = $this->get_event($event_data, $connection);

        if (!$event->connection_id) dd($event);

        return $event;

    }

    public function group_events ($events, $group_by = "F Y") {

        $grouped = [];

        foreach ($events as $event) {

            $group = $event->get_start_date($group_by);
            if (!isset($grouped[$group])) $grouped[$group] = [];
            $grouped[$group][] = $event;

        }

        return $grouped;

    }

}