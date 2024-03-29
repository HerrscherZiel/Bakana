<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModuleAddColor extends Migration
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
            $table->string('color')->after('status')->nullable();
        });

        Schema::table('jobs', function($table) {
            $table->string('color')->after('status')->nullable();
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
            $table->dropColumn('color');
        });

        Schema::table('jobs', function($table) {
            $table->dropColumn('color');
        });
    }
}
