<?php

use Illuminate\Database\Seeder;
use App\Categorie;

class CategorieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categorie::create(['nombre' =>'categoria1']);
        Categorie::create(['nombre' =>'categoria2']);
        Categorie::create(['nombre' =>'categoria3']);
        Categorie::create(['nombre' =>'categoria4']);
    }
}
