<?php

use Illuminate\Database\Seeder;
use App\Office;

class OfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Office::create([
            'direccion' => 'puente piedra',
            'nombre' => 'sucursal 1',
            'ruc' => '10008434',
            'email' => 'sucursal1@gmail.com',
            'telefono' => '9878655'
        ]);
    }
}
