<?php

namespace App\Http\Controllers;

use App\Buy;
use App\Product;
use App\Provider;
use App\tmp_compra;
use App\BuyDetail;
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
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
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
            return "nola";
        }
          
        $compra = Buy::create([
            'provider_id' => $request['provider_id'],
            'costo_total_compra' => $costo_total,
            'pagado' => $request['pagado'],
            'metodo_pago' => $request['condiciones'],
            'office_id' => $request['office_id'],
            'status_compra' => $request['tipo_pago']
        ]);
       $tmp = tmp_compra::where('session_id','=',"$id_usuario")->get();
        foreach($tmp as $item){

            BuyDetail::create([
                'buy_id' => $compra->id,
                'product_id' => $item['product_id'],
                'cant_paq' => $item['cantidad_paq'],
                'cant_und' => $item['cantidad_und'],
                'costo' => $item['costo_compra']
            ]);
        }
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
