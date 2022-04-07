<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportdeviceitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importdeviceitems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('import_id');
            $table->integer('device_id');
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
        Schema::dropIfExists('importdeviceitems');
    }
}
