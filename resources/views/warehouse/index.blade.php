@extends('layouts.layout')

@section('title','Almacen')
    
@section('content')
 
    
<div class="container mt-4 pt-4">
    <div class="row">
        <div class="col-11 col-md-8 col-lg-10 mx-auto">
        <div class="card">
            <div class="card-header text-primary h3">Almacenes</div>
            <div class="card-body">
            <div class="table-responsive">
            <table class="table table-hover" id="almacen" style="width:100%">
                <thead class="bg-primary text-light">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Sucursal</th>
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
        almacen();

        function elim (id){
            $.ajax({
                'method':'DELETE',
                'type':'json',
                'url':'/warehouse/'+id,
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                'success': function(datos){
                    $('#almacen').dataTable().fnDestroy();
                    almacen();
                    display_msg('Almacen eliminado correctamente','success');
                }

            });
        }
    </script>
    
@endsection