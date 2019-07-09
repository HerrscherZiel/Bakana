<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Module extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('module', function (Blueprint $table) {
            $table->increments('id_module');
            $table->string('nama_module');
            $table->integer('waktu');
            $table->integer('status');
            $table->text('keterangan')->nullable();
            $table->integer('project_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('project_id')->references('id_project')->on('project')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('module');

    }
}
