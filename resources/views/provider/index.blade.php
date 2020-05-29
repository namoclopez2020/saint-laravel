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
                <table class="table table-hover" id="proveedor" style="width:100%">
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
        proveedor();

        function elim (id){
            $.ajax({
                'method':'DELETE',
                'type':'json',
                'url':'/provider/'+id,
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                'success': function(datos){
                    $('#proveedor').dataTable().fnDestroy();
                    proveedor();
                    display_msg('Datos del proveedor eliminado correctamente','success');
                }

            });
        }
    </script>
    
@endsection