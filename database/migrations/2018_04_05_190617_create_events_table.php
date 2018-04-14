<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_index')->default(1);
            $table->string('name');
            $table->text('description');
            $table->integer('prize');
            $table->integer('slots');
            $table->integer('winner_id')->unsigned()->nullable();
            $table->boolean('joinable')->default(true);
            $table->boolean('active')->default(true);
            $table->dateTime('start_at');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('winner_id')
                ->references('id')
                ->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event');
    }
}
