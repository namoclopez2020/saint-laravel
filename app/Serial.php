<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Serial extends Model
{
   protected $table = "serials";

   protected $fillable = [
       'product_id',
       'serial_number'
   ];

   public function products(){
    return $this->belongsTo(Product::class);
}
}
