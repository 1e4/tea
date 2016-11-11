<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Round extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('round', function(Blueprint $blueprint)
        {
            $blueprint->increments('id');
            $blueprint->string('started_by'); //Who started the round
            $blueprint->string('chosen'); //Who is chosen
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('round');
    }
}
