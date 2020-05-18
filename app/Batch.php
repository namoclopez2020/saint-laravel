<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Provider;

class Batch extends Model
{
    //
    protected $guarded = [];

    public function provider (){
        return $this->belongsTo(Provider::class);
    }
}
