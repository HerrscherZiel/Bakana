<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([

            'name' => '< PM >',
            'email' => 'PM@mail.com',
            'password' => bcrypt('12345678'),
            'role_id' => '1'
        ]);

    }
}
