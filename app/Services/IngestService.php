<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use App\Models\Connection;

class IngestService {

    public function injest (Collection $connections) {

        $eventsService = new EventsService();

        $data = [
            'events' => [],
        ];

        if ($connections) foreach ($connections as $connection) {

            if (!$connection->active) continue;

            $connection->error = null;
            $connection->last_run = date("Y-m-d H:i:s");

            try {

                $response = Http::acceptJson()->get($connection->url);

            } catch (\Exception $e) {

                $connection->error = "Error connecting to connection {$connection->id}: " . $e->getMessage();
                $connection->save();
                continue;

            }

            //$eventsService->clear($connection->id);
            
            $data['events'][$connection->id] = $this->process($response->json(), $connection);
            
            $connection->save();

        }

        return $data;

    }

    public function process ($payload, Connection $connection) {

        $events_service = new EventsService();
        $data = [];

        $events_service->delete_unlisted(array_keys($payload), $connection);

        if ($payload) foreach ($payload as $external_id => $event_data) {

            $data[] = $events_service->insert($event_data, $connection)->external_id;

        }

        return $data;

    }

}