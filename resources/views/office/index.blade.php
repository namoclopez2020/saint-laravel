@extends('layouts.layout')

@section('title','Sucursales')
    
@section('content')

<div class="container mt-4 pt-4">
    <div class="row">
        <div class="col-11 col-md-8 col-lg-10 mx-auto">
           <div class="card">
               <div class="card-header text-primary h3">Lista de sucursales</div>
               <div class="card-body">
              <div class="table-responsive">
              <table class="table table-hover" id="myTable" style="width:100%">
                <thead class="bg-primary text-light">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>ruc</th>
                    <th>Email</th>
                    <th>Logo</th>
                    <th>Fecha agregado</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                   
                    @forelse($office as $itemOffice)
                        
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $itemOffice->nombre}}</td>
                            <td>{{ $itemOffice->direccion}}</td>
                            <td>{{ $itemOffice->ruc}}</td>
                            <td>{{ $itemOffice->email}}</td>
                            <td>{{ $itemOffice->logo }}</td>
                            <td>{{ $itemOffice->created_at->diffForHumans()}}</td>
                            <td class="text-center">
                            <div class="btn-group">
                                <a href="{{route('office.edit',$itemOffice)}}"  class="btn  btn-warning mr-1"  >
                                <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{route('office.destroy',$itemOffice)}}" method="POST">
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