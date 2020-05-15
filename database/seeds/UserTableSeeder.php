<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$1yHUjvgMCgwhI0IgFvaFcuI.z4P1JJaO4Q.YL40Z8ldYz5z7dPGN2',
            'role'=>'1',
            'status' => '1'
        ]);
    }
}
