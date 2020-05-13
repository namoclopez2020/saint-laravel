<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TipoDoc;

class Client extends Model
{
    protected $guarded = [];

    public function documento(){
        return $this->belongsTo(TipoDoc::class);
    }
}
