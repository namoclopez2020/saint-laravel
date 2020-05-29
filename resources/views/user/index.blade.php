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
            <table class="table table-hover" id="usuario" style="width:100%">
                <thead class="bg-primary text-light">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Rol</th>
                    <th>Fecha agregado</th>
                    <th>Fecha Actualizado</th>
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
        usuario();

        function elim (id){
            $.ajax({
                'method':'DELETE',
                'type':'json',
                'url':'/user/'+id,
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                'success': function(datos){
                    $('#usuario').dataTable().fnDestroy();
                    usuario();
                    display_msg('Datos del usuario eliminado correctamente','success');
                }

            });
        }
        function estado (id){
            $.ajax({
                'method':'PATCH',
                'type':'json',
                'url':'/status/'+id,
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                'success': function(datos){
                    $('#usuario').dataTable().fnDestroy();
                    usuario();
                    display_msg('Usuario actualizado','success');
                }

            });
        }
    </script>
    
@endsection