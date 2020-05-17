/*$(document).ready(function(){
  $("#buying_price").change(function(){
    alert("The text has been changed.");
  });
});
	$('#resultados').on('change', '.form-control', function(){
		$("#utilidad").val('');
		var costo= $('#buying_price').val();
		var precio=$('#sale_price').val();
		var porcentaje=((parseFloat(precio)-parseFloat(costo))/parseFloat(costo))*100;
		
	 $("#utilidad").val(porcentaje);
		var blister=$('#cantidad_blister').val();
		var precio_blister=parseFloat(precio)/parseFloat(blister);
		$('#precio_blister').val(precio_blister);
		
		var unidad=$('#cantidad_unidad').val();
		var precio_unidad=parseFloat(precio_blister)/parseFloat(unidad);
        $('#precio_unidad').val(precio_unidad);
});
*/
function load(){
	
	var empaque=$('#usa_empaque').find(":selected").val();
	if(empaque==""){
		empaque=0;
	}
	if(empaque == "1"){
	//	$('#serial').hide();
	$("#es_serial option[value='0']").attr("selected",true);
	$("#es_serial option[value='']").attr("disabled",true);
	$("#es_serial option[value='1']").attr("disabled",true);
		
	}else{
		
		$("#es_serial option[value='']").attr("disabled",false);
		$("#es_serial option[value='0']").attr("disabled",false);
		$("#es_serial option[value='1']").attr("disabled",false);	
	}
	
	
$("#loader2").fadeIn('slow');
	$.ajax({
		type:"GET",
		url:'list/'+empaque,
		//data:"empaque="+empaque,
		 beforeSend: function(objeto){
	$(".resultados").html("Mensaje: Cargando...");
	  },
		success:function(data){
			
			$(".resultados").html(data);
			
			
			
			
		}
	})
}
function load1(){
	var impuesto=$('#usa_impuesto').find(":selected").val();
	$("#loader2").fadeIn('slow');
	$.ajax({
		type:"GET",
		url:'impuesto/'+impuesto,
		
		 beforeSend: function(objeto){
	$(".resultados1").html("Mensaje: Cargando...");
	  },
		success:function(data){
			$(".resultados1").html(data);
			
			
			
		}
	})
}

		

		
		$( "#agregar_productos" ).submit(function( event ) {
			event.preventDefault();
			
		  
		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "/product",
					data: parametros,
					 beforeSend: function(objeto){
					
					  },
					success: function(datos){
					//$("#resu").html(datos);
					if(datos == true){
					document.getElementById("agregar_productos").reset();
					$(function () {

						Messenger.options = {
							extraClasses: 'messenger-fixed messenger-on-top  messenger-on-right',
							theme: 'flat',
							messageDefaults: {
								showCloseButton: true
							}
						}
						Messenger().post({
							message: 'Producto agregado exitosamente',
							type: 'success'
						});
						
						
						});
					}
					else{

						display_msg('No puede tener negativos','error');
					}
				  }
			});
		
		})

	