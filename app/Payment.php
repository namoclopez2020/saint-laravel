<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Buy;
use App\Office;

class Payment extends Model
{
    //
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function buy(){
        return $this->belongsTo(Buy::class);
    }
    public function office(){
        return $this->belongsTo(Office::class);
    }
}
