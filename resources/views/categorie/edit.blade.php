@extends('layouts.layout')

@section('title','Editar categoria')
    
@section('content')
    <div  class="container" style="padding-top: 60px">
  
        <div class="row">
            
            <div class="col-md-5 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            <span>Editando {{$categorie->nombre}}</span>
                        </strong>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('categorie.update',$categorie) }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                            <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $categorie->nombre ?? '')}}">
                            </div>
                                <button  class="btn btn-primary btn-block">Actualizar categoría</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection