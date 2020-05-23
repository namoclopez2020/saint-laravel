<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class BuyDetail extends Model
{
    //
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
