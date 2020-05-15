<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::query()
            ->insert([
                ["name" => "Workshops"],
                ["name" => "Seminare"],
                ["name" => "Exkursionen"],
                ["name" => "Veranstaltungstipps"],
            ]);
    }
}
