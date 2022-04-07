<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeConstraintColumnType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billitems', function (Blueprint $table) {
            $table->unsignedInteger('item_id')->change();
            $table->foreign('item_id')->references('id')->on('items')
                ->onDelete('cascade');
                //->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('billitems', function (Blueprint $table) {
            $table->integer('item_id',10)->unsigned()->change();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->integer('size',10)->unsigned()->nullable()->change();
            $table->foreign('size')->references('id')->on('items_sizes')->onDelete('set null');

        });
    }
}
