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
        Schema::create('connections', function (Blueprint $table) {

            $table->id();
            $table->boolean('active')->nullable();
            $table->string('name');
            $table->string('url', 512);
            $table->json('tags');
            $table->dateTime('last_run')->nullable();
            $table->text('error')->nullable();
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
        Schema::dropIfExists('connections');
    }
};
