<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('role')->insert(
            array(
                'nama_role' => 'Project Manager',
                'keterangan' => 'Memanage project yang dibawahi',
            )
        );

        DB::table('role')->insert(
            array(
                'nama_role' => 'Unassigned',
                'keterangan' => 'User belum di assign',
            )
        );
    }
}
