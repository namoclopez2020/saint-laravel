@extends('layouts.layout')

@section('title','Crear Usuario')
    
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6 ">
            <div class="card">
                <div class="card-header"><text class="h3">Editar Usuario</text>
                </div>
                    <div class="card-body">
                        <form action="{{ route('user.update',$user) }}" method="post">
                            @include('user._form')
                            @method('PATCH')
                            
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" >Guardar</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6 ">
            <div class="card">
                <div class="card-header"><text class="h3">Cambiar Contraseña</text>
                </div>
                    <div class="card-body">
                        <form action="{{ route('user.password',$user) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                            <input type="text" name="password" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" >Actualizar</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection