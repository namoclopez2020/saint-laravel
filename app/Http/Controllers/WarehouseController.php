<?php

namespace App\Http\Controllers;

use App\Warehouse;
use App\Office;
use Illuminate\Http\Request;
use App\Http\Requests\SaveWarehouseRequest;

class WarehouseController extends Controller
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
        $warehouse = Warehouse::latest()->get();
        return view('warehouse.index',compact('warehouse'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $office = Office::latest()->get();
        return view('warehouse.create',compact('office'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveWarehouseRequest $request)
    {
        Warehouse::create($request->validated());

        return redirect()->route('warehouse.index')->with('status','Almacen creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {   
        $office = Office::latest()->get();
        return view ('warehouse.edit',[
            'warehouse' => $warehouse,
            'office' => $office
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(SaveWarehouseRequest $request, Warehouse $warehouse)
    {
        $warehouse->update($request->validated());

        return redirect()->route('warehouse.index')->with('status','El almacen fue actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        return redirect()->route('warehouse.index')->with('status','El almacén fue eliminado correctamente');
    }
}
