<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(CategorySeeder::class);
//        $this->call(DegreeProgramSeeder::class);
//        $this->call(UniversitySeeder::class);
//        $this->call(AlumnusSeeder::class);
//        $this->call(TeamSeeder::class);
        $this->call(EventSeeder::class);

    }
}
