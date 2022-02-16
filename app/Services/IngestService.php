<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class IngestService {

    public function injest (Collection $connections) {

        if ($connections) foreach ($connections as $connection) {
            
            $response = Http::acceptJson()->get($connection->url);

            if ($response->failed()) {

                dd("RERRER");
                continue;
            }

            $this->process($response->json());

        }

    }

    public function process ($payload) {

        dd($payload);

        //return $connection_id ? $connection_id : "Processing...";

    }

}