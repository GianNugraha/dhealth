<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [ 'username' => 'user1', 'password' => 'user1', 'email' => 'user1@gmail.com', 'fullname' => 'User 1'],
            [ 'username' => 'user2', 'password' => 'user2', 'email' => 'user2@gmail.com', 'fullname' => 'User 2'],

        ];
            DB::table('tbl_user')->insert($users);
    }
}
