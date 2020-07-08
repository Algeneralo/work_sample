<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVoluntaryTypeToExperiencesTable extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE experiences MODIFY  type ENUM('work', 'education','voluntary')");
    }

    public function down()
    {
        Schema::table('experiences', function (Blueprint $table) {
            //
        });
    }
}