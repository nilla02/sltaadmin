<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('batch_number');
            $table->string('sage_customer_id');
            $table->string('sage_invoice_number');
            $table->string('status');
            $table->decimal('amount', 11, 2);
            $table->string('date');
            $table->string('termcode');
            $table->string('shiptoste1')->nullable();
            $table->string('shiptoste2')->nullable();
            $table->string('shiptoste3')->nullable();
            $table->string('shiptoste4')->nullable();
            $table->string('shiptoctac')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
