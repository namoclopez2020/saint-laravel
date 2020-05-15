@extends('layouts.layout')

@section('title','Crear Usuario')
    
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-md-7 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header"><text class="h3">Agregar Usuario</text></div>
                <div class="card-body">
                <form action="{{ route('user.store') }}" method="post">
                    @include('user._form')
                    <div class="form-group">
                        <label for="codigo_almacen" >Contraseña:</label>
                       <input type="password" name="password" class="form-control form-control-sm" >
                    </div>
                    <div class="form-group">
                        <label for="">Confirmar contraseña</label>
                        <input type="password" name="confirm_password" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" >Guardar</button>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection