<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class tmp_compra extends Model
{
    //
    protected $table="tmp_compras";
    protected $guarded=[];
    
    public function product (){
        return $this->belongsTo(Product::class);
    }
}
