<?php

use Illuminate\Database\Seeder;

class AlumnusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alumni = factory(\App\Models\Alumnus::class, 3)->create(["is_team_member" => 0]);
        $imageUrl = Faker\Factory::create()->imageUrl(640, 480, null, false);
        foreach ($alumni as $alumnus) {
            $alumnus->addMediaFromUrl($imageUrl)->toMediaCollection('avatar');
        }
    }
}
