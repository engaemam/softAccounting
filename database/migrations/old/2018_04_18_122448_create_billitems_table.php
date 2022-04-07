<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillitemsTable extends Migration
{

    public function up()
    {

        Schema::create('billitems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_id');

            $table->string('item_id');
            $table->string('quantity_b')->nullable();
            $table->string('price_b')->nullable();
            $table->string('total_price_b')->nullable();
            $table->string('total_final_b')->nullable();

            $table->string('device_id');
            $table->string('quantity')->nullable();
            $table->string('price')->nullable();
            $table->string('total_price')->nullable();
            $table->string('total_final')->nullable();

            $table->string('total_bill')->nullable();

            $table->string('type')->nullable();
            //$table->softDeletes();
            $table->timestamps();
        });

    }


    public function down()
    {
        Schema::dropIfExists('billitems');
    }
}
