<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceitemsTable extends Migration
{

    public function up()
    {
        Schema::create('invoiceitems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id');
            $table->string('item_id');
            $table->string('quantity_b')->nullable();
            $table->string('price_b')->nullable();
            $table->string('total_price_b')->nullable();
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
        Schema::dropIfExists('invoiceitems');
    }
}
