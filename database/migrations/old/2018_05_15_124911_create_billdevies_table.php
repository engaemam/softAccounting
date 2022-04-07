<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBilldeviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billdevies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_id');
            $table->integer('device_id');
            $table->integer('quantity')->nullable();
            $table->float('price')->nullable();
            $table->float('total_price')->nullable();
            $table->float('total_final')->nullable();

            $table->string('item_id_devices')->nullable();
            $table->string('quantity_devices')->nullable();
            $table->string('price_devices')->nullable();
            $table->string('total_devices')->nullable();


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
        Schema::dropIfExists('billdevies');
    }
}
