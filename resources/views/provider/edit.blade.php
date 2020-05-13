@extends('layouts.layout')

@section('title','Crear Proveedor')
    
@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-md-7 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header"><text class="h3">Agregar proveedor</text>
                </div>
                    <div class="card-body">
                        <form action="{{route('provider.update',$provider)}}" method="post">
                            @csrf
                            @method('PATCH')
                            @include('provider._form',['btnText' => 'Actualizar'])
                        </form>
                    </div>
            </div>
         </div>
    </div>
</div>
    
@endsection