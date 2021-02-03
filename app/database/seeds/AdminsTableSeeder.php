<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'admin@icloud.com',
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);

        DB::table('admins')->insert([
            'name' => 'サンダナオナリ',
            'email' => 'mkg_sandy@icloud.com',
            'password' => Hash::make('sasasasa'),
            'remember_token' => Str::random(10),
        ]);
    }
}
