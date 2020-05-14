@extends('layouts.layout')

@section('title','Crear Sucursal')
    
@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-md-7 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header"><text class="h3">Agregar sucursal</text>
                </div>
                    <div class="card-body">
                        <form action="{{route('office.store')}}" method="post">
                            @csrf
                            @include('office._form',['btnText' => 'Guardar'])
                        </form>
                    </div>
            </div>
         </div>
    </div>
</div>
    
@endsection