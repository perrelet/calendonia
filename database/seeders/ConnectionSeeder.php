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
            ['name' => 'Study Hub', 'url' => 'https://hub.21gratitudes.com/route', 'tags' => json_encode(['hub'])],
        ]);

    }
}
