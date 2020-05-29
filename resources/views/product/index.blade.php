@extends('layouts.layout')

@section('title','Productos')
    
@section('content')
<div class="container mt-4 pt-4">
    <div class="row">
        <div class="col-11 col-md-8 col-lg-10 mx-auto">
           <div class="card">
                <div class="card-header text-primary h3">
                   Lista de productos
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="producto" style="width:100%">
                            <thead class="bg-primary text-light">
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Codigo</th>
                                <th>Fecha agregado</th>
                                <th>Es Serial</th>
                                <th>Unidad de medida</th>
                                <th>Fraccion</th>
                                <th>Stock</th>
                                <th>Stock minimo</th>
                                <th>Categoria</th>
                                <th>Almacen</th>
                                <th>Costos</th>
                                <th>Precios</th>
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
@include('product.modal.detalles')
@endsection

@section('scripts')
    <script>

        function mostrar(producto) {
            $(document).ready(function () {
                $("#result").hide("slow");
                $("#cargar_reporte").show("slow");
                $("#editar_resul").load("product/"+producto, " ", function () {
                    
                    $("#editar_resul").show("slow");
                    $("#cargar_reporte").hide("slow");
                });
            });
        }

    
        producto();

        function elim (id){
            $.ajax({
                'method':'DELETE',
                'type':'json',
                'url':'/product/'+id,
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                'success': function(datos){
                    $('#producto').dataTable().fnDestroy();
                    producto();
                    display_msg('Datos del producto eliminado correctamente','success');
                }

            });
        }
    </script>
@endsection