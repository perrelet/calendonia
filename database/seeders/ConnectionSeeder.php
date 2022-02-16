<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConnectionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('connections')->truncate();

        DB::table('connections')->insert([
            [
                'name'  => 'Study Hub',
                'url'   => 'https://hub.21gratitudes.com/wp-json/hub/v1/events',
                'tags'  => json_encode(['online', 'hub'])
            ],
            [
                'name'  => 'Courses',
                'url'   => 'https://courses.21gratitudes.com/wp-json/dko/v1/events',
                'tags'  => json_encode(['online', 'courses'])
            ],
            [
                'name'  => '21G',
                'url'   => 'https://21gratitudes.com/wp-json/21g/v1/events',
                'tags'  => json_encode(['online', 'events'])
            ],
        ]);

    }
}
