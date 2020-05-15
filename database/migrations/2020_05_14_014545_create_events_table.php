<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->string('street', 80);
            $table->string('street_number', 40);
            $table->string('postcode', 40);
            $table->string('city', 40);
            $table->longText('details');
            $table->integer('max_participants')->nullable();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->foreignId("category_id");
            $table->softDeletes();
            $table->timestamps();

            $table->index(["name", "start_time", "end_time", "date"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
