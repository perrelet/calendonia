<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {

            $table->id();

            $table->string('title')->comment("*");
            $table->string('type')->comment("*");
            $table->string('sub_title')->nullable();
            $table->text('body')->nullable();
            //$table->json('tags')->comment("* JSON: List of tags associated with the event. {'tag_1', 'tag_2', ... }");
            $table->float('importance')->nullable()->default('0.0')->comment("Level of promiance for listing the event. 0 = default. 10 = featured.");

            $table->integer('connection_id')->comment("*");
            $table->text('external_id')->comment("*");

            $table->boolean('hide')->nullable();
            $table->dateTime('show_after')->nullable();
            $table->dateTime('hide_after')->nullable();

            $table->string('url', 512)->nullable()->comment("Primary URL to the event listing.");
            $table->string('access_url', 512)->nullable()->comment("URL place where users can access the actual event.");
            $table->string('admin_url', 512)->nullable()->comment("URL to backend / config area where event can be editted.");
            $table->json('links')->nullable()->comment("JSON: List of social / external / other related urls. [{'label': 'Example', 'url': 'https://example.com'}, ... ]");

            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('timezone')->default('Europe/London');
            $table->json('sub_dates')->nullable()->comment("JSON: List of secondary dates [{'date': 'Y-m-d H:i:s', 'label': 'Sub Event'}, ... ]");

            $table->string('image', 512)->nullable();
            $table->string('thumb', 512)->nullable();
            $table->string('video', 512)->nullable();
            $table->string('embed', 1024)->nullable();
            $table->json('medias')->nullable()->comment("JSON: List of additional media files (gallery) associated [{'label': 'Image 1', 'url': 'https://example.com/img.jpg'}, ... ]");
            
            $table->integer('capacity')->nullable()->comment('Total number of spaces available for booking.');
            $table->string('prerequisites', 512)->nullable()->comment('Description of prerequisites required to participate.');
            $table->string('disclaimer', 512)->nullable()->comment('Any warning or disclaimer required.');

            $table->boolean('virtual')->comment('Whether the event is physical or virtual.')->nullable();
            $table->string('host')->nullable();
            $table->json('organisers')->nullable()->comment("JSON: List of organisers / secondary hosts. [{'name': 'Jill', 'role': 'artist'}, ... ]");;
            $table->json('artists')->nullable()->comment("JSON: List of artists / talent. [{'name': 'Jill', 'role': 'artist'}, ... ]");;
            $table->string('venue')->nullable();
            $table->string('company')->nullable();
            
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('address_3')->nullable();
            $table->string('post_code')->nullable();
            $table->string('country')->nullable();
            $table->string('lat_long')->nullable()->comment("Longitude and latitude of the event.");

            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_fax')->nullable();
            $table->json('contact_other')->nullable()->comment("JSON: List of other methods contacts. [{'label': 'WhatsApp', 'value': '+41 123 456 7689'}, ... ]");

            $table->float('price')->nullable()->comment("Single price value for simple pricing.");
            $table->float('plan')->nullable()->comment("Subscription / plan / membership pricing option description.");
            $table->string('ticket_url', 512)->nullable()->comment("Single ticket url for simple pricing.");
            $table->json('tickets')->nullable()->comment("JSON: List of tickets for advanced pricing [{'label': 'Adult', 'price': '19.00', url: 'https://tickets.com/adult'}, ... ]");
            $table->string('currency')->nullable();

            $table->json('meta')->nullable()->comment("JSON: Additional meta data. {'key1': 'value1', 'key2': 'value2', ... }");

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
