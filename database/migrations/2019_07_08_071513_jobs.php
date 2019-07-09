<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Jobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id_job');
            $table->string('nama_job');
            $table->integer('module_id')->unsigned()->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->foreign('module_id')->references('id_module')->on('module')->onDelete('cascade');
            ;
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
        Schema::drop('jobs');

    }
}
