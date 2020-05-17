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
        $dev = factory(\App\Models\Alumnus::class)->create(["is_team_member" => 0, "email" => "alumni@development.it"]);
        $alumni = factory(\App\Models\Alumnus::class, 3)->create(["is_team_member" => 0]);

        $imageUrl = Faker\Factory::create()->imageUrl(640, 480, "business", false);
        $dev->addMediaFromUrl($imageUrl)->toMediaCollection('avatar');
        foreach ($alumni as $alumnus) {
            $alumnus->addMediaFromUrl($imageUrl)->toMediaCollection('avatar');
        }
    }
}
