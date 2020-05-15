<?php

use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = factory(\App\Models\Team::class, 3)->create(["is_team_member" => 1]);
        $imageUrl = Faker\Factory::create()->imageUrl(640, 480, "business", false);
        foreach ($teams as $team) {
            $team->addMediaFromUrl($imageUrl)->toMediaCollection('avatar');
        }
    }
}
