<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->bigInteger('collector_created')->unsigned()->nullable();
            $table->bigInteger('collector_updated')->unsigned()->nullable();
            $table->string('arrivalDate');
            $table->string('roomNumber');
            $table->integer('ageOfGuest');
            $table->string('guestExempted')->nullable();
            $table->string('firstName');
            $table->string('lastName');
            $table->integer('numberOfNights');
            $table->string('color');
            $table->timestamps();

            $table->foreign('collector_created', 'collector_id')->references('id')->on('collectors')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accommodations');
    }
}
