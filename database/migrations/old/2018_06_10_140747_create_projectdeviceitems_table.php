<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectdeviceitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectdeviceitems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->integer('device_id');
            $table->string('item_id_invoice')->nullable();
            $table->string('quantity_invoice')->nullable();
            $table->string('price_invoice')->nullable();
            $table->string('total_invoice')->nullable();
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
        Schema::dropIfExists('projectdeviceitems');
    }
}
