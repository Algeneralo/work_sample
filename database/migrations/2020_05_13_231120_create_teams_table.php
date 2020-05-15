<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 40);
            $table->string('last_name', 40);
            $table->enum('gender', ["m","f"]);
            $table->string('street', 80);
            $table->string('street_number', 40);
            $table->string('postcode', 40);
            $table->string('city', 40);
            $table->string('email', 100)->unique();
            $table->date('dob');
            $table->string('telephone', 50);
            $table->string('mobile', 50);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
