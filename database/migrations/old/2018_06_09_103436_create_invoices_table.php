<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('invoice_number')->nullable();
            $table->integer('client_id');
            $table->DATE('date')->nullable();
            $table->string('currency_id')->nullable();
            $table->string('notes')->nullable();
            $table->float('total_final_mgza')->nullable();
            $table->float('total_final_mogma3')->nullable();
            $table->float('total_invoice')->nullable();
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
