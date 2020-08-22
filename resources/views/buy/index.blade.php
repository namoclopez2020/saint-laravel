@extends('layouts.layout')

@section('title','Compras')
    
@section('content')
<div  class="container-flui" style="padding-top: 60px">
	
    <div class="col-md-12">
		<div class="card card-default">
		<div class="card-header">
		    <div class="btn-group pull-right ">
				<button class="btn btn-info compra" ><span class="fa fa-plus" ></span> Nueva Compra</button>
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
	@include('buy.modal.nueva_compra')
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

		var nueva_compra = function(){
			$('.compra').on("click", function(){
				$('#contenido').empty();
				$('#modalNuevaCompra').modal('show');
				let form;
				let div;
				let label;
				let id_proveedor;
				form = $('<form/>',{
					 'id' : 'form_compra',
					'role'  : 'form',
					'class'  : 'form-horizontal'
				});
				div = $('<div/>',{
					'class' : 'row',
				});
				div_a = $('<div/>',{
					class: 'col-11 mx-auto mb-2 text-secondary',
					text:'*Los productos que usan serial estaran disponibles en venta cuando se agreguen todos los numero de serie despues de la compra'
				});
				div_a.appendTo(div);
				div.appendTo(form);
				div_container = $('<div/>',{
					class:'container-fluid'
				});
				div_form_row = $('<div/>',{
					class:'form-row'
				});
				div_form_row.appendTo(div_container);
				div_container.appendTo(form);
				div_b = $('<div/>',{
					class : 'form-group col-md-4 form-group-typeahead'
				});
				div_b.appendTo(div_form_row);
				label = $('<label/>',{
					class:'inputCity',
					text :'Proveedor'
				});
				label.appendTo(div_b);
				input = $('<input/>',{
					type:'text',
					class: 'form-control input-sm',
					id:'nombre_proveedor',
					placeholder:'Selecciona un proveedor'
				});
				input.appendTo(div_b);
				form.appendTo('#contenido');
				div_b = $('<div/>',{
					class :'form-group col-md-4'
				});
					label = $('<label/>',{
						class:'inputCity',
						text :'Proveedor'
					});
					label.appendTo(div_b);
					input = $('<input/>',{
						type:'text',
						class: 'form-control input-sm',
						id:'ruc',
						placeholder:'RUC',
						readonly : true
					});
					input.appendTo(div_b);
					div_b.appendTo(div_form_row);
				div_b = $('<div/>',{
					class :'form-group col-md-4'
				});
					label = $('<label/>',{
						class:'inputCity',
						text :'Telefono'
					});
					label.appendTo(div_b);
					input = $('<input/>',{
						type:'text',
						class: 'form-control input-sm',
						id:'telefono',
						placeholder:'Telefono',
						readonly : true
					});
					input.appendTo(div_b);
					div_b.appendTo(div_form_row);

				//   <div class="form-row">

				//   <div class="form-group col-md-4">
				// 	<label for="inputCity">Telefono</label>
				// 	<input type="text" class="form-control input-sm" id="tel" placeholder="tel" readonly>
				//   </div>	
				//   </div>
				//   <div class="form-row">
				//   <div class="form-group col-md-4">
				// 			<label class="form-control-label">Fecha</label>
				// 			<input type="text" id="fecha" value="" class="form-control input-datepicker">
				//   </div>
				//   <div class="form-group col-md-2">
				//   <label class="form-control-label">Pago</label>
								  
				// 					  <select class='form-control input-sm' id="condiciones" name="condiciones">
				// 						  <option value="1">Efectivo</option>
				// 						  <option value="2">Cheque</option>
				// 						  <option value="3">Transferencia bancaria</option>
									  
				// 					  </select>
								  
				//   </div>
				//   <div class="form-group col-md-2">
				//   <label for="email" class="form-control-label">Tipo de pago</label>
								  
				// 					  <select class='form-control input-sm' id="tipo_pago" name="tipo_pago" onchange="load()">
				// 						  <option value="1">Total</option>
				// 						  <option value="0">Parcial</option>
										  
				// 					  </select>
								  
				//   </div>
				//   <div class="form-group col-md-4" id="ajax_pago">
						 
								  
				//   </div>
				  
				//   </div>
				//   <div class="form-row">
				// 	  <div class="col-12">
				// 	  <div class="pull-right">
							  
				// 			  <a href="add_provider.php" class="btn btn-secondary " >
				// 			   <span class="fa fa-user"></span> Nuevo proveedor
				// 			  </a>
				// 		  <!--	<button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal">
				// 			   <span class="glyphicon glyphicon-ing"></span> Agregar productos
				// 			  </button>-->
				// 			  <button type="submit" class="btn btn-success ">
				// 				<span class="fa fa-print"></span> Imprimir
				// 			  </button>
				// 		  </div>	
				// 	  </div>
				//   </div>
			
					  
			
      
        
            
         


			})
		}
		nueva_compra();
    </script>

@endsection