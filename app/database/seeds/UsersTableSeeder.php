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
        DB::table('users')->insert([
            [
                'name'              => 'サンダナオナリ',
                'email'             => 'mkg_sandy@icloud.com',
                'password'          => Hash::make('sasasasa'),
                'remember_token'    => Str::random(10),
            ],
            [
                'name' => 'ゲスト',
                'email' => 'test@icloud.com',
                'password' => Hash::make('wqwqwqwq'),
                'remember_token' => Str::random(10),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        ]);
    }
}
