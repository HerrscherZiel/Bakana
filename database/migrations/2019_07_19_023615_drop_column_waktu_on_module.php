<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnWaktuOnModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('module', function($table) {
            $table->dropColumn('waktu');
            $table->string('user')->after('nama_module')->nullable();
            $table->date('tgl_mulai')->after('user');
            $table->date('deadline')->after('tgl_mulai');
            $table->date('tgl_user')->after('deadline')->nullable();
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
        Schema::table('module', function($table) {
            $table->integer('waktu')->after('nama_module')->nullable();
            $table->dropColumn('user');
            $table->dropColumn('tgl_mulai');
            $table->dropColumn('deadline');
            $table->dropColumn('tgl_user');
        });
    }
}
