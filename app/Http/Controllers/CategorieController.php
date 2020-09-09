<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Http\Request;
use App\Http\Requests\CategorieSaveRequest;

class CategorieController extends Controller
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
        $categorie = Categorie::latest()->get();
        return view('categorie.index', compact('categorie'));
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
    public function listar()
    {   
        $categorie = Categorie::latest()->get();
        return $categorie->toJson();
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategorieSaveRequest $request)
    {
        Categorie::create($request->validated());
        return redirect()->route('categorie.index')->with('status','El proyecto fue creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $categorie)
    {
        return view ('categorie.edit',['categorie' => $categorie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(CategorieSaveRequest $request, Categorie $categorie)
    {
        $categorie->update($request->validated());

        return redirect()->route('categorie.index',$categorie)->with('status','La categoria fue actualizado con éxito');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return redirect()->route('categorie.index')
        ->with('status','El categoria fue eliminada con éxito');
    }
}
