<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Requests\SaveProductRequest;
use Illuminate\Http\Request;
use App\Provider;
use App\Warehouse;
use App\Categorie;
use App\product_provider;
use App\Serial;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{   
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('statusUser');
        $this->middleware('roles');
        $this->middleware('CheckGeneralData');
        $this->middleware('officeIsSelected');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $product = Product::latest()->get();
        
        return view('product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $provider = Provider::latest()->get();
        $warehouse = Warehouse::latest()->get();
        $categorie = Categorie::latest()->get();
        return view('product.create',compact(['categorie','warehouse','provider']));
    }  



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveProductRequest $request)
    {   
        $validated = $request->validated();
        DB::beginTransaction();
        try{
            $nombre_producto = $request['nombre'];
            $codigo = $request['codigo'];
            $id_categoria = $request['categoria'];
            $es_serial = $request['es_serial'];
            $usa_impuesto = $request['usa_impuesto'];
            $impuesto = $request['porcentaje_impuesto'];
            $usa_empaque = $request['usa_empaque'];
            $medida_paq = $request['medidas']['medida_paq'];
            $medida_und = $request['medidas']['medida_und'];
            $fraccion = $request['cantidades']['empaque'];
            $min_paq = $request['cantidades']['min_paq'];
            $min_und = $request['cantidades']['min_und'];

            $valores = [
                'nombre' => $nombre_producto,
                'codigo' => $codigo,
                'categorie_id' => $id_categoria,
                'es_serial' => $es_serial,
                'impuesto' => ($impuesto) ?:"0",
                'usa_empaque' => $usa_empaque,
                'medida_paq' => $medida_paq,
                'medida_und' => $medida_und,
                'fraccion' => ($fraccion) ?:"0",
                'min_paq' => ($min_paq) ?:"0",
                'min_und' => $min_und
            ];

            $product =  Product::create($valores);

            $array = [
                'error' => 0,
                'mensaje' => 'Producto Agregado Exitosamente'
            ];
            DB::commit();
            return json_encode($array);


        }catch(\Illuminate\Database\QueryException $e){
            DB::rollback();
            $array = array(
                'mensaje_p' => 'Hubo un problema al guardar el producto, intente nuevamente',
                'mensaje' => $e->getMessage(),
                'codigo' => $e->getCode(), 
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings(),
            );
            return $array;
        }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view ('product.ajax.detalle',[
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    public function empaque (Request $request){
        $empaque= $request['empaque'];
        return view('product.ajax.empaque', compact('empaque'));
    }

    public function impuesto (Request $request){
        $impuesto = $request['impuesto'];
        return view('product.ajax.impuesto',compact('impuesto'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function serialesProduct(Product $product){
         $product =  $product->with('seriales')->get();
         if(!$product){
             return null;
         }else{ 
            return view ('product.ajax.detalle',[
                'product' => $product[0]->seriales
            ]);
         }
    }

    
}
