<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkpProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkp_project', function (Blueprint $table) {
            $table->increments('id_project');
            $table->string('request')->nullable();
            $table->string('pkp_number')->nullable();
            $table->string('project_name')->nullable();
            $table->integer('id_subbrand')->nullable();
            $table->integer('type')->nullable();
            $table->string('categori')->nullable();
            $table->date('created_date')->nullable();
            $table->enum('status',['active','nonactive']);
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
        Schema::dropIfExists('pkp_project');
    }
}
