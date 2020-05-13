<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class indexController extends Controller
{    

    public function __construct(){
        $this->middleware('guest');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $title= "Inicio";
      return  view('auth.login',compact('title'));
    }

   
}
