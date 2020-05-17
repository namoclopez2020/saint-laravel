<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categorie;
use App\Warehouse;

class Product extends Model
{
    //
    protected $guarded = [];

    public function categorie (){
        return $this->belongsTo(Categorie::class);
    }
    public function warehouse (){
        return $this->belongsTo(Warehouse::class);
    }
}
