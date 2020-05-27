<?php

namespace App\Http\Controllers;

use App\General;
use App\Office;
use Illuminate\Http\Request;
use App\Http\Requests\SaveGeneralData;

class GeneralController extends Controller
{   
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('statusUser');
        $this->middleware('roles');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $office = Office::latest()->get();
        $general = General::first();
        if($general == NULL){
            return view('general',[
                'office' => $office
            ]);
        }
        return view('datos',compact('general'));
        
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
    public function store(SaveGeneralData $request)
    {   $general = General::first();
        if($general == NULL){
        General::create($request->validated());
        return redirect()->route('general.index')->with('status','Datos generales agregados correctamente');
        }else{
        return redirect()->route('general.index')->with('error','Los datos generales ya fueron agregados');
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\General  $general
     * @return \Illuminate\Http\Response
     */
    public function show(General $general)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\General  $general
     * @return \Illuminate\Http\Response
     */
    public function edit(General $general)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\General  $general
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, General $general)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\General  $general
     * @return \Illuminate\Http\Response
     */
    public function destroy(General $general)
    {
        //
    }
}
