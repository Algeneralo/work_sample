<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryLinkedFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_linked_friends', function (Blueprint $table) {
            $table->id();
            $table->foreignId("gallery_id")->constrained()->cascadeOnDelete();
            $table->foreignId("alumni_id")->constrained("alumni")->cascadeOnDelete();
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
        Schema::dropIfExists('gallery_linked_friends');
    }
}
