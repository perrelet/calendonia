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

            $response = Http::acceptJson()->get($connection->url);

            if ($response->failed()) {

                dd("RERRER");
                continue;
            }

            $eventsService->clear($connection->id);
            
            $data['events'][$connection->id] = $this->process($response->json(), $connection);

        }

        return $data;

    }

    public function process ($payload, Connection $connection) {

        $events_service = new EventsService();
        $data = [];

        if ($payload) foreach ($payload as $event_data) {

            $data[] = $events_service->insert($event_data, $connection)->external_id;

        }

        return $data;

    }

}