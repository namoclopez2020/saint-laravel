<?php

use Illuminate\Database\Seeder;
use App\TipoDoc;

class TipoDocTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDoc::create(['documento' =>'Cedula']);
        TipoDoc::create(['documento' =>'DNI']);
        TipoDoc::create(['documento' =>'RUC']);
        TipoDoc::create(['documento' =>'Sin documento']);
        
    }
}
