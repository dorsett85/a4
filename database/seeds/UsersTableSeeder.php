<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate([
        'email' => 'guest@stocktracker.com',
        'name' => 'Guest',
        'password' => \Hash::make('testing')
    ]);

    }
}
