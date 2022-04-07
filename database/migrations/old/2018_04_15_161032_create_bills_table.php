<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bill_number')->nullable();
            $table->DATE('date')->nullable();
            $table->string('notes')->nullable();
            $table->float('price_before_doller')->nullable();
            $table->float('price_doller')->nullable();
            $table->float('price_eg')->nullable();
            $table->integer('supplier_id');
            $table->string('total_bill')->nullable();
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
        Schema::dropIfExists('bills');
    }
}
