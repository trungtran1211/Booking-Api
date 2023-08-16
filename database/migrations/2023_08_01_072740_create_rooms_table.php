<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('room_type_id');
            $table->string('address');
            $table->integer('capacity');
            $table->boolean('is_available')->default(true);
            $table->string('room_number');
            $table->text('description');
            $table->decimal('price_per_night', 10, 2);
            $table->string('cover_image')->nullable();
            $table->text('amenities')->nullable();
            $table->text('availability_dates')->nullable();
            $table->decimal('rating', 3, 2)->nullable();
            $table->text('reviews')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('floor_number')->nullable();
            $table->integer('bed_count')->nullable();
            $table->integer('bathroom_count')->nullable();
            $table->string('view_type')->nullable();
            $table->timestamps();

            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('room_type_id')->references('id')->on('room_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
