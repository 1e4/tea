<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->name = 'admin';
        $user->email = 'admin@ian.pe';
        $user->password = bcrypt('admin');
        $user->admin = 1; //Could use Laravels can() but it's a simple app, no need to complicate things
        $user->save();
    }
}
