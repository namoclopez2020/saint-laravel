@extends('layouts.layout')

@section('title','Proveedores')
    
@section('content')



    <div class="container mt-4 pt-4">
        <div class="row">
            <div class="col-11 col-md-8 col-lg-10 mx-auto">
            <div class="card">
                <div class="card-header text-primary h3">Proveedores</div>
                <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover" id="myTable" style="width:100%">
                    <thead class="bg-primary text-light">
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Representante</th>
                        <th>Teléfono</th>
                        <th>RUC</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                
                    
                    @forelse ($provider as $itemProvider)
                    <tr>
                            <td>{{  $loop->iteration }}</td>
                            <td>{{ $itemProvider->nombre}}</td>
                            <td>{{ $itemProvider->representante}}</td>
                            <td>{{ $itemProvider->telefono}}</td>
                            <td>{{ $itemProvider->ruc}}</td>
                            <td>{{ $itemProvider->direccion}}</td>
                            <td class="text-center">
                            <div class="btn-group">
                                <a href="{{route('provider.edit', $itemProvider)}}"  class="btn  btn-warning mr-1"  >
                                <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{route('provider.destroy',$itemProvider)}}" method="POST">
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