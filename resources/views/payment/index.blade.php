@extends('layouts.layout')

@section('title','Cuentas por pagar')
    
@section('content')
<div  class="container" style="padding-top: 60px">
	
    <div class="col-md-12">
		<div class="card card-default">
		<div class="card-header">
		    
			<h4><i class='fa fa-search'></i> Cuentas por pagar</h4>
		</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" id="myTable" style="width:100%">
						<thead>
							<tr  class="info">
					<th>#</th>
					<th>Fecha</th>
                    <th>Numero de compra</th>
					<th>Cantidad pagada</th>
					<th class=''>Total</th>
					<th class=''>Acciones</th>
					
				</tr>
						</thead>
						<tbody>
                      @forelse ($compras as $itemCompra)
                      <tr>
                        <td> {{$loop->iteration}} </td>
                        <td> {{$itemCompra->created_at}} </td>
                        <td> {{$itemCompra->id}} </td>
                        <td> {{$itemCompra->pagado}} </td>
                        <td> {{$itemCompra->costo_total_compra}} </td>
                        <td>
                        <div class="btn-group">
                        <a class="btn btn-info mr-1" href="#" data-toggle="modal" data-target="#myModalpago" onclick="mostrar('{{$itemCompra->id}}')">Pagar</a>
                        
                        </div>
                        </td>
                        </tr> 
                      @empty
                          
                      @endforelse 
					
						
						</tbody>
					</table>
 				</div>
			</div>
		</div>	
		
	</div>
    </div>
    @include('payment.modal.nuevo_pago')
@endsection

@section('scripts')
<script>


    function mostrar(compra) {
        $(document).ready(function () {
            $("#result").hide("slow");
            $("#cargar_reporte").show("slow");
            $("#editar_resul").load("/buy/pagar/"+compra, " ", function () {
                $("#editar_resul").show("slow");
                $("#cargar_reporte").hide("slow");
            });
        });
    }
    
    function pagar (id){
        var maximo = $("#maximo").val();
        var monto = $("#pago").val();
        //console.log(monto);
        //console.log(maximo);
        
        if(monto ="" || monto <= 0 ){
            display_msg('Ingrese una cantidad valida','error');
            $("#pago").focus();
            return false;
        }
        if(monto > maximo){
            display_msg('Cantidad excede el monto máximo','error');
            return false;
        } 
        var parametros = $("#form_pago").serialize();
        $.ajax({
                        type: "POST",
                        url: "/buy/"+id,
                        data: parametros,
                         beforeSend: function(objeto){
                        //	$("#resultados_ajax").html("Mensaje: Cargando...");
                          },
                        success: function(datos){
                            
                            if(datos == true){
                                display_msg("pago realizado correctamente",'success');
                        setTimeout('document.location.reload()',2000);
                            }else{
                                display_msg("Cantidad excede el monto maximo",'error');
                            }
                        
                      }
                });
    }
    </script>
@endsection