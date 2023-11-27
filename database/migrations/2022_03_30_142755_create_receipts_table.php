<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->string('sage_system_id')->nullable();
            $table->string('number');
            $table->string('sage_invoice_number')->nullable();
            $table->string('title')->nullable();
            $table->string('sage_customer_id');
            $table->string('property_name')->nullable();
            $table->string('date');
            $table->string('reference')->nullable();
            $table->decimal('amount', 11, 2);
            $table->string('currency');
            $table->string('payment_type');
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
        Schema::dropIfExists('receipts');
    }
}
