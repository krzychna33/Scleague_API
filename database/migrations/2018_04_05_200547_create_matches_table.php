<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inner_id');
            $table->integer('match_index');
            $table->dateTime('match_date')->nullable();
            $table->integer('maps_id')->unsigned();
            $table->integer('team1_id')->unsigned();
            $table->integer('team2_id')->unsigned();
            $table->integer('team1_score')->nullable();
            $table->integer('team2_score')->nullable();
            $table->integer('winner_id')->unsigned()->nullable();
            $table->integer('event_id')->unsigned();
            $table->timestamps();

            $table->foreign('team1_id')
                ->references('id')
                ->on('teams');

            $table->foreign('team2_id')
                ->references('id')
                ->on('teams');

            $table->foreign('winner_id')
                ->references('id')
                ->on('teams');

            $table->foreign('event_id')
                ->references('id')
                ->on('events');

            $table->foreign('maps_id')
                ->references('id')
                ->on('maps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
