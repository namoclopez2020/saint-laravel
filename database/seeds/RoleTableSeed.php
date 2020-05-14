<?php

use Illuminate\Database\Seeder;
use App\role;

class RoleTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        role::create(['name' => 'Admin']);
    }
}
