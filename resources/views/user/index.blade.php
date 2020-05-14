@extends('layouts.layout')

@section('title','Usuarios')
    
@section('content')
 
    
<div class="container mt-4 pt-4">
    <div class="row">
        <div class="col-11 col-md-8 col-lg-10 mx-auto">
        <div class="card">
            <div class="card-header text-primary h3">Usuarios</div>
            <div class="card-body">
            <div class="table-responsive">
            <table class="table table-hover" id="myTable" style="width:100%">
                <thead class="bg-primary text-light">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Fecha agregado</th>
                    <th>Fecha Actualizado</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
            
                
                @forelse ($user as $itemUser)
                <tr>
                        <td>{{  $loop->iteration }}</td>
                        <td>{{ $itemUser->name}}</td>
                        <td>{{ $itemUser->email}}</td>
                        <td>{{ $itemUser->user_level->name}}</td>
                        <td>{{ $itemUser->created_at->format('d-m-Y H:g:i A')}}</td>
                        <td>{{ $itemUser->updated_at->diffForHumans()}}</td>
                        <td class="text-center">
                        <div class="btn-group">
                            <a href="{{route('user.edit', $itemUser)}}"  class="btn  btn-warning mr-1"  >
                            <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{route('user.destroy',$itemUser)}}" method="POST">
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