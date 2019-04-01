<?php

use Illuminate\Database\Seeder;

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
            'name' => 'gilles',
            'email' => 'gilles@domaine.com',
            'password' => bcrypt('admin'),
        ]);
        DB::table('users')->insert([
            'name' => 'gael',
            'email' => 'gael@domaine.com',
            'password' => bcrypt('user'),
        ]);
        DB::table('users')->insert([
            'name' => 'romane',
            'email' => 'romane@domaine.com',
            'password' => bcrypt('user'),
        ]);
    }
}
