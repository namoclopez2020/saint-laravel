<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;

class DataTableController extends Controller
{
    //
    public function almacen(Request $request){
        return datatables()->eloquent(Warehouse::query()->with('office'))
        ->toJson();
    }
}
