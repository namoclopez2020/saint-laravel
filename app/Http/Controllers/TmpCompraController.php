<?php

namespace App\Http\Controllers;

use App\tmp_compra;
use Illuminate\Http\Request;
use DB;

class TmpCompraController extends Controller
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
    public function index()
    {   
        $id_usuario = auth()->user()->id;
        $tmp_compra = tmp_compra::latest()->where('session_id','=',"$id_usuario")->get();
        $suma = tmp_compra::where('session_id','=',"$id_usuario")->select(DB::raw('SUM(costo_compra) as costo_total'))->get();
        foreach($suma as $sum){
            $costo_total = $sum['costo_total'];
        }
        return view('buy.ajax.index',compact('tmp_compra','costo_total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        tmp_compra::create([
            'product_id' => $request['id'],
            'cantidad_und' => $request['cantidad_und'],
            'cantidad_paq' => $request['cantidad_paq'],
            'costo_compra' => $request['costo_prod'],
            'session_id' => auth()->user()->id
        ]);
        return redirect()->route('TmpCompra.index');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tmp_compra  $tmp_compra
     * @return \Illuminate\Http\Response
     */
    public function show(tmp_compra $tmp_compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tmp_compra  $tmp_compra
     * @return \Illuminate\Http\Response
     */
    public function edit(tmp_compra $tmp_compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tmp_compra  $tmp_compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tmp_compra $tmp_compra)
    {
        //
    }
    public function pago(Request $request){
        if($request['pago'] == '0'){
            return view('buy.ajax.pago');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tmp_compra  $tmp_compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(tmp_compra $tmp_compra)
    {
        
    }
    public function borrar (tmp_compra $tmp_compra){
        $tmp_compra->delete();
        return redirect()->route('TmpCompra.index'); 
    }
}
