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
        $servidor = new \App\User;
        $servidor->name     = 'admin';
        $servidor->email    = 'admin@admin.com';
        $servidor->password = \Hash::make('password');
        $servidor->save();
    }
}
