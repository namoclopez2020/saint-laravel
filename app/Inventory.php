<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Inventory extends Model
{
    //
    protected $guarded = [];

    public function product(){
        return $this->hasOne(Product::class);
    }
}
