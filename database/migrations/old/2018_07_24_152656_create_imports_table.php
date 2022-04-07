<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number')->nullable();
            $table->integer('supplier_id');
            $table->DATE('date')->nullable();
            $table->float('price_doller')->nullable();
            $table->string('notes')->nullable();
            $table->string('currency_id')->nullable();
            $table->string('total_final_mgza')->nullable();
            $table->string('total_final_mogma3')->nullable();
            $table->string('total_final')->nullable();
            $table->string('total_import')->nullable();
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
        Schema::dropIfExists('imports');
    }
}
