@extends('layouts.layout')

@section('title','Seleccionar sucursal de trabajo')
    
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-md-7 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header"><text class="h3">Elegir sucursal de trabajo</text></div>
                <div class="card-body">
                <form action="{{route('select.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="sucursal_almacen" >Seleccione sucursal:</label>
                    <select name="office" class="form-control">
                    @forelse ($office as $itemOffice)
                        <option value="{{$itemOffice->id}}">{{$itemOffice->nombre }}</option>
                    @empty
                        
                    @endforelse
                      
                   
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" >Guardar</button>
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