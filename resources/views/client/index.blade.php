@extends('layouts.layout')

@section('title','Clientes')
    
@section('content')
    
<div class="container mt-4 pt-4">
    <div class="row">
        <div class="col-11 col-md-8 col-lg-10 mx-auto">
           <div class="card">
               <div class="card-header text-primary h3">Lista de clientes</div>
               <div class="card-body">
              <div class="table-responsive">
              <table class="table table-hover" id="myTable" style="width:100%">
                <thead class="bg-primary text-light">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Email</th>
                    <th>Documento</th>
                    <th>Nro de documento</th>
                    <th>Fecha Agregado</th>
                    <th>Tipo de cliente</th>
                    <th>Pedidos</th>
                    <th>Linea de crédito</th>
                    <th>Crédito restante</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                   
                    @forelse($client as $itemClient)
                        
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $itemClient->nombre}}</td>
                            <td>{{ $itemClient->telefono}}</td>
                            <td>{{ $itemClient->direccion}}</td>
                            <td>{{ $itemClient->email}}</td>
                            <td>{{ $itemClient->documento->documento }}</td>
                            <td>{{ $itemClient->nro_documento}}</td>
                            <td>{{ $itemClient->created_at->diffForHumans()}}</td>
                            <td>{{ $itemClient->grupo}}</td>
                            <td>{{ $itemClient->pedidos}}</td>
                            <td>{{ $itemClient->credito_max}}</td>
                            <td>{{ $itemClient->credito_restante}}</td>
                            <td class="text-center">
                            <div class="btn-group">
                                <a href="{{route('client.edit',$itemClient)}}"  class="btn  btn-warning mr-1"  >
                                <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{route('client.destroy',$itemClient)}}" method="POST">
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