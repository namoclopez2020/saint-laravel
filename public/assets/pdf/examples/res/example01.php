<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.midnight-blue{
	background:#2c3e50;
	padding: 4px 4px 4px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.silver{
	background:white;
	padding: 3px 4px 3px;
}
.clouds{
	background:#ecf0f1;
	padding: 3px 4px 3px;
}
.border-top{
	border-top: solid 1px #bdc3c7;
	
}
.border-left{
	border-left: solid 1px #bdc3c7;
}
.border-right{
	border-right: solid 1px #bdc3c7;
}
.border-bottom{
	border-bottom: solid 1px #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}
-->
</style>
<?php 

page_require_level(1);


//capturar datos de la sucursal
existe_sucursal_seleccionada();
$sucursal =usar_sucursal();
$id_sucursal=$sucursal[0];
//capturar datos para generar la factura

$id_prov=remove_junk($db->escape($_GET["prov"]));
$condiciones=remove_junk($db->escape($_GET["condiciones"]));
$sql_proveedor=find_provider_by_id($id_prov);
$fecha_factura=remove_junk($db->escape($_GET["fecha"]));
$time_fecha=strtotime($fecha_factura);
$fecha_factura=strftime("%Y-%m-%d %H:%M:%S", $time_fecha);
$tipo_pago=remove_junk($db->escape($_GET['tipo_pago']));
$pagado=remove_junk($db->escape($_GET['pagado']));
$actualizar_precio = remove_junk($db->escape($_GET['actualizar']));

//buscar ultimo id de compra para asignar un numero nuevo de compra
$sql=$db->query("select LAST_INSERT_ID(numero_compra) as last from compras order by id_compra desc limit 0,1 ");
$rw=$db->fetch_array($sql);
$numero_factura=$rw['last']+1;


?>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo "Mr Robot "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <table cellspacing="0" style="width: 100%;">
        <tr>

            <td style="width: 25%; color: #444444;">
                <img style="width: 50%;" src="../../../libs/img/usuario.png" alt="Logo"><br>
                
            </td>
			<td style="width: 50%; color: #34495e;font-size:12px;text-align:center">
                <span style="color: #34495e;font-size:14px;font-weight:bold"><?php echo $sucursal[1] ?></span>
				<br><?php echo $sucursal[2] ?><br> 
				
				
				RUC: <?php echo $sucursal[6]?>
                
            </td>
			<td style="width: 25%;text-align:right">
			COMPROBANTE Nº <?php echo $id_prov;?>
			</td>
			
        </tr>
    </table>
    <br>
    

	
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:100%;" class='midnight-blue'>PROVEEDOR</td>
        </tr>
		<tr>
           <td style="width:50%;" >
            <?php 
                foreach($sql_proveedor as $sql_proveedor):
                echo "<b>Nombre:</b> ";
                echo ucwords( $sql_proveedor['nombre']);
				echo "<br>";
			    echo "<b>Teléfono:</b> ";
				echo $sql_proveedor['Telefono'];
				echo "<br> <b>RUC:</b> ";
				echo $sql_proveedor['RUC'];
				endforeach;
			?>
			
		   </td>
        </tr>
        
   
    </table>
    
       <br>
		<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:35%;" class='midnight-blue'>USUARIO</td>
		  <td style="width:25%;" class='midnight-blue'>FECHA</td>
		   <td style="width:40%;" class='midnight-blue'>FORMA DE PAGO</td>
        </tr>
		<tr>
           <td style="width:35%;">
			<?php 
				$nombre_vendedor = $_SESSION['nombre_usuario'];
				echo $nombre_vendedor;
			?>
		   </td>
		  <td style="width:25%;"><?php echo read_date($fecha_factura);?></td>
		   <td style="width:40%;" >
				<?php 
				if ($condiciones==1){echo "Efectivo";}
				elseif ($condiciones==2){echo "Cheque";}
				elseif ($condiciones==3){echo "Transferencia bancaria";}
				elseif ($condiciones==4){echo "Crédito";}
				?>
		   </td>
        </tr>
		
        
   
    </table>
	<br>
  
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 10%;text-align:center" class='midnight-blue'>CANT.</th>
            <th style="width: 60%" class='midnight-blue'>DESCRIPCION</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'></th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO TOTAL</th>
            
        </tr>

<?php
$nums=1;
$sumador_total=0;
$session_id=$_SESSION['user_id'];
$sql_prov=$db->query("select * from proveedor where idproveedor='$id_prov'");
$rw_prov=$db->fetch_array($sql_prov);
$nombre_proveedor=$rw_prov['nombre'];	
$sql=$db->query("select * from products, tmp_compra where products.id_producto=tmp_compra.id_producto_compra and tmp_compra.session_id_compra='".$session_id."'");
$tipo_movimiento=8;
		
while ($row=$db->fetch_array($sql))
	{
	$id_tmp=$row["id_tmp_compra"];
	$id_producto=$row["id_producto"];
	$codigo_producto=$row['codigo_producto'];
    $cantidad_paq=$row['cantidad_paq'];
    $cantidad_und=$row['cantidad_und'];
    $medida_paq=$row['medida_paq'];
    $medida_und=$row['medida_und'];
	$nombre_producto=$row['nombre_producto'];
	$es_serial = $row['es_serial'];
	$usa_empaque= $row['usa_empaque'];
	$fraccion = $row['fraccion'];
	if($es_serial){
		$estado = "en espera";
	}
	else{
		$estado = "vigente";
	}
	
	
	$costo_compra=$row['costo_compra_tmp'];
	$costo_compra_f=number_format($costo_compra,2);//Formateo variables
	$costo_compra_r=str_replace(",","",$costo_compra_f);//Reemplazo las comas
	$precio_total=$costo_compra_r;
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador
	
	//Insert en la tabla detalle_compra
	$insert_detail=$db->query("INSERT INTO detalle_compra (num_compra,id_producto_compra,cant_paq,cant_und,costo_compra) VALUES ('$numero_factura','$id_producto','$cantidad_paq','$cantidad_und','$costo_compra_r')");
	
	//insert en la tabla detalle_producto para lotes
	$insert_lote= $db->query("INSERT INTO detalle_producto (numero_compra,id_producto,fecha_agregado,paq,und,id_proveedor,estado) VALUES ('$numero_factura','$id_producto','$fecha_factura','$cantidad_paq','$cantidad_und','$id_prov','$estado')");
	
	//actualizar costos en caso el usuario lo pida
	if($actualizar_precio == "true"){
		$sql_buscar="SELECT costo_anterior,costo_promedio,costo_actual from products where id_producto=$id_producto";
		$datos = find_by_sql($sql_buscar);
		foreach ($datos as $dato) :
			$costo_anterior = $dato['costo_anterior'];
			$costo_actual = $dato['costo_actual'];
			$costo_promedio = $dato['costo_promedio'];
		endforeach;
		$costo_anterior = $costo_actual;
		if($usa_empaque){
		 $unidades_totales = $cantidad_und+($cantidad_paq)*$fraccion;
		 $costo_actual=(double)$costo_compra/(double)$unidades_totales;
		 
		}
		else{
		$costo_actual = (double)$costo_compra/(double)$cantidad_und;
		}
		$costo_promedio =((double)$costo_anterior+(double)$costo_actual)/2;
		$costo_actual = dinero($costo_actual);
		$actualizar="UPDATE products set costo_anterior='{$costo_anterior}' , costo_actual='{$costo_actual}' , costo_promedio='{$costo_promedio}' where id_producto='$id_producto'";
		$db->query($actualizar);
	}
	
	//actualizar el stock en el producto
	sumar_stock($cantidad_paq,$cantidad_und,$id_producto);
	
	// insertar_movimiento_producto($id_producto,$tipo_movimiento,$cantidad,$_SESSION['user_id'],$fecha_factura);
				
	
	if ($nums%2==0){
		$clase="clouds";
	} else {
		$clase="silver";
	}
	?>

        <tr>
            <td class='<?php echo $clase;?>' style="width: 10%; text-align: center"><?php echo $cantidad_paq." ".$medida_paq." ".$cantidad_und." ".$medida_und ; ?></td>
            <td class='<?php echo $clase;?>' style="width: 60%; text-align: left"><?php echo $nombre_producto;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right">&nbsp;</td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_total_f;?></td>
            
        </tr>

	<?php 
	
	
	$nums++;
	}
	
	$total_factura= number_format($sumador_total,2,'.','');
	$total_iva=($total_factura * 18 )/100;
	$total_iva=number_format($total_iva,2,'.','');
	$subtotal=$total_factura-$total_iva;
?>
	  
        <tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">SUBTOTAL $/. </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($subtotal,2);?></td>
        </tr>
		<tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">IGV (<?php echo "18" ?>)%  </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_iva,2);?></td>
        </tr><tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">TOTAL $/. </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_factura,2);?></td>
        </tr>
    </table>
	
	
	
	<br>
	
	
	
	  

</page>




<?php
if($tipo_pago == 1 ) {
	$pagado = $total_factura;
}
$status_compra = ($tipo_pago == 1)  ? 'Total' : 'Parcial';
$insert=$db->query( "INSERT INTO compras (numero_compra,fecha_compra,id_proveedor,costo_total_compra,pagado,metodo_pago,suc_id,status_compra) VALUES ('$numero_factura','$fecha_factura','$id_prov','$total_factura','$pagado','$condiciones','$id_sucursal','$status_compra')");

//insertar pago
switch ($condiciones) {
	case 1:
		$metodo_pago = "Efectivo";
		break;
	case 2:
		$metodo_pago = "Cheque";
		break;
	case 3:
		$metodo_pago = "Transferencia Bancaria";
		break;
	
		
}
$sql= "INSERT INTO pagos(num_compra,monto_pagado,fecha_pago,id_usuario,id_sucursal,metodo_pago) ";

    $sql.= "VALUES ($numero_factura,$pagado,'{$fecha_factura}',$session_id,$id_sucursal,'{$metodo_pago}')";
    $db->query($sql);



$delete=$db->query("DELETE FROM tmp_compra WHERE session_id_compra='".$session_id."'");
?>