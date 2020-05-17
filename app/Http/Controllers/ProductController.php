<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Requests\SaveProductRequest;
use Illuminate\Http\Request;
use App\Provider;
use App\Warehouse;
use App\Categorie;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::latest()->get();
        
        return view('product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $product =  Product::create($request->validated());

        if($request['usa_empaque']):
            $request->validate([
                'fraccion' => 'required',
                'medida_paq' => 'required',
                'min_paq' => 'required'
             ]);
            
            $product->usa_empaque = $request['usa_empaque'];
            $product->medida_paq = $request['medida_paq'];
            $product->fraccion = $request['fraccion'];
            $product->min_paq = $request['min_paq'];
            $product->save();
        endif;
        if($request['usa_impuesto']):
            $request->validate([
                'impuesto' => 'required'
            ]);
            
            $product->impuesto = $request['impuesto'];
            $product->save();  
        endif;

        //insertar los proveedores de productos
        $contador = count($request['proveedor']);
        for($i=1;$i<=$contador;$i++){

        }

        return $product;
       // Product::create($request->validated());
       // return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
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
}
