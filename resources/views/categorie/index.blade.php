@extends('layouts.layout')

@section('title','Lista de categorias')
    
@section('content')
<div  class="container" style="padding-top: 60px">
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <span class=""></span>
                        <span>Agregar categoría</span>
                     </strong>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route ('categorie.store')}}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre de la categoría" required>
                        </div>
                            <button type="submit" name="add_cat" class="btn btn-primary">Agregar categoría</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <span class=""></span>
                        <span>Lista de categorías</span>
                    </strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="myTable" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">#</th>
                                    <th>Categorías</th>
                                    <th class="text-center" style="width: 100px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($categorie as $itemCategorie)
                                    <tr>
                                        <td>{{   $loop->iteration  }}</td>
                                        <td class="text-center">{{ $itemCategorie->nombre}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ route('categorie.edit' , $itemCategorie) }}"  class="btn  btn-warning mr-1"  >
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{route('categorie.destroy',$itemCategorie)}}" method="POST">
                                                    @csrf @method('DELETE')
                                                <button class="btn  btn-danger"> <span class=" fa fa-trash"></span></button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                         
                            @empty
                                
                            @endforelse
                                
              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection