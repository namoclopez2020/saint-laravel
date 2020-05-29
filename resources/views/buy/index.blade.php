@extends('layouts.layout')

@section('title','Compras')
    
@section('content')
<div  class="container" style="padding-top: 60px">
	
    <div class="col-md-12">
		<div class="card card-default">
		<div class="card-header">
		    <div class="btn-group pull-right">
				<a  href="nueva_compra.php" class="btn btn-info"><span class="fa fa-plus" ></span> Nueva Compra</a>
			</div>
			<h4><i class='fa fa-search'></i> Buscar Compras</h4>
		</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" id="compra" style="width:100%">
						<thead>
							<tr  class="info">
					<th>#</th>
					<th>Fecha</th>
					<th>Proveedor</th>
					<th>Medio de Pago</th>
					<th>Estado</th>
					<th>Cantidad pagada</th>
					<th class=''>Total</th>
					<th class=''>Acciones</th>
					
				        </tr>
						</thead>
						<tbody>
						
					
					
						</tbody>
					</table>
 				</div>
			</div>
		</div>	
		
	</div>
    </div>
    @include('buy.modal.detalles') 
@endsection
@section('scripts')
    <script>
        compra();
        function mostrar(compra) {
            $(document).ready(function () {
                $("#result").hide("slow");
                $("#cargar_reporte").show("slow");
                $("#editar_resul").load("/buy/detalles/"+compra, " ", function () {
                    $("#editar_resul").show("slow");
                    $("#cargar_reporte").hide("slow");
                });
            });
        }
        function detalles(id){
            window.open("/buy/"+id, "_blank");
        }
    </script>

@endsection