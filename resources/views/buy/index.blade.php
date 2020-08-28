@extends('layouts.layout')

@section('title','Compras')
    
@section('content')
<style>
	.ui-autocomplete-input {
	border: none;
	border: 1px solid #DDD !important;
	padding-top: 0px !important;
	z-index: 1511;
	position: relative;
	}
	.ui-menu .ui-menu-item a {
	font-size: 12px;
	}
	.ui-autocomplete {
	position: fixed;
	top: 100%;
	left: 0;
	z-index: 1051 !important;
	float: left;
	display: none;
	padding: 4px 0;
	list-style: none;
	background-color: #ffffff;
	border-color: #ccc;
	border-color: rgba(0, 0, 0, 0.2);
	border-style: solid;
	border-width: 1px;
	-webkit-border-radius: 2px;
	-moz-border-radius: 2px;
	border-radius: 2px;
	-webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	-moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	-webkit-background-clip: padding-box;
	-moz-background-clip: padding;
	background-clip: padding-box;
	*border-right-width: 2px;
	*border-bottom-width: 2px;
	}
	.ui-menu-item > a.ui-corner-all {
		display: block;
		padding: 3px 15px;
		clear: both;
		font-weight: normal;
		line-height: 18px;
		color: #555555;
		white-space: nowrap;
		text-decoration: none;
	}
	.ui-state-hover, .ui-state-active {
		color: #ffffff;
		text-decoration: none;
		background-color: #0088cc;
		border-radius: 0px;
		-webkit-border-radius: 0px;
		-moz-border-radius: 0px;
		background-image: none;
	}
	#modalIns{
		width: 500px;
	}
</style>
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
	@include('buy.modal.nueva_compra')
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
		let id_proveedor;
		var nueva_compra = function(){
			$('.compra').on("click", function(){
				$('#contenido').empty();
				$('#modalNuevaCompra').modal('show');
				let form;
				let div;
				let label;
				id_proveedor = null;
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
					class: 'form-control form-control-sm',
					id:'nombre_proveedor',
					placeholder:'Selecciona un proveedor'
				});
				input.appendTo(div_b);
				input.autocomplete({
                    source: function(request, response) {
                        
						var query=request.term;
                        $.ajax({
                            url:"buy/provider/"+query,
                            method: 'get',
							dataType:"json",
                            
                            success: function(data) {
                                response(data);
                            }
                        });
                    },
                    
					minLength: 1,
					select: function(event,ui){
						event.preventDefault();
						id_proveedor = ui.item.id_proveedor;
						$('#nombre_proveedor').val(ui.item.nombre_empresa);
						$('#telefono').val(ui.item.telefono);
						$('#ruc').val(ui.item.ruc);
					}
                });
				form.appendTo('#contenido');
				div_b = $('<div/>',{
					class :'form-group col-md-4'
				});
					label = $('<label/>',{
						class:'inputCity',
						text :'RUC'
					});
					label.appendTo(div_b);
					input = $('<input/>',{
						type:'text',
						class: 'form-control form-control-sm',
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
						class: 'form-control form-control-sm',
						id:'telefono',
						placeholder:'Telefono',
						readonly : true
					});
					input.appendTo(div_b);
					div_b.appendTo(div_form_row);
				div_form_row_1 = $('<div/>',{
					class :'form-row'
				});
					div_form_group = $('<div/>',{
						class:'form-group col-md-4'
					});
						label = $('<label/>',{
							class :'form-control-label',
							text : 'Metodo de pago'
						});
						select_opt = $('<select/>',{
							class:'form-control form-control-sm',
							id:'condiciones',
						});
						options_va = '<option value="1">Efectivo</option>';
						options_va += '<option value="2">Cheque</option>';
						options_va += '<option value="3">Transferencia bancaria</option>';
						select_opt.html(options_va);
					label.appendTo(div_form_group);
					select_opt.appendTo(div_form_group);
					div_form_group.appendTo(div_form_row);
					div_form_row.appendTo(div_container);

					div_form_group = $('<div/>',{
						class:'form-group col-md-2'
					});
						label = $('<label/>',{
							class :'form-control-label',
							text : 'Tipo de pago'
						});
						select_opt_1 = $('<select/>',{
							class:'form-control form-control-sm',
							id:'tipo_pago',
						});
						options_va = '<option value="1">Total</option>';
						options_va += '<option value="2">Parcial</option>';
						select_opt_1.html(options_va);
					label.appendTo(div_form_group);
					select_opt_1.appendTo(div_form_group);
					div_form_group.appendTo(div_form_row);

					div_form_group = $('<div/>',{
						class:'form-group col-md-2',
						id:'div_pagado',
						style:'display:none'
					});
						label = $('<label/>',{
							class :'form-control-label',
							text : 'Cantidad a pagar'
						});
					label.appendTo(div_form_group);
					div_form_group.appendTo(div_form_row);
					input_pagado = $('<input/>',{
						class : 'form-control form-control-sm',
						id:'pagado'
					});
					input_pagado.appendTo(div_form_group);
					select_opt_1.on("change", function(){
						$( "#tipo_pago option:selected" ).each(function() {
							if($(this).val() == 1){
								$("#div_pagado").hide();
								$("#pagado").val('');
							}else{
								$("#div_pagado").show();
								$("#pagado").val('');
							}
						});
					});
					div_form_group = $('<div/>',{
						class:'form-group col-md-4'
					});
						label = $('<label/>',{
							class :'form-control-label',
							text : 'Producto'
						});
						input_producto = $('<input/>',{
							class : 'form-control form-control-sm',
							id:'nombre_producto',
							placeholder:'Seleccione un producto'
						});
						input_producto.autocomplete({
							source: function(request, response) {
								
								var query=request.term;
								$.ajax({
									url:"buy/products/"+query,
									method: 'get',
									dataType:"json",
									
									success: function(data) {
										response(data);
									}
								});
							},
							
							minLength: 1,
							select: function(event,ui){
								event.preventDefault();
								$('#nombre_producto').val(ui.item.nombre_producto);
								
								insertar_fila(ui.item.id);
								
							}
						});
					label.appendTo(div_form_group);
					input_producto.appendTo(div_form_group);
					div_form_group.appendTo(div_form_row);

					div_form_group = $('<div/>',{
						class:'form-group col-md-2'
					});	
						label = $('<label/>',{
							class :'form-control-label ',
							text : ''
						});
						
						button_agregar = $('<button/>',{
							class:'btn btn-info btn-block mt-2 rounded btn-sm',
							id:'tipo_pago',
						});
						span_button = $('<span/>',{
							class: 'fa fa-plus',
							text:'Agregar'
						});
						span_button.appendTo(button_agregar);
						button_agregar.on('click', function(){
							event.preventDefault();
							
						});
					label.appendTo(div_form_group);
					
					button_agregar.appendTo(div_form_group);
					div_form_group.appendTo(div_form_row);
					div_row = $('<div/>',{
						class : 'form-row border-top border-info mt-3 pt-3 font-weight-bold',
						id:'cabecera_productos'
					});
					div_row.appendTo(div_container);
						div_col = $('<div/>',{
							class :'form-group col-md-4'
						});
						label = $('<label/>',{
							class:'inputCity',
							text :'Producto'
						});
						label.appendTo(div_col);
						div_col.appendTo(div_row);

						div_col = $('<div/>',{
							class :'form-group col-md-4'
						});
						label = $('<label/>',{
							class:'inputCity',
							text :'Cantidad'
						});
						label.appendTo(div_col);
						div_col.appendTo(div_row);
						div_col = $('<div/>',{
							class :'form-group col-md-4'
						});
						label = $('<label/>',{
							class:'inputCity',
							text :'Precio'
						});
						label.appendTo(div_col);
						div_col.appendTo(div_row);
					div_row = $('<div/>',{
						class : 'form-row border-top  mt-3 pt-3',
						id:'area_productos'
					});
					div_row.appendTo(div_container);
			
			
			})
		}
		nueva_compra();

		var insertar_fila = (id) => {
			let datos = {
				id
			}
			
			$.ajax({
				url:"buy/info_producto",
				method: 'post',
				dataType:"json",
				data: datos,
				headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
				success: function(data) {
					data = data[0];
					div_row = $('<div/>',{
						id:'filas',
						class:'form-row col-md-12',
						"data-id":data['id'],
						"data-empaque" :data['usa_empaque']
					});
					div_row.data('id',data['id']);
					div_row.data('empaque',data['usa_empaque']);

					div_row_1 = $('#area_productos');
					div_col = $('<div/>',{
							class :'form-group col-md-4'
						});
						label = $('<label/>',{
							class:'inputCity',
							text : data['nombre']
						});
						label.appendTo(div_col);
						div_col.appendTo(div_row);

						div_col = $('<div/>',{
							class :'form-row col-md-4 '
						});
						input = $('<input/>',{
							class:'form-control form-control-sm col-3 mr-1',
							id:'cant_und'
						});
						input.appendTo(div_col);
						label = $('<label/>',{
							class:'inputCity mr-2',
							text : data['medida_und'],
							
						});
						label.appendTo(div_col);

						if(parseInt(data['usa_empaque']) === 1){
							input = $('<input/>',{
								class:'form-control form-control-sm col-4 mr-1',
								id:'cant_paq'
								
							});
							label = $('<label/>',{
								class:'inputCity',
								text : data['medida_paq']
							});
							input.appendTo(div_col);
							label.appendTo(div_col);
							
						}
						div_col.appendTo(div_row);
						div_col = $('<div/>',{
							class :'form-group col-md-3'
						});
						input = $('<input/>',{
							class:'form-control form-control-sm col-10',
							id:'precio'
							
						});
						input.appendTo(div_col);
						div_col.appendTo(div_row);
						div_row.appendTo(div_row_1);
						
				}
			});
		}

		var generar_compra = () => {
			let filas = $("[id$=filas]");
			let precio = 0;
			let datos = {};
			let productos = [];
			let info = {};
			let id;
			let tipo_pago = $("#tipo_pago option:selected").val();
			let condiciones = $("#condiciones option:selected").val();
			let cantidad_pagado = null;
			filas.each(function(){
				id = $(this).data('id');
				cant_und = $(this).find('#cant_und').val();
				cant_paq = null;
				if($(this).data('empaque') === 1){
					cant_paq = $(this).find('#cant_paq').val();
				}
				cantidad = {
					cant_und,
					cant_paq
				};
				precio = $(this).find('#precio').val();

				info = {
					id,
					cantidad,
					precio
				};
				productos.push(info);
			});
			if(productos.length <= 0){
				alert('elija por lo menos un producto');
				$('#nombre_producto').focus();
				return false;
			}
			if(!id_proveedor){
				alert('Debe seleccionar un proveedor');
				$('#nombre_proveedor').focus();
				return false;
			}
			if(parseInt(tipo_pago) === 2){
				cantidad_pagado = $('#pagado').val();
				if(!cantidad_pagado){
					alert('Debe colocar la cantidad a pagar');
					$('#pagado').focus();
					return false;
				}
			}
			datos = {
				productos,
				id_proveedor,
				tipo_pago,
				condiciones,
				cantidad_pagado
			}
			console.log('datos->',datos);
		}

		var generar_compra_ajax = (datos) => {
			$.ajax({
				url:"buy/info_producto",
				method: 'post',
				dataType:"json",
				data: datos,
				headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
				success: function(data) {

				}
			});	
		}
    </script>
@endsection