<?php

use Illuminate\Database\Seeder;

class DegreeProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\DegreeProgram::query()
            ->insert([
                ["name" => "Maschinenbau"]
            ]);
    }
}
