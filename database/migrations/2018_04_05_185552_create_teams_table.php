<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('matches_won')->default(0);
            $table->integer('matches_lost')->default(0);
            $table->string('avatar_url')->nullable();
            $table->string('steamgroup')->nullable();
            $table->text('description')->nullable();
            $table->integer('team_owner_id')->unsigned();
            $table->integer('team_members_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('team_owner_id')
                ->references('id')
                ->on('users');

            $table->foreign('team_members_id')
                ->references('id')
                ->on('team_members');
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
