<?php

use Illuminate\Database\Seeder;
use App\Provider;

class ProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provider::create([
            'nombre' => 'proveedor 1',
            'ruc' => '10777974624',
            'representante' => 'cahuana',
            'direccion' => 'los olivos',
            'telefono' => '9894738'
        ]);
        Provider::create([
            'nombre' => 'proveedor 2',
            'ruc' => '10777974',
            'representante' => 'cahuana2',
            'direccion' => 'los olivos-primera etapa',
            'telefono' => '9894746538'
        ]);
    }
}
