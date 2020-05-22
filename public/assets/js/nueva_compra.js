	$(document).ready(
		cargar()
	);
	function cargar (){
		$.ajax({
			type: "GET",
			url: "/TmpCompra",
			 beforeSend: function(objeto){
				$("#resultados").html('<img src="./public/vendor/lightbox2/images/loading.gif"/>');
			  },
			success: function(datos){
			$("#resultados").html(datos);
			}
				});
	}
	function agregar (id)
	{
		var costo_prod=document.getElementById('costo_prod_'+id).value;
		var cantidad_und=document.getElementById('cantidad_und_'+id).value;
		var token = $("[name='_token']").attr("value");
		//Inicia validacion
		if(document.getElementById('cantidad_paq_'+id)){
			var cantidad_paq = document.getElementById('cantidad_paq_'+id).value;
			if(cantidad_paq == '' && cantidad_und == ''  || (cantidad_und <= 0 && cantidad_paq <= 0) || (cantidad_paq < 0 || cantidad_und <0)){
				display_msg('Ingrese una cantidad válida','error');
				
				document.getElementById('cantidad_paq_'+id).focus();

			}
		}
		else{
			if(cantidad_und == '' || cantidad_und <= 0){
				display_msg('Ingrese una cantidad de unidades válida','error');
				
				document.getElementById('cantidad_und'+id).focus();
			}
			var cantidad_paq = "";
		}
		
		//prueba
		//console.log(cantidad_paq)
		
		if (costo_prod == "")
		{	
			display_msg('El campo de costo es válido','error');
			document.getElementById('costo_prod_'+id).focus();
		return false;
		}
		//Fin validacion
		
		$.ajax({
	type: "POST",
	url: "/TmpCompra",
	data: "id="+id+"&costo_prod="+costo_prod+"&cantidad_und="+cantidad_und+"&cantidad_paq="+cantidad_paq+"&_token="+token,
	 beforeSend: function(objeto){
		$("#resultados").html("Mensaje: Cargando...");
	  },
	success: function(datos){
		
	$("#resultados").html(datos);
	}
		});
	}
	

	//funcion eliminar de detalle de compras
			function eliminar (id)
		{
			
			$.ajax({
        type: "GET",
        url: "/TmpCompra/delete/"+id,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});

		}
		
		$("#datos_compra").submit(function(event){
			event.preventDefault();
			var opcion = false;
		  var id_proveedor = $("#id_proveedor").val();
		 // var id_vendedor = $("#id_vendedor").val();
		  var condiciones = $("#condiciones").val();
		  var tipo_pago = $('#tipo_pago').val();
		  if(tipo_pago == "2"){
			  var pagado=$('#pagado').val();
			if(pagado==""){

				display_msg('Debes colocar la cantidad pagada','error');
					//fin mensaje
					$("#pagado").focus();
				return false;
			}
		  }else{
			  var pagado="";
		  }
		  var fecha=$("#fecha").val();
		  if(fecha==''){
			  display_msg('Selecciona una fecha válida','error');
			
				$("#fecha").focus();
				return false;
		  }
		  
		  if (id_proveedor==""){
			  display_msg('Debes seleccionar un proveedor','error');
	
			  $("#nombre_proveedor").focus();
			 return false;
		  }
		  
		  const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
			  confirmButton: 'btn btn-success',
			  cancelButton: 'btn btn-danger mr-2'
			},
			buttonsStyling: false
		  })
		  
		  swalWithBootstrapButtons.fire({
			title: '¿ Desea actualizar los costos de los productos ?',
			text: "Esta acción no se podra revertir",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si',
			cancelButtonText: 'No',
			reverseButtons: true
		  }).then((result) => {
			if (result.value) {
			   opcion = true;
				
				VentanaCentrada('./libs/pdf/examples/comprobante_compra.php?fecha='+fecha+'&prov='+id_proveedor+'&condiciones='+condiciones+'&tipo_pago='+tipo_pago+'&pagado='+pagado+'&actualizar='+opcion,'Factura','','800','600','true');
			} else if (
			  /* Read more about handling dismissals below */
			  result.dismiss === Swal.DismissReason.cancel
			) {
				
				VentanaCentrada('./libs/pdf/examples/comprobante_compra.php?fecha='+fecha+'&prov='+id_proveedor+'&condiciones='+condiciones+'&tipo_pago='+tipo_pago+'&pagado='+pagado+'&actualizar='+opcion,'Factura','','800','600','true');
			}
		  })
		  
		  
		  document.getElementById("datos_compra").reset();
		  
		 
		
		 });
		 function actualizar_precio()
   	 	{
    var opcion = confirm("¿Desea actualizar los precios actuales de los productos?");
   
	return opcion;
	
		}
		
		$( "#guardar_cliente" ).submit(function( event ) {
		  $('#guardar_datos').attr("disabled", true);
		  
		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/nuevo_cliente.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados_ajax").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#resultados_ajax").html(datos);
					$('#guardar_datos').attr("disabled", false);
					load(1);
				  }
			});
		  event.preventDefault();
		})
		
		$( "#guardar_producto" ).submit(function( event ) {
		  $('#guardar_datos').attr("disabled", true);
		  
		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/nuevo_producto.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados_ajax_productos").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#resultados_ajax_productos").html(datos);
					$('#guardar_datos').attr("disabled", false);
					load(1);
				  }
			});
		  event.preventDefault();
		})
