<?php

use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\University::query()
            ->insert([
                ["name" => "Ruhr-Universität Bochum"]
            ]);
    }
}
