@extends('layouts.layout')

@section('title','Datos Generales')
    
@section('content')
<div class="row">
    <div class="col-lg-4 col-md-6 col-12 mx-auto mt-4">
    <div class="card">
    <div class="card-header bg-primary text-light h3">Datos Generales</div>
    <div class="card-body">
    <div class="form-group">
    <label for="moneda" >Moneda:</label>
    <label name="moneda" class="form-control form-control-sm text-center" > {{$general->moneda}} </label>
    </div>
    <div class="form-group">
    <label for="moneda" >Representacion de moneda:</label>
    <label name="moneda" class="form-control form-control-sm text-center" > {{$general->signo}} </label>
    </div>
    <div class="form-group">
    <label for="moneda" >Sucursal Principal:</label>
    <label name="moneda" class="form-control form-control-sm text-center" > {{$general->office->nombre}} </label>
    </div>
    <div class="form-group">
    <label for="moneda" >Impuesto:</label>
    <label name="moneda" class="form-control form-control-sm text-center" > {{$general->signo_impuesto}} </label>
    </div>
    <div class="form-group">
    <label for="moneda" >Porcentaje de impuesto:</label>
    <label name="moneda" class="form-control form-control-sm text-center" > {{$general->impuesto}} </label>
    </div>
    </div>
    </div>
    </div>
    
    </div>
@endsection