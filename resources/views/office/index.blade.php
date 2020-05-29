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
              <table class="table table-hover" id="sucursal" style="width:100%">
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
                   
                  
                </tbody>
            </table>
              </div>
              
               </div>
           </div>
        </div>
    </div>
      
            
     
 
 </div>

    
@endsection
@section('scripts')
    <script>
        sucursal();

        function elim (id){
            $.ajax({
                'method':'DELETE',
                'type':'json',
                'url':'/office/'+id,
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                'success': function(datos){
                    $('#sucursal').dataTable().fnDestroy();
                    sucursal();
                    display_msg('Sucursal eliminada correctamente','success');
                }

            });
        }
    </script>
    
@endsection