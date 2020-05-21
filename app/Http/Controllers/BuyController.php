<?php

namespace App\Http\Controllers;

use App\Buy;
use App\Product;
use App\Provider;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $product = Product::latest()->get();
        return view('buy.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Buy  $buy
     * @return \Illuminate\Http\Response
     */
    public function show(Buy $buy)
    {
        //
    }

    public function proveedor(Request $request){
        $return_arr = array();
        $nombre=urldecode($request['query']);
        $proveedor = Provider::latest()->where('nombre','like',"%$nombre%")->get();
        foreach($proveedor as $row){
            $row_array['value'] = $row['nombre'];
            $row_array['ruc']=$row['ruc'];
            $row_array['telefono']=$row['telefono'];
            $row_array['id_proveedor']=$row['id'];
            $row_array['nombre_empresa']=$row['nombre'];
            array_push($return_arr,$row_array);
        }
        //return $return_arr;
        return json_encode($return_arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Buy  $buy
     * @return \Illuminate\Http\Response
     */
    public function edit(Buy $buy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Buy  $buy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buy $buy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Buy  $buy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buy $buy)
    {
        //
    }
}
