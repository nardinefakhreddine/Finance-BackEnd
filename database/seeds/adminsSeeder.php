<?php

use Illuminate\Database\Seeder;
use  Illuminate\Support\Facades\DB;

class adminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert(
            [
                'name'=>'nardine',
                'email'=>'admin@admin.com',
                'password'=>Hash::make('111111')
            ]
            );
    }
}
