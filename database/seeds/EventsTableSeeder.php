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
            $event->slots = 16;
            $event->start_at = (new DateTime('2020-06-20 22:10:42'))->format("Y-m-d H:i:s");
            $event->save();
        }
    }
}
