<?php

use Illuminate\Database\Seeder;
use App\Event;

class EventsTableSeeder extends Seeder
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
            $event = new Event();
            $event->name = $faker->company();
            $event->description = $faker->realText();
            $event->prize = $i * 100;
            $event->save();
        }
    }
}
