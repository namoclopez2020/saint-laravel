@extends('layouts.layout')

@section('title','Productos')
    
@section('content')
<div class="container-fluid mt-3 pt-4">
    <div class="row">
        <div class="col-11 col-md-12 col-lg-12 mx-auto">
           <div class="card">
                <div class="card-header text-info h3">
                    <div class="row">
                        <div class="col-6 col-md-6 col-lg-6">
                            Lista de productos
                        </div>
                        <div class="col-6 col-md-6 col-lg-6">
                            <button class="btn btn-info float-right rounded btn-sm" id="agregar_producto">Agregar Producto</button>
                        </div>
                    </div>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="producto" style="width:100%">
                            <thead class="thead">
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Codigo</th>
                                <th>Fecha agregado</th>
                                <th>Es Serial</th>
                                <th>Unidad de medida</th>
                                <th>Fraccion</th>
                                <th>Stock minimo</th>
                                <th>Categoria</th>
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
@include('product.modal.nuevo_producto')
@include('product.modal.detalles')
@include('product.modal.seriales')
@endsection

@section('scripts')
    <script>

        function mostrar(producto) {
            
            $("#result").hide("slow");
            $("#cargar_reporte").show("slow");
            $("#editar_resul").load("product/"+producto, " ", function () {
                
                $("#editar_resul").show("slow");
                $("#cargar_reporte").hide("slow");
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
        
        function ver_seriales(id_producto){
            $("#result").hide("slow");
            $("#cargar").show("slow");
            $("#resultado").load("serial/"+id_producto, " ", function (data) {
                
                $("#resultado").show("slow");
                $("#cargar").hide("slow");
            });
        }

        var nuevo_producto = function(){
            $('#agregar_producto').on("click", function(){
				$('#contenido').empty();
                $('#modalNuevoProducto').modal('show');
                let form;
				let div;
                let label;
                form = $('<form/>',{
					 'id' : 'form_compra',
					'role'  : 'form',
					'class'  : 'form-horizontal'
				});
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
					text :'Nombre'
				});
                label.appendTo(div_b);
                form.appendTo($('#contenido'));
                input = $('<input/>',{
					type:'text',
					class: 'form-control form-control-sm',
					id:'nombre_producto',
					placeholder:'Descripción'
				});
                input.appendTo(div_b);
                div_b = $('<div/>',{
					class :'form-group col-md-3'
				});
					label = $('<label/>',{
						class:'inputCity',
						text :'Codigo'
					});
					label.appendTo(div_b);
					input = $('<input/>',{
						type:'text',
						class: 'form-control form-control-sm',
						id:'codigo',
						placeholder:'Codigo'
						
					});
					input.appendTo(div_b);
                    div_b.appendTo(div_form_row);
                
                div_b = $('<div/>',{
                    class:'form-group col-md-3'
                });
                    label = $('<label/>',{
                        class :'form-control-label',
                        text : 'Medida para unidad'
                    });
                    select_opt = $('<select/>',{
                        class:'form-control form-control-sm',
                        id:'condiciones',
                    });
                    options_va = '<option value="1">Unidad</option>';
                    options_va += '<option value="2">Gramos</option>';
                    options_va += '<option value="3">Milititros</option>';
                    select_opt.html(options_va);
                    label.appendTo(div_b);
					select_opt.appendTo(div_b);
					div_b.appendTo(div_form_row);
                    
                div_b = $('<div/>',{
                    class:'form-group col-md-2'
                });
                    label = $('<label/>',{
                        class :'form-control-label',
                        text : '¿Usa empaque?'
                    });
                    label.appendTo(div_b);
                    div_radio = $('<div/>',{
                        class : 'form-check ',
                    });
                    radio = $('<input/>',{
                        type:'radio',
                        class :'form-check-input',
                        name:'usa_empaque',
                        id:'usa_empaque',
                        value:'1'
                    });
                    label_radio = $('<label/>',{
                        class :'form-check-label',
                        text:'Si'
                    });
                    radio.appendTo(div_radio);
                    label_radio.appendTo(div_radio);
                    div_radio.appendTo(div_b);
                    div_radio = $('<div/>',{
                        class : 'form-check',
                    });
                    radio = $('<input/>',{
                        type:'radio',
                        class :'form-check-input',
                        name:'usa_empaque',
                        id:'usa_empaque',
                        value:'0'
                    });
                    label_radio = $('<label/>',{
                        class :'form-check-label',
                        text:'No'
                    });
                    radio.appendTo(div_radio);
                    label_radio.appendTo(div_radio);
                    div_radio.appendTo(div_b);
                    
                    div_b.appendTo(div_form_row);
                $('input[type=radio][name=usa_empaque]').change(function() {
                    if(parseInt(this.value) === 1){

                    }else{
                        
                    }
                });
                div_b = $('<div/>',{
                    class:'form-group col-md-2'
                });
                    label = $('<label/>',{
                        class :'form-control-label',
                        text : '¿Usa impuesto?'
                    });
                    label.appendTo(div_b);
                    div_radio = $('<div/>',{
                        class : 'form-check ',
                    });
                    radio = $('<input/>',{
                        type:'radio',
                        class :'form-check-input',
                        name:'usa_impuesto'
                    });
                    label_radio = $('<label/>',{
                        class :'form-check-label',
                        text:'Si'
                    });
                    radio.appendTo(div_radio);
                    label_radio.appendTo(div_radio);
                    div_radio.appendTo(div_b);
                    div_radio = $('<div/>',{
                        class : 'form-check',
                    });
                    radio = $('<input/>',{
                        type:'radio',
                        class :'form-check-input',
                        name:'usa_impuesto'
                    });
                    label_radio = $('<label/>',{
                        class :'form-check-label',
                        text:'No'
                    });
                    radio.appendTo(div_radio);
                    label_radio.appendTo(div_radio);
                    div_radio.appendTo(div_b);
                    
                    div_b.appendTo(div_form_row);
                
                    div_b = $('<div/>',{
                        class:'form-group col-md-2'
                    });
                    label = $('<label/>',{
                        class :'form-control-label',
                        text : '¿Es serializable?'
                    });
                    label.appendTo(div_b);
                    div_radio = $('<div/>',{
                        class : 'form-check ',
                    });
                    radio = $('<input/>',{
                        type:'radio',
                        class :'form-check-input',
                        name:'es_serial'
                    });
                    label_radio = $('<label/>',{
                        class :'form-check-label',
                        text:'Si'
                    });
                    radio.appendTo(div_radio);
                    label_radio.appendTo(div_radio);
                    div_radio.appendTo(div_b);
                    div_radio = $('<div/>',{
                        class : 'form-check',
                    });
                    radio = $('<input/>',{
                        type:'radio',
                        class :'form-check-input',
                        name:'es_serial'
                    });
                    label_radio = $('<label/>',{
                        class :'form-check-label',
                        text:'No'
                    });
                    radio.appendTo(div_radio);
                    label_radio.appendTo(div_radio);
                    div_radio.appendTo(div_b);
                    
                    div_b.appendTo(div_form_row);
                
            });
        }
        
        nuevo_producto();
        
    </script>
@endsection