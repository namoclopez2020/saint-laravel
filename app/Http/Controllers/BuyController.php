<?php

namespace App\Http\Controllers;

use App\Buy;
use App\Product;
use App\Provider;
use App\tmp_compra;
use App\BuyDetail;
use App\Batch;
use App\Payment;
use DB;
use Illuminate\Http\Request;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class BuyController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('statusUser');
        $this->middleware('roles');
        $this->middleware('officeIsSelected');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buy = Buy::latest()->get();
        return view ('buy.index',compact('buy'));
       
    }

    public function detalle(Buy $buy){
        
        return view('buy.ajax.detalle',[
            'buy' => $buy
        ]);
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
        $request->validate([
        'provider_id' => 'required',
        'condiciones'=> 'required',
        'tipo_pago' => 'required',
        'actualizar' => 'required'
        ]);
        
        $request['office_id'] = "1";
           //return $request->all();
        //capturar el costo total de la compra
        $id_usuario = auth()->user()->id;
        $suma = tmp_compra::where('session_id','=',"$id_usuario")->select(DB::raw('SUM(costo_compra) as costo_total'))->get();
        foreach($suma as $sum){
            $costo_total = $sum['costo_total'];
        }
        if($request['pagado'] > $costo_total){
            return false;
        }
        if($request['tipo_pago']){
            $request['pagado'] = $costo_total;
        }
        $compra = Buy::create([
            'provider_id' => $request['provider_id'],
            'costo_total_compra' => $costo_total,
            'pagado' => $request['pagado'],
            'metodo_pago' => $request['condiciones'],
            'office_id' => $request['office_id'],
            'status_compra' => $request['tipo_pago']
        ]);

        //insertar datos en la tabla de pagos
        Payment::create([
            'buy_id' => $compra->id,
            'monto_pagado' => $request['pagado'],
            'user_id' => $id_usuario,
            'office_id' => $request['office_id'],
            'metodo_pago' => $request['condiciones']
        ]);

       $tmp = tmp_compra::where('session_id','=',"$id_usuario")->get();
        foreach($tmp as $item){

            $buy_detail = BuyDetail::create([
                'buy_id' => $compra->id,
                'product_id' => $item['product_id'],
                'cant_paq' => $item['cantidad_paq'],
                'cant_und' => $item['cantidad_und'],
                'costo' => $item['costo_compra']
            ]);
            if($buy_detail->product->es_serial){
                $estado = false;
            }else{
                $estado = true;
            }

            $batch = Batch::create([
                'buy_id' => $compra->id,
                'product_id' => $item['product_id'],
                'paq' => $item['cantidad_paq'],
                'und' => $item['cantidad_und'],
                'provider_id' => $request['provider_id'],
                'estado' => $estado
            ]);
           

          //sumar stock del producto  
           $stock_final = sumar_stock($item['cantidad_paq'],$item['cantidad_und'],$buy_detail->product->usa_empaque,$buy_detail->product->stock_und,$buy_detail->product->stock_paq,$buy_detail->product->fraccion);
           list($paq,$und) = explode("/",$stock_final);
           $product = Product::findOrFail($item['product_id']);
           $product->stock_paq = $paq;
           $product->stock_und = $und;
           
        
           //actualizar costos del producto en caso el usuario lo pida
           if($request['actualizar'] == "true"){
              
            $costos = actualizar_costos($product->costo_actual,
                                    $product->costo_promedio,
                                    $buy_detail->costo,
                                    $product->usa_empaque,
                                    $buy_detail->cant_und,
                                    $buy_detail->cant_paq,
                                    $product->fraccion);
            list($costo_anterior,$costo_actual,$costo_promedio) = explode("/",$costos);
            
            $product->costo_anterior = $costo_anterior;
            $product->costo_actual = $costo_actual;
            $product->costo_promedio = $costo_promedio;
           }    

           $product->save();
           
           

        }
        tmp_compra::where('session_id','=',"$id_usuario")->delete();

        

        

        return $compra->id;
        //return json_encode($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Buy  $buy
     * @return \Illuminate\Http\Response
     */
    public function show(Buy $buy)
    {   
        
        try {
            ob_start();
           
            $content = ob_get_clean();
        
            $html2pdf = new Html2Pdf('P', 'A4', 'fr');
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML(view('buy.show',['buy' => $buy]));
            $html2pdf->output('factura.pdf');
        } catch (Html2PdfException $e) {
            $html2pdf->clean();
        
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
        
        
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
    public function cuentasPorPagar(){
        $compras = Buy::where('status_compra','=','0')->get();
        return view('payment.index',compact('compras'));
    }

    public function pagar(Buy $buy){
       
        return view('payment.ajax.index',[
            'buy' => $buy
        ]);
    }

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
        $user_id = auth()->user()->id;
        $request->validate([
            'maximo' => 'required',
            'pago' => 'required',
            'medio_pago' => 'required'
        ]);
        if($request['pago'] > $request['maximo']){
            return false;
        }
        $request['office_id'] = 1;
        $buy->pagado += $request['pago'];
        if($buy->pagado == $buy->costo_total_compra){
        $buy->status_compra = true;
        }
        $buy->save();
        
        $payment = payment::create([
            'buy_id' => $buy->id,
            'monto_pagado' => $request['pago'],
            'user_id' => $user_id,
            'office_id' => $request['office_id'],
            'metodo_pago' => $request['medio_pago'],
        ]);
        
        

        return true;
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
