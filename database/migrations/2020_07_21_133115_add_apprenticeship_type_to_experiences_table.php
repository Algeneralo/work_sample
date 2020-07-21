<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprenticeshipTypeToExperiencesTable extends Migration
{
    public function up()
    {
        Schema::table('experiences', function (Blueprint $table) {
            DB::statement("ALTER TABLE experiences MODIFY  type ENUM('work', 'education','voluntary','apprenticeship')");

        });
    }

    public function down()
    {
        Schema::table('experiences', function (Blueprint $table) {
            //
        });
    }
}