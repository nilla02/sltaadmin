<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('EDCardPropertyId')->nullable();
            $table->string('sageId')->nullable();
            $table->string('name');
            $table->string('tradeName');
            $table->string('vatTaxpayerAccount');
            $table->string('Location');
            $table->string('mailingAddress');
            $table->integer('noOfRooms');
            $table->string('typeOfProperty');
            $table->string('ownerName');
            $table->string('ownerPosition');
            $table->string('ownerEmail');
            $table->string('managerName');
            $table->string('managerPosition');
            $table->string('managerEmail');
            $table->string('accountantName');
            $table->string('accountantPosition');
            $table->string('accountantEmail');
            $table->string('primaryContactName');
            $table->string('primaryContactPosition');
            $table->string('primaryContactEmail');
            $table->tinyinteger('applicableClassAndRate');
            $table->string('vat');
            $table->string('coicogs');
            $table->string('business');
            $table->string('government_id');
            $table->string('signed');
            $table->string('message')->nullable();
            $table->timestamps();
            $table->tinyinteger('accepted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
