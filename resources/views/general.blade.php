@extends('layouts.layout')

@section('title','Datos Generales')
    
@section('content')
<div class="row col-12 mx-auto mb-3 mt-4">
    <span class="text-secondary mx-auto">*Esta configuración solo se realizara por unica vez y no podra ser editado posteriormente</span>
    </div>
    <div class="row">
    <div class="col-lg-4 col-md-6 col-12 mx-auto">
    <div class="card">
    <div class="card-header bg-info text-light h3">Configuracion General</div>
    <div class="card-body">
    <form action="{{route('general.store')}}" method="POST">
        @csrf
    <div class="form-group">
    <label for="moneda" >Moneda:</label>
    <input type="text" name="moneda" class="form-control form-control-sm" placeholder="SOL">
     </div>
     <div class="form-group">
    <label for="icono" >Representación de moneda:</label>
    <input type="text" name="signo" class="form-control form-control-sm" placeholder="S/.">
     </div>
     <div class="form-group">
    <label for="icono" >Impuesto:</label>
    <input type="text" name="signo_impuesto" class="form-control form-control-sm" placeholder="IGV-IVA" maxlenght="3">
     </div>
     <div class="form-group row ">
     <div class="col-12"><label for="icono" >Porcentaje de impuesto:</label></div>
    <div class="col-12 row ml-1"><input type="number" name="impuesto" class="form-control col-8" placeholder="1"><div class="input-group-prepend ">
              <div class="input-group-text">%</div></div>
    
            </div>
     </div>
     <div class="form-group">
                        <label for="sucursal" >Seleccione sucursal principal:</label>
                        <select name="office_id" class="form-control form-control-sm">
                         @forelse ($office as $itemOffice)
                         <option value="{{$itemOffice->id}}">{{$itemOffice->nombre}}</option>
                         @empty
                             
                         @endforelse
                        
                        
                        </select>
     </div>
     <div class="form-group">
     <button type="submit" class="btn btn-info btn-block" name="guardar">Guardar </button>
     </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    
    
   
    </div>
@endsection
@section('scripts')
    
@endsection