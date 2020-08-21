<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;
use App\Office;
use App\Provider;
use App\User;
use App\Product;
use App\Buy;

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
        ->addColumn('esSerialText', '{{$es_serial ? \'Sí\': \'No\' }}')
        ->toJson();
    }

    public function compras(Request $request){
        return datatables()->eloquent(Buy::query()->with(['provider']))
       
        ->toJson();
    }

    public function cuentasPorPagar(Request $request){
        return datatables()->eloquent(Buy::query()->where('status_compra','=','0'))
        ->toJson();
    }

}
