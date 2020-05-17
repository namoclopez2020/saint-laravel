<?php

use Illuminate\Database\Seeder;
use App\Warehouse;

class WarehouseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Warehouse::create([
            'codigo' => '001',
            'nombre' => 'almacen 1',
            'office_id' => 1
        ]);
    }
}
