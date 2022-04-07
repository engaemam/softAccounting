<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectitems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');
            $table->integer('project_id');
            $table->integer('devices_id')->nullable();
            $table->float('price_item')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('total_price')->nullable();
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
        Schema::dropIfExists('projectitems');
    }
}
