<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobMarketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_markets', function (Blueprint $table) {
            $table->id();
            $table->string('employer', 80);
            $table->string('offer', 80);
            $table->string("category", 100);
            $table->string("city", 100);
            $table->enum('working_hours', ["full_time", "part_time"]);
            $table->date('beginning');
            $table->longText('details');
            $table->string('duration');
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
        Schema::dropIfExists('job_markets');
    }
}
