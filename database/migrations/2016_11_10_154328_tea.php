<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tea_log', function(Blueprint $blueprint)
        {
            $blueprint->increments('id');
            $blueprint->string('user');
            $blueprint->timestamps();
        });
        
        Schema::create('drinks', function(Blueprint $blueprint)
        {
            $blueprint->increments('id');
            $blueprint->string('user');
            $blueprint->string('drink');
            $blueprint->integer('sugar');
            $blueprint->string('milk');
            $blueprint->string('busy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tea_log');
        Schema::dropIfExists('drinks');
    }
}
