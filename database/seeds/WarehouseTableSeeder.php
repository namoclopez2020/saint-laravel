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
        for($i=0;$i<=10000; $i++){
            Warehouse::create([
                'codigo' => '001'.$i,
                'nombre' => 'almacen 1'.$i,
                'office_id' => 1
            ]);
        }
        
    }
}
