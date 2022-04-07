<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importitems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('import_id');

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
        Schema::dropIfExists('importitems');
    }
}
