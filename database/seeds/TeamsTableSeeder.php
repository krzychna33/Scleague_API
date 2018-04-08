<?php

use Illuminate\Database\Seeder;
use App\Team;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for($i=0; $i<10; $i++){
            $team = new Team();
            $team->name = $faker->name();
            $team->team_owner_id = 1;
            $team->save();
        }
    }
}
