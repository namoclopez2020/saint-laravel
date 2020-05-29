@extends('layouts.layout')

@section('title','Nueva Compra')
    
@section('content')
<div class="container mt-4">
    <div class="row">
    <div class="col-11 mx-auto mb-2">
    <text class="text-secondary">*Los productos que usan serial estaran disponibles en venta cuando se agreguen todos los numero de serie despues de la compra</text>
    </div>
    </div>
      <div class="container-fluid ">
         <div class="card">
             <div class="card-header"><i class="fa fa-edit">Nueva Compra</i></div>
             <div class="card-body">
             <form id="datos_compra"  method="POST" >
               @csrf
               <div class="form-row">
               <div class="form-group col-md-4 form-group-typeahead">
                <!-- <input type="text" name="actualizar" value="0">-->
                 <label for="inputCity">Proveedor</label>
                 <input type="text" class="form-control input-sm" id="nombre_proveedor" placeholder="Selecciona un proveedor" >
                    <!--     <input id="id_proveedor" name="provider_id" type='hidden'>-->
                              <input id="id_proveedor" name="provider_id" type='hidden'>
                 
                
               </div>
               <div class="form-group col-md-4">
                 <label for="inputCity">RUC</label>
           
               <input type="text" class="form-control input-sm" id="RUC" placeholder="RUC" readonly>
               
               </div>
               <div class="form-group col-md-4">
                 <label for="inputCity">Telefono</label>
                 <input type="text" class="form-control input-sm" id="tel" placeholder="tel" readonly>
               </div>	
               </div>
               <div class="form-row">
               <div class="form-group col-md-4">
                         <label class="form-control-label">Fecha</label>
                         <input type="text" id="fecha" value="" class="form-control input-datepicker">
               </div>
               <div class="form-group col-md-2">
               <label class="form-control-label">Pago</label>
                               
                                   <select class='form-control input-sm' id="condiciones" name="condiciones">
                                       <option value="1">Efectivo</option>
                                       <option value="2">Cheque</option>
                                       <option value="3">Transferencia bancaria</option>
                                   
                                   </select>
                               
               </div>
               <div class="form-group col-md-2">
               <label for="email" class="form-control-label">Tipo de pago</label>
                               
                                   <select class='form-control input-sm' id="tipo_pago" name="tipo_pago" onchange="load()">
                                       <option value="1">Total</option>
                                       <option value="0">Parcial</option>
                                       
                                   </select>
                               
               </div>
               <div class="form-group col-md-4" id="ajax_pago">
                      
                               
               </div>
               
               </div>
               <div class="form-row">
                   <div class="col-12">
                   <div class="pull-right">
                           
                           <a href="add_provider.php" class="btn btn-secondary " >
                            <span class="fa fa-user"></span> Nuevo proveedor
                           </a>
                       <!--	<button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal">
                            <span class="glyphicon glyphicon-ing"></span> Agregar productos
                           </button>-->
                           <button type="submit" class="btn btn-success ">
                             <span class="fa fa-print"></span> Imprimir
                           </button>
                       </div>	
                   </div>
               </div>
               </form>
                   
             </div>
         </div>
      </div>
      <div class="container-fluid">
          <div class="card bg-light" >
           <div class="card-body">
           <div class="row">
          <div class="col-12 col-md-8 col-lg-5">
              <div class="card"><div class="card-header bg-success text-light">Elegir productos</div>
              <div class="card-body">
              <div class="table-responsive">
              <table class="table" id="producto_compra_venta" style="width:100%">
                                 <thead>
                               <tr  class="warning">
                       <th style="width:10%">Código</th>
                       <th style="width:20%">Producto</th>
                       <th>Categoria</th>
                       <th>Stock</th>
                       <th>Medidas</th>
                       <th>Es Serial</th>
                       <th><span class="30%">Cant.</span></th>
                       <th><span class="">Costo</span></th>
                       <th class='text-center' style="width: 36px;">Agregar</th>
                       </tr>	
                               </thead>
                               <tbody>
                    
                  </tbody>
                                 </table>
              </div>
              </div>
           </div>
              
              
          </div>
          
              <div class="col-12 col-md-6 col-lg-7">
                  <div class="card">
                  <div class="card-header bg-secondary text-light h3">Detalle de compra</div>
                  <div class="card-body" id="resultados"></div>
                  </div>
                 
           </div>
          
      </div>
           </div>
          
          </div>
@endsection
@section('scripts')
  <script type="text/javascript" src="{{asset('/assets/js/VentanaCentrada.js')}}"></script>
  <script src="{{asset('/assets/js/nueva_compra.js')}}"></script>
  <script>
    
    function load(){
	var tipo_pago=$('#tipo_pago').find(":selected").val();
  $("#loader2").fadeIn('slow');
	$.ajax({
		type:"GET",
		url:'/TmpCompra/pago/'+tipo_pago,
		 beforeSend: function(objeto){
	$("#ajax_pago").html("Mensaje: Cargando...");
	  },
		success:function(data){
			$("#ajax_pago").html(data);
			
			
			
		}
	})
}

    $(document).ready(function() {

$('#nombre_proveedor').autocomplete({
  source: function(request, response){
    var query=request.term;
    $.ajax({
      method:'GET',
      url:"provider/"+query,
      dataType:"json",
      success: function(data){
        response(data);
      }

    });
  },
  minLength: 1,
  select: function(event,ui){
    event.preventDefault();
            $('#id_proveedor').val(ui.item.id_proveedor);
            $('#nombre_proveedor').val(ui.item.nombre_empresa);
            $('#tel').val(ui.item.telefono);
            $('#RUC').val(ui.item.ruc);
                            
      
  }
});


});

  </script>
@endsection