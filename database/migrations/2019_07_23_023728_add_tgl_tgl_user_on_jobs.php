<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTglTglUserOnJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('jobs', function($table) {
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
        Schema::table('jobs', function($table) {
            $table->dropColumn('tgl_mulai');
            $table->dropColumn('deadline');
            $table->dropColumn('tgl_user');
        });
    }
}
