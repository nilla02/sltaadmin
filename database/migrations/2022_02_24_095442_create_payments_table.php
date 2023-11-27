<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collector_id')->nullable()->constrained()->nullable()->onDelete('set null');
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->foreignId('declaration_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('payment', 11, 2);
            $table->string('payment_type');
            $table->string('payment_sub_type')->nullable();
            $table->string('payment_url')->nullable();
            $table->string('payment_back_url')->nullable();
            $table->integer('batch_number')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
