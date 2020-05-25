<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BuyDetail;
use App\Provider;
use App\Payment;

class Buy extends Model
{
    //
    protected $guarded = [];

    public function details(){
        return $this->hasMany(BuyDetail::class);
    }
    public function provider (){
        return $this->belongsTo(Provider::class);
    }
    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
