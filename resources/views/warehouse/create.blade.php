@extends('layouts.layout')

@section('title','Agregar almacen')
    
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-md-7 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header"><text class="h3">Agregar almacen</text>
                </div>
                    <div class="card-body">
                        <form action="{{route('warehouse.store')}}" method="post">
                            @csrf
                            @include('warehouse._form',['btnText' => 'Guardar'])
                        </form>
                    </div>
            </div>
         </div>
    </div>
</div>
@endsection