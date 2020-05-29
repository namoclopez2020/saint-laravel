<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;
use App\Office;
use App\Provider;
use App\User;
use App\Product;

class DataTableController extends Controller
{
    //
    public function almacen(Request $request){
        return datatables()->eloquent(Warehouse::query()->with('office'))
        ->toJson();
    }
    public function sucursal(Request $request){
        return datatables()->eloquent(Office::query())
        ->toJson();
    }

    public function proveedor(Request $request){
        return datatables()->eloquent(Provider::query())
        ->toJson();
    }
    public function usuario(Request $request){
        return datatables()->eloquent(User::query()->with('user_level'))
        ->toJson();
    }

    public function producto(Request $request){
        return datatables()->eloquent(Product::query()->with(['categorie','warehouse']))
        ->editColumn('es_serial', '{{$es_serial ? \'Sí\': \'No\' }}')
      
        ->toJson();
    }

}
