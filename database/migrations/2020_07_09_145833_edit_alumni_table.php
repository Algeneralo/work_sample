<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditAlumniTable extends Migration
{
    public function up()
    {
        Schema::table('alumni', function (Blueprint $table) {
            $table->string('street', 80)->nullable()->change();
            $table->string('street_number', 40)->nullable()->change();
            $table->string('postcode', 40)->nullable()->change();
            $table->string('city', 40)->nullable()->change();
            $table->date('dob')->nullable()->change();
            $table->string('telephone', 50)->nullable()->change();
            $table->string('mobile', 50)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('alumni', function (Blueprint $table) {
            //
        });
    }
}