<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Office;

class General extends Model
{
    //
    protected $guarded = [];

    public function office(){
        return $this->belongsTo(Office::class);
    }
}
