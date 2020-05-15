<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 40);
            $table->string('last_name', 40);
            $table->enum('gender', ["m", "f"]);
            $table->string('street', 80);
            $table->string('street_number', 40);
            $table->string('postcode', 40);
            $table->string('city', 40);
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            $table->date('dob');
            $table->foreignId('university_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('degree_program_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('alumni_year', 4)->nullable();
            $table->text('description')->nullable();
            $table->string('telephone', 50);
            $table->string('mobile', 50);
            $table->boolean('is_team_member')->default(0);
            $table->boolean('blocked')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->index("is_team_member");
            $table->index(["email", "first_name", "last_name", "city"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumni');
    }
}
