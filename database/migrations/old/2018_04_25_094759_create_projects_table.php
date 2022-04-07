<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_client')->nullable();
            $table->integer('project_number')->nullable();
            $table->dateTime('project_start_date');
            $table->dateTime('project_creation_date');
            $table->date('date_delivery')->nullable();
            $table->date('date_expirat')->nullable();
            $table->float('project_value')->nullable();
            $table->string('image_deal')->nullable();
            $table->string('name')->nullable();
            $table->string('image_bill')->nullable();
            $table->float('project_after_tax')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
