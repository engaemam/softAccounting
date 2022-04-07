<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAddInYourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('phone');
            $table->string('mobile');
            $table->unsignedBigInteger('country_id');

            //Start Supllier
            $table->string('suppliers_name');
            $table->string('manager_name');
            $table->string('position_manger');
            $table->string('suppliers_number');
            //Start Supllier

            //Start Client
            $table->string('name_company');
            $table->string('name_client');
            $table->string('client_position');
            $table->string('notes');
            //End Clients
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            //
        });
    }
}
