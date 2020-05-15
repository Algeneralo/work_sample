<?php

use App\Models\Alumnus;
use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = factory(Event::class, 5)->create();
        $imageUrl = Faker\Factory::create()->imageUrl(640, 480, null, false);
        foreach ($events as $item) {
            $item->addMediaFromUrl($imageUrl)->toMediaCollection('cover');
        }
        $alumni = Alumnus::all();

        // Populate the pivot table
        $events->each(function ($event) use ($alumni) {
            /** @var Event $event */
            $event->participants()->attach(
                $alumni->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
