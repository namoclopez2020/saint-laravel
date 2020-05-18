<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categorie;
use App\Warehouse;
use App\Provider;
use App\Batch;

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
    public function provider(){
        return $this->belongsToMany(Provider::class);
    }

    public function batches(){
        return $this->hasMany(Batch::class);
    }
}
