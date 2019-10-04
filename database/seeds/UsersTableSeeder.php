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

        $servidor = new \App\User;
        $servidor->name     = 'encuesta';
        $servidor->email    = 'encuesta@encuesta.com';
        $servidor->password = \Hash::make('123456789');
        $servidor->save();        
    }
}
