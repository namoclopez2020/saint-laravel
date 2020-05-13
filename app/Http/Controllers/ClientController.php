<?php

namespace App\Http\Controllers;

use App\Client;
use App\TipoDoc;
use Illuminate\Http\Request;
use App\Http\Requests\ClientSaveRequest;

class ClientController extends Controller
{   

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = client::latest()->get();
        return view ('client.index',compact('client'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $documento = TipoDoc::latest()->get();
        return view('client.create',compact('documento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientSaveRequest $request)
    {   
      //  $request['credito_restante'] = $request['credito_max'];
        $request['grupo'] = 'Ordinario';
       
    
     
        Client::create([
            'nombre'=>$request->validated()['nombre'],
            'telefono' => $request->validated()['telefono'],
            'direccion' => $request->validated()['direccion'],
            'email' => $request->validated()['email'],
            'documento_id' => $request->validated()['documento_id'],
            'nro_documento' => $request->validated()['nro_documento'],
            'pedidos' => $request->validated()['pedidos'],
            'credito_max' => $request->validated()['credito_max'],
            'credito_restante' => $request->validated()['credito_max'],
            'grupo' => 'Ordinario',
            
            
            ]
        
        );
      
        return redirect()->route('client.index')
       ->with('status','El cliente fue agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {   
        $docs = TipoDoc::latest()->get();
        return view ('client.edit',[
            'client' => $client,
            'documento' => $docs
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientSaveRequest $request, Client $client)
    {   
        $credito_old=$client->credito_max;
        
        $client->update($request->validated());

        //return $client->grupo;
       // return $client->credito_restante;
        $credito_restante = $client->credito_restante + ($client->credito_max-$credito_old);

        $client->update(['credito_restante' => $credito_restante]);

       
        return redirect()->route('client.index',$client)->with('status','El proyecto fue actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
