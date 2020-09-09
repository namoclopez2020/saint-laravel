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

        function producto(){
            var dataTable = $('#producto').DataTable({
                "language": {
                    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                    
                },
                'responsive': true,
                "ajax" : "/producto",
                "serverSide" : true,
                "processing" : true,
                "columns":[
                    {data: "id"},
                    {data: "nombre"},
                    {data: "codigo"},
                    {data: "fecha"},
                    {data: "esSerialText"},

                    {render: function(data,type,row){
                        return row['medida_paq']+"/"+row['medida_und'];
                    }},
                    {data: "fraccion"},
                    {render:function(data,type,row){
                        return row['min_paq']+"/"+row['min_und'];
                    }},
                    {render: function(data,type,row){
                        return row['categorie']['nombre'];
                    }},
                    { width: "1%",
                        render: function(data,type,row){
                        let botones = "<div class=\"dropdown  \">";
                            botones += "<button class=\"btn rounded btn-sm btn-light border-primary dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Dropdown button</button>";
                            botones += " <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">";
                            botones += "<a class=\"dropdown-item\" href=\"#\">Action</a>";
                            botones += "<a class=\"dropdown-item\" href=\"#\">Another action</a>";
                            if(parseInt(row['es_serial']) === 1){
                                
                                botones += "<a class=\"dropdown-item\" href=\"#\"  data-toggle=\"modal\" data-target=\"#myModalseriales\" onclick=\"ver_seriales("+row['id']+")\">Another action</a>";
                            }
                            botones += "</div>";
                            botones += "</div>";
                        
                        /*
                        botones = "<div class='btn-group'>";
                            
                        botones +="<a class='btn btn-info mr-2' href='#' data-toggle='modal' data-target='#myModalmostrar' onclick='mostrar("+row['id']+")'> &nbsp;&nbsp;+ info&nbsp;&nbsp;</a>";
                        botones +="<a href='/product/"+row['id']+"/edit'  class='btn  btn-warning mr-1'  >";
                        botones +="<i class='fa fa-pencil'></i></a>";
                        
                        botones +="<button onclick='elim("+row['id']+")' class='btn  btn-danger'> <span class='fa fa-trash'></span></button>";
                        botones +="</div>";
                        */
                        return botones;
                    }}
                ]
            })
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
                $.ajax({
                    url:"categorie/listar",
                    method: 'get',
                    dataType:"json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(categorias) {
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
                            class :'form-group col-md-2'
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
                                id:'medida_und',
                            });
                            options_va = '<option value="1">Unidad</option>';
                            options_va += '<option value="2">Gramos</option>';
                            options_va += '<option value="3">Milititros</option>';
                            select_opt.html(options_va);
                            label.appendTo(div_b);
                            select_opt.appendTo(div_b);
                            div_b.appendTo(div_form_row);
                        
                        div_b = $('<div/>',{
                            class:'form-group col-md-3'
                        });
                            label = $('<label/>',{
                                class :'form-control-label',
                                text : 'Categoria'
                            });
                            select_opt = $('<select/>',{
                                class:'form-control form-control-sm',
                                id:'categoria',
                            });
                            options_va = "<option value='' selected>Seleccione</option>";
                            categorias.forEach(function(cats){
                                options_va += `<option value="${cats.id}"> ${cats.nombre}</option>`;
                            });
                                                        
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
                                id:'usa_empaque_1',
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
                            div_b_1= $('<div/>',{
                                class :'form-group col-md-3',
                                style:'display:none'
                            });
                                label = $('<label/>',{
                                    class:'inputCity',
                                    text :'Cantidad por empaque'
                                });
                                label.appendTo(div_b_1);
                                input = $('<input/>',{
                                    type:'text',
                                    class: 'form-control form-control-sm',
                                    id:'cantidad',
                                    placeholder:'Cantidad'
                                    
                                });
                                input.appendTo(div_b_1);
                                div_b_1.appendTo(div_form_row);
                            
                            div_b_2 = $('<div/>',{
                                class:'form-group col-md-3',
                                style:'display:none'
                            });
                                label = $('<label/>',{
                                    class :'form-control-label',
                                    text : 'Medida para empaque'
                                });
                                select_opt = $('<select/>',{
                                    class:'form-control form-control-sm',
                                    id:'medida_paq',
                                });
                                options_va = '<option value="1">Paquete</option>';
                                options_va += '<option value="2">Kilos</option>';
                                options_va += '<option value="3">Litros</option>';
                                select_opt.html(options_va);
                                label.appendTo(div_b_2);
                                select_opt.appendTo(div_b_2);
                                div_b_2.appendTo(div_form_row);

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
                                name:'usa_impuesto',
                                id:'usa_impuesto',
                                value : '1',
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
                                value : '0',
                                name:'usa_impuesto',
                                id:'usa_impuesto',
                            });
                            label_radio = $('<label/>',{
                                class :'form-check-label',
                                text:'No'
                            });
                            radio.appendTo(div_radio);
                            label_radio.appendTo(div_radio);
                            div_radio.appendTo(div_b);
                            
                            div_b.appendTo(div_form_row);

                            div_b_3= $('<div/>',{
                                class :'form-group col-md-2',
                                style:'display:none'
                            });
                            label = $('<label/>',{
                                class:'inputCity',
                                text :'% de impuesto'
                            });
                            label.appendTo(div_b_3);
                            input = $('<input/>',{
                                type:'text',
                                class: 'form-control form-control-sm',
                                id:'impuesto_porc',
                                placeholder:'18%'
                                
                            });
                            input.appendTo(div_b_3);
                            div_b_3.appendTo(div_form_row);
                        
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
                                name:'es_serial',
                                id:'es_serial',
                                value : '1'
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
                                name:'es_serial',
                                id:'es_serial_1',
                                value : '0'
                            });
                            label_radio = $('<label/>',{
                                class :'form-check-label',
                                text:'No'
                            });
                            radio.appendTo(div_radio);
                            label_radio.appendTo(div_radio);
                            div_radio.appendTo(div_b);
                            
                            div_b.appendTo(div_form_row);

                            div_b= $('<div/>',{
                                class :'form-group col-md-3',
                            
                            });
                            label = $('<label/>',{
                                class:'inputCity',
                                text :'Stock mínimo'
                            });
                            label.appendTo(div_b);
                            row = $('<div/>',{
                                class :'form-row'
                            });
                            input_c = $('<input/>',{
                                type:'text',
                                class: 'form-control form-control-sm col-4',
                                id:'min_paq',
                                placeholder:'1',
                                style:'display:none'
                                
                            });
                            input_c.appendTo(row);
                            label_c = $('<label/>',{
                                class:'inputCity col-2',
                                text :'PAQ',
                                style:'display:none'
                            });
                            label_c.appendTo(row);
                            input = $('<input/>',{
                                type:'text',
                                class: 'form-control form-control-sm col-4',
                                id:'min_und',
                                placeholder:'1'
                                
                            });
                            input.appendTo(row);
                            label = $('<label/>',{
                                class:'inputCity col-2',
                                text :'UND'
                            });
                            label.appendTo(row);
                            row.appendTo(div_b);
                            div_b.appendTo(div_form_row); 

                            
                            $('input[type=radio][name=usa_empaque]').change(function() {
                                if(parseInt(this.value) === 1){
                                    div_b_1.show('slow');
                                    div_b_2.show('slow');
                                    $("#es_serial").prop("checked", false);
                                    $("#es_serial_1").prop("checked", true);
                                    $("#es_serial").attr("disabled", true);
                                    input_c.show('slow');
                                    label_c.show('slow');
                                }else{
                                    div_b_1.hide('slow');
                                    div_b_2.hide('slow');
                                    input_c.hide('slow');
                                    label_c.hide('slow');
                                    $("#es_serial").attr("disabled", false);
                                    
                                }
                            });
                            $('input[type=radio][name=usa_impuesto]').change(function() {
                                if(parseInt(this.value) === 1){
                                    div_b_3.show('slow');
                                }else{
                                    div_b_3.hide('slow'); 
                                }
                            });
                    }
                });
            });
        }

        nuevo_product_ajax = function(){
            
            let valores = {
                nombre : $('#nombre_producto').val(),
                codigo : $('#codigo').val(),
                medidas : {
                    medida_und : $("#medida_und option:selected").val(),
                    medida_paq : $("#medida_paq option:selected").val()
                },
                cantidades : {
                    empaque : $('#cantidad').val(),
                    min_paq : $('#min_paq').val(),
                    min_und : $('#min_und').val(),
                },
                usa_impuesto :  $('input[name=usa_impuesto]:checked').val(),
                porcentaje_impuesto : $('#impuesto_porc').val(),
                es_serial : $('input[name=es_serial]:checked').val(),
                usa_empaque : $('input[name=usa_empaque]:checked').val(),
                categoria : $("#categoria option:selected").val(),

                
            };
            console.log(valores);
            
            $.ajax({
				url:"product",
				method: 'post',
				dataType:"json",
				data: valores,
				headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
				success: function(data) {
					if(data['error'] == 0){
                        alert(data['mensaje']);
                    }else if(data['errors']['codigo']){
                        let mensaje = "";
                        data['errors']['codigo'].forEach(function(mensajes){
                            mensaje +=  `${mensajes} <br/>`;
                        });
                        display_msg(mensaje,'error');
                    }
                },
                error: function (request, status, error) {
                    let mensaje = "";
                    request['responseJSON']['errors']['codigo'].forEach(function(mensajes){
                        mensaje +=  `${mensajes} <br/>`;
                    });
                    request['responseJSON']['errors']['nombre'].forEach(function(mensajes){
                        mensaje +=  `${mensajes} <br/>`;
                    });
                    display_msg(mensaje,'error');
                    //display_msg(mensaje,'success');
                }
			});	
length
            
        }
        
        nuevo_producto();
        
    </script>
@endsection